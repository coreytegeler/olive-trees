<?php
if( isset( $cells ) ) {
	echo '<div id="cells">';
		$cells = $cells->sortBy( 'published', 'desc' );
		if( sizeof( $cells ) ) {
			foreach( $cells as $index => $cell ) {
				$title = $cell->title();
				$titleLength = strlen( $title );
				if( $titleLength >= 75 ) {
					$cellWidth = 'large';
				} else if( $titleLength >= 25 ) {
					$cellWidth = 'medium';
				} else {
					$cellWidth = 'small';
				}
				$published = $cell->date( 'M d, Y', 'published' );
				$type = $cell->intendedTemplate();
				$parent = $cell->parent()->slug();
				$title = $cell->title();
	 			$safeTitle = $cell->safeTitle();
	 			if( !$safeTitle->empty() ) {
	 				$title = $safeTitle;
	 			}
		 		echo '<div class="cell ' . $type . ' ' . $parent . '" data-length="' . $cellWidth . '" style="">';
		 			echo '<a href="' . $cell->url() . '">';
			 			echo '<div class="wrap">';
				 			echo '<div class="content">';
				 				if( $type == 'artwork' ) {
				 					$image = $cell->image();
				 					echo '<div class="image load" data-width="'.$image->width().'" data-height="'.$image->height().'">';
									 	echo $image;
									echo '</div>';
								} else if( $type == 'text' ) {
									snippet( 'content/text', array( 'page' => $cell ) );
								} else if( $type == 'event' ) {
									echo '<div class="date">';
										echo '<h3 class="month">' . $cell->date( 'F' ) . '</h3>';
										echo '<h1 class="day">' . $cell->date( 'd' ) . '</h1>';
							 		echo '</div>';
									echo '<div class="title">';
										echo '<h3>' . $title . '</h3>';
										$location = $cell->location();
										if( $location->isNotEmpty() ) {
											echo '<h4>at ' . $location . '</h4>';
										}
							 		echo '</div>';
								}
							echo '</div>';
							echo '<div class="tooltip">';
								echo '<h2>';
						 			echo $title;
					 			echo '</h2>';
					 			echo '<div class="meta">';
						 			echo '<span>' . $published . '</span>';
						 			echo '<span>' . $type . '</span>';
						 		echo '</div>';
					 		echo '</div>';
					 	echo '</div>';
				 	echo '</a>';
			 	echo '</div>';
			}
		}
	echo '</div>';
}
?>