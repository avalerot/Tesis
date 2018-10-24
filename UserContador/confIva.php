
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
  function confi(){
    if(confirm('¿Seguro que quieres modificar el porcentaje del IVA?')){ 
          return true;
      }
      return false;
  }
  
</script>
<?php 
include '../conection.php';
$ivaAct = $mysqli->query("SELECT porcentaje FROM iva where estado='1' ");
$iva = mysqli_fetch_array($ivaAct, MYSQLI_NUM);
$iva=$iva[0];
?>
</head>
<body>
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <center>  <h4 class="modal-title">Actualización de iva</h4></center> 
      <center>  <h4 class="modal-title"><b>Iva actual: <?php echo$iva?>% </b></h4></center> 
      </div>
      <div class="modal-body">

<div class="row">


<form onsubmit='return confi()' method="post" action="actuIva.php">
  <div class="hidden-xs hidden-sm col-lg-3 col-md-3"></div>
  <div class="col-xs-12 col-sm-12 col-lg-4 col-md-4">
    <label>Nuevo iva</label><input class="form-control" maxlength="2" type="number" name="iva" required>
  </div>
  <div style="padding: 25px 0px 0px 0px" class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
  <label></label>
    <button class="btn btn-primary" type="submit">Actualizar</button>
  </div>

</form>

    <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 ">


    <!-- --------------------------------------------------- -->



   


</div>

<div class="col-md-2 col-xs-1 col-lg-2 col-sm-1" ></div>


</center>
</div>
</div>

      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->



</body>
</html>

  