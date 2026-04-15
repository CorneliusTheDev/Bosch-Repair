<?php
/**
 * Single post / CPT template — used for blog posts, guides, error codes, recalls.
 *
 * @package MonogramRepairPro
 */
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

$post_type = get_post_type();
$appliance = get_post_meta( get_the_ID(), '_brp_appliance_type', true );
$error_code_val = get_post_meta( get_the_ID(), '_brp_error_code', true );

?>

<section class="page-hero">
    <div class="container">
        <?php brp_breadcrumbs(); ?>

        <?php if ( $error_code_val ) : ?>
        <span class="error-code-badge" style="font-size:1rem;margin-bottom:16px;display:inline-block;"><?php echo esc_html( $error_code_val ); ?></span>
        <?php endif; ?>

        <h1><?php the_title(); ?></h1>

        <div style="display:flex;gap:16px;flex-wrap:wrap;margin-top:16px;color:rgba(255,255,255,0.7);font-size:0.875rem;">
            <span><?php echo get_the_date( 'F j, Y' ); ?></span>
            <?php if ( $appliance ) : ?>
            <span>• <?php echo esc_html( ucfirst( $appliance ) ); ?></span>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="content-area">
    <div class="container">
        <div class="content-grid">

            <!-- Main content -->
            <article class="main-content">

                <?php if ( has_post_thumbnail() ) : ?>
                <div class="appliance-image">
                    <?php the_post_thumbnail( 'brp-appliance', array( 'alt' => get_the_title() ) ); ?>
                </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <!-- Error code specific: repair CTA -->
                <?php if ( $post_type === 'error_code' ) : ?>
                <div class="notice notice-warning" style="margin-top:40px;">
                    <strong>Need Help?</strong> If the error code hasn't resolved after basic troubleshooting, call our certified Monogram technicians at <a href="tel:<?php echo BRP_PHONE_RAW; ?>"><?php echo BRP_PHONE; ?></a> for professional diagnosis and same-day repair.
                </div>
                <?php endif; ?>

                <!-- Author bio for blog posts -->
                <?php if ( $post_type === 'post' ) : ?>
                <div style="background:var(--color-light);border-radius:var(--border-radius);padding:24px;margin-top:48px;display:flex;gap:16px;align-items:flex-start;">
                    <div style="width:56px;height:56px;background:var(--color-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:0.75rem;font-weight:700;letter-spacing:0.05em;flex-shrink:0;">TECH</div>
                    <div>
                        <strong style="display:block;margin-bottom:4px;">Written by a Certified Monogram Technician</strong>
                        <p style="color:var(--color-gray);font-size:0.875rem;margin:0;">All articles on this blog are written or reviewed by our factory-trained Monogram appliance repair technicians with hands-on experience diagnosing and fixing these machines.</p>
                    </div>
                </div>
                <?php endif; ?>

            </article>

            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">Get Expert Help</div>
                    <div class="sidebar-phone">
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="sidebar-phone-number"><?php echo BRP_PHONE; ?></a>
                        <p>Mon–Sat 7am–8pm · Sun 9am–5pm</p>
                        <a href="tel:<?php echo BRP_PHONE_RAW; ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;">Call Now</a>
                        <a href="#schedule" class="btn btn-secondary" style="width:100%;justify-content:center;">Book Online</a>
                    </div>
                </div>

                <?php if ( $post_type === 'error_code' ) : ?>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">Related Repairs</div>
                    <div class="sidebar-widget-body">
                        <?php $related_services = brp_get_services(); ?>
                        <ul class="footer-links" style="gap:8px;">
                            <?php foreach ( $related_services as $s ) : ?>
                                <li><a href="<?php echo esc_url( home_url( '/services/' . $s['slug'] . '/' ) ); ?>" style="color:var(--color-text);"><?php echo esc_html( $s['title'] ); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <div class="sidebar-widget">
                    <div class="sidebar-widget-header">Why Choose Us</div>
                    <div class="sidebar-widget-body">
                        <ul class="checklist" style="gap:8px;">
                            <li>Factory-certified Monogram parts</li>
                            <li>Highly trained technicians</li>
                            <li>90-day labor warranty</li>
                            <li>Same-day service available</li>
                        </ul>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</div>

<!-- FAQ if error code -->
<?php if ( $post_type === 'error_code' && $appliance ) : ?>
<?php echo brp_faq_section( array_slice( brp_get_faqs_for_appliance( $appliance ), 0, 5 ), 'Related ' . ucfirst( $appliance ) . ' Repair FAQs' ); ?>
<?php endif; ?>

<?php endwhile; endif; ?>

<?php echo brp_appointment_form(); ?>
<?php get_footer(); ?>
