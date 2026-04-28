<?php
/**
 * Error Codes v8 — Delete all cooktop error codes, insert E0–E9, Er22, Er31, Er39, Er47
 * Triggered once via transient brp_error_codes_v8_done
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ── 1. Delete all existing cooktop error codes ──────────────────────────────
$existing = new WP_Query( array(
    'post_type'      => 'error_code',
    'posts_per_page' => -1,
    'fields'         => 'ids',
    'tax_query'      => array( array(
        'taxonomy' => 'appliance_type',
        'field'    => 'slug',
        'terms'    => 'cooktop',
    ) ),
) );
foreach ( $existing->posts as $id ) {
    wp_delete_post( $id, true );
}

// ── 2. Helper ───────────────────────────────────────────────────────────────
function brp_insert_cooktop_code( $slug, $title, $code, $content ) {
    $post_id = wp_insert_post( array(
        'post_type'    => 'error_code',
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_content' => $content,
        'post_status'  => 'publish',
    ) );
    if ( $post_id && ! is_wp_error( $post_id ) ) {
        wp_set_post_terms( $post_id, array( 'cooktop' ), 'appliance_type' );
        update_post_meta( $post_id, '_brp_error_code', $code );
    }
}

// ── 3. New codes ─────────────────────────────────────────────────────────────

brp_insert_cooktop_code(
    'cooktop-error-code-e0',
    'Monogram Cooktop Error Code E0 – Control Board Communication Failure',
    'E0',
    '<h2>Monogram Cooktop Error Code E0 – Control Board Communication Failure</h2>
<p>The <strong>E0 error code</strong> on a Monogram cooktop signals a <strong>communication failure between the main control board and the user interface (UI) board</strong>. The two boards exchange data continuously during operation; when that signal is interrupted or lost, the cooktop locks out as a safety measure and displays E0.</p>

<h3>What Triggers E0</h3>
<ul>
<li><strong>Loose or corroded ribbon cable</strong> – The flat data cable connecting the UI board to the control board can work loose over time, especially on units that experience frequent thermal cycling.</li>
<li><strong>Failed control board</strong> – A burned relay or faulty microprocessor on the main board prevents it from sending or receiving handshake signals.</li>
<li><strong>Failed UI board</strong> – The touch panel board may lose its firmware or develop a damaged communication chip.</li>
<li><strong>Power surge damage</strong> – A voltage spike can corrupt both boards simultaneously, triggering E0 after the surge has passed.</li>
<li><strong>Heat damage to wiring harness</strong> – Excess heat from a nearby burner element or blocked ventilation can melt or degrade the insulation on data wires.</li>
</ul>

<h3>Troubleshooting Steps</h3>
<ol>
<li><strong>Hard reset the cooktop</strong> – Switch off the circuit breaker that supplies the cooktop, wait 60 seconds, then restore power. A temporary glitch in the communication bus can clear with a full power cycle.</li>
<li><strong>Inspect the wiring harness</strong> – With the power off and the cooktop cooled, remove the top panel and visually check all ribbon cables and connectors between the UI and main boards. Reseat any loose connectors firmly.</li>
<li><strong>Check for burn marks or corrosion</strong> – Inspect the connector pins under good lighting. Greenish or white deposits indicate moisture corrosion; black discolouration indicates heat damage. Clean with electronic contact cleaner or replace the harness.</li>
<li><strong>Test the control board voltage outputs</strong> – Using a multimeter, verify that the control board is outputting the correct reference voltages to the UI board as specified in the service manual.</li>
<li><strong>Replace the faulty board</strong> – If the wiring harness tests good but E0 persists, replace the control board first (the more common failure point), then the UI board if the error continues.</li>
</ol>

<h3>Is It Safe to Use the Cooktop?</h3>
<p>No. When E0 is active the cooktop disables all cooking zones. Do not attempt to bypass the lockout. Schedule service with a certified Monogram technician to inspect and replace the affected components.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e1',
    'Monogram Cooktop Error Code E1 – Overtemperature / Thermal Cutoff',
    'E1',
    '<h2>Monogram Cooktop Error Code E1 – Overtemperature / Thermal Cutoff</h2>
<p>The <strong>E1 error code</strong> on a Monogram cooktop indicates the unit has detected an <strong>overtemperature condition</strong>. An internal thermistor or thermostat has measured a temperature above the safe operating threshold and triggered a protective shutdown to prevent fire or component damage.</p>

<h3>Common Causes of E1</h3>
<ul>
<li><strong>Blocked ventilation</strong> – Cooktops require airflow beneath and around the unit. Grease buildup in vents, objects stored too close, or a poorly cut countertop opening restricts airflow and causes heat to accumulate.</li>
<li><strong>Extended high-heat cooking</strong> – Running multiple large burners or the boost setting continuously for very long periods can push internal temperatures above design limits.</li>
<li><strong>Faulty cooling fan</strong> – Induction models rely on internal fans to cool the inverter electronics. A failed fan bearing or seized motor causes rapid heat buildup even during normal use.</li>
<li><strong>Defective thermistor</strong> – A thermistor reading higher than actual temperature will trigger a false E1. This is less common but occurs on units with age-related component drift.</li>
<li><strong>Ambient temperature too high</strong> – Installing the cooktop directly adjacent to an oven vent or in an unusually warm kitchen can compound heat stress.</li>
</ul>

<h3>Troubleshooting Steps</h3>
<ol>
<li><strong>Turn off the cooktop and allow it to cool</strong> – Power down and wait at least 30 minutes before attempting a reset. Trying to reset while the unit is still hot will cause the error to return immediately.</li>
<li><strong>Clear all ventilation paths</strong> – Clean the vents beneath the cooktop with a soft brush and vacuum. Ensure the countertop cutout dimensions match the installation manual specifications.</li>
<li><strong>Check the cooling fan (induction models)</strong> – Power the unit on briefly and listen for fan operation. A functioning fan should spin up quickly when a cooking zone is activated. Absence of fan noise suggests a failed motor.</li>
<li><strong>Test the thermistor</strong> – At room temperature, a standard NTC thermistor should read approximately 10–50 kΩ depending on the model. Consult the service manual for the exact value and compare with a multimeter reading.</li>
<li><strong>Replace failed components</strong> – Replace the cooling fan or thermistor as indicated by your tests. If both test good and E1 recurs under normal cooking, suspect the control board\'s thermal monitoring circuit.</li>
</ol>

<h3>Prevention</h3>
<p>Clean the underside vents monthly if cooking frequently. Never store items in the cabinet directly below an induction cooktop while it is running.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e2',
    'Monogram Cooktop Error Code E2 – Left Front Zone Sensor Fault',
    'E2',
    '<h2>Monogram Cooktop Error Code E2 – Left Front Zone Sensor Fault</h2>
<p>The <strong>E2 error code</strong> on a Monogram cooktop points to a fault detected in the <strong>temperature or pan-detection sensor assigned to the left front cooking zone</strong>. On induction models this is an IGBT temperature sensor; on gas or electric radiant models it is a surface-element thermistor or thermal limiter.</p>

<h3>What Causes E2</h3>
<ul>
<li><strong>Open-circuit sensor</strong> – The sensor wire has broken internally or at a connector, reporting an infinitely high resistance that the control board interprets as an extreme temperature.</li>
<li><strong>Short-circuit sensor</strong> – The sensor leads have shorted together or to ground, reporting near-zero resistance (implying an impossibly high temperature) and triggering a protective fault.</li>
<li><strong>Physical damage to sensor</strong> – Boilover liquids seeping beneath the glass can corrode or short a sensor mounted close to the zone.</li>
<li><strong>Cracked glass cooktop surface</strong> – On glass-ceramic radiant models, a crack can shift the sensor mounting position, causing intermittent contact and erratic readings.</li>
</ul>

<h3>Troubleshooting Steps</h3>
<ol>
<li><strong>Power cycle the unit</strong> – Switch the circuit breaker off for 60 seconds. If the sensor experienced a momentary spike rather than a true fault, E2 will clear.</li>
<li><strong>Inspect for liquid damage</strong> – Look for dried boilover residue around the left front zone. Clean the surface thoroughly and allow it to dry completely before retesting.</li>
<li><strong>Measure sensor resistance</strong> – With power OFF, disconnect the sensor harness and measure resistance across the sensor terminals. Compare with the service manual specification. An open or shorted reading confirms sensor failure.</li>
<li><strong>Inspect the wiring harness to the zone</strong> – Check for melted insulation, pinched wires, or loose connector pins between the sensor and the control board.</li>
<li><strong>Replace the zone sensor</strong> – If resistance is out of spec, replace the sensor. On induction models this is typically the IGBT thermistor; on radiant models it is the element limiter or thermistor assembly.</li>
</ol>

<p>E2 disables at minimum the left front zone and may disable the entire cooktop depending on the model. Do not use the appliance until the fault is resolved to avoid overheating the affected zone\'s electronics.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e3',
    'Monogram Cooktop Error Code E3 – Right Front Zone Sensor Fault',
    'E3',
    '<h2>Monogram Cooktop Error Code E3 – Right Front Zone Sensor Fault</h2>
<p>The <strong>E3 error code</strong> on a Monogram cooktop indicates a fault in the <strong>temperature sensor for the right front cooking zone</strong>. The diagnosis and repair process mirrors that of E2 but targets the right front zone sensor and its associated wiring.</p>

<h3>Causes</h3>
<ul>
<li><strong>Sensor open circuit</strong> – Internal wire break in the thermistor or NTC sensor element.</li>
<li><strong>Sensor short circuit</strong> – Shorted sensor leads caused by liquid ingress or damaged insulation.</li>
<li><strong>Connector corrosion</strong> – Grease and steam accumulation on the connector between the sensor and the main harness.</li>
<li><strong>Control board input failure</strong> – Rarely, the analog input on the control board that reads the sensor signal can fail, creating a false E3 even when the sensor itself is good.</li>
</ul>

<h3>Troubleshooting Steps</h3>
<ol>
<li><strong>Hard reset</strong> – Turn the circuit breaker off for 60 seconds and restore power. Confirm whether E3 clears or immediately returns.</li>
<li><strong>Visual inspection</strong> – Remove the cooktop per the installation instructions and inspect the right front zone wiring for any visible damage, corrosion, or disconnected leads.</li>
<li><strong>Resistance test</strong> – Disconnect the sensor connector and measure resistance at the sensor terminals with a multimeter. Out-of-specification readings (open or near zero) confirm sensor failure.</li>
<li><strong>Swap test</strong> – If you have access to the service manual pin assignments, temporarily connect the right front sensor harness to the left front input on the board to determine whether the fault follows the sensor or the board input.</li>
<li><strong>Replace the sensor or board</strong> – Replace whichever component the swap test implicates. Use OEM Monogram replacement sensors to ensure correct resistance characteristics.</li>
</ol>

<p>Like E2, E3 triggers a safety lockout. Do not bypass or tape over the error display to continue cooking.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e4',
    'Monogram Cooktop Error Code E4 – Left Rear Zone Sensor Fault',
    'E4',
    '<h2>Monogram Cooktop Error Code E4 – Left Rear Zone Sensor Fault</h2>
<p>The <strong>E4 error code</strong> on a Monogram cooktop flags a fault in the <strong>temperature sensor for the left rear cooking zone</strong>. The left rear zone is often used for large pots and prolonged simmering, making its sensor more susceptible to steam and boilover damage over time.</p>

<h3>Why E4 Occurs</h3>
<ul>
<li><strong>Steam and condensation damage</strong> – Large pots on the rear zone release significant steam that can migrate beneath the glass and wet the sensor connections over repeated use.</li>
<li><strong>Open or shorted thermistor</strong> – Age-related element fatigue causes the NTC thermistor to drift out of specification and eventually fail open or short.</li>
<li><strong>Harness damage from high heat</strong> – The rear zone sits closest to the wall, where heat can accumulate and degrade the wiring insulation more quickly than front zones.</li>
<li><strong>Connector pin retraction</strong> – Thermal cycling causes connector housings to expand and contract, sometimes pushing a pin out of its terminal lock.</li>
</ul>

<h3>Diagnostic and Repair Steps</h3>
<ol>
<li><strong>Power off and cool down</strong> – Always work on a fully cooled cooktop. Left rear zone elements retain heat longer because of their proximity to the back wall.</li>
<li><strong>Remove the cooktop from the countertop</strong> – Access to the left rear zone sensor requires removing the unit from the installation cutout according to the installation guide.</li>
<li><strong>Inspect the sensor and harness</strong> – Look for moisture damage, corroded pins, or burned insulation near the left rear zone sensor mounting point.</li>
<li><strong>Measure resistance</strong> – An OEM left rear sensor should match the specification in the service manual (typically 10 kΩ at 25 °C for NTC sensors). Replace if out of spec.</li>
<li><strong>Dry and clean connectors</strong> – If condensation is present, dry with compressed air, treat with electronic contact cleaner, and let dry before reassembling.</li>
<li><strong>Replace the sensor</strong> – Install the OEM replacement sensor and torque any mounting screws to specification to ensure proper thermal contact.</li>
</ol>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e5',
    'Monogram Cooktop Error Code E5 – Right Rear Zone Sensor Fault',
    'E5',
    '<h2>Monogram Cooktop Error Code E5 – Right Rear Zone Sensor Fault</h2>
<p>The <strong>E5 error code</strong> on a Monogram cooktop identifies a fault in the <strong>temperature sensor for the right rear cooking zone</strong>. This is the symmetric counterpart to E4. Diagnosis and repair follow the same procedure as E4, targeted at the right rear zone sensor and its wiring path.</p>

<h3>Causes of E5</h3>
<ul>
<li><strong>Thermistor failure (open or short)</strong> – The sensor element fails due to age, heat cycles, or liquid damage.</li>
<li><strong>Wiring harness damage</strong> – Insulation degradation from heat concentration at the back of the cooktop.</li>
<li><strong>Connector corrosion</strong> – Grease vapour and steam settle into the connector over years of cooking and cause pin corrosion.</li>
<li><strong>Boilover liquid damage</strong> – Spills on the right rear zone penetrate beneath the glass and corrode the sensor assembly directly.</li>
</ul>

<h3>Repair Procedure</h3>
<ol>
<li><strong>Turn off the circuit breaker</strong> and allow the cooktop to cool fully (minimum 30 minutes after last use).</li>
<li><strong>Remove the unit from the countertop cutout</strong> following the installation manual procedure.</li>
<li><strong>Locate the right rear zone sensor</strong> — it is mounted beneath the glass at the right rear zone, connected to the main wiring harness via a 2-pin connector.</li>
<li><strong>Test resistance at the sensor connector</strong> — compare the reading against the service manual specification.</li>
<li><strong>Replace the sensor</strong> if resistance is outside specification, using an OEM part with identical resistance characteristics.</li>
<li><strong>Reinstall the cooktop</strong> and perform a test cycle on the right rear zone to confirm E5 is cleared and the zone heats normally.</li>
</ol>

<p>If E5 returns after sensor replacement, test the analog input pin on the main control board for correct voltage reference. A failed board input will continue to generate E5 regardless of sensor condition.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e6',
    'Monogram Cooktop Error Code E6 – IGBT / Inverter Module Overtemperature',
    'E6',
    '<h2>Monogram Cooktop Error Code E6 – IGBT / Inverter Module Overtemperature</h2>
<p>The <strong>E6 error code</strong> on a Monogram induction cooktop indicates that an <strong>IGBT (Insulated Gate Bipolar Transistor) or inverter module has reached its thermal limit</strong>. IGBTs are the high-power switching components that generate the induction field in each cooking zone; they produce significant heat under load and rely on active cooling to stay within safe operating temperatures.</p>

<h3>Why E6 Triggers</h3>
<ul>
<li><strong>Cooling fan failure</strong> – The internal fan that circulates air over the IGBT heat sinks is the most common cause. A seized fan bearing or failed fan motor causes rapid temperature rise within minutes of operation.</li>
<li><strong>Blocked air intake or exhaust</strong> – Grease-clogged vents or objects blocking airflow prevent heat dissipation even when the fan is running.</li>
<li><strong>Thermal paste degradation</strong> – Over many years, the thermal compound between the IGBT and its heat sink dries out, dramatically increasing thermal resistance.</li>
<li><strong>Oversized cookware on boost mode</strong> – Running a very large pan on maximum boost setting for extended periods pushes IGBT power dissipation to its thermal ceiling.</li>
<li><strong>Ambient temperature extremes</strong> – Kitchens that regularly exceed 35 °C reduce the available thermal headroom for the IGBT modules.</li>
</ul>

<h3>Troubleshooting</h3>
<ol>
<li><strong>Allow full cool-down</strong> – Switch off the cooktop and wait at least 45 minutes. IGBTs retain heat longer than surface sensors.</li>
<li><strong>Inspect and clean vents</strong> – Use a vacuum and soft brush to clear all intake and exhaust ventilation paths.</li>
<li><strong>Verify fan operation</strong> – Activate a cooking zone briefly and confirm the cooling fan starts within a few seconds. No fan noise indicates a failed fan.</li>
<li><strong>Replace the cooling fan</strong> – This resolves the majority of E6 faults. Use the OEM fan assembly for the correct airflow specification.</li>
<li><strong>Inspect IGBT thermal interface</strong> – If E6 persists after fan replacement, remove the IGBT module, clean the old thermal compound, and apply fresh high-quality thermal paste before reinstalling.</li>
<li><strong>Replace the IGBT module</strong> – If the module itself has been damaged by repeated overtemperature events (visible burn marks, cracked package), replace it. This is a job for a qualified technician due to high voltage residual charge in the capacitors.</li>
</ol>

<h3>Safety Warning</h3>
<p>Induction cooktop inverter circuits operate at high voltage. Always discharge capacitors before servicing internal components and allow a licensed technician to perform IGBT replacement.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e7',
    'Monogram Cooktop Error Code E7 – Input Voltage Out of Range',
    'E7',
    '<h2>Monogram Cooktop Error Code E7 – Input Voltage Out of Range</h2>
<p>The <strong>E7 error code</strong> on a Monogram cooktop indicates that the <strong>incoming supply voltage is outside the acceptable operating range</strong>. Monogram induction and electric cooktops are designed to operate within a specific voltage window (typically 208–240 V for 240 V models). Voltage that is too low or too high causes E7 and disables cooking zones as a protective measure.</p>

<h3>Causes of E7</h3>
<ul>
<li><strong>Utility supply voltage fluctuation</strong> – Brownouts, neighbour load spikes, or utility grid instability can cause momentary under-voltage events that trigger E7.</li>
<li><strong>Undersized circuit wiring</strong> – Wire gauge too small for the cooktop\'s rated amperage causes voltage drop under load, especially on long runs from the panel.</li>
<li><strong>Loose terminal connection</strong> – A loose connection at the terminal block on the cooktop, at the wall outlet, or at the breaker causes voltage to drop or spike intermittently.</li>
<li><strong>Tripped or weak circuit breaker</strong> – A breaker that is partially tripped or nearing the end of its service life may not maintain a stable supply to the cooktop.</li>
<li><strong>Shared circuit overload</strong> – If the cooktop circuit is shared with other high-draw appliances (uncommon but possible in older installations), simultaneous operation causes voltage sag.</li>
</ul>

<h3>Troubleshooting Steps</h3>
<ol>
<li><strong>Measure supply voltage at the outlet or terminal block</strong> – Use a multimeter to verify the voltage with the cooktop under load. It should remain within ±10% of the rated voltage throughout a cooking cycle.</li>
<li><strong>Inspect all terminal connections</strong> – Turn off the circuit breaker and inspect the connections at the cooktop terminal block. Tighten any loose screws; replace any burned or corroded terminals.</li>
<li><strong>Check the circuit breaker</strong> – Cycle the breaker fully off then on. If the breaker feels loose or trips again under normal load, have an electrician replace it.</li>
<li><strong>Verify wire gauge</strong> – Confirm that the supply wiring matches the gauge specified in the installation manual for the circuit length and amperage.</li>
<li><strong>Contact the utility</strong> – If voltage measurements show consistent under-voltage from the utility feed, contact your utility company. Low supply voltage is a utility issue, not an appliance fault.</li>
</ol>

<p>E7 is the one cooktop error that does not require appliance repair — it requires electrical system inspection. Never increase breaker size beyond specification to compensate for voltage issues.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e8',
    'Monogram Cooktop Error Code E8 – Coil / Heating Element Circuit Fault',
    'E8',
    '<h2>Monogram Cooktop Error Code E8 – Coil / Heating Element Circuit Fault</h2>
<p>The <strong>E8 error code</strong> on a Monogram cooktop signals a fault detected in the <strong>induction coil or radiant heating element circuit</strong>. The control board monitors the current through each heating circuit during operation; when current is absent, asymmetric, or outside expected parameters, E8 is triggered and the affected zone is disabled.</p>

<h3>What Causes E8</h3>
<ul>
<li><strong>Open-circuit induction coil</strong> – A wire break in the coil winding interrupts current flow. This is often caused by overheating from prolonged high-power operation or physical impact on the glass.</li>
<li><strong>Short-circuit in the coil</strong> – Shorted coil turns reduce impedance sharply, causing overcurrent that the board detects as abnormal. Heat damage is the typical cause.</li>
<li><strong>Failed radiant element (radiant models)</strong> – On glass-ceramic radiant models, the nichrome heating ribbon can break after thousands of thermal cycles.</li>
<li><strong>Damaged IGBT driving the coil</strong> – If the IGBT module that drives the coil has failed, the coil receives no excitation current, and the board detects an open circuit condition.</li>
<li><strong>Cracked cooktop glass</strong> – A crack that passes through or near the coil can damage coil conductors or shift the coil position, altering its impedance profile.</li>
</ul>

<h3>Diagnosis and Repair</h3>
<ol>
<li><strong>Identify the affected zone</strong> – E8 may specify a zone code on some models (e.g., E8-1 for zone 1). Test each zone individually to isolate the fault.</li>
<li><strong>Measure coil resistance</strong> – With power off and the coil connector disconnected, measure resistance across the coil terminals. Compare to specification (typically 1–5 Ω for induction coils). An open reading (OL) or very low reading confirms coil failure.</li>
<li><strong>Inspect for visible damage</strong> – Look for burn marks, melted wire insulation, or physical damage to the coil assembly beneath the glass.</li>
<li><strong>Test the IGBT</strong> – If the coil resistance is correct but E8 persists, test the IGBT module for the affected zone using the diode test on a multimeter.</li>
<li><strong>Replace the coil or IGBT</strong> – Coil and IGBT replacement requires disassembly of the cooktop bottom panel. This work should be performed by a certified technician due to the high-voltage capacitors present.</li>
</ol>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-e9',
    'Monogram Cooktop Error Code E9 – Touch Panel / Key Stuck',
    'E9',
    '<h2>Monogram Cooktop Error Code E9 – Touch Panel / Key Stuck</h2>
<p>The <strong>E9 error code</strong> on a Monogram cooktop indicates that the <strong>touch control panel has detected a stuck, continuously activated, or unresponsive key</strong>. The control board monitors the capacitive sensor values of all touch zones; if any key reports a constant activation signal for more than a few seconds, E9 is triggered and the panel is locked out to prevent unintended operation.</p>

<h3>Causes of E9</h3>
<ul>
<li><strong>Liquid on the control panel</strong> – Water, grease, or food residue bridging two touch-sensor zones creates a false continuous signal, simulating a pressed key.</li>
<li><strong>Damaged touch panel membrane</strong> – Physical damage (scratch, crack, or delamination) causes a touch zone to report persistent activation.</li>
<li><strong>Failed capacitive sensor IC</strong> – The capacitive sense controller chip on the UI board can fail in a state that holds one channel permanently active.</li>
<li><strong>Electromagnetic interference (EMI)</strong> – Nearby appliances or fluorescent lighting generating strong EMI can interfere with capacitive sensor readings.</li>
<li><strong>Manufacturing defect or age</strong> – Touch overlays delaminate from the glass after extended exposure to heat and cleaning chemicals, causing erratic signal behaviour.</li>
</ul>

<h3>Troubleshooting Steps</h3>
<ol>
<li><strong>Clean the touch panel surface</strong> – Dry the panel thoroughly and remove any grease film or food residue with a soft damp cloth. Do not use abrasive cleaners. Retry after the surface is completely dry.</li>
<li><strong>Hard reset the cooktop</strong> – Switch off the breaker for 60 seconds. This clears any transient capacitive offset stored in the sensor controller.</li>
<li><strong>Inspect the panel for physical damage</strong> – Look for cracks in the glass, bubbling under the control overlay, or areas where the overlay has lifted from the glass surface.</li>
<li><strong>Check for external interference</strong> – Temporarily move any fluorescent fixtures or appliances near the cooktop and test for E9 recurrence.</li>
<li><strong>Replace the touch panel overlay or UI board</strong> – If cleaning and reset do not resolve E9 and no external interference source is found, the touch panel or UI board must be replaced. A technician can determine which component is at fault by testing the board independently of the panel overlay.</li>
</ol>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-er22',
    'Monogram Cooktop Error Code Er22 – Communication Error Between Boards',
    'Er22',
    '<h2>Monogram Cooktop Error Code Er22 – Communication Error Between Boards</h2>
<p>The <strong>Er22 error code</strong> on a Monogram cooktop indicates a <strong>persistent communication error between the main control board and a secondary module</strong> — typically the power board, the zone driver board, or an auxiliary display module. Unlike E0, which covers general UI-to-main board communication, Er22 typically points to a specific inter-board protocol fault logged by the system diagnostics controller.</p>

<h3>Root Causes</h3>
<ul>
<li><strong>Damaged communication bus line</strong> – The serial data line (often SPI or I²C) between the two boards has an open circuit, short, or excessive impedance due to wiring damage or connector failure.</li>
<li><strong>Clock synchronisation failure</strong> – One board\'s oscillator has drifted out of tolerance, causing the two devices to lose timing alignment and fail to decode each other\'s signals.</li>
<li><strong>Firmware mismatch</strong> – After a component replacement with a non-matched board revision, the firmware versions may be incompatible, causing protocol-level communication failure.</li>
<li><strong>Electrostatic discharge (ESD) damage</strong> – If the cooktop was serviced without proper ESD precautions, the communication IC on one board may have been damaged.</li>
</ul>

<h3>Repair Steps</h3>
<ol>
<li><strong>Power cycle the appliance</strong> – Switch the circuit breaker off for 2 minutes (longer than a standard reset) to allow all board capacitors to discharge. Power on and observe whether Er22 clears.</li>
<li><strong>Inspect all inter-board connectors</strong> – Check the data cable connecting the two boards for physical damage, bent pins, or partial disconnection. Reseat both ends firmly.</li>
<li><strong>Verify board compatibility</strong> – If either board was recently replaced, confirm the replacement part number matches the OEM specification for this exact model. Mixing board revisions from different model years can cause Er22.</li>
<li><strong>Replace the communication cable</strong> – If the data cable shows any damage, replace it before condemning a board.</li>
<li><strong>Replace the control board</strong> – If the cable and connectors are good and the boards are confirmed compatible, the main control board is the most likely failed component.</li>
</ol>

<p>Er22 requires a qualified Monogram technician with access to the service manual schematic to correctly identify which specific board-to-board communication path is failing.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-er31',
    'Monogram Cooktop Error Code Er31 – Zone Power Regulation Fault',
    'Er31',
    '<h2>Monogram Cooktop Error Code Er31 – Zone Power Regulation Fault</h2>
<p>The <strong>Er31 error code</strong> on a Monogram cooktop signals a <strong>power regulation fault in one or more cooking zones</strong>. The control system monitors the power output delivered to each zone and compares it against the requested power level. When delivered power deviates significantly from the setpoint — either too high or too low — Er31 is logged and the affected zone is disabled.</p>

<h3>Causes of Er31</h3>
<ul>
<li><strong>Failed power regulation circuit</strong> – The PWM (pulse-width modulation) circuit or power control relay that adjusts heating power has failed, preventing accurate power delivery.</li>
<li><strong>Damaged IGBT or triac</strong> – The switching component that controls power to the zone has failed in a partially-on state, causing unregulated power delivery.</li>
<li><strong>Supply voltage instability</strong> – Fluctuating supply voltage makes it impossible for the control board to regulate zone power accurately, and Er31 is triggered when corrections exceed the control loop\'s range.</li>
<li><strong>Control board calibration drift</strong> – Over many years, the reference voltage or current-sense resistors on the board can drift, causing the board to misread actual power delivery.</li>
<li><strong>Shorted coil or element</strong> – A partially shorted coil draws more power than expected, causing the regulation system to detect an overcurrent at all power settings.</li>
</ul>

<h3>Diagnostic Steps</h3>
<ol>
<li><strong>Check supply voltage stability</strong> – Use a multimeter to monitor supply voltage during cooktop operation. Fluctuations of more than ±5% during cooking indicate a supply problem external to the cooktop.</li>
<li><strong>Test the coil or element resistance</strong> – Disconnect the affected zone\'s heating component and measure resistance. A lower-than-specification reading indicates a shorted coil.</li>
<li><strong>Inspect the power control components</strong> – Have a technician visually inspect the IGBT or triac for burn marks or cracked packages.</li>
<li><strong>Replace the zone driver board or power board</strong> – If the heating component tests good and supply voltage is stable, the power regulation circuit board requires replacement.</li>
</ol>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-er39',
    'Monogram Cooktop Error Code Er39 – Internal Memory / EEPROM Error',
    'Er39',
    '<h2>Monogram Cooktop Error Code Er39 – Internal Memory / EEPROM Error</h2>
<p>The <strong>Er39 error code</strong> on a Monogram cooktop indicates a fault in the <strong>control board\'s non-volatile memory (EEPROM)</strong>. The EEPROM stores calibration data, user settings, cooking profiles, and diagnostic logs. When the board detects a checksum mismatch, failed write operation, or corrupted memory block, Er39 is triggered.</p>

<h3>Why EEPROM Errors Occur</h3>
<ul>
<li><strong>Power interruption during a write cycle</strong> – If power is cut at the exact moment the board is writing configuration data to EEPROM, the memory block may be left in a partially-written, corrupted state.</li>
<li><strong>EEPROM end-of-life wear</strong> – EEPROMs have a finite number of write cycles (typically 100,000–1,000,000). Heavy use over many years can exhaust the write endurance of specific memory cells, causing data corruption.</li>
<li><strong>Voltage spike damage</strong> – A power surge can destroy EEPROM cells by over-stressing the floating-gate transistors that store each bit.</li>
<li><strong>Control board failure</strong> – General control board failure often manifests as EEPROM errors because the board can no longer maintain data integrity across power cycles.</li>
</ul>

<h3>Troubleshooting and Resolution</h3>
<ol>
<li><strong>Perform a factory reset</strong> – Consult the user manual for the factory reset procedure for your specific model. This clears user settings and re-initialises the EEPROM map; it may resolve minor corruption.</li>
<li><strong>Hard power cycle</strong> – Turn off the circuit breaker for 5 minutes to allow full capacitor discharge. This can sometimes allow the EEPROM controller to re-initialise cleanly.</li>
<li><strong>Check power supply quality</strong> – Install a surge protector on the cooktop\'s circuit if one is not already present. Surge damage causing EEPROM corruption will recur without protection.</li>
<li><strong>Replace the control board</strong> – EEPROM that has reached end-of-life wear or has been physically damaged by a surge cannot be repaired in the field. The control board assembly must be replaced. Ensure the replacement board is programmed or flashable with firmware compatible with your cooktop model number.</li>
</ol>

<p>Er39 often causes the cooktop to lose its programmed settings (boost levels, timer defaults, child lock state) even after repair. Reconfigure user settings after board replacement.</p>'
);

brp_insert_cooktop_code(
    'cooktop-error-code-er47',
    'Monogram Cooktop Error Code Er47 – Thermal Management System Fault',
    'Er47',
    '<h2>Monogram Cooktop Error Code Er47 – Thermal Management System Fault</h2>
<p>The <strong>Er47 error code</strong> on a Monogram cooktop indicates a fault in the <strong>thermal management system as a whole</strong>. Rather than pointing to a single zone sensor (as E2–E5 do), Er47 is a system-level error that indicates the cooktop\'s thermal monitoring architecture has detected an inconsistency that cannot be attributed to a single sensor — often involving multiple sensors reading implausibly different values, or the thermal management controller itself failing a self-test.</p>

<h3>Causes of Er47</h3>
<ul>
<li><strong>Multiple sensor drift</strong> – If two or more zone sensors have drifted enough to create contradictory temperature readings, the thermal management controller raises Er47 rather than blaming a single zone.</li>
<li><strong>Thermal management controller chip failure</strong> – The dedicated microcontroller (sometimes integrated into the main board) that aggregates sensor data and manages cooling responses can fail internally.</li>
<li><strong>Cooling system failure during thermal map verification</strong> – At startup, some Monogram models run a brief thermal check. If the cooling fan fails this check, Er47 is raised immediately.</li>
<li><strong>Wiring harness fault affecting multiple sensors simultaneously</strong> – A shared ground wire that has opened, or a shared supply rail that has degraded, will affect multiple sensors and appear as a system-level fault rather than a single-zone fault.</li>
<li><strong>Post-repair calibration requirement</strong> – After replacement of the glass top, coils, or sensors, if the thermal management system is not recalibrated per the service procedure, Er47 can appear because the sensor readings no longer match the expected thermal map for the unit.</li>
</ul>

<h3>Repair Approach</h3>
<ol>
<li><strong>Retrieve the full error log</strong> – Using the service diagnostic mode (described in the service manual), check for any accompanying error codes that may identify the primary fault triggering the system-level Er47.</li>
<li><strong>Inspect the shared wiring harness</strong> – Check the common ground and supply wires shared by multiple sensors. A single damaged ground can cause all connected sensors to read incorrectly.</li>
<li><strong>Test each zone sensor individually</strong> – Disconnect and measure each sensor\'s resistance. Replace any that are out of specification.</li>
<li><strong>Check and recalibrate the cooling system</strong> – Verify fan operation and, if the service manual includes a thermal calibration procedure, perform it after any component replacement.</li>
<li><strong>Replace the control board</strong> – If all sensors and wiring test within specification and Er47 persists, the thermal management controller on the main board has failed and the board must be replaced.</li>
</ol>

<p>Er47 is one of the more complex cooktop error codes. A certified Monogram service technician with access to the full diagnostic mode is strongly recommended for accurate root-cause identification.</p>'
);
