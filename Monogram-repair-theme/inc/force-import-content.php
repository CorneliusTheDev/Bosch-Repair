<?php
/**
 * One-time: Force-run import-all-error-content.php to populate error code posts.
 *
 * HOW TO RUN:
 *   1. Upload this file to: wp-content/themes/MonogramRepair/inc/force-import-content.php
 *   2. While logged in as WP admin, visit:
 *      https://navajowhite-chimpanzee-327425.hostingersite.com/wp-content/themes/MonogramRepair/inc/force-import-content.php
 *   3. Wait for "Done" message.
 *   4. DELETE this file from server after running.
 *
 * @package MonogramRepairPro
 */

// Load WordPress
require_once dirname( __FILE__, 5 ) . '/wp-load.php';

if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'You must be logged in as admin to run this script.' );
}

echo '<pre style="font-family:monospace;font-size:13px;padding:20px;">';
echo "=== Force Import: Error Code Content ===\n\n";

// Include the import script
include get_template_directory() . '/inc/import-all-error-content.php';

echo "\n=== Done. Delete this file from server. ===\n";
echo '</pre>';
