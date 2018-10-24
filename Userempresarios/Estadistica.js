$(datos());

 function datos (consulta,rueEmpr) { 
   var ruetempresaa = $('.ruetempresaa').val();
         $.ajax({
         	type:'POST',
         	url:'MostrarEstadis.php',
         	dataType: 'html',
         	data:{ccelegida:consulta
                ,rueEmpr:rueEmpr}
                  })
                        .done(function(respuesta){
                        $("#estadist").html(respuesta)

                        })
                       .fail(function(){
                       ("#estadist").html("NO SE PUDO ENVIAR")
                       })
    }


 $('#ChoseCC').change(function () { 
      var idcc = $(this).val();
      var emp =document.getElementById("ruetempresaa").value ;
      datos(idcc,emp)
 })


