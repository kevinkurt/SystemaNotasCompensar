<?php require_once 'admin/db_con.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Sistema de notas </title>
  </head>
  <body>
    <div class="container"><br>
      <a class="btn btn-success float-right" href="admin/login.php">Panel Administrativo</a>
          <h1 class="text-center"; style="padding-left: 160px;">Sistema de Notas Estudiantes</h1><br>

          <div class="row">
            <div class="col-md-4 offset-md-4">
              <form method="POST">
            <table class="text-center infotable">
              <tr>
                <th colspan="2">
                  <p class="text-center" >Información del Estudiante</p>
                </th>
              </tr>
              <tr>
                <td>
                   <p>Selecciona el Ciclo</p>
                </td>
                <td>
                   <select class="form-control" name="choose">
                     <option value="">
                       Selecciona
                     </option>
                     <option value="Tecnico">
                       Tecnico
                     </option>
                     <option value="Tecnologo">
                       Tecnologo
                     </option>
                     <option value="Profesional">
                       profesional
                     </option>
 
                   </select>
                </td>
              </tr>

              <tr>
                <td>
                  <p><label for="roll">Número de cedula </label></p>
                </td>
                <td>
                  <input class="form-control" type="text" pattern="[0-9]{10}" id="roll" placeholder="10 dígitos..." name="roll">
                </td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">
                  <input class="btn btn-success" type="submit" name="showinfo">
                </td>
              </tr>
            </table>
          </form>
            </div>
          </div>
        <br>
        <?php if (isset($_POST['showinfo'])) {
          $choose= $_POST['choose'];
          $roll = $_POST['roll'];
          if (!empty($choose && $roll)) {
            $query = mysqli_query($db_con,"SELECT * FROM `student_info` WHERE `roll`='$roll' AND `class`='$choose'");
            if (!empty($row=mysqli_fetch_array($query))) {
              if ($row['roll']==$roll && $choose==$row['class']) {
                $stroll= $row['roll'];
                $stname= $row['name'];
                $stclass= $row['class'];
                $city= $row['city'];
                $photo= $row['photo'];
                $Facultad= $row['Facultad'];
                $Materia= $row['Materia'];
                $Programa = $row ['Programa'];
                $pcontact= $row['pcontact'];
              ?>
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <table class="table table-bordered"; style="border: 3px solid rgb(34,139,34)">
              <tr>
                <td rowspan="5"; style="border: 3px solid rgb(34,139,34);"><h3>Información de Estudiante</h3><img class="img-thumbnail" src="admin/images/<?= isset($photo)?$photo:'';?>" width="250px"></td>
                <td>Nombre</td>
                <td><?= isset($stname)?$stname:'';?></td>
              </tr>
              <tr>
                <td>Número de indentificación</td>
                <td><?= isset($stroll)?$stroll:'';?></td>
              </tr>
              <tr>
                <td>Grado</td>
                <td><?= isset($stclass)?$stclass:'';?></td>
              </tr>
              <tr>
                <td>Dirección</td>
                <td><?= isset($city)?$city:'';?></td>
              </tr>
              <tr>
                <td>Fecha de Ingreso</td>
                <td><?= isset($pcontact)?$pcontact:'';?></td>
              </tr>
            </table>
          </div>
        </div>  

        <div>


        

      <div class="row2" style="padding-left: 0px; position: static;">
        
        <div class="col-sm-9">
        <h1>Datos generales</h1>
            <table class="table table-bordered"; style="border: 3px solid rgb(34,139,34)">
              <tr>
                <td>Programa</td>
                <td><?= isset($Programa)?$Programa:'';?></td>
              </tr>
              <tr>
                <td>Semestre</td>
                <td>7</td>
              </tr>
              <tr>
                <td>promedio</td>
                <td>4.5</td>
              </tr>
              <tr>
                <td>Materias inscritas</td>
                <td>5</td>
              </tr>
              <tr>
                </tr>
                <td>Facultad</td>
               
                <td>ing de sistemas</td> 
              </tr>
              
            </table>
          </div>

 <h1>Consultar Notas Actuales</h1>


<table  class="table table-bordered"; style="border: 3px solid rgb(34,139,34)">
  <tr>
    <th scope="col">Materia</th>
    <th scope="col">Creditos</th>
    <th scope="col">Nota final</th>
    <th scope="col">Definitiva</th>
   
  </tr>

  <tr>
    <td><?= isset($Facultad)?$Facultad:'';?></td>
    <td>3</td>
    <td>4.0</td>
    <td>4.0</td>
  </tr>

  <tr>
    <td>Desarrollo web</td>
    <td>3</td>
    <td>5.0</td>
    <td>5.0</td>
  </tr>

  <tr>
    <td>Internet de las cosas </td>
    <td>4</td>
    <td>4.5</td>
    <td>4.5</td>
  </tr>

  <tr>
    <th scope="row">TOTAL</th>
    <td>10</td>
    <td>13.5</td>
    <td>Promedio <strong>4.6</strong></td>
  </tr>
</table>


        </div>  
    </div>


        </div>
      <?php 
          }else{
                echo '<p style="color:red;">Por favor ingrese un número válido de cedula y ciclo</p>';
              }
            }else{
              echo '<p style="color:red;">Tu información ingresada no coincide</p>';
            }
            }else{?>
              <script type="text/javascript">alert("Datos no encontrados");</script>
            <?php }
          }; ?>

    </div>

    <div style="text-align: center;"">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>