<?php
/**
 * Archive template — used for post type archives, taxonomies, categories.
 *
 * @package MonogramRepairPro
 */
get_header();

if ( is_post_type_archive( 'error_code' ) ) :

    $categories = array(
        array( 'slug' => 'dishwasher',   'label' => 'Dishwashers',         'icon' => '🍽️' ),
        array( 'slug' => 'refrigerator', 'label' => 'Refrigerators',       'icon' => '🧊' ),
        array( 'slug' => 'range',        'label' => 'Ranges & Ovens',      'icon' => '🍳' ),
        array( 'slug' => 'wall-oven',    'label' => 'Wall Ovens',          'icon' => '🔲' ),
        array( 'slug' => 'cooktop',      'label' => 'Cooktops',            'icon' => '♨️' ),
        array( 'slug' => 'speed-oven',   'label' => 'Speed Ovens',         'icon' => '⚡' ),
    );

    $all_error_codes = array(
        'dishwasher' => array(
            array( 'code' => 'C1',  'title' => 'Water Not Filling / No Water Inlet' ),
            array( 'code' => 'C2',  'title' => 'Drain Problem / Not Draining' ),
            array( 'code' => 'C3',  'title' => 'Water Not Heating / Heater Fault' ),
            array( 'code' => 'C4',  'title' => 'Water Level Sensor Error' ),
            array( 'code' => 'C5',  'title' => 'Door Latch / Door Switch Fault' ),
            array( 'code' => 'C6',  'title' => 'Water Temperature Too High' ),
            array( 'code' => 'C7',  'title' => 'Turbidity / Soil Sensor Fault' ),
            array( 'code' => 'C8',  'title' => 'Leak Detected / Flood Protection Active' ),
        ),
        'refrigerator' => array(
            array( 'code' => 'PO',   'title' => 'Power Outage – Food Safety Alert' ),
            array( 'code' => 'dE',   'title' => 'Defrost System Failure' ),
            array( 'code' => 'FF',   'title' => 'Freezer Fan Motor Fault' ),
            array( 'code' => 'CF',   'title' => 'Condenser Fan Motor Fault' ),
            array( 'code' => 'CE',   'title' => 'Communication Error (Control Boards)' ),
            array( 'code' => 'HrS',  'title' => 'Fresh Food Section High Temperature Alarm' ),
            array( 'code' => 'HrF',  'title' => 'Freezer Section High Temperature Alarm' ),
            array( 'code' => 'IC',   'title' => 'Ice Maker Fault' ),
            array( 'code' => 'OP',   'title' => 'Open Probe / Temperature Sensor Open' ),
            array( 'code' => 'SP',   'title' => 'Short Probe / Temperature Sensor Short' ),
            array( 'code' => 'Sb',   'title' => 'Sabbath Mode Active' ),
        ),
        'range' => array(
            array( 'code' => 'F0',  'title' => 'Stuck Touch Pad / Key Shorted' ),
            array( 'code' => 'F1',  'title' => 'Control Board Failure / Runaway Temperature' ),
            array( 'code' => 'F2',  'title' => 'Oven Temperature Exceeded Maximum Limit' ),
            array( 'code' => 'F3',  'title' => 'Oven Temperature Sensor Open Circuit' ),
            array( 'code' => 'F4',  'title' => 'Oven Temperature Sensor Short Circuit' ),
            array( 'code' => 'F5',  'title' => 'Door Latch Switch Fault (Self-Clean Lock)' ),
            array( 'code' => 'F6',  'title' => 'Door Unlock Failure After Self-Clean' ),
            array( 'code' => 'F7',  'title' => 'Control Board Internal Error' ),
            array( 'code' => 'F8',  'title' => 'Bake Element Relay Fault' ),
            array( 'code' => 'F9',  'title' => 'Door Lock Relay Fault' ),
            array( 'code' => 'F10', 'title' => 'Temperature Sensor Runaway' ),
            array( 'code' => 'F13', 'title' => 'Convection Sensor Open Circuit' ),
            array( 'code' => 'F14', 'title' => 'Convection Sensor Short Circuit' ),
            array( 'code' => 'F97', 'title' => 'Cooling Fan Not Running' ),
            array( 'code' => 'F98', 'title' => 'Door Latch Assembly Fault' ),
        ),
        'wall-oven' => array(
            array( 'code' => 'F0',  'title' => 'Stuck Touch Pad / Shorted Key' ),
            array( 'code' => 'F1',  'title' => 'Control Board Failure / Runaway Temperature' ),
            array( 'code' => 'F2',  'title' => 'Oven Temperature Exceeded Safe Limit' ),
            array( 'code' => 'F3',  'title' => 'Oven Temperature Sensor Open Circuit' ),
            array( 'code' => 'F4',  'title' => 'Oven Temperature Sensor Short Circuit' ),
            array( 'code' => 'F5',  'title' => 'Door Latch Failure (Self-Clean Mode)' ),
            array( 'code' => 'F6',  'title' => 'Door Unlock Failure' ),
            array( 'code' => 'F8',  'title' => 'Bake Element Relay Fault' ),
            array( 'code' => 'F9',  'title' => 'Door Lock Relay Fault' ),
            array( 'code' => 'F13', 'title' => 'Convection Sensor Open Circuit' ),
            array( 'code' => 'F14', 'title' => 'Convection Sensor Short Circuit' ),
            array( 'code' => 'F97', 'title' => 'Cooling Fan Not Detected' ),
        ),
        'cooktop' => array(
            array( 'code' => 'F0',  'title' => 'Control Lock Active (Child Lock)' ),
            array( 'code' => 'F2',  'title' => 'Surface Element Overheating' ),
            array( 'code' => 'F3',  'title' => 'Surface Temperature Sensor Open Circuit' ),
            array( 'code' => 'F4',  'title' => 'Surface Temperature Sensor Short Circuit' ),
            array( 'code' => 'F5',  'title' => 'Control Board Failure' ),
            array( 'code' => 'F9',  'title' => 'Communication Error' ),
        ),
        'speed-oven' => array(
            array( 'code' => 'F1',  'title' => 'Control Board Fault' ),
            array( 'code' => 'F2',  'title' => 'Temperature Sensor Fault' ),
            array( 'code' => 'F3',  'title' => 'Door Switch / Interlock Failure' ),
            array( 'code' => 'F4',  'title' => 'Convection Fan Motor Fault' ),
            array( 'code' => 'F5',  'title' => 'Control Board Internal Failure' ),
            array( 'code' => 'F7',  'title' => 'Keypad / Touch Panel Fault' ),
            array( 'code' => 'F9',  'title' => 'Cooling Fan Fault' ),
        ),
    );

    ?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1>Monogram Appliance Error Codes</h1>
            <p>Look up any Monogram error code by selecting your appliance type below.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <div class="section-header text-center">
                <span class="section-label">Browse by Appliance</span>
                <h2 class="section-title">Error Code Categories</h2>
            </div>

            <div class="brp-topic-filters" id="brpEcFilters">
                <button class="btn btn-primary" data-filter="all">All Errors</button>
                <?php foreach ( $categories as $cat ) : ?>
                <button class="btn btn-secondary" data-filter="<?php echo esc_attr( $cat['slug'] ); ?>">
                    <?php echo $cat['icon']; ?> <?php echo esc_html( $cat['label'] ); ?>
                </button>
                <?php endforeach; ?>
            </div>

            <div class="section-header" style="margin-top:56px;">
                <span class="section-label" id="brpEcLabel">All Errors</span>
                <h3 class="section-title" id="brpEcTitle">All Error Codes</h3>
            </div>

            <div id="brpEcGrid" style="display:flex;flex-direction:column;gap:10px;">
                <?php foreach ( $all_error_codes as $appliance_slug => $codes ) :
                    $appliance_label = $appliance_slug;
                    $appliance_icon  = '';
                    foreach ( $categories as $cat ) {
                        if ( $cat['slug'] === $appliance_slug ) {
                            $appliance_label = $cat['label'];
                            $appliance_icon  = $cat['icon'];
                            break;
                        }
                    }
                    $appliance_page_url = home_url( '/error-codes/' . $appliance_slug . '/' );
                    foreach ( $codes as $ec ) :
                        $code_slug  = strtolower( str_replace( ' ', '', $ec['code'] ) );
                        $detail_url = add_query_arg( 'code', $code_slug, $appliance_page_url );
                ?>
                <a href="<?php echo esc_url( $detail_url ); ?>"
                   class="error-card"
                   data-appliance="<?php echo esc_attr( $appliance_slug ); ?>">
                    <span class="error-code-badge"><?php echo esc_html( $ec['code'] ); ?></span>
                    <div class="error-card-info">
                        <h4><?php echo esc_html( $ec['title'] ); ?></h4>
                        <p><?php echo $appliance_icon; ?> <?php echo esc_html( $appliance_label ); ?></p>
                    </div>
                    <span style="margin-left:auto;color:var(--color-gray);font-size:1.25rem;flex-shrink:0;">›</span>
                </a>
                <?php endforeach; endforeach; ?>
            </div>

            <div id="brpEcNoResults" style="display:none;text-align:center;padding:60px 20px;
                 background:var(--color-light);border-radius:var(--border-radius-lg);">
                <div style="font-size:3rem;margin-bottom:12px;">🔍</div>
                <h3 id="brpEcNoResultsMsg">No error codes found</h3>
                <button class="btn btn-primary" style="margin-top:16px;" onclick="brpEcFilter('all')">
                    Show All Errors
                </button>
            </div>

        </div>
    </section>

    <script>
    var brpEcLabels = {
        'all': { label: 'All Errors', title: 'All Error Codes' },
        <?php foreach ( $categories as $cat ) : ?>
        '<?php echo esc_js( $cat['slug'] ); ?>': { label: '<?php echo esc_js( $cat['label'] ); ?>', title: '<?php echo esc_js( $cat['label'] ); ?> Error Codes' },
        <?php endforeach; ?>
    };

    function brpEcFilter( filter ) {
        var cards     = document.querySelectorAll('#brpEcGrid .error-card');
        var noResults = document.getElementById('brpEcNoResults');
        var grid      = document.getElementById('brpEcGrid');
        var label     = document.getElementById('brpEcLabel');
        var title     = document.getElementById('brpEcTitle');
        var btns      = document.querySelectorAll('#brpEcFilters .btn');
        var visible   = 0;

        btns.forEach(function(btn) {
            btn.className = btn.getAttribute('data-filter') === filter
                ? 'btn btn-primary' : 'btn btn-secondary';
        });

        cards.forEach(function(card) {
            var show = filter === 'all' || card.getAttribute('data-appliance') === filter;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        if ( brpEcLabels[filter] ) {
            label.textContent = brpEcLabels[filter].label;
            title.textContent = brpEcLabels[filter].title;
        }

        if (visible === 0) {
            grid.style.display      = 'none';
            noResults.style.display = 'block';
            document.getElementById('brpEcNoResultsMsg').textContent =
                'No error codes found for "' + (brpEcLabels[filter] ? brpEcLabels[filter].label : filter) + '"';
        } else {
            grid.style.display      = '';
            noResults.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#brpEcFilters .btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                brpEcFilter( this.getAttribute('data-filter') );
            });
        });
    });
    </script>

    <?php echo brp_appointment_form( 'Got an Error Code? We\'ll Fix It Today' ); ?>

<?php elseif ( is_post_type_archive( 'recall' ) ) : ?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1>Maytag Appliance Recalls</h1>
            <p>Maytag appliances have been subject to several safety recalls issued in cooperation with the U.S. Consumer Product Safety Commission (CPSC). This page provides a reference to current and historical Maytag recall notices so you can check whether your appliance is affected. If your appliance is listed below, follow the recommended steps immediately.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="recall-card">
                        <h3><?php the_title(); ?></h3>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>

<?php elseif ( is_post_type_archive( 'service' ) ) :
    $services = brp_get_services();
?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1>Monogram Appliance Repair Services</h1>
            <p>Professional Monogram appliance repair for every appliance in your home. Factory-certified parts, same-day service, 90-day warranty.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="grid grid-3">
                <?php foreach ( $services as $s ) :
                    $card_img = get_template_directory_uri() . '/assets/images/services/' . $s['image'];
                    $clean_title  = preg_replace( '/^Monogram\s+/i', '', $s['title'] );
                    $service_url  = home_url( '/services/' . $s['slug'] . '/' );
                ?>
                <div class="service-card">
                    <div class="service-card-img-wrap">
                        <img src="<?php echo esc_url( $card_img ); ?>"
                             alt="<?php echo esc_attr( $s['title'] ); ?>"
                             loading="lazy" width="600" height="300">
                    </div>
                    <div class="service-card-body">
                        <div>
                            <h3><a href="<?php echo esc_url( $service_url ); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html( $clean_title ); ?></a></h3>
                            <p><?php echo esc_html( $s['desc'] ); ?></p>
                        </div>
                        <a href="<?php echo esc_url( $service_url ); ?>" class="service-card-link">Schedule Repair →</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php echo brp_appointment_form( 'Book Your Monogram Repair Today' ); ?>

<?php elseif ( is_post_type_archive( 'city' ) ) :
    $cities = brp_get_cities();
?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1>Monogram Appliance Repair — Service Areas</h1>
            <p>We provide expert Monogram appliance repair across 6 major U.S. metropolitan areas and their surrounding suburbs.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <div class="section-header text-center">
                <span class="section-label">Where We Work</span>
                <h2 class="section-title">Cities We Service</h2>
                <p class="section-desc">Same-day and next-day Monogram appliance repair available in all service areas. Select your city for local contact details and coverage information.</p>
            </div>

            <div class="city-cards-grid">
                <?php foreach ( $cities as $city ) :
                    $city_url = home_url( '/cities/' . $city['slug'] . '/' );
                ?>
                <a href="<?php echo esc_url( $city_url ); ?>" class="city-img-card">
                    <div class="city-img-wrap">
                        <img src="<?php echo esc_url( $city['image'] ); ?>"
                             alt="Monogram appliance repair in <?php echo esc_attr( $city['title'] ); ?>"
                             loading="lazy" width="800" height="500">
                        <div class="city-img-overlay"></div>
                        <div class="city-img-label">
                            <span class="city-img-name"><?php echo esc_html( $city['title'] ); ?></span>
                            <span class="city-img-state"><?php echo esc_html( $city['state'] ); ?></span>
                        </div>
                    </div>
                    <div class="city-img-body">
                        <p class="city-img-suburbs"><?php echo esc_html( 'Also serving: ' . implode( ', ', array_slice( explode( ', ', $city['suburbs'] ), 0, 4 ) ) . ' &amp; more' ); ?></p>
                        <span class="city-img-cta">View Service Area →</span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <?php echo brp_appointment_form( 'Book Your Monogram Repair Today' ); ?>

<?php else : ?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1><?php
                if ( is_post_type_archive( 'service' ) ) echo 'Monogram Appliance Repair Services';
                elseif ( is_post_type_archive( 'city' ) ) echo 'Cities We Service';
                elseif ( is_post_type_archive( 'recall' ) ) echo 'Maytag Appliance Recalls';
                elseif ( is_tax( 'appliance_type' ) ) echo 'Monogram ' . single_term_title( '', false ) . ' – Error Codes & Guides';
                else the_archive_title();
            ?></h1>
            <p><?php
                if ( is_post_type_archive( 'service' ) ) echo 'Professional Monogram appliance repair for every appliance in your home. Factory-certified parts, same-day service, 90-day warranty.';
                elseif ( is_post_type_archive( 'city' ) ) echo 'We provide expert Monogram appliance repair across 6 major U.S. metropolitan areas and their surrounding suburbs.';
                elseif ( is_post_type_archive( 'recall' ) ) echo 'Current and historical Maytag appliance safety recall information. Check if your appliance is affected.';
                else the_archive_description();
            ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <?php if ( have_posts() ) :

            // Appliance type → local service image
            $brp_appliance_imgs = array(
                'dishwasher'   => get_template_directory_uri() . '/assets/images/services/dishwasher.jpeg',
                'refrigerator' => get_template_directory_uri() . '/assets/images/services/refrigerator.webp',
                'washer'       => get_template_directory_uri() . '/assets/images/services/washer.jpg',
                'dryer'        => get_template_directory_uri() . '/assets/images/services/dryer.png',
                'oven'         => get_template_directory_uri() . '/assets/images/services/oven.png',
                'cooktop'      => get_template_directory_uri() . '/assets/images/services/cooktop.png',
                'microwave'    => get_template_directory_uri() . '/assets/images/services/microwave.png',
                'freezer'      => get_template_directory_uri() . '/assets/images/services/freezer.png',
                'wine-cooler'  => get_template_directory_uri() . '/assets/images/services/wine-cooler.jpg',
                'hood'         => get_template_directory_uri() . '/assets/images/services/hood.jpg',
            );
            $brp_img_fallback = get_template_directory_uri() . '/assets/images/services/oven.png';

            ?>
            <div class="grid grid-3">
                <?php while ( have_posts() ) : the_post();

                    $appliance_type = get_post_meta( get_the_ID(), '_brp_appliance_type', true );
                    $clean_title    = preg_replace( '/^(Monogram|Maytag|GE|LG|Samsung|Whirlpool|KitchenAid)\s+/i', '', get_the_title() );

                    if ( is_post_type_archive( 'service' ) ) :
                        // Service cards — image-first polished layout
                        if ( has_post_thumbnail() ) {
                            $card_img = get_the_post_thumbnail_url( null, 'brp-card' );
                        } else {
                            $card_img = $brp_appliance_imgs[ $appliance_type ] ?? $brp_img_fallback;
                        }
                    ?>
                    <div class="service-card">
                        <div class="service-card-img-wrap">
                            <img src="<?php echo esc_url( $card_img ); ?>"
                                 alt="<?php echo esc_attr( $clean_title ); ?>"
                                 loading="lazy" width="600" height="300">
                        </div>
                        <div class="service-card-body">
                            <div>
                                <h3><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html( $clean_title ); ?></a></h3>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="service-card-link">Schedule Repair →</a>
                        </div>
                    </div>

                    <?php else :
                        // Generic card for recalls, cities, etc.
                        $code = get_post_meta( get_the_ID(), '_brp_error_code', true );
                    ?>
                    <div class="card">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div style="height:180px;overflow:hidden;">
                            <?php the_post_thumbnail( 'brp-card', array( 'style' => 'width:100%;height:100%;object-fit:cover;' ) ); ?>
                        </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <?php if ( $code ) echo '<span class="error-code-badge" style="margin-bottom:10px;display:inline-block;">' . esc_html( $code ) . '</span>'; ?>
                            <h3 style="font-size:1.05rem;margin-bottom:8px;"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $clean_title ); ?></a></h3>
                            <p style="color:var(--color-gray);font-size:0.875rem;"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
            <?php else : ?>
            <div style="text-align:center;padding:80px 0;">
                <p>No items found. Content will be added soon.</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php echo brp_appointment_form(); ?>

<?php endif; ?>

<?php get_footer(); ?>
