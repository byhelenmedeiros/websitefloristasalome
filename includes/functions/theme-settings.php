<?php

// Função para configurar as opções do herói
function customizer_hero_settings($wp_customize) {
    // Seção Hero
    $wp_customize->add_section('hero', array(
        'title' => __('Header', 'floristasalome'),
        'priority' => 30,
    ));

    // Configuração para o texto do H1
    $wp_customize->add_setting('hero_h1_text', array(
        'default' => 'Encante-se com nossas flores',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_h1_text', array(
        'label' => __('Título da Header', 'floristasalome'),
        'section' => 'hero',
        'type' => 'text',
    ));

    // Configuração para o texto do parágrafo
    $wp_customize->add_setting('hero_paragraph_text', array(
        'default' => 'Explore a magia das flores e deixe-se envolver pelas emoções que elas transmitem. Na Florista Salomé, criamos experiências florais excepcionais para cada momento especial da sua vida.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_paragraph_text', array(
        'label' => __('Texto do Parágrafo', 'floristasalome'),
        'section' => 'hero',
        'type' => 'textarea',
    ));

    // Configuração para o link do botão principal
    $wp_customize->add_setting('hero_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url',
    ));

    $wp_customize->add_control('hero_button_link', array(
        'label' => __('Link do Botão Principal', 'floristasalome'),
        'section' => 'hero',
        'type' => 'text',
    ));

    // Configuração para o texto do botão principal
    $wp_customize->add_setting('hero_button_text', array(
        'default' => 'Descubra Agora',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_button_text', array(
        'label' => __('Texto do Botão Principal', 'floristasalome'),
        'section' => 'hero',
        'type' => 'text',
    ));

    // Configuração para o link do botão secundário
    $wp_customize->add_setting('hero_secondary_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url',
    ));

    $wp_customize->add_control('hero_secondary_button_link', array(
        'label' => __('Link do Botão Secundário', 'floristasalome'),
        'section' => 'hero',
        'type' => 'text',
    ));

    // Configuração para o texto do botão secundário
    $wp_customize->add_setting('hero_secondary_button_text', array(
        'default' => 'Explorar',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_secondary_button_text', array(
        'label' => __('Texto do Botão Secundário', 'floristasalome'),
        'section' => 'hero',
        'type' => 'text',
    ));

    // Configuração para alterar a imagem
    $wp_customize->add_setting('hero_image', array(
        'default' => get_template_directory_uri() . '/assets/images/flores-header.png',
        'sanitize_callback' => 'esc_url',
    ));

    $wp_customize->add_control(
        new WP_Customize_Upload_Control($wp_customize, 'hero_image', array(
            'label' => __('Imagem da Header', 'floristasalome'),
            'section' => 'hero',
            'settings' => 'hero_image',
        ))
    );
}



add_action('customize_register', 'customizer_hero_settings');

// Função para configurar o título da seção de produtos
function customizer_product_section_title($wp_customize) {
    $wp_customize->add_section('product_section', array(
        'title' => __('Título da Seção de Produtos', 'floristasalome'),
    ));

    $wp_customize->add_setting('product_section_title', array(
        'default' => 'Confeccionado com materiais de excelência.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('product_section_title', array(
        'label' => __('Título da Seção', 'floristasalome'),
        'section' => 'product_section',
        'settings' => 'product_section_title',
    ));
}

add_action('customize_register', 'customizer_product_section_title');

// Função para configurar o botão "Shop" na seção de produtos
function customizer_shop_button($wp_customize) {
    $wp_customize->add_section('product_section_shop', array(
        'title' => __('Configurações do Shop', 'floristasalome'),
    ));

    // Adicione uma configuração para a página "Shop"
    $wp_customize->add_setting('shop_page', array(
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('shop_page', array(
        'label' => __('Página para o botão "Shop"', 'floristasalome'),
        'section' => 'product_section_shop',
        'settings' => 'shop_page',
        'type' => 'dropdown-pages',
    ));
}

add_action('customize_register', 'customizer_shop_button');

// Função para configurar a seleção de produtos na página inicial
function customizer_product_selection($wp_customize) {
    $wp_customize->add_section('product_selection', array(
        'title' => __('Seleção de Produtos na página inicial', 'floristasalome'),
    ));

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("product_$i", array(
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control("product_$i", array(
            'label' => __("Escolha o Produto $i", 'floristasalome'),
            'section' => 'product_selection',
            'settings' => "product_$i",
            'type' => 'select',
            'choices' => get_products_for_customizer(), // Esta função irá listar os produtos disponíveis
        ));
    }
}

add_action('customize_register', 'customizer_product_selection');

// Função para buscar os produtos disponíveis para customização
function get_products_for_customizer() {
    $products = get_posts(array(
        'post_type' => 'produto', 
        'posts_per_page' => -1,
    ));

    $product_choices = array();
    foreach ($products as $product) {
        $product_choices[$product->ID] = $product->post_title;
    }

    return $product_choices;
}

// Adiciona suporte a imagens personalizadas
add_theme_support('custom-header', array(
    'default-image' => get_template_directory_uri() . '/images/default-header.jpg', // Imagem padrão
    'width' => 1600,
    'height' => 900,
    'flex-width' => true,
    'flex-height' => true,
));

// Adiciona controles para três imagens personalizadas
function mytheme_customize_register($wp_customize) {
    $wp_customize->add_section('custom_images', array(
        'title' => 'Imagens Personalizadas',
        'priority' => 70,
    ));

    // Primeira imagem
    $wp_customize->add_setting('header_image_1');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_image_1', array(
        'label' => 'Imagem 1',
        'section' => 'custom_images',
        'settings' => 'header_image_1',
    )));

    // Segunda imagem
    $wp_customize->add_setting('header_image_2');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_image_2', array(
        'label' => 'Imagem 2',
        'section' => 'custom_images',
        'settings' => 'header_image_2',
    )));

    // Terceira imagem
    $wp_customize->add_setting('header_image_3');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_image_3', array(
        'label' => 'Imagem 3',
        'section' => 'custom_images',
        'settings' => 'header_image_3',
    )));
}
add_action('customize_register', 'mytheme_customize_register');


function customizer_sections($wp_customize) {
    // Criando uma categoria principal "Como Podemos Ajudar"
    $wp_customize->add_panel('help_panel', array(
        'title' => 'Como Podemos Ajudar',
        'priority' => 30,
    ));

        // Criando uma subcategoria "We Help Section" dentro da categoria principal
        $wp_customize->add_section('help_section', array(
            'title' => 'Textos da secção',
            'priority' => 30,
            'panel' => 'help_panel', // Definindo a categoria para esta subseção
        ));

        
        // Adicionando configurações para a subcategoria "We Help Section"
        $wp_customize->add_setting('help_section_title', array(
            'default' => 'We Help You Make Modern Interior Design',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('help_section_title', array(
            'label' => 'Section Title',
            'section' => 'help_section',
            'type' => 'text',
        ));

        $wp_customize->add_setting('help_section_text', array(
            'default' => 'Donec facilisis quam ut purus rutrum lobortis...',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));

        $wp_customize->add_control('help_section_text', array(
            'label' => 'Section Text',
            'section' => 'help_section',
            'type' => 'textarea',
        ));

        $wp_customize->add_setting('help_section_button_text', array(
            'default' => 'Explore',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('help_section_button_text', array(
            'label' => 'Button Text',
            'section' => 'help_section',
            'type' => 'text',
        ));

        // Adicione um controle para escolha de ícone, por exemplo, utilizando o WordPress core para escolher um ícone
        $wp_customize->add_setting('help_section_icon', array(
            'default' => 'default-icon-class', // Substitua isso pelo valor padrão do ícone desejado
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('help_section_icon', array(
            'label' => 'Choose an Icon',
            'section' => 'help_section',
            'type' => 'text',
            'description' => 'Enter the CSS class for the desired icon', // Adicione uma descrição para orientar o usuário
        ));


        // Adicionando uma seção para "Links e Textos dos Itens"
    $wp_customize->add_section('help_items_section', array(
        'title' => 'Links e Textos dos Itens',
        'priority' => 30,
        'panel' => 'help_panel', // Adicionando a seção ao painel "Como Podemos Ajudar"
    ));

    for ($i = 1; $i <= 4; $i++) {
        // Adicionando configuração para o nome do item
        $wp_customize->add_setting('help_item_' . $i . '_name', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        // Adicionando controle para o nome do item
        $wp_customize->add_control('help_item_' . $i . '_name', array(
            'label' => 'Item ' . $i . ' Nome',
            'section' => 'help_items_section',
            'type' => 'text',
        ));

        // Adicionando configuração para a URL do item
        $wp_customize->add_setting('help_item_' . $i . '_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        // Adicionando controle para a URL do item
        $wp_customize->add_control('help_item_' . $i . '_url', array(
            'label' => 'Item ' . $i . ' URL',
            'section' => 'help_items_section',
            'type' => 'url',
        ));  
    }

// Adicionando uma seção para "Produtos Populares"
$wp_customize->add_section('popular_products_section', array(
    'title' => 'Produtos Populares',
    'priority' => 30,
    'panel' => 'help_panel', // Adicionando a seção ao painel "Como Podemos Ajudar"
));

for ($i = 1; $i <= 3; $i++) {
    // Imagem do Produto Popular
    $wp_customize->add_setting('popular_product_image_' . $i, array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'popular_product_image_' . $i, array(
        'label' => 'Imagem do Produto ' . $i,
        'section' => 'popular_products_section', // Adicionando ao submenu "Produtos Populares"
        'settings' => 'popular_product_image_' . $i,
    )));

    // Título do Produto Popular
    $wp_customize->add_setting('popular_product_title_' . $i, array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('popular_product_title_' . $i, array(
        'label' => 'Título do Produto ' . $i,
        'section' => 'popular_products_section', // Adicionando ao submenu "Produtos Populares"
        'type' => 'text',
    ));

    // Descrição do Produto Popular
    $wp_customize->add_setting('popular_product_description_' . $i, array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('popular_product_description_' . $i, array(
        'label' => 'Descrição do Produto ' . $i,
        'section' => 'popular_products_section', // Adicionando ao submenu "Produtos Populares"
        'type' => 'textarea',
    ));

    // Link do Produto Popular
    $wp_customize->add_setting('popular_product_link_' . $i, array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('popular_product_link_' . $i, array(
        'label' => 'Link do Produto ' . $i,
        'section' => 'popular_products_section', // Adicionando ao submenu "Produtos Populares"
        'type' => 'url',
    ));
}


    
    }
    add_action('customize_register', 'customizer_sections');
