<!DOCTYPE html>
<html>
<head>
  <title>Smart Meet - Book Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid p-3">
      <a href="#" class="navbar-brand">
        <img src="smartmeet transparent bg.PNG" alt="Logo" width="auto" height="110px">
      </a>
      <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseContent"
        class="navbar-toggler" aria-controls="navbarCollapseContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapseContent">
        <ul class="navbar-nav gap-3 fs-5 text-info ms-auto">
          <li class="nav-item"><a class="nav-link text-info link-primary" href="index.php">Home Page</a></li>
          <li class="nav-item"><a class="nav-link text-info link-primary" href="about-us.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link text-info link-primary" href="room-booking.php">Room Booking</a></li>
          <li class="nav-item"><a class="nav-link text-primary active" href="book-shop.php">Book Shop</a></li>
          <li class="nav-item"><a class="nav-link text-info link-primary" href="calculate.php">Calculate</a></li>
          <li class="nav-item"><a class="nav-link text-info link-primary" href="collaboration.php">Collaboration</a></li>
          <li class="nav-item"><a class="nav-link text-info link-primary" href="questionnaire.php">Questionnaire</a></li>
          <li class="nav-item"><a class="nav-link text-info link-primary" href="tips.php">Tips</a></li>
          <li class="nav-item"><a class="nav-link text-info link-primary" href="contact-us.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link text-info link-primary" href="funpage.php">Fun</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<main class="container py-5">
  <h1 class="text-center mb-4">Book Shop 📚</h1>
  <form id="bookForm" class="needs-validation" novalidate>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div id="book-list" class="d-grid gap-4">
          <?php
          // Book class
          class Book {
              public $title, $price, $image, $description;
              public function __construct($title, $price, $image, $description) {
                  $this->title = $title;
                  $this->price = $price;
                  $this->image = $image;
                  $this->description = $description;
              }
          }

          // Array of books
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

          // Function to display books
          function displayBooks($books) {
              foreach ($books as $book) {
                  echo '<div class="card mb-3 p-3">';
                  echo '  <div class="text-center">';
                  echo '    <img src="' . htmlspecialchars($book->image) . '" class="img-thumbnail mb-2" style="width: 120px;">';
                  echo '    <p class="h6">' . htmlspecialchars($book->title) . '</p>';
                  echo '    <p>Price: ' . htmlspecialchars($book->price) . ' OMR</p>';
                  echo '    <p>' . htmlspecialchars($book->description) . '</p>';
                  echo '  </div>';
                  echo '</div>';
              }
          }

          // Display books
          displayBooks($books);
          ?>
        </div>
      </div>
    </div>
  </form>
  <div class="text-center mt-4">
    <a href="calculate.html" class="btn btn-success">Go to Bill Calculator</a>
  </div>
</main>

<footer class="bg-light py-5 mt-5 text-dark">
  <div class="container text-center">
    <div>
      <ul class="nav justify-content-center mb-3">
        <li class="nav-item"><a class="nav-link text-info" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-info" href="about-us.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link text-info" href="contact-us.php">Contact Us</a></li>
      </ul>
    </div>
    <div class="justify-content-center mb-3">
      <a href="https://www.instagram.com/youthcenter_om/?theme=dark" class="text-info fs-2 me-3"><i class="bi bi-instagram"></i></a>
      <a href="https://x.com/youthcenter_om?lang=en" class="text-info fs-2 me-3"><i class="bi bi-twitter"></i></a>
    </div>
    <div class="mb-3"> 
      <p class="text-info">You can reach us at: <a class="text-info" href="mailto:SmartMeet@gmail.com">SmartMeet@gmail.com</a></p>
      <br>
      <p class="text-info">&copy; 2025 SmartMeet. All Rights Reserved.</p>
    </div>
  </div>
</footer>

</body>
</html>
