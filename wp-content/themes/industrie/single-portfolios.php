<?php 
get_header();

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
                        <?php if(has_post_thumbnail()){ ?>
                        <div class="bs-img bs-img-port-single">
                            <?php the_post_thumbnail('industrie_porfolio-single-size'); ?>                                        
                        </div>
                        <?php } ?>
                        

                        <?php while ( have_posts() ) : the_post(); ?>   
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php
                                  get_template_part( 'template-parts/post/content', get_post_format() );         
                                ?>
                                <div class="clear-fix"></div> 
                                <?php get_template_part( 'pagination' ); ?>                                      
                            </article> 
                        
                        <?php       
                        $author_meta = get_the_author_meta('description'); 
                        if( !empty($author_meta) ){ ?>
                            <div class="author-block">
                              <div class="author-img"> <?php echo get_avatar(get_the_author_meta( 'ID' ), 200);?> </div>
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
                if( $page_layout == '2left' || $page_layout == '2right'): ?>
                    <div class="col-lg-4 rs-portfolio-single-sidebar"> <?php dynamic_sidebar('rs-projects-sidebars'); ?></div>
                <?php endif; ?>
            </div>
                
            </div>
          <!-- Blog Detail End --> 
        </div>
    </div>
<!-- .container -->
<?php
get_footer();