$(document).ready(function(){

    $(document).on('submit', '.js-form', function(e){
        e.preventDefault();

        $.ajax('/site/search/', {
            method: 'post',
            format: 'json',
            data: $(this).serialize(),
            success: function(data){

                if(data.status == 'ok')
                {
                    $('#rooms').html(data.roomsHtml);
                    $('#bookingList').html(data.bookingListHtml);
                }

                if(data.status == 'error')
                {
                    $('#rooms').html(data.message)
                }
            }
        });

    });

    $(document).on('submit', '.js-booking', function(e){
        e.preventDefault();

        $.ajax('/site/booking/', {
            method: 'post',
            format: 'json',
            data: $(this).serialize(),
            success: function(data){

                if(data.status == 'ok')
                {
                    $('#booking').html(data.summaryHtml);
                    $('#bookingList').html(data.bookingListHtml);
                }
                else
                {
                    $.each(data.errors, function (index, value) {
                        $('#booking-' + index).siblings('.invalid-feedback').text(value).show();
                    });
                }
            }
        });

    });

});