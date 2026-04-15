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
        <p>Expert <?php echo esc_html( $clean_title ); ?> by factory-trained technicians. Same-day service available. Factory-certified parts. 90-day warranty.</p>
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
                    <span class="badge badge-success">✓ 90-Day Warranty</span>
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
                         loading="lazy"
                         style="max-width:100%;height:auto;display:block;margin:0 auto 32px;">
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
                    <p>A <?php echo BRP_BRAND; ?> wine cooler is a precision appliance engineered to maintain exact temperature and humidity conditions that protect your investment. When something goes wrong — whether it's a temperature swing, a vibration issue, or an error code on the display — you need a technician who understands the specific demands of wine storage. Our certified technicians specialize in <?php echo BRP_BRAND; ?> wine cooler repair and carry a full inventory of genuine <?php echo BRP_BRAND; ?> replacement parts for same-day service.</p>

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
                        <li><strong>Same-Day Scheduling:</strong> Call or book online — we confirm your appointment within minutes and aim for same-day or next-day arrival.</li>
                        <li><strong>Expert Diagnosis:</strong> Our technician arrives with diagnostic tools and the most common <?php echo BRP_BRAND; ?> wine cooler parts on the service vehicle.</li>
                        <li><strong>Upfront Quote:</strong> We explain the fault in plain language and give you a fixed price before any work begins. No hidden fees.</li>
                        <li><strong>Precision Repair:</strong> We use only genuine, factory-certified <?php echo BRP_BRAND; ?> replacement parts to ensure your cooler performs to original factory specifications.</li>
                        <li><strong>Temperature Verification:</strong> After completing the repair, we verify that both zones are reaching and holding the correct set temperatures before we leave.</li>
                        <li><strong>90-Day Warranty:</strong> Your repair is backed by our 90-day labor warranty. If the same fault returns, we come back and fix it at no charge.</li>
                    </ol>

                    <h3>Why Choose Genuine <?php echo BRP_BRAND; ?> Parts?</h3>
                    <p>Aftermarket compressors, thermistors, and fan motors may appear to fit but are rarely engineered to the same tolerances as the original <?php echo BRP_BRAND; ?> components. Using non-OEM parts in a wine cooler can lead to temperature inaccuracy, premature failure, and a voided manufacturer warranty. We stock genuine <?php echo BRP_BRAND; ?> parts and use them exclusively on every repair.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> If your <?php echo BRP_BRAND; ?> wine cooler is displaying an error code, write it down before our technician arrives — it gives us a head start on diagnosis. You can also look up your code in our <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>"><?php echo BRP_BRAND; ?> Error Code Database</a>.
                    </div>

                    <?php elseif ( 'hood' === $appliance_type ) : ?>
                    <!-- Hood / Range Hood specific content -->
                    <h2>Expert <?php echo BRP_BRAND; ?> Range Hood Repair</h2>
                    <p>A <?php echo BRP_BRAND; ?> range hood or ventilation hood is a critical part of your kitchen, removing smoke, grease, steam, and odors while protecting your cabinetry and improving air quality. When the blower motor fails, the lighting stops working, or the controls go unresponsive, you need a technician who knows <?php echo BRP_BRAND; ?> ventilation systems inside and out. Our certified technicians carry genuine <?php echo BRP_BRAND; ?> parts and deliver same-day hood repair service.</p>

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
                    <p>Every <?php echo BRP_BRAND; ?> hood repair starts with a thorough diagnostic. Our technician inspects the blower assembly, control board, lighting circuit, and wiring to identify the root cause before quoting a fixed price.</p>
                    <ol>
                        <li><strong>Same-Day Scheduling:</strong> Call or book online — we confirm an appointment within minutes.</li>
                        <li><strong>Expert Diagnosis:</strong> Our technician arrives with diagnostic tools and a complete inventory of common <?php echo BRP_BRAND; ?> hood parts.</li>
                        <li><strong>Upfront Quote:</strong> We explain the fault clearly and give you a fixed price before any repair work begins.</li>
                        <li><strong>Fast Repair:</strong> We use only genuine, factory-certified <?php echo BRP_BRAND; ?> replacement parts — blower motors, control boards, LED light assemblies, and more.</li>
                        <li><strong>Performance Test:</strong> We run the hood at all fan speeds and test the lighting before leaving to confirm the repair is complete.</li>
                        <li><strong>90-Day Warranty:</strong> Your repair is backed by our 90-day labor warranty for complete peace of mind.</li>
                    </ol>

                    <h3>Why Genuine <?php echo BRP_BRAND; ?> Parts Matter for Hood Repair</h3>
                    <p>Range hood blower motors and control boards are engineered to specific airflow and electrical tolerances. Aftermarket components frequently cause noise issues, reduced airflow, or premature failure. We stock genuine OEM <?php echo BRP_BRAND; ?> hood parts to ensure every repair restores your ventilation to factory performance.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> Clean or replace your <?php echo BRP_BRAND; ?> hood's grease filters every 1–3 months depending on cooking frequency. Clogged filters reduce airflow, strain the blower motor, and can trigger error codes. Our technicians can inspect and replace filters as part of any service visit.
                    </div>

                    <?php else : ?>
                    <!-- Default fallback content for all other appliances -->
                    <h2>Professional <?php echo esc_html( $page_title ); ?> Service</h2>
                    <p>When your <?php echo esc_html( $appliance_name ); ?> breaks down, you need a repair service you can trust. Our certified technicians have extensive experience servicing all <?php echo BRP_BRAND; ?> <?php echo esc_html( strtolower( $appliance_name ) ); ?> models — from the latest connected appliances to older units.</p>

                    <p>We carry a comprehensive inventory of factory-certified <?php echo BRP_BRAND; ?> replacement parts, which means most repairs can be completed in a single visit. No waiting for parts to arrive, no multiple trips — just fast, effective, lasting repairs.</p>

                    <h3>Common <?php echo esc_html( $appliance_name ); ?> Problems We Fix</h3>
                    <ul class="checklist">
                        <li>Not turning on or starting</li>
                        <li>Unusual noises (grinding, squeaking, banging)</li>
                        <li>Error code displayed on control panel</li>
                        <li>Leaking water</li>
                        <li>Not heating or cooling properly</li>
                        <li>Control panel unresponsive</li>
                        <li>Door not sealing or closing correctly</li>
                        <li>Excessive vibration or movement</li>
                        <li>Cycle not completing</li>
                        <li>Unusual odors during operation</li>
                    </ul>

                    <h3>Our <?php echo esc_html( $page_title ); ?> Process</h3>
                    <p>Every <?php echo BRP_BRAND; ?> repair begins with a thorough diagnostic. Our technician will inspect your appliance, identify the root cause of the problem, and provide you with a clear upfront quote before any work begins. You'll never be surprised by hidden fees.</p>

                    <ol>
                        <li><strong>Same-Day Scheduling:</strong> Call or book online — we'll confirm an appointment within minutes.</li>
                        <li><strong>Expert Diagnosis:</strong> Our technician arrives on time with diagnostic tools and a full inventory of common Monogram parts.</li>
                        <li><strong>Upfront Quote:</strong> We explain the issue in plain language and give you a fixed quote before starting repairs.</li>
                        <li><strong>Fast Repair:</strong> We complete the repair using factory-certified Monogram parts, usually within 1–2 hours.</li>
                        <li><strong>Quality Test:</strong> We run the appliance through a full test cycle to confirm everything is working perfectly before leaving.</li>
                        <li><strong>90-Day Warranty:</strong> Your repair is backed by our 90-day labor warranty for complete peace of mind.</li>
                    </ol>

                    <h3>Why Factory-Certified Parts Matter</h3>
                    <p>Using genuine, factory-certified <?php echo BRP_BRAND; ?> parts is critical for two reasons: quality and safety. Aftermarket parts may fit but often fail prematurely and can void your appliance warranty. Our technicians carry an extensive inventory of OEM <?php echo BRP_BRAND; ?> parts so you always get the right part, properly installed.</p>

                    <div class="notice notice-info">
                        <strong>💡 Tip:</strong> If your <?php echo esc_html( strtolower( $appliance_name ) ); ?> is displaying an error code, note it down before our technician arrives. You can also look it up in our <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>">Monogram Error Code Database</a>.
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
                            <li>90-day labor warranty</li>
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
