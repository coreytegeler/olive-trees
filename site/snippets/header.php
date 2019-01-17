<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">
  <?= css('assets/css/style.css') ?>

</head>
<body>
  <main class="main <?php echo $page->intendedTemplate(); ?>" role="main">
    <!-- <header role="header"> -->
      <!-- <a href="/" class="name"> -->
        <!-- <h1>Kameelah Janan Rasheed</h1> -->
      <!-- </a> -->
      <!-- <nav role="navigation"> -->
        <?php
        // echo '<div class="links">';
        //   $links = array( 'about' );
        //   foreach ( $links as $key => $slug ) {
        //     if( $link_page = page( $slug ) ) { 
        //       echo '<a href="' . $link_page->url() . '"><h4>' . $link_page->title() . '</h4></a>';
        //     }
        //   }
        // echo '</div>';
        // if( $param = param( 'type' ) ) {
        //   $selected = explode( ',', param( 'type' ) );
        // } else {
        //   $selected = null;
        // }
        // echo '<div class="links filters' . ( $selected ? ' filtered' : '' ) . '">';
        //   $filters = array( 'events', 'artwork', 'texts' );
        //   foreach ( $filters as $key => $slug ) {
        //     if( $filter_page = page( $slug ) ) {
        //       $filter_url = $site->url() . '/type:' . $slug;
        //       if( !$selected || in_array( $slug, $selected ) ) {
        //         $class = 'selected';
        //       } else {
        //         $class = '';
        //       }
        //       echo '<a href="' . $filter_url . '" data-filter="' . $slug . '" class="' . $class . '">';
        //         echo '<h4>' . $filter_page->title() . '</h4>';
        //       echo '</a>';
        //     }
        //   }
        // echo '</div>';
        ?>
      <!-- </nav> -->
    <!-- </header> -->