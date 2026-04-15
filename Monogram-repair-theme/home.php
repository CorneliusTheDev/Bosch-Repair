<?php
/**
 * Blog Posts Page (home.php)
 *
 * WordPress uses this file automatically for the "Posts page"
 * set in Settings → Reading. Shows all blog posts with
 * category filter buttons.
 *
 * @package MonogramRepairPro
 */
get_header();

$topics = brp_get_blog_topics();

// Load all posts
$all_posts = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 50,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
    'post__not_in'   => array( 1 ),
) );
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Monogram Appliance Blog</h1>
        <p>Tips, guides, and expert advice on Monogram appliances from our certified technicians.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <!-- Category filter buttons -->
        <div class="section-header text-center">
            <span class="section-label">Browse by Category</span>
            <h2 class="section-title">Blog Categories</h2>
        </div>

        <div class="brp-topic-filters" id="brpTopicFilters">
            <button class="btn btn-primary" data-filter="all">All Posts</button>
            <?php foreach ( $topics as $topic ) : ?>
            <button class="btn btn-secondary" data-filter="<?php echo esc_attr( $topic['slug'] ); ?>">
                <?php echo $topic['icon']; ?> <?php echo esc_html( $topic['label'] ); ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Active heading -->
        <div class="section-header" style="margin-top:48px;">
            <span class="section-label" id="brpActiveLabel">Latest</span>
            <h3 class="section-title" id="brpActiveTitle">Recent Blog Posts</h3>
        </div>

        <?php if ( $all_posts->have_posts() ) : ?>

        <div class="grid grid-3" id="brpPostGrid">
            <?php while ( $all_posts->have_posts() ) : $all_posts->the_post();
                $terms = get_the_terms( get_the_ID(), 'blog_topic' );
                $slugs = array();
                $first_term_name = '';
                if ( $terms && ! is_wp_error( $terms ) ) {
                    foreach ( $terms as $term ) {
                        $slugs[] = $term->slug;
                    }
                    $first_term_name = $terms[0]->name;
                }
            ?>
            <div class="post-card" data-topics="<?php echo esc_attr( implode( ' ', $slugs ) ); ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-card-img">
                    <?php the_post_thumbnail( 'brp-card', array( 'alt' => get_the_title() ) ); ?>
                </div>
                <?php else : ?>
                <div class="post-card-img" style="background:var(--color-light);display:flex;align-items:center;justify-content:center;">
                    <span style="font-size:3rem;">📰</span>
                </div>
                <?php endif; ?>
                <div class="post-card-body">
                    <div class="post-card-meta">
                        <span>📅 <?php echo get_the_date( 'M j, Y' ); ?></span>
                        <?php if ( $first_term_name ) : ?>
                        <span>• <?php echo esc_html( $first_term_name ); ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="post-card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="post-card-excerpt"><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="service-card-link">Read More →</a>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <!-- No results message -->
        <div id="brpNoResults" style="display:none;text-align:center;padding:60px 20px;
             background:var(--color-light);border-radius:var(--border-radius-lg);">
            <div style="font-size:3rem;margin-bottom:12px;">📭</div>
            <h3 id="brpNoResultsMsg">No posts in this category yet</h3>
            <p style="color:var(--color-gray);max-width:380px;margin:8px auto 20px;">
                Check back soon or browse all posts.
            </p>
            <button class="btn btn-primary" onclick="brpFilter('all')">View All Posts</button>
        </div>

        <?php else : ?>

        <div style="text-align:center;padding:80px 20px;background:var(--color-light);
             border-radius:var(--border-radius-lg);">
            <div style="font-size:4rem;margin-bottom:16px;">📝</div>
            <h3>Blog Coming Soon</h3>
            <p style="color:var(--color-gray);max-width:400px;margin:0 auto;">
                Our certified technicians are working on in-depth articles about Monogram appliance care and repair tips.
            </p>
        </div>

        <?php endif; ?>

    </div>
</section>

<script>
var brpLabels = {
    all:           { section: 'Latest',           heading: 'Recent Blog Posts' },
    dishwasher:    { section: 'Dishwashers',       heading: 'Dishwasher Posts' },
    washer:        { section: 'Washing Machines',  heading: 'Washing Machine Posts' },
    dryer:         { section: 'Dryers',            heading: 'Dryer Posts' },
    refrigerator:  { section: 'Refrigerators',     heading: 'Refrigerator Posts' },
    oven:          { section: 'Ovens & Ranges',    heading: 'Oven & Range Posts' },
    cooktop:       { section: 'Cooktops',          heading: 'Cooktop Posts' },
    microwave:     { section: 'Microwaves',        heading: 'Microwave Posts' },
    freezer:       { section: 'Freezers',          heading: 'Freezer Posts' },
    maintenance:   { section: 'Maintenance Tips',  heading: 'Maintenance Tip Posts' },
    'error-codes': { section: 'Error Code Guides', heading: 'Error Code Guide Posts' }
};

function brpFilter( filter ) {
    var cards     = document.querySelectorAll('#brpPostGrid .post-card');
    var noResults = document.getElementById('brpNoResults');
    var grid      = document.getElementById('brpPostGrid');
    var visible   = 0;

    // Buttons
    document.querySelectorAll('#brpTopicFilters .btn').forEach(function(btn) {
        btn.className = btn.getAttribute('data-filter') === filter
            ? 'btn btn-primary'
            : 'btn btn-secondary';
    });

    // Filter cards
    cards.forEach(function(card) {
        var topics = (card.getAttribute('data-topics') || '').split(' ');
        var show   = filter === 'all' || topics.indexOf(filter) !== -1;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    // Heading
    var info = brpLabels[filter] || { section: filter, heading: filter + ' Posts' };
    document.getElementById('brpActiveLabel').textContent = info.section;
    document.getElementById('brpActiveTitle').textContent = info.heading;

    // No results
    if (visible === 0 && grid) {
        grid.style.display    = 'none';
        noResults.style.display = 'block';
        document.getElementById('brpNoResultsMsg').textContent =
            'No posts in "' + info.section + '" yet';
    } else {
        if (grid)      grid.style.display      = '';
        if (noResults) noResults.style.display  = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#brpTopicFilters .btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            brpFilter(this.getAttribute('data-filter'));
        });
    });
});
</script>

<?php echo brp_appointment_form(); ?>
<?php get_footer(); ?>
