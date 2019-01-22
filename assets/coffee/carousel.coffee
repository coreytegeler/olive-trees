jQuery ($) ->
	transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd'

	slideWidth = ->
		return $(window).innerWidth()

	resizeCarousel = ->
		$carousel = $('.carousel').first()
		$slides = $carousel.find('.slide')
		slidesLength = $slides.length
		$slidesWrapper = $carousel.find('.slides')
		$currentSlide = $carousel.find('.slide.current')
		$leftSlide = $currentSlide.prev().addClass('left')
		$rightSlide = $currentSlide.next().addClass('right') 
		currentIndex = $currentSlide.index()
		left = currentIndex * -slideWidth()
		$slidesWrapper.addClass 'static'
		slidesWidth = slidesLength * slideWidth()
		$slidesWrapper.css
			width: slidesWidth
			x: left
		$slides.each (i, slide) ->
			imageUrl = $(slide).find('img').attr('src')
			if !imageUrl
				return fixIntro(slide)
			image = new Image
			$slide = $(this)
			$figure = $slide.find('figure')
			$caption = $slide.find('figcaption')

			# if $caption.length
			# 	halfCaptionHeight = $caption.innerHeight()
			# 	$figure.css
			# 		paddingTop: halfCaptionHeight+'px'

			image.onload = ->
				width = image.width
				height = image.height
				ratio = width / height
				if width >= height
					$slide.addClass 'landscape'
				else
					$slide.addClass 'portrait'
				if !parseInt($slide.css('width'))
					$slide.css width: slideWidth()
			image.src = imageUrl

	fixIntro = (slide) ->
		$slides = $(slide).parents('.slides').find('.slide')
		slidesLength = $slides.length
		$(slide).css width: 'calc(100%/'+slidesLength+')'

	setupCarousel = ->
		$('.carousel').each (i, carousel) ->
			$(this).find('.slide:first-child').addClass 'current'
			$(carousel).imagesLoaded ->
				$(carousel).addClass 'loaded'
		resizeCarousel()


	$('body').on 'mouseenter', '.carousel.loaded:not(.sliding) .arrow', ->
		$arrow = $(this)
		direction = $arrow.attr('data-direction')
		$carousel = $arrow.parents('.carousel')
		$carousel.attr('data-direction', direction)

	$('body').on 'mouseleave', '.carousel.loaded .arrow', ->
		$arrow = $(this)
		$carousel = $arrow.parents('.carousel')
		$carousel.attr('data-direction', '')

	$('body').on 'click', '.carousel.loaded:not(.sliding) .arrow', (e) ->
		$arrow = $(this)
		$carousel = $arrow.parents('.carousel')
		direction = $arrow.attr('data-direction')
		$carousel.slide(direction)

	# $('body').on 'click', '.carousel.loaded:not(.sliding) .slide.current', (e) ->
	# 	$slide = $(this)
	# 	$scroll = $slide.find('.scroll')
	# 	$carousel = $slide.parents('.carousel')
	# 	if $scroll.is('.bottom')
	# 		top = 0
	# 	else
	# 		top = $(document).height()
	# 	$scroll.animate
	# 		scrollTop: top
	# 	, 500

	$('.carousel .slide .scroll').scroll (e) ->
		$scroll = $(this)
		$slide = $scroll.parents('.slide')
		if this.scrollHeight - $scroll.scrollTop() <= $slide.innerHeight()
			$scroll.addClass('bottom')
		else
			$scroll.removeClass('bottom')

	$(document).keydown (e) ->
		$carousel = $('.carousel')
		if $carousel.is '.sliding'
			return
		if e.which == 37
			e.preventDefault()
			$carousel.slide('left')
		else if e.which == 39
			e.preventDefault()
			$carousel.slide('right')
		else
			return

	$.fn.slide = (direction) ->
		$carousel = $(this)
		$arrow = $carousel.find('.arrow.'+direction)
		# $arrow.addClass 'no'
		$carousel.addClass 'sliding'
		direction = $arrow.attr('data-direction')
		$carousel = $arrow.parents('.carousel')
		$slidesWrapper = $carousel.find('.slides')
		$currentSlide = $carousel.find('.slide.current')
		currentIndex = $currentSlide.index()
		$firstSlide = $carousel.find('.slide').first()
		$lastSlide = $carousel.find('.slide').last()
		left = parseInt($slidesWrapper.css('x'))
		$slidesWrapper.removeClass 'static'
		$currentSlide.find('.scroll').animate
			scrollTop: 0
		, 500
		switch direction
			when 'left'
				$nextSlide = $currentSlide.prev('.slide')
				left += slideWidth() + 2
			when 'right'
				$nextSlide = $currentSlide.next('.slide')
				left -= slideWidth() + 2
		delay = 0
		setTimeout (->
			$slidesWrapper.removeClass 'static'
			$slidesWrapper.stop()
			$carousel.find('.slide').removeClass 'current left right'
			$currentSlide.removeClass 'current'
			$nextSlide.addClass 'current'
			$leftSlide = $nextSlide.prev().addClass('left')
			$rightSlide = $nextSlide.next().addClass('right')
			$slidesWrapper.transition { x: left }, 700, 'easeInOutCubic', () ->
				if direction == 'right' && !$nextSlide.next().next().length
					firstSlug = $firstSlide.attr('data-slug')
					$firstClones = $carousel.find('[data-slug="'+firstSlug+'"]')
					if $firstClones.length > 1
						$firstClones.first().remove()
						$firstSlide = $carousel.find('.slide').first()
					$firstSlide.clone().insertAfter $lastSlide
				else if direction == 'left' && !$nextSlide.prev().prev().length
					lastSlug = $lastSlide.attr('data-slug')
					$lastClones = $carousel.find('[data-slug="'+lastSlug+'"]')
					if $lastClones.length > 1
						$lastClones.last().remove()
						$lastSlide = $carousel.find('.slide').last()
					$lastSlide.clone().insertBefore $firstSlide
				resizeCarousel()
				# $arrow.removeClass 'no'
				$carousel.removeClass 'sliding'
		), delay
	resizeCarousel()
		

	$ ->
		setupCarousel()

	$(window).resize () ->
		resizeCarousel()



	# ---
	# generated by js2coffee 2.2.0