<?php
/**
 * Create Error Codes – Batch 5
 * Adds Wine Cooler (11 codes) and Range Hood (11 codes).
 * Triggered once via brp_error_codes_v5_done transient.
 *
 * @package MonogramRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$phone     = defined( 'BRP_PHONE' )     ? BRP_PHONE     : '844-752-7887';
$phone_raw = defined( 'BRP_PHONE_RAW' ) ? BRP_PHONE_RAW : '8447527887';

// Ensure terms exist
foreach ( array( 'wine-cooler' => 'Wine Cooler', 'hood' => 'Range Hood' ) as $slug => $label ) {
    if ( ! term_exists( $slug, 'appliance_type' ) ) {
        wp_insert_term( $label, 'appliance_type', array( 'slug' => $slug ) );
    }
}

// ============================================================
// ERROR CODE DEFINITIONS
// slug => [ title, code_value, appliance_type_slug ]
// ============================================================
$defs = array(

    // ── WINE COOLER ─────────────────────────────────────────
    'wc-e1-temperature-sensor-open'        => array( 'Monogram Wine Cooler Error Code E1 – Temperature Sensor Open Circuit',      'E1',  'wine-cooler' ),
    'wc-e2-temperature-sensor-short'       => array( 'Monogram Wine Cooler Error Code E2 – Temperature Sensor Short Circuit',     'E2',  'wine-cooler' ),
    'wc-e3-evaporator-fan-fault'           => array( 'Monogram Wine Cooler Error Code E3 – Evaporator Fan Motor Fault',           'E3',  'wine-cooler' ),
    'wc-e4-condenser-fan-fault'            => array( 'Monogram Wine Cooler Error Code E4 – Condenser Fan Motor Fault',            'E4',  'wine-cooler' ),
    'wc-e5-compressor-overload'            => array( 'Monogram Wine Cooler Error Code E5 – Compressor Overload Protection',       'E5',  'wine-cooler' ),
    'wc-e6-control-board-communication'    => array( 'Monogram Wine Cooler Error Code E6 – Control Board Communication Error',    'E6',  'wine-cooler' ),
    'wc-e7-defrost-system-fault'           => array( 'Monogram Wine Cooler Error Code E7 – Defrost System Fault',                 'E7',  'wine-cooler' ),
    'wc-op-door-open-alarm'                => array( 'Monogram Wine Cooler Error Code OP – Door Open Alarm',                      'OP',  'wine-cooler' ),
    'wc-ec-cooling-system-failure'         => array( 'Monogram Wine Cooler Error Code EC – Cooling System Failure',               'EC',  'wine-cooler' ),
    'wc-hi-high-temperature-alarm'         => array( 'Monogram Wine Cooler Error Code HI – High Temperature Alarm',               'HI',  'wine-cooler' ),
    'wc-pf-power-failure-reset'            => array( 'Monogram Wine Cooler Error Code PF – Power Failure Reset',                  'PF',  'wine-cooler' ),

    // ── RANGE HOOD ──────────────────────────────────────────
    'hood-e1-blower-motor-speed-fault'     => array( 'Monogram Range Hood Error Code E1 – Blower Motor Speed Fault',              'E1',  'hood' ),
    'hood-e2-control-board-failure'        => array( 'Monogram Range Hood Error Code E2 – Control Board Failure',                 'E2',  'hood' ),
    'hood-e3-touch-panel-fault'            => array( 'Monogram Range Hood Error Code E3 – Touch Panel / Keypad Fault',            'E3',  'hood' ),
    'hood-e4-grease-filter-alert'          => array( 'Monogram Range Hood Error Code E4 – Grease Filter Full Alert',              'E4',  'hood' ),
    'hood-e5-light-circuit-fault'          => array( 'Monogram Range Hood Error Code E5 – LED Light Circuit Fault',               'E5',  'hood' ),
    'hood-e6-fan-motor-overload'           => array( 'Monogram Range Hood Error Code E6 – Fan Motor Overload / Thermal Protection','E6',  'hood' ),
    'hood-e7-communication-error'          => array( 'Monogram Range Hood Error Code E7 – Main-to-Display Communication Error',   'E7',  'hood' ),
    'hood-f1-main-control-board-failure'   => array( 'Monogram Range Hood Error Code F1 – Main Control Board Failure',            'F1',  'hood' ),
    'hood-f2-speed-control-module-fault'   => array( 'Monogram Range Hood Error Code F2 – Speed Control Module Fault',            'F2',  'hood' ),
    'hood-loc-control-lock'                => array( 'Monogram Range Hood LOC – Control Lock Active',                             'LOC', 'hood' ),
    'hood-cln-filter-cleaning-reminder'    => array( 'Monogram Range Hood CLN – Filter Cleaning Reminder',                        'CLN', 'hood' ),
);

// ============================================================
// CONTENT
// ============================================================
$content = array();

// ── WINE COOLER ──────────────────────────────────────────────

$content['wc-e1-temperature-sensor-open'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code E1 Mean?</h2>
<p>Error code <strong>E1</strong> on a Monogram wine cooler indicates a <strong>temperature sensor open circuit</strong>. The thermistor that monitors the internal cabinet temperature has failed open — the control board receives no signal from the sensor and cannot regulate the cooling cycle accurately.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed thermistor</strong> — The sensor element has broken internally, resulting in an open circuit.</li>
<li><strong>Damaged wiring</strong> — The thin wires running from the sensor to the control board have been pinched, cut, or corroded.</li>
<li><strong>Loose connector</strong> — The sensor connector has partially disconnected from the control board.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> — Unplug the wine cooler for 5 minutes, then restore power. If E1 clears and does not return, the fault was transient.</li>
<li><strong>Check temperature</strong> — If the cabinet is warming despite E1 clearing, the sensor has genuinely failed and will need replacement.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Thermistor replacement requires accessing the interior wiring. Call {$phone} for certified Monogram wine cooler repair.</p>
HTML;

$content['wc-e2-temperature-sensor-short'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code E2 Mean?</h2>
<p>Error code <strong>E2</strong> on a Monogram wine cooler indicates a <strong>temperature sensor short circuit</strong>. The thermistor's resistance has dropped near zero, sending a false reading of extreme cold to the control board. This may cause the compressor to run continuously or not at all.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Shorted thermistor</strong> — The sensor element has failed internally with a short circuit.</li>
<li><strong>Moisture damage</strong> — Condensation has entered the sensor housing, bridging the circuit.</li>
<li><strong>Wiring fault</strong> — The sensor cable has been pinched against a metal component, causing a short.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> — Unplug for 5 minutes and restore power.</li>
<li><strong>Inspect for moisture</strong> — If condensation is visible inside the cabinet, allow it to dry with the door open before retesting.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A shorted thermistor requires professional replacement. Call {$phone} for Monogram wine cooler service.</p>
HTML;

$content['wc-e3-evaporator-fan-fault'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code E3 Mean?</h2>
<p>Error code <strong>E3</strong> on a Monogram wine cooler indicates an <strong>evaporator fan motor fault</strong>. The fan that circulates cold air through the cabinet has stopped or is running below the required speed. Without this airflow, the wine cooler loses the ability to maintain consistent temperatures throughout the cabinet.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed fan motor</strong> — The motor has burned out or its bearings have seized.</li>
<li><strong>Ice blockage</strong> — Frost accumulation has physically jammed the fan blade.</li>
<li><strong>Wiring fault</strong> — A loose or broken wire in the fan motor circuit.</li>
<li><strong>Door switch fault</strong> — A faulty door switch is keeping the fan off even with the door closed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Listen for the fan</strong> — With the door closed, the fan should be audible. Silence with the compressor running suggests fan failure.</li>
<li><strong>Manual defrost</strong> — If heavy frost is present, unplug for 24 hours to allow ice to melt, then retest.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Evaporator fan motor replacement requires internal access. Call {$phone} for Monogram wine cooler repair.</p>
HTML;

$content['wc-e4-condenser-fan-fault'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code E4 Mean?</h2>
<p>Error code <strong>E4</strong> on a Monogram wine cooler indicates a <strong>condenser fan motor fault</strong>. The condenser fan dissipates heat from the refrigeration system. When it fails, the compressor overheats and the cooling system loses efficiency, resulting in rising cabinet temperatures.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed condenser fan motor</strong> — Motor burnout or seized bearings.</li>
<li><strong>Debris obstruction</strong> — Dust, lint, or foreign objects blocking the fan blade.</li>
<li><strong>Wiring fault</strong> — Broken or loose connection to the fan motor.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the condenser area</strong> — Unplug the unit and vacuum dust from the rear condenser area and fan.</li>
<li><strong>Listen for the fan</strong> — The condenser fan should run whenever the compressor is running.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Condenser fan replacement requires rear panel access. Call {$phone} for Monogram wine cooler service.</p>
HTML;

$content['wc-e5-compressor-overload'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code E5 Mean?</h2>
<p>Error code <strong>E5</strong> on a Monogram wine cooler indicates <strong>compressor overload protection</strong> has tripped. The compressor's thermal protector has shut the compressor down to prevent damage from overheating. The wine cooler will not cool until the compressor cools down and the protector resets.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Blocked ventilation</strong> — Insufficient clearance around the unit is trapping heat.</li>
<li><strong>Failed condenser fan</strong> — The fan that cools the condenser is not running (see E4).</li>
<li><strong>Dirty condenser coils</strong> — Heavy dust coating the condenser reduces heat transfer efficiency.</li>
<li><strong>Compressor wear</strong> — An aging compressor draws more current, runs hotter, and triggers the overload protector more easily.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Ensure ventilation clearance</strong> — Allow at least 3 inches on all sides of the unit.</li>
<li><strong>Clean the condenser</strong> — Vacuum the condenser coils at the rear or bottom of the unit.</li>
<li><strong>Allow to cool and reset</strong> — Unplug for 30 minutes, then restore power.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If E5 returns quickly after reset, the compressor or condenser fan requires professional diagnosis. Call {$phone} for Monogram wine cooler service.</p>
HTML;

$content['wc-e6-control-board-communication'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code E6 Mean?</h2>
<p>Error code <strong>E6</strong> on a Monogram wine cooler indicates a <strong>control board communication error</strong>. The main control board and the user interface (display) board have lost communication. The wine cooler halts normal operation until communication is restored.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Loose wiring harness</strong> — The connector between boards has partially unseated.</li>
<li><strong>Failed display board</strong> — The user interface PCB has developed an internal fault.</li>
<li><strong>Failed main board</strong> — The main control board has lost its communication circuit.</li>
<li><strong>Power surge</strong> — A voltage spike has corrupted firmware or damaged board components.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> — Unplug for 5 full minutes and restore power.</li>
<li><strong>Check for recurrence</strong> — If E6 returns within hours of clearing, a board fault is confirmed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Board-level diagnosis requires service tools. Call {$phone} for certified Monogram wine cooler repair.</p>
HTML;

$content['wc-e7-defrost-system-fault'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code E7 Mean?</h2>
<p>Error code <strong>E7</strong> on a Monogram wine cooler indicates a <strong>defrost system fault</strong>. The automatic defrost cycle — which periodically melts frost from the evaporator coils — is not operating correctly. Over time, frost accumulation blocks airflow and reduces cooling performance.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed defrost heater</strong> — The heater coil has burned out.</li>
<li><strong>Blown defrost fuse</strong> — A one-time thermal fuse in the defrost circuit has opened.</li>
<li><strong>Failed defrost thermostat</strong> — The thermostat that allows heater activation has failed open.</li>
<li><strong>Control board defrost relay fault</strong> — The relay initiating defrost cycles has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Manual defrost</strong> — Unplug for 24 hours with the door open. If cooling improves after restoring power, the automatic defrost system has failed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Defrost component access requires removing the interior back panel. Call {$phone} for Monogram wine cooler service.</p>
HTML;

$content['wc-op-door-open-alarm'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code OP Mean?</h2>
<p>Error code <strong>OP</strong> on a Monogram wine cooler is a <strong>door open alarm</strong>. The door has been left open or ajar beyond the programmed threshold (typically 3–5 minutes). The alert triggers to protect wine from temperature fluctuations before the cabinet warms to an unsafe level.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Door left ajar</strong> — An item is preventing the door from closing fully.</li>
<li><strong>Damaged door gasket</strong> — A torn or warped gasket prevents a complete seal.</li>
<li><strong>Failed door switch</strong> — The switch detecting door closure has failed in the open position.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Close the door firmly</strong> — Remove any obstructions and ensure the door latches completely.</li>
<li><strong>Test the gasket</strong> — Close the door on a dollar bill. If you feel no resistance when pulling, the gasket needs replacement.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>A faulty door switch or damaged gasket requires replacement. Call {$phone} for Monogram wine cooler service.</p>
HTML;

$content['wc-ec-cooling-system-failure'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code EC Mean?</h2>
<p>Error code <strong>EC</strong> on a Monogram wine cooler indicates a <strong>cooling system failure</strong>. The cabinet temperature has risen significantly above the set point despite the compressor running — or the compressor is not running at all. This is one of the more serious error codes, indicating a failure within the sealed refrigeration system or a major component.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Refrigerant leak</strong> — The sealed system has lost refrigerant charge, reducing or eliminating cooling capacity.</li>
<li><strong>Compressor failure</strong> — The compressor has failed mechanically or electrically.</li>
<li><strong>Blocked capillary tube</strong> — A restriction in the sealed system is preventing refrigerant flow.</li>
<li><strong>Failed start relay</strong> — The compressor start relay has failed, preventing the compressor from starting.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Check compressor operation</strong> — Place your hand on the back or bottom of the unit. The compressor should produce a gentle vibration and warmth when running.</li>
<li><strong>Hard reset</strong> — Unplug for 10 minutes. If the compressor starts after reset but EC returns, a sealed system fault is confirmed.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Sealed system repairs and compressor replacement require specialized tools and refrigerant handling certification. Call {$phone} immediately for expert Monogram wine cooler diagnosis.</p>
HTML;

$content['wc-hi-high-temperature-alarm'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code HI Mean?</h2>
<p>Error code <strong>HI</strong> on a Monogram wine cooler is a <strong>high temperature alarm</strong>. The cabinet temperature has exceeded the programmed high-temperature threshold — typically triggered when the interior rises above 65–70°F (18–21°C). This is a protective alert designed to warn you before wine is compromised by heat exposure.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power interruption</strong> — A power outage warmed the cabinet and HI triggered when power was restored.</li>
<li><strong>Door left open</strong> — Extended door opening allowed warm room air to enter.</li>
<li><strong>Cooling system fault</strong> — Any underlying refrigeration problem (compressor, fan, refrigerant) that reduces cooling capacity.</li>
<li><strong>High ambient temperature</strong> — The room surrounding the wine cooler is exceptionally warm, exceeding the unit's operating range.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Close the door and wait</strong> — Allow the unit 2–4 hours to cool down. The HI alarm should clear once the temperature drops below the threshold.</li>
<li><strong>Check ambient temperature</strong> — Monogram wine coolers are designed to operate in 55–90°F (13–32°C) ambient conditions.</li>
<li><strong>Monitor after clearing</strong> — If HI returns within hours, an underlying cooling fault is present.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If HI persists or recurs, the cooling system requires diagnosis. Call {$phone} for Monogram wine cooler service.</p>
HTML;

$content['wc-pf-power-failure-reset'] = <<<HTML
<h2>What Does Monogram Wine Cooler Error Code PF Mean?</h2>
<p>Error code <strong>PF</strong> on a Monogram wine cooler indicates a <strong>power failure reset</strong>. The unit lost power unexpectedly and is now informing you that it restarted. PF is an informational alert, not a component fault — the wine cooler will resume normal operation once you acknowledge and dismiss the code.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power outage</strong> — A home or building power interruption briefly cut power to the unit.</li>
<li><strong>Tripped circuit breaker</strong> — The circuit supplying the wine cooler tripped and was reset.</li>
<li><strong>Unplugged accidentally</strong> — The unit was disconnected from the outlet and reconnected.</li>
<li><strong>Voltage fluctuation</strong> — An unstable power supply caused the unit to cycle off and back on.</li>
</ul>
<h2>How to Clear PF</h2>
<ol>
<li><strong>Press any button</strong> — On most Monogram wine cooler models, pressing any keypad button will dismiss the PF alert and return to normal display.</li>
<li><strong>Check temperature</strong> — Verify the cabinet is cooling back to your set temperature after the power interruption.</li>
<li><strong>Monitor for recurrence</strong> — Frequent PF alerts without actual power outages may indicate an unstable power supply or a failing internal power board.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If PF appears repeatedly without power interruptions, call {$phone} for Monogram wine cooler diagnosis.</p>
HTML;

// ── RANGE HOOD ───────────────────────────────────────────────

$content['hood-e1-blower-motor-speed-fault'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code E1 Mean?</h2>
<p>Error code <strong>E1</strong> on a Monogram range hood indicates a <strong>blower motor speed fault</strong>. The control board monitors the blower motor's rotational speed via a feedback signal. E1 appears when the actual motor speed does not match the commanded speed — the motor is running too slowly, inconsistently, or not at all.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed blower motor</strong> — The motor has burned out or its bearings have worn, causing erratic or zero RPM feedback.</li>
<li><strong>Grease-clogged impeller</strong> — Heavy grease accumulation has caused the fan impeller to become unbalanced or restricted.</li>
<li><strong>Wiring fault</strong> — A loose or broken wire between the motor and the control board.</li>
<li><strong>Speed control board fault</strong> — The triac or speed controller on the board has failed.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the grease filters</strong> — Remove and wash all grease filters. A heavily loaded filter or grease-soaked impeller significantly restricts airflow and strains the motor.</li>
<li><strong>Hard reset</strong> — Switch the hood off at the circuit breaker for 60 seconds, then restore power.</li>
<li><strong>Test all speed settings</strong> — Run the hood at each speed setting and note which, if any, operate normally.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Blower motor replacement requires disassembly of the hood chassis. Call {$phone} for certified Monogram range hood repair.</p>
HTML;

$content['hood-e2-control-board-failure'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code E2 Mean?</h2>
<p>Error code <strong>E2</strong> on a Monogram range hood indicates a <strong>control board failure</strong>. The main printed circuit board that manages all hood functions — fan speed, lighting, timers, and smart home connectivity — has developed an internal fault and can no longer operate the hood normally.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Power surge damage</strong> — A voltage spike burned a component on the control board.</li>
<li><strong>Heat damage</strong> — Prolonged exposure to cooking heat has degraded board components over time.</li>
<li><strong>Grease contamination</strong> — Grease vapors have penetrated the board and caused a short circuit.</li>
<li><strong>Component failure</strong> — A relay, capacitor, or microcontroller on the board has failed with age.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> — Switch off the circuit breaker for 5 minutes, then restore power. A transient software fault may clear.</li>
<li><strong>Check for recurrence</strong> — If E2 returns immediately or within minutes, the board has a genuine hardware fault.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Control board replacement requires matching the exact OEM board for your hood model. Call {$phone} for expert Monogram range hood service.</p>
HTML;

$content['hood-e3-touch-panel-fault'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code E3 Mean?</h2>
<p>Error code <strong>E3</strong> on a Monogram range hood indicates a <strong>touch panel or keypad fault</strong>. The control board has detected that one or more touch zones on the panel are continuously activated (stuck), shorted, or are not responding. This prevents normal user input and safe operation.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Grease or moisture on the panel</strong> — Cooking residue bridging touch zones creates a phantom touch signal.</li>
<li><strong>Failed touch panel</strong> — The capacitive touch sensor layer has degraded or cracked.</li>
<li><strong>Wiring fault</strong> — The ribbon cable connecting the touch panel to the control board has become damaged.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Clean the control panel</strong> — Switch off power. Wipe the entire touch surface with a damp cloth, focusing on button seams. Dry completely before restoring power.</li>
<li><strong>Hard reset</strong> — After cleaning and drying, switch off the circuit breaker for 60 seconds and restore power.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If E3 persists after cleaning, the touch panel assembly requires replacement. Call {$phone} for Monogram range hood service.</p>
HTML;

$content['hood-e4-grease-filter-alert'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code E4 Mean?</h2>
<p>Error code <strong>E4</strong> on a Monogram range hood is a <strong>grease filter full alert</strong>. The hood's filter monitoring system — which tracks cumulative run hours — has determined that the grease filters have reached their recommended cleaning or replacement interval. This is a maintenance reminder, not a hardware failure.</p>
<h2>How to Clear E4</h2>
<ol>
<li><strong>Remove and clean the grease filters</strong> — Take out all mesh or baffle grease filters. Wash in hot soapy water or run through the dishwasher on a heavy cycle. Allow to dry fully before reinstalling.</li>
<li><strong>Reset the filter counter</strong> — After reinstalling clean filters, press and hold the designated filter reset button (check your model's use and care guide — typically labeled "Filter Reset" or held for 3 seconds on the fan or light button). The E4 indicator will clear.</li>
</ol>
<h2>Maintenance Schedule</h2>
<p>Monogram recommends cleaning range hood grease filters every 1–3 months depending on cooking frequency. Heavy use (daily high-heat cooking, wok cooking, frying) may require monthly cleaning. Clean filters maintain airflow efficiency, protect the blower motor, and prevent grease fires.</p>
<h2>When to Call a Professional</h2>
<p>If E4 does not clear after cleaning and resetting, or if the hood is showing reduced airflow, call {$phone} for Monogram range hood service.</p>
HTML;

$content['hood-e5-light-circuit-fault'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code E5 Mean?</h2>
<p>Error code <strong>E5</strong> on a Monogram range hood indicates an <strong>LED light circuit fault</strong>. The control board monitors the lighting circuit and has detected an open circuit, short circuit, or driver fault in the LED light assembly.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed LED module</strong> — One or more LED light modules have burned out or failed internally.</li>
<li><strong>Failed LED driver</strong> — The driver circuit on the control board that powers the LEDs has developed a fault.</li>
<li><strong>Wiring fault</strong> — A loose or broken wire in the lighting circuit.</li>
<li><strong>Thermal degradation</strong> — Prolonged heat exposure has shortened LED module lifespan.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> — Switch off the circuit breaker for 60 seconds and restore. Test the lights independently of the fan.</li>
<li><strong>Inspect visible light modules</strong> — On some models, LED modules are user-replaceable. Check if any modules are visibly damaged or discolored.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>LED driver replacement on the control board requires OEM parts and soldering in some cases. Call {$phone} for Monogram range hood lighting repair.</p>
HTML;

$content['hood-e6-fan-motor-overload'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code E6 Mean?</h2>
<p>Error code <strong>E6</strong> on a Monogram range hood indicates <strong>fan motor overload or thermal protection</strong>. The blower motor has drawn excessive current — typically due to a mechanical restriction, heavy grease buildup, or bearing wear — and its thermal protection circuit has tripped to prevent motor burnout.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Severely clogged grease filters</strong> — Blocked filters force the motor to work harder against resistance, drawing excessive current.</li>
<li><strong>Grease-seized impeller</strong> — Heavy grease accumulation on the fan wheel has thrown the impeller out of balance or seized it.</li>
<li><strong>Motor bearing wear</strong> — Worn bearings increase mechanical resistance, causing the motor to overheat.</li>
<li><strong>Blocked exhaust duct</strong> — A restricted or blocked exhaust duct creates back-pressure against the blower.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Switch off and allow to cool</strong> — Turn off the hood at the circuit breaker for at least 30 minutes to allow the thermal protector to reset.</li>
<li><strong>Clean all grease filters</strong> — Wash filters thoroughly before attempting to restart.</li>
<li><strong>Check the exhaust duct</strong> — Verify the duct path is clear and the exterior vent cap opens freely.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If E6 returns after cleaning and cooling, the motor or impeller requires inspection. Call {$phone} for Monogram range hood service.</p>
HTML;

$content['hood-e7-communication-error'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code E7 Mean?</h2>
<p>Error code <strong>E7</strong> on a Monogram range hood indicates a <strong>communication error between the main control board and the display module</strong>. These two boards exchange data continuously to coordinate user input with hood operation. E7 appears when this communication link is interrupted or corrupted.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Loose ribbon cable</strong> — The flat cable connecting the display to the main board has partially disconnected.</li>
<li><strong>Failed display board</strong> — The display/keypad module is not responding to the main board.</li>
<li><strong>Main board fault</strong> — The main board's communication circuit has failed.</li>
<li><strong>Grease contamination</strong> — Grease has entered the connector interface and disrupted the signal.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> — Switch off the circuit breaker for 5 minutes and restore power. A transient communication error may clear.</li>
<li><strong>Check for recurrence</strong> — Persistent E7 after reset indicates a physical fault in the wiring or a board.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Board and cable diagnosis requires hood disassembly. Call {$phone} for certified Monogram range hood repair.</p>
HTML;

$content['hood-f1-main-control-board-failure'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code F1 Mean?</h2>
<p>Error code <strong>F1</strong> on a Monogram range hood indicates a <strong>main control board failure</strong>. The primary PCB that controls all hood functions has detected an unrecoverable internal fault. Unlike E2 which may involve specific board sections, F1 indicates a broader failure of the main control logic.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>EEPROM or firmware corruption</strong> — A power surge or write error has corrupted the board's stored settings.</li>
<li><strong>Component failure</strong> — A microcontroller, relay, or power regulator on the board has failed.</li>
<li><strong>Thermal damage</strong> — Prolonged heat exposure has caused cumulative damage to board solder joints or components.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Hard reset</strong> — Switch off the circuit breaker for 10 minutes and restore power. A firmware hang may clear.</li>
<li><strong>If F1 persists</strong> — The board requires professional diagnosis and likely replacement.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Main control board replacement must use the exact OEM board for your Monogram hood model. Call {$phone} for expert Monogram range hood service.</p>
HTML;

$content['hood-f2-speed-control-module-fault'] = <<<HTML
<h2>What Does Monogram Range Hood Error Code F2 Mean?</h2>
<p>Error code <strong>F2</strong> on a Monogram range hood indicates a <strong>speed control module fault</strong>. The circuit that regulates blower motor speed — typically a triac or PWM controller — has developed a fault. The hood may operate at only one speed, fail to change speeds, or not run at all.</p>
<h2>Common Causes</h2>
<ul>
<li><strong>Failed triac or speed controller</strong> — The switching component that controls motor speed has failed open or shorted.</li>
<li><strong>Overheating</strong> — The speed control module has been damaged by excessive heat from cooking.</li>
<li><strong>Grease contamination</strong> — Grease on the control board has caused a short in the speed control circuit.</li>
</ul>
<h2>How to Troubleshoot</h2>
<ol>
<li><strong>Test all speed settings</strong> — Note whether any speed settings work. A triac that has failed open will result in no motor operation; one that has shorted may lock the motor at full speed.</li>
<li><strong>Hard reset</strong> — Switch off the circuit breaker for 5 minutes and retest.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Speed control module replacement requires component-level board repair or full board replacement. Call {$phone} for Monogram range hood repair.</p>
HTML;

$content['hood-loc-control-lock'] = <<<HTML
<h2>What Does Monogram Range Hood LOC Mean?</h2>
<p><strong>LOC</strong> displayed on a Monogram range hood indicates the <strong>control lock (child safety lock) is active</strong>. All touch panel buttons are disabled to prevent accidental changes to hood settings. This is not an error — it is a safety feature that has been enabled.</p>
<h2>How to Unlock the Hood</h2>
<ol>
<li><strong>Press and hold the Lock button</strong> — On most Monogram range hood models, press and hold the Lock key or the designated button combination for 3 seconds. The LOC indicator will turn off when the lock is deactivated.</li>
<li><strong>Check your model's procedure</strong> — Some models require holding the Power button or a specific button combination. Refer to your use and care guide for exact instructions.</li>
<li><strong>Power cycle if unresponsive</strong> — If the panel remains completely unresponsive, switch off the circuit breaker for 60 seconds and restore power. The control lock state resets on most models after a full power cycle.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>If LOC cannot be cleared after following all steps, the touch panel or control board may have a fault. Call {$phone} for Monogram range hood diagnosis.</p>
HTML;

$content['hood-cln-filter-cleaning-reminder'] = <<<HTML
<h2>What Does Monogram Range Hood CLN Mean?</h2>
<p><strong>CLN</strong> displayed on a Monogram range hood is a <strong>filter cleaning reminder</strong>. The hood has tracked cumulative operating hours and is notifying you that the grease filters are due for cleaning. CLN is a maintenance alert — not a hardware fault — and will not affect hood performance until filters become severely clogged.</p>
<h2>How to Clear CLN</h2>
<ol>
<li><strong>Remove the grease filters</strong> — Slide or lift out all mesh or baffle-style grease filters from the underside of the hood.</li>
<li><strong>Clean the filters</strong> — Wash in hot water with degreasing dish soap, or run through the dishwasher on a heavy-duty cycle. For heavy grease buildup, soak in hot water with baking soda for 15–30 minutes first.</li>
<li><strong>Reinstall the dry filters</strong> — Ensure filters are fully dry before reinserting to prevent steam and odor issues.</li>
<li><strong>Reset the reminder</strong> — Press and hold the Filter Reset or CLN button (varies by model — typically 3 seconds). The CLN indicator will turn off, resetting the hour counter to zero.</li>
</ol>
<h2>Maintenance Notes</h2>
<p>Monogram recommends cleaning grease filters every 1–3 months. Regular cleaning extends blower motor life, maintains proper airflow, and significantly reduces the risk of a grease fire. Call {$phone} if you need help with your Monogram range hood maintenance or if the CLN alert cannot be cleared.</p>
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
    error_log( "BRP v5 error codes: created={$created}, skipped={$skipped}" );
}
