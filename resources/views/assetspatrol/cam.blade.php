<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        h1{font-size:2.5em;background-color:lightgray;margin:5px;padding:5px;}
        button{font-size:.5em;}
        input{font-size:1.3em;}
        #scanData{width:90%;margin:10px;}
        </style>

    <title>Document</title>
</head>
<body>
     <h1>Barcode
        <button onclick="window.location.href='./index.html'">Home</button>
        <button onclick="EB.Application.quit();">Quit</button>
        </h1>
        <div id=content>
        </div>
        <input id="scanData" type=text >
        
</body>
</html>