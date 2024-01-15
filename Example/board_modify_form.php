<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
	function check_input(){
	if(!document.board_form.subject.value){
		alert("제목을 입력하세요");
		document.board_form.subject.focus();
		return;
	}
	if(!document.board_form.content.value){
		alert("내용을 입력하세요!");
		document.board_form.content.focus();
		return;
	}
	if(!document.board_form.password.value){
		alert("비밀번호를 입력하세요!");
		document.board_form.password.focus();
		return;
	}
	if(document.board_form.stored_password.value !== document.board_form.password.value){
		alert("비밀번호가 틀립니다. 작성자만 수정이 가능합니다.");
		location.go(-2);
	}
	document.board_form.submit();
}
</script>
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
	    <h3 id="board_title">
	    		게시판 > 글 쓰기
		</h3>
<?php
    $num = $_GET["num"];
    $page = $_GET["page"];
    
    $con = mysqli_connect("localhost", "sua", "1234", "board_project");
    $sql = "SELECT * FROM board_posted_data WHERE num=$num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $name = $row["name"];
    $subject = $row["subject"];
    $content = $row["content"];
    $file_name = $row["file_name"];
    $password = $row["password"];
?>
		<form name = "board_form" method="post" action="board_modify.php?num=<?=$num?>&page=<?=$page?>"
		enctype="multipart/form-data">
		<input type="hidden" name="stored_password" value="<?=$password?>">
			<ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>
				</li>
				<li>
					<span class="col1">제목 : </span>
					<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
				</li>
				<li id="text_area">
					<span class="col1">내용 : </span>
					<span class="col2">
						<textarea name="content"><?=$content?></textarea>
					</span>
				</li>
				<li>
			        <span class="col1"> 첨부 파일 : </span>
			        <span class="col2"><?=$file_name?></span>
			    </li>
			    <li>
			        <span class="col1"> 비밀번호 : </span>
			        <span class="col2"><input type="password" name="password"></span>
			    </li>
			</ul>
			<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li>
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
			</ul>
			
		</form>
	</div>
</section>
<footer>
<?php include "footer.php";?>
</footer>
</body>
</html>