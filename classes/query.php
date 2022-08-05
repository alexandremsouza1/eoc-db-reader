<?php

class DBR_Query {
    private $query_string = '';

    public function get_query_cms(){
        global $wpdb;
        $this->query_string = 'SELECT * FROM cms
        WHERE id IN (
            SELECT MAX(id)
            FROM cms
            GROUP BY varid
        )';
        return $this->query_string;
    }

    public function insert_register_cms($data){
        global $wpdb;
        $varid = $data['varid'] ?? false;
        $content = $data['content'] ?? false;
        if($varid && $content){
            $result = $wpdb->query($wpdb->prepare("INSERT INTO cms (varid,content) VALUES('%s','%s');", $varid, $content));
            return $result;
        }
    }

}

$var = new DBR_Query();
add_action( 'insert_register_cms', array( &$var, 'insert_register_cms' ) );
?>
