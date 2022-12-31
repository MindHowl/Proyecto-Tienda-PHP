<?php include('header.php'); ?>
<?php
if (isset($_REQUEST['mode'])=='remove') {
	$strsql = "Delete from propiedades where id=".addslashes($_REQUEST['id']);
	$result = MySQLSESSION_ExecuteSQL($strsql);
}

?>
<script type="text/javascript">
function deleteAlert(name,id){
	var conBox = confirm("Desea Borrar: " + name);
	if(conBox){ 
		location.href="<?php $_SERVER['PHP_SELF']; ?>?id="+ id + "&mode=remove";
	}else{
		return;
	}
}
</script>	
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
						<h2>Artículos</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						
				<table class="table table-bordered table-striped table-condensed">
				<thead>
					<a style="float:right" class="btn btn-success" href="articulos-alta.php?action=alta"> <i class="icon-plus icon-white"></i>Nueva</a></th>
					</tr>
    <tr>
					<th>Foto</th>
					<th>Marca</th>
					<th>Articulo</th>
					<th>Categoría</th>  
					<th>Precio</th>
					<th>Activo</th>
					<th>Destacado</th>               
					<th>Acciones</th>
    </tr>
</thead>   
<tbody>
<?php
$pag=$_GET["pag"];
if (!isset($pag)) $pag = 1; // Por defecto, pagina 1
$tampag = 10;
$columna = 1;
$reg1 = ($pag-1) * $tampag;
$sql="select * from articulos";
$result = MySQLSESSION_ExecuteSQL($sql);
$linea= 1;
$total = mysqli_num_rows($result);

for ($i=$reg1; $i<min($reg1+$tampag, $total); $i++) {
    mysqli_data_seek($result, $i);
	$row = mysqli_fetch_array($result);
	$sqlp="select * from articulos_marcas where id=".$row['marca'];
	$resultp = MySQLSESSION_ExecuteSQL($sqlp);
    $rowp = @mysqli_fetch_array($resultp);
	
	/*		
	$sqlc="select * from inmuebles where id=".$row['inmueble'];
	$resultc = MySQLSESSION_ExecuteSQL($sqlc);
    $rowc = @mysqli_fetch_array($resultc); 
	
	*/
?>
                                <tr>
								<td> <img src="uploads/<?php echo $row['foto']; ?>" width="100em" > </td>				
									<td><?php echo $rowp['marca']; ?> </td>									
									<td class="center"><?php echo $row['modelo']; ?></td>
									<td class="center"><?php echo $row['categoria']; ?> </td>
									<td class="center"><?php echo $row['precio']; ?></td>
									<td class="center">
										<?php if ($row['publicar']==1) { ?><span class="label label-success">Publicada</span><?php } else{?><span class="label label-danger"> No publicada</span><?php
										}?></td>
								    <td class="center">
										<?php if($row['destacado']==1){?><span class="label label-success">Destacada</span><?php } else{?><span class="label label-danger"> No destacada</span><?php
										}?></td> <!--para modificar-->								  
								    <td class="center"> <a class="btn btn-info" href="articulos-editar.php?id=<?php echo $row['id']; ?>&action=modificar"> <i class="icon-edit icon-white"></i> Editar </a> <a class="btn btn-danger" href="javascript: deleteAlert('<?php echo $row['modelo'];  ?>','<?php echo $row['id'];?>')"> <i class="icon-trash icon-white"></i> Borrar </a> </td>
								</tr>
                                <?php $linea++; }  ?>
							</tbody>
						</table>  
<div class="pagination pagination-centered">
						<ul>
							<?php 
							echo paginar($pag, $total, $tampag, "articulos.php?pag=");
							?>
						</ul >
						</div>     
					</div>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>
