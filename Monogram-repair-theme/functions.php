<?php
/**
 * Monogram Repair Pro - Theme Functions
 *
 * @package MonogramRepairPro
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Fix policy pages: replace old domain with maytagappliancesolutions.com
add_action( 'wp_loaded', function() {
    if ( get_transient( 'brp_domain_fix_done' ) ) return;
    $slugs = array( 'privacy-policy', 'terms-of-use', 'mobile-terms-of-use' );
    foreach ( $slugs as $slug ) {
        $page = get_page_by_path( $slug );
        if ( ! $page ) continue;
        $content = $page->post_content;
        $updated = preg_replace(
            '#https?://[a-z0-9\-]+\.hostingersite\.com#i',
            'https://maytagappliancesolutions.com',
            $content
        );
        if ( $updated !== $content ) {
            wp_update_post( array( 'ID' => $page->ID, 'post_content' => $updated ) );
        }
    }
    set_transient( 'brp_domain_fix_done', true, YEAR_IN_SECONDS );
} );

// Auto-setup: create all pages/posts if they don't exist yet
add_action( 'wp_loaded', function() {
    if ( get_transient( 'brp_auto_setup_done' ) ) return;
    if ( get_page_by_path( 'about-us' ) ) {
        set_transient( 'brp_auto_setup_done', true, YEAR_IN_SECONDS );
        return;
    }
    define( 'BRP_AUTO_SETUP', true );
    include get_template_directory() . '/inc/setup-pages.php';
    set_transient( 'brp_auto_setup_done', true, YEAR_IN_SECONDS );
} );

// Auto-populate error codes once
add_action( 'wp_loaded', function() {
    if ( get_transient( 'brp_error_codes_done' ) ) return;

    // Check if posts exist AND have appliance_type taxonomy assigned
    $with_tax = new WP_Query( array(
        'post_type'      => 'error_code',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'tax_query'      => array(
            array(
                'taxonomy' => 'appliance_type',
                'operator' => 'EXISTS',
            ),
        ),
    ) );

    if ( $with_tax->found_posts > 5 ) {
        set_transient( 'brp_error_codes_done', true, YEAR_IN_SECONDS );
        return;
    }

    include get_template_directory() . '/inc/create-error-codes.php';
    include get_template_directory() . '/inc/import-all-error-content.php';
    set_transient( 'brp_error_codes_done', true, YEAR_IN_SECONDS );
} );

define( 'BRP_VERSION', '1.0.7' );
define( 'BRP_DIR', get_template_directory() );
define( 'BRP_URI', get_template_directory_uri() );
define( 'BRP_PHONE', '844-752-7887' );
define( 'BRP_PHONE_RAW', '8447527887' );
define( 'BRP_EMAIL', 'info@maytagappliancesolutions.com' );
define( 'BRP_SITE_URL', 'https://maytagappliancesolutions.com' );
define( 'BRP_BRAND', 'Monogram' );

// ============================================================
// THEME SETUP
// ============================================================
function brp_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ) );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'custom-logo', array(
        'height'      => 96,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Image sizes
    add_image_size( 'brp-hero',     1400, 600,  true );
    add_image_size( 'brp-card',     600,  400,  true );
    add_image_size( 'brp-thumb',    300,  200,  true );
    add_image_size( 'brp-appliance', 900, 500, true );

    // Menus
    register_nav_menus( array(
        'primary'    => __( 'Primary Navigation', 'monogram-repair-pro' ),
        'footer-1'   => __( 'Footer Column 1 – Services', 'monogram-repair-pro' ),
        'footer-2'   => __( 'Footer Column 2 – Cities', 'monogram-repair-pro' ),
        'footer-3'   => __( 'Footer Column 3 – Resources', 'monogram-repair-pro' ),
        'footer-4'   => __( 'Footer Column 4 – Blog', 'monogram-repair-pro' ),
        'footer-legal' => __( 'Footer Legal Links', 'monogram-repair-pro' ),
    ) );
}
add_action( 'after_setup_theme', 'brp_theme_setup' );

// ============================================================
// ENQUEUE SCRIPTS & STYLES
// ============================================================
function brp_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style( 'brp-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(), null );

    // Main stylesheet (style.css = theme declaration + base)
    wp_enqueue_style( 'brp-style', get_stylesheet_uri(), array(), BRP_VERSION );

    // Main CSS
    wp_enqueue_style( 'brp-main',
        BRP_URI . '/assets/css/main.css',
        array( 'brp-style' ), BRP_VERSION );

    // Inline CSS overrides — bypasses Hostinger LiteSpeed Cache on static files
    wp_add_inline_style( 'brp-main', '
        .sidebar-phone-number { color: #0057a8 !important; }
        :root { --color-gray: #3d4451; }
        .text-muted, .section-subtitle, .breadcrumbs, .breadcrumbs a { color: #3d4451 !important; }
        .header-inner { justify-content: space-between !important; }
        .site-logo { flex-shrink: 0 !important; }
        .site-header .container { width: 100% !important; }
        .main-nav a { font-size: 1.05rem !important; font-weight: 600 !important; padding: 8px 16px !important; }
        .header-phone { font-size: 1.1rem !important; }
        .header-cta { gap: 28px !important; }
    ' );

    // Main JS
    wp_enqueue_script( 'brp-main',
        BRP_URI . '/assets/js/main.js',
        array(), BRP_VERSION, true );

    // Localize script with theme data + availability settings
    wp_localize_script( 'brp-main', 'brpData', array(
        'phone'        => BRP_PHONE,
        'phoneRaw'     => BRP_PHONE_RAW,
        'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
        'nonce'        => wp_create_nonce( 'brp_nonce' ),
        'availability' => array(
            'workingDays'  => array_map( 'intval', (array) get_option( 'brp_working_days', array( 1, 2, 3, 4, 5 ) ) ),
            'hoursStart'   => get_option( 'brp_working_hours_start', '09:00' ),
            'hoursEnd'     => get_option( 'brp_working_hours_end', '18:00' ),
            'slotInterval' => (int) get_option( 'brp_slot_interval', 60 ),
            'blockedDates' => brp_get_blocked_dates_array(),
        ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'brp_enqueue_assets' );

// ============================================================
// CUSTOM POST TYPES
// ============================================================
function brp_register_post_types() {

    // Error Codes
    register_post_type( 'error_code', array(
        'labels' => array(
            'name'          => 'Error Codes',
            'singular_name' => 'Error Code',
            'add_new_item'  => 'Add New Error Code',
            'edit_item'     => 'Edit Error Code',
        ),
        'public'            => true,
        'has_archive'       => true,
        'menu_icon'         => 'dashicons-warning',
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite'           => array( 'slug' => 'error-codes', 'with_front' => false ),
        'show_in_rest'      => true,
    ) );

    // Recalls
    register_post_type( 'recall', array(
        'labels' => array(
            'name'          => 'Recalls',
            'singular_name' => 'Recall',
            'add_new_item'  => 'Add New Recall',
        ),
        'public'            => true,
        'has_archive'       => true,
        'menu_icon'         => 'dashicons-megaphone',
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite'           => array( 'slug' => 'recalls', 'with_front' => false ),
        'show_in_rest'      => true,
    ) );

    // City pages
    register_post_type( 'city', array(
        'labels' => array(
            'name'          => 'Service Cities',
            'singular_name' => 'City',
            'add_new_item'  => 'Add New City',
        ),
        'public'            => true,
        'has_archive'       => true,
        'menu_icon'         => 'dashicons-location',
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite'           => array( 'slug' => 'cities', 'with_front' => false ),
        'show_in_rest'      => true,
    ) );

    // Service pages (individual appliance types)
    register_post_type( 'service', array(
        'labels' => array(
            'name'          => 'Services',
            'singular_name' => 'Service',
            'add_new_item'  => 'Add New Service',
        ),
        'public'            => true,
        'has_archive'       => true,
        'menu_icon'         => 'dashicons-hammer',
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite'           => array( 'slug' => 'services', 'with_front' => false ),
        'show_in_rest'      => true,
    ) );
}
add_action( 'init', 'brp_register_post_types' );

// ============================================================
// ERROR CODE URL STRUCTURE: /error-codes/{appliance}/{slug}/
// ============================================================
add_action( 'init', function() {
    add_rewrite_rule(
        '^error-codes/([^/]+)/([^/]+)/?$',
        'index.php?post_type=error_code&name=$matches[2]',
        'top'
    );
}, 20 );

add_filter( 'post_type_link', function( $link, $post ) {
    if ( $post->post_type !== 'error_code' ) return $link;
    $terms = get_the_terms( $post->ID, 'appliance_type' );
    if ( $terms && ! is_wp_error( $terms ) ) {
        return home_url( '/error-codes/' . $terms[0]->slug . '/' . $post->post_name . '/' );
    }
    return $link;
}, 10, 2 );

add_action( 'after_switch_theme', function() {
    brp_register_post_types();
    flush_rewrite_rules();
} );

// ============================================================
// CUSTOM TAXONOMIES
// ============================================================
function brp_register_taxonomies() {

    // Appliance Type (shared across error_code, guide, service, recall)
    register_taxonomy( 'appliance_type', array( 'error_code', 'service', 'recall' ), array(
        'labels' => array(
            'name'          => 'Appliance Types',
            'singular_name' => 'Appliance Type',
            'search_items'  => 'Search Appliance Types',
            'all_items'     => 'All Appliance Types',
            'edit_item'     => 'Edit Appliance Type',
            'add_new_item'  => 'Add New Appliance Type',
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'appliance', 'with_front' => false ),
    ) );

    // Blog topic taxonomy
    register_taxonomy( 'blog_topic', 'post', array(
        'labels' => array(
            'name'          => 'Blog Topics',
            'singular_name' => 'Blog Topic',
            'add_new_item'  => 'Add New Topic',
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'topic', 'with_front' => false ),
    ) );

    // City region taxonomy
    register_taxonomy( 'city_region', 'city', array(
        'labels' => array(
            'name'          => 'Regions',
            'singular_name' => 'Region',
            'add_new_item'  => 'Add New Region',
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'region', 'with_front' => false ),
    ) );
}
add_action( 'init', 'brp_register_taxonomies' );

// ============================================================
// ERROR CODES: TOP-PRIORITY REWRITE RULES
// Runs before post-type rules so /error-codes/dishwasher/
// resolves to the WP page, not an error_code post lookup.
// ============================================================
add_action( 'init', function() {
    $appliances = array( 'dishwasher', 'washer', 'dryer', 'refrigerator', 'oven', 'cooktop', 'microwave', 'freezer' );
    foreach ( $appliances as $appliance ) {
        add_rewrite_rule(
            '^error-codes/' . $appliance . '/?$',
            'index.php?pagename=error-codes/' . $appliance,
            'top'
        );
    }
}, 5 );

// ============================================================
// ERROR CODES: FORCE CORRECT TEMPLATE BY URL
// ============================================================
add_filter( 'template_include', function( $template ) {
    if ( ! is_page() ) return $template;

    $slug        = get_post_field( 'post_name', get_queried_object_id() );
    $parent_id   = get_post_field( 'post_parent', get_queried_object_id() );
    $parent_slug = $parent_id ? get_post_field( 'post_name', $parent_id ) : '';

    $ec_appliances = array( 'dishwasher', 'washer', 'dryer', 'refrigerator', 'oven', 'cooktop', 'microwave', 'freezer' );

    // /error-codes/ → hub template
    if ( $slug === 'error-codes' ) {
        $t = get_theme_file_path( 'page-templates/template-error-codes-hub.php' );
        if ( file_exists( $t ) ) return $t;
    }

    // /error-codes/dishwasher/ etc. → appliance template
    if ( $parent_slug === 'error-codes' && in_array( $slug, $ec_appliances, true ) ) {
        $t = get_theme_file_path( 'page-templates/template-error-codes-appliance.php' );
        if ( file_exists( $t ) ) return $t;
    }

    return $template;
} );

// ============================================================
// ERROR CODES: AUTO-CREATE HUB + APPLIANCE PAGES
// ============================================================
function brp_create_error_code_pages() {
    $appliances = array(
        'dishwasher'   => 'Monogram Dishwasher Error Codes',
        'washer'       => 'Monogram Washer Error Codes',
        'dryer'        => 'Monogram Dryer Error Codes',
        'refrigerator' => 'Monogram Refrigerator Error Codes',
        'oven'         => 'Monogram Oven & Range Error Codes',
        'cooktop'      => 'Monogram Cooktop Error Codes',
        'microwave'    => 'Monogram Microwave Error Codes',
        'freezer'      => 'Monogram Freezer Error Codes',
    );

    $needs_flush = false;

    // 1. Hub page: /error-codes/
    $hub = get_page_by_path( 'error-codes' );
    if ( ! $hub ) {
        $hub_id = wp_insert_post( array(
            'post_title'  => 'Error Codes',
            'post_name'   => 'error-codes',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ) );
        if ( $hub_id && ! is_wp_error( $hub_id ) ) {
            update_post_meta( $hub_id, '_wp_page_template', 'page-templates/template-error-codes-hub.php' );
            $needs_flush = true;
        }
    } else {
        $hub_id = $hub->ID;
    }

    // 2. Appliance sub-pages: /error-codes/dishwasher/ etc.
    if ( $hub_id && ! is_wp_error( $hub_id ) ) {
        foreach ( $appliances as $slug => $title ) {
            $existing = get_page_by_path( 'error-codes/' . $slug );
            if ( ! $existing ) {
                $id = wp_insert_post( array(
                    'post_title'   => $title,
                    'post_name'    => $slug,
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                    'post_parent'  => $hub_id,
                ) );
                if ( $id && ! is_wp_error( $id ) ) {
                    update_post_meta( $id, '_wp_page_template', 'page-templates/template-error-codes-appliance.php' );
                    $needs_flush = true;
                }
            }
        }
    }

    // 3. Create appliance_type taxonomy terms
    $terms = array_keys( $appliances );
    foreach ( $terms as $term ) {
        if ( ! term_exists( $term, 'appliance_type' ) ) {
            wp_insert_term( ucfirst( $term ), 'appliance_type', array( 'slug' => $term ) );
        }
    }

    if ( $needs_flush ) {
        flush_rewrite_rules();
    }
}
add_action( 'init', 'brp_create_error_code_pages', 20 );

// ============================================================
// BLOG TOPICS: AUTO-CREATE TERMS
// ============================================================
function brp_create_blog_topics() {
    $topics = array(
        'dishwasher'   => 'Dishwashers',
        'refrigerator' => 'Refrigerators',
        'range'        => 'Ranges & Pro Cooking',
        'wall-oven'    => 'Wall Ovens',
        'cooktop'      => 'Cooktops',
        'speed-oven'   => 'Speed Ovens',
        'ice-maker'    => 'Ice Makers',
        'wine-cooler' => 'Wine Coolers',
        'maintenance'  => 'Maintenance Tips',
        'error-codes'  => 'Error Code Guides',
    );
    foreach ( $topics as $slug => $name ) {
        if ( ! get_term_by( 'slug', $slug, 'blog_topic' ) ) {
            wp_insert_term( $name, 'blog_topic', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'init', 'brp_create_blog_topics' );

// ============================================================
// SIDEBARS / WIDGET AREAS
// ============================================================
function brp_register_sidebars() {
    register_sidebar( array(
        'name'          => 'Service Page Sidebar',
        'id'            => 'sidebar-service',
        'description'   => 'Sidebar shown on service pages',
        'before_widget' => '<div class="sidebar-widget" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar-widget-header">',
        'after_title'   => '</div><div class="sidebar-widget-body">',
    ) );

    register_sidebar( array(
        'name'          => 'Blog Sidebar',
        'id'            => 'sidebar-blog',
        'description'   => 'Sidebar shown on blog pages',
        'before_widget' => '<div class="sidebar-widget" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar-widget-header">',
        'after_title'   => '</div><div class="sidebar-widget-body">',
    ) );
}
add_action( 'widgets_init', 'brp_register_sidebars' );

// ============================================================
// SEO & META HELPERS
// ============================================================
function brp_get_meta( $key, $default = '' ) {
    global $post;
    if ( ! $post ) return $default;
    $value = get_post_meta( $post->ID, $key, true );
    return $value ? $value : $default;
}

// Structured data helper (LocalBusiness)
function brp_schema_local_business() {
    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'LocalBusiness',
        'name'            => get_bloginfo( 'name' ),
        'description'     => get_bloginfo( 'description' ),
        'telephone'       => BRP_PHONE,
        'email'           => BRP_EMAIL,
        'url'             => home_url(),
        'priceRange'      => '$$',
        'areaServed'      => array( 'Chicago', 'San Francisco', 'Houston', 'Miami', 'Los Angeles', 'New York' ),
        'serviceType'     => 'Appliance Repair',
        'brand'           => array( '@type' => 'Brand', 'name' => BRP_BRAND ),
    );
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}
add_action( 'wp_head', 'brp_schema_local_business' );

// FAQ structured data
function brp_get_faq_schema( $faqs ) {
    if ( empty( $faqs ) ) return '';
    $schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => array(),
    );
    foreach ( $faqs as $faq ) {
        $schema['mainEntity'][] = array(
            '@type'          => 'Question',
            'name'           => esc_html( $faq['q'] ),
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => esc_html( $faq['a'] ),
            ),
        );
    }
    return '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>';
}

// ============================================================
// ERROR CODE VIEW TRACKING
// ============================================================
add_action( 'template_redirect', function() {
    if ( ! is_singular( 'error_code' ) ) return;
    $post_id = get_the_ID();
    if ( ! $post_id ) return;
    $views = get_option( 'brp_ec_views', array() );
    $views[ $post_id ] = isset( $views[ $post_id ] ) ? $views[ $post_id ] + 1 : 1;
    update_option( 'brp_ec_views', $views, false );
} );

function brp_get_most_searched_by_appliance( $appliance_slug ) {
    $views = get_option( 'brp_ec_views', array() );
    if ( empty( $views ) ) return null;

    $term = get_term_by( 'slug', $appliance_slug, 'appliance_type' );
    if ( ! $term || is_wp_error( $term ) ) return null;

    $posts = get_posts( array(
        'post_type'      => 'error_code',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'tax_query'      => array( array(
            'taxonomy' => 'appliance_type',
            'field'    => 'slug',
            'terms'    => $appliance_slug,
        ) ),
    ) );

    if ( empty( $posts ) ) return null;

    $best_id    = null;
    $best_count = 0;
    foreach ( $posts as $pid ) {
        $count = isset( $views[ $pid ] ) ? $views[ $pid ] : 0;
        if ( $count > $best_count ) {
            $best_count = $count;
            $best_id    = $pid;
        }
    }

    if ( ! $best_id || $best_count === 0 ) return null;

    $code = get_post_meta( $best_id, '_brp_error_code', true );
    return $code ?: get_the_title( $best_id );
}

// ============================================================
// CUSTOM EXCERPT
// ============================================================
function brp_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'brp_excerpt_length' );

function brp_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'brp_excerpt_more' );

// ============================================================
// BREADCRUMBS
// ============================================================
function brp_breadcrumbs() {
    global $post;
    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<a href="' . home_url() . '">Home</a><span aria-hidden="true"> › </span>';

    if ( is_singular( 'service' ) ) {
        echo '<a href="' . get_post_type_archive_link( 'service' ) . '">Services</a><span> › </span>';
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_singular( 'city' ) ) {
        echo '<a href="' . get_post_type_archive_link( 'city' ) . '">Cities We Service</a><span> › </span>';
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_singular( 'error_code' ) ) {
        $terms = get_the_terms( $post->ID, 'appliance_type' );
        echo '<a href="' . get_post_type_archive_link( 'error_code' ) . '">Error Codes</a><span> › </span>';
        if ( $terms && ! is_wp_error( $terms ) ) {
            echo '<a href="' . get_term_link( $terms[0] ) . '">' . $terms[0]->name . '</a><span> › </span>';
        }
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_singular( 'recall' ) ) {
        echo '<a href="' . get_post_type_archive_link( 'recall' ) . '">Recalls</a><span> › </span>';
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_singular( 'post' ) ) {
        echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">Blog</a><span> › </span>';
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_post_type_archive() ) {
        echo '<span>' . post_type_archive_title( '', false ) . '</span>';
    } elseif ( is_page() ) {
        if ( $post->post_parent ) {
            echo '<a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a><span> › </span>';
        }
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_category() ) {
        echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">Blog</a><span> › </span>';
        echo '<span>' . single_cat_title( '', false ) . '</span>';
    }
    echo '</nav>';
}

// ============================================================
// APPOINTMENT: CUSTOM POST TYPE
// ============================================================
function brp_register_appointment_post_type() {
    register_post_type( 'appointment', array(
        'labels' => array(
            'name'               => 'Appointments',
            'singular_name'      => 'Appointment',
            'all_items'          => 'All Appointments',
            'view_item'          => 'View Appointment',
            'search_items'       => 'Search Appointments',
            'not_found'          => 'No appointments found.',
            'not_found_in_trash' => 'No appointments found in trash.',
        ),
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array( 'title' ),
        'capability_type'    => 'post',
        'capabilities'       => array( 'create_posts' => 'do_not_allow' ),
        'map_meta_cap'       => true,
    ) );
}
add_action( 'init', 'brp_register_appointment_post_type' );

// ============================================================
// APPOINTMENT: AVAILABILITY SETTINGS
// ============================================================
function brp_get_blocked_dates_array() {
    $raw = get_option( 'brp_blocked_dates', '' );
    if ( ! $raw ) return array();
    $dates = array();
    foreach ( explode( "\n", $raw ) as $line ) {
        $d = trim( $line );
        if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $d ) ) {
            $dates[] = $d;
        }
    }
    return $dates;
}

function brp_register_availability_settings_page() {
    add_submenu_page(
        'edit.php?post_type=appointment',
        'Availability Settings',
        'Availability Settings',
        'manage_options',
        'brp-availability',
        'brp_availability_settings_page_html'
    );
}
add_action( 'admin_menu', 'brp_register_availability_settings_page' );

function brp_availability_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    if ( isset( $_POST['brp_avail_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['brp_avail_nonce'] ) ), 'brp_save_availability' ) ) {
        $days = isset( $_POST['brp_working_days'] ) ? array_map( 'absint', (array) $_POST['brp_working_days'] ) : array();
        update_option( 'brp_working_days', $days );
        update_option( 'brp_working_hours_start', sanitize_text_field( wp_unslash( $_POST['brp_working_hours_start'] ?? '09:00' ) ) );
        update_option( 'brp_working_hours_end',   sanitize_text_field( wp_unslash( $_POST['brp_working_hours_end']   ?? '18:00' ) ) );
        update_option( 'brp_slot_interval',        absint( $_POST['brp_slot_interval'] ?? 60 ) );
        update_option( 'brp_blocked_dates',        sanitize_textarea_field( wp_unslash( $_POST['brp_blocked_dates'] ?? '' ) ) );
        echo '<div class="notice notice-success is-dismissible"><p><strong>Availability settings saved.</strong></p></div>';
    }

    $working_days  = array_map( 'intval', (array) get_option( 'brp_working_days', array( 1, 2, 3, 4, 5 ) ) );
    $hours_start   = get_option( 'brp_working_hours_start', '09:00' );
    $hours_end     = get_option( 'brp_working_hours_end',   '18:00' );
    $slot_interval = (int) get_option( 'brp_slot_interval', 60 );
    $blocked_dates = get_option( 'brp_blocked_dates', '' );

    $day_names = array( 0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday' );
    ?>
    <div class="wrap">
        <h1>Appointment Availability Settings</h1>
        <p style="color:#555;">Configure which days and hours customers can book appointments. Non-working days and times will be blocked in the booking form.</p>
        <form method="post">
            <?php wp_nonce_field( 'brp_save_availability', 'brp_avail_nonce' ); ?>

            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label>Working Days</label></th>
                    <td>
                        <?php foreach ( $day_names as $num => $label ) : ?>
                        <label style="display:inline-flex;align-items:center;gap:6px;margin-right:16px;margin-bottom:8px;">
                            <input type="checkbox" name="brp_working_days[]" value="<?php echo $num; ?>"
                                <?php checked( in_array( $num, $working_days, true ) ); ?>>
                            <?php echo esc_html( $label ); ?>
                        </label>
                        <?php endforeach; ?>
                        <p class="description">Unchecked days will be greyed out and unselectable in the booking form.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="brp_working_hours_start">Working Hours</label></th>
                    <td>
                        <input type="time" id="brp_working_hours_start" name="brp_working_hours_start"
                               value="<?php echo esc_attr( $hours_start ); ?>" style="width:130px;">
                        <span style="margin:0 8px;">to</span>
                        <input type="time" name="brp_working_hours_end"
                               value="<?php echo esc_attr( $hours_end ); ?>" style="width:130px;">
                        <p class="description">Time slots outside this range will not be available.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="brp_slot_interval">Time Slot Interval</label></th>
                    <td>
                        <select id="brp_slot_interval" name="brp_slot_interval">
                            <?php foreach ( array( 30 => '30 minutes', 60 => '1 hour', 90 => '1.5 hours', 120 => '2 hours' ) as $val => $lbl ) : ?>
                            <option value="<?php echo $val; ?>" <?php selected( $slot_interval, $val ); ?>><?php echo esc_html( $lbl ); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="description">How often time slots are shown (e.g. every 1 hour: 9:00 AM, 10:00 AM …).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="brp_blocked_dates">Blocked Dates</label></th>
                    <td>
                        <textarea id="brp_blocked_dates" name="brp_blocked_dates" rows="6" style="width:300px;font-family:monospace;"
                                  placeholder="2025-12-25&#10;2025-01-01&#10;2025-07-04"><?php echo esc_textarea( $blocked_dates ); ?></textarea>
                        <p class="description">One date per line in <strong>YYYY-MM-DD</strong> format (holidays, closures, etc.). These specific dates will be blocked regardless of the working-day setting.</p>
                    </td>
                </tr>
            </table>

            <?php submit_button( 'Save Availability Settings' ); ?>
        </form>
    </div>
    <?php
}

// Admin columns for Appointments
function brp_appointment_columns( $columns ) {
    return array(
        'cb'               => $columns['cb'],
        'title'            => 'Customer Name',
        'brp_phone'        => 'Phone',
        'brp_email'        => 'Email',
        'brp_appliance'    => 'Appliance',
        'brp_preferred_dt' => 'Preferred Date & Time',
        'brp_message'      => 'Message',
        'date'             => 'Submitted',
    );
}
add_filter( 'manage_appointment_posts_columns', 'brp_appointment_columns' );

function brp_appointment_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'brp_phone':
            echo esc_html( get_post_meta( $post_id, '_brp_phone', true ) );
            break;
        case 'brp_email':
            $email = get_post_meta( $post_id, '_brp_email', true );
            if ( $email ) echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
            break;
        case 'brp_appliance':
            echo esc_html( get_post_meta( $post_id, '_brp_appliance', true ) );
            break;
        case 'brp_preferred_dt':
            echo esc_html( get_post_meta( $post_id, '_brp_preferred_dt', true ) );
            break;
        case 'brp_message':
            $msg = get_post_meta( $post_id, '_brp_message', true );
            echo $msg ? '<span title="' . esc_attr( $msg ) . '">' . esc_html( wp_trim_words( $msg, 8, '...' ) ) . '</span>' : '—';
            break;
    }
}
add_action( 'manage_appointment_posts_custom_column', 'brp_appointment_column_content', 10, 2 );

// Make preferred date column sortable
function brp_appointment_sortable_columns( $columns ) {
    $columns['brp_preferred_dt'] = 'brp_preferred_dt';
    return $columns;
}
add_filter( 'manage_edit-appointment_sortable_columns', 'brp_appointment_sortable_columns' );

// Meta box showing full appointment details
function brp_appointment_meta_box() {
    add_meta_box(
        'brp_appointment_details',
        'Appointment Details',
        'brp_appointment_meta_box_html',
        'appointment',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'brp_appointment_meta_box' );

function brp_appointment_meta_box_html( $post ) {
    $fields = array(
        '_brp_phone'        => 'Phone',
        '_brp_email'        => 'Email',
        '_brp_appliance'    => 'Appliance',
        '_brp_preferred_dt' => 'Preferred Date & Time',
        '_brp_message'      => 'Message',
        '_brp_source_page'  => 'Source Page',
    );
    echo '<table style="width:100%;border-collapse:collapse;">';
    foreach ( $fields as $key => $label ) {
        $value = get_post_meta( $post->ID, $key, true );
        echo '<tr><th style="text-align:left;padding:6px 12px 6px 0;width:160px;color:#555;">' . esc_html( $label ) . '</th>';
        echo '<td style="padding:6px 0;">' . ( $value ? esc_html( $value ) : '<em style="color:#aaa;">—</em>' ) . '</td></tr>';
    }
    echo '</table>';
}

// ============================================================
// APPOINTMENT: AJAX HANDLER
// ============================================================
function brp_handle_appointment_submission() {
    // Verify nonce
    if ( ! isset( $_POST['brp_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['brp_nonce'] ) ), 'brp_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed. Please refresh the page and try again.' ) );
    }

    // Sanitize inputs
    $name           = sanitize_text_field( wp_unslash( $_POST['brp_name'] ?? '' ) );
    $phone          = sanitize_text_field( wp_unslash( $_POST['brp_phone'] ?? '' ) );
    $email          = sanitize_email( wp_unslash( $_POST['brp_email'] ?? '' ) );
    $appliance      = sanitize_text_field( wp_unslash( $_POST['brp_appliance'] ?? '' ) );
    $preferred_date = sanitize_text_field( wp_unslash( $_POST['brp_preferred_date'] ?? '' ) );
    $preferred_time = sanitize_text_field( wp_unslash( $_POST['brp_preferred_time'] ?? '' ) );
    $message        = sanitize_textarea_field( wp_unslash( $_POST['brp_message'] ?? '' ) );
    $source_page    = esc_url_raw( wp_unslash( $_POST['brp_source_page'] ?? '' ) );

    // Combine date + time into one string
    $preferred = '';
    if ( $preferred_date ) {
        $dt_obj    = DateTime::createFromFormat( 'Y-m-d', $preferred_date );
        $preferred = $dt_obj ? $dt_obj->format( 'F j, Y' ) : $preferred_date;
        if ( $preferred_time ) {
            $preferred .= ' at ' . $preferred_time;
        }
    }

    // Validate required fields
    if ( ! $name || ! $phone ) {
        wp_send_json_error( array( 'message' => 'Name and phone number are required.' ) );
    }

    // Save as appointment post
    $post_id = wp_insert_post( array(
        'post_title'  => $name . ' — ' . ( $preferred ?: current_time( 'Y-m-d' ) ),
        'post_type'   => 'appointment',
        'post_status' => 'publish',
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( array( 'message' => 'Could not save appointment. Please call us directly.' ) );
    }

    update_post_meta( $post_id, '_brp_phone',        $phone );
    update_post_meta( $post_id, '_brp_email',        $email );
    update_post_meta( $post_id, '_brp_appliance',    $appliance );
    update_post_meta( $post_id, '_brp_preferred_dt', $preferred );
    update_post_meta( $post_id, '_brp_message',      $message );
    update_post_meta( $post_id, '_brp_source_page',  $source_page );

    // Email to admin
    $admin_email  = get_option( 'admin_email' );
    $site_name    = get_bloginfo( 'name' );
    $admin_url    = admin_url( 'post.php?post=' . $post_id . '&action=edit' );

    $subject = '[' . $site_name . '] New Appointment Request — ' . $name;

    $body  = "A new appointment request was submitted on your website.\n\n";
    $body .= "-------------------------------\n";
    $body .= "Customer Name : " . $name . "\n";
    $body .= "Phone         : " . $phone . "\n";
    $body .= "Email         : " . ( $email ?: '—' ) . "\n";
    $body .= "Appliance     : " . ( $appliance ?: '—' ) . "\n";
    $body .= "Preferred Time: " . ( $preferred ?: '—' ) . "\n";
    $body .= "Message       : " . ( $message ?: '—' ) . "\n";
    $body .= "Source Page   : " . ( $source_page ?: '—' ) . "\n";
    $body .= "Submitted     : " . current_time( 'F j, Y \a\t g:i A' ) . "\n";
    $body .= "-------------------------------\n\n";
    $body .= "View in dashboard: " . $admin_url . "\n";

    wp_mail(
        $admin_email,
        $subject,
        $body,
        array( 'Content-Type: text/plain; charset=UTF-8' )
    );

    // Confirmation email to customer
    if ( $email ) {
        $customer_subject = 'We received your appointment request — ' . $site_name;
        $customer_body    = "Hi " . $name . ",\n\n";
        $customer_body   .= "Thank you for contacting " . $site_name . ". We received your appointment request and will call you shortly to confirm your booking.\n\n";
        $customer_body   .= "Your details:\n";
        $customer_body   .= "  Appliance     : " . ( $appliance ?: '—' ) . "\n";
        $customer_body   .= "  Preferred Time: " . ( $preferred ?: '—' ) . "\n";
        $customer_body   .= "  Message       : " . ( $message ?: '—' ) . "\n\n";
        $customer_body   .= "Questions? Call us at " . BRP_PHONE . "\n\n";
        $customer_body   .= "— " . $site_name . " Team\n";

        wp_mail(
            $email,
            $customer_subject,
            $customer_body,
            array(
                'Content-Type: text/plain; charset=UTF-8',
                'From: ' . $site_name . ' <' . BRP_EMAIL . '>',
            )
        );
    }

    wp_send_json_success( array( 'message' => 'Your appointment request has been received! We will call you shortly to confirm.' ) );
}
add_action( 'wp_ajax_brp_book_appointment',        'brp_handle_appointment_submission' );
add_action( 'wp_ajax_nopriv_brp_book_appointment', 'brp_handle_appointment_submission' );

// ============================================================
// HELPER: APPOINTMENT FORM
// ============================================================
function brp_appointment_form( $title = 'Schedule Your Repair Today' ) {
    ob_start();
    ?>
    <div class="appointment-section" id="schedule">
        <div class="container">
            <div class="appointment-inner">
                <div class="appointment-info">
                    <span class="section-label">Book Now</span>
                    <h2><?php echo esc_html( $title ); ?></h2>
                    <p>Our certified technicians are ready to diagnose and fix your <?php echo BRP_BRAND; ?> appliance. Same-day and next-day appointments available.</p>
                    <ul class="appointment-features">
                        <li>Factory-certified replacement parts</li>
                        <li>Highly trained, background-checked technicians</li>
                        <li>90-day labor warranty</li>
                        <li>Same-day service available</li>
                        <li>Upfront, transparent pricing</li>
                        <li>All major appliance brands accepted</li>
                    </ul>
                </div>
                <div class="appointment-form-wrapper">
                    <iframe id="appointmentIframe" src="https://webform.proleadservice.com/?ref_id=478" width="100%" style="min-height: 650px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// ============================================================
// HELPER: FAQ SECTION
// ============================================================
function brp_faq_section( $faqs, $title = 'Frequently Asked Questions' ) {
    if ( empty( $faqs ) ) return '';
    ob_start();
    ?>
    <section class="section bg-light">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-label">FAQ</span>
                <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
            </div>
            <div class="faq-list" style="max-width: 800px; margin: 0 auto;">
                <?php foreach ( $faqs as $i => $faq ) : ?>
                <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-<?php echo $i; ?>" itemprop="name">
                        <?php echo esc_html( $faq['q'] ); ?>
                        <span class="faq-icon" aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer" id="faq-answer-<?php echo $i; ?>" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text">
                            <p><?php echo wp_kses_post( $faq['a'] ); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    echo brp_get_faq_schema( $faqs );
    return ob_get_clean();
}

// ============================================================
// HELPER: SERVICES DATA
// ============================================================
function brp_get_services() {
    return array(
        array(
            'slug'  => 'monogram-oven-repair',
            'title' => 'Monogram Oven Repair',
            'icon'  => '🔲',
            'desc'  => 'Single and double Monogram wall oven repair — heating elements, sensors, control boards.',
            'image' => 'oven.png',
        ),
        array(
            'slug'  => 'monogram-microwave-repair',
            'title' => 'Monogram Microwave Repair',
            'icon'  => '📡',
            'desc'  => 'Monogram microwave not heating or displaying errors? We diagnose and fix it fast.',
            'image' => 'microwave.png',
        ),
        array(
            'slug'  => 'monogram-freezer-repair',
            'title' => 'Monogram Freezer Repair',
            'icon'  => '❄️',
            'desc'  => 'Monogram upright and undercounter freezer repair — not freezing, frost buildup, and more.',
            'image' => 'freezer.png',
        ),
        array(
            'slug'  => 'monogram-cooktop-repair',
            'title' => 'Monogram Cooktop Repair',
            'icon'  => '♨️',
            'desc'  => 'Gas and induction Monogram cooktop repair — burners, igniters, touch controls.',
            'image' => 'cooktop.png',
        ),
        array(
            'slug'  => 'monogram-refrigerator-repair',
            'title' => 'Monogram Refrigerator Repair',
            'icon'  => '🧊',
            'desc'  => 'Built-in column and French door Monogram refrigerator repair — cooling, ice maker, water dispenser.',
            'image' => 'refrigerator.webp',
        ),
        array(
            'slug'  => 'monogram-dishwasher-repair',
            'title' => 'Monogram Dishwasher Repair',
            'icon'  => '🍽️',
            'desc'  => 'Monogram dishwasher not draining, leaking, or cleaning? We diagnose and fix it fast.',
            'image' => 'dishwasher.png',
        ),
        array(
            'slug'  => 'monogram-dryer-repair',
            'title' => 'Monogram Dryer Repair',
            'icon'  => '🌀',
            'desc'  => 'Monogram dryer not heating or tumbling? We service all models with same-day availability.',
            'image' => 'dryer.png',
        ),
        array(
            'slug'  => 'monogram-wine-cooler-repair',
            'title' => 'Monogram Wine Cooler Repair',
            'icon'  => '🍷',
            'desc'  => 'Monogram wine cooler not cooling or showing errors? We restore optimal temperature control.',
            'image' => 'wine-cooler.png',
        ),
        array(
            'slug'  => 'monogram-hood-repair',
            'title' => 'Monogram Hood Repair',
            'icon'  => '💨',
            'desc'  => 'Monogram ventilation hood and range hood repair — blower motors, lighting, controls.',
            'image' => 'hood.png',
        ),
        array(
            'slug'  => 'monogram-washer-repair',
            'title' => 'Monogram Washer Repair',
            'icon'  => '🫧',
            'desc'  => 'Monogram washer not spinning, draining, or starting? We service all models with same-day availability.',
            'image' => 'washer.jpg',
        ),
    );
}

// ============================================================
// HELPER: CITIES DATA
// ============================================================
function brp_get_cities() {
    return array(
        array(
            'slug'     => 'chicago',
            'title'    => 'Chicago, IL',
            'state'    => 'Illinois',
            'image'    => get_template_directory_uri() . '/assets/images/cities/chicago.jpg',
            'zip_codes' => '60601, 60602, 60603, 60604, 60605, 60606, 60607, 60608, 60609, 60610, 60611, 60612, 60613, 60614, 60615, 60616, 60617, 60618, 60619, 60620',
            'suburbs'  => 'Evanston, Oak Park, Naperville, Schaumburg, Arlington Heights, Skokie, Cicero, Joliet, Waukegan, Elgin, Berwyn, Wheaton, Bolingbrook, Palatine, Des Plaines, Orland Park, Tinley Park, Oak Lawn, Elmhurst, Downers Grove',
        ),
        array(
            'slug'     => 'san-francisco',
            'title'    => 'San Francisco, CA',
            'state'    => 'California',
            'image'    => get_template_directory_uri() . '/assets/images/cities/san-francisco.jpg',
            'zip_codes' => '94102, 94103, 94104, 94105, 94107, 94108, 94109, 94110, 94111, 94112, 94114, 94115, 94116, 94117, 94118, 94121, 94122, 94123, 94124, 94127',
            'suburbs'  => 'Oakland, Berkeley, San Jose, Fremont, Santa Clara, Sunnyvale, Hayward, Alameda, San Mateo, Redwood City, Daly City, South San Francisco, San Leandro, Milpitas, Richmond, Concord, Walnut Creek, San Ramon, Dublin, Pleasanton',
        ),
        array(
            'slug'     => 'houston',
            'title'    => 'Houston, TX',
            'state'    => 'Texas',
            'image'    => get_template_directory_uri() . '/assets/images/cities/Houston.jpg',
            'zip_codes' => '77001, 77002, 77003, 77004, 77005, 77006, 77007, 77008, 77009, 77010, 77011, 77012, 77018, 77019, 77024, 77025, 77030, 77056, 77057, 77098',
            'suburbs'  => 'Sugar Land, Katy, The Woodlands, Pearland, League City, Pasadena, Missouri City, Friendswood, Baytown, Conroe, Humble, Spring, Cypress, Tomball, Stafford, Richmond, Galveston, Alvin, Clear Lake, Deer Park',
        ),
        array(
            'slug'     => 'miami',
            'title'    => 'Miami, FL',
            'state'    => 'Florida',
            'image'    => get_template_directory_uri() . '/assets/images/cities/miami.jpg',
            'zip_codes' => '33101, 33125, 33126, 33127, 33128, 33129, 33130, 33131, 33132, 33133, 33134, 33135, 33136, 33137, 33138, 33139, 33140, 33141, 33142, 33143',
            'suburbs'  => 'Coral Gables, Hialeah, Fort Lauderdale, Miami Beach, Doral, Homestead, North Miami, Aventura, Pembroke Pines, Hollywood, Miramar, Davie, Plantation, Sunrise, Lauderhill, West Palm Beach, Boca Raton, Delray Beach, Pompano Beach, Boynton Beach',
        ),
        array(
            'slug'     => 'los-angeles',
            'title'    => 'Los Angeles, CA',
            'state'    => 'California',
            'image'    => get_template_directory_uri() . '/assets/images/cities/los-angeles.jpg',
            'zip_codes' => '90001, 90002, 90003, 90004, 90005, 90006, 90007, 90008, 90010, 90011, 90012, 90013, 90014, 90015, 90016, 90017, 90018, 90019, 90020, 90021',
            'suburbs'  => 'Pasadena, Burbank, Santa Monica, Glendale, Long Beach, Torrance, El Monte, Pomona, Inglewood, Downey, West Covina, Norwalk, Compton, South Gate, Carson, El Cajon, Thousand Oaks, Simi Valley, Lancaster, Palmdale',
        ),
        array(
            'slug'     => 'new-york',
            'title'    => 'New York, NY',
            'state'    => 'New York',
            'image'    => get_template_directory_uri() . '/assets/images/cities/new-york.jpg',
            'zip_codes' => '10001, 10002, 10003, 10004, 10005, 10006, 10007, 10009, 10010, 10011, 10012, 10013, 10014, 10016, 10017, 10018, 10019, 10020, 10021, 10022',
            'suburbs'  => 'Brooklyn, Queens, Bronx, Staten Island, Jersey City, Newark, Hoboken, Yonkers, New Rochelle, White Plains, Mount Vernon, Flushing, Jamaica, Astoria, Long Island City, Stamford, Bridgeport, Paterson, Elizabeth, Edison',
        ),
    );
}

// ============================================================
// HELPER: APPLIANCE FAQ DATA
// ============================================================
function brp_get_faqs_for_appliance( $appliance ) {
    $all = array(
        'refrigerator' => array(
            array( 'q' => 'Why is my Monogram built-in refrigerator not cooling?', 'a' => 'Cooling failure in Monogram column and built-in refrigerators is commonly caused by dirty condenser coils, a failed evaporator fan motor, a stuck defrost system, or a failing sealed system. Our technicians carry diagnostic equipment to pinpoint the cause and repair it same-day.' ),
            array( 'q' => 'Why is my Monogram refrigerator leaking water?', 'a' => 'Common leak sources include a clogged defrost drain, a cracked drain pan, a failed water inlet valve, or a loose ice maker water line. We carry genuine Monogram parts and can repair leaks on the first visit.' ),
            array( 'q' => 'My Monogram refrigerator shows a PO or HrF error — what does it mean?', 'a' => 'PO indicates a recent power outage and is a food-safety alert. HrF means the freezer section has reached a high temperature, often caused by a failed evaporator fan or defrost heater. Call us for same-day service if HrF persists after a reset.' ),
            array( 'q' => 'Monogram ice maker not producing ice — what could cause this?', 'a' => 'Ice maker issues in Monogram refrigerators are typically caused by a frozen fill tube, a failed water inlet valve, a faulty ice maker module, or a clogged water filter. We diagnose and replace the defective component quickly.' ),
            array( 'q' => 'Is it worth repairing a Monogram built-in refrigerator?', 'a' => 'Yes — Monogram built-in refrigerators are premium appliances designed to last 20+ years and cost $5,000–$15,000 to replace. Repairs costing less than 30–40% of replacement value are almost always the smarter financial decision.' ),
        ),
        'range' => array(
            array( 'q' => 'Why are the burners on my Monogram pro range not igniting?', 'a' => 'Ignition problems on Monogram dual-fuel and all-gas ranges are usually caused by a dirty or cracked igniter, a faulty spark module, or a clogged burner port. Our technicians clean and replace igniter components to restore reliable ignition.' ),
            array( 'q' => 'My Monogram range shows an F1 or F2 error — what does it mean?', 'a' => 'F1 indicates a control board failure or runaway oven temperature, while F2 means the oven has exceeded its maximum temperature limit. Both codes require immediate attention. Turn off the range and call us for same-day diagnosis.' ),
            array( 'q' => 'Why is my Monogram dual-fuel range oven not heating evenly?', 'a' => 'Uneven heating is typically caused by a failing bake element, a faulty convection fan motor, or an inaccurate temperature sensor. We recalibrate the sensor or replace the defective part to restore precise cooking temperatures.' ),
            array( 'q' => 'My Monogram range door won\'t unlock after self-clean — what should I do?', 'a' => 'A stuck door after self-cleaning is caused by a failed door latch motor or a thermal lock that hasn\'t released. Do not force the door open. Call us and we\'ll safely disengage the lock mechanism without damaging the door.' ),
            array( 'q' => 'How often should a Monogram pro range be serviced?', 'a' => 'We recommend a professional service visit every 1–2 years for Monogram pro ranges — especially for cleaning burner ports, checking the gas valve and ignition system, and inspecting the convection fan. Regular maintenance prevents costly repairs.' ),
        ),
        'dishwasher' => array(
            array( 'q' => 'Why is my Monogram dishwasher not draining?', 'a' => 'Drainage problems are typically caused by a clogged filter basket, blocked drain hose, a failed drain pump motor, or a faulty check valve. Our technicians clear the obstruction or replace the pump to restore proper drainage.' ),
            array( 'q' => 'Why is my Monogram dishwasher leaking?', 'a' => 'Leaks in Monogram dishwashers usually come from a damaged door gasket, a cracked spray arm, a faulty water inlet valve, or a failed pump seal. We carry genuine Monogram seals and gaskets for a lasting repair.' ),
            array( 'q' => 'My Monogram dishwasher is showing a C2 or C8 error — what does it mean?', 'a' => 'C2 indicates a drain problem — the dishwasher cannot empty properly. C8 means a leak has been detected in the base pan, triggering the flood protection. C8 requires immediate service to prevent floor damage.' ),
            array( 'q' => 'Why does my Monogram dishwasher leave dishes dirty or spotty?', 'a' => 'Poor wash results are usually caused by clogged spray arm nozzles, a failing wash pump, low water temperature, or incorrect detergent. We inspect the spray arms, pump, and heating element and restore full cleaning performance.' ),
            array( 'q' => 'How long does a Monogram dishwasher repair take?', 'a' => 'Most Monogram dishwasher repairs are completed in a single 1–2 hour visit. We stock common parts in our service vehicles, so same-day repairs are available in most cases.' ),
        ),
        'wall-oven' => array(
            array( 'q' => 'Why is my Monogram wall oven not heating?', 'a' => 'A Monogram wall oven that won\'t heat is usually caused by a failed bake or broil element, a blown thermal fuse, a defective igniter (gas models), or a faulty electronic control board. We diagnose and replace the failed component on the first visit.' ),
            array( 'q' => 'My Monogram wall oven shows an F3 or F4 error — what does that mean?', 'a' => 'F3 means the oven temperature sensor has an open circuit (disconnected or broken), while F4 indicates a short circuit in the sensor. Both require sensor replacement, which our technicians can typically complete same-day.' ),
            array( 'q' => 'Why won\'t my Monogram wall oven door close properly?', 'a' => 'Door seal problems are caused by worn or broken hinges, a damaged door gasket, or a warped door frame. A poor seal significantly reduces cooking efficiency and increases energy use. We replace hinges and gaskets with genuine Monogram parts.' ),
            array( 'q' => 'Can you repair a Monogram combination wall oven (speed oven)?', 'a' => 'Yes — our technicians are trained on all Monogram combination oven models, including convection/microwave combos. We repair magnetron assemblies, convection fans, control boards, and more.' ),
        ),
        'cooktop' => array(
            array( 'q' => 'Why is my Monogram gas cooktop not igniting?', 'a' => 'Ignition failures on Monogram gas cooktops are most often caused by dirty igniters or burner ports, a faulty spark module, or a failed igniter switch. We clean and replace igniter components to restore reliable ignition on all burners.' ),
            array( 'q' => 'My Monogram induction cooktop is showing an F2 or F5 error — what does it mean?', 'a' => 'F2 indicates a burner overheating condition — the cooktop shut off as a safety measure. F5 points to an internal control board failure. For F5, the control board typically needs replacement. Call us for professional diagnosis.' ),
            array( 'q' => 'Why does my Monogram cooktop\'s touch control panel not respond?', 'a' => 'Unresponsive touch controls are caused by moisture under the glass, a faulty control board, or a damaged touch sensor. We diagnose the root cause and replace the control panel or board as needed.' ),
            array( 'q' => 'Can you repair a Monogram induction cooktop?', 'a' => 'Yes. Our technicians are trained on Monogram gas, electric, and induction cooktops. Induction repairs include inverter board replacement, coil servicing, temperature sensor repair, and touch panel replacement.' ),
        ),
        'speed-oven' => array(
            array( 'q' => 'Why is my Monogram speed oven not heating?', 'a' => 'Heating issues in Monogram speed ovens are caused by a failed magnetron (microwave function), a defective convection element, a blown thermal fuse, or a faulty control board. We diagnose and replace the correct component for a lasting fix.' ),
            array( 'q' => 'My Monogram speed oven shows an F7 error — what does it mean?', 'a' => 'F7 indicates a touch keypad or control panel fault — one or more touch buttons may be stuck or the panel has failed. We replace the keypad assembly with genuine Monogram parts.' ),
            array( 'q' => 'Why does my Monogram speed oven\'s microwave function work but convection doesn\'t?', 'a' => 'If only the convection function fails, the issue is usually a failed convection heating element, a faulty fan motor, or a relay on the control board. We isolate and repair the defective component.' ),
        ),
        'ice-maker' => array(
            array( 'q' => 'Why is my Monogram undercounter ice maker not making ice?', 'a' => 'Common causes include a frozen water line, a faulty water inlet valve, a failed ice maker board, or a dirty condenser coil reducing cooling efficiency. We carry all common Monogram ice maker components for same-day repair.' ),
            array( 'q' => 'Why is my Monogram ice maker leaking water?', 'a' => 'Leaks are typically caused by a cracked water inlet valve, a faulty water level sensor, or a clogged drain line. We identify the leak source and replace the failed component with genuine Monogram parts.' ),
            array( 'q' => 'My Monogram ice maker is making ice but it tastes bad — why?', 'a' => 'Off-tasting ice is usually caused by a clogged or expired water filter, mold in the ice bin, or stale ice. We recommend replacing the water filter every 6 months and deep-cleaning the ice bin annually.' ),
        ),
        'wine-cooler' => array(
            array( 'q' => 'Why is my Monogram wine cooler not cooling?', 'a' => 'Cooling failures in Monogram wine coolers are caused by a dirty condenser, a failed compressor, a faulty thermostat, or a refrigerant leak. We diagnose and service the cooling system to restore precise temperature control.' ),
            array( 'q' => 'My Monogram wine cooler is vibrating excessively — what causes this?', 'a' => 'Excessive vibration can damage wine sediment and is usually caused by worn compressor mounts, a failing fan motor, or the unit sitting on an uneven surface. We inspect and repair the vibration source.' ),
            array( 'q' => 'Can you repair a Monogram dual-zone wine cooler?', 'a' => 'Yes. Our technicians service all Monogram wine cooler models including dual-zone units. Repairs include thermostat replacement, compressor service, fan motor replacement, and control board diagnostics.' ),
        ),
        'hood' => array(
            array( 'q' => 'Why is my Monogram range hood not turning on?', 'a' => 'A hood that won\'t power on is typically caused by a tripped circuit breaker, a failed control board, or a blown fuse in the unit. Our technicians diagnose the electrical circuit and replace the faulty component with genuine Monogram parts.' ),
            array( 'q' => 'Why is my Monogram hood so loud?', 'a' => 'Excessive noise is usually caused by a worn or unbalanced blower wheel, loose housing panels, or a failing blower motor. We inspect the entire blower assembly and replace worn components to restore quiet operation.' ),
            array( 'q' => 'My Monogram hood fan runs but suction is weak — what\'s wrong?', 'a' => 'Weak airflow is most often caused by a clogged grease filter, a blocked exhaust duct, or a failing blower motor. We inspect the full ventilation path and restore proper airflow to factory specifications.' ),
            array( 'q' => 'Can you repair a Monogram hood with a smart/connected control panel?', 'a' => 'Yes. Our technicians service all Monogram hood models including WiFi-connected and app-controlled units. We diagnose control board faults, replace unresponsive panels, and restore smart-home connectivity.' ),
        ),
        'default' => array(
            array( 'q' => 'Do you use genuine Monogram parts?', 'a' => 'Yes. We use only genuine GE Monogram replacement parts to ensure your appliance performs to factory specifications and your warranty remains intact.' ),
            array( 'q' => 'How quickly can you come out for a Monogram appliance repair?', 'a' => 'We offer same-day and next-day appointments in all our service areas. Call us or use the online booking form and we\'ll have a certified technician at your door within 24 hours.' ),
            array( 'q' => 'Do you offer a warranty on your repairs?', 'a' => 'Yes. Every repair includes a 90-day labor warranty. If the same issue returns within 90 days, we come back and fix it free of charge. Parts carry the manufacturer\'s guarantee.' ),
            array( 'q' => 'Are your technicians certified to work on Monogram appliances?', 'a' => 'Our technicians are factory-trained, certified, and regularly updated on the latest Monogram appliance models and repair techniques. They arrive with a fully stocked service vehicle.' ),
            array( 'q' => 'Is your service affiliated with GE Monogram?', 'a' => 'No — we are an independent appliance repair company specializing in Monogram products. We are not affiliated with or endorsed by GE Appliances, LLC. "Monogram" is a registered trademark of GE Appliances used here for identification only.' ),
        ),
    );

    $key = strtolower( $appliance );
    return isset( $all[ $key ] ) ? array_merge( $all[ $key ], $all['default'] ) : $all['default'];
}

function brp_get_blog_topics() {
    return array(
        array( 'slug' => 'dishwasher',   'label' => 'Dishwashers',       'icon' => '🍽️' ),
        array( 'slug' => 'washer',       'label' => 'Washing Machines',  'icon' => '🫧' ),
        array( 'slug' => 'dryer',        'label' => 'Dryers',            'icon' => '🌀' ),
        array( 'slug' => 'refrigerator', 'label' => 'Refrigerators',     'icon' => '🧊' ),
        array( 'slug' => 'oven',         'label' => 'Ovens & Ranges',    'icon' => '🔥' ),
        array( 'slug' => 'cooktop',      'label' => 'Cooktops',          'icon' => '♨️' ),
        array( 'slug' => 'microwave',    'label' => 'Microwaves',        'icon' => '📡' ),
        array( 'slug' => 'freezer',      'label' => 'Freezers',          'icon' => '❄️' ),
        array( 'slug' => 'maintenance',  'label' => 'Maintenance Tips',  'icon' => '🔧' ),
        array( 'slug' => 'error-codes',  'label' => 'Error Code Guides', 'icon' => '⚠️' ),
    );
}

// ============================================================
// CLEAN UP WP HEAD
// ============================================================
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
add_filter( 'the_generator', '__return_false' );

// ============================================================
// ADMIN: CUSTOM META BOX FOR PHONE
// ============================================================
function brp_add_meta_boxes() {
    $screens = array( 'service', 'city', 'error_code', 'recall', 'post', 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box( 'brp_page_meta', 'SEO Settings', 'brp_meta_box_html', $screen, 'side', 'high' );
    }
}
add_action( 'add_meta_boxes', 'brp_add_meta_boxes' );

function brp_meta_box_html( $post ) {
    wp_nonce_field( 'brp_save_meta', 'brp_meta_nonce' );
    $fields = array(
        '_brp_appliance_type' => 'Appliance Type (dishwasher, refrigerator, range, wall-oven, cooktop, speed-oven, ice-maker, wine-cooler)',
        '_brp_error_code'     => 'Error Code (for error_code posts, e.g. E15)',
        '_brp_seo_title'      => 'SEO Title',
        '_brp_meta_desc'      => 'Meta Description',
    );
    foreach ( $fields as $key => $label ) {
        $val = get_post_meta( $post->ID, $key, true );
        echo '<p><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $label ) . '</strong></label><br>';
        if ( $key === '_brp_meta_desc' ) {
            echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="3" style="width:100%">' . esc_textarea( $val ) . '</textarea>';
        } else {
            echo '<input type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" style="width:100%">';
        }
        echo '</p>';
    }
}

function brp_save_meta( $post_id ) {
    if ( ! isset( $_POST['brp_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['brp_meta_nonce'], 'brp_save_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    $text_fields     = array( '_brp_appliance_type', '_brp_error_code', '_brp_seo_title' );
    $textarea_fields = array( '_brp_meta_desc' );
    foreach ( $text_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
        }
    }
    foreach ( $textarea_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
        }
    }
}
add_action( 'save_post', 'brp_save_meta' );

// ============================================================
// SEO: CUSTOM TITLE & META DESCRIPTION
// ============================================================
function brp_document_title_separator( $sep ) {
    return '|';
}
add_filter( 'document_title_separator', 'brp_document_title_separator' );

// Filter document title parts for better keyword-rich titles.
function brp_document_title_parts( $title ) {
    global $post;

    if ( is_front_page() ) {
        $title['title'] = 'Monogram Appliance Repair | Same-Day Service | Certified Technicians';
        unset( $title['tagline'] );
        return $title;
    }

    if ( is_singular() && $post ) {
        $seo_title = get_post_meta( $post->ID, '_brp_seo_title', true );
        if ( $seo_title ) {
            $title['title'] = $seo_title;
        }
    }

    if ( is_post_type_archive( 'service' ) )    $title['title'] = 'Monogram Appliance Repair Services | Monogram Repair Pro';
    if ( is_post_type_archive( 'city' ) )       $title['title'] = 'Monogram Repair Service Areas | Cities We Cover';
    if ( is_post_type_archive( 'error_code' ) ) $title['title'] = 'Monogram Appliance Error Codes | Lookup & Fix Guide';
    if ( is_post_type_archive( 'recall' ) )     $title['title'] = 'Monogram Appliance Recalls | Safety Notices & Updates';

    return $title;
}
add_filter( 'document_title_parts', 'brp_document_title_parts' );

// Generate a meta description for every page type.
function brp_get_auto_meta_description() {
    global $post;

    if ( is_front_page() ) {
        return 'Expert Monogram appliance repair with same-day service in Chicago, Los Angeles, New York, Houston, Miami, and San Francisco. Factory-certified parts, 90-day labor warranty.';
    }

    if ( is_singular() && $post ) {
        $custom = get_post_meta( $post->ID, '_brp_meta_desc', true );
        if ( $custom ) return $custom;

        // Fall back to excerpt or trimmed content
        $excerpt = get_the_excerpt();
        if ( $excerpt ) return wp_trim_words( $excerpt, 30, '.' );

        $content = wp_strip_all_tags( get_the_content() );
        if ( $content ) return wp_trim_words( $content, 30, '.' );
    }

    if ( is_post_type_archive( 'service' ) ) {
        return 'Professional Monogram appliance repair for pro ranges, built-in refrigerators, dishwashers, wall ovens, cooktops, and more. Same-day service with certified technicians.';
    }
    if ( is_post_type_archive( 'city' ) ) {
        return 'Monogram appliance repair available in Chicago, Los Angeles, New York, Houston, Miami, and San Francisco. Fast, reliable service by certified technicians.';
    }
    if ( is_post_type_archive( 'error_code' ) ) {
        return 'Look up Monogram appliance error codes for dishwashers, refrigerators, ranges, wall ovens, and cooktops. Find out what the code means and how to fix it.';
    }
    if ( is_post_type_archive( 'recall' ) ) {
        return 'Stay up to date on official Monogram appliance recalls and safety notices. Check if your appliance model is affected.';
    }
    if ( is_home() || is_category() || is_tag() ) {
        return 'Monogram appliance repair tips, maintenance guides, and error code explanations from our certified technicians.';
    }

    return '';
}

function brp_output_seo_meta() {
    global $post;

    $desc      = brp_get_auto_meta_description();
    $site_name = get_bloginfo( 'name' );
    $site_url  = home_url();

    // Canonical URL
    $canonical = '';
    if ( is_singular() ) {
        $canonical = get_permalink();
    } elseif ( is_post_type_archive() ) {
        $canonical = get_post_type_archive_link( get_post_type() );
    } elseif ( is_front_page() ) {
        $canonical = $site_url . '/';
    } elseif ( is_home() ) {
        $page = get_option( 'page_for_posts' );
        $canonical = $page ? get_permalink( $page ) : $site_url . '/blog/';
    }

    // Page title for OG
    $og_title = '';
    if ( is_singular() && $post ) {
        $seo_title = get_post_meta( $post->ID, '_brp_seo_title', true );
        $og_title  = $seo_title ?: get_the_title( $post->ID );
    }
    if ( ! $og_title ) {
        $parts    = wp_get_document_title();
        $og_title = $parts ?: $site_name;
    }

    // Output
    if ( $desc ) {
        echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
    }
    if ( $canonical ) {
        echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
    }
    echo '<meta property="og:type" content="' . ( is_singular() ? 'article' : 'website' ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
    if ( $og_title ) {
        echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">' . "\n";
    }
    if ( $desc ) {
        echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
    }
    if ( $canonical ) {
        echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . "\n";
    }
    // Featured image for OG
    if ( is_singular() && $post && has_post_thumbnail( $post->ID ) ) {
        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'brp-appliance' );
        if ( $img ) {
            echo '<meta property="og:image" content="' . esc_url( $img[0] ) . '">' . "\n";
            echo '<meta property="og:image:width" content="' . esc_attr( $img[1] ) . '">' . "\n";
            echo '<meta property="og:image:height" content="' . esc_attr( $img[2] ) . '">' . "\n";
        }
    }
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action( 'wp_head', 'brp_output_seo_meta', 2 );

// ============================================================
// SEO: SECURITY HEADERS
// ============================================================
add_action( 'send_headers', function() {
    if ( ! is_admin() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
        header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
    }
} );

// ============================================================
// SEO: DEFER MAIN JS
// ============================================================
add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
    if ( $handle === 'brp-main' ) {
        return '<script src="' . esc_url( $src ) . '" defer></script>' . "\n";
    }
    return $tag;
}, 10, 3 );

// ============================================================
// SEO: rel="noopener noreferrer" ON EXTERNAL LINKS IN CONTENT
// ============================================================
add_filter( 'the_content', function( $content ) {
    return preg_replace_callback(
        '/<a\s([^>]*?)>/i',
        function( $matches ) {
            $attrs = $matches[1];
            // Only touch links that open in a new tab
            if ( stripos( $attrs, 'target="_blank"' ) === false ) {
                return $matches[0];
            }
            // Add or normalise rel
            if ( preg_match( '/rel=["\']([^"\']*)["\']/', $attrs, $rel_match ) ) {
                $rel_val  = $rel_match[1];
                $new_rel  = implode( ' ', array_unique( array_merge(
                    explode( ' ', $rel_val ),
                    array( 'noopener', 'noreferrer' )
                ) ) );
                $attrs = preg_replace( '/rel=["\'][^"\']*["\']/', 'rel="' . $new_rel . '"', $attrs );
            } else {
                $attrs .= ' rel="noopener noreferrer"';
            }
            return '<a ' . $attrs . '>';
        },
        $content
    );
} );

// ============================================================
// TEMPORARY SETUP TRIGGER — REMOVE AFTER RUNNING ONCE
// ============================================================
add_action('init', function() {
    if (isset($_GET['brp_setup']) && current_user_can('manage_options')) {
        include get_template_directory() . '/inc/setup-pages.php';
        exit;
    }
}, 99);

// ============================================================
// AUTO-CREATE ERROR CODE APPLIANCE PAGES IF MISSING
// ============================================================
add_action( 'init', function() {
    // Run only once per day, only in front-end or admin
    if ( get_transient( 'brp_ec_pages_checked_v2' ) ) return;
    set_transient( 'brp_ec_pages_checked_v2', 1, DAY_IN_SECONDS );

    $ec_hub = get_page_by_path( 'error-codes' );
    if ( ! $ec_hub ) {
        // Create the hub page first
        $hub_id = wp_insert_post( array(
            'post_title'   => 'Error Codes',
            'post_name'    => 'error-codes',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ) );
        if ( ! is_wp_error( $hub_id ) ) {
            update_post_meta( $hub_id, '_wp_page_template', 'page-templates/template-error-codes-hub.php' );
            $ec_hub = get_post( $hub_id );
        }
    }

    if ( ! $ec_hub ) return;

    $appliances = array(
        'dishwasher'   => 'Monogram Dishwasher Error Codes',
        'washer'       => 'Monogram Washer Error Codes',
        'dryer'        => 'Monogram Dryer Error Codes',
        'refrigerator' => 'Monogram Refrigerator Error Codes',
        'oven'         => 'Monogram Oven &amp; Range Error Codes',
        'cooktop'      => 'Monogram Cooktop Error Codes',
        'microwave'    => 'Monogram Microwave Error Codes',
        'freezer'      => 'Monogram Freezer Error Codes',
    );

    foreach ( $appliances as $slug => $title ) {
        // Check if sub-page already exists under the hub
        $existing = get_page_by_path( 'error-codes/' . $slug );
        if ( $existing ) continue;

        // Also check if a top-level page with this slug exists
        $top_level = get_page_by_path( $slug );
        if ( $top_level && (int) $top_level->post_parent === (int) $ec_hub->ID ) continue;

        $page_id = wp_insert_post( array(
            'post_title'   => html_entity_decode( $title ),
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_parent'  => (int) $ec_hub->ID,
        ) );

        if ( ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', 'page-templates/template-error-codes-appliance.php' );
        }
    }

    flush_rewrite_rules();
}, 100 );

// ============================================================
// FAVICON
// Disable WordPress site icon output — favicon handled in header.php
remove_action( 'wp_head', 'wp_site_icon', 99 );
add_filter( 'get_site_icon_url', '__return_empty_string' );

// ============================================================
// DIRECT STYLE + SCRIPT FIXES (bypasses all caching)
// ============================================================
add_action( 'wp_head', function() {
    echo '<style id="brp-fixes">
        /* Phone number in all white-bg sections */
        .sidebar-phone-number { color: #0057a8 !important; }
        .page-hero .btn-secondary,
        .hero .btn-secondary {
            background: #fff !important;
            border-color: #fff !important;
            color: #0057a8 !important;
        }
    </style>';
}, 99 );

add_action( 'wp_footer', function() {
    echo '<script id="brp-fixes-js">
    document.addEventListener("DOMContentLoaded", function() {
        /* Hide most-searched placeholder when no real data */
        document.querySelectorAll(".ec-cat-most").forEach(function(el) {
            if (el.style.visibility === "hidden" || el.textContent.trim() === "\u2014" || el.textContent.trim() === "-") {
                el.style.display = "none";
            }
        });
    });
    </script>';
}, 99 );
