<?php
session_start();
error_reporting(0);
include('../includes/config.php');

//var_dump($dbh);
//var_dump($_GET['start_date']);
//echo "Error: ";
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
//$start_date = '2020-09-18';
//$end_date = '2051-10-11';
$sql = "SELECT
	COUNT( * ) TotalCount,
	USER.year_ordinal
FROM
	`lend`
	JOIN USER ON lend.user_id = USER.id
WHERE
	( lend.lend_time BETWEEN '" . $start_date . "' AND '". $end_date ."' )
	OR ( lend.return_time BETWEEN '" . $start_date . "' AND '". $end_date ."' )
GROUP BY
	USER.year_ordinal";
$query_select    = $dbh->prepare($sql);
$query_select->execute();
$results = $query_select->fetchAll(PDO::FETCH_OBJ);

//echo 'sdfs';
//print_r($results);
//return $results;
echo json_encode($results);
