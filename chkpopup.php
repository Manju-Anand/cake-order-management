<!DOCTYPE html>

<head>
    <title>Example 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .popup-container {
            display: inline-block;
            position: relative;
            width: 1000px;
        }

        .popup-content {
            display: none;
            position: absolute;
            top: 120%;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px;
            background-color: #ebdb00;
            color: green;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease-in-out,
                top 0.3s ease-in-out;
        }

        .popup-container:hover .popup-content {
            top: 100%;
            opacity: 1;
        }
    </style>
</head>

<body>
    <h3>
        Using onmouseenter and
        onmouseleave Attributes
    </h3>
    <div class="popup-container" id="popupContainer">
        Hover me to see popup
        <div class="popup-content">
            Hey Geek,
            <img src="includes/vision.png" width="100%">
            <strong>
                Welcome to GeeksforGeeks!
            </strong>
            <p>In JavaScript, to perform the functionality of opening the popup on hover, we can dynamically manipulate the DOM by responding to the mouse events.

                The below approaches can be used to accomplish this task.

                Table of Content

                Using mouseover and mouseout events
                Using onmouseenter and onmouseleave events
                Using mouseover and mouseout events
                In this approach, we are using the JavaScript events mouseover and mouseout to toggle the display of the popup content. The mouseover event is used to display the popup while mouseout is used to hide the same.</p>
        </div>

    </div>
    <h2>fdsfdsfus sdfsdgsdg gagagasg</h2>
        <div>
            <p>asfagsfb asfashfb arr  qwrqhwhr qwrqwrqwr qwrewrewygrwr awdeqweqiee asvfasggfaeaw asgvsabfawrwrqw</p>
        </div>
        <style>
            a.tooltip span {
    position: absolute;
    top: 10px;
    left: 25px;
    width: 250px; 
    border: #000 1px solid;
    background: #F8F8F8;
    padding: 10px;
    z-index: 1000000;
    display: inline;
    opacity: 0;
    transition: 750ms all;
}
a.tooltip:hover span {
    outline: none;
    text-decoration: none;
    font-size: 70%;
    color: #000;
    opacity: 1;
}
        </style>
        <!-- <a href="https://developer.bennysutton.com"> <img src="https://developer.bennysutton.com/music/images/1000px/html.jpg" style="float:right;"/></a> -->
<a href="#" class="tooltip">
  <img src="https://www.bennysutton.com/img/Ben-cartoon-100px.png"alt="test alt tag"  />
  <span>
		<div class="row">
			<div class="col-md-6">
				<img src="https://www.bennysutton.com/img/Ben-cartoon-150px.png" class="fade-in">
			</div>
				<div class="col-md-6">
				Tooltip Text.<p>gsdjbewjr ewrhebw tewtewhtqe tqwtqwjtqwtqwtqwt wetewt qwtqwtqwtq</p>
			</div>
			
				
				
		</div>
        <br /></span>
</a>






    <script>
        const popupContainer =
            document.getElementById('popupContainer');
        const popupContent =
            document.querySelector('.popup-content');
        popupContainer.onmouseenter =
            function() {
                popupContent.style.display = 'block';
            };
        popupContainer.onmouseleave =
            function() {
                popupContent.style.display = 'none';
            };
    </script>
</body>

</html>