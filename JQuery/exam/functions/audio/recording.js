(function($) {
    let audioChunks = [];

//controling the recording a student answer
    $.fn.recordingControler = function(){
        if (!isRecording) {
            if(prepairTime){
                $.fn.resetTimer('recording_time')
                $.fn.stopTimer()
                $.fn.startTimer('recording_time')//--> recording timer
                $.fn.startRecording();
                isRecording = !isRecording;
            }else {
                $.fn.stopTimer()
                $("#popup").fadeIn(400,function() {
                    //$('#cancel').css('display','none')
                    $('.card-title').text('Cannot Skip')
                    $('.card-text').text('You need to finish answering this question before going to the next.')
                    $('.btn-section').append(`
                        <a id="close-popup" href="#" data-recording = 0  class="btn btn-primary float-center me-3">Close</a>
                    `)
                });
            }
        } else {
            if(prepairTime){
                //pauseRecording()
                //stopTimer()
                $("#popup").fadeIn(400,function() {
                    //$('#cancel').css('display','none')
                    $('.card-title').text('Confirm')
                    $('.card-text').text('Are you it you want to submit this answer this answer and go to the next question?')
                    $('.btn-section').append(`
                        <a id="yes-popup" href="#"  class="btn btn-primary float-center me-3">YES</a>
                        <a id="no-popup" href="#" data-recording = 1  class="btn btn-primary float-center me-3">NO</a>
                    `)
                });
            }else {
                $.fn.stopTimer()
                $.fn.stopRecording()
                $("#popup").fadeIn(400,function() {
                    //$('#cancel').css('display','none')
                    $('.card-title').text('Recording Stoped')
                    $('.card-text').text('Please click "Next" to go to the next question')
                    $('.btn-section').append(`
                        <a id="yes-popup" href="#"  class="btn btn-primary float-center me-3">Next</a>
                    `)
                });
                isRecording = !isRecording;
            }
        }
    }

//start the student answer recording
    $.fn.startRecording = function(){
        navigator.mediaDevices.getUserMedia({ audio: true })
        .then(function (stream) {
            mediaRecorder = new MediaRecorder(stream, { mimeType: 'audio/webm; codecs=opus' });

            mediaRecorder.ondataavailable = function (event) {
                if (event.data.size > 0) {
                    audioChunks.push(event.data);
                }
            };

            mediaRecorder.onstop = function () {
                const audioBlob = new Blob(audioChunks, { type: 'audio/wav; codecs=opus' });
                const audioUrl = URL.createObjectURL(audioBlob);
                //audioPlayer.attr('src', audioUrl);
                console.log(audioUrl)
                const formData = new FormData();
                formData.append('audio', audioBlob, 'recording.wav');
                formData.append('task','audio_save');

                // Send the recorded audio to the server using $.ajax or $.post
                $.fn.saveAudio(formData);

                audioChunks = [];
            };

            mediaRecorder.start();
            //$.fn.recording.prop('disabled', false);
        })
        .catch(function (error) {
            console.error('Error accessing microphone:', error);
        });
    }

//stop the recordig of student answer
    $.fn.stopRecording = function(){
        if (mediaRecorder && mediaRecorder.state === 'recording') {
            mediaRecorder.stop();
        }
    }

})(jQuery);