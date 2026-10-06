<?php
	$product_type = get_theme_mod('industrie_woo_product_type') ? get_theme_mod('industrie_woo_product_type') : 'default_style';

	if ('default_style' == $product_type ) {
		$btn_text = get_theme_mod('wc_btn_txt') ? get_theme_mod('wc_btn_txt') : 'Add to cart';
	} else {
		$btn_text = get_theme_mod('wc_btn_txt') ? get_theme_mod('wc_btn_txt') : 'Read More';
	}
?>
<div class="product-list">
 	<div class="single-details">
 		<div class="images-product">
			<a href="<?php echo get_the_permalink(); ?>">
				<?php
					global $product;
					global $industrie_option;
					woocommerce_show_product_loop_sale_flash();
					woocommerce_template_loop_product_thumbnail();
				?>
			</a>
			<div class="overley">
				<div class="winners-details">
					<div class="product-info">
						<ul>			
							<li>
								<?php if ('default_style' !== $product_type ) { ?>
									<a href="<?php echo get_the_permalink(); ?>"><?php echo esc_html( $btn_text ); ?></a>
								<?php } else { ?>
									<a href="<?php echo esc_url($product->add_to_cart_url())?>"><?php echo esc_html( $btn_text ); ?></a>
								<?php } ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>