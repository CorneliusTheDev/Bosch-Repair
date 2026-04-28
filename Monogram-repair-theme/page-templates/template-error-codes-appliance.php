<?php
/**
 * Template Name: Error Codes – Appliance Listing
 *
 * Lists all error codes for a specific appliance type.
 * URL: /error-codes/dishwasher/
 * Detail: /error-codes/dishwasher/?code=e15
 *
 * @package MonogramRepairPro
 */
get_header();

$appliance_slug  = get_post_field( 'post_name', get_the_ID() );

// Map slug to clean appliance label (avoids "Monogram Dishwasher Error Codes" duplication)
$appliance_labels = array(
    'dishwasher'   => 'Dishwasher',
    'washer'       => 'Washer',
    'dryer'        => 'Dryer',
    'refrigerator' => 'Refrigerator',
    'oven'         => 'Oven & Range',
    'cooktop'      => 'Cooktop',
    'microwave'    => 'Microwave',
    'freezer'      => 'Freezer',
    'wine-cooler'  => 'Wine Cooler',
    'hood'         => 'Range Hood',
);
$appliance_title = isset( $appliance_labels[ $appliance_slug ] ) ? $appliance_labels[ $appliance_slug ] : get_the_title();

// Built-in error code data by appliance
// Load error codes from DB only
$db_ec_query = new WP_Query( array(
    'post_type'      => 'error_code',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value',
    'meta_key'       => '_brp_error_code',
    'order'          => 'ASC',
    'tax_query'      => array(
        array(
            'taxonomy' => 'appliance_type',
            'field'    => 'slug',
            'terms'    => $appliance_slug,
        ),
    ),
) );

$code_map = array();
if ( $db_ec_query->have_posts() ) {
    while ( $db_ec_query->have_posts() ) {
        $db_ec_query->the_post();
        $code_val = get_post_meta( get_the_ID(), '_brp_error_code', true );
        $code_val = $code_val ? strtoupper( trim( $code_val ) ) : strtoupper( get_the_title() );
        $key      = strtolower( str_replace( ' ', '', $code_val ) );
        $code_map[ $key ] = array(
            'code'      => $code_val,
            'title'     => get_the_title(),
            'desc'      => get_the_excerpt() ?: wp_trim_words( get_the_content(), 40, '...' ),
            'permalink' => get_permalink(),
            'from_db'   => true,
        );
    }
    wp_reset_postdata();
}

// ── Hardcoded fallback data (used when DB has no error_code posts) ──────────
$fallback_data = array(

    'dishwasher' => array(
        'C1' => array( 'title' => 'Water Not Filling / No Water Inlet',       'desc' => 'The dishwasher is not receiving water. Check that the supply valve is fully open, the inlet hose is not kinked, and the inlet valve screen is free of debris. If water pressure is adequate, the inlet solenoid valve itself may have failed and will need replacement.' ),
        'C2' => array( 'title' => 'Drain Problem / Not Draining',              'desc' => 'Water is not draining from the tub at the end of the cycle. Inspect the filter basket for food debris, check the drain hose for kinks or blockages, and ensure the house drain connection is clear. A seized drain pump motor will also trigger this code.' ),
        'C3' => array( 'title' => 'Water Not Heating / Heater Fault',          'desc' => 'The wash water is not reaching the required temperature. The heating element circuit may be open, or the NTC temperature sensor may be giving an incorrect reading. The dishwasher will not complete a sanitize cycle with this fault active.' ),
        'C4' => array( 'title' => 'Water Level Sensor Error',                  'desc' => 'The pressure sensor or float switch is not accurately detecting the water level inside the tub. This can cause overfilling or the machine stopping mid-cycle because it thinks the tub is empty.' ),
        'C5' => array( 'title' => 'Door Latch / Door Switch Fault',            'desc' => 'The control board is not detecting a securely closed door. Inspect the door latch for damage and check that the door-switch wiring harness is fully connected. The machine will not start with an open-door fault.' ),
        'C6' => array( 'title' => 'Water Temperature Too High',                'desc' => 'The wash temperature has exceeded the maximum safe limit. The NTC temperature sensor or a stuck heating relay on the control board is the most likely cause. Disconnect power immediately and call for service.' ),
        'C7' => array( 'title' => 'Turbidity / Soil Sensor Fault',             'desc' => 'The optical soil sensor is malfunctioning. Without a correct reading the dishwasher cannot choose the right cycle length and water usage. Cleaning the sensor lens may resolve the issue; otherwise the sensor module needs replacing.' ),
        'C8' => array( 'title' => 'Leak Detected / Flood Protection Active',   'desc' => 'Water has been detected in the base pan, triggering the float switch. The appliance will not run until the leak source is identified and fixed and the base pan is dried out. Common causes are a cracked door seal, loose hose connection, or faulty inlet valve.' ),
    ),

    'washer' => array(
        'E1' => array( 'title' => 'Water Fill Timeout',                        'desc' => 'The washer did not fill to the required level within the allotted time. Check household water pressure (minimum 20 psi required), ensure both inlet hoses are fully open, and inspect the inlet valve screens for sediment buildup.' ),
        'E2' => array( 'title' => 'Door Lock Fault',                           'desc' => 'The door latch is not engaging or the door-lock switch is not signalling the control board. Do not attempt to force the door open while the drum may still be rotating. Inspect the latch mechanism and wiring harness.' ),
        'E3' => array( 'title' => 'Motor / Drive Fault',                       'desc' => 'The drive motor or inverter board is not operating correctly. This may be caused by an overloaded drum — try removing some items and restarting. If the error persists, the motor module or control board requires professional diagnosis.' ),
        'E4' => array( 'title' => 'Overflow Error',                            'desc' => 'The water level inside the drum has exceeded the maximum safe limit. The water inlet valve may be stuck open or the pressure switch may have failed. Disconnect power and call for service immediately to prevent flooding.' ),
        'E5' => array( 'title' => 'NTC / Temperature Sensor Fault',            'desc' => 'The water temperature sensor (NTC thermistor) is open- or short-circuited. The washer may refuse to heat wash water or may display incorrect temperature readings. The sensor is typically located near the heater element.' ),
        'E6' => array( 'title' => 'Drain Timeout',                             'desc' => 'The washer is unable to drain within the expected time. Clean the pump filter (usually behind the kick panel at the front), check the drain hose for kinks, and confirm the standpipe height does not exceed 39 inches.' ),
        'E7' => array( 'title' => 'Imbalance / Vibration Error',               'desc' => 'The load is unevenly distributed inside the drum, preventing the machine from reaching spin speed safely. Open the door, redistribute the laundry evenly, and restart the spin cycle. Avoid washing single heavy items alone.' ),
        'E8' => array( 'title' => 'Control Board Communication Error',         'desc' => 'The main control board and the display module are not communicating. Unplug the machine for 10 minutes to allow the capacitors to fully discharge, then restore power. If the error returns, the wiring harness or control board needs inspection.' ),
    ),

    'dryer' => array(
        'E1' => array( 'title' => 'NTC / Thermistor Fault',                    'desc' => 'The drum temperature sensor (NTC thermistor) is open or shorted. Without accurate temperature data the dryer may overheat or produce no heat at all. The thermistor is typically mounted on the heating assembly and is an inexpensive part to replace.' ),
        'E2' => array( 'title' => 'Exhaust Thermistor Fault',                  'desc' => 'The exhaust duct temperature sensor has failed. Before replacing the sensor, thoroughly clean the dryer vent from the rear of the machine to the exterior duct cap — a clogged vent is the most common cause of exhaust sensor failures.' ),
        'E3' => array( 'title' => 'Heating Element Fault',                     'desc' => 'The heating element circuit is open. The drum will continue to rotate but no heat will be produced, leaving laundry damp. Confirm the dryer is on a dedicated 240 V circuit and both legs are live before replacing the element.' ),
        'E4' => array( 'title' => 'Thermal Cut-Out / High Limit Thermostat',   'desc' => 'The thermal limiter has tripped due to overheating — most commonly caused by a blocked or restricted exhaust vent. Clean the full vent path before resetting. Note: once a thermal cut-out trips it usually cannot be reset and must be replaced.' ),
        'E5' => array( 'title' => 'Motor Fault',                               'desc' => 'The drive motor is not operating correctly. Check for clothing items caught between the drum and the door seal, and ensure the motor start capacitor has not failed. A seized motor will also trip the thermal cut-out if left running.' ),
        'E6' => array( 'title' => 'Control Board Communication Error',         'desc' => 'The control module and the display board are not communicating. Unplug the dryer for 10 minutes to reset. If the error persists, check the ribbon cable between the two boards for damage or loose connectors.' ),
        'E7' => array( 'title' => 'Moisture Sensor Fault',                     'desc' => 'The auto-dry moisture sensor bars inside the drum are coated with residue or have failed. Clean the two metallic sensor strips with a soft cloth and rubbing alcohol. Fabric softener sheets leave a coating that insulates the sensors over time.' ),
        'E8' => array( 'title' => 'Door Switch Fault',                         'desc' => 'The control board is not detecting a closed door. The dryer will not start or will stop mid-cycle. Inspect the door latch, the door-switch plunger, and the wiring harness connector at the switch.' ),
    ),

    'refrigerator' => array(
        'PO'  => array( 'title' => 'Power Outage – Food Safety Alert',         'desc' => 'A power interruption was detected. The control board logs the event and alerts you to check food temperatures. Discard perishables that have been above 40 °F for more than 2 hours. The alert clears when you press any button.' ),
        'dE'  => array( 'title' => 'Defrost System Failure',                   'desc' => 'The automatic defrost cycle did not complete within 24 hours. Frost builds up on the evaporator coils over time, restricting airflow and reducing cooling. The defrost heater, defrost thermostat, or defrost control board relay is the likely cause.' ),
        'FF'  => array( 'title' => 'Freezer Fan Motor Fault',                  'desc' => 'The evaporator fan motor in the freezer compartment has failed or is obstructed by ice. Without this fan, cold air cannot circulate into the fresh-food section — both compartments will warm up. Manual defrost may be needed to free ice-bound motors.' ),
        'CF'  => array( 'title' => 'Condenser Fan Motor Fault',                'desc' => 'The condenser fan located near the compressor at the bottom rear is not running. This causes the compressor to overheat and reduces cooling efficiency. Clean the condenser coils and check for obstructions before replacing the motor.' ),
        'CE'  => array( 'title' => 'Communication Error (Control Boards)',     'desc' => 'The main control board and the dispenser or display board are not communicating. Unplug the refrigerator for 5 minutes to reset. If the fault returns, inspect the wiring harness between the boards for damaged connectors.' ),
        'HrS' => array( 'title' => 'Fresh Food Section High Temperature Alarm','desc' => 'The fresh-food (refrigerator) compartment has exceeded its safe temperature threshold. Check that the door gasket seals tightly all the way around, the condenser coils are clean, and the evaporator fan is running. Overloading the refrigerator with hot food can also trigger this alarm.' ),
        'HrF' => array( 'title' => 'Freezer Section High Temperature Alarm',  'desc' => 'The freezer compartment temperature has risen above the safe threshold. Inspect the door gasket for tears or gaps, confirm the evaporator fan is operating, and check that nothing is blocking the air vents inside the freezer.' ),
        'IC'  => array( 'title' => 'Ice Maker Fault',                          'desc' => 'The ice maker module has detected a fault condition — this can include a frozen fill line, a failed harvest motor, a stuck ice-level arm, or an issue with the water inlet valve. Resetting the ice maker (press the reset button on the module) often clears temporary faults.' ),
        'OP'  => array( 'title' => 'Open Probe / Temperature Sensor Open',    'desc' => 'A temperature sensor (thermistor) in the refrigerator or freezer compartment has an open circuit. The control board cannot regulate temperature in the affected section. Locate the correct sensor using the service manual for your model and replace it.' ),
        'SP'  => array( 'title' => 'Short Probe / Temperature Sensor Short',  'desc' => 'A temperature sensor circuit is shorted. A shorted thermistor typically reads a very low resistance, causing the control board to think the compartment is far colder than it is. Replace the faulty sensor and check the wiring harness for pinched wires.' ),
        'Sb'  => array( 'title' => 'Sabbath Mode Active',                     'desc' => 'The refrigerator is operating in Sabbath mode. Interior lights, audible alarms, and automatic ice-making are disabled. Navigate to the settings menu and turn off Sabbath mode if this was activated unintentionally.' ),
    ),

    'oven' => array(
        'F0'  => array( 'title' => 'Stuck Touch Pad / Key Shorted',            'desc' => 'A keypad button is stuck or the touch panel circuit is shorted. Disconnect power for 60 seconds. If the error returns when power is restored, the keypad membrane or the control board is faulty and must be replaced.' ),
        'F1'  => array( 'title' => 'Control Board Failure / Runaway Temperature','desc' => 'The electronic control board has detected an internal failure or an uncontrolled rise in oven temperature. Disconnect power immediately. Do not use the oven until a certified technician has inspected the control board and temperature sensor.' ),
        'F2'  => array( 'title' => 'Oven Temperature Exceeded Maximum Limit',  'desc' => 'The oven temperature has surpassed the maximum safe operating limit (typically above 590 °F in bake mode or 990 °F in self-clean). The temperature sensor may be faulty or the control board relay may be stuck closed, applying continuous power to the element.' ),
        'F3'  => array( 'title' => 'Oven Temperature Sensor Open Circuit',     'desc' => 'The oven temperature sensor (RTD probe) circuit is open. The control board has lost temperature feedback and will not heat the oven. Inspect the sensor probe wiring at the back wall of the oven cavity for damage or loose connectors.' ),
        'F4'  => array( 'title' => 'Oven Temperature Sensor Short Circuit',    'desc' => 'The oven temperature sensor circuit is shorted to ground or to the supply. The oven will not heat correctly. Replace the temperature sensor; if the fault persists after replacement, the control board may have a damaged input circuit.' ),
        'F5'  => array( 'title' => 'Door Latch Switch Fault (Self-Clean Lock)','desc' => 'The self-clean door latch mechanism is not engaging or the latch position switch is not responding. The oven will not enter self-clean mode. Manually move the latch lever; if it moves freely, the switch or motor module is the likely fault.' ),
        'F6'  => array( 'title' => 'Door Unlock Failure After Self-Clean',     'desc' => 'The oven door failed to unlock after the self-clean cycle completed. Allow the oven to cool to below 200 °F — this can take up to 2 hours. If the door remains locked when cool, the latch motor assembly needs replacement.' ),
        'F7'  => array( 'title' => 'Control Board Internal Error',             'desc' => 'The control board processor has encountered an internal error. A hard reset (turn off the circuit breaker for 5 minutes) may clear this code. If the error recurs during normal cooking operation, the board likely needs replacement.' ),
        'F8'  => array( 'title' => 'Bake Element Relay Fault',                 'desc' => 'The relay on the control board that controls the bake element is malfunctioning. A stuck-closed relay will cause the oven to overheat; a stuck-open relay will prevent heating. Professional replacement of the relay or full control board is required.' ),
        'F9'  => array( 'title' => 'Door Lock Relay Fault',                    'desc' => 'The relay controlling the door lock motor is not functioning correctly. The oven door may remain locked outside of self-clean mode or fail to lock when self-clean is requested. Repair involves the control board or the lock motor assembly.' ),
        'F10' => array( 'title' => 'Temperature Sensor Runaway',               'desc' => 'The temperature sensor is reading an extreme or erratic value (either too high or too low), causing the control board to detect a runaway condition. Check the sensor probe and its wiring harness for physical damage or a loose socket connector.' ),
        'F13' => array( 'title' => 'Convection Sensor Open Circuit',           'desc' => 'The convection oven temperature sensor circuit is open. Convection bake and roast modes will not function. Locate the convection sensor (usually at the rear of the oven cavity near the convection element) and test with a multimeter.' ),
        'F14' => array( 'title' => 'Convection Sensor Short Circuit',          'desc' => 'The convection temperature sensor is shorted. Replace the sensor and inspect the full wiring harness from the sensor socket to the control board for pinched or melted insulation.' ),
        'F97' => array( 'title' => 'Cooling Fan Not Running',                  'desc' => 'The control board cooling fan (located behind the back panel or above the oven) is not operating. The oven will shut down after a short period to protect the electronics from heat damage. The fan motor or its wiring is the typical cause.' ),
        'F98' => array( 'title' => 'Door Latch Assembly Fault',                'desc' => 'The self-clean door latch assembly is not operating correctly during the latch sequence. The motor may be stalled, the latch mechanism may be obstructed, or the latch position switch may have failed. Full latch assembly replacement is often required.' ),
    ),

    'cooktop' => array(
        'F0' => array( 'title' => 'Control Lock Active (Child Lock)',          'desc' => 'The control lock (child safety lock) has been activated, disabling all surface elements. Press and hold the lock button (or the designated key combination shown in your model\'s manual) for 3 seconds to deactivate.' ),
        'F2' => array( 'title' => 'Surface Element Overheating',               'desc' => 'A surface heating element has exceeded the maximum safe temperature. The element limiter, the temperature sensor for that zone, or the control board switch relay may be faulty. Stop using the affected zone and call for service.' ),
        'F3' => array( 'title' => 'Surface Temperature Sensor Open Circuit',   'desc' => 'The temperature sensor for one of the surface elements has an open circuit. The element will be disabled as a safety measure until the sensor is replaced and the circuit is restored.' ),
        'F4' => array( 'title' => 'Surface Temperature Sensor Short Circuit',  'desc' => 'The surface element temperature sensor circuit is shorted. This prevents safe temperature regulation of the zone. Replace the faulty sensor for the affected element and inspect the wiring.' ),
        'F5' => array( 'title' => 'Control Board Failure',                     'desc' => 'The cooktop control board has detected an internal failure. A power cycle at the circuit breaker (leave off for 5 minutes) may clear a temporary fault. A recurring F5 code requires full control board replacement.' ),
        'F9' => array( 'title' => 'Communication Error',                       'desc' => 'The cooktop touch control module and the power module are not communicating. Reset the cooktop at the circuit breaker. If the error persists, inspect the ribbon cable between the touch panel and the power board for damage.' ),
    ),

    'microwave' => array(
        'F1' => array( 'title' => 'Cavity Temperature Sensor Fault',           'desc' => 'The internal cavity temperature sensor is open- or short-circuited. The microwave may display a fault and refuse to operate, or it may run but not control power levels correctly. The sensor is located inside the microwave cavity wall.' ),
        'F2' => array( 'title' => 'Shorted Keypad / Stuck Key',                'desc' => 'A keypad button is stuck or the touch-panel membrane circuit is shorted. Disconnect power for 60 seconds. If the error returns when power is restored, the keypad membrane or control board requires replacement.' ),
        'F3' => array( 'title' => 'Turntable Motor Fault',                     'desc' => 'The turntable motor is not operating. Food will not rotate, resulting in uneven heating. Check that the turntable ring and tray are properly seated and that nothing is jamming the rotation before suspecting a motor failure.' ),
        'F4' => array( 'title' => 'Door Switch Fault',                         'desc' => 'One or more door interlock switches has failed. Microwaves use multiple door switches as a safety interlock — the magnetron will not operate if any switch fails. Do not attempt to bypass door switches; call for service.' ),
        'F5' => array( 'title' => 'Humidity Sensor Fault',                     'desc' => 'The internal humidity/steam sensor used by sensor-cook programs has failed. Auto-cook and sensor-reheat functions will not operate, but manual time-cook settings will still work normally.' ),
        'F6' => array( 'title' => 'Control Board Fault',                       'desc' => 'The main control board has detected an internal error. Unplug the microwave for 2–3 minutes to fully reset the electronics. If the fault returns, professional service or control board replacement is required.' ),
        'F7' => array( 'title' => 'Exhaust Fan Motor Fault',                   'desc' => 'The exhaust/ventilation fan motor is not running. The microwave may overheat if used without ventilation. Ensure the exhaust ducts or filters are not blocked before replacing the fan motor.' ),
        'SE' => array( 'title' => 'Keypad Shorted / Stuck Key',                'desc' => 'An "SE" display indicates the same condition as F2 — a button in the touch panel membrane is stuck or shorted. Unplug the microwave for 60 seconds. If SE appears again immediately on power-up, the keypad or the control board membrane interface needs replacement.' ),
    ),

    'freezer' => array(
        'PO'  => array( 'title' => 'Power Outage Alert',                       'desc' => 'A power interruption was logged by the control board. Verify that freezer temperature has recovered to 0 °F (−18 °C) or below. Food safety may be compromised if the internal temperature exceeded 10 °F for more than 2 hours.' ),
        'dE'  => array( 'title' => 'Defrost System Failure',                   'desc' => 'The automatic defrost cycle has not completed within the expected timeframe. Frost is accumulating on the evaporator coils, restricting airflow. The defrost heater, defrost thermostat, or the defrost timer/relay on the control board is the likely cause.' ),
        'FF'  => array( 'title' => 'Evaporator Fan Motor Fault',               'desc' => 'The evaporator fan motor has failed or is blocked by accumulated ice. Without this fan, cold air cannot circulate inside the cabinet and temperatures will rise. Manual defrost (unplug for 24–48 hours with the door open) may free an ice-bound motor.' ),
        'CF'  => array( 'title' => 'Condenser Fan Motor Fault',                'desc' => 'The condenser fan located at the back or bottom of the freezer near the compressor is not operating. This causes the compressor to overheat, reducing cooling efficiency and eventually warming the cabinet.' ),
        'CE'  => array( 'title' => 'Control Board Communication Error',        'desc' => 'The display board and the main control board are not communicating. Unplug the freezer for 10 minutes to allow a full reset. If the fault returns, inspect the wiring harness connector between the two boards.' ),
        'HrF' => array( 'title' => 'High Freezer Temperature Alarm',           'desc' => 'The freezer compartment temperature has exceeded the safe threshold. Check door gaskets for tears or gaps, confirm the evaporator fan is running, clean the condenser coils, and ensure the air vents inside the cabinet are not blocked by food items.' ),
        'OP'  => array( 'title' => 'Open Probe / Temperature Sensor Open',    'desc' => 'The temperature sensor (thermistor) circuit is open. Without temperature feedback the control board cannot regulate the compressor correctly. Locate the thermistor using the service manual for your specific model and check its resistance.' ),
        'SP'  => array( 'title' => 'Short Probe / Temperature Sensor Short',  'desc' => 'The temperature sensor circuit is shorted. A shorted thermistor typically reads near-zero resistance, sending erroneous temperature data to the control board. Replace the sensor and inspect the wiring harness for pinched or melted insulation.' ),
        'Sb'  => array( 'title' => 'Sabbath Mode Active',                     'desc' => 'The freezer is operating in Sabbath mode. Interior lights and audible high-temperature alarms are disabled during this mode. Navigate to the control panel settings to disable Sabbath mode if it was activated unintentionally.' ),
    ),
);

// If DB returned nothing, use the hardcoded fallback for this appliance
if ( empty( $code_map ) && isset( $fallback_data[ $appliance_slug ] ) ) {
    foreach ( $fallback_data[ $appliance_slug ] as $code_val => $entry ) {
        $key = strtolower( str_replace( ' ', '', $code_val ) );
        $code_map[ $key ] = array(
            'code'      => $code_val,
            'title'     => $entry['title'],
            'desc'      => $entry['desc'],
            'permalink' => '',
            'from_db'   => false,
        );
    }
}
// ── End fallback data ────────────────────────────────────────────────────────

uksort( $code_map, 'strnatcasecmp' );
$error_codes = array_values( $code_map );

// Most common codes: first 6 from the sorted list
$appliance_most_common = array_slice( array_keys( $code_map ), 0, 6 );

// Check if a specific code is requested
$requested_code = isset( $_GET['code'] ) ? strtolower( sanitize_key( $_GET['code'] ) ) : '';
$detail         = ( $requested_code && isset( $code_map[ $requested_code ] ) ) ? $code_map[ $requested_code ] : null;

// Also check database for the requested code
$db_detail_post = null;
if ( $requested_code && ! $detail ) {
    $db_check = new WP_Query( array(
        'post_type'      => 'error_code',
        'posts_per_page' => 1,
        'meta_query'     => array(
            array(
                'key'     => '_brp_error_code',
                'value'   => strtoupper( $requested_code ),
                'compare' => '=',
            ),
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'appliance_type',
                'field'    => 'slug',
                'terms'    => $appliance_slug,
            ),
        ),
    ) );
    if ( $db_check->have_posts() ) {
        $db_check->the_post();
        $db_detail_post = get_the_ID();
        wp_reset_postdata();
    }
}

// FAQ schema for list view
if ( ! $detail && ! empty( $error_codes ) ) {
    $schema = brp_get_faq_schema( array_map( function( $c ) {
        return array(
            'q' => 'What does Monogram error code ' . $c['code'] . ' mean?',
            'a' => $c['title'] . ': ' . $c['desc'],
        );
    }, $error_codes ) );
    echo $schema;
}

// Appliance page URL (base)
$appliance_url = get_permalink();

// All appliance categories for nav buttons
$ec_categories = array(
    array( 'slug' => 'dishwasher',   'label' => 'Dishwasher'   ),
    array( 'slug' => 'washer',       'label' => 'Washer'       ),
    array( 'slug' => 'dryer',        'label' => 'Dryer'        ),
    array( 'slug' => 'refrigerator', 'label' => 'Refrigerator' ),
    array( 'slug' => 'oven',         'label' => 'Oven & Range' ),
    array( 'slug' => 'cooktop',      'label' => 'Cooktop'      ),
    array( 'slug' => 'microwave',    'label' => 'Microwave'    ),
    array( 'slug' => 'freezer',      'label' => 'Freezer'      ),
);
?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>

        <?php if ( $detail ) : ?>
            <div style="display:inline-flex;align-items:center;gap:12px;margin-bottom:16px;">
                <span class="error-code-badge" style="font-size:1.1rem;"><?php echo esc_html( $detail['code'] ); ?></span>
            </div>
            <h1><?php echo esc_html( $detail['title'] ); ?></h1>
            <p>Monogram <?php echo esc_html( $appliance_title ); ?> &mdash; Error Code <?php echo esc_html( $detail['code'] ); ?></p>
        <?php else : ?>
            <h1>Monogram <?php echo esc_html( $appliance_title ); ?> Error Codes</h1>
            <p>Complete list of Monogram <?php echo esc_html( strtolower( $appliance_title ) ); ?> error codes with explanations and recommended repairs.</p>
        <?php endif; ?>

    </div>
</section>

<section class="section">
    <div class="container">

        <?php if ( $detail ) : ?>
        <!-- ================================================== -->
        <!-- DETAIL VIEW: single error code                     -->
        <!-- ================================================== -->
        <div class="content-grid">
            <div class="main-content">

                <!-- Back link -->
                <a href="<?php echo esc_url( $appliance_url ); ?>" class="brp-back-link">
                    &larr; All <?php echo esc_html( $appliance_title ); ?> Error Codes
                </a>

                <!-- Code card -->
                <div class="brp-ec-detail-card">
                    <div class="brp-ec-detail-header">
                        <span class="error-code-badge brp-ec-badge-lg"><?php echo esc_html( $detail['code'] ); ?></span>
                        <div>
                            <h2 class="brp-ec-detail-title"><?php echo esc_html( $detail['title'] ); ?></h2>
                            <p class="brp-ec-detail-appliance">
                                Monogram <?php echo esc_html( $appliance_title ); ?> &mdash; Error Code <?php echo esc_html( $detail['code'] ); ?>
                            </p>
                        </div>
                    </div>

                    <div class="brp-ec-detail-body">
                        <h3>What Does This Error Mean?</h3>
                        <p><?php echo esc_html( $detail['desc'] ); ?></p>
                    </div>

                    <div class="brp-ec-detail-actions">
                        <div class="notice notice-warning" style="margin-bottom:0;">
                            <strong>⚠️ Need Professional Help?</strong>
                            If this error code persists after basic troubleshooting, our certified Monogram technicians are available for same-day diagnosis and repair.
                            Call <a href="tel:<?php echo BRP_PHONE_RAW; ?>"><?php echo BRP_PHONE; ?></a> or book online below.
                        </div>
                    </div>
                </div>

                <!-- Steps to try first -->
                <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:28px;margin-top:32px;">
                    <h3 style="margin-bottom:16px;">General Troubleshooting Steps</h3>
                    <ol style="display:flex;flex-direction:column;gap:10px;margin:0;padding-left:20px;">
                        <li><strong>Hard reset:</strong> Unplug the appliance (or switch off the circuit breaker) for 5–10 minutes, then restore power.</li>
                        <li><strong>Note the code:</strong> Write down the exact error code and when it appeared.</li>
                        <li><strong>Check the manual:</strong> Your Monogram appliance manual may have model-specific reset procedures.</li>
                        <li><strong>Call a technician:</strong> If the code returns after a reset, professional diagnosis is recommended.</li>
                    </ol>
                </div>

                <!-- Other codes in this appliance -->
                <div style="margin-top:40px;">
                    <h3 style="margin-bottom:20px;">Other <?php echo esc_html( $appliance_title ); ?> Error Codes</h3>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <?php foreach ( array_slice( $error_codes, 0, 6 ) as $other ) :
                            if ( strtolower( str_replace( ' ', '', $other['code'] ) ) === $requested_code ) continue; ?>
                        <a href="<?php echo esc_url( add_query_arg( 'code', strtolower( str_replace( ' ', '', $other['code'] ) ), $appliance_url ) ); ?>" class="error-card">
                            <span class="error-code-badge"><?php echo esc_html( $other['code'] ); ?></span>
                            <div class="error-card-info">
                                <h4><?php echo esc_html( $other['title'] ); ?></h4>
                            </div>
                            <span style="margin-left:auto;color:var(--color-gray);font-size:1.25rem;flex-shrink:0;">›</span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo esc_url( $appliance_url ); ?>" class="btn btn-secondary" style="margin-top:16px;">
                        View All <?php echo esc_html( $appliance_title ); ?> Codes &rarr;
                    </a>
                </div>

            </div>

            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">📞 Get Expert Help</div>
                    <div class="sidebar-phone">
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="sidebar-phone-number"><?php echo BRP_PHONE; ?></a>
                        <p>Tell us your error code and we'll diagnose it over the phone — often free of charge.</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call Now</a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Repair</a>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">✅ Why Choose Us</div>
                    <div class="sidebar-widget-body">
                        <ul class="checklist" style="gap:8px;">
                            <li>Factory-certified Monogram parts</li>
                            <li>Same-day service available</li>
                            <li>30-day labor warranty</li>
                            <li>Trained, background-checked techs</li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">🔍 Other Appliance Codes</div>
                    <div class="sidebar-widget-body">
                        <ul class="footer-links" style="gap:8px;">
                            <?php
                            $all_types = array(
                                'dishwasher'   => 'Dishwasher',
                                'washer'       => 'Washer',
                                'dryer'        => 'Dryer',
                                'refrigerator' => 'Refrigerator',
                                'oven'         => 'Oven & Range',
                                'cooktop'      => 'Cooktop',
                                'microwave'    => 'Microwave',
                                'freezer'      => 'Freezer',
                                'wine-cooler'  => 'Wine Cooler',
                                'hood'         => 'Range Hood',
                            );
                            foreach ( $all_types as $slug => $label ) :
                                if ( $slug === $appliance_slug ) continue; ?>
                            <li><a href="<?php echo esc_url( home_url( '/error-codes/' . $slug . '/' ) ); ?>" style="color:var(--color-text);"><?php echo esc_html( $label ); ?> Codes</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>

        <?php else : ?>
        <!-- ================================================== -->
        <!-- LIST VIEW: all error codes for this appliance      -->
        <!-- ================================================== -->
        <div class="content-grid">
            <div class="main-content">

                <div class="notice notice-warning">
                    <strong>⚠️ Important:</strong> Many Monogram error codes require professional diagnosis and repair. Attempting to repair electrical or sealed system components yourself can be dangerous and may void your warranty. Call <?php echo BRP_PHONE; ?> for safe, certified repair.
                </div>

                <?php if ( ! empty( $error_codes ) ) : ?>

                <div class="section-header" style="margin-bottom:24px;">
                    <span class="section-label">Complete List</span>
                    <h2 class="section-title" style="font-size:1.4rem;">All Monogram <?php echo esc_html( $appliance_title ); ?> Error Codes</h2>
                </div>

                <div style="display:flex;flex-direction:column;gap:12px;">
                <?php foreach ( $error_codes as $ec ) :
                    $code_slug = strtolower( str_replace( ' ', '', $ec['code'] ) );
                    if ( ! empty( $ec['from_db'] ) && ! empty( $ec['permalink'] ) ) {
                        $ec_url = $ec['permalink'];
                    } else {
                        $ec_url = add_query_arg( 'code', $code_slug, $appliance_url );
                    }
                ?>
                <a href="<?php echo esc_url( $ec_url ); ?>" class="error-card" style="align-items:flex-start;padding:20px 24px;">
                    <span class="error-code-badge" style="flex-shrink:0;margin-top:2px;"><?php echo esc_html( $ec['code'] ); ?></span>
                    <div class="error-card-info" style="flex:1;">
                        <h4 style="margin-bottom:6px;"><?php echo esc_html( $ec['title'] ); ?></h4>
                        <p style="font-size:0.875rem;color:var(--color-gray);line-height:1.6;margin:0;"><?php echo esc_html( $ec['desc'] ); ?></p>
                    </div>
                    <span style="margin-left:16px;color:var(--color-gray);font-size:1.25rem;flex-shrink:0;padding-top:2px;">›</span>
                </a>
                <?php endforeach; ?>
                </div>

                <?php endif; ?>

                <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:32px;margin-top:40px;">
                    <h3>Don't See Your Error Code?</h3>
                    <p style="color:var(--color-gray);">Monogram regularly updates firmware and error code definitions. If you can't find your code, call our expert technicians — they have access to complete Monogram service documentation.</p>
                    <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary">📞 Call for Expert Diagnosis</a>
                </div>

            </div>

            <aside class="sidebar">
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">🔧 Quick Repair Help</div>
                    <div class="sidebar-phone">
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="sidebar-phone-number"><?php echo BRP_PHONE; ?></a>
                        <p>Tell us your error code and we'll help diagnose it over the phone.</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call Now</a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Repair</a>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">🔍 Other Appliance Codes</div>
                    <div class="sidebar-widget-body">
                        <ul class="footer-links" style="gap:8px;">
                            <?php
                            $all_types = array(
                                'dishwasher'   => 'Dishwasher',
                                'washer'       => 'Washer',
                                'dryer'        => 'Dryer',
                                'refrigerator' => 'Refrigerator',
                                'oven'         => 'Oven & Range',
                                'cooktop'      => 'Cooktop',
                                'microwave'    => 'Microwave',
                                'freezer'      => 'Freezer',
                                'wine-cooler'  => 'Wine Cooler',
                                'hood'         => 'Range Hood',
                            );
                            foreach ( $all_types as $slug => $label ) :
                                if ( $slug === $appliance_slug ) continue; ?>
                            <li><a href="<?php echo esc_url( home_url( '/error-codes/' . $slug . '/' ) ); ?>" style="color:var(--color-text);"><?php echo esc_html( $label ); ?> Codes</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php echo brp_appointment_form( 'Error Code? Our Technicians Can Fix It Today' ); ?>

<?php get_footer(); ?>
