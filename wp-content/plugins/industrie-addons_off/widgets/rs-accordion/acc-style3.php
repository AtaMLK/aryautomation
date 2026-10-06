<?php 
    
    $step_title        = !empty($item['step_title']) ? $item['step_title'] : '';
 ?>
<div class="accordion-item">
    <div class="accordion-header" id="heading<?php echo $i;?>">
        <div class="accordion-button <?php echo esc_attr($collapsed);?>" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $i;?>" aria-controls="collapse_<?php echo $i;?>">
            <?php if ( $has_icon ) : ?>
                <span class="elementor-accordion-icon elementor-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
                    <?php
                    if ( $is_new ) { ?>
                        <span class="elementor-accordion-icon-closed"><?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'] ); ?></span>
                        <span class="elementor-accordion-icon-opened"><?php \Elementor\Icons_Manager::render_icon( $settings['selected_active_icon'] ); ?></span>
                    <?php } else { ?>
                        <i class="elementor-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
                        <i class="elementor-accordion-icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>"></i>
                    <?php } ?>
                </span>
            <?php endif; ?>                        

            <?php if('left' == $settings['image_align']){ ?>
                <?php echo $selected_image; ?>
            <?php } ?>
            <div class="title-step-wrap">
                <?php if(!empty($step_title)):?>
                <div class="acc-step-title">
                    <?php echo esc_attr ($step_title);?>
                </div>
                <?php endif; ?>
                <?php if(!empty($title)):?>
                <<?php echo $settings['title_html_tag']; ?> class="tab-title"><?php echo esc_attr ($title);?></<?php echo $settings['title_html_tag']; ?>>
                <?php endif; ?>
            </div>

            <?php if('right' == $settings['image_align']){ ?>
                <?php echo $selected_image; ?>
            <?php } ?>

        </div>
    </div>

    <?php if(!empty($item['description'])):?>
    <div id="collapse_<?php echo $i;?>" class="accordion-collapse collapse <?php echo esc_attr( $active); ?>" aria-labelledby="heading<?php echo $i;?>" data-bs-parent="#rs-accordion-inner">
        <div class="accordion-body">
            <?php echo $this->parse_text_editor( $item['description'] ); ?>
        </div>
    </div>
    <?php endif;?>
</div>