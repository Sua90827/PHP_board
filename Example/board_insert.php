<meta charset="utf-8">
<?php
	$name = $_POST["name"];
	$subject = $_POST["subject"];
	$content = $_POST["content"];
	$password = $_POST["password"];
	
	$name = htmlspecialchars($name, ENT_QUOTES);
	$subject = htmlspecialchars($subject, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);
	$password = htmlspecialchars($password, ENT_QUOTES);
	
	$regist_day = date("Y-m-d (H:i)"); // 년, 월, 일, 시, 분
	
	// File STARTS -------------------------------------------------------------
	$upload_dir = './data/';
	
	$uploaded = $_FILES["upfile"];
	$file_name = $uploaded["name"];
	$file_tmp_name = $uploaded["tmp_name"];
	$file_type = $uploaded["type"];
	$file_size = $uploaded["size"];
	$file_error = $uploaded["error"];
	
	if( $file_name && !$file_error){
		$file = explode(".", $file_name);
		$file_name = $file[0];
		$file_ext = $file[1];
		
		$new_file_name = date("Y_m_d_H_i_s");
		$copied_file_name = $new_file_name.".".$file_ext; //저장될 파일 명
		$uploaded_file = $upload_dir.$copied_file_name; //경로 + 파일명
		
		if($file_size > 1000000){
			echo("
				<script>
					alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다. <br> 파일 크기를 체크해주세요.');
					history.back();
				</script>
			");
			exit;
		}
		
		if(!move_uploaded_file($file_tmp_name, $uploaded_file)){ 
		//파일을 지정한 디렉토리에 복사(move_uploaded_file)합니다. 복사에 실패한 경우에는 에러 메시지를 출력하고 뒤로 이동합니다.
			echo("
				<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.back();
				</script>
			");
			exit;
		}
	} else {  //파일과 관련된 변수들을 초기화
		$file_name = "";
		$file_type = "";
		$copied_file_name = "";
	}
		
	// File ENDS -------------------------------------------------------------
		
	$con = mysqli_connect("localhost", "sua", "1234", "board_project");
	
	$sql = "INSERT INTO board_posted_data (name, subject, content, regist_day, hit, file_name, file_type, file_copied, password) VALUES('$name', '$subject', '$content', '$regist_day', 0, '$file_name', '$file_type', '$copied_file_name',	'$password')";
	mysqli_query($con, $sql); //$sql에 저장된 명령 실행
	
	mysqli_close($con); //disconnecting DB
	
	echo("
		<script>
			location.href = 'board_list.php';
		</script>
	");
?>