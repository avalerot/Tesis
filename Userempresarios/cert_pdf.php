<?php
include '../conection.php';
$numero_lic=$_GET['num_lic'];


$consulta = $mysqli->query("SELECT M.NombreEmpresa,M.Rut,M.VerificadorEmpresa,O.Nombre_comuna,L.fec_emision,
					L.fec_ini_rep,L.dias_lic,L.fec_ter_lic,L.fec_rec_emp,E.rutEmpleado,E.priNomb,E.segNomb,E.apePat,
					E.apeMat,E.sistSalud,E.sistPrev,E.fecAfil,C.fecIni FROM empresa M JOIN contrato C ON M.idEmpresa=C.idEmpresa
					JOIN empleado E ON C.rutEmpleado=E.rutEmpleado JOIN licencia_medica L ON C.numCont=L.numCont JOIN
					comuna O ON M.comuna_numero=O.comuna_numero WHERE L.id_licencia='$numero_lic'");
					
while($row = $consulta -> fetch_array()){
	$nombreEmpresa=$row[0];
	$rutE=$row[1];
	$rutEmpresa=$row[1]."-".$row[2];
	$comuna=$row[3];
	$fechaEmision=$row[4];
	$inicioReposo=$row[5];
	$diasLicencia=$row[6];
	$terminoLicencia=$row[7];
	$recepcionEmpleador=$row[8];
	$rutEmpleado=$row[9];
	$nombre=$row[10]." ".$row[11];
	$apellido=$row[12]." ".$row[13];
	$salud=$row[14];
	$prevision=$row[15];
	$afiliacion=$row[16];
	$fechaContrato=$row[17];
}
	
	require("../recursos/dompdf/dompdf_config.inc.php");
 $codigo='
		<center>
	<div style=" width:750px; height:500px; border: dashed; ">
	
		<div style=" float: left; width: 360px; height: 60; margin: 5px 0px 0px 5px; padding: 10px 0px 0px 0px; border: solid;" ><b>'.$nombreEmpresa.'</b><br>'.$rutEmpresa.'</div>
		<div style=" float: left; width: 100%; height: 20; margin: 5px 0px 0px 0px; background-color: #E6E6E6" ><b>COMPROBANTE DE ENTREGA DE LICENCIA MEDICA</b></div>
		<div style=" float: left; width: 300px; height: 20; margin: 5px 10px 0px 430px" >'.$comuna.' '.$fechaEmision.'</div>
		<div style=" float: left; width: 100%; height: 25; margin: 10px 0px 0px 0px" >Se deja constancia, que con esta fecha se hace entrega de licencia médica correspondiente a<br><center><b>'.$nombre.' '.$apellido.'</b></center></div>
        <div style=" float: left; width: 360px; height: 75; margin: 10px 0px 0px 5px; padding: 5px 0px 0px 0px; border: solid;" >
        	<b>Rut empleado:</b>'.$rutEmpleado.'<br>
        	<b>Dias de licencia:</b>'.$diasLicencia.'<br>
        	<b>Fecha de inicio:</b>'.$inicioReposo.'<br>
        	<b>Fecha de término:</b>'.$terminoLicencia.'<br>
        	<b>Número de licencia:</b>'.$numero_lic.'<br>
		</div>
		
		<div style="; float: left; width: 360px; height: 60; margin: 10px 0px 0px 5px; padding: 5px 0px 0px 0px; border: solid;" >
 	 		<b>Sistema de salud:</b>'.$salud.'<br>
        	<b>Sistema de prevision:</b>'.$prevision.'<br>
        	<b>Fecha del contrato:</b>'.$fechaContrato.'<br>
        	<b>Fecha de afiliación:</b>'.$afiliacion.'<br>
        </div>
		
         <div style=" float: right; width: 320; height: 40; margin: opx 60px 0px 385px" >_______________________________<br>FIRMA RECEPCION</div>
	</div>
</center>
			';
			
	
$codigo=utf8_decode($codigo);
$dompdf= new DOMPDF();
$dompdf->load_html($codigo);
$dompdf->set_paper ('landscape'); 
$dompdf->render();
  
$dompdf->stream("licencia_"."$Nombre_persona"."_"."$Fecha_Inicio".".pdf");

?>