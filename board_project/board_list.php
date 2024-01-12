<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>Board</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
</head>

<body>

<header>
	<?php include "include/header.php";?>
</header>

<section>

	<div id="main_img_bar">
		<img src="./img/main_img.png">
	</div>
	
	<div id="board_box">
		<h3>게시판 > 목록보기</h3>
		<ul id="board_list">
			<li>
				<span class="col1">번호</span>
				<span class="col2">제목</span>
				<span class="col3">작성자</span>
				<span class="col4">첨부</span>
				<span class="col5">등록일</span>
				<span class="col6">조회</span>
			</li>
<?php
	if(isset($_GET["page"])) // isset 함수는 변수 설정되어 있는지, null이 아닌지 확인.
		$page = $_GET["page"];
	else
		$page = 1;
	
	$con = mysqli_connect("localhost", "sua", "1234", "board_project");
	$sql = "SELECT * FROM board_posted_data ORDER BY num DESC";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); //결과의 행 개수
	
	$scale = 10;
	
	// $total_page 
	if($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1; //나머지가 있다면 한 페이지 더 추가.
		
	//$page에 따라 $start(게시글) 계산
	$start = ($page - 1) * $scale;
	
	$number = $total_record - $start;
	
	for($i=$start; $i < $start + $scale && $i < $total_record; $i++;){
		mysqli_data_seek($result, $i);
		//가져올 레코드로 포인터 이동
		$row = mysqli_fetch_array($result);
		//하나의 레코드 가져오기
		$num = $row["num"];
		$name = $row["name"];
		$subject = $row["subject"];
		//$content = $row["content"];
		$regist_day = $row["regist_day"];
		$hit = $row["hit"];
		//$file_name = $row["file_name"];
		//$file_type = $row["file_type"];
		//$file_copied = $row["file_copied"];
		//$password = $row["password"];
		
		if($row["file_name"])
			$file_image = "<img src='./img/file.gif'>";
		else
			$file_image = " ";
?>
			<li>
				<span class="col1"><?=$number?></span>
				<span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
				<span class="col3"><?=$name?></span>
				<span class="col4"><?=$file_image?></span>
				<span class="col5"><?=$regist_day?></span>
				<span class="col6"><?=$hit?></span>
			</li>

<?php
		$number--;
	}
	mysqli_close($con);
?>

		</ul>
		<ul id="page_num">

<?php
	if($total_page>=2 && $page >=2){
		$new_page = $page-1;
		echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a></li>";
	}else{
		echo "<li>&nbsp;</li>";
		
	//게시판 목록 하단에 페이지 링크 번호 출력
	for($i=1; $i<=$total_page; $i++){
		if($page == $i){ //현재 페이지 번호 링크 안함
			echo "<li><b> $i </b></li>";
		}else{
			echo "<li><a href='board_list.php?page=$i'>$i</a></li>";
		}
	}
	
	
	
	
	
	
	
	</div>
</body>
				<span class="col1">번호</span>
				<span class="col2">제목</span>
				<span class="col3">작성자</span>
				<span class="col4">첨부</span>
				<span class="col5">등록일</span>
				<span class="col6">조회</span>