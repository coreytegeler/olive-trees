jQuery(function($) {
  var fixIntro, resizeCarousel, setupCarousel, slideWidth, transitionEnd;
  transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd';
  slideWidth = function() {
    return $(window).innerWidth();
  };
  resizeCarousel = function() {
    var $carousel, $currentSlide, $leftSlide, $rightSlide, $slides, $slidesWrapper, currentIndex, left, slidesLength, slidesWidth;
    $carousel = $('.carousel').first();
    $slides = $carousel.find('.slide');
    slidesLength = $slides.length;
    $slidesWrapper = $carousel.find('.slides');
    $currentSlide = $carousel.find('.slide.current');
    $leftSlide = $currentSlide.prev().addClass('left');
    $rightSlide = $currentSlide.next().addClass('right');
    currentIndex = $currentSlide.index();
    left = currentIndex * -slideWidth();
    $slidesWrapper.addClass('static');
    slidesWidth = slidesLength * slideWidth();
    $slidesWrapper.css({
      width: slidesWidth,
      x: left
    });
    return $slides.each(function(i, slide) {
      var $caption, $figure, $slide, image, imageUrl;
      imageUrl = $(slide).find('img').attr('src');
      if (!imageUrl) {
        return fixIntro(slide);
      }
      image = new Image;
      $slide = $(this);
      $figure = $slide.find('figure');
      $caption = $slide.find('figcaption');
      image.onload = function() {
        var height, ratio, width;
        width = image.width;
        height = image.height;
        ratio = width / height;
        if (width >= height) {
          $slide.addClass('landscape');
        } else {
          $slide.addClass('portrait');
        }
        if (!parseInt($slide.css('width'))) {
          return $slide.css({
            width: slideWidth()
          });
        }
      };
      return image.src = imageUrl;
    });
  };
  fixIntro = function(slide) {
    var $slides, slidesLength;
    $slides = $(slide).parents('.slides').find('.slide');
    slidesLength = $slides.length;
    return $(slide).css({
      width: 'calc(100%/' + slidesLength + ')'
    });
  };
  setupCarousel = function() {
    $('.carousel').each(function(i, carousel) {
      $(this).find('.slide:first-child').addClass('current');
      return $(carousel).imagesLoaded(function() {
        return $(carousel).addClass('loaded');
      });
    });
    return resizeCarousel();
  };
  $('body').on('mouseenter', '.carousel.loaded:not(.sliding) .arrow', function() {
    var $arrow, $carousel, direction;
    $arrow = $(this);
    direction = $arrow.attr('data-direction');
    $carousel = $arrow.parents('.carousel');
    return $carousel.attr('data-direction', direction);
  });
  $('body').on('mouseleave', '.carousel.loaded .arrow', function() {
    var $arrow, $carousel;
    $arrow = $(this);
    $carousel = $arrow.parents('.carousel');
    return $carousel.attr('data-direction', '');
  });
  $('body').on('click', '.carousel.loaded:not(.sliding) .arrow', function(e) {
    var $arrow, $carousel, direction;
    $arrow = $(this);
    $carousel = $arrow.parents('.carousel');
    direction = $arrow.attr('data-direction');
    return $carousel.slide(direction);
  });
  $('.carousel .slide .scroll').scroll(function(e) {
    var $scroll, $slide;
    $scroll = $(this);
    $slide = $scroll.parents('.slide');
    if (this.scrollHeight - $scroll.scrollTop() <= $slide.innerHeight()) {
      return $scroll.addClass('bottom');
    } else {
      return $scroll.removeClass('bottom');
    }
  });
  $(document).keydown(function(e) {
    var $carousel;
    $carousel = $('.carousel');
    if ($carousel.is('.sliding')) {
      return;
    }
    if (e.which === 37) {
      e.preventDefault();
      return $carousel.slide('left');
    } else if (e.which === 39) {
      e.preventDefault();
      return $carousel.slide('right');
    } else {

    }
  });
  $.fn.slide = function(direction) {
    var $arrow, $carousel, $currentSlide, $firstSlide, $lastSlide, $nextSlide, $slidesWrapper, currentIndex, delay, left;
    $carousel = $(this);
    $arrow = $carousel.find('.arrow.' + direction);
    $carousel.addClass('sliding');
    direction = $arrow.attr('data-direction');
    $carousel = $arrow.parents('.carousel');
    $slidesWrapper = $carousel.find('.slides');
    $currentSlide = $carousel.find('.slide.current');
    currentIndex = $currentSlide.index();
    $firstSlide = $carousel.find('.slide').first();
    $lastSlide = $carousel.find('.slide').last();
    left = parseInt($slidesWrapper.css('x'));
    $slidesWrapper.removeClass('static');
    $currentSlide.find('.scroll').animate({
      scrollTop: 0
    }, 500);
    switch (direction) {
      case 'left':
        $nextSlide = $currentSlide.prev('.slide');
        left += slideWidth() + 2;
        break;
      case 'right':
        $nextSlide = $currentSlide.next('.slide');
        left -= slideWidth() + 2;
    }
    delay = 0;
    return setTimeout((function() {
      var $leftSlide, $rightSlide;
      $slidesWrapper.removeClass('static');
      $slidesWrapper.stop();
      $carousel.find('.slide').removeClass('current left right');
      $currentSlide.removeClass('current');
      $nextSlide.addClass('current');
      $leftSlide = $nextSlide.prev().addClass('left');
      $rightSlide = $nextSlide.next().addClass('right');
      return $slidesWrapper.transition({
        x: left
      }, 700, 'easeInOutCubic', function() {
        var $firstClones, $lastClones, firstSlug, lastSlug;
        if (direction === 'right' && !$nextSlide.next().next().length) {
          firstSlug = $firstSlide.attr('data-slug');
          $firstClones = $carousel.find('[data-slug="' + firstSlug + '"]');
          if ($firstClones.length > 1) {
            $firstClones.first().remove();
            $firstSlide = $carousel.find('.slide').first();
          }
          $firstSlide.clone().insertAfter($lastSlide);
        } else if (direction === 'left' && !$nextSlide.prev().prev().length) {
          lastSlug = $lastSlide.attr('data-slug');
          $lastClones = $carousel.find('[data-slug="' + lastSlug + '"]');
          if ($lastClones.length > 1) {
            $lastClones.last().remove();
            $lastSlide = $carousel.find('.slide').last();
          }
          $lastSlide.clone().insertBefore($firstSlide);
        }
        resizeCarousel();
        return $carousel.removeClass('sliding');
      });
    }), delay);
  };
  resizeCarousel();
  $(function() {
    return setupCarousel();
  });
  return $(window).resize(function() {
    return resizeCarousel();
  });
});
