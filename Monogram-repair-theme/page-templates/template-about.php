<?php
/**
 * Template Name: About Us Page
 *
 * @package MonogramRepairPro
 */
get_header(); ?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>About Monogram Repair Pro</h1>
        <p>We are an independent, factory-trained appliance repair service specializing in Monogram products. Serving homeowners across the U.S. with honest, reliable, and professional service.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div style="margin-bottom:40px;">
            <span class="section-label">Our Story</span>
            <h2 class="section-title">Built on a Simple Promise: Fix It Right the First Time</h2>
            <p>Monogram Repair Pro was founded with one goal in mind — to provide homeowners with a repair service they can trust. We specialize exclusively in Monogram appliances, which means our technicians know these machines inside and out.</p>
            <p>Over the years, we've completed thousands of successful repairs across 6 major metropolitan areas. Every repair is backed by our 90-day labor warranty because we stand behind our work.</p>
            <p>We are not affiliated with or endorsed by Monogram (GE Appliances Corporation), but we are experts in their products — and that's what matters most to our customers.</p>

            <h3 style="margin-top:32px;margin-bottom:12px;">Our Technicians</h3>
            <p>Every technician on our team undergoes rigorous factory-level training specific to Monogram appliances. We don't send generalists — we send specialists. Our technicians arrive at your home with a fully stocked service vehicle carrying the most common Monogram replacement parts, so most repairs are completed in a single visit. Continuous education keeps our team up to date on every new Monogram model, from connected smart appliances to built-in column refrigerators and professional ranges.</p>

            <h3 style="margin-top:32px;margin-bottom:12px;">Where We Serve</h3>
            <p>We currently provide Monogram appliance repair in 6 major U.S. metropolitan areas and their surrounding suburbs. Whether you're in the heart of the city or in a surrounding community, our technicians are available for same-day and next-day service appointments. We understand that a broken refrigerator, dishwasher, or range disrupts your entire household — that's why fast response time is a core part of how we operate.</p>

            <h3 style="margin-top:32px;margin-bottom:12px;">Why Choose a Monogram Specialist?</h3>
            <p>Monogram appliances are engineered to precise tolerances and require OEM parts to perform as designed. A general appliance technician working from a generic manual cannot deliver the same quality of repair as a technician who works exclusively on these products. We stock genuine, factory-certified Monogram parts and follow manufacturer repair procedures on every job — ensuring your appliance returns to factory performance and your warranty remains intact.</p>
        </div>
        <div style="border-radius:var(--border-radius-lg);overflow:hidden;line-height:0;margin-bottom:80px;">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/kitchen.jpg' ); ?>"
                 alt="Modern kitchen with Monogram appliances"
                 style="width:100%;height:340px;object-fit:cover;display:block;"
                 loading="lazy">
        </div>

        <!-- Values -->
        <div class="section-header text-center">
            <span class="section-label">Our Values</span>
            <h2 class="section-title">What Sets Us Apart</h2>
        </div>
        <div class="grid grid-3" style="margin-bottom:80px;">
            <div class="feature-item" style="flex-direction:column;align-items:stretch;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <div class="feature-icon" style="margin:0 auto 16px;">🔧</div>
                <h4 style="text-align:center;">Factory-Certified Parts</h4>
                <p style="color:var(--color-gray);margin:0;">We use only genuine, factory-certified Monogram replacement parts. No aftermarket shortcuts that compromise your appliance's performance.</p>
            </div>
            <div class="feature-item" style="flex-direction:column;align-items:stretch;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <div class="feature-icon" style="margin:0 auto 16px;">🎓</div>
                <h4 style="text-align:center;">Highly Trained Technicians</h4>
                <p style="color:var(--color-gray);margin:0;">Our technicians are factory-trained professionals with continuous education on new Monogram models, technologies, and repair procedures.</p>
            </div>
            <div class="feature-item" style="flex-direction:column;align-items:stretch;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <div class="feature-icon" style="margin:0 auto 16px;">🛡️</div>
                <h4 style="text-align:center;">Honest & Transparent</h4>
                <p style="color:var(--color-gray);margin:0;">We provide upfront quotes before any work begins. No surprise fees. If we can't fix it, you don't pay a repair charge.</p>
            </div>
        </div>

        <!-- Service commitment -->
        <div style="background:var(--color-secondary);color:white;border-radius:var(--border-radius-lg);padding:60px;text-align:center;">
            <h2 style="color:white;margin-bottom:16px;">Our Service Commitment</h2>
            <p style="color:rgba(255,255,255,0.8);max-width:600px;margin:0 auto 32px;">Every Monogram appliance repair we perform is done with integrity, expertise, and respect for your home and your time. We guarantee your satisfaction.</p>
            <a href="#schedule" class="btn btn-primary btn-lg" style="margin-right:16px;">📅 Book a Repair</a>
            <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary btn-lg" style="background:#fff;border-color:#fff;color:var(--color-primary);">📞 <?php echo BRP_PHONE; ?></a>
        </div>

    </div>
</section>

<?php echo brp_appointment_form( 'Ready to Schedule Your Monogram Repair?' ); ?>

<?php get_footer(); ?>
