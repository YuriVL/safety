(function ($) {

    $(document).ready(function () {
        $(".adv-slider").slick({
            centerMode: true,
            variableWidth: true,
            centerPadding: '50px',
            slidesToShow: 1,
            slidesToScroll: 1,
            appendArrows: $(".adv-carousel-nav"),
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: false,
                        variableWidth: false
                    }
                }
            ]
        });

        partners_carousel_slides_count = $(".adv-slider").slick("getSlick").slideCount; //получаем количество слайдов

        $(".adv-carousel-nav .nav-numbers .last").text("0" + partners_carousel_slides_count);

        $('.adv-slider').on('afterChange', function (event, slick, currentSlide, nextSlide) {
            currentSlide = $('.adv-slider').slick('slickCurrentSlide'); //получаем текущий слайд
            $(".adv-carousel-nav .nav-numbers .first").text("0" + (currentSlide + 1));
        });

        $('input[name*="phone"]').mask('+(000) 000-00-00-00');

    });


    $('.like').on('click', function () {
        var id = $(this).data('id');
        if ($(this).hasClass('like_active')) {
            $(this).removeClass('like_active');
        }
        else {
            $(this).addClass('like_active');
        }
        console.log(id);
        $.ajax({
                url: like_url,
                type: "GET",
                data: ("id=" + id),
                success: function (result) {
                    if (result == 1) {
                        $("#like").text(Number($("#like").text()) + 1);
                    }
                    else if (result == 0) {
                        $("#like").text(Number($("#like").text()) - 1);
                    }
                    else alert("Error");
                }
            }
        )
    });

    $('input.form-control ').on('focus', function () {
        $(this).closest('.form-group').addClass('labelSlide');
    });

    $('input.form-control').blur(function () {
        if (!$.trim(this.value).length) { // zero-length string AFTER a trim
            $(this).closest('.form-group').removeClass('labelSlide');
            $(this).closest('.form-group').addClass('labelStart');

        }
    });

    $('textarea.form-control ').on('focus', function () {
            $(this).closest('.form-group').addClass('labelSlide');
    });

    $('textarea.form-control').blur(function () {
        if (!$.trim(this.value).length) { // zero-length string AFTER a trim
            $(this).closest('.form-group').removeClass('labelSlide');
            $(this).closest('.form-group').addClass('labelStart');

        }
    });
})(jQuery);

