<?php
//Задания 1-4
class Product {
    public $article;
    public $title;
    public $description;
    public $color;
    public $size;
    public $weight;
    public $price;
    public $guarantee;
    public $country;

    public function __construct($article, $title, $description, $color, $size, $weight, $price, $guarantee, $country)
    {
        $this->article = $article;
        $this->title = $title;
        $this->description = $description;
        $this->color = $color;
        $this->size = $size;
        $this->weight = $weight;
        $this->price = $price;
        $this->guarantee = $guarantee;
        $this->country = $country;
    }

    public function view(){
        echo "
            <hr><h2>Карточка товара</h2>
            <b>Артикул:</b> $this->article<br>
            <b>Наименование:</b> $this->title<br>
            <b>Описание:</b> $this->description<br>
            <b>Цвет:</b> $this->color<br>
            <b>Размер:</b> $this->size<br>
            <b>Вес:</b> $this->weight кг<br>
            <b>Цена:</b> $this->price руб.<br>
            <b>Гарантия:</b> $this->guarantee мес.<br>
            <b>Страна-производитель:</b> $this->country<br>
        ";
    }
}

// Товар со скидкой

class Discount extends Product {
    public $state;
    public $complete;
    public $package;
    public $reason;

    function __construct($article, $title, $description, $color, $size, $weight, $price, $guarantee, $country, $state, $complete, $package, $reason)
    {
        parent::__construct($article, $title, $description, $color, $size, $weight, $price, $guarantee, $country);
        $this->state = $state;
        $this->complete = $complete;
        $this->package = $package;
        $this->reason = $reason;
    }

    public function view()
    {
        parent::view();
        echo "
            <b>Состояние:</b> $this->state<br>
            <b>Комплектность:</b> $this->complete<br>
            <b>Состояние упаковки:</b> $this->package<br>
            <b>Причина уценки:</b> $this->reason<br>
        ";
    }
}

$good = new Product(231465,"Samsung J1", "Смартфон Samsung Galaxy J1 (2016)","черный", "132x69x9 мм.", 132, 4490,12, "Китай");
$good->view();

$good2 = new Discount(45679, "Nokia 3310", "Мобильный телефон Nokia 3310", "черный", "48x113x22 мм", 133, 1900, 2, "Китай", "хорошее", "зарядное устройство", "нет", "б/у");
$good2->view();

