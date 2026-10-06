<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
global $industrie_option;
$industrie_shop_layouts = get_theme_mod('industrie_shop_page_sidebar_setting');
$industrie_shop_layouts = $industrie_shop_layouts ? $industrie_shop_layouts : '';

$product_type = get_theme_mod('industrie_woo_product_type') ? get_theme_mod('industrie_woo_product_type') : 'default_style';

// Layout class
$mevim_layout_class = 'col-sm-12 col-xs-12';
if(!empty( $industrie_shop_layouts )) {
	if ( 'shop_no_sidebar' == $industrie_shop_layouts ) {
		$mevim_layout_class = 'col-sm-12 col-xs-12';
	}
	elseif( ($industrie_shop_layouts == 'shop_left_sidebar') || ($industrie_shop_layouts == 'shop_right_sidebar') ){
		$mevim_layout_class = 'col-md-8 col-xs-12';
	}
	else{
		$mevim_layout_class = 'col-sm-12 col-xs-12';
	}
}
?>

<div class="container">
	<div id="content" class="site-content rswooproduct_<?php echo esc_attr( $product_type ); ?>">		
		<div class="row">
			<?php
				if(!empty($industrie_shop_layouts) && is_product()){
					?>
					<div class="col-sm-12 col-xs-12">
					    <?php					
							woocommerce_content();						
						?>
					</div>
					<?php
				}else{				
					if ( $industrie_shop_layouts == 'shop_left_sidebar'  ) {
						get_sidebar('woocommerce');
					}
					?>    			
				    <div class="<?php echo esc_attr($mevim_layout_class);?>">
					    <?php					
							woocommerce_content();						
		   				 ?>
				    </div>
					<?php
					if ( $industrie_shop_layouts == 'shop_right_sidebar'  ) {
						get_sidebar('woocommerce');
					}	
				}
			?>
		</div>
	</div>
</div>
<?php
get_footer();