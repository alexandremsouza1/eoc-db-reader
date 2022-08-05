<?php
/***************************************************************************


        CMS Table
        Author: Alexandre Magno
        Website: www.ericolsonconsulting.com
        Contact: https://www.linkedin.com/in/alexandre-m-souza/

        This file is part of CMS Table.

    CMS Table is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    CMS Table is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with CMS Table; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
        
        You can find a copy of the GPL licence here:
        http://www.gnu.org/licenses/gpl-3.0.html
        
******************************************************************************/
$filepath = realpath (dirname(dirname(__FILE__)));
include_once($filepath.'/includes.php');

function eocdbr_add_plugins_page(){
    $page_title =  'CMS Table';
    $menu_title = 'CMS Table';
    $capability = 'manage_options';
    $menu_slug = 'eocdbr-admin';
    $function = 'eocdbr_admin_page';
    $icon_url = plugin_dir_url( __FILE__ ).'images/eocdbr.png';
    
    $my_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url);
    add_action( 'load-' . $my_page, 'load_admin_scripts' );    
}
add_action( 'admin_menu','eocdbr_add_plugins_page');

function load_admin_scripts(){
	add_action( 'admin_enqueue_scripts', 'enqueue_admin_css' );
	add_action( 'admin_enqueue_scripts','eocdbr_register_javascript');
}

function enqueue_admin_css($page) {
	$admin_css = plugins_url('/css/eocdbr-admin.css',__FILE__);
	wp_enqueue_style('eocdbr-admin', $admin_css);
}

function eocdbr_admin_page(){ ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2>CMS Table Setting</h2>
        <form method="post"> 
            <?php settings_fields( 'default' ); ?>
            <h3>CMS View Table</h3>
                <p>Edit and view CMS table contents</p>
        </form>
        <?php
			$query = new DBR_Query();
			$rc = new DBR_RecordSet();
			$rc->setQuery($query->get_query_cms());
			$rc->displayTable();
        ?>
    </div>
<?php
}

function dbr_list_tables(){
        global $wpdb;
        $query = 'show tables;';
        $results = $wpdb->get_results($query,ARRAY_A);
    return $results;
}

function dbr_table_select_options($results) {
    if(count($results) == 0) {
         echo '<em>No rows returned</em>';
    } else {
		echo '<tr><th class="eocdbr"><label class="eocdbr" for="eocdbr_table">Select Table: </label></th><td class="eocdbr"><select id="eocdbr_tables" name="eocdbr_tables">'."\n";
        foreach($results as $result) {
                echo '<option value="'.implode('">', array_values($result)).'">'.implode('</option>',array_values($result)).'</option>';
        }
        echo '</select></td></tr><br />';
    }
}

?>
