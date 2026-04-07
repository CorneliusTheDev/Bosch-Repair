<?php
/**
 * Import All Appliance Error Code Content
 *
 * Populates Bosch washer, dryer, refrigerator, oven, cooktop, microwave,
 * and freezer error_code posts with full SEO-optimized HTML content.
 *
 * HOW TO USE:
 *   1. Add this line temporarily to functions.php:
 *        add_action('init', function(){ include get_template_directory() . '/inc/import-all-error-content.php'; }, 100);
 *      Remove after running once.
 *   2. OR via WP-CLI:
 *        wp eval-file wp-content/themes/bosch-repair-theme/inc/import-all-error-content.php
 *
 * @package BoschRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) {
    require_once dirname( __FILE__, 5 ) . '/wp-load.php';
}

if ( ! current_user_can( 'manage_options' ) && ! defined( 'WP_CLI' ) ) {
    wp_die( 'Unauthorized.' );
}

$phone     = defined( 'BRP_PHONE' ) ? BRP_PHONE : '(800) 555-0199';
$phone_raw = defined( 'BRP_PHONE_RAW' ) ? BRP_PHONE_RAW : '18005550199';

// ============================================================
// ALL ERROR CODE CONTENT ARRAY
// slug => post_content (HTML)
// ============================================================
$all_content = array();

// ============================================================
// WASHER ERROR CODES
// ============================================================

$all_content['e02-motor-drive-system-failure'] = <<<HTML
<h2>What Does Bosch Washer Error Code E02 Mean?</h2>
<p>The E02 error code on your Bosch washing machine indicates a <strong>motor or drive system failure</strong>. The drive motor is responsible for rotating the drum during wash and spin cycles. When the control board detects the motor is not operating within expected parameters — failing to reach the correct speed, drawing excessive current, or not responding — it triggers the E02 fault and halts the cycle.</p>
<p>This error appears on Bosch 300 Series, 500 Series, and 800 Series front-load washers in the United States. Your washer may stop mid-cycle, refuse to spin, or make unusual grinding or humming noises.</p>

<h2>Common Causes of the E02 Error Code</h2>
<ul>
<li><strong>Worn carbon brushes</strong> &ndash; Carbon brushes that make electrical contact with the motor commutator wear down over time. When they become too short, they lose consistent contact, causing the motor to run erratically or stop.</li>
<li><strong>Defective motor control module</strong> &ndash; The motor control unit (inverter board on newer models) regulates motor speed and direction. A blown component prevents proper motor operation.</li>
<li><strong>Failed drive motor</strong> &ndash; The motor itself can fail due to burned windings, seized bearings, or internal short circuits, especially in machines that have been consistently overloaded.</li>
<li><strong>Wiring harness damage</strong> &ndash; Connectors between the motor and control board can loosen or wires can chafe against other components over time.</li>
<li><strong>Faulty tachometer</strong> &ndash; If the speed sensor mounted on the motor fails, the control board cannot verify motor speed and may trigger E02 even if the motor is physically running.</li>
</ul>

<h2>How to Troubleshoot the E02 Error Code</h2>
<ol>
<li><strong>Reset the washer</strong> &ndash; Unplug for at least 60 seconds, then plug back in and attempt a cycle. A temporary electronic glitch may have caused a false E02.</li>
<li><strong>Check for overloading</strong> &ndash; Remove some items if the drum was heavily loaded. Bosch front-load washers have specific weight limits — exceeding them strains the motor.</li>
<li><strong>Listen for motor sounds</strong> &ndash; Complete silence suggests the motor is not receiving power. Humming without rotation indicates a mechanical obstruction or seized motor.</li>
<li><strong>Inspect for drum obstructions</strong> &ndash; Small items like coins or underwire can wedge between the drum and tub, physically preventing spinning.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The E02 error almost always requires professional repair. Motor, motor control module, and tachometer components are located inside the machine and require partial disassembly to access and test properly. <strong>Contact our Bosch washer repair team</strong> for expert diagnosis using factory-certified Bosch parts backed by our service warranty. Our highly trained technicians will get your Bosch washer running again efficiently and reliably.</p>
HTML;

$all_content['e03-door-lock-failure'] = <<<HTML
<h2>What Does Bosch Washer Error Code E03 Mean?</h2>
<p>The E03 error code on a Bosch washing machine indicates a <strong>door lock mechanism failure</strong>. Every Bosch front-load washer uses an electronic door lock that must engage before a wash cycle can begin. This is a critical safety feature — without a properly locked door, water could leak out and the rapidly spinning drum could cause injury.</p>
<p>When the control board sends a signal to the door lock and does not receive confirmation that the lock has engaged within the expected time, it triggers the E03 error. This code appears on Bosch 300, 500, 800 Series, and Compact washer models in the United States.</p>

<h2>Common Causes of the E03 Error Code</h2>
<ul>
<li><strong>Failed door lock actuator</strong> &ndash; The electronic actuator inside the door lock assembly can burn out over time after thousands of lock-unlock cycles.</li>
<li><strong>Broken door strike</strong> &ndash; The plastic strike plate that the door latch hooks into can crack or break, preventing the lock from engaging fully.</li>
<li><strong>Warped or misaligned door</strong> &ndash; If the door has been pulled or pushed forcefully, it can shift out of alignment so the lock pin cannot reach the sensor.</li>
<li><strong>Debris in the door seal</strong> &ndash; Foreign objects or detergent buildup caught in the door boot seal can prevent the door from closing completely.</li>
<li><strong>Wiring connection issues</strong> &ndash; Loose wires connecting the door lock to the main control board, especially after transport or heavy vibration.</li>
</ul>

<h2>How to Troubleshoot the E03 Error Code</h2>
<ol>
<li><strong>Check the door closure</strong> &ndash; Open and firmly close the washer door, ensuring you hear a solid click. Push on the door to confirm it is fully seated.</li>
<li><strong>Inspect the door seal area</strong> &ndash; Look around the rubber door boot seal for trapped clothing, debris, or buildup preventing full closure.</li>
<li><strong>Examine the door strike</strong> &ndash; Check the plastic hook on the washer frame for cracks, chips, or misalignment.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds, then plug back in and retry.</li>
<li><strong>Listen for the lock attempt</strong> &ndash; When you close the door and press Start, listen for clicking from the door lock area. Silence or repeated clicking without engaging suggests actuator failure.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E03 persists after basic troubleshooting, the door lock assembly likely needs replacement — a repair requiring partial disassembly of the front panel. <strong>Contact our Bosch washer repair team</strong> for reliable diagnosis and repair using factory-certified parts and our service warranty.</p>
HTML;

$all_content['e04-water-leak-detected'] = <<<HTML
<h2>What Does Bosch Washer Error Code E04 Mean?</h2>
<p>The E04 error code on a Bosch washing machine indicates that the <strong>AquaStop flood protection system has detected a water leak</strong>. Bosch front-load washers include the AquaStop system, which uses a float switch in the machine's base pan to detect escaped water. When the float switch triggers, the control board stops the wash cycle, shuts off the water inlet valve, and activates the drain pump.</p>
<p>The E04 code means something in the washer's water system has failed and needs repair before the machine can be safely used again.</p>

<h2>Common Causes of the E04 Error Code</h2>
<ul>
<li><strong>Damaged door boot seal</strong> &ndash; Tears, cracks, or holes from foreign objects (coins, zippers, underwire) in the rubber door gasket allow water to leak down the front and into the base pan.</li>
<li><strong>Loose or cracked internal hoses</strong> &ndash; Hoses connecting the tub to the drain pump and circulation pump can loosen at clamp connections or crack from age and heat cycling.</li>
<li><strong>Leaking detergent dispenser</strong> &ndash; The dispenser housing or its connecting hose can develop leaks from detergent buildup and corrosion.</li>
<li><strong>Faulty water inlet valve</strong> &ndash; A valve that fails to shut off completely causes slow dripping that gradually fills the base pan.</li>
<li><strong>Drain pump seal failure</strong> &ndash; The pump shaft seal can wear out, allowing water to seep into the base pan.</li>
</ul>

<h2>How to Troubleshoot the E04 Error Code</h2>
<ol>
<li><strong>Turn off the water supply</strong> &ndash; Close the hot and cold water supply valves behind the washer immediately.</li>
<li><strong>Unplug the washer</strong> &ndash; Disconnect power for safety before investigating the leak source.</li>
<li><strong>Check the floor around the washer</strong> &ndash; Look for visible water and note where it appears to originate — front, back, or underneath.</li>
<li><strong>Inspect the door seal</strong> &ndash; Carefully examine the entire rubber boot seal for tears, punctures, or areas where the seal has separated.</li>
<li><strong>Check hose connections at the back</strong> &ndash; Inspect fill hoses at the connection points and check the drain hose for visible damage.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The E04 error requires identifying and repairing the exact leak source — internal leaks from hoses, the tub, or the pump require machine disassembly. <strong>Contact our Bosch washer repair team</strong> for thorough leak diagnosis and repair with factory-certified Bosch parts.</p>
HTML;

$all_content['e13-drain-time-exceeded'] = <<<HTML
<h2>What Does Bosch Washer Error Code E13 Mean?</h2>
<p>The E13 error code on a Bosch washing machine indicates that the <strong>drain cycle has exceeded the maximum allowed time</strong>. When the control board activates the drain pump and monitors the water level sensor, it expects the water to drop to the correct level within approximately 5-8 minutes. If drainage does not occur within this window, E13 is triggered.</p>
<p>When E13 appears, you will find standing water remaining in the wash tub and the washer stopped. This is one of the most frequently encountered Bosch washer error codes, and many of its common causes can be resolved without professional help.</p>

<h2>Common Causes of the E13 Error Code</h2>
<ul>
<li><strong>Clogged drain pump filter</strong> &ndash; The debris filter (coin trap) at the bottom front of the machine catches coins, buttons, hair ties, and lint. When heavily clogged, water cannot flow through the pump efficiently.</li>
<li><strong>Blocked drain hose</strong> &ndash; The drain hose can become kinked, crushed, or internally clogged with lint and debris over time.</li>
<li><strong>Drain pump failure</strong> &ndash; A weak or worn pump may move some water but not fast enough to satisfy the drain time requirement.</li>
<li><strong>Foreign object in the pump</strong> &ndash; Small items that bypass the filter can lodge in the pump impeller and prevent it from spinning freely.</li>
<li><strong>Excess suds</strong> &ndash; Using too much or non-HE detergent creates excessive suds that the drain pump struggles to clear efficiently.</li>
</ul>

<h2>How to Troubleshoot the E13 Error Code</h2>
<ol>
<li><strong>Clean the drain pump filter</strong> &ndash; Locate the small access panel at the lower front. Place towels and a shallow pan beneath it. Slowly unscrew the filter cap — water will flow out. Remove the filter and clean all debris, lint, and trapped items.</li>
<li><strong>Check the drain hose</strong> &ndash; Ensure the drain hose is not kinked and is inserted only 6-8 inches into the standpipe. Disconnect and check for internal blockages.</li>
<li><strong>Use HE detergent</strong> &ndash; Switch to an HE-formulated product if using regular detergent. Bosch front-loaders require HE detergent.</li>
<li><strong>Reset and test</strong> &ndash; After cleaning, run a Drain &amp; Spin cycle to test drainage.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E13 persists after cleaning the filter and checking the drain hose, the drain pump may need replacement. <strong>Contact our Bosch washer repair team</strong> for professional diagnosis and repair with factory-certified parts.</p>
HTML;

$all_content['e18-drain-pump-failure'] = <<<HTML
<h2>What Does Bosch Washer Error Code E18 Mean?</h2>
<p>The E18 error code on a Bosch washing machine indicates a <strong>drain pump failure or critical drainage obstruction</strong>. While E13 signals drainage taking too long, E18 is more severe — indicating complete pump malfunction or no drainage at all. When E18 appears, the washer stops immediately and you will find the drum full of water. The door lock remains engaged to prevent flooding your laundry area.</p>

<h2>Common Causes of the E18 Error Code</h2>
<ul>
<li><strong>Severely clogged drain pump filter</strong> &ndash; So clogged with lint, coins, and debris that virtually no water can pass through. This is the single most common cause of E18.</li>
<li><strong>Failed drain pump motor</strong> &ndash; The pump motor can burn out, especially after prolonged operation against a blockage. You may smell burning from the bottom of the washer.</li>
<li><strong>Impeller damage</strong> &ndash; A broken pump impeller cannot move water even though the motor is running.</li>
<li><strong>Foreign object jamming the pump</strong> &ndash; Coins, screws, or underwires wedged between the impeller and pump housing completely stop rotation.</li>
<li><strong>Wiring failure</strong> &ndash; A broken wire or corroded connector prevents the pump from receiving power.</li>
</ul>

<h2>How to Troubleshoot the E18 Error Code</h2>
<ol>
<li><strong>Emergency drain procedure</strong> &ndash; Find the small access panel at the lower front. Pull out the emergency drain tube (a thin black tube next to the filter cap). Remove the cap and let water drain into a pan. Empty and repeat.</li>
<li><strong>Clean the drain pump filter</strong> &ndash; Once drained, unscrew the filter cap and remove all debris.</li>
<li><strong>Check pump impeller rotation</strong> &ndash; With the filter removed, reach into the pump cavity and try to rotate the impeller. It should spin freely. If stuck or gritty, there may be debris or damage inside the pump.</li>
<li><strong>Run a test cycle</strong> &ndash; After clearing blockages, reinstall the filter and run a Drain &amp; Spin cycle.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E18 returns after clearing the filter, the drain pump assembly likely needs replacement. <strong>Contact our Bosch washer repair team</strong> for fast, reliable drain pump repair using factory-certified Bosch parts.</p>
HTML;

$all_content['e17-water-fill-time-exceeded'] = <<<HTML
<h2>What Does Bosch Washer Error Code E17 Mean?</h2>
<p>The E17 error code on a Bosch washing machine means the <strong>water fill cycle has exceeded the maximum allowed time</strong>. When a wash cycle starts, the control board opens the water inlet valve and monitors the water level sensor. If the water does not reach the required level within approximately 5-10 minutes, the control board triggers E17.</p>

<h2>Common Causes of the E17 Error Code</h2>
<ul>
<li><strong>Closed water supply valves</strong> &ndash; The hot and cold water shut-off valves behind the washer may have been accidentally turned off. This is the most common and simplest cause.</li>
<li><strong>Kinked or crushed fill hoses</strong> &ndash; Fill hoses can kink if the washer is pushed too close to the wall.</li>
<li><strong>Clogged inlet screens</strong> &ndash; Mesh screens inside the water inlet valve filter sediment. Over time, mineral deposits and rust can clog these screens and drastically reduce water flow.</li>
<li><strong>Faulty water inlet valve</strong> &ndash; The solenoid-operated inlet valve can fail electrically or mechanically, preventing water from entering the machine.</li>
<li><strong>Low household water pressure</strong> &ndash; Bosch washers require a minimum of about 20 PSI. Low pressure from a failing well pump or simultaneous use of multiple fixtures may prevent proper filling.</li>
<li><strong>AquaStop hose activation</strong> &ndash; The AquaStop fill hose has a built-in shut-off valve that closes permanently if it detects a leak. A red indicator window confirms this.</li>
</ul>

<h2>How to Troubleshoot the E17 Error Code</h2>
<ol>
<li><strong>Check water supply valves</strong> &ndash; Verify both hot and cold valves are fully open (turn counterclockwise).</li>
<li><strong>Inspect fill hoses</strong> &ndash; Check that hoses are not kinked or crushed between the washer and wall.</li>
<li><strong>Clean inlet screens</strong> &ndash; Turn off water supply, disconnect fill hoses, and clean the mesh screens inside the valve ports.</li>
<li><strong>Check AquaStop hose indicator</strong> &ndash; A red window means the safety valve has tripped and the entire hose assembly must be replaced.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds and restart.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E17 persists after checking supply valves, hoses, and screens, the water inlet valve likely needs replacement. <strong>Contact our Bosch washer repair team</strong> for expert repair using factory-certified Bosch parts.</p>
HTML;

$all_content['e32-unbalanced-load-detected'] = <<<HTML
<h2>What Does Bosch Washer Error Code E32 Mean?</h2>
<p>The E32 error code on a Bosch washing machine indicates that an <strong>unbalanced load has been detected</strong> during the spin cycle. Bosch front-load washers use vibration sensors and accelerometers that monitor drum balance during spin-up. When an imbalance is detected, the control board reduces spin speed or stops entirely to protect the drum bearings, suspension springs, shock absorbers, and the outer cabinet.</p>
<p>The E32 code is common and typically the easiest to resolve because it is usually caused by how laundry was loaded rather than a mechanical fault.</p>

<h2>Common Causes of the E32 Error Code</h2>
<ul>
<li><strong>Single heavy item</strong> &ndash; Washing a single bath towel, blanket, or pair of jeans creates a load that cannot distribute evenly around the drum.</li>
<li><strong>Mixed weight items</strong> &ndash; Very heavy and very light items together cause heavy items to clump on one side.</li>
<li><strong>Overloading or underloading</strong> &ndash; A too-full drum prevents free movement; a too-empty drum (one or two items) can also cause imbalance.</li>
<li><strong>Tangled items</strong> &ndash; Sheets or duvet covers wrapping around each other form a heavy ball on one side.</li>
<li><strong>Worn shock absorbers</strong> &ndash; Worn dampers reduce the machine's ability to absorb vibration, making even slight imbalances problematic.</li>
<li><strong>Washer not level</strong> &ndash; A washer not sitting level on the floor has a lower imbalance tolerance.</li>
</ul>

<h2>How to Troubleshoot the E32 Error Code</h2>
<ol>
<li><strong>Pause and redistribute</strong> &ndash; Open the door and redistribute laundry evenly around the drum. Break up tangled clumps. Close the door and restart the spin.</li>
<li><strong>Add or remove items</strong> &ndash; If washing a single heavy item, add a few towels. If overstuffed, remove some items.</li>
<li><strong>Check washer leveling</strong> &ndash; Place a bubble level on top and adjust the front feet until level in both directions. Ensure all four feet are firmly on the floor.</li>
<li><strong>Listen for unusual noise</strong> &ndash; Loud banging during spin with a balanced load may indicate worn shock absorbers.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E32 keeps appearing despite proper loading and level placement, the suspension system may need inspection. <strong>Contact our Bosch washer repair team</strong> for a thorough mechanical inspection and repair.</p>
HTML;

$all_content['f16-door-not-closed-properly'] = <<<HTML
<h2>What Does Bosch Washer Error Code F16 Mean?</h2>
<p>The F16 error code on a Bosch washing machine means the <strong>door is not closed properly or the door switch is not detecting closure</strong>. This is one of the most straightforward and commonly encountered washer error codes. When you press Start, the control board first checks the door switch. If it indicates "door open," F16 appears immediately and the cycle does not begin.</p>

<h2>Common Causes of the F16 Error Code</h2>
<ul>
<li><strong>Door not fully closed</strong> &ndash; The most common cause — the door appears closed but hasn't fully engaged the latch.</li>
<li><strong>Clothing caught in the door seal</strong> &ndash; A piece of fabric caught between the door glass and rubber boot seal prevents full closure.</li>
<li><strong>Faulty door switch</strong> &ndash; The electrical micro-switch that detects door closure can fail after years of use, its contacts corroding or sticking in the "open" position.</li>
<li><strong>Broken door handle or latch</strong> &ndash; A cracked or broken handle or latch mechanism prevents the door from engaging the frame.</li>
<li><strong>Swollen or displaced door seal</strong> &ndash; The boot seal can swell, shrink, or shift out of its groove, creating interference preventing full closure.</li>
</ul>

<h2>How to Troubleshoot the F16 Error Code</h2>
<ol>
<li><strong>Close the door firmly</strong> &ndash; Open fully and close with a firm, controlled push until you hear a solid click.</li>
<li><strong>Check for trapped items</strong> &ndash; Look around the entire perimeter of the rubber seal for fabric, tags, or small items.</li>
<li><strong>Inspect the door latch and handle</strong> &ndash; Look for cracks, broken pieces, or misalignment in the handle and latch hook.</li>
<li><strong>Clean the door seal</strong> &ndash; Wipe the boot seal with a damp cloth to remove detergent residue or mildew preventing closure.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds and try again. The door switch may have a temporary electronic fault.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If F16 persists with the door firmly closed, the door switch or latch assembly needs replacement. <strong>Contact our Bosch washer repair team</strong> for quick door switch diagnosis and replacement using factory-certified Bosch parts.</p>
HTML;

$all_content['f23-aquastop-system-activated'] = <<<HTML
<h2>What Does Bosch Washer Error Code F23 Mean?</h2>
<p>The F23 error code on a Bosch washing machine indicates that the <strong>AquaStop flood protection system has been activated</strong>. This is the F-series equivalent of the E23/E04 AquaStop errors. The AquaStop system is Bosch's multi-layer leak protection technology — F23 means water has been detected in the base pan underneath the wash tub, where it should never be.</p>
<p>When F23 activates, the washer immediately stops, closes the water inlet valve, and engages the drain pump to minimize water damage to your home.</p>

<h2>Common Causes of the F23 Error Code</h2>
<ul>
<li><strong>Door boot seal deterioration</strong> &ndash; The most common leak source. Tears, punctures from zippers or coins, or age-related cracking allows water to escape with each cycle.</li>
<li><strong>Internal hose connection failure</strong> &ndash; Hoses inside the washer (tub to pump, dispenser to tub, inlet valve to dispenser) can develop leaks at clamp connections or through material degradation.</li>
<li><strong>Drain pump seal wear</strong> &ndash; The mechanical seal around the drain pump shaft wears over time, allowing slow but steady dripping that accumulates in the base pan.</li>
<li><strong>Cracked tub</strong> &ndash; The outer plastic tub can develop stress cracks, particularly near the bearing mount.</li>
<li><strong>Dispenser housing leak</strong> &ndash; Cracks in the dispenser housing or its connecting hose from hardened detergent buildup.</li>
</ul>

<h2>How to Troubleshoot the F23 Error Code</h2>
<ol>
<li><strong>Shut off water supply</strong> &ndash; Close both hot and cold water valves behind the washer immediately.</li>
<li><strong>Unplug the washer</strong> &ndash; Disconnect power for safety before investigation.</li>
<li><strong>Check the door seal</strong> &ndash; Carefully inspect the entire rubber boot seal for tears, holes, or separation from the tub or door frame.</li>
<li><strong>Check external connections</strong> &ndash; Inspect fill hoses and drain hose for drips, loose connections, or visible damage.</li>
<li><strong>Allow drying time</strong> &ndash; After addressing the visible issue, allow the base pan to dry for several hours. The float switch will not reset while water remains in the pan.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The F23 error requires finding and repairing the specific internal leak source, which often involves replacing seals, hoses, or the door boot gasket. <strong>Contact our Bosch washer repair team</strong> for professional leak diagnosis and repair. Our technicians use factory-certified Bosch parts and can often complete leak repairs in a single service visit.</p>
HTML;

// ============================================================
// DRYER ERROR CODES
// ============================================================

$all_content['e01-dryer-heating-element-failure'] = <<<HTML
<h2>What Does Bosch Dryer Error Code E01 Mean?</h2>
<p>The E01 error code on a Bosch dryer indicates a <strong>heating element or heater circuit failure</strong>. The heating element generates the hot air that dries your clothes. When the control board detects that the heating element is not drawing current, is drawing too much current, or is not producing the expected temperature rise, it triggers E01 and stops the drying cycle.</p>
<p>This error is found on Bosch condensation and heat pump dryers sold in the United States. The drum may still tumble if you select an air-dry (no heat) cycle, which helps confirm the issue is specific to the heating system.</p>

<h2>Common Causes of the E01 Error Code</h2>
<ul>
<li><strong>Burned-out heating element</strong> &ndash; The element wire or coil can break after years of use. When broken, the circuit is open and no heat is produced.</li>
<li><strong>Blown thermal fuse</strong> &ndash; Thermal fuses blow permanently if the dryer overheats. They do not reset and must be replaced.</li>
<li><strong>Defective high-limit thermostat</strong> &ndash; A failed thermostat can cut power to the element prematurely or prevent it from receiving power at all.</li>
<li><strong>Heater relay failure on the control board</strong> &ndash; The relay that switches power to the heating element can fail, preventing the element from being energized.</li>
<li><strong>Restricted airflow causing overheating</strong> &ndash; Clogged lint filters, blocked condenser units, or restricted ducting cause overheating that blows the thermal fuse.</li>
</ul>

<h2>How to Troubleshoot the E01 Error Code</h2>
<ol>
<li><strong>Clean the lint filter</strong> &ndash; Remove and thoroughly clean the lint filter. On condensation dryers, also clean the condenser unit by rinsing it under running water.</li>
<li><strong>Check for airflow restrictions</strong> &ndash; Ensure nothing is blocking the air intake vents on the dryer.</li>
<li><strong>Reset the dryer</strong> &ndash; Turn off the circuit breaker for at least 60 seconds, then turn it back on.</li>
<li><strong>Test with an air-dry cycle</strong> &ndash; Run a no-heat cycle to confirm the drum still tumbles, isolating the issue to the heating circuit.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Heating element, thermal fuse, and thermostat components are located deep inside the dryer and require disassembly to access. Working with 240V circuits is dangerous without proper training. <strong>Contact our Bosch dryer repair team</strong> for safe, professional heating system repair using factory-certified Bosch parts.</p>
HTML;

$all_content['e05-lint-filter-blocked'] = <<<HTML
<h2>What Does Bosch Dryer Error Code E05 Mean?</h2>
<p>The E05 error code on a Bosch dryer indicates that the <strong>lint filter is blocked or that airflow through the dryer is severely restricted</strong>. Bosch dryers are equipped with airflow sensors that monitor resistance to air movement through the lint filter and ducting system. When airflow drops below the minimum acceptable level, E05 is triggered.</p>
<p>Proper airflow is essential for efficient and safe dryer operation. Any restriction reduces drying efficiency, increases energy consumption, extends cycle times, and can cause overheating that damages your clothes and the dryer's components. The E05 is a helpful alert that a maintenance issue needs addressing before it becomes a more serious problem.</p>

<h2>Common Causes of the E05 Error Code</h2>
<ul>
<li><strong>Heavily clogged lint filter</strong> &ndash; The most common cause by far. An inadequately cleaned filter significantly restricts airflow.</li>
<li><strong>Lint buildup in the filter housing</strong> &ndash; Fine lint particles accumulate in the filter housing slot and ductwork beyond the filter over time.</li>
<li><strong>Clogged condenser</strong> &ndash; On condensation dryers, lint that passes through the primary filter accumulates on the condenser fins, restricting airflow.</li>
<li><strong>Dryer sheet residue on filter</strong> &ndash; Fabric softener sheets leave an invisible waxy residue on the filter mesh that blocks airflow even with no visible lint.</li>
<li><strong>Blocked exhaust vent</strong> &ndash; On vented models, a clogged or crushed exterior vent duct restricts exhaust air.</li>
</ul>

<h2>How to Troubleshoot the E05 Error Code</h2>
<ol>
<li><strong>Clean the lint filter</strong> &ndash; Remove and peel off all lint. Then wash the filter in warm soapy water with a soft brush to remove invisible dryer sheet residue. Allow to dry completely before reinstalling.</li>
<li><strong>Vacuum the filter housing</strong> &ndash; Use a vacuum with a narrow attachment to clean lint from inside the filter slot.</li>
<li><strong>Clean the condenser</strong> &ndash; Remove the condenser from behind the access panel. Rinse under running water from both sides until lint is removed. Let dry before reinstalling.</li>
<li><strong>Reset and test</strong> &ndash; Turn off the circuit breaker for 30 seconds, then restart the dryer with a small load.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E05 persists after thorough cleaning, the airflow sensor itself may be faulty or there may be a deep internal lint blockage. <strong>Contact our Bosch dryer repair team</strong> for professional duct cleaning and sensor inspection using factory-certified parts.</p>
HTML;

$all_content['e07-condenser-unit-needs-cleaning'] = <<<HTML
<h2>What Does Bosch Dryer Error Code E07 Mean?</h2>
<p>The E07 error code on a Bosch dryer indicates that the <strong>condenser unit requires cleaning</strong>. This error is specific to Bosch condensation (ventless) and heat pump dryers. The condenser is a heat exchanger that cools warm, moist air from the drum, causing moisture to condense into water that is collected and pumped away. Over time, fine lint particles accumulate on the condenser's fins, reducing efficiency.</p>
<p>Bosch monitors condenser performance through temperature and humidity sensors. When the condenser becomes sufficiently blocked, E07 is triggered. An ignored E07 leads to longer drying times, higher energy consumption, potential overheating, and eventually more serious fault codes.</p>

<h2>Common Causes of the E07 Error Code</h2>
<ul>
<li><strong>Normal lint accumulation</strong> &ndash; Even with regular lint filter cleaning, fine lint particles collect on the condenser fins over many drying cycles. This is normal and expected.</li>
<li><strong>Infrequent condenser cleaning</strong> &ndash; Bosch recommends cleaning the condenser every 1-3 months. Many owners are unaware of this maintenance requirement.</li>
<li><strong>Fabric softener residue</strong> &ndash; Dryer sheets leave a waxy residue on the filter that allows more fine particles to pass through to the condenser.</li>
<li><strong>Pet hair</strong> &ndash; Households with pets generate significantly more fine fiber material that accelerates condenser fouling.</li>
</ul>

<h2>How to Clean the Condenser and Clear E07</h2>
<ol>
<li><strong>Locate the condenser</strong> &ndash; The condenser access panel is at the bottom front of the dryer. Release the clips or screws and remove the panel.</li>
<li><strong>Remove the condenser</strong> &ndash; Slide the condenser out after releasing retaining clips. Water may drip from it.</li>
<li><strong>Clean thoroughly</strong> &ndash; Rinse under running water from both sides until all lint is removed. For stubborn buildup, soak in warm water for 10-15 minutes before rinsing.</li>
<li><strong>Clean the condenser housing</strong> &ndash; Vacuum lint from the housing cavity inside the dryer.</li>
<li><strong>Dry and reinstall</strong> &ndash; Shake excess water off, let air-dry 15-20 minutes, then reinstall and secure the retaining clips.</li>
<li><strong>Reset</strong> &ndash; Turn off the circuit breaker for 30 seconds, then restart.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E07 persists after thorough condenser cleaning, the condenser performance sensor may be faulty. <strong>Contact our Bosch dryer repair team</strong> for sensor testing and replacement using factory-certified parts.</p>
HTML;

$all_content['d02-water-tank-full'] = <<<HTML
<h2>What Does Bosch Dryer Error Code d02 Mean?</h2>
<p>The d02 error code on a Bosch dryer means the <strong>water collection tank is full and must be emptied</strong>. This code is specific to Bosch condensation (ventless) dryers. Instead of venting moist air outdoors, these dryers extract moisture from clothes and collect it as liquid water in a removable tank at the top of the dryer.</p>
<p>When the water level reaches maximum capacity, a float switch triggers d02, and the dryer pauses the cycle until the tank is emptied. This is a <strong>normal maintenance alert — not a malfunction</strong>. The d02 will appear regularly during normal operation, especially when drying large or very wet loads.</p>

<h2>Why d02 Appears Frequently</h2>
<p>The frequency of d02 depends on several factors:</p>
<ul>
<li>The size of the load being dried</li>
<li>How wet the clothes are when they enter the dryer</li>
<li>The selected drying program (higher temperature programs extract more moisture)</li>
<li>Whether the dryer is connected to an external drain (which eliminates manual emptying)</li>
</ul>
<p>A full load of wet laundry can produce 2-3 liters of water, and the collection tank has a finite capacity. Running back-to-back cycles without emptying the tank will reliably trigger d02.</p>

<h2>How to Resolve the d02 Code</h2>
<ol>
<li><strong>Empty the water tank</strong> &ndash; Pull out the water collection tank from the top of the dryer, pour out the water, and reinsert the tank firmly until it clicks into place.</li>
<li><strong>Verify the tank is properly seated</strong> &ndash; Push the tank all the way in. If not properly seated, the fill tube may not align correctly.</li>
<li><strong>Check the external drain hose</strong> &ndash; If your dryer is plumbed to an external drain, inspect the hose for kinks or clogs. The hose should slope downward from the dryer to the drain.</li>
<li><strong>Resume the cycle</strong> &ndash; After emptying the tank, close the dryer door and press Start to resume drying.</li>
</ol>

<h2>Connect to a Permanent Drain</h2>
<p>If you find the d02 reminder inconvenient, consider connecting your Bosch dryer to a permanent drain outlet. Most Bosch condensation dryers include a drain hose connection option that automatically empties condensed water, eliminating the need to manually empty the tank.</p>

<h2>When to Call a Professional</h2>
<p>If d02 appears with an empty tank or immediately after emptying, the float switch or condenser pump may need service. <strong>Contact our Bosch dryer repair team</strong> for diagnosis using factory-certified Bosch parts.</p>
HTML;

// ============================================================
// REFRIGERATOR ERROR CODES
// ============================================================

$all_content['e03-defrost-system-malfunction'] = <<<HTML
<h2>What Does Bosch Refrigerator Error Code E03 Mean?</h2>
<p>The E03 error code on a Bosch refrigerator indicates a <strong>defrost system malfunction</strong>. Modern Bosch refrigerators use an automatic defrost system that periodically melts frost from the evaporator coils. The E03 error appears when the control board detects that the defrost system is not functioning properly — the defrost heater may not be activating, defrost may be taking too long, or the evaporator temperature is not rising as expected.</p>
<p>A malfunctioning defrost system creates a chain reaction: frost accumulates on the evaporator coils, the frost insulates the coils from the air, cooling efficiency decreases, the compressor runs longer trying to compensate, and food temperatures rise to unsafe levels.</p>

<h2>Common Causes of the E03 Error Code</h2>
<ul>
<li><strong>Burned-out defrost heater</strong> &ndash; The defrost heater near the evaporator coils can burn through and open-circuit, preventing it from generating heat during defrost cycles. This is the most common cause.</li>
<li><strong>Failed defrost thermostat (bi-metal)</strong> &ndash; The defrost termination thermostat cuts the heater when the coils are clear. If it fails open, it permanently breaks the heater circuit.</li>
<li><strong>Defrost timer or control board fault</strong> &ndash; A mechanical timer that sticks, or a control board malfunction, can prevent the defrost cycle from initiating.</li>
<li><strong>Wiring damage</strong> &ndash; Wiring to the defrost heater, thermostat, and sensors can be damaged by repeated freezing, thawing, and ice buildup.</li>
<li><strong>Blocked defrost drain</strong> &ndash; While not a direct component failure, a blocked drain causes meltwater to refreeze, making it appear as though defrost is not working.</li>
</ul>

<h2>How to Troubleshoot the E03 Error Code</h2>
<ol>
<li><strong>Check for frost buildup</strong> &ndash; Open the freezer and look at the back wall vents. Heavy frost blocking these vents confirms the defrost system is not working.</li>
<li><strong>Manual defrost</strong> &ndash; Unplug the refrigerator and leave both doors open for 12-24 hours until completely defrosted. Place towels to collect meltwater.</li>
<li><strong>Clear the defrost drain</strong> &ndash; While defrosted, flush the drain hole at the bottom of the freezer compartment with warm water.</li>
<li><strong>Monitor after restart</strong> &ndash; If frost returns rapidly within a few days, the defrost heater or thermostat has failed and is not clearing frost during automatic cycles.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The defrost heater, thermostat, and sensor are behind the rear panel inside the freezer compartment and require disassembly to access and test. <strong>Contact our Bosch refrigerator repair team</strong> for professional defrost system diagnosis and repair using factory-certified Bosch parts.</p>
HTML;

$all_content['e05-compressor-overload-start-failure'] = <<<HTML
<h2>What Does Bosch Refrigerator Error Code E05 Mean?</h2>
<p>The E05 error code on a Bosch refrigerator indicates a <strong>compressor overload or start failure</strong>. The compressor is the motor-pump unit at the heart of the refrigeration system — it compresses refrigerant and circulates it to remove heat from inside the refrigerator. When the compressor cannot start, repeatedly trips its overload protector, or draws excessive current, the control board triggers E05.</p>
<p>This is one of the most serious error codes on a Bosch refrigerator. Without a functioning compressor, the refrigerator cannot cool at all, and food safety becomes an immediate concern.</p>

<h2>Common Causes of the E05 Error Code</h2>
<ul>
<li><strong>Failed compressor start relay</strong> &ndash; The start relay provides the electrical boost needed to get the compressor motor running. A failed relay prevents starting. This is one of the most common and least expensive causes of E05.</li>
<li><strong>Failed run capacitor</strong> &ndash; A failed capacitor can prevent the compressor from starting or cause it to overheat and trip the overload.</li>
<li><strong>Dirty condenser coils</strong> &ndash; Dust-clogged condenser coils prevent heat dissipation, causing the compressor to work harder and overheat.</li>
<li><strong>Compressor motor failure</strong> &ndash; Internal winding failure requires compressor replacement — the most costly repair on a refrigerator.</li>
<li><strong>Sealed system refrigerant leak</strong> &ndash; Low refrigerant causes the compressor to run without building pressure, drawing excessive current trying to compensate.</li>
</ul>

<h2>How to Troubleshoot the E05 Error Code</h2>
<ol>
<li><strong>Listen for clicking</strong> &ndash; A repeating click-hum-click pattern every 2-5 minutes is the compressor trying to start and tripping the overload. This confirms the compressor is receiving power but cannot run.</li>
<li><strong>Clean the condenser coils</strong> &ndash; Locate the coils (behind the kick plate at the bottom front, or at the back) and vacuum them thoroughly with a brush attachment.</li>
<li><strong>Check ventilation</strong> &ndash; Ensure the refrigerator has adequate clearance for air circulation on all sides.</li>
<li><strong>Reset the refrigerator</strong> &ndash; Unplug for 10-15 minutes, allowing the compressor to equalize internal pressures and the overload protector to cool completely.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Start relay and capacitor replacement are relatively simple. Compressor replacement and sealed system work require EPA-certified technicians. <strong>Contact our Bosch refrigerator repair team</strong> for professional compressor system diagnosis and repair using factory-certified Bosch parts.</p>
HTML;

$all_content['e07-ice-maker-fault'] = <<<HTML
<h2>What Does Bosch Refrigerator Error Code E07 Mean?</h2>
<p>The E07 error code on a Bosch refrigerator indicates an <strong>ice maker system fault</strong>. This error is specific to Bosch refrigerator models equipped with an automatic ice maker, which includes many 500 Series, 800 Series, and Benchmark models in the United States. The ice maker system involves a water inlet valve, fill tube, mold heater, thermostat, motor-driven ejector mechanism, and ice level sensor — and E07 can be triggered by failures in any of these components.</p>

<h2>Common Causes of the E07 Error Code</h2>
<ul>
<li><strong>No water supply</strong> &ndash; If the water supply valve behind the refrigerator is closed or the line is kinked, the ice maker cannot fill.</li>
<li><strong>Frozen fill tube</strong> &ndash; The small tube delivering water to the ice maker mold can freeze solid, especially if the freezer is set too cold or water drips slowly between fill cycles.</li>
<li><strong>Failed water inlet valve</strong> &ndash; The solenoid-operated valve can fail electrically or mechanically, preventing water from reaching the ice maker.</li>
<li><strong>Ice maker module failure</strong> &ndash; The motorized assembly that fills, freezes, harvests, and ejects ice can fail due to a burned-out motor, broken ejector arm, or faulty thermostat.</li>
<li><strong>Freezer temperature too warm</strong> &ndash; If the freezer is above 5°F (-15°C), the ice maker cannot freeze water in the expected time frame.</li>
<li><strong>Jammed ice bucket</strong> &ndash; Ice clumps or an overfull bucket can jam the ejection mechanism.</li>
</ul>

<h2>How to Troubleshoot the E07 Error Code</h2>
<ol>
<li><strong>Check the water supply</strong> &ndash; Verify the water supply valve behind the refrigerator is fully open and there are no kinks in the water line.</li>
<li><strong>Inspect the fill tube</strong> &ndash; If the tube appears frosted over, carefully thaw with a hair dryer on low heat.</li>
<li><strong>Check the freezer temperature</strong> &ndash; Use a thermometer to verify the freezer is at 0°F (-18°C). Address any cooling issues first.</li>
<li><strong>Empty and inspect the ice bucket</strong> &ndash; Remove the bucket and break up any clumped ice. Check for jams in the ejection mechanism.</li>
<li><strong>Toggle the ice maker off and on</strong> &ndash; Turn it off, wait 30 seconds, then back on to force a restart of the cycle.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the ice maker doesn't resume production after these steps, the module, water inlet valve, or associated wiring may need replacement. <strong>Contact our Bosch refrigerator repair team</strong> for professional ice maker repair using factory-certified Bosch parts.</p>
HTML;

// ============================================================
// OVEN ERROR CODES
// ============================================================

$all_content['e001-oven-temp-sensor-open'] = <<<HTML
<h2>What Does Bosch Oven Error Code E001 Mean?</h2>
<p>The E001 error code on a Bosch oven or range indicates that the <strong>oven cavity temperature sensor has an open circuit</strong>. The temperature sensor (resistance temperature detector / RTD probe) is a long, thin metal probe extending into the oven cavity from the top rear wall. It measures internal temperature and reports it to the control board, which uses this reading to regulate heating elements and maintain the set temperature.</p>
<p>An open circuit means the electrical path through the sensor has been broken — the control board sends current but receives no return signal. Without temperature feedback, the oven cannot safely regulate heating, so it shuts down and displays E001. This error prevents the oven from operating in any mode (bake, broil, convection, self-clean).</p>

<h2>Common Causes of the E001 Error Code</h2>
<ul>
<li><strong>Failed RTD sensor</strong> &ndash; The platinum resistance wire inside the probe can break due to thermal fatigue after years of heating and cooling cycles.</li>
<li><strong>Disconnected sensor connector</strong> &ndash; The connector at the back of the oven can work loose, especially after service or moving.</li>
<li><strong>Damaged sensor wiring</strong> &ndash; Wires routing near the broil element or pinched during installation can be damaged by extreme heat.</li>
<li><strong>Corroded connector pins</strong> &ndash; Heat and humidity over years of use can corrode the connector pins, eventually creating an open circuit.</li>
<li><strong>Physical sensor probe damage</strong> &ndash; The metal probe can be bent or broken if struck by heavy cookware or oven racks.</li>
</ul>

<h2>How to Troubleshoot the E001 Error Code</h2>
<ol>
<li><strong>Reset the oven</strong> &ndash; Turn off the circuit breaker for at least 60 seconds. Restore power and check if E001 returns immediately.</li>
<li><strong>Inspect the sensor probe</strong> &ndash; Open the oven door and locate the temperature sensor probe (a thin metal rod extending from the rear wall). Check for visible damage — bends, cracks, or discoloration.</li>
<li><strong>Check the sensor mounting</strong> &ndash; Ensure the sensor is securely mounted to the oven wall. A loosened mounting screw can allow the sensor to shift and partially pull its connector loose.</li>
<li><strong>Wiggle test</strong> &ndash; With the oven unplugged, gently wiggle the sensor probe. Intermittent E001 that appears and disappears likely points to a loose connection.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The E001 error almost always requires sensor replacement. Accessing the connector often requires removing the oven from its cabinet or the rear panel. <strong>Contact our Bosch oven repair team</strong> for quick, professional temperature sensor replacement using factory-certified Bosch parts.</p>
HTML;

$all_content['e010-oven-overheating'] = <<<HTML
<h2>What Does Bosch Oven Error Code E010 Mean?</h2>
<p>The E010 error code on a Bosch oven indicates that the <strong>oven has exceeded its safe maximum operating temperature</strong>. This is a critical safety error — the oven has detected a temperature runaway condition where internal temperature has risen well above the set cooking temperature. The control board immediately cuts power to all heating elements and displays E010 to protect the oven, your kitchen, and your home from potential fire or heat damage.</p>

<h2>Common Causes of the E010 Error Code</h2>
<ul>
<li><strong>Relay stuck closed on the control board</strong> &ndash; The relay controlling power to the bake or broil element can weld itself in the "on" position, delivering continuous power regardless of the control board's commands. This is the most common cause of true oven overheating.</li>
<li><strong>Temperature sensor failure</strong> &ndash; If the sensor reports a lower temperature than actual, the control board keeps heating because it believes the set temperature hasn't been reached.</li>
<li><strong>Cooling fan failure</strong> &ndash; Without the cooling fan, the control board area overheats, causing erratic behavior including temperature runaway.</li>
<li><strong>Self-clean cycle malfunction</strong> &ndash; If temperature control fails during self-clean (which intentionally reaches ~900°F), the oven can exceed even the self-clean temperature limit.</li>
<li><strong>Blocked ventilation</strong> &ndash; Blocked oven ventilation openings prevent heat from escaping, causing the control area and surrounding cabinet to overheat.</li>
</ul>

<h2>How to Troubleshoot the E010 Error Code — Safety First</h2>
<ol>
<li><strong>Turn off the oven immediately</strong> &ndash; Press Cancel/Off and turn off the circuit breaker. If a relay is stuck, the element will keep heating with power connected.</li>
<li><strong>Open the oven door slightly</strong> &ndash; Once power is disconnected, crack the door open to allow heat to dissipate carefully — do not open fully to avoid burns.</li>
<li><strong>Do not use the oven</strong> &ndash; Until the E010 is professionally diagnosed and repaired, do not use the oven. A stuck relay can cause overheating again, potentially creating a fire hazard.</li>
<li><strong>Check the cooling fan</strong> &ndash; After the oven cools to room temperature, restore power briefly and listen for the cooling fan running. If absent, the fan motor may have failed.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The E010 error requires urgent professional diagnosis. Do not continue using an oven that has overheated. <strong>Contact our Bosch oven repair team</strong> for immediate safety diagnosis and repair using factory-certified Bosch parts.</p>
HTML;

$all_content['e211-door-lock-motor-failure'] = <<<HTML
<h2>What Does Bosch Oven Error Code E211 Mean?</h2>
<p>The E211 error code on a Bosch oven indicates a <strong>door lock motor failure</strong>. The door lock motor is a small, gear-reduced motor that moves the lock slide from the unlocked to the locked position (and back) in response to commands from the control board. It must engage before self-clean can begin and must disengage after self-clean is complete and the oven has cooled.</p>
<p>When the control board powers the motor and does not receive confirmation that the lock has reached its target position within the expected timeframe, E211 is triggered. This code can prevent self-clean from starting, interrupt a cycle in progress, or prevent you from opening the oven door after self-clean.</p>

<h2>Common Causes of the E211 Error Code</h2>
<ul>
<li><strong>Motor burnout</strong> &ndash; The lock motor can burn out due to age, repeated self-clean cycles, or overheating from extreme temperatures during self-clean.</li>
<li><strong>Stripped motor gears</strong> &ndash; The gear reduction mechanism can strip its teeth, allowing the motor to spin freely without moving the lock slide.</li>
<li><strong>Mechanical jam</strong> &ndash; Baked-on food, grease, or corrosion on the lock slide can create friction that stalls the motor.</li>
<li><strong>Position switch failure</strong> &ndash; Micro-switches that report lock position can fail, preventing the control board from knowing the lock's actual position.</li>
<li><strong>Wiring damage</strong> &ndash; Motor wiring routed near the top of the oven can deteriorate from the extreme heat generated during self-clean.</li>
</ul>

<h2>How to Troubleshoot the E211 Error Code</h2>
<ol>
<li><strong>Allow cooling</strong> &ndash; If E211 appeared during or after self-clean, wait until the oven has completely cooled (2-4 hours).</li>
<li><strong>Reset the oven</strong> &ndash; Turn off the circuit breaker for two minutes, then restore power. The oven will attempt to reset the lock to the unlocked position on startup.</li>
<li><strong>Listen for the motor</strong> &ndash; When the oven resets, listen near the top of the oven door for the lock motor running (a soft whirring or clicking for several seconds). Silence likely means the motor has failed.</li>
<li><strong>Clean the latch area</strong> &ndash; If the door is unlocked, carefully clean food residue from the door latch and lock mechanism area.</li>
<li><strong>Do not force the door</strong> &ndash; Never pry the door open when the lock is engaged. This can break the lock mechanism, hinges, or shatter the door glass.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The door lock assembly is located at the top of the oven frame behind the control panel and requires partial disassembly to access. <strong>Contact our Bosch oven repair team</strong> for professional door lock motor replacement using factory-certified Bosch parts.</p>
HTML;

// ============================================================
// COOKTOP ERROR CODES
// ============================================================

$all_content['e1-burner-temperature-too-high'] = <<<HTML
<h2>What Does Bosch Cooktop Error Code E1 Mean?</h2>
<p>The E1 error code on a Bosch cooktop indicates that a <strong>specific burner zone's temperature has exceeded the safe maximum</strong>. Unlike E0 (which refers to electronics overheating), E1 relates to the actual cooking surface temperature of a particular burner. Each burner zone has a temperature sensor monitoring surface temperature. When this sensor detects temperature above the safe threshold, the burner is automatically shut off or reduced in power.</p>
<p>On Bosch induction cooktops, the E1 is particularly relevant because the cookware itself generates heat via electromagnetic induction, and certain conditions can cause cookware to overheat. On radiant electric cooktops, E1 typically indicates the glass surface temperature near a specific burner has become dangerously hot.</p>

<h2>Common Causes of the E1 Error Code</h2>
<ul>
<li><strong>Empty pan on the burner</strong> &ndash; Leaving an empty pan at high power causes it to heat up extremely rapidly. The pan temperature can exceed 900°F in minutes with no food to absorb the heat.</li>
<li><strong>Pan boiled dry</strong> &ndash; If liquid evaporates completely and cooking continues, pan temperature rises rapidly.</li>
<li><strong>Warped or damaged cookware</strong> &ndash; Warped pans make inconsistent contact with the cooktop, creating hot spots and uneven heating that can trigger the sensor.</li>
<li><strong>High power for extended period</strong> &ndash; Running a burner at maximum power for a long time without managing the cooking process can push surface temperature beyond the safe limit.</li>
<li><strong>Temperature sensor fault</strong> &ndash; A faulty burner temperature sensor can report temperatures higher than actual, causing a false E1 error.</li>
</ul>

<h2>How to Troubleshoot the E1 Error Code</h2>
<ol>
<li><strong>Remove the cookware</strong> &ndash; Immediately remove the pan from the affected burner zone to eliminate the heat source.</li>
<li><strong>Wait for cooling</strong> &ndash; Allow the burner zone to cool for 10-15 minutes. The E1 error should clear once the surface temperature drops. The "H" (hot surface) indicator will remain until the surface cools below the burn-risk temperature.</li>
<li><strong>Never heat an empty pan</strong> &ndash; Always add food, oil, or liquid before turning on the burner.</li>
<li><strong>Use appropriate power levels</strong> &ndash; Use medium-high for most sautéing and frying, reserving maximum power for bringing water to a boil.</li>
<li><strong>Clean the cooktop surface</strong> &ndash; Remove burned-on residue near the burner zone, as it can interfere with the temperature sensor's accuracy.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E1 appears during normal cooking with proper cookware and moderate power levels, the burner temperature sensor may be faulty. <strong>Contact our Bosch cooktop repair team</strong> for sensor testing and replacement using factory-certified parts.</p>
HTML;

$all_content['e3-cookware-detection-error'] = <<<HTML
<h2>What Does Bosch Cooktop Error Code E3 Mean?</h2>
<p>The E3 error code on a Bosch cooktop indicates a <strong>cookware detection error</strong>, specific to Bosch induction cooktops. Induction cooktops generate an alternating magnetic field in the burner coil, which induces electrical currents in the base of ferromagnetic (iron-based) cookware, causing the cookware itself to heat up. The cooktop does not get hot directly — only the pan does.</p>
<p>For this to work, the cookware must be made of or contain a magnetic material (iron or magnetic stainless steel) and must be the right size for the burner zone. The E3 error appears when the induction coil attempts to energize but cannot detect suitable cookware on the burner zone.</p>

<h2>Common Causes of the E3 Error Code</h2>
<ul>
<li><strong>Incompatible cookware</strong> &ndash; Aluminum, copper, glass, ceramic, and non-magnetic stainless steel will not work on induction. This is the most common cause for new induction cooktop owners.</li>
<li><strong>Cookware too small for the zone</strong> &ndash; If the pan's base diameter is significantly smaller than the burner zone, the cooktop may not detect enough magnetic mass.</li>
<li><strong>Off-center placement</strong> &ndash; The pan must be centered on the burner zone marking.</li>
<li><strong>Warped pan bottom</strong> &ndash; A pan with a concave or convex warped bottom does not make full contact with the glass surface. The air gap reduces magnetic coupling.</li>
<li><strong>Very lightweight induction pan</strong> &ndash; Some very thin pans may not be detected at low power settings because they present insufficient magnetic load.</li>
</ul>

<h2>How to Troubleshoot the E3 Error Code</h2>
<ol>
<li><strong>Test with a magnet</strong> &ndash; Hold a refrigerator magnet to the bottom of your cookware. If it sticks firmly, the pan is induction-compatible. If it slides off or barely holds, the pan will not work.</li>
<li><strong>Center the pan</strong> &ndash; Make sure the pan is centered on the burner zone markings on the glass surface.</li>
<li><strong>Use the right size pan</strong> &ndash; Match pan diameter to the burner zone size. A small pan on a large zone may not be detected.</li>
<li><strong>Check for a flat bottom</strong> &ndash; Place the pan on a flat surface and check for rocking. A wobbling pan should be replaced.</li>
<li><strong>Try a higher power level</strong> &ndash; If a borderline pan is not detected at power level 1, try a higher setting.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E3 appears with known-compatible, properly sized, and properly centered cookware, the induction coil or its detection circuit may be faulty. <strong>Contact our Bosch cooktop repair team</strong> for professional induction system diagnosis using factory-certified parts.</p>
HTML;

$all_content['e7-touch-panel-fault'] = <<<HTML
<h2>What Does Bosch Cooktop Error Code E7 Mean?</h2>
<p>The E7 error code on a Bosch cooktop indicates a <strong>touch panel (capacitive control interface) fault</strong>. Most modern Bosch cooktops use capacitive touch controls that detect changes in electrical capacitance when your finger touches the glass surface over a sensor pad. The E7 error is triggered when the touch control system detects a malfunction — sensors not responding correctly, multiple sensors triggering simultaneously without being touched, or the touch controller chip reporting errors.</p>

<h2>Common Causes of the E7 Error Code</h2>
<ul>
<li><strong>Liquid or moisture on the control area</strong> &ndash; Water, cooking liquid, grease, or condensation on the touch control area changes capacitance readings and can cause false touches or no response. This is the single most common cause of E7.</li>
<li><strong>Object resting on the controls</strong> &ndash; A pot lid, towel, or utensil placed on the touch area creates a persistent capacitive input that confuses the controller.</li>
<li><strong>Cracked glass over the control area</strong> &ndash; A crack in the glass above the touch sensors changes capacitive properties and causes incorrect or no readings.</li>
<li><strong>Spillover damage</strong> &ndash; Liquid seeping through the edges and reaching the touch sensor board causes short circuits or corrosion.</li>
<li><strong>Failed touch controller chip</strong> &ndash; The microchip processing touch inputs can fail due to power surges, moisture damage, or component aging.</li>
</ul>

<h2>How to Troubleshoot the E7 Error Code</h2>
<ol>
<li><strong>Clean and dry the control area</strong> &ndash; Wipe the entire touch control area with a clean, dry cloth. Remove all moisture, grease, and food residue. This resolves the majority of E7 errors.</li>
<li><strong>Remove all objects from the cooktop</strong> &ndash; Ensure nothing is touching or near the touch control area.</li>
<li><strong>Power cycle the cooktop</strong> &ndash; Turn off the circuit breaker for 60 seconds. This resets the touch controller.</li>
<li><strong>Allow drying time</strong> &ndash; If a spill occurred near the control area, leave the circuit breaker off for several hours to allow moisture to evaporate.</li>
<li><strong>Check for glass damage</strong> &ndash; Carefully inspect the glass surface over the touch controls for cracks, chips, or scratches.</li>
<li><strong>Check the child lock</strong> &ndash; Some E7-like symptoms are caused by the child lock being engaged. Check your manual for the deactivation method.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E7 persists after thorough cleaning and drying, the touch control board or sensor array may need replacement. <strong>Contact our Bosch cooktop repair team</strong> for touch panel diagnosis and repair using factory-certified Bosch parts.</p>
HTML;

// ============================================================
// MICROWAVE ERROR CODES
// ============================================================

$all_content['f1-magnetron-failure'] = <<<HTML
<h2>What Does Bosch Microwave Error Code F1 Mean?</h2>
<p>The F1 error code on a Bosch microwave indicates a <strong>magnetron failure</strong>. The magnetron is the vacuum tube device that converts electrical energy into microwave radiation (at 2,450 MHz), which heats food by causing water molecules to vibrate. Without a functioning magnetron, the microwave cannot heat food at all.</p>
<p>When the control board detects the magnetron is not drawing expected current, is overheating, or is not functioning within normal parameters, it triggers F1 and disables heating. The microwave's fan, light, and turntable may still work, but no heat is produced.</p>

<h2>Common Causes of the F1 Error Code</h2>
<ul>
<li><strong>Age and wear</strong> &ndash; The magnetron has a finite lifespan. In heavily used household microwaves, it can wear out after 7-10 years as the internal filament or cathode material depletes.</li>
<li><strong>Running while empty</strong> &ndash; Operating a microwave with nothing inside causes the magnetron to absorb its own energy output, permanently damaging it in minutes.</li>
<li><strong>Arcing events</strong> &ndash; Metal objects, damaged containers, or mineral-rich foods can cause sparking inside the microwave. Repeated arcing can crack the magnetron's antenna or degrade internal components.</li>
<li><strong>Overheating</strong> &ndash; If the cooling fan has failed or ventilation is blocked, the magnetron can overheat. A thermal cut-out permanently opens if safe temperature is exceeded.</li>
<li><strong>Diode or capacitor failure</strong> &ndash; The high-voltage diode and capacitor supplying power to the magnetron can fail, preventing it from operating even if the magnetron itself is intact.</li>
</ul>

<h2>How to Troubleshoot the F1 Error Code</h2>
<p><strong>Critical safety warning:</strong> The microwave's high-voltage capacitor stores a potentially lethal charge of up to 4,000 volts even when unplugged. Never open the outer casing without proper training and equipment.</p>
<ol>
<li><strong>Reset the microwave</strong> &ndash; Unplug for at least 60 seconds, then plug back in. A temporary electronic fault may clear.</li>
<li><strong>Test with a cup of water</strong> &ndash; Place a microwave-safe cup of water inside and run on full power for 60 seconds. If the water heats, F1 may have been temporary. If the water stays cold, the magnetron or its power supply has failed.</li>
<li><strong>Check for arcing damage</strong> &ndash; Inspect the interior for burn marks or carbon deposits on the waveguide cover. Significant burning requires waveguide cover replacement at minimum.</li>
<li><strong>Assess repair vs. replace</strong> &ndash; Magnetron replacement often costs $150-$300 for parts plus labor. For microwaves over 7-8 years old, consider whether replacement is more economical.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The F1 error almost always requires professional diagnosis and repair due to high-voltage hazards inside the microwave. <strong>Contact our Bosch microwave repair team</strong> for safe, professional magnetron diagnosis and replacement using factory-certified Bosch parts.</p>
HTML;

$all_content['f3-door-switch-failure'] = <<<HTML
<h2>What Does Bosch Microwave Error Code F3 Mean?</h2>
<p>The F3 error code on a Bosch microwave indicates a <strong>door switch (interlock switch) failure</strong>. Microwave door switches are the most critical safety components in the appliance. Microwaves use multiple interlock switches (typically three) that form a system. All must be in the correct position for the microwave to operate — preventing microwave radiation from being emitted with the door open.</p>
<p>The F3 error appears when the control board's door interlock monitoring circuit detects an inconsistency in switch states. When F3 is active, the microwave will not start for any function as a mandatory safety measure.</p>

<h2>Common Causes of the F3 Error Code</h2>
<ul>
<li><strong>Worn switch contacts</strong> &ndash; Each door switch's spring-loaded contacts wear out, corrode, or become pitted after thousands of open-close cycles, causing intermittent or permanent failure.</li>
<li><strong>Broken door latch hook</strong> &ndash; The plastic latch hook that physically depresses the door switches can crack or break.</li>
<li><strong>Failed monitor switch</strong> &ndash; The monitor switch can blow the microwave's fuse when it detects a primary switch failure. If your microwave's fuse blew, this combined failure is likely the cause.</li>
<li><strong>Misaligned door</strong> &ndash; A bent hinge or warped frame means latch hooks may not fully engage the switches.</li>
</ul>

<h2>How to Troubleshoot the F3 Error Code</h2>
<p><strong>Safety note:</strong> Do not attempt to bypass or disable microwave door interlocks. They exist to prevent exposure to microwave radiation. Bypassing them is dangerous and illegal.</p>
<ol>
<li><strong>Reset the microwave</strong> &ndash; Unplug for 60 seconds and plug back in. Test by opening and closing the door firmly, then starting a cook cycle.</li>
<li><strong>Inspect the door latch</strong> &ndash; Examine the plastic latch hooks on the door for cracks, breaks, or damage. Check the corresponding holes on the microwave frame for broken plastic pieces.</li>
<li><strong>Close the door firmly</strong> &ndash; Ensure you close the door with a definitive push that fully engages the latch.</li>
<li><strong>Check for a blown fuse</strong> &ndash; If the microwave is completely dead (no display, no response), a blown fuse from a monitor switch activation is likely the cause.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Door switch replacement requires accessing the interior of the microwave near high-voltage components — a job for a trained technician. <strong>Contact our Bosch microwave repair team</strong> for professional door switch diagnosis and replacement using factory-certified Bosch parts.</p>
HTML;

$all_content['f7-keypad-touch-panel-fault'] = <<<HTML
<h2>What Does Bosch Microwave Error Code F7 Mean?</h2>
<p>The F7 error code on a Bosch microwave indicates a <strong>keypad or touch panel fault</strong>. The F7 error is triggered when the control board detects that a key or sensor on the panel is stuck in the activated state (continuously reporting as pressed), the panel is not responding to inputs, or the panel's signals are out of the expected range.</p>
<p>When a key continuously reports as pressed (stuck key), the microwave cannot function safely because the input would interfere with every operation. The F7 may render the microwave completely non-functional or may disable specific buttons while others continue working.</p>

<h2>Common Causes of the F7 Error Code</h2>
<ul>
<li><strong>Moisture under the membrane</strong> &ndash; Steam, condensation, or direct liquid spills can seep under the membrane keypad and cause individual keys to short-circuit in the pressed position. This is the most frequent cause.</li>
<li><strong>Grease and food buildup</strong> &ndash; Heavy grease accumulation around membrane keys can physically hold the membrane depressed, creating a stuck-key condition.</li>
<li><strong>Cracked or damaged membrane</strong> &ndash; The flexible membrane can crack, especially at hinge points around frequently used keys like Start. A cracked membrane allows moisture inside.</li>
<li><strong>Harsh cleaning</strong> &ndash; Using excessive liquid or harsh cleaning sprays directly on the control panel can drive moisture under the membrane.</li>
</ul>

<h2>How to Troubleshoot the F7 Error Code</h2>
<ol>
<li><strong>Clean the control panel</strong> &ndash; With the microwave unplugged, wipe the entire control panel with a barely damp cloth. Remove all grease, food splatters, and residue from around every button.</li>
<li><strong>Reset the microwave</strong> &ndash; Unplug for five minutes to clear stuck-key detection. When power is restored, the board re-reads all key states.</li>
<li><strong>Dry the panel area</strong> &ndash; If moisture is suspected, leave the microwave unplugged with the door open for several hours. Warm air from a hair dryer at low heat from 12+ inches can help.</li>
<li><strong>Test each button</strong> &ndash; After reset, press each button methodically. Note which do not respond or cause unexpected inputs.</li>
<li><strong>Do not spray cleaners on the panel</strong> &ndash; Apply cleaning products to a cloth first, never directly to the control panel.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Membrane keypads and touch panels are typically replaced as a complete assembly. <strong>Contact our Bosch microwave repair team</strong> for keypad diagnosis and replacement using factory-certified Bosch parts.</p>
HTML;

// ============================================================
// FREEZER ERROR CODES
// ============================================================

$all_content['e01-freezer-temperature-sensor-fault'] = <<<HTML
<h2>What Does Bosch Freezer Error Code E01 Mean?</h2>
<p>The E01 error code on a Bosch freezer indicates a <strong>temperature sensor (NTC thermistor) fault</strong>. The temperature sensor continuously measures the air temperature inside the freezer and reports this data to the main control board. The control board uses this reading to determine when to run the compressor, when to activate the defrost heater, and when to trigger temperature alarms.</p>
<p>When the control board detects that the sensor is returning readings outside the physically possible range — either an open circuit or a short circuit — it triggers E01. Without accurate temperature data, the freezer cannot safely manage its cooling cycle, and food preservation may be compromised.</p>

<h2>Common Causes of the E01 Error Code</h2>
<ul>
<li><strong>Thermistor component failure</strong> &ndash; NTC thermistors experience thermal fatigue from the extreme temperature cycles in the freezer environment — temperatures swing from 0°F during normal operation to 50°F+ during defrost cycles.</li>
<li><strong>Ice encasement</strong> &ndash; If the defrost system is not functioning properly, frost and ice can build up and completely encase the temperature sensor, thermally isolating it from the air.</li>
<li><strong>Wiring connection looseness</strong> &ndash; The connector linking the sensor to the control board can work loose due to vibration from the compressor.</li>
<li><strong>Moisture damage to the connector</strong> &ndash; During defrost cycles, water produced as frost melts can overflow from a blocked drain and contact the sensor's electrical connector, causing corrosion.</li>
<li><strong>Physical sensor damage</strong> &ndash; The thin probe can be bent or damaged if heavy items are placed against the back wall, or if shelves are forced in during restocking.</li>
</ul>

<h2>How to Troubleshoot the E01 Error Code</h2>
<ol>
<li><strong>Reset the freezer</strong> &ndash; Unplug or turn off the circuit breaker for at least five minutes. When power is restored, the board re-reads the sensor from a fresh starting state.</li>
<li><strong>Check for excessive frost or ice</strong> &ndash; Inspect for heavy frost accumulation, particularly on the back wall. Heavy icing suggests the sensor may be encased in ice due to a defrost system problem.</li>
<li><strong>Perform a manual defrost</strong> &ndash; If frost is heavy, unplug the freezer and leave the door open for 6-12 hours to allow complete defrosting. Place towels on the floor to absorb meltwater.</li>
<li><strong>Check the defrost drain</strong> &ndash; While defrosted, verify the drain hole at the bottom of the freezer compartment is clear. Flush with warm water.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E01 returns after reset and manual defrost, the temperature sensor or its wiring needs professional testing and replacement. <strong>Contact our Bosch freezer repair team</strong> for expert sensor diagnosis and replacement using factory-certified Bosch parts.</p>
HTML;

$all_content['e02-freezer-defrost-system-fault'] = <<<HTML
<h2>What Does Bosch Freezer Error Code E02 Mean?</h2>
<p>The E02 error code on a Bosch freezer indicates a <strong>defrost system malfunction</strong>. Bosch frost-free freezers use an automatic defrost system that activates at regular intervals (typically every 8-12 hours) to melt frost from the evaporator coils. The E02 error appears when the control board detects the defrost system is not performing as expected — whether the defrost heater is not activating, the temperature is not rising as expected during defrost, or the defrost is taking too long.</p>
<p>When E02 is active, the freezer continues cooling but without defrost cycles, frost gradually builds up on the evaporator coils over days. As frost thickens, cooling efficiency decreases and eventually the freezer fails to maintain safe food storage temperatures.</p>

<h2>Common Causes of the E02 Error Code</h2>
<ul>
<li><strong>Burned-out defrost heater</strong> &ndash; The heater element positioned near the evaporator coils can burn through and open-circuit, preventing it from generating heat. This is the most common cause.</li>
<li><strong>Failed defrost thermostat (bi-metal)</strong> &ndash; The termination thermostat that cuts the heater when coils are clear of frost can fail in the open position, permanently breaking the heater circuit.</li>
<li><strong>Defrost timer or control board fault</strong> &ndash; A mechanical timer that sticks, or a control board malfunction, prevents the defrost cycle from initiating.</li>
<li><strong>Blocked defrost drain</strong> &ndash; A blocked drain causes meltwater to refreeze inside the freezer, creating the appearance of a defrost system failure even when the heater is working.</li>
</ul>

<h2>How to Troubleshoot the E02 Error Code</h2>
<ol>
<li><strong>Check for frost buildup</strong> &ndash; Open the freezer and look for unusually heavy frost on the back wall or ceiling. Heavy frost confirms the defrost system is not working.</li>
<li><strong>Manual defrost</strong> &ndash; Unplug the freezer, remove all food to coolers with ice, and leave the door open for 12-24 hours until completely defrosted.</li>
<li><strong>Clear the defrost drain</strong> &ndash; While defrosted, locate and clear the drain hole. Flush with warm water.</li>
<li><strong>Monitor after restart</strong> &ndash; If the back wall frosts over again within a few days (instead of the normal several weeks), the defrost heater or thermostat has failed.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Replacing the defrost heater and thermostat requires removing the interior back wall panel of the freezer to access the evaporator. <strong>Contact our Bosch freezer repair team</strong> for professional defrost system diagnosis and repair using factory-certified Bosch parts.</p>
HTML;

$all_content['e05-freezer-high-temperature-alarm'] = <<<HTML
<h2>What Does Bosch Freezer Error Code E05 Mean?</h2>
<p>The E05 error code on a Bosch freezer indicates that a <strong>high temperature alarm has been triggered</strong> — the internal temperature of the freezer has risen above the safe threshold for food storage. Bosch freezers monitor internal temperature continuously and trigger E05 when the compartment temperature exceeds a programmed limit (typically around 14°F / -10°C, though this varies by model).</p>
<p>The E05 alarm is both a fault indicator and a food safety warning. Frozen food should be kept at 0°F (-18°C) or below. When temperatures rise significantly above this, ice crystals melt, texture deteriorates, and if temperatures rise high enough for long enough, bacterial growth can occur in thawed proteins.</p>

<h2>Common Causes of the E05 Error Code</h2>
<ul>
<li><strong>Door left open</strong> &ndash; Even a slightly ajar door allows warm room air to enter continuously, raising internal temperature rapidly. This is the most common non-mechanical cause.</li>
<li><strong>Power outage</strong> &ndash; During an extended power outage, the freezer temperature rises. A well-stocked, properly sealed freezer can maintain safe temperatures for 24-48 hours, but E05 will trigger as temperatures rise.</li>
<li><strong>Cooling system fault</strong> &ndash; If any component of the cooling system has failed (compressor, fan, defrost system), the freezer will gradually warm up and trigger E05.</li>
<li><strong>Damaged or worn door seal</strong> &ndash; A door seal no longer forming an airtight closure allows continuous warm air infiltration.</li>
<li><strong>Large amount of warm food added</strong> &ndash; Adding a significant quantity of room-temperature food at once raises internal temperature temporarily.</li>
</ul>

<h2>How to Respond to the E05 Code</h2>
<ol>
<li><strong>Check the door immediately</strong> &ndash; Verify all doors are fully closed and sealed. Check for items blocking door closure.</li>
<li><strong>Assess your food</strong> &ndash; If items are still frozen solid or have ice crystals, they are likely safe. If meat, poultry, or fish have fully thawed and are at room temperature, do not refreeze — cook immediately if still below 40°F or discard.</li>
<li><strong>Check for a power outage</strong> &ndash; If there was a power outage, restore power and allow the freezer to run to return to proper temperature.</li>
<li><strong>Listen for normal operation</strong> &ndash; After ensuring the door is closed and power is on, listen for the compressor running and the fan circulating air. Both should be active.</li>
<li><strong>Acknowledge the alarm</strong> &ndash; Press any button to silence the E05 alarm. The indicator may remain until temperature returns to the safe range.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E05 appears with other error codes or if the freezer temperature remains elevated despite the door being closed and no external causes being apparent, there is a mechanical cooling system failure. <strong>Contact our Bosch freezer repair team</strong> for professional diagnosis and repair using factory-certified Bosch parts.</p>
HTML;

$all_content['e07-freezer-door-open-alarm'] = <<<HTML
<h2>What Does Bosch Freezer Error Code E07 Mean?</h2>
<p>The E07 error code on a Bosch freezer indicates that the <strong>door has been left open beyond the acceptable time limit</strong>, or that the door switch is detecting the door as open when it should be closed. Bosch freezers have a door alarm that activates when the door remains open for more than approximately 60-120 seconds. After this time, the control board sounds an audible alarm and displays E07.</p>
<p>An open freezer door allows warm, humid room air to enter, raising the internal temperature, forcing the compressor to work harder, and causing excessive frost buildup on the evaporator coils. The E07 is typically a simple user alert — closing the door resolves it — but it can also indicate a seal, switch, or alignment issue if it appears with the door closed.</p>

<h2>Common Causes of the E07 Error Code</h2>
<ul>
<li><strong>Door physically left open</strong> &ndash; Opened and not fully closed, or propped open during loading or unloading.</li>
<li><strong>Door not fully latched</strong> &ndash; The door appears closed but the magnetic seal is not fully engaged. This often happens when the door is pushed closed gently rather than firmly.</li>
<li><strong>Worn or damaged door gasket</strong> &ndash; The magnetic gasket around the door degrades over time. Cracks, tears, or weakened magnets allow the door to swing open slightly after being closed.</li>
<li><strong>Freezer not level</strong> &ndash; If the freezer is tilted forward (front higher than back), gravity pulls the door open. Most Bosch freezers should be tilted slightly backward so gravity assists closure.</li>
<li><strong>Faulty door switch</strong> &ndash; If the door switch that detects closure fails in the "open" position, E07 will display even with the door firmly closed.</li>
<li><strong>Overloaded shelves near the door</strong> &ndash; Items extending too close to the door opening can prevent the door from closing fully.</li>
</ul>

<h2>How to Troubleshoot the E07 Error Code</h2>
<ol>
<li><strong>Close the door firmly</strong> &ndash; Open fully and close again with a deliberate push. Listen for the magnetic seal engaging.</li>
<li><strong>Check for obstructions</strong> &ndash; Open and check for items preventing full closure — a package that is too tall, a drawer not pushed in, or an overloaded shelf.</li>
<li><strong>Clean the door gasket</strong> &ndash; Wipe the gasket with warm soapy water. Food residue, sticky spills, or ice can prevent proper sealing.</li>
<li><strong>Test the gasket seal</strong> &ndash; Close the door on a dollar bill. It should offer firm resistance when you try to pull it out. If it slides out easily at any point, the gasket is not sealing there.</li>
<li><strong>Check freezer leveling</strong> &ndash; Place a level on top of the freezer. Adjust the front leveling feet so the front is equal to or slightly lower than the back, helping the door swing closed naturally.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E07 persists with the door firmly closed, the door gasket or door switch may need replacement. A warped door or broken hinge can also cause persistent door-open alerts. <strong>Contact our Bosch freezer repair team</strong> for door gasket and switch service using factory-certified Bosch parts.</p>
HTML;

// ============================================================
// UPDATE ALL POSTS WITH CONTENT
// ============================================================
$updated = 0;
$skipped = 0;
$not_found = 0;

echo "Starting import of " . count( $all_content ) . " error code pages...\n\n";

foreach ( $all_content as $slug => $content ) {
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
        echo "HAS CONTENT: '{$slug}' (ID: {$post->ID}) — skipping (already has content).\n";
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
echo "Run setup-pages.php first if posts were not found.\n";
