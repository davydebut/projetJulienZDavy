<?php 
wp_head();
?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <?php /*bloginfo('name')*/ the_custom_logo() ?>
        <!-- <img class="img-fluid" src="<?php  //echo get_custom_logo('url');?>" alt="logo"> -->
    </a>
    

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
    <?php wp_nav_menu([
    'menu' => "main",
    'container' => false,
    'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0'
    ]);
    ?>
    
    </div>
  </div>
</nav>