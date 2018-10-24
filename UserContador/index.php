<?php
session_start();
if(!isset($_SESSION["session_username0"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username0"]);
?>
 
<?php 
unset($_SESSION['arraySecuen']);
//obtener iva actual
include '../conection.php';
$ivaAct = $mysqli->query("SELECT porcentaje FROM iva where estado='1' ");
$iva = mysqli_fetch_array($ivaAct, MYSQLI_NUM);
$iva=$iva[0];
//------------------
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User - Contador</title>
    <script src="../recursos/js/jquery-3.2.1.min.js"></script>
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
                <a class="navbar-brand" href="#">Contadores</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
           
                <li class="dropdown">
                    <a href="javascript:void(0);" onclick="modal('myModal','confIva.php');" class="dropdown-toggle" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-gear">
                        
                    </i> Actualizar % IVA </b></a>
                    
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $usr ?> <b class="caret"></b></a>
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
                        <a href="#åå"><i class="fa fa-fw fa-dashboard"></i> inicio</a>
                    </li>
                    <li>
                        <a href="listaEmpresas.php"><i class="fa fa-bars"></i> Empresas </a>
                    </li>
                     <li>
                        <a href="listaEmpresasdesac.php"><i class="fa fa-bars"></i> Empresas desactivadas </a>
                    </li>
                     <li>
                        <a href="../DatosEmpresas/ingresarEmpre.php"><i class="fa fa-book""></i> Ingresar Empresa</a>
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
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div>
                                        <div>Empresas</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>Registros de hoy</div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>Total ingresado</div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $iva?>%</div>
                                        <div>IVA</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- /.row -->

              
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
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
<?php  } ?>