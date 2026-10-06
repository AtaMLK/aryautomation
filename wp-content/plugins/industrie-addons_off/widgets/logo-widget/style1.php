<?php use Elementor\Utils; ?>
<div class="rs-logo-grid logo-grid-<?php echo esc_attr($settings['logo_grid_style']); ?> <?php echo $clip_path_css; ?> rsl_logo_<?php echo esc_attr($settings['rs_logo_style']); ?>">
    <div class="row">
        <?php
        $logo_count = count($settings['logo_list']);
        $logo_row_count = $settings['columns'] + 1;

        $row_num = $logo_count / ($logo_row_count);
        $i = 0;
        $grid_columns_md = !empty($settings['grid_columns_md']) ? $settings['grid_columns_md'] : '';
        $grid_columns_sm = !empty($settings['grid_columns_sm']) ? $settings['grid_columns_sm'] : '';
        $grid_columns_xs = !empty($settings['grid_columns_xs']) ? $settings['grid_columns_xs'] : '';

        foreach ($settings['logo_list'] as $index => $item) :

            $image = wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']);



            $rs_logo_image = $item['rs_logo_image'];
            if (!$image) {
                $image = Utils::get_placeholder_image_src();
            }
            $image2 = '';

            if ($rs_logo_image  == 'style2') {
                $image2 = wp_get_attachment_image_url($item['image2']['id'], $settings['thumbnail_size']);
            }
            if (!$image2) {
                $image2 = Utils::get_placeholder_image_src();
                if (isset($item['image2']['alt']) && !empty($item['image2']['alt'])) {
                    $image_alt2 = $item['image2']['alt'];
                } else {
                    $image_alt2 = !empty($item['name']) ? $item['name'] : '';
                }
            }

            if (isset($item['image']['alt']) && !empty($item['image']['alt'])) {
                $image_alt = $item['image']['alt'];
            } else {
                $image_alt = !empty($item['name']) ? $item['name'] : '';
            }



            $title_tag = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h3';
            $description = !empty($item['description']) ? $item['description'] : '';
            $target = !empty($item['link']['is_external']) ? 'target=_blank' : '';
            $link = !empty($item['link']['url']) ? $item['link']['url'] : '';
            $gap = $settings['columns-gap'] == 'no-padding' ? 'no-padding' : '';
            $animation = !empty($settings['hover_animation']) ? 'elementor-animation-' . $settings['hover_animation'] . '' : '';

            $i++;
            $last = (($i % $logo_row_count) == 0) ? 'pre-last' : '';
            $last_row = (($i > ($row_num - 1) * $logo_row_count)) ? 'pre-last-row' : '';

        ?>
            <div class="col-lg-<?php echo esc_attr($settings['columns']); ?> col-md-<?php echo $grid_columns_md; ?> col-sm-<?php echo $grid_columns_sm; ?> col-<?php echo $grid_columns_xs; ?> logo-grid-item <?php echo esc_attr($gap); ?> <?php echo esc_attr($last); ?> <?php echo esc_attr($last_row); ?>">
                <div class="rs-grid-figure">
                    <div class="logo-img">
                        <?php if (!empty($link)) { ?>
                            <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                <?php if ($rs_logo_style == 'style3') { ?>
                                    <img class="hovers-logos rs-grid-img <?php echo esc_attr($animation); ?>" src="<?php echo esc_url($image2); ?>" title="<?php echo esc_attr($image_alt2); ?>" alt="<?php echo esc_attr($image_alt2); ?>">
                                <?php } ?>
                                <img class="rs-grid-img <?php echo esc_attr($animation); ?>" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($image_alt); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            </a>

                        <?php } else { ?>
                            <a>
                                <?php if ($rs_logo_style == 'style3') { ?>
                                    <img class="hovers-logos rs-grid-img <?php echo esc_attr($animation); ?>" src="<?php echo esc_url($image2); ?>" title="<?php echo esc_attr($image_alt2); ?>" alt="<?php echo esc_attr($image_alt2); ?>">
                                <?php } ?>
                                <img class="rs-grid-img <?php echo esc_attr($animation); ?>" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($image_alt); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            </a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>