function Basket() {
    this.products = [];
}

Basket.prototype.add = function (id, catalog) {
    for (var i = 0; i < catalog.products.length; i++) {
        if (+catalog.products[i].id === +id) {
            var key = this.products.indexOf(catalog.products[i]);
            if (key !== -1) {
                //console.log('key ' + key);
                //console.log('i ' + i);
                this.products[key].count++;
                this.products[key].amount = this.products[key].price * this.products[key].count;
            } else {
                var nextKey = this.products.push(catalog.products[i]) - 1;
                //console.log('nextKey ' + nextKey);
                //console.log('i ' + i);
                this.products[nextKey].count = 1;
                this.products[nextKey].amount = this.products[nextKey].price;
            }

        }
    }
    this.refresh();
};

Basket.prototype.refresh = function () {
    var conteiner = $('#container_basket');
    conteiner.empty();
    conteiner.append('<p class="basket_product_head">' +
                     '<span class="basket_item_n">№</span>' +
                     '<span class="basket_item_name">Наименование</span>' +
                     '<span class="basket_item_price">Стоимость, руб</span>' +
                     '<span class="basket_item_count">Кол-во</span>' +
                     '<span class="basket_item_amount">Суммарная стоимость, руб</span>' +
                     '</p>');
    var product;
    var all_amount = 0;
    for (var i = 0; i < this.products.length; i++) {
        all_amount += +this.products[i].amount;
        product = $('<div />', {
            class: 'basket_product',
            id: this.products[i].id
        });
        product.append('<span class="basket_item_n">' + (i+1) + '</span>');
        product.append('<span class="basket_item_name">' + this.products[i].name + '</span>');
        product.append('<span class="basket_item_price">' + this.products[i].price + '</span>');
        product.append('<span class="basket_item_count">' + this.products[i].count + '</span>');
        product.append('<span class="basket_item_amount">' + this.products[i].amount + '</span>');
        conteiner.append(product);
    }
    conteiner.append('<p class="all_amount">Всего: ' + all_amount + ' руб.</p>');
};
