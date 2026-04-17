<?php
/**
 * Create Error Codes – Batch 4
 * Adds 2 additional Microwave codes (F11, E6).
 * Triggered once via brp_error_codes_v4_done transient.
 *
 * @package MonogramRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$phone     = defined( 'BRP_PHONE' )     ? BRP_PHONE     : '844-752-7887';
$phone_raw = defined( 'BRP_PHONE_RAW' ) ? BRP_PHONE_RAW : '8447527887';

// Ensure microwave term exists
if ( ! term_exists( 'microwave', 'appliance_type' ) ) {
    wp_insert_term( 'Microwave', 'appliance_type', array( 'slug' => 'microwave' ) );
}

// ============================================================
// ERROR CODE DEFINITIONS
// ============================================================
$defs = array(
    'f11-microwave-communication-error' => array( 'Monogram Microwave Error Code F11 – Control-to-Display Communication Error', 'F11', 'microwave' ),
    'e6-microwave-sensor-cook-fault'    => array( 'Monogram Microwave Error Code E6 – Sensor Cook / Humidity Sensor Calibration Fault', 'E6', 'microwave' ),
);

// ============================================================
// CONTENT
// ============================================================
$content = array();

$content['f11-microwave-communication-error'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F11 Mean?</h2>
<p>Error code <strong>F11</strong> on a Monogram microwave indicates a <strong>communication error between the main control board and the secondary display/keypad board</strong>. These two boards continuously exchange data to coordinate user input with microwave operation. When the communication link is interrupted or corrupted, F11 appears and the microwave halts to prevent an uncontrolled operation state.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Loose or damaged ribbon cable</strong> &ndash; The flat ribbon cable or wiring harness connecting the main board to the display board has partially disconnected or been pinched.</li>
<li><strong>Failed display board</strong> &ndash; The secondary keypad/display PCB has developed an internal fault and is no longer responding to the main board.</li>
<li><strong>Failed main control board</strong> &ndash; Less commonly, the main board's communication circuit has failed.</li>
<li><strong>Power surge damage</strong> &ndash; A voltage spike corrupted the firmware or damaged communication components on one of the boards.</li>
<li><strong>Moisture ingress</strong> &ndash; Steam condensation inside the cavity has reached the control boards and caused a short in the communication circuit.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Unplug the microwave from the wall outlet for 5 full minutes, then restore power. A transient communication glitch may clear after a full power cycle.</li>
<li><strong>Check for recurrence</strong> &ndash; If F11 clears after reset but returns within a short time, a board or wiring fault is confirmed.</li>
<li><strong>Avoid repeated resets</strong> &ndash; If F11 returns consistently, do not continue attempting resets. Further operation may damage other components.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Diagnosing F11 requires accessing the internal wiring and testing board communication signals — work that involves dangerous stored charge in the high-voltage capacitor. Do not attempt internal repairs yourself. Call {$phone} for certified Monogram microwave diagnosis and board replacement using factory-certified parts.</p>
HTML;

$content['e6-microwave-sensor-cook-fault'] = <<<HTML
<h2>What Does Monogram Microwave Error Code E6 Mean?</h2>
<p>Error code <strong>E6</strong> on a Monogram microwave indicates a <strong>sensor cook / humidity sensor calibration fault</strong>. Monogram microwaves with automatic sensor cooking use a humidity sensor to detect moisture in steam released from food, allowing the microwave to auto-calculate cooking time and power. E6 appears when the sensor's readings fall outside the expected calibration range during a sensor cook cycle or at startup self-test.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Contaminated sensor surface</strong> &ndash; Food splatter or grease coating the humidity sensor inside the cavity alters its readings, causing calibration to fail.</li>
<li><strong>Sensor exposed to excessive steam</strong> &ndash; Operating the microwave for extended periods with very high-moisture food saturates the sensor.</li>
<li><strong>Failed humidity sensor</strong> &ndash; The sensor component has degraded and can no longer produce readings within the valid calibration range.</li>
<li><strong>Wiring fault</strong> &ndash; A loose or broken connection between the humidity sensor and the control board.</li>
<li><strong>Control board fault</strong> &ndash; The analog-to-digital converter on the control board that reads the sensor signal has developed a fault.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the microwave cavity</strong> &ndash; Unplug the microwave. Thoroughly clean the interior, paying particular attention to the humidity sensor — a small component typically located near the top of the cavity interior. Use a damp cloth and mild soap. Allow to dry completely with the door open for at least one hour before restoring power.</li>
<li><strong>Hard reset after cleaning</strong> &ndash; After the cavity is dry, plug the microwave back in and test a short manual (non-sensor) cook cycle first.</li>
<li><strong>Avoid sensor cook temporarily</strong> &ndash; If E6 only appears during sensor cook cycles, use manual time and power settings. If it appears at startup, the sensor has failed.</li>
<li><strong>Check recurrence</strong> &ndash; If E6 returns after cleaning and drying, the humidity sensor requires professional replacement.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Humidity sensor replacement requires internal access and safe discharge of the high-voltage capacitor before any work can begin. Call {$phone} for certified Monogram microwave repair using factory-certified replacement parts.</p>
HTML;

// ============================================================
// CREATE POSTS
// ============================================================
$created = 0;
$skipped = 0;

foreach ( $defs as $slug => $def ) {
    list( $title, $code_value, $appliance_slug ) = $def;

    $existing = get_posts( array(
        'post_type'   => 'error_code',
        'name'        => $slug,
        'post_status' => 'any',
        'numberposts' => 1,
        'fields'      => 'ids',
    ) );

    if ( $existing ) {
        $skipped++;
        continue;
    }

    $post_content = isset( $content[ $slug ] ) ? $content[ $slug ] : '';

    $post_id = wp_insert_post( array(
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_status'  => 'publish',
        'post_type'    => 'error_code',
        'post_content' => $post_content,
    ) );

    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_brp_error_code', $code_value );
        wp_set_post_terms( $post_id, array( $appliance_slug ), 'appliance_type' );
        $created++;
    }
}

if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
    error_log( "BRP v4 error codes: created={$created}, skipped={$skipped}" );
}
