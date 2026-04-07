<?php
/**
 * Archive template — used for post type archives, taxonomies, categories.
 *
 * @package BoschRepairPro
 */
get_header();

if ( is_post_type_archive( 'error_code' ) ) :

    $categories = array(
        array( 'slug' => 'dishwasher',   'label' => 'Dishwashers',      'icon' => '🍽️' ),
        array( 'slug' => 'washer',       'label' => 'Washing Machines', 'icon' => '🫧' ),
        array( 'slug' => 'dryer',        'label' => 'Dryers',           'icon' => '🌀' ),
        array( 'slug' => 'refrigerator', 'label' => 'Refrigerators',    'icon' => '🧊' ),
        array( 'slug' => 'oven',         'label' => 'Ovens & Ranges',   'icon' => '🔥' ),
        array( 'slug' => 'cooktop',      'label' => 'Cooktops',         'icon' => '♨️' ),
        array( 'slug' => 'microwave',    'label' => 'Microwaves',       'icon' => '📡' ),
        array( 'slug' => 'freezer',      'label' => 'Freezers',         'icon' => '❄️' ),
    );

    $all_error_codes = array(
        'dishwasher' => array(
            array( 'code' => 'E01', 'title' => 'Water Not Heating' ),
            array( 'code' => 'E02', 'title' => 'Drain Pump Fault' ),
            array( 'code' => 'E03', 'title' => 'Water Inlet Fault' ),
            array( 'code' => 'E04', 'title' => 'Flow Sensor / Spray Arm Issue' ),
            array( 'code' => 'E05', 'title' => 'Water Float Switch Fault' ),
            array( 'code' => 'E06', 'title' => 'Door Latch / Door Switch Failure' ),
            array( 'code' => 'E07', 'title' => 'Drying Fan Motor Failure (Zeolite)' ),
            array( 'code' => 'E08', 'title' => 'Low Water Level in Wash Tub' ),
            array( 'code' => 'E09', 'title' => 'Heating System / Heat Pump Failure' ),
            array( 'code' => 'E10', 'title' => 'Slow Heating / Calcification' ),
            array( 'code' => 'E11', 'title' => 'Temperature Sensor (Thermistor) Error' ),
            array( 'code' => 'E12', 'title' => 'Limescale Buildup on Heat Pump' ),
            array( 'code' => 'E13', 'title' => 'Water Temperature Too High' ),
            array( 'code' => 'E14', 'title' => 'Flow Meter / Water Distribution Error' ),
            array( 'code' => 'E15', 'title' => 'Water Leak Detected (AquaStop)' ),
            array( 'code' => 'E16', 'title' => 'Unexpected Water Fill' ),
            array( 'code' => 'E17', 'title' => 'Water Supply Hose Issue' ),
            array( 'code' => 'E18', 'title' => 'Insufficient Water (Underfill)' ),
            array( 'code' => 'E19', 'title' => 'Detergent Dispenser / Heat Exchanger Fault' ),
            array( 'code' => 'E20', 'title' => 'Circulation Pump Motor Winding Fault' ),
            array( 'code' => 'E21', 'title' => 'Circulation Pump Blocked' ),
            array( 'code' => 'E22', 'title' => 'Blocked Filter' ),
            array( 'code' => 'E23', 'title' => 'Drain Pump Electrical Fault' ),
            array( 'code' => 'E24', 'title' => 'Dishwasher Not Draining' ),
            array( 'code' => 'E25', 'title' => 'Drain Pump Blocked / Cover Loose' ),
            array( 'code' => 'E26', 'title' => 'Diverter Motor Fault' ),
            array( 'code' => 'E27', 'title' => 'Low Voltage Supply' ),
            array( 'code' => 'E28', 'title' => 'Aqua Sensor (Turbidity Sensor) Fault' ),
            array( 'code' => 'E29', 'title' => 'Low Mains Voltage' ),
            array( 'code' => 'E30', 'title' => 'High Voltage Supply' ),
        ),
        'washer' => array(
            array( 'code' => 'E01', 'title' => 'Door Lock Fault' ),
            array( 'code' => 'E02', 'title' => 'Water Inlet Problem' ),
            array( 'code' => 'E03', 'title' => 'Drainage Problem' ),
            array( 'code' => 'E04', 'title' => 'Overflow Protection Activated' ),
            array( 'code' => 'E13', 'title' => 'Water Loss During Cycle' ),
            array( 'code' => 'E17', 'title' => 'Water Fill Too Slow' ),
            array( 'code' => 'E18', 'title' => 'Water Heating Too Slow' ),
            array( 'code' => 'E21', 'title' => 'Drain Time Too Long' ),
            array( 'code' => 'E32', 'title' => 'Pressure Sensor Fault' ),
            array( 'code' => 'E42', 'title' => 'Door Lock Relay Fault' ),
            array( 'code' => 'F16', 'title' => 'Door Not Closed Properly' ),
            array( 'code' => 'F21', 'title' => 'Motor Control Fault' ),
            array( 'code' => 'F23', 'title' => 'AquaStop System Activated' ),
            array( 'code' => 'F43', 'title' => 'Motor Locked / Not Turning' ),
            array( 'code' => 'F57', 'title' => 'Voltage Too Low' ),
        ),
        'dryer' => array(
            array( 'code' => 'E01', 'title' => 'Condenser / Filter Blocked' ),
            array( 'code' => 'E02', 'title' => 'Heating Element Fault' ),
            array( 'code' => 'E03', 'title' => 'Temperature Sensor Error' ),
            array( 'code' => 'E04', 'title' => 'Motor Fault' ),
            array( 'code' => 'E05', 'title' => 'Control Board Communication Error' ),
            array( 'code' => 'E07', 'title' => 'Condenser Performance Sensor' ),
            array( 'code' => 'E08', 'title' => 'Heat Pump System Fault' ),
            array( 'code' => 'E09', 'title' => 'Electronic Module Error' ),
            array( 'code' => 'd02', 'title' => 'Water Tank Full' ),
            array( 'code' => 'd04', 'title' => 'Condenser Filter Reminder' ),
        ),
        'refrigerator' => array(
            array( 'code' => 'E01', 'title' => 'Refrigerator Temperature Sensor Fault' ),
            array( 'code' => 'E02', 'title' => 'Freezer Temperature Sensor Fault' ),
            array( 'code' => 'E03', 'title' => 'Defrost Heater Fault' ),
            array( 'code' => 'E04', 'title' => 'Fan Motor Fault' ),
            array( 'code' => 'E05', 'title' => 'Compressor Overload / Shutdown' ),
            array( 'code' => 'E06', 'title' => 'Ice Maker Fault' ),
            array( 'code' => 'E07', 'title' => 'Condenser Fan Motor Fault' ),
            array( 'code' => 'E08', 'title' => 'Water Dispenser Fault' ),
            array( 'code' => 'E09', 'title' => 'Communication Error Between Control Boards' ),
            array( 'code' => 'E11', 'title' => 'Ambient Temperature Too High' ),
            array( 'code' => 'E12', 'title' => 'Refrigerant Leak Suspected' ),
        ),
        'oven' => array(
            array( 'code' => 'E001', 'title' => 'Temperature Sensor Open Circuit' ),
            array( 'code' => 'E002', 'title' => 'Temperature Sensor Short Circuit' ),
            array( 'code' => 'E005', 'title' => 'Door Lock Fault' ),
            array( 'code' => 'E010', 'title' => 'Oven Overheating' ),
            array( 'code' => 'E011', 'title' => 'Broil Element Failure' ),
            array( 'code' => 'E030', 'title' => 'Bake Element Failure' ),
            array( 'code' => 'E101', 'title' => 'Convection Fan Motor Fault' ),
            array( 'code' => 'E105', 'title' => 'Communication Error' ),
            array( 'code' => 'E211', 'title' => 'Door Lock Fault (Self-Clean)' ),
            array( 'code' => 'E301', 'title' => 'Igniter Fault (Gas Models)' ),
            array( 'code' => 'E401', 'title' => 'Control Board Internal Error' ),
        ),
        'cooktop' => array(
            array( 'code' => 'E0', 'title' => 'Boost Function Active' ),
            array( 'code' => 'E1', 'title' => 'Internal Electronics Overheating' ),
            array( 'code' => 'E2', 'title' => 'Temperature Sensor Short Circuit' ),
            array( 'code' => 'E3', 'title' => 'Temperature Sensor Open Circuit' ),
            array( 'code' => 'E4', 'title' => 'Residual Heat Sensor Fault' ),
            array( 'code' => 'E5', 'title' => 'Power Board Communication Error' ),
            array( 'code' => 'E7', 'title' => 'Touch Control Panel Fault' ),
            array( 'code' => 'E8', 'title' => 'Supply Voltage Too High' ),
            array( 'code' => 'E9', 'title' => 'Supply Voltage Too Low' ),
            array( 'code' => 'Er', 'title' => 'Child Lock Active' ),
        ),
        'microwave' => array(
            array( 'code' => 'F1', 'title' => 'Control Board Fault' ),
            array( 'code' => 'F2', 'title' => 'Temperature Sensor Fault' ),
            array( 'code' => 'F3', 'title' => 'Door Switch / Interlock Failure' ),
            array( 'code' => 'F4', 'title' => 'Convection Fan Motor Fault' ),
            array( 'code' => 'F5', 'title' => 'Control Board Failure' ),
            array( 'code' => 'F7', 'title' => 'Keypad / Touch Panel Fault' ),
            array( 'code' => 'F9', 'title' => 'Cooling Fan Fault' ),
        ),
        'freezer' => array(
            array( 'code' => 'E01', 'title' => 'Freezer Temperature Sensor Fault' ),
            array( 'code' => 'E02', 'title' => 'Defrost System Malfunction' ),
            array( 'code' => 'E03', 'title' => 'Evaporator Fan Motor Fault' ),
            array( 'code' => 'E04', 'title' => 'Compressor Fault' ),
            array( 'code' => 'E05', 'title' => 'High Temperature Alarm' ),
            array( 'code' => 'E07', 'title' => 'Door Seal / Open Door Alarm' ),
        ),
    );

    ?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1>Bosch Appliance Error Codes</h1>
            <p>Look up any Bosch error code by selecting your appliance type below.</p>
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

<?php else : ?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1><?php
                if ( is_post_type_archive( 'service' ) ) echo 'Bosch Appliance Repair Services';
                elseif ( is_post_type_archive( 'city' ) ) echo 'Cities We Service';
                elseif ( is_post_type_archive( 'guide' ) ) echo 'Bosch Appliance Repair Guides';
                elseif ( is_post_type_archive( 'recall' ) ) echo 'Bosch Appliance Recalls';
                elseif ( is_tax( 'appliance_type' ) ) echo 'Bosch ' . single_term_title( '', false ) . ' – Error Codes & Guides';
                else the_archive_title();
            ?></h1>
            <p><?php
                if ( is_post_type_archive( 'service' ) ) echo 'Professional Bosch appliance repair for every appliance in your home. Factory-certified parts, same-day service, 90-day warranty.';
                elseif ( is_post_type_archive( 'city' ) ) echo 'We provide expert Bosch appliance repair across 6 major U.S. metropolitan areas and their surrounding suburbs.';
                elseif ( is_post_type_archive( 'guide' ) ) echo 'Step-by-step troubleshooting and maintenance guides written by our certified Bosch technicians.';
                elseif ( is_post_type_archive( 'recall' ) ) echo 'Current and historical Bosch appliance safety recall information. Check if your appliance is affected.';
                else the_archive_description();
            ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <?php if ( have_posts() ) : ?>
            <div class="grid grid-3">
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="card">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div style="height:180px;overflow:hidden;">
                        <?php the_post_thumbnail( 'brp-card', array( 'style' => 'width:100%;height:100%;object-fit:cover;' ) ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php
                        $code = get_post_meta( get_the_ID(), '_brp_error_code', true );
                        if ( $code ) echo '<span class="error-code-badge" style="margin-bottom:10px;display:inline-block;">' . esc_html( $code ) . '</span>';
                        ?>
                        <h3 style="font-size:1.05rem;margin-bottom:8px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p style="color:var(--color-gray);font-size:0.875rem;"><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
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
