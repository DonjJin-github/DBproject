<html>
    <head>
        <title>Upload image</title>
        <style>
            body {
                background-color: lightblue;
            }
            input {
                width: 50%;
                height: 5%;
                border: 1px;
                border-radius: 05px;
                padding: 8px 15px 8px 15px;
                margin: 10px 0px 15px 0px;
                box-shadow: 1px 1px 2px 1px grey;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <center>
            <h1>Upload / Insert an Image into Database using PHP MySQL</h1>

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
    $moviename = $mysqli->real_escape_string('어벤저스');
    $movietime = $mysqli->real_escape_string('15:00~16:00');

    $query = "INSERT INTO movie (moviename, movietime, image) VALUES ('$moviename', '$movietime', '$file')";

    if ($mysqli->query($query)) {
        echo '<script type="text/javascript"> alert("Image profile uploaded"); </script>';
    } else {
        echo '<script type="text/javascript"> alert("Error uploading image profile"); </script>';
    }
}
?>
