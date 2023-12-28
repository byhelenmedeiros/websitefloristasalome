<div class="product-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">
                    <?php echo get_theme_mod('product_section_title', 'Confeccionado com materiais de excelência'); ?>
                </h2>
                <p class="mb-4">
                    <?php echo esc_html(get_theme_mod('product_section_text', 'Deixe-se levar por nossa variedade de produtos e descubra a qualidade em cada detalhe. Sinta a diferença com cada escolha.')); ?>
                </p>
                <p>
                    <a href="<?php echo esc_url($shop_page_url); ?>" class="btn">
                        <?php echo get_theme_mod('shop_button_text', 'Explore nossa loja'); ?>
                    </a>
                </p>
            </div>

            <?php
            // Função para buscar os últimos produtos adicionados
            $latest_products = get_posts(array(
                'post_type' => 'produto',
                'posts_per_page' => 3, 
                'orderby' => 'post_date',
                'order' => 'DESC'
            ));

            // Exibir os últimos produtos
            foreach ($latest_products as $latest_product) {
                $latest_product_name = $latest_product->post_title;
                $latest_product_price = get_post_meta($latest_product->ID, '_price', true);
                $latest_product_image = get_post_meta($latest_product->ID, '_product_image', true);
            ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="<?php echo get_permalink($latest_product->ID); ?>">
                        <img src="<?php echo esc_url($latest_product_image); ?>" class="img-fluid product-thumbnail">
                        <h3 class="product-title"><?php echo esc_html($latest_product_name); ?></h3>
                        <strong class="product-price"><?php echo esc_html($latest_product_price); ?></strong>
                        <span class="icon-cross">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
