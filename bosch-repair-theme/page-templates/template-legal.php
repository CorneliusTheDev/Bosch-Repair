<?php
/**
 * Template Name: Legal Page (Privacy / Terms / Mobile Terms)
 *
 * Used for Privacy Policy, Terms of Use, and Mobile Terms of Use pages.
 *
 * @package BoschRepairPro
 */
get_header(); ?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1><?php the_title(); ?></h1>
        <p>Last updated: <?php echo get_the_modified_date( 'F j, Y' ); ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="max-width:840px;margin:0 auto;">
            <div class="entry-content">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
