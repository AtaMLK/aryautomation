<?php
// Register and load the widget
function rsframework_cta_widget()
{
  register_widget('cta_widget');
}
add_action('widgets_init', 'rsframework_cta_widget');

//Contact info Widget 
class cta_widget extends WP_Widget
{

  /** constructor */
  function __construct()
  {
    parent::__construct(
      'cta_widget',
      __('RS CTA Info', 'rsframework'),
      array('description' => __('Display your cta info!', 'rsframework'),)
    );
  }

  /** @see WP_Widget::widget */
  function widget($args, $instance)
  {
    extract($args);
    $image_src = '';
    $title    = apply_filters('widget_title', $instance['title']);
    $phone   = $instance['phone'];
    $app   = $instance['app'];
    $watermark_text   = $instance['watermark_text'];
    $info_title   = $instance['info_title'];



    if (!empty($intro) || !empty($phone)) { ?>
      <div class="rs-portfolio-call-to-action" style="background:url('<?php echo $instance['background_image'];?>)');">
        <div class="rs-portfolio-widget-inner">
          <?php
          if (!empty($watermark_text)) { ?>
            <span class="watermark"><?php echo wp_kses_post($watermark_text); ?></span>
            <div class="title-inner">
              <h3 class="title"><?php echo wp_kses_post($title); ?></h3>
            </div>
          <?php } ?>
          
          <div class="call-action-info">
            <div class="address-icon">
              <i class="ri-phone-line"></i>
            </div>
            <?php
            if (!empty($phone)) { ?>
              <div class="phone">
              <?php
              if (!empty($info_title)) { ?>
                <p><?php echo wp_kses_post($info_title); ?></p>
              <?php } ?>
                <a href="<?php echo esc_attr(str_replace(" ", "", ($app))); ?>"><?php esc_html_e($phone); ?></a>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>

  <?php
  }

  /** @see WP_Widget::update  */
  function update($new_instance, $old_instance)
  {
    $instance            = $old_instance;
    $instance['title']   = strip_tags($new_instance['title']);
    $instance['watermark_text']   = strip_tags($new_instance['watermark_text']);
    $instance['phone']   = strip_tags($new_instance['phone']);
    $instance['app']     = wp_kses_post($new_instance['app']);
    $instance['info_title']     = wp_kses_post($new_instance['info_title']);

    $instance['background_image'] = esc_url($new_instance['background_image']);
    return $instance;
  }

  /** @see WP_Widget::form */
  function form($instance)
  {

    $title   = (isset($instance['title'])) ? $instance['title'] : '';
    $phone   = (isset($instance['phone'])) ? $instance['phone'] : '';
    $app     = (isset($instance['app'])) ? $instance['app'] : '';
    $watermark_text     = (isset($instance['watermark_text'])) ? $instance['watermark_text'] : '';
    $info_title     = (isset($instance['info_title'])) ? $instance['info_title'] : '';
    $background_image = isset($instance['background_image']) ? $instance['background_image'] : '';

  ?>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'rsframework'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_js($title); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('watermark_text')); ?>"><?php esc_html_e('Watermark Text:', 'rsframework'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('watermark_text')); ?>" name="<?php echo esc_attr($this->get_field_name('watermark_text')); ?>" type="text" value="<?php echo esc_js($watermark_text); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('info_title')); ?>"><?php esc_html_e('Contact Info Title:', 'rsframework'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('info_title')); ?>" name="<?php echo esc_attr($this->get_field_name('info_title')); ?>" type="text" value="<?php echo esc_js($info_title); ?>" />
    </p>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone Number:', 'rsframework'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_js($phone); ?>" />
    </p>


    <p>
      <label for="<?php echo esc_attr($this->get_field_id('app')); ?>"><?php esc_html_e('Link:', 'rsframework'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('app')); ?>" name="<?php echo esc_attr($this->get_field_name('app')); ?>" type="text" value="<?php echo esc_js($app); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('background_image'); ?>"><?php esc_html_e('Background Image:', 'rsframework'); ?></label>
        <input type="text" class="widefat background-image" id="<?php echo $this->get_field_id('background_image'); ?>" name="<?php echo $this->get_field_name('background_image'); ?>" value="<?php echo esc_attr($background_image); ?>">
        <button class="rs-upload-image-button button"><?php esc_html_e('Upload Image:', 'rsframework'); ?></button>
    </p>

    <script>
            jQuery(document).ready(function ($) {
                // Uploading files
                $(document).on('click', '.rs-upload-image-button', function (e) {
                    e.preventDefault();
                    var widget = $(this).closest('.widget');
                    var imageField = widget.find('.background-image');
                    var imageFrame;
                    if (imageFrame) {
                        imageFrame.open();
                        return;
                    }
                    imageFrame = wp.media({
                        title: 'Choose Image',
                        multiple: false
                    });
                    imageFrame.on('select', function () {
                        var attachment = imageFrame.state().get('selection').first().toJSON();
                        imageField.val(attachment.url);
                    });
                    imageFrame.open();
                });
            });
        </script>

<?php
  }
} // end class