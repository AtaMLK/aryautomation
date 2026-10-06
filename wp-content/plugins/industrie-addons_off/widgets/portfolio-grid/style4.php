<?php
use Elementor\Icons_Manager;

$cat = $settings['portfolio_category'];
$select_portfolio = $settings['select_portfolio_item'];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$icon_image = $settings['icon_image_show_hide'];

if (empty($cat)) {
	$best_wp = new wp_Query(array(
		'post_type'      => 'portfolios',
		'posts_per_page' => $settings['per_page'],
		'post__in' => $select_portfolio,
		'orderby' => 'menu_order',
		'order' 			=> $settings['pre_posts_sort'],
	));
} else {
	$best_wp = new wp_Query(array(
		'post_type'      => 'portfolios',
		'posts_per_page' => $settings['per_page'],
		'orderby' => 'menu_order',
		'post__in' => $select_portfolio,
		'order' 			=> $settings['pre_posts_sort'],
		'tax_query'      => array(
			array(
				'taxonomy' => 'portfolio-category',
				'field'    => 'slug', //can be set to ID
				'terms'    => $cat //if field is ID you can reference by cat/term number
			),
		)
	));
}

$x = 1;

while ($best_wp->have_posts()) : $best_wp->the_post();

	$content       = get_the_content();
	$column_cl = get_post_meta( get_the_ID(), 'portfolios_column', true);
	$cats_show = get_the_term_list($best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');

	if(isset($column_cl) && !empty($column_cl)) {
		$col_class = $column_cl;
	} else {
		$col_class = $settings['portfolio_columns'];
	}

?>
	<div class="col-lg-<?php echo esc_html($col_class); ?> col-md-<?php echo esc_html($settings['portfolio_md_columns']); ?> col-xs-1 grid-item col-sm-<?php echo esc_html($settings['portfolio_sm_columns']); ?>">
		<div class="portfolio-item content-overlay rsportfolio-grid-style4">
			<?php if (has_post_thumbnail()) : ?>
				<a href="<?php the_permalink(); ?>">
					<div class="portfolio-img">
						<?php if(isset($column_cl) && !empty($column_cl)) { ?>
							<?php the_post_thumbnail("898x450");
							?>
						<?php } else { ?>
							<?php the_post_thumbnail($settings['thumbnail_size']); ?>
						<?php } ?>
					</div>
				</a>
			<?php endif; ?>

			<div class="portfolio-details">
				<?php if ('yes' == $settings['show_count']) { ?>
					<div class="count_number">
						<?php echo sprintf("%02d", $x); ?>
					</div>
				<?php } ?>
				<div class="portfolio-title-cat">
					<?php if (get_the_title()) : ?>
						
						<h4 class="p-title">
							<a href="<?php the_permalink() ?>">
								<?php the_title(); ?>
							</a>
						</h4>
						
					<?php endif; ?>
					<p class="p-category"><?php echo wp_kses_post($cats_show); ?></p>
				</div>
				<?php if ('yes' == $settings['show_button']) { ?>
					<div class="p-icon">
						<a href="<?php the_permalink(); ?>" class="prs_btn">
							<?php
								if (!empty($settings['read_more_text'])) {
									echo esc_html($settings['read_more_text']);
								}
							?>
							<em>
								<?php if (!empty($settings['read_more_icon']['value'])) : ?>
									<?php \Elementor\Icons_Manager::render_icon($settings['read_more_icon'], ['aria-hidden' => 'true']); ?>
								<?php endif; ?>
								<?php if (!empty($settings['read_more_icon']['value'])) : ?>
									<?php \Elementor\Icons_Manager::render_icon($settings['read_more_icon'], ['aria-hidden' => 'true']); ?>
								<?php endif; ?>
							</em>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
	$x++;
endwhile;
wp_reset_query();