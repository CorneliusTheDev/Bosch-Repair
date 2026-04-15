<?php
/**
 * Template Name: Blog Hub
 *
 * Blog main page with JavaScript-based category filtering.
 * URL: /blog/
 *
 * @package MonogramRepairPro
 */
get_header();

$topics = brp_get_blog_topics();

// Load all posts at once (JS will filter client-side)
$blog_posts = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 50,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Monogram Appliance Blog</h1>
        <p>Tips, guides, and expert advice on Monogram appliances from our certified technicians. Browse by appliance type or topic.</p>
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

        <?php if ( $blog_posts->have_posts() ) : ?>

        <!-- Posts grid -->
        <div class="grid grid-3" id="brpPostGrid">
            <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post();

                // Get all blog_topic slugs for this post
                $post_topic_terms = get_the_terms( get_the_ID(), 'blog_topic' );
                $topic_slugs = array();
                $topic_name  = '';
                if ( $post_topic_terms && ! is_wp_error( $post_topic_terms ) ) {
                    foreach ( $post_topic_terms as $term ) {
                        $topic_slugs[] = $term->slug;
                    }
                    $topic_name = $post_topic_terms[0]->name;
                }
            ?>
            <div class="post-card" data-topics="<?php echo esc_attr( implode( ' ', $topic_slugs ) ); ?>">
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
                        <?php if ( $topic_name ) : ?>
                        <span>• <?php echo esc_html( $topic_name ); ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="post-card-excerpt"><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="service-card-link">Read More →</a>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <!-- No results message (hidden by default) -->
        <div id="brpNoResults" style="display:none;text-align:center;padding:60px 20px;background:var(--color-light);border-radius:var(--border-radius-lg);">
            <div style="font-size:3rem;margin-bottom:12px;">📭</div>
            <h3 id="brpNoResultsTitle">No posts in this category yet</h3>
            <p style="color:var(--color-gray);max-width:400px;margin:8px auto 20px;">Check back soon or browse all posts.</p>
            <button class="btn btn-primary" data-filter="all" onclick="brpFilter('all')">View All Posts</button>
        </div>

        <?php else : ?>

        <!-- No posts at all -->
        <div style="text-align:center;padding:80px 20px;background:var(--color-light);border-radius:var(--border-radius-lg);">
            <div style="font-size:4rem;margin-bottom:16px;">📝</div>
            <h3>Blog Coming Soon</h3>
            <p style="color:var(--color-gray);max-width:400px;margin:0 auto 24px;">
                Our certified technicians are working on in-depth articles. Check back soon!
            </p>
            <div class="brp-topic-preview-grid">
                <?php foreach ( $topics as $topic ) : ?>
                <div class="brp-topic-preview-card">
                    <div class="brp-topic-preview-icon"><?php echo $topic['icon']; ?></div>
                    <div class="brp-topic-preview-label"><?php echo esc_html( $topic['label'] ); ?></div>
                    <div class="brp-topic-preview-sub">Coming soon</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php endif; ?>

    </div>
</section>

<!-- Topic labels for JS headings -->
<script>
var brpTopicLabels = {
    <?php foreach ( $topics as $t ) : ?>
    '<?php echo esc_js( $t['slug'] ); ?>': { label: '<?php echo esc_js( $t['label'] ); ?>' },
    <?php endforeach; ?>
};

function brpFilter( filter ) {
    var cards     = document.querySelectorAll('#brpPostGrid .post-card');
    var noResults = document.getElementById('brpNoResults');
    var grid      = document.getElementById('brpPostGrid');
    var btns      = document.querySelectorAll('#brpTopicFilters .btn');
    var visible   = 0;

    // Update active button
    btns.forEach(function(btn) {
        if ( btn.getAttribute('data-filter') === filter ) {
            btn.className = 'btn btn-primary';
        } else {
            btn.className = 'btn btn-secondary';
        }
    });

    // Show/hide cards
    cards.forEach(function(card) {
        if ( filter === 'all' ) {
            card.style.display = '';
            visible++;
        } else {
            var topics = card.getAttribute('data-topics') || '';
            var topicList = topics.split(' ');
            if ( topicList.indexOf(filter) !== -1 ) {
                card.style.display = '';
                visible++;
            } else {
                card.style.display = 'none';
            }
        }
    });

    // Show/hide no-results message
    if ( visible === 0 ) {
        grid.style.display = 'none';
        noResults.style.display = 'block';
        document.getElementById('brpNoResultsTitle').textContent =
            'No posts in "' + (brpTopicLabels[filter] ? brpTopicLabels[filter].label : filter) + '" yet';
    } else {
        grid.style.display = '';
        noResults.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#brpTopicFilters .btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            brpFilter( this.getAttribute('data-filter') );
        });
    });
});
</script>

<?php echo brp_appointment_form(); ?>

<?php get_footer(); ?>
