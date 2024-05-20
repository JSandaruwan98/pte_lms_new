<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logo-icon.png">
    <title>PTE Learning Management System</title>
    <link rel="stylesheet" href="./assets/css/old_style/practiceExam.css">
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
      .highlight-red {
          background-color: red; /* Highlight color for indexes in the first array */
      }
      .highlight-yellow {
          background-color: yellow; /* Highlight color for indexes in the second array */
      }
      .highlight-green {
          background-color: green; /* Highlight color for indexes common to both arrays */
      }
      table{
        border-collapse: collapse;
        
      }
      #tbl-header{
          background-color: #B2DFDB;
      }
      
      #tdata{
        padding: 7px;
        border: 5px solid white;
        background-color: #F5F5F5;
      }
      .b1 {
        display: none;
        align-items: center;
        justify-content: center;
      }
      .titlebox{
        text-align: center;
        padding:0 5px;
        margin:-20px 30px 0px 30px;
        background:#F5F5F5;
        font-size: 10px;
      }
      #content{
        border:1px solid #6c757d;
        padding:10px;
        height: auto;
        width: auto;
        color: #6c757d;
      }
      
  </style>
    
    
</head>
<body>
    <section class="row p-3">
      <div class="col-2 text-center"><h4 class="h6 fw-bold">Text No: 04</h4><h4 class="h6 font-weight-bold">Practice Exam II</h4></div>
    </section>
    
    <section class="p-3">

        <table class="table" id="data-table">
            <thead>
              <tr id="tbl-header">
                <th class="text-center" scope="col" class="text-center" style="width: 5%;"><span style="color: #666464;">S.No</th>
                <th class="text-center" scope="col" class="text-center" style="width: 35%;"><span style="color: #666464;">Question</span></th>
                <th class="text-center" scope="col" class="text-center" style="width: 30%;"><span style="color: #666464;">User Answer</span></th>
                <th class="text-center" scope="col" class="text-center" style="width: 10%;"><span style="color: #666464;">Score</span></th>
                <th class="text-center" scope="col" class="text-center" style="width: 10%;"><span style="color: #666464;">Total</span></th>
              </tr>
            </thead>
            <tbody></tbody>
        </table>

        <nav class="pgecard" aria-label="Page navigation example">
          <ul id="pagingBatch" class="pagination"></ul>
        </nav>
    </section>
    <div class="b1">
      <div class="overlay-content-popup" id="overlay-content-popup">
          <div id="cb" class="content-popup">
              <div class="container">
                  <div class="row">
                      <div style="text-align: left; font-weight: 300;">Score Info</div>
                  </div>
                  
                  <div class="row mx-3">
                      <div id="score-progress-section" class="col-5 py-3">
                          <!--using progress bar display for the total score-->
                          <div id="total" class="row px-2" style="cursor: pointer;">
                              <div class="p-2">
                                  <div class="progress">
                                      <div class="progress-bar" id="total-progress" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <div style="font-weight: 300;">Total  ( <span id="total_score"></span>% )</div>
                              </div>     
                          </div>

                          <!--score cart section-->
                          <div id="score-section" class="row px-2">
                              <div id="score-cart-1" class="col-4 p-1">
                                  <div id="score-I" class="p-2"  style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3); border-radius: 5px; cursor: pointer;">
                                      <span id="score-name-1"></span><br><span id="score-marks-1" class="green-text"><span id="score-marks-add-1"></span></span>
                                  </div>
                              </div>
                              <div id="score-cart-2" class="col-4 p-1">
                                  <div id="score-II" class="p-2" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3); border-radius: 5px; cursor: pointer;">
                                      <span id="score-name-2"></span><br><span id="score-marks-2" class="yellow-text"><span id="score-marks-add-2"></span></span>
                                  </div>
                              </div>
                              <div id="score-cart-3" class="col-4 p-1">
                                  <div id="score-III" class="p-2"  style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3); border-radius: 5px; cursor: pointer;">
                                      <span id="score-name-3"></span><br><span id="score-marks-3" class="purple-text"><span id="score-marks-add-3"></span></span>
                                  </div>
                              </div>
                              <div id="score-cart-4" class="col-4 p-1">
                                  <div id="score-IV" class="p-2"  style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3); border-radius: 5px; cursor: pointer;">
                                      <span id="score-name-4"></span><br><span id="score-marks-4" class="orange-text"><span id="score-marks-add-4"></span></span>
                                  </div>
                              </div>
                              <div id="score-cart-5" class="col-4 p-1">
                                <div id="score-V" class="p-2"  style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3); border-radius: 5px; cursor: pointer;">
                                    <span id="score-name-5"></span><br><span id="score-marks-5" class="orange-text"><span id="score-marks-add-5"></span></span>
                                </div>
                              </div>
                              <div id="score-cart-6" class="col-4 p-1">
                                <div id="score-VI" class="p-2"  style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3); border-radius: 5px; cursor: pointer;">
                                    <span id="score-name-6"></span><br><span id="score-marks-6" class="orange-text"><span id="score-marks-add-6"></span></span>
                                </div>
                              </div>
                              <div id="score-cart-7" class="col-4 p-1">
                                <div id="score-VII" class="p-2"  style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3); border-radius: 5px; cursor: pointer;">
                                    <span id="score-name-7"></span><br><span id="score-marks-7" class="orange-text"><span id="score-marks-add-7"></span></span>
                                </div>
                              </div>
                          </div>

                          
              
              
                          <!--score anlysis and suggesion section-->
                          <div id="tl-section-1" class="togel-section1">
                              
                              <div id="skill-analysis-label" class="row px-2">
                                  <div class="p-2"></div><h4 class="h6" style="text-align: left;">Skill Analysis</h4>
                                  <p class="lh-sm" style="font-weight: 500; font-size: 10px; text-align:justify">The following scores show how you have performed in different aspects as compared to other users. These scores can be used to analyse how you can improve in this question, but they are not directly related to the PTE scores.</p>
                              </div>

                              <!--Each presentation is described using a progress bar of pronunciation, fluency, stress and speed-->
                              <div id="skill-analysis-progressbar" class="row">
                                  <div class="p-2"  style="background-color: white; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3); border-radius: 5px;">
                                      <div>
                                          <div class="progress mt-1">
                                              <div id="pronoun-progress" class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                          <h4 class="h6" style="font-size: 10px; text-align: right;"><span style="float: left;">Pronounciation Accuracy</span> <span id="pronoun-precentage"  class="text-primary"></span></h4>
                                      </div>
                                      <div>
                                          <div class="progress mt-1">
                                              <div id="fluent-progress" class="progress-bar" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                          <h4 class="h6" style="font-size: 10px; text-align: right;"><span style="float: left;">Fluent</span> <span id="fluent-precentage" class="text-primary"></span></h4>
                                      </div>
                                      <div>
                                          <div class="progress mt-1">
                                              <div id="confidence-progress" class="progress-bar" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                          <h4 class="h6" style="font-size: 10px; text-align: right;"><span style="float: left;">Stress</span> <span id="fluent-precentage" class="text-primary">0%</span></h4>
                                      </div>
                                      
                                  </div>
                              </div>    
                          </div>
                          
                          <!--suggestion section-->
                          <div class="togel-section2" style="display: none;">
                              <div id="suggestion" class="row px-2"  style="text-align: left;">
                                  <div class="p-2"></div><h4 class="h6">Suggestion</h4>
                                  <p id="suggestion-head" class="lh-sm" style="font-weight: 500; font-size: 10px;"></p>
                                  <ol id="suggestion-content" style="font-weight: 300; text-align: justify; line-height: 1; font-size: 10px; list-style-type: decimal; margin-left: 10px;">
                                      <li id="content-1"></li>
                                      <li id="content-2"></li>
                                      <li id="content-3"></li>
                                      <li id="content-4"></li>
                                  </ol>                                    
                              </div>
                          </div>

                          
                      </div>
                      

                      <div id="answer-section" class="col-7 ps-5">
                          
       

                          <!--answer error section 01(missed words, additional words and pronunciation suggesions)-->
                          <div id="answer-evaluation-1" class="row mt-4">

                              <div type="button" class="tab-a1 pronun btn btn-outline-secondary me-1" data-tab="tab9" style="width: 120px; height: 30px; font-size: 10px; border: 1px solid">Pronunciation</div>
                              <div type="button" class="tab-a1 additional btn btn-outline-secondary me-1" data-tab="tab8" style="width: 120px; height: 30px; font-size: 10px; border: 1px solid">Additional Words</div>
                              <div type="button" class="tab-a1 missed btn btn-outline-secondary" data-tab="tab7" style="width: 120px; height: 30px; font-size: 10px; border: 1px solid">Missed Words</div>

                              <!--*****************************************************************************************************************************************************-->
                              
                              <div class="tab-content-a1" id="tab9" style="border: none">
                                  <p id="error_colors" class="mb-2" style="color: black; text-align: left;"><span class="dot" style="background-color: green;"></span><span class="me-2"> Good </span><span class="dot" style="background-color: rgb(255, 162, 0);"></span><span class="me-2"> Average </span><span class="dot" style="background-color: red;"></span><span class="me-2"> Bad </span></p>
                                  <p id="pronun" style="text-align:justify;">fg</p>
                              </div>
                              <div class="tab-content-a1" id="tab8" style="border: none">
                                  <p class="mb-2" style="color: black; text-align: left;"></span><span class="dot" style="background-color: red;"></span><span class="me-2"> Additional words </span></p>
                                  <p id="additional" style="text-align:justify;">Content for Tab 2 goes here.</p>
                              </div>
                              <div class="tab-content-a1" id="tab7" style="border: none">
                                  <p class="mb-2" style="color: black; text-align: left;"></span><span class="dot" style="background-color: red;"></span><span class="me-2"> Missed words </span></p>
                                  <p id="missed" style="text-align:justify;">Content for Tab 3 goes here.</p>
                              </div>
                          </div>

                          <!--answer error section 02(grammar errors)-->
                          <div id="answer-evaluation-2" class="row">
                              <p id="user-answer" style="text-align:justify;">Content for Tab 3 goes here.</p>
                          </div>
                          <div id="comment-popup" style="font-weight: 500;"></div>
                      </div>
                  </div>
              </div> 
          </div>
      </div>
      
  </div>
    
</body>
<script>
  $(document).ready(function(){


    var fragment = window.location.hash;
    var values = fragment.substring(1).split('#');

    var test_id = values[0];
    var student_id = values[1];
    var id = values[2];

    /**##############################################################################
     *                   Evaluation Table Data Loading Function
     * ##############################################################################**/

     function loadData(){
      console.log(test_id)
          $.ajax({
            type: "GET",
            url: `controlers/get.php?data_type=evaluationSheet&test_id=${test_id}&student_id=${student_id}`,
            data: {  },
            dataType: "json",
            success: function (response) {
              console.log(response)
              var tableBody = $("#data-table tbody");   
              tableBody.empty();   // Remove the all previous data in to the table

              //Create a table adding a columns for each raw
              $i=1
              $.each(response, function (index, item) {
                const row = $('<tr>');
                  row.attr('id','tdata')

                  //First Column
                  const tdata1 = $('<td>').text($i);
                    tdata1.addClass('text-center');
                    tdata1.css('width', '5%')
                  
                  //Second Column
                  const tdata2 = $('<td>')
                    //tdata2.addClass('text-center');
                    const paraDiv = $('<p>')
                      paraDiv.addClass('text-justify')
                      paraDiv.text(item.solution)

                    const imageDiv = $('<img>')
                      imageDiv.attr({'id':'imageDiv', 'src': item.imageFile})
                      imageDiv.css({'width':'280px','height':'250px'})

                    const audioDiv = $('<audio>');
                      audioDiv.attr('id', 'audioDiv');
                      audioDiv.attr('controls', '');
                      audioDiv.css({'padding': '5px', 'border-radius': '30px', 'width': '300px', 'margin': '10px'});  
                      
                      const sourceDiv = $('<source>');
                        sourceDiv.attr('src', '../student/'+item.Q_audio); 
                        sourceDiv.attr('type', 'audio/wav');
                      audioDiv.append(sourceDiv);  

                    if(item.type == 'Read Aloud'){
                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.append(name, paraDiv)
                    }else if(item.type == 'Repeat Sentence' || item.type == 'Re-tell Lecture' || item.type == 'Answer Short Question' || item.type == 'Summarize Spoken Text' || item.type == 'Write From Dictation' || item.type == 'Highlight Incorrect Words'){
                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.append(name, audioDiv)
                    }else if(item.type == 'Describe Image'){
                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.append(name, imageDiv)
                    }else if(item.type == 'Summarize Written Text' || item.type == 'Write Essay'){
                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      const paraDivSWT = $('<p>')
                        paraDivSWT.addClass('text-justify')
                        
                      var paragraphsArray = item.solution.split('"=,');
                      paragraphsArray = paragraphsArray.map(function(paragraph) {
                        return paragraph.trim();
                      });
                      console.log(paragraphsArray)
                      for (var i = 0; i < paragraphsArray.length; i++) {
                        paraDivSWT.append('<p>' + paragraphsArray[i] + '</p>');
                      }

                      tdata2.append(name, paraDivSWT)
                    }else if(item.type == 'Reading & Writing：Fill in the blanks'){
                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.prepend(name)
                      const jsonData = JSON.parse(item.solution);

                      const Question = $('<div>').append('<p style="text-align: justify;">'+jsonData[0].question+'</p>');
                      for (var i = 0; i < jsonData[0].answers.length; i++) { 
                        var placeholder = "{{" + (i + 1) + "}}";
                        var selectHtml = "<select style='display: inline-block;' id='select" + (i + 1) + "' class='dropdown'>" +
                                        "<option value=''>Select</option>";
                        for (var j = 0; j < jsonData[0].answers[i].length; j++) { 
                            selectHtml += "<option value='" + jsonData[0].answers[i][j] + "'>" + jsonData[0].answers[i][j] + "</option>";
                        }
                        selectHtml += "</select>";
                        Question.html(Question.html().replace(placeholder, selectHtml));
                      }
                      const correctAnswer = $('<p>').text('Correct Answer')
                        correctAnswer.css('font-weight','bold')
                      tdata2.append(name, Question, correctAnswer);
                      const answer = JSON.parse(item.key_words)
                      $.each(answer, function(index, item) {
                        tdata2.append('<p><span style="font-weight: bold;">Option'+(index + 1)+':</span> ' + item + '</p>');        
                     })
                    }else if(item.type == 'Re-order Paragraphs'){

                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.prepend(name)
                      const array = JSON.parse(item.solution);
                      for(var i = 0; i < array.length; i++){
                        tdata2.append('<p><span style="font-weight: bold;">Option'+(i+1)+':</span> ' + array[i] + '</p>');
                      }

                      const correctAnswer = $('<p>').text('Correct Answer')
                        correctAnswer.css('font-weight','bold')
                      tdata2.append(correctAnswer);
                      const answer = JSON.parse(item.key_words)
                      console.log(answer)
                      $.each(answer, function(index, item) {
                        tdata2.append('<p><span style="font-weight: bold;">Option'+item+'</p>');        
                      })

                    }else if(item.type == 'Multiple Choice (Multiple)-R'){

                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.prepend(name)
                      const jsonData = JSON.parse(item.solution);
                      tdata2.append('<p style="text-align: justify;">' + jsonData.Question + '</p>');
                      for(var i = 0; i < jsonData.answer.length; i++){
                        tdata2.append('<p><span style="font-weight: bold;">Option'+(i+1)+':</span> ' + jsonData.answer[i] + '</p>');
                      }

                      const correctAnswer = $('<p>').text('Correct Answer')
                        correctAnswer.css('font-weight','bold')
                      tdata2.append(correctAnswer);
                      const answer = JSON.parse(item.key_words)
                      console.log(answer)
                      $.each(answer, function(index, item) {
                        tdata2.append('<p><span style="font-weight: bold;">Option'+item+'</p>');        
                      })

                    }else if(item.type == 'Multiple Choice (Single)-R'){

                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.prepend(name)
                      const jsonData = JSON.parse(item.solution);
                      tdata2.append('<p style="text-align: justify;">' + jsonData.Question + '</p>');
                      for(var i = 0; i < jsonData.answer.length; i++){
                        tdata2.append('<p><span style="font-weight: bold;">Option'+(i+1)+':</span> ' + jsonData.answer[i] + '</p>');
                      }

                      const correctAnswer = $('<p>').text('Correct Answer')
                        correctAnswer.css('font-weight','bold')
                      tdata2.append(correctAnswer);
                      const answer = JSON.parse(item.key_words)
                      console.log(answer)
                      $.each(answer, function(index, item) {
                        tdata2.append('<p><span style="font-weight: bold;">Option'+item+'</p>');        
                      })
                    }else if(item.type == 'Reading：Fill in the Blanks'){

                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.prepend(name)
                      const jsonData = JSON.parse(item.solution);
                      tdata2.append('<p style="text-align: justify;">' + jsonData.Question + '</p>');
                      for(var i = 0; i < jsonData.answer.length; i++){
                        tdata2.append('<p><span style="font-weight: bold;">Option'+(i+1)+':</span> ' + jsonData.answer[i] + '</p>');
                      }

                      const correctAnswer = $('<p>').text('Correct Answer')
                        correctAnswer.css('font-weight','bold')
                      tdata2.append(correctAnswer);
                      const answer = JSON.parse(item.key_words)
                      console.log(answer)
                      $.each(answer, function(index, item) {
                        tdata2.append('<p><span style="font-weight: bold;">'+index+' '+item+'</p>');        
                      })
                    }else if(item.type == 'Multiple Choice (Multiple)-L' || item.type == 'Highlight Correct Summary' || item.type == 'Select Missing Word'){
                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.prepend(name,audioDiv)
                      const jsonData = JSON.parse(item.solution);
                      for(var i = 0; i < jsonData.answer.length; i++){
                        tdata2.append('<p><span style="font-weight: bold;">Option'+(i+1)+':</span> ' + jsonData.answer[i] + '</p>');
                      }

                      const correctAnswer = $('<p>').text('Correct Answer')
                        correctAnswer.css('font-weight','bold')
                      tdata2.append(correctAnswer);
                      const answer = JSON.parse(item.key_words)
                      console.log(answer)
                      $.each(answer, function(index, item) {
                        tdata2.append('<p><span style="font-weight: bold;">Option'+item+'</p>');        
                      })
                    }else if(item.type == 'Listening: Fill in the Blanks'){
                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      const jsonData = JSON.parse(item.solution);
                      const Question = $('<div>').append('<p style="text-align: justify;">'+jsonData.Question+'</p>');

                      tdata2.prepend(name, audioDiv, Question)

                      const correctAnswer = $('<p>').text('Correct Answer')
                        correctAnswer.css('font-weight','bold')
                      tdata2.append(correctAnswer);
                      const answer = JSON.parse(item.key_words)
                      console.log(answer)
                      $.each(answer, function(index, item) {
                        tdata2.append('<p><span style="font-weight: bold;">'+index+' '+item+'</p>');        
                      })
                    }else if(item.type == 'Multiple Choice (Single)-L'){
                      const name = $('<p>').text(item.type)
                        name.css('font-weight','bold')
                      tdata2.prepend(name,audioDiv)
                      const jsonData = JSON.parse(item.solution);
                      for(var i = 0; i < jsonData.answer.length; i++){
                        tdata2.append('<p><span style="font-weight: bold;">Option'+(i+1)+':</span> ' + jsonData.answer[i] + '</p>');
                      }

                      const correctAnswer = $('<p>').text('Correct Answer')
                        correctAnswer.css('font-weight','bold')
                      tdata2.append(correctAnswer);
                      const answer = JSON.parse(item.key_words)
                      console.log(answer)
                      $.each(answer, function(index, item) {
                        tdata2.append('<p><span style="font-weight: bold;">Option'+item+'</p>');        
                      })
                    }
                    
                    
                    tdata2.css('width', '35%') 

                  //Third Column
                  const tdata3 = $('<td>')
                    if(item.type == 'Summarize Written Text' || item.type == 'Summarize Spoken Text' || item.type == 'Write Essay'){
                      const userAnswer = $('<p>')
                      userAnswer.addClass('text-justify');
                      userAnswer.text(item.userAnswer)
                      tdata3.append(userAnswer)
                    }else if(item.type == 'Reading & Writing：Fill in the blanks'){
                      const jsonData = JSON.parse(item.userAnswer);
                      for(var i = 0; i < jsonData.length; i++){
                        tdata3.append('<p><span style="font-weight: bold;">Blank'+(i+1)+':</span> ' + jsonData[i] + '</p>');
                      }
                    }else if(item.type == 'Re-order Paragraphs'){
                      const sol_option = JSON.parse(item.solution);
                      const answer_order = JSON.parse(item.userAnswer)
                      $.each(answer_order, function(index, value) {
                        var sol_Index = value - 1;
                        if (sol_Index >= 0 && sol_Index < sol_option.length) {
                            tdata3.append('<p><span style="font-weight: bold;">Option'+(sol_Index+1)+':</span> ' + sol_option[sol_Index] + '</p>');
                        }
                      })        
                    }else if(item.type == 'Multiple Choice (Multiple)-R' || item.type == 'Multiple Choice (Multiple)-L'){
                      const sol_option = JSON.parse(item.solution);
                      const answer_order = JSON.parse(item.userAnswer)
                      $.each(answer_order, function(index, value) {
                        var sol_Index = value - 1;
                        tdata3.append('<p><span style="font-weight: bold;">Option'+(sol_Index+1)+':</span> ' + sol_option.answer[value - 1] + '</p>');
                      });       
                    }else if(item.type == 'Multiple Choice (Single)-R' || item.type == 'Multiple Choice (Single)-L' || item.type == 'Highlight Correct Summary' || item.type == 'Select Missing Word'){
                      const sol_option = JSON.parse(item.solution);
                      const answer_order = JSON.parse(item.userAnswer)
                      tdata3.append('<p><span style="font-weight: bold;">Option'+(answer_order)+':</span> ' + sol_option.answer[answer_order - 1] + '</p>');        
                    }else if(item.type == 'Reading：Fill in the Blanks' || item.type == 'Listening: Fill in the Blanks'){
                      const answer = JSON.parse(item.userAnswer)
                      $.each(answer, function(index, item) {
                        tdata3.append('<p><span style="font-weight: bold;">Option'+(item.id)+':</span> ' + item.value + '</p>');        
                      })
                    }else if(item.type == 'Write From Dictation'){
                      //const missed_words = JSON.parse(item.missed_words)
                      //const additional_words = JSON.parse(item.additional_words)
                      //console.log(item.missed_words)
                      console.log(item.additional_words)
                      text = item.solution
                      item.missed_words.split(', ').map(function(word) {
                        var regex = new RegExp("\\b" + word + "\\b", "g");
                        text = text.replace(regex, "<span style='color:red'>" + word + "</span>");
                      });

                      tdata3.html(text);
                      tdata3.append(`<p id="error_colors" class="mt-4" style="color: black; text-align: left;"><span class="dot" style="background-color: red;"></span><span class="me-2"> Missed Words </span></p>`)

                      
                      //tdata3.append(additional_words_paragraph)
                    }else if(item.type == 'Highlight Incorrect Words'){
                      const sol_option = JSON.parse(item.userAnswer);
                      const key_words = JSON.parse(item.key_words);

                      var indexesCommon = sol_option.filter(index => key_words.includes(index)); // Indexes common to both arrays

                      var highlightedText = "";
                      var words = item.solution.split(" ");

                      for (var i = 0; i < words.length; i++) {
                        var word = words[i];
                        if (indexesCommon.includes(i)) {
                            highlightedText += "<span class='highlight-green'>" + word + "</span>";
                        }
                        else if (sol_option.includes(i)) {
                            highlightedText += "<span class='highlight-red'>" + word + "</span>";
                        }
                        else if (key_words.includes(i)) {
                            highlightedText += "<span class='highlight-yellow'>" + word + "</span>";
                        } else {
                            highlightedText += word;
                        }
                        if (i < words.length - 1) {
                            highlightedText += " ";
                        }
                      }
                      tdata3.html(highlightedText);
                      tdata3.append(`<p id="error_colors" class="mt-4" style="color: black; text-align: left;"><span class="dot" style="background-color: green;"></span><span class="me-2"> Correctly Selected </span><span class="dot" style="background-color: rgb(255, 162, 0);"></span><span class="me-2"> Correct Answers </span><span class="dot" style="background-color: red;"></span><span class="me-2"> Wrong </span></p>`)
                     
                    }else{
                      tdata3.addClass('text-center')
                      const audio = $('<audio>')
                      audio.attr('controls','')
                      const source = $('<source>')
                        source.attr('src', item.mp4File)
                        source.attr('type', 'audio/mpeg')
                        source.css('width', '200px')
                      audio.append(source)
                      tdata3.append(audio)
                    } 
                    
                    
                    
                    tdata3.css('width', '30%')  
                  
                  //Fourth Column
                  const tdata4 = $('<td>')
                    tdata4.addClass('text-center p-5')

                      const div1 = $('<div>')
                        div1.addClass('mb-4')
                        div1.attr('id', 'content')
                        const titlebox1 = $('<div>').text('Content')
                          titlebox1.addClass('titlebox')
                          const score1 = $('<p>').text(item.content)
                            score1.addClass('h6 text-center')
                      div1.append(titlebox1, score1)

                      const score = $('<div>')
                        score.addClass('mb-4')
                        score.attr('id', 'content')
                        const titlebox_score = $('<div>').text('Score')
                          titlebox_score.addClass('titlebox')
                          const score_content = $('<p>').text(item.content)
                            score_content.addClass('h6 text-center')
                      score.append(titlebox_score, score_content)


                      const div2 = $('<div>')
                        div2.attr('id', 'content')
                        div2.addClass('mb-4')
                        const titlebox2 = $('<div>').text('Pronunciation')
                          titlebox2.addClass('titlebox')
                          const score2 = $('<p>').text(item.pronunciation)
                            score2.addClass('h6 text-center')
                      div2.append(titlebox2, score2)

                      const div3 = $('<div>')
                        div3.attr('id', 'content')
                        const titlebox3 = $('<div>').text('Oral_fluency')
                          titlebox3.addClass('titlebox')
                          const score3 = $('<p>').text(item.oral_fluency)
                            score3.addClass('h6 text-center')
                      div3.append(titlebox3, score3)

                      const grammar = $('<div>')
                        grammar.attr('id', 'content')
                        grammar.addClass('mb-4')
                        const grammartitlebox = $('<div>').text('Grammar')
                          grammartitlebox.addClass('titlebox')
                          const grammarscore = $('<p>').text(item.grammar)
                            grammarscore.addClass('h6 text-center')
                        grammar.append(grammartitlebox, grammarscore)

                        const form = $('<div>')
                        form.attr('id', 'content')
                        form.addClass('mb-4')
                        const formtitlebox = $('<div>').text('Form')
                          formtitlebox.addClass('titlebox')
                          const formscore = $('<p>').text(item.form)
                            formscore.addClass('h6 text-center')
                        form.append(formtitlebox, formscore)

                      const vocabulary = $('<div>')
                        vocabulary.attr('id', 'content')
                        vocabulary.addClass('mb-4')
                        const vocabularytitlebox = $('<div>').text('Vocabulary')
                          vocabularytitlebox.addClass('titlebox')
                          const vocabularyscore = $('<p>').text(item.vocabulary)
                            vocabularyscore.addClass('h6 text-center')
                        vocabulary.append(vocabularytitlebox, vocabularyscore)
                      
                      const spelling = $('<div>')
                        spelling.attr('id', 'content')
                        spelling.addClass('mb-4')
                        const spellingtitlebox = $('<div>').text('Spelling')
                          spellingtitlebox.addClass('titlebox')
                          const spellingscore = $('<p>').text(item.spelling)
                            spellingscore.addClass('h6 text-center')
                            spelling.append(spellingtitlebox, spellingscore)  

                      const dsc = $('<div>')
                        dsc.attr('id', 'content')
                        dsc.addClass('mb-4')
                        const dsctitlebox = $('<div>').text('Dev_Str_Cohe')
                          dsctitlebox.addClass('titlebox')
                          const dscscore = $('<p>').text(item.dsc)
                            dscscore.addClass('h6 text-center')
                            dsc.append(dsctitlebox, dscscore)
                        
                      const glr = $('<div>')
                        glr.attr('id', 'content')
                        glr.addClass('mb-4')
                        const glrtitlebox = $('<div>').text('General_linguistic_range')
                          glrtitlebox.addClass('titlebox')
                          const glrscore = $('<p>').text(item.glr)
                            glrscore.addClass('h6 text-center')
                        glr.append(glrtitlebox, glrscore)

                    if(item.type == 'Answer Short Question'){
                      tdata4.append(div1)
                    }else if(item.type == 'Read Aloud' || item.type == 'Repeat Sentence' || item.type == 'Describe Image' || item.type == 'Re-tell Lecture'){
                      tdata4.append(div1, div2, div3)
                    }else if(item.type == 'Summarize Written Text'  || item.type == 'Summarize Spoken Text'){
                      tdata4.append(div1, form, grammar, vocabulary)
                    }else if(item.type == 'Write Essay'){
                      tdata4.append(div1, form, dsc, grammar, glr, vocabulary, spelling)
                    }else if(item.type == 'Reading & Writing：Fill in the blanks' || item.type == 'Re-order Paragraphs' || item.type == 'Multiple Choice (Multiple)-R' || item.type == 'Multiple Choice (Single)-R' || item.type == 'Reading：Fill in the Blanks' || item.type == 'Summarize Spoken Text' || item.type == 'Multiple Choice (Multiple)-L' || item.type == 'Listening: Fill in the Blanks' || item.type == 'Multiple Choice (Single)-L' || item.type == 'Highlight Correct Summary' || item.type == 'Select Missing Word' || item.type == 'Highlight Incorrect Words'){
                      tdata4.append(score)
                    }    
                    
                  
                  //Seventh Column
                  const tdata7 = $('<td>')
                    tdata7.addClass('<text-center>')
                      const p71 = $('<p>')
                      p71.addClass('text-center')
                      p71.text(item.totalScore)
                      const div = $('<div>');
                        div.addClass('text-center')
                      const divScoreInfo = $('<div>');
                      divScoreInfo.attr({
                        id: 'score',
                        class: 'score_info btn btn-outline-secondary fw-bold rounded',
                        style: 'font-size: 10px; width: 80px;',
                        'data-content': item.content,
                        'data-pronounciation': item.pronunciation,
                        'data-oral_fluency': item.oral_fluency,
                        'data-grammar': item.grammar,
                        'data-form': item.form,
                        'data-vocabulary': item.vocabulary,
                        'data-spelling': item.spelling,
                        'data-dsc': item.dsc,
                        'data-glr': item.glr,
                        'data-additional': item.additional_words,
                        'data-missed': item.missed_words,
                        'data-audio': item.audio,
                        'data-solution': item.solution,
                        'data-user_answer': item.userAnswer,
                        'data-answer_id': item.answer_id,
                        'data-type': item.type,
                        'data-pronun_json': item.json_data
                      });  // adding to db data from answering table
                      divScoreInfo.text('Score Info');
                      div.append(divScoreInfo)
                      if(item.type == 'Reading & Writing：Fill in the blanks' || item.type == 'Re-order Paragraphs' || item.type == 'Multiple Choice (Multiple)-R' || item.type == 'Multiple Choice (Single)-R' || item.type == 'Reading：Fill in the Blanks' || item.type == 'Multiple Choice (Multiple)-L' || item.type == 'Listening: Fill in the Blanks' || item.type == 'Multiple Choice (Single)-L' || item.type == 'Highlight Correct Summary' || item.type == 'Select Missing Word' || item.type == 'Highlight Incorrect Words' || item.type == 'Write From Dictation'){
                        tdata7.append(p71);
                      }else{
                        tdata7.append(p71,div);
                      }

                row.append(tdata1, tdata2, tdata3, tdata4, tdata7);
                tableBody.append(row);
                $i++;
              })

              // Sentence creating function
              function createSentence(data) {
                  var sentence = "";
                    for (var i = 0; i < data.length; i++) {
                      sentence += data[i].label + " ";
                      }
                            
                    sentence = sentence.trim();
                            
                    sentence = sentence.charAt(0).toUpperCase() + sentence.slice(1);
                            
                    sentence += ".";
                    return sentence;
              }

              /**##############################################################################
               *                               Score Info Popup
               * ##############################################################################**/

              $('.score_info').click(function (e) {
                console.log('worked')
                $('#tab9').show();
                $('.b1').css('display','block')
                $('#overlay-content-popup').toggle();
                $('#cb').toggle()

                var content = $(this).data('content');
                var pronounciation = $(this).data('pronounciation');
                var oral_fluency = $(this).data('oral_fluency');
                var grammar = $(this).data('grammar');
                var form = $(this).data('form');
                var vocabulary = $(this).data('vocabulary')
                var spelling = $(this).data('spelling')
                var dsc = $(this).data('dsc')
                var glr = $(this).data('glr')
                var additional = $(this).data('additional');
                var missed = $(this).data('missed');
                var audio = $(this).data('audio');
                var solution = $(this).data('solution')
                var user_answer = $(this).data('user_answer')
                var audioDiv = $('#user-answer-recording')
                var pronun_json = $(this).data('pronun_json')
                var type = $(this).data('type')
                var answer_id = $(this).data('answer_id')

                //popup content display feature


                
                if(type == 'Read Aloud' || type == 'Repeat Sentence' || type == 'Re-tell Lecture' || type == 'Describe Image'){

                  //restore feature
                  $('#score-progress-section').removeClass('col-12').addClass('col-5');
                  $('#answer-section').removeClass('col-12').addClass('col-7');
                  $('#score-cart-2').css('display','block');
                  $('#score-cart-1').removeClass('col-12').addClass('col-4');
                  $('#score-cart-3').css('display','block');
                  $('.additional').show()
                  $('.missed').show()
                  $('#tl-section-1').show()
                  $('#total').show()

                  totalScore = (content + pronounciation)/2
                  precentage = (totalScore / 5) * 100

                  var pronounciation_precentage = (pronounciation / 5) * 100

                  //************** Progress Bars Evaluation Precentage **********************
                    $('#total_score').text(precentage)
                    $('#total-progress').css('width', precentage+'%' )

                    $('#pronoun-progress').css('width', pronounciation_precentage + '%')
                    $('#pronoun-precentage').text(pronounciation_precentage + '%')

                    $('#fluent-progress').css('width', oral_fluency + '%')
                    $('#fluent-precentage').text(oral_fluency + '%')
                  
                  //************** Score Count  **********************************************  

                    $('#score-name-1').text('Content');
                    $('#score-marks-add-1').text(content+'/5');

                    $('#score-name-2').text('Pronun');
                    $('#score-marks-add-2').text(pronounciation+'/5');
                      
                    $('#score-name-3').text('Fluency');
                    $('#score-marks-add-3').text(oral_fluency+'/5');
                    
                    $('#score-cart-4').css('display','none')
                    $('#score-cart-5').css('display','none');
                    $('#score-cart-6').css('display','none');
                    $('#score-cart-7').css('display','none');

                  var finalSentence = createSentence(pronun_json);
                  if(type == 'Re-tell Lecture'){
                    var pronun_paragraph = $('#pronun').text(finalSentence)
                  }else{
                    var pronun_paragraph = $('#pronun').text(user_answer)
                  }

                  //Pronunciation Evaluation
                  $.each(pronun_json, function(index, word) {
                        
                    var regex = new RegExp('\\b' + word['label'] + '\\b', 'gi'); // Use word boundaries and case-insensitive matching
                    if(word['score'] >= 80){
                      pronun_paragraph.html(pronun_paragraph.html().replace(regex, '<span class="highlight" style="color: green;">' + word['label'] + '</span>'))    
                    }else if(word['score'] >= 40){
                      pronun_paragraph.html(pronun_paragraph.html().replace(regex, '<span class="highlight" style="color: rgb(255, 162, 0);">' + word['label'] + '</span>'))    
                    }else if(word['score'] >= 0){
                      pronun_paragraph.html(pronun_paragraph.html().replace(regex, '<span class="highlight" style="color: red;">' + word['label'] + '</span>'))    
                    }

                  });

                  //Check the Additional words and Missed Words
                  if(type == 'Read Aloud' || type == 'Repeat Sentence'){

                    $('#content-swt-score').addClass('white-text');
                    $('#content-swt').addClass('blue-background');


                    var additional_words_paragraph = $('#additional').text(user_answer)
                    var additional = additional.split(/[ ,.:]+/).filter(Boolean)
                    $.each(additional, function(index, word) {
                      var regex = new RegExp('\\b' + word+ '\\b', 'gi'); // Use word boundaries and case-insensitive matching
                      additional_words_paragraph.html(additional_words_paragraph.html().replace(regex, '<span class="highlight" style="color: red;">' + word + '</span>'))    
                    });

                    var missed_words_paragraph = $('#missed').text(solution)
                    var missed = missed.split(/[ ,.:]+/).filter(Boolean)
                    $.each(missed, function(index, word) {
                      var regex = new RegExp('\\b' + word+ '\\b', 'gi'); // Use word boundaries and case-insensitive matching
                      missed_words_paragraph.html(missed_words_paragraph.html().replace(regex, '<span class="highlight" style="color: red;">' + word + '</span>'))    
                    });

                    $('#header-title').text('Content')

                  }else if(type == 'Re-tell Lecture' || type == 'Describe Image'){
                    $('.additional').hide()
                    $('.missed').hide()
                    $('#header-title').text('Speech Recognition')
                    $('#content-type-error').css('display','none')
                  }
                }else if(type == 'Answer Short Question'){
                    $('#tl-section-1').hide()
                    $('#total').hide()
                    
                    $('#score-progress-section').addClass('col-12')
                    $('#score-cart-1').removeClass('col-4').addClass('col-12');
                    $('#score-cart-2').css('display','none');
                    $('#score-cart-3').css('display','none');
                    $('#score-cart-4').css('display','none');
                    $('#score-cart-5').css('display','none');
                    $('#score-cart-6').css('display','none');

                    $('#score-name-1').text('Content');
                    $('#score-marks-add-1').text(content+'/1');

                    $('#score-I').addClass('blue-background')
                    $('#score-marks-1').addClass('white-text');

                    $('.pronun').text('AI Speech Recognition')
                    $('#pronun').text(user_answer)
                                

                    $('.pronun').css('width','140px')
                    $('.additional').hide()
                    $('.missed').hide()
                    $('#error_colors').css('display','none')
                    $('#answer-evaluation-2').hide()  
                    
                    $('#total_score').css('display', 'none')
                    $('#total-progress').hide
                                
                  }else if(type == 'Summarize Written Text'|| type == 'Summarize Spoken Text'){

                    $('#tl-section-1').hide()
                    //$('.togel-section2').css('display','block')
                    $('#score-progress-section').addClass('col-12')
                    $('#answer-section').addClass('col-12')

                    $('#togel-section2').hide()
                    $('#score-I').addClass('blue-background')
                    $('#score-marks-1').addClass('white-text');
                    $('#answer-evaluation-1').css('display', 'none')

                    //totalScore = (content + grammar + form + vocabulary)/7
                    //precentage = Math.round(totalScore * 100)
                    //$('#total_score').text(precentage)
                    $('#total').css('display', 'none' )
                                
                    //change the responsiness for the score-cart
                    $('#score-cart-1').removeClass('col-4').addClass('col-3');
                    $('#score-cart-2').removeClass('col-4').addClass('col-3');
                    $('#score-cart-3').removeClass('col-4').addClass('col-3');
                    $('#score-cart-4').removeClass('col-4').addClass('col-3');
                    $('#score-cart-5').css('display', 'none')
                    $('#score-cart-6').css('display', 'none')
                    $('#score-cart-7').css('display', 'none')

                    //adding to the score name and scores
                    $('#score-name-1').text('Content');
                    $('#score-marks-add-1').text(content+'/2');
                    $('#score-name-2').text('Form');
                    $('#score-marks-add-2').text(form+'/1');
                    $('#score-name-3').text('Grammar');
                    $('#score-marks-add-3').text(grammar+'/2');
                    $('#score-name-4').text('Vocabulary')
                    $('#score-marks-add-4').text(vocabulary+'/2');


                    $('#score-section-asq').css('display','none')
                    $('#score-section-swt').css('display','none')
                    $('#total').removeAttr('id', 'total')

                    var paragraph = $('#user-answer').text(user_answer)
                    grammar_result(answer_id)
                      .then(function(data) {
                        data.forEach(function(item) {
                          let startIndex = parseInt(item.start_index);
                          let endIndex = parseInt(item.end_index);
                          let coveredText = item.covered_text.replace(/"/g, '');
                          let comment = item.comment.replace(/"/g, '');

                          var regex = new RegExp('\\b' + coveredText + '\\b', 'gi'); // Use word boundaries and case-insensitive 						matching
                          paragraph.html(paragraph.html().replace(regex, '<span class="highlight-word" style="color: #b80707; cursor:pointer;" data-comment="' + comment + '">' + coveredText + '</span>'));
                        });
                      })
                      .catch(function(error) {
                        console.error('Error fetching data:', error);
                      });

                    $(document).on("click", ".highlight-word", function(e) {
                      var comment = $(this).data('comment');
                      $(".bold").removeClass("bold");
                      $(this).addClass('bold')
                      $(this).prev().removeClass("bold");
                      console.log(e)
                      var popup = $('#comment-popup');
                      popup.text(comment);
                      //popup.css({ top: e.pageY + 10, left: e.pageX, display: block });
                      popup.show();
                      $(document).one('click', function() {
                        popup.hide();
                        $(".bold").removeClass("bold");
                      });
                      e.stopPropagation();
                      });

                      $('#comment-popup').click(function(e) {
                        e.stopPropagation();
                        $(this).removeClass('bold-text')
                      });
                  }else if(type == 'Write Essay'){
                    $('#tl-section-1').hide()
                    //$('.togel-section2').css('display','block')
                    $('#score-progress-section').addClass('col-12')
                    $('#answer-section').addClass('col-12')

                    $('#togel-section2').hide()
                    $('#score-I').addClass('blue-background')
                    $('#score-marks-1').addClass('white-text');
                    $('#answer-evaluation-1').css('display', 'none')

                    //totalScore = (content + grammar + form + vocabulary)/7
                    //precentage = Math.round(totalScore * 100)
                    //$('#total_score').text(precentage)
                    $('#total').css('display', 'none' )

                    // css display change
                    $('#score-cart-1').css('display','block');
                    $('#score-cart-2').css('display','block');
                    $('#score-cart-3').css('display','block');
                    $('#score-cart-4').css('display','block');
                    $('#score-cart-5').css('display','block');
                    $('#score-cart-6').css('display','block');
                    $('#score-cart-7').css('display','block');
                                
                    //change the responsiness for the score-cart
                    $('#score-cart-1').removeClass('col-4').removeClass('col-3').addClass('col-2');
                    $('#score-cart-2').removeClass('col-4').removeClass('col-3').addClass('col-2');
                    $('#score-cart-3').removeClass('col-4').removeClass('col-3').addClass('col-1');
                    $('#score-cart-4').removeClass('col-4').removeClass('col-3').addClass('col-2');
                    $('#score-cart-5').removeClass('col-4').addClass('col-1');
                    $('#score-cart-6').removeClass('col-4').addClass('col-2');
                    $('#score-cart-7').removeClass('col-4').addClass('col-2');

                    //adding to the score name and scores
                    $('#score-name-1').text('Content');
                    $('#score-marks-add-1').text(content+'/2');
                    $('#score-name-2').text('Form');
                    $('#score-marks-add-2').text(form+'/2');
                    $('#score-name-3').text('DSC');
                    $('#score-marks-add-3').text(dsc+'/2');
                    $('#score-name-4').text('Grammar')
                    $('#score-marks-add-4').text(grammar+'/2');
                    $('#score-name-5').text('GLR')
                    $('#score-marks-add-5').text(glr+'/2');
                    $('#score-name-6').text('Vocabulary')
                    $('#score-marks-add-6').text(vocabulary+'/2');
                    $('#score-name-7').text('Spelling')
                    $('#score-marks-add-7').text(spelling+'/2');


                    $('#score-section-asq').css('display','none')
                    $('#score-section-swt').css('display','none')
                    $('#total').removeAttr('id', 'total')

                    var paragraph = $('#user-answer').text(user_answer)
                    grammar_result(answer_id)
                      .then(function(data) {
                        data.forEach(function(item) {
                          let startIndex = parseInt(item.start_index);
                          let endIndex = parseInt(item.end_index);
                          let coveredText = item.covered_text.replace(/"/g, '');
                          let comment = item.comment.replace(/"/g, '');

                          var regex = new RegExp('\\b' + coveredText + '\\b', 'gi'); // Use word boundaries and case-insensitive 						matching
                          paragraph.html(paragraph.html().replace(regex, '<span class="highlight-word" style="color: #b80707; cursor: 						pointer;" data-comment="' + comment + '">' + coveredText + '</span>'));
                        });
                      })
                      .catch(function(error) {
                        console.error('Error fetching data:', error);
                      });

                    $(document).on("click", ".highlight-word", function(e) {
                      var comment = $(this).data('comment');
                      $(".bold").removeClass("bold");
                      $(this).addClass('bold')
                      $(this).prev().removeClass("bold");
                      console.log(e)
                      var popup = $('#comment-popup');
                      popup.text(comment);
                      //popup.css({ top: e.pageY + 10, left: e.pageX, display: block });
                      popup.show();
                      $(document).one('click', function() {
                        popup.hide();
                        $(".bold").removeClass("bold");
                      });
                      e.stopPropagation();
                      });

                      $('#comment-popup').click(function(e) {
                        e.stopPropagation();
                        $(this).removeClass('bold-text')
                      });
                  }
              })
            }
          })
    }

    loadData()

    //******** Score Info Popup Closing Feature ********** 
    $(document).on("click", function(event){
      if(!$(event.target).closest('#score').length && !$(event.target).closest('#cb').length && !$(event.target).closest('.b2').length) {
        $('.b1').css('display','none')
        $('#overlay-content-popup').hide();
        $('#cb').hide();
        $('.tab-content-a1').hide();
        $('.togel-section2, .togel-section3').hide()
        $('#score-IV, #score-III, #score-II, #score-I').removeClass('blue-background');
        $('#score-marks-4, #score-marks-3, #score-marks-2, #score-marks-1').removeClass('white-text');                               
                                
        if(typeValue == 6 || typeValue == 5){
          $('.togel-section1').hide()
          $('.togel-section2').show()
          $('#suggestion-content').hide()
        }else{
          $('.togel-section1').show()
          $('.togel-section2').hide()
        }
      }
    });

    
    //******** Additional, Missed And Pronunciatio Tabs feature **********      
    $('.tab-a1').click(function() {
      $('.tab-content-a1').hide();
      var tabId = $(this).data('tab');
      $('#' + tabId).show();
    });

    function grammar_result(grammar_result){
      return new Promise(function(resolve, reject) {
        $.ajax({
          url: 'src/controllers/getController.php?data_type=grammar_result&answer_id=' + grammar_result,
          method: 'GET',
          success: function(data) {
            resolve(data); // Resolve the promise with the fetched data
          },
          error: function(xhr, status, error) {
            reject(error); // Reject the promise if there's an error
          }
        });
      });    
    }

    

  })

     
</script>



</html>