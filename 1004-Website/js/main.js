/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $(".img-thumbnail").on("click", showPopUp);
    //without the stopPropagation, this will be fired when clicking the thumbnail
    $(document).on("click", function () {
        $(".img-popup").remove();
    });
    activateMenu();
});

function showPopUp(e) {
    //console.log($(e.currentTarget).parent().children().length)
    //cannot directly use e.target/e.currentTarget because this function is not 
    //added to listener using the classic way
    //since we are using jquery, there need a jquery way to access e.target
    //which is $(e.target) / $(e.currentTarget) to access.
    if ($(this).parent().children().length > 2) {
        $(".img-popup").remove();
        return;
    }
    if ($(".img-popup").length != 0) {
        $(".img-popup").remove();
    }
    var popUpImage = $("<img>");
    var imageSrc = $(this).attr("src");
    $(popUpImage).attr({
        "alt": "popoutImage",
        "title": "PopoutImage",
        "src": imageSrc
    });
    var popUp = $("<span class='img-popup'></span>").append(popUpImage);
    $(this).parent().append(popUp);

    //prevent the event furhter bubbling.
    e.stopPropagation();
}

function activateMenu()
{
    var current_page_URL = location.href;
    $(".navbar-nav a").each(function ()
    {
        var target_URL = $(this).prop("href");
        if (target_URL === current_page_URL)
        {
            $('nav a').parents('li, ul').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        }
    });
}


