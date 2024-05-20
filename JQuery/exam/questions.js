(function($) {
    window.type;
    let submitData;

// fetching the data from db
    $.fn.fetchingData = function(page, questionsPerPage, test_id) {
        $.ajax({
            url: `controlers/get.php?data_type=getQuestion&page=${page}&per_page=${questionsPerPage}&test_id=${test_id}&type=${null}`,
            method: 'GET',
            success: function(data) {
                console.log(data);
                isRecording = false;
                prepairTime = false;
                for (var i = 0; i < data['data'].length; i++) {
                    type = data['data'][i].type;
                    let solution = data['data'][i].solution;
                    let audio = data['data'][i].mp4File;
                    let image = data['data'][i].imageFile;
                    let KeyWords = data['data'][i].key_words;
                    let question_id = data['data'][i].question_id;

                    var mainStyles = $('#solution').attr('style');
                    $('#title').append(`<h4 style="color: white;">${data['data'][i].question}</h4>`);

                    if (['Read Aloud'].includes(type)) { 
    //------> Read Aloud
                        $.fn.resetTimer('prepair_time_i')
                        $.fn.startTimer('prepair_time_i')
                        $.fn.speakText(mainStyles, solution);

                        submitData = { task : 'speaking-i', Solution: solution, question_id: question_id, student_id: 2, key_words: KeyWords, type: type, test_id: test_id}

                    }else if(['Repeat Sentence', 'Re-tell Lecture', 'Answer Short Question'].includes(type)){
    //------> Repeate Sentence, Re-tell Lecture and Answer Short Question
                        $.fn.resetTimer('prepair_time_ii')
                        $.fn.startTimer('prepair_time_ii')
                        $.fn.speakAudio(mainStyles, audio) 
                        
                        var task = (type === 'Repeat Sentence') ? 'speaking-i' : 'speaking-ii';
                        submitData = { task : task, Solution: solution, question_id: question_id, student_id: 2, key_words: KeyWords, type: type, test_id: test_id}

                    }else if(['Describe Image'].includes(type)){
    //------> Describe Image
                        $.fn.resetTimer('prepair_time_ii')
                        $.fn.startTimer('prepair_time_ii')
                        $.fn.speakImage(mainStyles, image) 

                        submitData = { task : 'speaking-ii', Solution: solution, question_id: question_id, student_id: 2, key_words: KeyWords, type: type, test_id: test_id}

                    } else if (['Summarize Written Text', 'Write Essay'].includes(type)) { 
    //------> Summarize Written Test, Write Essay
                        $.fn.write(solution);
                    } else if(['Reading & Writing：Fill in the blanks'].includes(type)){
    //------> Reading & Writing：Fill in the blanks
                        $.fn.readingFB(solution);  
                    }
                }
            }
        });
    };

// submit the data to the db
    $.fn.submit = function(){
        console.log('Submited...')
        $.ajax({
            url: 'controlers/post.php',
            type: 'POST',
            data: submitData,
            success: function(response){
                console.log(response.message);
            },
            error: function (error) {
                console.error('Error submit the answer:', error);
            }
        })
    }

    $.fn.speakText = function(mainStyles, solution) {
        $('#solution').attr('style', mainStyles);
        $('#solution').append(`<p>${solution}</p>`);
    };

    $.fn.speakAudio = function(mainStyles, audio){
        $('#solution').attr('style', mainStyles);
        $('#solution').append(`
            <audio id = "questionAudio" controls style="width: 400px; margin: 50px">
                <source src='${audio}' type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>`
        );
    } 

    $.fn.speakImage = function(mainStyles, image){
        $('#solution').attr('style', mainStyles);
        $('#solution').append(`<img src="${image}" style="width:300px; height: 200px">`);
    }

    $.fn.write = function(Solution) {
        $('#solution').removeAttr('style');
        $('#solution').css('text-align', 'justify');
        $('#text_row').css('display', 'block');
        $('#prepair-time').empty();
        $('#timer_row').css('margin-bottom', '20px');
                
        var paragraphsArray = Solution.split('"=,');
        paragraphsArray = paragraphsArray.map(function(paragraph) {
            return paragraph.trim();
        });
        console.log(paragraphsArray);
        for (var i = 0; i < paragraphsArray.length; i++) {
            $('#solution').append('<p>' + paragraphsArray[i] + '</p>');
        }
    };

})(jQuery);
