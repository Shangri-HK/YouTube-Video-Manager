/**
 * Created by HARDCORE on 13/12/2015.
 */

$(function() {
    $('.video').click(function() {
        var videoId = $(this);
        var videoId = videoId.children();
        console.log(videoId.attr('value'));

        var displayDetails = $('.video-details');

        $.ajax({
           url: 'ajax/selectVideo.php',
            type: 'GET',
            data: 'videoId='+videoId.attr('value'),
            success: function(html) {
                displayDetails.html(html);
            }, complete: function() {
                addFavs(videoId);
            }
        });
    });

    $('#dub_link').click(function() {
        $('#all').hide();
        $('#all_slot').attr('class', '');
        $('#dub').show();
        $('#dub_slot').attr('class', 'active');
        $('#techno').hide();
        $('#techno_slot').attr('class', '');
        $('#electro_h').hide();
        $('#electro_h_slot').attr('class', '');
        $('#variety').hide();
        $('#variety_slot').attr('class', '');
    });

    $('#all_link').click(function() {
        $('#all').show();
        $('#all_slot').attr('class', 'active');
        $('#dub').hide();
        $('#dub_slot').attr('class', '');
        $('#techno').hide();
        $('#techno_slot').attr('class', '');
        $('#electro_h').hide();
        $('#electro_h_slot').attr('class', '');
        $('#variety').hide();
        $('#variety_slot').attr('class', '');
    });

    $('#techno_link').click(function() {
        $('#techno').show();
        $('#techno_slot').attr('class', 'active');
        $('#all').hide();
        $('#all_slot').attr('class', '');
        $('#dub').hide();
        $('#dub_slot').attr('class', '');
        $('#electro_h').hide();
        $('#electro_h_slot').attr('class', '');
        $('#variety').hide();
        $('#variety_slot').attr('class', '');
    });

    $('#electro_h_link').click(function() {
        alert('d');
        $('#electro_h').show();
        $('#electro_h_slot').attr('class', 'active');
        $('#techno').hide();
        $('#techno_slot').attr('class', '');
        $('#all').hide();
        $('#all_slot').attr('class', '');
        $('#dub').hide();
        $('#dub_slot').attr('class', '');
        $('#variety').hide();
        $('#variety_slot').attr('class', '');
    });

    $('#variety_link').click(function() {
        $('#variety').show();
        $('#variety_slot').attr('class', 'active');
        $('#techno').hide();
        $('#techno_slot').attr('class', '');
        $('#all').hide();
        $('#all_slot').attr('class', '');
        $('#dub').hide();
        $('#dub_slot').attr('class', '');
        $('#electro_h').hide();
        $('#eletro_h_slot').attr('class', '');
    });
});

function addFavs(videoId) {
    $('#add_favs').click(function() {

        var videoGender = 'N/A';
        videoId = videoId.val();

        $.ajax({
            url: 'ajax/actionsVideo.php',
            type: 'GET',
            data: 'function=addFav&videoId='+videoId+'&videoGender='+videoGender,
            success: function(html) {
                    $('#alert-disp').html(html);
            }
        });
    });
}

