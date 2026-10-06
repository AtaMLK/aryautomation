<?php 
get_header();
$post_id      = get_the_id();
$author_id    = get_post_field ('post_author', $post_id);
$display_name = get_the_author_meta( 'display_name' , $author_id );
$industrie_blog_page_custom_read_more = get_theme_mod('industrie_blog_page_custom_read_more') ? get_theme_mod('industrie_blog_page_custom_read_more') : '';
$industrie_blog_page_hide_author = get_theme_mod('industrie_blog_page_hide_author') ? get_theme_mod('industrie_blog_page_hide_author') : '';
$industrie_blog_page_hide_date = get_theme_mod('industrie_blog_page_hide_date') ? get_theme_mod('industrie_blog_page_hide_date') : '';
$industrie_blog_page_hide_categiry = get_theme_mod('industrie_blog_page_hide_categiry') ? get_theme_mod('industrie_blog_page_hide_categiry') : '';
?>
    <div class="container"> 
        <div id="content">
            <?php
                //checking page layout
                $page_layout = get_theme_mod( 'industrie_blog_single_sidebar_setting' );
                $col_side    = '';
                $col_letf    = '';
                if($page_layout == '2left'){
                    $col_side = '8';
                    $col_letf = 'left-sidebar';
                }
                else if($page_layout == '2right'){
                    $col_side = '8';
                }
                else{
                	$col_side = '12';
            	}
            ?>
          <!-- Blog Detail Start -->
            <div class="rs-blog-details">
                <div class="row padding-<?php echo esc_attr( $col_letf) ?>">
                    <div class="col-lg-<?php echo esc_attr( $col_side). ' ' .esc_attr( $col_letf) ?>">
                        <?php while ( have_posts() ) : the_post(); ?>    
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php if(has_post_thumbnail()){ ?>
                                    <div class="bs-img">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                <?php } ?>
                                <div class="blog-meta">
                                <ul class="btm-cate_no_thum">
                                    <?php if(!empty($industrie_blog_page_hide_author) ){ ?>                                                  
                                    <?php } else { ?>
                                        <li>
                                            <div class="postedby">                                                            
                                                <div class="info">                                            
                                                    <?php esc_html_e( 'By', 'industrie' ); ?> <span class="name"><?php echo esc_html($display_name); ?> </span>         
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>

                                        <?php if(!empty($industrie_blog_page_hide_date) ){ ?>                                                  
                                        <?php } else { ?>
                                            <li>
                                                <div class="blog-date">
                                                    <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                                </div>                                              
                                            </li>
                                        <?php } ?>                                            
                                        <?php if(!empty($industrie_blog_page_hide_categiry) ){ ?>                                                  
                                        <?php } else { 
                                            if(get_the_category()):
                                                $seperator = ', '; // blank instead of comma
                                                $after = '';
                                                $before = '';
                                                echo '<li class="rs___tag"><div class="tag-line">';
                                                ?>
                                                <?php
                                                the_category(', '); 
                                                echo '</div> </li>';
                                            endif;
                                        } ?>
                                        <li class="rs_comments">                                                
                                            <?php echo get_comments_number( '0', '1', '%' ); ?> <?php esc_html_e( 'Comment', 'industrie' ); ?>                                                
                                        </li>
                                    </ul>                                                         
                                </div>
                                
                                <h3 class="rs-blog-single-title"><?php the_title(); ?></h3>

                                <?php
                                  get_template_part( 'template-parts/post/content', get_post_format() );         
                                ?>
                                <div class="clear-fix"></div>           
                            </article> 
                        
                        <?php       
                        $author_meta = get_the_author_meta('description'); 
                        if( !empty($author_meta) ){
                        ?>
                            <div class="author-block">
                              <div class="author-img"> <?php echo get_avatar(get_the_author_meta( 'ID' ), 260);?> </div>
                              <div class="author-desc">
                                <h3 class="author-title">
                                  <?php the_author();?>
                                </h3>
                                <p>
                                  <?php   
                                    echo wpautop( get_the_author_meta( 'description' ) );
                                  ?>
                                </p>
                                <a href="<?php echo esc_url(get_the_author_meta('user_url'))?>" target="_blank">
                                  <?php echo esc_url(get_the_author_meta( 'user_url'))?></a> 
                                </div>
                            </div>
                            <!-- .author-block -->
                        <?php }
                                  
                        ?>
                        <?php 
                        $blog_author = '';
                        if($blog_author == ""){
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        }
                        endwhile; // End of the loop.
                        ?>
                    </div>
                  <?php
                    if( $page_layout == '2left' || $page_layout == '2right'):
                        get_sidebar('single');
                    endif; ?>
                </div>
            </div>
          <!-- Blog Detail End --> 
        </div>
    </div>
<!-- .container -->
<?php
get_footer();