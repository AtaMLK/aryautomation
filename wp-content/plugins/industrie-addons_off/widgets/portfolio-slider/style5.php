<?php 
    $cat = $settings['portfolio_category']; 
    $select_portfolio = $settings['select_portfolio_item'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(empty($cat)){
    	$best_wp = new wp_Query(array(
			'post_type'      => 'portfolios',
			'posts_per_page' => $settings['per_page'],	
			'post__in' => $select_portfolio,						
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],
				'post__in' => $select_portfolio,				
				'tax_query'      => array(
			        array(
						'taxonomy' => 'portfolio-category',
						'field'    => 'slug', //can be set to ID
						'terms'    => $cat //if field is ID you can reference by cat/term number
			        ),
			    )
		));	  
    }

	while($best_wp->have_posts()): $best_wp->the_post();			
		$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');	
		
		$postid = $best_wp->ID;
	?>	

	<div class="grid-item">
		<div class="portfolio-item">
			<?php if(has_post_thumbnail()): ?>
                <div class="portfolio-img">
                	<?php  the_post_thumbnail($settings['thumbnail_size']);?>
					<div class="img-overlay"></div>
                </div>
            <?php endif;?>
			<?php if('yes' == $settings['btn__show_hide']){ ?>
				<div class="p-icon2">
					<a href="<?php the_permalink(); ?>" class="prs_btn">
						<span class="pbtn_icon">
						<?php if(!empty($settings['btn__icon']['value'])) : ?>
							<em class="btn_icon_1"><?php \Elementor\Icons_Manager::render_icon( $settings['btn__icon'], [ 'aria-hidden' => 'true' ] ); ?></em>
						<?php endif; ?>
						</span>
						<span class="pbtn_text">
							<?php 
								if(!empty($settings['btn__title'])) {
									echo esc_html($settings['btn__title']);
								} 
							?>
						</span>
					</a>                        
				</div>
			<?php } ?>
			<div class="portfolio-content">
            	<div class="content-details">
	            	<?php if(get_the_title()):?>
	            		<h4 class="p-title"><?php the_title();?></h4>
	            	<?php endif;?>
					<?php if('yes' == $settings['cat_show_hide']){ ?>
	            		<p class="p-category"><?php echo wp_kses_post($cats_show); ?></p>
					<?php } ?>
	            </div>
            </div>
        </div>
	</div>
	
	<?php	
	endwhile;
	wp_reset_query();  