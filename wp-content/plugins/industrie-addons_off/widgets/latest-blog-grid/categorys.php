<?php 
$category = get_the_category(get_the_ID());
foreach($category as $cat) { 
$cate_bg     = get_term_meta($cat->cat_ID, 'category_bg_color', true);
$cate_color  = get_term_meta($cat->cat_ID, 'category_bg_color', true);
$cate_bg = ($cate_bg) ? "Style=background:$cate_bg" : "" ;
$cate_color = ($cate_color) ? "Style=color:$cate_color" : "" ;
?>
<?php if( "blog_cat_show_hide" == $settings['blog_cat_show_hide'] ){ ?>

<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>" <?php echo esc_html($cate_color); ?> >
<?php if($content_reverse == '2') {

        if(!empty( $settings['category_icon']['value']) ) {
            \Elementor\Icons_Manager::render_icon( $settings['category_icon'], [ 'aria-hidden' => 'true' ] );
        }else{
            ?>
                <i class="ri-bookmark-line"></i>
            <?php 
        }
} ?>
<?php echo esc_html($cat->name);?></a>

<?php } else {
 ?>
<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>"<?php echo esc_html($cate_color); ?> >
    <?php 

        if(!empty( $settings['category_icon']['value']) ) {
            \Elementor\Icons_Manager::render_icon( $settings['category_icon'], [ 'aria-hidden' => 'true' ] );
        }elseif( !empty($settings['category_img_sec__']['url']) ){
            ?>
              <img src="<?php echo esc_url( $settings['category_img_sec__']['url'] );?>" alt="image"/>
            <?php
        }
     ?>
<?php echo esc_html($cat->name);?>
</a>

<?php } ?>
<?php } ?>


 