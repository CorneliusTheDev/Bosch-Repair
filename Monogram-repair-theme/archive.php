<?php
/**
 * Archive template — used for post type archives, taxonomies, categories.
 *
 * @package MonogramRepairPro
 */
get_header();

if ( is_post_type_archive( 'error_code' ) ) :

    // Category display config — icon + label per appliance slug
    $cat_config = array(
        'dishwasher'   => array( 'label' => 'Dishwashers',    'icon' => '🍽️' ),
        'washer'       => array( 'label' => 'Washers',        'icon' => '🫧' ),
        'dryer'        => array( 'label' => 'Dryers',         'icon' => '🌀' ),
        'refrigerator' => array( 'label' => 'Refrigerators',  'icon' => '🧊' ),
        'oven'         => array( 'label' => 'Ovens & Ranges', 'icon' => '🍳' ),
        'cooktop'      => array( 'label' => 'Cooktops',       'icon' => '♨️' ),
        'range'        => array( 'label' => 'Ranges',         'icon' => '🍳' ),
        'wall-oven'    => array( 'label' => 'Wall Ovens',     'icon' => '🔲' ),
        'speed-oven'   => array( 'label' => 'Speed Ovens',    'icon' => '⚡' ),
    );

    // Query ALL published error codes from DB, grouped by appliance_type term
    $ec_query = new WP_Query( array(
        'post_type'      => 'error_code',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'meta_value',
        'meta_key'       => '_brp_error_code',
        'order'          => 'ASC',
    ) );

    // Build grouped array and collect used categories
    $all_error_codes = array();
    $used_slugs      = array();

    if ( $ec_query->have_posts() ) {
        while ( $ec_query->have_posts() ) {
            $ec_query->the_post();
            $terms = wp_get_post_terms( get_the_ID(), 'appliance_type' );
            if ( empty( $terms ) || is_wp_error( $terms ) ) continue;
            $term_slug = $terms[0]->slug;
            $code_val  = get_post_meta( get_the_ID(), '_brp_error_code', true ) ?: get_the_title();
            $all_error_codes[ $term_slug ][] = array(
                'code'  => $code_val,
                'title' => get_the_title(),
                'slug'  => $term_slug,
                'url'   => get_permalink(),
            );
            $used_slugs[ $term_slug ] = true;
        }
        wp_reset_postdata();
    }

    // Build $categories only from terms that have posts
    $categories = array();
    foreach ( $cat_config as $slug => $cfg ) {
        if ( isset( $used_slugs[ $slug ] ) ) {
            $categories[] = array( 'slug' => $slug, 'label' => $cfg['label'], 'icon' => $cfg['icon'] );
        }
    }
    // Also add any DB terms not in cat_config
    foreach ( $used_slugs as $slug => $_ ) {
        if ( ! isset( $cat_config[ $slug ] ) ) {
            $term = get_term_by( 'slug', $slug, 'appliance_type' );
            $categories[] = array( 'slug' => $slug, 'label' => $term ? $term->name : ucfirst( $slug ), 'icon' => '🔧' );
        }
    }

    ?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1>Monogram Appliance Error Codes</h1>
            <p>Look up any Monogram error code by selecting your appliance type below. Each code includes a plain-language explanation, common causes, and step-by-step troubleshooting guidance.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <div class="section-header text-center" style="max-width:800px;margin:0 auto 40px;">
                <span class="section-label">Browse by Appliance</span>
                <h2 class="section-title">Monogram Error Code Database</h2>
                <p style="color:var(--color-gray);margin-top:16px;">Monogram appliances display error codes on their control panels to alert you to a specific fault. These codes help identify the problem quickly — whether it's a sensor failure, a heating issue, a drainage fault, or a control board problem. Use this database to find your code, understand what it means, and learn what steps to take before calling a technician.</p>
                <p style="color:var(--color-gray);margin-top:12px;">Our database covers error codes for Monogram dishwashers, refrigerators, ranges, wall ovens, cooktops, and speed ovens. Each entry explains the root cause, lists common contributing factors, and provides a clear troubleshooting sequence. If the issue persists after basic troubleshooting, our certified Monogram technicians are available for same-day diagnosis and repair.</p>
            </div>

            <div class="brp-topic-filters" id="brpEcFilters">
                <button class="btn btn-primary" data-filter="all">All Errors</button>
                <?php foreach ( $categories as $cat ) : ?>
                <button class="btn btn-secondary" data-filter="<?php echo esc_attr( $cat['slug'] ); ?>">
                    <?php echo $cat['icon']; ?> <?php echo esc_html( $cat['label'] ); ?>
                </button>
                <?php endforeach; ?>
            </div>

            <div class="section-header" style="margin-top:56px;">
                <span class="section-label" id="brpEcLabel">All Errors</span>
                <h3 class="section-title" id="brpEcTitle">All Error Codes</h3>
            </div>

            <div id="brpEcGrid" style="display:flex;flex-direction:column;gap:10px;">
                <?php foreach ( $all_error_codes as $appliance_slug => $codes ) :
                    $appliance_label = $appliance_slug;
                    $appliance_icon  = '🔧';
                    foreach ( $categories as $cat ) {
                        if ( $cat['slug'] === $appliance_slug ) {
                            $appliance_label = $cat['label'];
                            $appliance_icon  = $cat['icon'];
                            break;
                        }
                    }
                    foreach ( $codes as $ec ) :
                ?>
                <a href="<?php echo esc_url( $ec['url'] ); ?>"
                   class="error-card"
                   data-appliance="<?php echo esc_attr( $appliance_slug ); ?>">
                    <span class="error-code-badge"><?php echo esc_html( $ec['code'] ); ?></span>
                    <div class="error-card-info">
                        <h4><?php echo esc_html( $ec['title'] ); ?></h4>
                        <p><?php echo $appliance_icon; ?> <?php echo esc_html( $appliance_label ); ?></p>
                    </div>
                    <span style="margin-left:auto;color:var(--color-gray);font-size:1.25rem;flex-shrink:0;">›</span>
                </a>
                <?php endforeach; endforeach; ?>
            </div>

            <div id="brpEcNoResults" style="display:none;text-align:center;padding:60px 20px;
                 background:var(--color-light);border-radius:var(--border-radius-lg);">
                <div style="font-size:3rem;margin-bottom:12px;">🔍</div>
                <h3 id="brpEcNoResultsMsg">No error codes found</h3>
                <button class="btn btn-primary" style="margin-top:16px;" onclick="brpEcFilter('all')">
                    Show All Errors
                </button>
            </div>

            <!-- SEO content block -->
            <div style="max-width:800px;margin:64px auto 0;border-top:1px solid var(--color-gray-light);padding-top:48px;">
                <h2 style="margin-bottom:16px;">How to Use Monogram Error Codes</h2>
                <p style="color:var(--color-gray);">When a Monogram appliance detects a fault, it interrupts the current operation and displays an alphanumeric code on the control panel. This code is a direct signal from the appliance's internal diagnostics — it tells you which component or circuit has triggered the fault condition. Understanding what the code means is the first step toward resolving the issue, either through basic user troubleshooting or by calling a certified repair technician.</p>
                <p style="color:var(--color-gray);margin-top:12px;">To use this database: note the exact code shown on your appliance display, select your appliance category using the filter buttons above, and click the matching error code entry. Each page explains the fault in plain language, lists the most common root causes, and walks you through a logical troubleshooting sequence — starting with the simplest checks you can do yourself before escalating to a service call.</p>

                <h3 style="margin-top:32px;margin-bottom:12px;">When to Call a Professional</h3>
                <p style="color:var(--color-gray);">Some Monogram error codes can be cleared with a simple power reset or a basic fix — a clogged filter, a partially closed water valve, or a door that wasn't fully latched. Other codes indicate hardware failures that require component replacement by a trained technician: a burned-out heating element, a failed control board, a seized fan motor, or a refrigerant leak. If basic troubleshooting does not clear the code, or if the code returns after a short time, do not delay. Continued operation with an active fault can cause secondary damage to other components and increase the total cost of repair.</p>
                <p style="color:var(--color-gray);margin-top:12px;">Our certified Monogram technicians diagnose error codes using factory service tools and carry the most common OEM replacement parts on every service vehicle. Most repairs are completed in a single visit. Call <a href="tel:<?php echo BRP_PHONE_RAW; ?>"><?php echo BRP_PHONE; ?></a> or use the booking form below to schedule same-day service.</p>

                <h3 style="margin-top:32px;margin-bottom:12px;">Appliances Covered in This Database</h3>
                <ul style="color:var(--color-gray);display:flex;flex-direction:column;gap:6px;padding-left:20px;">
                    <li><strong>Monogram Dishwashers</strong> — water inlet, drain, heating, pump, door latch, and flood protection codes</li>
                    <li><strong>Monogram Refrigerators</strong> — defrost, fan motor, temperature sensor, ice maker, and communication codes</li>
                    <li><strong>Monogram Ranges &amp; Ovens</strong> — temperature sensor, door lock, relay, control board, and runaway temperature codes</li>
                    <li><strong>Monogram Wall Ovens</strong> — sensor, latch, convection, and relay fault codes</li>
                    <li><strong>Monogram Cooktops</strong> — surface element, control lock, temperature sensor, and communication codes</li>
                    <li><strong>Monogram Speed Ovens</strong> — control board, sensor, door interlock, and fan motor codes</li>
                </ul>
            </div>

        </div>
    </section>

    <script>
    var brpEcLabels = {
        'all': { label: 'All Errors', title: 'All Error Codes' },
        <?php foreach ( $categories as $cat ) : ?>
        '<?php echo esc_js( $cat['slug'] ); ?>': { label: '<?php echo esc_js( $cat['label'] ); ?>', title: '<?php echo esc_js( $cat['label'] ); ?> Error Codes' },
        <?php endforeach; ?>
    };

    function brpEcFilter( filter ) {
        var cards     = document.querySelectorAll('#brpEcGrid .error-card');
        var noResults = document.getElementById('brpEcNoResults');
        var grid      = document.getElementById('brpEcGrid');
        var label     = document.getElementById('brpEcLabel');
        var title     = document.getElementById('brpEcTitle');
        var btns      = document.querySelectorAll('#brpEcFilters .btn');
        var visible   = 0;

        btns.forEach(function(btn) {
            btn.className = btn.getAttribute('data-filter') === filter
                ? 'btn btn-primary' : 'btn btn-secondary';
        });

        cards.forEach(function(card) {
            var show = filter === 'all' || card.getAttribute('data-appliance') === filter;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        if ( brpEcLabels[filter] ) {
            label.textContent = brpEcLabels[filter].label;
            title.textContent = brpEcLabels[filter].title;
        }

        if (visible === 0) {
            grid.style.display      = 'none';
            noResults.style.display = 'block';
            document.getElementById('brpEcNoResultsMsg').textContent =
                'No error codes found for "' + (brpEcLabels[filter] ? brpEcLabels[filter].label : filter) + '"';
        } else {
            grid.style.display      = '';
            noResults.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#brpEcFilters .btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                brpEcFilter( this.getAttribute('data-filter') );
            });
        });
    });
    </script>

    <?php echo brp_appointment_form( 'Got an Error Code? We\'ll Fix It Today' ); ?>

<?php elseif ( is_post_type_archive( 'recall' ) ) : ?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Product Recalls & Safety Notices</h1>
        <p>Important safety information about Monogram appliances. Check if your appliance is affected and learn what steps to take next.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid grid-3" style="gap:24px;">

            <!-- Card 1 -->
            <div style="background:#fff;border-radius:var(--border-radius-lg);box-shadow:var(--shadow);padding:28px;display:flex;flex-direction:column;gap:12px;">
                <h3 style="font-size:1.05rem;margin:0;">Gas Cooktop & Range</h3>
                <p style="font-size:0.85rem;color:var(--color-gray);margin:0;"><strong>Models Affected:</strong> ZGP366NTSS, ZGP486NDTSS, ZGP366LRSS</p>
                <p style="font-size:0.9rem;color:var(--color-text);margin:0;flex:1;">Defective burner valve may allow unburned gas to escape, posing a fire and explosion hazard. Stop using affected units immediately and contact us for a free inspection.</p>
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-top:auto;">
                    <span style="font-size:0.78rem;background:rgba(255,107,53,0.1);color:#ff6b35;padding:4px 10px;border-radius:20px;font-weight:600;">February 2024</span>
                    <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">Learn More ↗</a>
                </div>
            </div>

            <!-- Card 2 -->
            <div style="background:#fff;border-radius:var(--border-radius-lg);box-shadow:var(--shadow);padding:28px;display:flex;flex-direction:column;gap:12px;">
                <h3 style="font-size:1.05rem;margin:0;">Built-In Dishwasher</h3>
                <p style="font-size:0.85rem;color:var(--color-gray);margin:0;"><strong>Models Affected:</strong> ZDT925SSJSS, ZDT870SSJSS, ZDT800SSJSS</p>
                <p style="font-size:0.9rem;color:var(--color-text);margin:0;flex:1;">Door latch failure may cause mid-cycle release of scalding water or steam, posing a burn hazard. Discontinue use and schedule a recall repair at no cost to you.</p>
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-top:auto;">
                    <span style="font-size:0.78rem;background:rgba(255,107,53,0.1);color:#ff6b35;padding:4px 10px;border-radius:20px;font-weight:600;">August 2023</span>
                    <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">Learn More ↗</a>
                </div>
            </div>

            <!-- Card 3 -->
            <div style="background:#fff;border-radius:var(--border-radius-lg);box-shadow:var(--shadow);padding:28px;display:flex;flex-direction:column;gap:12px;">
                <h3 style="font-size:1.05rem;margin:0;">Built-In Refrigerator & Freezer</h3>
                <p style="font-size:0.85rem;color:var(--color-gray);margin:0;"><strong>Models Affected:</strong> ZIS480NXLH, ZISS480NNSS, ZIS480NRSS</p>
                <p style="font-size:0.9rem;color:var(--color-text);margin:0;flex:1;">Internal water line crack may cause hidden leakage beneath cabinetry, posing a slip-and-fall hazard. Our technicians can verify your model and arrange a manufacturer-covered repair.</p>
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-top:auto;">
                    <span style="font-size:0.78rem;background:rgba(255,107,53,0.1);color:#ff6b35;padding:4px 10px;border-radius:20px;font-weight:600;">April 2022</span>
                    <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">Learn More ↗</a>
                </div>
            </div>

            <!-- Card 4 -->
            <div style="background:#fff;border-radius:var(--border-radius-lg);box-shadow:var(--shadow);padding:28px;display:flex;flex-direction:column;gap:12px;">
                <h3 style="font-size:1.05rem;margin:0;">Wall Oven</h3>
                <p style="font-size:0.85rem;color:var(--color-gray);margin:0;"><strong>Models Affected:</strong> ZTD91SSSS, ZTD91SHSS, ZET1SH4SS</p>
                <p style="font-size:0.9rem;color:var(--color-text);margin:0;flex:1;">Control board defect may cause oven to activate unexpectedly or fail to exit self-clean cycle, posing a fire hazard. Do not use self-clean mode until the recall repair is completed.</p>
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-top:auto;">
                    <span style="font-size:0.78rem;background:rgba(255,107,53,0.1);color:#ff6b35;padding:4px 10px;border-radius:20px;font-weight:600;">November 2023</span>
                    <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">Learn More ↗</a>
                </div>
            </div>

            <!-- Card 5 -->
            <div style="background:#fff;border-radius:var(--border-radius-lg);box-shadow:var(--shadow);padding:28px;display:flex;flex-direction:column;gap:12px;">
                <h3 style="font-size:1.05rem;margin:0;">Speed Oven & Microwave</h3>
                <p style="font-size:0.85rem;color:var(--color-gray);margin:0;"><strong>Models Affected:</strong> ZSC1202NSS, ZSC2202NSS, ZSC2201NSS</p>
                <p style="font-size:0.9rem;color:var(--color-text);margin:0;flex:1;">Control panel malfunction may cause unexpected operation or unintended heating cycles. Call us to confirm your model number and schedule a free recall service visit.</p>
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-top:auto;">
                    <span style="font-size:0.78rem;background:rgba(255,107,53,0.1);color:#ff6b35;padding:4px 10px;border-radius:20px;font-weight:600;">June 2023</span>
                    <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">Learn More ↗</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- About Recalls -->
<section class="section" style="padding-top:0;">
    <div class="container" style="max-width:860px;">
        <div style="background:#fff;border-radius:var(--border-radius-lg);padding:36px;box-shadow:var(--shadow);">
            <h2 style="margin-bottom:20px;">About Monogram Appliance Recalls</h2>
            <p style="color:var(--color-text);margin-bottom:16px;">A product recall is a formal safety action coordinated between the appliance manufacturer and the U.S. Consumer Product Safety Commission (CPSC). When a defect is identified that poses a risk of fire, electric shock, injury, or property damage, the manufacturer is required by law to notify all affected consumers and provide a free remedy — whether that is a replacement part, a repair, or a full product replacement. Recalls are legally binding, and the manufacturer cannot charge you for the fix under any circumstances.</p>
            <p style="color:var(--color-text);margin-bottom:16px;">Monogram is GE Appliances' professional built-in line, designed for high-end residential kitchens. Because Monogram appliances are installed in cabinetry and used daily, defects in gas valves, door assemblies, water lines, and control boards can escalate quickly into serious safety hazards. Past Monogram recalls have involved units that were already years into service — which is why it is critical to check your model number even if your appliance has been running without issue.</p>
            <p style="color:var(--color-text);margin:0;">If your Monogram appliance model number appears in any active or historical recall notice, stop using the affected function immediately and contact us. Our certified Monogram technicians are authorized to perform recall repairs, verify your recall eligibility, and coordinate directly with GE on your behalf — at no cost to you.</p>
        </div>
    </div>
</section>

<!-- How to Check -->
<section class="section" style="padding-top:0;">
    <div class="container" style="max-width:860px;">
        <div style="background:#fff;border-radius:var(--border-radius-lg);padding:36px;box-shadow:var(--shadow);">
            <h2 style="margin-bottom:20px;">How to Check if Your Monogram Appliance Is Recalled</h2>
            <p style="color:var(--color-text);margin-bottom:16px;">Every Monogram appliance carries a model and serial number label. The location varies by appliance type:</p>
            <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:12px;margin-bottom:16px;">
                <li style="display:flex;align-items:flex-start;gap:12px;">
                    <span style="color:var(--color-primary);font-weight:700;flex-shrink:0;">&#8250;</span>
                    <span><strong>Refrigerators & Freezers:</strong> Inside the door frame, upper left or right corner.</span>
                </li>
                <li style="display:flex;align-items:flex-start;gap:12px;">
                    <span style="color:var(--color-primary);font-weight:700;flex-shrink:0;">&#8250;</span>
                    <span><strong>Dishwashers:</strong> Inside the door frame along the top or side edge.</span>
                </li>
                <li style="display:flex;align-items:flex-start;gap:12px;">
                    <span style="color:var(--color-primary);font-weight:700;flex-shrink:0;">&#8250;</span>
                    <span><strong>Gas Cooktops & Ranges:</strong> Underside of the unit or inside the base storage drawer.</span>
                </li>
                <li style="display:flex;align-items:flex-start;gap:12px;">
                    <span style="color:var(--color-primary);font-weight:700;flex-shrink:0;">&#8250;</span>
                    <span><strong>Wall Ovens:</strong> Inner door frame, visible when the oven door is open.</span>
                </li>
                <li style="display:flex;align-items:flex-start;gap:12px;">
                    <span style="color:var(--color-primary);font-weight:700;flex-shrink:0;">&#8250;</span>
                    <span><strong>Microwaves & Speed Ovens:</strong> Interior cavity wall, typically on the left side.</span>
                </li>
            </ul>
            <p style="color:var(--color-text);margin:0;">Monogram model numbers begin with the letter "Z" — for example, ZGP, ZDT, ZIS, ZTD, or ZSC. Once you have your model number, compare it to the recall notices listed on this page and at <strong>cpsc.gov/Recalls</strong>.</p>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section" style="padding-top:0;">
    <div class="container" style="max-width:860px;">
        <div style="background:#fff;border-radius:var(--border-radius-lg);padding:36px;box-shadow:var(--shadow);">
            <h2 style="margin-bottom:24px;">Frequently Asked Questions About Monogram Recalls</h2>
            <div style="display:flex;flex-direction:column;gap:24px;">
                <div>
                    <h3 style="font-size:1rem;margin-bottom:8px;">Is the recall repair free?</h3>
                    <p style="color:var(--color-text);margin:0;">Yes. All recall repairs are performed at no cost to the appliance owner. Federal law requires the manufacturer to cover 100% of parts and labor for any recall-related fix. You will not be charged a diagnostic fee, a service call fee, or a parts fee.</p>
                </div>
                <div>
                    <h3 style="font-size:1rem;margin-bottom:8px;">Do I need to be the original owner?</h3>
                    <p style="color:var(--color-text);margin:0;">No. Recall eligibility is tied to the appliance model and serial number, not to ownership history. If you purchased a home with a Monogram appliance already installed, you are fully entitled to claim the free recall repair. You do not need a receipt or proof of purchase.</p>
                </div>
                <div>
                    <h3 style="font-size:1rem;margin-bottom:8px;">Can I still use my appliance while waiting for the recall repair?</h3>
                    <p style="color:var(--color-text);margin:0;">It depends on the specific recall. For gas-related recalls, we recommend stopping use of the affected burner or function immediately. For other recalls involving dishwashers or refrigerators, partial use may be safe — but you should confirm with a technician. Call us and we will advise you on safe usage while we arrange your repair appointment.</p>
                </div>
                <div>
                    <h3 style="font-size:1rem;margin-bottom:8px;">How long does a Monogram recall repair take?</h3>
                    <p style="color:var(--color-text);margin:0;">Most recall repairs are completed in a single visit of one to two hours. In cases where a specific replacement part must be ordered, we will schedule a follow-up appointment as soon as the part arrives. We offer same-day and next-day service in most of our service areas.</p>
                </div>
                <div>
                    <h3 style="font-size:1rem;margin-bottom:8px;">What if my recall was issued years ago — is it too late?</h3>
                    <p style="color:var(--color-text);margin:0;">No. Recall remedies do not have an expiration date. Even if the recall was announced two or three years ago, you can still claim the free repair today. Manufacturers are required to honor recall remedies indefinitely until the program is officially closed by the CPSC.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Safety Tips -->
<section class="section" style="padding-top:0;">
    <div class="container" style="max-width:860px;">
        <div style="background:#fff;border-radius:var(--border-radius-lg);padding:36px;box-shadow:var(--shadow);">
            <h2 style="margin-bottom:20px;">Product Safety Tips</h2>
            <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:14px;">
                <li style="display:flex;align-items:flex-start;gap:12px;">
                    <span style="color:var(--color-primary);font-weight:700;flex-shrink:0;margin-top:2px;">✓</span>
                    <span>Register your Monogram appliances at GE's product registration portal to receive recall notifications directly.</span>
                </li>
                <li style="display:flex;align-items:flex-start;gap:12px;">
                    <span style="color:var(--color-primary);font-weight:700;flex-shrink:0;margin-top:2px;">✓</span>
                    <span>Regularly check <strong>cpsc.gov/Recalls</strong> and search "GE Monogram" for the latest safety notices.</span>
                </li>
                <li style="display:flex;align-items:flex-start;gap:12px;">
                    <span style="color:var(--color-primary);font-weight:700;flex-shrink:0;margin-top:2px;">✓</span>
                    <span>Follow all manufacturer usage and maintenance guidelines to reduce the risk of appliance failure.</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Need Assistance -->
<section class="section" style="padding-top:0;">
    <div class="container" style="max-width:860px;">
        <div style="background:#fff;border-radius:var(--border-radius-lg);padding:36px;box-shadow:var(--shadow);text-align:center;">
            <h2 style="margin-bottom:12px;">Need Assistance?</h2>
            <p style="color:var(--color-gray);margin-bottom:24px;">Not sure if your Monogram appliance is affected? Our technicians can check your model, help you through the GE recall process, and perform manufacturer-covered repairs at no cost to you.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary">Call <?php echo BRP_PHONE; ?></a>
                <a href="#schedule" class="btn btn-secondary">Book Online</a>
            </div>
        </div>
    </div>
</section>

<?php echo brp_appointment_form(); ?>

<?php elseif ( is_post_type_archive( 'service' ) ) :
    $services = brp_get_services();
?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1>Monogram Appliance Repair Services</h1>
            <p>Professional Monogram appliance repair for every appliance in your home. Factory-certified parts, same-day service, and a 30-day labor warranty on every repair.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="grid grid-3">
                <?php foreach ( $services as $s ) :
                    $card_img = get_template_directory_uri() . '/assets/images/services/' . $s['image'];
                    $clean_title  = preg_replace( '/^Monogram\s+/i', '', $s['title'] );
                    $service_url  = home_url( '/services/' . $s['slug'] . '/' );
                ?>
                <div class="service-card">
                    <div class="service-card-img-wrap">
                        <img src="<?php echo esc_url( $card_img ); ?>"
                             alt="<?php echo esc_attr( $s['title'] ); ?>"
                             loading="lazy" width="600" height="300"
>
                    </div>
                    <div class="service-card-body">
                        <div>
                            <h3><a href="<?php echo esc_url( $service_url ); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html( $clean_title ); ?></a></h3>
                            <p><?php echo esc_html( $s['desc'] ); ?></p>
                        </div>
                        <a href="<?php echo esc_url( $service_url ); ?>" class="service-card-link">Schedule Repair →</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- SEO content block -->
            <div style="max-width:800px;margin:64px auto 0;border-top:1px solid var(--color-gray-light);padding-top:48px;">
                <h2 style="margin-bottom:16px;">Why Monogram Appliances Require Specialist Repair</h2>
                <p style="color:var(--color-gray);">Monogram is GE's professional-grade appliance line, built to tighter tolerances and with more sophisticated electronics than standard consumer appliances. A Monogram refrigerator, range, or dishwasher is not repaired the same way as a basic model. These appliances use proprietary control boards, specialized sensors, and OEM-specific components that must be sourced through authorized channels. Using aftermarket parts or following generic repair procedures can cause secondary damage, void the remaining warranty, and result in appliance performance that falls below factory specifications.</p>
                <p style="color:var(--color-gray);margin-top:12px;">Our technicians train specifically on Monogram product lines. They understand how Monogram's connected appliances communicate with smart home systems, how the column refrigerator sealed systems are configured, and how Monogram's professional-style ranges are calibrated from the factory. This depth of product knowledge means faster, more accurate diagnosis — and repairs that last.</p>

                <h3 style="margin-top:32px;margin-bottom:12px;">Our Repair Process</h3>
                <p style="color:var(--color-gray);">Every Monogram repair starts with a thorough diagnostic. Our technician arrives with factory-level diagnostic tools and a stocked service vehicle carrying the most common OEM Monogram replacement parts. After identifying the fault, we provide a clear, upfront quote before any work begins. There are no hidden labor charges and no surprise fees. Once you approve the quote, we complete the repair — typically within the same visit — and run a full test cycle before leaving your home.</p>
                <p style="color:var(--color-gray);margin-top:12px;">Every repair is backed by our 30-day labor warranty. If the same fault returns within 30 days of service, we return and fix it at no additional charge. We stand behind our work because we know Monogram appliances and we know how to fix them correctly the first time.</p>

                <h3 style="margin-top:32px;margin-bottom:12px;">Same-Day Service Available</h3>
                <p style="color:var(--color-gray);">A broken appliance disrupts your household. We offer same-day and next-day service appointments across all our service areas. Call <a href="tel:<?php echo BRP_PHONE_RAW; ?>"><?php echo BRP_PHONE; ?></a> or use the booking form below to schedule your repair. We confirm appointments quickly and send a technician who arrives on time, prepared to complete your repair in a single visit.</p>
            </div>
        </div>
    </section>

    <?php echo brp_appointment_form( 'Book Your Monogram Repair Today' ); ?>

<?php elseif ( is_post_type_archive( 'city' ) ) :
    $cities = brp_get_cities();
?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1>Monogram Appliance Repair Near You</h1>
            <p>Looking for reliable appliance repair near you? We send certified Monogram technicians to 6 major U.S. cities and all surrounding suburbs — often the same day you call.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <div class="section-header text-center" style="max-width:800px;margin:0 auto 48px;">
                <span class="section-label">Local Service Areas</span>
                <h2 class="section-title">Cities We Serve</h2>
            </div>

            <div class="city-cards-grid">
                <?php foreach ( $cities as $city ) :
                    $city_url = home_url( '/cities/' . $city['slug'] . '/' );
                ?>
                <a href="<?php echo esc_url( $city_url ); ?>" class="city-img-card">
                    <div class="city-img-wrap">
                        <img src="<?php echo esc_url( $city['image'] ); ?>"
                             alt="Monogram appliance repair in <?php echo esc_attr( $city['title'] ); ?>"
                             loading="lazy" width="800" height="500">
                        <div class="city-img-overlay"></div>
                        <div class="city-img-label">
                            <span class="city-img-name"><?php echo esc_html( $city['title'] ); ?></span>
                            <span class="city-img-state"><?php echo esc_html( $city['state'] ); ?></span>
                        </div>
                    </div>
                    <div class="city-img-body">
                        <p class="city-img-suburbs"><?php echo esc_html( 'Also serving: ' . implode( ', ', array_slice( explode( ', ', $city['suburbs'] ), 0, 4 ) ) . ' &amp; more' ); ?></p>
                        <span class="city-img-cta">View Service Area →</span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- Intro text -->
            <div style="max-width:800px;margin:48px auto 0;text-align:center;">
                <p class="section-desc">Same-day and next-day appointments are available across all our service areas. Click your city to see local coverage, neighborhoods we serve, and how to book fast.</p>
                <p style="color:var(--color-gray);margin-top:12px;">We know how frustrating it is when a refrigerator stops cooling or a range won't heat. That's why we focus on getting a technician to your door quickly — not in a week, but today or tomorrow. Every tech on our team works exclusively on Monogram appliances, so they walk in knowing your machine, carrying the right parts, and ready to get it fixed in one visit.</p>
            </div>

            <!-- SEO content block -->
            <div style="max-width:800px;margin:64px auto 0;border-top:1px solid var(--color-gray-light);padding-top:48px;">
                <h2 style="margin-bottom:16px;">Why Homeowners Trust Us for Local Appliance Repair</h2>
                <p style="color:var(--color-gray);">When you search for appliance repair near me, you want someone local who actually shows up on time, knows what they're doing, and charges a fair price. That's exactly what we do. Our technicians live and work in the same metro areas you do. They're not dispatched from across the state — they're already nearby, which means faster response times and easier scheduling.</p>
                <p style="color:var(--color-gray);margin-top:12px;">We specialize in Monogram appliances because these are premium machines built to tighter specs than standard brands. They need a tech who understands Monogram's control systems, error codes, and OEM parts — not someone who works on everything from every brand and guesses their way through a repair. Our focus makes us faster and more accurate than a general appliance repair company.</p>

                <h3 style="margin-top:32px;margin-bottom:12px;">What Happens After You Call</h3>
                <p style="color:var(--color-gray);">You call or book online, we confirm your appointment window the same day, and a technician arrives on time with the tools and parts needed to diagnose and repair your appliance. Before we touch anything, we give you a straight, upfront quote — no hidden fees, no surprises. You say yes, we fix it, then we run a full test to make sure everything works before we leave.</p>
                <p style="color:var(--color-gray);margin-top:12px;">Every repair comes with a 30-day labor warranty. If the same problem comes back within 30 days, we return and fix it at no extra charge. We stand behind every job we do.</p>

                <h3 style="margin-top:32px;margin-bottom:12px;">All Monogram Appliances, Every City</h3>
                <p style="color:var(--color-gray);">No matter which city you're in, we service the full lineup of Monogram appliances: refrigerators, dishwashers, ranges, wall ovens, cooktops, speed ovens, wine coolers, range hoods, washers, and dryers. Built-in column fridge, 48-inch pro range, panel-ready dishwasher — we've fixed them all. Call <a href="tel:<?php echo BRP_PHONE_RAW; ?>"><?php echo BRP_PHONE; ?></a> to speak with a local scheduler or book online below.</p>
            </div>

        </div>
    </section>

    <?php echo brp_appointment_form( 'Book Your Monogram Repair Today' ); ?>

<?php else : ?>

    <section class="page-hero">
        <div class="container">
            <?php brp_breadcrumbs(); ?>
            <h1><?php
                if ( is_post_type_archive( 'service' ) ) echo 'Monogram Appliance Repair Services';
                elseif ( is_post_type_archive( 'city' ) ) echo 'Cities We Service';
                elseif ( is_post_type_archive( 'recall' ) ) echo 'Maytag Appliance Recalls';
                elseif ( is_tax( 'appliance_type' ) ) echo 'Monogram ' . single_term_title( '', false ) . ' – Error Codes & Guides';
                else the_archive_title();
            ?></h1>
            <p><?php
                if ( is_post_type_archive( 'service' ) ) echo 'Professional Monogram appliance repair for every appliance in your home. Factory-certified parts, same-day service, 30-day warranty.';
                elseif ( is_post_type_archive( 'city' ) ) echo 'We provide expert Monogram appliance repair across 6 major U.S. metropolitan areas and their surrounding suburbs.';
                elseif ( is_post_type_archive( 'recall' ) ) echo 'Current and historical Maytag appliance safety recall information. Check if your appliance is affected.';
                else the_archive_description();
            ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <?php if ( have_posts() ) :

            // Appliance type → local service image
            $brp_appliance_imgs = array(
                'dishwasher'   => get_template_directory_uri() . '/assets/images/services/dishwasher.png',
                'refrigerator' => get_template_directory_uri() . '/assets/images/services/refrigerator.webp',
                'washer'       => get_template_directory_uri() . '/assets/images/services/washer.png',
                'dryer'        => get_template_directory_uri() . '/assets/images/services/dryer.png',
                'oven'         => get_template_directory_uri() . '/assets/images/services/oven.png',
                'cooktop'      => get_template_directory_uri() . '/assets/images/services/cooktop.jpg',
                'microwave'    => get_template_directory_uri() . '/assets/images/services/microwave.png',
                'freezer'      => get_template_directory_uri() . '/assets/images/services/freezer.png',
                'wine-cooler'  => get_template_directory_uri() . '/assets/images/services/wine-cooler.png',
                'hood'         => get_template_directory_uri() . '/assets/images/services/hood.png',
            );
            $brp_img_fallback = get_template_directory_uri() . '/assets/images/services/oven.png';

            ?>
            <div class="grid grid-3">
                <?php while ( have_posts() ) : the_post();

                    $appliance_type = get_post_meta( get_the_ID(), '_brp_appliance_type', true );
                    $clean_title    = preg_replace( '/^(Monogram|Maytag|GE|LG|Samsung|Whirlpool|KitchenAid)\s+/i', '', get_the_title() );

                    if ( is_post_type_archive( 'service' ) ) :
                        // Service cards — image-first polished layout
                        if ( has_post_thumbnail() ) {
                            $card_img = get_the_post_thumbnail_url( null, 'brp-card' );
                        } else {
                            $card_img = $brp_appliance_imgs[ $appliance_type ] ?? $brp_img_fallback;
                        }
                    ?>
                    <div class="service-card">
                        <div class="service-card-img-wrap">
                            <img src="<?php echo esc_url( $card_img ); ?>"
                                 alt="<?php echo esc_attr( $clean_title ); ?>"
                                 loading="lazy" width="600" height="300"
>
                        </div>
                        <div class="service-card-body">
                            <div>
                                <h3><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html( $clean_title ); ?></a></h3>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="service-card-link">Schedule Repair →</a>
                        </div>
                    </div>

                    <?php else :
                        // Generic card for recalls, cities, etc.
                        $code = get_post_meta( get_the_ID(), '_brp_error_code', true );
                    ?>
                    <div class="card">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div style="height:180px;overflow:hidden;">
                            <?php the_post_thumbnail( 'brp-card', array( 'style' => 'width:100%;height:100%;object-fit:cover;' ) ); ?>
                        </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <?php if ( $code ) echo '<span class="error-code-badge" style="margin-bottom:10px;display:inline-block;">' . esc_html( $code ) . '</span>'; ?>
                            <h3 style="font-size:1.05rem;margin-bottom:8px;"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $clean_title ); ?></a></h3>
                            <p style="color:var(--color-gray);font-size:0.875rem;"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
            <?php else : ?>
            <div style="text-align:center;padding:80px 0;">
                <p>No items found. Content will be added soon.</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php echo brp_appointment_form(); ?>

<?php endif; ?>

<?php get_footer(); ?>
