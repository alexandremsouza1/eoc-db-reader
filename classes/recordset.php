<?php

class DBR_RecordSet {
    private $query = '';
    private $results = array();
    private $base_table = '';

    private function fetchRecordsArray(){
        global $wpdb;
        $results = $wpdb->get_results($this->query,ARRAY_A);
        $this->results = $results;
    }

    private function fetchRecordsObject(){
        global $wpdb;
        $results = $wpdb->get_row($this->query,OBJECT);
        $this->results = $results;
    }

    private function formatForm(){
		echo 'Base Table: ' . $this->base_table . '<br />';
		?>
			<div class=wrap>
				<form method="post" action ="">
					<table id="example" class="table widefat post fixed">
					<?php 
					echo "\t";
					foreach ($this->results as $key => $value){
						echo '<tr><th class="eocdbr"><label class="eocdbr" for="'.$key.'">'.$key.': </label></th>'."\n"."\t"."\t"."\t"."\t"."\t"."\t"."\t";
						echo '<td class="eocdbr"><input class="eocdbr" type="text" id="'.$key.'" name="'.$key.'" value="'.$value.'" /></td></tr>'."\n"."\t"."\t"."\t"."\t"."\t"."\t";
					}
					echo "\n";
					?>
					</table>
					<button type="submit" name="submit">Submit</button>
				</form>
			</div> 
		<?php
		$_POST['table_name'] = $this->base_table;
		
	}

	private function writeRecords(){
		foreach($_POST as $key => $value){
			echo "$key => $value<br>";
		}
	}

	public function setQuery($query_string){
        $this->query = $query_string;
    }
    
    public function setBaseTable($query_string){
		global $wpdb;
		$explain = array();
		$base_table_query = 'EXPLAIN '. $query_string;
		$explain = $wpdb->get_row($base_table_query,ARRAY_A);
		$this->base_table = $explain["table"];
	}
     
    public function displayTable(){
        $this->fetchRecordsArray($this->query);
        add_thickbox();
        if(count($this->results) == 0) {
			?>
            <em>No rows returned</em>
            <?php
        } else {
            echo '<a href="#TB_inline?width=600&height=550&inlineId=modal-window-id-new" class="thickbox">Insert Register</a>';
            echo'
              <table   
                    id="table"
                    data-toggle="table"
                    data-search="true"
                    data-pagination="true"
                >
                <thead>
                        <tr>
                            <th scope="col">'.implode('</th><th>', array_keys(reset($this->results))).'
                            <th scope="col">edit</th>
                        </th>
                    </tr>
                </thead>
                <tbody>'."\n";
            foreach($this->results as $result) {
                array_push($result, $this->linkContent($result));
                echo '<tr><td scope="row">'.implode('</td><td>', array_values($result)).'</td></tr>'."\n";
            }
            ?>
            </tbody></table>
            <?php
        }
        echo $this->insertLastLink();
    }


    public function displayForm(){
        if (!isset($_POST['submit'])) {
			//$this->setBaseTable ($this->query);
            $this->fetchRecordsObject($this->query);
            if(count($this->results) == 0) {
                echo '<em>No rows returned</em>';
            } else {
				$this->formatForm();
            }
        } else {
            $this->writeRecords();
        }
    }

    public function editIconSvg()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
        </svg>';
    }

    public function linkContent($values,$readOnlyVarid = false)
    {
        return '
        <a href="#TB_inline?width=600&height=550&inlineId=modal-window-id-'.$values['id'].'" class="thickbox">'.$this->editIconSvg().'</a>
        <div id="modal-window-id-'.$values['id'].'" style="display:none;">
            <form id="form-update" method="post" action="">
                <div class="form-group">
                    <label for="values-id">ID</label>
                    <input id="values-id" type="text" class="form-control" readonly name="id" value="'.$values['id'].'" />
                </div>
                <div class="form-group">
                    <label for="values-varid">Varid</label>
                    <input id="values-varid" type="text" class="form-control" readonly="'.$readOnlyVarid.'" name="varid" value="'.$values['varid'].'" />
                </div>
                <div class="form-group">
                    <textarea id="values-content" name="content" rows="10" cols="50" class="form-control">'.$values['content'].'</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>';
    }

    public function insertLastLink()
    {
        return '<div id="modal-window-id-new" style="display:none;">
            <form id="form-update-new" method="post" action="">
            <div class="form-group">
                <label for="values-id">ID</label>
                <input id="values-id" type="text" class="form-control" readonly name="id" value="" />
            </div>
            <div class="form-group">
                <label for="values-varid">Varid</label>
                <input id="values-varid" type="text" class="form-control"  name="varid" value="" />
            </div>
            <div class="form-group">
                <textarea id="values-content" name="content" rows="10" cols="50" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>';
    }
}
?>
