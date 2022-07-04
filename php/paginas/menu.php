<?php 
  session_start();
?>
<style>
  .rotate {
    animation: rotation 4s infinite linear;
  }

  @keyframes rotation {
    from {
      transform: rotate(0deg);
    }
    to {
      transform: rotate(359deg);
    }
  }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="#"><img class="rotate" src="../../img/home.svg" style="width: 4vw;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <span class="navbar-brand mb-0" aria-current="page"><?php if(isset($_SESSION["nome"])){echo $_SESSION["nome"];}else{echo "Visitante";}?></span>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tabelas
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="quadrado.php">Quadrado <img src="../../img/square.svg"></a></li>
            <li><a class="dropdown-item" href="tabuleiro.php">Tabuleiro <img src="../../img/tabuleiro-de-xadrez.png"></a></li>
            <li><a class="dropdown-item" href="usuario.php">Usuário <img src="../../img/user.svg"></a></li>
            <li><a class="dropdown-item" href="retangulo.php">Retangulo <img src="../../img/rectangle.png"></a></li>
            <li><a class="dropdown-item" href="triangulo.php">Triangulo <img src="../../img/triangle.svg"></a></li>
            <li><a class="dropdown-item" href="circulo.php">Circulo <img src="../../img/circle.svg"></a></li>
            <li><a class="dropdown-item" href="cubo.php">Cubo <img src="../../img/cube.png"></a></li>
            <li><a class="dropdown-item" href="esfera.php">Esfera <img src="../../img/sphere.png"></a></li>
            <li><a class="dropdown-item" href="icosaedro.php">Icosaedro <img src="../../img/icosaedro.png"></a></li>
            <li><a class="dropdown-item" href="icosidodecaedro.php">Icosidodecaedro <img src="../../img/Icosidodecaedro.png"></a></li>
          </ul>
        </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Login
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../paginas/login.php">Login <img src="../../img/log-in.svg"></a></li>
            <li><a class="dropdown-item" href="../paginas/login.php?operation=logout">Logout <img src="../../img/log-out.svg"></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<script src="../../bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>