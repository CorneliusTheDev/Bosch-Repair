<?php
/**
 * Template Name: City Page
 * Template Post Type: city
 *
 * Used for individual city pages.
 * e.g. /cities/chicago/
 *
 * @package BoschRepairPro
 */
get_header();

$city_slug  = get_post_field( 'post_name', get_the_ID() );
$city_title = get_the_title();
$services   = brp_get_services();
$cities     = brp_get_cities();
$all_cities = brp_get_cities();

// Find city data
$city_data = null;
foreach ( $all_cities as $c ) {
    if ( $c['slug'] === $city_slug ) {
        $city_data = $c;
        break;
    }
}

// Fallback
if ( ! $city_data ) {
    $city_data = array(
        'title'     => $city_title,
        'state'     => get_post_meta( get_the_ID(), '_brp_state', true ) ?: '',
        'zip_codes' => get_post_meta( get_the_ID(), '_brp_zip_codes', true ) ?: '',
        'suburbs'   => get_post_meta( get_the_ID(), '_brp_suburbs', true ) ?: '',
    );
}

$city_name_only = explode( ',', $city_data['title'] )[0];
$suburbs_arr    = explode( ', ', $city_data['suburbs'] );

$city_faqs = array(
    array(
        'q' => 'Do you offer same-day Bosch appliance repair in ' . $city_name_only . '?',
        'a' => 'Yes! We offer same-day and next-day Bosch appliance repair appointments in ' . $city_name_only . ' and all surrounding suburbs. Call us before noon for the best chance at a same-day visit.',
    ),
    array(
        'q' => 'Which ' . $city_name_only . ' suburbs do you service?',
        'a' => 'We service ' . $city_name_only . ' and the following suburbs: ' . $city_data['suburbs'] . '. If you don\'t see your suburb listed, call us — we may still be able to help.',
    ),
    array(
        'q' => 'How much does Bosch appliance repair cost in ' . $city_name_only . '?',
        'a' => 'Repair costs vary based on the appliance type and issue. We provide upfront, fixed quotes before any work begins. Most Bosch appliance repairs in ' . $city_name_only . ' range from $150–$500 depending on parts required.',
    ),
    array(
        'q' => 'Are your ' . $city_name_only . ' technicians certified?',
        'a' => 'Yes. All our technicians are factory-trained, certified, and background-checked. They specialize specifically in Bosch appliances and receive regular training on new models and technologies.',
    ),
    array(
        'q' => 'Do you repair all Bosch appliance models in ' . $city_name_only . '?',
        'a' => 'We repair all Bosch appliance models including washers, dryers, dishwashers, refrigerators, ovens, ranges, cooktops, microwaves, and more. We service both current and discontinued models.',
    ),
);
?>

<!-- PAGE HERO -->
<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Bosch Appliance Repair in <?php echo esc_html( $city_name_only ); ?></h1>
        <p>Professional <?php echo BRP_BRAND; ?> appliance repair serving <?php echo esc_html( $city_name_only ); ?> and surrounding suburbs. Same-day service available. Factory-certified parts and highly trained technicians.</p>
        <div style="display:flex;gap:16px;margin-top:24px;flex-wrap:wrap;">
            <a href="#schedule" class="btn btn-primary">📅 Schedule in <?php echo esc_html( $city_name_only ); ?></a>
            <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary" style="border-color:rgba(255,255,255,0.4);color:#e30000;">📞 <?php echo BRP_PHONE; ?></a>
        </div>
    </div>
</section>

<!-- CONTENT AREA -->
<div class="content-area">
    <div class="container">
        <div class="content-grid">

            <!-- Main content -->
            <div class="main-content">

                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:32px;">
                    <span class="badge badge-primary">✓ Serving <?php echo esc_html( $city_name_only ); ?></span>
                    <span class="badge badge-primary">✓ Same-Day Available</span>
                    <span class="badge badge-success">✓ 90-Day Warranty</span>
                </div>

                <div class="entry-content">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php if ( get_the_content() ) : the_content(); endif; ?>
                    <?php endwhile; endif; ?>

                    <!-- Default city content -->
                    <h2><?php echo BRP_BRAND; ?> Appliance Repair in <?php echo esc_html( $city_name_only ); ?>, <?php echo esc_html( $city_data['state'] ); ?></h2>
                    <p>When a <?php echo BRP_BRAND; ?> appliance breaks down in your <?php echo esc_html( $city_name_only ); ?> home, you need a local repair service that's fast, reliable, and uses genuine parts. Our <?php echo esc_html( $city_name_only ); ?>-based technicians specialize exclusively in <?php echo BRP_BRAND; ?> appliances and understand the specific models popular in this area.</p>

                    <p>We provide expert <?php echo BRP_BRAND; ?> appliance repair throughout <?php echo esc_html( $city_name_only ); ?> and all surrounding suburbs. Most repairs are completed on the first visit — we arrive with a fully stocked service vehicle so parts are almost always on hand.</p>

                    <h3>Bosch Appliances We Repair in <?php echo esc_html( $city_name_only ); ?></h3>
                    <div class="grid grid-2" style="margin:24px 0;">
                        <?php foreach ( $services as $s ) : ?>
                        <a href="<?php echo home_url( '/services/' . $s['slug'] . '/' ); ?>" style="display:flex;align-items:center;gap:10px;padding:12px 16px;background:var(--color-light);border-radius:8px;color:var(--color-secondary);text-decoration:none;font-weight:600;font-size:0.9rem;transition:all 0.2s;" onmouseover="this.style.background='var(--color-primary)';this.style.color='white';" onmouseout="this.style.background='var(--color-light)';this.style.color='var(--color-secondary)';">
                            <span><?php echo $s['icon']; ?></span>
                            <?php echo esc_html( $s['title'] ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>

                    <h3>Service Area: <?php echo esc_html( $city_name_only ); ?> & Suburbs</h3>
                    <p>We cover <?php echo esc_html( $city_name_only ); ?> city limits and all nearby suburbs. Our technicians are based locally and can typically arrive within a few hours of your call.</p>

                    <h4>Zip Codes We Serve</h4>
                    <p style="color:var(--color-gray);"><?php echo esc_html( $city_data['zip_codes'] ); ?> and surrounding areas.</p>

                    <h4>Suburbs We Cover</h4>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin:12px 0 24px;">
                        <?php foreach ( $suburbs_arr as $suburb ) : ?>
                        <span style="background:var(--color-light);border-radius:100px;padding:4px 12px;font-size:0.85rem;color:var(--color-secondary);"><?php echo esc_html( trim( $suburb ) ); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="notice notice-success">
                        <strong>📍 Serving <?php echo esc_html( $city_name_only ); ?>:</strong> Don't see your exact neighborhood or zip code? Call us at <?php echo BRP_PHONE; ?> and we'll confirm whether we can service your area.
                    </div>

                    <h3>Why <?php echo esc_html( $city_name_only ); ?> Homeowners Choose Us</h3>
                    <ul class="checklist">
                        <li>Local <?php echo esc_html( $city_name_only ); ?> technicians — fast arrival times</li>
                        <li>Factory-certified <?php echo BRP_BRAND; ?> parts for all models</li>
                        <li>Upfront pricing — no surprises on your invoice</li>
                        <li>Same-day and next-day appointments available</li>
                        <li>90-day labor warranty on all repairs</li>
                        <li>Background-checked, uniformed professionals</li>
                        <li>Evening and weekend availability</li>
                        <li>Hundreds of 5-star reviews from <?php echo esc_html( $city_name_only ); ?> customers</li>
                    </ul>
                </div>

                <!-- Other cities -->
                <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:32px;margin-top:48px;">
                    <h3 style="margin-bottom:16px;">🗺️ Other Cities We Service</h3>
                    <div style="display:flex;flex-wrap:wrap;gap:10px;">
                        <?php foreach ( $all_cities as $c ) :
                            if ( $c['slug'] === $city_slug ) continue; ?>
                        <a href="<?php echo home_url( '/cities/' . $c['slug'] . '/' ); ?>" class="btn btn-secondary btn-sm">
                            <?php echo esc_html( $c['title'] ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div><!-- /.main-content -->

            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">📞 <?php echo esc_html( $city_name_only ); ?> Service</div>
                    <div class="sidebar-phone">
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="sidebar-phone-number"><?php echo BRP_PHONE; ?></a>
                        <p>Mon–Sat 7am–8pm<br>Sun 9am–5pm</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call Now</a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Online</a>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">📍 Zip Codes We Cover</div>
                    <div class="sidebar-widget-body">
                        <p style="font-size:0.85rem;color:var(--color-gray);line-height:1.6;"><?php echo esc_html( $city_data['zip_codes'] ); ?></p>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">✅ Our Guarantees</div>
                    <div class="sidebar-widget-body">
                        <ul class="checklist" style="gap:8px;">
                            <li>Same-day availability</li>
                            <li>Factory-certified parts</li>
                            <li>90-day labor warranty</li>
                            <li>Upfront fixed pricing</li>
                            <li>On-time arrival</li>
                        </ul>
                    </div>
                </div>
            </aside>

        </div><!-- /.content-grid -->
    </div>
</div>

<!-- FAQ SECTION -->
<?php echo brp_faq_section( $city_faqs, 'Bosch Appliance Repair FAQ – ' . $city_name_only ); ?>

<!-- APPOINTMENT FORM -->
<?php echo brp_appointment_form( 'Schedule Bosch Repair in ' . $city_name_only ); ?>

<?php get_footer(); ?>
