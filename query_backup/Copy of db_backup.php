<?php
include 'config.inc';
#$backupFile = "backup_db_saa.sql";
$backupFile = $dbname . date("Y-m-d-H-i-s") . '.sql';
$command = "mysqldump --add-drop-table -u $dbuser -p $dbpass $dbname> $backupFile";
system($command);
include 'closedb.inc';

?>
