<?php
/**
 * Create Error Codes – Batch 3
 * Adds Microwave (to 14) and Freezer (to 12) codes.
 * Triggered once via brp_error_codes_v3_done transient.
 *
 * @package MonogramRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$phone     = defined( 'BRP_PHONE' )     ? BRP_PHONE     : '844-752-7887';
$phone_raw = defined( 'BRP_PHONE_RAW' ) ? BRP_PHONE_RAW : '8447527887';

// Ensure terms exist
$appliance_terms = array(
    'microwave' => 'Microwave',
    'freezer'   => 'Freezer',
);
foreach ( $appliance_terms as $slug => $label ) {
    if ( ! term_exists( $slug, 'appliance_type' ) ) {
        wp_insert_term( $label, 'appliance_type', array( 'slug' => $slug ) );
    }
}

// ============================================================
// ERROR CODE DEFINITIONS
// ============================================================
$defs = array(

    // ── MICROWAVE (new codes to reach 14) ───────────────────
    'f7-microwave-door-switch-fault'           => array( 'Monogram Microwave Error Code F7 – Door Switch Fault',                  'F7',   'microwave' ),
    'f8-microwave-relay-drive-circuit'         => array( 'Monogram Microwave Error Code F8 – Relay Drive Circuit Failure',        'F8',   'microwave' ),
    'f9-microwave-magnetron-overheating'       => array( 'Monogram Microwave Error Code F9 – Magnetron Overheating',              'F9',   'microwave' ),
    'loc-microwave-control-lock'               => array( 'Monogram Microwave LOC – Control Lock Active',                          'LOC',  'microwave' ),
    'e1-microwave-power-level-sensor'          => array( 'Monogram Microwave Error Code E1 – Power Level Sensor Fault',           'E1',   'microwave' ),

    // ── FREEZER (new codes to reach 12) ─────────────────────
    'op-freezer-door-open-alarm'               => array( 'Monogram Freezer Error Code OP – Door Open Alarm',                      'OP',   'freezer' ),
    '4-freezer-defrost-heater-failure'         => array( 'Monogram Freezer Error Code 4 – Defrost Heater Failure',                '4',    'freezer' ),
    '6-freezer-evaporator-fan-fault'           => array( 'Monogram Freezer Error Code 6 – Evaporator Fan Motor Fault',            '6',    'freezer' ),
    'e0-freezer-control-communication-error'   => array( 'Monogram Freezer Error Code E0 – Control Board Communication Error',    'E0',   'freezer' ),
    'sy-cf-freezer-condenser-fan-fault'        => array( 'Monogram Freezer Error Code SY CF – Condenser Fan Fault',               'SY CF','freezer' ),
    'sy-ce-freezer-communication-error'        => array( 'Monogram Freezer Error Code SY CE – Communication Error',               'SY CE','freezer' ),
    '1-freezer-refrigerant-sensor-fault'       => array( 'Monogram Freezer Error Code 1 – Refrigerant/Thermistor Sensor Fault',   '1',    'freezer' ),
);

// ============================================================
// CONTENT
// ============================================================
$content = array();

// ── MICROWAVE ────────────────────────────────────────────────

$content['f7-microwave-door-switch-fault'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F7 Mean?</h2>
<p>Error code <strong>F7</strong> on a Monogram microwave indicates a <strong>door switch fault</strong>. Microwaves use multiple interlock switches to confirm the door is fully closed before allowing magnetron operation. If one or more of these switches fails to signal correctly, the microwave halts operation and displays F7.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed primary door interlock switch</strong> &ndash; The most common cause. The primary switch has worn out or its actuator tab has broken.</li>
<li><strong>Failed secondary or monitor switch</strong> &ndash; Microwaves have 2–3 interlock switches. Any one failing can trigger F7.</li>
<li><strong>Door latch hook broken</strong> &ndash; The plastic hooks on the door that press the switches have cracked or snapped.</li>
<li><strong>Door misalignment</strong> &ndash; The door is not hanging straight and is not engaging the switches fully.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Do not attempt internal repairs yourself</strong> &ndash; Microwave capacitors retain lethal charge even when unplugged. All internal work must be performed by a qualified technician.</li>
<li><strong>Inspect door latch hooks</strong> &ndash; With the microwave unplugged, examine the two or three plastic hooks on the door edge. If any are broken, the door assembly needs replacement.</li>
<li><strong>Power cycle</strong> &ndash; Unplug for 60 seconds and re-test. If F7 persists, a switch has failed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Door switch replacement in a microwave requires discharging the high-voltage capacitor. Call {$phone} for safe, certified Monogram microwave repair.</p>
HTML;

$content['f8-microwave-relay-drive-circuit'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F8 Mean?</h2>
<p>Error code <strong>F8</strong> on a Monogram microwave indicates a <strong>relay drive circuit failure</strong> on the main control board. The relay that controls power to the magnetron or other high-voltage components has developed a fault — either failing open (no power to component) or welded shut (component runs continuously).</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Welded relay contacts</strong> &ndash; High-current switching has caused relay contacts to fuse together, causing the magnetron to run when it shouldn't. This is a safety hazard.</li>
<li><strong>Failed relay driver</strong> &ndash; The transistor or circuit driving the relay has failed, preventing the relay from activating.</li>
<li><strong>Control board failure</strong> &ndash; The broader control board has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Stop using the microwave immediately</strong> &ndash; A welded relay can cause the magnetron to run with the door open, which is dangerous. Unplug the unit.</li>
<li><strong>Do not reset and continue</strong> &ndash; F8 is a safety-critical fault that must be diagnosed before use.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>F8 requires control board inspection and possible replacement. Call {$phone} immediately for urgent Monogram microwave service.</p>
HTML;

$content['f9-microwave-magnetron-overheating'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F9 Mean?</h2>
<p>Error code <strong>F9</strong> on a Monogram microwave indicates <strong>magnetron overheating</strong>. The thermal cutout or thermoprotector on the magnetron tube has tripped due to the magnetron operating above its safe temperature threshold. The microwave shuts off automatically to prevent damage or fire.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Blocked ventilation</strong> &ndash; The microwave's cooling vents are obstructed by items placed too close on top of or around the unit.</li>
<li><strong>Extended high-power operation</strong> &ndash; Running the microwave at full power for very long periods causes the magnetron to overheat.</li>
<li><strong>Failed cooling fan</strong> &ndash; The internal fan that cools the magnetron has stopped working, causing heat to build up.</li>
<li><strong>Worn magnetron</strong> &ndash; An aging magnetron runs hotter and reaches thermal cutout sooner than a new unit.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Allow to cool</strong> &ndash; Unplug the microwave and allow at least 30 minutes for the magnetron to cool before attempting to restart.</li>
<li><strong>Check ventilation clearance</strong> &ndash; Ensure at least 3 inches of clearance on all sides and above the microwave.</li>
<li><strong>Reduce cook time</strong> &ndash; For extended cooking tasks, use lower power levels with rest periods in between.</li>
<li><strong>Power cycle after cooling</strong> &ndash; Plug back in and test with a short 30-second cook cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If F9 returns quickly after cooling, the cooling fan or magnetron thermoprotector needs replacement. Call {$phone} for Monogram microwave service.</p>
HTML;

$content['loc-microwave-control-lock'] = <<<HTML
<h2>What Does Monogram Microwave LOC Mean?</h2>
<p><strong>LOC</strong> displayed on a Monogram microwave indicates the <strong>control lock (child safety lock) is active</strong>. All keypad buttons are disabled to prevent accidental operation. This is not an error — it is a safety feature that has been turned on.</p>
<h2>How to Unlock the Microwave</h2>
<ol>
<li><strong>Press and hold the Lock or Stop/Cancel button</strong> &ndash; On most Monogram microwaves, press and hold the designated lock key for 3 seconds. The LOC indicator will extinguish when unlocked.</li>
<li><strong>Check your model's procedure</strong> &ndash; Some models require holding the "3" key or a specific button combination. Refer to the use and care guide for your exact model.</li>
<li><strong>Power cycle</strong> &ndash; If the keypad is completely unresponsive, unplug for 60 seconds and restore. The control lock state does not persist through power cycles on most models.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the microwave remains locked after trying all methods or the keypad is otherwise unresponsive, the control board may have developed a fault. Call {$phone} for Monogram microwave diagnosis.</p>
HTML;

$content['e1-microwave-power-level-sensor'] = <<<HTML
<h2>What Does Monogram Microwave Error Code E1 Mean?</h2>
<p>Error code <strong>E1</strong> on a Monogram microwave indicates a <strong>power level sensor or inverter feedback fault</strong>. On inverter-based Monogram microwaves, the inverter board continuously monitors magnetron output. E1 appears when the feedback signal from the inverter indicates the power output is not matching the commanded level.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed inverter board</strong> &ndash; The inverter that controls magnetron power output has developed an internal fault.</li>
<li><strong>Magnetron degradation</strong> &ndash; An aging magnetron tube no longer draws the expected current, causing an inverter feedback mismatch.</li>
<li><strong>Loose wiring connection</strong> &ndash; A connector between the inverter board and magnetron has come loose.</li>
<li><strong>Control board fault</strong> &ndash; The main control board is not communicating properly with the inverter.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Unplug for 5 minutes, then plug back in and test with a 30-second cook cycle.</li>
<li><strong>Note any changes in cooking performance</strong> &ndash; If food is not heating properly or heating unevenly before E1 appears, the magnetron or inverter is failing.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Inverter board and magnetron replacement involves dangerous high-voltage components. Call {$phone} for certified Monogram microwave repair.</p>
HTML;

// ── FREEZER ──────────────────────────────────────────────────

$content['op-freezer-door-open-alarm'] = <<<HTML
<h2>What Does Monogram Freezer Error Code OP Mean?</h2>
<p>Error code <strong>OP</strong> on a Monogram freezer is a <strong>door open alarm</strong>. The freezer has detected that its door was left open or ajar for more than the programmed alert threshold (typically 3–5 minutes). The alarm triggers to protect food safety before the freezer temperature rises to a dangerous level.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Door left ajar</strong> &ndash; The freezer door was not fully closed, either accidentally or because an item is blocking the seal.</li>
<li><strong>Damaged door gasket</strong> &ndash; A torn or warped gasket prevents the door from sealing, causing the door switch to read "open."</li>
<li><strong>Failed door switch</strong> &ndash; The magnetic or mechanical switch that detects door closure has failed and continuously signals open.</li>
<li><strong>Overloaded freezer</strong> &ndash; Items stacked too high or too close to the door prevent it from closing fully.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Close the door firmly</strong> &ndash; Ensure the door latches fully. The alarm should stop immediately.</li>
<li><strong>Check for obstructions</strong> &ndash; Reorganize freezer contents so nothing blocks the door from closing completely.</li>
<li><strong>Test the gasket</strong> &ndash; Close the door on a dollar bill. You should feel resistance when pulling it. Replace the gasket if you feel no resistance at any point.</li>
<li><strong>Check door alignment</strong> &ndash; If the freezer is not level, the door may drift open. Adjust the leveling legs.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A faulty door switch or damaged gasket needs replacement. Call {$phone} to schedule Monogram freezer service.</p>
HTML;

$content['4-freezer-defrost-heater-failure'] = <<<HTML
<h2>What Does Monogram Freezer Error Code 4 Mean?</h2>
<p>Error code <strong>4</strong> on a Monogram freezer indicates a <strong>defrost heater failure</strong>. The automatic defrost system — which periodically heats the evaporator coils to remove frost buildup — is not operating. Without regular defrost cycles, ice accumulates on the evaporator, progressively blocking airflow until the freezer can no longer maintain temperature.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Burned-out defrost heater</strong> &ndash; The resistance heater coil wrapped around or near the evaporator coils has failed open-circuit.</li>
<li><strong>Blown defrost thermal fuse</strong> &ndash; A one-time safety fuse in the defrost heater circuit has opened, usually from a previous overheating event.</li>
<li><strong>Failed defrost thermostat</strong> &ndash; The thermostat that allows the heater to activate (when the evaporator is below a set temperature) has failed open.</li>
<li><strong>Control board defrost relay failure</strong> &ndash; The relay on the main board that initiates defrost cycles is faulty.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Perform a manual defrost</strong> &ndash; Unplug the freezer for 24–48 hours with the door open and towels on the floor. If cooling performance improves after restoring power, the defrost system has failed and allowed ice to build up.</li>
<li><strong>Listen during defrost cycle</strong> &ndash; A working heater produces a soft hissing sound as ice melts. No sound during a scheduled defrost cycle indicates heater failure.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Defrost heater access requires removing the freezer's back interior panel. Call {$phone} for certified Monogram freezer repair.</p>
HTML;

$content['6-freezer-evaporator-fan-fault'] = <<<HTML
<h2>What Does Monogram Freezer Error Code 6 Mean?</h2>
<p>Error code <strong>6</strong> on a Monogram freezer indicates an <strong>evaporator fan motor fault</strong>. The fan that circulates cold air from the evaporator coils throughout the freezer compartment is not running at the correct speed or has stopped entirely. Without this airflow, the freezer temperature rises despite the compressor running.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed evaporator fan motor</strong> &ndash; The fan motor has burned out and no longer spins.</li>
<li><strong>Fan blade blocked by ice</strong> &ndash; Excessive frost accumulation has physically locked the fan blade in place.</li>
<li><strong>Wiring fault</strong> &ndash; A loose or broken wire in the fan motor circuit.</li>
<li><strong>Door switch not releasing fan</strong> &ndash; The fan is wired to stop when the door is open; a faulty door switch can keep the fan off even with the door closed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Listen at the freezer</strong> &ndash; With the door closed, you should hear the fan running. Silence while the compressor is running indicates fan failure.</li>
<li><strong>Press the door switch manually</strong> &ndash; Open the door and press the door switch with your finger. The fan should start running.</li>
<li><strong>Check for ice blockage</strong> &ndash; If frost is severe, manually defrost (unplug 24 hours) and retest.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Evaporator fan motor replacement requires accessing the freezer's interior back panel. Call {$phone} for Monogram freezer repair.</p>
HTML;

$content['e0-freezer-control-communication-error'] = <<<HTML
<h2>What Does Monogram Freezer Error Code E0 Mean?</h2>
<p>Error code <strong>E0</strong> on a Monogram freezer indicates a <strong>control board communication error</strong>. The main control board is not receiving or sending data properly to other electronic modules — such as the user interface board, the temperature sensors, or the inverter board.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Loose wiring harness connector</strong> &ndash; Vibration or movement has partially unseated a connector between control boards.</li>
<li><strong>Failed main control board</strong> &ndash; An internal fault in the main PCB has disrupted its communication bus.</li>
<li><strong>Failed user interface board</strong> &ndash; The display/keypad module is not responding to the main board.</li>
<li><strong>Power surge damage</strong> &ndash; A voltage spike corrupted firmware or damaged board components.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Unplug the freezer for 5 full minutes to clear any transient communication fault, then restore power.</li>
<li><strong>Check the power supply</strong> &ndash; Plug the freezer into a different outlet to rule out unstable power.</li>
<li><strong>Reseat connectors</strong> &ndash; With power off, a technician should check that all wiring harness connectors are fully engaged.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Control board diagnosis requires service mode access and specialized tools. Call {$phone} for certified Monogram freezer repair.</p>
HTML;

$content['sy-cf-freezer-condenser-fan-fault'] = <<<HTML
<h2>What Does Monogram Freezer Error Code SY CF Mean?</h2>
<p>Error code <strong>SY CF</strong> on a Monogram freezer stands for <strong>Condenser Fan System Fault</strong>. The condenser fan that pulls air over the condenser coils to dissipate heat is not operating correctly. Without this fan, the compressor overheats and the sealed refrigeration system loses efficiency, causing rising freezer temperatures.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed condenser fan motor</strong> &ndash; The motor has burned out or its bearings have seized.</li>
<li><strong>Condenser fan blade obstruction</strong> &ndash; Dust, debris, or a foreign object is preventing the fan from spinning.</li>
<li><strong>Wiring fault</strong> &ndash; A broken wire or loose connector to the condenser fan motor.</li>
<li><strong>Control board relay failure</strong> &ndash; The relay on the main board that powers the condenser fan has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Locate the condenser fan</strong> &ndash; It is typically behind the access panel at the bottom rear of the freezer.</li>
<li><strong>Clean the condenser area</strong> &ndash; Unplug the freezer and vacuum lint and dust from the condenser coils and fan area.</li>
<li><strong>Listen for the fan</strong> &ndash; With power on and the compressor running, you should hear the condenser fan. Silence indicates it has failed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Condenser fan motor replacement requires accessing the rear service compartment. Call {$phone} for Monogram freezer repair.</p>
HTML;

$content['sy-ce-freezer-communication-error'] = <<<HTML
<h2>What Does Monogram Freezer Error Code SY CE Mean?</h2>
<p>Error code <strong>SY CE</strong> on a Monogram freezer indicates a <strong>system communication error</strong> — specifically a failure in the communication between the main control board and a secondary board or component. This is distinct from E0 in that SY CE is typically generated by the system-level watchdog circuit rather than a specific component reporting in.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Main-to-secondary board communication loss</strong> &ndash; The data link between the two boards has been interrupted.</li>
<li><strong>Power interruption during operation</strong> &ndash; A brief power fluctuation corrupted the communication state between boards.</li>
<li><strong>Failed main board</strong> &ndash; The main control PCB has an internal communication bus fault.</li>
<li><strong>Loose wiring harness</strong> &ndash; The ribbon cable or harness connecting the boards has partially disconnected.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset first</strong> &ndash; Unplug for 5 minutes. SY CE sometimes clears after a full power cycle.</li>
<li><strong>Check for recurrence</strong> &ndash; If it clears but returns within 24 hours, a board or wiring fault is present.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Persistent SY CE requires board-level diagnosis. Call {$phone} for expert Monogram freezer service.</p>
HTML;

$content['1-freezer-refrigerant-sensor-fault'] = <<<HTML
<h2>What Does Monogram Freezer Error Code 1 Mean?</h2>
<p>Error code <strong>1</strong> on a Monogram freezer indicates a <strong>refrigerant/thermistor sensor fault</strong>. The temperature sensor (thermistor) that monitors the freezer compartment or the evaporator area is reporting an out-of-range reading. Without accurate temperature data, the control board cannot manage the compressor and defrost cycles properly.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed thermistor</strong> &ndash; The sensor's resistance has drifted outside the expected range or it has failed open/short circuit.</li>
<li><strong>Loose sensor connector</strong> &ndash; The wiring connector to the thermistor has come loose.</li>
<li><strong>Sensor encased in ice</strong> &ndash; Excessive frost buildup has surrounded the thermistor, affecting its reading accuracy.</li>
<li><strong>Wiring damage</strong> &ndash; The thin wires leading to the sensor have been pinched or broken.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Manual defrost</strong> &ndash; If heavy frost buildup is present, unplug for 24 hours to let it melt. The sensor reading may normalize once ice clears.</li>
<li><strong>Hard reset</strong> &ndash; Restore power after defrosting and check if error code 1 clears.</li>
<li><strong>Check for recurrence</strong> &ndash; If error 1 returns within a few hours, the thermistor needs replacement.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Thermistor testing requires a multimeter and access to the freezer compartment wiring. Call {$phone} for certified Monogram freezer repair.</p>
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
    error_log( "BRP v3 error codes: created={$created}, skipped={$skipped}" );
}
