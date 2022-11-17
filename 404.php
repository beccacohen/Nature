<?php get_header(); ?>
<div class="container">
  <section class="page-404">
    <div class="row">

      <div class="col-md-8 align-items-center">

      <section class="error-container">
        <span class="error">4</span>
        <span class="error"><span class="screen-reader-text">0</span></span>
        <span class="error">4</span>
      </section>

      <h1>Opps something went wrong</h1>
      <div class="link-container">
        <a href="<?php echo get_home_url(); ?>" class="more-link">Go home</a>
      </div>
    </div>

      <aside class="col-md-3">

        <?php dynamic_sidebar('sidebar-widget'); ?>
      </aside>
    </div>
  </section>
</div>

<?php get_footer(); ?>
