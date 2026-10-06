<?php 
use Elementor\Icons_Manager;

if ( has_post_format('video') ) { 
$video_link    = get_post_meta(get_the_ID(), 'posts_video', true);
?>
<div class="video__post"><a class="popup-videos" href="<?php echo esc_url($video_link);?>">
<?php if ( $settings['video_icon'] ):
Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] );
endif; ?>
</a></div>
<?php } ?>	