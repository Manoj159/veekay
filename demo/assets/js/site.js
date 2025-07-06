$( document ).ready(function() {

           
     $('.main-hero-slider').slick({
          
        });      

    $('.car-slider').slick({

        infinite: true,

        slidesToShow: 4,

        slidesToScroll: 1,



        responsive: [

        {

        breakpoint: 600,

        settings: {

            slidesToShow: 2,

            slidesToScroll: 2

        }

        },

        {

        breakpoint: 480,

        settings: {

            slidesToShow: 1,

            slidesToScroll: 1

        }

        }

        // You can unslick at a given breakpoint now by adding:

        // settings: "unslick"

        // instead of a settings object

    ]

        

    });



    $('.offer-slider').slick({

        infinite: true,

        slidesToShow: 5,

        slidesToScroll: 1,

        responsive: [

        {

        breakpoint: 600,

        settings: {

            slidesToShow: 2,

            slidesToScroll: 2

        }

        },

        {

        breakpoint: 480,

        settings: {

            slidesToShow: 1,

            slidesToScroll: 1

        }

        }

        // You can unslick at a given breakpoint now by adding:

        // settings: "unslick"

        // instead of a settings object

    ]

    });



    $('.testimonial-slider').slick({

        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
        {
        breakpoint: 600,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2
        }
        },
        {
        breakpoint: 480,
        settings: {

            slidesToShow: 1,

            slidesToScroll: 1
        }
        }

        // You can unslick at a given breakpoint now by adding:

        // settings: "unslick"

        // instead of a settings object

    ]
    });

    $('.how-book-slider').slick({

        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
        {
        breakpoint: 600,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2
        }
        },
        {
        breakpoint: 480,
        settings: {

            slidesToShow: 1,

            slidesToScroll: 1
        }
        }

        // You can unslick at a given breakpoint now by adding:

        // settings: "unslick"

        // instead of a settings object

    ]
    });



    $ (".modal a").not (".dropdown-toggle").on ("click", function () {

		$ (".modal").modal ("hide");

	});



    // $('#about-link').addClass('current');

    $('.km-item').on('click', function(e){

        e.preventDefault();

        $('.km-item').removeClass('active');

        $(this).addClass('active');

    });

 



    //mobile filter box open js





    $(".filter-toggler .btn").click(function(){

        $(".filter-sidebar").toggleClass("display");

    });



    $(".filter-sidebar .btn-close").click(function(){

        $(".filter-sidebar").toggleClass("display");

    });

    



});



// datetime picker js

$(function(){

	

	var date = new Date();

    date.setDate(date.getDate());

	 

    $(".start-timepicker").datetimepicker({

        minuteStep: 10,

        autoclose:true,

		startView: 2,

		format: "dd-mm-yyyy hh:00:00",

        minView:1,

		startDate: date,

		todayHighlight: true



    });

	

	

     

    $(".end-timepicker").datetimepicker({

        minuteStep: 10,

        autoclose:true,

		startView: 2,

		format: "dd-mm-yyyy hh:00:00",

        minView:1,

		startDate: date,

		todayHighlight: true

		

	



    });

});





// picker backdrop

$('div').each(function(){



    if ( $(".datetimepicker").css('display') == 'block')

    {

        $(".picker-backdrop").css("display", "block");

    }

});



$(window).scroll(function(){

        var sticky = $('.header'),

            scroll = $(window).scrollTop();



        if (scroll >= 30) sticky.addClass('fixed');

        else sticky.removeClass('fixed');

});





// show more text show less text

document.addEventListener('DOMContentLoaded', function () {
    const moreText = document.querySelector('.more-text');
    const showMoreBtn = document.querySelector('.show-more-btn');
    const showLessBtn = document.querySelector('.show-less-btn');

    showMoreBtn.addEventListener('click', function () {
        moreText.style.display = 'inline';
        showMoreBtn.style.display = 'none';
        showLessBtn.style.display = 'inline';
    });

    showLessBtn.addEventListener('click', function () {
        moreText.style.display = 'none';
        showMoreBtn.style.display = 'inline';
        showLessBtn.style.display = 'none';
    });
});










