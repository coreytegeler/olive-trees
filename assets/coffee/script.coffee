$ ->
	$window = $(window)
	$filters = $('.filters a')
	$cells = $('#cells')
	$cells.isotope
	  itemSelector: '.cell',
	  layoutMode: 'masonry',
	  transitionDuration: 0,
	  masonry:
	    columnWidth: '.cell'

	onResize = () ->
		$cells.find('.cell').each (i, cell) ->
			$cell = $(cell)
			$image = $cell.find('.image.load')
			if $image.length
				$img = $cell.find('img')
				imgWidth = Math.floor($image.attr('data-width'))
				imgHeight = Math.floor($image.attr('data-height'))
				imgRatio = imgWidth/imgHeight
				padding = parseInt($cell.find('a').css('padding'))*2
				cellWidth = Math.floor($cell.innerWidth() - padding)
				$image.css
					width: cellWidth
					height: cellWidth/imgRatio
				$image.imagesLoaded () ->
					$loadedImage = $(this.elements[0])
					$loadedImage.attr('style', '')
					$loadedImage.addClass('loaded').removeClass('load')
					$cells.isotope()

			$cell.removeClass('left right center top')
			left = $cell.position().left
			right = Math.ceil(left + $cell.innerWidth())
			top = $cell.position().top
			if( left == 0 )
				$cell.addClass 'left'
			else if( right >= $cells.innerWidth() )
				$cell.addClass 'right'
			else
				$cell.addClass 'center'
			if( top == 0 )
				$cell.addClass 'top'
			if $cell.is('.text')
				windowWidth = $window.innerWidth()
				fontSize = windowWidth/200
				$cell.find('.content').css
					fontSize: fontSize + 'px'
		$cells.isotope()

	filterCells = () ->
		query = []
		$filters.each (i, filter) ->
			if $(filter).is('.selected') && slug = $(filter).attr('data-filter')
				query.push('.'+slug)
		if query.length
			query = query.join()
		else
			query = ''
		$cells.isotope
			filter: query
		onResize()

	filterCells()

	$(window).resize () ->
		onResize()
	.resize()

	$filters.on 'click', (e) ->
		if !$cells.length
			return
		e.preventDefault()
		$filter = $(this)
		$parent = $filters.parent()
		if $parent.is(':not(.filtered)')
			$filters.each () ->
				$(this).removeClass('selected')
			$parent.addClass('filtered')
			$filter.addClass('selected')
		else
			$filter.toggleClass('selected')
		filterCells()

	# $(window).mousemove (e) ->
	# 	# console.log e.screenX
	# 	x = e.screenX
	# 	a = 0
	# 	b = $(window).innerWidth()
	# 	c = .2
	# 	d = 2
	# 	size = (x-a)/(b-a) * (d-c) + c
	# 	console.log size
	# 	$cells.find('.cell').each () ->
	# 		$(this).css
	# 			fontSize: size+'em'
	# 	$cells.isotope 'layout'