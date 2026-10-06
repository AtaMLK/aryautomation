<?php
  $industrie_page_banner = get_theme_mod( 'industrie_page_banner' );
  $industrie_page_breadcrumb_val = get_post_meta( get_the_ID(), 'industrie_page_breadcrumb_val', true );

if( $industrie_page_breadcrumb_val != 1 ){
  if($industrie_page_banner !=''){
  ?>
  <div class="rs-breadcrumbs">
      <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($industrie_page_banner); ?>')">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumbs-inner">
                  <?php 
                    $industrie_page_custom_title = get_theme_mod( 'industrie_page_custom_title' );
                  ?>
                  <h1 class="page-title">
                    <?php if($industrie_page_custom_title !=''){
                        echo esc_html($industrie_page_custom_title);
                    } else {
                        the_title();
                    }
                    ?>
                  </h1>
                  <?php
                    $industrie_page_custom_desc = get_theme_mod( 'industrie_page_custom_description' );
                    if($industrie_page_custom_desc !=''){
                  ?>  
                      <h6 class="intro-title">
                          <?php echo esc_html( $industrie_page_custom_desc ); ?>
                      </h6>
                  <?php } ?>
                                  
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <?php }
  else{
  ?>
    <div class="rs-breadcrumbs  porfolio-details">
      <div class="rs-breadcrumbs-inner">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumbs-inner">
                <?php 
                  $industrie_page_custom_title = get_theme_mod( 'industrie_page_custom_title' );            
                ?>
                <h1 class="page-title">
                    <?php if($industrie_page_custom_title !=''){
                        echo esc_html($industrie_page_custom_title);
                    } else {
                        the_title();
                    }
                    ?>
                </h1>
                <?php
                  $industrie_page_custom_desc = get_theme_mod( 'industrie_page_custom_description' );
                  if($industrie_page_custom_desc !=''){
                ?>  
                    <h6 class="intro-title">
                        <?php echo esc_html( $industrie_page_custom_desc ); ?>
                    </h6>
                <?php } ?>
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
    }
}