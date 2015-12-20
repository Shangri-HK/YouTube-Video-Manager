/**
 * Created by HARDCORE on 13/12/2015.
 */

var first = true;

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

                loadTags();
                addFavs(videoId);
            }
        });
    });

    //loadTags();

    $('.genre_link').click(function() {
        var genre = $(this).attr('data-id');
        $('div[class="tab_icon"]').hide();
        $('div[id="'+genre+'"]').show();
        $('li[id*="_slot"]').attr('class', '');
        $('li[id*="'+genre+'_slot"]').attr('class', 'active');
        $('div[class="filters"]').hide();
        $('div[data-id="'+genre+'"]').show();
    });
});

function filterByTags() {
    $('.tag-filter').click(function() {
        var tag = $(this).text();
    });
}

function loadTags() {
    $('#genre').change(function() {
        var genre = $(this).find('option:selected').text();
        var tags_recip = $('#tags');

        $.ajax({
            url: 'ajax/actionsVideo.php',
            type: 'GET',
            data: 'function=loadingTags&genre='+genre,
            success: function(html) {
                tags_recip.html('');
                tags_recip.html(html);
                setTags();
            }
        });
    });
}

function setTags() {
    $('button[id^="tag"]').click(function() {
        if ($(this).attr('class') == 'btn btn-sm btn-default active')
            $(this).attr('class', 'btn btn-sm btn-default');
        else
            $(this).attr('class', 'btn btn-sm btn-default active');
    });
}

function addFavs(videoId) {
    $('#add_favs').click(function() {

        var videoGender = $('#genre').find(":selected").text();
        videoId = videoId.val();
        var k = 0;
        var tags = [];
        $('button[id^="tag"]').each(function() {
            if ($(this).attr('class') == 'btn btn-sm btn-default active')
                tags[k++] = $(this).text();
        });

        $.ajax({
            url: 'ajax/actionsVideo.php',
            type: 'GET',
            data: 'function=addFav&videoId='+videoId+'&videoGender='+videoGender+'&tags='+tags,
            success: function(html) {
                    $('#alert-disp').html(html);

            }
        });
    });
}


