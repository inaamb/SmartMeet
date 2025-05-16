<?php
header('Content-Type: application/json');

class Book {
    public $title, $price, $image;
    public function __construct($title, $price, $image) {
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
    }
}

$books = [
    new Book("Python Crash Course", 15, "book1.jpg"),
    new Book("History of the World Map by Map", 13, "book2.jpg"),
    new Book("Coding Essentials Guidebook", 16, "book3.jpg"),
    new Book("The Knowledge Gap", 11, "book4.jpg"),
    new Book("Beyond the Science of Reading", 35, "book5.jpg"),
    new Book("Harnessing the Science of Learning", 26, "book6.jpg"),
    new Book("Uncommon Sense Teaching", 20, "book7.jpg"),
    new Book("Infinite Education", 18, "book8.jpg"),
    new Book("The AI Classroom", 40, "book9.jpg"),
    new Book("AI for Educators", 22, "book10.jpg")
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantities = json_decode(file_get_contents("php://input"), true);
    $total = 0;
    $totalBooks = 0;
    $results = [];

    foreach ($books as $i => $book) {
        $qty = isset($quantities["book$i"]) ? (int)$quantities["book$i"] : 0;
        if ($qty > 0) {
            $subtotal = $qty * $book->price;
            $total += $subtotal;
            $totalBooks += $qty;
            $results[] = [
                'title' => $book->title,
                'price' => $book->price,
                'qty' => $qty,
                'subtotal' => $subtotal
            ];
        }
    }

    if ($totalBooks > 5) {
        $total *= 0.9;
    }

    echo json_encode([
        'results' => $results,
        'totalBooks' => $totalBooks,
        'total' => round($total, 2),
        'discountApplied' => $totalBooks > 5
    ]);
    exit;
}


echo json_encode($books);
