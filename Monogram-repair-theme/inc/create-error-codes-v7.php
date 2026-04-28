<?php
/**
 * Error Codes v7 — Add Monogram Dishwasher F-series codes (F2–F147)
 * F1 already exists; this file adds all remaining documented F codes.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$phone = defined( 'BRP_PHONE' ) ? BRP_PHONE : '844-752-7887';

$dishwasher_f_codes = array(

    'monogram-dishwasher-error-code-f2' => array(
        'code'    => 'F2',
        'title'   => 'Monogram Dishwasher Error Code F2 – Communication Failure',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F2 Mean?</h2>
<p>Error code <strong>F2</strong> on a Monogram dishwasher indicates a <strong>communication failure between the display board and the main control board</strong>. The two boards communicate continuously via a data line — when the main board cannot send signals to the display board (or the display board fails to receive them) for more than 20 seconds, F2 is triggered and the dishwasher halts.</p>

<h3>Common Causes of F2</h3>
<ul>
<li>Faulty or damaged display board (user interface board)</li>
<li>Defective main PCB (printed circuit board)</li>
<li>Loose, disconnected, or damaged communication wiring harness between boards</li>
<li>Moisture or corrosion on connector pins causing intermittent signal loss</li>
<li>Power surge that disrupted board communication firmware</li>
</ul>

<h3>How to Troubleshoot F2</h3>
<ol>
<li><strong>Power reset:</strong> Turn off the dishwasher at the circuit breaker for 60 seconds, then restore power. A temporary communication glitch caused by a power fluctuation will often clear with a full reset.</li>
<li><strong>Inspect the wiring harness:</strong> With the dishwasher unplugged, open the door and inspect the wire harness running between the door panel (display board) and the main control board in the base. Look for kinked, pinched, or partially disconnected connectors.</li>
<li><strong>Reseat all connectors:</strong> Disconnect and firmly reconnect every connector on both the display board and main board. Corroded pins can be cleaned carefully with electrical contact cleaner.</li>
<li><strong>Test with a replacement display board:</strong> If the wiring is intact, the display board is more commonly at fault than the main board and is typically less expensive to replace first.</li>
<li><strong>Replace the main control board:</strong> If a new display board does not resolve F2, the main PCB requires replacement with a genuine Monogram component.</li>
</ol>

<p>Board replacement requires careful identification of the correct part number for your specific Monogram dishwasher model. Call our repair team at <strong>{$phone}</strong> for professional F2 diagnosis.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f3' => array(
        'code'    => 'F3',
        'title'   => 'Monogram Dishwasher Error Code F3 – Touchpad Shorted',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F3 Mean?</h2>
<p>Error code <strong>F3</strong> on a Monogram dishwasher indicates that the <strong>touchpad (key panel) has a shorted key or button</strong>. The control board has detected a continuous activation signal from the touchpad that exceeds what is possible from a normal button press — indicating one or more switches on the touchpad are internally shorted and permanently activated.</p>

<h3>Common Causes of F3</h3>
<ul>
<li>Moisture or liquid ingress beneath the touchpad membrane causing a short</li>
<li>Worn or damaged touchpad membrane with a failed key switch</li>
<li>Physical damage to the control panel surface</li>
<li>Damaged ribbon cable connecting the touchpad to the display board</li>
</ul>

<h3>How to Troubleshoot F3</h3>
<ol>
<li><strong>Power reset:</strong> Switch off the circuit breaker for 60 seconds. If a button was temporarily stuck due to moisture, the reset may clear F3.</li>
<li><strong>Inspect the control panel:</strong> Look for signs of moisture intrusion, bubbling, or deformation of the panel surface — these indicate the membrane seal has failed and liquid has reached the key switches.</li>
<li><strong>Check the ribbon cable:</strong> With power disconnected, carefully inspect the ribbon cable from the touchpad to the display board for any tears, kinks, or connector damage.</li>
<li><strong>Replace the touchpad assembly:</strong> F3 typically requires replacement of the touchpad/key panel. On most Monogram integrated dishwashers, the touchpad is integrated with the door panel assembly — use only a genuine Monogram replacement part for your specific model.</li>
</ol>

<p>Touchpad replacement on a fully integrated Monogram dishwasher requires careful disassembly of the door panel. Call our team at <strong>{$phone}</strong> for professional F3 repair.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f4' => array(
        'code'    => 'F4',
        'title'   => 'Monogram Dishwasher Error Code F4 – Humidity Sensor Fault',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F4 Mean?</h2>
<p>Error code <strong>F4</strong> on a Monogram dishwasher indicates a <strong>humidity sensor fault — either open circuit or short circuit</strong>. The humidity sensor monitors moisture levels inside the dishwasher tub and is used by the control board to manage the drying cycle and detect when dishes are dry. An F4 fault means the sensor is providing a reading outside its valid range, preventing accurate drying control.</p>

<h3>Common Causes of F4</h3>
<ul>
<li>Failed humidity sensor (open or shorted internally)</li>
<li>Sensor connector loose, corroded, or damaged</li>
<li>Wiring fault between the sensor and main control board</li>
<li>Excessive mineral deposit buildup on the sensor element</li>
</ul>

<h3>How to Troubleshoot F4</h3>
<ol>
<li><strong>Power reset:</strong> Turn off at the breaker for 60 seconds and restart. Check whether F4 clears.</li>
<li><strong>Locate the humidity sensor:</strong> On Monogram dishwashers, the humidity sensor is typically mounted in the upper area of the tub or on the door liner. Consult your model's service diagram for the exact location.</li>
<li><strong>Inspect and clean the sensor:</strong> Mineral deposits from hard water can coat the sensor element and affect its readings. With the dishwasher unplugged, clean the sensor with a soft cloth dampened with white vinegar. Allow to dry fully before testing.</li>
<li><strong>Check the connector:</strong> Inspect the sensor wiring connector for corrosion or looseness. Reseat firmly.</li>
<li><strong>Replace the humidity sensor:</strong> If cleaning does not resolve F4, the sensor requires replacement. Use a genuine Monogram humidity sensor for your specific model number.</li>
</ol>

<p>For professional humidity sensor diagnosis and replacement, call our Monogram dishwasher repair team at <strong>{$phone}</strong>.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f5' => array(
        'code'    => 'F5',
        'title'   => 'Monogram Dishwasher Error Code F5 – Humidity Sensor or Inverter Personality Error',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F5 Mean?</h2>
<p>Error code <strong>F5</strong> on a Monogram dishwasher can indicate one of two faults depending on the model: a <strong>humidity sensor open or short circuit</strong> (similar to F4 but representing a different threshold or sensor circuit), or an <strong>inverter motor controller personality mismatch</strong> — where the inverter drive board has detected that it has been installed in a unit configuration it was not programmed for.</p>

<h3>Common Causes of F5</h3>
<ul>
<li>Humidity sensor failure (open or shorted element)</li>
<li>Inverter board replaced with an incorrectly configured or incompatible part</li>
<li>Wiring fault in the humidity sensor circuit</li>
<li>Main control board communication issue with the inverter</li>
</ul>

<h3>How to Troubleshoot F5</h3>
<ol>
<li><strong>Power reset:</strong> Disconnect power at the circuit breaker for 60 seconds and restart. Document whether F5 appears immediately or only after a cycle begins.</li>
<li><strong>If F5 appears during a cycle (humidity-related):</strong> Follow the same humidity sensor inspection and replacement steps as for F4. Inspect the sensor connector and test sensor continuity.</li>
<li><strong>If F5 follows a recent inverter or board replacement:</strong> Verify that the replacement inverter board is the correct part number for your specific Monogram dishwasher model. Personality mismatches require either the correct board to be installed or the board to be reprogrammed by a factory-trained technician.</li>
<li><strong>Check all wiring harness connections:</strong> Inspect connections between the main board and inverter board for loose or damaged connectors.</li>
</ol>

<p>Inverter personality configuration requires factory-level diagnostic tools. Call our Monogram dishwasher service team at <strong>{$phone}</strong> for accurate F5 diagnosis.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f6' => array(
        'code'    => 'F6',
        'title'   => 'Monogram Dishwasher Error Code F6 – Temperature Probe Short or Wireless Communication Lost',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F6 Mean?</h2>
<p>Error code <strong>F6</strong> on a Monogram dishwasher indicates either a <strong>shorted temperature probe</strong> or a <strong>loss of communication with the wireless connectivity module</strong> (on Wi-Fi enabled models). A shorted temperature probe sends an unrealistically high temperature reading to the control board, preventing safe operation of the wash and drying cycles. On connected models, F6 may also appear when the Wi-Fi module loses contact with the main board.</p>

<h3>Common Causes of F6</h3>
<ul>
<li>Failed wash water temperature probe (internal short circuit)</li>
<li>Wiring short in the temperature probe circuit</li>
<li>Wi-Fi/wireless module failure or communication interruption (connected models)</li>
<li>Loose or corroded connector at the temperature probe or wireless module</li>
</ul>

<h3>How to Troubleshoot F6</h3>
<ol>
<li><strong>Power reset:</strong> Turn off at the circuit breaker for 60 seconds. This will reset the wireless module as well as clearing transient probe faults.</li>
<li><strong>Identify the fault type:</strong> If F6 appears at the start of any cycle regardless of Wi-Fi status, the temperature probe is likely the cause. If F6 only appears after a period of normal operation, the wireless module may be overheating or losing signal.</li>
<li><strong>Test the temperature probe:</strong> With the dishwasher unplugged, locate the temperature probe (typically in the sump area at the base of the tub). Disconnect and measure resistance with a multimeter. A near-zero reading confirms a short — replace the probe.</li>
<li><strong>Check the wireless module:</strong> Ensure the Wi-Fi module wiring harness is secure. If the module itself has failed, it can be replaced independently of the main board on most Monogram models.</li>
<li><strong>Replace as needed:</strong> Use genuine Monogram temperature probe or wireless module components for your specific model.</li>
</ol>

<p>Call our Monogram dishwasher repair specialists at <strong>{$phone}</strong> for professional F6 diagnosis — we carry genuine temperature probes for all Monogram dishwasher models.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f7' => array(
        'code'    => 'F7',
        'title'   => 'Monogram Dishwasher Error Code F7 – Control Panel or Keypad Error',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F7 Mean?</h2>
<p>Error code <strong>F7</strong> on a Monogram dishwasher indicates a <strong>control panel or keypad fault</strong>. This code is triggered when the control board detects an abnormal signal from the user interface panel — which can include stuck buttons, an unresponsive keypad, or an electrical fault in the panel's circuit board. F7 overlaps in behavior with F3 on some models but is typically associated with broader panel communication issues rather than a single shorted key.</p>

<h3>Common Causes of F7</h3>
<ul>
<li>One or more buttons stuck in a permanently pressed state</li>
<li>Damaged or worn membrane keypad</li>
<li>Liquid or moisture intrusion into the control panel</li>
<li>Damaged ribbon cable between the keypad and the display/control board</li>
<li>Electrical fault on the user interface board</li>
</ul>

<h3>How to Troubleshoot F7</h3>
<ol>
<li><strong>Power reset:</strong> Switch off the circuit breaker for 60 seconds and restore. Press each button on the panel in sequence after power is restored — an F7 that reappears immediately when a specific button is touched indicates which key is at fault.</li>
<li><strong>Inspect the panel surface:</strong> Look for moisture damage, bubbling under the panel overlay, or any button that does not click and release properly.</li>
<li><strong>Check the ribbon cable:</strong> With the dishwasher unplugged, carefully open the door inner panel and inspect the ribbon cable connection to the control board. Reseat any loose connection.</li>
<li><strong>Clean around buttons:</strong> Dampened cleaning around the panel edges can sometimes free a mechanically stuck button. Dry thoroughly before testing.</li>
<li><strong>Replace the control panel assembly:</strong> If the fault persists, the keypad/UI panel assembly requires replacement with a genuine Monogram part.</li>
</ol>

<p>For professional Monogram dishwasher control panel replacement, call our team at <strong>{$phone}</strong>.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f9' => array(
        'code'    => 'F9',
        'title'   => 'Monogram Dishwasher Error Code F9 – Door Lock Circuit Problem',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F9 Mean?</h2>
<p>Error code <strong>F9</strong> on a Monogram dishwasher indicates a <strong>door lock circuit problem</strong>. The control board monitors the door latch and lock assembly to confirm the door is securely closed before allowing a cycle to start or continue. When the door lock circuit fails to confirm a locked state — or reports an unexpected state change during operation — F9 is triggered and the cycle halts.</p>

<h3>Common Causes of F9</h3>
<ul>
<li>Door latch worn or damaged and not engaging the switch correctly</li>
<li>Door lock switch (microswitch) failed open or closed</li>
<li>Wiring fault in the door latch circuit</li>
<li>Door misaligned — not closing squarely against the tub gasket</li>
<li>Foreign object preventing the latch from fully engaging</li>
</ul>

<h3>How to Troubleshoot F9</h3>
<ol>
<li><strong>Power reset:</strong> Turn off at the circuit breaker for 60 seconds. Open and firmly close the door, making sure you hear and feel the latch engage before restoring power.</li>
<li><strong>Inspect the latch:</strong> Open the door and examine the latch strike and the latch receiver on the tub frame. Look for any visible cracking, wear, or debris preventing full engagement.</li>
<li><strong>Check door alignment:</strong> Close the door slowly and observe whether it closes evenly on both sides. A door that drops or tilts may need hinge adjustment.</li>
<li><strong>Test the door switch:</strong> With the dishwasher unplugged, disconnect the door switch wiring and test continuity with a multimeter — the switch should open and close as the latch is engaged and released.</li>
<li><strong>Replace the latch assembly:</strong> If the switch or latch mechanism is worn, replace the complete door latch assembly with a genuine Monogram component.</li>
</ol>

<p>Door latch replacement on a Monogram integrated dishwasher requires careful panel removal. Call our repair team at <strong>{$phone}</strong> for professional F9 service.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f16' => array(
        'code'    => 'F16',
        'title'   => 'Monogram Dishwasher Error Code F16 – Temperature Sensor Malfunction',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F16 Mean?</h2>
<p>Error code <strong>F16</strong> on a Monogram dishwasher indicates a <strong>temperature sensor malfunction</strong> — the sensor monitoring wash water temperature is reading a value that is open circuit, short circuit, or otherwise outside its valid operating range. The dishwasher requires accurate temperature data to safely manage the hot wash phase and sanitize dishes effectively. F16 halts the cycle when the sensor cannot be trusted.</p>

<h3>Common Causes of F16</h3>
<ul>
<li>Failed temperature sensor (NTC thermistor) in the sump or wash circuit</li>
<li>Damaged sensor connector or loose wiring</li>
<li>Mineral scale buildup on the sensor element affecting readings</li>
<li>Control board input circuit failure</li>
</ul>

<h3>How to Troubleshoot F16</h3>
<ol>
<li><strong>Power reset:</strong> Disconnect at the breaker for 60 seconds and restart a fresh cycle.</li>
<li><strong>Locate the temperature sensor:</strong> On Monogram dishwashers, the NTC temperature sensor is typically found in the sump assembly at the bottom of the tub, accessible after removing the lower spray arm and filter assembly.</li>
<li><strong>Inspect for scale buildup:</strong> If the sensor element is coated in white mineral scale, clean it with a vinegar solution and a soft brush. Allow to dry before testing.</li>
<li><strong>Test resistance:</strong> Disconnect the sensor and measure resistance with a multimeter at room temperature. For a typical NTC thermistor, expect 10,000–50,000 ohms at 68°F (20°C). An OL reading (open) or near-zero (short) confirms the sensor must be replaced.</li>
<li><strong>Replace the sensor:</strong> Install a factory-certified Monogram NTC temperature sensor. Aftermarket sensors may not have the correct resistance curve for your model's control logic.</li>
</ol>

<p>Call our Monogram dishwasher service team at <strong>{$phone}</strong> for professional F16 temperature sensor replacement.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f33' => array(
        'code'    => 'F33',
        'title'   => 'Monogram Dishwasher Error Code F33 – Door Switch Error',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F33 Mean?</h2>
<p>Error code <strong>F33</strong> on a Monogram dishwasher indicates a <strong>door switch error</strong>. The control board is not receiving the correct signal from the door switch that confirms the door is securely closed and locked. Without a confirmed door-closed signal, the dishwasher will not start or will stop mid-cycle for safety. F33 is specifically a door switch circuit fault — distinct from a door latch alignment issue.</p>

<h3>Common Causes of F33</h3>
<ul>
<li>Failed door switch (microswitch) — no longer making contact when door is closed</li>
<li>Broken or disconnected wiring to the door switch</li>
<li>Door switch actuator worn and not depressing the switch fully</li>
<li>Control board input failure</li>
</ul>

<h3>How to Troubleshoot F33</h3>
<ol>
<li><strong>Power reset:</strong> Turn off at the circuit breaker for 60 seconds, close the door firmly, and restore power.</li>
<li><strong>Check the door closure:</strong> Ensure the door latches fully with a firm click. If the door feels loose or the latch doesn't engage positively, the switch actuator may not be reaching the switch contact point.</li>
<li><strong>Locate the door switch:</strong> The door switch is mounted in the door latch assembly. It is the microswitch that physically activates when the latch engages the tub frame receiver.</li>
<li><strong>Test the switch:</strong> With the dishwasher unplugged and the door switch accessible, use a multimeter to test continuity across the switch terminals while manually simulating door closure by pressing the actuator. No continuity when the actuator is depressed confirms a failed switch.</li>
<li><strong>Replace the door switch:</strong> The switch may be replaceable as a standalone component or as part of the complete latch assembly depending on your model. Use genuine Monogram parts.</li>
</ol>

<p>Call our certified Monogram dishwasher repair team at <strong>{$phone}</strong> for accurate F33 diagnosis and door switch replacement.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f34' => array(
        'code'    => 'F34',
        'title'   => 'Monogram Dishwasher Error Code F34 – Water in Drain Pan (Leak Detected)',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F34 Mean?</h2>
<p>Error code <strong>F34</strong> on a Monogram dishwasher indicates that <strong>water has been detected in the base drain pan</strong> — the drip tray at the bottom of the dishwasher beneath the tub. A float switch in the pan rises when water accumulates, triggering F34. The dishwasher immediately stops the current cycle, closes the water inlet valve, and activates the drain pump to remove water from the pan as a flood prevention measure.</p>

<h3>Common Causes of F34</h3>
<ul>
<li>Leaking door gasket or tub seal</li>
<li>Loose or cracked internal water hose connection</li>
<li>Failed wash pump seal allowing water to escape into the base</li>
<li>Faulty water inlet valve that drips when closed</li>
<li>Excessive sudsing from wrong detergent causing overflow into the base</li>
<li>Cracked sump assembly or tub</li>
</ul>

<h3>How to Troubleshoot F34</h3>
<ol>
<li><strong>Stop using the dishwasher immediately:</strong> Continued operation while F34 is active can worsen the leak and cause floor or cabinetry damage.</li>
<li><strong>Clear the base pan:</strong> With the dishwasher unplugged, carefully tilt the unit backward approximately 45 degrees to drain water from the base pan into a towel or bucket. This resets the float switch.</li>
<li><strong>Identify the leak source:</strong> Pull the dishwasher forward from its cabinetry if possible and inspect underneath during a short test fill cycle. Look for drips from the door bottom, pump area, or hose connections.</li>
<li><strong>Check the door gasket:</strong> Inspect the door perimeter gasket for cracks, tears, or sections that have pulled away from the channel. A damaged gasket allows water to run down the door and collect in the base.</li>
<li><strong>Inspect internal hoses:</strong> Check the hose clamps on the inlet and drain hoses inside the unit for looseness or corrosion.</li>
<li><strong>Do not ignore F34:</strong> Even a slow drip can saturate flooring and cabinetry over weeks. Call our team at <strong>{$phone}</strong> for professional leak detection and repair.</li>
</ol>
HTML,
    ),

    'monogram-dishwasher-error-code-f56' => array(
        'code'    => 'F56',
        'title'   => 'Monogram Dishwasher Error Code F56 – Failure to Drain',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F56 Mean?</h2>
<p>Error code <strong>F56</strong> (also displayed as <strong>FTD</strong> on some models) on a Monogram dishwasher indicates a <strong>failure to drain</strong>. The dishwasher attempted to drain the tub at the end of a cycle phase but the turbidity or water level sensor confirmed that water remains in the sump after the drain pump has run for its full allotted time. This leaves standing water at the bottom of the tub.</p>

<h3>Common Causes of F56</h3>
<ul>
<li>Drain hose kinked, crushed, or clogged with debris</li>
<li>Drain pump impeller blocked by glass, food debris, or a foreign object</li>
<li>Failed drain pump motor</li>
<li>Clogged or dirty filter and sump screen</li>
<li>Garbage disposal knockout plug still installed (if recently connected to a new disposal)</li>
<li>Drain hose installed too high or without a high loop, allowing siphoning</li>
</ul>

<h3>How to Troubleshoot F56</h3>
<ol>
<li><strong>Check and clean the filter:</strong> Remove the lower spray arm, then remove and rinse the cylindrical filter and flat filter screen. Clogged filters are one of the most common causes of poor draining on Monogram dishwashers.</li>
<li><strong>Inspect the drain hose:</strong> Pull the dishwasher slightly forward and trace the drain hose to the sink drain or garbage disposal. Check for kinks, compression against the cabinet, or clogs.</li>
<li><strong>Check the garbage disposal connection:</strong> If connected to a disposal, ensure the disposal knockout plug has been removed and the disposal itself is not clogged — it should be run before starting the dishwasher.</li>
<li><strong>Clear the drain pump:</strong> With the dishwasher unplugged and the filters removed, reach into the sump and check for debris around the pump impeller. Remove any obstructions carefully.</li>
<li><strong>Test the drain pump:</strong> If the impeller is clear but the pump does not run during a drain cycle, the pump motor has likely failed and requires replacement.</li>
</ol>

<p>Drain pump replacement requires sump disassembly. Call our Monogram dishwasher repair specialists at <strong>{$phone}</strong> for F56 diagnosis and professional drain system service.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f99' => array(
        'code'    => 'F99',
        'title'   => 'Monogram Dishwasher Error Code F99 – Minimum Wash Temperature Not Reached',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F99 Mean?</h2>
<p>Error code <strong>F99</strong> on a Monogram dishwasher indicates that the <strong>minimum required wash temperature of 120°F (49°C) was not reached</strong> in recent wash cycles. Dishwashers require hot water for effective cleaning and sanitation — when the incoming water supply is too cold or the heating element fails to bring water to the required temperature, F99 is stored as a performance fault.</p>

<h3>Common Causes of F99</h3>
<ul>
<li>Incoming hot water supply too cold — water heater set too low or located far from the dishwasher</li>
<li>Failed heating element not boosting wash water temperature</li>
<li>Defective temperature sensor providing inaccurate readings</li>
<li>Wash pump not circulating water effectively, reducing heat distribution</li>
<li>Very cold water supply during winter months</li>
</ul>

<h3>How to Troubleshoot F99</h3>
<ol>
<li><strong>Check hot water supply temperature:</strong> Before starting a wash cycle, run the kitchen hot water tap for 30–60 seconds until the water is hot to the touch. This purges cold water from the supply line and ensures the dishwasher fills with already-hot water — a key step often overlooked.</li>
<li><strong>Check your water heater setting:</strong> Verify your home water heater is set to at least 120°F (49°C). Many manufacturers recommend 120°F–125°F for dishwasher performance. Settings below 110°F will consistently trigger F99.</li>
<li><strong>Test the heating element:</strong> With the dishwasher unplugged, access the heating element in the tub base and test continuity with a multimeter. No continuity confirms the element has failed and must be replaced.</li>
<li><strong>Verify the temperature sensor:</strong> A faulty NTC sensor may falsely report low temperatures. Test and replace as needed (see F16 guidance).</li>
<li><strong>Check for sanitize cycle use:</strong> If you regularly use the Sanitize cycle, F99 may appear when water temperature doesn't reach the higher sanitize threshold — not just the 120°F minimum. The heating element must be fully functional for sanitize cycles.</li>
</ol>

<p>For heating element testing and replacement on Monogram dishwashers, call our repair team at <strong>{$phone}</strong>.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f112' => array(
        'code'    => 'F112',
        'title'   => 'Monogram Dishwasher Error Code F112 – Stuck Button on User Interface',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F112 Mean?</h2>
<p>Error code <strong>F112</strong> on a Monogram dishwasher indicates that a <strong>button on the user interface (control panel) is stuck or has been held continuously for an extended period</strong>. The control board monitors all panel inputs and triggers F112 when any button remains in an activated state beyond normal press duration — preventing an accidental cycle selection or modification.</p>

<h3>Common Causes of F112</h3>
<ul>
<li>Food residue, grease, or moisture beneath a button causing physical sticking</li>
<li>Worn or deformed button membrane that no longer releases after pressing</li>
<li>Damaged user interface board with a failed switch circuit</li>
<li>Debris caught between the panel overlay and the underlying board</li>
</ul>

<h3>How to Troubleshoot F112</h3>
<ol>
<li><strong>Power reset:</strong> Turn off at the circuit breaker for 60 seconds. When power is restored, press each button individually to identify any that feel stiff, mushy, or fail to click and release.</li>
<li><strong>Clean the control panel:</strong> With the dishwasher unplugged, use a damp cloth to clean around all button edges on the panel surface. A mixture of warm water and mild dish soap can dissolve residue that causes mechanical sticking. Dry thoroughly before reconnecting power.</li>
<li><strong>Check for panel damage:</strong> Inspect for any visible cracking, swelling, or deformation of the panel surface that could cause a permanent button depression.</li>
<li><strong>Isolate the stuck button:</strong> After cleaning and resetting, if F112 returns, note which button the display highlights or test each button methodically — the stuck button will retrigger the fault.</li>
<li><strong>Replace the user interface board:</strong> If cleaning does not resolve F112, the control panel assembly requires replacement with a genuine Monogram part for your model.</li>
</ol>

<p>For Monogram dishwasher control panel replacement, call our repair specialists at <strong>{$phone}</strong>.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f146' => array(
        'code'    => 'F146',
        'title'   => 'Monogram Dishwasher Error Code F146 – Circulation Pump Amperage Abnormal',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F146 Mean?</h2>
<p>Error code <strong>F146</strong> on a Monogram dishwasher indicates that the <strong>circulation pump is drawing abnormal amperage</strong>. The control board monitors the current draw of the main wash circulation pump during operation. When the amperage reading is too high (motor strain) or too low (motor not running properly), F146 is triggered. This fault directly affects wash performance — a compromised circulation pump means reduced water pressure through the spray arms.</p>

<h3>Common Causes of F146</h3>
<ul>
<li>Foreign object (glass shard, bone fragment, label) lodged in the pump impeller, causing mechanical resistance and high current draw</li>
<li>Circulation pump motor winding failure — worn motor drawing excessive current</li>
<li>Failed pump motor capacitor on models where the pump uses a start capacitor</li>
<li>Inverter drive board fault affecting pump motor control</li>
<li>Partially blocked spray arm causing back pressure on the circulation system</li>
</ul>

<h3>How to Troubleshoot F146</h3>
<ol>
<li><strong>Power reset:</strong> Turn off at the circuit breaker for 60 seconds. If a momentary jam cleared, F146 may not return.</li>
<li><strong>Inspect the filter and sump:</strong> Remove the filters and check the sump area for any foreign objects — glass chips, bones, pits, or labels are common culprits that jam the impeller.</li>
<li><strong>Check spray arm movement:</strong> Remove the spray arms and ensure they spin freely and are not cracked or blocked.</li>
<li><strong>Listen during cycle start:</strong> When starting a cycle after clearing the sump, listen for unusual humming or grinding sounds from the pump area — these indicate mechanical resistance even after visible debris is removed.</li>
<li><strong>Pump replacement:</strong> If the impeller is clear but F146 persists, the circulation pump motor has likely failed internally and requires replacement. This is a major dishwasher repair that requires sump disassembly.</li>
</ol>

<p>Circulation pump replacement on a Monogram dishwasher is a complex repair. Call our certified repair team at <strong>{$phone}</strong> for professional F146 service.</p>
HTML,
    ),

    'monogram-dishwasher-error-code-f147' => array(
        'code'    => 'F147',
        'title'   => 'Monogram Dishwasher Error Code F147 – Drain Pump Amperage Abnormal',
        'content' => <<<HTML
<h2>What Does Monogram Dishwasher Error Code F147 Mean?</h2>
<p>Error code <strong>F147</strong> on a Monogram dishwasher indicates that the <strong>drain pump is drawing abnormal amperage</strong>. The drain pump expels used wash water at the end of each cycle phase. When the control board detects that the drain pump's current draw is outside the expected range — either too high (obstruction or motor strain) or too low (pump not running) — it triggers F147 and may leave standing water in the tub.</p>

<h3>Common Causes of F147</h3>
<ul>
<li>Foreign object jammed in the drain pump impeller — the most common cause of high current draw</li>
<li>Drain hose severely kinked or blocked, creating back pressure that overloads the pump</li>
<li>Failed drain pump motor with worn windings drawing excessive current</li>
<li>Drain pump capacitor failure</li>
<li>Garbage disposal or sink drain blockage preventing proper drainage</li>
</ul>

<h3>How to Troubleshoot F147</h3>
<ol>
<li><strong>Power reset:</strong> Disconnect power for 60 seconds and restart. If standing water remains after the reset cycle, the drain pump is not operating.</li>
<li><strong>Clean the filter assembly:</strong> Remove and thoroughly clean the filter, filter screen, and sump cover. Debris that reaches the drain pump typically passes through the filter first — a clogged filter restricts flow and can cause the pump to strain.</li>
<li><strong>Check for impeller obstruction:</strong> With the dishwasher unplugged and filters removed, inspect the drain pump inlet for glass, debris, or other objects. Remove any obstruction carefully to avoid injury.</li>
<li><strong>Inspect the drain hose:</strong> Check the drain hose for kinks, compression, or clogs from end to end. Ensure the high loop is maintained and that the connection at the disposal or drain is clear.</li>
<li><strong>Run the disposal:</strong> If connected to a garbage disposal, run it for 30 seconds before starting the dishwasher — a full disposal can block dishwasher drainage and cause both F56 and F147.</li>
<li><strong>Replace the drain pump:</strong> If the impeller is clear and the hose is unobstructed but F147 persists, the drain pump motor has failed and requires replacement.</li>
</ol>

<p>For drain pump replacement and F147 diagnosis on Monogram dishwashers, call our repair team at <strong>{$phone}</strong>.</p>
HTML,
    ),

);

// ── Insert posts ──────────────────────────────────────────────────────────────
$term = get_term_by( 'slug', 'dishwasher', 'appliance_type' );
if ( ! $term ) {
    $inserted = wp_insert_term( 'Dishwasher', 'appliance_type', array( 'slug' => 'dishwasher' ) );
    $term_id  = is_wp_error( $inserted ) ? 0 : $inserted['term_id'];
} else {
    $term_id = $term->term_id;
}

foreach ( $dishwasher_f_codes as $slug => $data ) {
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
        update_post_meta( $post_id, '_brp_appliance_type', 'dishwasher' );
        if ( $term_id ) {
            wp_set_post_terms( $post_id, array( $term_id ), 'appliance_type' );
        }
    }
}
