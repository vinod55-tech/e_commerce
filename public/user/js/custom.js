(function ($) {
  'use strict';

  AOS.init({
    duration: 1500,
  });



  $(window).scroll(function () {
    // var scrollHeader = $(window).scrollTop();
    // if (scrollHeader >= 10) {
    //     $('#header').addClass('scrolled');
    // } else {
    //     $('#header').removeClass('scrolled');
    // }
  });

  



  $(function () {
    $(".profile-action a").on("click", function (e) {
      $(this).parent().toggleClass("active");
      $(".notify").removeClass("active");

      $("body").removeClass("sidebar-active");
      $(".site-menu").removeClass("active");
      e.stopPropagation()
    });
    $(".notify a").on("click", function (e) {
      $(this).parent().toggleClass("active");
      $(".profile-action").removeClass("active");

      $("body").removeClass("sidebar-active");
      $(".site-menu").removeClass("active");
      e.stopPropagation()
    });
    $(document).on("click", function (e) {
      if ($(e.target).is(".profile-action, .notify") === false) {
        $(".profile-action").removeClass("active");
        $(".notify").removeClass("active");
      }
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.dashboard-listing .nav-link').forEach(function (element) {

      element.addEventListener('click', function (e) {

        let nextEl = element.nextElementSibling;
        let parentEl = element.parentElement;

        if (nextEl) {
          e.preventDefault();
          let mycollapse = new bootstrap.Collapse(nextEl);

          if (nextEl.classList.contains('show')) {
            mycollapse.hide();
          } else {
            mycollapse.show();
            // find other submenus with class=show
            var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
            // if it exists, then close all of them
            if (opened_submenu) {
              new bootstrap.Collapse(opened_submenu);
            }
          }
        }
      }); // addEventListener
    }) // forEach
  });

  // arrow rotate

  $(".dashboard-listing .nav .nav-item").click(function () {

    if ($(this).hasClass("arrow-rotate")) {
      $(".dashboard-listing .nav .nav-item").removeClass("arrow-rotate");
    } else {
      $(".dashboard-listing .nav .nav-item").removeClass("arrow-rotate");
      $(this).addClass("arrow-rotate");
    }
  });


  $(".table-detail .more-option").click(function(){
    $('.on-ads').slideToggle();
    $('.more-option .camp-name .main-name').toggleClass("rotate-it")
  });

  // img upload

  jQuery(document).ready(function () {
    ImgUpload();

    // var $btns = $('.tab-btn').click(function() {
    //   if (this.id == 'all') {
    //     $('.content-parent > div').fadeIn(450);
    //   } else {
    //     var $el = $('.' + this.id).fadeIn(450);
    //     $('.content-parent > div').not($el).hide();
    //   }
    //   $btns.removeClass('active');
    //   $(this).addClass('active');
    // })

  });
  
  function ImgUpload() {
    var imgWrap = "";
    var imgArray = [];
  
    $('.upload__inputfile').each(function () {
      $(this).on('change', function (e) {
        imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
        var maxLength = $(this).attr('data-max_length');
  
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        var iterator = 0;
        filesArr.forEach(function (f, index) {
  
          if (!f.type.match('image.*')) {
            return;
          }
  
          if (imgArray.length > maxLength) {
            return false
          } else {
            var len = 0;
            for (var i = 0; i < imgArray.length; i++) {
              if (imgArray[i] !== undefined) {
                len++;
              }
            }
            if (len > maxLength) {
              return false;
            } else {
              imgArray.push(f);
  
              var reader = new FileReader();
              reader.onload = function (e) {
                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                imgWrap.append(html);
                iterator++;
              }
              reader.readAsDataURL(f);
            }
          }
        });
      });
    });
  
    $('body').on('click', ".upload__img-close", function (e) {
      var file = $(this).parent().data("file");
      for (var i = 0; i < imgArray.length; i++) {
        if (imgArray[i].name === file) {
          imgArray.splice(i, 1);
          break;
        }
      }
      $(this).parent().parent().remove();
    });
  }

  const swiper_post = new Swiper('.posts-slider', {
    // Optional parameters
    // direction: 'vertical',
    loop: true,
  
    // If we need pagination
    // pagination: {
    //   el: '.swiper-pagination',
    // },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
    // And if we need scrollbar
    // scrollbar: {
    //   el: '.swiper-scrollbar',
    // },

    

  });

})(jQuery)

$(document).ready(function () {
  var current_fs, next_fs, previous_fs; //step_cols
  var opacity;
  var current = 1;
  var steps = $(".step_col").length;
  setProgressBar(current);
  $(".next").click(function () {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    $("#progressbar li").eq($(".step_col").index(next_fs)).addClass("active");
    next_fs.show();
    current_fs.animate({ opacity: 0 }, {
      step: function (now) {
        opacity = 1 - now;
        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({ 'opacity': opacity });
      },
      duration: 500
    });
    setProgressBar(++current);
  });
  $(".previous").click(function () {
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    //Remove class active
    $("#progressbar li").eq($(".step_col").index(current_fs)).removeClass("active");
    previous_fs.show();
    current_fs.animate({ opacity: 0 }, {
      step: function (now) {
        opacity = 1 - now;
        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        previous_fs.css({ 'opacity': opacity });
      },
      duration: 500
    });
    setProgressBar(--current);
  });
  function setProgressBar(curStep) {
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width", percent + "%")
  }
  $(".submit").click(function () {
    return false;
  })
});