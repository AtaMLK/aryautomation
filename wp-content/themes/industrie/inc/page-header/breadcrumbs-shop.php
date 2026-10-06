<?php 
  $shop_page_title = get_theme_mod( 'wc_shop_page_title' );
?>

<div class="rs-breadcrumbs porfolio-details">
    <div class="rs-breadcrumbs-inner">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="breadcrumbs-inner">
                    <h1 class="page-title">
                        <?php if( $shop_page_title !='' ){
                            echo esc_html( $shop_page_title );
                            } else {                                
                                woocommerce_page_title();
                            }
                        ?>
                    </h1>               
                </div>
              </div>
            </div>
          </div>
    </div>
</div>