<?php get_header(); ?>
<main class="container">
  <?php Breadcrumb(); ?>
<?php
    if(have_posts()){
      while(have_posts()) {
        the_post(); ?>

        <div class="single-post">
          <div class="featured-image img-post-single">
              <?php the_post_thumbnail('large'); ?>
          </div><!--featured-image-->

          <div class="text-container">
            <h2><?php the_title();?></a></h2>

            <?php
              post_data();
            ?>
            <p class="body-content"><?php the_content(); ?></p>
          </div><!--text-container-->
        </div><!--single-page-->
        <?php
      }
    }
?>
  </main>
<?php get_footer(); ?>
