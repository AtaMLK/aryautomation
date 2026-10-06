<nav class="menu-wrap-off nav-container nav menu-ofcn">       
    <div class="inner-offcan">
        <div class="nav-link-container">  
            <a href='#' class="nav-menu-link close-button" id="close-button2">              
                <i class="ri-close-fill closes"></i>
            </a> 
        </div> 
        
        <div class="sidenav offcanvas-icon">        
            <div id="mobile_menu" class="rs-offcanvas-inner-left">
                <?php
                    if ( has_nav_menu( 'menu-1' ) ):
                        ?>                                
                            <div class="widget widget_nav_menu mobile-menus">      
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'menu-1',
                                        'menu_id'        => 'primary-menu-single1',
                                    ) );
                                ?>
                            </div>                                
                        <?php
                    endif;
                ?>
            </div>      
        </div>
    </div>
</nav>