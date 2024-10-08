<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EDUQUEST</title>
  <link rel="icon" href="img/title-logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <link rel="stylesheet" href="cssquiz.css">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            let userId = urlParams.get('user_id');
            
            if (userId) {
                localStorage.setItem('userId', userId);
            } else {
                userId = localStorage.getItem('userId');
            }
        });
  </script>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">EDUQUEST</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Tutorial\index2.html">Tutorial</a>
        </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tutorial
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="Tutorial\python.html">PYTHON</a></li>
              <li><a class="dropdown-item" href="Tutorial\html1.html">HTML</a></li>
              <li><a class="dropdown-item" href="Tutorial\css.html">CSS</a></li>
              <li><a class="dropdown-item" href="Tutorial\js.html">JAVASCRIPT</a></li>
              <li><a class="dropdown-item" href="Tutorial\sql.html">SQL</a></li>
              <li><a class="dropdown-item" href="Tutorial\php.html">PHP</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Online Compiler
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="ide\python\python\python.html">PYTHON</a></li>
              <li><a class="dropdown-item" href="ide\js\js\js.html">JAVASCRIPT</a></li>
              <li><a class="dropdown-item" href="ide\php\pHP\php.html">PHP</a></li>
              <li><a class="dropdown-item" href="ide\sql\sql\sql.html">SQL</a></li>
              <li><a class="dropdown-item" href="ide\html\html\html1.html">HTML</a></li>
              <li><a class="dropdown-item" href="ide\css\css\css.html">CSS</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="quiz.html" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Quiz
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="quiz/py.html">PYTHON QUIZ</a></li>
              <li><a class="dropdown-item" href="quiz/html.html">HTML QUIZ</a></li>
              <li><a class="dropdown-item" href="quiz/css.html">CSS QUIZ</a></li>
              <li><a class="dropdown-item" href="quiz/js.html">JS QUIZ</a></li>
              <li><a class="dropdown-item" href="quiz/sql.html">SQL QUIZ</a></li>
              <li><a class="dropdown-item" href="quiz/php.html">PHP QUIZ</a></li>
            </ul>
          </li>
        </ul>
        <!-- <button class="btn btn-outline-success mx-3" type="submit"> Profile </button> -->
        <!-- <a href="log/index.php"><button class="btn btn-outline-success mx-3"
            style="background-color:#0047AB;color:#ffffff;width:1" type="submit"> SignIn </button></a> -->
            
        <?php
            if(isset($_SESSION['email'])) { // check if user is logged in
                // display logout button
                echo '<a href="log/profile.php"><button class="btn btn-outline-success mx-3"
                style="background-color:#0047AB;color:#ffffff;width:1" type="submit"> Profile </button></a>';

                echo '<a href="log/logout.php"><button class="btn btn-outline-success mx-3"
                style="background-color:#0047AB;color:#ffffff;width:1" type="submit"> Logout </button></a>';
            } else {
                // display login button
                echo '<a href="log/index.php"><button class="btn btn-outline-success mx-3"
                style="background-color:#0047AB;color:#ffffff;width:1" type="submit"> SignIn </button></a>';
            }
        ?>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="container">
      <h1 class="mx-3 my-3" style="text-align: center;">Courses we offer</h1><br><br>
      <div class="row">
        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card" style="width:100%;"> 
            <img src="src/python.jpg" class="card-img-top" alt="Card Image">
            <div class="card-body d-flex flex-column">
              <a href="Tutorial\python.html" class="btn btn-primary mt-auto align-self-start" style="margin: auto;" >Learn PYTHON</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card" style="width:100%;"> 
            <img src="src/sql.jpg" class="card-img-top" alt="Card Image">
            <div class="card-body d-flex flex-column">
              <a href="Tutorial/sql.html" class="btn btn-primary mt-auto align-self-start" style="margin: auto;">Learn SQL</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card" style="width:100%;"> 
            <img src="src/php.png" class="card-img-top" alt="Card Image">
            <div class="card-body d-flex flex-column">
              <a href="Tutorial/php.html" class="btn btn-primary mt-auto align-self-start" style="margin: auto;">Learn PHP</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card" style="width:100%;"> 
            <img src="src/html.jpg" class="card-img-top" alt="Card Image">
            <div class="card-body d-flex flex-column">
              <a href="Tutorial/html1.html" class="btn btn-primary mt-auto align-self-start" style="margin: auto;">Learn HTML</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card" style="width:100%;"> 
            <img src="src/css.jpg" class="card-img-top" alt="Card Image">
            <div class="card-body d-flex flex-column">
              <a href="Tutorial/css.html" class="btn btn-primary mt-auto align-self-start" style="margin: auto;">Learn CSS</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card" style="width:100%;"> 
            <img src="src/js.png" class="card-img-top" alt="Card Image">
            <div class="card-body d-flex flex-column">
              <a href="Tutorial/js.html" class="btn btn-primary mt-auto align-self-start" style="margin: auto;">Learn JS</a>
            </div>
          </div>
        </div>
      </div>
    </div> <br>

    <h1 class="mx-2 my-2" style="text-align: center;">Online Compiler</h1><br><br>
    <a href="ide\python\python\python.html"><img style="width: 100%;" src="src/ide.png"></a> <br><br>

    <h1 class="mx-2 my-2" style="text-align: center; ">Hint System</h1>
    <h5 class="mx-2 my-2" style="text-align: center; ">Help to tackle the errors</h5> <br>
    <a href="ide\hint\index.html"><img style="width: 100%;" src="src/hint.png"></a>

    <h1 class="mx-3 my-3" style="text-align: center;">Practice Your Skills </h1><br><br>
    <div class="quiz-grid">
      <div class="quiz-block">
        <i class="fab fa-python quiz-icon python-icon"></i>
        <a href="quiz/py.html"><h2>Python Quiz</h2></a>
        <p>Test your knowledge of Python with our quiz!</p>
      </div>
      <div class="quiz-block">
        <i class="fas fa-database quiz-icon sql-icon"></i>
        <a href="quiz/sql.html"><h2>SQL Quiz</h2></a>
        <p>Test your knowledge of SQL with our quiz!</p>
      </div>
      <div class="quiz-block">
        <i class="fas fa-code quiz-icon html-icon"></i>
        <a href="quiz/html.html"><h2>HTML Quiz</h2></a>
        <p>Test your knowledge of HTML with our quiz!</p>
      </div>
      <div class="quiz-block">
        <i class="fas fa-code quiz-icon html-icon"></i>
        <a href="quiz/css.html"><h2>CSS Quiz</h2></a>
        <p>Test your knowledge of CSS with our quiz!</p>
      </div>
      <div class="quiz-block">
        <i class="fas fa-code quiz-icon html-icon"></i>
        <a href="quiz/js.html"><h2>JavaScipt Quiz</h2></a>
        <p>Test your knowledge of JavaScript with our quiz!</p>
      </div>
      <div class="quiz-block">
        <i class="fas fa-code quiz-icon html-icon"></i>
        <a href="quiz/php.html"><h2>PHP Quiz</h2></a>
        <p>Test your knowledge of PHP with our quiz!</p>
      </div>
    </div>
  </div>

  <!-- Remove the container if you want to extend the Footer to full width. -->
  <div style="margin-top: 2%;">
    <footer class="bg-dark text-center text-white">
      <!-- Grid container -->
      <div class="container p-4 pb-0">
        <!-- Section: Form -->
        <section class="">
          <div class="row d-flex justify-content-center">
            <!--Grid column-->
            <div class="col-auto">
              <p><strong>About | FAQ | Help </strong></p>
              <p class="pt-2">
                On CodesCrackers.com, you can find free scholastic resources. Although we do our best to
                ensure the accuracy and completeness of our tutorials, articles, examples, and tests, we cannot
                guarantee that they are error-free. Use of this site constitutes acceptance of our terms of use and
                privacy policy.
              </p>
        </section>
        <!-- Section: Form -->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">All Rights Reserved</a><br>
        Eduquest
      </div>
      <!-- Copyright -->
    </footer>
    <!-- End of .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
</body>
</html>
