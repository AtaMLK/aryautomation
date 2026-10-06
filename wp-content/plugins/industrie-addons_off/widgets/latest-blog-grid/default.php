
<?php use Elementor\Icons_Manager; ?>


<div class="col-md-<?php echo esc_html($settings['col_md']);?> col-sm-<?php echo esc_html($settings['col_sm']);?> col-lg-<?php echo esc_html($settings['blog_columns']);?>">
	<div class="pre-blog-item">
		<div class="blog-inner-wrap">

            <!-- Image Part -->
            <?php if ( 'yes' === $settings['blog_image_show_hide'] ){ ?>
                <div class="pre-image-wrap">
                    <?php if ('yes' === $settings['blog_image_show_hide']){ ?>                                            
                        <a class="pre-pointer-events" href="<?php the_permalink();?>">
                            <?php  the_post_thumbnail($settings['thumbnail_size']);?>
                        </a>
                    <?php } ?>                                         
                    
                    <!-- == Show Category== -->
                    <?php if ( 'yes' === $settings['blog_cat_show_hide'] ){ ?>
                        <div class="pre-cat-list">
                            <?php include plugin_dir_path(__FILE__)."/categorys.php"; ?>
                        </div>
                    <?php } ?>

                </div>
            <?php }?>


            <!-- Meta Wrapper -->
            <?php if ( 'yes' === $settings['blog_meta_show_hide'] ){ ?>
                <div class="meta-wrapper">
                    
                    <!-- Author Meta -->
                    <?php if ( 'yes' === $settings['author_meta'] ){ ?>
                        <?php if(!empty($post_admin)){ ?>
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <span class="pre-admin">
                                    <?php if ( 'yes' === $settings['blog_avatar_show_hide'] ){?>
                                        <em class="pre-avatar-image"><?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?></em>
                                    <?php } else {

                                            if ( $settings['author_icon'] ):
                                                Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] );
                                            endif; 
                                        } 
                                    ?>
                                    <?php echo esc_html($post_admin);?>
                                </span>
                            </a>
                        <?php } ?>
                    <?php } ?>

                    <!-- Date -->
                    <?php if ( 'yes' === $settings['blog_meta_show_hide'] ){ ?>
                        <div class="pre-blog-meta">
                            <?php if(!empty($_day) && !empty($_month)){ ?>
                                <span class="pre-date"><?php echo esc_html($_day);?></span>
                                <span class="pre-month"><?php echo esc_html($_month);?></span>
                            <?php } ?>
                        </div>
                    <?php  }  ?>

                </div>
            <?php } ?>


            <!-- Title Part -->
            <?php if ( 'yes' === $settings['blog_title_show_hide'] ){ ?>
                <div class="pre-title-wrap">
                    <h3 class="pre-post-title">
                        <a class="pre-pointer-events" href="<?php the_permalink();?>">
                            <?php echo wp_trim_words( get_the_title(), $limits, '' ); ?>
                        </a>
                    </h3>
                 </div>                                     
            <?php } ?>

            <!-- Content Part -->
             <?php if ( 'yes' === $settings['blog_content_show_hide'] ){ ?>
                <div class="pre-content-wrap">
                    <p class="pre-content">
                        <?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?>
                    </p>
                </div>
            <?php } ?>

            <!-- Button Part -->
            <?php if ( 'yes' === $settings['blog_readmore_show_hide'] ){ ?>
                <div class="blog-btn-part">
                    <?php   $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';?>
                        <a class="blog-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                            <span class="btn-txt"><?php echo esc_html($settings['blog_btn_text']);?></span>          
                            <?php 
                                if(!empty($settings['blog_btn_icon'])) : 
                                    Icons_Manager::render_icon( $settings['blog_btn_icon'], [ 'aria-hidden' => 'true' ] );
                                endif; 
                            ?>
                        </a>
                </div>
            <?php }?>

  		</div>
	</div>
</div>