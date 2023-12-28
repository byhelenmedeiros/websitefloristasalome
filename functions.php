
<?php


// Incluindo arquivos de funcionalidades
require_once get_template_directory() . '/includes/functions/enqueue-scripts.php';
require_once get_template_directory() . '/includes/functions/theme-settings.php';
require_once get_template_directory() . '/includes/functions/products.php'; // Incluindo o arquivo com as funções de produtos




add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

    function register_my_menus() {
        register_nav_menus(
            array(
                'primary-menu' => __( 'Primary Menu' ),
            )
        );
    }
    add_action( 'init', 'register_my_menus' );




// Adicionando as ações relacionadas aos produtos
add_action('admin_menu', 'add_product_menu');
add_action('admin_init', 'process_product_form');
