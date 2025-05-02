<?php
//CRUD, aqui se generará la tablita 
include("db.php");

$accion = $_POST ["accion"]; 

if($accion == "buscar"){
    $nombre = $_POST ["nombre_buscar"]; 
    //------------
    $query = "select *from alumnos where 1"; 
    if($nombre!=""){
        $query.=" and nombre like '%".$nombre."%'"; 
    }
    $result = $db -> query ($query); 

    if($result -> num_rows >0){
        //Debe mostrar las filas
        echo '
        <table class="table table-hover">
            <thead>
                <tr>
                <th>ID</th>
                <th>Apellido_paterno</th>
                <th>Apellido_materno</th>
                <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
        '; 
        //Recorremos los resultadops con un while: 
        while ($row = $result -> fetch_assoc()){
            echo '
            <tr>
            <td>'.$row["id_alumno"].'</td>
            <td>'.$row["apellido_paterno"].'</td>
            <td>'.$row["apellido_materno"].'</td>
            <td>'.$row["nombre"].'</td>
            </tr>
            '; 
        }
        echo '
        </tbody>
        </table>
        ';
    }else{
        echo '
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Warning!</h4>
            <p class="mb-0">No hay registros que mostrar</p>
        </div>
        '; 
    }
    //------------
}
if($accion=="insertar"){
    $nombre = $_POST["nombre"]; 
    $apellido_paterno = $_POST["apellido_paterno"]; 
    $apellido_materno = $_POST["apellido_materno"]; 
    $qry = "insert into alumnos (nombre, apellido_paterno, apellido_materno) values ('$nombre', '$apellido_paterno', '$apellido_materno')"; 
    if($db -> query ($qry)){
        $response["status"] = "OK"; 
    }else{
        $response["status"] = "ERROR"; 
    }
    echo json_encode($response); 
}