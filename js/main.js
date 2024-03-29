/*  ---------------------------------------------------
    Template Name: Male Fashion
    Description: Male Fashion - ecommerce teplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.product__filter').length > 0) {
            var containerEl = document.querySelector('.product__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    // $('.collapse').on('shown.bs.collapse', function () {
    //     $(this).prev().addClass('active');
    // });

    // $('.collapse').on('hidden.bs.collapse', function () {
    //     $(this).prev().removeClass('active');
    // });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        nav: true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*-------------------
        Radio Btn
    --------------------- */
    $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").on('click', function () {
        $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
        Size Select
    --------------------- */
    // $(".shop__sidebar__size label").on('click', function () {
    //     $(this).toggleClass('active');
    // });

    /*-------------------
        Scroll
    --------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/


    // Uncomment below and use your date //

    var timerdate = "2023/01/29"

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"));
    });

    /*------------------
        Magnific
    --------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.append('<span class="fa fa-angle-up inc qtybtn"></span>');
    proQty.prepend('<span class="fa fa-angle-down dec qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

    var proQty = $('.pro-qty-2');
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            // Max quantity 10
            if (oldValue == 10) {
                return;
            }
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }

        let inputVar = $button.parent().find('input');
        inputVar.val(newVal);

        let id = inputVar.data("id");

        let currPrice = ($(`#price-${id}`).text().split(/ +/)[1]);
        $(`#total-${id}`).text(`₹ ${(currPrice * newVal).toFixed(2)}`);
        inputVar.change();
    });

    /*------------------
        Achieve Counter
    --------------------*/
    $('.cn_num').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    /*---------------------------
        Active Nav link changer
    ----------------------------*/

    $(".header__menu>ul>li>a").each(function (index, element) {
        const currentLocation = location.href;
        if (element.href == currentLocation) {
            $(".header__menu>ul>li.active").removeClass("active");
            $(element).parent('li').addClass("active");
        }
    });

    // wishlist

    $('.wishlist, .delete').click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        let action = $(this).attr("class");
        let productId = id.split("-")[1];
        $.ajax({
            url: 'api/wishlist.php',
            method: 'POST',
            data: {
                id: productId,
                action: action
            },
            success: function (data) {

                $(".toast-body").text(data)

                const toast = new bootstrap.Toast($("#liveToast"))
                toast.show()
                console.log(`#${id}`)
                $(`#${id}`)
                    .toggleClass("wishlist")
                    .toggleClass("delete")

                $(`#${id}`).children("i.fa-heart")
                    .toggleClass("white-heart")
                    .toggleClass("red-heart")

                if (action == "delete") $(`#${id}`).children("p").text("ADD TO WISHLIST")
                else $(`#${id}`).children("p").text("ADDED TO WISHLIST")
            }
        })
    })

    $(".search-model-form").submit(function (e) {
        e.preventDefault();
        location.href = "shop?q=" + $("#search-input").val();
    })
})(jQuery);