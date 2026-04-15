<?php
/**
 * Homepage Template
 *
 * @package MonogramRepairPro
 */
get_header();

$services = brp_get_services();
$cities   = brp_get_cities();

?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-layout">

            <!-- LEFT: text + CTA -->
            <div class="hero-content">
                <div class="hero-badge">
                    #1 Rated Monogram Appliance Repair
                </div>
                <h1>Expert <span>Monogram Appliance</span> Repair You Can Trust</h1>
                <p class="hero-subtitle">
                    Same-day service across 6 major cities. Factory-certified parts, highly trained technicians, and a 90-day labor warranty on every repair.
                </p>
                <div class="hero-cta">
                    <a href="#schedule" class="btn btn-primary btn-lg">Schedule Repair</a>
                    <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-secondary btn-lg" style="background:#fff;border-color:#fff;color:var(--color-primary);"><?php echo BRP_PHONE; ?></a>
                </div>
            </div>

            <!-- RIGHT: stats 2x2 grid -->
            <div class="hero-image-col" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;width:100%;max-width:480px;margin-left:120px;">

                <div style="background:linear-gradient(135deg,rgba(255,255,255,0.10) 0%,rgba(255,255,255,0.04) 100%);border:1px solid rgba(255,255,255,0.15);border-top:2px solid var(--color-primary);border-radius:16px;padding:32px 20px 28px;text-align:center;backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);box-shadow:0 8px 32px rgba(0,0,0,0.2);">
                    <div style="font-size:3.2rem;font-weight:800;color:#fff;line-height:1;margin-bottom:8px;letter-spacing:-0.03em;">15k+</div>
                    <div style="font-size:0.7rem;font-weight:700;color:rgba(255,255,255,0.55);text-transform:uppercase;letter-spacing:0.1em;">Repairs Completed</div>
                </div>

                <div style="background:linear-gradient(135deg,rgba(255,255,255,0.10) 0%,rgba(255,255,255,0.04) 100%);border:1px solid rgba(255,255,255,0.15);border-top:2px solid var(--color-primary);border-radius:16px;padding:32px 20px 28px;text-align:center;backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);box-shadow:0 8px 32px rgba(0,0,0,0.2);">
                    <div style="font-size:3.2rem;font-weight:800;color:#fff;line-height:1;margin-bottom:8px;letter-spacing:-0.03em;">6</div>
                    <div style="font-size:0.7rem;font-weight:700;color:rgba(255,255,255,0.55);text-transform:uppercase;letter-spacing:0.1em;">Major Cities</div>
                </div>

                <div style="background:linear-gradient(135deg,rgba(255,255,255,0.10) 0%,rgba(255,255,255,0.04) 100%);border:1px solid rgba(255,255,255,0.15);border-top:2px solid var(--color-primary);border-radius:16px;padding:32px 20px 28px;text-align:center;backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);box-shadow:0 8px 32px rgba(0,0,0,0.2);">
                    <div style="font-size:3.2rem;font-weight:800;color:#fff;line-height:1;margin-bottom:8px;letter-spacing:-0.03em;">90<span style="font-size:1.4rem;color:var(--color-primary);font-weight:700;margin-left:3px;">-Day</span></div>
                    <div style="font-size:0.7rem;font-weight:700;color:rgba(255,255,255,0.55);text-transform:uppercase;letter-spacing:0.1em;">Labor Warranty</div>
                </div>

                <div style="background:linear-gradient(135deg,rgba(255,255,255,0.10) 0%,rgba(255,255,255,0.04) 100%);border:1px solid rgba(255,255,255,0.15);border-top:2px solid var(--color-primary);border-radius:16px;padding:32px 20px 28px;text-align:center;backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);box-shadow:0 8px 32px rgba(0,0,0,0.2);">
                    <div style="font-size:3.2rem;font-weight:800;color:#fff;line-height:1;margin-bottom:8px;letter-spacing:-0.03em;">4.9<span style="font-size:1.4rem;color:var(--color-primary);font-weight:700;margin-left:3px;">★</span></div>
                    <div style="font-size:0.7rem;font-weight:700;color:rgba(255,255,255,0.55);text-transform:uppercase;letter-spacing:0.1em;">Avg. Rating</div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- TRUST BAR -->
<div class="trust-bar">
    <div class="container">
        <div class="trust-bar-inner">
            <div class="trust-item">Factory-Certified Parts</div>
            <div class="trust-item">Highly Trained Technicians</div>
            <div class="trust-item">90-Day Labor Warranty</div>
            <div class="trust-item">Same-Day Service Available</div>
            <div class="trust-item">Upfront, Transparent Pricing</div>
        </div>
    </div>
</div>

<!-- SERVICES SECTION -->
<section class="section" id="services">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-label">What We Fix</span>
            <h2 class="section-title">Monogram Appliance Repair Services</h2>
            <p class="section-subtitle">We service all Monogram appliance models — from the newest connected appliances to older units. Genuine parts, expert hands.</p>
        </div>
        <div class="grid grid-4">
            <?php foreach ( $services as $service ) : ?>
            <a href="<?php echo esc_url( home_url( '/services/' . $service['slug'] . '/' ) ); ?>" class="service-card">
                <div class="service-card-img-wrap">
                    <?php if ( ! empty( $service['image'] ) ) : ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/services/' . $service['image'] ); ?>"
                         alt="<?php echo esc_attr( $service['title'] ); ?>" loading="lazy"
                         <?php if ( $service['image'] === 'washer.png' ) echo 'class="img-zoom-washer"'; ?>>
                    <?php else : ?>
                    <span class="service-card-icon"><?php echo $service['icon']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="service-card-body">
                    <h3><?php echo esc_html( $service['title'] ); ?></h3>
                    <p><?php echo esc_html( $service['desc'] ); ?></p>
                    <span class="service-card-link">Learn More →</span>
                </div>
            </a>
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
                <h2 class="section-title" style="margin-bottom:32px;">The Monogram Specialist You Can Rely On</h2>
                <div style="display:flex;flex-direction:column;gap:28px;">
                    <div class="feature-item">
                        <div class="feature-icon" style="font-size:1rem;font-weight:800;font-family:monospace;">01</div>
                        <div class="feature-content">
                            <h4>Factory-Certified Parts Only</h4>
                            <p>We never use counterfeit or aftermarket parts. Every repair uses genuine Monogram-certified components to preserve your appliance's performance and longevity.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon" style="font-size:1rem;font-weight:800;font-family:monospace;">02</div>
                        <div class="feature-content">
                            <h4>Highly Trained Technicians</h4>
                            <p>Our technicians undergo continuous training on new Monogram models and technologies, ensuring an accurate diagnosis and lasting repair every time.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon" style="font-size:1rem;font-weight:800;font-family:monospace;">03</div>
                        <div class="feature-content">
                            <h4>90-Day Labor Warranty</h4>
                            <p>Every repair is backed by our 90-day labor warranty. If the same issue returns within 90 days, we come back and fix it — free of charge.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon" style="font-size:1rem;font-weight:800;font-family:monospace;">04</div>
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
                    <p style="color:rgba(255,255,255,0.8);margin-bottom:32px;">Our certified Monogram technicians are standing by. Most repairs are completed in a single visit.</p>
                    <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary btn-lg" style="width:100%;justify-content:center;margin-bottom:16px;">
                        <?php echo BRP_PHONE; ?>
                    </a>
                    <a href="#schedule" class="btn btn-secondary btn-lg" style="width:100%;justify-content:center;">
                        Book Online
                    </a>
                    <div style="margin-top:24px;padding-top:24px;border-top:1px solid rgba(255,255,255,0.1);">
                        <p style="font-size:0.85rem;color:rgba(255,255,255,0.6);margin:0;">Available Mon–Sat 7am–8pm<br>Sun 9am–5pm · Emergency service available</p>
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
            <p class="section-subtitle">We provide expert Monogram appliance repair across 6 major U.S. metropolitan areas and their surrounding suburbs.</p>
        </div>
        <div class="grid grid-3">
            <?php foreach ( $cities as $city ) : ?>
            <a href="<?php echo home_url( '/cities/' . $city['slug'] . '/' ); ?>" class="city-card city-card--has-image">
                <?php if ( ! empty( $city['image'] ) ) : ?>
                <div class="city-card-image">
                    <img src="<?php echo esc_url( $city['image'] ); ?>"
                         alt="<?php echo esc_attr( $city['title'] ); ?> skyline"
                         width="600" height="267" loading="lazy">
                    <div class="city-card-image-overlay"></div>
                </div>
                <?php endif; ?>
                <div class="city-card-body">
                    <h3><?php echo esc_html( $city['title'] ); ?></h3>
                    <div class="city-card-meta">
                        <span><?php echo esc_html( $city['state'] ); ?></span>
                        <span>•</span>
                        <span>Suburbs covered</span>
                    </div>
                    <p style="font-size:0.85rem;color:var(--color-gray);margin-top:8px;margin-bottom:0;">
                        <?php echo esc_html( implode( ', ', array_slice( explode( ', ', $city['suburbs'] ), 0, 4 ) ) ); ?> & more
                    </p>
                    <span class="city-card-cta">View Service Area →</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <div class="text-center" style="margin-top:40px;">
            <a href="<?php echo get_post_type_archive_link( 'city' ); ?>" class="btn btn-secondary">View All Service Areas →</a>
        </div>
    </div>
</section>


<!-- ERROR CODES QUICK LINK -->
<section class="section">
    <div class="container">
        <div class="card" style="border-top:4px solid var(--color-primary);max-width:720px;margin:0 auto;">
            <div class="card-body">
                <h3>Monogram Error Code Lookup</h3>
                <p style="color:var(--color-gray);">See an error code on your Monogram appliance? Look it up in our comprehensive database to understand what's wrong and whether it needs professional service.</p>
                <a href="<?php echo get_post_type_archive_link( 'error_code' ); ?>" class="btn btn-primary mt-3">Browse Error Codes →</a>
            </div>
        </div>
    </div>
</section>

<!-- APPOINTMENT FORM -->
<?php echo brp_appointment_form( 'Schedule Your Monogram Appliance Repair Today' ); ?>

<?php get_footer(); ?>
