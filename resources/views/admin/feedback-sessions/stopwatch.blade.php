<!DOCTYPE html>
<html lang="en">
<body>
<div class="container">
    <h1 id="timerLabel">00:00:00</h1>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    var status = 0; // 0:stop 1:running
    var time = {{$total_duration}};
    var startBtn = document.getElementById("startBtn");
    var timerLabel = document.getElementById('timerLabel');

    $(document).ready(function(){
        status = 1;
        timer();
    });

    function timer(){
        if (status == 1) {
            setTimeout(function() {
                time++;

                var min = Math.floor(time/60);
                var sec = Math.floor(time%60);

                if (min < 10) min = "0" + min;

                if (sec >= 60) sec = sec % 60;

                if (sec < 10) sec = "0" + sec;

                timerLabel.innerHTML = min + ":" + sec;

                timer();
            }, 1000);
        }
    }

    document.onkeydown = function(event) { 
        if (event) {
            if (event.keyCode == 32 || event.which == 32) {
                if(status == 1) {
                    stop();
                } else if (status == 0) {
                    start();
                }
            }
        }
    };
</script>
</body>
</html>