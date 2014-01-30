<?php
/***************************************************************************


EOC Database Reader
Author: Eric Olson Consulting LLC
Website: www.ericolsonconsulting.com
Contact: http://www.ericolsonconsulting.com
                                
This file is part of EOC Database Reader.
                                        
EOC Database Reader is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

EOC Database Reader is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with EOC Database Reader; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

                                                                                                    You can find a copy of the GPL licence here:
                                                                                                            http://www.gnu.org/licenses/gpl-3.0.html
                                                                                                                    
                                                                                                                    ******************************************************************************/
$filepath = realpath (dirname(__FILE__));
include_once($filepath.'/includes.php');

function eocdbr_register_settings(){
    add_option( 'eocdbr_query', '');
    register_setting( 'default', 'eocdbr_query' );
}
add_action( 'admin_init', 'eocdbr_register_settings' );

?>
