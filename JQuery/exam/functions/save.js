(function($){
    $.fn.saveAudio = function(formData, type){
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
                $.fn.submit(type)
            },
            error: function (error) {
                console.error('Error saving audio:', error);
            }
        });
    } 
})(jQuery);