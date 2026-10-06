<?php 
	use Elementor\Icons_Manager;
    $cat = $settings['portfolio_category'];
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
	$limit = !empty($settings['content_word_show']) ? $settings['content_word_show'] : 13;
	$content   = get_the_excerpt();
	$trimmed_content = wp_trim_words($content, $limit, '');

	$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');	
	?>	
	<div class="col-lg-<?php echo esc_html($settings['portfolio_columns']);?> col-md-6 grid-item <?php echo $termsString;?>">
		<div class="portfolio-item content-overlay <?php echo $settings['overlay_on_off'];?>">
			<?php if(has_post_thumbnail()): ?>
                <div class="portfolio-img">
                	<a href="<?php the_permalink();?>"><?php  the_post_thumbnail($settings['thumbnail_size']);?></a>
                </div>
            <?php endif;?>
			<?php if($settings['arrow_on_off'] == 'yes') { ?>
			<div class="portfolio-read-more">
				<a  href="<?php the_permalink(); ?>" >
					<?php if(!empty($settings['selected_icon'])){ ?>
					<?php 
					if ( $settings['selected_icon'] ):
						Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); 
					endif; ?>
					<?php }else{ ?>
						<?php if(!empty($settings['selected_icon_image'])) :?>
							<img src="<?php echo esc_url( $settings['selected_icon_image']['url'] );?>" alt="image"/>
						<?php endif;?>
					<?php } ?>
				</a>  
			</div>
			<?php } ?>
            <div class="portfolio-content">
                <div class="portfolio-inner">
                	<?php if(get_the_title()):?>
                		<h3 class="p-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                	<?php endif;?>

                	<?php
                		if($settings['cat_show_off'] == 'yes'){
                			echo '<p class="p-category">' . wp_kses_post($cats_show) . '</p>';
                		}
                	?>
                	<?php
                		 if($settings['content_show_off'] == 'yes' && $content) { 
                        	echo '<p class="desc">' . wp_kses_post($trimmed_content) . '</p>';
                        }
                	?>
                </div>
            </div>
        </div>
	</div>
	<?php	
	endwhile;
	wp_reset_query();

