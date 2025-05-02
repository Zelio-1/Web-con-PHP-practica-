<?php
    include ("db.php");  
    //Para ver la pagina: http://localhost/php/app.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/cyborg/bootstrap.min.css" integrity="sha512-M+Wrv9LTvQe81gFD2ZE3xxPTN5V2n1iLCXsldIxXvfs6tP+6VihBCwCMBkkjkQUZVmEHBsowb9Vqsq1et1teEg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div class ="container">
        <div class ="row">
            <div class = "col12">
                <div class="h1">Catálogo de alumnos</div>
            </div>
        </div>
        <div class= "row">
            <form id ="frmBuscar" name="frmBuscar">
                <div class ="mb-3">
                    <label class="form-label" for="nombre_buscar">Nombres:</label>
                    <input class="form-control" type ="text" id ="nombre_buscar" name="nombre_buscar">
                </div>
                <div class ="mb-3">
                    <button type="button" name="btnBuscar" id="btnBuscar" class="btn btn-success btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                    <button type="button" name="btnNuevo" id="btnNuevo" class="btn btn-warning btn-sm"><i class="fa-solid fa-plus"></i> Nuevo</button>
                </div>
            </form>
        </div>
        
        
        <div class="row">
            <div class = "col12" id = "tablita" name= "tablita">
            <!--Traemos la tabla desde AJAX-->
            </div>
        </div>
        
        
    </div>
    <!--Modal-->
    <div class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="form-add-alumno">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear un Alumno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="nombre" class="control-label">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="apellido_paterno" class="control-label">Apellido Paterno:</label>
                                <input type="text" name="apellido_paterno" id="nombapellido_paternore" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="apellido_materno" class="control-label">Apellido Materno:</label>
                                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onClick="crearAlumno()"><i class="fa-solid fa-floppy-disk"></i> Crear</button>    
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Fin Modal-->

    <script type="text/javascript">
        //Funcion par el renderizado de la pagina (onLoad): 
        $(function (){
            $("#btnBuscar").on("click", function(event){
                buscar()
            })
            //Cuando se cargue la pagina por primera vez se ejecutara la funcion "buscar": 
            //buscar()

            //Interceptar el click en el boton "Nuevo": 
            $("#btnNuevo").on("click", function(event){
                $("#form-add-alumno").modal("show");
            })

        }); 
        function buscar (){
            $.ajax({ // <- Esto es un objeto dentro de una func., por lo que toene llaves 
                //Haciendo una peticion, con un POST: 
                type:"POST", 
                url:"operaciones.php", //Endpoint 
                data:"accion=buscar&"+$("#frmBuscar").serialize(), 
                cache:false, 
                beforeSend: function (){}, 
                success: function (resultado){
                    $("#tablita").html(resultado); //Cuando se ejecute la func., el resukltado lo pegrá en la tablita
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status); 
                    alert(thrownError); 
                }
            })
        }
        
        function crearAlumno() {
            
            if($("#nombre").val()=="") {alert("Por favor ingrese el Nombre");return false;}
            if($("#apellido_paterno").val()=="") {alert("Por favor ingrese el Apellido Paterno");return false;}
            if($("#apellido_materno").val()=="") {alert("Por favor ingrese el Apellido Materno");return false;}

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "operaciones.php",
                data: "accion=insertar&"+$("#myForm").serialize(),
                cache: false,
                beforeSend: function(){
                    $("#form-add-alumno").modal("hide");
                },
                success: function(resultado){
                    if (resultado.status=="OK") {
                        buscar()
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {alert (xhr.status); alert(thrownError);}
            })
        }

        $("#form-add-alumno").on("hidden.bs.modal", function(e) {
            $("#myForm")[0].reset();
        })

    </script>
</body>
</html>
