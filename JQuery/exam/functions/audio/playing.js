(function($) {
    $.fn.playAudio = function(){
        var questionAudio = $('#questionAudio')[0];

        if (questionAudio) {
            questionAudio.removeEventListener('loadedmetadata', $.fn.handleMetadataLoaded);
            questionAudio.addEventListener('loadedmetadata', $.fn.handleMetadataLoaded);

            if (questionAudio.readyState >= 2) {
                questionAudio.dispatchEvent(new Event('loadedmetadata'));
            }

            questionAudio.play();
        } else {
            console.error("Audio element not found");
        }
    }

    $.fn.handleMetadataLoaded = function() {
        var duration = $('#questionAudio')[0].duration;
        console.log("Audio duration: " + duration + " seconds");

        recordingTimeout = setTimeout(function () {
            if ([
                'Summarize Spoken Text',
                'Multiple Choice (Multiple)-L',
                'Multiple Choice (Single)-L',
                'Highlight Correct Summary',
                'Select Missing Word',
                'Listening: Fill in the Blanks',
                'Highlight Incorrect Words',
                'Write From Dictation'
            ].includes(window.type)) {
                startTimer(5);
            } else {
                $.fn.recordingControler();
            }
        }, duration * 1000);
    }
})(jQuery);