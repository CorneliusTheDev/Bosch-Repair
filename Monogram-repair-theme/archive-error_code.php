<?php
/**
 * Template for error_code post type archive.
 * Hub:    /error-codes/
 * Detail: /error-codes/?appliance=dishwasher&code=e01
 *
 * @package MonogramRepairPro
 */
get_header();

$categories = array(
    array( 'slug' => 'dishwasher',   'label' => 'Dishwashers',      'icon' => '🍽️', 'desc' => 'Monogram dishwasher error codes and diagnostics' ),
    array( 'slug' => 'washer',       'label' => 'Washing Machines', 'icon' => '🫧', 'desc' => 'Monogram washer error codes and diagnostics' ),
    array( 'slug' => 'dryer',        'label' => 'Dryers',           'icon' => '🌀', 'desc' => 'Monogram dryer error codes and diagnostics' ),
    array( 'slug' => 'refrigerator', 'label' => 'Refrigerators',    'icon' => '🧊', 'desc' => 'Monogram refrigerator error codes and diagnostics' ),
    array( 'slug' => 'oven',         'label' => 'Ovens & Ranges',   'icon' => '🔥', 'desc' => 'Monogram oven and range error codes and diagnostics' ),
    array( 'slug' => 'cooktop',      'label' => 'Cooktops',         'icon' => '♨️', 'desc' => 'Monogram cooktop error codes and diagnostics' ),
    array( 'slug' => 'microwave',    'label' => 'Microwaves',       'icon' => '📡', 'desc' => 'Monogram microwave error codes and diagnostics' ),
    array( 'slug' => 'freezer',      'label' => 'Freezers',         'icon' => '❄️', 'desc' => 'Monogram freezer error codes and diagnostics' ),
    array( 'slug' => 'wine-cooler',  'label' => 'Wine Coolers',     'icon' => '🍷', 'desc' => 'Monogram wine cooler error codes and diagnostics' ),
    array( 'slug' => 'hood',         'label' => 'Range Hoods',      'icon' => '💨', 'desc' => 'Monogram range hood error codes and diagnostics' ),
);

// Build error codes dynamically from the database
$all_error_codes = array();

$ec_query = new WP_Query( array(
    'post_type'      => 'error_code',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value',
    'meta_key'       => '_brp_error_code',
    'order'          => 'ASC',
) );

if ( $ec_query->have_posts() ) {
    while ( $ec_query->have_posts() ) {
        $ec_query->the_post();
        $terms = get_the_terms( get_the_ID(), 'appliance_type' );
        $appliance_slug = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->slug : 'other';
        $code_val = get_post_meta( get_the_ID(), '_brp_error_code', true );

        if ( ! isset( $all_error_codes[ $appliance_slug ] ) ) {
            $all_error_codes[ $appliance_slug ] = array();
        }

        $all_error_codes[ $appliance_slug ][] = array(
            'code'      => $code_val ? $code_val : get_the_title(),
            'title'     => get_the_title(),
            'desc'      => get_the_excerpt(),
            'permalink' => get_permalink(),
        );
    }
    wp_reset_postdata();
}


// ── Check for detail view ──────────────────────────────────────────────────
$req_appliance = isset( $_GET['appliance'] ) ? sanitize_key( $_GET['appliance'] ) : '';
$req_code      = isset( $_GET['code'] )      ? strtolower( sanitize_key( $_GET['code'] ) ) : '';

$detail      = null;
$cat_label   = '';
$cat_icon    = '';

if ( $req_appliance && $req_code && isset( $all_error_codes[ $req_appliance ] ) ) {
    foreach ( $all_error_codes[ $req_appliance ] as $ec ) {
        if ( strtolower( str_replace( ' ', '', $ec['code'] ) ) === $req_code ) {
            $detail = $ec;
            break;
        }
    }
    foreach ( $categories as $cat ) {
        if ( $cat['slug'] === $req_appliance ) {
            $cat_label = $cat['label'];
            $cat_icon  = $cat['icon'];
            break;
        }
    }
}

$hub_url = get_post_type_archive_link( 'error_code' );
?>

<?php if ( $detail ) : ?>
<!-- ══════════════════════════════════════════════════════════ -->
<!-- DETAIL VIEW                                               -->
<!-- ══════════════════════════════════════════════════════════ -->

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <div style="display:inline-flex;align-items:center;gap:12px;margin-bottom:16px;">
            <span class="error-code-badge" style="font-size:1.1rem;"><?php echo esc_html( $detail['code'] ); ?></span>
        </div>
        <h1><?php echo esc_html( $detail['title'] ); ?></h1>
        <p><?php echo $cat_icon; ?> Monogram <?php echo esc_html( $cat_label ); ?> — Error Code <?php echo esc_html( $detail['code'] ); ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="content-grid">
            <div class="main-content">

                <a href="<?php echo esc_url( add_query_arg( 'appliance', $req_appliance, $hub_url ) ); ?>"
                   class="brp-back-link">&larr; All <?php echo esc_html( $cat_label ); ?> Error Codes</a>

                <div class="brp-ec-detail-card">
                    <div class="brp-ec-detail-header">
                        <span class="error-code-badge brp-ec-badge-lg"><?php echo esc_html( $detail['code'] ); ?></span>
                        <div>
                            <h2 class="brp-ec-detail-title"><?php echo esc_html( $detail['title'] ); ?></h2>
                            <p class="brp-ec-detail-appliance">
                                Monogram <?php echo esc_html( $cat_label ); ?> — Error Code <?php echo esc_html( $detail['code'] ); ?>
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
                            If this error code persists after basic troubleshooting, our certified Monogram technicians are available for same-day diagnosis and repair.
                            Call <a href="tel:<?php echo BRP_PHONE_RAW; ?>"><?php echo BRP_PHONE; ?></a> or book online below.
                        </div>
                    </div>
                </div>

                <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:28px;margin-top:32px;">
                    <h3 style="margin-bottom:16px;">General Troubleshooting Steps</h3>
                    <ol style="display:flex;flex-direction:column;gap:10px;margin:0;padding-left:20px;">
                        <li><strong>Hard reset:</strong> Unplug the appliance (or switch off the circuit breaker) for 5–10 minutes, then restore power.</li>
                        <li><strong>Note the code:</strong> Write down the exact error code and when it appeared.</li>
                        <li><strong>Check the manual:</strong> Your Monogram appliance manual may have model-specific reset procedures.</li>
                        <li><strong>Call a technician:</strong> If the code returns after a reset, professional diagnosis is recommended.</li>
                    </ol>
                </div>

                <div style="margin-top:40px;">
                    <h3 style="margin-bottom:20px;">Other <?php echo esc_html( $cat_label ); ?> Error Codes</h3>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <?php $count = 0;
                        foreach ( $all_error_codes[ $req_appliance ] as $other ) :
                            if ( strtolower( str_replace( ' ', '', $other['code'] ) ) === $req_code ) continue;
                            if ( $count >= 6 ) break;
                            $count++;
                        ?>
                        <a href="<?php echo esc_url( $other['permalink'] ); ?>" class="error-card">
                            <span class="error-code-badge"><?php echo esc_html( $other['code'] ); ?></span>
                            <div class="error-card-info">
                                <h4><?php echo esc_html( $other['title'] ); ?></h4>
                            </div>
                            <span style="margin-left:auto;color:var(--color-gray);font-size:1.25rem;flex-shrink:0;">›</span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo esc_url( add_query_arg( 'appliance', $req_appliance, $hub_url ) ); ?>"
                       class="btn btn-secondary" style="margin-top:16px;">
                        View All <?php echo esc_html( $cat_label ); ?> Codes &rarr;
                    </a>
                </div>

            </div>

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
                            <li>Factory-certified Monogram parts</li>
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
                            <?php foreach ( $categories as $cat ) :
                                if ( $cat['slug'] === $req_appliance ) continue; ?>
                            <li><a href="<?php echo esc_url( add_query_arg( 'appliance', $cat['slug'], $hub_url ) ); ?>"
                                   style="color:var(--color-text);"><?php echo esc_html( $cat['label'] ); ?> Codes</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php else : ?>
<!-- ══════════════════════════════════════════════════════════ -->
<!-- HUB VIEW                                                  -->
<!-- ══════════════════════════════════════════════════════════ -->

<?php
$most_searched_map = array(
    'dishwasher'   => 'LEAK DETECTED',
    'washer'       => 'E22',
    'dryer'        => '001',
    'refrigerator' => 'FF',
    'oven'         => 'F2',
    'cooktop'      => 'F',
    'microwave'    => 'F3',
    'freezer'      => 'FF',
);
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Monogram Appliance Error Codes</h1>
        <p>Select your appliance type below to look up any Monogram error code with step-by-step troubleshooting guidance.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-label">Browse by Appliance</span>
            <h2 class="section-title">Error Code Categories</h2>
        </div>

        <div class="ec-cat-grid">
            <?php foreach ( $categories as $cat ) :
                $term       = get_term_by( 'slug', $cat['slug'], 'appliance_type' );
                $code_count = ( $term && ! is_wp_error( $term ) ) ? (int) $term->count : 0;
                $top_code   = isset( $most_searched_map[ $cat['slug'] ] ) ? $most_searched_map[ $cat['slug'] ] : '';
                $page_url   = home_url( '/error-codes/' . $cat['slug'] . '/' );
            ?>
            <a href="<?php echo esc_url( $page_url ); ?>" class="ec-cat-card ec-cat-card--link">
                <div class="ec-cat-card-top">
                    <div class="ec-cat-icon"><?php echo $cat['icon']; ?></div>
                    <span class="ec-cat-badge"><?php echo $code_count; ?> codes</span>
                </div>
                <div class="ec-cat-title"><?php echo esc_html( $cat['label'] ); ?></div>
                <div class="ec-cat-desc"><?php echo esc_html( $cat['desc'] ); ?></div>
                <hr class="ec-cat-divider">
                <?php if ( $top_code ) : ?>
                <div class="ec-cat-most">Most searched: <span class="ec-cat-most-code"><?php echo esc_html( $top_code ); ?></span></div>
                <?php else : ?>
                <div class="ec-cat-most" style="visibility:hidden;">—</div>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php endif; ?>

<?php echo brp_appointment_form( 'Got an Error Code? We\'ll Fix It Today' ); ?>

<?php get_footer(); ?>
