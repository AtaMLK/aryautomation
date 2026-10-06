<?php
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
?>
<div class="services-inner <?php echo $title_based_on; ?>">
    <?php if (!empty($settings['numbering_txt'])) : ?>
        <div class="numbering">
            <span><?php echo esc_html($settings['numbering_txt']); ?></span>
        </div>
    <?php endif; ?>
    <div class="content_part">
        <?php if (!empty($settings['title'])) { ?>
            <div class="services-title">
                <?php if (!empty($settings['title_link'])) :
                    $link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
                ?>
                    <<?php echo esc_html($settings['title_tag']); ?> <?php echo esc_attr($this->print_render_attribute_string('title')); ?>>

                        <a href="<?php echo esc_url($settings['title_link']); ?>" <?php echo esc_attr($link_open); ?>>
                            <?php echo wp_kses_post($settings['title']); ?>
                        </a>
                    </<?php echo esc_html($settings['title_tag']); ?>>
                <?php else : ?>
                    <<?php echo esc_html($settings['title_tag']); ?> <?php echo esc_attr($this->print_render_attribute_string('title')); ?>> <?php echo wp_kses_post($settings['title']); ?></<?php echo esc_html($settings['title_tag']); ?>>
                <?php endif; ?>
            </div>
        <?php } ?>
        <?php if (!empty($settings['description'])) : ?>
            <div class="desc-text">
                <?php echo wp_kses_post($settings['description']); ?>
            </div>
        <?php endif; ?>
        <?php if ('yes' == $settings['button_show_hide']) { ?>
            <div class="btn-part">
                <?php
                $link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : '';
                ?>
                <a class="services-btn" href="<?php echo esc_url($settings['services_btn_link']); ?>" <?php echo wp_kses_post($link_open); ?>>
                    <?php if ('left' == $settings['button_icon_postion']) { ?>
                    <?php
                        Icons_Manager::render_icon($settings['btn__selected_icon'], ['aria-hidden' => 'true']);
                    } ?>
                    <?php echo esc_html($settings['services_btn_text']); ?>
                    <?php if ('right' == $settings['button_icon_postion']) { ?>
                    <?php
                        Icons_Manager::render_icon($settings['btn__selected_icon'], ['aria-hidden' => 'true']);
                    } ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <?php if ('yes' == $settings['icon_image_show_hide']) { ?>
        <div class="media_wrap">
            <?php if (!empty($settings['selected_image']['url'])) { ?>
                <?php if (!empty($settings['selected_image'])) : ?>
                    <div class="image_style media-cmn">
                        <?php 
                            echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'selected_image' );                         
                        ?>
                    </div>
                <?php endif; ?>
            <?php } ?>
        </div>
    <?php } ?>
</div>