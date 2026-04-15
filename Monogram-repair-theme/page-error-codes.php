<?php
/**
 * Template Name: Error Codes Hub
 *
 * Single page with category filter buttons + error code cards.
 * Clicking a category shows its error codes (JS filtering).
 * Clicking an error code opens the detail view.
 * URL: /error-codes/
 *
 * @package MonogramRepairPro
 */
get_header();

$categories = array(
    array( 'slug' => 'dishwasher',   'label' => 'Dishwashers',      'icon' => '🍽️', 'desc' => 'Monogram dishwasher error codes and diagnostics' ),
    array( 'slug' => 'washer',       'label' => 'Washing Machines', 'icon' => '🫧', 'desc' => 'Monogram washer error codes and diagnostics' ),
    array( 'slug' => 'dryer',        'label' => 'Dryers',           'icon' => '🌀', 'desc' => 'Monogram dryer error codes and diagnostics' ),
    array( 'slug' => 'refrigerator', 'label' => 'Refrigerators',    'icon' => '🧊', 'desc' => 'Monogram refrigerator error codes and diagnostics' ),
    array( 'slug' => 'oven',         'label' => 'Ovens & Ranges',   'icon' => '🔥', 'desc' => 'Monogram oven and range error codes and diagnostics' ),
    array( 'slug' => 'cooktop',      'label' => 'Cooktops',         'icon' => '♨️', 'desc' => 'Monogram cooktop error codes and diagnostics' ),
    array( 'slug' => 'microwave',    'label' => 'Microwaves',       'icon' => '📡', 'desc' => 'Monogram microwave error codes and diagnostics' ),
    array( 'slug' => 'freezer',      'label' => 'Freezers',         'icon' => '❄️', 'desc' => 'Monogram freezer error codes and diagnostics' ),
);

// Build error codes dynamically from the database
$all_error_codes = array();

$ec_query = new WP_Query( array(
    'post_type'      => 'error_code',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value',
    'meta_key'       => '_brp_error_code',
    'order'          => 'ASC',
) );

if ( $ec_query->have_posts() ) {
    while ( $ec_query->have_posts() ) {
        $ec_query->the_post();
        $terms = get_the_terms( get_the_ID(), 'appliance_type' );
        $appliance_slug = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->slug : 'other';
        $code_val = get_post_meta( get_the_ID(), '_brp_error_code', true );

        if ( ! isset( $all_error_codes[ $appliance_slug ] ) ) {
            $all_error_codes[ $appliance_slug ] = array();
        }

        $all_error_codes[ $appliance_slug ][] = array(
            'code'      => $code_val ? $code_val : get_the_title(),
            'title'     => get_the_title(),
            'permalink' => get_permalink(),
        );
    }
    wp_reset_postdata();
}
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Monogram Appliance Error Codes</h1>
        <p>Select your appliance type below to look up any Monogram error code with step-by-step troubleshooting guidance.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-label">Browse by Appliance</span>
            <h2 class="section-title">Error Code Categories</h2>
        </div>

        <div class="ec-cat-grid">
            <?php foreach ( $categories as $cat ) :
                $term       = get_term_by( 'slug', $cat['slug'], 'appliance_type' );
                $code_count = ( $term && ! is_wp_error( $term ) ) ? (int) $term->count : 0;
                $top_code   = ( $code_count > 0 ) ? brp_get_most_searched_by_appliance( $cat['slug'] ) : null;
                $page_url   = home_url( '/error-codes/' . $cat['slug'] . '/' );
            ?>
            <a href="<?php echo esc_url( $page_url ); ?>" class="ec-cat-card ec-cat-card--link">
                <div class="ec-cat-card-top">
                    <div class="ec-cat-icon"><?php echo $cat['icon']; ?></div>
                    <span class="ec-cat-badge"><?php echo $code_count; ?> codes</span>
                </div>
                <div class="ec-cat-title"><?php echo esc_html( $cat['label'] ); ?></div>
                <div class="ec-cat-desc"><?php echo esc_html( $cat['desc'] ); ?></div>
                <hr class="ec-cat-divider">
                <?php if ( $top_code ) : ?>
                <div class="ec-cat-most">Most searched: <span class="ec-cat-most-code"><?php echo esc_html( $top_code ); ?></span></div>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php echo brp_appointment_form( 'Got an Error Code? We\'ll Fix It Today' ); ?>

<?php get_footer(); ?>
