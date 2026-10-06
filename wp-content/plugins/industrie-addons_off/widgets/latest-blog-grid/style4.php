<?php   
use Elementor\Icons_Manager; 
$cat = $settings['category'];
$select = $settings['select_posts'];

global  $paged;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if(empty($cat)){
    $prelements_query = new wp_Query(array(
        'post_type'         => 'post',                                
        'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
        'posts_per_page'    => $settings['per_page'],
        'offset'            => $settings['pre_blog_posts_offset'],
        'paged'             => $paged,
        'post__in'          => $select,                  
    ));   
}   
else{
    $prelements_query = new wp_Query(array(
            'post_type'         => 'post',
            'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
            'posts_per_page'    => $settings['per_page'],
            'offset'            => $settings['pre_blog_posts_offset'],
            'paged'             => $paged,
            'post__in'          => $select,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug', 
                    'terms'    => $cat 
                ),
            )
    ));   
}                      


while($prelements_query->have_posts()): $prelements_query->the_post(); 

    $full_date       = get_the_date('M j, Y');
    $blog_date       = get_the_date('M j, Y');
    $blog_only_date  = get_the_date('j');
    $blog_only_month = get_the_date('M');
    $post_admin      = get_the_author();

    if(!empty($settings['blog_word_show'])){
        $limit = $settings['blog_word_show'];
    }
    else{
        $limit = 20;
    }

    
    if(!empty($settings['blog_title_word_show'])){
        $limits = $settings['blog_title_word_show'];
    }
    else{
        $limits = 200;
    }
?>

<div class="pre-blog-item col-lg-<?php echo esc_attr($settings['latest_blog_item_column']); ?>">
    <div class="blog-inner-wraps">        
        <div class="pre-image-wrap">
            <?php if ( 'yes' === $settings['blog_image_show_hide'] ){ ?>
                <a href="<?php the_permalink(); ?>" class="rs--thum">
                    <?php  the_post_thumbnail($settings['thumbnail_size']);?>
                </a>
            <?php
                } 
            ?>
            <div class="pre-blog-content">
                <?php if ( 'yes' === $settings['blog_meta_show_hide'] ){ ?>
                    <ul class="pre-blog-meta">
                        <?php if(!empty($post_admin)){ ?>                                
                            <li> <?php echo esc_html('By', 'industrie') ?> <span><?php echo esc_html($post_admin); ?></span></li> 
                        <?php } ?>

                        <?php if(!empty($full_date)){ ?>                         
                            <li> <?php echo esc_html($full_date); ?> </li>
                        <?php } ?> 
                    </ul>                  
                <?php } ?>

                <?php if ( 'yes' === $settings['blog_title_show_hide'] ){ ?>
                    <h3 class="pre-post-title"><a class="pre-pointer-events" href="<?php the_permalink();?>">
                        <?php echo wp_trim_words( get_the_title(), $limits, '' ); ?></a>
                    </h3>
                <?php } ?>                

                
                <?php if ( 'yes' === $settings['blog_content_show_hide'] ){ ?>
                    <p class="pre-content"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                <?php }

                if ( 'yes' === $settings['blog_cate_show_hide'] ){
                    $category = get_the_category(get_the_ID());
                    foreach($category as $cat) { 
                    ?>
                    <a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>" class="rs-cate">
                        <?php echo esc_html($cat->name);?>
                    </a>
                <?php } 
                } ?>              
            </div>
        </div>            
    </div>
</div>

<?php
endwhile;
wp_reset_query(); 
?>