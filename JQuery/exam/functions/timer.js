(function($) {
    let seconds = 0;
    let seconds4 = 25;
    let seconds5 = 0;
    let minutes = 0;
    let hours = 0;

    /*
        prepair_time_i => Read Aloud QType preparing time
        prepair_time_ii => RS, RL and ASW QType preparing time
    */

    $.fn.startTimer = function(task) {
        prepairTime = !prepairTime;
        timer = setInterval(function() {
            $.fn.updateTimer(task)
        }, 1000);
    };

    $.fn.stopTimer = function() {
        clearInterval(timer);
    };

    $.fn.resetTimer = function(task) {
        clearInterval(timer);
        switch (task) {
            case 'recording_time':
                seconds = 0;
                $('#myProgressBar').css('width', 0 + '%');
                break;
            case 'prepair_time_i':
                seconds = 35;
                break;
            case 'prepair_time_ii':
                seconds = 5;
                break;
            case 4:
                seconds4 = 25;
                break;
            case 5:
                seconds5 = 0;
                break;
        }
        minutes = 0;
        hours = 0;
        $.fn.updateTimerDisplay(task);
    };

    $.fn.updateTimer = function(task) {
        switch (task) {
            case 'recording_time':
                $.fn.updateProgressBar(39);
                seconds++;
                if (seconds === 40) {
                    clearInterval(timer);
                    $.fn.recordingControler();
                }
                break;
            case 'prepair_time_i':
                seconds--;
                if (seconds === 30) {
                    clearInterval(timer);
                    $.fn.recordingControler()
                }
                break;
            case 'prepair_time_ii':
                seconds--;
                if (seconds === 0) {
                    clearInterval(timer);
                    $.fn.playAudio();
                }
                break;
            case 4:
                seconds4--;
                if (seconds4 === 0) {
                    clearInterval(timer);
                    RecordingButton();
                }
                break;
            case 5:
                $.fn.updateProgressBar(60);
                seconds5++;
                if (seconds5 >= 60) {
                    seconds5 = 0;
                    minutes++;
                    if (minutes >= 10) {
                        clearInterval(timer);
                    }
                }
                break;
        }
        $.fn.updateTimerDisplay(task);
    };

    $.fn.updateTimerDisplay = function(task) {
        let formattedTime;
        switch (task) {
            case 'recording_time':
                formattedTime = `${$.fn.pad(hours)}:${$.fn.pad(minutes)}:${$.fn.pad(seconds)}`;
                $("#timer").text(formattedTime);
                break;
            case 'prepair_time_i':
                formattedTime = `${$.fn.pad(hours)}:${$.fn.pad(minutes)}:${$.fn.pad(seconds)}`;
                $("#prepair-timer").text(formattedTime);
                break;
            case 'prepair_time_ii':
                formattedTime = `${$.fn.pad(hours)}:${$.fn.pad(minutes)}:${$.fn.pad(seconds)}`;
                $("#prepair-timer").text(formattedTime);
                break;
            case 4:
                formattedTime = `${$.fn.pad(hours)}:${$.fn.pad(minutes)}:${$.fn.pad(seconds4)}`;
                $("#prepair-timer").text(formattedTime);
                break;
            case 5:
                formattedTime = `${$.fn.pad(hours)}:${$.fn.pad(minutes)}:${$.fn.pad(seconds5)}`;
                $("#timer").text(formattedTime);
                break;
        }
    };

    $.fn.pad = function(value) {
        return value < 10 ? `0${value}` : value;
    };

    $.fn.updateProgressBar = function(timeInterval) {
        var progress = seconds / timeInterval * 100;
        $('#myProgressBar').css('width', progress + '%');
    };
})(jQuery);