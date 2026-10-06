<?php


if ( ! function_exists( 'industrie_setup' ) ) :

define( 'INDUSTRIE_THEME_DIR', get_template_directory() );
define( 'INDUSTRIE_THEME_URI', get_template_directory_uri() );
define( 'INDUSTRIE_THEME_SUB_DIR', INDUSTRIE_THEME_DIR.'/inc/' );
define( 'INDUSTRIE_THEME_CSS_DIR', INDUSTRIE_THEME_URI.'/css/' );
define( 'INDUSTRIE_THEME_JS_DIR', INDUSTRIE_THEME_URI.'/js/' );

function industrie_setup() {
	load_theme_textdomain( 'industrie', get_template_directory() . '/languages' );


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );	

	function industrie_change_excerpt( $text )
	{
		$pos = strrpos( $text, '[');
		if ($pos === false)
		{
			return $text;
		}

		return rtrim (substr($text, 0, $pos) ) . '...';
	}
	add_filter('get_the_excerpt', 'industrie_change_excerpt');


	// Limit Excerpt Length by number of Words
	function industrie_custom_excerpt( $limit ) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
		} else {
		$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
		}
		function content($limit) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
		} else {
		$content = implode(" ",$content);
		}
		$content = preg_replace('/[.+]/','', $content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'industrie' ),		
		'menu-2' => esc_html__( 'Mobile Menu', 'industrie' ),	
		'menu-3' => esc_html__( 'Onepage Menu', 'industrie' ),	
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'industrie_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	//add support posts format
	add_theme_support( 'post-formats', array( 
		'aside', 
		'gallery',
		'audio',
		'video',
		'image',
		'quote',
		'link',
	) );

add_theme_support( 'align-wide' );	
}
endif;
add_action( 'after_setup_theme', 'industrie_setup' );


/**
*Custom Image Size
*/

add_image_size( 'industrie_portfolio-slider', 520, 640, true );
add_image_size( 'industrie_blog-transparent', 700, 600, true );
add_image_size( 'industrie_blog-single', 1200, 630, true );
add_image_size( 'industrie_portfolio-slider-four', 416, 340, true );
add_image_size( 'industrie_service-grid', 352, 199, true );
add_image_size( 'industrie_portfolio-slider', 666, 450, true );
add_image_size( 'industrie_portfolio-grid-large', 834, 550, true );
add_image_size( 'industrie_portfolio-grid2', 434, 450, true );
add_image_size( 'industrie_portfolio-grid-small', 413, 269, true );
add_image_size( 'industrie_portfolio-grid-architecture1', 421, 550, true );
add_image_size( 'industrie_team-member-grid', 414, 500, true );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function industrie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'industrie_content_width', 640 );
}
add_action( 'after_setup_theme', 'industrie_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 *  Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/template-scripts.php';



/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-sidebar.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';


/**
 * Customizer additions.
 */
require_once INDUSTRIE_THEME_SUB_DIR.'/customizer/includes.php';

if (is_admin() && isset($_GET['activated'])){
	wp_redirect(admin_url("themes.php?page=industrie"));
}
if (is_admin()) {	
	require_once get_template_directory() . '/framework/ini/theme-base.php';	
}

$licenseKey = get_option("IndustrieWordPressTheme_lic_Key","");
if (!empty($licenseKey)){
	require_once get_template_directory() . '/framework/custom.php';
	require_once get_template_directory() . '/inc/woocommerce-functions.php';
}
if (is_admin()){
	require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
    require_once get_template_directory() . '/framework/tgm-config.php';
}


/**
 * Registers an editor stylesheet for the theme.
 */
function industrie_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'industrie_theme_add_editor_styles' );


/*------------------------------------------------------------------------
Organize Comments form field
------------------------------------------------------------------------*/
function industrie_wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'industrie_wpb_move_comment_field_to_bottom' );	

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});



function industrie_comment_textarea_placeholder( $args ) {
	$replace_comment = __('Comment*', 'industrie');
	$args['comment_field']        = str_replace( '<textarea', '<textarea placeholder="'.$replace_comment.'"', $args['comment_field'] );
	return $args;
}
add_filter( 'comment_form_defaults', 'industrie_comment_textarea_placeholder' );

/**
 * Comment Form Fields Placeholder
 *
 */
function industrie_comment_form_fields( $fields ) {
	$replace_author = __('Name*', 'industrie');
    $replace_email = __('Email*', 'industrie');
    $website_url = __('Website', 'industrie');
	foreach( $fields as &$field ) {
		$field = str_replace( 'id="author"', 'id="author" placeholder="'.$replace_author.'"', $field );
		$field = str_replace( 'id="email"', 'id="email" placeholder="'.$replace_email.'"', $field );
		$field = str_replace( 'id="url"', 'id="url" placeholder="'.$website_url.'"', $field );
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'industrie_comment_form_fields' );

/**
 * Breadcrumb dizisinden "Arya Automation & Otomasyon Çözümleri" öğesini kaldırır.
 */
add_filter('bcn_after_fill', function($trail) {
    foreach ($trail->breadcrumbs as $key => $crumb) {
        $title = strtolower($crumb->get_title());
        // Breadcrumb'ta göründüğü şekilde, küçük harflerle karşılaştırıyoruz.
        if ($title === 'arya automation & otomasyon çözümleri') {
            unset($trail->breadcrumbs[$key]);
        }
    }
    $trail->breadcrumbs = array_values($trail->breadcrumbs);
    return $trail;
});

/**
 * WooCommerce Ürün Sekmelerini Türkçe'ye Çevir ve Sıralamasını Düzenle
 */
add_filter( 'woocommerce_product_tabs', 'custom_turkish_tabs', 98 );
function custom_turkish_tabs( $tabs ) {

    // Özellikler sekmesi (Description)
    if ( isset( $tabs['description'] ) ) {
        $tabs['description']['title']    = 'Özellikler';
        $tabs['description']['priority'] = 5;  // En düşük değer en üstte
    }

    // Ek Bilgiler sekmesi (Additional Information)
    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title']    = 'Ek Bilgiler';
        $tabs['additional_information']['priority'] = 30;
    }

    // Yorumlar sekmesi (Reviews)
    if ( isset( $tabs['reviews'] ) ) {
        $tabs['reviews']['title']    = 'Yorumlar';
        $tabs['reviews']['priority'] = 35;
    }

    // Eğer sitende ekstra sekme varsa (örneğin 'data_sheet') bunları da ekleyebilirsin:
    /*
    if ( isset( $tabs['data_sheet'] ) ) {
        $tabs['data_sheet']['title']    = 'Veri Sayfası';
        $tabs['data_sheet']['priority'] = 10;
    }
    */

    return $tabs;
}

/**
 * WooCommerce Ürün Meta Alanındaki "Category:" Metinlerini Türkçeleştir
 */
add_filter( 'gettext', 'translate_category_text_turkish', 20, 3 );
function translate_category_text_turkish( $translated_text, $text, $domain ) {
    if ( 'woocommerce' === $domain ) {
        if ( trim( $text ) === 'Category:' ) {
            $translated_text = 'Kategori:';
        } elseif ( trim( $text ) === 'Categories:' ) {
            $translated_text = 'Kategoriler:';
        }
    }
    return $translated_text;
}

/* ---------------
   WHATSAPP BLOĞU KALDIRILDI & FİYATLAR GERİ GETİRİLDİ
   --------------- */

/* Güvenlik için fiyat ve sepete ekle hook'larını tekrar ekleyelim (tema daha önce kaldırmış olabilir) */
add_action('after_setup_theme', function () {
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
}, 20);


function industrie_register_post_type() {
    // 1. Post type tanımı
    register_post_type( 'industrie', [
        'label' => 'Industrie',
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true, // Gutenberg ve Elementor uyumu için
    ] );

    // 2. Elementor desteği sadece 1 kez yazılsın
    if ( get_option( 'industrie_custom_post_type_elementor_support' ) !== true ) {
        update_option( 'industrie_custom_post_type_elementor_support', true );
    }
}
add_action( 'init', 'industrie_register_post_type' );
/**
 * Custom rewrite rule for WooCommerce product_cat archives
 */
function custom_add_product_cat_rewrite() {
    add_rewrite_rule(
        '^urun-kategorileri/([^/]+)/?$',
        'index.php?product_cat=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_add_product_cat_rewrite');
// Tüm tıklamaları JS ile yakala
add_action('wp_footer', function() {
    ?>
    <script>
    document.addEventListener('click', function(e) {
        let target = e.target;

        // En yakın tıklanabilir elementi bul
        let clickable = target.closest('a, button, input[type="submit"]');
        if (!clickable) return;

        let data = {
            action: 'log_site_click',
            tag: clickable.tagName,
            text: clickable.innerText.trim(),
            href: clickable.getAttribute('href') || '',
            page: window.location.href
        };

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(data)
        });
    });
    </script>
    <?php
});

// PHP tarafında click logla
add_action('wp_ajax_log_site_click', 'log_site_click');
add_action('wp_ajax_nopriv_log_site_click', 'log_site_click');
function log_site_click() {
    $file = WP_CONTENT_DIR . '/site_activity.log';
    $time = date("Y-m-d H:i:s");
    $tag  = sanitize_text_field($_POST['tag']);
    $text = sanitize_text_field($_POST['text']);
    $href = sanitize_text_field($_POST['href']);
    $page = sanitize_text_field($_POST['page']);

    $log_line = "[CLICK] $time | $page | $tag | $text | $href\n";
    file_put_contents($file, $log_line, FILE_APPEND);
    wp_die();
}