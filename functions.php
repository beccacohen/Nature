<?php
/*===================================
  Adding Stylesheets and Javascript Files
====================================*/
function custom_theme_scripts(){
  //Bootstrap css
  wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');

  //Main stylesheet
  wp_enqueue_style('main-styles', get_stylesheet_uri());

  //Javascript Files
  wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js');
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/scripts.js');
}

add_action('wp_enqueue_scripts', 'custom_theme_scripts');

/*===================================
  Adds Featured Images
====================================*/
add_theme_support('post-thumbnails');

/*===================================
  Adding menus to our theme
====================================*/
function register_my_menus(){
  register_nav_menus(array(
    'main-menu'     => __('Main Menu'),
    'footer-left'   => __('Left Footer Menu'),
    'footer-middle' => __('Middle Footer Menu'),
    'footer-right'  => __('Right Footer Menu')
  ));
}

add_action('init', 'register_my_menus');

/*===================================
  Custom Header Images
====================================*/

$custom_image_header = array(
  'width'   => 520,
  'height'  => 150,
  'uploads' => true
);

add_theme_support('custom-header', $custom_image_header);

/*===================================
  Creating Widget Areas
====================================*/
function balnk_widgets_init(){
  register_sidebar(array(
    'name'          => ('Sidebar Widget'),
    'id'            => 'sidebar-widget',
    'description'   => 'Area in the sidebar for content',
    'before_widget' => '<div class="sidebar-widget-container">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ));

  register_sidebar(array(
    'name'          => ('Top Footer Widget'),
    'id'            => 'top-footer-widget',
    'description'   => 'Area in the top footer for content',
    'before_widget' => '<div class="top-footer-widget-container">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ));

  register_sidebar(array(
    'name'          => ('Bottom Footer Widget'),
    'id'            => 'bottom-footer-widget',
    'description'   => 'Area in the bottom footer for content',
    'before_widget' => '<div class="bottom-footer-widget-container">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ));
}

add_action('widgets_init','balnk_widgets_init');

/*===================================
  Post Data Info
====================================*/
function post_data(){
  $archive_year  = get_the_time('Y');
  $archive_month = get_the_time('m');
  $archive_day   = get_the_time('d');
?>
  <p> Written by: <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a> | Publshed on: <a href="<?php echo get_day_link($archive_year,$archive_month,$archive_day); ?>"> <?php echo "$archive_month/$archive_day/$archive_year"; ?></a></p>

<?php
}

?>
