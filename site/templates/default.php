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
          echo '<div class="slide" data-slug="slide-' . $index . '">';
            echo '<div class="scroll">';

              echo '<div class="content">';
                echo '<div class="inner">';
                  echo '<div class="body">';

                  if( $slide->hasImages() ) {
                    foreach( $slide->images() as $image ) {
                      echo '<figure>';
                        echo $image;
                        $caption = $image->caption();
                        if( $caption->isNotEmpty() ) {
                          echo '<figcaption>' . $image->caption()->kirbytext() . '</figcaption>';
                        }
                      echo '</figure>';
                    }
                  } elseif( $slide->text() ) {
                    $text = $slide->text();
                    echo $text->kirbytext();
                  }

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