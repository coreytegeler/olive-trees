  <footer class="footer" role="contentinfo">
  	<div class="inner">
    <?php
    $links = $site->links()->toStructure();
    echo '<ul class="links">';
	    foreach( $links as $i => $link ) {
	    	echo '<li>';
		    	echo '<a href="' . $link->_url() . '" target="_blank">';
		    		echo $link->_title();
		    	echo '</a>';
	    	echo '</li>';
	    }
		echo '</ul>';
		echo '<div class="copyright">';
			echo $site->copyright();
		echo '</div>';
    ?>
  </div>
</footer>
</main>
</body>
<?= js(array(
  'assets/js/jquery-3.2.1.min.js',
  'assets/js/isotope.pkgd.min.js',
  'assets/js/masonry-horizontal.js',
  'assets/js/imagesloaded.js',
  'assets/js/transit.js',
  'assets/js/carousel.js',
  'assets/js/script.js'
) ) ?>
</html>