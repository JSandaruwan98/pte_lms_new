<?php
require_once 'check_role/checkRole.php';
checkRoleOthers('student');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logo-icon.png">
    <title>PTE Learning Management System</title>
    <link rel="stylesheet" href="./assets/css/old_style/pteTest.css">
    <link rel="stylesheet" href="./assets/css/old_style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./assets/css/old_style/style_for_mycourse_dropdown.css">
    <link rel="stylesheet" href="./assets/css/old_style/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/old_style/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/old_style/main.css">
    <link rel="stylesheet" href="./assets/css/old_style/custome.css">
    <link rel="stylesheet" href="./assets/css/old_style/pteTest.css">
    <style>
        .card {
            width: auto;
            height: auto;
            background-color: #f0f0f0;
            border: 2px dotted #5b5b5b;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            cursor: grab;
        }
        .highlight {
            background-color: yellow;
        }
        
    </style>
    <script>
        $(document).ready(function() {
        
      });
      </script>
</head>
<body>
    <div style="margin-top: 1%">
        <!--Section 01 (this section Displayed main banner image)-->
        <section class="banner-area relative about-banner" id="home" style="background: url('images/img/slider3.png') right;">	
            <div class="overlay overlay-bg" style="background-color: rgba(0, 65, 65, 0.5);"></div>
            <div class="container">				
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="about-content col-lg-12"></div>	
                </div>
            </div>
        </section>

        <!--Section 03 (This section is used for recording and submiting answers)-->
        <section class="feature-area" id="block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="feature-area" id="feature-area">
                            <div class="single-feature" id="single-feature">
                                <div class="title" id="title" style="height: auto; text-align: justify; padding: 15px;"></div>
                                <div class="desc-wrap" style="background-color: rgb(218, 253, 253); ">
                                
                                    <!--************************************************************************************************************-->
                                    <!--timer row-->
                                    <div id="timer_row" class="row">
                                        <div id="prepair-time" class="col-2 col-md-3 col-sm-4">
                                            <div style="color: red;">Prepair Time</div>
                                            <div id="prepair-timer" style="color: red;">00:00:00</div>
                                        </div>
                                        <div id="recording-bar" class="col-8 col-md-6 col-sm-4">
                                            <div class="progress">
                                                <div id="myProgressBar" class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div id="recording-time" class="col-2 col-md-3 col-sm-4">
                                            <div data-role="controls">
                                                <div id="timer" style="font-size:x-large">00:00:00</div>
                                            </div>
                                            <button id="recordButton" style="display: none;">Record</button>
                                            <div data-role="recordings"></div>
                                        </div>
                                    </div>  

                                    <!--************************************************************************************************************-->
                                    <!--question and recording row-->
                                    <div id="qandr_row" class="row px-3">
                                        <div id="solution" style="text-align: justify; justify-content: center; align-items: center; display: flex; color: #222; margin-top: 25px; padding-left: 30px; padding-right: 30px;">
                                            
                                        </div>    
                                    </div>
                                    
                                    <!--************************************************************************************************************-->    
                                    <!--text row-->
                                    <div id="text_row" class="row px-5" style="margin-top: 60px; display: none;">
                                        <textarea name="" id="text_answer" cols="30" rows="10"></textarea>
                                    </div>

                                    <!--************************************************************************************************************-->
                                    <!--button row-->      
                                    <div id="button_row" class="row" style="margin-top: 60px;">
                                        <div class="col-2 col-md-3 col-sm-4">
                                            <a  href="#" id="save_and_exit" style="font-size: 18px; font-weight:600; float: left;">Save and Exit</a>
                                        </div>
                                        <div class="col-8 col-md-6 col-sm-4">
                                            <a id="page-number" style="font-size: 18px; font-weight:600;"><span id="currentPage">1</span> /<span id="totalPages">1</span></a>
                                        </div>
                                        <div class="col-2 col-md-3 col-sm-4">
                                            <a  href="#" id="next" style="font-size: 18px; font-weight:600; float: right;">Next</a>	
                                        </div>
                                    </div>
                                </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </section>
    </div>

    <div id="popup" class="popup">
        <div class="popup-card" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="btn-section"></div>
            </div>
        </div>
    </div> 



<script>

    $(document).ready(function (){
        // get the test_id
        var fragment = window.location.hash;
        if (fragment.startsWith('#')) { var test_id = parseInt(fragment.substring(1)); } 
        // assign the html DOM
        var progressBar = document.getElementById('myProgressBar');
        const toggleRecordingButton = $('#recordButton');
        const audioPlayer = $('#audioPlayer');
        // assign the pagination variable data
        var currentPage = 1;
        var questionsPerPage = 1;
        // define the question or answers variable
        let question_id;
        let type;
        let prepairTime;
        var pageNumber;
        let score = 0;
        let total = 0;
        let KeyWords;
        // assigned the arrays
        let rw_user_answr = [];
        var valuesArray = [];
        var highlightedIndices = [];
        var selectedAnswers = [];

        // starting popup message
        $("#popup").fadeIn(400,function() {
            $('.card-title').text('Test Resumed')
            $('.card-text').text('Click "Continue" to start the test.')
            $('.btn-section').append(`
                <a id="starting-continue" href="#"  class="btn btn-primary float-center me-3">Continue</a>
            `)
        });

        //continue button
        $(document).on('click', '#starting-continue', function(event) {
            $('#popup').fadeOut()
            $('#starting-continue').remove() 
            fetchAndDisplayQuestions(currentPage)
        })

        //fetch the start page number
        $.ajax({
            url: `controlers/get.php?data_type=startPage&test_id=${test_id}`,
            method: 'GET',
            success: function(data){ pageNumber = data['start_page'] }
        })


        /*******************************************************************************************************************
        ************************************** FETCHING DATA FROM DB *******************************************************
        *******************************************************************************************************************/

        function fetchAndDisplayQuestions(page){
            $.ajax({
                url: `controlers/get.php?data_type=getQuestion&page=${page}&per_page=${questionsPerPage}&test_id=${test_id}&type=${null}`,
                method: 'GET',
                success: function(data){
                    console.log(data)
                    isRecording = false;
                    prepairTime = false;
                    
                    // DOM value clearing
                    $('#title').empty();
                    $('#Question').empty();
                    $('#solution').empty();
                    // assign the variable from database
                    totalPages = data['totalItems'];
                    $('#text_row').css('display','none')

                    for (var i = 0; i < data['data'].length; i++) {
                        // assign the variable from database
                        type = data['data'][i].type;
                        Solution = data['data'][i].solution;
                        type = data['data'][i].type;
                        KeyWords = data['data'][i].key_words
                        question_id = data['data'][i].question_id;
                        // title DOM Create
                        var mainStyles = $('#solution').attr('style');
                        $('#title').append(`<h4 style="color: white;">${data['data'][i].question}</h2>`);


                        if(type == 'Read Aloud'){ 
        //------> Read Aloud
                            resetTimer(2)
                            startTimer(2)
                            $('#solution').attr('style', mainStyles);
                            $('#solution').append(`<p>${data['data'][i].solution}</p>`);

                        }else if(type === 'Repeat Sentence' || type === 'Re-tell Lecture' || type == 'Answer Short Question'){
        //------> Repeate Sentence, Re-tell Lecture and Answer Short Question
                            resetTimer(3)
                            startTimer(3)
                            $('#solution').attr('style', mainStyles);
                            $('#solution').append(`
                                <audio id = "questionAudio" controls style="width: 400px; margin: 50px">
                                    <source src='${data['data'][i].mp4File}' type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>`
                            );

                        }else if(type == 'Describe Image'){
        //------> Describe Image
                            resetTimer(4)
                            startTimer(4)
                            $('#solution').attr('style', mainStyles);
                            $('#solution').append(`<img src="${data['data'][i].imageFile}" style="width:300px; height: 200px">`);

                        }else if(type == 'Summarize Written Text' || type == 'Write Essay'){ 
        //------> Summarize Written Test, Write Essay
                            resetTimer(5)
                            startTimer(5)
                            $('#solution').removeAttr('style');
                            $('#solution').css('text-align', 'justify')
                            $('#text_row').css('display','block')
                            $('#prepair-time').empty()
                            $('#timer_row').css('margin-bottom', '20px')

                            var paragraphsArray = Solution.split('"=,');
                            paragraphsArray = paragraphsArray.map(function(paragraph) {
                                return paragraph.trim();
                            });
                            console.log(paragraphsArray)
                            for (var i = 0; i < paragraphsArray.length; i++) {
                                $('#solution').append('<p>' + paragraphsArray[i] + '</p>');
                            }
                            
                        }else if(type == 'Reading & Writing：Fill in the blanks'){ 
        //------> Reading & Writing：Fill in the blanks
                            resetTimer(5)
                            startTimer(5)
                            
                            $('#prepair-time').empty()
                            $('#timer_row').css('margin-bottom', '20px')

                            $('#solution').attr('style', mainStyles);
                            
                            var jsonData = JSON.parse(Solution);
                            console.log(jsonData)
                            $('#solution').append(`<p>${jsonData[0].question}</p>`);

                            for (var i = 0; i < jsonData[0].answers.length; i++) { 
                                var placeholder = "{{" + (i + 1) + "}}";
                                var selectHtml = "<select style='display: inline-block;' id='select" + (i + 1) + "' class='dropdown'>" +
                                                "<option value=''>Select</option>";
                                for (var j = 0; j < jsonData[0].answers[i].length; j++) { 
                                    selectHtml += "<option value='" + jsonData[0].answers[i][j] + "'>" + jsonData[0].answers[i][j] + "</option>";
                                }
                                selectHtml += "</select>";
                                $("#solution").html($("#solution").html().replace(placeholder, selectHtml));
                            }

                            $(".dropdown").change(function() {
                                var allSelected = true;
                                $(".dropdown").each(function() {
                                    if ($(this).val() === "") {
                                        allSelected = false;
                                        return false; 
                                    }
                                });
                                
                                if (allSelected) {
                                    //var selectedAnswers = [];
                                    $(".dropdown").each(function() {
                                        rw_user_answr.push($(this).val());
                                    });
                                    console.log(rw_user_answr.join(", "))
                                }
                            });

                        }else if(type == 'Re-order Paragraphs'){ 
        //------> Re-order Paragraphs
                            resetTimer(5)
                            startTimer(5)
                            

                            $('#prepair-time').empty()
                            $('#timer_row').css('margin-bottom', '20px')

                            const array = JSON.parse(Solution);

                            $('#solution').attr('style', mainStyles);
                            $('#solution').append(`
                                <div id="cardContainer">
                                </div>
                            `);

                            var cardContainer = $('#cardContainer');

                            for (let i = 0; i < array.length; i++) {
                                let cardNumber = i + 1;
                                let olStart = i + 1;
                                cardContainer.append(`
                                    <div id="card${cardNumber}" class="card px-5" draggable="true" value="${cardNumber}">
                                        <ol style="list-style: decimal;" start="${olStart}">
                                            <li>${array[i]}</li>
                                        </ol>
                                    </div>
                                `);
                            }

                        //swapping cards -> drag and drop feature
                            $(".card").on("dragstart", function(event) {
                                $(this).addClass("dragging");
                            });
                        
                            $(".card").on("dragend", function(event) {
                                $(this).removeClass("dragging");
                            });
                        
                            $(".card").on("dragover", function(event) {
                                event.preventDefault();
                            });
                        
                            $(".card").on("drop", function(event) {
                                event.preventDefault();
                                var draggingCard = $(".dragging");
                                var droppedCard = $(this);
                                var cardValue = draggingCard.attr("value");
                            
                                // Calculate the index of the dragging card and dropped card
                                var draggingIndex = draggingCard.index();
                                var droppedIndex = droppedCard.index();
                                
                                // Swap the positions of the dragging card and dropped card in the DOM
                                if (draggingIndex < droppedIndex) {
                                    draggingCard.insertAfter(droppedCard);
                                } else {
                                    draggingCard.insertBefore(droppedCard);
                                }
                                
                                valuesArray = []

                                // push the index of all cards after rearrangement valuesArray
                                $(".card").each(function(index) {
                                    valuesArray.push($(this).attr("value"));
                                });
                            });

        
                        }else if(type == 'Multiple Choice (Multiple)-R'){ 
        //------> Multiple Choice (Multiple)-R
                            resetTimer(5)
                            startTimer(5)

                            $('#prepair-time').empty()
                            $('#timer_row').css('margin-bottom', '20px')

                            const jsonData = JSON.parse(Solution);
                            $('#solution').css('display','block');
                            $('#solution').prepend('<p>' + jsonData.Question + '</p>');

                            for(var i = 0; i < jsonData.answer.length; i++){
                                $('#solution').append('<p><input type="checkbox" name="answer" value="'+(i+1)+'"> ' + jsonData.answer[i] + '</p>');
                            }

                        }else if(type == 'Multiple Choice (Single)-R'){ 
        //------> Multiple Choice (Single)-R
                            resetTimer(5)
                            startTimer(5)

                            $('#prepair-time').empty()
                            $('#timer_row').css('margin-bottom', '20px')

                            const jsonData = JSON.parse(Solution);
                            $('#solution').css('display','block');
                            $('#solution').prepend('<p>' + jsonData.Question + '</p>');

                            for(var i = 0; i < jsonData.answer.length; i++){
                                $('#solution').append('<p><input type="radio" name="answer" value="'+(i+1)+'"> ' + jsonData.answer[i] + '</p>');
                            }

                        }else if(type == 'Reading：Fill in the Blanks'){ 
        //------> Reading：Fill in the Blanks
                            resetTimer(5)
                            startTimer(5)

                            $('#prepair-time').empty()
                            $('#timer_row').css('margin-bottom', '20px')

                            let jsonData = JSON.parse(Solution)

                            //const jsonData = JSON.parse(Solution);
                            $('#solution').css('display','block');
                            const form = $('<form>')
                                form.attr('id','form1')
                                const dHolder = $('<div>')
                                    dHolder.addClass('droppableHolder')
                                    dHolder.append(`<p>`+jsonData.Question+`</p>`)
                                form.append(dHolder)
                            const dContent = $('<div>')
                                    dContent.css('display','flex')
                                    jsonData.answer.forEach((value, index) => {
                                        const draggable = $('<div>').text(value)
                                            draggable.addClass('draggable btn-primary')
                                            dContent.append(draggable)
                                    });
                            $('#solution').append(form, dContent)
                            valuesArray = []
                            $(function () {
                                $(".draggable").draggable({
                                    revert: true,
                                    helper: 'clone',
                                    start: function (event, ui) {
                                        $(this).fadeTo('fast', 0.5);
                                    },
                                    stop: function (event, ui) {
                                        $(this).fadeTo(0, 1);
                                    }
                                });

                                $(".droppable").droppable({
                                    hoverClass: 'active',
                                    drop: function (event, ui) {
                                        var draggableText = $(ui.draggable).text();
                                        valuesArray.push({ value: draggableText, id: this.id });
                                        $(this).val(function(index, value) {
                                            return value + draggableText;
                                        });
                                        $(ui.draggable).remove(); 
                                        console.log(valuesArray)

                                    }
                                });
                            });        

                        }else if(type == 'Summarize Spoken Text' || type == 'Write From Dictation'){ 
        //------> Summarize Spoken Text & Write From Dictation
        
                            resetTimer(3)
                            startTimer(3)
                            $('#solution').css('margin-top','0px')
                            const audio = $('<div>')
                                audio.append(`
                                <audio id = "questionAudio" controls style="width: 400px; margin-bottom: 20px">
                                    <source src='${data['data'][i].mp4File}' type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>`
                                );
                                audio.css({'display':'flex','justify-content':'center'})

                            $('#solution').append(audio)
                            $('#text_row').css('display','block')
                            $('#timer_row').css('margin-bottom', '20px')

                        }else if(type == 'Multiple Choice (Multiple)-L'){ 
        //------> Multiple Choice (Multiple)-L
                            resetTimer(3)
                            startTimer(3)

                            const jsonData = JSON.parse(Solution);
                            $('#solution').css({'display':'block', 'margin-top':'0px'});
                            
                            const audio = $('<div>')
                                audio.append(`
                                <audio id = "questionAudio" controls style="width: 400px; margin-bottom: 20px">
                                    <source src='${data['data'][i].mp4File}' type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>`
                                );
                                audio.css({'display':'flex','justify-content':'center'})
                            
                            const question = $('<div>')
                            question.prepend('<p style="font-weight:bold">' + jsonData.Question + '</p>');

                            for(var i = 0; i < jsonData.answer.length; i++){
                                question.append('<p><input type="checkbox" name="answer" value="' + (i+1) + '"> ' + jsonData.answer[i] + '</p>');
                            }

                            $('#solution').append(audio, question)

                        }else if(type == 'Multiple Choice (Single)-L' || type == 'Highlight Correct Summary' || type == 'Select Missing Word'){ 
        //------> Multiple Choice (Single)-L & Highlight Correct Summary & Select Missing Word
                            resetTimer(3)
                            startTimer(3)

                            const jsonData = JSON.parse(Solution);
                            $('#solution').css({'display':'block', 'margin-top':'0px'});
                            
                            const audio = $('<div>')
                                audio.append(`
                                <audio id = "questionAudio" controls style="width: 400px; margin-bottom: 20px">
                                    <source src='${data['data'][i].mp4File}' type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>`
                                );
                                audio.css({'display':'flex','justify-content':'center'})
                            
                            const question = $('<div>')
                            question.prepend('<p style="font-weight:bold">' + jsonData.Question + '</p>');

                            for(var i = 0; i < jsonData.answer.length; i++){
                                question.append('<p><input type="radio" name="answer" value="' + (i+1) + '"> ' + jsonData.answer[i] + '</p>');
                            }

                            $('#solution').append(audio, question)

                        }else if(type == 'Listening: Fill in the Blanks'){ 
        //------> Listening: Fill in the Blanks
                            resetTimer(3)
                            startTimer(3)

                            const jsonData = JSON.parse(Solution);
                            $('#solution').css({'display':'block', 'margin-top':'0px'});
                            
                            const audio = $('<div>')
                                audio.append(`
                                <audio id = "questionAudio" controls style="width: 400px; margin-bottom: 20px">
                                    <source src='${data['data'][i].mp4File}' type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>`
                                );

                                audio.css({'display':'flex','justify-content':'center'})
                            
                                $('#solution').css('display','block');
                                const form = $('<form>')
                                    form.attr('id','form1')
                                    const dHolder = $('<div>')
                                        dHolder.addClass('droppableHolder')
                                        dHolder.append(`<p>`+jsonData.Question+`</p>`)
                                    form.append(dHolder)

                            $('#solution').append(audio, form)
                        }else if(type == 'Highlight Incorrect Words'){ 
        //------> Highlight Incorrect Words
                            resetTimer(3)
                            startTimer(3)

                            var isDragging = false;
                            highlightedIndices = [];

                            //const jsonData = JSON.parse(Solution);
                            $('#solution').css({'display':'block', 'margin-top':'0px'});
                            
                            const audio = $('<div>')
                                audio.append(`
                                <audio id = "questionAudio" controls style="width: 400px; margin-bottom: 20px">
                                    <source src='${data['data'][i].mp4File}' type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>`
                                );

                                audio.css({'display':'flex','justify-content':'center'})
                            
                                $('#solution').css('display','block');
                                const form = $('<form>')
                                    form.attr('id','form1')
                                    const dHolder = $('<div>')
                                        dHolder.addClass('droppableHolder')
                                        dHolder.append(`<p id="paragraph">`+Solution+`</p>`)
                                    form.append(dHolder)

                            $('#solution').append(audio, form)


                            function toggleHighlight(index) {
                                var indexPos = highlightedIndices.indexOf(index);
                                if (indexPos === -1) {
                                highlightedIndices.push(index);
                                } else {
                                highlightedIndices.splice(indexPos, 1);
                                }
                                $('#paragraph span').eq(index).toggleClass('highlight');
                            }

                        // Mouse down event listener to start selection
                            $('#paragraph').on('mousedown', 'span', function(e) {
                                isDragging = true;
                                var index = $(this).index();
                                toggleHighlight(index);
                                e.preventDefault(); // Prevent text selection while dragging
                            });

                        // Mouse move event listener to continue selection
                            $('#paragraph').on('mousemove', 'span', function() {
                                if (isDragging) {
                                var index = $(this).index();
                                toggleHighlight(index);
                                }
                            });

                        // Mouse up event listener to end selection
                            $(document).mouseup(function() {
                                isDragging = false;
                            });

                        // Clear the paragraph and populate it with spans for each word
                            var paragraph = $('#paragraph');
                            var words = paragraph.text().split(' ');
                            paragraph.empty();
                            words.forEach(function(word) {
                                var span = $('<span>').text(word + ' ');
                                paragraph.append(span);
                            });
                        } 

                    }
                    function updatePagination() {
                        $("#currentPage").text(pageNumber);
                        $("#totalPages").text(totalPages);
                    }
                    updatePagination()
                    
                }
            })
        }


        

        

        // next button popup message
        $("#next").on("click", function() {
            if(type == 'Summarize Written Text' || type == 'Write Essay' || type == 'Reading & Writing：Fill in the blanks' || type == 'Re-order Paragraphs' || type == 'Multiple Choice (Multiple)-R' || type == 'Multiple Choice (Single)-R' || type == 'Reading：Fill in the Blanks' || type == 'Summarize Spoken Text' || type == 'Multiple Choice (Multiple)-L' || type == 'Multiple Choice (Single)-L' || type == 'Highlight Correct Summary' || type == 'Select Missing Word' || type == 'Listening: Fill in the Blanks' || type == 'Highlight Incorrect Words' || type == 'Write From Dictation'){
                $("#popup").fadeIn(400,function() {
                    //$('#cancel').css('display','none')
                    $('.card-title').text('Confirm')
                    $('.card-text').text('Are you it you want to submit this answer this answer and go to the next question?')
                    $('.btn-section').append(`
                        <a id="yes-popup" href="#"  class="btn btn-primary float-center me-3">YES</a>
                        <a id="no-popup" href="#" data-recording = 1  class="btn btn-primary float-center me-3">NO</a>
                    `)
                });
            }else{
                prepairTime = !prepairTime
                RecordingButton()
            }            
        });

        //Yes button
        $(document).on('click', '#yes-popup', function(event) {
            
            stopTimer()
            if(type == 'Reading & Writing：Fill in the blanks' || type == 'Re-order Paragraphs' || type == 'Multiple Choice (Multiple)-R' || type == 'Multiple Choice (Single)-R' || type == 'Reading：Fill in the Blanks' || type == 'Multiple Choice (Multiple)-L' || type == 'Multiple Choice (Single)-L' || type == 'Highlight Correct Summary' || type == 'Select Missing Word' || type == 'Listening: Fill in the Blanks' || type == 'Highlight Incorrect Words' || type == 'Write From Dictation'){
                submit()
            }else{
                if(type == 'Summarize Written Text' || type == 'Write Essay' || type == 'Summarize Spoken Text'){
                    submit()
                }else{
                    stopRecording();
                }

                $('.btn-section').empty()
                $('.card-title').empty()
                $('.card-text').empty()
                $("#popup").fadeOut();


                $("#popup").fadeIn(400,function() {
                    $('.card-title').text('File Processing.........')
                    $('.btn-section').append(`
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `)
                    $('.card-text').text('Do not refresh page')

                    
                });
            }
            

        })

        //No button
        $(document).on('click', '#no-popup', function(event) {
            $('.btn-section').empty();
            $('.card-title').empty();
            $('.card-text').empty();
            $("#popup").fadeOut();           
        });



        //invisible recording button function
        
        function RecordingButton() {
            if (!isRecording) {
                if(prepairTime){
                    resetTimer(1)
                    stopTimer()
                    startTimer(1)//--> recording timer
                    startRecording();
                    isRecording = !isRecording;
                }else {
                    stopTimer()
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
                    stopTimer()
                    stopRecording()
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
        };



        //close-popup for cannot skip popup
        $(document).on('click', '#close-popup', function(event) {
            $('.btn-section').empty()
            $('.card-title').empty()
            $('.card-text').empty()
            $("#popup").fadeOut();
            if(type == 'Read Aloud'){
                startTimer(2)
            }else if(type === 'Repeat Sentence' || type === 'Re-tell Lecture' || type == 'Answer Short Question'){
                startTimer(3)
            }else if(type == 'Describe Image'){
                startTimer(4)
            }
            
            
        });





        //after click the save and exit button this function load
        function closeAndMoveToPreviousTab() {
            $.ajax({
                url:'controlers/post.php',
                type: 'POST',
                data: { task : 'incomplete_exam', test_id :  test_id},
                success: function(response){
                    window.close();
                    window.history.back();
                    
                }
            })

            
            
        }

        //click the save and exit button
        $('#save_and_exit').on('click', function() {
            closeAndMoveToPreviousTab();
            const replyMessage = 'Reload';
            event.originalEvent.source.postMessage(replyMessage, '*');

        });


        /*******************************************************************************************************************
        ************************************** Timming Function *******************************************************
        *******************************************************************************************************************/

        //assign the variables of time
        let seconds1 = 0;
        let seconds2 = 35;
        let seconds3 = 5;
        let seconds4 = 25;
        let seconds5 = 0;
        let minutes = 0;
        let hours = 0;

        function startTimer(task) {
            prepairTime = !prepairTime
            timer = setInterval(function(){updateTimer(task)}, 1000);
        }

        function stopTimer() {
            clearInterval(timer);
        }

        function resetTimer(task) {             
            clearInterval(timer);
            if(task==1){
                seconds1 = 0;
                progressBar.style.width = 0+'%'
            }else if(task == 2){
                seconds2 = 35;
            }else if(task == 3){
                seconds3 = 5;
            }else if(task == 4){
                seconds4 = 25;
            }else if(task == 5){
                seconds5 = 0;
            }
            minutes = 0;
            hours = 0;
            updateTimerDisplay(task);
        }

        function updateTimer(task) {
            if(task==2){
                seconds2--;
                if (seconds2 === 30) {
                    clearInterval(timer);
                    RecordingButton();  
                }
                    
            }else if(task==3){
                seconds3--;
                if (seconds3 === 0) {
                    clearInterval(timer);
                    playAudio();
                }
                    
            }else if(task==4){ 
                seconds4--;
                if (seconds4 === 0) {
                    clearInterval(timer);
                    RecordingButton(); 
                }
                    
            }else if(task==1){
                //this is progress increasing
                var currentWidth = parseFloat(progressBar.style.width, 10);
                var newWidth = (currentWidth + 2.5) % 101; 
                progressBar.style.width = newWidth + '%';
                                         
                seconds1++;
                if (seconds1 === 40) {
                    clearInterval(timer);
                    RecordingButton();
                }
            }else if(task==5){
                //this is progress increasing
                var currentWidth = parseFloat(progressBar.style.width, 10);
                var newWidth = (currentWidth + 0.16) % 101; 
                progressBar.style.width = newWidth + '%';
                
                seconds5++;
                if (seconds5 >= 60) {
                    seconds5 = 0;
                    minutes++;
                    
                    if (minutes >= 10) {
                        clearInterval(timer);
                    }
                }
                
                
            }
            updateTimerDisplay(task);
        }

        function updateTimerDisplay(task) { 
            if(task==1){
                const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds1)}`;
                $("#timer").text(formattedTime);
            }else if(task==2){
                const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds2)}`;
                $("#prepair-timer").text(formattedTime);
            }else if(task==3){
                const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds3)}`;
                $("#prepair-timer").text(formattedTime);
            }else if(task==4){
                const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds4)}`;
                $("#prepair-timer").text(formattedTime);
            }else if(task==5){
                const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds5)}`;
                $("#timer").text(formattedTime);
            }
        }

        function pad(value) {
            return value < 10 ? `0${value}` : value;
        }


        /*******************************************************************************************************************
        ************************************** Audio Play *******************************************************
        *******************************************************************************************************************/


        function playAudio() {
            var questionAudio = $('#questionAudio')[0];

            if (questionAudio) {
                questionAudio.removeEventListener('loadedmetadata', handleMetadataLoaded);
                questionAudio.addEventListener('loadedmetadata', handleMetadataLoaded);

                if (questionAudio.readyState >= 2) {
                    questionAudio.dispatchEvent(new Event('loadedmetadata'));
                }

                questionAudio.play();
            } else {
                console.error("Audio element not found");
            }
        }

        function handleMetadataLoaded() {
            var duration = $('#questionAudio')[0].duration;
            console.log("Audio duration: " + duration + " seconds");

            recordingTimeout = setTimeout(function () {
                if(type == 'Summarize Spoken Text' || type == 'Multiple Choice (Multiple)-L' || type == 'Multiple Choice (Single)-L' || type == 'Highlight Correct Summary' || type == 'Select Missing Word' || type == 'Listening: Fill in the Blanks' || type == 'Highlight Incorrect Words' || type == 'Write From Dictation'){
                    startTimer(5)
                }else{
                    RecordingButton();
                }
            }, duration * 1000);
        }

        function stopRecordingTimeout() {
            if (recordingTimeout) {
                clearTimeout(recordingTimeout);
            }
        }

        function stopAudio(){
            var questionAudio = $('#questionAudio')[0];
            questionAudio.pause()
            questionAudio.currentTime = 0
            stopRecordingTimeout()
        }


        /*******************************************************************************************************************
        ************************************** Recording Section *******************************************************
        *******************************************************************************************************************/

        let audioChunks = [];


        function startRecording() {
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
                        audioPlayer.attr('src', audioUrl);
                        console.log(audioUrl)
                        const formData = new FormData();
                        formData.append('audio', audioBlob, 'recording.wav');
                        formData.append('task','audio_save');

                        // Send the recorded audio to the server using $.ajax or $.post
                        saveAudio(formData);

                        audioChunks = [];
                    };

                    mediaRecorder.start();
                    toggleRecordingButton.prop('disabled', false);
                })
                .catch(function (error) {
                    console.error('Error accessing microphone:', error);
                });
        }


        function stopRecording() {
            if (mediaRecorder && mediaRecorder.state === 'recording') {
                mediaRecorder.stop();
            }
        }

        function pauseRecording() {
            if (mediaRecorder && mediaRecorder.state === 'recording') {
                mediaRecorder.pause();
            }
        }

        function saveAudio(formData) {
            // Send the recorded audio data to the server using $.ajax or $.post
            $.ajax({
                url: 'controlers/post.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log('Audio saved successfully:');
                    console.log(response.audioFile2);
                    audioFile = response.audioFile2;
                    submit()
                },
                error: function (error) {
                    console.error('Error saving audio:', error);
                }
            });
        }


        function submit(){
            answer = $('#text_answer').val();

            console.log('Question No:' + question_id)
            if(type == 'Read Aloud' || type == 'Repeat Sentence'){
                task = 'speaking-i'
                data = { task : task, Solution: Solution, question_id: question_id, student_id: 2, key_words: KeyWords, type: type, test_id: test_id}
            }else if(type == 'Describe Image' || type == 'Re-tell Lecture' || type == 'Answer Short Question'){
                task = 'speaking-ii'
                data = { task : task, Solution: Solution, question_id: question_id, student_id: 2, key_words: KeyWords, type: type, test_id: test_id}
            }else if(type == 'Summarize Written Text' || type == 'Summarize Spoken Text'){
                task = 'writing-i'
                data = { task : task, Solution: Solution, answer: answer, question_id: question_id, student_id: 2, key_words: KeyWords, type: type, test_id: test_id}
            }else if(type == 'Write From Dictation'){
                task = 'dictation'
                data = { task : task, Solution: Solution, answer: answer, question_id: question_id, student_id: 2, key_words: KeyWords, type: type, test_id: test_id}
            }else if(type == 'Write Essay'){
                task = 'writing-ii';
                data = { task : task, Solution: Solution, answer: answer, question_id: question_id, student_id: 2, key_words: KeyWords, type: type, test_id: test_id} 
            }else if(type == 'Reading & Writing：Fill in the blanks'){

                const jsonObj = JSON.parse(KeyWords);
                $.each(jsonObj, function(index, value) {
                    if(rw_user_answr[index] == value){
                        score++
                    }
                });
                const rua = JSON.stringify(rw_user_answr);

                task = 'reading_marks';
                data = { task : task, answer: rua, question_id: question_id, score: score, test_id: test_id} 

            }else if(type == 'Re-order Paragraphs'){

                const solutionArray = JSON.parse(KeyWords);
                if(valuesArray.length === 0){valuesArray = ['1','2','3','4']}

                var count = 0;
                for (var i = 0; i < valuesArray.length; i++) {
                    if (valuesArray[i] === solutionArray[i]) {
                        count++;
                    }
                }

                task = 'reading_marks';
                data = { task : task, answer: JSON.stringify(valuesArray), question_id: question_id, score: count, test_id: test_id} 
            }else if(type == 'Multiple Choice (Multiple)-R' || type == 'Multiple Choice (Multiple)-L'){


                var selectedAnswers = [];

                $('input[name="answer"]:checked').each(function(){
                    selectedAnswers.push($(this).val());
                });

                // Compare selected answers with correct answers
                var KeywordAsArray = JSON.parse(KeyWords);
                console.log(KeyWords)
                function countSameItems(array1, array2) {
                    var commonItems = 0;
                    var smallerArray = array1.length <= array2.length ? array1 : array2;
                    var largerArray = array1.length > array2.length ? array1 : array2;

                    $.each(smallerArray, function(index, item) {
                        if ($.inArray(item, largerArray) !== -1) {
                            commonItems++;
                        }
                    });
                    return commonItems;
                }


                var count = countSameItems(selectedAnswers, KeywordAsArray);
                if(selectedAnswers.length > KeywordAsArray.length){
                    count = 0
                }
                task = 'reading_marks';
                data = { task : task, answer: JSON.stringify(selectedAnswers), question_id: question_id, score: count, test_id: test_id} 

            }else if(type == 'Multiple Choice (Single)-R' || type == 'Multiple Choice (Single)-L' || type == 'Highlight Correct Summary' || type == 'Select Missing Word'){
                var selectedAnswers = [];

                var selectedAnswer = $('input[name="answer"]:checked').val();
                console.log("Selected answer:", selectedAnswer);

                // Compare selected answers with correct answers
                var KeywordAsArray = JSON.parse(KeyWords);
                var count;

                if (KeywordAsArray.includes(selectedAnswer)) {
                    count = 1
                } else {
                    count = 0
                }

                task = 'reading_marks';
                data = { task : task, answer: JSON.stringify(selectedAnswer), question_id: question_id, score: count, test_id: test_id} 
            }else if(type == 'Reading：Fill in the Blanks'){
                //const data1 = { 1: "departments", 2: "reaches", 3: "regardless", 4: "majority" };
                const data1 = JSON.parse(KeyWords)
                
                const compareValues = (arr1, arr2) => {
                    const sameValues = {};
                    count = 0
                    $.each(arr2, function(index, item) {
                        if (arr1[item.id] === item.value) {
                            count++
                        }
                    });
                    
                    return count;
                };
                const score = compareValues(data1, valuesArray);
                task = 'reading_marks';
                data = { task : task, answer: JSON.stringify(valuesArray), question_id: question_id, score: score, test_id: test_id} 
            }else if(type == 'Listening: Fill in the Blanks'){
                const data1 = JSON.parse(KeyWords)
                
                $('.droppable').each(function() {
                    var id = $(this).attr('id');
                    var value = $(this).val();
                    valuesArray.push({ id: id, value: value });
                });
                
                const compareValues = (arr1, obj2) => {
                    let count = 0;
                        
                    arr1.forEach(item => {
                        const id = item.id;
                        const value = item.value;
                        
                        if (value === obj2[id]) {
                            count++;
                        }
                    });
                    return count;
                };


                
                const score = compareValues(valuesArray, data1);

                task = 'reading_marks';
                data = { task : task, answer: JSON.stringify(valuesArray), question_id: question_id, score: score, test_id: test_id} 
            }else if(type == 'Highlight Incorrect Words'){

                console.log('Highlighted Indices Array:', highlightedIndices);
                const valuesArray = JSON.parse(KeyWords)
                
                var count = 0;
              
                $.each(highlightedIndices, function(index, value) {
                    if ($.inArray(value, valuesArray) !== -1) {
                        count++;
                    }
                });

                task = 'reading_marks';
                data = { task : task, answer: JSON.stringify(highlightedIndices), question_id: question_id, score: count, test_id: test_id} 
            }

            $.ajax({
                url:'controlers/post.php',
                type: 'POST',
                data: data,
                success: function(response){
                    $("#popup").fadeOut();
                    $('.btn-section').empty()
                    $('.card-title').empty()
                    $('.card-text').empty()
                    $('#next-popup').remove(); 
                    const replyMessage = 'Reload';
                    console.log(response.message);
                    console.log(response.grammar);
                    if(response.success){
                        rw_user_answr = [];
                        $("#text_answer").val("");
                        if (pageNumber < totalPages) {
                            pageNumber++;
                            fetchAndDisplayQuestions(currentPage);
                            resetTimer(1);
                            resetTimer(1)
                            if(type == 'Read Aloud'){ 
                                resetTimer(2)
                            }else if(type === 'Repeat Sentence' || type === 'Re-tell Lecture' || type == 'Answer Short Question' || type == 'Summarize Spoken Text' || type == 'Write From Dictation' || type == 'Multiple Choice (Multiple)-L' || type == 'Multiple Choice (Single)-L' || type == 'Highlight Correct Summary' || type == 'Select Missing Word' || type == 'Listening: Fill in the Blanks' || type == 'Highlight Incorrect Words'){
                                resetTimer(3)
                            }else if(type == 'Describe Image'){
                                resetTimer(4)
                            }else if(type == 'Summarize Written Text' || type == 'Write Essay' || type == 'Reading & Writing：Fill in the blanks' || type == 'Re-order Paragraphs' || type == 'Multiple Choice (Multiple)-R' || type == 'Multiple Choice (Single)-R' || type == 'Reading：Fill in the Blanks'){ 
                                resetTimer(5)
                            }   
                        }else{
                            $.ajax({
                                url:'controlers/post.php',
                                type: 'POST',
                                data: { task : 'complete_exam', test_id :  test_id},
                                success: function(response){
                                    window.close();
                                    window.history.back();
                                }
                            })
                        } 
                        
                    }else{
                        $("#popup").fadeIn(400,function() {
                            //$('#cancel').css('display','none')
                            $('.card-title').text('Notice Error')
                            $('.card-text').text('The answer was not saved due to an internet problem or a problem recording your voice')
                            $('.btn-section').append(`
                                <a id="save_and_exit_popup" href="#"  class="btn btn-primary float-center me-3">Save and Exit</a>
                                <a id="retry" href="#"  class="btn btn-danger float-center me-3">Retry</a>

                            `)
                        });

                        $(document).on('click', '#save_and_exit_popup', function(event) {
                            $('.btn-section').empty()
                            $('.card-title').empty()
                            $('.card-text').empty()
                            closeAndMoveToPreviousTab();
                        });

                        $(document).on('click', '#retry', function(event) {
                            resetTimer(1)
                            if(type == 'Read Aloud'){ 
                                resetTimer(2)
                                startTimer(2)
                            }else if(type === 'Repeat Sentence' || type === 'Re-tell Lecture' || type == 'Answer Short Question'  || type == 'Summarize Spoken Text' || type == 'Write From Dictation' || type == 'Multiple Choice (Multiple)-L' || type == 'Multiple Choice (Single)-L' || type == 'Highlight Correct Summary' || type == 'Select Missing Word' || type == 'Listening: Fill in the Blanks' || type == 'Highlight Incorrect Words'){
                                resetTimer(3)
                                startTimer(3)
                            }else if(type == 'Describe Image'){
                                resetTimer(4)
                                startTimer(4)
                            }else if(type == 'Summarize Written Text' || type == 'Write Essay' || type == 'Reading & Writing：Fill in the blanks' || type == 'Re-order Paragraphs' || type == 'Multiple Choice (Multiple)-R' || type == 'Multiple Choice (Single)-R' || type == 'Reading：Fill in the Blanks'){ 
                                resetTimer(5)
                                startTimer(5)
                            }  
                            $('.btn-section').empty()
                            $('.card-title').empty()
                            $('.card-text').empty() 
                            $("#popup").fadeOut();
                            
                            //reset the timinig and recording features
                            isRecording = false
                            prepairTime = true
                        });

                    }
                    
                }
            })
                
        };


        

    

    })
</script>
    
</body>
</html>