/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function (e) {
    $(".img-thumbnail").on("click", showPopUp);
    //without the stopPropagation, this will be fired when clicking the thumbnail
    $(document).on("click", function () {
        $(".img-popup").remove();
    });
    activateMenu();
    submitCartItem();
    removeCartItem();
    checkEmptyCart();

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
    console.log("Hi");
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

//make sure test product template has the correct access to js 
function submitCartItem() {
    $("#add-to-cart").submit(function (e) {
        var formData = {
            product_id: $("#product_id").val(),
            quantity: $("#quantity").val(),
        };
        $.ajax({
            type: "POST",
            url: "test_product_template.php", //?id=" + $('#product_id').val(),
            data: formData,
            error: function ()
            {
                alert("Request Failed");
            },
            success: function (response)
            {
//                $("#dialog").dialog();
//                console.log("This is being fired");
                var overlay = jQuery("<div class='alert alert-success' id='success-alert'><button type='button' class='close' data-dismiss='alert'>x</button><strong>Success! </strong> Product have added to your wishlist.</div>");

                overlay.appendTo(document.body)
                $("#success-alert").delay(4000).slideUp(200, function () {
                    $("#success-alert").alert('close');
                });
            }
        });
        return false;
    })
}
function checkEmptyCart() {
    $("#checkout").submit(function (e) {
        var formData = {
            total_item: $("#total_item").val(),
            //placeorder: $("#placeorder").name,
        };
        $.ajax({
            type: "POST",
            url: "add_to_cart.php", //?id=" + $('#product_id').val(),
            data: formData,
            error: function ()
            {
                alert("Request Failed");
            },
            success: function (response)
            {
                console.log("Somethinghere");
                console.log(formData.total_item);
                if (formData.total_item == 0) {
                    console.log("zero Item");
                    var overlay = jQuery("<div class='alert alert-danger' id='success-alert'><button type='button' class='close' data-dismiss='alert'>x</button><strong>Unable to checkout! </strong> There is no item in your cart!</div>");
                    overlay.appendTo(document.body);
                    $("#success-alert").delay(4000).slideUp(200, function () {
                        $("#success-alert").alert('close');
                    });
                } else {
                    $.ajax({
                        type: "GET",
                        url: "add_to_cart.php?placeorder=1", //?id=" + $('#product_id').val(),
                        error: function ()
                        {
                            alert("Request Failed");
                        },
                        success: function (response)
                        {
                            console.log("succesful checckout")
                            window.location.href = 'place_order.php';                       
                        }
                    });
                    
//                    console.log("more than zero Item");
                }
            }
        });
        return false;
    })
}

function removeCartItem() {
    $("#cart_page").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "add_to_cart.php?removeAll=1",
//            data: formData,
            error: function ()
            {
                alert("Request Failed");
            },
            success: function (response)
            {
                $('#cart_table').empty();
                $('#cart_table').load(location.href + ' #cart_table>*', "");
            }
        });
        return false;
    })
}


