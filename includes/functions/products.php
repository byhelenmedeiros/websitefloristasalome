<?php 
function enqueue_product_styles_admin() {
    wp_enqueue_style('product-styles', get_template_directory_uri() . '/assets/css/product-styles.css');
}
add_action('admin_enqueue_scripts', 'enqueue_product_styles_admin');

function enqueue_product_scripts_admin() {
    wp_enqueue_script('product-scripts', get_template_directory_uri() . '/assets/js/product-scripts.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'enqueue_product_scripts_admin');



function process_product_form() {
    if (isset($_POST['submit_product'])) {
        $product_name = sanitize_text_field($_POST['product_name']);
        $product_description = sanitize_text_field($_POST['product_description']);
        $product_price = sanitize_text_field($_POST['product_price']);

        if (!empty($_FILES['product_image']['name'])) {
            $image_path = upload_product_image($_FILES['product_image']);
        } else {
            $image_path = '';
        }

        $product_id = create_product_post($product_name, $product_description, $product_price, $image_path);

        if ($product_id) {
            // Produto adicionado com sucesso
            echo '<div class="notice notice-success is-dismissible"><p>Produto adicionado com sucesso.</p></div>';
        }
    }
}

// Função para criar um novo post de produto
function create_product_post($name, $description, $price, $image_path) {
    $product_args = array(
        'post_title' => $name,
        'post_content' => $description,
        'post_status' => 'publish',
        'post_type' => 'produto',
    );

    $product_id = wp_insert_post($product_args);

    if ($product_id) {
        update_post_meta($product_id, '_price', $price);
        if (!empty($image_path)) {
            update_post_meta($product_id, '_product_image', $image_path);
        }
    }

    return $product_id;
}

// Função para fazer o upload da imagem do produtofunction 
function upload_product_image($file) {
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    $file_return = wp_handle_upload($file, array('test_form' => false));

    if (isset($file_return['error']) || isset($file_return['upload_error_handler'])) {
        return false;
    } else {
        $attachment = array(
            'post_mime_type' => $file_return['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_return['file'])),
            'post_content' => '',
            'post_status' => 'inherit',
            'guid' => $file_return['url']
        );

        $attachment_id = wp_insert_attachment($attachment, $file_return['url']);

        if (!is_wp_error($attachment_id)) {
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_return['file']);
            wp_update_attachment_metadata($attachment_id, $attachment_data);

            return $file_return['url'];
        }
    }

    return false;
}

function list_products() {
    $args = array(
        'post_type' => 'produto', 
        'posts_per_page' => -1, // -1 para buscar todos os produtos
    );

    $products = get_posts($args);

    if ($products) {
        ?>
        <div class="container">
            <h1>Lista de Produtos</h1>
            <h4>Ao clicar no produto, você poderá visualizar detalhes, editar ou remover.</h4>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagem do produto</th> 
                        <th>ID do Produto</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product) {
                    $product_name = get_the_title($product->ID);
                    $product_price = get_post_meta($product->ID, '_price', true);
                    $product_id = $product->ID; // Obtém o ID do produto
                    $product_description = $product->post_content;
                    $product_image = get_post_meta($product->ID, '_product_image', true);
                ?>

                    <tr class="product-row">
                        <td class="product-image">
                            <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>" class="thumbnail-image" width="50" height="50">
                        </td>
                        <td class="product-id"><?php echo $product_id; ?></td>
                        <td class="product-name"><?php echo $product_name; ?></td>
                        <td class="product-price">
                            <?php echo number_format($product_price, 2, ',', '.') . '€'; ?>
                        </td>
                        <td class="description-column">
                            <p class="product-description"><?php echo $product_description; ?></p>
                        </td>
                        <td>
                            <a href="?action=edit_product&product_id=<?php echo $product->ID; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?action=delete_product&product_id=<?php echo $product->ID; ?>" class="btn btn-danger btn-sm">Remover</a>
                        </td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}

   // Função para adicionar a seção de produtos no menu do painel de administração
   function add_product_menu() {
    add_menu_page(
        'Produtos',
        'Produtos',
        'manage_options',
        'list-products',
        'list_products',
        'dashicons-cart' 
    );

    add_submenu_page(
        'list-products',
        'Detalhes do Produto',
        'Detalhes do Produto',
        'manage_options',
        'product-details',
        'show_product_details'
    );    

    add_submenu_page(
        'list-products',
        'Adicionar Novo Produto',
        'Adicionar Novo Produto',
        'manage_options',
        'add-product',
        'show_product_form'
    );
  
}

function show_product_details() {
    $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

    if ($product_id) {
        // Obtenha as informações do produto com base no ID
        $product = get_post($product_id);
        if ($product && $product->post_type === 'produto') {
            // Exiba os detalhes do produto aqui
            $product_name = $product->post_title;
            $product_description = $product->post_content;
            $product_price = get_post_meta($product_id, '_price', true);
            $product_image = get_post_meta($product_id, '_product_image', true);
            
            ?>
            <div class="product-details">
                <h2><?php echo $product_name; ?></h2>
                <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>" />
                <p><?php echo $product_description; ?></p>
                <p>Preço: <?php echo $product_price; ?></p>
            </div>
            <?php
        } else {
            // Mensagem de erro se o produto não for encontrado
            echo "Produto não encontrado.";
        }
    }
}


// Função para exibir o formulário de adicionar produto
function show_product_form() {
    ?>

    <div class="wrap">
    <h2>Adicionar Novo Produto</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Nome do Produto</label>
                <input type="text" name="product_name" id="product_name" required>
            </div>
            <div class="form-group">
                <label for="product_description">Descrição do Produto</label>
                <textarea name="product_description" id="product_description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="product_price">Preço do Produto</label>
                <input type="text" name="product_price" id="product_price" required>
            </div>
            <div class="form-group">
                <label for="product_image">Imagem do Produto</label>
                <input type="file" name="product_image" id="product_image" accept="image/*">
            </div>
            <input type="submit" name="submit_product" value="Adicionar Produto" class="btn btn-primary">
            <input type="submit" name="remove_product" value="Remover Produto" class="btn btn-danger">
        </form>
   </div>
   
    <?php
}

// Função para exibir o formulário de edição de produto
function edit_product_form($product_id) {
    $product = get_post($product_id);
    $product_name = $product->post_title;
    $product_description = $product->post_content;
    $product_price = get_post_meta($product_id, '_price', true);
    $product_image = get_post_meta($product_id, '_product_image', true);
    ?>
    <div class="wrap">
        <h2>Editar Produto</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <div class="form-group">
                <label for="product_name">Nome do Produto</label>
                <input type="text" name="product_name" id="product_name" value="<?php echo $product_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="product_description">Descrição do Produto</label>
                <textarea name="product_description" id="product_description" rows="4" required><?php echo $product_description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="product_price">Preço do Produto</label>
                <input type="text" name="product_price" id="product_price" value="<?php echo $product_price; ?>" required>
            </div>
            <div class="form-group">
                <label for="product_image">Imagem do Produto</label>
                <input type="file" name="product_image" id="product_image" accept="image/*">
                <?php if (!empty($product_image)) { ?>
                    <img src="<?php echo $product_image; ?>" alt="Product Image" style="max-width: 100px;">
                <?php } ?>
            </div>
            <input type="submit" name="update_product" value="Atualizar Produto" class="btn btn-primary">
            <input type="submit" name="remove_product" value="Remover Produto" class="btn btn-danger">
        </form>
    </div>
    <?php
}

function delete_product() {
    if (isset($_GET['action']) && $_GET['action'] === 'delete_product' && isset($_GET['product_id'])) {
        $product_id = intval($_GET['product_id']);
        if ($product_id > 0) {
            // Deleta o post do produto pelo ID
            $deleted = wp_delete_post($product_id, true);

            if ($deleted) {
                // Redireciona de volta para a página de listagem de produtos após a remoção bem-sucedida
                wp_redirect(admin_url('admin.php?page=list-products'));
                exit();
            } else {
                // Se houver um erro ao excluir o produto
                add_action('admin_notices', 'delete_product_error_notice');
            }
        }
    }
}

function delete_product_error_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e('Erro ao tentar remover o produto.', 'text-domain'); ?></p>
    </div>
    <?php
}

add_action('admin_init', 'delete_product');


// Adicionando as ações relacionadas aos produtos
add_action('admin_menu', 'add_product_menu');
add_action('admin_init', 'process_product_form');
