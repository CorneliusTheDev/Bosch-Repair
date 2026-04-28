</main><!-- /#main-content -->

<!-- ===== FLOATING PHONE BUTTON ===== -->
<div class="floating-phone" role="complementary" aria-label="Quick contact">
    <span class="floating-phone-label">Call Now — <?php echo BRP_PHONE; ?></span>
    <a href="tel:<?php echo BRP_PHONE_RAW; ?>"
       class="floating-phone-btn"
       aria-label="Call <?php echo BRP_PHONE; ?> to schedule appliance repair">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.84a16 16 0 0 0 6.29 6.29l.95-.95a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
    </a>
</div>
<!-- ===== /FLOATING PHONE BUTTON ===== -->

<!-- ===== SITE FOOTER ===== -->
<footer class="site-footer" role="contentinfo">
    <div class="container">

        <div class="footer-grid">

            <!-- Brand column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                    <div class="site-logo-text">
                        <span class="site-logo-name" style="font-size:1.4rem;"><span style="color:var(--color-primary)">Monogram</span> Repair Pro</span>
                        <span class="site-logo-tagline">Certified Appliance Repair</span>
                    </div>
                </a>
                <p>Professional <?php echo BRP_BRAND; ?> appliance repair service with factory-certified parts, highly trained technicians, and a 30-day labor warranty. Serving Chicago, San Francisco, Houston, Miami, Los Angeles, and New York.</p>
                <div class="footer-contact-item">
                    <div>
                        <strong><a href="tel:<?php echo BRP_PHONE_RAW; ?>" style="color:white;font-size:1.1rem;letter-spacing:0.02em;"><?php echo BRP_PHONE; ?></a></strong>
                        <span style="display:block;font-size:0.85rem;color:rgba(255,255,255,0.9);font-weight:700;margin-top:4px;">Mon–Fri: 7am–8pm</span>
                        <span style="display:block;font-size:0.85rem;color:rgba(255,255,255,0.9);font-weight:700;">Sat–Sun: 9am–5pm</span>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <a href="mailto:<?php echo BRP_EMAIL; ?>" style="color:white;font-weight:700;font-size:0.95rem;"><?php echo BRP_EMAIL; ?></a>
                </div>
                <div style="display:flex;gap:16px;margin-top:16px;">
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:6px;color:white;font-weight:800;font-size:0.95rem;text-decoration:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        Facebook
                    </a>
                    <a href="https://www.tumblr.com" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:6px;color:white;font-weight:800;font-size:0.95rem;text-decoration:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14.563 24c-5.093 0-7.031-3.756-7.031-6.411V9.747H5.116V6.648c3.63-1.313 4.512-4.596 4.71-6.469C9.84.051 9.941 0 9.999 0h3.517v6.114h4.801v3.633h-4.82v7.47c.016 1.001.375 2.371 2.547 2.371h.028a4.9 4.9 0 0 0 2.245-.572v3.596a10.5 10.5 0 0 1-3.754.388z"/></svg>
                        Tumblr
                    </a>
                    <a href="https://www.quora.com" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:6px;color:white;font-weight:800;font-size:0.95rem;text-decoration:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12c2.4 0 4.635-.706 6.512-1.924l-1.98-2.233A8.47 8.47 0 0 1 12 20.5C7.306 20.5 3.5 16.694 3.5 12S7.306 3.5 12 3.5 20.5 7.306 20.5 12a8.47 8.47 0 0 1-1.35 4.618l1.98 2.23A11.94 11.94 0 0 0 24 12C24 5.373 18.627 0 12 0zm1.63 16.552-1.302-1.473c-.407.12-.84.171-1.328.171-2.742 0-4.7-2.01-4.7-4.75s1.958-4.75 4.7-4.75 4.7 2.01 4.7 4.75c0 1.568-.62 2.93-1.6 3.83l1.302 1.473-1.772.749z"/></svg>
                        Quora
                    </a>
                </div>
            </div>

            <!-- Services column -->
            <div class="footer-col">
                <h4>Services</h4>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-1',
                    'menu_class'     => 'footer-links',
                    'container'      => false,
                    'fallback_cb'    => 'brp_footer_services_fallback',
                ) );
                ?>
            </div>

            <!-- Cities column -->
            <div class="footer-col">
                <h4>Cities We Service</h4>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-2',
                    'menu_class'     => 'footer-links',
                    'container'      => false,
                    'fallback_cb'    => 'brp_footer_cities_fallback',
                ) );
                ?>
            </div>

            <!-- Resources column -->
            <div class="footer-col">
                <h4>Resources</h4>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-3',
                    'menu_class'     => 'footer-links',
                    'container'      => false,
                    'fallback_cb'    => 'brp_footer_resources_fallback',
                ) );
                ?>
            </div>

            <!-- Blog column -->
            <div class="footer-col">
                <h4>Blog</h4>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-4',
                    'menu_class'     => 'footer-links',
                    'container'      => false,
                    'fallback_cb'    => 'brp_footer_blog_fallback',
                ) );
                ?>
            </div>

        </div><!-- /.footer-grid -->

        <!-- Disclaimer -->
        <div class="footer-disclaimer">
            <p><strong>Independent Service Disclaimer:</strong> This is an independent appliance repair service specializing in <?php echo BRP_BRAND; ?> products. Professional diagnosis by experienced, factory-trained technicians. Not affiliated with or endorsed by GE Appliances, LLC. <?php echo BRP_BRAND; ?> and all related trademarks are the property of their respective owners and are used here for identification purposes only. Our services are not sponsored, authorized, or approved by <?php echo BRP_BRAND; ?>.</p>
        </div>

        <!-- Footer bottom bar -->
        <div class="footer-bottom">
            <p class="footer-bottom-copy">
                &copy; <?php echo date( 'Y' ); ?> Monogram Repair Pro. All rights reserved.
            </p>
            <div class="footer-bottom-links">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-legal',
                    'container'      => false,
                    'fallback_cb'    => 'brp_footer_legal_fallback',
                ) );
                ?>
            </div>
        </div>

    </div><!-- /.container -->
</footer>
<!-- ===== /SITE FOOTER ===== -->

<?php wp_footer(); ?>
</body>
</html>

<?php
// Fallback footer menus

function brp_footer_services_fallback() {
    $services = brp_get_services();
    echo '<ul class="footer-links">';
    foreach ( $services as $s ) {
        $label = preg_replace( '/^Monogram\s+/i', '', $s['title'] );
        echo '<li><a href="' . home_url( '/services/' . $s['slug'] . '/' ) . '">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}

function brp_footer_cities_fallback() {
    $cities = brp_get_cities();
    echo '<ul class="footer-links">';
    foreach ( $cities as $c ) {
        echo '<li><a href="' . home_url( '/cities/' . $c['slug'] . '/' ) . '">' . esc_html( $c['title'] ) . '</a></li>';
    }
    echo '</ul>';
}

function brp_footer_blog_fallback() {
    $appliances = array(
        'dishwasher'   => 'Monogram Dishwasher',
        'washer'       => 'Monogram Washer',
        'dryer'        => 'Monogram Dryer',
        'refrigerator' => 'Monogram Refrigerator',
        'oven'         => 'Monogram Oven & Range',
        'cooktop'      => 'Monogram Cooktop',
        'microwave'    => 'Monogram Microwave',
        'freezer'      => 'Monogram Freezer',
        'maintenance'  => 'Maintenance Tips',
    );
    echo '<ul class="footer-links">';
    foreach ( $appliances as $slug => $label ) {
        echo '<li><a href="' . home_url( '/topic/' . $slug . '/' ) . '">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}

function brp_footer_resources_fallback() {
    echo '<ul class="footer-links">';
    echo '<li><a href="' . home_url( '/about-us/' ) . '">About Us</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'error_code' ) . '">Error Codes</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'recall' ) . '">Recalls</a></li>';
    echo '<li><a href="#schedule">Book Appointment</a></li>';
    echo '<li><a href="tel:' . BRP_PHONE_RAW . '">' . BRP_PHONE . '</a></li>';
    echo '</ul>';
}

function brp_footer_legal_fallback() {
    echo '<a href="' . home_url( '/privacy-policy/' ) . '">Privacy Policy</a>';
    echo '<a href="' . home_url( '/terms-of-use/' ) . '">Terms of Use</a>';
    echo '<a href="' . home_url( '/mobile-terms-of-use/' ) . '">Mobile Terms</a>';
}
