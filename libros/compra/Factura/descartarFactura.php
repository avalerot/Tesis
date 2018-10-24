<?php 
session_start();
$anotrabajo=$_GET['anotrabajo'];
$mestrabajo=$_GET['mestrabajo'];
$Rutempre=$_GET['Rutempre'];
unset($_SESSION['arraySecuen']);
  echo '<script> window.location="Form_FacturasDts.php?Rutempre='.$Rutempre.'&anotrabajo='.$anotrabajo.'&mestrabajo='.$mestrabajo.'"</script>';

?>