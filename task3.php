<?php

declare(strict_types = 1);

class Book {

    // Использую защищенный модификатор доступа private для инкапсуляции, 
    // вся информация будет выводится через метод getInfo,
    // поэтому к ней не нужен доступ напрямую
    private string $title;
    private string $author;
    private int $year;
    private float $price;

    function __construct(string $title, string $author, int $year, float $price) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->price = $price;
    }

    public function getInfo() {
        return "Название: $this->title, Автор: $this->author, Год выпуска: $this->year, Цена: $this->price";
    }
}

$Idiot = new Book("Идиот", "Ф. М. Достоевский", 1868, 200);
$TheLightFantastic = new Book("Безумная звезда", "Т. Пратчетт", 1986, 220);
$TheRoad = new Book("Дорога", "К. Маккарти", 2006, 180);

echo $Idiot->getInfo() . "\n" . $TheLightFantastic->getInfo() . "\n" . $TheRoad->getInfo();