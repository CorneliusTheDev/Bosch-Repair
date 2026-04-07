<?php
/**
 * Default page template.
 *
 * @package BoschRepairPro
 */
get_header(); ?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php endwhile; endif; rewind_posts(); ?>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="max-width:900px;margin:0 auto;">
            <div class="entry-content">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</section>

<?php echo brp_appointment_form(); ?>
<?php get_footer(); ?>
