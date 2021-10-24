<?php
session_start();
error_reporting(0);
include('../includes/config.php');

$sql = "SELECT
	COUNT( * ) TotalCount,
	tblcategory.CategoryName,
	yx_books.CatId 
FROM
	`yx_books`
	JOIN tblcategory ON yx_books.CatId = tblcategory.id 
GROUP BY
	yx_books.CatId";
$query_select    = $dbh->prepare($sql);
$query_select->execute();
$results = $query_select->fetchAll(PDO::FETCH_OBJ);

echo json_encode($results);

