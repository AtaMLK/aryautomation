<?php 
    $cat = $settings['portfolio_category'];
    $cat_show_hide = $settings['cat_show_hide'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(empty($cat)){
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],								
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],				
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

		$termsArray  = get_the_terms( $best_wp->ID, "portfolio-category" );  //Get the terms for this particular item
		$termsString = ""; //initialize the string that will contain the terms
		$termsSlug   = "";

		foreach ( $termsArray as $term ) { 
			$termsString .= 'filter_'.$term->slug.' '; 
			$termsSlug .= $term->name;
		}
		
		$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');	
	?>	
	<div class="col-lg-<?php echo esc_html($settings['portfolio_columns']);?> col-md-6 grid-item <?php echo $termsString;?>">
			<div class="portfolio-item content-overlay">
				<?php if(has_post_thumbnail()): ?>
                    <div class="portfolio-img">
                    	<a href="<?php the_permalink();?>"><?php  the_post_thumbnail($settings['thumbnail_size']);?></a>
                    </div>
                <?php endif;?>
                <div class="portfolio-content">
                    <div class="portfolio-inner">
						<?php if($cat_show_hide == 'yes') : ?>
                    		<?php if('bottom' !== $settings['categorie_position']){ ?>
                        		<p class="p-category"><?php echo wp_kses_post($cats_show); ?></p>
                        	<?php } ?>
							<?php endif;?>
                        	<?php if(get_the_title()):?>
                        		<h3 class="p-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        	<?php endif;?>
							<?php if($cat_show_hide == 'yes') : ?>
                        	<?php if('bottom' == $settings['categorie_position']){ ?>
                        		<p class="p-category"><?php echo wp_kses_post($cats_show); ?></p>
                        	<?php } ?>
							<?php endif;?>
							<p><?php the_excerpt();?></p>
							<div class="portfolio-read-more">
								<a href="<?php the_permalink();?>" class="portfolio-btn"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none"><path d="M16.1421 1C16.1421 0.447715 15.6944 2.55533e-07 15.1421 2.55533e-07L6.14214 2.55533e-07C5.58985 2.55533e-07 5.14214 0.447715 5.14214 1C5.14214 1.55228 5.58985 2 6.14214 2H14.1421V10C14.1421 10.5523 14.5899 11 15.1421 11C15.6944 11 16.1421 10.5523 16.1421 10L16.1421 1ZM1.70711 15.8492L15.8492 1.70711L14.435 0.292893L0.292893 14.435L1.70711 15.8492Z" fill="#212020"></path></svg></a>
							</div>
                    </div>
                </div>
            </div>
		</div>
	<?php	
	endwhile;
	wp_reset_query();