<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
    <meta name="description" content="" />
    <!-- Bootstrap CSS -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Floris navigation bar">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">Florista Salomé<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFlorist" aria-controls="navbarsFlorist" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsFlorist">
                    <?php
                $menu_args = array(
                    'theme_location' => 'primary-menu',
                    'menu_class' => 'custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0',
                    'container' => false,
                );
                
                wp_nav_menu($menu_args);
            ?>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/user.svg"></a></li>
                    <li><a class="nav-link" href="cart.html"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cart.svg"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Conteúdo da sua página -->
    
    <?php wp_footer(); ?>
</body>
</html>
