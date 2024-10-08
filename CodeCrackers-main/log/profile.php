<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CODECRACKERS</title>
  <link rel="icon" href="img/title-logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <link rel="stylesheet" href="cssprofile.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.html">CODECRACKERS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="container" >
        <img src="profile-logo.png" style="height:35px; width:35px; ">
          <?php
            session_start();
            if(isset($_SESSION['email'])) { 
                echo $_SESSION['email'];
            } 
          ?>
        </div>
        <a href="logout.php"><button class="btn btn-outline-success mx-3"
            style="background-color:#0047AB;color:#ffffff;width:1" type="submit"> Logout </button></a>
      </div>
    </div>
  </nav>

  <div style="text-align:center;"><h3>My Tutorial Progress</h3></div>
  <div class="cards-container">
      <div class="card">
        <div class="card-title">Python Tutorial</div>
        <div class="card-progress">
          <div class="progress-bar" id="python-progress"></div>
          <div class="progress-percentage" id="python-percentage">75%</div>
        </div>
      </div>
      <div class="card">
        <div class="card-title">HTML Tutorial</div>
        <div class="card-progress">
          <div class="progress-bar" id="html-progress"></div>
          <div class="progress-percentage" id="html-percentage">50%</div>
        </div>
      </div>
      <div class="card">
        <div class="card-title">CSS Tutorial</div>
        <div class="card-progress">
          <div class="progress-bar" id="css-progress"></div>
          <div class="progress-percentage" id="css-percentage">25%</div>
        </div>
      </div>
      <div class="card">
        <div class="card-title">JavaScript Tutorial</div>
        <div class="card-progress">
          <div class="progress-bar" id="javascript-progress"></div>
          <div class="progress-percentage" id="javascript-percentage">10%</div>
        </div>
      </div>
      <div class="card">
        <div class="card-title">SQL Tutorial</div>
        <div class="card-progress">
          <div class="progress-bar" id="sql-progress"></div>
          <div class="progress-percentage" id="sql-percentage">5%</div>
        </div>
      </div>
      <div class="card">
        <div class="card-title">PHP Tutorial</div>
        <div class="card-progress">
          <div class="progress-bar" id="php-progress"></div>
          <div class="progress-percentage" id="php-percentage">0%</div>
        </div>
      </div>
    </div>

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
        CodeCrackers
      </div>
      <!-- Copyright -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
    <script>
        function updateProgress() {
            fetch('progress.php')
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error(data.error);
                        return;
                    }
                    document.getElementById('python-progress').style.width = data.python + '%';
                    document.getElementById('python-percentage').innerText = data.python + '%';
                    
                    document.getElementById('html-progress').style.width = data.html + '%';
                    document.getElementById('html-percentage').innerText = data.html + '%';
                    
                    document.getElementById('css-progress').style.width = data.css + '%';
                    document.getElementById('css-percentage').innerText = data.css + '%';
                    
                    document.getElementById('javascript-progress').style.width = data.javascript + '%';
                    document.getElementById('javascript-percentage').innerText = data.javascript + '%';
                    
                    document.getElementById('sql-progress').style.width = data.sql + '%';
                    document.getElementById('sql-percentage').innerText = data.sql + '%';
                    
                    document.getElementById('php-progress').style.width = data.php + '%';
                    document.getElementById('php-percentage').innerText = data.php + '%';
                })
                .catch(error => console.error('Error fetching progress data:', error));
        }

        setInterval(updateProgress, 10000); // Update every 10 seconds
        updateProgress(); // Initial update
    </script>
</body>

</html>
