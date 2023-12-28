document.addEventListener('DOMContentLoaded', function() {
    var deleteLinks = document.querySelectorAll('.delete-link');

    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var confirmation = confirm('Tem certeza de que deseja excluir este produto? Esta ação não poderá ser desfeita.');
            if (confirmation) {
                window.location = link.getAttribute('href');
            }
        });
    });
});


jQuery(document).ready(function($) {
    $('.toggle-details').on('click', function() {
        var productId = $(this).data('product-id');
        $('#product-details-' + productId).toggle();
    });
});

jQuery(document).ready(function($) {
    $('.delete-product').click(function(event) {
        event.preventDefault();
        var productId = $(this).data('product-id');
        $('#confirmationModal').modal('show');

        $('.confirm-delete').click(function() {
            window.location.href = '?action=delete_product&product_id=' + productId;
        });
    });
});
