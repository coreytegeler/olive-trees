<?php
snippet('header');
$title = $site->title();
$intro = $page->intro()->kirbytext();
$slides = $site->pages()->template( 'slide' );

echo '<div class="content">';
  echo '<div class="carousel">';
    echo '<div class="slides">';
      // echo '<div class="slide intro current" data-slug="intro">';
      //   echo '<div class="scroll">';
      //     echo '<div class="content">';
      //       echo '<div class="inner">';
      //         echo '<h1>' . $title . '</h1>';
      //         echo '<div class="body">';
      //           echo $intro;
      //         echo '</div>';
      //       echo '</div>';
      //     echo '</div>';      
      //   echo '</div>';
      // echo '</div>';
      if( $slides ) {
        foreach ( $slides as $index => $slide ) {
          // $type = $slide->_fieldset();
          // if( $type == 'image' ) {
          //   $image = $slide->image();
          //   $image = $page->image( $image );
          //   $title = $image->filename();
          //   $caption = $image->caption();
          // } else if( $type == 'text' ) {
          //   $text = $slide->text()->kirbytext();
          // }
          echo '<div class="slide" data-slug="' . $title . '">';
            echo '<div class="scroll">';
              // if( $type == 'image' ) {
              //   echo '<div class="wrap">';
              //     echo '<img src="' .  $image->url() . '"/>';
              //   echo '</div>';
              //   if( $caption->isNotEmpty() ) {
              //     echo '<div class="caption"><div class="inner">' . $image->caption() . '</div></div>';
              //   }
              // } else if( $type == 'text' ) {
              echo '<div class="content">';
                echo '<div class="inner">';
                  echo '<div class="body">';
                  echo $slide->content()->text()->kirbytext();
                    // echo $slide->text();
                  echo '</div>';
                echo '</div>';
              echo '</div>';
              // }
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