</main><!-- /#main-content -->

<!-- ===== FLOATING PHONE BUTTON ===== -->
<div class="floating-phone" role="complementary" aria-label="Quick contact">
    <span class="floating-phone-label">Call Now — <?php echo BRP_PHONE; ?></span>
    <a href="tel:<?php echo BRP_PHONE_RAW; ?>"
       class="floating-phone-btn"
       aria-label="Call <?php echo BRP_PHONE; ?> to schedule appliance repair">
        📞
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
                        <span class="site-logo-name" style="font-size:1.4rem;"><span style="color:var(--color-primary)">Bosch</span> Repair Pro</span>
                        <span class="site-logo-tagline">Certified Appliance Repair</span>
                    </div>
                </a>
                <p>Professional <?php echo BRP_BRAND; ?> appliance repair service with factory-certified parts, highly trained technicians, and a 90-day labor warranty. Serving Chicago, San Francisco, Houston, Miami, Los Angeles, and New York.</p>
                <div class="footer-contact-item">
                    <span>📞</span>
                    <div>
                        <strong><a href="tel:<?php echo BRP_PHONE_RAW; ?>" style="color:white;"><?php echo BRP_PHONE; ?></a></strong>
                        <span style="display:block;font-size:0.8rem;color:rgba(255,255,255,0.5)">Mon–Sat 7am–8pm, Sun 9am–5pm</span>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <span>✉️</span>
                    <a href="mailto:<?php echo BRP_EMAIL; ?>" style="color:rgba(255,255,255,0.65);"><?php echo BRP_EMAIL; ?></a>
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

        </div><!-- /.footer-grid -->

        <!-- Disclaimer -->
        <div class="footer-disclaimer">
            <p><strong>Independent Service Disclaimer:</strong> This is an independent appliance repair service specializing in <?php echo BRP_BRAND; ?> products. Professional diagnosis by experienced, factory-trained technicians. Not affiliated with or endorsed by BSH Home Appliances Corporation or Robert Bosch GmbH. <?php echo BRP_BRAND; ?> and all related trademarks are the property of their respective owners and are used here for identification purposes only. Our services are not sponsored, authorized, or approved by <?php echo BRP_BRAND; ?>.</p>
        </div>

        <!-- Footer bottom bar -->
        <div class="footer-bottom">
            <p class="footer-bottom-copy">
                &copy; <?php echo date( 'Y' ); ?> Bosch Repair Pro. All rights reserved.
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
    foreach ( array_slice( $services, 0, 8 ) as $s ) {
        echo '<li><a href="' . home_url( '/services/' . $s['slug'] . '/' ) . '">' . esc_html( $s['title'] ) . '</a></li>';
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

function brp_footer_resources_fallback() {
    echo '<ul class="footer-links">';
    echo '<li><a href="' . home_url( '/about-us/' ) . '">About Us</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'error_code' ) . '">Error Codes</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'guide' ) . '">Repair Guides</a></li>';
    echo '<li><a href="' . home_url( '/blog/' ) . '">Blog</a></li>';
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
