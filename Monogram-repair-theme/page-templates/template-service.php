<?php
/**
 * Template Name: Service Page
 * Template Post Type: service
 *
 * Used for individual Monogram appliance service pages.
 * e.g. /services/monogram-washer-repair/
 *
 * @package MonogramRepairPro
 */
get_header();

$appliance_type = get_post_meta( get_the_ID(), '_brp_appliance_type', true );
$faqs           = brp_get_faqs_for_appliance( $appliance_type ?: 'default' );
$cities         = brp_get_cities();
$services       = brp_get_services();
$page_title     = get_the_title();
$clean_title    = preg_replace( '/^(Monogram|Maytag|GE|LG|Samsung|Whirlpool|KitchenAid)\s+/i', '', $page_title );

// Determine appliance keyword from title
$appliance_name = str_replace( array( 'Monogram ', 'Maytag ', ' Repair' ), '', $page_title );

// Appliance-specific hero subtitles
$hero_subtitles = array(
    'refrigerator' => 'Your food has a narrow safety window once cooling stops. We treat refrigerator calls as same-day priority — technicians arrive stocked with OEM compressors and thermistors, and verify temperatures in every compartment before leaving.',
    'oven'         => 'An oven running 25°F off doesn\'t just ruin meals — a gas igniter at the wrong resistance spec won\'t open the valve even when it glows. We test against your model\'s exact specifications, not a generic checklist.',
    'dishwasher'   => 'A slow dishwasher leak you can\'t see can damage your floor and cabinetry for weeks before it\'s visible. We inspect the full water path — pump seals, door gasket, inlet valve — not just the symptom showing on the display.',
    'cooktop'      => 'Gas cooktop repairs have real safety stakes — a valve or igniter that\'s close enough isn\'t close enough. We carry the correct OEM components for your model and verify flame quality and gas pressure before every job is closed.',
    'washer'       => 'A grinding drum bearing gets more expensive every load you run. We diagnose Monogram washers down to the root cause — bearings, drain pumps, control boards — and carry the parts to fix it the same day.',
    'dryer'        => 'A dryer that runs but won\'t heat almost always means restricted airflow — the leading cause of dryer fires. We check the full ventilation path on every call, not just the component that triggered the service request.',
    'microwave'    => 'A built-in Monogram microwave costs $1,500 or more to replace. Most repairs are a fraction of that. We discharge the capacitor before opening anything — then diagnose and fix the actual fault with factory-certified parts.',
    'freezer'      => 'A fully stocked freezer stays safe for about 48 hours after cooling fails. We treat freezer calls as emergencies — same-day priority, system-level diagnosis, and temperature verification before we leave.',
    'wine-cooler'  => 'A two-degree temperature swing sustained over months can alter the aging trajectory of wines you\'ve been storing for years. We fix Monogram wine coolers to the manufacturer\'s tolerances — not "close enough to work."',
    'hood'         => 'A range hood that doesn\'t move air keeps smoke, grease, and steam in your kitchen instead of out of it. We repair Monogram blower motors, control boards, and lighting in a single visit — same-day when you need it.',
);
$hero_subtitle = isset( $hero_subtitles[ $appliance_type ] )
    ? $hero_subtitles[ $appliance_type ]
    : 'Expert ' . $clean_title . ' by factory-trained technicians who specialize exclusively in Monogram. Same-day service available. Factory-certified parts on every repair. 30-day labor warranty.';

// Find the service image from brp_get_services() by matching the current post slug
$current_slug   = get_post_field( 'post_name', get_the_ID() );
$service_image  = '';
foreach ( $services as $s ) {
    if ( $s['slug'] === $current_slug && ! empty( $s['image'] ) ) {
        $service_image = $s['image'];
        break;
    }
}
$service_image_url = $service_image
    ? get_template_directory_uri() . '/assets/images/services/' . $service_image
    : '';
?>

<!-- PAGE HERO -->
<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1><?php echo esc_html( $clean_title ); ?></h1>
        <p><?php echo esc_html( $hero_subtitle ); ?></p>
        <div style="display:flex;gap:16px;margin-top:24px;flex-wrap:wrap;">
            <a href="#schedule" class="btn btn-primary">📅 Schedule Repair Now</a>
            <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary" style="background:#fff;border-color:#fff;color:var(--color-primary);">📞 <?php echo BRP_PHONE; ?></a>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="content-area">
    <div class="container">
        <div class="content-grid">

            <!-- Main content column -->
            <div class="main-content">

                <!-- Trust badges row -->
                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:36px;">
                    <span class="badge badge-primary">✓ Factory-Certified Parts</span>
                    <span class="badge badge-primary">✓ Highly Trained Technicians</span>
                    <span class="badge badge-success">✓ 30-Day Warranty</span>
                    <span class="badge badge-primary">✓ Same-Day Available</span>
                </div>

                <!-- Appliance image -->
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="appliance-image">
                    <?php the_post_thumbnail( 'brp-appliance', array( 'alt' => $page_title ) ); ?>
                </div>
                <?php elseif ( $service_image_url ) : ?>
                <div class="appliance-image">
                    <img src="<?php echo esc_url( $service_image_url ); ?>"
                         alt="<?php echo esc_attr( $page_title ); ?>"
                         loading="lazy">
                </div>
                <?php else : ?>
                <div class="appliance-image" style="background:var(--color-light);border-radius:var(--border-radius-lg);height:280px;display:flex;align-items:center;justify-content:center;margin-bottom:32px;">
                    <div style="text-align:center;color:var(--color-gray);">
                        <div style="font-size:4rem;margin-bottom:8px;">🔧</div>
                        <p style="margin:0;"><?php echo esc_html( $page_title ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Page content -->
                <div class="entry-content">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>

                    <?php
                    // Show fallback if post has no real visible content
                    // (handles empty posts AND Gutenberg-only empty-block markup)
                    $has_real_content = trim( wp_strip_all_tags( get_the_content() ) ) !== '';
                    if ( ! $has_real_content ) :
                    ?>

                    <?php if ( 'wine-cooler' === $appliance_type ) : ?>
                    <!-- Wine Cooler specific content -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Wine Cooler Repair</h2>
                    <p>Temperature consistency and vibration control are everything in wine storage — and when your <?php echo BRP_BRAND; ?> wine cooler starts drifting off its set point or developing mechanical issues, it puts bottles you've been carefully storing for years at risk. A unit that swings just a few degrees between cycles can accelerate aging and compromise corks over time. Our technicians specialize specifically in <?php echo BRP_BRAND; ?> wine coolers and carry the replacement parts to handle most faults in a single visit.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Wine Cooler Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Not cooling or not reaching set temperature</li>
                        <li>Temperature fluctuating between zones (dual-zone models)</li>
                        <li>Compressor running but not cooling</li>
                        <li>Excessive vibration that may disturb wine sediment</li>
                        <li>Error codes on the control display</li>
                        <li>Interior light not working</li>
                        <li>Door seal damaged or not sealing properly</li>
                        <li>Condensation or frost buildup inside the cabinet</li>
                        <li>Fan motor making unusual noise</li>
                        <li>Control panel unresponsive or buttons not working</li>
                        <li>Unit not turning on</li>
                        <li>Humidity too high or too low inside the cabinet</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Wine Cooler Models We Service</h3>
                    <p>Our technicians are experienced with the full range of <?php echo BRP_BRAND; ?> undercounter and built-in wine coolers, including:</p>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> Single-Zone Undercounter Wine Coolers</li>
                        <li><?php echo BRP_BRAND; ?> Dual-Zone Wine Coolers</li>
                        <li><?php echo BRP_BRAND; ?> Built-In Column Wine Storage</li>
                        <li><?php echo BRP_BRAND; ?> Integrated Wine Coolers (panel-ready)</li>
                    </ul>

                    <h3>Why Precise Temperature Matters</h3>
                    <p>Wine is sensitive to temperature swings of even a few degrees. Long-term storage requires consistent temperatures — typically 45°F to 65°F depending on the wine type — along with controlled humidity and minimal vibration. A malfunctioning cooler that cycles between temperatures can accelerate aging, push corks, and ruin years of careful cellaring. Don't wait to have the problem assessed.</p>

                    <h3>Our <?php echo BRP_BRAND; ?> Wine Cooler Repair Process</h3>
                    <ol>
                        <li><strong>Schedule:</strong> Call or book online — we lock in same-day or next-day service and confirm your window within minutes.</li>
                        <li><strong>Diagnosis:</strong> We test the compressor, thermistors, fan motors, and zone controls to pinpoint the actual fault — not just the symptom on the display.</li>
                        <li><strong>Fixed Quote:</strong> A clear price, explained in plain language, before we touch anything.</li>
                        <li><strong>Repair with OEM Parts:</strong> Factory-certified <?php echo BRP_BRAND; ?> compressors, thermistors, and fan assemblies — the parts rated to your unit's exact tolerances.</li>
                        <li><strong>Temperature Verification:</strong> We confirm both zones are hitting and holding their set temperatures before we leave your home.</li>
                        <li><strong>30-Day Warranty:</strong> Same fault returns? We come back at no charge.</li>
                    </ol>

                    <h3>Why Choose Genuine <?php echo BRP_BRAND; ?> Parts?</h3>
                    <p>Aftermarket compressors, thermistors, and fan motors may appear to fit but are rarely engineered to the same tolerances as the original <?php echo BRP_BRAND; ?> components. Using non-OEM parts in a wine cooler can lead to temperature inaccuracy, premature failure, and a voided manufacturer warranty. We stock genuine <?php echo BRP_BRAND; ?> parts and use them exclusively on every repair.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> If your <?php echo BRP_BRAND; ?> wine cooler is displaying an error code, write it down before our technician arrives — it gives us a head start on diagnosis. You can also look up your code in our <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>"><?php echo BRP_BRAND; ?> Error Code Database</a>.
                    </div>

                    <?php elseif ( 'hood' === $appliance_type ) : ?>
                    <!-- Hood / Range Hood specific content -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Range Hood Repair</h2>
                    <p>A <?php echo BRP_BRAND; ?> range hood does one job: move air. When the blower motor quits, the lights stop working, or the controls go unresponsive, that job doesn't get done — and grease, smoke, and steam build up in your kitchen instead. Our technicians specialize in <?php echo BRP_BRAND; ?> ventilation systems and carry the parts to clear up most hood faults the same day they arrive.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Hood Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Blower motor not working or running at wrong speed</li>
                        <li>Hood not turning on at all</li>
                        <li>Lights not working or flickering</li>
                        <li>Control panel buttons unresponsive</li>
                        <li>Excessive noise (rattling, grinding, humming)</li>
                        <li>Poor suction or weak airflow</li>
                        <li>Error code displayed on the panel</li>
                        <li>Fan running but not exhausting properly</li>
                        <li>Grease filter sensor malfunction</li>
                        <li>Hood not connecting to smart home system</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Hood Models We Service</h3>
                    <p>We service the full range of <?php echo BRP_BRAND; ?> ventilation products, including:</p>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> Wall-Mount Chimney Range Hoods</li>
                        <li><?php echo BRP_BRAND; ?> Island Range Hoods</li>
                        <li><?php echo BRP_BRAND; ?> Under-Cabinet Range Hoods</li>
                        <li><?php echo BRP_BRAND; ?> Built-In Downdraft Ventilation Systems</li>
                        <li><?php echo BRP_BRAND; ?> Integrated Cabinet-Mount Hoods</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Hood Repair Process</h3>
                    <ol>
                        <li><strong>Schedule:</strong> Same-day or next-day service available — call or book online and we confirm your window within minutes.</li>
                        <li><strong>Diagnosis:</strong> We inspect the blower assembly, control board, lighting circuit, and wiring to find the root cause before quoting a price — not after.</li>
                        <li><strong>Fixed Quote:</strong> One number — parts and labor — before we pick up a single tool.</li>
                        <li><strong>Repair:</strong> Genuine <?php echo BRP_BRAND; ?> blower motors, control boards, and LED assemblies. No aftermarket substitutes.</li>
                        <li><strong>Performance Check:</strong> We run the hood at every fan speed and test the lights before leaving. If it's not right, we don't leave.</li>
                        <li><strong>30-Day Warranty:</strong> Your repair is backed by our standard 30-day labor warranty.</li>
                    </ol>

                    <h3>Why Genuine <?php echo BRP_BRAND; ?> Parts Matter for Hood Repair</h3>
                    <p>Range hood blower motors and control boards are engineered to specific airflow and electrical tolerances. Aftermarket components frequently cause noise issues, reduced airflow, or premature failure. We stock genuine OEM <?php echo BRP_BRAND; ?> hood parts to ensure every repair restores your ventilation to factory performance.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> Clean or replace your <?php echo BRP_BRAND; ?> hood's grease filters every 1–3 months depending on cooking frequency. Clogged filters reduce airflow, strain the blower motor, and can trigger error codes. Our technicians can inspect and replace filters as part of any service visit.
                    </div>

                    <?php elseif ( 'refrigerator' === $appliance_type ) : ?>
                    <!-- REFRIGERATOR -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Refrigerator Repair</h2>
                    <p>Your <?php echo BRP_BRAND; ?> refrigerator holds somewhere between $200 and $500 worth of food at any given time — and when the cooling stops, that window closes fast. We prioritize refrigerator calls for exactly this reason, aiming for same-day arrival on every fault. Our technicians specialize exclusively in <?php echo BRP_BRAND; ?> refrigerators and carry a fully loaded parts inventory so most issues are resolved without a return trip.</p>

                    <p><?php echo BRP_BRAND; ?> built-in refrigerators — columns, counter-depths, French doors — use specific compressors, evaporator assemblies, and control boards that aren't interchangeable with standard GE components. Installing the wrong part into a sealed refrigeration system doesn't just fail to fix the problem — it can cause refrigerant complications that turn a $400 repair into a $1,500 one. We carry the exact parts rated for your model. Every time.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Refrigerator Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Refrigerator not cooling or freezer section not freezing</li>
                        <li>Temperature too warm despite correct settings</li>
                        <li>Ice maker not producing ice or making misshapen cubes</li>
                        <li>Water dispenser not working or dripping constantly</li>
                        <li>Frost buildup on evaporator coils or inside freezer</li>
                        <li>Compressor running constantly or cycling too frequently</li>
                        <li>Loud noises — rattling, clicking, buzzing, or humming</li>
                        <li>Water pooling inside the refrigerator or on the floor</li>
                        <li>Door gasket damaged or not sealing properly</li>
                        <li>Error codes on the display panel</li>
                        <li>Control board unresponsive or display malfunctioning</li>
                        <li>LED lighting not working inside compartments</li>
                        <li>Fresh food compartment too warm while freezer is fine</li>
                        <li>Defrost cycle not running, causing ice buildup</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Refrigerator Models We Service</h3>
                    <p>Our technicians are trained on the full <?php echo BRP_BRAND; ?> refrigerator lineup, including:</p>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> 30" and 36" Counter-Depth French Door Refrigerators</li>
                        <li><?php echo BRP_BRAND; ?> Built-In Column Refrigerators and Freezers</li>
                        <li><?php echo BRP_BRAND; ?> Side-by-Side Refrigerators</li>
                        <li><?php echo BRP_BRAND; ?> Bottom-Freezer Models</li>
                        <li><?php echo BRP_BRAND; ?> All-Refrigerator and All-Freezer Columns</li>
                        <li><?php echo BRP_BRAND; ?> Integrated Panel-Ready Refrigerators</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Refrigerator Repair Process</h3>
                    <ol>
                        <li><strong>Priority Scheduling:</strong> Refrigerator calls get same-day priority. Call us now and we'll do everything possible to get there today.</li>
                        <li><strong>Precise Diagnosis:</strong> We use professional refrigeration diagnostic tools to find the actual fault, not just guess based on the symptom you describe.</li>
                        <li><strong>Upfront Quote:</strong> A fixed price before we start. What we quote is what you pay — no open-ended labor billing.</li>
                        <li><strong>Factory-Matched Parts:</strong> OEM <?php echo BRP_BRAND; ?> compressors, evaporator fans, thermistors, and water valves — calibrated to your unit's specifications.</li>
                        <li><strong>Compartment Temperature Test:</strong> After the repair, we check temperatures in every section and run a full system test before we leave.</li>
                        <li><strong>30-Day Warranty:</strong> Same issue within 30 days? We return and fix it at no charge.</li>
                    </ol>

                    <h3>Why OEM Parts Are Non-Negotiable for Refrigerator Repair</h3>
                    <p>Refrigerators operate within narrow temperature tolerances. An aftermarket thermistor that reads 2°F off can cause the compressor to run overtime, increasing your energy bill and shortening the appliance's lifespan. Aftermarket water inlet valves and ice maker assemblies are also frequent sources of leaks and component failures. We stock genuine <?php echo BRP_BRAND; ?> parts specifically because precision matters — and cutting corners on a refrigerator repair can cost far more than the savings on a cheap part.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> If your <?php echo BRP_BRAND; ?> refrigerator is not cooling, check that the condenser coils at the back or bottom are not clogged with dust. Dirty coils are one of the most common causes of poor cooling performance and can be cleaned with a vacuum brush. If cleaning doesn't resolve the issue, call us for a professional diagnosis.
                    </div>

                    <?php elseif ( 'oven' === $appliance_type ) : ?>
                    <!-- OVEN -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Oven Repair</h2>
                    <p>An oven that doesn't hold temperature bakes unevenly. An oven with a failing igniter can accumulate unburned gas before the valve opens. Neither is a wait-and-see situation. Our certified technicians specialize in <?php echo BRP_BRAND; ?> oven repair — gas, electric, dual-fuel, and speed oven configurations — and carry factory-certified parts to handle the most common faults on the first visit.</p>

                    <p>Oven repairs require more precision than most homeowners expect. An igniter at the wrong resistance will glow without ever triggering the gas valve — a repair that looks correct but isn't. A bake element at the wrong wattage rating can damage the control board over time. We test every component against your model's specifications before installing anything. No guessing, no generic substitutes.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Oven Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Oven not heating or reaching set temperature</li>
                        <li>Temperature running too hot or too cold</li>
                        <li>Bake or broil element not glowing or heating</li>
                        <li>Gas oven not igniting or igniter clicking continuously</li>
                        <li>Convection fan not running or making noise</li>
                        <li>Self-clean cycle not starting or getting stuck</li>
                        <li>Control board displaying error codes</li>
                        <li>Door not closing properly or hinge damaged</li>
                        <li>Oven light not working</li>
                        <li>Temperature probe giving inaccurate readings</li>
                        <li>Touch controls unresponsive</li>
                        <li>Oven shutting off mid-cycle unexpectedly</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Oven Models We Service</h3>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> 30" and 36" Single Wall Ovens</li>
                        <li><?php echo BRP_BRAND; ?> Double Wall Ovens</li>
                        <li><?php echo BRP_BRAND; ?> Professional Gas Ranges with Oven</li>
                        <li><?php echo BRP_BRAND; ?> Dual-Fuel Ranges</li>
                        <li><?php echo BRP_BRAND; ?> Speed Ovens (Convection + Microwave)</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Oven Repair Process</h3>
                    <ol>
                        <li><strong>Same-Day Service:</strong> A broken oven disrupts your household quickly. We prioritize oven calls and aim to arrive the same day.</li>
                        <li><strong>Component-Level Testing:</strong> We test the igniter, heating elements, temperature probe, thermostat, and control board individually to find the exact fault before touching anything else.</li>
                        <li><strong>Fixed Price:</strong> Parts and labor quoted together, upfront, before any work begins.</li>
                        <li><strong>Specification-Matched Parts:</strong> The correct igniter resistance, element wattage, and control board for your exact model — not the closest available alternative.</li>
                        <li><strong>Temperature Calibration:</strong> We run the oven through a full heat cycle and verify it reaches and holds the correct temperature before we leave.</li>
                        <li><strong>30-Day Warranty:</strong> Same fault returns within 30 days? We fix it at no charge.</li>
                    </ol>

                    <h3>The Risk of Incorrect Oven Repairs</h3>
                    <p>An oven igniter that is the wrong resistance rating will glow but never open the gas valve — leading to gas buildup. A bake element that runs at the wrong wattage can permanently damage your control board. We take oven repairs seriously because the consequences of getting them wrong go beyond inconvenience. Our technicians carry the exact OEM <?php echo BRP_BRAND; ?> components rated for your specific model.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> If your <?php echo BRP_BRAND; ?> oven runs hotter or cooler than the set temperature, it may simply need calibration — a quick adjustment in the settings menu. If calibration doesn't solve it, the temperature sensor or thermostat likely needs replacement. Look up your error code in our <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>"><?php echo BRP_BRAND; ?> Error Code Database</a>.
                    </div>

                    <?php elseif ( 'dishwasher' === $appliance_type ) : ?>
                    <!-- DISHWASHER -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Dishwasher Repair</h2>
                    <p>Dishwasher problems come in two kinds: the ones you can see — standing water, dirty dishes, a door that won't latch — and the ones that are quietly causing damage while you continue running it. A slow door seal leak or a weeping pump gasket can wick into your cabinetry for weeks before it's visible. Our technicians treat every <?php echo BRP_BRAND; ?> dishwasher repair with both in mind, because fixing the symptom without checking the underlying water path isn't a complete repair.</p>

                    <p>We carry the door gaskets, pump assemblies, drain components, and control boards that <?php echo BRP_BRAND; ?> dishwashers actually require — not aftermarket parts that "sort of fit." A genuine <?php echo BRP_BRAND; ?> pump seal is machined to tighter tolerances than any generic replacement, which means it seals correctly under operating pressure rather than weeping slowly from the day it's installed.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Dishwasher Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Dishwasher not draining — standing water at the bottom</li>
                        <li>Not cleaning dishes properly — residue or film left behind</li>
                        <li>Leaking water onto the floor</li>
                        <li>Door latch not catching or door not closing securely</li>
                        <li>Wash cycle not starting</li>
                        <li>Unusual noises — grinding, rattling, or humming</li>
                        <li>Error codes displayed on the control panel</li>
                        <li>Detergent dispenser not opening during the cycle</li>
                        <li>Dishes not drying after the cycle completes</li>
                        <li>Control panel buttons unresponsive or frozen</li>
                        <li>Water not filling or fill cycle taking too long</li>
                        <li>Spray arms clogged or not rotating</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Dishwasher Models We Service</h3>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> 24" Fully Integrated Dishwashers</li>
                        <li><?php echo BRP_BRAND; ?> Panel-Ready Dishwashers</li>
                        <li><?php echo BRP_BRAND; ?> Dishwashers with Third-Rack Configurations</li>
                        <li><?php echo BRP_BRAND; ?> Stainless Interior Dishwashers</li>
                        <li><?php echo BRP_BRAND; ?> Wi-Fi Connected Smart Dishwashers</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Dishwasher Repair Process</h3>
                    <ol>
                        <li><strong>Schedule:</strong> Same-day and next-day service available. A broken dishwasher means hand-washing everything — we know that gets old fast.</li>
                        <li><strong>Full Diagnosis:</strong> We inspect the door gasket, pump, control board, spray arms, drain path, and water supply — not just the first obvious component.</li>
                        <li><strong>Fixed Quote:</strong> Parts and labor agreed before we start. No per-hour billing that escalates as the job continues.</li>
                        <li><strong>OEM Components:</strong> Factory-certified <?php echo BRP_BRAND; ?> pumps, door latches, gaskets, and control boards — parts that fit correctly and seal under real operating pressure.</li>
                        <li><strong>Full Cycle Test:</strong> We run a complete wash cycle after the repair to check cleaning performance, draining, and confirm there are no leaks anywhere in the system.</li>
                        <li><strong>30-Day Warranty:</strong> Same problem returns? We come back and resolve it at no charge.</li>
                    </ol>

                    <h3>Why Leaks Demand Immediate Attention</h3>
                    <p>Even a slow dishwasher leak can cause significant damage to your kitchen floor and cabinetry within weeks. Water seeping under hardwood or laminate flooring causes warping and mold growth that costs thousands to remediate. If your <?php echo BRP_BRAND; ?> dishwasher is leaking — even slightly — don't delay the repair. Our technicians carry the door gaskets, pump seals, and inlet valve assemblies needed to stop leaks the same day.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> If your <?php echo BRP_BRAND; ?> dishwasher isn't draining, first check that the drain hose isn't kinked and that your garbage disposal knockout plug has been removed (if newly installed). If neither applies, the drain pump or check valve likely needs replacement. Note any error code and visit our <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>"><?php echo BRP_BRAND; ?> Error Code Database</a> for guidance.
                    </div>

                    <?php elseif ( 'washer' === $appliance_type ) : ?>
                    <!-- WASHER -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Washer Repair</h2>
                    <p>A broken washer compounds quickly — laundry piles up, you're making trips to the laundromat, and if it's a front-load with a failing drum bearing, every extra day you wait makes the repair more expensive. Our certified technicians specialize in <?php echo BRP_BRAND; ?> washer repair and carry genuine factory parts so most faults can be resolved in a single visit.</p>

                    <p><?php echo BRP_BRAND; ?>'s front-load washers use specific bearing kits, drum assemblies, and control boards that need exact-match replacements. The connected features on smart models also require technicians who understand <?php echo BRP_BRAND; ?>'s firmware and app integration — not just the mechanical side. We handle both.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Washer Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Washer not spinning or spin cycle very slow</li>
                        <li>Washer not draining — water remaining in drum</li>
                        <li>Leaking water from the door seal or hoses</li>
                        <li>Excessive vibration or "walking" during spin cycle</li>
                        <li>Loud banging or grinding noises</li>
                        <li>Washer door locked and won't open</li>
                        <li>Cycle not starting or stopping mid-wash</li>
                        <li>Error codes displayed on control panel</li>
                        <li>Not filling with water or filling too slowly</li>
                        <li>Clothes coming out too wet after the spin cycle</li>
                        <li>Foul odor from drum (mold or mildew buildup)</li>
                        <li>Control panel unresponsive or Wi-Fi connection lost</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Washer Models We Service</h3>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> Front-Load Washers (2.8 cu. ft. and 5.0 cu. ft.)</li>
                        <li><?php echo BRP_BRAND; ?> Smart Front-Load Washers with Wi-Fi</li>
                        <li><?php echo BRP_BRAND; ?> Stacked Washer/Dryer Combinations</li>
                        <li><?php echo BRP_BRAND; ?> Built-In Laundry Pair Installations</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Washer Repair Process</h3>
                    <ol>
                        <li><strong>Fast Scheduling:</strong> Same-day and next-day washer repair available across all service areas — wet laundry doesn't wait.</li>
                        <li><strong>Root-Cause Diagnosis:</strong> We test the motor, bearings, drain pump, door seal, and control board to find what's actually wrong — not just what sounds wrong.</li>
                        <li><strong>Fixed Price:</strong> A complete quote — parts and labor — before any work starts. No surprise charges when the job is done.</li>
                        <li><strong>Genuine Parts:</strong> OEM <?php echo BRP_BRAND; ?> drum bearings, door gaskets, drain pumps, and control boards — matched to your specific model.</li>
                        <li><strong>Full Test Cycle:</strong> We run a complete wash and spin cycle, check for leaks, and confirm all smart features are working before we leave.</li>
                        <li><strong>30-Day Warranty:</strong> Same fault within 30 days? We fix it at no additional charge.</li>
                    </ol>

                    <h3>Front-Load Washer Bearings: Don't Ignore the Noise</h3>
                    <p>A loud grinding or rumbling noise during the spin cycle almost always indicates worn drum bearings — one of the most common <?php echo BRP_BRAND; ?> front-load washer failures. Bearings that fail completely can damage the drum shaft and spider arm, turning a straightforward bearing replacement into a far more expensive repair. If you hear grinding, schedule a service visit before the problem worsens. Our technicians carry the correct bearing kits for <?php echo BRP_BRAND; ?> models and can typically complete the repair in a single visit.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> Run a monthly drum-clean cycle with a washing machine cleaner to prevent mold and odor buildup in your <?php echo BRP_BRAND; ?> front-load washer. Always leave the door ajar between washes to allow the drum to dry. If you see an error code, check our <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>"><?php echo BRP_BRAND; ?> Error Code Database</a> before calling.
                    </div>

                    <?php elseif ( 'dryer' === $appliance_type ) : ?>
                    <!-- DRYER -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Dryer Repair</h2>
                    <p>A dryer that runs but doesn't heat isn't just inefficient — a blown thermal fuse almost always means airflow is restricted somewhere, and restricted airflow is the leading cause of dryer fires in the U.S. We check the full ventilation system on every dryer repair call, not just the component that triggered the service request. Our technicians specialize in <?php echo BRP_BRAND; ?> dryers and carry the parts to resolve most faults the same day.</p>

                    <p>Gas and electric dryers have different failure patterns, and <?php echo BRP_BRAND; ?>'s sensor drying systems add diagnostic complexity that general technicians often miss. We test the heating assembly, thermal components, drum drive, and moisture sensors specifically — not a generic dryer checklist applied to every brand.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Dryer Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Dryer not heating — tumbling but clothes stay wet</li>
                        <li>Dryer running but taking multiple cycles to dry clothes</li>
                        <li>Thermal fuse blown (usually caused by restricted airflow)</li>
                        <li>Drum not turning — motor running but drum stationary</li>
                        <li>Loud squealing, thumping, or scraping noises</li>
                        <li>Dryer shutting off before the cycle completes</li>
                        <li>Overheating — exterior of machine very hot to the touch</li>
                        <li>Error codes on the control display</li>
                        <li>Start button not responding</li>
                        <li>Steam function not working</li>
                        <li>Drum light not working</li>
                        <li>Dryer producing burning smell during operation</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Dryer Models We Service</h3>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> 7.4 cu. ft. Electric Dryers</li>
                        <li><?php echo BRP_BRAND; ?> Gas Dryers</li>
                        <li><?php echo BRP_BRAND; ?> Steam Dryers</li>
                        <li><?php echo BRP_BRAND; ?> Front-Control and Rear-Control Models</li>
                        <li><?php echo BRP_BRAND; ?> Matching Dryers for Stacked Laundry Pairs</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Dryer Repair Process</h3>
                    <ol>
                        <li><strong>Same-Day Scheduling:</strong> Wet laundry is urgent. We offer same-day dryer repair in most service areas — call and we'll get there.</li>
                        <li><strong>Safety-First Diagnosis:</strong> We check the ventilation path before anything else — restricted airflow is a fire hazard — then diagnose the electrical or mechanical fault.</li>
                        <li><strong>Fixed Quote:</strong> A clear price, parts and labor together, before we begin any work.</li>
                        <li><strong>OEM Heating Components:</strong> Genuine <?php echo BRP_BRAND; ?> heating elements, thermal fuses, thermostats, drum belts, and idler pulleys — rated to your model's specifications.</li>
                        <li><strong>Vent Inspection Included:</strong> We test your external vent for blockages as part of every service visit — not as an add-on charge.</li>
                        <li><strong>30-Day Warranty:</strong> Same issue within 30 days? We return and fix it at no charge.</li>
                    </ol>

                    <h3>A Blocked Vent Is a Fire Hazard</h3>
                    <p>The U.S. Fire Administration estimates that clothes dryers cause over 2,900 home fires annually — and restricted airflow from a clogged vent is the leading contributing factor. If your <?php echo BRP_BRAND; ?> dryer is taking longer to dry clothes, running hot, or has a thermal fuse that keeps blowing, the vent duct is almost certainly restricted. We inspect and test the vent system as a standard part of every dryer service call. Don't run a dryer that overheats — call us today.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> Clean your lint trap after every single load — a clogged lint screen reduces airflow by up to 75%, making your dryer work harder and run hotter. Have your external vent duct professionally cleaned at least once a year. If your dryer displays an error code, look it up in our <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>"><?php echo BRP_BRAND; ?> Error Code Database</a>.
                    </div>

                    <?php elseif ( 'microwave' === $appliance_type ) : ?>
                    <!-- MICROWAVE -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Microwave Repair</h2>
                    <p><?php echo BRP_BRAND; ?> built-in and drawer microwaves represent a $1,000–$2,000 investment that's fitted into your cabinetry. Replacing one means ordering a new unit, waiting on delivery, and paying an installer to pull and reset the trim kit. In most cases, repair is the smarter call — and our certified technicians are trained to handle it safely. That last part matters, because a microwave capacitor can hold a lethal charge even after the unit is unplugged.</p>

                    <p>We discharge the capacitor before any internal work begins. Every visit, every time — it's not optional, it's the first step. From there, we diagnose the magnetron, door switches, diode, and control board with the same approach we use on any other appliance: find the actual fault, quote a fixed price, and repair it with factory-certified parts.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Microwave Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Microwave not heating food despite running normally</li>
                        <li>Sparking or arcing inside the cavity</li>
                        <li>Turntable not rotating</li>
                        <li>Door not opening, closing, or latching correctly</li>
                        <li>Microwave not starting at all</li>
                        <li>Display not working or showing incorrect information</li>
                        <li>Exhaust fan not running (over-the-range models)</li>
                        <li>Interior light not working</li>
                        <li>Unusual burning smell during operation</li>
                        <li>Error codes displayed on the panel</li>
                        <li>Buttons on control panel not responding</li>
                        <li>Microwave running but making loud humming noise</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Microwave Models We Service</h3>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> 30" Built-In Microwaves</li>
                        <li><?php echo BRP_BRAND; ?> Over-the-Range Microwave/Hood Combinations</li>
                        <li><?php echo BRP_BRAND; ?> Microwave Drawer Models</li>
                        <li><?php echo BRP_BRAND; ?> Speed Oven/Microwave Combination Units</li>
                        <li><?php echo BRP_BRAND; ?> Trim-Kit Integrated Microwaves</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Microwave Repair Process</h3>
                    <ol>
                        <li><strong>Schedule:</strong> Same-day or next-day service available. Call or book online.</li>
                        <li><strong>Capacitor Discharge First:</strong> Before we open the unit, we safely discharge the capacitor — standard protocol, no exceptions.</li>
                        <li><strong>Component Testing:</strong> We test the magnetron, diode, capacitor, door switches, and control board to find the exact fault.</li>
                        <li><strong>Fixed Quote:</strong> The full repair price — parts and labor — before we start anything.</li>
                        <li><strong>Genuine Parts:</strong> Factory-certified <?php echo BRP_BRAND; ?> magnetrons, door switches, and control boards only.</li>
                        <li><strong>30-Day Warranty:</strong> Standard 30-day labor warranty on every repair.</li>
                    </ol>

                    <h3>When to Repair vs. Replace Your Microwave</h3>
                    <p>As a general rule, if the cost of repair is less than 50% of the cost of a new equivalent <?php echo BRP_BRAND; ?> microwave, repair is the right choice. <?php echo BRP_BRAND; ?> built-in and drawer microwaves typically cost $800–$2,000 new, which means most repairs — including magnetron replacement — are economically sound. We give you an honest assessment and will tell you if a replacement makes more sense in your specific situation.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> Never run your <?php echo BRP_BRAND; ?> microwave empty — without food or liquid to absorb microwave energy, the magnetron can overheat and fail prematurely. If your microwave sparks, stop using it immediately and call us — sparking is often caused by damaged waveguide covers or metallic residue and can escalate quickly.
                    </div>

                    <?php elseif ( 'freezer' === $appliance_type ) : ?>
                    <!-- FREEZER -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Freezer Repair</h2>
                    <p>A fully stocked freezer stays cold for about 48 hours after the cooling system fails. A half-full one — closer to 24 hours. Once temperatures climb above 40°F and hold there for more than two hours, you're in food safety territory and meat is at risk. We treat <?php echo BRP_BRAND; ?> freezer calls as urgent and aim for same-day service specifically because the window is short.</p>

                    <p>Freezer faults can all present the same way — the unit isn't cold enough — but the causes vary widely. A failed defrost heater, a seized evaporator fan motor, a compressor running without properly circulating refrigerant, and a control board that's stopped triggering the defrost cycle all look identical from the outside. We diagnose with precision tools, not trial and error, and carry the factory-certified <?php echo BRP_BRAND; ?> components to fix what we find.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Freezer Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Freezer not cold enough — temperature above 0°F</li>
                        <li>Excessive frost or ice buildup inside the compartment</li>
                        <li>Compressor running constantly but not cooling</li>
                        <li>Compressor not starting</li>
                        <li>Loud noises — buzzing, clicking, or rattling from compressor area</li>
                        <li>Defrost drain clogged — water pooling in bottom</li>
                        <li>Door gasket cracked, torn, or not sealing properly</li>
                        <li>Error codes on the display panel</li>
                        <li>Interior light not working</li>
                        <li>Evaporator fan motor not running</li>
                        <li>Unit cycling on and off too frequently</li>
                        <li>Condensation forming on the exterior door panel</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Freezer Models We Service</h3>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> 18" and 24" All-Freezer Column Units</li>
                        <li><?php echo BRP_BRAND; ?> Built-In Freezer Columns (Panel-Ready)</li>
                        <li><?php echo BRP_BRAND; ?> Undercounter Freezer Drawers</li>
                        <li><?php echo BRP_BRAND; ?> Integrated Freezer Columns for Kitchen Suites</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Freezer Repair Process</h3>
                    <ol>
                        <li><strong>Emergency Scheduling:</strong> Freezer failures get same-day priority in all our service areas. Call now — don't wait on this one.</li>
                        <li><strong>System-Level Diagnosis:</strong> We check compressor output, evaporator temperature, defrost cycle function, and fan operation — a full picture, not just the first obvious component.</li>
                        <li><strong>Honest Assessment:</strong> A clear explanation of the fault and a fixed price before we start any repair.</li>
                        <li><strong>OEM Parts:</strong> Genuine <?php echo BRP_BRAND; ?> compressors, evaporator fans, defrost heaters, and door gaskets — calibrated to your unit's system requirements.</li>
                        <li><strong>Temperature Confirmation:</strong> After the repair, we verify the freezer is reaching and holding its target temperature before we leave.</li>
                        <li><strong>30-Day Warranty:</strong> Same fault returns within 30 days? We come back and fix it at no charge.</li>
                    </ol>

                    <h3>How Long Can Food Stay Safe in a Broken Freezer?</h3>
                    <p>A fully stocked, unopened freezer stays cold for approximately 48 hours after power loss or compressor failure. A half-full freezer holds temperature for about 24 hours. If temperatures rise above 40°F for more than 2 hours, meat and poultry should be discarded. Call us immediately when your <?php echo BRP_BRAND; ?> freezer shows signs of failure — time is the critical factor.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> If your <?php echo BRP_BRAND; ?> freezer has excessive frost buildup, it usually indicates a failed defrost heater, defrost thermostat, or defrost control board. These are straightforward repairs when caught early. Don't attempt to manually defrost with a heat gun or sharp implement — you can damage the evaporator coils, which are an expensive repair.
                    </div>

                    <?php elseif ( 'cooktop' === $appliance_type ) : ?>
                    <!-- COOKTOP -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Cooktop Repair</h2>
                    <p>A <?php echo BRP_BRAND; ?> gas cooktop with a failing valve, a faulty igniter, or any gas smell near the burners is not a wait-and-see situation. Gas appliance repairs carry real safety stakes, and our certified technicians are trained specifically for gas cooktop work — following all applicable service codes on every job. If you smell gas, turn off the supply at the shutoff valve and call us immediately.</p>

                    <p>Induction cooktop faults are different but equally specific. Failed induction coils, unresponsive touch controls, and error codes on the display all require technicians who understand <?php echo BRP_BRAND; ?>'s control logic — not just general induction theory. We carry gas and induction components for the full <?php echo BRP_BRAND; ?> cooktop lineup and handle both with the same precision.</p>

                    <h3>Common <?php echo BRP_BRAND; ?> Cooktop Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Gas burner not igniting — clicking but no flame</li>
                        <li>Burner igniting but flame too weak or uneven</li>
                        <li>Continuous clicking even when not in use</li>
                        <li>Induction zone not heating or not detecting cookware</li>
                        <li>Control knob broken, stiff, or spinning freely</li>
                        <li>Touch controls unresponsive on induction models</li>
                        <li>Error code displayed on induction control panel</li>
                        <li>Gas smell near cooktop during or after use</li>
                        <li>Burner grate or cap damaged or missing</li>
                        <li>One or more burners working but others not</li>
                        <li>Cooktop surface cracked (induction glass)</li>
                        <li>Simmer function not maintaining low temperature</li>
                    </ul>

                    <h3><?php echo BRP_BRAND; ?> Cooktop Models We Service</h3>
                    <ul class="checklist">
                        <li><?php echo BRP_BRAND; ?> 30" and 36" Gas Cooktops (4-burner and 6-burner)</li>
                        <li><?php echo BRP_BRAND; ?> 36" Induction Cooktops</li>
                        <li><?php echo BRP_BRAND; ?> Professional Dual-Fuel Cooktops</li>
                        <li><?php echo BRP_BRAND; ?> Modular Cooktop Systems</li>
                        <li><?php echo BRP_BRAND; ?> Downdraft Cooktop Combinations</li>
                    </ul>

                    <h3>Our <?php echo BRP_BRAND; ?> Cooktop Repair Process</h3>
                    <ol>
                        <li><strong>Gas-Safe Scheduling:</strong> Smell gas? Turn off the supply valve and call immediately — we treat it as an emergency. For non-gas faults, same-day or next-day service is available.</li>
                        <li><strong>Safety-First Diagnosis:</strong> We test gas pressure, valve function, igniter resistance, burner cap condition, and induction coil output to find the precise fault.</li>
                        <li><strong>Fixed Quote:</strong> A clear price before we begin any work, covering parts and labor.</li>
                        <li><strong>Factory Parts:</strong> Genuine <?php echo BRP_BRAND; ?> igniters, spark modules, gas valves, and induction control boards — no generic alternatives on our vehicles.</li>
                        <li><strong>Safety Verification:</strong> After the repair, we run all burners, verify flame quality and color on gas models, and confirm there are no leaks before leaving.</li>
                        <li><strong>30-Day Warranty:</strong> Your repair is covered by our standard 30-day labor warranty.</li>
                    </ol>

                    <h3>Gas Cooktop Safety: What You Should Know</h3>
                    <p>A continuous clicking sound from a gas cooktop — even when all burners are off — usually means moisture has gotten into the igniter. While it often resolves on its own as the igniter dries, persistent clicking can indicate a failed spark module or a worn igniter electrode that needs replacement. A weak or yellow flame — instead of a crisp blue one — can indicate a clogged burner port or an incorrect gas/air mixture. Both issues affect combustion efficiency and should be addressed by a professional. Our technicians carry the complete range of <?php echo BRP_BRAND; ?> igniter and burner components.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> Keep burner caps and grates clean — food residue in the burner ports is the most common cause of weak or uneven flames on <?php echo BRP_BRAND; ?> gas cooktops. Soak caps in warm soapy water and use a toothpick to clear blocked ports. Never use a wire brush, which can enlarge the ports and affect flame quality.
                    </div>

                    <?php else : ?>
                    <!-- Default fallback -->
                    <h2>Professional <?php echo esc_html( $page_title ); ?> Service</h2>
                    <p>When your <?php echo esc_html( $appliance_name ); ?> breaks down, you need a repair service you can trust. Our certified technicians have extensive experience servicing all <?php echo BRP_BRAND; ?> <?php echo esc_html( strtolower( $appliance_name ) ); ?> models — from the latest connected appliances to older units. We carry a comprehensive inventory of factory-certified <?php echo BRP_BRAND; ?> replacement parts, which means most repairs can be completed in a single visit.</p>

                    <h3>Common <?php echo esc_html( $appliance_name ); ?> Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Not turning on or starting</li>
                        <li>Unusual noises (grinding, squeaking, banging)</li>
                        <li>Error code displayed on control panel</li>
                        <li>Not heating or cooling properly</li>
                        <li>Control panel unresponsive</li>
                        <li>Door not sealing or closing correctly</li>
                        <li>Excessive vibration or movement</li>
                        <li>Cycle not completing</li>
                        <li>Unusual odors during operation</li>
                    </ul>

                    <h3>Our Repair Process</h3>
                    <ol>
                        <li><strong>Same-Day Scheduling:</strong> Call or book online — we'll confirm an appointment within minutes.</li>
                        <li><strong>Expert Diagnosis:</strong> Our technician arrives on time with diagnostic tools and a full inventory of common <?php echo BRP_BRAND; ?> parts.</li>
                        <li><strong>Upfront Quote:</strong> We explain the issue in plain language and give you a fixed quote before starting repairs.</li>
                        <li><strong>Fast Repair:</strong> We complete the repair using factory-certified <?php echo BRP_BRAND; ?> parts, usually within 1–2 hours.</li>
                        <li><strong>Quality Test:</strong> We run the appliance through a full test cycle to confirm everything is working perfectly before leaving.</li>
                        <li><strong>30-Day Warranty:</strong> Your repair is backed by our 30-day labor warranty for complete peace of mind.</li>
                    </ol>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> If your <?php echo esc_html( strtolower( $appliance_name ) ); ?> is displaying an error code, note it down before our technician arrives. You can also look it up in our <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>"><?php echo BRP_BRAND; ?> Error Code Database</a>.
                    </div>

                    <?php endif; ?>

                    <?php endif; // end ! $has_real_content ?>
                </div>

                <!-- Cities served -->
                <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:32px;margin-top:48px;">
                    <h3 style="margin-bottom:16px;">🏙️ <?php echo esc_html( $page_title ); ?> Near You</h3>
                    <p style="color:var(--color-gray);margin-bottom:20px;">We provide <?php echo esc_html( $page_title ); ?> in all major metropolitan areas. Click your city for local service details and contact information.</p>
                    <div style="display:flex;flex-wrap:wrap;gap:10px;">
                        <?php foreach ( $cities as $city ) : ?>
                        <a href="<?php echo home_url( '/cities/' . $city['slug'] . '/' ); ?>" class="btn btn-secondary btn-sm">
                            <?php echo esc_html( $city['title'] ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div><!-- /.main-content -->

            <!-- Sidebar -->
            <aside class="sidebar">

                <!-- Call sidebar widget -->
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">📞 Call Us Now</div>
                    <div class="sidebar-phone">
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="sidebar-phone-number"><?php echo BRP_PHONE; ?></a>
                        <p>Mon–Sat 7am–8pm<br>Sun 9am–5pm</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;">Call Now</a>
                    </div>
                </div>

                <!-- Schedule sidebar widget -->
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">📅 Schedule Online</div>
                    <div class="sidebar-widget-body">
                        <p style="margin-bottom:16px;font-size:0.9rem;color:var(--color-gray);">Book your repair appointment online in 60 seconds.</p>
                        <a href="#schedule" class="btn btn-primary" style="width:100%;justify-content:center;">Book Appointment</a>
                    </div>
                </div>

                <!-- Why us sidebar widget -->
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">✅ Why Choose Us</div>
                    <div class="sidebar-widget-body">
                        <ul class="checklist" style="gap:8px;">
                            <li>Factory-certified Monogram parts</li>
                            <li>Highly trained technicians</li>
                            <li>30-day labor warranty</li>
                            <li>Same-day service available</li>
                            <li>Upfront, fixed pricing</li>
                            <li>Background-checked technicians</li>
                        </ul>
                    </div>
                </div>

                <!-- Other services sidebar widget -->
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">🔧 Other Services</div>
                    <div class="sidebar-widget-body">
                        <ul class="footer-links" style="gap:8px;">
                            <?php foreach ( array_slice( $services, 0, 8 ) as $s ) :
                                if ( $s['slug'] === get_post_field( 'post_name' ) ) continue; ?>
                            <li><a href="<?php echo home_url( '/services/' . $s['slug'] . '/' ); ?>" style="color:var(--color-text);"><?php echo esc_html( $s['title'] ); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </aside><!-- /.sidebar -->

        </div><!-- /.content-grid -->
    </div>
</div>

<!-- FAQ SECTION -->
<?php echo brp_faq_section( $faqs, 'Frequently Asked Questions About ' . $page_title ); ?>

<!-- APPOINTMENT FORM -->
<?php echo brp_appointment_form( 'Schedule Your ' . $page_title . ' Today' ); ?>

<?php get_footer(); ?>
