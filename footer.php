</div>
<footer>
    <?php
    wp_nav_menu([ // wp_nav_menu() prend en paramètre dans un tableau le nom du register_nav_menu('header') 
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0'
    ])
    ?>
</footer>
<div>
    <?= get_option('agence_horaire'); ?>
</div>
<?php wp_footer() ?>
</body>

</html>