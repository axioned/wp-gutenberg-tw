(function ($, window, document) {
    //Ready code
    $(document).ready(function () {
     
    });
  
    //Window On Load function
    $(window).on("load", function () {
      //This check contact us URL for 2 forms added
      console.log($('.slider-image'));
      $('.slider-image').slick({
        dots: true,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        speed: 1000,
        cssEase: "ease",
        responsive: [
          {
            breakpoint: 996,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
            }
          }
        ]
      });
    });
  
    //Window On Ready function
    $(window).on("load resize", function () {
  
    });
  
    //Window On Scroll function
    $(window).scroll(function (e) {
  
    });
  
  })(jQuery, window, document);
  