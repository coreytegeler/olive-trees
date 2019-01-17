<?php
snippet( 'header' );
	echo '<div class="content">';
	  $title = $page->safeTitle();
		if( $title->empty() ) { $title = $page->title(); }
		$location = $page->location();
		echo '<div class="inner">';
		  echo '<h1>' . $title . '</h1>';
		  
			echo '<div class="meta">';
				if( $location->isNotEmpty() ) {
					echo '<h4>at ' . $location . '</h4>';
				}
			echo '</div>';

			echo '<div class="body">';
				echo '<div class="date">';
					echo '<h2 class="month">' . $page->date( 'F' ) . '</h2>';
					echo '<h1 class="day">' . $page->date( 'd' ) . '</h1>';
				echo '</div>';
			echo '</div>';
	 echo '</div>';
snippet( 'footer' );
?>