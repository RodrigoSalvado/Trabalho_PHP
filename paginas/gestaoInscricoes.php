<?php
global $conn;
include "../basedados/basedados.h";
include "ConstUtilizadores.php";

session_start();

$user = $_SESSION["user"];
$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador == CLIENTE || empty($tipoUtilizador)){
    echo "<script>window.alert('Nao tem autorização para entrar aqui') ; window.location.href = 'paginaPrincipal.php';</script>";
}

?>


    <!DOCTYPE html>
    <html>

    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="favicon.png" type="">

        <title> Finexo </title>

        <!-- bootstrap core css -->
        <link rel="stylesheet" type="text/css" href="bootstrap.css" />

        <!-- fonts style -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

        <!--owl slider stylesheet -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

        <!-- font awesome style -->
        <link href="font-awesome.min.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="style.css" rel="stylesheet" />
        <!-- responsive style -->
        <link href="responsive.css" rel="stylesheet" />

    </head>

    <body class="sub_page">

    <div class="hero_area">

        <div class="hero_bg_box">
            <div class="bg_img_box">
                <img src="hero-bg.png" alt="">
            </div>
        </div>

        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="paginaPrincipal.php">
            <span>
              Crypto Academy
            </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ">
                            <li class="nav-item active">
                                <a class="nav-link" href="paginaPrincipal.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html"> About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cursos.php">Cursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="why.html">Why Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="team.html">Team</a>
                            </li>

                            <?php
                            if(isset($_SESSION["user"])){
                                echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="perfil.php">Perfil-'.$_SESSION["user"].'</a>
                                </li>
                             ';
                            }
                            ?>

                            <li class="nav-item">
                                <?php
                                if(isset($_SESSION["user"])){
                                    echo '<a class="nav-link" href="logout.php"> <i class="fa fa-user" aria-hidden="true"></i> Logout</a>';
                                }else{
                                    echo '<a class="nav-link" href="login.html"> <i class="fa fa-user" aria-hidden="true"></i> Login</a>';
                                }
                                ?>
                            </li>
                            <form class="form-inline">
                                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>


    <!-- service section -->


    <div class="heading_container heading_center" style="margin-top: 80px">
        <h2>
            Gestão de Inscrições <span></span>
        </h2>
        <div class="container">
            <table class="table table-primary table-sortable" role="grid">
                    <?php

                    switch($tipoUtilizador){
                        case ADMINISTRADOR:
                            echo '
                            <thead>
                                <tr>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Curso</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Utilizador</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Estado</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Aceitar</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Recusar</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Expulsar</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <div class="botoes_gest">';

                            $sql = "SELECT u.username, uc.id_utilizador, uc.curso, uc.aceite
                                    FROM utilizador u
                                    JOIN util_curso uc ON u.id_utilizador = uc.id_utilizador";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $curso = $row["curso"];
                                    $id_aluno = $row["id_utilizador"];
                                    $username = $row["username"];
                                    $aceite = $row["aceite"];
                                    $estado = ($aceite == 1)? "Aceite" : "Por aceitar";

                                    if($aceite == 0){
                                        echo "
                                                <tr>
                                                    <td class='text-center'>$curso</td>
                                                    <td class='text-center'>$username</td>
                                                    <td class='text-center'>$estado</td>
                                                    <td class='text-center'><a href='validarInscricao.php?id=" . $id_aluno . "&validar=1&curso=".$curso."'><button>Aceitar</button></a></td>
                                                    <td class='text-center'><a href='validarInscricao.php?id=" . $id_aluno . "&curso=".$curso."'><button>Recusar</button></a></td>
                                                    <td class='text-center'>/</td>
                                                </tr>";
                                    }else{
                                        echo "
                                                    <tr>
                                                        <td class='text-center'>$curso</td>
                                                        <td class='text-center'>$username</td>
                                                        <td class='text-center'>$estado</td>
                                                        <td class='text-center'>/</td>
                                                        <td class='text-center'>/</td>
                                                        <td class='text-center'><a href='validarInscricao.php?id=" . $id_aluno . "&curso=".$curso."'><button>Expulsar</button></a></td>
                                                    </tr>";
                                    }
                                }
                            }

                            break;

                        case DOCENTE:

                            echo '
                            <thead>
                                <tr>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Curso</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Utilizador</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Estado</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Aceitar</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Recusar</span></th> 
                                    <th class="text-center header" scope="col" role="columnheader"><span>Expulsar</span></th>                                
                                </tr>
                            </thead>
                            <tbody>
                            <div class="botoes_gest">';

                            $sql = "SELECT id_utilizador, curso, aceite
                                    FROM util_curso 
                                    WHERE docente = '$user'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $curso = $row["curso"];
                                    $id_aluno = $row["id_utilizador"];
                                    $aceite = $row["aceite"];

                                    $estado = ($row["aceite"] == 1)? "Aceite" : "Por aceitar";

                                    $sqlAluno = "SELECT username FROM utilizador WHERE id_utilizador = $id_aluno";
                                    $resultAluno = mysqli_query($conn, $sqlAluno);

                                    if(mysqli_num_rows($resultAluno)>0){
                                        while($rowUser = mysqli_fetch_assoc($resultAluno)){
                                            $username = $rowUser["username"];

                                            if($aceite == 0){
                                                echo "
                                                <tr>
                                                    <td class='text-center'>$curso</td>
                                                    <td class='text-center'>$username</td>
                                                    <td class='text-center'>$estado</td>
                                                    <td class='text-center'><a href='validarInscricao.php?id=" . $id_aluno . "&validar=1&curso=".$curso."'><button>Aceitar</button></a></td>
                                                    <td class='text-center'><a href='validarInscricao.php?id=" . $id_aluno . "&curso=".$curso."'><button>Recusar</button></a></td>
                                                    <td class='text-center'>/</td>
                                                </tr>";
                                            }else{
                                                echo "
                                                    <tr>
                                                        <td class='text-center'>$curso</td>
                                                        <td class='text-center'>$username</td>
                                                        <td class='text-center'>$estado</td>
                                                        <td class='text-center'>/</td>
                                                        <td class='text-center'>/</td>
                                                        <td class='text-center'><a href='validarInscricao.php?id=" . $id_aluno . "&curso=".$curso."'><button>Expulsar</button></a></td>
                                                    </tr>";
                                            }


                                        }
                                    }

                                }
                            }


                            break;

                        case ALUNO:

                            echo '
                            <thead>
                                <tr>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Curso</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Estado</span></th>
                                    <th class="text-center header" scope="col" role="columnheader"><span>Desistir</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <div class="botoes_gest">';

                            $sql = "SELECT uc.curso, uc.aceite, u.id_utilizador
                                    FROM util_curso uc
                                    JOIN utilizador u ON uc.id_utilizador = u.id_utilizador
                                    WHERE u.username = '$user';
  ";

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                  $curso = $row["curso"];
                                  $aceite = $row["aceite"];
                                  $estado = ($aceite == 1)? "Aceite" : "Por aceitar";
                                  $id = $row["id_utilizador"];

                                  if($aceite == 0){
                                      echo "
                                        <tr>
                                            <td class='text-center'>$curso</td>
                                            <td class='text-center'>$estado</td>
                                            <td class='text-center'>/</td>
                                        </tr>";
                                  }else{
                                      echo "
                                        <tr>
                                            <td class='text-center'>$curso</td>
                                            <td class='text-center'>$estado</td>
                                            <td class='text-center'><a href='validarInscricao.php?id=" . $id . "&curso=".$curso."'><button>Desistir</button></a></td>
                                        </tr>";
                                  }
                                }
                            }

                            break;

                        default:
                            echo "Inicie Sessão";
                    }

                    ?>

                </div>
                </tbody>
            </table>
        </div>
    </div>
<br><br><br><br>

    <!-- end service section -->

    <!-- info section -->

    <section class="info_section layout_padding2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 info_col">
                    <div class="info_contact">
                        <h4>
                            Address
                        </h4>
                        <div class="contact_link_box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                  Location
                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                  Call +01 1234567890
                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                  demo@gmail.com
                </span>
                            </a>
                        </div>
                    </div>
                    <div class="info_social">
                        <a href="">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 info_col">
                    <div class="info_detail">
                        <h4>
                            Info
                        </h4>
                        <p>
                            necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 mx-auto info_col">
                    <div class="info_link_box">
                        <h4>
                            Links
                        </h4>
                        <div class="info_links">
                            <a class="active" href="paginaPrincipal.php">
                                Home
                            </a>
                            <a class="" href="about.html">
                                About
                            </a>
                            <a class="" href="cursos.php">
                                Services
                            </a>
                            <a class="" href="why.html">
                                Why Us
                            </a>
                            <a class="" href="team.html">
                                Team
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 info_col ">
                    <h4>
                        Subscribe
                    </h4>
                    <form action="#">
                        <input type="text" placeholder="Enter email" />
                        <button type="submit">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- end info section -->



    <!-- jQery -->
    <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="bootstrap.js"></script>
    <!-- owl slider -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- custom js -->
    <script type="text/javascript" src="custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->

    </body>

    </html>

<?php

mysqli_close($conn);