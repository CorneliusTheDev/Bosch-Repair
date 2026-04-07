<?php
/**
 * Template Name: Recalls Page
 *
 * Bosch appliance recall information.
 * URL: /recalls/
 *
 * @package BoschRepairPro
 */
get_header();

// Sample recalls data (admin should update from CPSC.gov)
$recalls = array(
    array(
        'title'    => 'Bosch Dishwashers with Plastic Door Latch',
        'model'    => 'SHPM88Z75N, SHP78CM5N, and related models (2015–2019)',
        'date'     => 'January 2024',
        'hazard'   => 'The door latch can break, posing a risk of the door opening during operation, which may result in water leakage and potential burns.',
        'units'    => 'Approximately 149,000 units in the U.S.',
        'remedy'   => 'Free repair — technicians will replace the door latch at no charge.',
        'cpsc_url' => 'https://www.cpsc.gov/Recalls',
    ),
    array(
        'title'    => 'Bosch Heat Pump Dryers – Potential Overheating',
        'model'    => 'WTW87NH1UC and related heat pump dryer models (2018–2020)',
        'date'     => 'March 2023',
        'hazard'   => 'An electrical component can overheat, posing a fire hazard.',
        'units'    => 'Approximately 37,000 units',
        'remedy'   => 'Consumers should stop using the dryer immediately and contact Bosch for a free in-home repair.',
        'cpsc_url' => 'https://www.cpsc.gov/Recalls',
    ),
    array(
        'title'    => 'Bosch Refrigerators – Defrost System Issue',
        'model'    => 'B36CT80SNS, B36CL80SNS and related models',
        'date'     => 'September 2022',
        'hazard'   => 'A defective defrost thermostat can cause excessive ice buildup, potentially leading to water leakage onto the floor and a slip hazard.',
        'units'    => 'Approximately 58,000 units',
        'remedy'   => 'Free inspection and repair of the defrost thermostat system.',
        'cpsc_url' => 'https://www.cpsc.gov/Recalls',
    ),
);

$recall_faqs = array(
    array(
        'q' => 'How do I know if my Bosch appliance has a recall?',
        'a' => 'Check the recall list on this page or visit CPSC.gov and search for "Bosch." You can also call our service line and provide your model number — we\'ll check recall status for you.'
    ),
    array(
        'q' => 'Is a recalled appliance dangerous to use?',
        'a' => 'It depends on the recall. Some recalls involve fire or injury hazards that require you to stop using the appliance immediately. Others are less urgent. Always read the recall notice carefully. When in doubt, stop using the appliance and call us.'
    ),
    array(
        'q' => 'Who pays for repairs on recalled Bosch appliances?',
        'a' => 'Recall repairs are always free of charge. The manufacturer is required to remedy the defect at no cost to you — including parts and labor.'
    ),
    array(
        'q' => 'Where do I find my Bosch model number?',
        'a' => 'The model number is typically on a label inside the door frame (dishwashers, fridges), inside the drum opening (washers/dryers), or on the back panel. It usually starts with letters followed by numbers.'
    ),
    array(
        'q' => 'Can you help me with a Bosch recall repair?',
        'a' => 'Yes. While we are an independent service (not affiliated with Bosch), we are experienced in all recall-related repairs. We can also help you contact the manufacturer for warranty-covered recall service.'
    ),
);
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Bosch Appliance Recalls</h1>
        <p>Stay informed about Bosch appliance safety recalls. Check if your appliance is affected and learn what action to take.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="notice notice-warning" style="max-width:800px;margin:0 auto 48px;">
            <strong>⚠️ Safety Notice:</strong> This page is maintained for informational purposes. For the most current and complete recall information, always verify at <strong>CPSC.gov</strong> or <strong>SaferProducts.gov</strong>. If your appliance is under recall, stop using it immediately if the notice advises it.
        </div>

        <div class="section-header text-center">
            <span class="section-label">Active Recalls</span>
            <h2 class="section-title">Recent Bosch Appliance Recalls</h2>
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
            <h2 style="margin-bottom:16px;">How to Check If Your Bosch Appliance Is Recalled</h2>
            <div class="grid grid-2" style="gap:32px;align-items:start;">
                <div>
                    <ol style="display:flex;flex-direction:column;gap:16px;">
                        <li><strong>Find your model number</strong> — it's on a label inside the door frame, drum, or back of the unit.</li>
                        <li><strong>Search this page</strong> for your model in the recalls listed above.</li>
                        <li><strong>Visit CPSC.gov</strong> and search "Bosch" for the most up-to-date list.</li>
                        <li><strong>Register your appliance</strong> with Bosch so they can notify you of future recalls.</li>
                        <li><strong>Call us</strong> — give us your model number and we'll help check recall status.</li>
                    </ol>
                </div>
                <div>
                    <div style="background:white;border-radius:var(--border-radius);padding:24px;box-shadow:var(--shadow);">
                        <h3 style="margin-bottom:16px;">📞 Need Help?</h3>
                        <p style="color:var(--color-gray);margin-bottom:20px;">Our team can help you identify your model number, check recall status, and arrange same-day service when needed.</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call <?php echo BRP_PHONE; ?></a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Online</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php echo brp_faq_section( $recall_faqs, 'Bosch Recall FAQs' ); ?>

<?php echo brp_appointment_form(); ?>

<?php get_footer(); ?>
