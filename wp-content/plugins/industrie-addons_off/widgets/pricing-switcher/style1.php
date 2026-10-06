<?php 
use Elementor\Icons_Manager;
?>
<div class="col-lg-4 col-sm-6">
    <div class="pricing-item monthly <?php echo esc_attr($itemactive_class);?>">
        <?php if(!empty($badge)) { ?>
            <div class="pricebadge"><?php echo esc_html( $badge ); ?></div>
        <?php } ?>
        <div class="title-wrapper">
            <h3 class="title"><?php echo esc_html($plan_title);?></h3>
            <?php if(!empty($intro_monthly)) { ?>
                <div class="intro-txt"><?php echo esc_html( $intro_monthly ); ?></div>
            <?php } ?>
        </div>
        <div class="price-wrapper">
            <div class="price">
                <?php echo esc_html($price_monthly);?>
            </div>
            <?php if(!empty($duration_monthly)){ ?>
                <div class="plan-duration">
                    <?php echo esc_html($duration_monthly);?>
                </div>
            <?php } ?>
        </div>
        <?php if(!empty($desc_monthly)){ ?>
            <div class="description"><?php echo wp_kses_post($desc_monthly); ?></div>
        <?php } ?>
        <?php if(!empty($features_monthly)){ ?>
            <div class="pricing-feature">
                <?php if(!empty($item['feature_title'])) { ?>
                    <div class="feature-title"><?php echo esc_html($item['feature_title']); ?></div>
                <?php } ?>
                <?php echo wp_kses_post($features_monthly);?>
            </div>
        <?php } ?>
        <?php if(!empty($button_text)){ ?> 
            <div class="pricing-btn">
                <a href="<?php echo esc_url($button_link_monthly);?>" <?php echo esc_attr($btn_link_external_monthly);?>>
                    <?php
                        echo esc_attr ($button_text);
                        if (!empty($item['btn_icon'])) {
                            Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']);
                        }
                    ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="pricing-item yearly <?php echo esc_attr($itemactive_class);?>">
        <?php if(!empty($badge)) { ?>
            <div class="pricebadge"><?php echo esc_html( $badge ); ?></div>
        <?php } ?>
        <div class="title-wrapper">
            <h3 class="title"><?php echo esc_html($plan_title);?></h3>
            <?php if(!empty($intro_yearly)) { ?>
                <div class="intro-txt"><?php echo esc_html( $intro_yearly ); ?></div>
            <?php } ?>
        </div>
        <div class="price-wrapper">
            <div class="price">
                <?php echo esc_html($price_yearly);?>
            </div>
            <?php if(!empty($duration_yearly)){ ?>
                <div class="plan-duration">
                    <?php echo esc_html($duration_yearly);?>
                </div>
            <?php } ?>
        </div>
        <?php if(!empty($desc_yearly)){ ?>
            <div class="description"><?php echo wp_kses_post($desc_yearly);?></div>
        <?php } ?>
        <?php if(!empty($features_yearly)){ ?>
            <div class="pricing-feature">
                <?php if(!empty($item['feature_title'])) { ?>
                    <div class="feature-title"><?php echo esc_html($item['feature_title']); ?></div>
                <?php } ?>
                <?php echo wp_kses_post($features_yearly);?>
            </div>
                
        <?php } ?>
        <?php if(!empty($button_text)){ ?> 
            <div class="pricing-btn">
                <a href="<?php echo esc_url($button_link_yearly);?>" <?php echo esc_attr($btn_link_external_yearly);?>>
                    <?php 
                        echo esc_attr ($button_text);
                        if (!empty($item['btn_icon'])) {
                            Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']);
                        }
                    ?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>