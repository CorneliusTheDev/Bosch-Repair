<?php
/**
 * Import All Appliance Error Code Content
 *
 * Populates Monogram washer, dryer, refrigerator, oven, cooktop, microwave,
 * and freezer error_code posts with full SEO-optimized HTML content.
 *
 * HOW TO USE:
 *   1. Add this line temporarily to functions.php:
 *        add_action('init', function(){ include get_template_directory() . '/inc/import-all-error-content.php'; }, 100);
 *      Remove after running once.
 *   2. OR via WP-CLI:
 *        wp eval-file wp-content/themes/monogram-repair-theme/inc/import-all-error-content.php
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
// ALL ERROR CODE CONTENT ARRAY
// slug => post_content (HTML)
// ============================================================
$all_content = array();

// ============================================================
// WASHER ERROR CODES
// ============================================================

$all_content['e22-fill-timeout-water-supply'] = <<<HTML
<h2>What Does Monogram Washer Error Code E22 Mean?</h2>
<p>The E22 error code on a Monogram washing machine indicates a <strong>fill timeout</strong> &mdash; the washer was unable to fill with water within the expected time limit (typically 8 minutes). When the control board activates the water inlet valve to fill the drum, it monitors the water level sensor. If the water level does not rise to the required level within the fill timeout window, E22 is triggered and the cycle stops.</p>
<p>When E22 appears, you may notice that the drum has little or no water in it, or that filling started but stopped before reaching the proper level. This code is common on Monogram washers using the GE electronic control platform.</p>

<h2>Common Causes of the E22 Error Code</h2>
<ul>
<li><strong>Water supply valves not fully open</strong> &ndash; The hot and cold water supply valves behind the washer may be partially or completely closed, restricting water flow.</li>
<li><strong>Kinked or clogged fill hoses</strong> &ndash; The rubber hoses connecting the washer to the supply valves can become kinked or internally clogged with sediment and mineral deposits.</li>
<li><strong>Clogged inlet valve screens</strong> &ndash; The water inlet valve on the back of the washer has small mesh screens that filter debris. These screens can become clogged with mineral deposits, rust, or sediment, severely restricting flow.</li>
<li><strong>Failed water inlet valve</strong> &ndash; The solenoid-operated inlet valve can fail electrically or mechanically, preventing it from opening to allow water in.</li>
<li><strong>Low water pressure</strong> &ndash; Monogram washers require a minimum pressure (typically 20&ndash;120 PSI) to fill within the allowed time. Low household pressure can cause fill timeout.</li>
<li><strong>Failed water level pressure sensor</strong> &ndash; If the pressure sensor gives incorrect readings, the washer may keep filling and time out even with adequate water.</li>
</ul>

<h2>How to Troubleshoot the E22 Error Code</h2>
<ol>
<li><strong>Check water supply valves</strong> &ndash; Locate the hot and cold water valves behind the washer and ensure both are fully open (turned counterclockwise).</li>
<li><strong>Check for kinked hoses</strong> &ndash; Inspect fill hoses from the wall valves to the back of the washer. Straighten any kinks.</li>
<li><strong>Clean the inlet valve screens</strong> &ndash; Turn off both water supply valves, disconnect fill hoses, and use needle-nose pliers to carefully remove and rinse the small mesh screens inside the valve ports.</li>
<li><strong>Test water pressure</strong> &ndash; If you suspect low pressure, check flow at nearby fixtures. A whole-house pressure issue needs to be addressed at the main supply or pressure-reducing valve.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds, plug back in, and attempt a new cycle.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E22 persists after checking valves, hoses, and cleaning screens, the water inlet valve or water level pressure sensor may need replacement. <strong>Contact our Monogram washer repair team</strong> for professional diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['e23-flood-protection-drain'] = <<<HTML
<h2>What Does Monogram Washer Error Code E23 Mean?</h2>
<p>The E23 error code on a Monogram washing machine indicates that the <strong>flood protection system has been activated</strong> &mdash; the washer detected an excessive amount of water in the drum or tub, triggering the safety drain. This error is triggered when the water level sensor detects a water level significantly above what was requested by the selected wash cycle.</p>
<p>When E23 appears, the washer stops filling, activates the drain pump to remove excess water, and halts the cycle to prevent overflow.</p>

<h2>Common Causes of the E23 Error Code</h2>
<ul>
<li><strong>Faulty water inlet valve stuck open</strong> &ndash; The most common cause. If the solenoid-operated inlet valve fails in the open position, water continuously trickles into the drum even when the washer is not actively filling, eventually triggering the flood protection.</li>
<li><strong>Failed water level pressure sensor</strong> &ndash; A pressure sensor that reads incorrectly may tell the control board the drum is nearly empty when it actually has adequate water, causing the washer to keep filling until flood protection triggers.</li>
<li><strong>Siphoning through drain hose</strong> &ndash; If the drain hose is inserted too deeply into the standpipe or located below the washer&rsquo;s minimum drain height, a siphon effect can pull water back into the tub.</li>
</ul>

<h2>How to Troubleshoot the E23 Error Code</h2>
<ol>
<li><strong>Check the inlet valve</strong> &ndash; After a wash cycle, turn off the water supply valves and observe whether water continues to drip into the drum. Ongoing dripping with the valve closed confirms the valve is stuck open.</li>
<li><strong>Check drain hose position</strong> &ndash; Ensure the drain hose is inserted only 6&ndash;8 inches into the standpipe at the correct minimum height per your Monogram installation guide.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds. The drain pump should have already removed excess water. After reset, run a short cycle and monitor.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the inlet valve continues to drip or the water level sensor provides incorrect readings, professional diagnosis and component replacement is needed. <strong>Contact our Monogram washer repair team</strong> for expert repair using factory-certified Monogram parts.</p>
HTML;

$all_content['e30-no-drain-pump-signal'] = <<<HTML
<h2>What Does Monogram Washer Error Code E30 Mean?</h2>
<p>The E30 error code on a Monogram washing machine indicates that the <strong>control board is not receiving a proper signal from the drain pump</strong>. Unlike a drain timeout (E31), E30 indicates a communication or electrical issue with the pump circuit rather than simply slow drainage. The control board sends a command to the drain pump and monitors the pump&rsquo;s response signal. When this signal is absent or incorrect, E30 is triggered.</p>

<h2>Common Causes of the E30 Error Code</h2>
<ul>
<li><strong>Loose electrical connection to the drain pump</strong> &ndash; The wiring connector to the drain pump motor has come loose or partially disconnected.</li>
<li><strong>Clogged drain pump</strong> &ndash; A severely clogged pump impeller can prevent the motor from spinning, causing it to draw excessive current and trip an internal thermal protector.</li>
<li><strong>Failed drain pump motor</strong> &ndash; The pump motor has burned out electrically.</li>
<li><strong>Control board fault</strong> &ndash; The control board&rsquo;s pump drive circuit has failed.</li>
</ul>

<h2>How to Troubleshoot the E30 Error Code</h2>
<ol>
<li><strong>Clean the drain pump filter</strong> &ndash; Locate the access panel at the lower front of the washer. Place towels down, slowly open the filter cap, and remove any debris, lint, or foreign objects from the filter and pump cavity.</li>
<li><strong>Check pump electrical connections</strong> &ndash; If accessible, ensure the wiring harness connector to the drain pump is firmly seated.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds and retry a Drain &amp; Spin cycle.</li>
<li><strong>Listen for pump operation</strong> &ndash; When drain should occur, listen for the hum of the pump motor. Silence suggests no power to the pump.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E30 persists after cleaning the filter, the drain pump electrical connections or pump motor require professional inspection and likely replacement. <strong>Contact our Monogram washer repair team</strong> for expert drain pump diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['e31-drain-timeout-slow-drain'] = <<<HTML
<h2>What Does Monogram Washer Error Code E31 Mean?</h2>
<p>The E31 error code on a Monogram washing machine indicates that the <strong>drain cycle exceeded the maximum allowed time</strong> &mdash; water is draining too slowly. The control board activates the drain pump and monitors the water level sensor. If the water level does not drop to the expected level within the drain timeout window, E31 is triggered.</p>
<p>When E31 appears, you will find standing water remaining in the wash tub and the washer stopped. E31 is one of the most frequently encountered Monogram washer error codes, and many of its causes can be resolved by the homeowner.</p>

<h2>Common Causes of the E31 Error Code</h2>
<ul>
<li><strong>Clogged drain pump filter</strong> &ndash; The debris filter (coin trap) at the lower front of the machine catches coins, buttons, hair ties, and lint. When clogged, water cannot flow through the pump efficiently.</li>
<li><strong>Blocked or kinked drain hose</strong> &ndash; The drain hose can become kinked, crushed, or internally blocked with lint and debris.</li>
<li><strong>Drain pump failure</strong> &ndash; A weak or worn pump may move water but not fast enough to meet the drain time requirement.</li>
<li><strong>Foreign object in the pump impeller</strong> &ndash; Small items bypassing the filter can wedge in the pump impeller, restricting rotation.</li>
<li><strong>Excessive suds</strong> &ndash; Using too much detergent or non-HE detergent creates foam that the pump cannot clear efficiently.</li>
</ul>

<h2>How to Troubleshoot the E31 Error Code</h2>
<ol>
<li><strong>Clean the drain pump filter</strong> &ndash; Place towels and a shallow pan under the filter access panel (lower front). Slowly open the filter cap and drain water. Remove the filter and clean all debris thoroughly. This is the most common fix for E31.</li>
<li><strong>Check the drain hose</strong> &ndash; Ensure the drain hose is not kinked and is inserted only 6&ndash;8 inches into the standpipe.</li>
<li><strong>Use HE detergent</strong> &ndash; Monogram front-load washers require HE (High Efficiency) detergent used in the correct quantity.</li>
<li><strong>Run a Drain &amp; Spin cycle</strong> &ndash; After cleaning the filter, run a Drain &amp; Spin cycle to test drainage.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If E31 persists after cleaning the filter and checking the drain hose, the drain pump or its impeller may need replacement. <strong>Contact our Monogram washer repair team</strong> for professional drain pump diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['e42-e45-drive-motor-error'] = <<<HTML
<h2>What Do Monogram Washer Error Codes E42 and E45 Mean?</h2>
<p>The E42 and E45 error codes on a Monogram washing machine indicate <strong>drive motor errors</strong> &mdash; the motor or motor drive system is operating outside design limits. The control board monitors motor current, speed, and inverter drive feedback signals. E42 typically indicates the motor drive is operating above design limits (overcurrent or overspeed), while E45 indicates a related motor control fault.</p>
<p>When these errors appear, the washer may stop mid-cycle, fail to spin, or produce grinding or straining sounds before stopping.</p>

<h2>Common Causes of the E42 / E45 Error Codes</h2>
<ul>
<li><strong>Overloaded drum</strong> &ndash; Exceeding the washer&rsquo;s rated load capacity forces the motor to work harder than its rated limits, triggering overcurrent protection.</li>
<li><strong>Worn motor bearings</strong> &ndash; Bearings that have degraded create mechanical drag on the motor, increasing current draw.</li>
<li><strong>Failed inverter board</strong> &ndash; The motor speed control inverter has a component failure.</li>
<li><strong>Worn drive motor</strong> &ndash; Internal electrical failure of the motor windings.</li>
<li><strong>Loose motor wiring</strong> &ndash; Intermittent connection causing erratic motor control.</li>
</ul>

<h2>How to Troubleshoot the E42 / E45 Error Codes</h2>
<ol>
<li><strong>Reduce load size</strong> &ndash; If the drum was heavily loaded, remove items. Wash large heavy items (blankets, rugs) separately.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds. After reset, run a small, balanced load and monitor for error recurrence.</li>
<li><strong>Listen for unusual sounds</strong> &ndash; Grinding, humming without spinning, or squealing during operation indicate mechanical motor issues.</li>
<li><strong>Check for drum obstructions</strong> &ndash; Items like underwire, coins, or small toys can lodge between the drum and tub, adding mechanical resistance to the motor.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Motor, inverter board, and bearing replacement require accessing internal washer components. <strong>Contact our Monogram washer repair team</strong> for professional motor system diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['e60-e64-door-lock-errors'] = <<<HTML
<h2>What Do Monogram Washer Error Codes E60&ndash;E64 Mean?</h2>
<p>The E60 through E64 error codes on a Monogram washing machine all relate to <strong>door lock system failures</strong>. Every Monogram front-load washer uses an electronic door lock that must engage before a wash cycle can begin. This safety feature prevents the door from opening during operation. When the control board cannot verify that the door lock has properly engaged or disengaged, these error codes are triggered.</p>

<h2>Common Causes of Door Lock Error Codes</h2>
<ul>
<li><strong>Failed door lock actuator</strong> &ndash; The electronic actuator that mechanically locks and unlocks the door can burn out.</li>
<li><strong>Broken door latch or strike</strong> &ndash; Physical damage to the door latch or the frame strike prevents proper lock engagement.</li>
<li><strong>Loose wiring to the door lock</strong> &ndash; Wiring connections between the door lock assembly and the control board can loosen.</li>
<li><strong>Warped or misaligned door</strong> &ndash; If the door has been damaged, the lock pin cannot reach the sensor properly.</li>
<li><strong>Debris in the door seal</strong> &ndash; Foreign objects caught in the rubber boot seal can prevent the door from fully closing.</li>
</ul>

<h2>How to Troubleshoot Door Lock Error Codes</h2>
<ol>
<li><strong>Check door closure</strong> &ndash; Open and firmly re-close the washer door until you hear a solid click. Push on the door to confirm it is fully seated.</li>
<li><strong>Inspect the door seal</strong> &ndash; Look around the rubber boot seal for trapped clothing, debris, or buildup preventing full closure.</li>
<li><strong>Examine the door latch</strong> &ndash; Check the plastic latch hook and strike for cracks, chips, or misalignment.</li>
<li><strong>Reset the washer</strong> &ndash; Unplug for 60 seconds and retry.</li>
<li><strong>Listen for lock engagement</strong> &ndash; When you press Start, listen for clicking from the door lock area. Repeated clicking without locking suggests actuator failure.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If door lock errors persist after basic troubleshooting, the door lock assembly likely needs replacement. <strong>Contact our Monogram washer repair team</strong> for professional door lock diagnosis and replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['ue-ub-unbalanced-load'] = <<<HTML
<h2>What Does Monogram Washer Error Code UE or UB Mean?</h2>
<p>The UE or UB error code on a Monogram washing machine indicates an <strong>unbalanced load</strong> during the spin cycle. The washer&rsquo;s vibration sensors detect when laundry has collected on one side of the drum during spin, creating excessive vibration. Monogram washers will attempt to redistribute the load automatically (by adding water and tumbling) up to several times before displaying UE or UB.</p>
<p>This is one of the most common washer error codes and is almost always caused by laundry loading rather than a mechanical failure.</p>

<h2>Common Causes of UE / UB Error Codes</h2>
<ul>
<li><strong>Single heavy item</strong> &ndash; Washing one large, heavy item alone (bath towel, jeans, blanket) creates an unbalanced load that cannot be distributed evenly.</li>
<li><strong>Tangled items</strong> &ndash; Sheets or duvet covers tangled around each other form a heavy mass on one side of the drum.</li>
<li><strong>Overloaded drum</strong> &ndash; An overfull drum prevents free movement and balanced distribution during spin.</li>
<li><strong>Washer not level</strong> &ndash; A washer not sitting perfectly level on all four feet has reduced imbalance tolerance.</li>
<li><strong>Worn shock absorbers</strong> &ndash; Worn suspension dampers reduce the machine&rsquo;s ability to handle even slight imbalances.</li>
</ul>

<h2>How to Troubleshoot UE / UB Error Codes</h2>
<ol>
<li><strong>Pause and redistribute</strong> &ndash; Open the door and redistribute laundry evenly around the drum. Break up tangled clumps. Close the door and restart the spin.</li>
<li><strong>Add or remove items</strong> &ndash; If washing a single heavy item, add two or three similar-weight towels. If the drum is overstuffed, remove some items.</li>
<li><strong>Check washer leveling</strong> &ndash; Place a level on top and adjust the front leveling feet until level in both directions. All four feet must make firm contact with the floor.</li>
<li><strong>Run a Spin Only cycle</strong> &ndash; After redistributing, run a Spin Only or Drain &amp; Spin cycle to complete spinning.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If UE/UB continues with properly loaded and leveled machines, the suspension rods, shock absorbers, or vibration sensors may need inspection. <strong>Contact our Monogram washer repair team</strong> for mechanical inspection and repair using factory-certified Monogram parts.</p>
HTML;

// ============================================================
// DRYER ERROR CODES
// ============================================================

$all_content['001-003-defective-inlet-thermistor'] = <<<HTML
<h2>What Do Monogram Dryer Error Codes 001 and 003 Mean?</h2>
<p>Error codes 001 and 003 on a Monogram dryer indicate a <strong>defective inlet thermistor</strong> &mdash; the temperature sensor located on the air inlet duct where air enters the dryer drum. The inlet thermistor measures the temperature of air entering the drum and provides this data to the control board to regulate heating cycles. When the sensor reading is outside the expected range, these codes are triggered.</p>

<h2>Common Causes of the 001 / 003 Error Codes</h2>
<ul>
<li><strong>Failed inlet thermistor element</strong> &ndash; The thermistor&rsquo;s internal resistance element has failed from age or heat exposure.</li>
<li><strong>Loose or disconnected thermistor wires</strong> &ndash; The wiring connecting the thermistor to the control board has come loose from the connector.</li>
<li><strong>Damaged thermistor wiring</strong> &ndash; Wires routed near hot components can have insulation damage, creating shorts or opens.</li>
<li><strong>Thermistor exposed to excessive heat</strong> &ndash; A restricted airflow (clogged lint filter, blocked exhaust duct) can cause temperatures at the sensor location to exceed the sensor&rsquo;s rated limits, damaging it.</li>
</ul>

<h2>How to Troubleshoot the 001 / 003 Error Codes</h2>
<ol>
<li><strong>Clean the lint filter</strong> &ndash; Clean the lint filter thoroughly before every drying cycle. A clogged lint filter restricts airflow and can cause overheating that damages sensors.</li>
<li><strong>Check the exhaust duct</strong> &ndash; Inspect the exhaust duct from the dryer to the exterior vent for blockages, kinks, or obstructions. Poor exhaust flow causes extreme temperatures that can damage the inlet sensor.</li>
<li><strong>Reconnect loose wires</strong> &ndash; Access the inlet thermistor on the air inlet duct and ensure its wiring connector is firmly seated.</li>
<li><strong>Test thermistor resistance</strong> &ndash; A technician can test the thermistor resistance with a multimeter. Replace if the reading is outside the expected range for ambient temperature.</li>
<li><strong>Reset the dryer</strong> &ndash; Unplug for 60 seconds and retry after cleaning the lint filter and checking exhaust.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If 001 or 003 persist after lint filter cleaning and checking connections, the inlet thermistor requires replacement. <strong>Contact our Monogram dryer repair team</strong> for professional thermistor replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['002-004-defective-outlet-thermistor'] = <<<HTML
<h2>What Do Monogram Dryer Error Codes 002 and 004 Mean?</h2>
<p>Error codes 002 and 004 on a Monogram dryer indicate a <strong>defective outlet thermistor</strong> &mdash; the temperature sensor located on the blower housing or exhaust duct where air exits the dryer. The outlet thermistor measures the temperature of air leaving the drum and provides data to the control board to optimize drying efficiency. When the sensor reading is outside the expected range, these codes are triggered.</p>

<h2>Common Causes of the 002 / 004 Error Codes</h2>
<ul>
<li><strong>Failed outlet thermistor</strong> &ndash; The sensor element has failed electrically.</li>
<li><strong>Disconnected thermistor connector</strong> &ndash; The wiring harness to the sensor has come loose at the blower housing.</li>
<li><strong>Completely clogged exhaust system</strong> &ndash; A fully blocked exhaust system creates abnormally high temperatures at the outlet sensor, eventually damaging it.</li>
<li><strong>Damaged wiring</strong> &ndash; Thermistor wiring routed near the drum or heating element can become damaged from heat.</li>
</ul>

<h2>How to Troubleshoot the 002 / 004 Error Codes</h2>
<ol>
<li><strong>Reconnect loose wires</strong> &ndash; Check the wiring connector at the outlet thermistor on the blower housing and ensure it is firmly seated.</li>
<li><strong>Clean the exhaust system</strong> &ndash; Use a dryer duct cleaning kit to thoroughly clean the exhaust duct from the dryer to the exterior vent. A clogged duct is a frequent cause of outlet sensor damage.</li>
<li><strong>Test thermistor resistance</strong> &ndash; A technician can test the thermistor&rsquo;s resistance to determine if it has failed.</li>
<li><strong>Reset the dryer</strong> &ndash; Unplug for 60 seconds and retry after addressing any blockage.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If codes persist after checking connections and cleaning the exhaust, the outlet thermistor requires replacement. <strong>Contact our Monogram dryer repair team</strong> for professional thermistor replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['005-dryer-control-board-failure'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 005 Mean?</h2>
<p>The 005 error code on a Monogram dryer indicates a <strong>main control board failure</strong>. The main control board is the electronic brain of the dryer &mdash; it manages all functions including heating cycles, motor operation, cycle timing, sensor readings, and display communication. When the control board itself fails or detects an unrecoverable internal error, it records the 005 fault code.</p>

<h2>Common Causes of the 005 Error Code</h2>
<ul>
<li><strong>Power surge damage</strong> &ndash; Voltage spikes can damage sensitive electronic components on the control board.</li>
<li><strong>Component failure on the board</strong> &ndash; Individual capacitors, relays, or processors on the board can fail from age or manufacturing defects.</li>
<li><strong>Excessive heat exposure</strong> &ndash; A severely restricted exhaust system causes extreme internal temperatures that damage the control board over time.</li>
<li><strong>Moisture damage</strong> &ndash; In rare cases, moisture from a nearby plumbing leak can reach the control board.</li>
</ul>

<h2>How to Troubleshoot the 005 Error Code</h2>
<ol>
<li><strong>Unplug for 3 minutes</strong> &ndash; A longer power cycle than normal allows the control board&rsquo;s capacitors to fully discharge. After 3 minutes, restore power and check if the code clears.</li>
<li><strong>Check the exhaust system</strong> &ndash; Ensure the dryer has proper airflow to prevent overheating that can damage the board.</li>
<li><strong>Check for power surge history</strong> &ndash; If a recent storm or power event occurred, this may have damaged the board.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The 005 error almost always requires control board replacement. The board must be correctly matched to your Monogram dryer model. <strong>Contact our Monogram dryer repair team</strong> for professional control board diagnosis and replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['008-00d-door-switch-malfunction'] = <<<HTML
<h2>What Do Monogram Dryer Error Codes 008 and 00D Mean?</h2>
<p>Error codes 008 and 00D on a Monogram dryer indicate a <strong>door switch malfunction</strong> &mdash; the door switch is not providing a proper signal to the control board. The door switch is a safety device that detects whether the dryer door is open or closed. The dryer will not operate with an open door. If the door switch fails, the dryer may refuse to start even with the door fully closed.</p>

<h2>Common Causes of the 008 / 00D Error Codes</h2>
<ul>
<li><strong>Failed door switch</strong> &ndash; The mechanical switch has worn out and no longer makes proper electrical contact when the door is closed.</li>
<li><strong>Loose wiring to the door switch</strong> &ndash; The wiring connector at the switch has come loose.</li>
<li><strong>Broken door strike</strong> &ndash; The plastic piece on the door that presses the switch button has broken, so the switch doesn&rsquo;t physically activate when the door closes.</li>
<li><strong>Door misalignment</strong> &ndash; A door that is out of alignment may not press the switch sufficiently.</li>
</ul>

<h2>How to Troubleshoot the 008 / 00D Error Codes</h2>
<ol>
<li><strong>Check door closure</strong> &ndash; Open and firmly re-close the dryer door. Listen for the click of the latch engaging.</li>
<li><strong>Inspect the door strike</strong> &ndash; Look at the door&rsquo;s latch area for broken or damaged plastic components.</li>
<li><strong>Check wiring connections</strong> &ndash; If accessible, verify the wiring harness connector at the door switch is firmly seated.</li>
<li><strong>Reset the dryer</strong> &ndash; Unplug for 60 seconds and retry.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If door switch errors persist, the switch or its wiring requires replacement. <strong>Contact our Monogram dryer repair team</strong> for professional door switch diagnosis and replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['009-dryer-drive-motor-problem'] = <<<HTML
<h2>What Does Monogram Dryer Error Code 009 Mean?</h2>
<p>The 009 error code on a Monogram dryer indicates a <strong>drive motor problem</strong> &mdash; the motor that rotates the dryer drum and drives the blower wheel has a fault. The control board monitors motor operation through current sensors and tachometer inputs. When the motor draws abnormal current, fails to start, or provides unexpected speed readings, the 009 fault is recorded.</p>

<h2>Common Causes of the 009 Error Code</h2>
<ul>
<li><strong>Failed drive motor</strong> &ndash; The motor&rsquo;s windings have burned out or its bearings have seized.</li>
<li><strong>Loose motor wiring</strong> &ndash; The wiring harness connector to the motor has come loose, creating intermittent or no power delivery.</li>
<li><strong>Broken or worn drive belt</strong> &ndash; If the drive belt has broken, the motor runs unloaded (no drum rotation).</li>
<li><strong>Seized drum bearing or support</strong> &ndash; If the drum bearing has seized, the motor struggles to rotate the drum and may overheat and fail.</li>
</ul>

<h2>How to Troubleshoot the 009 Error Code</h2>
<ol>
<li><strong>Listen for motor sounds</strong> &ndash; Start a cycle and listen. A hum without drum rotation suggests a seized motor or broken belt. Complete silence suggests no power to the motor.</li>
<li><strong>Check motor wiring</strong> &ndash; Reconnect any loose wiring connectors on the motor if accessible.</li>
<li><strong>Check the drive belt</strong> &ndash; Access the dryer drum area and verify the drive belt is intact and properly seated on the drum, motor pulley, and idler pulley.</li>
<li><strong>Reset the dryer</strong> &ndash; Unplug for 60 seconds and retry.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Motor replacement requires full disassembly of the dryer cabinet. <strong>Contact our Monogram dryer repair team</strong> for professional motor and mechanical diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

// ============================================================
// REFRIGERATOR ERROR CODES
// ============================================================

$all_content['ff-freezer-temperature-too-high'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code FF Mean?</h2>
<p>The FF error code on a Monogram refrigerator indicates that the <strong>freezer temperature has risen above the safe freezing threshold</strong> &mdash; the internal temperature is higher than what is needed to keep food safely frozen. Monogram refrigerators continuously monitor freezer temperature using internal sensors. When the temperature rises above safe levels (typically above 15&deg;F / &minus;9&deg;C), the control board triggers the FF alert.</p>
<p>When FF appears, ice cream may have softened, ice cubes may have partially melted, or frozen foods may feel unusually pliable. This is a critical error requiring prompt attention to prevent food spoilage.</p>

<h2>Common Causes of the FF Error Code</h2>
<ul>
<li><strong>Door gasket failure</strong> &ndash; A worn, torn, or warped door seal allows warm air to infiltrate the freezer compartment. Even a small gap can raise freezer temperature significantly over time.</li>
<li><strong>Condenser coils clogged with dust</strong> &ndash; Dirty condenser coils reduce the refrigerator&rsquo;s ability to dissipate heat, reducing overall cooling efficiency.</li>
<li><strong>Evaporator fan motor failure</strong> &ndash; The evaporator fan circulates cold air throughout the freezer and refrigerator compartments. A failed fan motor results in a warm freezer even though the compressor is running.</li>
<li><strong>Defrost system malfunction</strong> &ndash; If the automatic defrost heater, defrost thermostat, or defrost timer fails, frost accumulates on the evaporator coils and blocks airflow, reducing cooling efficiency.</li>
<li><strong>Compressor or sealed system issue</strong> &ndash; A failing compressor or refrigerant leak prevents the system from maintaining adequate cooling capacity.</li>
</ul>

<h2>How to Troubleshoot the FF Error Code</h2>
<ol>
<li><strong>Check the freezer door</strong> &ndash; Inspect the door gasket for tears, gaps, or warping. Perform a paper test: place a sheet of paper in the door and close it &mdash; if the paper pulls out easily, the gasket needs replacement.</li>
<li><strong>Clean the condenser coils</strong> &ndash; Locate the condenser coils behind the kick plate at the bottom front of the refrigerator. Use a vacuum with a brush attachment to remove dust buildup every 6&ndash;12 months.</li>
<li><strong>Check the evaporator fan</strong> &ndash; Open the freezer and listen for the fan running. If you hear no airflow, the fan motor may have failed.</li>
<li><strong>Reset the refrigerator</strong> &ndash; Unplug for 30&ndash;60 seconds, then plug back in. This can clear temporary electronic errors triggering the FF code.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the FF error code persists after basic troubleshooting, professional diagnosis is required. <strong>Contact our Monogram refrigerator repair team</strong> for expert diagnosis and repair using factory-certified Monogram parts. Schedule your appointment today by calling {$phone}.</p>
HTML;

$all_content['pf-refrigerator-power-failure'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code PF Mean?</h2>
<p>The PF error code on a Monogram refrigerator stands for <strong>Power Failure</strong> &mdash; it indicates that the refrigerator&rsquo;s power supply was interrupted since the last time the display was cleared. This is an informational alert rather than a malfunction error. Monogram refrigerators are designed to log power interruptions so you are aware that cooling may have been paused.</p>
<p>When PF appears, the refrigerator has successfully restarted after the power interruption and is working to return to set temperatures. However, the duration of the outage determines whether food safety is a concern.</p>

<h2>Common Causes of the PF Error Code</h2>
<ul>
<li><strong>Power outage</strong> &ndash; A neighborhood or home power outage lasting any length of time will trigger PF when power is restored.</li>
<li><strong>Tripped circuit breaker</strong> &ndash; A tripped breaker in your electrical panel interrupts the refrigerator&rsquo;s power supply.</li>
<li><strong>Unplugging the refrigerator</strong> &ndash; Manually unplugging and re-plugging triggers PF.</li>
<li><strong>Loose power outlet connection</strong> &ndash; A loose plug connection can cause intermittent power interruptions.</li>
</ul>

<h2>How to Clear the PF Error Code</h2>
<ol>
<li><strong>Press the System Check or Alarm Reset button</strong> &ndash; On most Monogram refrigerator models, pressing the System Check, Reset, or Alarm Reset button clears the PF code.</li>
<li><strong>Check food safety</strong> &ndash; If the outage lasted more than 4 hours, inspect frozen and refrigerated foods for signs of thawing or spoilage. When in doubt, throw it out.</li>
<li><strong>Check the circuit breaker</strong> &ndash; Ensure the refrigerator&rsquo;s circuit breaker is fully in the ON position.</li>
<li><strong>Monitor temperatures</strong> &ndash; After clearing PF, verify that the refrigerator reaches set temperatures within 24 hours.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the PF code reappears frequently without a known power outage, the refrigerator may have an intermittent wiring problem or failing control board. <strong>Contact our Monogram refrigerator repair team</strong> for diagnosis and repair with factory-certified Monogram parts.</p>
HTML;

$all_content['ci-check-ice-maker'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code CI Mean?</h2>
<p>The CI error code on a Monogram refrigerator means <strong>Check Ice Maker</strong> &mdash; the refrigerator&rsquo;s diagnostics have detected a problem with the automatic ice maker system. This indicates the ice maker is not operating within expected parameters, such as failing to complete a harvest cycle or failing to receive water for a fill cycle.</p>

<h2>Common Causes of the CI Error Code</h2>
<ul>
<li><strong>Ice jam in the ice maker mold or bin</strong> &ndash; Ice cubes can fuse together into a large mass that prevents the ejector mechanism from completing the harvest cycle.</li>
<li><strong>Frozen fill tube</strong> &ndash; The small water inlet tube leading to the ice maker can freeze solid, preventing water from entering the mold.</li>
<li><strong>Failed water inlet valve</strong> &ndash; If the solenoid valve that controls water flow to the ice maker fails, no water enters the ice maker.</li>
<li><strong>Ice maker module failure</strong> &ndash; The electronic control module inside the ice maker assembly can fail, causing it to stop cycling.</li>
<li><strong>Freezer temperature too warm</strong> &ndash; If the freezer is above 15&deg;F (&minus;9&deg;C), ice takes too long to freeze, causing harvest cycle timeouts that trigger CI.</li>
</ul>

<h2>How to Troubleshoot the CI Error Code</h2>
<ol>
<li><strong>Toggle the ice maker</strong> &ndash; Turn the ice maker switch off, wait 30 seconds, then turn it back on to force a cycle restart.</li>
<li><strong>Check for ice jams</strong> &ndash; Remove the ice bin and break up any clumped or fused ice.</li>
<li><strong>Thaw the fill tube</strong> &ndash; If the fill tube appears frosted, carefully apply low heat with a hair dryer to thaw it.</li>
<li><strong>Verify water supply</strong> &ndash; Ensure the water supply line behind the refrigerator is connected and the valve is fully open.</li>
<li><strong>Check freezer temperature</strong> &ndash; Use a thermometer to confirm the freezer is at 0&deg;F (&minus;18&deg;C).</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the CI code persists after these steps, the water inlet valve or ice maker module may require replacement. <strong>Contact our Monogram refrigerator repair team</strong> for professional ice maker diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['de-defrost-system-problem'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code dE Mean?</h2>
<p>The dE error code on a Monogram refrigerator indicates that the <strong>automatic defrost system has not operated properly within the past 24 hours</strong>. Modern Monogram refrigerators run automatic defrost cycles periodically (typically every 8&ndash;12 hours) to melt frost that accumulates on the evaporator coils. When the control board detects a complete defrost cycle has not occurred in 24 hours, it displays the dE alert.</p>
<p>Without proper defrost cycles, frost builds on the evaporator coils, restricting airflow and reducing cooling efficiency. Over time, severe frost buildup can cause the freezer to stop cooling altogether.</p>

<h2>Common Causes of the dE Error Code</h2>
<ul>
<li><strong>Burned-out defrost heater</strong> &ndash; The electric heating element near the evaporator coils can burn through and fail open-circuit, preventing any defrost heating. This is the most common cause.</li>
<li><strong>Failed defrost thermostat (bi-metal)</strong> &ndash; The defrost termination thermostat can fail in the open position, permanently breaking the heater circuit.</li>
<li><strong>Defrost control board or timer failure</strong> &ndash; A failed adaptive defrost control board or mechanical timer can prevent defrost from initiating.</li>
<li><strong>Defrost temperature sensor failure</strong> &ndash; A failing sensor can cause the control board to abort defrost cycles prematurely.</li>
</ul>

<h2>How to Troubleshoot the dE Error Code</h2>
<ol>
<li><strong>Check for frost buildup</strong> &ndash; Open the freezer and look at the back wall and air vents. Heavy frost confirms the defrost system is not working.</li>
<li><strong>Manual defrost</strong> &ndash; Unplug the refrigerator and leave both doors open for 24&ndash;48 hours to clear accumulated frost. Place towels to collect meltwater.</li>
<li><strong>Monitor after restart</strong> &ndash; If frost returns rapidly within a few days, the defrost heater or thermostat has definitively failed.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Defrost heater, thermostat, and sensor components are behind the rear panel inside the freezer compartment and require disassembly to access and test. <strong>Contact our Monogram refrigerator repair team</strong> for professional defrost system diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['hrs-control-board-failure'] = <<<HTML
<h2>What Does Monogram Refrigerator Error Code HRS Mean?</h2>
<p>The HRS error code on a Monogram refrigerator indicates a <strong>main control board failure</strong>. This error typically appears following a power surge, lightning strike, or significant electrical disturbance that damages the refrigerator&rsquo;s primary electronic control module. The main control board manages all functions including temperature regulation, defrost cycles, ice maker operation, dispenser functions, and communication with the display panel.</p>

<h2>Common Causes of the HRS Error Code</h2>
<ul>
<li><strong>Power surge damage</strong> &ndash; Voltage spikes from lightning storms or utility switching can destroy sensitive electronic components on the control board. This is the most common cause of HRS.</li>
<li><strong>Electrical brownout damage</strong> &ndash; Prolonged low-voltage conditions can also damage control board components over time.</li>
<li><strong>Component failure on the control board</strong> &ndash; Individual capacitors, relays, or IC chips can fail from age or heat stress without a power surge.</li>
<li><strong>Water damage</strong> &ndash; Condensation or a leak reaching the control board can cause short circuits and board failure.</li>
</ul>

<h2>How to Troubleshoot the HRS Error Code</h2>
<ol>
<li><strong>Reset the refrigerator</strong> &ndash; Unplug for 10 minutes, then plug back in. A temporary glitch may clear with a complete power cycle.</li>
<li><strong>Check the circuit breaker</strong> &ndash; Ensure the breaker is fully ON and not damaged.</li>
<li><strong>Install a surge protector</strong> &ndash; For future protection, use an appliance-grade surge protector on the refrigerator outlet.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The HRS error code almost always requires professional control board replacement. <strong>Contact our Monogram refrigerator repair team</strong> for professional diagnosis and control board replacement using factory-certified Monogram parts. Schedule your appointment today by calling {$phone}.</p>
HTML;

// ============================================================
// OVEN ERROR CODES
// ============================================================

$all_content['f0-oven-stuck-touch-pad'] = <<<HTML
<h2>What Does Monogram Oven Error Code F0 Mean?</h2>
<p>The F0 error code on a Monogram oven or range indicates a <strong>stuck touch pad key</strong>. One or more buttons on the electronic control panel have been detected in a continuously pressed state. The control board interprets this as a stuck or shorted key and triggers F0 to prevent unintended oven operation. The oven will typically not respond to normal control inputs and may emit a continuous beeping sound.</p>

<h2>Common Causes of the F0 Error Code</h2>
<ul>
<li><strong>Moisture or liquid under the touch pad</strong> &ndash; Spills that seep beneath the glass or membrane touch pad can short out a key.</li>
<li><strong>Worn or failed touch pad membrane</strong> &ndash; Over time, the conductive layer beneath the touch pad can degrade, causing false key-press signals.</li>
<li><strong>Control board failure</strong> &ndash; In some cases, the ERC board generates false key-press signals, mimicking a stuck key.</li>
</ul>

<h2>How to Troubleshoot the F0 Error Code</h2>
<ol>
<li><strong>Power cycle the oven</strong> &ndash; Turn off the circuit breaker for 60 seconds, then restore power. A temporary electronic glitch can cause false stuck-key readings that clear with a reset.</li>
<li><strong>Inspect the touch pad for damage</strong> &ndash; Look for cracks, discoloration from liquid damage, or raised areas on the keypad surface.</li>
<li><strong>Clean around the touch pad edges</strong> &ndash; Use a soft damp cloth to clean any food residue or moisture from around the keypad edges. Let the oven sit unpowered for an hour before retrying.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the F0 error returns consistently, the touch pad assembly or the electronic range control board requires replacement. <strong>Contact our Monogram oven repair team</strong> for professional diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['f2-oven-temperature-too-high'] = <<<HTML
<h2>What Does Monogram Oven Error Code F2 Mean?</h2>
<p>The F2 error code on a Monogram oven or range indicates that the <strong>oven temperature has exceeded the safe operating threshold</strong>. There are two F2 scenarios:</p>
<ul>
<li><strong>During Bake mode:</strong> F2 triggers when oven temperature exceeds approximately 615&ndash;630&deg;F (324&ndash;332&deg;C)</li>
<li><strong>During Self-Clean mode:</strong> F2 triggers when oven temperature exceeds approximately 915&ndash;930&deg;F (490&ndash;499&deg;C)</li>
</ul>
<p>When F2 appears, the oven shuts down all heating to protect the appliance and your home from a potential runaway temperature condition.</p>

<h2>Common Causes of the F2 Error Code</h2>
<ul>
<li><strong>Welded or stuck relay contacts on the control board</strong> &ndash; The relay that controls the bake or broil heating elements can weld closed in the ON position, causing the element to run continuously. This is the most common cause of F2.</li>
<li><strong>Shorted temperature sensor</strong> &ndash; A shorted RTD sensor can send a false low-temperature reading, causing the control board to continuously power the heating elements.</li>
<li><strong>Faulty control board</strong> &ndash; The control board may fail to send the shutoff signal to the heating element relay.</li>
</ul>

<h2>How to Troubleshoot the F2 Error Code</h2>
<ol>
<li><strong>Turn off the circuit breaker immediately</strong> &ndash; If the F2 code appears and the oven feels excessively hot, cut power at the breaker for safety.</li>
<li><strong>Allow the oven to cool completely</strong> &ndash; Before any inspection, ensure the oven is at room temperature.</li>
<li><strong>Reset and monitor</strong> &ndash; After cooling, restore power and run the oven at a moderate temperature (350&deg;F). If temperature climbs uncontrollably, there is a relay or sensor issue.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The F2 error involving stuck relay contacts presents a safety risk. <strong>Contact our Monogram oven repair team immediately</strong> for diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['f3-oven-open-temperature-sensor'] = <<<HTML
<h2>What Does Monogram Oven Error Code F3 Mean?</h2>
<p>The F3 error code on a Monogram oven or range indicates that the <strong>oven temperature sensor (RTD probe) circuit is open</strong> &mdash; the electrical path through the sensor has been broken. The control board sends a small current through the temperature sensor and expects to measure a specific resistance value. An open circuit means the current finds no path through the sensor, returning infinite resistance. Without a functioning temperature sensor, the oven cannot measure or regulate its internal temperature, making safe cooking impossible.</p>

<h2>Common Causes of the F3 Error Code</h2>
<ul>
<li><strong>Broken or disconnected temperature sensor wiring</strong> &ndash; The wires connecting the sensor to the control board can break from metal fatigue due to repeated heating and cooling cycles.</li>
<li><strong>Burned or damaged sensor probe</strong> &ndash; The metal probe can be physically damaged from contact with heavy cookware.</li>
<li><strong>Failed temperature sensor</strong> &ndash; The RTD sensor element inside the probe can fail and develop an open circuit from thermal stress over years of high-temperature operation.</li>
</ul>

<h2>How to Troubleshoot the F3 Error Code</h2>
<ol>
<li><strong>Reset the oven</strong> &ndash; Turn off the breaker for 60 seconds and retry. Confirm F3 returns before proceeding.</li>
<li><strong>Inspect the sensor probe</strong> &ndash; Look at the sensor probe mounted on the rear upper wall inside the oven cavity for visible damage.</li>
<li><strong>Test sensor resistance</strong> &ndash; A technician can test the sensor with a multimeter. A properly functioning Monogram oven RTD sensor reads approximately 1100 ohms at room temperature. Infinite resistance confirms an open circuit.</li>
</ol>

<h2>When to Call a Professional</h2>
<p><strong>Contact our Monogram oven repair team</strong> for professional diagnosis and temperature sensor replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['f4-oven-shorted-temperature-sensor'] = <<<HTML
<h2>What Does Monogram Oven Error Code F4 Mean?</h2>
<p>The F4 error code on a Monogram oven or range indicates that the <strong>oven temperature sensor (RTD probe) is shorted</strong> &mdash; the resistance reading from the sensor is near zero ohms, far below the normal operating range. A shorted sensor tells the control board that the oven is extremely cold, causing it to run heating elements continuously in an attempt to reach the set temperature. This can result in runaway temperatures and is a safety risk.</p>

<h2>Common Causes of the F4 Error Code</h2>
<ul>
<li><strong>Shorted temperature sensor element</strong> &ndash; The internal resistance element in the RTD probe has short-circuited from thermal degradation.</li>
<li><strong>Pinched or damaged sensor wiring</strong> &ndash; Wires routed near sharp edges or hot surfaces can have insulation damaged, creating a short circuit to the oven chassis.</li>
</ul>

<h2>How to Troubleshoot the F4 Error Code</h2>
<ol>
<li><strong>Reset the oven</strong> &ndash; Turn off the circuit breaker for 60 seconds. If F4 immediately returns, the sensor has definitively failed.</li>
<li><strong>Test the sensor resistance</strong> &ndash; With the oven unplugged, disconnect the sensor and measure resistance. A reading near zero (short circuit) rather than the expected ~1100 ohms confirms sensor failure.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The F4 error requires temperature sensor replacement. Because a shorted sensor can cause overheating, it should not be ignored. <strong>Contact our Monogram oven repair team</strong> for sensor replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['f9-oven-door-lock-circuit-fault'] = <<<HTML
<h2>What Does Monogram Oven Error Code F9 Mean?</h2>
<p>The F9 error code on a Monogram oven or range indicates a <strong>door lock circuit fault</strong>. This error most commonly appears when attempting to run a self-clean cycle, which requires the oven door to lock for safety during the extremely high temperatures used to incinerate food residue. If the door lock motor fails to lock or unlock within the expected timeframe, or if the door lock switches provide unexpected signals, F9 is triggered.</p>

<h2>Common Causes of the F9 Error Code</h2>
<ul>
<li><strong>Pinched or damaged wiring between ERC and door lock</strong> &ndash; Wiring running from the control board to the door lock motor and switches can be pinched during installation.</li>
<li><strong>Failed door lock motor</strong> &ndash; The small motor that drives the door lock mechanism can burn out or become mechanically stuck.</li>
<li><strong>Failed door lock switches</strong> &ndash; The limit switches that confirm the door lock status can fail.</li>
<li><strong>Mechanical obstruction</strong> &ndash; Debris or warped door components can physically prevent the lock mechanism from completing its travel.</li>
</ul>

<h2>How to Troubleshoot the F9 Error Code</h2>
<ol>
<li><strong>Reset the oven</strong> &ndash; Turn off the circuit breaker for 5 minutes to reset the control board. Retry starting a self-clean cycle.</li>
<li><strong>Listen for the lock motor</strong> &ndash; When self-clean is initiated, listen for the motor attempting to engage the lock. Silence suggests the motor is not receiving power.</li>
<li><strong>Check door alignment</strong> &ndash; Ensure the oven door closes squarely and the lock mechanism has a clear path to engage.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Door lock motor and switch replacement requires partial disassembly of the oven. <strong>Contact our Monogram oven repair team</strong> for professional door lock system repair using factory-certified Monogram parts.</p>
HTML;

$all_content['fff-oven-eeprom-failure'] = <<<HTML
<h2>What Does Monogram Oven Error Code FFF Mean?</h2>
<p>The FFF error code on a Monogram oven or range indicates a <strong>control board EEPROM (Electrically Erasable Programmable Read-Only Memory) failure</strong>. The EEPROM chip on the control board stores the oven&rsquo;s operating parameters, calibration data, and programmed settings. When this chip fails, the control board cannot access the data it needs to operate the oven correctly. This is a critical fault that renders the oven non-functional until the control board is replaced.</p>

<h2>Common Causes of the FFF Error Code</h2>
<ul>
<li><strong>EEPROM chip failure</strong> &ndash; The non-volatile memory chip fails from age, write-cycle exhaustion, or electronic damage.</li>
<li><strong>Power surge or electrical disturbance</strong> &ndash; A voltage spike can corrupt the data stored in EEPROM.</li>
<li><strong>Control board age</strong> &ndash; After many years of operation, EEPROM chips can reach end of life.</li>
</ul>

<h2>How to Troubleshoot the FFF Error Code</h2>
<ol>
<li><strong>Reset the oven</strong> &ndash; Power cycle via the circuit breaker for 5&ndash;10 minutes. In rare cases, a power interruption during a write cycle can cause a temporary FFF that clears with a reset.</li>
<li><strong>Confirm the error persists</strong> &ndash; If FFF immediately returns after reset, the EEPROM or control board has definitively failed.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The FFF error always requires replacement of the electronic range control (ERC) board, as the EEPROM chip is integrated into the board. <strong>Contact our Monogram oven repair team</strong> for control board replacement using factory-certified Monogram parts. Schedule your appointment today by calling {$phone}.</p>
HTML;

// ============================================================
// COOKTOP ERROR CODES
// ============================================================

$all_content['f-induction-no-cookware-detected'] = <<<HTML
<h2>What Does Monogram Induction Cooktop Error Code F Mean?</h2>
<p>The F error code on a Monogram induction cooktop indicates that <strong>no compatible (induction-capable) cookware has been detected on the cooking zone</strong>. Induction cooktops work by generating an electromagnetic field that heats only ferromagnetic cookware placed directly on the glass surface. When you activate a cooking zone, it searches for a compatible magnetic pot or pan. If no cookware is placed on the zone, if the cookware is not centered, or if the cookware is not induction-compatible, the cooktop displays the F code.</p>
<p>This is not a malfunction &mdash; it is a normal status indicator. However, persistent F errors when cookware is present can indicate a sensor problem.</p>

<h2>Common Causes of the F Error Code</h2>
<ul>
<li><strong>Non-induction-compatible cookware</strong> &ndash; Aluminum, copper, glass, ceramic, and some stainless steel pots are not induction-compatible. Only ferromagnetic materials (cast iron, magnetic stainless steel) work on induction cooktops.</li>
<li><strong>Cookware not centered</strong> &ndash; The pan must be positioned directly over the center of the induction coil.</li>
<li><strong>Cookware too small</strong> &ndash; Each zone has a minimum cookware diameter requirement.</li>
<li><strong>No cookware on the zone</strong> &ndash; The zone was activated without a pot or pan placed on it.</li>
</ul>

<h2>How to Troubleshoot the F Error Code</h2>
<ol>
<li><strong>Check cookware compatibility</strong> &ndash; Test your cookware with a magnet. If a magnet sticks firmly to the bottom, it is induction-compatible.</li>
<li><strong>Center the cookware</strong> &ndash; Position the pot directly over the center of the cooking zone.</li>
<li><strong>Use the correct size cookware</strong> &ndash; Match the pot size to the zone size per your Monogram cooktop owner&rsquo;s manual.</li>
<li><strong>Test with a known-compatible pan</strong> &ndash; Try a cast iron skillet to isolate whether the issue is the cookware or the cooktop sensor.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If F appears consistently with confirmed induction-compatible, properly sized, and centered cookware, the induction coil sensor may have failed. <strong>Contact our Monogram cooktop repair team</strong> for professional diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['f7x-cooling-fan-speed-too-low'] = <<<HTML
<h2>What Does Monogram Cooktop Error Code F7X Mean?</h2>
<p>The F7X error code (where X is a number) on a Monogram cooktop indicates that the <strong>internal cooling fan speed is too low</strong> &mdash; the fan is either running slower than its required minimum speed or has stopped. Monogram induction cooktops use internal cooling fans to protect the sensitive electronic components (power inverters, control boards, and induction coils) from overheating. When the control board detects insufficient fan speed, it triggers the F7X fault and may reduce or shut down cooktop operation to prevent component damage.</p>

<h2>Common Causes of the F7X Error Code</h2>
<ul>
<li><strong>Dirt and debris accumulation around the cooling fan</strong> &ndash; Dust, grease, and cooking residue build up around the fan intake vents and restrict airflow.</li>
<li><strong>Faulty cooling fan motor</strong> &ndash; The fan motor can fail from worn bearings, electrical failure, or physical damage.</li>
<li><strong>Blocked ventilation path</strong> &ndash; Items placed near the cooktop&rsquo;s ventilation slots or an improper installation can obstruct airflow.</li>
</ul>

<h2>How to Troubleshoot the F7X Error Code</h2>
<ol>
<li><strong>Turn off the cooktop</strong> &ndash; Power off at the circuit breaker immediately to prevent overheating damage.</li>
<li><strong>Check ventilation clearances</strong> &ndash; Ensure nothing is blocking the cooktop&rsquo;s air intake and exhaust vents.</li>
<li><strong>Clean the ventilation vents</strong> &ndash; Vacuum dust and debris from the ventilation slots carefully.</li>
<li><strong>Allow the cooktop to cool</strong> &ndash; Allow 15&ndash;20 minutes of cooling before restoring power and retesting.</li>
<li><strong>Listen for the fan</strong> &ndash; When powered on, you should hear the cooling fan running. Silence or unusual rattling suggests a fan problem.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the F7X error persists after clearing obstructions and cleaning vents, the cooling fan motor requires replacement. <strong>Contact our Monogram cooktop repair team</strong> for professional cooling fan diagnosis and replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['f160-pan-detection-communication-failure'] = <<<HTML
<h2>What Does Monogram Induction Cooktop Error Code F160 Mean?</h2>
<p>The F160 error code on a Monogram induction cooktop indicates a <strong>pan detection communication failure</strong> &mdash; the cooktop&rsquo;s control board has lost proper communication with the inductive sensor system that detects whether compatible cookware is present on a cooking zone. This is a hardware-level communication fault between the main control board and the pan-sensing subsystem.</p>

<h2>Common Causes of the F160 Error Code</h2>
<ul>
<li><strong>Main control board failure</strong> &ndash; The communication interface on the control board that talks to the pan-sensing coils has failed.</li>
<li><strong>Inductive sensor wiring failure</strong> &ndash; The wiring between the control board and the cooking zone induction coils may be damaged or disconnected.</li>
<li><strong>Power surge damage</strong> &ndash; Voltage spikes can damage the communication circuits on the control board.</li>
</ul>

<h2>How to Troubleshoot the F160 Error Code</h2>
<ol>
<li><strong>Reset the cooktop</strong> &ndash; Turn off the circuit breaker for 5 minutes to allow a full power-down reset of all electronic components.</li>
<li><strong>Retry and observe</strong> &ndash; After reset, test whether F160 returns immediately or only under certain conditions.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>The F160 error almost always requires professional diagnosis and control board replacement with inductive sensor recalibration. <strong>Contact our Monogram cooktop repair team</strong> for expert induction cooktop repair using factory-certified Monogram parts.</p>
HTML;

// ============================================================
// MICROWAVE ERROR CODES
// ============================================================

$all_content['f1-microwave-open-thermal-sensor'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F1 Mean?</h2>
<p>The F1 error code on a Monogram microwave indicates that the <strong>thermal sensor (thermistor) has an open circuit or that the microwave cavity has experienced excessive heat</strong>. The thermal sensor continuously monitors the internal temperature of the microwave&rsquo;s magnetron and cavity. If the temperature exceeds safe limits, the sensor circuit opens as a safety mechanism, or the sensor itself can fail open from heat damage. When F1 appears, the microwave will typically stop all cooking operations until the error is resolved.</p>

<h2>Common Causes of the F1 Error Code</h2>
<ul>
<li><strong>Excessive heat in the microwave cavity</strong> &ndash; Running the microwave empty, or using it at maximum power for extended periods, can raise cavity temperature to levels that trigger the thermal sensor.</li>
<li><strong>Failed thermal sensor (thermistor)</strong> &ndash; The thermal sensor&rsquo;s internal element can burn out and develop an open circuit, triggering F1 even at normal operating temperatures.</li>
<li><strong>Blocked or insufficient ventilation</strong> &ndash; If the microwave&rsquo;s ventilation is restricted (dirty grease filters, cabinet installation with blocked top vents), heat cannot escape properly.</li>
<li><strong>Dirty interior</strong> &ndash; Heavy grease and food buildup absorbs microwave energy and re-radiates it as heat, raising cavity temperature.</li>
</ul>

<h2>How to Troubleshoot the F1 Error Code</h2>
<ol>
<li><strong>Allow the microwave to cool</strong> &ndash; Open the door and let it rest for 20&ndash;30 minutes. If caused by temporary overheating, the thermal sensor may reset once temperatures drop.</li>
<li><strong>Reset the microwave</strong> &ndash; Unplug for 60 seconds or flip the circuit breaker off and on. Retry operation.</li>
<li><strong>Clean the microwave interior</strong> &ndash; Remove all food residue and grease buildup from the interior walls, floor, and ceiling.</li>
<li><strong>Check the ventilation</strong> &ndash; For over-the-range models, clean or replace the grease filter. Ensure the top of the microwave has adequate clearance for venting.</li>
<li><strong>Avoid running the microwave empty</strong> &ndash; Never run the microwave with nothing inside &mdash; the energy has nowhere to go and rapidly raises cavity temperature.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If F1 returns after cooling and cleaning, the thermal sensor has likely failed. Microwave repairs should only be performed by qualified technicians due to the risk of stored electrical charge in the high-voltage capacitor. <strong>Contact our Monogram microwave repair team</strong> for safe and professional thermal sensor replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['f3-microwave-shorted-touch-pad'] = <<<HTML
<h2>What Does Monogram Microwave Error Code F3 Mean?</h2>
<p>The F3 error code on a Monogram microwave indicates a <strong>shorted touch pad panel</strong> &mdash; the control panel&rsquo;s keypad or membrane has developed a short circuit, causing the control board to receive false or continuous input signals from the panel. This can cause erratic microwave behavior, unresponsive controls, or the microwave failing to start.</p>

<h2>Common Causes of the F3 Error Code</h2>
<ul>
<li><strong>Liquid damage to the touch panel</strong> &ndash; Splashes or steam condensation entering the touch panel creates short circuits between the panel&rsquo;s conductive layers.</li>
<li><strong>Worn touch panel membrane</strong> &ndash; Aging conductive layers in the touch panel can degrade and develop shorts between adjacent key circuits.</li>
<li><strong>Physical damage to the panel</strong> &ndash; Cracking or impact damage to the touch panel glass or membrane.</li>
</ul>

<h2>How to Troubleshoot the F3 Error Code</h2>
<ol>
<li><strong>Clean around the touch panel</strong> &ndash; With the microwave unplugged, gently clean around the control panel edges with a slightly damp cloth to remove grease and residue.</li>
<li><strong>Allow drying time</strong> &ndash; If liquid was recently spilled near the controls, allow 24&ndash;48 hours for the panel to dry completely before retrying.</li>
<li><strong>Reset the microwave</strong> &ndash; Unplug for 60 seconds and retry.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If F3 persists, the touch pad panel assembly requires replacement. <strong>Contact our Monogram microwave repair team</strong> for professional touch pad replacement using factory-certified Monogram parts.</p>
HTML;

$all_content['pf-888-power-failure-display-reset'] = <<<HTML
<h2>What Does Monogram Microwave Error Code PF, 888, or 8888 Mean?</h2>
<p>The PF, 888, or 8888 display on a Monogram microwave is <strong>not an error code indicating a malfunction</strong> &mdash; these codes appear after the initial installation of a new microwave or after a power interruption (power outage, circuit breaker trip, or unplugging). They indicate that the microwave&rsquo;s memory has been cleared and the clock needs to be reset.</p>
<ul>
<li><strong>PF</strong> = Power Failure</li>
<li><strong>888</strong> or <strong>8888</strong> = Display test pattern shown after initial power-up</li>
</ul>

<h2>How to Clear PF / 888 / 8888</h2>
<ol>
<li><strong>Press CLEAR or CANCEL</strong> &ndash; On most Monogram microwave models, pressing the CLEAR or CANCEL button once clears the PF or 888 display.</li>
<li><strong>Set the clock</strong> &ndash; After clearing, set the correct time using the Clock setting button.</li>
</ol>
<p>No professional service is required for PF, 888, or 8888 display codes. These are normal post-power-interruption displays. If the code reappears frequently, check the circuit breaker supplying the microwave and inspect the outlet for a loose connection.</p>

<h2>When to Call a Professional</h2>
<p>If PF or 888 reappears repeatedly without any known power outages, the microwave may have an intermittent electrical connection or a failing control board. <strong>Contact our Monogram microwave repair team</strong> for diagnosis and repair using factory-certified Monogram parts. Call {$phone} to schedule an appointment.</p>
HTML;

// ============================================================
// FREEZER ERROR CODES
// ============================================================

$all_content['ff-freezer-temperature-alarm'] = <<<HTML
<h2>What Does Monogram Freezer Error Code FF Mean?</h2>
<p>The FF error code on a Monogram freezer indicates that the <strong>freezer temperature has risen above the safe threshold</strong> &mdash; the internal temperature is higher than what is needed to keep food safely frozen. Monogram column freezers and undercounter freezers continuously monitor temperature using precision sensors. When the temperature rises above approximately 15&deg;F (&minus;9&deg;C) and cannot return to safe freezing levels, the FF alert is triggered.</p>
<p>When FF appears, food stored in the freezer may already be partially or fully thawing. This is a critical alert requiring prompt action to prevent food spoilage and food safety issues.</p>

<h2>Common Causes of the FF Error Code</h2>
<ul>
<li><strong>Door gasket failure or seal problem</strong> &ndash; A damaged, warped, or poorly sealing door gasket allows warm room-temperature air to continuously infiltrate the freezer compartment.</li>
<li><strong>Evaporator fan motor failure</strong> &ndash; The evaporator fan circulates cold air throughout the freezer. A failed fan motor means cold air cannot circulate and the freezer warms up even though the compressor is running.</li>
<li><strong>Defrost system failure</strong> &ndash; If the defrost heater, thermostat, or defrost control fails, frost accumulates on the evaporator coils and eventually blocks all airflow, preventing cooling.</li>
<li><strong>Condenser coils clogged</strong> &ndash; Dust and debris on the condenser coils prevent proper heat dissipation.</li>
<li><strong>Compressor or sealed system issue</strong> &ndash; A failing compressor or refrigerant leak reduces the system&rsquo;s ability to maintain freezing temperatures.</li>
</ul>

<h2>How to Troubleshoot the FF Error Code</h2>
<ol>
<li><strong>Check the door seal</strong> &ndash; Perform a paper test: insert a piece of paper in the door and close it; if you can pull the paper out easily, the seal is inadequate.</li>
<li><strong>Check for frost buildup</strong> &ndash; Open the freezer and inspect the back wall and air vents for excessive frost accumulation, which indicates a defrost system failure.</li>
<li><strong>Listen for the evaporator fan</strong> &ndash; With the door open, press the door switch to activate the fan. You should hear the fan running. No sound suggests a motor failure.</li>
<li><strong>Clean the condenser coils</strong> &ndash; Locate the condenser coils and vacuum them carefully with a brush attachment.</li>
<li><strong>Reset the freezer</strong> &ndash; Unplug for 30&ndash;60 seconds and plug back in. If temperature was temporarily elevated from a door left open, the freezer should recover.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If FF persists after checking the door seal, cleaning coils, and verifying the fan runs, professional diagnosis is required. <strong>Contact our Monogram freezer repair team immediately</strong> to protect your frozen food and appliance. Call {$phone} to schedule your repair appointment today.</p>
HTML;

$all_content['de-freezer-defrost-system-fault'] = <<<HTML
<h2>What Does Monogram Freezer Error Code dE Mean?</h2>
<p>The dE error code on a Monogram freezer indicates that the <strong>automatic defrost system has not operated properly within the past 24 hours</strong>. Modern Monogram freezers run automatic defrost cycles periodically to melt frost that accumulates on the evaporator coils during normal operation. When the control board detects that a complete defrost cycle has not occurred within the expected timeframe, it displays the dE alert.</p>
<p>Without proper defrost cycling, frost builds progressively on the evaporator coils. Eventually the frost layer becomes thick enough to completely block airflow over the coils, stopping cooling entirely. The FF (temperature too high) code often follows a prolonged dE condition.</p>

<h2>Common Causes of the dE Error Code</h2>
<ul>
<li><strong>Burned-out defrost heater</strong> &ndash; The electric heating element near the evaporator coils has burned out and developed an open circuit. This is the most common cause of the dE error.</li>
<li><strong>Failed defrost thermostat (bi-metal limiter)</strong> &ndash; The defrost termination thermostat can fail in the open position, permanently breaking the heater circuit.</li>
<li><strong>Failed defrost temperature sensor</strong> &ndash; A failing sensor can cause the control board to abort defrost cycles prematurely.</li>
<li><strong>Defrost control board or timer failure</strong> &ndash; A failed adaptive defrost control board or mechanical timer prevents the system from initiating defrost.</li>
</ul>

<h2>How to Troubleshoot the dE Error Code</h2>
<ol>
<li><strong>Look for frost buildup</strong> &ndash; Open the freezer and inspect the rear panel for heavy frost or ice. Extensive frost buildup confirms the defrost system has failed.</li>
<li><strong>Manual defrost</strong> &ndash; Unplug the freezer and leave the door open with towels on the floor to catch meltwater. Allow 24&ndash;48 hours for a complete defrost.</li>
<li><strong>Observe how quickly frost returns</strong> &ndash; After the manual defrost, plug in and monitor. If frost returns rapidly within a few days, the defrost heater or thermostat has definitively failed.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>Accessing the evaporator coils to test and replace defrost components requires removing the interior rear panel of the freezer. <strong>Contact our Monogram freezer repair team</strong> for professional defrost system diagnosis and repair using factory-certified Monogram parts.</p>
HTML;

$all_content['cc-freezer-temperature-incorrect'] = <<<HTML
<h2>What Does Monogram Freezer Error Code CC Mean?</h2>
<p>The CC error code on a Monogram freezer indicates that the <strong>freezer compartment temperature is incorrect &mdash; specifically, too warm compared to the target set temperature</strong>. The control board continuously compares the actual internal temperature against the set temperature. When the actual temperature remains significantly higher than set for an extended period and the cooling system cannot bring it into the acceptable range, the CC code is triggered.</p>

<h2>Common Causes of the CC Error Code</h2>
<ul>
<li><strong>Dirty or clogged condenser coils</strong> &ndash; Dust, pet hair, and debris on the condenser coils are the most common cause. Clogged coils cannot efficiently release heat, reducing the entire cooling system&rsquo;s effectiveness.</li>
<li><strong>Inadequate ventilation clearance</strong> &ndash; Monogram column freezers require specified clearances. Insufficient clearance traps heat around the condenser, reducing efficiency.</li>
<li><strong>Overloaded freezer with warm items</strong> &ndash; Too much warm food placed in the freezer at once raises the temperature significantly.</li>
<li><strong>Refrigerant system issue</strong> &ndash; Low refrigerant or a failing compressor reduces the system&rsquo;s cooling capacity.</li>
</ul>

<h2>How to Troubleshoot the CC Error Code</h2>
<ol>
<li><strong>Clean the condenser coils</strong> &ndash; Locate and vacuum the condenser coils thoroughly with a soft brush attachment. This is the most impactful first step.</li>
<li><strong>Check clearances</strong> &ndash; Verify the freezer has required air clearance on all sides per Monogram installation specifications.</li>
<li><strong>Check the door seal</strong> &ndash; Inspect the door gasket for any gaps or damage that allows warm air infiltration.</li>
<li><strong>Reset the freezer</strong> &ndash; Unplug for 30 seconds and plug back in. The control board will recalibrate temperature monitoring.</li>
</ol>

<h2>When to Call a Professional</h2>
<p>If the CC error persists after cleaning coils and verifying clearances, professional diagnosis of the refrigerant system, compressor, or temperature sensor is needed. <strong>Contact our Monogram freezer repair team</strong> for expert diagnosis and repair using factory-certified Monogram parts. Schedule your appointment today by calling {$phone}.</p>
HTML;

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

// ── DISHWASHER ──────────────────────────────────────────────

$all_content['start-light-flashing-cycle-interrupted'] = <<<HTML
<h2>What Does Monogram Dishwasher Start Light Flashing Mean?</h2>
<p>A flashing Start light on a Monogram dishwasher indicates that <strong>the dishwasher door was opened during an active wash cycle or the cycle was otherwise interrupted</strong>. When the control board loses the door-locked signal during an active cycle, it pauses the cycle and causes the Start indicator to flash.</p>
<p>This is not a component malfunction &mdash; it is a cycle state notification that requires a simple user action to resolve.</p>
<h2>Common Causes of Start Light Flashing</h2>
<ul>
<li><strong>Door opened during wash cycle</strong> &ndash; Opening the door during any phase of the cycle (wash, rinse, dry) causes the cycle to pause and the Start light to flash.</li>
<li><strong>Power interruption</strong> &ndash; A brief power fluctuation or outage during a cycle can cause the control board to lose cycle state.</li>
<li><strong>Door latch not fully engaged</strong> &ndash; The control board may interpret an incompletely latched door as a door-open event.</li>
</ul>
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
<li><strong>Overfilling from a faulty inlet valve</strong> &ndash; An inlet valve that fails to close can overfill the tub, causing water to overflow into the base pan.</li>
<li><strong>Cracked sump or tub</strong> &ndash; In older units, the plastic tub or sump can develop hairline cracks.</li>
</ul>
<h2>How to Troubleshoot LEAK DETECTED</h2>
<ol>
<li><strong>Stop using the dishwasher</strong> &ndash; Do not run it again until the leak source is identified.</li>
<li><strong>Unplug or cut power</strong> &ndash; Turn off power at the circuit breaker.</li>
<li><strong>Check the door gasket</strong> &ndash; Inspect the entire perimeter of the door gasket for cracks or areas where it has separated.</li>
<li><strong>Allow the base pan to dry</strong> &ndash; The float switch will keep the alert active until the accumulated water evaporates or is removed. The base pan must be dry before normal operation resumes.</li>
</ol>
<h2>When to Call a Professional</h2>
<p>Internal hose replacements, gasket replacement, and inlet valve replacement require partial or full disassembly. <strong>Contact our Monogram dishwasher repair team</strong> at {$phone} for leak diagnosis and repair. Do not delay &mdash; water damage can escalate quickly.</p>
HTML;

$all_content['end-of-cycle-beeping'] = <<<HTML
<h2>What Does Monogram Dishwasher End-of-Cycle Beeping Mean?</h2>
<p>The beeping at the end of a Monogram dishwasher cycle is <strong>normal operation</strong> &mdash; it is the end-of-cycle completion signal indicating that the wash cycle has finished successfully. This is not an error code. However, the sound can be adjusted or disabled on most Monogram dishwasher models.</p>
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

// ── REFRIGERATOR (additional) ───────────────────────────────

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
<li><strong>Stuck touch pad key</strong> &ndash; A consistently stuck key can trigger F1 on some Monogram range models.</li>
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
<p>The F1 error code on a Monogram cooktop indicates a <strong>stuck touch pad key</strong> &mdash; one or more buttons on the touch control panel have been detected in a continuously pressed or shorted state. The control system triggers F1 to prevent unintended cooking zone operation.</p>
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
