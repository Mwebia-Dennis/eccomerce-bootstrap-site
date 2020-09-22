<?php
    
    include 'connection.php';
    class QueryMysql {

        public function getData($query) {
            global $conn;
            $result = $conn->query($query);
            $_data = [];
            if($result->num_rows > 0){
                
                while($row = $result->fetch_assoc()){
                    
                    $_data[] = $row;
                }
                
            }
            
            return $_data;
            
        }
        
        public function runQuery($query) {
            global $conn;

            return $conn->query($query);
        }
        
        public function executeQuery($query) {
            global $conn;
            
            return $conn->query($query)->num_rows;
        }
        
        public function getAll($table_name) {
            global $conn;
            return $this->getData("SELECT * FROM ".$conn->real_escape_string($table_name)." order by date_added desc");
        }
    
    }
?>