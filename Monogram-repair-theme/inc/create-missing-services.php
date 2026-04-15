<?php
/**
 * One-time: Create missing Wine Cooler and Hood service posts.
 *
 * HOW TO RUN:
 *   1. Upload this file to the server (it's already in the theme folder).
 *   2. While logged in as WP admin, visit:
 *      https://YOUR-SITE.com/wp-content/themes/Monogram-repair-theme/inc/create-missing-services.php
 *   3. Wait for the success message.
 *   4. DELETE this file from server (or leave it — it is safe to re-run).
 *
 * @package MonogramRepairPro
 */

require_once dirname( __FILE__, 5 ) . '/wp-load.php';

if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'You must be logged in as admin to run this script.' );
}

echo '<div style="font-family:monospace;background:#1e1e1e;color:#d4d4d4;padding:20px;margin:20px;border-radius:8px;">';
echo '<h2 style="color:#4ec9b0;">Creating Missing Service Posts</h2><ul>';

$missing = array(
    array(
        'title'     => 'Monogram Wine Cooler Repair',
        'slug'      => 'monogram-wine-cooler-repair',
        'appliance' => 'wine-cooler',
    ),
    array(
        'title'     => 'Monogram Hood Repair',
        'slug'      => 'monogram-hood-repair',
        'appliance' => 'hood',
    ),
);

foreach ( $missing as $s ) {
    $existing = get_posts( array(
        'post_type'   => 'service',
        'name'        => $s['slug'],
        'numberposts' => 1,
        'post_status' => 'any',
    ) );

    if ( $existing ) {
        $id = $existing[0]->ID;
        // Make sure it is published and has the correct template + meta
        wp_update_post( array(
            'ID'          => $id,
            'post_status' => 'publish',
        ) );
        update_post_meta( $id, '_wp_page_template', 'page-templates/template-service.php' );
        update_post_meta( $id, '_brp_appliance_type', $s['appliance'] );
        wp_set_post_terms( $id, array( $s['appliance'] ), 'appliance_type' );
        echo '<li style="color:#ce9178;">EXISTS (updated): ' . esc_html( $s['title'] ) . ' — ID: ' . $id . '</li>';
    } else {
        $id = wp_insert_post( array(
            'post_title'   => $s['title'],
            'post_name'    => $s['slug'],
            'post_status'  => 'publish',
            'post_type'    => 'service',
            'post_content' => '',
        ) );
        if ( is_wp_error( $id ) ) {
            echo '<li style="color:#f44747;">ERROR: ' . esc_html( $s['title'] ) . ' — ' . esc_html( $id->get_error_message() ) . '</li>';
        } else {
            update_post_meta( $id, '_wp_page_template', 'page-templates/template-service.php' );
            update_post_meta( $id, '_brp_appliance_type', $s['appliance'] );
            wp_set_post_terms( $id, array( $s['appliance'] ), 'appliance_type' );
            echo '<li style="color:#b5cea8;">CREATED: ' . esc_html( $s['title'] ) . ' — ID: ' . $id . '</li>';
        }
    }
}

// Flush rewrite rules so the new URLs work immediately
flush_rewrite_rules();

echo '</ul>';
echo '<p style="color:#569cd6;margin-top:16px;"><strong>Done.</strong> Visit the pages to confirm:</p>';
echo '<ul>';
echo '<li><a style="color:#9cdcfe;" href="' . home_url( '/services/monogram-wine-cooler-repair/' ) . '" target="_blank">' . home_url( '/services/monogram-wine-cooler-repair/' ) . '</a></li>';
echo '<li><a style="color:#9cdcfe;" href="' . home_url( '/services/monogram-hood-repair/' ) . '" target="_blank">' . home_url( '/services/monogram-hood-repair/' ) . '</a></li>';
echo '</ul>';
echo '</div>';
