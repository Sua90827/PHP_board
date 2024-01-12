<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
	<div id="main_img_bar">
        <img src="./img/main_img.png">
    </div>
    <div id="board_box">
    	<h3 class="title">
    		게시판 > 내용보기
    	</h3>
<?php 
    $num = $_GET["num"];
    $page = $_GET["page"];
    
    $con = mysqli_connect("localhost", "sua", "1234", "board_project");
    $sql = "select * from board where num=$num";
    $result = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_array($result);
    $name = $row["name"];
    $subject = $row["name"];
    $content = $row["content"];
    $regist_day = $row["regist_day"];
    $hit = $row["hit"];
    $file_name = $row["file_name"];
    $file_type = $row["file_type"];
    $file_copied = $row["file_copied"];
    $password = $row["password"];
?>
    </div>
</section>