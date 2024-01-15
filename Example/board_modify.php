<?php
    $num = $_GET["num"];
    $page = $_GET["page"];
    
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    
    $con = mysqli_connect("localhost", "sua", "1234", "board_project");
    $sql = "UPDATE board_posted_data SET subject='$subject', content='$content' WHERE num=$num";
    mysqli_query($con, $sql);
    mysqli_close($con);
    
    echo "
            <script>
                location.href='board_view.php?num=$num&page=$page';
            </script>
        ";
?>