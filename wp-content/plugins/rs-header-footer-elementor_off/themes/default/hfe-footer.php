<?php
/**
 * @since 1.0.0
 */
if( is_404() ){
    return;
} else {
    do_action( 'hfe_footer_before' );
    do_action( 'hfe_footer' );
} ?>
</div><!-- #page -->
<?php 
if(!empty(get_theme_mod('industrie_enable_go_to_top'))){
?>
 <!-- start scrollUp  -->
<div id="scrollUp">
    <i class="ri-arrow-up-s-line"></i>
</div>   
<?php } 
    if(!empty(get_theme_mod('gsap_animation_enable_disable'))){
        if(!empty(get_theme_mod('gsap_custom_cursor_enable_disable'))){
    ?>
    <!-- Custom Cursor Start -->
    <div id="rs-mouse">
        <div id="cursor-ball"></div>
    </div>
    <!-- Custom Cursor End -->
<?php } }
wp_footer(); ?>
</body>
</html> 
