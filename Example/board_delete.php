<?php
    $num = $_GET["num"];
    $page = $_GET["page"];
    
    $con = mysqli_connect("localhost", "sua", "1234", "board_project");
    $sql = "SELECT * FROM board_posted_data WHERE num=$num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    
    $copied_name = $row["file_copied"];
    
    if($copied_name){
        $file_path = "./data/".$copied_name;
        unlink($file_path);
    }
    
    $sql = "DELETE FROM board_posted_data WHERE num=$num";
    mysqli_query($con, $sql);
    mysqli_close($con);
    
    echo "
            <script>
                location.href = 'board_list.php?page=$page';
            </script>
        ";
?>