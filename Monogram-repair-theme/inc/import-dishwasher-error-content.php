<?php
/**
 * Import Dishwasher Error Code Content
 *
 * Populates all Monogram dishwasher error_code posts with full SEO-optimized content.
 *
 * HOW TO USE:
 *   1. Add this line temporarily to functions.php:
 *        add_action('init', function(){ include get_template_directory() . '/inc/import-dishwasher-error-content.php'; }, 100);
 *      and remove it after running once.
 *   2. OR via WP-CLI:
 *        wp eval-file wp-content/themes/monogram-repair-theme/inc/import-dishwasher-error-content.php
 *
 * @package MonogramRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) {
    require_once dirname( __FILE__, 5 ) . '/wp-load.php';
}

if ( ! current_user_can( 'manage_options' ) && ! defined( 'WP_CLI' ) ) {
    wp_die( 'Unauthorized.' );
}

$phone     = defined( 'BRP_PHONE' ) ? BRP_PHONE : '844-752-7887';
$phone_raw = defined( 'BRP_PHONE_RAW' ) ? BRP_PHONE_RAW : '8447527887';

// ============================================================
// DISHWASHER ERROR CODE CONTENT
// slug => post_content (HTML)
// ============================================================
$dishwasher_content = array();

// ---- Start Light Flashing ----
$dishwasher_content['start-light-flashing-cycle-interrupted'] = <<<HTML
<h2>What Does a Flashing Start Light on a Monogram Dishwasher Mean?</h2>
<p>A flashing Start light on a Monogram dishwasher indicates that the <strong>dishwasher door was opened during an active wash cycle or the cycle was otherwise interrupted</strong>. Monogram dishwashers use a cycle interrupt detection system &mdash; when the control board loses the door-locked signal during an active cycle, it pauses operation and causes the Start indicator to flash, alerting you that the cycle has been interrupted and needs to be restarted.</p>
<p>This is the most commonly encountered status indicator on Monogram dishwashers. It is not a component malfunction &mdash; it is a cycle state notification that requires a simple user action to resolve. This behavior appears on Monogram built-in dishwashers, including fully integrated and semi-integrated panel-ready models.</p>

<h2>Common Causes of a Flashing Start Light</h2>
<ul>
<li><strong>Door opened during wash cycle</strong> &ndash; The most common cause. Opening the dishwasher door during any phase of the wash cycle (wash, rinse, or dry) pauses the cycle and triggers the flashing Start light.</li>
<li><strong>Power interruption</strong> &ndash; A brief power fluctuation or outage during a cycle can cause the control board to lose cycle state and display the interrupted cycle indicator.</li>
<li><strong>Door latch not fully engaged</strong> &ndash; If the door latch does not fully click into the locked position when closing, the control board may interpret this as a door-open event and pause the cycle.</li>
<li><strong>Child lock accidentally activated</strong> &ndash; On models with a child lock feature, accidentally activating child lock during a cycle can pause operation.</li>
<li><strong>Control board glitch</strong> &ndash; In rare cases, a temporary electronic glitch in the control board can falsely trigger a cycle interrupt.</li>
</ul>

<h2>How to Fix the Flashing Start Light</h2>
<ol>
<li><strong>Press the Start pad once</strong> &ndash; Press the Start/Resume button once on the control panel.</li>
<li><strong>Close the door within 4 seconds</strong> &ndash; Immediately close and fully latch the dishwasher door within 4 seconds of pressing Start. You should hear the door click into the locked position.</li>
<li><strong>The cycle will resume</strong> &ndash; The dishwasher will resume the interrupted cycle from where it left off, or restart, depending on how long the cycle was paused and which model you have.</li>
<li><strong>If the cycle cannot resume</strong> &ndash; If the paused cycle cannot continue (for example, the water drained during an extended interruption), select your desired wash cycle and press Start normally to begin a fresh cycle.</li>
<li><strong>Verify child lock status</strong> &ndash; Check if the child lock indicator is lit. Consult your Monogram dishwasher owner's manual for how to deactivate child lock on your specific model.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the Start light flashes immediately when a new cycle begins &mdash; even without opening the door &mdash; or if the dishwasher does not resume after pressing Start and closing the door, there may be a door latch failure or control board fault requiring professional diagnosis. Our factory-trained Monogram dishwasher repair technicians use only genuine factory-certified replacement parts and can diagnose latch and control board issues quickly. <strong>Contact our Monogram dishwasher repair team</strong> for expert diagnosis and repair.</p>
<p><strong>Schedule your Monogram dishwasher repair appointment today</strong> by calling {$phone} and let our experienced team resolve the problem quickly and affordably.</p>
HTML;

// ---- Beeping Once Per Minute ----
$dishwasher_content['beeping-once-per-minute-door-open'] = <<<HTML
<h2>What Does Monogram Dishwasher Beeping Once Per Minute Mean?</h2>
<p>If your Monogram dishwasher is <strong>beeping once per minute</strong>, this indicates that the dishwasher door was opened or has been left open during active operation. This is a safety and reminder alert &mdash; the dishwasher is notifying you that it cannot complete its wash cycle because the door is open or unlatched, and that action is required to continue the cycle.</p>
<p>Monogram dishwashers are engineered with strict door-safety protocols. The appliance will not operate with an open door because water and steam could cause injury or property damage. The once-per-minute beep is a persistent reminder that serves as both a safety alert and a convenience notification.</p>

<h2>Common Causes of the Once-Per-Minute Beeping</h2>
<ul>
<li><strong>Door opened during an active cycle</strong> &ndash; The most common cause. If you opened the dishwasher door during the wash, rinse, or dry phase to add a forgotten dish and did not fully re-close the door, the beeping will continue.</li>
<li><strong>Door not fully latched</strong> &ndash; The door appears closed but has not clicked fully into the latched position. This can happen when dishware is loaded near the door edges and prevents the door from closing completely.</li>
<li><strong>Worn or failed door latch</strong> &ndash; A worn or broken latch mechanism prevents proper door engagement, causing the control board to read the door as open even when it appears physically closed.</li>
<li><strong>Obstructed door gasket</strong> &ndash; A displaced or damaged door gasket can physically prevent the door from sealing and latching correctly.</li>
<li><strong>Dish rack overloaded near door</strong> &ndash; Items loaded in the front of the dish rack can block the door from closing fully if they protrude too far forward.</li>
</ul>

<h2>How to Stop the Once-Per-Minute Beeping</h2>
<ol>
<li><strong>Press the Start button</strong> &ndash; Press the Start pad on the control panel.</li>
<li><strong>Close the door firmly</strong> &ndash; Push the door in completely until you hear or feel the latch click solidly into place. Apply firm, even pressure at the center of the door.</li>
<li><strong>The beeping will stop</strong> &ndash; Once the door is properly latched with Start pressed, the beeping will cease and the wash cycle will resume.</li>
<li><strong>Check dish loading</strong> &ndash; If the door seems obstructed, rearrange items in the front of the dish racks to ensure nothing protrudes beyond the rack edge.</li>
<li><strong>Inspect the door gasket</strong> &ndash; Run your fingers around the rubber door gasket to check for any displaced, folded, or damaged areas that may be preventing a proper seal.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the once-per-minute beeping persists even after firmly latching the door and pressing Start, the door latch assembly may be worn or broken and requires professional inspection. A failed door switch that does not register the door as closed even when it is physically latched is also a common cause of persistent door alerts. Our certified Monogram dishwasher repair technicians can diagnose door latch and door switch problems quickly and replace components with genuine factory-certified Monogram parts.</p>
<p><strong>Don&rsquo;t let a door latch issue leave you without a working dishwasher &mdash; schedule your Monogram dishwasher repair appointment today</strong> by calling {$phone}.</p>
HTML;

// ---- Leak Detected ----
$dishwasher_content['leak-detected'] = <<<HTML
<h2>What Does &ldquo;LEAK DETECTED&rdquo; Mean on a Monogram Dishwasher?</h2>
<p>The <strong>&ldquo;LEAK DETECTED&rdquo;</strong> message on a Monogram dishwasher display indicates that the appliance&rsquo;s built-in leak detection system has found water in the base drip tray &mdash; a location where water should never accumulate during normal operation. Monogram built-in dishwashers are equipped with a float switch in the base pan beneath the dishwasher tub. When water escapes from the tub and collects in this drip tray, the float rises and activates the leak detection circuit.</p>
<p>When LEAK DETECTED appears, the dishwasher automatically stops the current cycle, shuts off the water inlet valve to prevent more water from entering, and activates the drain pump to remove as much water as possible. This multi-layer response is designed to minimize water damage to your cabinetry and flooring.</p>
<p><strong>Do not ignore this alert.</strong> An unaddressed dishwasher leak can cause significant water damage to your kitchen cabinetry, flooring, and subfloor, and may also create conditions for mold growth.</p>

<h2>Common Causes of the LEAK DETECTED Alert</h2>
<ul>
<li><strong>Deteriorated door gasket</strong> &ndash; The rubber door seal around the dishwasher door opening can crack, stiffen, or separate from its channel over time. Even a small gap allows water to leak past the door with each wash cycle, gradually accumulating in the base pan.</li>
<li><strong>Loose or cracked internal hoses</strong> &ndash; Multiple hoses inside the dishwasher &mdash; including connections from the wash pump to the spray arms, the circulation pump to the sump, and the inlet valve to the tub &mdash; can loosen at clamp connections or develop cracks from age and heat cycling.</li>
<li><strong>Failed water inlet valve staying open</strong> &ndash; An inlet valve that fails to close completely allows water to continuously trickle into the tub even when the dishwasher is not actively filling. This slow overfill can cause water to spill into the base pan.</li>
<li><strong>Cracked dishwasher tub or sump</strong> &ndash; In older units, the plastic tub or sump (the bottom basin of the dishwasher) can develop hairline cracks, particularly from thermal stress or impact damage.</li>
<li><strong>Faulty or improperly seated door latch seal</strong> &ndash; A compromised seal around the door latch area can allow water to escape past the door frame during high-pressure wash and rinse cycles.</li>
<li><strong>Clogged drain causing internal overflow</strong> &ndash; A severely clogged drain can cause wash water to back up and overflow into the base pan during drain phases.</li>
<li><strong>Detergent dispenser leak</strong> &ndash; A cracked detergent dispenser housing or its connecting hose can allow water to leak at the dispenser location.</li>
</ul>

<h2>What to Do When LEAK DETECTED Appears</h2>
<ol>
<li><strong>Stop using the dishwasher immediately</strong> &ndash; Do not run additional cycles until the leak source is identified and repaired.</li>
<li><strong>Turn off power</strong> &ndash; Switch off the dishwasher at the circuit breaker for safety before inspecting.</li>
<li><strong>Shut off the water supply</strong> &ndash; Locate the water supply valve under the sink and close it to stop water supply to the dishwasher.</li>
<li><strong>Inspect the door gasket</strong> &ndash; Open the door and carefully examine the entire perimeter of the rubber door gasket for cracks, tears, hardening, or areas where the gasket has separated from its channel.</li>
<li><strong>Check under and around the dishwasher</strong> &ndash; Use a flashlight to look beneath the dishwasher and along the base for visible water trails, drips, or puddles.</li>
<li><strong>Check drain hose connections</strong> &ndash; Inspect the drain hose where it connects to the sink drain or garbage disposal for any looseness or dripping.</li>
<li><strong>Allow the base pan to dry completely</strong> &ndash; Even after repairing the leak source, the float switch in the base drip tray will keep the LEAK DETECTED message active until the water in the tray evaporates or is removed. The tray must be fully dry before normal dishwasher operation can resume.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>All but the simplest leak sources &mdash; such as a loose external drain hose connection &mdash; require professional diagnosis and repair. Internal hose replacement, door gasket replacement, inlet valve replacement, sump repair, and tub crack repair all require partial or full dishwasher disassembly. <strong>Contact our Monogram dishwasher repair team immediately</strong> for professional leak diagnosis. We use only genuine factory-certified Monogram replacement parts and back our repairs with a service warranty.</p>
<p>Do not delay &mdash; water damage from a leaking dishwasher can escalate quickly. <strong>Call {$phone} today</strong> to schedule your Monogram dishwasher leak repair.</p>
HTML;

// ---- End of Cycle Beeping ----
$dishwasher_content['end-of-cycle-beeping'] = <<<HTML
<h2>Why Does My Monogram Dishwasher Beep at the End of a Cycle?</h2>
<p>The beeping at the end of a Monogram dishwasher cycle is <strong>normal operation</strong> &mdash; it is the <strong>end-of-cycle completion signal</strong> that indicates the wash cycle has finished successfully. Monogram dishwashers are designed to provide an audible notification when the cycle is complete so you know your dishes are clean and ready to unload. This is a convenience feature, not an error condition.</p>
<p>The standard end-of-cycle signal on most Monogram dishwashers consists of two beeps. However, if the sound occurs at unexpected times or with unusual patterns, it may indicate a different status condition or fault code rather than normal cycle completion.</p>

<h2>How to Adjust or Disable the End-of-Cycle Beeping</h2>
<p>On most Monogram dishwasher models, the end-of-cycle completion sound can be toggled on or off using a specific control panel button sequence. The most common method is:</p>
<ol>
<li><strong>Ensure the dishwasher is not running</strong> &ndash; Make sure no cycle is currently active before attempting to change the sound setting.</li>
<li><strong>Press the Dry Options (or Heated Dry) button five times</strong> &ndash; Press the Dry Options pad (or Heated Dry button, depending on your model) exactly <strong>5 times within 3 seconds</strong>.</li>
<li><strong>Confirm the setting change</strong> &ndash; The dishwasher will indicate via a beep or display change whether the end-of-cycle sound is now ON or OFF.</li>
<li><strong>Test the new setting</strong> &ndash; Run a short cycle to verify the sound setting has taken effect.</li>
</ol>
<p><strong>Note:</strong> The exact button sequence may vary by model and production year. Consult your Monogram dishwasher owner&rsquo;s manual for the specific procedure for your model number. If you do not have the physical manual, the model number on the door jamb can be used to find the digital manual on the GE Appliances website.</p>

<h2>Why the End-of-Cycle Sound Matters</h2>
<p>Many homeowners find the end-of-cycle notification useful because Monogram dishwashers &mdash; particularly fully integrated panel-ready models &mdash; are designed to be whisper-quiet during operation. Because you may not hear the cycle end, the audible completion signal reminds you to open the door and allow steam to escape, which improves drying performance on many models. Opening the door slightly at the end of the drying phase significantly improves air drying and reduces water spots on dishes and glassware.</p>

<h2>When to Call a Professional</h2>
<p>If your Monogram dishwasher is beeping at unexpected times &mdash; not just at the end of a completed cycle &mdash; this may indicate a fault condition, sensor alert, or door status issue that requires professional evaluation. Unusual beeping patterns, continuous beeping, or beeping that occurs without a clear trigger can all indicate an underlying component problem. <strong>Contact our Monogram dishwasher repair team</strong> to diagnose and resolve any non-routine beeping. We use factory-certified Monogram parts and provide a service warranty on all repairs. Call {$phone} to schedule your appointment today.</p>
HTML;

// ============================================================
// UPDATE ALL POSTS WITH CONTENT
// ============================================================
$updated = 0;
$skipped = 0;
$not_found = 0;

echo "Starting import of " . count( $dishwasher_content ) . " dishwasher error code pages...\n\n";

foreach ( $dishwasher_content as $slug => $content ) {
    $posts = get_posts( array(
        'post_type'   => 'error_code',
        'name'        => $slug,
        'numberposts' => 1,
        'post_status' => 'any',
    ) );

    if ( empty( $posts ) ) {
        echo "NOT FOUND: error_code '{$slug}' — skipping.\n";
        $not_found++;
        continue;
    }

    $post = $posts[0];

    // Only update if content is currently empty or very short
    if ( strlen( trim( $post->post_content ) ) > 200 ) {
        echo "HAS CONTENT: '{$slug}' — skipping (already has content).\n";
        $skipped++;
        continue;
    }

    wp_update_post( array(
        'ID'           => $post->ID,
        'post_content' => $content,
    ) );

    echo "UPDATED: '{$slug}' (ID: {$post->ID})\n";
    $updated++;
}

echo "\n=== Done: {$updated} updated, {$skipped} skipped, {$not_found} not found ===\n";
