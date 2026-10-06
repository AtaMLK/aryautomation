<?php 
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

		$portfolio_column  = !empty(get_post_meta( get_the_ID(), 'portfolios_column', true )) ? get_post_meta( get_the_ID(), 'portfolios_column', true ): $settings['portfolio_columns'];

		$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');	
	?>	
	<div class="col-lg-<?php echo esc_html($portfolio_column);?> col-md-6 grid-item <?php echo $termsString;?>">
			<div class="portfolio-item content-overlay">
				<?php if(has_post_thumbnail()): ?>
                    <div class="portfolio-img">
                    	<a href="<?php the_permalink();?>"><?php  the_post_thumbnail($settings['thumbnail_size']);?></a>
                    </div>
                <?php endif;?>
                <div class="portfolio-content">
                	<div class="vertical-middle">
                        <div class="vertical-middle-cell">
		                    <div class="portfolio-inner">
		                    	<?php if(get_the_title()):?>
		                    		<h3 class="p-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		                    	<?php endif;?>
		                    	<p class="p-category"><?php echo wp_kses_post($cats_show); ?></p>
								<a class="arrow-btn" href="<?php the_permalink(); ?>"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.0035 3.40804L1.41153 12L0 10.5885L8.59097 1.99651H1.01922V0H12V10.9808H10.0035V3.40804Z" fill="white"/>
</svg></a>
		                    </div>
	                    </div>
                    </div>
                </div>
            </div>
		</div>
	<?php	
	endwhile;
	wp_reset_query();