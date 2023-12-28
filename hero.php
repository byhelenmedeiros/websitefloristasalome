<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1><?php echo get_theme_mod('hero_h1_text', 'Encante-se com nossas flores'); ?></h1>
                    <p class="mb-4"><?php echo get_theme_mod('hero_paragraph_text', 'Explore a magia das flores e deixe-se envolver pelas emoções que elas transmitem. Na Florista Salomé, criamos experiências florais excepcionais para cada momento especial da sua vida.'); ?></p>
                    <p><a href="<?php echo esc_url(get_theme_mod('hero_button_link', '#')); ?>" class="btn btn-secondary me-2"><?php echo get_theme_mod('hero_button_text', 'Descubra Agora'); ?></a><a href="<?php echo esc_url(get_theme_mod('hero_secondary_button_link', '#')); ?>" class="btn btn-white-outline"><?php echo get_theme_mod('hero_secondary_button_text', 'Explorar'); ?></a></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                <img src="<?php echo get_theme_mod('hero_image', get_template_directory_uri() . '/assets/images/flores-header.png'); ?>" class="img-fluid d-none d-sm-block">
                </div>
            </div>
        </div>
    </div>
</div>
