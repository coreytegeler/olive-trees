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
          $type = $slide->_fieldset();
          if( $type == 'image' ) {
            $image = $slide->image();
            $image = $page->image( $image );
            $title = $image->filename();
            $caption = $image->caption();
          } else if( $type == 'text' ) {
            $text = $slide->text()->kirbytext();
          }
          echo '<div class="slide ' . $type . '" data-slug="' . $title . '">';
            echo '<div class="scroll">';
              echo '<div class="texture"></div>';
              if( $type == 'image' ) {
                echo '<div class="wrap">';
                  echo '<img src="' .  $image->url() . '"/>';
                echo '</div>';
                if( $caption->isNotEmpty() ) {
                  echo '<div class="caption"><div class="inner">' . $image->caption() . '</div></div>';
                }
              } else if( $type == 'video' ) {
                echo '<div class="wrap">';
                  if( $slide->source() == 'vimeo' ) {
                    $root = 'player.vimeo.com/video/';
                  } else if( $slide->source() == 'youtube' ) {
                    $root = 'www.youtube.com/embed/';
                  }
                  echo '<iframe src="https://' . $root . $slide->videoid() . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                echo '</div>';
                if( $slide->caption()->isNotEmpty() ) {
                  echo '<div class="caption"><div class="inner">' . $slide->caption() . '</div></div>';
                }
              } else if( $type == 'text' ) {
                echo '<div class="content">';
                  echo '<div class="inner">';
                    echo '<div class="body">';
                      echo $text;
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
              }
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