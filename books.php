<?php


header('Content-Type: application/json'); // Tells browser to expect JSON

class Book {
    public $title, $price, $image, $description;

    public function __construct($title, $price, $image, $description) {
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
    }
}

$books = [
    new Book("Python Crash Course", 15, "book1.jpg", "An introductory guide to programming with Python."),
    new Book("History of the World Map by Map", 13, "book2.jpg", "A visual history of the world through maps."),
    new Book("Coding Essentials Guidebook", 16, "book3.jpg", "A comprehensive guide to essential coding concepts."),
    new Book("The Knowledge Gap", 11, "book4.jpg", "Explores the education gap in society and ways to bridge it."),
    new Book("Beyond the Science of Reading", 35, "book5.jpg", "In-depth analysis of the latest research on reading science."),
    new Book("Harnessing the Science of Learning", 26, "book6.jpg", "Learn the latest cognitive science that can improve learning."),
    new Book("Uncommon Sense Teaching", 20, "book7.jpg", "Offers new strategies for teaching based on science."),
    new Book("Infinite Education", 18, "book8.jpg", "Discusses the future of education in the digital age."),
    new Book("The AI Classroom", 40, "book9.jpg", "How AI is changing the way we educate students."),
    new Book("AI for Educators", 22, "book10.jpg", "A practical guide for educators to implement AI in classrooms.")
];

echo json_encode($books); 
?>
