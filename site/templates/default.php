<?php
snippet('header');
	$cells = new Pages();
	if( $artworks = $pages->find( 'artwork' ) ) {
		$cells->add( $artworks->children()->visible() );
	}
	if( $texts = $pages->find( 'texts' ) ) {
		$cells->add( $texts->children()->visible() );
	}
	if( $posts = $pages->find( 'blog' ) ) {
		$cells->add( $posts->children()->visible() );
	}
	if( $events = $pages->find( 'events' ) ) {
		$cells->add( $events->children()->visible() );
	}
	if( $cells ) {
		snippet( 'cells', array( 'cells' => $cells ) );
	}
snippet('footer');
?>