
<?php
session_start();
if(!isset($_SESSION["session_username1"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username1"]);
?> 
<?php 
$rutE=$_GET['rutE'];
unset($_SESSION['arraySecuen']);
//obtener iva actual
include '../conection.php';
$empresa = $mysqli->query("SELECT RutEmpre FROM Usuarios where Nomuser='$usr' ");
$Empre = mysqli_fetch_array($empresa, MYSQLI_NUM);
$Empres=$Empre[0];
$ivaAct = $mysqli->query("SELECT porcentaje FROM iva where estado='1' ");
$iva = mysqli_fetch_array($ivaAct, MYSQLI_NUM);
$iva=$iva[0];
$ccCostos = $mysqli->query("SELECT nombre, idCentroCostos FROM centrocostos WHERE rutEmpresa='$Empres' and Estado=1");
$Rutempre=$_GET['rutE'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User - Empresario</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
            function modal(div,url){
$.post(
    url,
function(resp){

    $("#"+div+"").html(resp);
}

    );

    }


    </script>


</head>

<body>
 <!-- Modal -->


    <div id="wrapper">
  
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Empresarios</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
    
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo$usr?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-repeat"></i> Cambiar Contraseña</a>
                        </li>
                       
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="#"><i class="fa fa-fw fa-dashboard"></i> inicio</a>
                    </li>
                    <li>
                        <a href="opciones.php?rut=<?php echo $rutE ?>"><i class="fa fa-bars"></i> Opciones</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div style="height: 1000px" class="container-fluid">

                <!-- Page Heading -->
                <div  class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Bienvenido 
                        </h1>  
                    </div>
                </div>
                <!-- /.row -->
                <div  class="row">
                    <div  class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Visita al SII</strong>  <a href="http://www.sii.cl" class="alert-link" target="blank">Presionando aquí</a> 
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                                <div class="row">
                                <label>Centro de costos</label>
                                <select class="form-control" id="ChoseCC" placeholder="Elige centro de costos"> 
                                <option>Elige centro de costos</option>
                                     <?php
                                        while($row = $ccCostos -> fetch_array()){

                                        echo "<option value='".$cc=$row[1]."' >".$cc=$row[0]."</option>";         
                                         } 
                                     ?>
                                </select>
                                        <input value='<?php echo $Rutempre ?>' id='ruetempresaa' type='hidden'  name='ruetempresaa'/> 
                                </div> 
                    </div>
                </div>
              <br>
            <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                             <div id="estadist"></div>
                        </div>
                            
                    </div>
                </div>


                <!-- /.row -->

              
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="Estadistica.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>
    <div class="modal fade" id="myModal" role="dialog">

  </div>
         
</html>
<?php } ?>
