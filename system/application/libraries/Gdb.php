<?php

class Gdb {

    function Gdb() {
        $obj = & get_instance();
    }

    function backup($host, $user, $pass, $name, $path, $tables = '*') { // $[1]= path/
        //echo 1;die();
        $return = '';
        $filename = '';
        $link = mysql_connect($host, $user, $pass);
        mysql_select_db($name, $link);

        //get all of the tables
        if ($tables == '*') {
            $tables = array();
            $result = mysql_query('SHOW TABLES');
            while ($row = mysql_fetch_row($result)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        //cycle through
        foreach ($tables as $table) {
            $result = mysql_query('SELECT * FROM ' . $table);
            $num_fields = mysql_num_fields($result);

            $return.= 'DROP TABLE ' . $table . ';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE ' . $table));
            $return.= "\n\n" . $row2[1] . ";\n\n";

            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = mysql_fetch_row($result)) {
                    $return.= 'INSERT INTO ' . $table . ' VALUES(';
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = ereg_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $return.= '"' . $row[$j] . '"';
                        } else {
                            $return.= '""';
                        }
                        if ($j < ($num_fields - 1)) {
                            $return.= ',';
                        }
                    }
                    $return.= ");\n";
                }
            }
            $return.="\n\n\n";
        }

        //save file
        $filename = 'cist_transcript_db' . date(' d M, Y h i s A') . '.sql';
        // rename file if file already exist
        if (file_exists($filename)) {
            $j = 1;
            $ex = end(split('[.]', $filename));
            $name = basename($filename, ".sql"); // $file name without extention
            while (file_exists($filename)) {
                $filename = $name . "_" . $j . '.' . $ex;
                $j++;
            }
        }
        // create file
        $handle = fopen($path . '/' . $filename, 'w+');
        fwrite($handle, $return);
        fclose($handle);
        return $filename;
    }

    // import database
    function import($p) {
        passthru("nohup mysql -u ".$p[0]." -p ".$p[1]." DBNAME < ".$p[2]);
    }

}

?>