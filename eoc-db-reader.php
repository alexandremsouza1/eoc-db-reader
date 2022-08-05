<?php
/*
Plugin Name: CMS Table
Plugin URI: https://www.linkedin.com/in/alexandre-m-souza/
Description: CMS Table is an exercise in retrieving records from a database query.
Version: 0.0.1
Author: Alexandre Magno
Author URI: https://www.linkedin.com/in/alexandre-m-souza/
License: GPL3
*/


$filepath = realpath (dirname(__FILE__));
include_once($filepath.'/includes.php');

$args = $_POST;
apply_filters( 'insert_register_cms', $args );

?>
