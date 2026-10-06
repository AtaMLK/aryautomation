<?php
get_header(); ?>
<div id="rs-blog" class="rs-blog blog-page">
    <?php
        $industrie_blog_page_btn_setting = get_theme_mod('industrie_blog_page_btn_setting');
        $industrie_blog_layouts = get_theme_mod('industrie_blog_page_sidebar_setting');
        $industrie_blog_page_custom_read_more = get_theme_mod('industrie_blog_page_custom_read_more') ? get_theme_mod('industrie_blog_page_custom_read_more') : '';
        $industrie_blog_page_hide_author = get_theme_mod('industrie_blog_page_hide_author') ? get_theme_mod('industrie_blog_page_hide_author') : '';
        $industrie_blog_page_hide_date = get_theme_mod('industrie_blog_page_hide_date') ? get_theme_mod('industrie_blog_page_hide_date') : '';
        $industrie_blog_page_hide_categiry = get_theme_mod('industrie_blog_page_hide_categiry') ? get_theme_mod('industrie_blog_page_hide_categiry') : '';
        //checking blog layout form option  
        $col         = '';
        $blog_layout = ''; 
        $column      = ''; 
        $blog_grid   = '';
        if(!empty($industrie_blog_layouts) || !is_active_sidebar( 'sidebar-1' )){
            $blog_layout = !empty($industrie_blog_layouts) ? $industrie_blog_layouts : '';
            $blog_grid   = !empty($industrie_blog_layouts) ? $industrie_blog_layouts : '';
            $blog_grid = !empty($blog_grid) ? $blog_grid : '12';
            if($blog_layout == 'blog_no_sidebar' || !is_active_sidebar( 'sidebar-1' )){
                $layout ='full-layout';
                $col    = '-full';
                $column = 'sidebar-none';  
            }          
            elseif($blog_layout == 'blog_left_sidebar'){
                $layout = 'full-layout-left';  
            }    
            elseif($blog_layout == 'blog_right_sidebar'){
                $layout = 'full-layout-right'; 
            } 
            else{
                $col = '';
                $blog_layout = ''; 
            }
        }
        else{
            $col         ='';
            $blog_layout =''; 
            $layout      ='';
            $blog_grid   ='12';
        }
    ?>
    <div class="container">
        <div id="content">
            <div class="row padding-<?php echo esc_attr( $layout) ?>">  
                <div class="contents-sticky col-md-12 col-lg-8<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>">
                    <div class="row">            
                        <?php
                        if ( have_posts() ) :           
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();                             
                            $post_id        = get_the_id();
                            $author_id      = get_post_field ('post_author', $post_id);
                            $display_name   = get_the_author_meta( 'display_name' , $author_id );                     
                            $no_thumb = "";
                            if ( !has_post_thumbnail() ) {
                              $no_thumb = "no-thumbs";
                            }
                        ?>
                        <div class="col-sm-<?php echo esc_attr($blog_grid);?> col-xs-12">
                            <article <?php post_class();?>>
                                <div class="blog-item <?php echo esc_attr($no_thumb); echo esc_attr($industrie_blog_page_btn_setting); ?>">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <div class="blog-img">
                                            <a href="<?php the_permalink();?>">
                                                <?php the_post_thumbnail('industrie_blog-single');?>
                                            </a>                                  
                                            <div class="blog-meta">
                                                <ul class="btm-cate">                                                    

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
                                                    </ul>                                                         
                                            </div>
                                        </div>                                    
                                    <?php } ?> 
                                    
                                    <div class="full-blog-content">
                                        <div class="title-wrap">                                                                    
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
                                                        <?php if ( has_post_thumbnail() ) { 
                                                        } else { ?>
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
                                                        } } ?>
                                                    </ul>                                                         
                                                </div>
                                            </div>
                                            <h3 class="blog-title">
                                                <a href="<?php the_permalink();?>">
                                                    <?php the_title();?>
                                                </a>
                                            </h3>

                                            <div class="blog-desc"> 
                                            <?php 
                                                if ( ! has_excerpt() ) {
                                                    echo wp_trim_words( get_the_content(), 34, '...' );
                                                } else { 
                                                    the_excerpt();
                                                }
                                            ?>                                     
                                            </div>

                                           

                                            <?php if(!empty($industrie_blog_page_custom_read_more)){ ?>                                          
                                                <div class="blog-button">
                                                    <a href="<?php the_permalink();?>">
                                                        <?php echo esc_html($industrie_blog_page_custom_read_more); ?>
                                                    </a>
                                                </div>
                                            <?php } else { ?>

                                            <div class="blog-button">
                                                <a href="<?php the_permalink();?>"><?php esc_html_e('Continue Reading', 'industrie');?></a>
                                            </div>

                                          <?php } ?>
                                    </div>
                              </div>
                            </article>
                        </div>
                        
                        <?php  
                          endwhile; 
                          wp_reset_query();                       
                        ?>
                    </div>
                    <div class="pagination-area">
                        <?php
                            the_posts_pagination();
                        ?>
                    </div>
                    <?php
                    else :
                    get_template_part( 'template-parts/content', 'none' );
                    endif; ?> 
                </div>
            <?php if( $layout != 'full-layout' ):     
               get_sidebar();    
             endif;
            ?>
          </div>
        </div>
    </div>
</div>
<?php get_footer();