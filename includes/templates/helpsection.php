<!-- Start We Help Section -->
<div class="we-help-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="imgs-grid">
                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                        $image_url = get_theme_mod('header_image_' . $i);
                        $alt_text = 'Image ' . $i; 

                        // Verifica se existe uma imagem personalizada
                        if ($image_url) {
                            echo '<div class="grid grid-' . $i . '"><img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '"></div>';
                        } else {
                            echo '<div class="grid grid-' . $i . '">No image selected</div>'; // Mensagem padrão caso não haja imagem personalizada
                        }
                    }
                    ?>
                </div>
            </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4"><?php echo get_theme_mod('help_section_title', 'We Help You Make Modern Interior Design'); ?></h2>
                    <p><?php echo get_theme_mod('help_section_text', 'Donec facilisis quam ut purus rutrum lobortis...'); ?></p>

                    <ul class="list-unstyled custom-list my-4">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <?php
                    $item_name = get_theme_mod('help_item_' . $i . '_name');
                    $item_url = get_theme_mod('help_item_' . $i . '_url');

                    // Verifica se o nome do item está definido para exibir na lista
                    if ($item_name) {
                        echo '<li><a href="' . esc_url($item_url) . '" style="text-decoration: none;">' . esc_html($item_name) . '</a></li>';
                    }
                    ?>
                <?php endfor; ?>
                    </ul>


                    <p><a href="#" class="btn"><?php echo get_theme_mod('help_section_button', 'Explore'); ?></a></p>

                </div>
        </div>
    </div>
</div>
<!-- End We Help Section -->

<div class="popular-product">
    <div class="container">
        <div class="row">
            <!-- Aqui estão os produtos populares -->
            <?php for ($i = 1; $i <= 3; $i++) : ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="<?php echo esc_url(get_theme_mod('popular_product_image_' . $i)); ?>" alt="Product Image <?php echo $i; ?>" class="img-fluid">
                        </div>
                        <div class="pt-3 ps-3">
                            <h3><?php echo esc_html(get_theme_mod('popular_product_title_' . $i)); ?></h3>
                            <p><?php echo esc_html(get_theme_mod('popular_product_description_' . $i)); ?></p>
                            <p><a href="<?php echo esc_url(get_theme_mod('popular_product_link_' . $i)); ?>">Ver mais</a></p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

