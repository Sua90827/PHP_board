<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:20px 0 0 80px;
   cursor:pointer;
}
</style>
<script>
	function check_matching_password(number, page_now){
		var enteredPassword = document.password_form.input_password.value;
		var storedPassword = document.password_form.stored_password.value;
		
		if(enteredPassword !== storedPassword){
			alert("비밀번호가 다릅니다. 작성자만 삭제가 가능합니다.");
		} else {
			document.password_form.submit();
			// 삭제 성공 시 부모 창 갱신
			window.opener.history.back();
			window.close();
		}
	}
</script>
</head>
<body>
<h3>비밀번호 확인</h3>
<p>
<?php
    $num = $_GET["num"];
    $page = $_GET["page"];
    $stored_password = $_GET["password"];
    
    
    
?>
	<form name="password_form" method="post" action="board_delete.php?num=<?=$num?>&page=<?=$page?>">
		<input name="input_password" type="password">
		<input name="stored_password" type="hidden" value="<?=$stored_password?>">
		<button onclick="check_matching_password(<?=$num?>,<?=$page?>)">확인</button>
	</form>