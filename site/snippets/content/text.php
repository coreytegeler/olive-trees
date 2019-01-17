<?php
$title = $page->safeTitle();
if( $title->empty() ) {
  $title = $page->title();
}
$whitelist = '<p><span><div><h1><h2><h3><h4><strong><em><i><bold><br>';
$meta = $page->meta()->kirbytext();
$intro = $page->intro()->kirbytext();
$body = $page->body()->kirbytext();
// echo '<div class="texture"></div>';
echo '<div class="inner">';
  echo '<h1>' . $title . '</h1>';
  echo '<div class="meta">';
    echo strip_tags( $meta, $whitelist );
  echo '</div>';
  echo '<div class="intro">';
    echo strip_tags( $intro, $whitelist );
  echo '</div>';
  echo '<div class="body">';
    echo strip_tags( $body, $whitelist );
  echo '</div>';
echo '</div>';
?>