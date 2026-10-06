<?php get_template_part('inc/header/off-canvas'); ?> 
<header id="rs-header" class="single-header header-style5">
    <div class="header-inner">
        <!-- Header Menu Start -->
        <div class="menu-area">
            <div class="container">
                <div class="row-table">
                    <div class="col-cell header-logo">
                      <?php get_template_part('inc/header/logo'); ?>
                    </div>
    
                    <div class="col-cell menu-responsive"> 
                        <?php              
                            require get_parent_theme_file_path('inc/header/menu.php'); 
                        ?> 
                    </div>

                    <div class="col-cell header-quote">
                        <div class="sidebarmenu-area text-right mobilehum">                                    
                            <ul class="offcanvas-icon">
                                <li class="nav-link-container"> 
                                    <a href='#' class="nav-menu-link menu-button">
                                        <i class="ri-menu-2-line"></i>
                                    </a> 
                                </li>
                            </ul>                                       
                        </div>     
                    </div>
                </div>
            </div> 
        </div>
        <!-- Header Menu End -->
    </div>
     <!-- End Slider area  -->
</header>
<?php 
get_template_part( 'inc/breadcrumbs' );