<?php
/**
 * @author  rs-theme
 * @version 1.0.0 
 */
?>  
</div><!-- .main-container -->
<footer id="rs-footer" class="rs-footer">
    <div class="footer-bottom">
        <div class="container">        
            <div class="rs-copyright"> <?php echo esc_html('&copy;')?> <?php echo date("Y");?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> </div>        
        </div>
    </div>
</footer>
</div><!-- #page -->
<?php 
if(!empty(get_theme_mod('industrie_enable_go_to_top'))){
?>
 <!-- start scrollUp  -->
<div id="scrollUp">
    <i class="ri-arrow-up-s-line"></i>
</div>   
<?php } 
 wp_footer(); ?>
  </body>
</html>
