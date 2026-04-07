<?php
/**
 * Template Name: Error Codes – Appliance Listing
 *
 * Lists all error codes for a specific appliance type.
 * URL: /error-codes/dishwasher/
 * Detail: /error-codes/dishwasher/?code=e15
 *
 * @package BoschRepairPro
 */
get_header();

$appliance_slug  = get_post_field( 'post_name', get_the_ID() );

// Map slug to clean appliance label (avoids "Bosch Dishwasher Error Codes" duplication)
$appliance_labels = array(
    'dishwasher'   => 'Dishwasher',
    'washer'       => 'Washer',
    'dryer'        => 'Dryer',
    'refrigerator' => 'Refrigerator',
    'oven'         => 'Oven & Range',
    'cooktop'      => 'Cooktop',
    'microwave'    => 'Microwave',
    'freezer'      => 'Freezer',
);
$appliance_title = isset( $appliance_labels[ $appliance_slug ] ) ? $appliance_labels[ $appliance_slug ] : get_the_title();

// Built-in error code data by appliance
// Load error codes from DB only
$db_ec_query = new WP_Query( array(
    'post_type'      => 'error_code',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value',
    'meta_key'       => '_brp_error_code',
    'order'          => 'ASC',
    'tax_query'      => array(
        array(
            'taxonomy' => 'appliance_type',
            'field'    => 'slug',
            'terms'    => $appliance_slug,
        ),
    ),
) );

$code_map = array();
if ( $db_ec_query->have_posts() ) {
    while ( $db_ec_query->have_posts() ) {
        $db_ec_query->the_post();
        $code_val = get_post_meta( get_the_ID(), '_brp_error_code', true );
        $code_val = $code_val ? strtoupper( trim( $code_val ) ) : strtoupper( get_the_title() );
        $key      = strtolower( str_replace( ' ', '', $code_val ) );
        $code_map[ $key ] = array(
            'code'      => $code_val,
            'title'     => get_the_title(),
            'desc'      => get_the_excerpt() ?: wp_trim_words( get_the_content(), 40, '...' ),
            'permalink' => get_permalink(),
            'from_db'   => true,
        );
    }
    wp_reset_postdata();
}

uksort( $code_map, 'strnatcasecmp' );
$error_codes = array_values( $code_map );

// Most common codes: first 6 from the sorted list
$appliance_most_common = array_slice( array_keys( $code_map ), 0, 6 );

// Check if a specific code is requested
$requested_code = isset( $_GET['code'] ) ? strtolower( sanitize_key( $_GET['code'] ) ) : '';
$detail         = ( $requested_code && isset( $code_map[ $requested_code ] ) ) ? $code_map[ $requested_code ] : null;

// Also check database for the requested code
$db_detail_post = null;
if ( $requested_code && ! $detail ) {
    $db_check = new WP_Query( array(
        'post_type'      => 'error_code',
        'posts_per_page' => 1,
        'meta_query'     => array(
            array(
                'key'     => '_brp_error_code',
                'value'   => strtoupper( $requested_code ),
                'compare' => '=',
            ),
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'appliance_type',
                'field'    => 'slug',
                'terms'    => $appliance_slug,
            ),
        ),
    ) );
    if ( $db_check->have_posts() ) {
        $db_check->the_post();
        $db_detail_post = get_the_ID();
        wp_reset_postdata();
    }
}

// FAQ schema for list view
if ( ! $detail && ! empty( $error_codes ) ) {
    $schema = brp_get_faq_schema( array_map( function( $c ) {
        return array(
            'q' => 'What does Bosch error code ' . $c['code'] . ' mean?',
            'a' => $c['title'] . ': ' . $c['desc'],
        );
    }, $error_codes ) );
    echo $schema;
}

// Appliance page URL (base)
$appliance_url = get_permalink();

// All appliance categories for nav buttons
$ec_categories = array(
    array( 'slug' => 'dishwasher',   'label' => 'Dishwasher',   'icon' => '🍽️' ),
    array( 'slug' => 'washer',       'label' => 'Washer',       'icon' => '🫧' ),
    array( 'slug' => 'dryer',        'label' => 'Dryer',        'icon' => '🌀' ),
    array( 'slug' => 'refrigerator', 'label' => 'Refrigerator', 'icon' => '🧊' ),
    array( 'slug' => 'oven',         'label' => 'Oven & Range', 'icon' => '🔥' ),
    array( 'slug' => 'cooktop',      'label' => 'Cooktop',      'icon' => '♨️' ),
    array( 'slug' => 'microwave',    'label' => 'Microwave',    'icon' => '📡' ),
    array( 'slug' => 'freezer',      'label' => 'Freezer',      'icon' => '❄️' ),
);
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>

        <?php if ( $detail ) : ?>
            <div style="display:inline-flex;align-items:center;gap:12px;margin-bottom:16px;">
                <span class="error-code-badge" style="font-size:1.1rem;"><?php echo esc_html( $detail['code'] ); ?></span>
            </div>
            <h1><?php echo esc_html( $detail['title'] ); ?></h1>
            <p>Bosch <?php echo esc_html( $appliance_title ); ?> &mdash; Error Code <?php echo esc_html( $detail['code'] ); ?></p>
        <?php else : ?>
            <h1>Bosch <?php echo esc_html( $appliance_title ); ?> Error Codes</h1>
            <p>Complete list of Bosch <?php echo esc_html( strtolower( $appliance_title ) ); ?> error codes with explanations and recommended repairs.</p>
        <?php endif; ?>

    </div>
</section>

<section class="section">
    <div class="container">

        <?php if ( $detail ) : ?>
        <!-- ================================================== -->
        <!-- DETAIL VIEW: single error code                     -->
        <!-- ================================================== -->
        <div class="content-grid">
            <div class="main-content">

                <!-- Back link -->
                <a href="<?php echo esc_url( $appliance_url ); ?>" class="brp-back-link">
                    &larr; All <?php echo esc_html( $appliance_title ); ?> Error Codes
                </a>

                <!-- Code card -->
                <div class="brp-ec-detail-card">
                    <div class="brp-ec-detail-header">
                        <span class="error-code-badge brp-ec-badge-lg"><?php echo esc_html( $detail['code'] ); ?></span>
                        <div>
                            <h2 class="brp-ec-detail-title"><?php echo esc_html( $detail['title'] ); ?></h2>
                            <p class="brp-ec-detail-appliance">
                                Bosch <?php echo esc_html( $appliance_title ); ?> &mdash; Error Code <?php echo esc_html( $detail['code'] ); ?>
                            </p>
                        </div>
                    </div>

                    <div class="brp-ec-detail-body">
                        <h3>What Does This Error Mean?</h3>
                        <p><?php echo esc_html( $detail['desc'] ); ?></p>
                    </div>

                    <div class="brp-ec-detail-actions">
                        <div class="notice notice-warning" style="margin-bottom:0;">
                            <strong>⚠️ Need Professional Help?</strong>
                            If this error code persists after basic troubleshooting, our certified Bosch technicians are available for same-day diagnosis and repair.
                            Call <a href="tel:<?php echo BRP_PHONE_RAW; ?>"><?php echo BRP_PHONE; ?></a> or book online below.
                        </div>
                    </div>
                </div>

                <!-- Steps to try first -->
                <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:28px;margin-top:32px;">
                    <h3 style="margin-bottom:16px;">General Troubleshooting Steps</h3>
                    <ol style="display:flex;flex-direction:column;gap:10px;margin:0;padding-left:20px;">
                        <li><strong>Hard reset:</strong> Unplug the appliance (or switch off the circuit breaker) for 5–10 minutes, then restore power.</li>
                        <li><strong>Note the code:</strong> Write down the exact error code and when it appeared.</li>
                        <li><strong>Check the manual:</strong> Your Bosch appliance manual may have model-specific reset procedures.</li>
                        <li><strong>Call a technician:</strong> If the code returns after a reset, professional diagnosis is recommended.</li>
                    </ol>
                </div>

                <!-- Other codes in this appliance -->
                <div style="margin-top:40px;">
                    <h3 style="margin-bottom:20px;">Other <?php echo esc_html( $appliance_title ); ?> Error Codes</h3>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <?php foreach ( array_slice( $error_codes, 0, 6 ) as $other ) :
                            if ( strtolower( str_replace( ' ', '', $other['code'] ) ) === $requested_code ) continue; ?>
                        <a href="<?php echo esc_url( add_query_arg( 'code', strtolower( str_replace( ' ', '', $other['code'] ) ), $appliance_url ) ); ?>" class="error-card">
                            <span class="error-code-badge"><?php echo esc_html( $other['code'] ); ?></span>
                            <div class="error-card-info">
                                <h4><?php echo esc_html( $other['title'] ); ?></h4>
                            </div>
                            <span style="margin-left:auto;color:var(--color-gray);font-size:1.25rem;flex-shrink:0;">›</span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo esc_url( $appliance_url ); ?>" class="btn btn-secondary" style="margin-top:16px;">
                        View All <?php echo esc_html( $appliance_title ); ?> Codes &rarr;
                    </a>
                </div>

            </div>

            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">📞 Get Expert Help</div>
                    <div class="sidebar-phone">
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="sidebar-phone-number"><?php echo BRP_PHONE; ?></a>
                        <p>Tell us your error code and we'll diagnose it over the phone — often free of charge.</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call Now</a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Repair</a>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">✅ Why Choose Us</div>
                    <div class="sidebar-widget-body">
                        <ul class="checklist" style="gap:8px;">
                            <li>Factory-certified Bosch parts</li>
                            <li>Same-day service available</li>
                            <li>90-day labor warranty</li>
                            <li>Trained, background-checked techs</li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">🔍 Other Appliance Codes</div>
                    <div class="sidebar-widget-body">
                        <ul class="footer-links" style="gap:8px;">
                            <?php
                            $all_types = array(
                                'dishwasher'   => 'Dishwasher',
                                'washer'       => 'Washer',
                                'dryer'        => 'Dryer',
                                'refrigerator' => 'Refrigerator',
                                'oven'         => 'Oven & Range',
                                'cooktop'      => 'Cooktop',
                                'microwave'    => 'Microwave',
                                'freezer'      => 'Freezer',
                            );
                            foreach ( $all_types as $slug => $label ) :
                                if ( $slug === $appliance_slug ) continue; ?>
                            <li><a href="<?php echo esc_url( home_url( '/error-codes/' . $slug . '/' ) ); ?>" style="color:var(--color-text);"><?php echo esc_html( $label ); ?> Codes</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>

        <?php else : ?>
        <!-- ================================================== -->
        <!-- LIST VIEW: all error codes for this appliance      -->
        <!-- ================================================== -->
        <div class="content-grid">
            <div class="main-content">

                <div class="notice notice-warning">
                    <strong>⚠️ Important:</strong> Many Bosch error codes require professional diagnosis and repair. Attempting to repair electrical or sealed system components yourself can be dangerous and may void your warranty. Call <?php echo BRP_PHONE; ?> for safe, certified repair.
                </div>

                <?php if ( ! empty( $error_codes ) ) : ?>

                <?php
                // Build most common list (only codes that exist in our data)
                $common_pills = array();
                foreach ( $appliance_most_common as $mc_key ) {
                    if ( isset( $code_map[ $mc_key ] ) ) {
                        $common_pills[] = $code_map[ $mc_key ];
                    }
                }
                ?>

                <?php if ( ! empty( $common_pills ) ) : ?>
                <!-- Most Common Codes -->
                <div class="ec-pills-section">
                    <div class="ec-pills-section-header">
                        <span class="ec-pills-section-icon">&#9776;</span>
                        <span class="ec-pills-section-label">Most Common Codes</span>
                    </div>
                    <div class="ec-pills-row">
                        <?php foreach ( $common_pills as $i => $ec ) :
                            $code_slug = strtolower( str_replace( ' ', '', $ec['code'] ) );
                            if ( ! empty( $ec['from_db'] ) && ! empty( $ec['permalink'] ) ) {
                                $ec_url = $ec['permalink'];
                            } else {
                                $ec_url = add_query_arg( 'code', $code_slug, $appliance_url );
                            }
                        ?>
                        <a href="<?php echo esc_url( $ec_url ); ?>"
                           class="ec-pill<?php echo $i === 0 ? ' ec-pill--active' : ''; ?>"
                           title="<?php echo esc_attr( $ec['title'] ); ?>">
                            <?php echo esc_html( $ec['code'] ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- All Codes A-Z -->
                <div class="ec-pills-section">
                    <div class="ec-pills-section-header">
                        <span class="ec-pills-section-icon ec-pills-section-icon--az">A-Z</span>
                        <span class="ec-pills-section-label">All Codes</span>
                    </div>
                    <div class="ec-pills-row">
                        <?php foreach ( $error_codes as $ec ) :
                            $code_slug = strtolower( str_replace( ' ', '', $ec['code'] ) );
                            if ( ! empty( $ec['from_db'] ) && ! empty( $ec['permalink'] ) ) {
                                $ec_url = $ec['permalink'];
                            } else {
                                $ec_url = add_query_arg( 'code', $code_slug, $appliance_url );
                            }
                        ?>
                        <a href="<?php echo esc_url( $ec_url ); ?>"
                           class="ec-pill"
                           title="<?php echo esc_attr( $ec['title'] ); ?>">
                            <?php echo esc_html( $ec['code'] ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php endif; ?>

                <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:32px;margin-top:40px;">
                    <h3>Don't See Your Error Code?</h3>
                    <p style="color:var(--color-gray);">Bosch regularly updates firmware and error code definitions. If you can't find your code, call our expert technicians — they have access to complete Bosch service documentation.</p>
                    <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary">📞 Call for Expert Diagnosis</a>
                </div>

            </div>

            <aside class="sidebar">
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">🔧 Quick Repair Help</div>
                    <div class="sidebar-phone">
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="sidebar-phone-number"><?php echo BRP_PHONE; ?></a>
                        <p>Tell us your error code and we'll help diagnose it over the phone.</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call Now</a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Repair</a>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">🔍 Other Appliance Codes</div>
                    <div class="sidebar-widget-body">
                        <ul class="footer-links" style="gap:8px;">
                            <?php
                            $all_types = array(
                                'dishwasher'   => 'Dishwasher',
                                'washer'       => 'Washer',
                                'dryer'        => 'Dryer',
                                'refrigerator' => 'Refrigerator',
                                'oven'         => 'Oven & Range',
                                'cooktop'      => 'Cooktop',
                                'microwave'    => 'Microwave',
                                'freezer'      => 'Freezer',
                            );
                            foreach ( $all_types as $slug => $label ) :
                                if ( $slug === $appliance_slug ) continue; ?>
                            <li><a href="<?php echo esc_url( home_url( '/error-codes/' . $slug . '/' ) ); ?>" style="color:var(--color-text);"><?php echo esc_html( $label ); ?> Codes</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php echo brp_appointment_form( 'Error Code? Our Technicians Can Fix It Today' ); ?>

<?php get_footer(); ?>
