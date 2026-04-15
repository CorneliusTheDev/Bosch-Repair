<?php
/**
 * 404 Template
 *
 * @package MonogramRepairPro
 */
get_header(); ?>

<section class="page-hero">
    <div class="container">
        <h1>Page Not Found</h1>
        <p>The page you're looking for doesn't exist. Try our services or call us directly for help.</p>
    </div>
</section>

<section class="section">
    <div class="container" style="text-align:center;max-width:700px;margin:0 auto;">
        <div style="font-size:6rem;margin-bottom:24px;">🔍</div>
        <h2>404 – Page Not Found</h2>
        <p style="color:var(--color-gray);margin-bottom:36px;">The page you're looking for may have been moved, renamed, or doesn't exist. Here are some helpful links:</p>

        <div class="grid grid-3" style="margin-bottom:40px;">
            <a href="<?php echo home_url('/'); ?>" class="card" style="text-decoration:none;color:inherit;padding:24px;text-align:center;">
                <div style="font-size:2rem;margin-bottom:8px;">🏠</div>
                <strong>Home</strong>
            </a>
            <a href="<?php echo get_post_type_archive_link('service'); ?>" class="card" style="text-decoration:none;color:inherit;padding:24px;text-align:center;">
                <div style="font-size:2rem;margin-bottom:8px;">🔧</div>
                <strong>Services</strong>
            </a>
            <a href="<?php echo get_post_type_archive_link('error_code'); ?>" class="card" style="text-decoration:none;color:inherit;padding:24px;text-align:center;">
                <div style="font-size:2rem;margin-bottom:8px;">⚠️</div>
                <strong>Error Codes</strong>
            </a>
        </div>

        <p style="margin-bottom:16px;color:var(--color-gray);">Or call us directly for fast appliance repair service:</p>
        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary btn-lg">📞 <?php echo BRP_PHONE; ?></a>
    </div>
</section>

<?php get_footer(); ?>
