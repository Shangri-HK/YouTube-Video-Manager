/**
 * Created by HARDCORE on 13/12/2015.
 */

$(function() {
    $('.video').click(function(e) {
        var videoId = $(this);
        var videoId = videoId.children();
        console.log(videoId.attr('value'));

        var displayDetails = $('.video-details');

        $.ajax({
           url: 'ajax/selectVideo.php',
            type: 'GET',
            data: 'videoId='+videoId.attr('value'),
            success: function(html, statut) {
                displayDetails.html(html);
            }
        });
    });
});

