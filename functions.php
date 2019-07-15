<?php
/**
 * Silverless functions and definitions
 *
 * @package Admin Hub
 */


/****************************************************/
/*                       Hooks                       /
/****************************************************/

/* Enqueue scripts and styles */
add_action('wp_enqueue_scripts', 'silverless_scripts');

/* Add Menus */
add_action('init', 'silverless_custom_menu' );

/* Dashboard Config */
add_action('wp_dashboard_setup', 'silverless_dashboard_widget');

/* Dashboard Style */
add_action('admin_head', 'silverless_custom_fonts');

/* Remove Default Menu Items */
add_action('admin_menu', 'silverless_remove_menus');

/* Change Posts name */
add_action( 'admin_menu', 'silverless_change_post_label' );
add_action( 'init', 'silverless_change_post_object' );

/*
* Edit Columns Posts
*/
add_filter( 'manage_posts_columns', 'silverless_manage_columns' );
add_action( 'manage_posts_custom_column' , 'silverless_custom_posts_column', 10, 2 );


/****************************************************/
/*                     Functions                     /
/****************************************************/

function silverless_scripts() {
	
	wp_enqueue_style( 'silverless-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'silverless-core-js', get_template_directory_uri() . '/inc/js/compiled.js', array('jquery'), true); 
	
}

function silverless_custom_menu() {
	
	register_nav_menus(array(
		
		'main-menu' => __( 'Main Menu' )
		
	));
}

function silverless_dashboard_widget() {
	
	global $wp_meta_boxes;
 
	wp_add_dashboard_widget('custom_help_widget', 'Silverless Support', 'custom_dashboard_help');
	
}

function custom_dashboard_help() {
?>

<img src="https://silverless.co.uk/wp-content/themes/silverless/images/logo__silverless.svg" style="max-width:100%;
height:auto;"/>

<img src="https://silverless.co.uk/wp-content/uploads/2016/10/icon-screen-delete.svg" style=" display: inline-block; width: 60px; margin: 2em calc(50% - 30px) 1em;"/>

<p>For support or general enquiries please contact us directly at <a href="mailto:hello@silverless.co.uk">hello@silverless.co.uk</a> or call <a href="tel:+44 (0)1672 556532">01672 556532</a></p>
<p>We aim to respond within 60 minutes during hours (Mon to Fri 9am - 5pm)</p>

<?php
}

function silverless_custom_fonts() {
  echo '
<style>
#menu-posts-camp .dashicons-admin-post:before{font-family:dashicons;content:"\f102"}#toplevel_page_testimonials .dashicons-admin-generic:before{font-family:dashicons;content:"\f101"}#toplevel_page_call-to-action .dashicons-admin-generic:before{font-family:dashicons;content:"\f488"}.taxonomy-where tr.form-field.term-description-wrap,body.taxonomy-what .form-field.term-description-wrap,body.taxonomy-when .form-field.term-description-wrap,body.taxonomy-where .form-field.term-description-wrap{display:none}#wpcontent,#wpfooter,#wpwrap{background:#cdc7c0}#adminmenu,#adminmenu .wp-submenu,#adminmenuback,#adminmenuwrap,#wpadminbar{background-color:#362b3a}#adminmenu .wp-has-current-submenu .wp-submenu,#adminmenu .wp-has-current-submenu .wp-submenu.sub-open,#adminmenu .wp-has-current-submenu.opensub .wp-submenu,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu,.no-js li.wp-has-current-submenu:hover .wp-submenu{background-color:#302036}#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head,#adminmenu .wp-menu-arrow,#adminmenu .wp-menu-arrow div,#adminmenu li.current a.menu-top,#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,.folded #adminmenu li.current.menu-top,.folded #adminmenu li.wp-has-current-submenu{background:#312036;color:#e57732}ul#adminmenu a.wp-has-current-submenu:after,ul#adminmenu>li.current>a.current:after{border-right-color:#cdc7c0}#adminmenu .wp-submenu a:focus,#adminmenu .wp-submenu a:hover,#adminmenu a:hover,#adminmenu li.menu-top>a:focus{color:#e4652f}

.post-type-page .acf-postbox {
  background: hsl(283, 14%, 20%);
  border-color: hsl(283, 14%, 20%);
}

.post-type-page #poststuff h2 {
  font-size: 14px;
  color: hsl(32, 12%, 78%);
  border:none;
  }

.post-type-page .acf-fields>.acf-field {
  border-color: hsl(30, 9%, 71%) !important;
}

.post-type-page .acf-flexible-content .layout {
  background: hsl(32, 12%, 78%);
  border: none;
  margin-bottom:50px;
}

.post-type-page .acf-flexible-content .layout .acf-fc-layout-handle {
    font-size:18px;
    text-transform:uppercase;
    font-weight:900;}

.post-type-page .acf-flexible-content .layout .acf-fc-layout-order {
  background: hsl(15, 73%, 46%);
  font-size: 12px;
  color: hsl(0, 0%, 100%);
}

.post-type-page .acf-flexible-content .no-value-message {
  color: hsl(0, 0%, 100%);
}

.post-type-page .inside.acf-fields > .acf-field > .acf-label {
    color: hsl(0, 0%, 100%);
    text-transform: uppercase;
    font-size: 24px;
    }

</style>';
}
 
function silverless_remove_menus(){

  remove_menu_page( 'edit-comments.php' ); //Comments
  
}

function silverless_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Websites';
    $submenu['edit.php'][5][0]  = 'Websites';
    $submenu['edit.php'][10][0] = 'Add Website';
    $submenu['edit.php'][16][0] = 'Website Tags';
}

function silverless_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name               = 'Websites';
    $labels->singular_name      = 'Website';
    $labels->add_new            = 'Add Website';
    $labels->add_new_item       = 'Add Website';
    $labels->edit_item          = 'Edit Website';
    $labels->new_item           = 'Website';
    $labels->view_item          = 'View Website';
    $labels->search_items       = 'Search Websites';
    $labels->not_found          = 'No Websites found';
    $labels->not_found_in_trash = 'No Websites found in Trash';
    $labels->all_items          = 'All Websites';
    $labels->menu_name          = 'Websites';
    $labels->name_admin_bar     = 'Websites';
}

function silverless_manage_columns( $columns ) {
	
	$columns = array(
		'cb'         => '&lt;input type="checkbox" />',
		'title'      => __( 'Name' ),
		'url'        => __( 'URL' , 'url'),
		'host_date'  => __( 'Hosting Date' , 'host_date'),
		'site_date'  => __( 'Site Date' , 'site_date'),
		'categories' => __( 'Categories' )
	);
	return $columns;
}


function silverless_custom_posts_column( $column, $post_id ) {
	
	if($column == "url") {
		$url = get_post_meta( $post_id, 'site_url', true );
		echo "<a href='http://$url'>$url</a>";
	}
	else if($column == "host_date") {
		$date = get_post_meta( $post_id, 'dates_website', true );
		echo $date ? date("d/m/Y", strtotime($date)) : "";
	}
	else if($column == "site_date") {
		$date = get_post_meta( $post_id, 'dates_hosting', true );
		echo $date ? date("d/m/Y", strtotime($date)) : "";
	}
}
