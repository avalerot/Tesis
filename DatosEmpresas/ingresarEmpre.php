
<link rel="stylesheet" href="../recursos/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="../recursos/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="../recursos/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script>


  

   
    function getDV(numero) {
        if( numero.length == 0 ||numero.length > 9 || numero.length < 6) {
                    document.getElementById("aviso").innerHTML = "El RUT ingresado es invalido  ";
                   // document.getElementById("boton").innerHTML = "";
                    document.getElementsByName("cd")[0].value ='';
                       return false;
                }else{
                  document.getElementById("aviso").innerHTML = " ";
                 // document.getElementById("boton").innerHTML = "<button type='submit' class='btn btn-success'>Ingresar</button>";
                }

                nuevo_numero = numero.toString().split("").reverse().join("");
                for(i=0,j=2,suma=0; i < nuevo_numero.length; i++, ((j==7) ? j=2 : j++)) {
                    suma += (parseInt(nuevo_numero.charAt(i)) * j); 
                }
                n_dv = 11 - (suma % 11);
       
                var dv=((n_dv == 11) ? 0 : ((n_dv == 10) ? "K" : n_dv));
                 document.getElementsByName("cd")[0].value = dv;
                return ((n_dv == 11) ? 0 : ((n_dv == 10) ? "K" : n_dv));
            }
            

   function solonumeros(e){
  Key=e.KeyCode || e.which;
  teclado=String.fromCharCode(Key).toLowerCase();
  Letras="0123456789";
  especiales="8-37-38-46-164";
  teclado_especial=false;
  for(var i in especiales){
    if(Key==especiales[i])
        {
      teclado_especial=true;break;
      }
    
    }
    if (Letras.indexOf(teclado)==-1 && !teclado_especial){
      return false;
      
      }
  
  }


function sololetras(e){
  Key=e.KeyCode || e.which;
  teclado=String.fromCharCode(Key).toLowerCase();
  Letras="áéíóúüabcde fghijklmnñopqrstuvwxyz";
  especiales="8-37-38-46-164";
  teclado_especial=false;
  for(var i in especiales){
    if(Key==especiales[i])
        {
      teclado_especial=true;break;
      }
    
    }
    if (Letras.indexOf(teclado)==-1 && !teclado_especial){
      return false;
      
      }
  
  }


function sololetrasmail(e){
  Key=e.KeyCode || e.which;
  teclado=String.fromCharCode(Key).toLowerCase();
  Letras="áéíóúüabcdeQWERTYUIOPASDFGHJKLÑZXCVBNM.-_@/&:;fghijklmnñopqrstuvwxyz123456789";
  especiales="8-37-38-46-164";
  teclado_especial=false;
  for(var i in especiales){
    if(Key==especiales[i])
        {
      teclado_especial=true;break;
      }
    
    }
    if (Letras.indexOf(teclado)==-1 && !teclado_especial){
      return false;
      
      }
  
  }


  
    </script>

    <script>
      

function load(strp)
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","provincia.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("qp="+strp );

}



function getComuna(comuna){
  document.getElementsByName("comu")[0].value =comuna;
}




    </script>
<script>
function loadc(str)
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDivc").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","comuna.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+str );

}

    </script>
<?php 

include '../conection.php';
$regiones = $mysqli->query("Select region_numero,region_numero_romano, nombre_region FROM regiones
         ORDER BY region_numero ASC");

?>


<center>
<p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Ingreso de empresa</p></center>

<div class="container">
<div style="background-color: #F2F2F2; border-radius: 10px 10px 10px 10px"  class="row">
<div style="padding: 0px 0px 2px 0px" class="panel panel-default">
<center>
<div style="height: 30px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b> Datos de la empresa</b></h5>
 </p>
   <p style="padding: 0px 0px 0px 10px; margin: 0px 0px 5px 0px" class="bg-danger" id="aviso"> </p>
  </div>
  </center>
<form  method='post' action="subirEmpresa.php" >
			
  </div>
<p><div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><label>Nombre</label><input class="form-control" type="text" name="nombreEmp" onkeypress='return sololetras(event)' required/></div></p>

<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><p><label>Rut</label>  
<input type="text" class="form-control" size="8"  onkeypress='return solonumeros(event)'   onblur="getDV(this.value)" maxlength="8" autocomplete="off" name="Rut" id="Rut"  required/> 
</div>

<div id="input" class="col-xs-12 col-sm-12 col-md-2 col-lg-2"><p><label>Verificador</label>
<input class="form-control" name="cd" id="cd" type="text"  readonly required/>

</div>

<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><label>Región</label>
<select onchange="load(this.value)" class="form-control" name="region" required/>
  <option value=""> </option>
      <?php while($rowr = $regiones ->fetch_array()){?>
      <option value="<?php echo"$rowr[0]" ?>">     <?php echo utf8_encode($rowr[2])  ?> </option>

      <?php } ?>
</select>

</div>
<div style="height: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>




<div id="myDiv" class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
<div id="myDivc" class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
<input type="hidden" name="comu" id="comu">
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><label>Calle</label><input class="form-control" type="" name="calle" required=""></div>
<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"><label>Número dirección</label><input class="form-control" type="number" maxlength="5" name="numeroDirec"></div>
<div style="height: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><label>Mail</label><input  onkeypress='return sololetrasmail(event)' class="form-control"  type="email" maxlength="43" size="43" name="mail" placeholder="Obligatorio" required></div>
<p><div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><label>Número celular</label><input size="9" onkeypress='return solonumeros(event)' class="form-control" maxlength="9" type="text" name="ncel" placeholder="Obligatorio" required></div></p>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><LABEL>Número fijo</LABEL><input size="7" onkeypress='return solonumeros(event)' maxlength="7" class="form-control" type="text" name="nfij" placeholder="Opcional"></div>
<div style="height: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
</div>



<!-- ------------------------------------------------------------------------------------------------------------------- -->
<div style="height: 30px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
<div style="background-color: #F2F2F2; border-radius: 10px 10px 10px 10px"  class="row">
<div style="padding: 0px 0px 2px 0px" class="panel panel-default">
<center>
<div style="height: 30px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b> Centro de costos de la empresa</b></h5>
  </div>
  </center>
  </div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><label>Centro de costos 1</label><input class="form-control" type="text" name="cc1" placeholder="Obligatorio" required></div>
<p><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><label>Centro de costos 2</label><input class="form-control" type="text" name="cc2" placeholder="Opcional"></div></p>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><LABEL>Centro de costos 3</LABEL><input class="form-control" type="text" name="cc3" placeholder="Opcional"></div>

<div style="height: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
</div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<div style="height: 30px" class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
<div style="background-color: #F2F2F2; border-radius: 10px 10px 10px 10px"  class="row">
<div style="padding: 0px 0px 2px 0px" class="panel panel-default">
<center>
<div style="height: 30px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Cuentas corrientes (auxiliar)</b></h5>
  </div>
  </center>
  </div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><label>Cuenta auxiliar 1</label><input class="form-control" type="number" name="ca1" placeholder="Obligatorio" required></div>
<p><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><label>cuenta auxiliar 2</label><input class="form-control" type="number" name="ca2" placeholder="Opcional"></div></p>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><LABEL>cuenta auxiliar 3</LABEL><input class="form-control" type="number" name="ca3" placeholder="Opcional"></div>

<div style="height: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
</div>
</div>




<!-- -------------------------------------------------SOLO SEPARACIÓN------------------------------------------------------------------ -->
<div style="height: 30px" class="hidden-xs hidden-sm col-md-2 col-lg-2"></div>
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
<div style=" border-radius: 10px 10px 10px 10px; padding: 10px 0px 0px 0px"  class="row">
  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"><label></label></div>
<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
</div>
</div>



<!-- ------------------------------------------------------------------------------------------------------------------- -->



<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
<div  class="col-xs-12 col-sm-12 col-md-7 col-lg-7"></div>
<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
<div style="background-color: #F2F2F2; border-radius: 10px 10px 10px 10px; padding: 10px 0px 0px 0px"  class="row">

  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"><label></label></div>
<div id="boton" class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><button type='submit' class='btn btn-success'>Ingresar</button></div>
<div style="height: 10px" class="col-xs-12 col-sm-12 hidden-md hidden-lg"></div>
</form>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a href="../UserContador/index.php" class="btn btn-danger">Cancelar</a></div>


<div style="height: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
</div>
</div>


</div>

