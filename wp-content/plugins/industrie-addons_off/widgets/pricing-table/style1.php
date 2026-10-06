<?php use Elementor\Icons_Manager; 
?>
<?php if ($settings['show_badge']) : ?>
    <span <?php $this->print_render_attribute_string('badge_text'); ?>><?php echo esc_html($settings['badge_text']); ?></span>
<?php endif; ?>

<?php if ('top' == $settings['selected_image_postion']) : ?>
    <?php if (!empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])) : ?>
        <div class="rs-pricing-icon">
            <?php if ($settings['selected_icon']) : ?>
                <i class="fa <?php echo esc_html($settings['selected_icon']); ?>"></i>
            <?php endif; ?>

            <?php if ($settings['selected_image']['url']) : ?>
                <img src="<?php echo esc_url($settings['selected_image']['url']); ?>" alt="<?php echo esc_url($settings['selected_image']['url']); ?>" />
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="rs-pricing-table-header">
    <?php if ($settings['title']) : ?>
        <h3 <?php $this->print_render_attribute_string('title'); ?>><?php echo esc_html($settings['title']); ?></h3>
    <?php endif; ?>
</div>

<?php if ('middle' == $settings['selected_image_postion']) : ?>
    <?php if (!empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])) : ?>
        <div class="rs-pricing-icon">
            <?php if ($settings['selected_icon']) : ?>
                <i class="fa <?php echo esc_html($settings['selected_icon']); ?>"></i>
            <?php endif; ?>

            <?php if ($settings['selected_image']['url']) : ?>
                <img src="<?php echo esc_url($settings['selected_image']['url']); ?>" alt="<?php echo esc_url($settings['selected_image']['url']); ?>" />
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="rs-pricing-table-price <?php echo esc_attr($settings['pricing_inline']); ?>">
    <div class="rs-pricing-table-price-tag <?php echo esc_attr($settings['price_gradient_color_setting']);?>">
        <span class="rs-pricing-table-currency"><?php echo esc_html($currency); ?></span><span <?php $this->print_render_attribute_string('price'); ?>><?php echo esc_html($settings['price']); ?></span><span <?php $this->print_render_attribute_string('period'); ?>><?php echo esc_html($settings['period']); ?></span>
        <?php if (!empty($settings['heading_watermark'])) {
            ?>
                <span class="watermark"><?php echo esc_html( $settings['heading_watermark']); ?></span>
            <?php
        } ?>
    </div>
</div>

<?php if ($settings['short_desc_show_hide'] == 'yes') : ?>
    <div class="short-desc"><?php echo esc_html($settings['short_desc']); ?></div>
<?php endif; ?>

<div class="rs-pricing-table-body">
    <?php if ($settings['features_title']) : ?>
        <h3 <?php $this->print_render_attribute_string('features_title'); ?>><?php echo wp_kses_post($settings['features_title']); ?></h3>
    <?php endif; ?>

    <?php if (is_array($settings['features_list'])) : ?>
        <ul class="rs-pricing-table-features-list <?php echo ($settings['icon_postion']); ?> <?php echo esc_attr($settings['feature_icon_gradient_color_setting']);?>">
            <?php foreach ($settings['features_list'] as $index => $feature) :
                $name_key = $this->get_repeater_setting_key('text', 'features_list', $index);
                $this->add_inline_editing_attributes($name_key, 'basic');
                $this->add_render_attribute($name_key, 'class', 'rs-pricing-table-feature-text');
                $text_line_through = $feature['text_line_through'];
                $line_through = '';
                if( $text_line_through == 'yes' ) {
                    $line_through = 'line-through';
                }
            ?>
                <li class="<?php echo esc_attr('elementor-repeater-item-' . $feature['_id']); ?> <?php echo $line_through;?>">
                    <?php if ($settings['icon_show']) :
                        if ($feature['icon']) : ?>
                            <?php
                            Icons_Manager::render_icon($feature['icon'], ['aria-hidden' => 'true']);
                            ?>

                    <?php endif;
                    endif; ?>

                    <span <?php $this->print_render_attribute_string($name_key); ?>><?php echo wp_kses_post($feature['text']); ?></span>
                </li>
            <?php endforeach; ?>

        </ul>
    <?php endif; ?>
</div>

<?php if ($settings['button_text']) : ?>
    <div class="btn-part <?php echo esc_attr($settings['btn_gradient_color_setting']);?> <?php echo $btn_rotate;?>">
        <a <?php $this->print_render_attribute_string('button_text'); ?>><?php echo esc_html($settings['button_text']); ?>
            <?php if (!empty($settings['btn_icon'])) : ?>
                <?php
                Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']);
                ?>
            <?php endif; ?>
        </a>
    </div>
<?php endif; ?>
<?php if ($settings['btn_bottom_text_show']) : ?>
<div class="btn-bottom-text">
    <p><?php echo esc_html($settings['btn_bottom_text_']); ?></p>
</div>
<?php endif; ?>