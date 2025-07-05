<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grid Layout</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(6, 100px);
            grid-gap: 5px;
            padding: 5px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .grid-item {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80px;
            height: 120px;
            background-color: #ccc;
            /* border-radius: 10px; */
            border-top-right-radius: 30%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            color: #333;
        }
        .c { background-color: #ff9999; }
        .d { background-color: #99ff99; }
        .e { background-color: #9999ff; }
        .f { background-color: #ffff99; }
        .g { background-color: #99ffff; }
    </style>
</head>
<body>
    <div class="grid-container">
        <div class="grid-item c">Item 1</div>
        <div class="grid-item d">Item 2</div>
        <div class="grid-item e">Item 3</div>
        <div class="grid-item f">Item 4</div>
        <div class="grid-item g">Item 5</div>
        <div class="grid-item g">Item 5</div>

        <div class="grid-item c">Item 1</div>
        <div class="grid-item d">Item 2</div>
        <div class="grid-item e">Item 3</div>
        <div class="grid-item f">Item 4</div>
        <div class="grid-item g">Item 5</div>
        <div class="grid-item g">Item 5</div>

        <div class="grid-item c">Item 1</div>
        <div class="grid-item d">Item 2</div>
        <div class="grid-item e">Item 3</div>
        <div class="grid-item f">Item 4</div>
        <div class="grid-item g">Item 5</div>
        <div class="grid-item g">Item 5</div>

        <div class="grid-item c">Item 1</div>
        <div class="grid-item d">Item 2</div>
        <div class="grid-item e">Item 3</div>
        <div class="grid-item f">Item 4</div>
        <div class="grid-item g">Item 5</div>
        <div class="grid-item g">Item 5</div>
        <!-- Add more items as needed -->
    </div>
</body>
</html>
