<?php use Elementor\Icons_Manager; ?>
<div class="rs-pricing-table-header">
    <?php if ($settings['title']) : ?>
        <h3 <?php $this->print_render_attribute_string('title'); ?>><?php echo esc_html($settings['title']); ?></h3>
    <?php endif; ?>
    <div class="rs-pricing-table-price <?php echo esc_attr($settings['pricing_inline']); ?>">
        <div class="rs-pricing-table-price-tag">
            <span class="rs-pricing-table-currency">
                <?php echo esc_html($currency); ?>
            </span>
            <span <?php $this->print_render_attribute_string('price'); ?>>
                <?php echo esc_html($settings['price']); ?>
            </span>
        </div>
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
        <ul class="rs-pricing-table-features-list <?php echo ($settings['icon_postion']); ?>">


            <?php foreach ($settings['features_list'] as $index => $feature) :
                $name_key = $this->get_repeater_setting_key('text', 'features_list', $index);
                $this->add_inline_editing_attributes($name_key, 'basic');
                $this->add_render_attribute($name_key, 'class', 'rs-pricing-table-feature-text');
            ?>
                <li class="<?php echo esc_attr('elementor-repeater-item-' . $feature['_id']); ?>">
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
    <div class="btn-part">
        <a <?php $this->print_render_attribute_string('button_text'); ?>><?php echo esc_html($settings['button_text']); ?>
            <?php if (!empty($settings['btn_icon'])) : ?>
                <?php
                Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']);
                ?>
            <?php endif; ?>
        </a>
    </div>
<?php endif; ?>