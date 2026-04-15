<?php
/**
 * One-time: Replace all "Bosch" references with "Monogram" in the database.
 *
 * HOW TO RUN (pick one):
 *
 * A) WP-CLI (recommended – fastest):
 *      wp eval-file wp-content/themes/monogram-repair-theme/inc/fix-bosch-to-monogram.php
 *
 * B) Temporary hook – add to functions.php, load any page as admin, then REMOVE:
 *      add_action('init', function(){
 *          if ( current_user_can('manage_options') )
 *              include get_template_directory() . '/inc/fix-bosch-to-monogram.php';
 *      }, 100);
 *
 * DELETE this file after running.
 *
 * @package MonogramRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) {
    require_once dirname( __FILE__, 5 ) . '/wp-load.php';
}

if ( ! current_user_can( 'manage_options' ) && ! defined( 'WP_CLI' ) ) {
    wp_die( 'Unauthorized.' );
}

global $wpdb;

$replacements = array(
    'Bosch Repair'    => 'Monogram Repair',
    'Bosch repair'    => 'Monogram repair',
    'bosch-repair'    => 'monogram-repair',
    'Bosch washer'    => 'Monogram washer',
    'Bosch Washer'    => 'Monogram Washer',
    'Bosch dryer'     => 'Monogram dryer',
    'Bosch Dryer'     => 'Monogram Dryer',
    'Bosch dishwasher'=> 'Monogram dishwasher',
    'Bosch Dishwasher'=> 'Monogram Dishwasher',
    'Bosch fridge'    => 'Monogram fridge',
    'Bosch Fridge'    => 'Monogram Fridge',
    'Bosch refrigerator' => 'Monogram refrigerator',
    'Bosch Refrigerator' => 'Monogram Refrigerator',
    'Bosch oven'      => 'Monogram oven',
    'Bosch Oven'      => 'Monogram Oven',
    'Bosch cooktop'   => 'Monogram cooktop',
    'Bosch Cooktop'   => 'Monogram Cooktop',
    'Bosch microwave' => 'Monogram microwave',
    'Bosch Microwave' => 'Monogram Microwave',
    'Bosch freezer'   => 'Monogram freezer',
    'Bosch Freezer'   => 'Monogram Freezer',
    'Bosch error'     => 'Monogram error',
    'Bosch Error'     => 'Monogram Error',
    // Generic brand name (must come last)
    'Bosch'           => 'Monogram',
    'bosch'           => 'monogram',
    'BOSCH'           => 'MONOGRAM',
);

$tables = array(
    // Posts: title, content, excerpt, status, name
    array( 'table' => $wpdb->posts,      'col' => 'post_title' ),
    array( 'table' => $wpdb->posts,      'col' => 'post_content' ),
    array( 'table' => $wpdb->posts,      'col' => 'post_excerpt' ),
    array( 'table' => $wpdb->posts,      'col' => 'post_name' ),
    // Post meta
    array( 'table' => $wpdb->postmeta,   'col' => 'meta_value' ),
    // Terms (taxonomy names)
    array( 'table' => $wpdb->terms,      'col' => 'name' ),
    array( 'table' => $wpdb->terms,      'col' => 'slug' ),
    array( 'table' => $wpdb->term_taxonomy, 'col' => 'description' ),
    // Options (site settings, widget text, menus, etc.)
    array( 'table' => $wpdb->options,    'col' => 'option_value' ),
    // Comments
    array( 'table' => $wpdb->comments,   'col' => 'comment_content' ),
    array( 'table' => $wpdb->comments,   'col' => 'comment_author' ),
);

$total_updated = 0;
$log = array();

foreach ( $tables as $t ) {
    $table = $t['table'];
    $col   = $t['col'];

    foreach ( $replacements as $find => $replace ) {
        // Skip options that store serialized data with numeric lengths — handled separately
        $count = $wpdb->query(
            $wpdb->prepare(
                "UPDATE `{$table}` SET `{$col}` = REPLACE(`{$col}`, %s, %s) WHERE `{$col}` LIKE %s",
                $find,
                $replace,
                '%' . $wpdb->esc_like( $find ) . '%'
            )
        );

        if ( $count > 0 ) {
            $log[]          = "✓ {$table}.{$col}: '{$find}' → '{$replace}' ({$count} row(s))";
            $total_updated += $count;
        }
    }
}

// Clear all object/page/post caches
wp_cache_flush();
flush_rewrite_rules();

// Output
$nl = defined( 'WP_CLI' ) ? "\n" : "<br>\n";
echo "=== Bosch → Monogram Database Fix ==={$nl}{$nl}";
foreach ( $log as $entry ) {
    echo esc_html( $entry ) . $nl;
}
if ( empty( $log ) ) {
    echo "No 'Bosch' references found in the database. Already clean!{$nl}";
}
echo "{$nl}=== Done: {$total_updated} total row update(s). ==={$nl}";
echo "IMPORTANT: Delete or remove inc/fix-bosch-to-monogram.php after running.{$nl}";
