<?php include('header.php'); ?>
<?php

if ( isset($_REQUEST['Modificar'])) {
    extract($_REQUEST);	
  if($_FILES['foto']['name'] != ""){ // El campo foto contiene una imagen...
    // Primero, hay que validar que se trata de un JPG/GIF/PNG
    if ((($_FILES["foto"]["type"] == "image/gif")
      || ($_FILES["foto"]["type"] == "image/jpeg")
      || ($_FILES["foto"]["type"] == "image/png")
      || ($_FILES["foto"]["type"] == "image/pjpeg"))
      ) {
      // el archivo es un JPG/GIF/PNG, entonces...
        $foto = $_FILES['foto']['name'];
        $directorio = '../uploads'; // directorio de tu elecci&oacute;n
      // almacenar imagen en el servidor
        move_uploaded_file($_FILES['foto']['tmp_name'], $directorio.'/'.$foto);
        } else { // El archivo no es JPG/GIF/PNG
          $malformato = $_FILES["foto"]["type"];
          echo 'La imagen es invalda: '.$malformato;
          }
    } else { 
		$foto=$fotoactual;
    }	
		$sql="update articulos set categoria='$categoria', 
			    marca='$marca', 
					modelo='$modelo', 
					publicar='$publicar',
					destacado='$destacado',
					detalle='$detalle', 
					precio='$precio', 
					foto='$foto'
					where id='$id'";
			  mysqli_query($_SESSION['dbdatabase'], "SET SESSION sql_mode = ' ' ");   							
		$result = MySQLSESSION_ExecuteSQL($sql);
}
?>

<?php
$id=$_REQUEST['id'];
$action=$_REQUEST['action'];

//if ($action =='modificar') {
$sql="select * from articulos where id=".addslashes($id);
$result = MySQLSESSION_ExecuteSQL($sql);
$row=mysqli_fetch_array($result); 
//}
?>

			<div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Artículos</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>-->
					</div>
				  <div class="box-content">
            <form class="form-horizontal" name="frm-usuarios" id="frm" method="post" enctype="multipart/form-data" action="articulos-editar.php?action=modificar">
              <fieldset>
						    <div class="control-group">
                  <label class="control-label" for="label">Categoría</label>
                  <div class="controls">
							      <select name="categoria"id="selectError1">
					<?php
					$sqlpais = "select * from articulos_categorias order by categoria asc";
			      $resultpais = MySQLSESSION_ExecuteSQL($sqlpais);
			      while ($rowpais = mysqli_fetch_array($resultpais)) {
					if  ($rowpais['id'] == $row['categoria']) {
					?>
                    <option value="<?php echo $rowpais['id']; ?>" selected="selected"><?php echo $rowpais['categoria']; ?></option>
                    <?php }else{ ?>
                    <option value="<?php echo $rowpais['id']; ?>" ><?php echo $rowpais['categoria']; ?></option>
                    <?php } } ?>
                    </select>
                  </div>
                </div>
			          <div class="control-group">
                  <label class="control-label" for="label">Marca</label>
                    <div class="controls">
							        <select name="marca"id="selectError1">
							        <?php
					$sqlpais = "select * from articulos_marcas order by marca asc";
			        $resultpais = MySQLSESSION_ExecuteSQL($sqlpais);
			        while ($rowpais = mysqli_fetch_array($resultpais)) {
					if  ($rowpais['id'] == $row['marca']) {
					?>
                              <option value="<?php echo $rowpais['id']; ?>" selected="selected"><?php echo $rowpais['marca']; ?></option>
                              <?php }else{ ?>
                              <option value="<?php echo $rowpais['id']; ?>" ><?php echo $rowpais['marca']; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                        </div>
						
						
						<div class="control-group">
                          <label class="control-label" for="focusedInput">Modelo</label>
                         
<div class="controls">
                            <input name="modelo" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $row['modelo']; ?>" >
                                <input name="action" type="hidden" id="action" value="modificar" />
							
							<input name="id" type="hidden" value="<?php echo $id ?>" />
						
                          </div>
                        </div>
						  
							<div class="control-group">
                          <label class="control-label" for="selectError3">Publicar</label>
                          <div class="controls">
                         
                            <select name="publicar" id="activo" class="input-mini focused" >
                               <option value="<?php echo $row['publicar']; ?>"><?php if ($row['publicar']==1) { echo 'Si'; }else{ echo 'No'; } ?></option>
               <?php if ($row['publicar']==1) { ?><option value="0" >No</option><?php } ?>
                <?php if ($row['publicar']==0) { ?><option value="1">Si</option><?php } ?>
                            </select>
                          </div>
                        </div>
                       
                       <div class="control-group">
                          <label class="control-label" for="selectError3">Destacado</label>
                          <div class="controls">
                         
                            <select name="destacado" id="activo" class="input-mini focused" >
                               <option value="<?php echo $row['destacado']; ?>"><?php if ($row['destacado']==1) { echo 'Si'; }else{ echo 'No'; } ?></option>
               <?php if ($row['destacado']==1) { ?><option value="0" >No</option><?php } ?>
                <?php if ($row['destacado']==0) { ?><option value="1">Si</option><?php } ?>
                            </select>
                          </div>
                        </div>		   		   
                       
												
						 <div class="control-group">
                          <label class="control-label" for="focusedInput">Descripci&oacute;n</label>
                          <div class="controls">
                            <textarea name="detalle" rows="7" class="input-xlarge focused" id="focusedInput"  ><?php echo $row['detalle']; ?></textarea>
                            
							
                          </div>
                        </div>
						
						 <div class="control-group">
                          <label class="control-label" for="label">Precio</label>
                          <div class="controls">
                             <input name="precio" type="number" class="input-medium focused" id="focusedInput" value="<?php echo $row['precio']; ?>" > 
                          </div>
                        </div>
						
						 <div class="control-group">
                          <label class="control-label" for="label">Foto<br> ( jpg, gif, png )</label>
                          <div class="controls">
						   <?php if ($row['foto'] != NULL)  { ?>
						   <img  style=" max-width:200px;" src="uploads/<?php echo $row['foto']; ?>" >
										
										<?php }else{ ?>
										Foto no disponible 
										<?php } ?>
										
										<input name="fotoactual" type="hidden"  value="<?php echo $row['foto']; ?>" size="20"  />
										<p><input name="foto" type="file" class="input-file uniform_on" id="fileInput"></p>
                            
                          </div>
                        </div>                    
                    
                        
                          <div class="control-group warning">
                          <label class="control-label" for="inputWarning"></label>
                        </div>
                          <div class="form-actions">
                         
						
                          <input name="Modificar"  type="submit" class="btn btn-primary" value="Modificar"/>	
						
                          <input name="Volver"  type="button" class="btn" value="Volver" onclick="location.href='articulos.php';" />	
                          </div>
												
                        </fieldset>
                      </form>  
					
					
				   </div> <!--box content -->
				</div><!--/span-->
			</div><!--/row-->
       
<?php include('footer.php'); ?>
