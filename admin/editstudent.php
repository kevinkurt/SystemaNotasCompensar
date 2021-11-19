<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: index.php?page=' . $corepage[0]);
	}
}

$id = base64_decode($_GET['id']);
$oldPhoto = base64_decode($_GET['photo']);

if (isset($_POST['updatestudent'])) {
	$name = $_POST['name'];
	$roll = $_POST['roll'];
	$address = $_POST['address'];
	$pcontact = $_POST['pcontact'];
	$Facultad = $_POST['Facultad'];
	$Materia = $_POST['Materia'];
	$Programa = $_POST['Programa'];
	$class = $_POST['class'];

	if (!empty($_FILES['photo']['name'])) {
		$photo = $_FILES['photo']['name'];
		$photo = explode('.', $photo);
		$photo = end($photo);
		$photo = $roll . date('Y-m-d-m-s') . '.' . $photo;
	} else {
		$photo = $oldPhoto;
	}


	$query = "UPDATE `student_info` SET `name`='$name',`roll`='$roll',`class`='$class',`city`='$address',`pcontact`='$pcontact',`photo`='$photo',`Facultad`='$Facultad', `Materia`='$Materia', `Programa`='$Programa' WHERE `id`= $id";
	if (mysqli_query($db_con, $query)) {
		$datainsert['insertsucess'] = '<p style="color: green;">Student Updated!</p>';
		if (!empty($_FILES['photo']['name'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo);
			unlink('images/' . $oldPhoto);
		}
		header('Location: index.php?page=all-student&edit=success');
	} else {
		header('Location: index.php?page=all-student&edit=error');
	}
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Editar Información de Estudiante<small class="text-warning"> Editar</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?page=all-student">Todos los Estudiantes </a></li>
		<li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
	</ol>
</nav>

<?php
if (isset($id)) {
	$query = "SELECT `id`, `name`, `roll`, `class`, `city`, `pcontact`, `photo`,`Facultad`,`Materia`,`Programa`,`datetime` FROM `student_info` WHERE `id`=$id";
	$result = mysqli_query($db_con, $query);
	$row = mysqli_fetch_array($result);
}
?>
<div class="row">
	<div class="col-sm-6">
		<form enctype="multipart/form-data" method="POST" action="">
			<div class="form-group">
				<label for="name">Nombre de Estudiante</label>
				<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="roll">Número de Cedula</label>
				<input name="roll" type="text" class="form-control" pattern="[0-9]{10}" id="roll" value="<?php echo $row['roll']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="address">Dirección de Estudiante</label>
				<input name="address" type="text" class="form-control" id="address" value="<?php echo $row['city']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="pcontact">Número de Contacto</label>
				<input name="pcontact" type="text" class="form-control" id="pcontact" value="<?php echo $row['pcontact']; ?>" pattern="[0-9]{10}" placeholder="+57..." required="">
			</div>
			<div class="form-group">
				<label for="class">Grado</label>
				<select name="class" class="form-control" id="class" required="" value="">
					<option>Select</option>
					<option value="Tecnico" <?= $row['class'] == 'Tecnico' ? 'selected' : '' ?>>Tecnico</option>
					<option value="Tecnologo" <?= $row['class'] == 'Tecnologo' ? 'selected' : '' ?>>Tecnologo</option>
					<option value="Profesional" <?= $row['class'] == 'Profesional' ? 'selected' : '' ?>>Profesional</option>
				</select>
			</div>
			<div class="form-group">
				<label for="Facultad">Facultad</label>
				<select name="Facultad" class="form-control" id="Facultad" required="" value="">
					<option>Select</option>
					<option value="Ing. Sistemas" <?= $row['Facultad'] == 'Ing. Sistemas' ? 'selected' : '' ?>>Ing de Sistemas</option>
					<option value="Ing. telecomunicaciones" <?= $row['Facultad'] == 'Ing. telecomunicaciones' ? 'selected' : '' ?>>ing de telecomunicaciones</option>
					<option value="ing de software" <?= $row['Facultad'] == 'ing de software' ? 'selected' : '' ?>>ing de software</option>
				</select>
			</div>

			<div class="form-group">
				<label for="Materia">Materia</label>
				<select name="Materia" class="form-control" id="Materia" required="" value="">
					<option>Select</option>
					<option value="Desarrollo Web" <?= $row['Materia'] == 'Desarrollo Web' ? 'selected' : '' ?>>Desarrollo Web</option>
					<option value="Emprendimiento" <?= $row['Materia'] == 'Emprendimiento' ? 'selected' : '' ?>>Emprendimiento</option>
					<option value="gestion y calidad" <?= $row['Materia'] == 'gestion y calidad' ? 'selected' : '' ?>>Gestion y Calidad de la información</option>
				</select>
			</div>
			<div class="form-group">
				<label for="Programa">Programa</label>
				<select name="Programa" class="form-control" id="Programa" required="" value="">
					<option>Select</option>
					<option value="Técnico profesional en
INSTALACIÓN DE REDES DE TELECOMUNICACIONES" <?= $row['Programa'] == 'Técnico profesional en
INSTALACIÓN DE REDES DE TELECOMUNICACIONES' ? 'selected' : '' ?>>Técnico profesional en
						INSTALACIÓN DE REDES DE TELECOMUNICACIONES</option>

					<option value="Tecnólogo en
GESTIÓN DE REDES DE TELECOMUNICACIONES" <?= $row['Programa'] == 'Tecnólogo en
GESTIÓN DE REDES DE TELECOMUNICACIONES' ? 'selected' : '' ?>>Tecnólogo en
						GESTIÓN DE REDES DE TELECOMUNICACIONES</option>



					<option value="Profesional en
INGENIERÍA DE TELECOMUNICACIONES" <?= $row['Programa'] == 'Profesional en
INGENIERÍA DE TELECOMUNICACIONES' ? 'selected' : '' ?>>Profesional en
						INGENIERÍA DE TELECOMUNICACIONES</option>

					<option value="Profesional en
INGENIERÍA DE TELECOMUNICACIONES" <?= $row['Programa'] == 'Profesional en
INGENIERÍA DE TELECOMUNICACIONES' ? 'selected' : '' ?>>Profesional en
						INGENIERÍA DE TELECOMUNICACIONES</option>


					<option value="Técnica Profesional en
		PROGRAMACIÓN DE APLICACIONES DE SOFTWARE" <?= $row['Programa'] == 'Técnica Profesional en
		PROGRAMACIÓN DE APLICACIONES DE SOFTWARE' ? 'selected' : '' ?>>Técnica Profesional en
						PROGRAMACIÓN DE APLICACIONES DE SOFTWARE</option>


					<option value="Tecnología en
		DESARROLLO DE APLICACIONES WEB Y MÓVILES" <?= $row['Programa'] == 'Tecnología en
		DESARROLLO DE APLICACIONES WEB Y MÓVILES' ? 'selected' : '' ?>>Tecnología en
						DESARROLLO DE APLICACIONES WEB Y MÓVILES</option>


					<option value="Profesional en
		INGENIERÍA DE SOFTWARE" <?= $row['Programa'] == 'Profesional en
		INGENIERÍA DE SOFTWARE' ? 'selected' : '' ?>>Profesional en
						INGENIERÍA DE SOFTWARE</option>


					<option value="Técnica profesional en
PRODUCCIÓN DE PIEZAS MULTIMEDIA" <?= $row['Programa'] == 'Técnica profesional en
PRODUCCIÓN DE PIEZAS MULTIMEDIA' ? 'selected' : '' ?>>Técnica profesional en
						PRODUCCIÓN DE PIEZAS MULTIMEDIA</option>


					<option value="Tecnólogo en
GESTIÓN DE PROYECTOS WEB" <?= $row['Programa'] == 'Tecnólogo en
GESTIÓN DE PROYECTOS WEB' ? 'selected' : '' ?>>Tecnólogo en
						GESTIÓN DE PROYECTOS WEB</option>


					<option value="Profesional en
DISEÑO VISUAL" <?= $row['Programa'] == 'Profesional en
DISEÑO VISUAL' ? 'selected' : '' ?>>Profesional en
						DISEÑO VISUAL</option>


					<option value="Tecnología en Auditoría y Aseguramiento de la Información" <?= $row['Programa'] == 'Tecnología en Auditoría y Aseguramiento de la Información' ? 'selected' : '' ?>>Tecnología en Auditoría y Aseguramiento de la Información</option>


					<option value="Tecnología en Operaciones de Manufactura y Servicios" <?= $row['Programa'] == 'Tecnología en Operaciones de Manufactura y Servicios' ? 'selected' : '' ?>>Tecnología en Operaciones de Manufactura y Servicios</option>


					<option value="Administración Logística" <?= $row['Programa'] == 'Administración Logística' ? 'selected' : '' ?>>Administración Logística</option>


					<option value="Comunicación Social" <?= $row['Programa'] == 'Comunicación Social' ? 'selected' : '' ?>>Comunicación Social</option>


					<option value="Tecnología en Productividad y Mejoramiento Continuo" <?= $row['Programa'] == 'Tecnología en Productividad y Mejoramiento Continuo' ? 'selected' : '' ?>>Tecnología en Productividad y Mejoramiento Continuo</option>


					<option value="Administración de Servicios de Salud" <?= $row['Programa'] == 'Administración de Servicios de Salud' ? 'selected' : '' ?>>Administración de Servicios de Salud</option>


					<option value="Técnica Profesional en
CONTABILIDAD" <?= $row['Programa'] == 'Técnica Profesional en
CONTABILIDAD' ? 'selected' : '' ?>>Técnica Profesional en
						CONTABILIDAD</option>


					<option value="Tecnología en
GESTIÓN TRIBUTARIA Y FINANCIERA" <?= $row['Programa'] == 'Tecnología en
GESTIÓN TRIBUTARIA Y FINANCIERA' ? 'selected' : '' ?>>Tecnología en
						GESTIÓN TRIBUTARIA Y FINANCIERA</option>





					<option value="Profesional en
CONTADURÍA PÚBLICA" <?= $row['Programa'] == 'Profesional en
CONTADURÍA PÚBLICA' ? 'selected' : '' ?>>Profesional en
						CONTADURÍA PÚBLICA</option>


				</select>
			</div>

			<div class="form-group">
				<label for="photo">Fotografía</label>
				<input name="photo" type="file" class="form-control" id="photo">
			</div>
			<div class="form-group text-center">
				<input name="updatestudent" value="Editar Estudiante" type="submit" class="btn btn-success">
			</div>
		</form>
	</div>
</div>