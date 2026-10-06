<?php 
$logo_height        = !empty(get_theme_mod('industrie_logo_height')) ? 'style = "max-height: '.get_theme_mod('industrie_logo_height').'"' : '';
$sticky_logo_height = !empty(get_theme_mod('industrie_sticky_logo_height')) ? 'style = "max-height: '.get_theme_mod('industrie_sticky_logo_height').'"' : '';


if ( has_custom_logo() ){ ?>
    <div class="logo-area">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php the_custom_logo(); ?></a>          
    </div>
    <div class="logo-area sticky-logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php the_custom_logo(); ?></a>
    </div>
<?php } else { ?>
    <div class="logo-area">
        <?php
            if (!empty( get_theme_mod('industrie_default_logo') ) ) { ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img <?php echo wp_kses($logo_height, 'industrie');?> src="<?php echo esc_url(get_theme_mod('industrie_default_logo')); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
        <?php } 
        else {?>
          <div class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>         
           <?php  } 
        ?>
    </div>
    <?php if (!empty( get_theme_mod('industrie_sticky_logo') ) ) { ?>
        <div class="logo-area sticky-logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img <?php echo wp_kses($sticky_logo_height, 'industrie');?> src="<?php echo esc_url(get_theme_mod('industrie_sticky_logo')); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
           </div>
    <?php }

    else {?>
    <div class="logo-area sticky-logo">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    </div>
<?php }
}