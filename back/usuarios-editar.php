<?php include('header.php'); ?>
<?php
if (isset($_REQUEST['Alta'])) {
  extract($_REQUEST);
  $passwd = md5($clave);
  $alta = date('Y-m-d');
  $sql = "Insert into seg_usuarios ( nombre, apellido, usuario, clave, activo, fecha alta  )
				values ('$nombre', '$apellido', '$usuario', '$passwd',  '1', '$alta')";
  mysqli_query($_SESSION['dbdatabase'], "SET SESSION sql_mode = ' ' ");
  $result = MySQLSESSION_ExecuteSQL($sql);
}

if (isset($_REQUEST['Modificar'])) {
  extract($_REQUEST);
  if ($clave != '') {
    $passwd = md5($clave);
    $sql = "update seg_usuarios set nombre = '$nombre', 
						apellido = '$apellido', 			  	
						clave = '$passwd', 
						activo = '$activo'		
						where id='$id'";
  } else {
    $sql = "update seg_usuarios set nombre = '$nombre', 
						apellido = '$apellido',				 
						activo = '$activo'		
						where id='$id'";
  }
  mysqli_query($_SESSION['dbdatabase'], "SET SESSION sql_mode = ' ' ");
  $result = MySQLSESSION_ExecuteSQL($sql);
}
?>

<?php
$id = $_REQUEST['id'];
$action = $_REQUEST['action'];
if ($action == 'modificar') {
  $sql = "select * from seg_usuarios where id=" . $id;
  $result = MySQLSESSION_ExecuteSQL($sql);
  $row = mysqli_fetch_array($result);
}
?>
<!--<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="sistemas.php">Sistema</a>
					</li>
				</ul>
			</div>-->
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
      <h2>Usuarios</h2>
      <!--<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>-->
    </div>
    <div class="box-content">
      <form class="form-horizontal" name="frm" id="frm" method="post" action="usuarios-editar.php?action=<?php echo $action ?>">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Nombre</label>
            <div class="controls">
              <input name="nombre" class="input-xlarge focused" id="focusedInput" type="text" value="<?php echo $row['nombre']; ?>" required="required" />
              <input name="action" type="hidden" value="<?php echo $_REQUEST['action']; ?>" /><input name="id" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Apellido</label>
            <div class="controls">
              <input name="apellido" class="input-xlarge focused" id="focusedInput" type="text" value="<?php echo $row['apellido']; ?>" required="required" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Usuario</label>
            <div class="controls">
              <?php if ($action == 'alta') { ?>
                <input name="usuario" class="input-xlarge focused" id="focusedInput" type="email" value="<?php echo $row['usuario']; ?>" required="required" />
              <?php } ?>
              <?php if ($action == 'modificar') { ?>
                <input class="input-xlarge focused" id="focusedInput" type="text" value="<?php echo $row['usuario']; ?>" disabled /><input name="usuario" class="input-xlarge focused" id="focusedInput" type="hidden" value="<?php echo $row['usuario']; ?>" required="required" />
              <?php } ?>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="label">Perfil</label>
            <div class="controls">
              <select name="perfil" id="label" required="required">
                <?php
                $sqlpais = "select * from seg_perfiles order by id asc";
                $resultpais = MySQLSESSION_ExecuteSQL($sqlpais);
                while ($rowpais = mysqli_fetch_array($resultpais)) {
                  if ($rowpais['id'] == $row['perfil']) {
                ?>
                    <option value="<?php echo $rowpais['id']; ?>" selected="selected"><?php echo $rowpais['perfil']; ?>
                    </option>
                  <?php } else { ?>
                    <option value="<?php echo $rowpais['id']; ?>"><?php echo $rowpais['perfil']; ?></option>
                <?php }
                } ?>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="selectError3">Activo</label>
            <div class="controls">
              <?php if ($action == 'alta') { ?>
                <select name="activo" id="selectError3">
                  <option value="1">Si</option>
                </select><?php } ?>
              <?php if ($action == 'modificar') { ?>
                <select name="activo" id="selectError3" required="required">
                  <option value="<?php echo $row['activo']; ?>"><?php if ($row['activo'] == 1) {
                                                                  echo 'Si';
                                                                } else {
                                                                  echo 'No';
                                                                } ?></option>
                  <?php if ($row['activo'] == 1) { ?><option value="0">No</option><?php } ?>
                  <?php if ($row['activo'] == 0) { ?><option value="1">Si</option><?php } ?>
                </select><?php } ?>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Contrase&ntilde;a <?php if ($action == 'modificar') { ?><br />(ingrese solamente si cambia)<?php } ?></label>
            <div class="controls">
              <input name="clave" class="input-xlarge focused" id="focusedInput" type="password" <?php if ($action == 'alta') { ?>required="required" <?php } ?> />
            </div>
          </div>
          <div class="control-group warning">
            <label class="control-label" for="inputWarning"></label>
          </div>
          <div class="form-actions">
            <?php if ($_REQUEST['action'] == 'alta') { ?>
              <input name="Alta" type="submit" class="btn btn-primary" value="Enviar" />
            <?php } ?>
            <?php if ($_REQUEST['action'] == 'modificar') { ?>
              <input name="Modificar" type="submit" class="btn btn-primary" value="Modificar" />
            <?php } ?>
            <input name="Volver" type="button" class="btn" value="Volver" onClick="location.href='usuarios.php';" />
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  <!--/span-->
</div>
<!--/row-->
<?php include('footer.php'); ?>