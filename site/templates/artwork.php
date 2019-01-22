<?php
snippet('header');
$title = $page->safeTitle();
if( $title->empty() ) {
  $title = $page->title();
}
$intro = $page->intro()->kirbytext();
$images = $page->images();
$slides = $page->slides()->toStructure();
echo '<div class="content">';
  echo '<div class="carousel">';
    echo '<div class="slides">';
      echo '<div class="slide intro current" data-slug="intro">';
        echo '<div class="scroll">';
          echo '<div class="content">';
            echo '<div class="texture"></div>';
            echo '<div class="inner">';
              echo '<h1>' . $title . '</h1>';
              echo '<div class="body">';
                echo $intro;
              echo '</div>';
            echo '</div>';
          echo '</div>';      
        echo '</div>';
      echo '</div>';
      if( $slides ) {
        foreach ( $slides as $index => $slide ) {
          // $image = $slide->image();
          // $image = $page->image( $image );
          $title = $image->filename();
          $caption = $image->caption();
          $text = $slide->text()->kirbytext();

          echo '<div class="slide ' . $type . '" data-index="' . $index . '">';
            echo '<div class="scroll">';


              // if( $type == 'image' ) {
              //   echo '<div class="wrap">';
              //     echo '<img src="' .  $image->url() . '"/>';
              //   echo '</div>';
              //   if( $caption->isNotEmpty() ) {
              //     echo '<div class="caption"><div class="inner">' . $image->caption() . '</div></div>';
              //   }
              echo '<div class="content">';
                echo '<div class="inner">';
                  echo '<div class="body">';
                    echo 'TEXT';
                    print_r( $slide->files()[0] );

                    echo $text;
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        }
      }
    echo '</div>';
    echo '<div class="arrow left" data-direction="left"></div>';
    echo '<div class="arrow right" data-direction="right"></div>';
  echo '</div>';
echo '</div>';
snippet('footer');
?>