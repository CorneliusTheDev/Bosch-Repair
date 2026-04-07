<?php
/**
 * Main index template — fallback for all views.
 *
 * @package BoschRepairPro
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1><?php
            if ( is_post_type_archive() ) post_type_archive_title();
            elseif ( is_category() ) single_cat_title();
            elseif ( is_tag() ) single_tag_title();
            elseif ( is_tax() ) single_term_title();
            elseif ( is_search() ) echo 'Search Results for: ' . get_search_query();
            elseif ( is_404() ) echo 'Page Not Found';
            else the_title();
        ?></h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
        <div class="grid grid-3">
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="card">
                <?php if ( has_post_thumbnail() ) : ?>
                <div style="height:200px;overflow:hidden;">
                    <?php the_post_thumbnail( 'brp-card', array( 'style' => 'width:100%;height:100%;object-fit:cover;' ) ); ?>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <h3 style="font-size:1.05rem;margin-bottom:8px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p style="color:var(--color-gray);font-size:0.875rem;"><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Read More</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php the_posts_pagination(); ?>
        <?php else : ?>
        <div style="text-align:center;padding:80px 20px;">
            <div style="font-size:4rem;margin-bottom:16px;">🔍</div>
            <h2>Nothing Found</h2>
            <p style="color:var(--color-gray);margin-bottom:24px;">We couldn't find what you were looking for. Try a different search or browse our services below.</p>
            <a href="<?php echo home_url(); ?>" class="btn btn-primary">← Back to Home</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php echo brp_appointment_form(); ?>
<?php get_footer(); ?>
