<?php
    $post_id        = get_the_id();
    $author_id      = get_post_field ('post_author', $post_id);
    $display_name   = get_the_author_meta( 'display_name' , $author_id );

    $industrie_blog_single_hide_author = get_theme_mod('industrie_blog_single_hide_author');
    $industrie_blog_single_hide_comment = get_theme_mod('industrie_blog_single_hide_comment');
    $industrie_blog_single_hide_published = get_theme_mod('industrie_blog_single_hide_published');
    $industrie_blog_single_hide_category = get_theme_mod('industrie_blog_single_hide_categiry');
 ?>

<div class="rs-breadcrumbs porfolio-details">    
    <div class="rs-breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumbs-inner"> 
                        <h1 class="page-title">
                            <?php the_title(); ?>
                        </h1>
                        <ul class="breadcrumbs-meta breadcrumbs-meta-rstheme">
                            <?php if( $industrie_blog_single_hide_author == 1 ){ ?>
                            
                            <?php } else { ?>
                                <li>
                                    <div class="postedby">                                    
                                        <div class="info">
                                            <span class="name">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                <?php 
                                                    echo esc_html($display_name);
                                                ?>
                                            </span>                                        
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>

                            <?php if( $industrie_blog_single_hide_published == 1 ){ ?>
                            
                            <?php } else { ?> 
                                
                                <li>                                
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                        <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                    </span>
                                </li>
                            <?php } ?>
                            <?php if( $industrie_blog_single_hide_category == 1 ){ ?>
                            
                            <?php } else { ?> 
                            <li>                                                               
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                <ul class="single-posts-meta">
                                    <li class="post-cate">                                                      
                                        <?php
                                            //tag add
                                            $seperator = ', '; // blank instead of comma
                                            $after = '';
                                            $before = '';
                                            echo '<div class="tag-line">';
                                            ?>                                                
                                            <?php
                                            the_category(', '); 
                                            echo '</div>';
                                        ?> 
                                    </li>
                                </ul> 
                            </li>
                            <?php } ?>

                            <?php if( $industrie_blog_single_hide_comment == 1 ){ ?>
                            
                            <?php } else { ?> 
                            <li>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    <?php echo get_comments_number( '0', '1', '%' ); ?>
                                </span>
                            </li>
                            <?php } ?>
                        </ul>      
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>