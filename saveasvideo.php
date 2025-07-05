<!DOCTYPE html>
<html>
<head>
    <title>Save Section as Video</title>
    <!-- Include the latest version of html2canvas from a CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Include RecordRTC from a CDN -->
    <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #testimonialSection {
            background-color: #ffffff;
            border: 2px solid #4CAF50;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            text-align: center;
        }

        #testimonialSection h3 {
            color: #4CAF50;
            margin-top: 0;
        }

        #testimonialSection p {
            color: #555;
        }

        #testimonialSection video {
            width: 100%;
            border-radius: 10px;
            margin-top: 10px;
        }

        #captureButton {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #captureButton:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="testimonialSection">
        <h3>Testimonial</h3>
        <p>This is a testimonial content.</p>
        <video id="testimonialVideo" controls>
            <source src="assets/img/rtex1.mp4" type="video/mp4">
        </video>
    </div>

    <button id="captureButton">Capture and Save as Video</button>

    <script>
        document.getElementById('captureButton').addEventListener('click', function() {
            html2canvas(document.getElementById('testimonialSection')).then(function(canvas) {
                var video = document.getElementById('testimonialVideo');
                var stream = canvas.captureStream(30); // Capture at 30fps
                var recorder = new RecordRTC(stream, {
                    type: 'video',
                    mimeType: 'video/webm;codecs=vp9'
                });

                video.play();
                recorder.startRecording();

                video.onended = function() {
                    recorder.stopRecording(function() {
                        var blob = recorder.getBlob();

                        // Upload the blob to the server
                        var formData = new FormData();
                        formData.append('video', blob, 'testimonial_section.webm');

                        fetch('upload.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log(data);
                            alert('Video uploaded successfully');
                        })
                        .catch(error => {
                            console.error('Error uploading video:', error);
                        });
                    });
                };
            }).catch(function(error) {
                console.error('Error capturing the section:', error);
            });
        });
    </script>
</body>
</html>
