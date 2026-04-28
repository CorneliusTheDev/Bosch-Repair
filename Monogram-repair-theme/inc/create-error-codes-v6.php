<?php
/**
 * Error Codes v6 — Replace all Monogram Dryer error codes
 * Deletes existing dryer codes and inserts E1–E7, F01–F07
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$phone = defined( 'BRP_PHONE' ) ? BRP_PHONE : '844-752-7887';

// ── 1. Delete all existing dryer error_code posts ─────────────────────────────
$existing = get_posts( array(
    'post_type'      => 'error_code',
    'post_status'    => 'any',
    'posts_per_page' => -1,
    'fields'         => 'ids',
    'tax_query'      => array(
        array(
            'taxonomy' => 'appliance_type',
            'field'    => 'slug',
            'terms'    => 'dryer',
        ),
    ),
) );
foreach ( $existing as $id ) {
    wp_delete_post( $id, true );
}

// ── 2. Define new dryer error codes ──────────────────────────────────────────
$dryer_codes = array(

    'monogram-dryer-error-code-e1' => array(
        'code'    => 'E1',
        'title'   => 'Monogram Dryer Error Code E1 – EEPROM Error',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code E1 Mean?</h2>
<p>Error code <strong>E1</strong> on a Monogram dryer indicates an <strong>EEPROM (Electrically Erasable Programmable Read-Only Memory) error</strong>. The control board has detected that it cannot read from or write to its internal EEPROM memory chip correctly. The EEPROM stores critical operational settings, calibration data, and cycle parameters — when it fails or becomes corrupted, the dryer cannot function reliably.</p>

<h3>Common Causes of E1</h3>
<ul>
<li>Improper or unstable power supply to the dryer (voltage spikes, brownouts)</li>
<li>Defective or corrupted control board EEPROM chip</li>
<li>Loose wiring harness connections to the main control board</li>
<li>Control board damaged by moisture or power surge</li>
</ul>

<h3>How to Troubleshoot E1</h3>
<ol>
<li><strong>Power reset:</strong> Unplug the dryer from the wall outlet for at least 60 seconds, then restore power. A temporary voltage irregularity can trigger E1 and a reset often clears it.</li>
<li><strong>Check the power supply:</strong> Ensure the dryer is on a dedicated 240V circuit. Avoid using extension cords or sharing the circuit with other high-draw appliances.</li>
<li><strong>Inspect wiring connections:</strong> With the dryer unplugged, check all wiring harness connectors at the control board for looseness, corrosion, or damage. Reseat any loose connectors firmly.</li>
<li><strong>Replace the control board:</strong> If E1 returns after a reset and the wiring is sound, the control board's EEPROM has likely failed and the board requires replacement with a genuine Monogram part.</li>
</ol>

<p>Control board replacement requires accessing the internal cabinet. Contact our Monogram dryer repair team at <strong>{$phone}</strong> for professional diagnosis and repair.</p>
HTML,
    ),

    'monogram-dryer-error-code-e2' => array(
        'code'    => 'E2',
        'title'   => 'Monogram Dryer Error Code E2 – Inlet Thermistor Short Circuit',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code E2 Mean?</h2>
<p>Error code <strong>E2</strong> on a Monogram dryer indicates a <strong>shorted inlet thermistor</strong>. The inlet thermistor measures the temperature of air entering the dryer drum. A shorted thermistor reads abnormally low resistance, causing the control board to receive a temperature signal that is implausibly high — triggering E2 as a safety fault to prevent overheating.</p>

<h3>Common Causes of E2</h3>
<ul>
<li>Faulty or failed inlet thermistor (internal short circuit)</li>
<li>Damaged wiring between the thermistor and control board (pinched or shorted wire)</li>
<li>Moisture or debris contaminating the thermistor connector</li>
<li>Defective control board misreading the thermistor signal</li>
</ul>

<h3>How to Troubleshoot E2</h3>
<ol>
<li><strong>Power reset:</strong> Unplug for 60 seconds and restart. If E2 clears and does not return, monitor the dryer for recurrence.</li>
<li><strong>Locate the inlet thermistor:</strong> The inlet thermistor is typically located near the air intake at the rear or front of the drum assembly.</li>
<li><strong>Inspect the wiring connector:</strong> With the dryer unplugged, check the thermistor connector for moisture, corrosion, or damage. Clean and reseat firmly.</li>
<li><strong>Test thermistor resistance:</strong> Using a multimeter, measure the thermistor's resistance at room temperature (approximately 68°F/20°C). A properly functioning NTC thermistor should read approximately 10,000–50,000 ohms. A near-zero reading confirms a short circuit and the thermistor must be replaced.</li>
<li><strong>Replace the inlet thermistor:</strong> Use only a genuine Monogram replacement thermistor rated for your specific model.</li>
</ol>

<p>Thermistor replacement requires partial disassembly of the dryer. Call our Monogram dryer repair team at <strong>{$phone}</strong> for professional service.</p>
HTML,
    ),

    'monogram-dryer-error-code-e3' => array(
        'code'    => 'E3',
        'title'   => 'Monogram Dryer Error Code E3 – Outlet Thermistor Short Circuit',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code E3 Mean?</h2>
<p>Error code <strong>E3</strong> on a Monogram dryer indicates a <strong>shorted outlet thermistor</strong>. The outlet thermistor monitors the temperature of exhaust air leaving the drum. When it short-circuits, it reads near-zero resistance, sending an artificially high temperature signal to the control board — triggering E3 to prevent the dryer from operating unsafely.</p>

<h3>Common Causes of E3</h3>
<ul>
<li>Failed outlet thermistor with internal short circuit</li>
<li>Wiring harness short between the thermistor leads</li>
<li>Thermistor connector corroded or moisture-contaminated</li>
<li>Defective control board</li>
</ul>

<h3>How to Troubleshoot E3</h3>
<ol>
<li><strong>Power reset:</strong> Unplug the dryer for 60 seconds and restart to clear any transient fault.</li>
<li><strong>Locate the outlet thermistor:</strong> The outlet thermistor is mounted on the exhaust duct near the blower or lint screen housing.</li>
<li><strong>Inspect wiring and connector:</strong> With power off, check for pinched wires, bare wire contacts, or a corroded connector at the thermistor. Reseat the connector firmly.</li>
<li><strong>Test thermistor resistance:</strong> Disconnect the thermistor and measure resistance with a multimeter. A reading near 0 ohms confirms a short circuit — the thermistor must be replaced.</li>
<li><strong>Replace the outlet thermistor:</strong> Install a genuine Monogram replacement part. Aftermarket thermistors may not meet the calibration tolerances required for accurate temperature management.</li>
</ol>

<p>If E3 persists after thermistor replacement, the control board may require testing. Call <strong>{$phone}</strong> for expert Monogram dryer diagnosis.</p>
HTML,
    ),

    'monogram-dryer-error-code-e4' => array(
        'code'    => 'E4',
        'title'   => 'Monogram Dryer Error Code E4 – Inlet Thermistor Open Circuit',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code E4 Mean?</h2>
<p>Error code <strong>E4</strong> on a Monogram dryer indicates an <strong>open circuit in the inlet thermistor</strong>. Unlike E2 (which is a short circuit), an open-circuit thermistor reads infinite resistance — meaning the electrical path through the sensor is broken. The control board cannot receive any temperature data from the inlet, triggering E4 and halting the cycle.</p>

<h3>Common Causes of E4</h3>
<ul>
<li>Failed inlet thermistor (open internal element)</li>
<li>Broken wire or disconnected connector in the thermistor circuit</li>
<li>Corroded or burned terminal pins on the connector</li>
<li>Control board wiring harness damage</li>
</ul>

<h3>How to Troubleshoot E4</h3>
<ol>
<li><strong>Power reset:</strong> Unplug for 60 seconds and restart. Reconnect power and check if E4 clears.</li>
<li><strong>Check the thermistor connector:</strong> With the dryer unplugged, trace the wiring from the inlet thermistor to the control board. Look for a disconnected plug, broken wire, or burned terminal.</li>
<li><strong>Test the thermistor:</strong> Disconnect the thermistor and test with a multimeter. No continuity (OL/infinite resistance) at any temperature confirms an open circuit — replace the thermistor.</li>
<li><strong>Inspect the wiring harness:</strong> If the thermistor tests correctly in isolation, the fault is in the wiring. Repair or replace the damaged section of the harness.</li>
</ol>

<p>If you are unsure how to test components safely, call our Monogram dryer repair team at <strong>{$phone}</strong>.</p>
HTML,
    ),

    'monogram-dryer-error-code-e5' => array(
        'code'    => 'E5',
        'title'   => 'Monogram Dryer Error Code E5 – Outlet Thermistor Open Circuit',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code E5 Mean?</h2>
<p>Error code <strong>E5</strong> on a Monogram dryer indicates an <strong>open circuit in the outlet thermistor</strong>. The outlet thermistor monitors exhaust air temperature and is critical for determining when laundry is dry and preventing overheating. An open-circuit outlet thermistor sends no signal to the control board — causing E5 and stopping the drying cycle as a safety precaution.</p>

<h3>Common Causes of E5</h3>
<ul>
<li>Failed outlet thermistor element (open circuit internally)</li>
<li>Disconnected or broken wiring to the outlet thermistor</li>
<li>Corroded connector pins</li>
<li>Damaged control board input circuit</li>
</ul>

<h3>How to Troubleshoot E5</h3>
<ol>
<li><strong>Power reset:</strong> Unplug for 60 seconds. Reconnect and check whether E5 clears on restart.</li>
<li><strong>Locate the outlet thermistor:</strong> It is typically mounted on the exhaust duct at the drum outlet, near the blower wheel housing or lint duct.</li>
<li><strong>Inspect wiring and connector:</strong> Trace the wiring from the thermistor to the board. Look for a broken wire, unplugged connector, or burned pins. Reseat any loose connections.</li>
<li><strong>Measure thermistor resistance:</strong> Disconnect the thermistor and test with a multimeter. Infinite resistance at room temperature confirms the thermistor is open and must be replaced.</li>
<li><strong>Replace with OEM part:</strong> Use a genuine Monogram outlet thermistor. Ensure the connector engages fully and the thermistor is secured in its mounting bracket.</li>
</ol>

<p>For professional Monogram dryer repair, call our team at <strong>{$phone}</strong> — we carry genuine thermistor assemblies for all Monogram dryer models.</p>
HTML,
    ),

    'monogram-dryer-error-code-e6' => array(
        'code'    => 'E6',
        'title'   => 'Monogram Dryer Error Code E6 – User Interface Mismatch (EEPROM)',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code E6 Mean?</h2>
<p>Error code <strong>E6</strong> on a Monogram dryer indicates a <strong>user interface configuration mismatch</strong>. The EEPROM on the main control board has a stored value for the expected user interface (control panel) type, and the connected control panel does not match that stored value. This error most commonly occurs after a control board or user interface board has been replaced with a component that has not been correctly configured for the specific dryer model.</p>

<h3>Common Causes of E6</h3>
<ul>
<li>Control board replaced with a non-configured or incorrectly configured board</li>
<li>User interface (control panel) replaced with an incompatible part</li>
<li>EEPROM data corrupted — stored UI type no longer matches the installed panel</li>
<li>Loose or intermittent communication wiring between control board and UI panel</li>
</ul>

<h3>How to Troubleshoot E6</h3>
<ol>
<li><strong>Power reset:</strong> Unplug for 60 seconds and restart. If this follows a parts replacement, proceed to the next steps.</li>
<li><strong>Verify parts compatibility:</strong> Confirm that both the control board and user interface board are correct for your specific Monogram dryer model number. Even boards that appear physically identical may have different firmware or EEPROM configurations.</li>
<li><strong>Check the communication harness:</strong> Inspect the wiring between the control board and UI panel for loose connectors or damaged wires. Reseat all connectors with the dryer unplugged.</li>
<li><strong>Reconfigure or replace the control board:</strong> If the board is new and E6 persists, the EEPROM may need to be programmed to match the installed UI — a process that typically requires a service technician with programming tools.</li>
</ol>

<p>E6 after a board replacement requires factory-level configuration. Call our Monogram dryer repair team at <strong>{$phone}</strong> for professional diagnosis and board programming.</p>
HTML,
    ),

    'monogram-dryer-error-code-e7' => array(
        'code'    => 'E7',
        'title'   => 'Monogram Dryer Error Code E7 – Stuck Control Panel Button',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code E7 Mean?</h2>
<p>Error code <strong>E7</strong> on a Monogram dryer indicates that a <strong>control panel button is stuck or continuously activated</strong>. The control board monitors all panel inputs and if any button appears to be held down for an abnormally extended period, E7 is triggered as a safety fault — preventing the button from launching or modifying an unintended cycle.</p>

<h3>Common Causes of E7</h3>
<ul>
<li>Residue, moisture, or debris beneath a button causing it to stick physically</li>
<li>Worn or damaged button switch that no longer releases properly</li>
<li>Control panel membrane or touchpad failure</li>
<li>Electronic switch failure on the user interface board</li>
</ul>

<h3>How to Troubleshoot E7</h3>
<ol>
<li><strong>Power reset:</strong> Unplug the dryer for 60 seconds. Reconnect and check if E7 clears. A stuck button may release on its own.</li>
<li><strong>Inspect all buttons:</strong> Press each button on the control panel individually. Listen and feel for any button that does not click or spring back normally.</li>
<li><strong>Clean around the control panel:</strong> With the dryer unplugged, use a slightly damp cloth to clean the edges of the control panel where buttons meet the panel surface. Dry thoroughly before restoring power.</li>
<li><strong>Check for damage:</strong> Look for cracked or warped buttons, swollen panel overlays, or signs of liquid intrusion that may have caused a button to short permanently.</li>
<li><strong>Replace the user interface board:</strong> If a specific button is electronically stuck, the UI board or panel membrane requires replacement with a genuine Monogram component.</li>
</ol>

<p>If E7 persists after cleaning, the control panel assembly needs professional service. Call our team at <strong>{$phone}</strong> for Monogram dryer control panel replacement.</p>
HTML,
    ),

    'monogram-dryer-error-code-f01' => array(
        'code'    => 'F01',
        'title'   => 'Monogram Dryer Error Code F01 – Inlet Temperature Sensor Short Circuit',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code F01 Mean?</h2>
<p>Error code <strong>F01</strong> on a Monogram dryer indicates that the <strong>inlet temperature sensor is reporting a short circuit</strong>. This is the F-series equivalent of the E2 fault — the sensor monitoring incoming air temperature is shorted, causing it to report an unrealistically high temperature to the control board. The dryer halts the cycle to prevent potential overheating damage.</p>

<h3>Common Causes of F01</h3>
<ul>
<li>Defective inlet temperature sensor with internal short</li>
<li>Pinched or shorted wiring in the sensor circuit</li>
<li>Moisture ingress into the sensor connector</li>
<li>Control board input channel failure</li>
</ul>

<h3>How to Troubleshoot F01</h3>
<ol>
<li><strong>Power reset:</strong> Disconnect power for 60 seconds and restart. If F01 clears, run a short cycle and monitor for recurrence.</li>
<li><strong>Locate the inlet sensor:</strong> The inlet temperature sensor is positioned at the air entry point into the drum — typically behind the front panel or near the rear duct inlet depending on the model.</li>
<li><strong>Test sensor resistance:</strong> With the dryer unplugged, disconnect the sensor and use a multimeter to measure resistance. A near-zero reading (short circuit) confirms a faulty sensor that must be replaced.</li>
<li><strong>Inspect the wiring harness:</strong> Check for any points where the wiring may be pinched against the cabinet, drum, or motor assembly — these contact points can cause intermittent shorts.</li>
<li><strong>Replace the sensor:</strong> Use only a genuine Monogram inlet temperature sensor for your specific model to ensure correct calibration.</li>
</ol>

<p>For professional Monogram dryer diagnosis and sensor replacement, call our team at <strong>{$phone}</strong>.</p>
HTML,
    ),

    'monogram-dryer-error-code-f02' => array(
        'code'    => 'F02',
        'title'   => 'Monogram Dryer Error Code F02 – Outlet Temperature Sensor Short Circuit',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code F02 Mean?</h2>
<p>Error code <strong>F02</strong> on a Monogram dryer indicates that the <strong>outlet temperature sensor is reporting a short circuit</strong>. The outlet sensor monitors exhaust air temperature — the primary signal the dryer uses to determine moisture content and cycle completion. A shorted sensor sends a falsely high temperature reading, causing the control board to trigger F02 and stop the dryer.</p>

<h3>Common Causes of F02</h3>
<ul>
<li>Failed outlet temperature sensor (internal short)</li>
<li>Wiring short between sensor leads or at the connector</li>
<li>Moisture or lint contamination on the connector contacts</li>
<li>Defective control board sensor input</li>
</ul>

<h3>How to Troubleshoot F02</h3>
<ol>
<li><strong>Power reset:</strong> Unplug for 60 seconds and restart. Monitor whether F02 returns during the next cycle.</li>
<li><strong>Locate the outlet sensor:</strong> This sensor is mounted on the exhaust duct at the drum outlet — often near the blower wheel housing or lint screen duct assembly.</li>
<li><strong>Clean the connector:</strong> With the dryer unplugged, remove the connector and inspect the terminals for lint accumulation or moisture. Clean with electrical contact cleaner and allow to dry completely.</li>
<li><strong>Test sensor resistance:</strong> Measure resistance with a multimeter. A reading near 0 ohms confirms a short — replace the outlet temperature sensor.</li>
<li><strong>Replace with OEM part:</strong> Non-OEM sensors may have incorrect resistance curves, leading to inaccurate temperature management even after the fault code clears.</li>
</ol>

<p>Call our Monogram dryer service team at <strong>{$phone}</strong> for fast, accurate sensor diagnosis and replacement.</p>
HTML,
    ),

    'monogram-dryer-error-code-f03' => array(
        'code'    => 'F03',
        'title'   => 'Monogram Dryer Error Code F03 – Inlet Temperature Sensor Open Circuit',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code F03 Mean?</h2>
<p>Error code <strong>F03</strong> on a Monogram dryer indicates an <strong>open circuit in the inlet temperature sensor</strong>. An open-circuit sensor has infinite resistance — no electrical signal passes through it. The control board receives no temperature data from the inlet and triggers F03 to halt operation safely.</p>

<h3>Common Causes of F03</h3>
<ul>
<li>Failed inlet temperature sensor (broken internal element)</li>
<li>Disconnected wiring connector at the sensor or control board</li>
<li>Broken wire in the sensor circuit</li>
<li>Corroded or burned terminal pins</li>
</ul>

<h3>How to Troubleshoot F03</h3>
<ol>
<li><strong>Power reset:</strong> Unplug for 60 seconds and restart.</li>
<li><strong>Check connector seating:</strong> With the dryer unplugged, locate the inlet temperature sensor and firmly push in the wiring connector. A partially disconnected connector is a common cause of open-circuit faults.</li>
<li><strong>Trace the wiring:</strong> Follow the wire from the sensor to the control board. Look for a broken wire, especially at any point where the wire passes through a panel opening or near moving components.</li>
<li><strong>Test sensor with multimeter:</strong> Disconnect the sensor and measure resistance. Infinite resistance (OL on multimeter display) at room temperature confirms an open circuit — replace the sensor.</li>
<li><strong>Replace the sensor:</strong> Install a factory-certified Monogram inlet temperature sensor and ensure the connector is fully engaged.</li>
</ol>

<p>Need help diagnosing F03? Call our Monogram dryer repair specialists at <strong>{$phone}</strong> — we carry genuine temperature sensors for all Monogram dryer models.</p>
HTML,
    ),

    'monogram-dryer-error-code-f04' => array(
        'code'    => 'F04',
        'title'   => 'Monogram Dryer Error Code F04 – Outlet Temperature Sensor Open Circuit',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code F04 Mean?</h2>
<p>Error code <strong>F04</strong> on a Monogram dryer indicates an <strong>open circuit in the outlet temperature sensor</strong>. The outlet sensor provides continuous feedback to the control board about exhaust air temperature — the key variable in moisture-sensing and cycle-completion logic. When this sensor circuit is broken, the dryer cannot manage the drying cycle and triggers F04 to prevent damage or unsafe operation.</p>

<h3>Common Causes of F04</h3>
<ul>
<li>Failed outlet temperature sensor with open internal element</li>
<li>Disconnected connector at the sensor location</li>
<li>Broken wiring between the sensor and control board</li>
<li>Damaged terminal pins in the connector</li>
</ul>

<h3>How to Troubleshoot F04</h3>
<ol>
<li><strong>Power reset:</strong> Unplug the dryer for 60 seconds and restart to rule out a transient fault.</li>
<li><strong>Locate the outlet sensor:</strong> This sensor is in the exhaust path, near the blower or lint duct at the rear of the drum assembly.</li>
<li><strong>Inspect the connector:</strong> With the dryer unplugged, push the connector firmly onto the sensor. Check for damaged, bent, or corroded terminal pins — these are a common source of intermittent open-circuit faults.</li>
<li><strong>Test the sensor:</strong> Disconnect and test resistance with a multimeter. An OL (open) reading confirms the sensor must be replaced.</li>
<li><strong>Check the full wiring path:</strong> If the sensor itself tests good, the fault is in the wiring harness between the sensor and the control board. Repair or replace the damaged section.</li>
</ol>

<p>Call our Monogram dryer service team at <strong>{$phone}</strong> for professional F04 diagnosis and repair.</p>
HTML,
    ),

    'monogram-dryer-error-code-f05' => array(
        'code'    => 'F05',
        'title'   => 'Monogram Dryer Error Code F05 – Control Board EEPROM Error',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code F05 Mean?</h2>
<p>Error code <strong>F05</strong> on a Monogram dryer indicates an <strong>error with the electronic control board's EEPROM (memory)</strong>. The control board has failed to read or write data to its onboard EEPROM memory chip correctly. This memory stores cycle settings, calibration data, and operating parameters — without reliable EEPROM function, the control board cannot operate the dryer correctly.</p>

<h3>Common Causes of F05</h3>
<ul>
<li>Defective control board with a failed EEPROM chip</li>
<li>Power surge or voltage spike that corrupted the EEPROM data</li>
<li>Prolonged power supply instability (brownouts, frequent outages)</li>
<li>Manufacturing defect in the control board</li>
</ul>

<h3>How to Troubleshoot F05</h3>
<ol>
<li><strong>Power reset:</strong> Unplug the dryer completely from the wall outlet for at least 5 minutes. This is longer than a standard reset because EEPROM initialization takes time. Restore power and check if F05 clears.</li>
<li><strong>Check the power supply:</strong> Verify the dryer is connected to a properly grounded, dedicated 240V circuit. Use a voltage meter to confirm both legs of the supply are providing correct voltage.</li>
<li><strong>Consider a surge protector:</strong> If your home has frequent voltage spikes, using a line conditioner or surge protection device for the dryer circuit can prevent future EEPROM corruption.</li>
<li><strong>Replace the control board:</strong> If F05 returns consistently, the control board requires replacement. Use only a genuine Monogram control board for your specific dryer model number.</li>
</ol>

<p>Control board replacement is not a DIY repair — it requires correct part identification and proper installation procedure. Call our Monogram dryer repair team at <strong>{$phone}</strong> for professional F05 resolution.</p>
HTML,
    ),

    'monogram-dryer-error-code-f06' => array(
        'code'    => 'F06',
        'title'   => 'Monogram Dryer Error Code F06 – Stuck Button Detected',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code F06 Mean?</h2>
<p>Error code <strong>F06</strong> on a Monogram dryer indicates that the dryer has <strong>detected a button on the control panel that appears to be continuously pressed or stuck</strong>. The control board continuously monitors all panel inputs — when any button remains in the activated state for longer than the expected maximum press duration, F06 is triggered to prevent an unintended cycle from being launched or modified.</p>

<h3>Common Causes of F06</h3>
<ul>
<li>Physical debris, spilled liquid, or residue beneath a button causing mechanical sticking</li>
<li>Worn or deformed button that no longer springs back after being pressed</li>
<li>Damaged membrane switch on the user interface board</li>
<li>Electronic failure in the button switch circuit</li>
</ul>

<h3>How to Troubleshoot F06</h3>
<ol>
<li><strong>Power reset:</strong> Unplug the dryer for 60 seconds. When you restore power, press each control panel button in sequence to identify any that feel stuck, stiff, or unresponsive.</li>
<li><strong>Clean the control panel surface:</strong> With the dryer unplugged, dampen a cloth with a mild cleaner and clean around all buttons. Pay particular attention to button edges where residue accumulates. Dry thoroughly before reconnecting.</li>
<li><strong>Inspect for physical damage:</strong> Look for cracked, warped, or sunken buttons. Buttons that have been pressed forcefully for years can lose their tactile feedback and fail to release.</li>
<li><strong>Identify the stuck button:</strong> If F06 reappears immediately after a reset, try pressing each button one at a time while observing the display. The fault code typically reappears when the stuck button is activated.</li>
<li><strong>Replace the user interface panel:</strong> If cleaning does not resolve the issue, the panel membrane or UI board has failed and requires replacement with a genuine Monogram part.</li>
</ol>

<p>Call our Monogram dryer repair specialists at <strong>{$phone}</strong> for control panel diagnosis and replacement.</p>
HTML,
    ),

    'monogram-dryer-error-code-f07' => array(
        'code'    => 'F07',
        'title'   => 'Monogram Dryer Error Code F07 – Voltage Error',
        'content' => <<<HTML
<h2>What Does Monogram Dryer Error Code F07 Mean?</h2>
<p>Error code <strong>F07</strong> on a Monogram dryer indicates a <strong>voltage error detected by the dryer's internal diagnostic system</strong>. The control board monitors incoming supply voltage and internal circuit voltages continuously. When a reading falls outside the expected operating range — either too high or too low — F07 is triggered and the dryer halts to protect its components from voltage-related damage.</p>

<h3>Common Causes of F07</h3>
<ul>
<li>Fluctuating household power supply (brownouts, voltage surges)</li>
<li>One leg of the 240V supply missing or significantly reduced (tripped breaker)</li>
<li>Loose or corroded wiring at the dryer's terminal block</li>
<li>Faulty power cord with a damaged conductor</li>
<li>Internal control board power regulation failure</li>
</ul>

<h3>How to Troubleshoot F07</h3>
<ol>
<li><strong>Check the circuit breaker:</strong> Electric dryers use two breaker poles for 240V supply. Check the breaker panel — if one pole is tripped, reset it. A dryer running on 120V (one tripped leg) will have no heat and may display voltage errors.</li>
<li><strong>Power reset:</strong> Unplug the dryer for 60 seconds. If F07 was caused by a momentary voltage spike (e.g., from a storm or appliance startup surge on the same circuit), it should clear after the reset.</li>
<li><strong>Inspect the terminal block:</strong> With the dryer unplugged, open the rear access panel and inspect the terminal block where the power cord connects. Look for loose screws, burned terminals, or corrosion. Tighten any loose connections.</li>
<li><strong>Test supply voltage:</strong> Using a multimeter at the outlet, verify both hot legs of the 240V supply are delivering approximately 120V each relative to neutral (240V leg-to-leg). Low voltage indicates a utility or wiring problem.</li>
<li><strong>Inspect the power cord:</strong> A damaged 4-wire power cord with a broken conductor can cause voltage errors. Inspect the cord for damage and replace if necessary.</li>
<li><strong>Control board evaluation:</strong> If supply voltage tests correct and F07 persists, the control board's voltage-sensing circuit may have failed — requiring board replacement.</li>
</ol>

<p><strong>Do not ignore F07</strong> — operating a dryer with a voltage fault can cause premature component failure and creates a risk of electrical damage. Call our Monogram dryer repair team at <strong>{$phone}</strong> for safe, professional F07 diagnosis.</p>
HTML,
    ),

);

// ── 3. Insert new dryer error_code posts ─────────────────────────────────────
$term = get_term_by( 'slug', 'dryer', 'appliance_type' );
if ( ! $term ) {
    $inserted = wp_insert_term( 'Dryer', 'appliance_type', array( 'slug' => 'dryer' ) );
    $term_id  = is_wp_error( $inserted ) ? 0 : $inserted['term_id'];
} else {
    $term_id = $term->term_id;
}

foreach ( $dryer_codes as $slug => $data ) {
    // Skip if already exists
    if ( get_page_by_path( $slug, OBJECT, 'error_code' ) ) continue;

    $post_id = wp_insert_post( array(
        'post_type'    => 'error_code',
        'post_status'  => 'publish',
        'post_title'   => $data['title'],
        'post_name'    => $slug,
        'post_content' => str_replace( '{$phone}', $phone, $data['content'] ),
    ) );

    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_brp_error_code', $data['code'] );
        update_post_meta( $post_id, '_brp_appliance_type', 'dryer' );
        if ( $term_id ) {
            wp_set_post_terms( $post_id, array( $term_id ), 'appliance_type' );
        }
    }
}
