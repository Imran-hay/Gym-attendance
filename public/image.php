<?php 

session_start();
$id = '';

if(isset($_SESSION['id']))
{
    echo $_SESSION['id'];
    $id = $_SESSION['id'];


}
else{
    die("please regiter first");
}

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'upload') {
        // Retrieve the image data from the form field
        $imageData = $_POST['image_data'];

        // Convert the base64-encoded image data to binary
        $imageBinary = base64_decode(str_replace('data:image/png;base64,', '', $imageData));

        // Save the image to a file
        file_put_contents("../Images/photos/$id.png", $imageBinary);

        // Prepare the SQL statement with a parameter placeholder for the binary data
        $mysqli = new mysqli('localhost', 'root', '', 'ssgym');

        // Prepare the SQL statement with a parameter placeholder for the binary data
        $stmt = $mysqli->prepare('UPDATE users SET photo = ? WHERE id = ?');
        
        // Bind the binary data to the parameter placeholder
        $stmt->bind_param('si', $imageBinary, $id);
        
        // Execute the SQL statement
        $stmt->execute();
        
        

        echo '<p>Image uploaded successfully!</p>';
        unset($_SESSION['id']);
        
        
    }
    if(isset($_POST['back']))
    {
        header('Location:qr-scan.php');
    }
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Camera Capture</title>
    <style>
        #video {
            transform: scaleX(-1);
        }
    </style>
</head>
<body>
    <h1>Camera Capture</h1>
    <video id="video" width="640" height="480"></video>
    <br>
    <button id="capture-btn">Capture</button>
    <br>
    <canvas id="canvas"></canvas>
    <br>
    <img id="preview">
    <br>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="upload">
        <input type="hidden" name="image_data" id="image-data">
        <input type="submit" value="Upload">
    </form>
    <form method="post" action="image.php">
       
        <button name="back">Back to Home</button>
    </form>

    <script>
        // Get the video element and start the camera
        var video = document.getElementById('video');
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function(error) {
                console.log('Camera error: ' + error.message);
            });

        // Get the canvas and context
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        // Get the capture button and attach the click event handler
        var captureBtn = document.getElementById('capture-btn');
        captureBtn.addEventListener('click', function() {
            // Draw the video frame to the canvas
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Get the image data from the canvas
            var imageData = canvas.toDataURL();

            // Set the image data as the preview image source
            var previewImg = document.getElementById('preview');
            previewImg.src = imageData;

            // Set the image data as the value of the hidden form field
            var imageDataField = document.getElementById('image-data');
            imageDataField.value = imageData;
        });
    </script>


</body>
</html>