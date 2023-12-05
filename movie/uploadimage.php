<html>
    <head>
        <title>Upload image</title>
    </head>
    <body>
        <center>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Choose a profile pic:</label><br>
                <input type="file" name="image" id="image" /><br>

                <input type="submit" name="upload" value="Upload Image/Data" /><br>
            </form>
        </center>
    </body>
</html>

<?php
$host = 'localhost';
$user = 'root';
$pw = '1234';
$db_name = 'dbproject';

$mysqli = new mysqli($host, $user, $pw, $db_name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['upload'])) {
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

    // Escape the values and use placeholders in the query
    $moviename = $mysqli->real_escape_string('어벤져스:엔드게임');
    $movietime = $mysqli->real_escape_string('16:00~18:00');

    $query = "INSERT INTO movie (moviename, movietime, image) VALUES ('$moviename', '$movietime', '$file')";

    if ($mysqli->query($query)) {
        echo '<script type="text/javascript"> alert("Image profile uploaded"); </script>';
    } else {
        echo '<script type="text/javascript"> alert("Error uploading image profile"); </script>';
    }
}
?>
