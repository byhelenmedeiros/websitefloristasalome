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
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/tiny-slider.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
</head>
<body>
      <!-- Start Header/Navigation -->
      <?php get_template_part('includes/templates/header'); ?>
    <!-- Conteúdo da página inicial -->
    <?php get_template_part('hero'); ?>
    <?php get_template_part('includes/templates/producthome'); ?>
    <?php get_template_part('includes/templates/helpsection'); ?>
    <?php get_template_part('includes/templates/footer'); ?>
    <?php get_template_part('includes/templates/testimonial'); ?>








 <!-- footer -->
    <?php get_footer(); ?>

</body>
</html>
