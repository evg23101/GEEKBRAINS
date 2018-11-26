$(document).ready(function () {
    var catalog = new Catalog();



    catalog.getProducts();
// навешиваем draggable на блок продукта
    // в данном случае с применением ajax draggable навешиваем в методе refresh класса Catalog

    //function drag(elem) {
    //    $('.product').draggable({
    //        helper: 'clone'
    //    });
    //}



    var basket = new Basket();
//навешиваем эффект droppable на контейнер кор
    $('#container_basket').droppable({
        drop: function(event, ui) {
            var elem = ui.draggable[0];
            //console.log(ui.draggable[0]);
            basket.add(elem.id, catalog);
        }
    });

// клик по стрелке вправо
    $('#right').on('click', function () {       
        var firstElem = $('.conteiner_product .product:first-child');
          // анимированное смещение первого продукта вправо с длительностью 500мс
        firstElem.animate({
            marginLeft: -400
        }, 500, function () { // после смещения первый продукт удаляется, 
                                // margin-left сбрасывается на 0, каким он и был
                                // и продукт добавляется в конец списка продуктов
            firstElem.detach().css('margin-left', 0).appendTo('.conteiner_product');            
        });
    });

// клик по стрелке влево
    $('#left').on('click', function () {
        var lastElem = $('.conteiner_product .product:last-child');
        // последний продукт удаляется
        // его margin-left задается отрицательным, чтобы элемента не было видно в блоке
        // и продукт добавляется первым в списке продуктов
        lastElem.detach().css('margin-left', '-400px').prependTo('.conteiner_product');
        // заетм выполняется анимированное смещение первого элемента вправо сбрасыванием margin-left на 0
        $('.conteiner_product .product:first-child').animate({
            marginLeft: 0
        }, 500);
    });
});
