<?php
namespace RSHFE\WidgetsManager\Widgets;
/**
 * @author  rs-theme
 * @since   1.0.0
 * @version 1.0.0 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<!--Preloader start here-->
<?php
	if( is_404() ){
		return;
	} else {
    get_template_part( 'inc/header/preloader' ); 
	}
?>

<div class="rs-offcanvas-area">
	<div class="rsoffwrap"></div>
	<!-- Canvas Menu start -->
	<nav class="right_menu_togle">	
		<div class="rsoffwrap-close"> <i class="ri-close-line"></i> </div>

		<?php 
			if(!empty(get_theme_mod('industrie_mobile_sidebar_logo_image'))){
				if(!empty(get_theme_mod('mobile_sidebar_logo_enable_disable'))){
					$mobile_menu_logo_height    = !empty(get_theme_mod('industrie_mobile_sidebar_logo_image_height')) ? 'style = "width: auto; height: '.get_theme_mod('industrie_mobile_sidebar_logo_image_height').';"' : '';
					$mobile_menu_logo_margin_bottom    = !empty(get_theme_mod('industrie_mobile_sidebar_logo_margin_bottom')) ? 'style = "margin-bottom: '.get_theme_mod('industrie_mobile_sidebar_logo_margin_bottom').';"' : ''; ?>

					<div class="sidebar-mobile-menu-logo" <?php echo wp_kses($mobile_menu_logo_margin_bottom, 'industrie');?>>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img <?php echo wp_kses($mobile_menu_logo_height, 'industrie');?> src="<?php echo esc_url(get_theme_mod('industrie_mobile_sidebar_logo_image')); ?>" alt>
						</a>
					</div>
			<?php }
		} ?>

		<?php if ( is_active_sidebar( 'rs-offcanvas-sidebar' ) ) { ?>    
	    	<div class="rs-desk-off-content"><?php dynamic_sidebar('rs-offcanvas-sidebar'); ?></div>
	    <?php } ?>

	    <?php
	    	$post_id = get_the_ID();
	    	$rs_onepage_post_check = get_post_meta($post_id, 'rs_onepage_post_check', true);

	    	if ( has_nav_menu( 'menu-2' ) || has_nav_menu( 'menu-3' ) ) { ?>
				<nav class="nav navbar">
					<div class="navbar-menu">
						<?php
							if ($rs_onepage_post_check === 'on') {
								if (has_nav_menu( 'menu-3' )) {
									wp_nav_menu( array(
										'theme_location' => 'menu-3',
										'menu_id'        => 'mobile_menu_rstheme',
										'menu_class'     => 'menu rs_onepage_mobile_menu',
									) );
								} else {
									wp_nav_menu( array(
										'theme_location' => 'menu-2',
										'menu_id'        => 'mobile_menu_rstheme',
										'menu_class'     => 'menu rs_mobile_menu',
									) );
								}
								
							} else {
								wp_nav_menu( array(
									'theme_location' => 'menu-2',
									'menu_id'        => 'mobile_menu_rstheme',
									'menu_class'     => 'menu rs_mobile_menu',
								) );
							}
						?>
					</div>
				</nav>
	    <?php } ?>  
	</nav>
</div>

<div id="page" class="hfeed site">
<?php 
$sticky = !empty(get_theme_mod('industrie_enable_sticky_menu')) ? 'rs-enable-sticky' : ''; 
$auto_margin = !empty(get_theme_mod('industrie_header_auto_margin_top_off')) ? 'auto-margin-off' : ''; 
if( is_404() ){
	return;
} else {

	?>
	<header id="rs-header" class="single-header <?php echo esc_attr($sticky); ?> <?php echo esc_attr($auto_margin); ?>">
	    <div class="header-inner">
	    	<?php
	    		do_action( 'hfe_topbar' ); 
				do_action( 'hfe_header' );
			?>
		</div>
		<div id="rs-theme-toggle" class="rs_ld_btn" style="opacity: 0; display: none;">
			<span class="d-block-light"><i class="ri-sun-line"></i></span>
		 	<span class="d-block-dark"><i class="ri-moon-line"></i></span>
		</div>

	</header>
	<?php do_action( 'hfe_header_after' ); ?>
	<?php
}