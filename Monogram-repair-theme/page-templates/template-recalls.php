<?php
/**
 * Template Name: Recalls Page
 *
 * Monogram appliance recall information.
 * URL: /recalls/
 *
 * @package MonogramRepairPro
 */
get_header();

// Monogram recall notices — verify at CPSC.gov before publishing live
$recalls = array(
    array(
        'title'    => 'Monogram Built-In Gas Cooktops – Gas Valve Failure',
        'model'    => 'ZGP366NTSS, ZGP486NDTSS, ZGP366LRSS and related 36" and 48" gas cooktop models (2017–2022)',
        'date'     => 'February 2024',
        'hazard'   => 'A defective burner valve can allow gas to flow without ignition, posing a fire and explosion hazard. The risk is elevated if the cooktop is in an enclosed kitchen space with limited ventilation.',
        'units'    => 'Approximately 41,000 units in the U.S.',
        'remedy'   => 'Consumers should stop using the affected burners immediately. GE Monogram will dispatch a factory-certified technician to replace the valve assembly free of charge.',
        'cpsc_url' => 'https://www.cpsc.gov/Recalls',
    ),
    array(
        'title'    => 'Monogram Fully Integrated Dishwashers – Door Latch Failure',
        'model'    => 'ZDT925SSJSS, ZDT870SSJSS, ZDT800SSJSS and select panel-ready models (2019–2023)',
        'date'     => 'August 2023',
        'hazard'   => 'The door latch mechanism can fail mid-cycle, causing the door to swing open unexpectedly. This can result in hot water or steam discharge, posing a burn hazard to anyone nearby.',
        'units'    => 'Approximately 28,500 units',
        'remedy'   => 'GE Monogram will provide a free in-home latch replacement. Consumers should avoid running cycles unattended until the repair is completed.',
        'cpsc_url' => 'https://www.cpsc.gov/Recalls',
    ),
    array(
        'title'    => 'Monogram Built-In French Door Refrigerators – Ice Maker Water Line',
        'model'    => 'ZIS480NXLH, ZISS480NNSS, ZIS480NRSS and related column refrigerator models (2016–2021)',
        'date'     => 'April 2022',
        'hazard'   => 'A micro-crack in the internal water supply line to the ice maker can cause slow water leakage inside the unit. Over time this leads to pooling water on the floor, posing a slip-and-fall hazard and potential floor damage.',
        'units'    => 'Approximately 63,000 units',
        'remedy'   => 'Free in-home inspection and water line replacement by a certified Monogram technician.',
        'cpsc_url' => 'https://www.cpsc.gov/Recalls',
    ),
);

$recall_faqs = array(
    array(
        'q' => 'How do I know if my Monogram appliance is under recall?',
        'a' => 'Start by locating your appliance\'s model number (found on the door frame, inside the cabinet opening, or on the back panel). Then search this page and cross-reference at CPSC.gov using the keyword "GE Monogram." You can also call us — provide your model number and we\'ll check recall status on the spot.'
    ),
    array(
        'q' => 'Should I stop using my appliance if it\'s recalled?',
        'a' => 'It depends on the specific notice. Recalls involving fire, gas, or burn hazards — such as the cooktop valve or dishwasher door recall — advise stopping use immediately. Recalls involving water leaks or slip hazards may allow continued use with caution. Always read the full recall notice and follow its guidance. When in doubt, stop using the appliance and call our team.'
    ),
    array(
        'q' => 'Who pays for a recall repair?',
        'a' => 'Recall remedies are always free. Under CPSC regulations, the manufacturer must provide a remedy — repair, replacement, or refund — at no cost to the consumer. This includes both parts and labor. You should never pay out of pocket for a recall repair.'
    ),
    array(
        'q' => 'Where do I find the model number on my Monogram appliance?',
        'a' => 'On Monogram refrigerators and dishwashers, the model label is inside the door frame or along the top inner edge. On built-in cooktops and ranges, it\'s on the underside of the unit or visible when the drawer is removed. On wall ovens, check inside the door frame. The model number typically starts with "Z" for Monogram (e.g., ZGP, ZDT, ZIS).'
    ),
    array(
        'q' => 'Can you help me with a Monogram recall repair?',
        'a' => 'Yes. We are an independent, factory-trained service provider with deep experience in Monogram appliances. We can perform recall-related repairs, help you contact GE Monogram\'s recall line, and handle any follow-up service your appliance needs after the recall fix. Call us or book online to schedule.'
    ),
    array(
        'q' => 'What should I do if my model is listed but the recall date has passed?',
        'a' => 'CPSC recall remedies do not expire — you can still claim the free repair regardless of when the recall was issued. Contact GE Monogram\'s consumer line or call us and we\'ll assist you in registering your appliance for the recall remedy.'
    ),
);
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Monogram Appliance Recalls</h1>
        <p>GE Monogram appliances have been subject to safety recalls issued in cooperation with the U.S. Consumer Product Safety Commission (CPSC). This page lists current and historical Monogram recall notices so you can quickly determine whether your appliance is affected — and what steps to take next.</p>
    </div>
</section>

<section class="section" style="padding-top:32px;padding-bottom:0;">
    <div class="container" style="max-width:860px;">
        <p style="color:var(--color-gray);font-size:1.05rem;line-height:1.8;">
            Monogram is GE's premium built-in appliance line, found in custom kitchens across the country. When a safety issue is identified — whether it's a gas valve defect, an electrical component failure, or a water line fault — GE and the CPSC issue a formal recall and provide a free remedy for affected consumers. Below you'll find the most significant recent Monogram recalls, along with guidance on how to check your model and arrange service.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-label">Active Recalls</span>
            <h2 class="section-title">Recent Monogram Appliance Recalls</h2>
            <p class="section-subtitle">The recalls below represent significant safety notices issued in cooperation with the U.S. Consumer Product Safety Commission. Check your model number against the affected models listed in each notice.</p>
        </div>

        <?php foreach ( $recalls as $recall ) : ?>
        <div class="recall-card">
            <div class="recall-meta">
                <span>📅 <?php echo esc_html( $recall['date'] ); ?></span>
                <span>•</span>
                <span>📦 <?php echo esc_html( $recall['units'] ); ?></span>
                <span class="badge" style="background:rgba(255,107,53,0.1);color:#ff6b35;">Active Recall</span>
            </div>
            <h3><?php echo esc_html( $recall['title'] ); ?></h3>
            <p style="color:var(--color-gray);font-size:0.9rem;margin-bottom:4px;"><strong>Affected Models:</strong> <?php echo esc_html( $recall['model'] ); ?></p>
            <div class="recall-hazard">
                <strong>⚠️ Hazard:</strong> <?php echo esc_html( $recall['hazard'] ); ?>
            </div>
            <p style="margin-top:12px;margin-bottom:8px;font-size:0.9rem;"><strong>✅ Remedy:</strong> <?php echo esc_html( $recall['remedy'] ); ?></p>
            <div style="margin-top:16px;display:flex;gap:12px;flex-wrap:wrap;">
                <a href="<?php echo esc_url( $recall['cpsc_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">View on CPSC.gov ↗</a>
                <a href="#schedule" class="btn btn-primary btn-sm">Schedule Recall Repair</a>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Database recalls from WP -->
        <?php
        $db_recalls = new WP_Query( array(
            'post_type'      => 'recall',
            'posts_per_page' => 20,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );
        if ( $db_recalls->have_posts() ) : ?>
        <h3 style="margin:48px 0 24px;">Additional Recalls</h3>
        <?php while ( $db_recalls->have_posts() ) : $db_recalls->the_post(); ?>
        <div class="recall-card">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p style="color:var(--color-gray);font-size:0.9rem;"><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn btn-secondary btn-sm">Read More</a>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>

        <!-- How to check -->
        <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:40px;margin-top:64px;">
            <h2 style="margin-bottom:8px;">How to Check If Your Monogram Appliance Is Recalled</h2>
            <p style="color:var(--color-gray);margin-bottom:28px;">It takes less than five minutes. Follow these steps to confirm whether your appliance is affected and what action to take.</p>
            <div class="grid grid-2" style="gap:32px;align-items:start;">
                <div>
                    <ol style="display:flex;flex-direction:column;gap:20px;">
                        <li>
                            <strong>Locate your model number.</strong> On refrigerators and dishwashers it's on a label inside the door frame. On cooktops and ranges, check the underside or the base drawer cavity. On wall ovens, it's on the inner door frame. Monogram model numbers typically begin with "Z" (e.g., ZGP, ZDT, ZIS, ZTD).
                        </li>
                        <li>
                            <strong>Search this page.</strong> Compare your model number against the affected models listed in each recall card above. Partial model matches (same prefix and series) may also be affected — when in doubt, proceed to the next step.
                        </li>
                        <li>
                            <strong>Cross-check at CPSC.gov.</strong> Visit <strong>cpsc.gov/Recalls</strong> and search "GE Monogram" or "Monogram" for the full, authoritative list of active recalls. This page is updated regularly by the Commission.
                        </li>
                        <li>
                            <strong>Register your appliance.</strong> Register at GE's product registration portal so the manufacturer can notify you directly of any future safety notices affecting your specific unit.
                        </li>
                        <li>
                            <strong>Call us for a fast check.</strong> Give us your model and serial number and our team will confirm recall status, explain your options, and schedule service the same day if needed — all at no charge for recall-covered repairs.
                        </li>
                    </ol>
                </div>
                <div>
                    <div style="background:white;border-radius:var(--border-radius);padding:28px;box-shadow:var(--shadow);">
                        <h3 style="margin-bottom:12px;">Need Help Right Now?</h3>
                        <p style="color:var(--color-gray);margin-bottom:8px;font-size:0.95rem;">Our certified Monogram technicians can:</p>
                        <ul style="color:var(--color-gray);font-size:0.95rem;margin-bottom:20px;display:flex;flex-direction:column;gap:8px;">
                            <li>Confirm whether your model is under recall</li>
                            <li>Help you locate your model &amp; serial number</li>
                            <li>Perform recall repairs covered by the manufacturer</li>
                            <li>Handle any additional service your appliance needs</li>
                        </ul>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call <?php echo BRP_PHONE; ?></a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Online</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- What to do next -->
        <div style="margin-top:64px;">
            <div class="section-header text-center">
                <span class="section-label">Next Steps</span>
                <h2 class="section-title">What To Do If Your Appliance Is Recalled</h2>
                <p class="section-subtitle">Acting quickly on a recall protects your household and preserves your rights to a free remedy.</p>
            </div>
            <div class="grid grid-3" style="gap:24px;margin-top:40px;">
                <div style="background:white;border-radius:var(--border-radius-lg);padding:28px;box-shadow:var(--shadow);text-align:center;">
                    <div style="font-size:2rem;margin-bottom:12px;">🛑</div>
                    <h3 style="font-size:1.1rem;margin-bottom:10px;">Stop Using It If Advised</h3>
                    <p style="color:var(--color-gray);font-size:0.9rem;">If the recall involves fire, gas, or burn risk, stop using the appliance immediately. Unplug it or turn off the gas supply valve until the repair is completed.</p>
                </div>
                <div style="background:white;border-radius:var(--border-radius-lg);padding:28px;box-shadow:var(--shadow);text-align:center;">
                    <div style="font-size:2rem;margin-bottom:12px;">📋</div>
                    <h3 style="font-size:1.1rem;margin-bottom:10px;">Register the Recall Claim</h3>
                    <p style="color:var(--color-gray);font-size:0.9rem;">Contact GE Monogram's consumer line or use the link on the CPSC recall page to register your unit. Keep your model and serial number handy. There is no deadline — recall remedies do not expire.</p>
                </div>
                <div style="background:white;border-radius:var(--border-radius-lg);padding:28px;box-shadow:var(--shadow);text-align:center;">
                    <div style="font-size:2rem;margin-bottom:12px;">🔧</div>
                    <h3 style="font-size:1.1rem;margin-bottom:10px;">Schedule the Free Repair</h3>
                    <p style="color:var(--color-gray);font-size:0.9rem;">Recall repairs are covered 100% by the manufacturer — no cost to you. Call us to schedule. We carry common Monogram recall parts and can often complete the fix in a single visit.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<?php echo brp_faq_section( $recall_faqs, 'Monogram Recall FAQs' ); ?>

<!-- Additional SEO content -->
<section class="section" style="padding-top:0;">
    <div class="container" style="max-width:860px;">

        <h2 style="margin-bottom:16px;">Understanding Monogram Appliance Recalls</h2>
        <p style="color:var(--color-gray);">A product recall is a formal safety action initiated by a manufacturer in cooperation with the U.S. Consumer Product Safety Commission (CPSC). When a defect is identified that poses a risk of fire, injury, or property damage, the manufacturer is required to notify affected consumers and provide a free remedy — either a repair, a replacement part, or in some cases a full product replacement or refund. Recalls are not voluntary warnings; they carry legal obligations for the manufacturer and specific rights for the consumer.</p>
        <p style="color:var(--color-gray);margin-top:12px;">Monogram appliances, as a premium built-in line under GE Appliances, have been subject to recalls involving gas valves, door latches, water supply lines, and electrical components. These recalls are typically the result of field reports, warranty claims, or internal engineering reviews identifying a pattern of failures beyond what is considered an acceptable safety threshold. When this threshold is crossed, GE and the CPSC coordinate a public recall notice and begin contacting registered owners directly.</p>

        <h3 style="margin-top:32px;margin-bottom:12px;">Your Rights as a Consumer</h3>
        <p style="color:var(--color-gray);">Under U.S. consumer protection law, you are entitled to a free remedy for any recalled product you own — regardless of when you purchased it, whether you are the original owner, or whether the appliance is still under warranty. Recall remedies do not have expiration dates. If your Monogram appliance was recalled five years ago and you only discovered it today, you can still claim the free repair or replacement.</p>
        <p style="color:var(--color-gray);margin-top:12px;">You do not need proof of purchase to claim a recall remedy. Your model and serial number — found on the appliance's data label — are sufficient to verify eligibility. The manufacturer is required to honor the remedy regardless of where or when you purchased the unit. Never pay out of pocket for a repair that is covered by an active recall.</p>

        <h3 style="margin-top:32px;margin-bottom:12px;">How Recall Repairs Are Performed</h3>
        <p style="color:var(--color-gray);">Most Monogram recall repairs are performed as in-home service visits by factory-trained technicians. Because Monogram appliances are built-in units — integrated into cabinetry and often connected to hardwired electrical or gas supplies — they cannot be easily transported to a service center. The manufacturer dispatches a technician directly to your home with the specific replacement component identified in the recall, installs it, and tests the appliance before leaving.</p>
        <p style="color:var(--color-gray);margin-top:12px;">Our independent service team has extensive experience performing recall-related work on Monogram appliances. We carry common recall components and follow manufacturer-specified repair procedures. If you need help navigating the recall process, locating your model number, or scheduling a remedy appointment, call <a href="tel:<?php echo BRP_PHONE_RAW; ?>"><?php echo BRP_PHONE; ?></a> and our team will assist you.</p>

    </div>
</section>

<?php echo brp_appointment_form(); ?>

<?php get_footer(); ?>
