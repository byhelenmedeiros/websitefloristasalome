<?php

get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Produtos</h2>
        </div>
    </div>

    <div class="row">
        <?php
        // Loop para exibir produtos
        $args = array(
            'post_type' => 'produto', // Use o nome do seu tipo de post personalizado
            'posts_per_page' => -1, // Exibe todos os produtos
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="<?php the_permalink(); ?>">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('medium', array('class' => 'img-fluid product-thumbnail'));
                        }
                        ?>
                        <h3 class="product-title"><?php the_title(); ?></h3>
                        <strong class="product-price"><?php echo get_post_meta(get_the_ID(), '_price', true); ?></strong>
                    </a>
                </div>
        <?php
            endwhile;
        else :
            echo 'Nenhum produto encontrado.';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php get_footer(); ?>
