<?php
/**
 * Template Name: About Us Page
 *
 * @package BoschRepairPro
 */
get_header(); ?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>About Bosch Repair Pro</h1>
        <p>We are an independent, factory-trained appliance repair service specializing in Bosch products. Serving homeowners across the U.S. with honest, reliable, and professional service.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="grid grid-2" style="gap:64px;align-items:center;margin-bottom:80px;">
            <div>
                <span class="section-label">Our Story</span>
                <h2 class="section-title">Built on a Simple Promise: Fix It Right the First Time</h2>
                <p>Bosch Repair Pro was founded with one goal in mind — to provide homeowners with a repair service they can trust. We specialize exclusively in Bosch appliances, which means our technicians know these machines inside and out.</p>
                <p>Over the years, we've completed thousands of successful repairs across 6 major metropolitan areas. Every repair is backed by our 90-day labor warranty because we stand behind our work.</p>
                <p>We are not affiliated with or endorsed by Bosch (BSH Home Appliances Corporation), but we are experts in their products — and that's what matters most to our customers.</p>
            </div>
            <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:40px;">
                <div class="grid grid-2" style="gap:24px;">
                    <div style="text-align:center;padding:24px;background:white;border-radius:var(--border-radius);box-shadow:var(--shadow);">
                        <div style="font-size:2.5rem;font-weight:800;color:var(--color-primary);">15k+</div>
                        <div style="font-size:0.85rem;color:var(--color-gray);margin-top:4px;">Repairs Completed</div>
                    </div>
                    <div style="text-align:center;padding:24px;background:white;border-radius:var(--border-radius);box-shadow:var(--shadow);">
                        <div style="font-size:2.5rem;font-weight:800;color:var(--color-primary);">6</div>
                        <div style="font-size:0.85rem;color:var(--color-gray);margin-top:4px;">Major Cities</div>
                    </div>
                    <div style="text-align:center;padding:24px;background:white;border-radius:var(--border-radius);box-shadow:var(--shadow);">
                        <div style="font-size:2.5rem;font-weight:800;color:var(--color-primary);">4.9★</div>
                        <div style="font-size:0.85rem;color:var(--color-gray);margin-top:4px;">Average Rating</div>
                    </div>
                    <div style="text-align:center;padding:24px;background:white;border-radius:var(--border-radius);box-shadow:var(--shadow);">
                        <div style="font-size:2.5rem;font-weight:800;color:var(--color-primary);">90-day</div>
                        <div style="font-size:0.85rem;color:var(--color-gray);margin-top:4px;">Labor Warranty</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="section-header text-center">
            <span class="section-label">Our Values</span>
            <h2 class="section-title">What Sets Us Apart</h2>
        </div>
        <div class="grid grid-3" style="margin-bottom:80px;">
            <div class="feature-item" style="flex-direction:column;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <div class="feature-icon" style="margin:0 auto 16px;">🔧</div>
                <h4>Factory-Certified Parts</h4>
                <p style="color:var(--color-gray);margin:0;">We use only genuine, factory-certified Bosch replacement parts. No aftermarket shortcuts that compromise your appliance's performance.</p>
            </div>
            <div class="feature-item" style="flex-direction:column;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <div class="feature-icon" style="margin:0 auto 16px;">🎓</div>
                <h4>Highly Trained Technicians</h4>
                <p style="color:var(--color-gray);margin:0;">Our technicians are factory-trained professionals with continuous education on new Bosch models, technologies, and repair procedures.</p>
            </div>
            <div class="feature-item" style="flex-direction:column;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <div class="feature-icon" style="margin:0 auto 16px;">🛡️</div>
                <h4>Honest & Transparent</h4>
                <p style="color:var(--color-gray);margin:0;">We provide upfront quotes before any work begins. No surprise fees. If we can't fix it, you don't pay a repair charge.</p>
            </div>
        </div>

        <!-- Service commitment -->
        <div style="background:var(--color-secondary);color:white;border-radius:var(--border-radius-lg);padding:60px;text-align:center;">
            <h2 style="color:white;margin-bottom:16px;">Our Service Commitment</h2>
            <p style="color:rgba(255,255,255,0.8);max-width:600px;margin:0 auto 32px;">Every Bosch appliance repair we perform is done with integrity, expertise, and respect for your home and your time. We guarantee your satisfaction.</p>
            <a href="#schedule" class="btn btn-primary btn-lg" style="margin-right:16px;">📅 Book a Repair</a>
            <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary btn-lg" style="border-color:rgba(255,255,255,0.4);color:white;">📞 <?php echo BRP_PHONE; ?></a>
        </div>

    </div>
</section>

<?php echo brp_appointment_form( 'Ready to Schedule Your Bosch Repair?' ); ?>

<?php get_footer(); ?>
