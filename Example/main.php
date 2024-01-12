<div id="main_img_bar">
    <img src="./img/main_img.png">
</div>
<div id="main_content">
    <div id="latest">
        <h4>최근 게시글(15장)</h4>
        <ul>
<!-- 최근 게시 글 DB에서 불러오기 -->
<?php
    $con = mysqli_connect("localhost", "sua", "1234", "board_project");
    $sql = "select * from board_posted_data";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
        while( $row = mysqli_fetch_array($result) )
        {
            $regist_day = substr($row["regist_day"], 0, 10);
?>
                <li>
                    <span><?=$row["subject"]?></span>
                    <span><?=$row["name"]?></span>
                    <span><?=$regist_day?></span>
                </li>
<?php
        }
    }
?>
            </div>
        </div>