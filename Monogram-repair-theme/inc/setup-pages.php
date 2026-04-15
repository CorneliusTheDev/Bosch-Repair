<?php
/**
 * One-time Page Setup Script
 *
 * Run this ONCE after activating the theme to create all required pages,
 * service posts, city posts, and error code posts.
 *
 * HOW TO USE:
 * 1. Upload this theme to /wp-content/themes/monogram-repair-theme/
 * 2. Activate the theme in WordPress Admin → Appearance → Themes
 * 3. Open WordPress Admin → Tools → Theme File Editor (or use WP-CLI)
 * 4. OR: Add this line temporarily to functions.php:
 *       add_action('init', function(){ include get_template_directory() . '/inc/setup-pages.php'; }, 99);
 *    and remove it after running once.
 *
 * ALTERNATIVELY: run via WP-CLI:
 *    wp eval-file wp-content/themes/monogram-repair-theme/inc/setup-pages.php
 *
 * @package MonogramRepairPro
 */

if ( ! defined( 'ABSPATH' ) ) {
    // Allow running via WP-CLI
    require_once dirname( __FILE__, 5 ) . '/wp-load.php';
}

// Safety: only run for admins or auto-setup
if ( ! current_user_can( 'manage_options' ) && ! defined( 'WP_CLI' ) && ! defined( 'BRP_AUTO_SETUP' ) ) {
    wp_die( 'Unauthorized.' );
}

$log = array();

// ============================================================
// HELPER
// ============================================================
function brp_setup_create_page( $title, $slug, $template, $content = '', $parent_id = 0 ) {
    global $log;
    $existing = get_page_by_path( $slug );
    if ( $existing ) {
        $log[] = "EXISTS: Page '{$title}' (/{$slug}/)";
        return $existing->ID;
    }
    $page_id = wp_insert_post( array(
        'post_title'     => $title,
        'post_name'      => $slug,
        'post_status'    => 'publish',
        'post_type'      => 'page',
        'post_content'   => $content,
        'post_parent'    => $parent_id,
        'page_template'  => $template,
    ) );
    if ( ! is_wp_error( $page_id ) && $template ) {
        update_post_meta( $page_id, '_wp_page_template', $template );
    }
    $log[] = "CREATED: Page '{$title}' (ID: {$page_id})";
    return $page_id;
}

function brp_setup_create_cpt( $post_type, $title, $slug, $template = '', $meta = array(), $tax = array(), $content = '' ) {
    global $log;
    $existing = get_posts( array(
        'post_type'  => $post_type,
        'name'       => $slug,
        'numberposts' => 1,
    ) );
    if ( $existing ) {
        $log[] = "EXISTS: {$post_type} '{$title}'";
        return $existing[0]->ID;
    }
    $id = wp_insert_post( array(
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_status'  => 'publish',
        'post_type'    => $post_type,
        'post_content' => $content,
        'page_template' => $template,
    ) );
    if ( ! is_wp_error( $id ) ) {
        if ( $template ) update_post_meta( $id, '_wp_page_template', $template );
        foreach ( $meta as $k => $v ) update_post_meta( $id, $k, $v );
        foreach ( $tax as $taxonomy => $terms ) wp_set_post_terms( $id, $terms, $taxonomy );
    }
    $log[] = "CREATED: {$post_type} '{$title}' (ID: {$id})";
    return $id;
}

// ============================================================
// 1. STATIC PAGES
// ============================================================
$home_id = brp_setup_create_page( 'Home', 'home', '', '' );
update_option( 'page_on_front', $home_id );
update_option( 'show_on_front', 'page' );

$about_id = brp_setup_create_page( 'About Us', 'about-us', 'page-templates/template-about.php' );

$blog_id = brp_setup_create_page( 'Blog', 'blog', 'page-templates/template-blog.php' );
update_option( 'page_for_posts', $blog_id );

brp_setup_create_page( 'Privacy Policy', 'privacy-policy', 'page-templates/template-legal.php',
    '<h2>Privacy Policy</h2>
    <p><strong>Effective Date:</strong> January 1, 2024</p>
    <p>Monogram Repair Pro ("Company", "we", "us", or "our") is committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website at <a href="' . BRP_SITE_URL . '">' . BRP_SITE_URL . '</a> or use our services.</p>
    <h3>Information We Collect</h3>
    <p>We collect information you provide directly to us, including: name, phone number, email address, service address, and appliance information when you schedule a repair appointment. We may also collect usage data and cookies when you visit our website.</p>
    <h3>How We Use Your Information</h3>
    <p>We use the information we collect to: schedule and fulfill repair appointments, communicate with you about your service, send appointment reminders, improve our services, and comply with legal obligations.</p>
    <h3>Information Sharing</h3>
    <p>We do not sell, trade, or otherwise transfer your personal information to outside parties. We may share information with trusted service providers who assist us in operating our website and conducting our business, provided those parties agree to keep this information confidential.</p>
    <h3>Data Security</h3>
    <p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>
    <h3>Your Rights</h3>
    <p>You have the right to access, correct, or delete your personal data. To exercise these rights, contact us at ' . BRP_EMAIL . '.</p>
    <h3>Contact Us</h3>
    <p>If you have questions about this Privacy Policy, please contact us at ' . BRP_EMAIL . ' or call ' . BRP_PHONE . '.</p>'
);

brp_setup_create_page( 'Terms of Use', 'terms-of-use', 'page-templates/template-legal.php',
    '<h2>Terms of Use</h2>
    <p><strong>Effective Date:</strong> January 1, 2024</p>
    <p>By accessing and using the Monogram Repair Pro website at <a href="' . BRP_SITE_URL . '">' . BRP_SITE_URL . '</a> and services, you agree to be bound by these Terms of Use. Please read them carefully.</p>
    <h3>Services</h3>
    <p>Monogram Repair Pro provides independent appliance repair services. We are not affiliated with, authorized by, or endorsed by GE Appliances, LLC. The Monogram name and related trademarks are used for identification purposes only.</p>
    <h3>Service Appointments</h3>
    <p>By scheduling a service appointment, you authorize our technician to diagnose and repair your appliance. A diagnostic fee may apply if you decline the quoted repair. All repairs include a 90-day labor warranty.</p>
    <h3>Payment</h3>
    <p>Payment is due upon completion of service. We accept major credit cards, debit cards, and checks. Pricing is provided upfront before any work begins.</p>
    <h3>Limitation of Liability</h3>
    <p>Our liability is limited to the cost of the service performed. We are not responsible for consequential, incidental, or special damages arising from appliance failure.</p>
    <h3>Governing Law</h3>
    <p>These Terms are governed by the laws of the state in which service is performed.</p>
    <h3>Contact</h3>
    <p>For questions about these Terms, contact us at ' . BRP_EMAIL . '.</p>'
);

brp_setup_create_page( 'Mobile Terms of Use', 'mobile-terms-of-use', 'page-templates/template-legal.php',
    '<h2>Mobile Terms of Use</h2>
    <p><strong>Effective Date:</strong> January 1, 2024</p>
    <p>These Mobile Terms of Use govern your use of Monogram Repair Pro\'s mobile services, including SMS/text message communications and mobile website access at <a href="' . BRP_SITE_URL . '">' . BRP_SITE_URL . '</a>.</p>
    <h3>SMS / Text Message Service</h3>
    <p>By providing your mobile phone number and opting in, you consent to receive text messages from Monogram Repair Pro regarding appointment confirmations, reminders, and service updates. Message and data rates may apply.</p>
    <h3>Opt-Out</h3>
    <p>You may opt out of SMS communications at any time by replying STOP to any message we send. After opting out, you will receive one confirmation message and will not receive further messages unless you opt back in.</p>
    <h3>Help</h3>
    <p>For help, reply HELP to any message or contact us at ' . BRP_EMAIL . ' or ' . BRP_PHONE . '.</p>
    <h3>Message Frequency</h3>
    <p>Message frequency varies based on your service interactions, typically 2–4 messages per appointment scheduled.</p>
    <h3>Privacy</h3>
    <p>Your mobile information will not be shared with third parties for marketing purposes. See our Privacy Policy for full details.</p>
    <h3>Contact</h3>
    <p>Mobile program support: ' . BRP_EMAIL . '</p>'
);

// ============================================================
// 2. SERVICE POSTS (one per appliance)
// ============================================================
$services = array(
    array( 'title' => 'Monogram Oven Repair',          'slug' => 'monogram-oven-repair',          'appliance' => 'oven' ),
    array( 'title' => 'Monogram Microwave Repair',     'slug' => 'monogram-microwave-repair',     'appliance' => 'microwave' ),
    array( 'title' => 'Monogram Freezer Repair',       'slug' => 'monogram-freezer-repair',       'appliance' => 'freezer' ),
    array( 'title' => 'Monogram Cooktop Repair',       'slug' => 'monogram-cooktop-repair',       'appliance' => 'cooktop' ),
    array( 'title' => 'Monogram Refrigerator Repair',  'slug' => 'monogram-refrigerator-repair',  'appliance' => 'refrigerator' ),
    array( 'title' => 'Monogram Dishwasher Repair',    'slug' => 'monogram-dishwasher-repair',    'appliance' => 'dishwasher' ),
    array( 'title' => 'Monogram Dryer Repair',         'slug' => 'monogram-dryer-repair',         'appliance' => 'dryer' ),
    array( 'title' => 'Monogram Hood Repair',          'slug' => 'monogram-hood-repair',          'appliance' => 'hood' ),
    array( 'title' => 'Monogram Washer Repair',        'slug' => 'monogram-washer-repair',        'appliance' => 'washer' ),
);

foreach ( $services as $s ) {
    brp_setup_create_cpt( 'service', $s['title'], $s['slug'],
        'page-templates/template-service.php',
        array( '_brp_appliance_type' => $s['appliance'] ),
        array( 'appliance_type' => array( $s['appliance'] ) )
    );
}

// Wine Cooler Repair — created separately with dedicated content
brp_setup_create_cpt( 'service', 'Monogram Wine Cooler Repair', 'monogram-wine-cooler-repair',
    'page-templates/template-service.php',
    array( '_brp_appliance_type' => 'wine-cooler' ),
    array( 'appliance_type' => array( 'wine-cooler' ) ),
    '<h2>Expert Monogram Wine Cooler Repair</h2>
    <p>A Monogram wine cooler is a precision appliance engineered to maintain exact temperature and humidity conditions that protect your investment. When something goes wrong — whether it\'s a temperature swing, a vibration issue, or an error code on the display — you need a technician who understands the specific demands of wine storage. Our certified technicians specialize in Monogram wine cooler repair and carry a full inventory of genuine Monogram replacement parts for same-day service.</p>

    <h3>Common Monogram Wine Cooler Problems We Fix</h3>
    <ul class="checklist">
        <li>Not cooling or not reaching set temperature</li>
        <li>Temperature fluctuating between zones (dual-zone models)</li>
        <li>Compressor running but not cooling</li>
        <li>Excessive vibration that may disturb wine sediment</li>
        <li>Error codes on the control display</li>
        <li>Interior light not working</li>
        <li>Door seal damaged or not sealing properly</li>
        <li>Condensation or frost buildup inside the cabinet</li>
        <li>Fan motor making unusual noise</li>
        <li>Control panel unresponsive or buttons not working</li>
        <li>Unit not turning on</li>
        <li>Humidity too high or too low inside the cabinet</li>
    </ul>

    <h3>Monogram Wine Cooler Models We Service</h3>
    <p>Our technicians are experienced with the full range of Monogram undercounter and built-in wine coolers, including:</p>
    <ul class="checklist">
        <li>Monogram Single-Zone Undercounter Wine Coolers</li>
        <li>Monogram Dual-Zone Wine Coolers</li>
        <li>Monogram Built-In Column Wine Storage</li>
        <li>Monogram Integrated Wine Coolers (panel-ready)</li>
    </ul>

    <h3>Why Precise Temperature Matters</h3>
    <p>Wine is sensitive to temperature swings of even a few degrees. Long-term storage requires consistent temperatures — typically 45°F to 65°F depending on the wine type — along with controlled humidity and minimal vibration. A malfunctioning cooler that cycles between temperatures can accelerate aging, push corks, and ruin years of careful cellaring. Don\'t wait to have the problem assessed.</p>

    <h3>Our Monogram Wine Cooler Repair Process</h3>
    <ol>
        <li><strong>Same-Day Scheduling:</strong> Call or book online — we confirm your appointment within minutes and aim for same-day or next-day arrival.</li>
        <li><strong>Expert Diagnosis:</strong> Our technician arrives with diagnostic tools and the most common Monogram wine cooler parts on the service vehicle.</li>
        <li><strong>Upfront Quote:</strong> We explain the fault in plain language and give you a fixed price before any work begins. No hidden fees.</li>
        <li><strong>Precision Repair:</strong> We use only genuine, factory-certified Monogram replacement parts to ensure your cooler performs to original factory specifications.</li>
        <li><strong>Temperature Verification:</strong> After completing the repair, we verify that both zones are reaching and holding the correct set temperatures before we leave.</li>
        <li><strong>90-Day Warranty:</strong> Your repair is backed by our 90-day labor warranty. If the same fault returns, we come back and fix it at no charge.</li>
    </ol>

    <h3>Why Choose Genuine Monogram Parts?</h3>
    <p>Aftermarket compressors, thermistors, and fan motors may appear to fit but are rarely engineered to the same tolerances as the original Monogram components. Using non-OEM parts in a wine cooler can lead to temperature inaccuracy, premature failure, and a voided manufacturer warranty. We stock genuine GE Monogram parts and use them exclusively on every repair.</p>

    <div class="notice notice-info">
        <strong>💡 Tip:</strong> If your Monogram wine cooler is displaying an error code, write it down before our technician arrives — it gives us a head start on diagnosis. You can also look up your code in our <a href="' . home_url( '/error-codes/' ) . '">Monogram Error Code Database</a>.
    </div>'
);

// ============================================================
// 3. CITY POSTS
// ============================================================
$cities_data = array(
    array(
        'title' => 'Chicago',   'slug' => 'chicago',
        'zip'   => '60601, 60602, 60603, 60604, 60605, 60606, 60607, 60608, 60609, 60610, 60611, 60612, 60613, 60614, 60615, 60616, 60617, 60618, 60619, 60620',
        'suburbs' => 'Evanston, Oak Park, Naperville, Schaumburg, Arlington Heights, Skokie, Cicero, Joliet, Waukegan, Elgin, Berwyn, Wheaton, Bolingbrook, Palatine, Des Plaines, Orland Park, Tinley Park, Oak Lawn, Elmhurst, Downers Grove',
        'state' => 'Illinois',
    ),
    array(
        'title' => 'San Francisco', 'slug' => 'san-francisco',
        'zip'   => '94102, 94103, 94104, 94105, 94107, 94108, 94109, 94110, 94111, 94112, 94114, 94115, 94116, 94117, 94118, 94121, 94122, 94123, 94124, 94127',
        'suburbs' => 'Oakland, Berkeley, San Jose, Fremont, Santa Clara, Sunnyvale, Hayward, Alameda, San Mateo, Redwood City, Daly City, South San Francisco, San Leandro, Milpitas, Richmond, Concord, Walnut Creek, San Ramon, Dublin, Pleasanton',
        'state' => 'California',
    ),
    array(
        'title' => 'Houston', 'slug' => 'houston',
        'zip'   => '77001, 77002, 77003, 77004, 77005, 77006, 77007, 77008, 77009, 77010, 77011, 77012, 77018, 77019, 77024, 77025, 77030, 77056, 77057, 77098',
        'suburbs' => 'Sugar Land, Katy, The Woodlands, Pearland, League City, Pasadena, Missouri City, Friendswood, Baytown, Conroe, Humble, Spring, Cypress, Tomball, Stafford, Richmond, Galveston, Alvin, Clear Lake, Deer Park',
        'state' => 'Texas',
    ),
    array(
        'title' => 'Miami', 'slug' => 'miami',
        'zip'   => '33101, 33125, 33126, 33127, 33128, 33129, 33130, 33131, 33132, 33133, 33134, 33135, 33136, 33137, 33138, 33139, 33140, 33141, 33142, 33143',
        'suburbs' => 'Coral Gables, Hialeah, Fort Lauderdale, Miami Beach, Doral, Homestead, North Miami, Aventura, Pembroke Pines, Hollywood, Miramar, Davie, Plantation, Sunrise, Lauderhill, West Palm Beach, Boca Raton, Delray Beach, Pompano Beach, Boynton Beach',
        'state' => 'Florida',
    ),
    array(
        'title' => 'Los Angeles', 'slug' => 'los-angeles',
        'zip'   => '90001, 90002, 90003, 90004, 90005, 90006, 90007, 90008, 90010, 90011, 90012, 90013, 90014, 90015, 90016, 90017, 90018, 90019, 90020, 90021',
        'suburbs' => 'Pasadena, Burbank, Santa Monica, Glendale, Long Beach, Torrance, El Monte, Pomona, Inglewood, Downey, West Covina, Norwalk, Compton, South Gate, Carson, El Cajon, Thousand Oaks, Simi Valley, Lancaster, Palmdale',
        'state' => 'California',
    ),
    array(
        'title' => 'New York', 'slug' => 'new-york',
        'zip'   => '10001, 10002, 10003, 10004, 10005, 10006, 10007, 10009, 10010, 10011, 10012, 10013, 10014, 10016, 10017, 10018, 10019, 10020, 10021, 10022',
        'suburbs' => 'Brooklyn, Queens, Bronx, Staten Island, Jersey City, Newark, Hoboken, Yonkers, New Rochelle, White Plains, Mount Vernon, Flushing, Jamaica, Astoria, Long Island City, Stamford, Bridgeport, Paterson, Elizabeth, Edison',
        'state' => 'New York',
    ),
);

foreach ( $cities_data as $c ) {
    brp_setup_create_cpt( 'city', $c['title'], $c['slug'],
        'page-templates/template-city.php',
        array(
            '_brp_zip_codes' => $c['zip'],
            '_brp_suburbs'   => $c['suburbs'],
            '_brp_state'     => $c['state'],
        )
    );
}

// ============================================================
// 4. ERROR CODE POSTS — removed, will be added manually
// ============================================================
$error_codes_setup = array(
    // intentionally empty — error codes will be added via WP admin
    array( 'title' => 'placeholder-do-not-use', 'slug' => 'placeholder-do-not-use', 'code' => '', 'appliance' => 'dishwasher' ),
);

// Create appliance_type terms
$appliance_terms = array( 'oven', 'microwave', 'freezer', 'cooktop', 'refrigerator', 'dishwasher', 'dryer', 'wine-cooler', 'hood', 'washer' );
foreach ( $appliance_terms as $term ) {
    if ( ! term_exists( $term, 'appliance_type' ) ) {
        wp_insert_term( ucfirst( $term ), 'appliance_type', array( 'slug' => $term ) );
    }
}

// Error codes are added manually via WP Admin — no auto-creation here.

// ============================================================
// 5. STATIC ARCHIVE/HUB PAGES
// ============================================================
brp_setup_create_page( 'Error Codes', 'error-codes', 'page-templates/template-error-codes-hub.php' );
brp_setup_create_page( 'Recalls', 'recalls', 'page-templates/template-recalls.php' );

// Error code appliance sub-pages (for URL structure /error-codes/dishwasher/)
$error_hub_id = get_page_by_path( 'error-codes' );
$ec_appliances = array( 'dishwasher', 'washer', 'dryer', 'refrigerator', 'oven', 'cooktop', 'microwave', 'freezer' );
$ec_labels = array( 'Dishwasher', 'Washer', 'Dryer', 'Refrigerator', 'Oven & Range', 'Cooktop', 'Microwave', 'Freezer' );
if ( $error_hub_id ) {
    foreach ( $ec_appliances as $i => $slug ) {
        brp_setup_create_page(
            'Monogram ' . $ec_labels[$i] . ' Error Codes',
            $slug,
            'page-templates/template-error-codes-appliance.php',
            '',
            $error_hub_id->ID
        );
    }
}

// ============================================================
// 6. FLUSH REWRITE RULES
// ============================================================
flush_rewrite_rules();

// ============================================================
// 7. OUTPUT LOG
// ============================================================
echo '<div style="font-family:monospace;background:#1e1e1e;color:#d4d4d4;padding:20px;margin:20px;border-radius:8px;">';
echo '<h2 style="color:#4ec9b0;">✅ Monogram Repair Pro – Setup Complete</h2>';
echo '<p style="color:#9cdcfe;">The following pages and posts have been created:</p>';
echo '<ul>';
foreach ( $log as $entry ) {
    $color = strpos( $entry, 'EXISTS' ) !== false ? '#ce9178' : '#b5cea8';
    echo '<li style="color:' . $color . ';">' . esc_html( $entry ) . '</li>';
}
echo '</ul>';
echo '<p style="color:#569cd6;margin-top:20px;"><strong>Next Steps:</strong></p>';
echo '<ol style="color:#d4d4d4;">';
echo '<li>Go to Appearance → Menus and create your Primary navigation menu.</li>';
echo '<li>Set your homepage: Settings → Reading → Static Page → Home.</li>';
echo '<li>Set your blog page: Settings → Reading → Posts page → Blog.</li>';
echo '<li>Add your phone number in functions.php (BRP_PHONE constant).</li>';
echo '<li>Upload appliance images to each Service post via Media Library.</li>';
echo '<li>Install and configure an SEO plugin (e.g., Yoast SEO or RankMath).</li>';
echo '<li>Add Google Analytics or GTM tracking code via Settings or plugin.</li>';
echo '<li>REMOVE the include() call from functions.php after running this setup.</li>';
echo '</ol>';
echo '</div>';
