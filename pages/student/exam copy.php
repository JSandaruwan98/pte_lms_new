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
<script src="JQuery/exam/functions/audio/playing.js"></script>
<script src="JQuery/exam/functions/save.js"></script>
<script src="JQuery/exam/functions/audio/recording.js"></script>
<script src="JQuery/exam/functions/timer.js"></script>
<script src="JQuery/exam/questions.js"></script>
<script type="module">
    $(document).ready(function () {
        let questionsPerPage = 1;
        var fragment = window.location.hash;
        if (fragment.startsWith('#')) { var test_id = parseInt(fragment.substring(1)); } 
       
        var data = $.fn.fetchingData(1, questionsPerPage, test_id);
        console.log(data);
    });
</script> 
</body>
</html>