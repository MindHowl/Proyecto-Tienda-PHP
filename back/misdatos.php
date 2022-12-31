<?php include('header.php'); ?>
<?php

if (isset($_REQUEST['Modificar'])) {
	extract($_REQUEST);
	if ($clave != '') {
		$passwd = md5($clave);
		$sql = "update seg_usuarios set nombre = '$nombre', 
				apellido = '$apellido', 
				clave = '$passwd'
				where id='$id'";
	} else {
		$sql = "update seg_usuarios set nombre = '$nombre', 
				apellido = '$apellido'
				where id='$id'";
	}
	mysqli_query($_SESSION['dbdatabase'], "SET SESSION sql_mode = ' ' ");
	$result = MySQLSESSION_ExecuteSQL($sql);
}

?>
<?php
$sql = "select * from seg_usuarios where id=" . $_SESSION['IDUsuario'];
$result = MySQLSESSION_ExecuteSQL($sql);
$row = mysqli_fetch_array($result);
?>

<div>
	<ul class="breadcrumb">
		<li>
			<a href="index.php">Inicio</a>
		</li>
	</ul>
</div>

<div class="row-fluid sortable">
	<!--/span-->
</div>
<!--/row-->
<div class="row-fluid sortable">
	<!--/span-->
	<!--/span-->
</div>
<!--/row-->
<div class="row-fluid sortable">
	<!--/span-->
	<!--/span-->
</div>
<!--/row-->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2>Mis Datos</h2>
			<!--<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>-->
		</div>
		<div class="box-content">
			<form class="form-horizontal" name="frm-usuarios" id="frm" method="post" enctype="multipart/form-data"
				action="misdatos.php">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Nombre</label>
						<div class="controls">
							<input name="nombre" class="input-xlarge focused" id="focusedInput" type="text"
								value="<?php echo $row['nombre']; ?>" required="required" />
							<input name="id" type="hidden" value="<?php echo $_SESSION['IDUsuario']; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Apellido</label>
						<div class="controls">
							<input name="apellido" class="input-xlarge focused" id="focusedInput" type="text"
								value="<?php echo $row['apellido']; ?>" required="required" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Usuario</label>
						<div class="controls">
							<input name="usuario" class="input-xlarge focused" id="focusedInput" type="text"
								value="<?php echo $row['usuario']; ?>" disabled />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Contrase&ntilde;a <br />(ingrese solamente si
							cambia)</label>
						<div class="controls">
							<input name="clave" class="input-xlarge focused" id="focusedInput" type="password" />
						</div>
					</div>
					<div class="control-group warning">
						<label class="control-label" for="inputWarning"></label>
					</div>
					<div class="form-actions">
						<input name="Modificar" type="submit" class="btn btn-primary" value="Modificar"/>
					</div>
				</fieldset>
			</form>
		</div>
	</div><!--/span-->
</div><!--/row-->

<?php include('footer.php'); ?>