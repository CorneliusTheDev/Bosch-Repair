<?php
/**
 * Create Error Codes – Batch 2
 * Adds missed + new codes to reach 12 per appliance type.
 * Triggered once via brp_error_codes_v2_done transient.
 *
 * @package MonogramRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$phone     = defined( 'BRP_PHONE' )     ? BRP_PHONE     : '844-752-7887';
$phone_raw = defined( 'BRP_PHONE_RAW' ) ? BRP_PHONE_RAW : '8447527887';

// Ensure terms exist
$appliance_terms = array(
    'washer'       => 'Washer',
    'dryer'        => 'Dryer',
    'refrigerator' => 'Refrigerator',
    'oven'         => 'Oven & Range',
    'cooktop'      => 'Cooktop',
    'dishwasher'   => 'Dishwasher',
);
foreach ( $appliance_terms as $slug => $label ) {
    if ( ! term_exists( $slug, 'appliance_type' ) ) {
        wp_insert_term( $label, 'appliance_type', array( 'slug' => $slug ) );
    }
}

// ============================================================
// ERROR CODE DEFINITIONS
// slug => [ title, code_value, appliance_type_slug ]
// ============================================================
$defs = array(

    // ── DISHWASHER (missed from v1 + new) ───────────────────
    'start-light-flashing-cycle-interrupted' => array( 'Monogram Dishwasher Start Light Flashing – Cycle Interrupted',        'Start',  'dishwasher' ),
    'beeping-once-per-minute-door-open'      => array( 'Monogram Dishwasher Beeping Once Per Minute – Door Left Open',         'Beep',   'dishwasher' ),
    'leak-detected'                          => array( 'Monogram Dishwasher LEAK DETECTED Error',                              'LEAK',   'dishwasher' ),
    'end-of-cycle-beeping'                   => array( 'Monogram Dishwasher End-of-Cycle Beeping – Cycle Complete Alert',      'End',    'dishwasher' ),
    'dishwasher-c1-water-inlet-fault'        => array( 'Monogram Dishwasher Error Code C1 – Water Inlet Fault',                'C1',     'dishwasher' ),
    'dishwasher-c2-fill-valve-problem'       => array( 'Monogram Dishwasher Error Code C2 – Fill Valve Problem',               'C2',     'dishwasher' ),
    'dishwasher-c3-wash-pump-malfunction'    => array( 'Monogram Dishwasher Error Code C3 – Wash Pump Malfunction',            'C3',     'dishwasher' ),
    'dishwasher-c4-drain-pump-fault'         => array( 'Monogram Dishwasher Error Code C4 – Drain Pump Fault',                 'C4',     'dishwasher' ),
    'dishwasher-f1-control-board-failure'    => array( 'Monogram Dishwasher Error Code F1 – Control Board Failure',            'F1',     'dishwasher' ),
    'dishwasher-i10-water-not-filling'       => array( 'Monogram Dishwasher Error Code i10 – Water Not Filling',               'i10',    'dishwasher' ),
    'dishwasher-i20-drain-issue'             => array( 'Monogram Dishwasher Error Code i20 – Drain Issue',                     'i20',    'dishwasher' ),
    'dishwasher-i30-flood-protection'        => array( 'Monogram Dishwasher Error Code i30 – Flood Protection Activated',      'i30',    'dishwasher' ),

    // ── WASHER (missed from v1 + new) ───────────────────────
    'e66-e67-temperature-sensor-malfunction' => array( 'Monogram Washer Error Codes E66/E67 – Temperature Sensor Malfunction', 'E66/E67','washer' ),
    'e11-washer-water-not-heating'           => array( 'Monogram Washer Error Code E11 – Water Not Heating to Target Temperature', 'E11', 'washer' ),
    'e52-motor-speed-sensor-fault'           => array( 'Monogram Washer Error Code E52 – Motor Speed Sensor Fault',            'E52',    'washer' ),
    'sud-sd-excess-suds'                     => array( 'Monogram Washer Error Code SUD/SD – Excess Suds Detected',             'SUD/SD', 'washer' ),
    'e14-ntc-water-temperature-sensor'       => array( 'Monogram Washer Error Code E14 – NTC Water Temperature Sensor Fault',  'E14',    'washer' ),

    // ── DRYER (missed from v1 + new) ────────────────────────
    '000-no-errors-self-test'                => array( 'Monogram Dryer Error Code 000 – No Errors / Self-Test Complete',       '000',    'dryer' ),
    '006-stuck-control-panel-button'         => array( 'Monogram Dryer Error Code 006 – Stuck Control Panel Button',           '006',    'dryer' ),
    '007-miswired-power-supply'              => array( 'Monogram Dryer Error Code 007 – Miswired Power Supply',                '007',    'dryer' ),
    'af-restricted-airflow'                  => array( 'Monogram Dryer Error Code AF – Restricted Airflow / Clogged Vent',     'AF',     'dryer' ),
    'dryer-pf-power-failure'                 => array( 'Monogram Dryer Error Code PF – Power Failure',                        'PF',     'dryer' ),
    'hf-dryer-heat-failure'                  => array( 'Monogram Dryer Error Code HF – No Heat / Heating Failure',             'HF',     'dryer' ),
    'e1-dryer-thermistor-error'              => array( 'Monogram Dryer Error Code E1 – Thermistor / Temperature Sensor Error', 'E1',     'dryer' ),

    // ── REFRIGERATOR (missed from v1 + new) ─────────────────
    'cc-refrigerator-temperature-incorrect'  => array( 'Monogram Refrigerator Error Code CC – Fresh Food Temperature Incorrect','CC',    'refrigerator' ),
    'op-refrigerator-door-open-alarm'        => array( 'Monogram Refrigerator Error Code OP – Door Open Alarm',                'OP',     'refrigerator' ),
    '4-defrost-heater-problem'               => array( 'Monogram Refrigerator Error Code 4 – Defrost Heater Problem',          '4',      'refrigerator' ),
    '6-evaporator-fan-motor-fault'           => array( 'Monogram Refrigerator Error Code 6 – Evaporator Fan Motor Fault',      '6',      'refrigerator' ),
    '8-ice-maker-fault'                      => array( 'Monogram Refrigerator Error Code 8 – Ice Maker Fault',                 '8',      'refrigerator' ),
    'e0-communication-error'                 => array( 'Monogram Refrigerator Error Code E0 – Control Board Communication Error','E0',   'refrigerator' ),
    'sy-ef-sealed-system-evaporator-fan'     => array( 'Monogram Refrigerator Error Code SY EF – Evaporator Fan Fault',       'SY EF',  'refrigerator' ),

    // ── OVEN (missed from v1 + new) ─────────────────────────
    'f1-oven-system-watchdog-stuck-key'      => array( 'Monogram Oven Error Code F1 – System Watchdog / Stuck Key',            'F1',     'oven' ),
    'f5-oven-relay-drive-circuit-failure'    => array( 'Monogram Oven Error Code F5 – Loss of Relay Drive Circuit',            'F5',     'oven' ),
    'f8-oven-shorted-meat-probe'             => array( 'Monogram Oven Error Code F8 – Shorted Meat Probe',                    'F8',     'oven' ),
    'f6-oven-door-lock-circuit'              => array( 'Monogram Oven Error Code F6 – Door Lock Circuit Failure',              'F6',     'oven' ),
    'f7-oven-function-key-stuck'             => array( 'Monogram Oven Error Code F7 – Function Key Shorted / Stuck',           'F7',     'oven' ),
    'f10-oven-runaway-temperature'           => array( 'Monogram Oven Error Code F10 – Runaway Oven Temperature',              'F10',    'oven' ),

    // ── COOKTOP (missed from v1 + new) ──────────────────────
    'f1-cooktop-stuck-touch-pad'             => array( 'Monogram Cooktop Error Code F1 – Stuck Touch Pad',                    'F1',     'cooktop' ),
    'f113-cooktop-temperature-sensor'        => array( 'Monogram Cooktop Error Code F113 – Temperature Sensor Out of Range',  'F113',   'cooktop' ),
    'f161-cooktop-burner-sensor-fault'       => array( 'Monogram Cooktop Error Code F161 – Burner Temperature Sensor Fault', 'F161',   'cooktop' ),
    'f2-cooktop-shorted-touch-pad'           => array( 'Monogram Cooktop Error Code F2 – Shorted Touch Pad',                  'F2',     'cooktop' ),
    'f3-cooktop-control-board-failure'       => array( 'Monogram Cooktop Error Code F3 – Control Board Failure',              'F3',     'cooktop' ),
    'f5-cooktop-pan-temperature-sensor'      => array( 'Monogram Cooktop Error Code F5 – Pan Temperature Sensor Fault',       'F5',     'cooktop' ),
    'f6-cooktop-power-board-error'           => array( 'Monogram Cooktop Error Code F6 – Power Board Error',                  'F6',     'cooktop' ),
    'loc-cooktop-control-lock'               => array( 'Monogram Cooktop LOC / Control Lock – Surface Lock Active',           'LOC',    'cooktop' ),
    'f115-cooktop-igniter-fault'             => array( 'Monogram Cooktop Error Code F115 – Igniter Fault',                    'F115',   'cooktop' ),
);

// ============================================================
// CONTENT
// ============================================================
$content = array();

// ── DISHWASHER ──────────────────────────────────────────────

$content['start-light-flashing-cycle-interrupted'] = <<<HTML
<h2>What Does the Monogram Dishwasher Start Light Flashing Mean?</h2>
<p>A flashing Start light on a Monogram dishwasher indicates the cycle was <strong>interrupted before it could complete</strong>. This typically happens when the door is opened mid-cycle, a power glitch occurred, or the dishwasher detected a fault and paused for safety.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Door opened during cycle</strong> &ndash; Opening the door pauses the cycle; if not properly closed and restarted, the Start light continues to flash.</li>
<li><strong>Power interruption</strong> &ndash; A brief power outage or voltage drop interrupts the cycle mid-run.</li>
<li><strong>Control board fault</strong> &ndash; The electronic controller lost its cycle position and requires a reset.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Close the door firmly</strong> &ndash; Ensure the door latch clicks fully. Then press Start to resume.</li>
<li><strong>Reset the dishwasher</strong> &ndash; Press and hold the Start/Reset button for 3 seconds to cancel the cycle. Wait 2 minutes, then start a fresh cycle.</li>
<li><strong>Cut power</strong> &ndash; Flip the breaker or unplug for 30 seconds, then restore power and restart.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the Start light continues flashing after resets, the door latch switch or control board may need replacement. Call {$phone} for certified Monogram dishwasher repair.</p>
HTML;

$content['beeping-once-per-minute-door-open'] = <<<HTML
<h2>Why Is My Monogram Dishwasher Beeping Once Per Minute?</h2>
<p>A single beep per minute on a Monogram dishwasher is a <strong>door-open reminder alert</strong>. The dishwasher detected the door was left unlatched after a cycle completed or during a delayed start countdown.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Door left ajar</strong> &ndash; The most common cause. The door was not fully closed after unloading.</li>
<li><strong>Door latch not engaging</strong> &ndash; A worn or misaligned door latch fails to signal a closed state to the control board.</li>
<li><strong>Delayed start active</strong> &ndash; The dishwasher is in a delayed-start countdown and reminding you the door is open.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Close the door firmly</strong> &ndash; Push until the latch clicks. The beeping should stop immediately.</li>
<li><strong>Inspect the latch</strong> &ndash; Check for debris in the latch strike area. Clean with a damp cloth.</li>
<li><strong>Cancel delayed start</strong> &ndash; If a delayed start was set accidentally, press Cancel/Drain to clear it.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A door latch that won't engage properly needs replacement. Contact our team at {$phone} to schedule service.</p>
HTML;

$content['leak-detected'] = <<<HTML
<h2>What Does the Monogram Dishwasher LEAK DETECTED Error Mean?</h2>
<p>The <strong>LEAK DETECTED</strong> error on a Monogram dishwasher means the anti-flood sensor in the base pan has detected standing water underneath the appliance. The dishwasher immediately stops filling and activates the drain pump to remove water as a safety measure.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed door gasket / door seal</strong> &ndash; A cracked, worn, or misseated door seal allows water to escape during the wash or rinse cycle.</li>
<li><strong>Loose hose connection</strong> &ndash; The inlet or drain hose connection inside the dishwasher has worked loose and drips water into the base.</li>
<li><strong>Cracked sump or spray arm seal</strong> &ndash; Internal seals around the wash pump sump can crack over time.</li>
<li><strong>Overfilling due to fill valve fault</strong> &ndash; A stuck-open fill valve causes overflow into the base pan.</li>
<li><strong>Excessive suds</strong> &ndash; Using non-dishwasher detergent generates suds that overflow into the base.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Do not use the dishwasher</strong> &ndash; Using it while leaking can damage your floor. Disconnect power first.</li>
<li><strong>Tilt the dishwasher back slightly</strong> &ndash; Carefully lean it back 45° to drain water from the base pan, then restore to level. This clears the float sensor.</li>
<li><strong>Inspect the door seal</strong> &ndash; Open the door and examine the rubber gasket around the perimeter for cracks, tears, or debris. Clean the gasket channel thoroughly.</li>
<li><strong>Check hose connections</strong> &ndash; With power off, inspect the inlet hose connection at the fill valve and the drain hose connection at the pump.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Leak repairs require accessing internal components. Call {$phone} so our certified Monogram technician can safely identify and fix the source of the leak using genuine parts.</p>
HTML;

$content['end-of-cycle-beeping'] = <<<HTML
<h2>What Does Monogram Dishwasher End-of-Cycle Beeping Mean?</h2>
<p>End-of-cycle beeping on a Monogram dishwasher is a <strong>normal completion alert</strong> — a series of beeps indicating the wash cycle has finished. However, if beeping is excessive, continuous, or unusual, it may indicate an issue.</p>
<h2>Common Causes of Unusual Beeping at End of Cycle</h2>
<ul>
<li><strong>Normal cycle completion signal</strong> &ndash; Monogram dishwashers beep 3–5 times when a cycle ends. This is expected behavior.</li>
<li><strong>Rinse aid low</strong> &ndash; Some models beep to indicate the rinse aid dispenser needs refilling.</li>
<li><strong>Error code stored</strong> &ndash; A fault was detected during the cycle and the dishwasher is alerting you via beep pattern.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Check rinse aid level</strong> &ndash; Open the rinse aid dispenser on the inside of the door and refill if low.</li>
<li><strong>Read the display</strong> &ndash; Look for any fault code displayed alongside the beeping.</li>
<li><strong>Adjust sound settings</strong> &ndash; On supported models, press and hold the Heated Dry or Dry Boost button for 3 seconds to toggle end-of-cycle beeping on or off.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If beeping is accompanied by a fault code or the dishwasher won't resume normal operation, call {$phone} for diagnosis.</p>
HTML;

$content['dishwasher-c1-water-inlet-fault'] = <<<HTML
<h2>What Does Monogram Dishwasher Error Code C1 Mean?</h2>
<p>Error code <strong>C1</strong> on a Monogram dishwasher indicates a <strong>water inlet fault</strong> — the dishwasher did not reach the required water level within the allowed fill time. The control board opened the inlet valve but the water level sensor did not confirm the tub filled properly.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Water supply valve closed or restricted</strong> &ndash; The shutoff valve under the sink may be partially closed.</li>
<li><strong>Clogged inlet valve screen</strong> &ndash; Mineral deposits can block the small mesh filter in the water inlet valve.</li>
<li><strong>Failed water inlet valve</strong> &ndash; The solenoid valve fails to open fully, restricting water flow.</li>
<li><strong>Low water pressure</strong> &ndash; Household water pressure below 20 PSI prevents the tub from filling in time.</li>
<li><strong>Faulty water level sensor</strong> &ndash; The pressure switch or float sensor gives incorrect readings.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Check the supply valve</strong> &ndash; Ensure the hot water shutoff under the sink is fully open.</li>
<li><strong>Clean the inlet screen</strong> &ndash; Turn off the supply valve, disconnect the inlet hose, and rinse the screen filter.</li>
<li><strong>Reset</strong> &ndash; Press Cancel/Drain, wait 2 minutes, then start a new cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A failed inlet valve or water level sensor requires replacement. Call {$phone} for expert Monogram dishwasher service.</p>
HTML;

$content['dishwasher-c2-fill-valve-problem'] = <<<HTML
<h2>What Does Monogram Dishwasher Error Code C2 Mean?</h2>
<p>Error code <strong>C2</strong> on a Monogram dishwasher signals a <strong>fill valve problem</strong> — specifically an overfill or continuous fill condition. The control board detects the water level is rising beyond the expected point, suggesting the fill valve is not closing properly.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Stuck-open fill valve</strong> &ndash; The solenoid valve fails to close after the tub reaches the correct level, continuously adding water.</li>
<li><strong>Faulty water level sensor</strong> &ndash; Incorrect level readings cause the controller to keep the valve open too long.</li>
<li><strong>Control board fault</strong> &ndash; The board fails to send the close signal to the inlet valve.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Turn off the water supply</strong> &ndash; Close the shutoff valve under the sink to stop water flow.</li>
<li><strong>Reset the dishwasher</strong> &ndash; Press Cancel/Drain, wait for the pump to clear water, then cut power at the breaker for 60 seconds.</li>
<li><strong>Observe on restart</strong> &ndash; If the tub continues to overfill after reset, the fill valve needs replacement.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A continuously running inlet valve can flood your kitchen. Call {$phone} immediately for same-day Monogram dishwasher repair.</p>
HTML;

$content['dishwasher-c3-wash-pump-malfunction'] = <<<HTML
<h2>What Does Monogram Dishwasher Error Code C3 Mean?</h2>
<p>Error code <strong>C3</strong> on a Monogram dishwasher indicates a <strong>wash pump malfunction</strong>. The circulation pump that pressurizes water through the spray arms has failed to operate correctly, resulting in poor washing performance or a complete wash failure.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Blocked pump impeller</strong> &ndash; Broken glass, food debris, or foreign objects jammed in the pump prevent it from spinning.</li>
<li><strong>Failed wash pump motor</strong> &ndash; The pump motor has burned out electrically.</li>
<li><strong>Loose wiring connector</strong> &ndash; The electrical connection to the pump motor has come loose.</li>
<li><strong>Control board fault</strong> &ndash; The board's pump drive circuit has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Check for debris</strong> &ndash; Remove the lower spray arm and filter assembly. Look for glass or hard objects near the pump inlet and remove any found.</li>
<li><strong>Clean the filter</strong> &ndash; Rinse the cylindrical and mesh filters under running water.</li>
<li><strong>Reset</strong> &ndash; Cut power for 60 seconds and restart a short cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Wash pump motor replacement requires professional service. Contact us at {$phone} for certified Monogram repair.</p>
HTML;

$content['dishwasher-c4-drain-pump-fault'] = <<<HTML
<h2>What Does Monogram Dishwasher Error Code C4 Mean?</h2>
<p>Error code <strong>C4</strong> on a Monogram dishwasher indicates a <strong>drain pump fault</strong> — the dishwasher was unable to drain water within the expected time window. Standing water remains in the tub after the drain cycle.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Clogged drain filter</strong> &ndash; The most common cause. Food particles and debris accumulate in the filter assembly, blocking flow to the drain pump.</li>
<li><strong>Blocked drain hose</strong> &ndash; A kinked or clogged drain hose prevents water from exiting the dishwasher.</li>
<li><strong>Clogged kitchen sink drain</strong> &ndash; If the dishwasher drains into the sink drain, a blockage there will prevent dishwasher drainage.</li>
<li><strong>Failed drain pump motor</strong> &ndash; The drain pump impeller or motor has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the filter</strong> &ndash; Remove and thoroughly rinse the filter assembly at the bottom of the tub.</li>
<li><strong>Check drain hose</strong> &ndash; Inspect for kinks behind the dishwasher. Ensure it has a high loop or air gap before connecting to the sink drain.</li>
<li><strong>Run sink disposal</strong> &ndash; If you have a garbage disposal, run it to clear any blockage at the drain connection point.</li>
<li><strong>Reset</strong> &ndash; Press Cancel/Drain to trigger a manual drain cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A failed drain pump needs replacement. Call {$phone} to schedule Monogram dishwasher service.</p>
HTML;

$content['dishwasher-f1-control-board-failure'] = <<<HTML
<h2>What Does Monogram Dishwasher Error Code F1 Mean?</h2>
<p>Error code <strong>F1</strong> on a Monogram dishwasher indicates a <strong>main control board failure</strong>. The electronic controller that manages all dishwasher functions has detected an internal fault or has stopped communicating correctly with the components it controls.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power surge damage</strong> &ndash; A voltage spike has damaged the control board's circuitry.</li>
<li><strong>Moisture intrusion</strong> &ndash; Condensation or a steam leak has caused corrosion on the board.</li>
<li><strong>Component failure</strong> &ndash; A relay, capacitor, or microprocessor on the board has failed with age.</li>
<li><strong>Loose wiring harness</strong> &ndash; A connector to the control board has partially disconnected.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Cut power at the circuit breaker for 5 full minutes, then restore and test. This clears transient board faults.</li>
<li><strong>Check wiring</strong> &ndash; With power off, gently reseat the wiring harness connectors on the control board.</li>
<li><strong>Look for burn marks</strong> &ndash; If accessible, inspect the board for visibly burned or discolored components.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Control board replacement requires precise installation and calibration. Call {$phone} for professional Monogram dishwasher repair with a genuine replacement board.</p>
HTML;

$content['dishwasher-i10-water-not-filling'] = <<<HTML
<h2>What Does Monogram Dishwasher Error Code i10 Mean?</h2>
<p>Error code <strong>i10</strong> on a Monogram dishwasher indicates the appliance is <strong>not filling with enough water</strong>. The control system expected the water level to reach a set point within a certain time, but the tub is filling too slowly or not at all.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Partially closed water supply valve</strong> &ndash; The hot water shutoff valve under the sink is not fully open.</li>
<li><strong>Faulty water inlet valve</strong> &ndash; The solenoid valve is failing to open fully.</li>
<li><strong>Low household water pressure</strong> &ndash; Pressure below 20 PSI results in slow fills and an i10 error.</li>
<li><strong>Plugged inlet valve filter screen</strong> &ndash; Mineral scale has blocked the screen at the valve inlet.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Fully open the supply valve</strong> &ndash; Turn counterclockwise until it stops.</li>
<li><strong>Clean the inlet screen</strong> &ndash; Disconnect the water supply hose and clean the filter screen at the valve connection.</li>
<li><strong>Check pressure at the tap</strong> &ndash; Run the hot water at the kitchen sink; a weak stream indicates low household pressure.</li>
<li><strong>Reset</strong> &ndash; Power cycle the dishwasher and run a new cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If i10 persists, the water inlet valve needs replacement. Call {$phone} for fast Monogram service.</p>
HTML;

$content['dishwasher-i20-drain-issue'] = <<<HTML
<h2>What Does Monogram Dishwasher Error Code i20 Mean?</h2>
<p>Error code <strong>i20</strong> on a Monogram dishwasher signals a <strong>drain issue</strong> — water is not draining from the tub at the expected rate. This code is similar to C4 but indicates a timeout during drainage rather than a pump signal failure.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Blocked filter assembly</strong> &ndash; The cylindrical and flat mesh filters are clogged with food debris.</li>
<li><strong>Kinked drain hose</strong> &ndash; The drain hose is bent behind the unit restricting outflow.</li>
<li><strong>Garbage disposal knockout plug</strong> &ndash; On new installations, the disposal knockout plug was not removed before connecting the drain hose.</li>
<li><strong>Failing drain pump</strong> &ndash; The pump motor is worn and cannot drain water fast enough.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the filter</strong> &ndash; Twist out and rinse the filter assembly under the tap.</li>
<li><strong>Inspect drain hose routing</strong> &ndash; Straighten any kinks and ensure a proper high loop is in place.</li>
<li><strong>Check garbage disposal connection</strong> &ndash; If the dishwasher drain connects to the disposal inlet, run the disposal to clear it.</li>
<li><strong>Manual drain</strong> &ndash; Press Cancel/Drain to run a drain-only cycle and observe if water exits.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Drain pump replacement is required if the pump has failed. Call {$phone} to book a Monogram technician.</p>
HTML;

$content['dishwasher-i30-flood-protection'] = <<<HTML
<h2>What Does Monogram Dishwasher Error Code i30 Mean?</h2>
<p>Error code <strong>i30</strong> on a Monogram dishwasher means the <strong>flood protection system has been triggered</strong>. The anti-flood float switch in the base pan has detected standing water in the drip tray beneath the tub. The dishwasher stops filling and activates the drain pump continuously as a safety response.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Internal water leak</strong> &ndash; A loose hose connection, cracked pump seal, or failed door gasket has allowed water to pool in the base.</li>
<li><strong>Overfilling</strong> &ndash; A stuck-open fill valve caused the tub to overflow into the base pan.</li>
<li><strong>Suds overflow</strong> &ndash; Incorrect detergent or excessive detergent produced foam that flowed into the base.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Tilt the machine back</strong> &ndash; With power off, carefully lean the dishwasher back 45° to drain water from the base tray and reset the float switch. Hold for 30 seconds, then return to level.</li>
<li><strong>Inspect for the leak source</strong> &ndash; After draining the base, run a short cycle and look for drips under the door seal, at hose connections, or under the unit.</li>
<li><strong>Use correct detergent</strong> &ndash; Only use automatic dishwasher detergent — never hand dish soap or laundry detergent.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>i30 indicates an active internal leak that must be fixed before using the dishwasher again. Call {$phone} for same-day Monogram repair service.</p>
HTML;

// ── WASHER (missed + new) ────────────────────────────────────

$content['e66-e67-temperature-sensor-malfunction'] = <<<HTML
<h2>What Do Monogram Washer Error Codes E66/E67 Mean?</h2>
<p>Error codes <strong>E66 and E67</strong> on a Monogram washing machine indicate a <strong>water temperature sensor (NTC thermistor) malfunction</strong>. E66 typically signals an open circuit (disconnected or broken sensor), while E67 indicates a short circuit in the sensor or its wiring. Without accurate temperature data, the control board cannot regulate the wash temperature and halts the cycle.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed NTC thermistor</strong> &ndash; The temperature sensor has burned out or drifted outside its operating range.</li>
<li><strong>Loose wiring connector</strong> &ndash; The connector to the thermistor has come loose inside the machine.</li>
<li><strong>Wiring harness damage</strong> &ndash; Chafed or pinched wiring between the sensor and control board creates open or short conditions.</li>
<li><strong>Control board fault</strong> &ndash; The board's temperature sensing circuit has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Reset</strong> &ndash; Unplug the washer for 60 seconds, then restart a cold-water cycle. If E66/E67 only appears on hot cycles, the sensor is likely faulty.</li>
<li><strong>Check wiring</strong> &ndash; With the machine unplugged, access the thermistor (usually on the rear drum tub or heater assembly) and reseat the connector.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Temperature sensor and wiring diagnosis requires multimeter testing. Call {$phone} for professional Monogram washer service.</p>
HTML;

$content['e11-washer-water-not-heating'] = <<<HTML
<h2>What Does Monogram Washer Error Code E11 Mean?</h2>
<p>Error code <strong>E11</strong> on a Monogram washing machine indicates the <strong>water is not heating to the target temperature</strong> within the allowed time. Monogram front-load washers have an internal heating element for hot wash programs. E11 triggers when the temperature sensor does not confirm the water reached the set temperature.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed heating element</strong> &ndash; The internal heater has burned out and is not warming the water.</li>
<li><strong>Failed temperature sensor (NTC)</strong> &ndash; An incorrect reading makes the controller believe heating is not occurring even if it is.</li>
<li><strong>Tripped thermal cutout</strong> &ndash; An overtemperature safety cutout has tripped and needs to be reset or replaced.</li>
<li><strong>Control board fault</strong> &ndash; The relay that powers the heating element has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Try a cold wash cycle</strong> &ndash; If the washer completes cold cycles without error, the fault is isolated to the heating circuit.</li>
<li><strong>Reset</strong> &ndash; Unplug for 5 minutes, then restart a warm cycle.</li>
<li><strong>Check the circuit breaker</strong> &ndash; On electric models, ensure the breaker supplying the washer is fully on.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Heating element testing and replacement requires draining the machine and accessing internal components. Call {$phone} for expert service.</p>
HTML;

$content['e52-motor-speed-sensor-fault'] = <<<HTML
<h2>What Does Monogram Washer Error Code E52 Mean?</h2>
<p>Error code <strong>E52</strong> on a Monogram washer indicates a <strong>motor speed sensor (tachometer) fault</strong>. The control board is not receiving proper speed feedback from the drive motor, which prevents it from controlling spin and agitation speeds correctly.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed tachometer / Hall sensor</strong> &ndash; The speed feedback sensor on the motor has failed.</li>
<li><strong>Loose motor wiring</strong> &ndash; The wiring harness connector at the motor or control board has partially disconnected.</li>
<li><strong>Worn motor brushes</strong> &ndash; On brush-type motors, worn brushes create erratic speed signals.</li>
<li><strong>Control board fault</strong> &ndash; The inverter or motor control module has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Unplug for 5 minutes and retry. Intermittent E52 can result from a temporary sensor glitch.</li>
<li><strong>Reduce load</strong> &ndash; An extremely unbalanced or oversized load can overload the motor and trigger speed faults.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Motor sensor and inverter board diagnosis requires specialized tools. Contact {$phone} for certified Monogram washer repair.</p>
HTML;

$content['sud-sd-excess-suds'] = <<<HTML
<h2>What Does Monogram Washer Error Code SUD/SD Mean?</h2>
<p>The <strong>SUD</strong> or <strong>SD</strong> error code on a Monogram washing machine means <strong>excess suds have been detected</strong>. The washer pauses the cycle and adds extra rinse time to break down the foam before continuing. In severe cases, it will stop entirely until suds dissipate.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Too much detergent</strong> &ndash; Using more detergent than the cycle requires is the most common cause.</li>
<li><strong>Wrong detergent type</strong> &ndash; Using regular (non-HE) detergent in a high-efficiency Monogram washer produces far too many suds.</li>
<li><strong>Detergent residue buildup</strong> &ndash; Old detergent residue in the drum re-activates and creates extra foam.</li>
<li><strong>Soft water</strong> &ndash; Very soft water increases sudsing — reduce detergent dose accordingly.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Wait</strong> &ndash; Allow the washer to complete its automatic anti-suds routine. Do not open the door.</li>
<li><strong>Use HE detergent only</strong> &ndash; Switch to a detergent marked "HE" and use the correct dose for your load size and water hardness.</li>
<li><strong>Run a drum clean cycle</strong> &ndash; Use a washing machine cleaner tablet or run a hot cycle with no detergent to flush residue.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If SUD/SD appears even with correct detergent use, a foam sensor or control board fault may be the cause. Call {$phone} for diagnosis.</p>
HTML;

$content['e14-ntc-water-temperature-sensor'] = <<<HTML
<h2>What Does Monogram Washer Error Code E14 Mean?</h2>
<p>Error code <strong>E14</strong> on a Monogram washer indicates an <strong>NTC water temperature sensor fault</strong>. The sensor used to measure incoming or internal water temperature is reporting a value that is out of the expected range, preventing the control board from managing wash temperature accurately.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Defective NTC sensor</strong> &ndash; The thermistor has drifted out of range or failed completely.</li>
<li><strong>Loose or corroded wiring</strong> &ndash; The sensor connector is not making solid contact.</li>
<li><strong>Very cold inlet water</strong> &ndash; In rare cases, extremely cold water (below 5°C) in winter can cause the sensor to read an out-of-range value.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds, then restart on a warm cycle.</li>
<li><strong>Check inlet water temperature</strong> &ndash; During cold weather, run the hot water at a nearby tap for 30 seconds before starting the washer.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>NTC sensor replacement is straightforward but requires accessing the back panel. Call {$phone} for fast Monogram washer repair.</p>
HTML;

// ── DRYER (missed + new) ─────────────────────────────────────

$content['000-no-errors-self-test'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 000 Mean?</h2>
<p>Error code <strong>000</strong> on a Monogram dryer is <strong>not an error</strong> — it is the self-test completion code indicating <strong>no faults were detected</strong> during the diagnostic cycle. You may see 000 displayed after running a service diagnostic mode.</p>
<h2>What to Do</h2>
<ol>
<li><strong>Exit diagnostic mode</strong> &ndash; Press the Power button to exit the service test and return to normal operation.</li>
<li><strong>Run a normal cycle</strong> &ndash; If you entered diagnostics due to a problem, and 000 appears, the fault may be intermittent. Monitor the next few cycles.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If your dryer was displaying a real error code before you entered diagnostics and the problem persists in normal use, call {$phone} for professional Monogram dryer service.</p>
HTML;

$content['006-stuck-control-panel-button'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 006 Mean?</h2>
<p>Error code <strong>006</strong> on a Monogram dryer indicates a <strong>stuck or continuously activated control panel button</strong>. One of the touch pad buttons is being detected as pressed for an extended period, which the control board interprets as a fault rather than a legitimate user selection.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Debris under the button</strong> &ndash; Lint, moisture, or a foreign object is pressing against a button pad.</li>
<li><strong>Moisture on the control panel</strong> &ndash; Liquid that entered the panel is causing a constant contact signal.</li>
<li><strong>Failed touch pad membrane</strong> &ndash; The membrane switch beneath the button has delaminated and is making continuous contact.</li>
<li><strong>Control board fault</strong> &ndash; The board's input sensing circuit has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the panel</strong> &ndash; Wipe the control panel with a dry cloth. Gently press each button several times to check for sticking.</li>
<li><strong>Hard reset</strong> &ndash; Unplug the dryer for 60 seconds and power back on.</li>
<li><strong>Inspect for moisture</strong> &ndash; If liquid was recently near the panel, allow it to dry completely before powering on.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A faulty control panel or touch pad assembly needs professional replacement. Call {$phone} for Monogram dryer repair.</p>
HTML;

$content['007-miswired-power-supply'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 007 Mean?</h2>
<p>Error code <strong>007</strong> on a Monogram dryer indicates a <strong>miswired or incorrect power supply</strong>. The dryer's control board has detected that the electrical supply connection does not match the expected configuration — typically a problem with the terminal block wiring or power cord installation.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Incorrect power cord installation</strong> &ndash; A 3-wire cord was connected where a 4-wire cord is required (or vice versa) without the correct neutral-to-ground bonding jumper adjustment.</li>
<li><strong>Reversed hot legs</strong> &ndash; The two hot leads on the terminal block were swapped during installation or service.</li>
<li><strong>Loose terminal block connection</strong> &ndash; One of the power supply leads has come loose from the terminal block, creating an unbalanced supply.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Do not use the dryer</strong> &ndash; A wiring fault can cause damage or fire risk. Disconnect power immediately.</li>
<li><strong>Inspect the terminal block</strong> &ndash; With power disconnected, remove the access panel at the rear and verify all connections to the terminal block are tight and correctly positioned per your installation guide.</li>
<li><strong>Verify outlet wiring</strong> &ndash; Have an electrician verify the 240V outlet is correctly wired.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Electrical wiring issues must be resolved by a qualified technician or electrician. Call {$phone} for safe Monogram dryer service.</p>
HTML;

$content['af-restricted-airflow'] = <<<HTML
<h2>What Does Monogram Dryer Error Code AF Mean?</h2>
<p>Error code <strong>AF</strong> on a Monogram dryer stands for <strong>Airflow Fault</strong> — the dryer has detected severely restricted exhaust airflow. Without proper venting, the dryer cannot expel hot moist air, leading to long dry times, overheating, and potential fire hazard.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Clogged lint screen</strong> &ndash; A heavily loaded lint filter is the most common and easiest-to-fix cause.</li>
<li><strong>Blocked exhaust duct</strong> &ndash; Lint has accumulated inside the exhaust duct, significantly reducing airflow.</li>
<li><strong>Crushed or kinked flexible duct</strong> &ndash; The duct behind the dryer has been compressed against the wall.</li>
<li><strong>Blocked exterior vent cap</strong> &ndash; Bird nests, debris, or a stuck damper flap is blocking the outside vent.</li>
<li><strong>Duct is too long or has too many bends</strong> &ndash; Exceeding the maximum duct run length or adding too many 90° elbows restricts flow.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the lint screen</strong> &ndash; Remove and clean the screen before every load.</li>
<li><strong>Check the exhaust duct</strong> &ndash; Disconnect the duct at the dryer and check for lint clogs. Use a dryer vent brush kit to clean the full length.</li>
<li><strong>Inspect the exterior vent cap</strong> &ndash; Go outside and verify the cap opens freely when the dryer is running.</li>
<li><strong>Straighten the duct</strong> &ndash; Pull the dryer away from the wall and eliminate sharp kinks in the flexible section.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A severely blocked duct system is a fire hazard. Call {$phone} for professional Monogram dryer service and duct inspection.</p>
HTML;

$content['dryer-pf-power-failure'] = <<<HTML
<h2>What Does Monogram Dryer Error Code PF Mean?</h2>
<p>Error code <strong>PF</strong> on a Monogram dryer stands for <strong>Power Failure</strong> — the dryer detected that power was interrupted while a drying cycle was in progress. The cycle has been stopped and the PF code is displayed as an alert.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power outage</strong> &ndash; A household power outage interrupted the cycle.</li>
<li><strong>Tripped circuit breaker</strong> &ndash; The dryer's dedicated circuit breaker tripped during operation.</li>
<li><strong>Loose outlet connection</strong> &ndash; The power cord plug is not fully seated in the outlet.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Acknowledge the code</strong> &ndash; Press Start or any button to clear PF from the display.</li>
<li><strong>Check the breaker</strong> &ndash; Ensure the dryer's circuit breaker is fully on (not tripped to middle position). Reset if needed.</li>
<li><strong>Restart the cycle</strong> &ndash; Select your drying cycle and press Start. If the load is still damp, run a new timed dry cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If PF appears regularly without a power outage, the control board or power supply wiring may have an intermittent fault. Call {$phone} for diagnosis.</p>
HTML;

$content['hf-dryer-heat-failure'] = <<<HTML
<h2>What Does Monogram Dryer Error Code HF Mean?</h2>
<p>Error code <strong>HF</strong> on a Monogram dryer stands for <strong>No Heat / Heating Failure</strong>. The dryer is running but no heat is being produced, or the temperature is too low to properly dry clothes. The control board monitors temperature and triggers HF when heating does not occur within the expected time.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Tripped thermal fuse</strong> &ndash; A one-time safety fuse has blown due to overheating (often from restricted airflow). This is the most common cause of no heat.</li>
<li><strong>Failed heating element (electric)</strong> &ndash; The resistive heating coil has burned out.</li>
<li><strong>Failed gas igniter or valve (gas models)</strong> &ndash; The igniter glows but doesn't ignite gas, or the gas valve coils have failed.</li>
<li><strong>Tripped high-limit thermostat</strong> &ndash; The high-limit safety thermostat has opened due to overheating.</li>
<li><strong>Restricted airflow</strong> &ndash; See AF code — restricted venting causes the thermal fuse to blow.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Check airflow first</strong> &ndash; Clean the lint screen and exhaust duct before replacing any parts. A blocked duct will blow a new thermal fuse immediately.</li>
<li><strong>Check the circuit breaker</strong> &ndash; On electric dryers, two breaker poles supply power. If one is tripped, the drum will spin but there will be no heat.</li>
<li><strong>Verify gas supply</strong> &ndash; On gas models, ensure the gas shutoff valve is open and the home gas supply is active.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Thermal fuse, heating element, and gas valve replacement requires professional diagnosis. Call {$phone} for certified Monogram dryer repair.</p>
HTML;

$content['e1-dryer-thermistor-error'] = <<<HTML
<h2>What Does Monogram Dryer Error Code E1 Mean?</h2>
<p>Error code <strong>E1</strong> on a Monogram dryer indicates a <strong>thermistor (temperature sensor) error</strong>. The sensor that monitors dryer drum or exhaust temperature is reading a value outside the expected operating range, which prevents the control board from managing the heat cycle safely.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed thermistor</strong> &ndash; The sensor has failed open-circuit or short-circuit, producing an out-of-range resistance reading.</li>
<li><strong>Loose wiring connector</strong> &ndash; The connector to the thermistor has vibrated loose over time.</li>
<li><strong>Damaged wiring</strong> &ndash; Heat damage or chafing has compromised the sensor wires.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Reset</strong> &ndash; Unplug the dryer for 60 seconds and restart. If E1 clears, monitor for recurrence.</li>
<li><strong>Check the thermistor location</strong> &ndash; On most Monogram dryers, the thermistor is on the exhaust duct near the drum outlet. With power off, reseat its connector.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Thermistor resistance testing and replacement requires multimeter access to internal components. Call {$phone} for expert Monogram dryer diagnosis.</p>
HTML;

// ── REFRIGERATOR (missed + new) ──────────────────────────────

$content['cc-refrigerator-temperature-incorrect'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code CC Mean?</h2>
<p>Error code <strong>CC</strong> on a Monogram refrigerator indicates the <strong>fresh food compartment temperature is not correct</strong> — typically warmer than the set point. The control board has detected a significant deviation between the actual and target temperature in the main refrigerator section.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Dirty condenser coils</strong> &ndash; Dust-covered condenser coils can't efficiently release heat, reducing cooling performance.</li>
<li><strong>Blocked air vents</strong> &ndash; Food items placed directly against the rear wall block airflow between compartments.</li>
<li><strong>Failed evaporator fan</strong> &ndash; The fan that circulates cold air from the freezer to the refrigerator section has stopped.</li>
<li><strong>Faulty temperature sensor</strong> &ndash; The refrigerator compartment thermistor is reading incorrectly.</li>
<li><strong>Door seal leak</strong> &ndash; A damaged door gasket allows warm air infiltration.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean condenser coils</strong> &ndash; Vacuum the coils at the back or underneath the unit (unplug first).</li>
<li><strong>Clear air vents</strong> &ndash; Rearrange food to allow at least 1 inch of clearance from all rear and side walls.</li>
<li><strong>Check door seals</strong> &ndash; Run a dollar bill test — close the door on a bill and try to pull it out. It should have noticeable resistance all the way around.</li>
<li><strong>Reset</strong> &ndash; Unplug for 30 seconds, then restore power.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If CC persists after cleaning coils and checking seals, the evaporator fan or temperature sensor likely needs replacement. Call {$phone} for Monogram refrigerator service.</p>
HTML;

$content['op-refrigerator-door-open-alarm'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code OP Mean?</h2>
<p>Error code <strong>OP</strong> on a Monogram refrigerator is a <strong>door open alarm</strong>. The refrigerator has detected that a door was left open for more than the programmed alert time (typically 3–5 minutes), causing the interior temperature to rise. The alarm is triggered to alert you before food safety is compromised.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Door left ajar</strong> &ndash; A family member left the refrigerator or freezer door open.</li>
<li><strong>Faulty door closure</strong> &ndash; The door is visually closed but the hinge or seal prevents a full seal.</li>
<li><strong>Damaged door gasket</strong> &ndash; A torn or warped gasket prevents the door from fully sealing.</li>
<li><strong>Door switch fault</strong> &ndash; The magnetic switch that detects door closure has failed and signals "open" even when the door is shut.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Close the door firmly</strong> &ndash; The alarm should clear once the door is properly closed.</li>
<li><strong>Test the gasket</strong> &ndash; Run the dollar bill test around the door perimeter. Replace the gasket if you feel any gaps.</li>
<li><strong>Check for levelness</strong> &ndash; An unlevel refrigerator may cause doors to drift open. Adjust the leveling legs so the unit tilts slightly back.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A faulty door switch or damaged gasket requires replacement. Call {$phone} to schedule service.</p>
HTML;

$content['4-defrost-heater-problem'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code 4 Mean?</h2>
<p>Error code <strong>4</strong> on a Monogram refrigerator indicates a <strong>defrost heater problem</strong>. The automatic defrost system — which periodically heats the evaporator coils to melt frost buildup — is not operating properly. This eventually leads to ice accumulation on the evaporator, blocking airflow and degrading cooling performance.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Burned-out defrost heater</strong> &ndash; The resistive heater coil wrapped around the evaporator has failed.</li>
<li><strong>Blown defrost fuse / thermal limiter</strong> &ndash; A one-time safety fuse in the defrost circuit has opened.</li>
<li><strong>Failed defrost thermostat</strong> &ndash; The thermostat that limits defrost temperature has failed open, preventing heater activation.</li>
<li><strong>Defrost control board fault</strong> &ndash; The main control board is not initiating the defrost cycle.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Manual defrost</strong> &ndash; Unplug the refrigerator for 24–48 hours with doors open to manually melt frost. If cooling improves after this, the defrost system has failed.</li>
<li><strong>Listen for the defrost heater</strong> &ndash; During a defrost cycle, you should hear a soft hiss as ice melts. No sound at all suggests the heater is not activating.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Defrost heater and thermostat replacement requires accessing the evaporator behind the back wall of the freezer. Call {$phone} for certified Monogram refrigerator repair.</p>
HTML;

$content['6-evaporator-fan-motor-fault'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code 6 Mean?</h2>
<p>Error code <strong>6</strong> on a Monogram refrigerator indicates an <strong>evaporator fan motor fault</strong>. The fan that circulates cold air from the evaporator coils throughout the refrigerator and freezer compartments is not running at the correct speed or has stopped entirely.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed evaporator fan motor</strong> &ndash; The fan motor has burned out and is no longer spinning.</li>
<li><strong>Ice buildup on fan blade</strong> &ndash; Excess frost has accumulated and is preventing the fan from spinning freely.</li>
<li><strong>Obstructed fan blade</strong> &ndash; A food item or debris is blocking the fan.</li>
<li><strong>Loose wiring connector</strong> &ndash; The connector to the fan motor has come loose.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Listen for fan noise</strong> &ndash; Open the freezer door. You should hear the fan running. If silent and the compressor is running, the fan motor has likely failed.</li>
<li><strong>Check for ice blockage</strong> &ndash; If frost accumulation is the cause, manually defrost the unit (unplug 24 hours) and test again.</li>
<li><strong>Press door switch</strong> &ndash; Hold the freezer door switch with the door open. If you can hear the fan start, the door switch may be triggering it off.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Evaporator fan motor replacement requires accessing the freezer back panel. Call {$phone} to schedule Monogram refrigerator repair.</p>
HTML;

$content['8-ice-maker-fault'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code 8 Mean?</h2>
<p>Error code <strong>8</strong> on a Monogram refrigerator indicates an <strong>ice maker fault</strong>. The ice maker assembly has reported an error — this can range from a temperature problem in the ice maker compartment to a mechanical failure in the ice production mechanism.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Ice maker turned off</strong> &ndash; The ice maker arm or control switch is in the off position.</li>
<li><strong>Frozen water supply line</strong> &ndash; The water line feeding the ice maker has frozen inside the freezer door or back panel.</li>
<li><strong>Failed ice maker assembly</strong> &ndash; The ice maker module (motor, thermostat, or mold heater) has failed.</li>
<li><strong>Water inlet valve failure</strong> &ndash; The dual solenoid water inlet valve's ice maker side has failed, preventing water delivery.</li>
<li><strong>Ice maker temperature too warm</strong> &ndash; The freezer is not cold enough for the ice maker to complete its cycle.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Verify ice maker is on</strong> &ndash; Check that the ice maker's on/off arm is in the down (on) position.</li>
<li><strong>Check freezer temperature</strong> &ndash; The freezer should be set to 0°F (-18°C) for reliable ice production.</li>
<li><strong>Test water supply</strong> &ndash; Dispense water through the door dispenser. If no water flows, the inlet valve or water line has an issue.</li>
<li><strong>Reset the ice maker</strong> &ndash; Press and hold the ice maker test/reset button for 3 seconds.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Call {$phone} if the ice maker needs replacement or the water inlet valve needs diagnosis and repair.</p>
HTML;

$content['e0-communication-error'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code E0 Mean?</h2>
<p>Error code <strong>E0</strong> on a Monogram refrigerator indicates a <strong>control board communication error</strong>. The main electronic control board (or the user interface board) is not communicating properly with one of the other boards or sensors in the system.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Loose wiring harness connector</strong> &ndash; A connector between control boards has come loose due to vibration.</li>
<li><strong>Failed main control board</strong> &ndash; The primary control module has developed an internal fault.</li>
<li><strong>Failed user interface board</strong> &ndash; The dispenser or display board is not responding to the main board.</li>
<li><strong>Power surge damage</strong> &ndash; A voltage spike has corrupted board firmware or damaged components.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Unplug the refrigerator for 5 full minutes, then restore power. E0 sometimes clears on its own after a reset.</li>
<li><strong>Check connections</strong> &ndash; If the error returns after reset, a technician should check wiring harness connectors between the main board and display board.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Control board diagnosis requires accessing sealed compartments and using service mode diagnostics. Call {$phone} for expert Monogram refrigerator repair.</p>
HTML;

$content['sy-ef-sealed-system-evaporator-fan'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code SY EF Mean?</h2>
<p>Error code <strong>SY EF</strong> on a Monogram refrigerator stands for <strong>Evaporator Fan System Fault</strong>. This code specifically indicates the evaporator fan motor circuit has failed — the control board is not detecting the fan's operation feedback signal.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed evaporator fan motor</strong> &ndash; The motor has stopped running and is drawing no current or not producing a proper feedback signal.</li>
<li><strong>Seized fan due to ice buildup</strong> &ndash; Heavy frost has locked the fan blade in place.</li>
<li><strong>Open circuit in fan wiring</strong> &ndash; A broken wire or disconnected connector in the fan motor circuit.</li>
<li><strong>Control board fan relay fault</strong> &ndash; The relay on the main board that powers the fan has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Manual defrost</strong> &ndash; Unplug for 24 hours. If ice was blocking the fan, it will now spin freely and SY EF may clear.</li>
<li><strong>Listen at startup</strong> &ndash; After restoring power, the fan should run immediately. Silence from the freezer compartment confirms the motor is not running.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Evaporator fan motor replacement in the sealed compartment requires professional service. Call {$phone} for Monogram refrigerator repair.</p>
HTML;

// ── OVEN (missed + new) ──────────────────────────────────────

$content['f1-oven-system-watchdog-stuck-key'] = <<<HTML
<h2>What Does Monogram Oven Error Code F1 Mean?</h2>
<p>Error code <strong>F1</strong> on a Monogram oven or range indicates a <strong>system watchdog fault or stuck key</strong>. This means either the main control board's watchdog circuit detected a software or hardware failure, or one of the control panel buttons is registered as continuously pressed.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Control board failure</strong> &ndash; An internal fault in the main control board's processor or memory.</li>
<li><strong>Stuck touch pad key</strong> &ndash; Moisture or a hardware defect has caused a key to register continuous input.</li>
<li><strong>Power surge</strong> &ndash; A voltage spike corrupted control board firmware.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Turn off the oven circuit breaker for 30 seconds, then restore power. If F1 clears, monitor for recurrence.</li>
<li><strong>Inspect the touch pad</strong> &ndash; Check for moisture or damage around the control panel. Dry thoroughly if wet.</li>
<li><strong>Cancel and restart</strong> &ndash; Press Cancel to attempt to clear the fault without a full power cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Persistent F1 typically requires control board replacement. Call {$phone} for certified Monogram oven repair with genuine parts.</p>
HTML;

$content['f5-oven-relay-drive-circuit-failure'] = <<<HTML
<h2>What Does Monogram Oven Error Code F5 Mean?</h2>
<p>Error code <strong>F5</strong> on a Monogram oven indicates a <strong>relay drive circuit failure</strong> on the main control board. The board has detected that one of its internal relay outputs — used to control the bake or broil element — is not functioning correctly.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Welded relay contacts</strong> &ndash; A relay on the control board has welded shut due to arcing, causing the element to remain powered even when it should be off. This is a fire and burn hazard.</li>
<li><strong>Failed relay driver circuit</strong> &ndash; The transistor or driver chip that activates the relay has failed, preventing the element from turning on.</li>
<li><strong>Control board failure</strong> &ndash; The broader control board has failed with a relay circuit fault.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Stop using the oven immediately</strong> &ndash; F5 can indicate a welded relay where the element stays on — this is dangerous. Disconnect power at the breaker.</li>
<li><strong>Hard reset</strong> &ndash; After 5 minutes of power off, restore and observe. If the oven gets hot without being turned on, a relay is welded — do not use the oven.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>F5 is a safety-critical fault. Call {$phone} immediately for urgent Monogram oven repair before using the appliance again.</p>
HTML;

$content['f8-oven-shorted-meat-probe'] = <<<HTML
<h2>What Does Monogram Oven Error Code F8 Mean?</h2>
<p>Error code <strong>F8</strong> on a Monogram oven indicates a <strong>shorted meat probe (temperature probe)</strong>. The accessory probe used to monitor internal meat temperature is registering a resistance that indicates a short circuit, meaning the probe leads are contacting each other or the probe is damaged.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Damaged probe cable</strong> &ndash; The cord of the meat probe has been nicked, burned, or crimped, shorting the conductors together.</li>
<li><strong>Probe stored in oven</strong> &ndash; Leaving the probe connected during a self-clean cycle destroys it.</li>
<li><strong>Faulty probe jack socket</strong> &ndash; The probe receptacle inside the oven has debris or damage causing a short.</li>
<li><strong>No probe connected but socket dirty</strong> &ndash; Moisture or debris in the probe socket can sometimes trigger F8 without a probe attached.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Disconnect the probe</strong> &ndash; Remove the meat probe from the oven socket. If F8 clears, the probe is faulty and needs replacement.</li>
<li><strong>Clean the socket</strong> &ndash; With the oven cool and power off, carefully clean the probe receptacle.</li>
<li><strong>Inspect the probe cord</strong> &ndash; Look for cracks, burns, or exposed wiring on the probe cable.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If F8 persists after disconnecting the probe, the probe socket or control board needs service. Call {$phone} for Monogram oven repair.</p>
HTML;

$content['f6-oven-door-lock-circuit'] = <<<HTML
<h2>What Does Monogram Oven Error Code F6 Mean?</h2>
<p>Error code <strong>F6</strong> on a Monogram oven indicates a <strong>door lock circuit failure</strong>. The motorized door lock mechanism used during self-clean cycles has developed an electrical fault — the control board cannot confirm the lock motor completed its travel to the locked or unlocked position.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed door lock motor</strong> &ndash; The small motor that drives the latch mechanism has burned out.</li>
<li><strong>Defective door lock switch</strong> &ndash; The microswitch that confirms locked/unlocked position has failed.</li>
<li><strong>Wiring fault</strong> &ndash; Loose or damaged wiring in the door lock circuit.</li>
<li><strong>Door lock assembly jammed</strong> &ndash; Debris or food residue is preventing the latch from traveling its full range.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Turn off the breaker for 60 seconds, then restore. This may release a locked door after a self-clean interruption.</li>
<li><strong>Allow to cool</strong> &ndash; The door remains locked until the oven cools below ~250°F. Wait at least 30 minutes after power restoration.</li>
<li><strong>Check for obstructions</strong> &ndash; Look at the door latch area for food buildup that may prevent smooth operation.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A stuck locked door and F6 code require professional service. Call {$phone} for Monogram oven repair — do not force the door open.</p>
HTML;

$content['f7-oven-function-key-stuck'] = <<<HTML
<h2>What Does Monogram Oven Error Code F7 Mean?</h2>
<p>Error code <strong>F7</strong> on a Monogram oven indicates a <strong>function key is shorted or stuck</strong>. The control board has detected that one of the touch pad buttons is registering as continuously pressed, which prevents normal operation.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Moisture under touch pad</strong> &ndash; Steam or cleaning liquid has seeped under the control panel membrane, creating a continuous contact.</li>
<li><strong>Failed touch pad membrane</strong> &ndash; A key in the membrane has delaminated and is permanently activated.</li>
<li><strong>Food debris on panel</strong> &ndash; Sticky residue is holding a button in a depressed state.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the control panel</strong> &ndash; Wipe gently with a dry cloth. Do not use wet cleaners directly on the panel.</li>
<li><strong>Hard reset</strong> &ndash; Turn off the circuit breaker for 30 seconds and restore. If F7 clears, the fault was likely a moisture-induced transient.</li>
<li><strong>Allow panel to dry</strong> &ndash; If the panel was recently cleaned or exposed to steam, let it dry for several hours before powering on.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A permanently failed touch pad membrane requires replacement of the control panel assembly. Call {$phone} for Monogram oven service.</p>
HTML;

$content['f10-oven-runaway-temperature'] = <<<HTML
<h2>What Does Monogram Oven Error Code F10 Mean?</h2>
<p>Error code <strong>F10</strong> on a Monogram oven indicates <strong>runaway oven temperature</strong> — the oven temperature has exceeded approximately 590°F (310°C) during a normal bake or broil cycle. This is a critical safety fault: the oven immediately shuts off the heating elements to prevent damage and fire risk.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Welded bake/broil relay</strong> &ndash; The most dangerous cause — a relay on the control board has welded shut and is continuously powering the element with no temperature control.</li>
<li><strong>Failed oven temperature sensor (RTD)</strong> &ndash; The sensor reads too low, causing the control to keep heating past the actual setpoint.</li>
<li><strong>Runaway control board</strong> &ndash; The board has lost control of its relay outputs.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Disconnect power immediately</strong> &ndash; Turn off the oven's circuit breaker. F10 is a safety alert — stop using the oven until it is repaired.</li>
<li><strong>Do not reset and resume</strong> &ndash; A welded relay will cause the oven to re-overheat immediately. This is a fire hazard.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>F10 requires immediate professional inspection. Call {$phone} urgently — do not use the oven until a certified Monogram technician clears this fault.</p>
HTML;

// ── COOKTOP (missed + new) ───────────────────────────────────

$content['f1-cooktop-stuck-touch-pad'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F1 Mean?</h2>
<p>Error code <strong>F1</strong> on a Monogram cooktop indicates a <strong>stuck or shorted touch pad</strong>. One of the touch controls on the cooktop surface is registering as continuously pressed, preventing normal operation.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Moisture on touch surface</strong> &ndash; Water or condensation under the glass surface is causing a false touch input.</li>
<li><strong>Boilover residue</strong> &ndash; Spilled liquid has dried over a touch sensor zone, simulating a continuous press.</li>
<li><strong>Failed touch pad controller</strong> &ndash; The capacitive sensing circuit has developed a fault.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the surface</strong> &ndash; Wipe the cooktop glass thoroughly with a dry microfiber cloth. Ensure no liquid is pooled near the controls.</li>
<li><strong>Power cycle</strong> &ndash; Turn the cooktop off at the breaker for 30 seconds, then restore.</li>
<li><strong>Remove moisture</strong> &ndash; If liquid got under the glass or control area, allow 24 hours to dry before re-testing.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Persistent F1 requires touch pad assembly replacement. Call {$phone} for Monogram cooktop service.</p>
HTML;

$content['f113-cooktop-temperature-sensor'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F113 Mean?</h2>
<p>Error code <strong>F113</strong> on a Monogram cooktop indicates the <strong>temperature sensor is reading out of range</strong>. The sensor that monitors the glass surface or element temperature is reporting a value that is outside the normal operating window, causing the control to halt operation as a safety precaution.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed temperature sensor</strong> &ndash; The thermistor or thermocouple measuring cooktop temperature has failed.</li>
<li><strong>Loose sensor connector</strong> &ndash; The wiring to the sensor has come loose, creating an open circuit reading.</li>
<li><strong>Control board fault</strong> &ndash; The board's sensor input circuit has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Reset</strong> &ndash; Turn off power at the breaker for 60 seconds and restore. Re-test.</li>
<li><strong>Allow to cool</strong> &ndash; If the cooktop was used heavily, allow 20 minutes to cool completely before resetting.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Temperature sensor access requires removing the cooktop. Call {$phone} for professional Monogram cooktop service.</p>
HTML;

$content['f161-cooktop-burner-sensor-fault'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F161 Mean?</h2>
<p>Error code <strong>F161</strong> on a Monogram cooktop indicates a <strong>burner temperature sensor fault</strong> at a specific burner zone. The sensor monitoring that burner's temperature is not reporting within the expected range, causing the control to disable that zone.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed zone sensor</strong> &ndash; The temperature sensor for that specific burner element has failed.</li>
<li><strong>Wiring damage at that zone</strong> &ndash; Heat cycling over time has damaged the sensor wiring near the burner.</li>
<li><strong>Induction coil failure</strong> &ndash; On induction models, the coil and its sensor are integrated; a coil failure can trigger F161.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Note which zone triggered the code</strong> &ndash; The display may indicate which burner is at fault.</li>
<li><strong>Reset</strong> &ndash; Cycle power off at the breaker for 60 seconds. Retry that specific zone.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Burner zone sensor or coil replacement requires disassembly. Call {$phone} for Monogram cooktop repair.</p>
HTML;

$content['f2-cooktop-shorted-touch-pad'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F2 Mean?</h2>
<p>Error code <strong>F2</strong> on a Monogram cooktop indicates a <strong>shorted touch pad</strong>. Unlike F1 (stuck key), F2 specifically indicates an electrical short in the touch sensing circuit rather than a mechanically stuck control.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Liquid intrusion</strong> &ndash; A boilover or spill has caused a conductive short across touch pad traces.</li>
<li><strong>Failed touch pad membrane</strong> &ndash; Internal failure in the capacitive control layer.</li>
<li><strong>Control module fault</strong> &ndash; The touch sensing controller chip has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean thoroughly</strong> &ndash; Use a cooktop cleaner and a dry cloth. Ensure all residue is cleared from the control area.</li>
<li><strong>Power cycle</strong> &ndash; Breaker off for 60 seconds.</li>
<li><strong>Inspect for cracks</strong> &ndash; A cracked glass surface near the controls can allow liquid to short the sensors.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>F2 often requires control module or touch pad assembly replacement. Call {$phone} for service.</p>
HTML;

$content['f3-cooktop-control-board-failure'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F3 Mean?</h2>
<p>Error code <strong>F3</strong> on a Monogram cooktop indicates a <strong>main control board failure</strong>. The electronic controller that manages power to all burner zones has detected an internal fault or has lost communication with a key component.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power surge damage</strong> &ndash; A voltage spike has damaged the board's circuitry.</li>
<li><strong>Component failure with age</strong> &ndash; Capacitors or relay drivers on the board have failed.</li>
<li><strong>Overheating damage</strong> &ndash; The control board is typically under the cooktop surface; poor ventilation or a nearby burner malfunction can cause heat damage.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> &ndash; Breaker off for 5 minutes, then restore. Test all zones.</li>
<li><strong>Check for burning smell</strong> &ndash; A burnt smell from under the cooktop suggests a component has burned on the board.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Control board replacement requires removing and disassembling the cooktop. Call {$phone} for expert Monogram service with genuine parts.</p>
HTML;

$content['f5-cooktop-pan-temperature-sensor'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F5 Mean?</h2>
<p>Error code <strong>F5</strong> on a Monogram induction cooktop indicates a <strong>pan temperature sensor fault</strong>. The sensor that monitors the temperature of the cooking vessel (used for boost and precise temperature modes) is reading outside the expected range.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Incompatible cookware</strong> &ndash; Non-induction-compatible pans don't provide a proper temperature feedback signal.</li>
<li><strong>Pan sensor circuit failure</strong> &ndash; The sensor in the coil module has failed.</li>
<li><strong>Overheating</strong> &ndash; The sensor triggered a safety shutdown due to a very hot pan.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Use induction-compatible cookware</strong> &ndash; Test with a pot that has a flat magnetic base. A magnet should stick to the bottom.</li>
<li><strong>Allow to cool</strong> &ndash; If a pan was extremely hot, let the zone cool for 10 minutes and reset.</li>
<li><strong>Power cycle</strong> &ndash; Breaker off for 60 seconds.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If F5 persists with proper cookware, the induction coil module needs replacement. Call {$phone}.</p>
HTML;

$content['f6-cooktop-power-board-error'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F6 Mean?</h2>
<p>Error code <strong>F6</strong> on a Monogram cooktop indicates a <strong>power board error</strong>. On induction cooktops, the power board converts AC mains power into the high-frequency AC used to drive the induction coils. F6 indicates this board has detected an internal fault.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>IGBT transistor failure</strong> &ndash; The switching transistors on the power board have failed (often from a short-circuit in the coil or cookware fault).</li>
<li><strong>Overtemperature shutdown</strong> &ndash; The power board overheated and its protection circuit triggered.</li>
<li><strong>Power supply fault</strong> &ndash; Incorrect or unstable voltage supply is causing the board to fault.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Allow cooling time</strong> &ndash; Turn off at the breaker and wait 30 minutes before resetting, in case overtemperature triggered F6.</li>
<li><strong>Check ventilation</strong> &ndash; Ensure the cooktop's ventilation slots under the unit are not blocked.</li>
<li><strong>Hard reset</strong> &ndash; Restore power after cooling and test a single burner zone at low power.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Power board replacement is a high-voltage repair. Call {$phone} for safe, professional Monogram cooktop service.</p>
HTML;

$content['loc-cooktop-control-lock'] = <<<HTML
<h2>What Does Monogram Cooktop LOC / Control Lock Mean?</h2>
<p><strong>LOC</strong> displayed on a Monogram cooktop indicates the <strong>control lock (surface lock) is active</strong>. This is a child-safety feature that disables all touch controls to prevent accidental activation. It is not an error — it is an intentionally activated mode.</p>
<h2>How to Unlock the Cooktop</h2>
<ol>
<li><strong>Press and hold the Lock button</strong> &ndash; On most Monogram cooktops, press and hold the lock key (padlock icon or "LOC" key) for 3 seconds until the LOC indicator turns off.</li>
<li><strong>Refer to your model's manual</strong> &ndash; Some models require holding a specific button combination. The indicator light near the lock symbol will extinguish when unlocked.</li>
<li><strong>Power cycle if unresponsive</strong> &ndash; If the unlock button has no effect, turn off the circuit breaker for 30 seconds and restore. The lock state does not persist across power cycles on most models.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If the cooktop remains locked after trying all methods, the control lock circuit may have a fault. Call {$phone} for Monogram cooktop diagnosis.</p>
HTML;

$content['f115-cooktop-igniter-fault'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F115 Mean?</h2>
<p>Error code <strong>F115</strong> on a Monogram gas cooktop indicates an <strong>igniter fault</strong>. The control board has detected that the spark igniter on one or more burners is not functioning correctly — either not sparking when commanded, or sparking continuously when it should not be.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Wet igniter</strong> &ndash; Boilover liquid has saturated the igniter, causing continuous clicking or preventing sparks.</li>
<li><strong>Cracked igniter tip</strong> &ndash; Physical damage to the ceramic igniter electrode prevents effective sparking.</li>
<li><strong>Clogged burner cap</strong> &ndash; Food debris blocking the burner ports prevents ignition even when the igniter works.</li>
<li><strong>Failed igniter module</strong> &ndash; The spark module that generates high voltage for the igniters has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Dry the igniters</strong> &ndash; Remove burner grates and caps. Dry the igniter tips with a hair dryer on low heat for 2–3 minutes.</li>
<li><strong>Clean burner caps</strong> &ndash; Remove and wash burner caps and bases. Clear any clogged ports with a toothpick.</li>
<li><strong>Reset</strong> &ndash; Cycle power off and on at the breaker after cleaning.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A cracked igniter or failed igniter module needs replacement. Call {$phone} for professional Monogram cooktop repair.</p>
HTML;

// ============================================================
// CREATE POSTS
// ============================================================
$created = 0;
$skipped = 0;

foreach ( $defs as $slug => $def ) {
    list( $title, $code_value, $appliance_slug ) = $def;

    // Skip if already exists
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
    error_log( "BRP v2 error codes: created={$created}, skipped={$skipped}" );
}
