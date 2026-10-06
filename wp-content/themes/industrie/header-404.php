<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="//gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>    

	<?php 
		if( ! function_exists( 'wp_body_open' ) ) {
		    function wp_body_open() {
		    	do_action( 'wp_body_open' );
		    }
		}
	?> 
     
    <!--Preloader start here-->
    <?php 
        get_template_part( 'inc/header/preloader' );     
    ?> 
    <!--Preloader area end here-->
    <div id="page" class="site">        
        <!-- End Header Menu End -->
        <div class="main-contain offcontents">                