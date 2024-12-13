<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,700;1,100;1,200;1,300;1,400;1,500;1,600&family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <link rel="stylesheet" href="main.css">
    <?php
        include('config.php');
        $subject = '';
        $title = '';
        if(isset($_POST['subject'])){
            $subject = $_POST['subject'];
        }
        if(isset($_POST['title'])){
            $title = $_POST['title'];
        }
        if(isset($_POST['but_upload'])){
            $maxsize = 5242880;  // 5MB
            $name = $_FILES['file']['name'];
            $target_dir = "videos/";
            $target_file = $target_dir . basename($name);
            $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extension_arr = array("mp4", "mpeg", "avi", "3gp");

            if(in_array($videoFileType, $extension_arr)){
                if(($_FILES['file']['size'] >= $maxsize) || ($_FILES['file']['size'] == 0)){
                    echo "<center><h3 class='faild'>The file size exceeds 5MB. Please choose a smaller file.</h3></center>";
                }else{
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
                        $query = "INSERT INTO videos (name, location, subject, title) VALUES ('$name', '$target_file', '$subject', '$title')";
                        mysqli_query($con, $query);
                        echo "<center><h3 class='success'>Upload successfully</h3></center>";
                    } else {
                        echo "<center><h3 class='faild'>File upload failed</h3></center>";
                    }
                }
            } else {
                echo "<center><h3 class='faild'>Invalid file format. Only MP4, MPEG, AVI, and 3GP are allowed.</h3></center>";
            }
        }
    ?>
</head>
<body>
    <div class="container">
        <center>
            <img src="images/logo.jpg" alt="">
        </center>
        <div class="form">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <br>
                <input type="text" name="subject" id="subject" placeholder="The title of the video" required>
                <br>
                <input type="text" name="title" id="title" placeholder="Description for video" required>
                <br>
                <input type="submit" value="Upload Video" name="but_upload">
                <br>
                <a href="test.html" class="linko">Back to Reeltik</a>
            </form>
        </div>
    </div>
</body>
</html>
