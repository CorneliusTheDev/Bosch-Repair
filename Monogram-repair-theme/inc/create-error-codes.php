<?php
/**
 * Create & Populate All Error Code Posts
 *
 * Creates every error_code CPT post, assigns the correct appliance_type
 * taxonomy term, sets the _brp_error_code meta, and fills in the full
 * SEO content — all in one pass.
 *
 * HOW TO USE (pick one method):
 *   A) WP-CLI (recommended):
 *        wp eval-file wp-content/themes/monogram-repair-theme/inc/create-error-codes.php
 *
 *   B) Temporary hook — add to functions.php, load any page, then REMOVE:
 *        add_action( 'init', function() {
 *            include get_template_directory() . '/inc/create-error-codes.php';
 *        }, 100 );
 *
 * Running it a second time is safe: existing posts are skipped.
 *
 * @package MonogramRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) {
    require_once dirname( __FILE__, 5 ) . '/wp-load.php';
}

if ( ! current_user_can( 'manage_options' ) && ! defined( 'WP_CLI' ) ) {
    wp_die( 'Unauthorized.' );
}

$phone     = defined( 'BRP_PHONE' )     ? BRP_PHONE     : '844-752-7887';
$phone_raw = defined( 'BRP_PHONE_RAW' ) ? BRP_PHONE_RAW : '8447527887';

// ============================================================
// 1. ENSURE TAXONOMY TERMS EXIST
// ============================================================
$appliance_terms = array(
    'washer'       => 'Washer',
    'dryer'        => 'Dryer',
    'refrigerator' => 'Refrigerator',
    'oven'         => 'Oven & Range',
    'cooktop'      => 'Cooktop',
    'microwave'    => 'Microwave',
    'freezer'      => 'Freezer',
    'dishwasher'   => 'Dishwasher',
);
foreach ( $appliance_terms as $slug => $label ) {
    if ( ! term_exists( $slug, 'appliance_type' ) ) {
        wp_insert_term( $label, 'appliance_type', array( 'slug' => $slug ) );
    }
}

// ============================================================
// 2. ERROR CODE DEFINITIONS
// Format: slug => [ title, code_value, appliance_type_slug ]
// ============================================================
$error_code_defs = array(

    // ── WASHER ──────────────────────────────────────────────
    'e22-fill-timeout-water-supply'      => array( 'Monogram Washer Error Code E22 – Fill Timeout / Water Supply Problem',   'E22',    'washer' ),
    'e23-flood-protection-drain'         => array( 'Monogram Washer Error Code E23 – Flood Protection Drain Activated',      'E23',    'washer' ),
    'e30-no-drain-pump-signal'           => array( 'Monogram Washer Error Code E30 – No Drain Pump Signal',                  'E30',    'washer' ),
    'e31-drain-timeout-slow-drain'       => array( 'Monogram Washer Error Code E31 – Drain Timeout / Slow Drain',            'E31',    'washer' ),
    'e42-e45-drive-motor-error'          => array( 'Monogram Washer Error Codes E42/E45 – Drive Motor Error',                'E42/E45','washer' ),
    'e60-e64-door-lock-errors'           => array( 'Monogram Washer Error Codes E60–E64 – Door Lock Errors',                 'E60-E64','washer' ),
    'ue-ub-unbalanced-load'              => array( 'Monogram Washer Error Code UE/UB – Unbalanced Load',                     'UE/UB',  'washer' ),

    // ── DRYER ───────────────────────────────────────────────
    '001-003-defective-inlet-thermistor' => array( 'Monogram Dryer Error Codes 001/003 – Defective Inlet Thermistor',        '001/003','dryer' ),
    '002-004-defective-outlet-thermistor'=> array( 'Monogram Dryer Error Codes 002/004 – Defective Outlet Thermistor',       '002/004','dryer' ),
    '005-dryer-control-board-failure'    => array( 'Monogram Dryer Error Code 005 – Main Control Board Failure',             '005',    'dryer' ),
    '008-00d-door-switch-malfunction'    => array( 'Monogram Dryer Error Codes 008/00D – Door Switch Malfunction',           '008/00D','dryer' ),
    '009-dryer-drive-motor-problem'      => array( 'Monogram Dryer Error Code 009 – Drive Motor Problem',                   '009',    'dryer' ),

    // ── REFRIGERATOR ────────────────────────────────────────
    'ff-freezer-temperature-too-high'    => array( 'Monogram Refrigerator Error Code FF – Freezer Temperature Too High',     'FF',     'refrigerator' ),
    'pf-refrigerator-power-failure'      => array( 'Monogram Refrigerator Error Code PF – Power Failure',                   'PF',     'refrigerator' ),
    'ci-check-ice-maker'                 => array( 'Monogram Refrigerator Error Code CI – Check Ice Maker',                  'CI',     'refrigerator' ),
    'de-defrost-system-problem'          => array( 'Monogram Refrigerator Error Code dE – Defrost System Problem',           'dE',     'refrigerator' ),
    'hrs-control-board-failure'          => array( 'Monogram Refrigerator Error Code HRS – Main Control Board Failure',      'HRS',    'refrigerator' ),

    // ── OVEN ────────────────────────────────────────────────
    'f0-oven-stuck-touch-pad'            => array( 'Monogram Oven Error Code F0 – Stuck Touch Pad',                          'F0',     'oven' ),
    'f2-oven-temperature-too-high'       => array( 'Monogram Oven Error Code F2 – Oven Temperature Too High',                'F2',     'oven' ),
    'f3-oven-open-temperature-sensor'    => array( 'Monogram Oven Error Code F3 – Open Oven Temperature Sensor',             'F3',     'oven' ),
    'f4-oven-shorted-temperature-sensor' => array( 'Monogram Oven Error Code F4 – Shorted Oven Temperature Sensor',          'F4',     'oven' ),
    'f9-oven-door-lock-circuit-fault'    => array( 'Monogram Oven Error Code F9 – Door Lock Circuit Fault',                  'F9',     'oven' ),
    'fff-oven-eeprom-failure'            => array( 'Monogram Oven Error Code FFF – Control EEPROM Failure',                  'FFF',    'oven' ),

    // ── COOKTOP ─────────────────────────────────────────────
    'f-induction-no-cookware-detected'          => array( 'Monogram Cooktop Error Code F – No Compatible Cookware Detected (Induction)', 'F',    'cooktop' ),
    'f7x-cooling-fan-speed-too-low'             => array( 'Monogram Cooktop Error Code F7X – Cooling Fan Speed Too Low',                 'F7X',  'cooktop' ),
    'f160-pan-detection-communication-failure'  => array( 'Monogram Cooktop Error Code F160 – Pan Detection Communication Failure',      'F160', 'cooktop' ),

    // ── MICROWAVE ───────────────────────────────────────────
    'f1-microwave-open-thermal-sensor'   => array( 'Monogram Microwave Error Code F1 – Open Thermal Sensor / Overheating',   'F1',     'microwave' ),
    'f3-microwave-shorted-touch-pad'     => array( 'Monogram Microwave Error Code F3 – Shorted Touch Pad Panel',             'F3',     'microwave' ),
    'pf-888-power-failure-display-reset' => array( 'Monogram Microwave Error Code PF/888 – Power Failure or Display Reset',  'PF/888', 'microwave' ),

    // ── FREEZER ─────────────────────────────────────────────
    'ff-freezer-temperature-alarm'       => array( 'Monogram Freezer Error Code FF – Freezer Temperature Too High / Food Thawing', 'FF', 'freezer' ),
    'de-freezer-defrost-system-fault'    => array( 'Monogram Freezer Error Code dE – Defrost System Problem',                'dE',     'freezer' ),
    'cc-freezer-temperature-incorrect'   => array( 'Monogram Freezer Error Code CC – Temperature Control / Compartment Too Warm', 'CC', 'freezer' ),
    'pf-freezer-power-failure'           => array( 'Monogram Freezer Error Code PF – Power Failure',                           'PF',     'freezer' ),
    'ci-freezer-check-ice-maker'         => array( 'Monogram Freezer Error Code CI – Check Ice Maker',                         'CI',     'freezer' ),

    // ── WASHER (additional) ──────────────────────────────────
    'e66-e67-temperature-sensor-malfunction' => array( 'Monogram Washer Error Codes E66/E67 – Temperature Sensor Malfunction', 'E66/E67', 'washer' ),

    // ── DRYER (additional) ──────────────────────────────────
    '000-no-errors-self-test'            => array( 'Monogram Dryer Error Code 000 – No Errors / Self-Test Complete',           '000',    'dryer' ),
    '006-stuck-control-panel-button'     => array( 'Monogram Dryer Error Code 006 – Stuck Control Panel Button',               '006',    'dryer' ),
    '007-miswired-power-supply'          => array( 'Monogram Dryer Error Code 007 – Miswired Power Supply',                    '007',    'dryer' ),

    // ── DISHWASHER ──────────────────────────────────────────
    'start-light-flashing-cycle-interrupted' => array( 'Monogram Dishwasher Start Light Flashing – Cycle Interrupted',        'Start',  'dishwasher' ),
    'beeping-once-per-minute-door-open'  => array( 'Monogram Dishwasher Beeping Once Per Minute – Door Left Open',             'Beep',   'dishwasher' ),
    'leak-detected'                      => array( 'Monogram Dishwasher LEAK DETECTED Error',                                  'LEAK',   'dishwasher' ),
    'end-of-cycle-beeping'               => array( 'Monogram Dishwasher End-of-Cycle Beeping – Cycle Complete Alert',          'End',    'dishwasher' ),

    // ── REFRIGERATOR (additional) ───────────────────────────
    'cc-refrigerator-temperature-incorrect' => array( 'Monogram Refrigerator Error Code CC – Fresh Food Temperature Incorrect', 'CC',   'refrigerator' ),

    // ── OVEN (additional) ───────────────────────────────────
    'f1-oven-system-watchdog-stuck-key'  => array( 'Monogram Oven Error Code F1 – System Watchdog / Stuck Key',                'F1',     'oven' ),
    'f5-oven-relay-drive-circuit-failure'=> array( 'Monogram Oven Error Code F5 – Loss of Relay Drive Circuit',                'F5',     'oven' ),
    'f8-oven-shorted-meat-probe'         => array( 'Monogram Oven Error Code F8 – Shorted Meat Probe',                        'F8',     'oven' ),

    // ── COOKTOP (additional) ────────────────────────────────
    'f1-cooktop-stuck-touch-pad'         => array( 'Monogram Cooktop Error Code F1 – Stuck Touch Pad',                        'F1',     'cooktop' ),
    'f113-cooktop-temperature-sensor'    => array( 'Monogram Cooktop Error Code F113 – Temperature Sensor Out of Range',       'F113',   'cooktop' ),
    'f161-cooktop-burner-sensor-fault'   => array( 'Monogram Cooktop Error Code F161 – Burner Temperature Sensor Fault',      'F161',   'cooktop' ),

    // ── MICROWAVE (additional) ──────────────────────────────
    'f2-microwave-shorted-thermal-sensor'=> array( 'Monogram Microwave Error Code F2 – Shorted Thermal Sensor',               'F2',     'microwave' ),
    'f4-microwave-open-humidity-sensor'  => array( 'Monogram Microwave Error Code F4 – Open Humidity Sensor',                  'F4',     'microwave' ),
    'f5-microwave-shorted-humidity-sensor'=> array( 'Monogram Microwave Error Code F5 – Shorted Humidity Sensor',              'F5',     'microwave' ),
    'f6-microwave-shorted-temperature-probe' => array( 'Monogram Microwave Error Code F6 – Shorted Temperature Probe',         'F6',     'microwave' ),
    'f10-microwave-shorted-touch-screen' => array( 'Monogram Microwave Error Code F10 – Shorted Touch Screen',                 'F10',    'microwave' ),
    '18-microwave-power-watch'           => array( 'Monogram Microwave Error Code 18 – Electronic Control Issue',              '18',     'microwave' ),
);

// ============================================================
// 3. CONTENT FOR EACH POST
// ============================================================
$all_content = array();

// ── WASHER ──────────────────────────────────────────────────

$all_content['e22-fill-timeout-water-supply'] = <<<HTML
<h2>What Does Monogram Washer Error Code E22 Mean?</h2>
<p>The E22 error code on a Monogram washing machine indicates a <strong>fill timeout</strong> &mdash; the washer was unable to fill with water within the expected time limit (typically 8 minutes). When the control board activates the water inlet valve to fill the drum, it monitors the water level sensor. If the water level does not rise to the required level within the fill timeout window, E22 is triggered and the cycle stops.</p>
<h2>Common Causes of the E22 Error Code</h2>
<ul>
<li><strong>Water supply valves not fully open</strong> &ndash; The hot and cold water supply valves behind the washer may be partially or completely closed.</li>
<li><strong>Kinked or clogged fill hoses</strong> &ndash; The rubber hoses can become kinked or internally clogged with sediment and mineral deposits.</li>
<li><strong>Clogged inlet valve screens</strong> &ndash; The small mesh screens inside the water inlet valve can become clogged, severely restricting flow.</li>
<li><strong>Failed water inlet valve</strong> &ndash; The solenoid-operated inlet valve can fail electrically or mechanically.</li>
<li><strong>Low water pressure</strong> &ndash; Monogram washers require a minimum of 20&ndash;120 PSI to fill within the allowed time.</li>
<li><strong>Failed water level pressure sensor</strong> &ndash; Incorrect readings may cause the washer to time out even with adequate water.</li>
</ul>
<h2>How to Troubleshoot the E22 Error Code</h2>
<ol>
<li><strong>Check water supply valves</strong> &ndash; Ensure both valves behind the washer are fully open (turned counterclockwise).</li>
<li><strong>Check for kinked hoses</strong> &ndash; Inspect fill hoses and straighten any kinks.</li>
<li><strong>Clean the inlet valve screens</strong> &ndash; Turn off supply valves, disconnect fill hoses, remove and rinse the mesh screens inside the valve ports.</li>
<li><strong>Test water pressure</strong> &ndash; Check flow at nearby fixtures. A whole-house pressure issue needs to be addressed at the main supply or pressure-reducing valve.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds, then plug back in and attempt a new cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If E22 persists after checking valves, hoses, and cleaning screens, the water inlet valve or water level pressure sensor may need replacement. <strong>Contact our Monogram washer repair team</strong> at {$phone} for professional diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['e23-flood-protection-drain'] = <<<HTML
<h2>What Does Monogram Washer Error Code E23 Mean?</h2>
<p>The E23 error code on a Monogram washing machine indicates that the <strong>flood protection system has been activated</strong> &mdash; the washer detected an excessive water level, triggering a safety drain to prevent overflow.</p>
<h2>Common Causes of the E23 Error Code</h2>
<ul>
<li><strong>Faulty water inlet valve stuck open</strong> &ndash; The most common cause. If the solenoid valve fails in the open position, water continuously trickles into the drum triggering flood protection.</li>
<li><strong>Failed water level pressure sensor</strong> &ndash; An incorrect reading may tell the control board the drum is empty when it is full, causing continuous filling.</li>
<li><strong>Siphoning through drain hose</strong> &ndash; If the drain hose is inserted too deeply into the standpipe or is too low, a siphon effect can pull water back into the tub.</li>
</ul>
<h2>How to Troubleshoot the E23 Error Code</h2>
<ol>
<li><strong>Check the inlet valve</strong> &ndash; After a wash cycle, turn off water supply valves. If water continues to drip into the drum, the inlet valve is stuck open.</li>
<li><strong>Check drain hose position</strong> &ndash; Ensure the drain hose is inserted only 6&ndash;8 inches into the standpipe at the correct minimum height per your Monogram installation guide.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds. The drain pump should already have removed excess water. Run a short cycle and monitor.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the inlet valve continues to drip or the water level sensor provides incorrect readings, professional diagnosis is needed. Call {$phone} to schedule a Monogram washer repair appointment.</p>
HTML;

$all_content['e30-no-drain-pump-signal'] = <<<HTML
<h2>What Does Monogram Washer Error Code E30 Mean?</h2>
<p>The E30 error code indicates that the <strong>control board is not receiving a proper signal from the drain pump</strong>. Unlike E31 (drain timeout), E30 points to an electrical or communication issue with the pump circuit rather than simply slow drainage.</p>
<h2>Common Causes of the E30 Error Code</h2>
<ul>
<li><strong>Loose electrical connection to the drain pump</strong> &ndash; The wiring connector to the pump motor has come loose or partially disconnected.</li>
<li><strong>Clogged drain pump</strong> &ndash; A severely clogged pump impeller can prevent the motor from spinning and cause an overcurrent trip.</li>
<li><strong>Failed drain pump motor</strong> &ndash; The pump motor has burned out electrically.</li>
<li><strong>Control board fault</strong> &ndash; The control board&rsquo;s pump drive circuit has failed.</li>
</ul>
<h2>How to Troubleshoot the E30 Error Code</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Unplug the washer for 60 seconds and restart. If E30 returns immediately, the issue is hardware-related.</li>
<li><strong>Check for a drain clog</strong> &ndash; Access the drain pump filter (usually behind a small panel at the front base of the washer) and remove any debris or foreign objects.</li>
<li><strong>Check wiring</strong> &ndash; With the washer unplugged, inspect the wiring harness connector at the drain pump for looseness or corrosion.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>E30 typically requires replacement of the drain pump or control board. Call {$phone} to schedule expert Monogram washer service.</p>
HTML;

$all_content['e31-drain-timeout-slow-drain'] = <<<HTML
<h2>What Does Monogram Washer Error Code E31 Mean?</h2>
<p>E31 on a Monogram washer indicates a <strong>drain timeout</strong> &mdash; the washer was unable to drain within the expected time window. Unlike E30, the pump is receiving its signal but the water is not draining fast enough or at all.</p>
<h2>Common Causes of the E31 Error Code</h2>
<ul>
<li><strong>Clogged drain pump filter</strong> &ndash; Lint, coins, or debris blocking the pump filter is the most common cause.</li>
<li><strong>Kinked or blocked drain hose</strong> &ndash; A kinked or crushed drain hose restricts water flow out of the washer.</li>
<li><strong>Blocked household drain standpipe</strong> &ndash; If the home&rsquo;s standpipe is partially blocked, the washer can&rsquo;t drain at the required rate.</li>
<li><strong>Weak or failing drain pump</strong> &ndash; The pump motor may be mechanically worn and unable to generate sufficient flow.</li>
</ul>
<h2>How to Troubleshoot the E31 Error Code</h2>
<ol>
<li><strong>Clean the drain pump filter</strong> &ndash; Locate the access panel at the front base of the washer, place a towel and shallow pan under it, then unscrew the filter and remove any debris.</li>
<li><strong>Check the drain hose</strong> &ndash; Inspect the drain hose from the washer to the standpipe for kinks or blockages.</li>
<li><strong>Test the standpipe</strong> &ndash; Pour water directly into the standpipe to verify it drains freely.</li>
<li><strong>Reset the washer</strong> &ndash; After clearing any blockages, unplug for 60 seconds and retry a drain/spin cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If E31 persists after clearing blockages, the drain pump may need replacement. Contact our team at {$phone} for prompt service.</p>
HTML;

$all_content['e42-e45-drive-motor-error'] = <<<HTML
<h2>What Do Monogram Washer Error Codes E42/E45 Mean?</h2>
<p>Error codes E42 and E45 on a Monogram washing machine indicate a <strong>drive motor fault</strong>. E42 typically signals a motor communication error (the control board is not receiving proper feedback from the motor), while E45 indicates a motor overcurrent or overload condition.</p>
<h2>Common Causes of E42/E45</h2>
<ul>
<li><strong>Overloaded drum</strong> &ndash; Overloading the washer causes the motor to draw excess current and triggers overload protection (E45).</li>
<li><strong>Seized drum bearing</strong> &ndash; A worn or seized drum bearing forces the motor to work much harder, causing overcurrent.</li>
<li><strong>Failed drive motor</strong> &ndash; The motor windings or brushes (on brush-type motors) may have failed.</li>
<li><strong>Loose motor wiring connector</strong> &ndash; A partially disconnected wiring harness can cause intermittent motor communication faults (E42).</li>
<li><strong>Failed motor control module</strong> &ndash; The inverter board that drives the motor has failed.</li>
</ul>
<h2>How to Troubleshoot E42/E45</h2>
<ol>
<li><strong>Reduce load size</strong> &ndash; If the drum was heavily loaded, remove some items and retry with a smaller load.</li>
<li><strong>Hard reset</strong> &ndash; Unplug for 5 minutes, then restart with a small load in a normal wash cycle.</li>
<li><strong>Check drum rotation</strong> &ndash; With the washer off and unplugged, manually rotate the drum. It should turn smoothly with slight resistance. Grinding or very heavy resistance suggests a bearing issue.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Motor, bearing, and inverter board repairs require professional service. Call {$phone} to schedule an appointment with a certified Monogram technician.</p>
HTML;

$all_content['e60-e64-door-lock-errors'] = <<<HTML
<h2>What Do Monogram Washer Error Codes E60–E64 Mean?</h2>
<p>Error codes E60 through E64 on a Monogram washing machine all relate to the <strong>door lock / latch assembly</strong>. The specific code indicates the nature of the door lock fault detected by the control board.</p>
<ul>
<li><strong>E60</strong>: Door lock mechanism did not engage within the expected time.</li>
<li><strong>E61</strong>: Door lock mechanism did not disengage (unlock) within the expected time.</li>
<li><strong>E62</strong>: Door lock feedback signal is incorrect or missing.</li>
<li><strong>E63/E64</strong>: Door lock circuit fault &mdash; open or short circuit detected.</li>
</ul>
<h2>Common Causes of E60–E64</h2>
<ul>
<li><strong>Obstructed door latch</strong> &ndash; Clothing caught in the door or debris in the latch mechanism.</li>
<li><strong>Worn or damaged door latch</strong> &ndash; The plastic or metal latch hook has broken or worn down.</li>
<li><strong>Failed door lock assembly (actuator)</strong> &ndash; The motorized lock actuator has failed.</li>
<li><strong>Wiring fault</strong> &ndash; Loose or damaged wiring to the door lock assembly.</li>
</ul>
<h2>How to Troubleshoot E60–E64</h2>
<ol>
<li><strong>Clear the door area</strong> &ndash; Ensure no clothing or debris is caught in or around the door gasket and latch area.</li>
<li><strong>Inspect the door latch hook</strong> &ndash; Look for visible damage to the latch hook or the strike plate on the door frame.</li>
<li><strong>Hard reset</strong> &ndash; Unplug for 60 seconds. If the door was locked during a fault, the lock should release after reset.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the door lock assembly or wiring needs replacement, call {$phone} for certified Monogram washer repair.</p>
HTML;

$all_content['ue-ub-unbalanced-load'] = <<<HTML
<h2>What Do Monogram Washer Error Codes UE/UB Mean?</h2>
<p>The UE (or UB on some models) error code on a Monogram washing machine indicates an <strong>unbalanced load</strong>. The washer detected that the load inside the drum is not evenly distributed during the spin cycle, causing excessive vibration. The washer will automatically pause and attempt to redistribute the load before retrying spin.</p>
<h2>Common Causes of UE/UB</h2>
<ul>
<li><strong>Single heavy item</strong> &ndash; Washing one large item (a comforter, blanket, or heavy towel) alone causes it to clump on one side.</li>
<li><strong>Mixed heavy and light items</strong> &ndash; Combining very heavy and very light items in the same load makes even distribution difficult.</li>
<li><strong>Overloaded drum</strong> &ndash; Too many items can prevent proper tumbling and redistribution.</li>
<li><strong>Washer not level</strong> &ndash; If the washer is not level on the floor, even a balanced load will cause imbalance during spin.</li>
<li><strong>Worn shock absorbers or suspension springs</strong> &ndash; Worn suspension components can cause the drum to wobble excessively even with a balanced load.</li>
</ul>
<h2>How to Fix UE/UB</h2>
<ol>
<li><strong>Redistribute the load manually</strong> &ndash; Pause the cycle, open the door, and manually redistribute items evenly around the drum.</li>
<li><strong>Add or remove items</strong> &ndash; For a single heavy item, add a few similar items to balance the load.</li>
<li><strong>Check the washer is level</strong> &ndash; Place a spirit level on top of the washer. Adjust the leveling feet until the washer is level side-to-side and front-to-back.</li>
<li><strong>Reduce load size</strong> &ndash; For large loads, split into two smaller, more manageable loads.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If UE/UB appears consistently even with correctly loaded, balanced laundry and the washer is level, the shock absorbers or suspension springs may be worn and need replacement. Call {$phone} for service.</p>
HTML;

// ── DRYER ───────────────────────────────────────────────────

$all_content['001-003-defective-inlet-thermistor'] = <<<HTML
<h2>What Do Monogram Dryer Error Codes 001/003 Mean?</h2>
<p>Error codes 001 and 003 on a Monogram dryer indicate a <strong>defective inlet thermistor</strong>. The inlet thermistor (also called the inlet temperature sensor) measures the temperature of air entering the drum. Error 001 typically indicates an open-circuit thermistor (reads too high a resistance), while 003 indicates a short-circuit thermistor (reads too low a resistance).</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed inlet thermistor</strong> &ndash; The thermistor itself has failed open or shorted due to age, heat exposure, or physical damage.</li>
<li><strong>Loose wiring connector</strong> &ndash; The connector to the thermistor has come loose, causing an open circuit reading.</li>
<li><strong>Damaged wiring harness</strong> &ndash; Wiring to the thermistor has been pinched, cut, or burned.</li>
</ul>
<h2>How to Troubleshoot 001/003</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Disconnect power for 60 seconds and restart. If the error returns immediately, it is a sensor hardware fault.</li>
<li><strong>Check wiring</strong> &ndash; With the dryer unplugged, inspect the wiring connector at the inlet thermistor location (typically near the inlet duct at the back of the drum) for looseness or corrosion.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Inlet thermistor replacement requires disassembling the dryer cabinet. Call {$phone} for certified Monogram dryer repair.</p>
HTML;

$all_content['002-004-defective-outlet-thermistor'] = <<<HTML
<h2>What Do Monogram Dryer Error Codes 002/004 Mean?</h2>
<p>Error codes 002 and 004 on a Monogram dryer indicate a <strong>defective outlet thermistor</strong>. The outlet thermistor measures the temperature of air exiting the drum. Code 002 indicates an open circuit (thermistor reads infinite resistance) and 004 indicates a short circuit (thermistor reads near-zero resistance).</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed outlet thermistor</strong> &ndash; The thermistor has failed due to heat fatigue or age.</li>
<li><strong>Loose or corroded wiring connector</strong> &ndash; The connector at the thermistor has become loose or corroded.</li>
<li><strong>Overheating event</strong> &ndash; A previous overheating event may have damaged the thermistor or its wiring.</li>
</ul>
<h2>How to Troubleshoot 002/004</h2>
<ol>
<li><strong>Check the lint filter and exhaust duct</strong> &ndash; A blocked lint filter or crushed exhaust duct causes overheating that can damage thermistors. Clean the lint filter and verify the duct is not kinked or blocked.</li>
<li><strong>Hard reset</strong> &ndash; Unplug for 60 seconds and restart.</li>
<li><strong>Check wiring at the thermistor</strong> &ndash; Inspect the connector at the outlet thermistor (usually located near the exhaust port or blower housing) for looseness or damage.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the thermistor or its wiring has failed, professional replacement is required. Call {$phone} to schedule service.</p>
HTML;

$all_content['005-dryer-control-board-failure'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 005 Mean?</h2>
<p>Error code 005 on a Monogram dryer indicates a <strong>main control board failure</strong>. The control board has detected an internal fault or has failed to communicate properly with one or more subsystems. This error typically means the electronic control board itself has malfunctioned.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power surge damage</strong> &ndash; A power surge or lightning strike can damage the control board&rsquo;s internal components.</li>
<li><strong>Component failure on the board</strong> &ndash; Individual components on the control board (capacitors, relays, microprocessors) can fail over time.</li>
<li><strong>Moisture or corrosion</strong> &ndash; Moisture ingress or corrosion on board connectors can cause communication failures.</li>
</ul>
<h2>How to Troubleshoot 005</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Disconnect power for 5&ndash;10 minutes and restart. Occasionally a soft board fault will clear with a full power cycle.</li>
<li><strong>Check all wiring harness connections to the control board</strong> &ndash; Ensure all connectors are firmly seated (with dryer unplugged).</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Control board replacement is a complex repair. Call {$phone} for certified Monogram dryer service and ensure only genuine Monogram parts are used.</p>
HTML;

$all_content['008-00d-door-switch-malfunction'] = <<<HTML
<h2>What Do Monogram Dryer Error Codes 008/00D Mean?</h2>
<p>Error codes 008 and 00D on a Monogram dryer indicate a <strong>door switch malfunction</strong>. The control board is not receiving the correct signal from the door switch, which tells the dryer whether the door is open or closed. Error 008 typically indicates the switch is stuck in the open state, and 00D indicates it is stuck in the closed state or has a circuit fault.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed door switch</strong> &ndash; The microswitch inside the door switch assembly has worn out or failed.</li>
<li><strong>Broken door latch</strong> &ndash; The plastic latch strike no longer depresses the switch actuator properly.</li>
<li><strong>Loose wiring connector</strong> &ndash; The connector to the door switch has come loose.</li>
</ul>
<h2>How to Troubleshoot 008/00D</h2>
<ol>
<li><strong>Inspect the door latch</strong> &ndash; Look at the latch strike on the door and the switch actuator on the dryer frame for visible damage or misalignment.</li>
<li><strong>Test the door switch</strong> &ndash; With the dryer unplugged, disconnect the door switch wiring and use a multimeter to check continuity: the switch should have continuity when the actuator is depressed and no continuity when released.</li>
<li><strong>Hard reset</strong> &ndash; Unplug for 60 seconds and retry.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Door switch and latch replacement is a straightforward repair for a trained technician. Call {$phone} to schedule service.</p>
HTML;

$all_content['009-dryer-drive-motor-problem'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 009 Mean?</h2>
<p>Error code 009 on a Monogram dryer indicates a <strong>drive motor problem</strong>. The drive motor is responsible for rotating the drum and driving the blower fan. When the control board detects that the motor is not starting, running, or responding correctly, error 009 is triggered.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Worn motor start winding</strong> &ndash; The motor&rsquo;s start winding has failed, preventing the motor from starting under load.</li>
<li><strong>Tripped thermal overload</strong> &ndash; The motor&rsquo;s built-in thermal overload protector has tripped due to overheating (often from a blocked vent or lint buildup).</li>
<li><strong>Seized drum</strong> &ndash; A seized drum bearing or glide creates drag that prevents the motor from turning the drum.</li>
<li><strong>Failed motor capacitor</strong> &ndash; Some Monogram dryer motors use a start capacitor that can fail.</li>
<li><strong>Loose motor wiring connector</strong> &ndash; The wiring harness to the motor has come loose.</li>
</ul>
<h2>How to Troubleshoot 009</h2>
<ol>
<li><strong>Clean the exhaust duct and lint trap</strong> &ndash; A severely blocked duct causes the motor to overheat and trip its thermal overload. Clean the duct from dryer to wall cap.</li>
<li><strong>Allow the motor to cool</strong> &ndash; If the dryer was running hot, unplug for 30 minutes to allow the thermal overload to reset.</li>
<li><strong>Check drum rotation</strong> &ndash; With the dryer unplugged, manually rotate the drum. It should turn smoothly and freely. Resistance suggests a worn drum bearing or glide strip.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Motor replacement requires full disassembly of the dryer cabinet. Call {$phone} for expert Monogram dryer repair.</p>
HTML;

// ── REFRIGERATOR ────────────────────────────────────────────

$all_content['ff-freezer-temperature-too-high'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code FF Mean?</h2>
<p>The FF error code on a Monogram refrigerator (with freezer) indicates that the <strong>freezer compartment temperature is too high</strong>. The control board has detected that the freezer has been above the safe temperature threshold for a period of time, putting food safety at risk.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed evaporator fan motor</strong> &ndash; The fan that circulates cold air through the freezer compartment has stopped working.</li>
<li><strong>Frost buildup on the evaporator coils</strong> &ndash; Excessive ice buildup blocks airflow over the evaporator coils, reducing cooling capacity.</li>
<li><strong>Failed defrost heater or thermostat</strong> &ndash; A defrost system failure allows ice to build up unchecked on the evaporator.</li>
<li><strong>Sealed system problem</strong> &ndash; A refrigerant leak or failed compressor reduces the system&rsquo;s cooling capacity.</li>
<li><strong>Door seal failure</strong> &ndash; A damaged or poorly sealing freezer door gasket allows warm air infiltration.</li>
</ul>
<h2>How to Troubleshoot the FF Error Code</h2>
<ol>
<li><strong>Check the door seal</strong> &ndash; Inspect the freezer door gasket for cracks, tears, or areas that don&rsquo;t seal properly. Close the door on a piece of paper: you should feel resistance when pulling the paper out.</li>
<li><strong>Listen for the evaporator fan</strong> &ndash; Open the freezer door and press the door switch (the button the door depresses). You should hear the evaporator fan running. Silence suggests a failed fan motor.</li>
<li><strong>Defrost the freezer manually</strong> &ndash; Unplug the refrigerator for 24&ndash;48 hours with the freezer door propped open. If the freezer cools normally after, the defrost system has failed.</li>
<li><strong>Check the condenser coils</strong> &ndash; Dusty or dirty condenser coils reduce cooling efficiency. Clean with a vacuum and coil brush.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Most causes of FF require professional diagnosis and repair. Call {$phone} for same-day Monogram refrigerator service.</p>
HTML;

$all_content['pf-refrigerator-power-failure'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code PF Mean?</h2>
<p>The PF error code on a Monogram refrigerator indicates a <strong>power failure</strong> has occurred. This is an informational alert that the appliance detected a power interruption &mdash; the refrigerator lost power and then power was restored. PF is not a malfunction code; it is a notification that food safety should be checked.</p>
<h2>What to Do When You See PF</h2>
<ol>
<li><strong>Check food safety</strong> &ndash; If the power was out for more than 4 hours, check refrigerated food for signs of spoilage. Freezer food is safe if ice crystals remain or the freezer temperature stayed at or below 40°F.</li>
<li><strong>Clear the PF alert</strong> &ndash; Press the OK or any button on the control panel as prompted by the display to acknowledge and clear the PF code.</li>
<li><strong>Allow the refrigerator to recover</strong> &ndash; After a power failure, it can take 4&ndash;8 hours for the refrigerator and freezer to return to their set temperatures. This is normal.</li>
<li><strong>Check for recurring PF codes</strong> &ndash; If PF appears frequently without an obvious power outage, the refrigerator may have a loose power cord connection or the home outlet may have an intermittent fault.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If PF appears repeatedly and you have confirmed stable power supply, the refrigerator&rsquo;s control board or power supply board may be failing. Call {$phone} for professional diagnosis.</p>
HTML;

$all_content['ci-check-ice-maker'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code CI Mean?</h2>
<p>The CI error code on a Monogram refrigerator indicates a <strong>Check Ice Maker</strong> alert. The refrigerator&rsquo;s control system has detected a problem with the ice maker that is preventing it from operating correctly.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Ice maker arm/bail in the OFF position</strong> &ndash; The ice maker&rsquo;s wire shut-off arm may have been manually raised to the OFF position.</li>
<li><strong>Low water pressure to the ice maker</strong> &ndash; Insufficient water pressure prevents the inlet valve from filling the ice maker mold.</li>
<li><strong>Frozen fill tube</strong> &ndash; The small tube that fills the ice maker mold has frozen over, blocking water flow.</li>
<li><strong>Failed water inlet valve</strong> &ndash; The ice maker&rsquo;s water inlet valve solenoid has failed.</li>
<li><strong>Failed ice maker module</strong> &ndash; The ice maker assembly module (the motor and thermostat that controls the harvest cycle) has failed.</li>
</ul>
<h2>How to Troubleshoot the CI Error Code</h2>
<ol>
<li><strong>Check the ice maker shut-off arm</strong> &ndash; Ensure the wire shut-off arm is in the lowered (ON) position.</li>
<li><strong>Verify the ice maker is turned on</strong> &ndash; Check the refrigerator&rsquo;s control panel settings to confirm the ice maker is enabled.</li>
<li><strong>Check for a frozen fill tube</strong> &ndash; Look at the small tube at the back of the ice maker compartment. If it is frozen over, use a turkey baster with warm water to carefully thaw it.</li>
<li><strong>Verify water supply</strong> &ndash; Ensure the water supply line behind the refrigerator is connected and the shut-off valve is open.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the ice maker still doesn&rsquo;t produce ice after these steps, the inlet valve or ice maker module needs replacement. Call {$phone} for service.</p>
HTML;

$all_content['de-defrost-system-problem'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code dE Mean?</h2>
<p>The dE error code on a Monogram refrigerator indicates a <strong>defrost system problem</strong>. The refrigerator&rsquo;s adaptive defrost control has determined that the defrost system is not operating correctly, which can lead to ice buildup on the evaporator coils and reduced cooling performance over time.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed defrost heater</strong> &ndash; The electric heater that melts frost from the evaporator coils has burned out or developed an open circuit.</li>
<li><strong>Failed defrost thermostat (bi-metal thermostat)</strong> &ndash; The thermostat that cuts off the defrost heater when coils reach approximately 50°F has failed open, preventing the heater from receiving power.</li>
<li><strong>Failed defrost timer or adaptive defrost control</strong> &ndash; The component that initiates the defrost cycle has failed.</li>
<li><strong>Failed evaporator temperature sensor</strong> &ndash; An incorrect temperature reading prevents the defrost cycle from initiating or terminating properly.</li>
</ul>
<h2>How to Troubleshoot the dE Error Code</h2>
<ol>
<li><strong>Manual defrost test</strong> &ndash; Unplug the refrigerator, remove all food, and leave the freezer door open for 24&ndash;48 hours to fully defrost. If the refrigerator works normally after full defrost, the defrost system has failed and needs repair before ice rebuilds.</li>
<li><strong>Listen for defrost heater</strong> &ndash; During a defrost cycle, you should hear a faint sizzling/hissing sound as frost melts. Silence during what should be a defrost cycle suggests a failed heater or thermostat.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Defrost system component testing and replacement requires accessing the evaporator behind the freezer back panel. Call {$phone} to schedule certified Monogram refrigerator repair.</p>
HTML;

$all_content['hrs-control-board-failure'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code HRS Mean?</h2>
<p>The HRS error code on a Monogram refrigerator indicates a <strong>main control board failure</strong>. The HRS code is specific to certain Monogram built-in refrigerator models and indicates that the main electronic control board has detected an internal hardware fault or has experienced a critical communication error.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power surge damage</strong> &ndash; A voltage spike or power surge has damaged components on the main control board.</li>
<li><strong>Internal board component failure</strong> &ndash; Capacitors, voltage regulators, or microprocessors on the board have failed.</li>
<li><strong>Software corruption</strong> &ndash; In rare cases, the board&rsquo;s firmware has become corrupted and a full reset may clear the fault.</li>
</ul>
<h2>How to Troubleshoot the HRS Error Code</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Unplug the refrigerator for 10&ndash;15 minutes, then restore power. If HRS clears and the refrigerator operates normally, monitor for recurrence.</li>
<li><strong>Check wiring connections to the control board</strong> &ndash; With the refrigerator unplugged, inspect the wiring harness connectors to the main control board for looseness or corrosion.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>HRS typically requires main control board replacement, which must be the correct board for your specific Monogram model. Call {$phone} for factory-certified Monogram refrigerator repair.</p>
HTML;

// ── OVEN ────────────────────────────────────────────────────

$all_content['f0-oven-stuck-touch-pad'] = <<<HTML
<h2>What Does Monogram Oven Error Code F0 Mean?</h2>
<p>The F0 error code on a Monogram oven or range indicates a <strong>stuck touch pad (shorted key)</strong>. The oven&rsquo;s control board is detecting a continuously pressed key or button on the control panel. When any key is detected as being held down for longer than a set time limit (typically 60 seconds), F0 is triggered to prevent unintended operation.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Food or grease on the touch pad</strong> &ndash; Spillover that has seeped under the touch pad surface can cause a key to be continuously activated.</li>
<li><strong>Damaged touch pad membrane</strong> &ndash; Physical damage, heat warping, or delamination of the touch pad membrane can cause a key to register as stuck.</li>
<li><strong>Failed touch pad/keypad assembly</strong> &ndash; The touch pad assembly has developed an internal electrical fault.</li>
<li><strong>Control board fault</strong> &ndash; In rare cases, the control board itself misreads a stuck key when the touch pad is actually fine.</li>
</ul>
<h2>How to Troubleshoot F0</h2>
<ol>
<li><strong>Clean the control panel</strong> &ndash; With the oven off and cooled, gently clean around all touch pad keys with a damp cloth. Remove any grease or food residue, especially around key edges.</li>
<li><strong>Hard reset</strong> &ndash; Turn off the circuit breaker for the oven for 5 minutes, then restore power. If F0 immediately reappears, the touch pad is physically stuck.</li>
<li><strong>Disconnect the touch pad ribbon cable</strong> &ndash; A technician can disconnect the touch pad ribbon cable from the control board to determine whether F0 clears (board is fine, touch pad is faulty) or persists (board is faulty).</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Touch pad and control board replacement should be performed by a certified technician. Call {$phone} to schedule Monogram oven repair.</p>
HTML;

$all_content['f2-oven-temperature-too-high'] = <<<HTML
<h2>What Does Monogram Oven Error Code F2 Mean?</h2>
<p>The F2 error code on a Monogram oven or range indicates that the <strong>oven temperature has exceeded the safe maximum threshold</strong> (typically above 615°F for bake/broil modes, or above approximately 950°F during self-clean). When F2 appears, the oven shuts down all heating to protect the appliance and your home from a potential runaway temperature condition.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Stuck-open relay on the control board</strong> &ndash; A relay on the control board has failed in the closed (on) position, allowing continuous power to the heating element even after the temperature set point is reached.</li>
<li><strong>Failed oven temperature sensor (RTD probe)</strong> &ndash; If the temperature sensor fails in a way that makes it read lower than actual temperature, the board keeps heating indefinitely until the actual temperature exceeds the F2 threshold.</li>
<li><strong>Improper self-clean operation</strong> &ndash; F2 during self-clean is often normal if the oven temperature climbs above the self-clean limit; some models require a control board replacement if F2 occurs repeatedly during self-clean.</li>
</ul>
<h2>How to Troubleshoot F2</h2>
<ol>
<li><strong>Allow the oven to cool completely</strong> &ndash; Do not attempt to open the oven or touch any components while it is hot.</li>
<li><strong>Hard reset</strong> &ndash; Turn off the oven circuit breaker for 5 minutes, then restore power. Attempt a bake cycle at a low temperature and monitor.</li>
<li><strong>Check the oven temperature sensor resistance</strong> &ndash; At room temperature the RTD sensor should read approximately 1080&ndash;1100 ohms. A reading significantly outside this range indicates a failed sensor.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>F2 involves a potential overheating risk and should be diagnosed professionally. Call {$phone} for certified Monogram oven repair.</p>
HTML;

$all_content['f3-oven-open-temperature-sensor'] = <<<HTML
<h2>What Does Monogram Oven Error Code F3 Mean?</h2>
<p>The F3 error code on a Monogram oven or range indicates that the <strong>oven temperature sensor (RTD probe) circuit is open</strong> &mdash; meaning the sensor or its wiring has an open circuit and no temperature reading is being received by the control board. Without a valid temperature reading, the oven cannot operate safely and shuts down.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed oven temperature sensor (RTD probe)</strong> &ndash; The most common cause. The sensor itself has developed an open circuit, typically due to the resistance element breaking internally.</li>
<li><strong>Loose or disconnected sensor wiring</strong> &ndash; The wiring connector at the sensor probe has come loose, especially after moving the range or cleaning behind it.</li>
<li><strong>Broken wiring harness</strong> &ndash; Wiring to the sensor has been pinched or burned by a heating element.</li>
</ul>
<h2>How to Troubleshoot F3</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Turn off the circuit breaker for 5 minutes and restore power. If F3 returns immediately, the sensor circuit has a genuine open fault.</li>
<li><strong>Inspect the sensor connector</strong> &ndash; With power off, locate the oven temperature sensor (a probe extending into the oven cavity, usually at the upper back wall). Check that the connector at the back of the oven is fully seated.</li>
<li><strong>Test the sensor resistance</strong> &ndash; At room temperature (approximately 70°F), an RTD sensor should read approximately 1080&ndash;1100 ohms. An open circuit reading (OL/infinite) on a multimeter confirms a failed sensor.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If wiring and connections are intact but F3 persists, the temperature sensor or control board needs replacement. Call {$phone} for Monogram oven service.</p>
HTML;

$all_content['f4-oven-shorted-temperature-sensor'] = <<<HTML
<h2>What Does Monogram Oven Error Code F4 Mean?</h2>
<p>The F4 error code on a Monogram oven or range indicates that the <strong>oven temperature sensor (RTD probe) circuit is shorted</strong>. The control board is reading an abnormally low resistance from the sensor, which typically means the sensor is reading a falsely high temperature or has experienced an internal short circuit.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed oven temperature sensor (shorted internally)</strong> &ndash; The resistance element inside the probe has shorted, causing it to read a very low resistance value.</li>
<li><strong>Pinched sensor wiring (wires touching)</strong> &ndash; The two sensor wires have been pinched together, creating a short circuit and a false low-resistance reading.</li>
<li><strong>Moisture or grease ingress into the sensor connector</strong> &ndash; Liquid or conductive grease between the sensor connector pins can simulate a short circuit.</li>
</ul>
<h2>How to Troubleshoot F4</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Turn off the circuit breaker for 5 minutes and restore power.</li>
<li><strong>Inspect the sensor wiring</strong> &ndash; With power off, trace the sensor wiring from the probe to the control board connection. Look for pinched, melted, or burned sections where the wires may be touching.</li>
<li><strong>Test the sensor resistance</strong> &ndash; At room temperature the RTD probe should read approximately 1080&ndash;1100 ohms. A very low reading (near zero) on a multimeter confirms an internal short in the sensor.</li>
<li><strong>Dry the connector</strong> &ndash; If grease or moisture is present in the connector, clean and dry thoroughly before retesting.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the sensor or its wiring has failed, call {$phone} for certified Monogram oven repair using genuine parts.</p>
HTML;

$all_content['f9-oven-door-lock-circuit-fault'] = <<<HTML
<h2>What Does Monogram Oven Error Code F9 Mean?</h2>
<p>The F9 error code on a Monogram oven or range indicates a <strong>door lock circuit fault</strong>. The door lock mechanism (used during self-clean cycles) is not responding correctly to the control board. F9 may appear when the board sends a lock command and does not receive the expected confirmation signal from the door lock assembly.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed door lock assembly (motor and/or switch)</strong> &ndash; The motorized door lock actuator has failed mechanically or electrically.</li>
<li><strong>Stuck door lock mechanism</strong> &ndash; The lock latch is physically stuck or obstructed and cannot reach the locked position.</li>
<li><strong>Loose wiring to the door lock assembly</strong> &ndash; The connector at the door lock motor or switch has come loose.</li>
<li><strong>Control board relay fault</strong> &ndash; The relay on the control board that powers the door lock motor has failed.</li>
</ul>
<h2>How to Troubleshoot F9</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Turn off the circuit breaker for 5 minutes and restore power. Attempt to cancel any active self-clean cycle.</li>
<li><strong>Inspect the door lock area</strong> &ndash; Look at the door lock latch area (typically upper-right of the oven door frame) for visible obstructions or damage.</li>
<li><strong>Check wiring connector to the door lock</strong> &ndash; With power off, locate the door lock assembly and verify its wiring connector is fully seated.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Door lock assembly replacement in Monogram ovens requires partial disassembly of the door frame. Call {$phone} for certified service.</p>
HTML;

$all_content['fff-oven-eeprom-failure'] = <<<HTML
<h2>What Does Monogram Oven Error Code FFF Mean?</h2>
<p>The FFF error code on a Monogram oven or range indicates a <strong>control board EEPROM failure</strong>. The EEPROM (Electrically Erasable Programmable Read-Only Memory) chip on the control board stores appliance settings, calibration data, and operational parameters. When this memory chip fails or its data becomes corrupted, FFF is triggered and the oven is unable to operate.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power surge or voltage spike</strong> &ndash; A sudden voltage spike can corrupt or physically damage the EEPROM chip on the control board.</li>
<li><strong>EEPROM chip failure due to age</strong> &ndash; EEPROM chips have a finite number of write cycles and can eventually fail.</li>
<li><strong>Control board failure</strong> &ndash; The control board has failed, affecting the EEPROM subsystem.</li>
</ul>
<h2>How to Troubleshoot FFF</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Turn off the circuit breaker for 10&ndash;15 minutes and restore power. Occasionally a soft memory fault will clear with a full power cycle.</li>
<li><strong>Do not attempt further self-repair</strong> &ndash; EEPROM failure typically requires control board replacement. There is no user-level fix for a failed EEPROM chip.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>FFF always requires a new control board programmed with the correct firmware for your Monogram oven model. Call {$phone} for factory-certified Monogram oven repair.</p>
HTML;

// ── COOKTOP ─────────────────────────────────────────────────

$all_content['f-induction-no-cookware-detected'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F Mean?</h2>
<p>The F error code on a Monogram induction cooktop indicates that <strong>no compatible cookware has been detected</strong> on the active cooking zone. Induction cooktops require ferromagnetic cookware (cast iron, magnetic stainless steel) to generate heat. If incompatible cookware is placed on a zone, or no cookware is present, the F code is displayed as a safety feature &mdash; the element never heats.</p>
<h2>Is the F Code an Error?</h2>
<p>In most cases, F on a Monogram induction cooktop is <strong>not a fault or malfunction</strong> &mdash; it is an informational alert telling you the active zone cannot detect compatible cookware. The cooktop is operating as designed.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Incompatible cookware</strong> &ndash; Aluminum, copper, glass, ceramic, or non-magnetic stainless steel pots and pans will not work on induction.</li>
<li><strong>Cookware too small for the zone</strong> &ndash; If the base of the cookware is smaller than the minimum size for the cooking zone, the cooktop may not detect it.</li>
<li><strong>Cooktop surface not fully cooled from previous use</strong> &ndash; In rare cases, residual heat affects induction sensor readings temporarily.</li>
<li><strong>Faulty induction coil or zone control</strong> &ndash; If compatible cookware is placed on the zone and F persists, there may be a hardware fault in the zone&rsquo;s induction coil or control circuit.</li>
</ul>
<h2>How to Resolve the F Code</h2>
<ol>
<li><strong>Test cookware compatibility</strong> &ndash; Hold a magnet to the bottom of the pot or pan. If the magnet sticks strongly, the cookware is compatible. If it doesn&rsquo;t stick, the cookware is not suitable for induction.</li>
<li><strong>Use properly sized cookware</strong> &ndash; Ensure the cookware base diameter matches or exceeds the minimum zone size marked on the cooktop.</li>
<li><strong>Try a different zone</strong> &ndash; If compatible cookware still shows F on one zone, test on another zone to determine if it is a zone-specific hardware fault.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If compatible, correctly sized cookware consistently triggers F on a specific zone, the induction coil or zone control board for that burner may have failed. Call {$phone} for Monogram cooktop service.</p>
HTML;

$all_content['f7x-cooling-fan-speed-too-low'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F7X Mean?</h2>
<p>The F7X error code on a Monogram cooktop (where X is a digit identifying the specific zone or fan) indicates that the <strong>cooling fan speed is too low</strong>. Monogram induction and gas cooktops use internal cooling fans to prevent the electronics from overheating. When the control board detects that a cooling fan is running below its expected speed, F7X is triggered and the cooktop may shut down to protect the electronics.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Blocked fan intake</strong> &ndash; Grease, debris, or a foreign object blocking the fan&rsquo;s intake vent is reducing airflow and fan speed.</li>
<li><strong>Failed fan motor</strong> &ndash; The fan motor bearings have worn out, reducing the fan&rsquo;s ability to reach its required speed.</li>
<li><strong>Loose fan wiring connector</strong> &ndash; The electrical connector to the fan motor has come loose, reducing power to the motor.</li>
<li><strong>Failed control board fan drive circuit</strong> &ndash; The circuit on the control board that powers the fan has partially failed.</li>
</ul>
<h2>How to Troubleshoot F7X</h2>
<ol>
<li><strong>Clean the cooktop ventilation area</strong> &ndash; Inspect the vent areas around and under the cooktop. Remove any grease buildup or debris from vent openings.</li>
<li><strong>Hard reset</strong> &ndash; Disconnect power at the circuit breaker for 5 minutes and restore. If F7X clears, monitor for recurrence.</li>
<li><strong>Listen for the fan</strong> &ndash; During operation, you should hear a faint fan sound from the cooktop. Silence suggests a failed or disconnected fan motor.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Cooling fan access requires removing the cooktop from the counter. Call {$phone} for professional Monogram cooktop service.</p>
HTML;

$all_content['f160-pan-detection-communication-failure'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F160 Mean?</h2>
<p>The F160 error code on a Monogram induction cooktop indicates a <strong>pan detection communication failure</strong>. The cooktop&rsquo;s internal communication bus between the main control board and the individual zone control modules has experienced a fault. Zone modules use this bus to report pan detection status and receive heating commands. When communication is lost, F160 is triggered.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Loose internal wiring connector</strong> &ndash; A connector on the internal communication harness between the main board and zone modules has come loose, often from vibration during installation or shipping.</li>
<li><strong>Failed zone control module</strong> &ndash; One of the individual induction zone control boards has failed, disrupting the communication bus.</li>
<li><strong>Failed main control board</strong> &ndash; The main board&rsquo;s communication interface has failed.</li>
<li><strong>Power surge</strong> &ndash; A voltage spike has damaged the communication circuitry on one or more boards.</li>
</ul>
<h2>How to Troubleshoot F160</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Disconnect power at the circuit breaker for 5&ndash;10 minutes and restore power. A soft communication fault may clear with a full power cycle.</li>
<li><strong>Check for intermittent occurrence</strong> &ndash; If F160 only appears occasionally, it may be an intermittent loose connector that vibration makes worse during cooking.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>F160 requires accessing internal cooktop wiring and control boards, which requires removing the cooktop from the counter. Call {$phone} for expert Monogram cooktop diagnosis and repair.</p>
HTML;

// ── MICROWAVE ───────────────────────────────────────────────

$all_content['f1-microwave-open-thermal-sensor'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F1 Mean?</h2>
<p>The F1 error code on a Monogram microwave indicates an <strong>open thermal sensor</strong> &mdash; the thermal sensor (thermistor) that monitors the microwave cavity or magnetron temperature has developed an open circuit, meaning no temperature reading is being received by the control board. The microwave disables heating as a safety precaution.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed thermal sensor (open circuit)</strong> &ndash; The thermistor has developed an open circuit due to heat fatigue or age.</li>
<li><strong>Loose wiring connector to the thermal sensor</strong> &ndash; The connector has come loose from the sensor.</li>
<li><strong>Overheating event</strong> &ndash; A previous overheating incident may have damaged the sensor or its wiring harness.</li>
</ul>
<h2>How to Troubleshoot F1</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Unplug the microwave for 2&ndash;3 minutes and restore power. If F1 immediately returns, the sensor has a genuine fault.</li>
<li><strong>Allow the microwave to cool</strong> &ndash; If the microwave was used heavily, allow 30 minutes to cool before retrying. Some thermal sensors have a built-in reset that clears when the temperature drops.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Microwave repair involves high-voltage components that can be dangerous even when unplugged (capacitors hold charge). Do not attempt to service the microwave yourself. Call {$phone} for certified Monogram microwave repair.</p>
HTML;

$all_content['f3-microwave-shorted-touch-pad'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F3 Mean?</h2>
<p>The F3 error code on a Monogram microwave indicates a <strong>shorted touch pad panel</strong>. The control board has detected one or more keys on the touch pad as continuously activated (stuck), which prevents normal operation.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Food splatter or moisture on the touch pad</strong> &ndash; Liquid or food residue that has seeped under the touch pad membrane is bridging key contacts.</li>
<li><strong>Damaged touch pad membrane</strong> &ndash; Physical damage or delamination is causing key contacts to touch.</li>
<li><strong>Failed touch pad/keypad assembly</strong> &ndash; Internal failure of the membrane switch assembly.</li>
</ul>
<h2>How to Troubleshoot F3</h2>
<ol>
<li><strong>Clean the control panel</strong> &ndash; Unplug the microwave. Wipe the entire touch pad surface with a damp cloth, paying careful attention to the seams around each key. Allow to dry completely before restoring power.</li>
<li><strong>Hard reset</strong> &ndash; Unplug for 5 minutes and restore power. If F3 does not immediately return, the moisture/residue was the cause.</li>
<li><strong>Inspect for physical damage</strong> &ndash; Look for bubbling, delamination, or cracks in the touch pad overlay.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Touch pad replacement in Monogram built-in microwaves requires disassembly. Call {$phone} for certified Monogram microwave repair.</p>
HTML;

$all_content['pf-888-power-failure-display-reset'] = <<<HTML
<h2>What Does Monogram Microwave Error Code PF or 888/8888 Mean?</h2>
<p>The PF code (or a display showing 888 or 8888) on a Monogram microwave indicates a <strong>power failure or display reset condition</strong>. This is an informational alert that the microwave lost power and has restarted, or that the display needs to be reset after power was interrupted.</p>
<h2>What to Do When You See PF or 888/8888</h2>
<ol>
<li><strong>Reset the clock</strong> &ndash; Press the Clock pad and enter the current time using the number pads. This clears the PF/888 display and returns the microwave to normal standby mode.</li>
<li><strong>Check the power outlet</strong> &ndash; Ensure the microwave is plugged into a dedicated 20-amp circuit. Overloaded circuits can cause intermittent power interruptions that trigger the PF reset.</li>
<li><strong>Check GFCI outlets</strong> &ndash; If the microwave is on a circuit protected by a GFCI outlet, verify the GFCI has not tripped.</li>
<li><strong>Monitor for frequent recurrence</strong> &ndash; If PF/888 appears frequently without an actual power outage, the microwave&rsquo;s internal power supply board may be failing intermittently.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If PF or 888 appears repeatedly without power interruptions, the control board or power supply board may need replacement. Call {$phone} for Monogram microwave service.</p>
HTML;

// ── FREEZER ─────────────────────────────────────────────────

$all_content['ff-freezer-temperature-alarm'] = <<<HTML
<h2>What Does Monogram Freezer Error Code FF Mean?</h2>
<p>The FF error code on a Monogram standalone freezer indicates that the <strong>freezer temperature is too high</strong> &mdash; the compartment temperature has risen above the safe threshold. This alarm is critical as food safety is directly at risk when a freezer fails to maintain proper temperatures (0°F / -18°C or below).</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Door left open or door seal failure</strong> &ndash; Warm air entering the freezer through an open door or a damaged gasket overwhelms the cooling system.</li>
<li><strong>Failed evaporator fan motor</strong> &ndash; If the evaporator fan is not running, cold air cannot be circulated through the freezer compartment.</li>
<li><strong>Frost buildup blocking airflow</strong> &ndash; Excessive ice on the evaporator coils restricts airflow and reduces cooling capacity.</li>
<li><strong>Failed defrost system</strong> &ndash; A failed defrost heater or thermostat allows unchecked ice to build up on the evaporator.</li>
<li><strong>Failed compressor or refrigerant leak</strong> &ndash; A sealed system failure prevents adequate heat removal from the freezer compartment.</li>
<li><strong>Recent large food load</strong> &ndash; Adding a large amount of warm food to the freezer at once can temporarily trigger the alarm while the freezer catches up.</li>
</ul>
<h2>How to Troubleshoot the FF Error Code</h2>
<ol>
<li><strong>Check the door seal</strong> &ndash; Close the door on a piece of paper. If you can pull the paper out without resistance, the seal is compromised and needs replacement.</li>
<li><strong>Listen for the evaporator fan</strong> &ndash; With the door open (and the door switch held in), listen for fan noise inside the compartment. Silence suggests a failed fan motor.</li>
<li><strong>Check condenser coils</strong> &ndash; Dusty condenser coils reduce efficiency. Clean with a vacuum and coil brush.</li>
<li><strong>Manual defrost</strong> &ndash; Unplug the freezer for 24&ndash;48 hours with the door open to fully defrost. If temperatures return to normal after full defrost, the defrost system has failed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Most causes of FF require professional diagnosis and repair. <strong>Contact our Monogram freezer repair team immediately</strong> to protect your frozen food and appliance. Call {$phone} to schedule your repair appointment today.</p>
HTML;

$all_content['de-freezer-defrost-system-fault'] = <<<HTML
<h2>What Does Monogram Freezer Error Code dE Mean?</h2>
<p>The dE error code on a Monogram standalone freezer indicates a <strong>defrost system problem</strong>. The freezer&rsquo;s automatic defrost system has failed to complete a normal defrost cycle, which will lead to progressive ice buildup on the evaporator coils and eventual temperature rise if left unaddressed.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed defrost heater</strong> &ndash; The electric heater assembly that melts frost from the evaporator coils has failed open.</li>
<li><strong>Failed defrost thermostat (bi-metal)</strong> &ndash; The safety thermostat that cuts off the defrost heater at approximately 50°F has failed open, preventing the heater from receiving power.</li>
<li><strong>Failed defrost timer or adaptive defrost control</strong> &ndash; The component that initiates the defrost cycle has failed.</li>
<li><strong>Failed evaporator temperature sensor</strong> &ndash; An inaccurate temperature reading prevents proper defrost cycle control.</li>
</ul>
<h2>How to Troubleshoot the dE Error Code</h2>
<ol>
<li><strong>Manual defrost test</strong> &ndash; Unplug the freezer, remove all food (store in coolers with ice), and leave the door open for 24&ndash;48 hours to allow complete defrost. Plug back in. If the freezer works normally after full defrost, the auto-defrost system has failed and will need repair before ice rebuilds.</li>
<li><strong>Listen during defrost</strong> &ndash; During a scheduled defrost cycle you should hear a faint hissing/sizzling sound from inside the freezer as frost melts. Silence confirms the defrost heater is not activating.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Defrost component testing and replacement requires removing the freezer&rsquo;s interior back panel. Call {$phone} for certified Monogram freezer repair service.</p>
HTML;

$all_content['cc-freezer-temperature-incorrect'] = <<<HTML
<h2>What Does Monogram Freezer Error Code CC Mean?</h2>
<p>The CC error code on a Monogram standalone freezer indicates that the <strong>freezer compartment temperature is incorrect</strong> &mdash; specifically that it is warmer than the set point and is not maintaining the expected temperature. CC is a sustained temperature warning, typically triggered when the freezer has been unable to reach or maintain its set temperature for an extended period.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Overloaded freezer</strong> &ndash; Packing the freezer too full can restrict internal airflow, reducing cooling efficiency and causing temperature rise.</li>
<li><strong>Ambient temperature too high</strong> &ndash; If the freezer is in a very warm environment (garage in summer), it may struggle to maintain freezer temperatures.</li>
<li><strong>Condenser coils dirty</strong> &ndash; Dust-covered condenser coils reduce the freezer&rsquo;s ability to reject heat efficiently.</li>
<li><strong>Failed evaporator fan motor</strong> &ndash; Poor air circulation inside the compartment leads to uneven temperatures and overall temperature rise.</li>
<li><strong>Defrost system failure</strong> &ndash; Ice buildup on the evaporator from a failed defrost system blocks airflow and reduces cooling.</li>
<li><strong>Temperature control (thermostat) set too warm</strong> &ndash; The set point may have been inadvertently changed.</li>
</ul>
<h2>How to Troubleshoot the CC Error Code</h2>
<ol>
<li><strong>Check the temperature setting</strong> &ndash; Verify the freezer is set to 0°F (&minus;18°C) or colder.</li>
<li><strong>Clean condenser coils</strong> &ndash; Vacuum and brush the condenser coils (usually at the back or underneath the freezer) to restore heat rejection efficiency.</li>
<li><strong>Reduce freezer load</strong> &ndash; Ensure items are not packed so tightly that air cannot circulate. Leave some space between items and ensure vents are not blocked.</li>
<li><strong>Verify the environment</strong> &ndash; If the freezer is in a hot space, ensure adequate ventilation around the appliance (minimum clearances per installation guide).</li>
<li><strong>Check the evaporator fan</strong> &ndash; Listen for fan operation when the door is open and the door switch is pressed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If CC persists after addressing environmental factors, the freezer needs professional service. Call {$phone} for certified Monogram freezer repair.</p>
HTML;

// ── FREEZER (additional) ────────────────────────────────────

$all_content['pf-freezer-power-failure'] = <<<HTML
<h2>What Does Monogram Freezer Error Code PF Mean?</h2>
<p>The PF error code on a Monogram freezer stands for <strong>Power Failure</strong> &mdash; it indicates that the freezer&rsquo;s electrical power supply was interrupted since the last time the alert was acknowledged. This is an informational alert rather than a component malfunction.</p>
<h2>What to Do When PF Appears</h2>
<ol>
<li><strong>Press Clear/Alarm Reset</strong> &ndash; Press the Alarm Reset, Clear, or System Check button on the control panel to acknowledge and clear the PF code.</li>
<li><strong>Assess food safety</strong> &ndash; If the outage lasted less than 4 hours and the door remained closed, food should still be safe. A full freezer stays frozen approximately 48 hours if kept closed; a half-full freezer for about 24 hours.</li>
<li><strong>Check food temperature</strong> &ndash; If food is still at 0&deg;F (&minus;18&deg;C) or below, it is safe.</li>
<li><strong>When in doubt, throw it out</strong> &ndash; If you are unsure how long power was out or food shows signs of thawing, discard perishable items.</li>
<li><strong>Check the circuit breaker</strong> &ndash; Verify the breaker for the freezer is fully in the ON position.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If PF appears frequently without a known power outage, the freezer may have an intermittent electrical problem or failing control board. <strong>Contact our Monogram freezer repair team</strong> at {$phone} for diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['ci-freezer-check-ice-maker'] = <<<HTML
<h2>What Does Monogram Freezer Error Code CI Mean?</h2>
<p>The CI error code on a Monogram freezer indicates <strong>Check Ice Maker</strong> &mdash; the diagnostic system has detected that the ice maker is not operating within expected parameters, either failing to complete a harvest cycle or failing to fill with water properly.</p>
<h2>Common Causes of the CI Error Code</h2>
<ul>
<li><strong>Ice jam in the ice maker mold or ice bin</strong> &ndash; Fused or clumped ice blocks the ejector from completing a harvest cycle.</li>
<li><strong>Frozen fill tube</strong> &ndash; The small tube delivering water to the ice maker can freeze solid.</li>
<li><strong>Failed water inlet valve</strong> &ndash; The solenoid valve that supplies water to the ice maker has failed.</li>
<li><strong>Ice maker module failure</strong> &ndash; The electronic module controlling fill, freeze, and harvest cycles has failed.</li>
<li><strong>Freezer temperature too warm</strong> &ndash; If the freezer temperature is above 10&deg;F (&minus;12&deg;C), ice cannot freeze within the cycle time.</li>
</ul>
<h2>How to Troubleshoot the CI Error Code</h2>
<ol>
<li><strong>Toggle the ice maker</strong> &ndash; Turn the ice maker switch off, wait 30 seconds, and turn it back on to force a cycle restart.</li>
<li><strong>Check for ice jams</strong> &ndash; Remove the ice bin and break up any clumped or fused ice.</li>
<li><strong>Thaw the fill tube</strong> &ndash; If the fill tube is frozen, carefully apply low heat with a hair dryer.</li>
<li><strong>Check freezer temperature</strong> &ndash; Verify the freezer is at 0&deg;F (&minus;18&deg;C).</li>
<li><strong>Verify water supply</strong> &ndash; Ensure the water supply line is connected and the valve is open.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If CI persists, the water inlet valve or ice maker module may require replacement. Call {$phone} to schedule Monogram freezer repair.</p>
HTML;

// ── WASHER (additional) ─────────────────────────────────────

$all_content['e66-e67-temperature-sensor-malfunction'] = <<<HTML
<h2>What Do Monogram Washer Error Codes E66 and E67 Mean?</h2>
<p>The E66 and E67 error codes on a Monogram washing machine indicate a <strong>temperature sensor (thermistor) malfunction</strong>. The temperature sensor monitors water temperature in the wash tub, allowing the control board to regulate heating and verify that water is within the expected temperature range. When the sensor provides readings outside the expected range, these codes are triggered.</p>
<h2>Common Causes of the E66 / E67 Error Codes</h2>
<ul>
<li><strong>Failed temperature sensor (thermistor)</strong> &ndash; The thermistor&rsquo;s internal resistance element has failed, producing out-of-range readings.</li>
<li><strong>Disconnected thermistor wiring</strong> &ndash; The sensor connector has come loose from the control board or sensor itself.</li>
<li><strong>Thermistor contaminated</strong> &ndash; In some cases, detergent buildup on the sensor element can affect readings.</li>
</ul>
<h2>How to Troubleshoot the E66 / E67 Error Codes</h2>
<ol>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds and retry. A temporary glitch can cause false thermistor readings.</li>
<li><strong>Test hot water temperature</strong> &ndash; Run hot water at a nearby sink. If extremely hot (above 140&deg;F) or cold, this could affect sensor readings.</li>
<li><strong>Check thermistor resistance</strong> &ndash; A technician can test the thermistor&rsquo;s resistance with a multimeter &mdash; it should follow a predictable curve with temperature.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If E66 or E67 persists, the thermistor likely needs replacement. <strong>Contact our Monogram washer repair team</strong> at {$phone} for professional diagnosis and replacement using factory-certified Monogram parts.</p>
HTML;

// ── DRYER (additional) ──────────────────────────────────────

$all_content['000-no-errors-self-test'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 000 Mean?</h2>
<p>The 000 code on a Monogram dryer indicates that <strong>no errors or fault codes have been stored</strong> &mdash; the self-diagnostic cycle completed without finding any recorded faults. This code appears when you manually enter the dryer&rsquo;s diagnostic mode and the control board reports no current or stored faults.</p>
<p>This is a normal and positive result. If your dryer is behaving abnormally but shows 000, the problem may be mechanical (worn drum seal, belt, or pulley) rather than electronic.</p>
<h2>How to Use the Diagnostic Mode</h2>
<ol>
<li><strong>Access diagnostic mode</strong> &ndash; Follow the button sequence for your specific Monogram dryer model (consult the service manual).</li>
<li><strong>Record all codes</strong> &ndash; Cycle through all fault codes. Note any codes other than 000.</li>
<li><strong>Exit diagnostic mode</strong> &ndash; Follow the exit procedure or simply unplug the dryer.</li>
</ol>
<p>No repair is needed for a 000 code result. If problems persist, contact our Monogram dryer repair team at {$phone} for mechanical inspection.</p>
HTML;

$all_content['006-stuck-control-panel-button'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 006 Mean?</h2>
<p>The 006 error code on a Monogram dryer indicates that <strong>a control panel button is stuck or continuously pressed</strong>. The control board monitors all panel buttons and if any button appears held down for an abnormally long period, the 006 code is triggered as a safety measure.</p>
<h2>Common Causes of the 006 Error Code</h2>
<ul>
<li><strong>Physically stuck button</strong> &ndash; A button has become stuck in the depressed position from a damaged mechanism, warped panel, or foreign object.</li>
<li><strong>Worn or failed button contact</strong> &ndash; A button&rsquo;s internal electrical contact can fail in the closed (pressed) position.</li>
<li><strong>Moisture or contamination under the panel</strong> &ndash; Liquid entering the control panel can create short circuits that mimic a stuck button.</li>
</ul>
<h2>How to Troubleshoot the 006 Error Code</h2>
<ol>
<li><strong>Push each button</strong> &ndash; Firmly press and release each button one at a time. A physically stuck button may release with firm pressure.</li>
<li><strong>Unplug and clean</strong> &ndash; Unplug the dryer. Clean around the control panel edges with a slightly damp cloth to remove residue causing sticking.</li>
<li><strong>Reset the dryer</strong> &ndash; After cleaning, restore power and check if the code clears.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the 006 error persists, the control panel or button component needs replacement. <strong>Contact our Monogram dryer repair team</strong> at {$phone} for professional control panel diagnosis and repair.</p>
HTML;

$all_content['007-miswired-power-supply'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 007 Mean?</h2>
<p>The 007 error code on a Monogram dryer indicates a <strong>miswired power supply</strong> &mdash; specifically, the Line 2 and Neutral connections on the dryer&rsquo;s terminal block have been swapped. Electric dryers use a 240V supply with two hot legs (L1 and L2) and a neutral wire. If L2 and Neutral are swapped, the control board detects this and displays 007.</p>
<p><strong>This is an electrical safety issue &mdash; do not operate the dryer with a 007 error.</strong></p>
<h2>How to Fix the 007 Error Code</h2>
<ol>
<li><strong>Disconnect power</strong> &ndash; Turn off the circuit breaker for the dryer. Do NOT work on the terminal block with power connected.</li>
<li><strong>Access the terminal block</strong> &ndash; Remove the rear panel access cover for the terminal block.</li>
<li><strong>Correct the wiring</strong> &ndash; Consult the wiring diagram inside the dryer and ensure L1, L2, and Neutral are connected to the correct terminals.</li>
<li><strong>Restore power and retest</strong> &ndash; After correcting the wiring, restore power and verify the 007 code no longer appears.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Electrical wiring should only be performed by qualified personnel. If you are not comfortable with 240V connections, contact our Monogram dryer repair team at {$phone} or a licensed electrician.</p>
HTML;

// ── DISHWASHER ──────────────────────────────────────────────

$all_content['start-light-flashing-cycle-interrupted'] = <<<HTML
<h2>What Does Monogram Dishwasher Start Light Flashing Mean?</h2>
<p>A flashing Start light on a Monogram dishwasher indicates that <strong>the dishwasher door was opened during an active wash cycle or the cycle was otherwise interrupted</strong>. When the control board loses the door-locked signal during an active cycle, it pauses the cycle and causes the Start indicator to flash.</p>
<p>This is not a component malfunction &mdash; it is a cycle state notification that requires a simple user action to resolve.</p>
<h2>How to Fix the Flashing Start Light</h2>
<ol>
<li><strong>Press the Start pad once</strong> &ndash; Press the Start/Resume button once on the control panel.</li>
<li><strong>Close the door within 4 seconds</strong> &ndash; Immediately close and fully latch the dishwasher door within 4 seconds of pressing Start.</li>
<li><strong>The cycle will resume</strong> &ndash; The dishwasher will resume the interrupted cycle from where it left off.</li>
<li><strong>If the cycle cannot resume</strong> &ndash; Select the desired wash cycle and press Start normally to begin a new cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the Start light flashes immediately when a new cycle begins without the door being opened, or the dishwasher does not resume after pressing Start, there may be a door latch or control board issue. <strong>Contact our Monogram dishwasher repair team</strong> at {$phone} for professional diagnosis using factory-certified Monogram parts.</p>
HTML;

$all_content['beeping-once-per-minute-door-open'] = <<<HTML
<h2>What Does Monogram Dishwasher Beeping Once Per Minute Mean?</h2>
<p>If your Monogram dishwasher is <strong>beeping once per minute</strong>, this indicates that the dishwasher door was opened or left open during active operation. This is a safety and reminder alert &mdash; the dishwasher cannot complete its cycle because the door is open or unlatched.</p>
<h2>Common Causes of the Beeping Alert</h2>
<ul>
<li><strong>Door left open after opening during a cycle</strong> &ndash; If you opened the door to add a dish and did not fully close it.</li>
<li><strong>Door not fully latched</strong> &ndash; The door appears closed but has not clicked into a fully latched position.</li>
<li><strong>Failed door latch</strong> &ndash; A worn or broken door latch may prevent proper engagement.</li>
<li><strong>Door gasket interference</strong> &ndash; A displaced or damaged door gasket can prevent full closure.</li>
</ul>
<h2>How to Stop the Beeping</h2>
<ol>
<li><strong>Press Start</strong> &ndash; Press the Start button on the control panel.</li>
<li><strong>Close the door firmly</strong> &ndash; Push the door until you hear a solid click of the latch engaging.</li>
<li><strong>The beeping will stop</strong> &ndash; Once the door is latched with Start pressed, the beeping will cease and the cycle will resume.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If beeping persists even with the door firmly latched, the door latch assembly may need replacement. <strong>Contact our Monogram dishwasher repair team</strong> at {$phone} for professional latch diagnosis using factory-certified Monogram parts.</p>
HTML;

$all_content['leak-detected'] = <<<HTML
<h2>What Does Monogram Dishwasher "LEAK DETECTED" Mean?</h2>
<p>The &ldquo;LEAK DETECTED&rdquo; message on a Monogram dishwasher indicates that the dishwasher&rsquo;s <strong>built-in leak detection system has found water in the base pan</strong>. When water accumulates in the drip tray at the bottom of the dishwasher, a float switch rises and triggers this alert. The dishwasher automatically stops, shuts off the water inlet valve, and activates the drain pump.</p>
<p><strong>Do not ignore this alert</strong> &mdash; an unaddressed leak can cause water damage to your cabinetry and flooring.</p>
<h2>Common Causes of LEAK DETECTED</h2>
<ul>
<li><strong>Deteriorated door gasket</strong> &ndash; The rubber door seal can crack or stiffen, allowing water to leak past during wash cycles.</li>
<li><strong>Loose or cracked internal hoses</strong> &ndash; Hoses connecting the wash pump, spray arms, and drain pump can develop cracks or loosen at clamps.</li>
<li><strong>Overfilling from a faulty inlet valve</strong> &ndash; An inlet valve that fails to close can overfill the tub.</li>
<li><strong>Cracked sump or tub</strong> &ndash; In older units, the plastic tub or sump can develop hairline cracks.</li>
</ul>
<h2>How to Troubleshoot LEAK DETECTED</h2>
<ol>
<li><strong>Stop using the dishwasher</strong> &ndash; Do not run it again until the leak source is identified.</li>
<li><strong>Unplug or cut power</strong> &ndash; Turn off power at the circuit breaker.</li>
<li><strong>Check the door gasket</strong> &ndash; Inspect the perimeter of the door gasket for cracks or areas where it has separated.</li>
<li><strong>Allow the base pan to dry</strong> &ndash; The float switch will keep the alert active until the accumulated water evaporates or is removed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Internal hose replacements, gasket replacement, and inlet valve replacement require partial or full disassembly. <strong>Contact our Monogram dishwasher repair team</strong> at {$phone} for leak diagnosis and repair. Do not delay &mdash; water damage can escalate quickly.</p>
HTML;

$all_content['end-of-cycle-beeping'] = <<<HTML
<h2>What Does Monogram Dishwasher End-of-Cycle Beeping Mean?</h2>
<p>The beeping at the end of a Monogram dishwasher cycle is <strong>normal operation</strong> &mdash; it is the end-of-cycle completion signal indicating that the wash cycle has finished successfully. This is not an error code.</p>
<h2>How to Adjust the End-of-Cycle Beeping</h2>
<p>On most Monogram dishwasher models, the end-of-cycle beeping can be toggled on or off:</p>
<ol>
<li><strong>Make sure the dishwasher is not running</strong> &ndash; Ensure no cycle is active.</li>
<li><strong>Press the Dry Options button 5 times within 3 seconds</strong> &ndash; Or press the Heated Dry button, depending on your model.</li>
<li><strong>The sound setting will toggle</strong> &ndash; The dishwasher will indicate whether the end-of-cycle sound is now ON or OFF.</li>
<li><strong>Test the setting</strong> &ndash; Run a short cycle to verify the change.</li>
</ol>
<p>Note: The exact button combination may vary by model. Consult your Monogram dishwasher owner&rsquo;s manual for the specific procedure.</p>
<h2>When to Call a Professional</h2>
<p>If your Monogram dishwasher is beeping at unexpected times &mdash; not at the end of a cycle &mdash; this may indicate a fault code or sensor alert. <strong>Contact our Monogram dishwasher repair team</strong> at {$phone} to identify and resolve any non-routine beeping.</p>
HTML;

// ── REFRIGERATOR (additional) ────────────────────────────────

$all_content['cc-refrigerator-temperature-incorrect'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code CC Mean?</h2>
<p>The CC error code on a Monogram refrigerator indicates that the <strong>fresh food compartment temperature is incorrect and too warm</strong>. The control board monitors the internal temperature and compares it against your set temperature. When the actual temperature is significantly higher than the target for an extended period, the CC error is triggered.</p>
<h2>Common Causes of the CC Error Code</h2>
<ul>
<li><strong>Dust-clogged condenser coils</strong> &ndash; The most frequent cause. Coils coated with dust cannot efficiently dissipate heat, reducing overall cooling effectiveness.</li>
<li><strong>Refrigerator door left open</strong> &ndash; Extended door opening or a door that doesn&rsquo;t seal properly allows warm air in.</li>
<li><strong>Overstocked refrigerator</strong> &ndash; Blocking internal air vents with food items prevents cold air circulation.</li>
<li><strong>Damper control failure</strong> &ndash; A failed damper can limit cold air flow from the freezer to the fresh food section.</li>
<li><strong>Evaporator or condenser fan failure</strong> &ndash; A failed fan prevents proper air circulation.</li>
</ul>
<h2>How to Troubleshoot the CC Error Code</h2>
<ol>
<li><strong>Clean the condenser coils</strong> &ndash; Locate the coils behind the kick plate at the bottom front and vacuum thoroughly.</li>
<li><strong>Check door seals</strong> &ndash; Inspect gaskets for damage and ensure doors close and seal properly.</li>
<li><strong>Clear internal air vents</strong> &ndash; Rearrange contents to ensure nothing blocks the internal circulation vents.</li>
<li><strong>Check the temperature setting</strong> &ndash; Verify it is set to the recommended 37&deg;F (3&deg;C).</li>
<li><strong>Ensure adequate clearance</strong> &ndash; The refrigerator needs proper air clearance on all sides.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If CC persists after cleaning coils and checking door seals, a professional diagnosis is needed to test the damper, fans, and sealed system. <strong>Contact our Monogram refrigerator repair team</strong> at {$phone} for expert diagnosis using factory-certified Monogram parts.</p>
HTML;

// ── OVEN (additional) ────────────────────────────────────────

$all_content['f1-oven-system-watchdog-stuck-key'] = <<<HTML
<h2>What Does Monogram Oven Error Code F1 Mean?</h2>
<p>The F1 error code on a Monogram oven or range indicates either a <strong>stuck touch pad key or a system watchdog circuit malfunction</strong> on the electronic range control (ERC) board. The watchdog circuit is an internal monitoring system that verifies the board&rsquo;s processor is running correctly. If the processor hangs or produces unexpected outputs, the watchdog triggers an F1 fault.</p>
<p>This is one of the more serious oven error codes as it can indicate a fundamental failure of the control board&rsquo;s core electronics.</p>
<h2>Common Causes of the F1 Error Code</h2>
<ul>
<li><strong>Failed ERC board</strong> &ndash; The control board&rsquo;s internal processor, memory, or watchdog circuit has failed. This requires control board replacement.</li>
<li><strong>Stuck touch pad key</strong> &ndash; Similar to F0, a consistently stuck key can trigger F1 on some Monogram range models.</li>
<li><strong>Power surge damage</strong> &ndash; Voltage spikes can damage the watchdog circuit or processor.</li>
</ul>
<h2>How to Troubleshoot the F1 Error Code</h2>
<ol>
<li><strong>Reset the oven</strong> &ndash; Turn off the circuit breaker for 5 minutes to allow the control board&rsquo;s capacitors to fully discharge. Restore power and test.</li>
<li><strong>Inspect the touch pad</strong> &ndash; Check for any obviously stuck or damaged keys.</li>
<li><strong>Check for heat damage</strong> &ndash; Ensure oven vents are not blocked, as excessive heat can damage board components.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>The F1 error almost always requires control board replacement. The ERC board must be correctly matched to your specific Monogram oven model. <strong>Contact our Monogram oven repair team</strong> at {$phone} for accurate diagnosis and control board replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['f5-oven-relay-drive-circuit-failure'] = <<<HTML
<h2>What Does Monogram Oven Error Code F5 Mean?</h2>
<p>The F5 error code on a Monogram oven or range indicates a <strong>loss of relay drive circuit</strong> on the electronic range control (ERC) board. The relay drive circuit is responsible for sending control signals to the heating element relays. When this circuit fails, the control board can no longer reliably switch heating elements.</p>
<h2>Common Causes of the F5 Error Code</h2>
<ul>
<li><strong>Failed relay drive circuit on ERC board</strong> &ndash; An internal component (transistor, driver IC, or trace) responsible for energizing the output relays has failed.</li>
<li><strong>Failed output relay</strong> &ndash; The relay itself on the ERC board may have failed open or developed a high-resistance contact.</li>
<li><strong>Power surge damage</strong> &ndash; Voltage spikes can damage the relay drive circuitry.</li>
</ul>
<h2>How to Troubleshoot the F5 Error Code</h2>
<ol>
<li><strong>Reset the oven</strong> &ndash; Power cycle via the circuit breaker for 5 minutes. F5 from a temporary glitch may clear with a longer reset.</li>
<li><strong>Test oven function after reset</strong> &ndash; Check if the bake and broil elements cycle on and off normally.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>The F5 error requires replacement of the electronic range control (ERC) board. <strong>Contact our Monogram oven repair team</strong> at {$phone} for professional control board diagnosis and replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['f8-oven-shorted-meat-probe'] = <<<HTML
<h2>What Does Monogram Oven Error Code F8 Mean?</h2>
<p>The F8 error code on a Monogram oven or range indicates that the <strong>meat probe (temperature probe) is shorted or there is a problem with the probe circuit</strong>. When the probe or its receptacle port develops a short circuit, the control board detects the abnormal resistance and triggers F8.</p>
<h2>Common Causes of the F8 Error Code</h2>
<ul>
<li><strong>Damaged meat probe</strong> &ndash; The probe cable can be damaged by the oven door catching it, or the probe tip can short internally from heat damage.</li>
<li><strong>Contaminated probe receptacle</strong> &ndash; Food drips, grease, or moisture in the probe port can cause a short circuit.</li>
<li><strong>Faulty probe wiring</strong> &ndash; Internal wiring of the probe can short from repeated high-temperature exposure.</li>
</ul>
<h2>How to Troubleshoot the F8 Error Code</h2>
<ol>
<li><strong>Remove the meat probe</strong> &ndash; If a probe is inserted, remove it. F8 should clear immediately if the probe itself was shorted.</li>
<li><strong>Clean the probe receptacle</strong> &ndash; With the oven cooled and unpowered, clean the probe port with a dry cotton swab.</li>
<li><strong>Inspect the probe cable</strong> &ndash; Check for pinching, melting, or physical damage.</li>
<li><strong>Reset and test without probe</strong> &ndash; Reset the oven and run a normal bake cycle without the probe to confirm normal operation.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If F8 appears even with no probe inserted, the port or associated wiring may need repair. <strong>Contact our Monogram oven repair team</strong> at {$phone} for diagnosis using factory-certified Monogram parts.</p>
HTML;

// ── COOKTOP (additional) ─────────────────────────────────────

$all_content['f1-cooktop-stuck-touch-pad'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F1 Mean?</h2>
<p>The F1 error code on a Monogram cooktop indicates a <strong>stuck touch pad key</strong> &mdash; one or more buttons on the touch control panel have been detected in a continuously pressed or shorted state. The control system interprets this as an indefinitely pressed key and triggers F1 to prevent unintended cooking zone operation.</p>
<h2>Common Causes of the F1 Error Code</h2>
<ul>
<li><strong>Moisture or liquid under the touch control surface</strong> &ndash; Cooking condensation or spills that seep under the touch panel can short a key&rsquo;s sensors.</li>
<li><strong>Worn or failed touch pad membrane</strong> &ndash; The touch-sensitive layer can degrade over time, causing ghost key presses.</li>
<li><strong>Failed control board</strong> &ndash; The main control board can generate false key-press signals.</li>
<li><strong>Heavy object on the touch surface</strong> &ndash; Items placed on the cooktop in standby can register as a sustained key press.</li>
</ul>
<h2>How to Troubleshoot the F1 Error Code</h2>
<ol>
<li><strong>Clear the cooktop surface</strong> &ndash; Remove all items, cookware, and cloths from the touch control area.</li>
<li><strong>Power cycle the cooktop</strong> &ndash; Turn off the circuit breaker for 60 seconds, then restore power.</li>
<li><strong>Clean the touch panel</strong> &ndash; With power off, clean the panel with a soft damp cloth. Dry thoroughly before restoring power.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If F1 persists after cleaning and power cycling, the touch pad assembly or control board requires replacement. <strong>Contact our Monogram cooktop repair team</strong> at {$phone} for professional diagnosis using factory-certified Monogram parts.</p>
HTML;

$all_content['f113-cooktop-temperature-sensor'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F113 Mean?</h2>
<p>The F113 error code on a Monogram cooktop indicates that the <strong>cooktop temperature sensor (RTD) is reading out of the expected range</strong> &mdash; either an open circuit (broken sensor) or a value far outside normal operating parameters. The sensor monitors the cooktop&rsquo;s internal temperature to prevent overheating and protect electronic components.</p>
<h2>Common Causes of the F113 Error Code</h2>
<ul>
<li><strong>Open temperature sensor circuit</strong> &ndash; The sensor probe has developed an open circuit from thermal stress or physical damage.</li>
<li><strong>Disconnected sensor wiring</strong> &ndash; The wiring harness connecting the sensor to the control board has come loose.</li>
<li><strong>Failed RTD sensor</strong> &ndash; The resistance temperature detector has reached end of life or was damaged.</li>
</ul>
<h2>How to Troubleshoot the F113 Error Code</h2>
<ol>
<li><strong>Reset the cooktop</strong> &ndash; Turn off the circuit breaker for 60 seconds, then restore power.</li>
<li><strong>Test sensor resistance</strong> &ndash; A technician can measure the sensor resistance (expected ~1100 ohms at room temperature). An open circuit confirms failure.</li>
<li><strong>Check wiring connections</strong> &ndash; Verify the sensor connector is properly seated at the control board.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>The F113 error requires temperature sensor replacement. <strong>Contact our Monogram cooktop repair team</strong> at {$phone} for professional sensor replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['f161-cooktop-burner-sensor-fault'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F161 Mean?</h2>
<p>The F161 error code on a Monogram cooktop indicates a <strong>burner temperature sensor fault or a sensor calibration issue</strong> &mdash; the burner&rsquo;s temperature sensor is providing incorrect readings or requires calibration. This error is sometimes seen after a new control board or cooktop component has been installed.</p>
<h2>Common Causes of the F161 Error Code</h2>
<ul>
<li><strong>Newly installed control board requiring calibration</strong> &ndash; After replacing the main control board, sensor calibration must be completed.</li>
<li><strong>Burner temperature sensor fault</strong> &ndash; The sensor itself may be providing readings outside the calibrated range.</li>
<li><strong>Miscommunication between sensor and control board</strong> &ndash; Wiring or connector issues causing unreliable sensor data.</li>
</ul>
<h2>How to Troubleshoot the F161 Error Code</h2>
<ol>
<li><strong>Complete the calibration procedure</strong> &ndash; If a control board was recently replaced, perform the sensor calibration procedure in the Monogram service manual for your model.</li>
<li><strong>Reset the cooktop</strong> &ndash; Try a circuit breaker reset for 5 minutes before attempting calibration.</li>
<li><strong>Check sensor connections</strong> &ndash; Ensure all sensor wiring connections are secure.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If calibration was not recently required, F161 likely indicates a sensor failure. <strong>Contact our Monogram cooktop repair team</strong> at {$phone} for expert diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

// ── MICROWAVE (additional) ───────────────────────────────────

$all_content['f2-microwave-shorted-thermal-sensor'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F2 Mean?</h2>
<p>The F2 error code on a Monogram microwave indicates that the <strong>thermal sensor is shorted</strong> &mdash; the sensor&rsquo;s resistance reading is near zero, far below the normal operating range. A shorted thermal sensor sends a false &ldquo;very low temperature&rdquo; signal to the control board, which may cause the microwave to run heating continuously. The control board detects this and displays F2 as a safety fault.</p>
<h2>Common Causes of the F2 Error Code</h2>
<ul>
<li><strong>Shorted thermal sensor element</strong> &ndash; The internal resistance element in the thermistor has short-circuited from heat damage, moisture, or component failure.</li>
<li><strong>Pinched or damaged sensor wiring</strong> &ndash; Wires that have insulation damaged against the chassis create a short to ground.</li>
<li><strong>Contamination of sensor connections</strong> &ndash; Grease or moisture entering the sensor connector can create a conductive path.</li>
</ul>
<h2>How to Troubleshoot the F2 Error Code</h2>
<ol>
<li><strong>Reset the microwave</strong> &ndash; Unplug for 60 seconds and retry. If F2 immediately returns, the sensor has definitively failed.</li>
<li><strong>Confirm the error at startup</strong> &ndash; Verify that F2 appears at startup, not just during cooking.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>The F2 error requires thermal sensor replacement, which involves accessing internal components including dangerous stored electrical charges. This repair should only be performed by a qualified technician. <strong>Contact our Monogram microwave repair team</strong> at {$phone} for safe and professional repair.</p>
HTML;

$all_content['f4-microwave-open-humidity-sensor'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F4 Mean?</h2>
<p>The F4 error code on a Monogram microwave indicates an <strong>open humidity sensor circuit</strong>. Monogram microwaves with automatic (sensor) cooking use a humidity sensor to detect moisture levels in steam released from food, allowing the microwave to automatically determine when food is properly cooked. An open circuit means the control board receives no signal from the sensor.</p>
<h2>Common Causes of the F4 Error Code</h2>
<ul>
<li><strong>Failed humidity sensor</strong> &ndash; The sensor element has developed an open circuit from heat exposure or aging.</li>
<li><strong>Disconnected sensor wiring</strong> &ndash; The wiring from the humidity sensor to the control board has come loose.</li>
<li><strong>Food residue on the sensor</strong> &ndash; Heavy grease buildup on the sensor surface can interfere with its operation.</li>
</ul>
<h2>How to Troubleshoot the F4 Error Code</h2>
<ol>
<li><strong>Clean the sensor area</strong> &ndash; With the microwave unplugged, gently clean the humidity sensor (visible inside the cavity) with a damp cloth.</li>
<li><strong>Reset the microwave</strong> &ndash; Unplug for 60 seconds and retry.</li>
<li><strong>Use manual cooking</strong> &ndash; If F4 only appears during auto/sensor cooking, you can use timed manual cooking while awaiting repair.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If F4 persists after cleaning, the humidity sensor requires replacement. <strong>Contact our Monogram microwave repair team</strong> at {$phone} for professional replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['f5-microwave-shorted-humidity-sensor'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F5 Mean?</h2>
<p>The F5 error code on a Monogram microwave indicates a <strong>shorted humidity sensor</strong> &mdash; the opposite of F4. Where F4 means the sensor circuit is open (broken), F5 means the sensor resistance is near zero (shorted). Both conditions prevent the humidity sensor from providing accurate readings for automatic cooking programs.</p>
<h2>Common Causes of the F5 Error Code</h2>
<ul>
<li><strong>Shorted humidity sensor element</strong> &ndash; Internal failure of the sensor&rsquo;s resistive element.</li>
<li><strong>Moisture on sensor contacts</strong> &ndash; Heavy steam condensation on sensor connections can cause a temporary short.</li>
<li><strong>Damaged sensor wiring</strong> &ndash; Wires routed near sharp edges can have insulation damaged, creating a short circuit.</li>
</ul>
<h2>How to Troubleshoot the F5 Error Code</h2>
<ol>
<li><strong>Allow drying</strong> &ndash; If the microwave was recently used for high-steam cooking, allow the interior to dry with the door open for an hour before retesting.</li>
<li><strong>Reset the microwave</strong> &ndash; Unplug for 60 seconds and retry. If F5 immediately returns, the sensor has failed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>The F5 error requires humidity sensor replacement. <strong>Contact our Monogram microwave repair team</strong> at {$phone} for professional repair using factory-certified Monogram parts.</p>
HTML;

$all_content['f6-microwave-shorted-temperature-probe'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F6 Mean?</h2>
<p>The F6 error code on a Monogram microwave indicates that the <strong>temperature probe (meat probe) is shorted</strong>. Monogram microwaves with probe cooking functionality allow you to insert a temperature probe into food to monitor its internal temperature. A shorted probe sends a false near-zero resistance reading to the control board.</p>
<h2>Common Causes of the F6 Error Code</h2>
<ul>
<li><strong>Damaged temperature probe</strong> &ndash; The probe cable may have been pinched by the microwave door or damaged by heat.</li>
<li><strong>Dirty probe connector receptacle</strong> &ndash; Grease or food debris in the probe port creates a conductive short.</li>
<li><strong>Failed probe element</strong> &ndash; Internal failure of the probe&rsquo;s resistance element.</li>
</ul>
<h2>How to Troubleshoot the F6 Error Code</h2>
<ol>
<li><strong>Remove the probe</strong> &ndash; If a probe is inserted, remove it. F6 should clear immediately if the probe itself was shorted.</li>
<li><strong>Clean the probe port</strong> &ndash; With the microwave unplugged, clean the receptacle with a dry cotton swab.</li>
<li><strong>Inspect the probe</strong> &ndash; Check the cable for damage. A functioning probe in ice water should read approximately 32&deg;F (0&deg;C).</li>
<li><strong>Reset without probe</strong> &ndash; Confirm normal operation without the probe.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If F6 appears with no probe inserted, the probe port or associated wiring may need repair. <strong>Contact our Monogram microwave repair team</strong> at {$phone} for diagnosis using factory-certified Monogram parts.</p>
HTML;

$all_content['f10-microwave-shorted-touch-screen'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F10 Mean?</h2>
<p>The F10 error code on a Monogram microwave indicates a <strong>shorted touch screen or control panel</strong>. This error is specific to Monogram microwave models with a touch screen display. The touch screen controller has detected a persistent touch or short condition that prevents normal input detection.</p>
<h2>Common Causes of the F10 Error Code</h2>
<ul>
<li><strong>Liquid damage to the touch screen</strong> &ndash; Spills or condensation reaching the screen create short circuits in the touch-sensitive layer.</li>
<li><strong>Physical damage to the screen</strong> &ndash; Cracked or damaged touch screen glass.</li>
<li><strong>Failed touch screen controller</strong> &ndash; The touch controller IC has failed.</li>
<li><strong>Heavy soiling on the screen</strong> &ndash; Thick grease covering a significant portion of the screen can cause phantom touch detections.</li>
</ul>
<h2>How to Troubleshoot the F10 Error Code</h2>
<ol>
<li><strong>Clean the touch screen</strong> &ndash; Unplug the microwave. Gently clean with a soft, slightly damp cloth. Do not use abrasive cleaners. Dry completely.</li>
<li><strong>Reset the microwave</strong> &ndash; After cleaning, unplug for 60 seconds and retry.</li>
<li><strong>Check for physical damage</strong> &ndash; Look for cracks or chips in the touch screen glass.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If F10 persists after cleaning and resetting, the touch screen assembly requires replacement. <strong>Contact our Monogram microwave repair team</strong> at {$phone} for professional touch screen replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['18-microwave-power-watch'] = <<<HTML
<h2>What Does Monogram Microwave Error Code 18 Mean?</h2>
<p>The error code 18 (sometimes displayed as &ldquo;Power Watch&rdquo;) on a Monogram microwave indicates an <strong>electronic control issue</strong>. This error signals that the microwave&rsquo;s control board has detected an internal electronic fault that prevents normal operation. Unlike PF or 888 which are informational, error 18 indicates a hardware problem requiring professional service.</p>
<h2>Common Causes of Error Code 18</h2>
<ul>
<li><strong>Main control board failure</strong> &ndash; A failed capacitor, relay, or processor component on the main control board.</li>
<li><strong>Power surge damage</strong> &ndash; Voltage spikes damaging the control board&rsquo;s electronic circuits.</li>
<li><strong>Overheating of control electronics</strong> &ndash; Inadequate ventilation causing the control board to overheat.</li>
</ul>
<h2>How to Troubleshoot Error Code 18</h2>
<ol>
<li><strong>Reset the microwave</strong> &ndash; Unplug for 5 minutes (longer than a standard reset), then restore power. A temporary electronic glitch may clear.</li>
<li><strong>Check ventilation</strong> &ndash; Ensure the microwave vents are clear and the installation has adequate air clearance.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Error code 18 typically requires professional diagnosis of the control board. <strong>Contact our Monogram microwave repair team</strong> at {$phone} for expert diagnosis and control board replacement using factory-certified Monogram parts.</p>
HTML;

// ============================================================
// 4. CREATE POSTS AND POPULATE CONTENT
// ============================================================
$created  = 0;
$updated  = 0;
$skipped  = 0;
$errors   = 0;

echo "Starting creation of " . count( $error_code_defs ) . " error code posts...\n\n";

foreach ( $error_code_defs as $slug => $def ) {
    list( $title, $code_value, $appliance_slug ) = $def;
    $content = isset( $all_content[ $slug ] ) ? $all_content[ $slug ] : '';

    // Check if post already exists
    $existing = get_posts( array(
        'post_type'   => 'error_code',
        'name'        => $slug,
        'numberposts' => 1,
        'post_status' => 'any',
    ) );

    if ( $existing ) {
        $post_id = $existing[0]->ID;
        // Update taxonomy if missing
        $terms = wp_get_post_terms( $post_id, 'appliance_type', array( 'fields' => 'slugs' ) );
        if ( ! in_array( $appliance_slug, $terms, true ) ) {
            wp_set_post_terms( $post_id, array( $appliance_slug ), 'appliance_type' );
            echo "FIXED TAXONOMY: '{$slug}' → {$appliance_slug}\n";
        }
        // Update content if empty
        if ( $content && strlen( trim( $existing[0]->post_content ) ) < 200 ) {
            wp_update_post( array( 'ID' => $post_id, 'post_content' => $content ) );
            echo "UPDATED CONTENT: '{$slug}' (ID: {$post_id})\n";
            $updated++;
        } else {
            echo "EXISTS: '{$slug}' (ID: {$post_id}) — skipping.\n";
            $skipped++;
        }
        continue;
    }

    // Create new post
    $post_id = wp_insert_post( array(
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_status'  => 'publish',
        'post_type'    => 'error_code',
        'post_content' => $content,
    ), true );

    if ( is_wp_error( $post_id ) ) {
        echo "ERROR: Could not create '{$slug}': " . $post_id->get_error_message() . "\n";
        $errors++;
        continue;
    }

    // Assign appliance_type taxonomy
    $term_result = wp_set_post_terms( $post_id, array( $appliance_slug ), 'appliance_type' );
    if ( is_wp_error( $term_result ) ) {
        echo "TAX ERROR: Could not assign '{$appliance_slug}' to '{$slug}': " . $term_result->get_error_message() . "\n";
    }

    // Set _brp_error_code meta
    update_post_meta( $post_id, '_brp_error_code', $code_value );

    echo "CREATED: '{$slug}' (ID: {$post_id}, appliance: {$appliance_slug}, code: {$code_value})\n";
    $created++;
}

// Flush rewrite rules so new post permalinks work
flush_rewrite_rules();

echo "\n=== Done: {$created} created, {$updated} content-updated, {$skipped} skipped, {$errors} errors ===\n";
echo "Rewrite rules flushed.\n";
