<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Poliklinik</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sistem Informasi Poliklinik</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">Data Master</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?page=dokter">Dokter</a></li>
            <li><a class="dropdown-item" href="index.php?page=pasien">Pasien</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=periksa">Periksa</a>
        </li>
      </ul>
      
      <!-- Menambahkan tombol Login dan Register di sebelah kanan navbar -->
      <ul class="navbar-nav ml-auto">
        <?php
        session_start();
        if (isset($_SESSION['login'])) {
            echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
        } else {
            echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="registrasiUser.php">Register</a></li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>

<main role="main" class="container mt-4">
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        echo "<h2>" . ucwords($page) . "</h2>";
        include($page . ".php");
    } else {
        echo "<h2>Selamat Datang di Sistem Informasi Poliklinik</h2>";
    }
    ?>
</main>

</body>
</html>
