<?php

// Registrar o Custom Post Type Testemunhos
function register_testimonials_post_type() {
    register_post_type('testemunhos',
        array(
            'labels' => array(
                'name' => __('Testemunhos'),
                'singular_name' => __('Testemunho')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor'),
        )
    );
}
add_action('init', 'register_testimonials_post_type');

// Adicionar meta boxes para campos personalizados
function add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        'Detalhes do Testemunho',
        'render_testimonial_meta_box',
        'testemunhos',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

// Renderiza o conteúdo da meta box
function render_testimonial_meta_box($post) {
    // Adicione campos personalizados conforme necessário
    // Título, Citação, Nome do Autor, Cargo, etc.
    $testimonial_quote = get_post_meta($post->ID, 'testimonial_quote', true);
    $testimonial_author = get_post_meta($post->ID, 'testimonial_author', true);
    $testimonial_position = get_post_meta($post->ID, 'testimonial_position', true);
    ?>
    <label for="testimonial_quote">Citação:</label>
    <textarea name="testimonial_quote" id="testimonial_quote" rows="4" style="width: 100%;"><?php echo esc_textarea($testimonial_quote); ?></textarea>

    <label for="testimonial_author">Autor:</label>
    <input type="text" name="testimonial_author" id="testimonial_author" value="<?php echo esc_attr($testimonial_author); ?>" style="width: 100%;">

    <label for="testimonial_position">Cargo:</label>
    <input type="text" name="testimonial_position" id="testimonial_position" value="<?php echo esc_attr($testimonial_position); ?>" style="width: 100%;">
    <?php
}

// Salvar os dados da meta box
function save_testimonial_meta_data($post_id) {
    // Verifica se o nonce é válido.
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // Verifica se o usuário atual tem permissão para editar o post.
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Salva os dados dos campos personalizados.
    if (isset($_POST['testimonial_quote'])) {
        update_post_meta($post_id, 'testimonial_quote', sanitize_textarea_field($_POST['testimonial_quote']));
    }
    if (isset($_POST['testimonial_author'])) {
        update_post_meta($post_id, 'testimonial_author', sanitize_text_field($_POST['testimonial_author']));
    }
    if (isset($_POST['testimonial_position'])) {
        update_post_meta($post_id, 'testimonial_position', sanitize_text_field($_POST['testimonial_position']));
    }
}
add_action('save_post', 'save_testimonial_meta_data');
