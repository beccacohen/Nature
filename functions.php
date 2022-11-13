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
  Adding menus to theme
====================================*/
function register_my_menus(){
  register_nav_menus(array(
    'main-menu'     => __('Main Menu'),
    'footer-left'   => __('Left Footer Menu'),
    'footer-middle' => __('Middle Footer Menu'),
    'footer-right'  => __('Right Footer Menu'),
    'mobile-menu'   => __('Mobile Menu')
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
/*===================================
Breadcrumbs
====================================*/
function Breadcrumb() {
  $delimiter = '/';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<div class="wrap" id="crumbs">';

    global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';

  if ( is_category() ) {
    global $wp_query;
    $cat_obj = $wp_query->get_queried_object();
    $thisCat = $cat_obj->term_id;
    $thisCat = get_category($thisCat);
    $parentCat = get_category($thisCat->parent);
    if ($thisCat->parent != 0) echo(get_category_parents($parentCat,
    TRUE, ' ' . $delimiter . ' '));
    echo $currentBefore . 'Archive by category &#39;';
    single_cat_title();
    echo '&#39;' . $currentAfter;

  } elseif ( is_day() ) {
    echo '<a href="' . get_year_link(get_the_time('Y')) . '">' .
    get_the_time('Y') . '</a> ' . $delimiter . ' ';
    echo '<a href="' .
    get_month_link(get_the_time('Y'),get_the_time('m')) . '">' .
    get_the_time('F') . '</a> ' . $delimiter . ' ';
    echo $currentBefore . get_the_time('d') . $currentAfter;

  } elseif ( is_month() ) {
    echo '<a href="' . get_year_link(get_the_time('Y')) . '">' .
    get_the_time('Y') . '</a> ' . $delimiter . ' ';
    echo $currentBefore . get_the_time('F') . $currentAfter;

  } elseif ( is_year() ) {
    echo $currentBefore . get_the_time('Y') . $currentAfter;

  } elseif ( is_single() && !is_attachment() ) {
    $cat = get_the_category(); $cat = $cat[0];
    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
    echo $currentBefore;
    the_title();
    echo $currentAfter;

  } elseif ( is_attachment() ) {
    $parent = get_post($post->post_parent);
    $cat = get_the_category($parent->ID); $cat = $cat[0];
    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
    echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
    echo $currentBefore;
    the_title();
    echo $currentAfter;

  } elseif ( is_page() && !$post->post_parent ) {
    echo $currentBefore;
    the_title();
    echo $currentAfter;

  } elseif ( is_page() && $post->post_parent ) {
    $parent_id  = $post->post_parent;
    $breadcrumbs = array();
    while ($parent_id) {
      $page = get_page($parent_id);
      $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' .
      get_the_title($page->ID) . '</a>';
      $parent_id  = $page->post_parent;
    }
    $breadcrumbs = array_reverse($breadcrumbs);
    foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . '
    ';
    echo $currentBefore;
    the_title();
    echo $currentAfter;

  } elseif ( is_search() ) {
    echo $currentBefore . 'Search results for &#39;' .
    get_search_query() . '&#39;' . $currentAfter;

  } elseif ( is_tag() ) {
    echo $currentBefore . 'Posts tagged &#39;';
    single_tag_title();
    echo '&#39;' . $currentAfter;

  } elseif ( is_author() ) {
    global $author;
    $userdata = get_userdata($author);
    echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;

  } elseif ( is_404() ) {
    echo $currentBefore . 'Error 404' . $currentAfter;
  }

  if ( get_query_var('paged') ) {
  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
  echo __('Page') . ' ' . get_query_var('paged');
  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
}
  echo '</div>';
  }
}
?>
