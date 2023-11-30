<html>
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <center>
        <table>
            <thead>
                <tr>
                    <th>IMAGE</th>
                </tr>
            </thead>
            <?php
                $host = 'localhost:3306';
                $user = 'root';
                $pw = '1234';
                $db_name = 'dbproject';
                $mysqli = new mysqli($host, $user, $pw, $db_name); // db 연결

                // UID가 1인 행만을 선택하는 쿼리
                $query = "SELECT * FROM movie WHERE movieUID = 1";
                $query_run = mysqli_query($mysqli, $query);

                while($row = mysqli_fetch_array($query_run))
                {
                    echo '<tr><td><img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image" style="width: 100px; height: 100px;"></td></tr>';
                }
            ?>
        </table>
    </center>
</body>
</html>
