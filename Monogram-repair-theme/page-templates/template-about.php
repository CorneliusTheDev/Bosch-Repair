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
        <p>We were trained on the Monogram line from the inside — then built this company because we saw what happened to homeowners once GE stopped showing up.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div style="border-radius:var(--border-radius-lg);overflow:hidden;line-height:0;margin-bottom:48px;">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/kitchen.jpg' ); ?>"
                 alt="Modern kitchen with Monogram appliances"
                 style="width:100%;height:340px;object-fit:cover;display:block;"
                 loading="lazy">
        </div>

        <div style="margin-bottom:40px;">
            <span class="section-label">Our Story</span>
            <h2 class="section-title">We Left the Factory Side So We Could Actually Help You</h2>
            <p>In 2013, our founder walked away from an eleven-year career as a GE field service engineer — specifically on the Monogram line. The departure wasn't about the work itself. It was about a pattern he kept seeing: the moment a customer's warranty expired, factory service became slow, expensive, and increasingly hard to reach. Meanwhile, independent shops weren't trained on built-in column refrigerators, integrated dishwashers, or 48-inch professional gas ranges. A homeowner with $20,000 worth of Monogram appliances had essentially no good options.</p>
            <p>Monogram Repair Pro was founded to close that gap — not as a general appliance company that added Monogram to its list, but as a shop that went all-in on a single brand. That meant building a hiring pipeline specifically for technicians with Monogram field history, stocking every vehicle based on what these appliances actually fail at (not a generic suggested parts list), and turning down work on other brands rather than diluting what we do well. Twelve years and more than 12,000 completed Monogram repairs later, that focus is the reason our first-visit completion rate sits above 96%.</p>
            <p>We are not affiliated with GE Appliances or authorized by Monogram. That independence is intentional. It means the only metric we're optimizing for is whether your appliance works when we leave — not whether the call fits inside a warranty program, a service contract, or a manufacturer's deprioritized queue.</p>

            <h3 style="margin-top:40px;margin-bottom:12px;">How We Hire</h3>
            <p>Most repair companies hire general appliance technicians and train them across brands. We hire differently. Every technician we bring on already has a minimum of five years of Monogram-specific experience before their first job with us — they've seen the sealed system configurations, the control board architectures, and the failure patterns unique to this line. We add 40 hours of hands-on technical training per year after that — not online modules, but actual component work on the specific assemblies Monogram uses in current production.</p>
            <p>The result is a team where even the newest technician has encountered your exact failure mode dozens of times. That's not a marketing line. It's why we carry the right parts, make the right diagnosis on the first look, and close most calls without a return visit.</p>

            <h3 style="margin-top:40px;margin-bottom:12px;">Six Cities, All Local</h3>
            <p>We operate in Chicago, Houston, Los Angeles, Miami, New York, and San Francisco. In every market, our technicians live in the metro area — they're not driving in from a regional hub. That's the difference between advertising same-day service and actually delivering it. If you're in a suburb that isn't on our cities page, call anyway. Our real coverage extends further than what we publish.</p>

            <h3 style="margin-top:40px;margin-bottom:12px;">Why Monogram Is Not Like Other GE Products</h3>
            <p>Monogram appliances share a name with GE but not their components. They're built to different tolerances, use different sealed-system configurations, and require replacement parts that are not interchangeable with standard GE equivalents. A thermistor calibrated for a regular GE refrigerator that reads two degrees off won't throw an error — but it will cause your compressor to cycle longer, raise your energy bill, and shorten the unit's life. An aftermarket gas igniter at the wrong resistance will glow and appear to function — but will never open the valve.</p>
            <p>These aren't unusual edge cases. They're the calls we receive after a general repair service has already been to the house. We carry factory-certified Monogram parts on every vehicle because any other approach isn't a real repair — it's a delay with a receipt attached.</p>
        </div>

        <!-- Values -->
        <div class="section-header text-center">
            <span class="section-label">How We Work</span>
            <h2 class="section-title">Three Commitments That Apply to Every Job</h2>
        </div>
        <div class="grid grid-3" style="margin-bottom:80px;">
            <div class="feature-item" style="flex-direction:column;align-items:stretch;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <h4 style="text-align:center;">Factory Parts. Every Time.</h4>
                <p style="color:var(--color-gray);margin:0;">We install factory-certified components rated to your specific Monogram model — not the closest available substitute. Aftermarket parts can pass a bench test and fail at spec six weeks later. We don't take that risk with your appliance.</p>
            </div>
            <div class="feature-item" style="flex-direction:column;align-items:stretch;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <h4 style="text-align:center;">Specialists, Not Generalists</h4>
                <p style="color:var(--color-gray);margin:0;">Our technicians average six-plus years on the Monogram line before joining us. When they diagnose your appliance, they're pulling from a catalog of failures they've seen before — not working through a generic checklist that applies to every brand.</p>
            </div>
            <div class="feature-item" style="flex-direction:column;align-items:stretch;text-align:center;padding:32px;background:var(--color-light);border-radius:var(--border-radius-lg);">
                <h4 style="text-align:center;">One Price, Before We Start</h4>
                <p style="color:var(--color-gray);margin:0;">We give you a complete quote — parts and labor together — before anything is opened or touched. If we can't fix it, you don't pay a repair fee. No escalating estimates. No pressure approvals mid-job.</p>
            </div>
        </div>

        <!-- Service commitment -->
        <div style="background:#3d1a08;color:white;border-radius:var(--border-radius-lg);padding:60px;text-align:center;">
            <h2 style="color:white;margin-bottom:16px;">What We Stand Behind</h2>
            <p style="color:rgba(255,255,255,0.8);max-width:640px;margin:0 auto 32px;">A fixed quote before we touch anything. Genuine Monogram parts on every repair. A 30-day labor warranty — same fault returns within 30 days, we come back at no charge. If we can't fix it, you pay nothing for the repair. That is the complete agreement. No fine print, no exceptions.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                <a href="#schedule" class="btn btn-primary btn-lg">Book a Repair</a>
                <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary btn-lg" style="background:#fff;border-color:#fff;color:var(--color-primary);"><?php echo BRP_PHONE; ?></a>
            </div>
        </div>

    </div>
</section>

<?php echo brp_appointment_form( 'Ready to Schedule Your Monogram Repair?' ); ?>

<?php get_footer(); ?>
