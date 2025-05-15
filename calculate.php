<?php
// Define Book class
class Book {
    public $title, $price, $image;
    public function __construct($title, $price, $image) {
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
    }
}

// Array of books (objects)
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

// Calculate totals
$total = 0;
$totalBooks = 0;
$resultRows = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($books as $index => $book) {
        $qty = isset($_POST["book$index"]) ? (int)$_POST["book$index"] : 0;
        if ($qty > 0) {
            $subtotal = $qty * $book->price;
            $total += $subtotal;
            $totalBooks += $qty;
            $resultRows[] = [
                'title' => $book->title,
                'price' => $book->price,
                'qty' => $qty,
                'subtotal' => $subtotal
            ];
        }
    }

    // Apply 10% discount if more than 5 books
    if ($totalBooks > 5) {
        $total *= 0.9;
    }
}

// Function to render result table
function renderTable($rows) {
    if (empty($rows)) return '';
    $reslt = '<table class="table table-bordered mt-4">';
    $reslt.= '<thead><tr><th>Title</th><th>Price (OMR)</th><th>Quantity</th><th>Subtotal (OMR)</th></tr></thead><tbody>';
    foreach ($rows as $row) {
        $reslt .= "<tr>
            <td>" . htmlspecialchars($row['title']) . "</td>
            <td>" . htmlspecialchars($row['price']) . "</td>
            <td>" . htmlspecialchars($row['qty']) . "</td>
            <td>" . htmlspecialchars(number_format($row['subtotal'], 2)) . "</td>
        </tr>";
    }
    $reslt .= "</tbody></table>";
    return $reslt;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill Calculator - Book Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid p-3">
            <a href="#" class="navbar-brand"><img src="smartmeet transparent bg.PNG" alt="Logo" width="auto" height="110px"></a>
            <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseContent" class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapseContent">
                <ul class="navbar-nav gap-3 fs-5 text-info ms-auto">
                    <li class="nav-item"><a class="nav-link text-info" href="index.php">Home Page</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="about-us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="room-booking.php">Room Booking</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="book-shop.php">Book Shop</a></li>
                    <li class="nav-item"><a class="nav-link text-primary active" href="calculate.php">Calculate</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="collaboration.php">Collaboration</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="questionnaire.php">Questionnaire</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="tips.php">Tips</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="contact-us.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="funpage.php">Fun</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container my-5">
    <h1 class="text-center mb-4">Bill Calculator</h1>
    <form method="post" action="calculate.php">
        <?php foreach ($books as $index => $book): ?>
            <div class="card mb-3">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="<?= htmlspecialchars($book->image) ?>" class="img-thumbnail" style="width: 100px;" alt="<?= htmlspecialchars($book->title) ?>">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($book->title) ?></h5>
                            <p class="card-text">Price: <?= htmlspecialchars($book->price) ?> OMR</p>
                            <input type="number" class="form-control" name="book<?= $index ?>" min="0" max="10" value="0">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Calculate Total</button>
        </div>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?= renderTable($resultRows) ?>
        <?php if ($totalBooks > 5): ?>
            <div class="alert alert-success text-center mt-3">
                You received a 10% discount for buying more than 5 books!
            </div>
        <?php endif; ?>
        <div class="text-center mt-4">
            <h3>Total: <?= number_format($total, 2) ?> OMR</h3>
        </div>
    <?php endif; ?>
</main>

<footer class="bg-light py-5 mt-5 text-dark">
    <div class="container text-center">
        <ul class="nav justify-content-center mb-3">
            <li class="nav-item"><a class="nav-link text-info" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link text-info" href="about-us.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link text-info" href="contact-us.php">Contact Us</a></li>
        </ul>
        <div class="justify-content-center mb-3">
            <a href="https://www.instagram.com/youthcenter_om/?theme=dark" class="text-info fs-2 me-3"><i class="bi bi-instagram"></i></a>
            <a href="https://x.com/youthcenter_om?lang=en" class="text-info fs-2 me-3"><i class="bi bi-twitter"></i></a>
        </div>
        <div class="mb-3">
            <p class="text-info">You can reach us at: <a class="text-info" href="mailto:SmartMeet@gmail.com">SmartMeet@gmail.com</a></p>
            <p class="text-info">&copy; 2025 SmartMeet. All Rights Reserved.</p>
        </div>
    </div>
</footer>
</body>
</html>
