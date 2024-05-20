
(function($) {
    $.fn.fetchingData = function(page, questionsPerPage, test_id){
        $.ajax({
            url: `controlers/get.php?data_type=getQuestion&page=${page}&per_page=${questionsPerPage}&test_id=${test_id}&type=${null}`,
            method: 'GET',
            success: function(data){
                console.log(data);
            }
        })
    };
})(jQuery);