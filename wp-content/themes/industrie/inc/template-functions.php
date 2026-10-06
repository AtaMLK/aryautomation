<?php
/**
 * @author  rs-theme
 */
function industrie_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'industrie_body_classes' );


function rs__reading_times_grids() {
    $post = get_post();
    $words = count(preg_split('/\s+/', strip_tags( $post->post_content )));
    $minutes = floor( $words / 800 );
    $seconds = floor( $words % 800 / ( 800 / 60 ) );
    if ( 1 <= $minutes ) {
        $rs__time = ($minutes == 1 ? '': $minutes . '' ) . ' '. ($seconds == 1 ? '' :  $seconds . '' );
    } else {
        $rs__time = $seconds . '';
    }
    return $rs__time;
}



/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function industrie_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'industrie_pingback_header' );

/**  kses_allowed_html */

function industrie_prefix_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'industrie': 
      $tags = array( 
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default: 
      return $tags;
  }
}

add_filter( 'wp_kses_allowed_html', 'industrie_prefix_kses_allowed_html', 10, 2);

function industrie_get_postTitleArray($postType = 'post' ) {
    $post_type_query  = new WP_Query(
        array (
            'post_type'      => $postType,
            'posts_per_page' => -1
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // the key equals the ID, the value is the post_title
    if ( is_array($posts_array) ) {
        $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID' );
    }else {
      $post_title_array['default'] = esc_html__( 'Default', 'industrie' );
    }
    return $post_title_array;
}

function industrie_studio_fonts_url() {
    $font_url = '';    
    $industrie_body_font = get_theme_mod('industrie_body_font', 'Arial, sans-serif');
    $industrie_header_font = get_theme_mod('industrie_header_font', 'Arial, sans-serif');
    $industrie_heading_font = get_theme_mod('industrie_heading_font', 'Arial, sans-serif');
    $industrie_h1_font = get_theme_mod('industrie_h1_font', 'Arial, sans-serif');
    $industrie_h2_font = get_theme_mod('industrie_h2_font', 'Arial, sans-serif');
    $industrie_h3_font = get_theme_mod('industrie_h3_font', 'Arial, sans-serif');
    $industrie_h4_font = get_theme_mod('industrie_h4_font', 'Arial, sans-serif');
    $industrie_h5_font = get_theme_mod('industrie_h5_font', 'Arial, sans-serif');
    $industrie_h6_font = get_theme_mod('industrie_h6_font', 'Arial, sans-serif');

    $font_families = array();

    if ( $industrie_body_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_body_font;
    }

    if ( $industrie_header_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_header_font;
    }

    if ( $industrie_heading_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_heading_font;
    }

    if ( $industrie_h1_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_h1_font;
    }

    if ( $industrie_h2_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_h2_font;
    }

    if ( $industrie_h3_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_h3_font;
    }

    if ( $industrie_h4_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_h4_font;
    }

    if ( $industrie_h5_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_h5_font;
    }

    if ( $industrie_h6_font !== 'Arial, sans-serif' ) {
        $font_families[] = $industrie_h6_font;
    }

    if ( ! empty( $font_families ) ) {
        $font_url = add_query_arg( 'family', urlencode( implode( '|', $font_families ) . ':400,500,600,700&display=swap' ), "//fonts.googleapis.com/css" );
    } else {
        $font_url = add_query_arg( 'family', urlencode( 'Space Grotesk:400,500,600,700&display=swap' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

/*
Enqueue scripts and styles.
*/

function industrie_studio_scripts() {
    wp_enqueue_style( 'studio-fonts', industrie_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'industrie_studio_scripts' );

//Favicon Icon
function industrie_site_icon() {
    if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {          
    if(!empty(get_theme_mod('industrie_favicon')))
    {?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(get_theme_mod('industrie_favicon')); ?>"> 
  <?php 
    }
  }
}
add_filter('wp_head', 'industrie_site_icon');

//excerpt for specific section
function industrie_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'read more', 'industrie' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'industrie_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'industrie_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  // Get post ID
  $post_id = $post->ID;

  // Check for custom excerpt
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  }
  // No custom excerpt...so lets generate one
  else {
    // Readmore link
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';
    // Check for more tag and return content if it exists
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }
    // No more tag defined so generate excerpt using wp_trim_words
    else {
      // Generate excerpt
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );
      // Add readmore to excerpt if enabled
      if ( $readmore ) {
        $output .= apply_filters( 'industrie_wpex_readmore_link', $readmore_link );
      }

    }

  }
  // Apply filters and echo
  return apply_filters( 'industrie_wpex_get_excerpt', $output );
}


function industrie_import_files() {
    return array(

        // Industry Main Demo

        array(
          'import_file_name'           => 'Industry Main',
          'categories'                 => array( 'Multipages', 'Industry' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/main/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/main',    
        ),           

        // Industry Main One Demo

        array(
          'import_file_name'           => 'Industry Main Onepage',
          'categories'                 => array( 'Onepages', 'Industry', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/main/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/main/onepage',    
        ),           


        // Oil Demo

        array(
          'import_file_name'           => 'Oil Or Gas',
          'categories'                 => array( 'Multipages', 'Oil/Gas' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/oil/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/oil/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/oil/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/oil/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/oil',    
        ),          

        // Oil Demo Onepage

        array(
          'import_file_name'           => 'Oil Or Gas Onepage',
          'categories'                 => array( 'Onepages', 'Oil/Gas', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/oil/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/oil/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/oil/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/oil/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/oil/onepage',    
        ),              


        // energy Demo

        array(
          'import_file_name'           => 'Solar Energy',
          'categories'                 => array( 'Multipages', 'Solar Energy' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/energy/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/energy/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/energy/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/energy/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/energy',    
        ),   
                

        // energy Demo Onepage

        array(
          'import_file_name'           => 'Solar Energy Onepage',
          'categories'                 => array( 'Onepages', 'Solar Energy', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/energy/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/energy/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/energy/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/energy/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/energy/onepage',    
        ),   
        

        // Laboratory Demo

        array(
          'import_file_name'           => 'Laboratory',
          'categories'                 => array( 'Multipages', 'Laboratory' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/laboratory/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/laboratory/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/laboratory/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/laboratory/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/laboratory',    
        ),        


        // Laboratory Demo Onepage

        array(
          'import_file_name'           => 'Laboratory Onepage',
          'categories'                 => array( 'Onepages', 'Laboratory', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/laboratory/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/laboratory/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/laboratory/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/laboratory/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/laboratory/onepage',    
        ),


        // manufacturing Demo

        array(
          'import_file_name'           => 'Manufacturing',
          'categories'                 => array( 'Multipages', 'Manufacturing'),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/manufacturing/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/manufacturing/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/manufacturing/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/manufacturing/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/manufacturing',    
        ),           


        // manufacturing Demo Onepage

        array(
          'import_file_name'           => 'Manufacturing Onepage',
          'categories'                 => array( 'Onepages', 'Manufacturing', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/manufacturing/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/manufacturing/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/manufacturing/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/manufacturing/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/manufacturing/onepage',    
        ),         


        // robotic Demo

        array(
          'import_file_name'           => 'Robotic',
          'categories'                 => array( 'Multipages', 'Robotic' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/robotic/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/robotic/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/robotic/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/robotic/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/robotic',    
        ),            

        // robotic Demo Onepage

        array(
          'import_file_name'           => 'Robotic Onepage',
          'categories'                 => array( 'Onepages', 'Robotic', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/robotic/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/robotic/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/robotic/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/robotic/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/robotic/onepage',    
        ),            


        // factory Demo

        array(
          'import_file_name'           => 'Factory',
          'categories'                 => array( 'Multipages', 'Factory' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/factory/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/factory/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/factory/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/factory/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/factory',    
        ),           


        // factory Demo Onepage

        array(
          'import_file_name'           => 'Factory Onepage',
          'categories'                 => array( 'Onepages', 'Factory', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/factory/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/factory/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/factory/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/factory/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/factory/onepage',    
        ),        

        // metallurgy Demo

        array(
          'import_file_name'           => 'Metallurgy',
          'categories'                 => array( 'Multipages', 'Metallurgy' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/metallurgy/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/metallurgy/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/metallurgy/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/metallurgy/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/metallurgy',    
        ),            

        // metallurgy Demo Onepage

        array(
          'import_file_name'           => 'Metallurgy Onepage',
          'categories'                 => array( 'Onepages', 'Metallurgy', 'Onepage'),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/metallurgy/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/metallurgy/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/metallurgy/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/metallurgy/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/metallurgy/onepage',    
        ),             

        // architecture Demo

        array(
          'import_file_name'           => 'Architecture',
          'categories'                 => array( 'Multipages', 'Architecture' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/architecture/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/architecture/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/architecture/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/architecture/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/architecture',    
        ),            


        // architecture Demo Onepage

        array(
          'import_file_name'           => 'Architecture Onepage',
          'categories'                 => array( 'Onepages', 'Architecture', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/architecture/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/architecture/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/architecture/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/architecture/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/architecture/onepage',    
        ),         


        // construction Demo

        array(
          'import_file_name'           => 'Construction Orange Demo',
          'categories'                 => array( 'Multipages', 'Construction Orange', 'Construction' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/construction/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/construction/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/construction/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/construction/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/construction',    
        ),            


        // Construction Demo Onepage

        array(
          'import_file_name'           => 'Construction Orange Onepage',
          'categories'                 => array( 'Onepages', 'Construction Orange', 'Construction', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/construction/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/construction/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/construction/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/construction/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/construction/onepage',    
        ),     
        

        // RTL Demo

        array(
          'import_file_name'           => 'Main Demo RTL',
          'categories'                 => array( 'Main Demo RTL', 'RTL Demo' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main-rtl/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main-rtl/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main-rtl/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/main-rtl/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/main-rtl',    
        ),            


        // RTL Demo Onepage

        array(
          'import_file_name'           => 'Main Demo RTL Onepage',
          'categories'                 => array( 'Main Demo RTL', 'RTL Demo', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main-rtl/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main-rtl/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/main-rtl/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/main-rtl/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/main-rtl/onepage',    
        ),        

        // Construction Blue Demo

        array(
          'import_file_name'           => 'Construction Blue Demo',
          'categories'                 => array( 'Construction Blue', 'Blue Demo', 'Construction' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/blue-construction/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/blue-construction/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/blue-construction/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/blue-construction/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/construction2025',    
        ),            


        // RTL Demo Onepage

        array(
          'import_file_name'           => 'Construction Blue Onepage Demo ',
          'categories'                 => array( 'Construction Blue', 'Blue Demo', 'Construction', 'Onepage' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/blue-construction/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/blue-construction/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/blue-construction/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/blue-construction/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/construction2025/onepage',    
        ),         


        // Red Engineering Demo

        array(
          'import_file_name'           => 'Red Engineering Demo',
          'categories'                 => array( 'Red Engineering', 'Red Demo', 'Engineering' ),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/red-engineering/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/red-engineering/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/red-engineering/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/red-engineering/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/engineering',    
        ),            


        // Red Engineering Onepage

        array(
          'import_file_name'           => 'Red Engineering Onepage Demo ',
          'categories'                 => array( 'Red Engineering', 'Red Demo', 'Engineering', 'Onepage'),
          'import_file_url'            => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/red-engineering/industrie-content.xml',
          'import_widget_file_url'     => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/red-engineering/industrie-widgets.wie',  
          'import_customizer_file_url' => 'https://demo.rstheme.com/wordpress/demo-data/industrie/data/red-engineering/industrie-customizer.dat',     
          'import_preview_image_url'   => 'https://demo.rstheme.com/wordpress/demo-data/industrie/screens/red-engineering/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'industrie' ),
           'preview_url'                => 'https://industrie.rstheme.com/engineering/onepage',    
        ), 

    );
}

add_filter( 'pt-ocdi/import_files', 'industrie_import_files' );


function industrie_set_import_id(){
    if(isset( $_GET['import'] )) {
        $import_demo_id =(int) $_GET['import'];
        unset($_COOKIE['import_id']);
        if(!isset($_COOKIE['import_id'])) {
            setcookie('import_id', $import_demo_id, time()+3600); 
        }  
    }
}  

add_action( 'init', 'industrie_set_import_id');

function industrie_after_import_setup() {
  // Assign menus to their locations.
    $main_menu       = get_term_by( 'name', 'Main Menu', 'nav_menu' ); 
    $mobile_menu     = get_term_by( 'name', 'Responsive Menu', 'nav_menu' ); 
    $single_menu     = get_term_by( 'name', 'Onepage Menu', 'nav_menu' ); 

    set_theme_mod( 'nav_menu_locations', array(
          'menu-1' => $main_menu->term_id,        
          'menu-2' => $mobile_menu->term_id,        
          'menu-3' => $single_menu->term_id        
        )
    );


    if(isset($_COOKIE['import_id'])) {

        $selected= (int)$_COOKIE['import_id'];

        if($selected==0 || $selected==2 || $selected==4 || $selected==6 || $selected==8 || $selected==10 || $selected==12 || $selected==14 || $selected==16 || $selected==18 || $selected==20 || $selected==22 || $selected==24){
            $front_page_id = get_page_by_title( 'Home' ); 
        } else{
            $front_page_id = get_page_by_title( 'Onepage' ); 
        }

        $blog_page_id  = get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );


        if(class_exists('RevSlider'))
        {
            if($selected==0 || $selected==1) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/main-industry.zip");
                ob_get_clean();
            }  

            if($selected==2 || $selected==3) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/oil-gas.zip");
                ob_get_clean();
            }  

            if($selected==6 || $selected==7) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/laboratory.zip");
                ob_get_clean();
            } 


             if($selected==8 || $selected==9) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/manufacture.zip");
                ob_get_clean();
            }

            if($selected==10 || $selected==11) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/robotic.zip");
                ob_get_clean();
            }

            if($selected==12 || $selected==13) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/factory.zip");
                ob_get_clean();
            }
   
            if($selected==14 || $selected==15) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/metallurgy.zip");
                ob_get_clean();
            }              

            if($selected==16 || $selected==17) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/architecture.zip");
                ob_get_clean();
            }              

            if($selected==18 || $selected==19) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/construction.zip");
                ob_get_clean();
            }             

            if($selected==20 || $selected==21) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/main-industry-rtl.zip");
                ob_get_clean();
            }  

            if($selected==24 || $selected==25) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/engineering.zip");
                ob_get_clean();
            }  
           
        }


        if($selected==0 || $selected==1) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/main/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        

        if($selected==2 || $selected==3) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/oil/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        


        if($selected==4 || $selected==5) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/energy/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        

        if($selected==6 || $selected==7) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/labratory/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        

        if($selected==8 || $selected==9) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/manufacturing/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        


        if($selected==10 || $selected==11) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/robotic/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        

        if($selected==12 || $selected==13) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/factory/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        


        if($selected==14 || $selected==15) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/metallurgy/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        


        if($selected==16 || $selected==17) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/architecture/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        


        if($selected==18 || $selected==19) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/construction/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        


        if($selected==20 || $selected==21) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/main-rtl/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        


        if($selected==22 || $selected==23) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/blue-construction/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }        

        if($selected==24 || $selected==25) {
            $import_kit_zip = get_parent_theme_file_path() . '/ocdi/kits/red-engineering/elementor-kit.zip';
            $import_export_module        = \Elementor\Plugin::$instance->app->get_component( 'import-export' );
            $import_settings['referrer'] = 'remote';
            $import_export_module->import_kit( $import_kit_zip, $import_settings );
        }

    }
    unset($_COOKIE['import_id']);

}
add_action( 'pt-ocdi/after_import', 'industrie_after_import_setup' );


// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );


/**
 * Mega Menu
 */
add_action('wp_nav_menu_item_custom_fields', function($item_id, $item) {
  $show_rs_mega_class = get_post_meta($item_id, '_show-industrie-as-mega', true);
  ?>
    <p class="industrie-show-as-button description description-wide">
        <label for="industrie-menu-item-btns-<?php echo esc_attr ($item_id); ?>" >
          <input type="checkbox" 
            id="industrie-menu-item-btns-<?php echo esc_attr ($item_id); ?>" 
            name="industrie-menu-item-btns[<?php echo esc_attr ($item_id); ?>]" 
            <?php checked($show_rs_mega_class, true); ?> 
          /><?php echo esc_html__('Check Mega Menu', 'industrie'); ?>
        </label>
    </p>
  <?php
}, 10, 2);

add_action('wp_update_nav_menu_item', function($menu_id, $industrie_menu_item_db_id) {
  $industrie_button_value = (isset($_POST['industrie-menu-item-btns'][$industrie_menu_item_db_id]) && $_POST['industrie-menu-item-btns'][$industrie_menu_item_db_id] === 'on') ? true : false;
  update_post_meta($industrie_menu_item_db_id, '_show-industrie-as-mega', $industrie_button_value);
}, 10, 2);

add_filter('nav_menu_css_class', function($classes, $menu_item) {
    $show_rs_mega_class = get_post_meta($menu_item->ID, '_show-industrie-as-mega', true);
    if ($show_rs_mega_class) {
        $classes[] = 'rs-mega-menu';
    }
    return $classes;
}, 10, 2);

//disable elementor default styles
update_option('elementor_disable_color_schemes', 'yes');
update_option('elementor_disable_typography_schemes', 'yes');

//Check Custom Post Types in Elementor Setting
function industrie_custom_post_type_elementor_support() {
    // Custom post types you want to enable Elementor for
    $post_types = ['page', 'post', 'teams', 'services', 'events', 'portfolios', 'elementor-rshf']; // Replace with your CPT slugs
    // Merge existing supported post types with your custom post types
    $elementor_support = array_merge( get_option( 'elementor_cpt_support', [] ), $post_types );
    // Update Elementor supported post types option
    update_option( 'elementor_cpt_support', $elementor_support );
}
add_action( 'init', 'industrie_custom_post_type_elementor_support' );

$licenseKey  = get_option("IndustrieWordPressTheme_lic_Key","");
if(empty($licenseKey)) :
    add_action( 'admin_notices', 'industrie_admin_notice__success');
    function industrie_admin_notice__success() {?>
        <div class="industrie-notice notice notice-theme is-dismissible">
            <div class="industrie-notice-intro">The Industrie Theme must need to activate the purchase code. Without activation you will miss more features of the theme.  <a href="<?php echo esc_url(get_admin_url())?>/admin.php?page=industrie">Active Now!</a></div>
        </div>
        <?php 
    } 
endif;