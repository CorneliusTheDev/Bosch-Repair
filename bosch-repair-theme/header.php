<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content">Skip to main content</a>

<!-- ===== SITE HEADER ===== -->
<header class="site-header" role="banner">
    <div class="container">
        <div class="header-inner">

            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home" aria-label="<?php bloginfo( 'name' ); ?> - Home">
                <?php
                if ( has_custom_logo() ) :
                    the_custom_logo();
                else : ?>
                <div class="site-logo-text">
                    <span class="site-logo-name"><span>Bosch</span> Repair Pro</span>
                    <span class="site-logo-tagline">Certified Appliance Repair</span>
                </div>
                <?php endif; ?>
            </a>

            <!-- Primary Navigation -->
            <nav class="main-nav" id="main-nav" aria-label="Primary Navigation">
                <?php brp_fallback_nav(); ?>
            </nav>

            <!-- Header CTA -->
            <div class="header-cta">
                <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="header-phone" aria-label="Call us at <?php echo BRP_PHONE; ?>">
                    <span class="header-phone-icon" aria-hidden="true">📞</span>
                    <span class="header-phone-text"><?php echo BRP_PHONE; ?></span>
                </a>
                <a href="#schedule" class="btn btn-primary btn-sm">Book Now</a>
            </div>

            <!-- Mobile toggle -->
            <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="main-nav" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</header>
<!-- ===== /SITE HEADER ===== -->

<main id="main-content" tabindex="-1">

<?php
// Fallback nav when no menu is assigned
function brp_fallback_nav() {
    echo '<ul>';
    echo '<li><a href="' . home_url() . '">Home</a></li>';
    echo '<li><a href="' . home_url( '/about-us/' ) . '">About Us</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'service' ) . '">Services</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'city' ) . '">Cities</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'error_code' ) . '">Error Codes</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'guide' ) . '">Guides</a></li>';
    echo '<li><a href="' . home_url( '/blog/' ) . '">Blog</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'recall' ) . '">Recalls</a></li>';
    echo '</ul>';
}
