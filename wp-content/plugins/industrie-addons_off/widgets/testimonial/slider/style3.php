<div class="grid-item">
    <div class="testimonial-inner">
        <div class="quote_icon">
            <?php \Elementor\Icons_Manager::render_icon( $settings['testimonial_quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <?php if ($settings['company_logo_show'] == 'yes') {?>
            <div class="logo-img">
                <img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr($item['name']); ?>">
            </div>
        <?php } ?>

        <div class="testi-card-bottom">
            <?php if (!empty($vendor_image)) { ?>
                <div class="vendor-img">
                    <img src="<?php echo esc_url($vendor_image); ?>" alt="<?php echo esc_attr($item['name']); ?>">
                </div>
            <?php  } ?>
            <div class="content-part">
                <?php if ($settings['title_show'] == 'yes') {?> 
                    <h4 class="title"><?php echo esc_html($title); ?></h4>
                <?php } ?>
                <?php if ($settings['ratings_show'] == 'yes') {?>
                    <div class="ratings">
                        <?php echo $ratingstars ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="description">
            <?php echo wp_kses_post($description); ?>
        </div>

        <div class="content-part-modify">
            <h5 class="name"><?php echo esc_attr($name); ?></h5>
            <?php if ($settings['separator_content_show'] == 'yes') {?>
                <div class="testi-separator"><?php echo esc_html($settings['separator_content']); ?></div>
            <?php } ?>
            <div class="testi-designation"><?php echo esc_attr($designation); ?></div>
        </div>
    </div>
</div>