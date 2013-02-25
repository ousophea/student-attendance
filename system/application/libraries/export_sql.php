<?php

/***************************************************************
 * SQL_Export class
 *
 * @package DB Export
 * @subpackage   Library
 * @date    - 16 May 2011
 * @Author  - Neeraj Avinash
 * @email   - info@webvalley.info
 * @link    - http://webvalley.info
***************************************************************/

class Export_Sql{
	private $_tables, $_exported, $_ci;

        /**
         * Public default constructor
         */
        public function  __construct(  ){
            //  Set time limit to 0 to override default time limit of php engine.
            set_time_limit(0);
            
            $memoryLimit = '1G';
            ini_set("memory_limit",$memoryLimit);

            $this->_ci = &get_instance();

	}

        /**
         * Public function export
         * This method reads the DB tables and create the sql commands for the structure and complete insert.
         * @param <Array> $tables . Tables to be exported
         * @param <Bool> $db . Flag to tell to export complete DB
         * @return <String>
         */
        public function export( $tables = array(), $where = NULL, $db = FALSE ){
            //  Do Initialize
            $this->_tables = array();

            //  If db is set to true export all tables
            if ( $db ){
                $sql = 'SHOW TABLES';
                $response = $this->_ci->db->query($sql)
                                        ->result_array();
                if ( $response ){

                    foreach ($response as $table ){
                        $this->_tables[] = array($table[key($table)] => TRUE);
                    }
                }
            }else{
                // Set tables to import
                $this->_tables = $tables;
            }

            foreach($this->_tables as $tbl => $exportData){
                $header = $this->_create_header($tbl);
                $data = $this->_get_data($tbl, $where, $exportData);

                $this->_exported .= "###################\n# Dumping table $tbl\n###################\n\n$header" . $data . "\n";
            }

            //  Cleanup
            unset( $header, $data, $tbl );

            $filename = 'dump_sql.sql';
            $filesize = strlen( $this->_exported );

            header( 'Content-Type: application/force-download; charset=utf-8' );
            header( 'Content-Length: '.$filesize );
            header( 'Content-Disposition: attachment; filename="'.$filename.'"' );
            header( 'Cache-Control: max-age=10' );
            echo $this->_exported;

            //unlink($target);
            return TRUE;
	}

        /**
         * Private function _create_header
         * This method creates table header for the create query.
         * @param <type> $table
         * @return <type>
         */
	private function _create_header($table = NULL){
            //  Do Initialize
            $createQuery = '';
            
            //  For a failsafe if the table already exists, need to do a alter instead of create table.
            $sql = "SHOW TABLES LIKE '". $table ."'";
            $response = $this->_ci->db->query($sql)
                                    ->result_array();
            
            if ( count($response) > 0 ){
                //  Table not found, lets create a new table in DB.
                $sql = 'SHOW CREATE TABLE  `'. $table .'`';
                $response = $this->_ci->db->query($sql)
                                        ->result_array();
                if ( $response ){
                    $sql = current($response);

                    $createQuery = array_pop($sql);
                }

                $createQuery     = preg_replace('/^CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $createQuery);
            }
            return $createQuery . ";\n\n";
	}

        /**
         * Private function _get_data
         * This method creates the insert query
         * @param <type> $table
         * @return string
         */
	private function _get_data( $table = NULL, $where = NULL, $exportData = FALSE){
            //  If export data is false, return.
            if ( !$exportData )
                return ;
            
            $_where = '';
            if (is_array($where)){
                foreach ( $where as $key => $value )
                $_where .= " AND " . $key . " = '". $value ."'";
            }

            $sql = 'SELECT * FROM   `'. $table .'` WHERE 1 ' . $_where;
            $response = $this->_ci->db->query($sql)
                                    ->result_array();

            //  Do Initialize
            $dataQuery = '';

            if ( $response ){
                //  Loop through the response
                foreach ( $response as $val ){
                    //  Build insert header. USE REPLACE instead of INSERT so that if there is any previous record, it deletes and then iserts.
                    $dataQuery .= 'REPLACE INTO `'. $table .'` VALUES (';

                    //  Do Initialize the array to hold values
                    $values = array();

                    foreach ($val as $key => $value){
                        if ( strtolower($key) == 'id' && $value == '' )
                            $value = 'NULL';
                        else
                            $value = "'" . mysql_real_escape_string ($value) . "'";
                        $values[] = $value;
                    }

                    $dataQuery .= implode(', ', $values);
                    $dataQuery .= ");\n\n";
                }
            }
            return $dataQuery;
	}
}

/* End of file export_sql.php */
/* Location: ./libraries/export_sql.php */