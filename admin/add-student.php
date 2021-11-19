<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: index.php?page=' . $corepage[0]);
	}
}

if (isset($_POST['addstudent'])) {
	$name = $_POST['name'];
	$roll = $_POST['roll'];
	$address = $_POST['address'];
	$pcontact = $_POST['pcontact'];
	$Facultad = $_POST['Facultad'];
	$Materia = $_POST['Materia'];
	$Programa = $_POST['Programa'];
	$class = $_POST['class'];

	$photo = explode('.', $_FILES['photo']['name']);
	$photo = end($photo);
	$photo = $roll . date('Y-m-d-m-s') . '.' . $photo;

	$query = "INSERT INTO `student_info`(`name`, `roll`, `class`, `city`, `pcontact`, `photo`,`Facultad`,`Materia`, `Programa`) VALUES ('$name', '$roll', '$class', '$address','$pcontact','$photo','$Facultad','$Materia','$Programa');";


	if (mysqli_query($db_con, $query)) {
		$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
		move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo);
	} else {
		$datainsert['inserterror'] = '<p style="color: red;">Estudiante no ingresado, revise la información diligenciada.</p>';
	}
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Agregar Estudiante<small class="text-warning"> Nuevo Estudiante</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
		<li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
	</ol>
</nav>

<div class="row">

	<div class="col-sm-6">
		<?php if (isset($datainsert)) { ?>
			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
				<div class="toast-header">
					<strong class="mr-auto">Student Insert Alert</strong>
					<small><?php echo date('d-M-Y'); ?></small>
					<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="toast-body">
					<?php
					if (isset($datainsert['insertsucess'])) {
						echo $datainsert['insertsucess'];
					}
					if (isset($datainsert['inserterror'])) {
						echo $datainsert['inserterror'];
					}
					?>
				</div>
			</div>
		<?php } ?>
		<form enctype="multipart/form-data" method="POST" action="">

			<div class="form-group" style="padding-left: 0px;position:relative;padding-bottom: 0px">
				<label for="photo">Fotografía de Estudiante</label>
				<input name="photo" type="file" class="form-control" id="photo" required="">
			</div>


			<div class="form-group">
				<label for="name">Nombre de Estudiante</label>
				<input name="name" type="text" class="form-control" id="name" value="<?= isset($name) ? $name : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="roll">Número de Cedula</label>
				<input name="roll" type="text" value="<?= isset($roll) ? $roll : ''; ?>" class="form-control" pattern="[0-9]{10}" id="roll" required="">
			</div>
			<div class="form-group">
				<label for="address">Dirección de Estudiante</label>
				<input name="address" type="text" value="<?= isset($address) ? $address : ''; ?>" class="form-control" id="address" required="">
			</div>
			<div class="form-group">
				<label for="pcontact">Teléfono de Contacto</label>
				<input name="pcontact" type="text" class="form-control" id="pcontact" pattern="[0-9]{10}" value="<?= isset($pcontact) ? $pcontact : ''; ?>" placeholder="+57........." required="">
			</div>
			<div class="form-group">
				<label for="class">Grado Estudiantil</label>
				<select name="class" class="form-control" id="class" required="">
					<option>Selecciona</option>
					<option value="Tecnico">Tecnico</option>
					<option value="Tecnologo">Tecnologo</option>
					<option value="Profesional">Profesional</option>
				</select>
			</div>
			<div class="form-group">
				<label for="Facultad">Facultad</label>
				<select name="Facultad" class="form-control" id="Facultad" required="">
					<option>Selecciona</option>
					<option value="IngSistemas">ing sistemas</option>
					<option value="ingtelecomunicaciones">ing telecomunicaciones</option>
					<option value="ingsoftware">ing de software</option>
				</select>
			</div>
			<div class="form-group">
				<label for="Materia">Materia</label>
				<select name="Materia" class="form-control" id="Materia" required="">
					<option>Selecciona</option>
					<option value="DesarrolloWeb">Desarrollo Web</option>
					<option value="Emprendimiento">Emprendimiento</option>
					<option value="gestionycalidad">Gestion y Calidad de la información</option>
				</select>
			</div>

			<div class="form-group">
				<label for="Programa">Programa</label>
				<select name="Programa" class="form-control" id="Programa" required="">
					<option>Selecciona</option>
					<option value="Técnico profesional en
INSTALACIÓN DE REDES DE TELECOMUNICACIONES">Técnico profesional en
						INSTALACIÓN DE REDES DE TELECOMUNICACIONES</option>
					<option value="Tecnólogo en
GESTIÓN DE REDES DE TELECOMUNICACIONES">Tecnólogo en
						GESTIÓN DE REDES DE TELECOMUNICACIONES</option>
					<option value="Profesional en
INGENIERÍA DE TELECOMUNICACIONES">Profesional en
						INGENIERÍA DE TELECOMUNICACIONES</option>
					<option value="Técnica Profesional en
		PROGRAMACIÓN DE APLICACIONES DE SOFTWARE">Técnica Profesional en
						PROGRAMACIÓN DE APLICACIONES DE SOFTWARE</option>
					<option value="Tecnología en
		DESARROLLO DE APLICACIONES WEB Y MÓVILES">Tecnología en
						DESARROLLO DE APLICACIONES WEB Y MÓVILES</option>
					<option value="Profesional en
		INGENIERÍA DE SOFTWARE">Profesional en
						INGENIERÍA DE SOFTWARE</option>
					<option value="Técnica profesional en
PRODUCCIÓN DE PIEZAS MULTIMEDIA">Técnica profesional en
						PRODUCCIÓN DE PIEZAS MULTIMEDIA</option>
					<option value="Tecnólogo en
GESTIÓN DE PROYECTOS WEB">Tecnólogo en
						GESTIÓN DE PROYECTOS WEB</option>
					<option value="Profesional en
DISEÑO VISUAL">Profesional en
						DISEÑO VISUAL</option>
					<option value="Tecnología en Auditoría y Aseguramiento de la Información">Tecnología en Auditoría y Aseguramiento de la Información</option>
					<option value="Tecnología en Operaciones de Manufactura y Servicios">Tecnología en Operaciones de Manufactura y Servicios</option>
					<option value="Administración Logística">Administración Logística</option>
					<option value="Comunicación Social">Comunicación Social</option>
					<option value="Tecnología en Productividad y Mejoramiento Continuo">Tecnología en Productividad y Mejoramiento Continuo</option>
					<option value="Administración de Servicios de Salud">Administración de Servicios de Salud</option>
					<option value="Técnica Profesional en
CONTABILIDAD">Técnica Profesional en
						CONTABILIDAD</option>
					<option value="Tecnología en
GESTIÓN TRIBUTARIA Y FINANCIERA">Tecnología en
						GESTIÓN TRIBUTARIA Y FINANCIERA</option>

					<option value="Profesional en
CONTADURÍA PÚBLICA">Profesional en
						CONTADURÍA PÚBLICA</option>

				</select>
			</div>

			<div class="form-group text-center">
				<input name="addstudent" value="Agregar Estudiante" type="submit" class="btn btn-danger">
			</div>

		</form>
	</div>
</div>