<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Salsa&display=swap" rel="stylesheet">

    <title><?php bloginfo('name'); ?></title>

    <?php wp_head(); ?>
  </head>

<body <?php body_class()?>>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-lg-2 logo-container">
          <?php
              if(get_header_image() == ''){ ?>
                  <h1><a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php
                }else{ ?>
                  <a href="<?php echo get_home_url(); ?>"><img class="logo" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="Company Logo" /></a>
                <?php
                  }
              ?>

        </div> <!--col-lg-2 logo-container -->

        <div class="col-lg-6 navigation">
          <nav class="custom-menu-class">
            <?php
              wp_nav_menu(array(
                'theme_location' => 'main-nav'
              ));
              ?>
            </div><!--col-lg-6 nav -->

            <div class="col-lg-3">
              <?php
              get_search_form(); ?>
            </div><!--col-lg-4 search-->

           </nav>
         </div> <!--/col-lg-6 navigation -->
      </div> <!--/row-->
    </div> <!--/container-->
  </header>
