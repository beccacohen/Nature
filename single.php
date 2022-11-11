<?php get_header(); ?>
<main class="container">
<?php
    if(have_posts()){
      while(have_posts()) {
        the_post(); ?>

        <div class="single-post">
          <div class="featured-image">
              <?php the_post_thumbnail(); ?>
              <?php post_data(); ?>
          </div><!--featured-image-->
          <div class="text-container">
            <h2><?php the_title();?></a></h2>
            <p class="body-content"><?php the_content();?></p>
            <?php dynamic_sidebar('sidebar-widget'); ?>
          </div><!--text-container-->
        </div><!--individual-post-->
        <?php
      }
    }
?>
  </main>
<?php get_footer(); ?>
