<?php 
use Elementor\Group_Control_Image_Size;
?>
<?php if ('yes' === $settings['enable_grid_']) { ?>
    <div class="grid-item col-lg-<?php echo esc_attr($settings['service__column_desktop']); ?> col-md-<?php echo esc_attr($settings['service__column_md']); ?>">
<?php } else { ?>
    <div class="grid-item">
<?php } ?>
    <div class="rs-service-slider">
        <?php if(isset($item['image']['url']) && !empty($item['image']['url']) ) { ?>
            <div class="service-img">
                <?php 
                    echo Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );                         
                ?>
            </div>
        <?php  } ?>

        <div class="service-title-holder btn_<?php echo $read_more_hover_based;?>">
            <div class="service-content-area">
            <?php if (!empty($item['name'])) : ?>
                <?php if ('yes' === $settings['show_title']) : ?>
                    <div class="service-title <?php echo $title_hover_underline;?>">
                    <<?php echo esc_attr($title_tag); ?> class="title">
                        <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                             <?php echo esc_attr($title); ?>
                        </a>
                        </<?php echo esc_attr($title_tag); ?>>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($item['description'])) : ?>
                <?php if ('yes' === $settings['show_desc']) : ?>
                    <div class="service-desc">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (!empty($nnumber) && $number_enable_disable == 'yes') : ?>
                <div class="numbering <?php echo $number_line_css;?>">
                    <span><?php echo $nnumber;?></span>
                </div>
            <?php endif; ?>
            <!-- Button Style -->
            <?php if ($settings['show_read'] == 'yes') { ?>
                <div class="read__more">
                    <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?> class="btn-area">
                        <span class="btn-text"><?php echo esc_html($settings['button_text']); ?></span>
                        <span class="btn-icon"><?php if (!empty($settings['show_read_icon']) && !empty($settings['button_text'])) { ?>
                            <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                        <?php } ?>
                        </span>
                    </a>
                </div>
            <?php } ?>
            <!-- Button Style End -->
            </div>
        </div>
    </div>
</div>