<?php
//Required files for the CMS Table plugin.

$filepath = realpath (dirname(__FILE__));

include_once($filepath.'/settings.php');

include_once($filepath.'/admin/admin.php');

include_once($filepath.'/classes/query.php');
include_once($filepath.'/classes/recordset.php');



function eocdbr_register_stylesheet(){
    //wp_register_style( 'eocdbr', plugins_url('css/eocdbr.css', __FILE__) );
    //wp_register_style( 'bootstrap-table-style.min', plugins_url('css/bootstrap-table.min.css', __FILE__) );
    //wp_enqueue_style( 'eocdbr' );
    //wp_enqueue_style( 'bootstrap-table-style.min' );
}

add_action( 'wp_enqueue_scripts', 'eocdbr_register_stylesheet' );


function eocdbr_register_javascript(){
	wp_enqueue_script( 'table', plugins_url('js/table.js', __FILE__), array('jquery'));
    wp_enqueue_script( 'bootstrap-table-min-js', plugins_url('js/bootstrap-table-min.js', __FILE__), array('jquery'), '1.0' );
}

// Admin Page Functions
function eocdbr_plugin_admin_link($links) {
  $admin_link = '<a href="admin.php?page=eocdbr-admin">Settings</a>';
  array_unshift($links, $admin_link);
  return $links;
}
$plugin = plugin_basename($filepath.'/eoc-db-reader.php');
add_filter("plugin_action_links_$plugin", 'eocdbr_plugin_admin_link' );

// Front End Functions
function dbr_show_table($atts){
    extract(shortcode_atts(array('query_set_id' => 0), $atts));
    $query = new DBR_Query();
    $rc = new DBR_RecordSet();
    $rc->setQuery($query->get_query_cms());
    $rc->displayTable();
}
add_shortcode('dbr_show_table','dbr_show_table');

function dbr_show_form($atts){
    extract(shortcode_atts(array('query_set_id' => 0), $atts));
    $query = new DBR_Query();
    $rc = new DBR_RecordSet();
    $rc->setQuery($query->get_query_cms());
    $rc->displayForm();
}
add_shortcode('dbr_show_form','dbr_show_form');


add_action( 'admin_menu', 'register_page');


function register_page()
{
    add_action( 'admin_enqueue_scripts', 'enqueue_bootstrap' );
}



function enqueue_bootstrap()
{
  $path1 = plugins_url('css/bootstrap.css', __FILE__); 
  $path2 = plugins_url('css/bootstrap-table.min.css', __FILE__); 
  $dependencies = array(); //add any depencdencies in array
  $version = false; //or use a version int or string
  wp_enqueue_style( 'bootstrap-table', $path1, $dependencies, $version );
  wp_enqueue_style( 'bootstrap', $path2, $dependencies, $version );
}

?>

