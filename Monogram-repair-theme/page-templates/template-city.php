<?php
/**
 * Template Name: City Page
 * Template Post Type: city
 *
 * Used for individual city pages.
 * e.g. /cities/chicago/
 *
 * @package MonogramRepairPro
 */
get_header();

$city_slug  = get_post_field( 'post_name', get_the_ID() );
$city_title = get_the_title();
$services   = brp_get_services();
$all_cities = brp_get_cities();

// Find city data
$city_data = null;
foreach ( $all_cities as $c ) {
    if ( $c['slug'] === $city_slug ) {
        $city_data = $c;
        break;
    }
}

// Fallback
if ( ! $city_data ) {
    $city_data = array(
        'title'     => $city_title,
        'state'     => get_post_meta( get_the_ID(), '_brp_state', true ) ?: '',
        'zip_codes' => get_post_meta( get_the_ID(), '_brp_zip_codes', true ) ?: '',
        'suburbs'   => get_post_meta( get_the_ID(), '_brp_suburbs', true ) ?: '',
    );
}

$city_name_only = explode( ',', $city_data['title'] )[0];
$suburbs_arr    = explode( ', ', $city_data['suburbs'] );

// City-specific hero subtitles (short, for the banner)
$city_hero_subtitles = array(
    'chicago'       => 'Our Chicago technicians are locally based and stocked for the Monogram configurations common across Lincoln Park, Bucktown, and the North Shore. Same-day service is the standard here — not a premium.',
    'san-francisco' => 'The Bay Area has one of the highest concentrations of Monogram built-ins in the country. Our SF techs are stationed locally — no cross-bay dispatching — and arrive ready to finish the job in a single visit.',
    'houston'       => 'Houston Monogram kitchens often run full appliance suites. Our technicians are spread across the metro and equipped for multi-appliance calls, covering Memorial, River Oaks, The Woodlands, and surrounding areas.',
    'miami'         => 'South Florida\'s humidity and salt air accelerate component wear in ways most homeowners don\'t expect. Our Miami technicians know what to look for in this climate and stock accordingly for Miami-Dade and Broward.',
    'los-angeles'   => 'LA kitchens are built to impress, and a broken Monogram appliance in Beverly Hills or Pacific Palisades doesn\'t wait. Our technicians are distributed across the metro to get to you without the cross-city delay.',
    'new-york'      => 'New York Monogram service means building access, service windows, and freight elevators — our technicians navigate all of it regularly. We work in Manhattan high-rises, Brooklyn brownstones, and Queens homes.',
);
$city_hero_subtitle = isset( $city_hero_subtitles[ $city_slug ] )
    ? $city_hero_subtitles[ $city_slug ]
    : 'Expert ' . BRP_BRAND . ' appliance repair serving ' . esc_html( $city_name_only ) . ' and surrounding suburbs. Locally based technicians, factory-certified parts, and same-day service available.';

$city_faq_map = array(
    'chicago' => array(
        array(
            'q' => 'Do you offer same-day Monogram repair in Chicago?',
            'a' => 'Yes — same-day service is our standard in Chicago, not a premium. Call before noon and we\'ll do everything we can to have a technician at your door the same day. We have multiple techs based across the city and North Shore suburbs, so response times are faster than a company dispatching from outside the metro.',
        ),
        array(
            'q' => 'Which Chicago suburbs do you service?',
            'a' => 'We cover Chicago proper and the surrounding suburbs including ' . $city_data['suburbs'] . '. If you\'re in an area not listed, call us — our actual service area extends beyond what we publish.',
        ),
        array(
            'q' => 'How much does Monogram appliance repair cost in Chicago?',
            'a' => 'We give a fixed quote — parts and labor together — before any work starts. Most Monogram repairs in Chicago fall between $150 and $500 depending on the appliance type and the part required. You approve the price before we touch anything.',
        ),
        array(
            'q' => 'Can you repair Monogram appliances in Chicago high-rises and condos?',
            'a' => 'Yes. Our Chicago technicians regularly work in high-rise buildings, lakefront condos, and older Chicago two-flats. We\'re familiar with building access procedures and can work within your building\'s service hours.',
        ),
        array(
            'q' => 'Do you service legacy Monogram models in Chicago?',
            'a' => 'Yes. We service both current Monogram production models and older legacy units. If your appliance is out of manufacturer support, that\'s often exactly when you need a specialist — and we carry parts for models that most general shops won\'t stock.',
        ),
    ),
    'san-francisco' => array(
        array(
            'q' => 'Do you offer same-day Monogram repair in San Francisco?',
            'a' => 'Yes. Our Bay Area technicians are stationed locally — not dispatched from across the Bay — which makes same-day and next-day scheduling realistic despite Bay Area traffic. Call us in the morning for the best chance at a same-day appointment.',
        ),
        array(
            'q' => 'Which Bay Area areas do you service?',
            'a' => 'We cover San Francisco and the full Bay Area metro including ' . $city_data['suburbs'] . '. If your neighborhood isn\'t listed, call — we may still be able to reach you.',
        ),
        array(
            'q' => 'How much does Monogram repair cost in San Francisco?',
            'a' => 'We quote a fixed price before any work begins — parts and labor together. Bay Area Monogram repairs typically run between $150 and $600 depending on the appliance and the fault. You\'ll have a firm number before we pick up a tool.',
        ),
        array(
            'q' => 'Can you repair panel-ready and integrated Monogram appliances in SF?',
            'a' => 'Yes — panel-ready and integrated configurations are some of the most common setups we see in Pacific Heights, Marin, and Peninsula custom kitchens. Our technicians are experienced with these installations and bring the parts to handle them correctly.',
        ),
        array(
            'q' => 'Do you repair all Monogram appliance types in the Bay Area?',
            'a' => 'We repair the full Monogram lineup — built-in refrigerators, pro ranges, wall ovens, dishwashers, cooktops, speed ovens, wine coolers, and hoods. Both current and legacy models.',
        ),
    ),
    'houston' => array(
        array(
            'q' => 'Do you offer same-day Monogram repair in Houston?',
            'a' => 'Yes. We have multiple technicians spread across the Houston metro — Memorial, River Oaks, The Woodlands, Katy, and beyond — so we can usually reach you the same day without a long cross-city drive. Call us and we\'ll confirm availability for your area immediately.',
        ),
        array(
            'q' => 'Which Houston suburbs do you service?',
            'a' => 'We cover Houston and surrounding communities including ' . $city_data['suburbs'] . '. Call us if your area isn\'t listed — we often extend beyond our published zones.',
        ),
        array(
            'q' => 'Can you handle multi-appliance Monogram service calls in Houston?',
            'a' => 'Yes. Houston Monogram kitchens often run full appliance suites — a 48-inch range, column refrigerator, and integrated dishwasher in the same kitchen. Our technicians are equipped for multi-appliance calls so you\'re not scheduling separate visits for each unit.',
        ),
        array(
            'q' => 'How much does Monogram appliance repair cost in Houston?',
            'a' => 'All quotes are fixed and provided upfront before any work starts. Houston Monogram repairs typically run between $150 and $500. The price you approve is the price you pay.',
        ),
        array(
            'q' => 'Are your Houston Monogram technicians locally based?',
            'a' => 'Yes. Every technician we use in Houston lives and works in the metro area. We don\'t dispatch from a regional hub — that\'s how we keep same-day service a real option rather than a marketing promise.',
        ),
    ),
    'miami' => array(
        array(
            'q' => 'Do you offer same-day Monogram repair in Miami?',
            'a' => 'Yes. We serve Miami-Dade and Broward with locally stationed technicians, and same-day appointments are available throughout the area. If you call in the morning, we\'ll do everything we can to get there the same day.',
        ),
        array(
            'q' => 'Which Miami neighborhoods and areas do you service?',
            'a' => 'We cover Miami-Dade and Broward including ' . $city_data['suburbs'] . '. If your area isn\'t listed, call — we\'re often able to extend beyond our published zones.',
        ),
        array(
            'q' => 'Does Miami\'s climate affect Monogram appliances differently?',
            'a' => 'Yes, and our technicians know exactly how. South Florida\'s humidity and salt air accelerate corrosion on electrical contacts, speed up gasket wear, and cause moisture-related control board failures at a higher rate than other markets. Our Miami team stocks for the failures that are most common in this climate.',
        ),
        array(
            'q' => 'Do you work in Miami high-rises and condo buildings?',
            'a' => 'Yes — we regularly work in Brickell, Edgewater, and other high-rise areas. We\'re used to coordinating with building management, working within service elevator windows, and navigating the logistics that come with condo appliance repair.',
        ),
        array(
            'q' => 'How much does Monogram repair cost in Miami?',
            'a' => 'We quote a fixed price — parts and labor — before starting any work. Miami Monogram repairs typically run $150–$500 depending on the appliance type and fault. No open-ended billing.',
        ),
    ),
    'los-angeles' => array(
        array(
            'q' => 'Do you offer same-day Monogram repair in Los Angeles?',
            'a' => 'Yes. Our technicians are distributed across the LA metro — we don\'t have everyone based in one location — so we can get to Bel Air, Beverly Hills, Santa Monica, the Valley, or the Palisades without fighting cross-city traffic. Same-day service is available in most of the LA metro.',
        ),
        array(
            'q' => 'Which LA areas and neighborhoods do you service?',
            'a' => 'We cover the full Los Angeles metro including ' . $city_data['suburbs'] . '. If your neighborhood isn\'t listed, call us — we serve areas beyond what\'s published.',
        ),
        array(
            'q' => 'How much does Monogram appliance repair cost in Los Angeles?',
            'a' => 'We provide a fixed quote — parts and labor together — before any work begins. LA Monogram repairs typically range from $150 to $600 depending on the appliance and the fault. What we quote is what you pay.',
        ),
        array(
            'q' => 'Do you service the custom and entertainment-focused Monogram kitchens common in LA?',
            'a' => 'Yes — high-spec Monogram suites in custom kitchens are exactly what we work on every day across Los Angeles. Our technicians are experienced with the full Monogram professional lineup, including integrated, panel-ready, and multi-appliance configurations.',
        ),
        array(
            'q' => 'Are your LA Monogram technicians locally based?',
            'a' => 'Yes. All our Los Angeles technicians live and work in the metro area. We position them across the city intentionally so that same-day service is a real option — not something that depends on whether traffic cooperates.',
        ),
    ),
    'new-york' => array(
        array(
            'q' => 'Do you offer same-day Monogram repair in New York?',
            'a' => 'Yes. We work across Manhattan, Brooklyn, Queens, the Bronx, and Staten Island with technicians based throughout the metro. Same-day and next-day service is available in most areas — call us and we\'ll confirm what we can do for your building and neighborhood.',
        ),
        array(
            'q' => 'Which New York neighborhoods and boroughs do you service?',
            'a' => 'We cover all five boroughs and extend into Westchester, Long Island, and parts of New Jersey including ' . $city_data['suburbs'] . '. Call us if your area isn\'t listed.',
        ),
        array(
            'q' => 'Can you work in New York high-rises and co-op buildings?',
            'a' => 'Yes — this is a significant part of what we do in New York. Our technicians understand building access protocols, doormen procedures, service elevator scheduling, and the window restrictions common in Manhattan co-ops and condos. We come fully equipped so we don\'t need a return trip for parts, which matters in buildings with tight service schedules.',
        ),
        array(
            'q' => 'How much does Monogram repair cost in New York?',
            'a' => 'We give a fixed quote — parts and labor — before starting any work. New York Monogram repairs typically run between $150 and $600. There are no open-ended labor charges or mid-job surprises.',
        ),
        array(
            'q' => 'Do you repair all Monogram appliance types in New York?',
            'a' => 'We repair the full Monogram lineup in New York — refrigerators, ranges, wall ovens, dishwashers, cooktops, speed ovens, wine coolers, and hoods. Both current and legacy models, in kitchens ranging from Manhattan high-rises to Brooklyn brownstones.',
        ),
    ),
);

$city_faqs = isset( $city_faq_map[ $city_slug ] ) ? $city_faq_map[ $city_slug ] : array(
    array(
        'q' => 'Do you offer same-day Monogram appliance repair in ' . $city_name_only . '?',
        'a' => 'Yes. We offer same-day and next-day Monogram appliance repair in ' . $city_name_only . ' and surrounding suburbs. Call us in the morning for the best chance at a same-day visit.',
    ),
    array(
        'q' => 'Which suburbs near ' . $city_name_only . ' do you service?',
        'a' => 'We service ' . $city_name_only . ' and the following suburbs: ' . $city_data['suburbs'] . '. If you don\'t see your area listed, call us — we often serve beyond what we publish.',
    ),
    array(
        'q' => 'How much does Monogram appliance repair cost in ' . $city_name_only . '?',
        'a' => 'We provide a fixed quote before any work begins — parts and labor together. Most repairs range from $150–$500. You approve the price before we start.',
    ),
    array(
        'q' => 'Are your technicians in ' . $city_name_only . ' locally based?',
        'a' => 'Yes. Our technicians live and work in the ' . $city_name_only . ' area. We don\'t dispatch from a distant hub — that\'s how same-day service stays a real option.',
    ),
    array(
        'q' => 'Do you repair all Monogram appliance models in ' . $city_name_only . '?',
        'a' => 'We repair all Monogram appliances — built-in refrigerators, pro ranges, wall ovens, dishwashers, cooktops, speed ovens, wine coolers, and hoods. Both current and legacy models.',
    ),
);
?>

<!-- CITY IMAGE BANNER -->
<?php if ( ! empty( $city_data['image'] ) ) : ?>
<div class="city-image-banner" style="position:relative;overflow:hidden;">
    <img src="<?php echo esc_url( $city_data['image'] ); ?>"
         alt="<?php echo esc_attr( $city_name_only ); ?> skyline — Monogram appliance repair service area"
         width="1400" height="400"
         loading="eager"
         style="width:100%;height:320px;object-fit:cover;display:block;">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom, rgba(0,0,0,0.35) 0%, rgba(0,0,0,0.55) 100%);display:flex;align-items:center;">
        <div class="container" style="position:relative;z-index:1;color:#fff;">
            <?php brp_breadcrumbs(); ?>
            <h1 style="color:#fff;margin-top:8px;">Monogram Appliance Repair in <?php echo esc_html( $city_name_only ); ?></h1>
            <p style="color:rgba(255,255,255,0.88);max-width:620px;"><?php echo esc_html( $city_hero_subtitle ); ?></p>
            <div style="display:flex;gap:16px;margin-top:24px;flex-wrap:wrap;">
                <a href="#schedule" class="btn btn-primary">📅 Schedule in <?php echo esc_html( $city_name_only ); ?></a>
                <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary" style="background:#fff;border-color:#fff;color:var(--color-primary);">📞 <?php echo BRP_PHONE; ?></a>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
<!-- PAGE HERO (fallback when no image) -->
<section class="page-hero page-hero--city">
    <div class="container">
        <?php brp_breadcrumbs(); ?>
        <h1>Monogram Appliance Repair in <?php echo esc_html( $city_name_only ); ?></h1>
        <p><?php echo esc_html( $city_hero_subtitle ); ?></p>
        <div style="display:flex;gap:16px;margin-top:24px;flex-wrap:wrap;">
            <a href="#schedule" class="btn btn-primary">📅 Schedule in <?php echo esc_html( $city_name_only ); ?></a>
            <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary" style="background:#fff;border-color:#fff;color:var(--color-primary);">📞 <?php echo BRP_PHONE; ?></a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CONTENT AREA -->
<div class="content-area">
    <div class="container">
        <div class="content-grid">

            <!-- Main content -->
            <div class="main-content">

                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:32px;">
                    <span class="badge badge-primary">✓ Serving <?php echo esc_html( $city_name_only ); ?></span>
                    <span class="badge badge-primary">✓ Same-Day Available</span>
                    <span class="badge badge-success">✓ 30-Day Warranty</span>
                </div>

                <div class="entry-content">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php if ( get_the_content() ) : the_content(); endif; ?>
                    <?php endwhile; endif; ?>

                    <!-- Default city content -->
                    <h2><?php echo BRP_BRAND; ?> Appliance Repair in <?php echo esc_html( $city_name_only ); ?>, <?php echo esc_html( $city_data['state'] ); ?></h2>
                    <?php
                    $city_intros = array(
                        'chicago'       => '<p>Chicago kitchens work hard, and when a Monogram appliance goes down — whether it\'s the middle of winter or the week before a big holiday — waiting three days for a service window isn\'t an option. Our Chicago technicians are locally based and stocked for the Monogram models common in Lincoln Park, Bucktown, Wicker Park, and across the North Shore. Same-day service is our standard here, not a premium.</p>',
                        'san-francisco' => '<p>The Bay Area has some of the highest concentrations of Monogram built-in appliances in the country — custom kitchens with column refrigerators, panel-ready dishwashers, and integrated ranges that require a technician who knows exactly what they\'re working with. Our San Francisco team is stationed locally to cut through Bay Area traffic, and every van is stocked for the configurations we see most in Pacific Heights, Marin, and the Peninsula.</p>',
                        'houston'       => '<p>Houston homes run big, and Monogram kitchens here often mean full appliance suites — a 48-inch range, a built-in column refrigerator, and an integrated dishwasher all under one roof. Our Houston technicians are spread across the metro and equipped for multi-appliance service calls, so you\'re not waiting for a second visit when two appliances go down at once. We cover Memorial, River Oaks, The Woodlands, and surrounding areas.</p>',
                        'miami'         => '<p>South Florida\'s humidity and salt air are harder on appliance components than most homeowners realize — corrosion on contacts, accelerated gasket wear, and moisture-related control board issues come up more often here than anywhere else we work. Our Miami technicians know what to look for in this climate and carry the parts that hold up in it. We serve Brickell, Coral Gables, Key Biscayne, and throughout Miami-Dade and Broward.</p>',
                        'los-angeles'   => '<p>LA kitchens are designed to impress, and a broken Monogram appliance in a Bel Air, Beverly Hills, or Pacific Palisades home tends to be urgent — entertaining doesn\'t wait. Our Los Angeles team is distributed across the metro specifically so we can get to you quickly despite the traffic, and our vans are loaded with the Monogram parts most common in the custom kitchens we service across the city.</p>',
                        'new-york'      => '<p>New York Monogram service comes with its own logistics — building access, freight elevators, doormen, and service windows that sometimes run 9 to 5 whether that works for you or not. Our New York technicians navigate all of it regularly. We work in Manhattan high-rises, Brooklyn brownstones, and Queens homes with the same fully stocked kit, because a return trip for a part is never acceptable when you\'re dealing with a building\'s service schedule.</p>',
                    );
                    echo isset( $city_intros[ $city_slug ] ) ? $city_intros[ $city_slug ] : '<p>When a ' . BRP_BRAND . ' appliance breaks down in your ' . esc_html( $city_name_only ) . ' home, you need a technician who actually specializes in these products — not a general repair service running through a generic checklist. Our ' . esc_html( $city_name_only ) . '-based team works exclusively on ' . BRP_BRAND . ' appliances, which means they\'ve already seen your failure mode before they arrive.</p>';
                    ?>

                    <?php
                    $city_first_visit_lines = array(
                        'chicago'       => 'We cover all of Chicago and the surrounding metro — our technicians are already stationed nearby, which means we can usually get to you the same day and wrap up the repair in a single visit.',
                        'san-francisco' => 'Bay Area traffic is unpredictable, so we keep our San Francisco techs stationed locally and loaded with the parts needed to finish most Monogram jobs without a return trip.',
                        'houston'       => 'Houston is a big city, so we position multiple technicians across the metro and stock each van accordingly — most Monogram repairs here are done start to finish in one appointment.',
                        'miami'         => 'Our Miami technicians stock their vans with the parts most commonly needed for Monogram appliances in South Florida, so the majority of repairs don\'t require a second trip to your home.',
                        'los-angeles'   => 'We know LA traffic can eat up your day, so our techs are spread across the metro and carry enough inventory to handle most Monogram repairs on the spot — no waiting around for a parts order.',
                        'new-york'      => 'Whether you\'re in Manhattan, Brooklyn, Queens, or anywhere else in the metro, our New York techs travel with a fully stocked kit so most Monogram repairs get resolved in a single visit.',
                    );
                    $first_visit_line = isset( $city_first_visit_lines[ $city_slug ] )
                        ? $city_first_visit_lines[ $city_slug ]
                        : 'We cover ' . esc_html( $city_name_only ) . ' and all surrounding suburbs — our vans are stocked with the most common Monogram parts so most repairs are finished in a single visit.';
                    ?>
                    <p>We provide expert <?php echo BRP_BRAND; ?> appliance repair throughout <?php echo esc_html( $city_name_only ); ?> and all surrounding suburbs. <?php echo esc_html( $first_visit_line ); ?></p>

                    <h3>Monogram Appliances We Repair in <?php echo esc_html( $city_name_only ); ?></h3>
                    <div class="grid grid-2" style="margin:24px 0;">
                        <?php foreach ( $services as $s ) : ?>
                        <a href="<?php echo home_url( '/services/' . $s['slug'] . '/' ); ?>" style="display:flex;align-items:center;gap:10px;padding:12px 16px;background:var(--color-light);border-radius:8px;color:var(--color-secondary);text-decoration:none;font-weight:600;font-size:0.9rem;transition:all 0.2s;" onmouseover="this.style.background='var(--color-primary)';this.style.color='white';" onmouseout="this.style.background='var(--color-light)';this.style.color='var(--color-secondary)';">
                            <span><?php echo $s['icon']; ?></span>
                            <?php echo esc_html( $s['title'] ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>

                    <h3>Service Area: <?php echo esc_html( $city_name_only ); ?> & Suburbs</h3>
                    <?php
                    $city_area_lines = array(
                        'chicago'       => '<p>We cover all of Chicago and the surrounding metro — from Evanston and Oak Park to Naperville and the North Shore. Our technicians live in the area, which is why we can get to you the same day without making you wait for someone driving in from outside the city.</p>',
                        'san-francisco' => '<p>We cover San Francisco proper and the full Bay Area metro — Marin, the Peninsula, East Bay, and South Bay. Every technician is stationed locally so Bay Area traffic doesn\'t become your problem when your refrigerator stops cooling.</p>',
                        'houston'       => '<p>Houston is a large city and we staff for it — multiple technicians spread across the metro cover Memorial, River Oaks, Sugar Land, The Woodlands, Katy, and everything in between. Most calls get same-day arrival without a cross-city wait.</p>',
                        'miami'         => '<p>We cover Miami-Dade and Broward counties — Brickell, Coral Gables, Key Biscayne, Fort Lauderdale, and surrounding neighborhoods. Our South Florida team stocks for the salt-air and humidity-related failures that come up here more often than anywhere else we work.</p>',
                        'los-angeles'   => '<p>We cover the full LA metro — Bel Air, Beverly Hills, Pacific Palisades, Santa Monica, the Valley, and beyond. Our technicians are positioned across the city so we\'re not fighting rush-hour traffic to get to your side of town.</p>',
                        'new-york'      => '<p>We cover Manhattan, Brooklyn, Queens, the Bronx, and Staten Island — plus Westchester, Long Island, and parts of New Jersey. Our New York technicians are familiar with building access protocols, doormen, and service elevator windows that make urban appliance repair its own challenge.</p>',
                    );
                    echo isset( $city_area_lines[ $city_slug ] ) ? $city_area_lines[ $city_slug ] : '<p>We cover ' . esc_html( $city_name_only ) . ' and all surrounding suburbs. Our technicians are locally based — they live and work in the area — so most calls result in same-day arrival without a long wait for someone dispatching from outside the metro.</p>';
                    ?>

                    <h4>Zip Codes We Serve</h4>
                    <p style="color:var(--color-gray);"><?php echo esc_html( $city_data['zip_codes'] ); ?> and surrounding areas.</p>

                    <h4>Suburbs We Cover</h4>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin:12px 0 24px;">
                        <?php foreach ( $suburbs_arr as $suburb ) : ?>
                        <span style="background:var(--color-light);border-radius:100px;padding:4px 12px;font-size:0.85rem;color:var(--color-secondary);"><?php echo esc_html( trim( $suburb ) ); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="notice notice-success">
                        <strong>📍 Serving <?php echo esc_html( $city_name_only ); ?>:</strong> Don't see your exact neighborhood or zip code? Call us at <?php echo BRP_PHONE; ?> and we'll confirm whether we can service your area.
                    </div>

                    <h3>Why <?php echo esc_html( $city_name_only ); ?> Homeowners Choose Us</h3>
                    <?php
                    $city_why_us = array(
                        'chicago' => '<ul class="checklist">
                            <li>Locally based Chicago technicians — no dispatching from a regional hub hours away</li>
                            <li>Same-day service available across the city and North Shore suburbs</li>
                            <li>Factory-certified Monogram parts stocked for Chicago\'s most common models</li>
                            <li>Winter-priority scheduling — we know a broken appliance in a Chicago January is urgent</li>
                            <li>30-day labor warranty on every repair</li>
                            <li>Fixed upfront pricing — no surprises on the invoice</li>
                            <li>Background-checked, uniformed professionals</li>
                        </ul>',
                        'san-francisco' => '<ul class="checklist">
                            <li>Bay Area techs stationed locally — not driving in from across the Bay</li>
                            <li>Experience with the panel-ready and integrated configurations common in SF custom kitchens</li>
                            <li>Factory-certified Monogram parts stocked for the models most popular on the Peninsula</li>
                            <li>Same-day and next-day appointments available despite Bay Area traffic</li>
                            <li>30-day labor warranty on all repairs</li>
                            <li>Transparent, fixed pricing before any work begins</li>
                            <li>Background-checked, uniformed technicians</li>
                        </ul>',
                        'houston' => '<ul class="checklist">
                            <li>Multiple Houston technicians spread across the metro — faster arrival times citywide</li>
                            <li>Equipped for multi-appliance calls common in Houston\'s larger Monogram kitchen suites</li>
                            <li>Factory-certified parts stocked for the full Monogram range lineup</li>
                            <li>Same-day service available across Memorial, River Oaks, The Woodlands, and surrounding areas</li>
                            <li>30-day labor warranty on every repair</li>
                            <li>Upfront, fixed quotes — no surprises on the invoice</li>
                            <li>Background-checked, uniformed professionals</li>
                        </ul>',
                        'miami' => '<ul class="checklist">
                            <li>Miami techs familiar with the humidity and salt-air related failures common in South Florida</li>
                            <li>Condo-building experience — we work in high-rises with service windows and freight elevators regularly</li>
                            <li>Factory-certified Monogram parts stocked for coastal climate conditions</li>
                            <li>Same-day and next-day service across Miami-Dade and Broward</li>
                            <li>30-day labor warranty on all repairs</li>
                            <li>Fixed pricing before any work starts — no open-ended labor charges</li>
                            <li>Background-checked, uniformed professionals</li>
                        </ul>',
                        'los-angeles' => '<ul class="checklist">
                            <li>Technicians distributed across LA — we get to Bel Air, Beverly Hills, and the Palisades without the cross-city wait</li>
                            <li>Experience with the custom, entertainment-focused Monogram kitchens common across Los Angeles</li>
                            <li>Factory-certified parts stocked for high-end Monogram suite configurations</li>
                            <li>Same-day service available across the metro</li>
                            <li>30-day labor warranty on every repair</li>
                            <li>Upfront, fixed pricing — the quote we give is what you pay</li>
                            <li>Background-checked, uniformed technicians</li>
                        </ul>',
                        'new-york' => '<ul class="checklist">
                            <li>New York technicians familiar with building access protocols, doormen, and service elevator windows</li>
                            <li>Experience in Manhattan high-rises, Brooklyn brownstones, and Queens homes</li>
                            <li>Fully stocked service kits — we avoid return trips because we know how building scheduling works</li>
                            <li>Factory-certified Monogram parts for all models common in New York premium kitchens</li>
                            <li>30-day labor warranty on all repairs</li>
                            <li>Fixed upfront pricing — no surprises</li>
                            <li>Background-checked, uniformed professionals</li>
                        </ul>',
                    );
                    echo isset( $city_why_us[ $city_slug ] ) ? $city_why_us[ $city_slug ] : '<ul class="checklist">
                        <li>Local ' . esc_html( $city_name_only ) . ' technicians — fast, direct arrival times</li>
                        <li>Factory-certified ' . BRP_BRAND . ' parts for all models</li>
                        <li>Upfront, fixed pricing — no surprises on your invoice</li>
                        <li>Same-day and next-day appointments available</li>
                        <li>30-day labor warranty on all repairs</li>
                        <li>Background-checked, uniformed professionals</li>
                        <li>Evening and weekend availability</li>
                    </ul>';
                    ?>
                </div>

                <!-- Other cities -->
                <div style="background:var(--color-light);border-radius:var(--border-radius-lg);padding:32px;margin-top:48px;">
                    <h3 style="margin-bottom:16px;">🗺️ Other Cities We Service</h3>
                    <div style="display:flex;flex-wrap:wrap;gap:10px;">
                        <?php foreach ( $all_cities as $c ) :
                            if ( $c['slug'] === $city_slug ) continue; ?>
                        <a href="<?php echo home_url( '/cities/' . $c['slug'] . '/' ); ?>" class="btn btn-secondary btn-sm">
                            <?php echo esc_html( $c['title'] ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div><!-- /.main-content -->

            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">📞 <?php echo esc_html( $city_name_only ); ?> Service</div>
                    <div class="sidebar-phone">
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="sidebar-phone-number"><?php echo BRP_PHONE; ?></a>
                        <p>Mon–Sat 7am–8pm<br>Sun 9am–5pm</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call Now</a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Online</a>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">📍 Zip Codes We Cover</div>
                    <div class="sidebar-widget-body">
                        <p style="font-size:0.85rem;color:var(--color-gray);line-height:1.6;"><?php echo esc_html( $city_data['zip_codes'] ); ?></p>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">✅ Our Guarantees</div>
                    <div class="sidebar-widget-body">
                        <ul class="checklist" style="gap:8px;">
                            <li>Same-day availability</li>
                            <li>Factory-certified parts</li>
                            <li>30-day labor warranty</li>
                            <li>Upfront fixed pricing</li>
                            <li>On-time arrival</li>
                        </ul>
                    </div>
                </div>
            </aside>

        </div><!-- /.content-grid -->
    </div>
</div>

<!-- FAQ SECTION -->
<?php echo brp_faq_section( $city_faqs, 'Monogram Appliance Repair FAQ – ' . $city_name_only ); ?>

<!-- APPOINTMENT FORM -->
<?php echo brp_appointment_form( 'Schedule Monogram Repair in ' . $city_name_only ); ?>

<?php get_footer(); ?>
