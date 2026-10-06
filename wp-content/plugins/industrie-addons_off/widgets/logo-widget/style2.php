<?php use Elementor\Utils; ?>
<div class="rsaddon-unique-slider rsaddons-logo-showcase <?php echo $clip_path_css; ?>">
    <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider-<?php echo $unique; ?> rs-addon-slider rsl_logo_<?php echo esc_attr($settings['rs_logo_style']); ?>">
        <?php
        foreach ($settings['logo_list'] as $index => $item) :
            // print_r($item['image']);

            $image = wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']);
            $image_alt = '';

            if (isset($item['image']['alt']) && !empty($item['image']['alt'])) {
                $image_alt = $item['image']['alt'];
            } else {
                $image_alt = !empty($item['name']) ? $item['name'] : '';
            }



            $rs_logo_image = $item['rs_logo_image'];
            $image2 = '';
            $image_alt2 = '';
            if ($rs_logo_image  == 'style2') {
                $image2 = wp_get_attachment_image_url($item['image2']['id'], $settings['thumbnail_size']);
            }


            if (!$image) {
                $image = Utils::get_placeholder_image_src();
            }

            if (!$image2) {
                $image2 = Utils::get_placeholder_image_src();

                if (isset($item['image2']['alt']) && !empty($item['image2']['alt'])) {
                    $image_alt2 = $item['image2']['alt'];
                } else {
                    $image_alt2 = !empty($item['name']) ? $item['name'] : '';
                }
            }

            $title        = $item['name'];
            $title_tag    = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h3';
            $description  = !empty($item['description']) ? $item['description'] : '';
            $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';
            $link         = !empty($item['link']['url']) ? $item['link']['url'] : '';
            $gap          = $settings['columns-gap'] == 'no-padding' ? 'no-padding' : '';

            $animation    = !empty($settings['hover_animation']) ? 'elementor-animation-' . $settings['hover_animation'] . '' : '';
        ?>
            <div class="grid-item <?php echo esc_attr($gap); ?>">
                <div class="rs-grid-figure">
                    <div class="logo-img ddddd">
                        <?php if (!empty($link)) { ?>
                            <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                <?php if ($rs_logo_style == 'style3') { ?>
                                    <img class="hovers-logos rs-grid-img <?php echo esc_attr($animation); ?>" src="<?php echo esc_url($image2); ?>" title="<?php echo esc_attr($image_alt2); ?>" alt="<?php echo esc_attr($image_alt2); ?>">
                                <?php } ?>
                                <img class="mains-logos rs-grid-img <?php echo esc_attr($animation); ?>" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($image_alt); ?>" alt="<?php echo esc_attr($image_alt); ?>"></a>

                        <?php } else { ?>
                            <a>
                                <?php if ($rs_logo_style == 'style3') { ?>
                                    <img class="hovers-logos rs-grid-img <?php echo esc_attr($animation); ?>" src="<?php echo esc_url($image2); ?>" title="<?php echo esc_attr($image_alt2); ?>" alt="<?php echo esc_attr($image_alt2); ?>">
                                <?php } ?>
                                <img class="mains-logos rs-grid-img <?php echo esc_attr($animation); ?>" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($image_alt); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            </a>
                        <?php } ?>
                    </div>
                    <?php if (!empty($item['name'])) : ?>
                        <?php if ('yes' === $settings['show_title']) : ?>
                            <div class="logo-title">
                                <<?php echo esc_attr($title_tag); ?> class="title"> <?php echo esc_attr($title); ?></<?php echo esc_attr($title_tag); ?>>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (!empty($item['description'])) : ?>
                        <?php if ('yes' === $settings['show_desc']) : ?>
                            <div class="logo-desc">
                                <p class="description"> <?php echo esc_attr($description); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <span class="left-bottom-shape"></span>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
    <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
</div>