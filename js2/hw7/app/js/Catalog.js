function Catalog() {
    this.products = [];
}

Catalog.prototype.refresh = function () {
    var conteiner = $('.conteiner_product');
    var product;
    conteiner.empty();
    for (var i = 0; i < this.products.length; i++) {
        product = $('<div />', {
            class: 'product',
            id: this.products[i].id
        });
        product.append('<p><img class="product_img" src="' + this.products[i].foto + '"></p>');
        product.append('<p>' + this.products[i].name + '</p>');
        product.append('<p>Стоимость: ' + this.products[i].price + ' руб.</p>');
        // навешиваем draggable на продукт
        product.draggable({helper: 'clone'});
        conteiner.append(product);
    }
};

Catalog.prototype.getProducts = function () {
    $.get({
        url: 'catalog.json',
        dataType: 'json',
        context: this,
        success: function (data) {

            this.products = data;
            this.refresh();

        },
        error: function (error) {
            console.log('Ошибка:', error.status, error.statusText);
        }
    });
};
