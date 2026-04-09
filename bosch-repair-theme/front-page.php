<?php
/**
 * Homepage Template
 *
 * @package BoschRepairPro
 */
get_header();

$services = brp_get_services();
$cities   = brp_get_cities();

$reviews = array(
    array( 'name' => 'Jennifer M.', 'city' => 'Chicago, IL', 'text' => 'My Bosch dishwasher stopped draining on a Sunday. The tech was here Monday morning with the exact part needed. Fixed in 90 minutes. Excellent service!', 'stars' => 5 ),
    array( 'name' => 'Robert K.', 'city' => 'Los Angeles, CA', 'text' => 'Very knowledgeable technician diagnosed my Bosch fridge compressor issue quickly. Used genuine Bosch parts and the fridge has been running perfectly ever since.', 'stars' => 5 ),
    array( 'name' => 'Sarah T.', 'city' => 'New York, NY', 'text' => 'Bosch washer was leaking water all over the floor. Called at 8am, had someone here by noon. Replaced the door seal and tested it thoroughly. Great job!', 'stars' => 5 ),
    array( 'name' => 'Marcus L.', 'city' => 'Houston, TX', 'text' => 'Professional and punctual. My Bosch oven heating element died right before Thanksgiving. They squeezed me in and had it repaired the same day. Lifesavers!', 'stars' => 5 ),
    array( 'name' => 'Angela P.', 'city' => 'Miami, FL', 'text' => 'Bosch speed oven repair was done perfectly. The tech explained everything, showed me the old part vs new, and even gave tips on preventing future issues.', 'stars' => 5 ),
    array( 'name' => 'David W.', 'city' => 'San Francisco, CA', 'text' => 'Used them twice now for Bosch appliances. Both times: punctual, professional, used real Bosch parts. 90-day warranty gives me peace of mind.', 'stars' => 5 ),
);
?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <span>⭐</span> #1 Rated Bosch Appliance Repair
            </div>
            <h1>Expert <span>Bosch Appliance</span> Repair You Can Trust</h1>
            <p class="hero-subtitle">
                Same-day service across 6 major cities. Factory-certified parts, highly trained technicians, and a 90-day labor warranty on every repair.
            </p>
            <div class="hero-cta">
                <a href="#schedule" class="btn btn-primary btn-lg">📅 Schedule Repair</a>
                <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary btn-lg" style="background:#fff;border-color:#fff;color:#e30000;">📞 <?php echo BRP_PHONE; ?></a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-number">15<span>k+</span></div>
                    <div class="hero-stat-label">Repairs Completed</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-number">6</div>
                    <div class="hero-stat-label">Major Cities</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-number">90<span>-day</span></div>
                    <div class="hero-stat-label">Labor Warranty</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-number">4.9<span>★</span></div>
                    <div class="hero-stat-label">Avg. Rating</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRUST BAR -->
<div class="trust-bar">
    <div class="container">
        <div class="trust-bar-inner">
            <div class="trust-item"><span class="trust-item-icon">✅</span> Factory-Certified Parts</div>
            <div class="trust-item"><span class="trust-item-icon">🏆</span> Highly Trained Technicians</div>
            <div class="trust-item"><span class="trust-item-icon">🛡️</span> 90-Day Labor Warranty</div>
            <div class="trust-item"><span class="trust-item-icon">⚡</span> Same-Day Service Available</div>
            <div class="trust-item"><span class="trust-item-icon">💰</span> Upfront, Transparent Pricing</div>
        </div>
    </div>
</div>

<!-- SERVICES SECTION -->
<section class="section" id="services">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-label">What We Fix</span>
            <h2 class="section-title">Bosch Appliance Repair Services</h2>
            <p class="section-subtitle">We service all Bosch appliance models — from the newest connected appliances to older units. Genuine parts, expert hands.</p>
        </div>
        <div class="grid grid-4">
            <?php foreach ( $services as $service ) : ?>
            <div class="service-card">
                <div class="service-card-icon"><?php echo $service['icon']; ?></div>
                <div>
                    <h3><?php echo esc_html( $service['title'] ); ?></h3>
                    <p><?php echo esc_html( $service['desc'] ); ?></p>
                </div>
                <a href="<?php echo home_url( '/services/' . $service['slug'] . '/' ); ?>" class="service-card-link">
                    Learn More →
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- WHY US SECTION -->
<section class="section bg-light">
    <div class="container">
        <div class="grid grid-2" style="gap:64px;align-items:center;">
            <div>
                <span class="section-label">Why Choose Us</span>
                <h2 class="section-title" style="margin-bottom:32px;">The Bosch Specialist You Can Rely On</h2>
                <div style="display:flex;flex-direction:column;gap:28px;">
                    <div class="feature-item">
                        <div class="feature-icon">🔧</div>
                        <div class="feature-content">
                            <h4>Factory-Certified Parts Only</h4>
                            <p>We never use counterfeit or aftermarket parts. Every repair uses genuine Bosch-certified components to preserve your appliance's performance and longevity.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🎓</div>
                        <div class="feature-content">
                            <h4>Highly Trained Technicians</h4>
                            <p>Our technicians undergo continuous training on new Bosch models and technologies, ensuring an accurate diagnosis and lasting repair every time.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🛡️</div>
                        <div class="feature-content">
                            <h4>90-Day Labor Warranty</h4>
                            <p>Every repair is backed by our 90-day labor warranty. If the same issue returns within 90 days, we come back and fix it — free of charge.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">⚡</div>
                        <div class="feature-content">
                            <h4>Same-Day & Next-Day Service</h4>
                            <p>Broken appliances disrupt your life. That's why we offer same-day and next-day appointments in all our service areas, including weekends.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div style="background:var(--color-secondary);border-radius:var(--border-radius-lg);padding:40px;color:white;">
                    <h3 style="color:white;margin-bottom:24px;">Ready to Schedule?</h3>
                    <p style="color:rgba(255,255,255,0.8);margin-bottom:32px;">Our certified Bosch technicians are standing by. Most repairs are completed in a single visit.</p>
                    <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary btn-lg" style="width:100%;justify-content:center;margin-bottom:16px;">
                        📞 <?php echo BRP_PHONE; ?>
                    </a>
                    <a href="#schedule" class="btn btn-secondary btn-lg" style="width:100%;justify-content:center;">
                        📅 Book Online
                    </a>
                    <div style="margin-top:24px;padding-top:24px;border-top:1px solid rgba(255,255,255,0.1);">
                        <p style="font-size:0.85rem;color:rgba(255,255,255,0.6);margin:0;">⏰ Available Mon–Sat 7am–8pm<br>Sun 9am–5pm · Emergency service available</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CITIES SECTION -->
<section class="section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-label">Service Areas</span>
            <h2 class="section-title">Cities We Service</h2>
            <p class="section-subtitle">We provide expert Bosch appliance repair across 6 major U.S. metropolitan areas and their surrounding suburbs.</p>
        </div>
        <div class="grid grid-3">
            <?php foreach ( $cities as $city ) : ?>
            <a href="<?php echo home_url( '/cities/' . $city['slug'] . '/' ); ?>" class="city-card">
                <div class="city-card-body">
                    <div style="font-size:2rem;margin-bottom:12px;">🏙️</div>
                    <h3><?php echo esc_html( $city['title'] ); ?></h3>
                    <div class="city-card-meta">
                        <span>📍 <?php echo esc_html( $city['state'] ); ?></span>
                        <span>•</span>
                        <span>Suburbs covered</span>
                    </div>
                    <p style="font-size:0.85rem;color:var(--color-gray);margin-top:8px;margin-bottom:0;">
                        <?php echo esc_html( implode( ', ', array_slice( explode( ', ', $city['suburbs'] ), 0, 4 ) ) ); ?> & more
                    </p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <div class="text-center" style="margin-top:40px;">
            <a href="<?php echo get_post_type_archive_link( 'city' ); ?>" class="btn btn-secondary">View All Service Areas →</a>
        </div>
    </div>
</section>

<!-- REVIEWS SECTION -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-label">Customer Reviews</span>
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Over 15,000 satisfied customers across the U.S. trust us with their Bosch appliances.</p>
        </div>
        <div class="grid grid-3">
            <?php foreach ( $reviews as $review ) : ?>
            <div class="review-card">
                <div class="review-stars"><?php echo str_repeat( '★', $review['stars'] ); ?></div>
                <p class="review-text">"<?php echo esc_html( $review['text'] ); ?>"</p>
                <div class="review-author">
                    <div class="review-avatar"><?php echo strtoupper( substr( $review['name'], 0, 1 ) ); ?></div>
                    <div class="review-author-info">
                        <strong><?php echo esc_html( $review['name'] ); ?></strong>
                        <span><?php echo esc_html( $review['city'] ); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ERROR CODES & GUIDES QUICK LINKS -->
<section class="section">
    <div class="container">
        <div class="grid grid-2" style="gap:40px;">
            <div class="card" style="border-top:4px solid var(--color-primary);">
                <div class="card-body">
                    <div style="font-size:2.5rem;margin-bottom:16px;">⚠️</div>
                    <h3>Bosch Error Code Lookup</h3>
                    <p style="color:var(--color-gray);">See an error code on your Bosch appliance? Look it up in our comprehensive database to understand what's wrong and whether it needs professional service.</p>
                    <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>" class="btn btn-primary mt-3">Browse Error Codes →</a>
                </div>
            </div>
            <div class="card" style="border-top:4px solid var(--color-secondary);">
                <div class="card-body">
                    <div style="font-size:2.5rem;margin-bottom:16px;">📖</div>
                    <h3>Bosch Appliance Repair Guides</h3>
                    <p style="color:var(--color-gray);">Step-by-step troubleshooting and maintenance guides for all Bosch appliances. Written by our certified technicians to help you understand your appliance better.</p>
                    <a href="<?php echo get_post_type_archive_link( 'guide' ); ?>" class="btn btn-dark mt-3">Read Guides →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- APPOINTMENT FORM -->
<?php echo brp_appointment_form( 'Schedule Your Bosch Appliance Repair Today' ); ?>

<?php get_footer(); ?>
