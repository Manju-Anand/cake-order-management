<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $webmFile = $uploadDir . basename($_FILES['video']['name']);
        $mp4File = $uploadDir . pathinfo($_FILES['video']['name'], PATHINFO_FILENAME) . '.mp4';

        // Move the uploaded WebM file to the uploads directory
        if (move_uploaded_file($_FILES['video']['tmp_name'], $webmFile)) {
            // Convert WebM to MP4 using FFmpeg
            $ffmpegCommand = "ffmpeg -i $webmFile $mp4File";
            shell_exec($ffmpegCommand);

            // Optionally, delete the WebM file after conversion
            // unlink($webmFile);

            echo "Video uploaded and converted successfully. <a href='$mp4File'>Download MP4</a>";
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
} else {
    echo "Invalid request method.";
}
?>
