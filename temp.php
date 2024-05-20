<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Countdown Progress Bar</title>
<style>
    #progress-bar {
        width: 100%;
        background-color: #f0f0f0;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    #filler {
        height: 20px;
        background-color: #3498db;
        border-radius: 5px;
    }
</style>
</head>
<body>
<h1>Countdown Progress Bar</h1>
<div id="progress-bar">
    <div id="filler"></div>
</div>
<div id="countdown">40</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var timeLeft = 40;
    var countdownInterval = setInterval(function() {
        timeLeft--;
        $('#countdown').text(timeLeft);
        var progress = (40 - timeLeft) / 40 * 100;
        $('#filler').css('width', progress + '%');
        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            $('#countdown').text('Countdown Complete!');
        }
    }, 1000);
});
</script>
</body>
</html>
