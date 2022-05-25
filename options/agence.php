<?php
class AgenceMenuPage
{ // -> ceci est une classe qui permet de créer une page dans le back-office

    const GROUP = "agence_options"; // -> ceci est le nom du groupe de la page dans le back-office

    public static function register()
    {
        add_action('admin_menu', [self::class, 'addMenu']); // ajout d'un menu dans l'admin et appelle de la méthode addMenu
        add_action('admin_init', [self::class, 'registerSettings']); // ajout d'un groupe de paramètres dans l'admin et appelle de la méthode registerSettings
        add_action('admin_enqueue_scripts', [self::class, 'registerScripts']); // ajout d'un script dans l'admin et appelle de la méthode enqueueScripts
    }

    public static function registerScripts($suffix)
    {
        if ($suffix === 'settings_page_agence_options') {
            wp_register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', [], false);
            wp_register_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', [], false, true);
            wp_enqueue_script('montheme_admin', get_template_directory_uri() . '/assets/admin.js', ['flatpickr'], false, true);
            wp_enqueue_style('flatpickr');
        }
    }

    public static function registerSettings()
    {
        // var_dump($suffix); // -> permet de voir le suffixe de la page dans le back-office string(28)"settings_page_agence_options"
        // die();
        register_setting(self::GROUP, 'agence_horaire'); // -> ceci est le nom du groupe de paramètres
        // get_option('agence_horaire'); // -> ceci est le nom du groupe de paramètres
        register_setting(self::GROUP, 'agence_date');
        add_settings_section('agence_options_section', 'Paramètres', function () {
            echo 'Vous pouver ici gérer les paramètres liés à l\'agence immobilières';
        }, self::GROUP);
        add_settings_field('agence_options_horaire', 'Horaire d\'ouverture', function () {
?>
            <textarea name="agence_horaire" cols="30" rows="10" style="width:100%;"><?php echo esc_html(get_option('agence_horaire')) ?></textarea>
        <?php
        }, self::GROUP, 'agence_options_section');
        add_settings_field('agence_options_date', 'Date d\'ouverture', function () {
        ?>
            <input type="text" name="agence_date" cols="30" rows="10" value="<?php echo esc_attr(get_option('agence_date')) ?>" class="montheme_datepicker">
        <?php
        }, self::GROUP, 'agence_options_section');
    }

    public static function addMenu()
    {
        add_options_page('Gestion de l\'agence', 'Agence', 'manage_options', self::GROUP, [self::class, 'render']); // ajout d'un menu dans l'admin et appelle de la méthode render
    }

    public static function render()
    {
        // echo 'Bonjour les gens';
        ?>
        <h1>Gestion de l'agence</h1>
        <pre>
            <?= var_dump(get_current_screen()); // Donne des informations sur l'écran qui est directement affiché c'est un objet de type wp_screen 
            ?>
        </pre>
        <form action="options.php" method="post">
            <?php
            settings_fields(self::GROUP); // permet de récupérer les données du formulaire
            do_settings_sections(self::GROUP); // permet de récupérer les sections du formulaire
            submit_button(); // permet de créer un bouton submit
            ?>
        </form>
<?php
    }
}
