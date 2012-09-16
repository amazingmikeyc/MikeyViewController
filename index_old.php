<?php 
//include('../database.php');

mysql_connect('127.0.0.1','root','r00t');
mysql_select_db('mikeyc_mikeynet');

$sql = 'SHOW TABLES';
$result = mysql_query($sql);
while($record = mysql_fetch_assoc($result)) {

        $tables[] = $record['Tables_in_mikeyc_mikeynet'];

}



if (!isset($_GET['table'])) $_GET['table'] = 'page';
if (!isset($_GET['limit'])) $_GET['limit'] = 1;

$sql = 'DESCRIBE '.$_GET['table'];
$result = mysql_query($sql);

while($record = mysql_fetch_assoc($result)) {

        $fields[] = $record;

}

//get first record
$sql = 'SELECT * FROM '.$_GET['table'].' LIMIT '.$_GET['limit'].', 1';
$result = mysql_query($sql);

if ($record = mysql_fetch_assoc($result)) {

//print_r($record);
    //    $fields[] = $record;

}

$sql = 'SELECT * FROM '.$_GET['table'];
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)) {
	$tableRows[] = $row;
}

//view

foreach ($tables as $table) {
	?><a href='?table=<?php echo $table; ?>'><?php echo $table ?> </a> - <?php
}


?><hr><?php 
foreach ($fields as $field) {

	?><p><?php echo $field['Field'];?>: <input type='text' name='<?php echo $field['Field'];?>' value='<?php echo $record[$field['Field']]; ?>'/><?php echo $field['Type']; ?></p><?php


}


?>
<hr>
<h1>Table</h1>

<table>
<tr>
<?php foreach ($fields as $field) {
	?><th><?php echo $field['Field']; ?></th><?php
} ?>
</tr>
<?php 
$count = 0;
foreach ($tableRows as $row) {
	?><tr><?php
 
	foreach ($row as $field=>$value) {
		
		?><td><a href='?table=<?php echo $_GET['table']; ?>&limit=<?echo $count;?>' ><?echo $value; ?></A></td><?php 
	}
	?></tr><?php
	$count++;
}
?></table><?php
