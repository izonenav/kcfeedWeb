jQuery(document).ready(function( $ ) {
		
  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
      $('.back-to-top2').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
      $('.back-to-top2').fadeOut('slow');
    }
  });
  
  // $('.back-to-top').click(function(){
    // $('html, body').animate({scrollTop : 0},1500, 'easeInOutExpo');
    // return false;
  // });

  // Initiate the wowjs animation library
  //new WOW().init();
  var wow = new WOW();
  wow.init();

  // Initiate superfish on nav menu
  $('.nav-menu').superfish({
    animation: {
      opacity: 'show'
    },
    speed: 400
  });

  // Mobile Navigation
  if ($('#nav-menu-container').length) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
    $('body').append('<div id="mobile-body-overly"></div>');
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

    $(document).on('click', '.menu-has-children i', function(e) {
      $(this).next().toggleClass('menu-item-active');
      $(this).nextAll('ul').eq(0).slideToggle();
      $(this).toggleClass("fa-chevron-up fa-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function(e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }

  // Smooth scroll for the menu and links with .scrollto classes
  $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        var top_space = 0;

        if ($('#header').length) {
          top_space = $('#header').outerHeight();

          if( ! $('#header').hasClass('header-fixed') ) {
            top_space = top_space - 20;
          }
        }

        $('html, body').animate({
          scrollTop: target.offset().top - top_space
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu').length) {
          $('.nav-menu .menu-active').removeClass('menu-active');
          $(this).closest('li').addClass('menu-active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
        return false;
      }
    }
  });

  // Header scroll class
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('header-scrolled');
    } else {
      $('#header').removeClass('header-scrolled');
    }
  });

  // Intro carousel
  var introCarousel = $("#introCarousel");
  var introCarouselIndicators = $(".carousel-indicators");
  introCarousel.find(".carousel-inner").children(".carousel-item").each(function(index) {
    (index === 0) ?
    introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "' class='active'></li>") :
    introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "'></li>");

    $(this).css("background-image", "url('" + $(this).children('.carousel-background').children('img').attr('src') +"')");
    $(this).children('.carousel-background').remove();
  });

  $(".carousel").swipe({
    swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
      if (direction == 'left') $(this).carousel('next');
      if (direction == 'right') $(this).carousel('prev');
    },
    allowPageScroll:"vertical"
  });
  
  // 회사소개 carousel
  var introCarousel2 = $("#introCarousel2");
  var introCarouselIndicators2 = $(".carousel-indicators2");
  introCarousel2.find("#dd").children(".carousel-item").each(function(index) {
    (index === 0) ?
    introCarouselIndicators2.append("<li data-target='#introCarousel2' data-slide-to='" + index + "' class='active'></li>") :
    introCarouselIndicators2.append("<li data-target='#introCarousel2' data-slide-to='" + index + "'></li>");

  });

  $(".carousel2").swipe({
    swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
      if (direction == 'left') $(this).carousel('next');
      if (direction == 'right') $(this).carousel('prev');
	  
    },
    allowPageScroll:"vertical"
  });
  
	$('#about li').attr("data-target","#test");
  //$('#about li').css("data-target", "");
  
  // Skills section
  $('#skills').waypoint(function() {
    $('.progress .progress-bar').each(function() {
      $(this).css("width", $(this).attr("aria-valuenow") + '%');
    });
  }, { offset: '80%'} );

  // jQuery counterUp (used in Facts section)
  $('[data-toggle="counter-up"]').counterUp({
    delay: 10,
    time: 2000
  });

  // Porfolio isotope and filter
  var portfolioIsotope1 = $('.portfolio-container').isotope({
    itemSelector: '.portfolio-item',
    layoutMode: 'fitRows'
  });

  $('#portfolio-flters li').on( 'click', function() {
    $("#portfolio-flters li").removeClass('filter-active');
    $(this).addClass('filter-active');

    portfolioIsotope1.isotope({ filter: $(this).data('filter') });
  });
  
  // notice isotope and filter
  var portfolioIsotope = $('.notice-container').isotope({
    itemSelector: '.notice-item',
    layoutMode: 'fitRows'
  });

  $('#notice-flters li').on( 'click', function() {	  
    $("#notice-flters li").removeClass('filter-active');
    $(this).addClass('filter-active');
    portfolioIsotope.isotope({ filter: $(this).data('filter') });
  });
    portfolioIsotope.isotope({ filter: $("<li data-filter='.filter-noti' class='filter-active'>뉴스</li>").data('filter') });

  
  // about isotope and filter
  var portfolioIsotope2 = $('.about-container').isotope({
    itemSelector: '.about-item',
    layoutMode: 'fitRows'
  });

  $('#about-flters li').on( 'click', function() {	  
    $("#about-flters li").removeClass('filter-active');
    $(this).addClass('filter-active');
    portfolioIsotope.isotope({ filter: $(this).data('filter') });
  });

  
  // recruit isotope and filter
  var portfolioIsotope3 = $('.recruit-container').isotope({
    itemSelector: '.recruit-item',
    layoutMode: 'fitRows'
  });

  $('#recruit-flters li').on( 'click', function() {
    $("#recruit-flters li").removeClass('filter-active');
    $(this).addClass('filter-active');
    portfolioIsotope3.isotope({ filter: $(this).data('filter') });
  });
    // portfolioIsotope3.isotope({ filter: $("<li data-filter='.filter-recuit' class='filter-active'>채용정보</li>").data('filter') });
    portfolioIsotope3.isotope({ filter: ".filter-recuit" });

											
  
  // Clients carousel (uses the Owl Carousel library)
  $(".clients-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: { 0: { items: 2 }, 768: { items: 4 }, 900: { items: 6 }
    }
  });

  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1
  });

  
  // notice 부분 화면 컨트롤 및 공지사항 fetch , tootip 사용
	var width = window.innerWidth;

	if(width < 992)
	{	
		familyobj = document.querySelectorAll("a[data-title='FAMILY SITE']");
		familyobj[0].outerHTML = "";
		familyobj[1].outerHTML = "";
		document.querySelector(".notice-container").style.height = "700px";
		document.querySelector(".notice-item").style.height = "700px";
		document.querySelector(".recruit-container").style.height = "1100px";
	}
	else if(width >= 992)
	{
		document.querySelector(".recruit-container").style.height = "818px";
		// document.querySelector("#about .about-col i").style.fontSize  = "35px";
	}
	
	fetchNotice('default' , 'notice');
	$('[data-toggle="tooltip"]').tooltip();   

	//modal
	// $("#myModal").modal();
});
