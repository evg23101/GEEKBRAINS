function Basket(id) {
    this.id = id;
    this.countGoods = 0; // Количество товаров в корзине
    this.amount = 0; // Общая стоимость товаров
    this.basketItems = []; // Товары, которые находятся в корзине

    this.getBasket();
}

/**
 * Отрисовка корзины
 */
Basket.prototype.render = function (root) {
    var basketDiv = $('<div />',{
        id:this.id,
        //text:'Корзина'
    });

    var basketItemsDiv = $('<div />',{
        id:this.id + '_items',
    });

    basketItemsDiv.appendTo(basketDiv);
    basketDiv.appendTo(root);
};

/**
 * Получение товаров с сервера (из JSON файла)
 */
Basket.prototype.getBasket = function () {
    var appendId = '#'+this.id+'_items';

    // Способ 1
    // var self = this;

    $.get({
        url:'./basket.json',
        dataType:'json',
        context:this, // Способ 2
        success:function (data) {
            // console.log(this);
            var basketData = $('<div />',{
                id:'basket_data'
            });
            this.countGoods = data.basket.length;
            this.amount = data.amount;

            // Вывод информации в DOM
            basketData.appendTo(appendId);

            // Перерисовка корзины
            this.refresh();
        },
        error:function (error) {
            console.log('Ошибка получения корзины',error.status,error.statusText)
        }
    });
};

/**
 * Функция добавления товара в корзину
 * @param idProduct - ID продукта
 * @param price - Стоимость
 */
Basket.prototype.add = function (idProduct, price) {
    var basketItem ={
        "id_product":idProduct,
        "price":price
    };

    this.countGoods++;
    this.amount += price;
    this.basketItems.push(basketItem);

    // Перерисовка корзины
    this.refresh();
};

/**
 * Функция удаления товара из корзины
 */

Basket.prototype.delete = function () {
    if (this.countGoods > 0) {
        let priceOne = this.amount/this.countGoods;
        this.amount -= priceOne;
        this.countGoods--;
        this.basketItems.pop();
        this.refresh();
        if (this.countGoods == 0) {
            $('#basket_data').text('Корзина пуста');
        }
    }
};


Basket.prototype.refresh = function () {
    var basketDataDiv = $('#basket_data');
    basketDataDiv.empty();
    basketDataDiv.append('<p>Всего товаров: '+this.countGoods+'</p>');
    basketDataDiv.append('<p>Сумма: '+this.amount+'</p>');
};