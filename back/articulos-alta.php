<?php include('header.php'); ?>
<?php

if (isset($_POST['Alta'])) {
  extract($_POST);
  //aca se procesa la Foto

  if ($_FILES['foto']['name'] != "") {
    // El campo foto contiene una imagen...
    // Primero, hay que validar que se trata de un JPG/GIF/PNG
    // $allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "GIF", "PNG");
    if (
      (($_FILES["foto"]["type"] == "image/gif")
        || ($_FILES["foto"]["type"] == "image/jpeg")
        || ($_FILES["foto"]["type"] == "image/png")
        || ($_FILES["foto"]["type"] == "image/pjpeg"))
    ) {
      // el archivo es un JPG/GIF/PNG, entonces...
      $foto = $_FILES['foto']['name'];
      $directorio = '../uploads'; // directorio de tu elecci&oacute;n
      // almacenar imagen en el servidor
      move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . '/' . $foto);
    } else { // El archivo no es JPG/GIF/PNG
      $malformato = $_FILES["foto"]["type"];
      echo 'La imagen es invalda: ' . $malformato;
    }
  }
  $sql = "Insert into articulos (marca,  nombre,  publicar, foto)
			values ('$marca',  '$nombre','1', '$foto')";
  mysqli_query($_SESSION['dbdatabase'], "SET SESSION sql_mode = ' ' ");
  $result = MySQLSESSION_ExecuteSQL($sql);

}
?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2>Articulos</h2>
      <!--<div class="box-icon">
              <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
              <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
              <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>-->
    </div>
    <div class="box-content">
      <form class="form-horizontal" name="frm-usuarios" id="frm" method="post" enctype="multipart/form-data"
        action="articulos-alta.php">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Nombre</label>
            <div class="controls">
              <input name="nombre" type="text" class="input-xlarge focused" id="focusedInput" required="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="label">Marca</label>
            <div class="controls">
              <select name="marca" id="selectError1">
                <?php
                $sql = "select * from articulos_marcas order by marca asc";
                $result = MySQLSESSION_ExecuteSQL($sql);
                while ($row = mysqli_fetch_array($result)) {
                  ?>
                  <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['marca']; ?>
                  </option>
                  <?php } ?>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Foto</label>
            <div class="controls">
              <input name="foto" type="file" class="input-xlarge focused" id="focusedInput">
            </div>
          </div>
          <div class="control-group warning">
            <label class="control-label" for="inputWarning"></label>
          </div>
          <div class="form-actions">
            <input name="Alta" type="submit" class="btn btn-primary" value="Alta" />
            <input name="Volver" type="button" class="btn" value="Volver" onclick="location.href='articulos.php';" />
          </div>
        </fieldset>
      </form>
    </div>
  </div><!--/span-->
</div><!--/row-->

<?php include('footer.php'); ?>