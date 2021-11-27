/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//$(document).ready(function (e) {
//$(".img-thumbnail").on("click", showPopUp);
$(document).ready(function () {
    $(".img-thumbnail").on("click", goToProductDesc);
    $(".img-thumbnail").on("click", showPopUp);
    //without the stopPropagation, this will be fired when clicking the thumbnail
    $(document).on("click", function () {
        $(".img-popup").remove();
    });
    activateMenu();
    submitCartItem();
    removeAllItem();
    checkEmptyCart();
    increment();
    decrement();
    goCheckout();
});

function showPopUp(e) {
    //window.open("product_page_1.php");
    //console.log($(e.currentTarget).parent().children().length)
    //cannot directly use e.target/e.currentTarget because this function is not 
    //added to listener using the classic way
    //since we are using jquery, there need a jquery way to access e.target
    //which is $(e.target) / $(e.currentTarget) to access.
    /*if ($(this).parent().children().length > 2) {
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
     e.stopPropagation();*/
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

function submitCartItem() {
    $("#add-to-cart").submit(function (e) {
        var formData = {
            product_id: $("#product_id").val(),
            quantity: $("#quantity").val(),
        };
        $.ajax({
            type: "POST",
            url: "product_page.php",
            data: formData,
            error: function ()
            {
                alert("Request 2 Failed");
            },
            success: function (response)
            {
                var overlay = jQuery("<div class='alert alert-success success-alert' id='success-alert'><button type='button' class='close' data-dismiss='alert'>x</button><strong>Success! </strong><p>Product have added to your wishlist.</p></div>");
                overlay.appendTo(document.body)
                $(".success-alert").delay(4000).slideUp(200, function () {
                    $(".success-alert").alert('close');
                });
            }
        });
        return false;
    })
}
function checkEmptyCart() {
    $("#checkout").submit(function (e) {
        e.preventDefault();
        var formData = {
            total_item: $("#total_item").val(),
        };
        console.log(formData.total_item);
        $.ajax({
            type: "POST",
            url: "checkout_confirmation.php",
            data: formData,
            error: function ()
            {
                alert("Request Failed");
            },
            success: function (response)
            {
                if (formData.total_item == 0) {
                    var overlay = jQuery("<div class='alert alert-danger failed-alert' id='failed-alert'><button type='button' class='close' data-dismiss='alert'>x</button><strong>Unable to checkout! </strong><p>There is no item in your cart!</p></div>");
                    overlay.appendTo(document.body);
                    $(".failed-alert").delay(4000).slideUp(200, function () {
                        $(".failed-alert").alert('close');
                    });
                } else {
                    $.ajax({
                        type: "GET",
                        url: "cart.php?placeorder=1",
                        error: function ()
                        {
                            alert("Request Failed");
                        },
                        success: function (response)
                        {
//                            console.log("succesful checckout")
                            window.location.href = 'place_order.php';
                        }
                    });
                }
                return false;
            }
        });
        return false;
    })
}

function goCheckout() {
    $("#placeorder").submit(function (e) {
        e.preventDefault(); 
        $.post("checkout_confirmation.php", {
                total_item: $("#total_item").val(),
                total_price: $("#total_price").val(),
            }, function () {
//                console.log("try");
                window.location.href = "checkout_confirmation.php";
            });
        return false;
    })
}

function removeAllItem() {
    $("#remove_all").click(function () {
        $set = 1;
        $.post("cart.php", {
            removeAll: $set
        }, function () {

            location.reload();
        });
        return false;
    });
}

function increment() {
    $set = 1;
    $(".increment").on('click', function (e) {
        $selector = "quantity-" + $(e.target).siblings(".quantity").attr("id");
        $original = $(e.target).siblings(".quantity").val();
        $quantity = $(e.target).siblings(".quantity").val();
        $max = $(e.target).siblings(".quantity").attr("max");
        if ($quantity < $max) {
            $quantity++;
            $new = $quantity;
            $(e.target).siblings(".quantity").val($quantity);
            $.post("cart.php", {
                update: $set,
                [$selector]: $new,
            }, function () {
                location.reload();
            });
        } else {
            var overlay = jQuery("<div class='alert alert-danger success-alert' id='success-alert'><button type='button' class='close' data-dismiss='alert'>x</button><strong>Warning! </strong><p>You have reached to maximum quanity.</p></div>");
            overlay.appendTo(document.body)
            $(".success-alert").delay(4000).slideUp(200, function () {
                $(".success-alert").alert('close');
            });
        }
    });
    return false;
}
function decrement() {
    $set = 1;
    $(".decrement").on('click', function (e) {
        $selector = "quantity-" + $(e.target).siblings(".quantity").attr("id");
        $original = $(e.target).siblings(".quantity").val();
        $quantity = $(e.target).siblings(".quantity").val();
        $min = $(e.target).siblings(".quantity").attr("min");
        if ($quantity > $min) {
            $quantity--;
            $new = $quantity;
            $(e.target).siblings(".quantity").val($quantity);
            $.post("cart.php", {
                update: $set,
                [$selector]: $new,
            }, function () {
                location.reload();
            });
        } else {
            var overlay = jQuery("<div class='alert alert-danger success-alert' id='success-alert'><button type='button' class='close' data-dismiss='alert'>x</button><strong>Warning! </strong><p>If you want to remove this item, click remove instead.</p></div>");
            overlay.appendTo(document.body)
            $(".success-alert").delay(4000).slideUp(200, function () {
                $(".success-alert").alert('close');
            });
        }
    });
    return false;
}

function goToProductDesc()
{
    window.open("product_page_1.php", '_blank');
}


