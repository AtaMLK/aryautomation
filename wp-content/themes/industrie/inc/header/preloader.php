<?php
$preloader_img = "";
if(!empty(get_theme_mod('industrie_enable_preloader'))){

    $loading = get_theme_mod('industrie_enable_preloader');
    if(!empty(get_theme_mod('industrie_preloader_image'))){
        $preloader_img = get_theme_mod('industrie_preloader_image');
    }

    if($loading == 1){
      if(empty($preloader_img)):
      ?> 
        <div id="pre-load">
            <div class="loader-pre">
                <div id="loader" class="loader">
                    <div class="loader-container">
                        <div class='loader-icon'></div>
                    </div>
                </div>
            </div>
        </div>     
        <?php else: ?>
        <div id="pre-load">
            <div id="loader" class="loader">
                <div class="loader-container">
                    <div class='loader-icon'><img src="<?php echo esc_url(get_theme_mod('industrie_preloader_image')); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></div>
                </div>
            </div>              
        </div>
      <?php endif; ?>
  <?php }
}