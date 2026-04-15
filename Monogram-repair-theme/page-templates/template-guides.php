<?php
/**
 * Template Name: Guides Hub
 *
 * Guides section landing page.
 * URL: /guides/
 *
 * @package MonogramRepairPro
 */
get_header();

$guide_categories = array(
    array( 'icon' => '🫧', 'label' => 'Washer Guides',       'slug' => 'washer' ),
    array( 'icon' => '🌀', 'label' => 'Dryer Guides',        'slug' => 'dryer' ),
    array( 'icon' => '🍽️', 'label' => 'Dishwasher Guides',   'slug' => 'dishwasher' ),
    array( 'icon' => '🧊', 'label' => 'Refrigerator Guides', 'slug' => 'refrigerator' ),
    array( 'icon' => '🔥', 'label' => 'Oven & Range Guides', 'slug' => 'oven' ),
    array( 'icon' => '♨️', 'label' => 'Cooktop Guides',      'slug' => 'cooktop' ),
);

// Sample built-in guides
$sample_guides = array(
    array(
        'title'    => 'Why Is My Monogram Dishwasher Not Draining? Complete Troubleshooting Guide',
        'slug'     => 'monogram-dishwasher-not-draining',
        'category' => 'Dishwasher',
        'excerpt'  => 'Step-by-step guide to diagnosing and fixing Monogram dishwasher drainage problems — from clogged filters to failed drain pumps.',
        'time'     => '8 min read',
    ),
    array(
        'title'    => 'How to Clean a Monogram Washing Machine: Complete Maintenance Guide',
        'slug'     => 'how-to-clean-monogram-washing-machine',
        'category' => 'Washer',
        'excerpt'  => 'Prevent mold, odors, and performance issues with our complete Monogram front-load washer cleaning and maintenance guide.',
        'time'     => '6 min read',
    ),
    array(
        'title'    => 'Monogram Refrigerator Leaking Water: 7 Common Causes and Fixes',
        'slug'     => 'monogram-refrigerator-leaking-water',
        'category' => 'Refrigerator',
        'excerpt'  => 'Find out why your Monogram refrigerator is leaking and how to fix it — from clogged defrost drains to faulty water inlet valves.',
        'time'     => '10 min read',
    ),
    array(
        'title'    => 'Monogram Oven Not Heating? Here\'s How to Diagnose the Problem',
        'slug'     => 'monogram-oven-not-heating',
        'category' => 'Oven',
        'excerpt'  => 'Learn the most common reasons a Monogram oven stops heating and how to determine if you need a new heating element, thermostat, or control board.',
        'time'     => '7 min read',
    ),
    array(
        'title'    => 'Monogram Dryer Not Drying Clothes: Causes and Solutions',
        'slug'     => 'monogram-dryer-not-drying',
        'category' => 'Dryer',
        'excerpt'  => 'When clothes come out damp, it\'s usually one of these 5 problems. This guide walks you through diagnosing and resolving each one.',
        'time'     => '9 min read',
    ),
    array(
        'title'    => 'How to Reset Your Monogram Appliance: Full Model Guide',
        'slug'     => 'how-to-reset-monogram-appliance',
        'category' => 'All Appliances',
        'excerpt'  => 'Reset procedures for Monogram washers, dryers, dishwashers, refrigerators, ovens, and cooktops — model-specific instructions included.',
        'time'     => '5 min read',
    ),
);

// DB guides
$db_guides = new WP_Query( array(
    'post_type'      => 'guide',
    'posts_per_page' => 12,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Monogram Appliance Repair Guides</h1>
        <p>Expert troubleshooting and maintenance guides written by our certified Monogram technicians. Find answers to common issues before calling for service.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <!-- Browse by appliance -->
        <div class="section-header text-center">
            <span class="section-label">Browse by Appliance</span>
            <h2 class="section-title">Select Your Appliance Type</h2>
        </div>
        <div class="grid grid-3" style="margin-bottom:64px;">
            <?php foreach ( $guide_categories as $cat ) : ?>
            <a href="<?php echo home_url( '/guides/' . $cat['slug'] . '/' ); ?>" class="card" style="text-decoration:none;color:inherit;text-align:center;">
                <div class="card-body">
                    <div style="font-size:2.5rem;margin-bottom:12px;"><?php echo $cat['icon']; ?></div>
                    <h3 style="font-size:1.05rem;"><?php echo esc_html( $cat['label'] ); ?></h3>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Featured guides -->
        <div class="section-header">
            <span class="section-label">Popular Guides</span>
            <h2 class="section-title">Most Read Repair Guides</h2>
        </div>
        <div class="grid grid-3" style="margin-bottom:48px;">
            <?php foreach ( $sample_guides as $guide ) : ?>
            <div class="guide-card">
                <span class="badge badge-primary" style="margin-bottom:12px;"><?php echo esc_html( $guide['category'] ); ?></span>
                <h3><a href="<?php echo home_url( '/guides/' . $guide['slug'] . '/' ); ?>" style="color:inherit;"><?php echo esc_html( $guide['title'] ); ?></a></h3>
                <p><?php echo esc_html( $guide['excerpt'] ); ?></p>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;">
                    <span style="font-size:0.8rem;color:var(--color-gray);">⏱ <?php echo esc_html( $guide['time'] ); ?></span>
                    <a href="<?php echo home_url( '/guides/' . $guide['slug'] . '/' ); ?>" style="font-size:0.9rem;font-weight:600;color:var(--color-primary);">Read →</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- DB guides -->
        <?php if ( $db_guides->have_posts() ) : ?>
        <div class="section-header">
            <h2 class="section-title">Latest Guides</h2>
        </div>
        <div class="grid grid-3">
            <?php while ( $db_guides->have_posts() ) : $db_guides->the_post(); ?>
            <div class="guide-card">
                <h3><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h3>
                <p><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" style="font-size:0.9rem;font-weight:600;color:var(--color-primary);">Read Guide →</a>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>

        <!-- CTA block -->
        <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:48px;text-align:center;margin-top:64px;">
            <h2 style="margin-bottom:12px;">Still Can't Fix It?</h2>
            <p style="color:var(--color-gray);max-width:500px;margin:0 auto 28px;">Our certified Monogram technicians are available same-day. If the guide didn't solve your problem, let us handle it professionally.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary btn-lg">📞 Call <?php echo BRP_PHONE; ?></a>
                <a href="#schedule" class="btn btn-secondary btn-lg">📅 Book Online</a>
            </div>
        </div>

    </div>
</section>

<?php echo brp_appointment_form(); ?>

<?php get_footer(); ?>
