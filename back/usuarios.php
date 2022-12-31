<?php include('header.php'); ?>
<?php
if (isset($_REQUEST['mode']) == 'remove') {
	$strsql = "Delete from seg_usuarios where id=" . addslashes($_REQUEST['id']);
	$result = MySQLSESSION_ExecuteSQL($strsql);
}
?>
<script type="text/javascript">
	function deleteAlert(name, id) {
		var conBox = confirm("Desea Borrar: " + name);
		if (conBox) {
			location.href = "<?php $_SERVER['PHP_SELF']; ?>?id=" + id + "&mode=remove";
		} else {
			return;
		}
	}
</script>
<script type="text/javascript">
	function expandFilters() {
		var s_val;
		var b_do_show;
		var o_item = $('#dv_filter_1');
		if (!o_item) {
			return false;
		}
		if (o_item.is(':visible') && (o_item.css('display') != 'none')) {
			s_tx = '+ Consultas';
			b_do_show = false;
		}
		else {
			s_tx = '- Consultas';
			b_do_show = true;
		}
		for (i = 1; i < 20; i++) {
			o_item = $('#dv_filter_' + i);
			if (o_item.size() > 0) {
				if (b_do_show) {
					o_item.show();
				}
				else {
					o_item.hide();
				}
			}
			else {
				break;
			}
		}
		o_item = $('#cmd_expand');
		if (o_item) {
			o_item.val(s_tx);
		}
	}
</script>
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
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th colspan="6">
							<form name="frm_search" id="frm_search" method="post" action="usuarios.php"
								class="form-horizontal" style="float:left">
								<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
									<tr>
										<td colspan="2"><input name="cmd_expand" id="cmd_expand" type="button"
												class="btn btn-info" style="width:95px" value="+ Consultas"
												title="Buscar" onclick="javascript:expandFilters();" /></td>
									</tr>
									<tr id="dv_filter_1" style="display:none;">
										<td width="130">Nombre y Apellido
											<input name="buscar" type="hidden" id="buscar" value="1" />
										</td>
										<td>
											<input type="text" name="nombre" id="nombre" />
										</td>
									</tr>
									<tr id="dv_filter_2" style="display:none;">
										<td width="130">Usuario</td>
										<td><input type="text" name="usuario" id="usuario" /></td>
									</tr>
									<tr id="dv_filter_3" style="display:none;">
										<td>Perfil</td>
										<td><select name="perfil" id="label">
												<option value="0"></option>
												<?php
												$sqlpais = "select * from seg_perfiles order by id asc";
												$resultpais = MySQLSESSION_ExecuteSQL($sqlpais);
												while ($rowpais = mysqli_fetch_array($resultpais)) {
													?>
													<option value="<?php echo $rowpais['id']; ?>">
														<?php echo $rowpais['perfil']; ?>
													</option>
													<?php } ?>
											</select></td>
									</tr>
									<tr id="dv_filter_4" style="display:none;">
										<td colspan="2"><input name="cmd_search" id="cmd_search" type="submit"
												class="btn btn-info" value="Buscar" style="width:70px;" /></td>
									</tr>
								</table>
								<?php if (isset($_REQUEST['buscar']) == 1) { ?>
									Resultados para la consulta:&nbsp;&nbsp; Nombre y Apellido: <?php echo $_REQUEST['nombre'] ?> Usuario: <?php echo $_REQUEST['numero'] ?> Perfil: <?php echo $_REQUEST['perfil'] ?> &nbsp;&nbsp;<a class="btn" href="usuarios.php"><i
											class="icon-refresh" title="Quitar Filtros"></i></a>
									<?php } ?>
							</form>
							<a style="float:right" class="btn btn-success" href="usuarios-editar.php?action=alta"> <i
									class="icon-plus icon-white"></i>Nuevo </a>
						</th>
					</tr>
					<tr>
						<th>Nombre</th>
						<th>Usuario</th>
						<th>Fecha Alta</th>
						<th>Perfil</th>
						<th>Status</th>
						<th>Accciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$pag = $_GET["pag"];
					if (!isset($pag))
						$pag = 1; // Por defecto, pagina 1
					$tampag = 20;
					$columna = 1;
					$reg1 = ($pag - 1) * $tampag;
					$sql = "select * from seg_usuarios WHERE 1";
					if ($_REQUEST['nombre'] != '') {
						$where1 = " and (nombre LIKE '%" . $_REQUEST['nombre'] . "%' or apellido LIKE '%" . $_REQUEST['nombre'] . "%')";
						$nombre = $_REQUEST['nombre'];
					} else {
						$where1 = '';
						$nombre = '';
					}
					if ($_REQUEST['usuario'] != '') {
						$where2 = " and usuario LIKE '%" . $_REQUEST['nombre'] . "%'";
						$usuario = $_REQUEST['usuario'];
					} else {
						$where2 = '';
						$usuario = '';
					}
					if ($_REQUEST['perfil'] != 0) {
						$where3 = " and perfil=" . $_REQUEST['perfil'] . "";
						$perfil = $_REQUEST['perfil'];
					} else {
						$where3 = '';
						$perfil = '';
					}
					//mysqli_set_charset( $mysqlSESSION_database, 'utf8');
					$result = MySQLSESSION_ExecuteSQL($sql . $where1 . $where2 . $where3 . " order by id asc");
					$linea = 1;
					$total = mysqli_num_rows($result);
					for ($i = $reg1; $i < min($reg1 + $tampag, $total); $i++) {
						mysqli_data_seek($result, $i);
						$row = mysqli_fetch_array($result);
						$sqlp = "select * from seg_perfiles where id=" . $row['perfil'];
						$resultp = MySQLSESSION_ExecuteSQL($sqlp);
						$rowp = mysqli_fetch_array($resultp);
						?>
						<tr>
							<td><?php echo $row['nombre']; ?>
								<?php echo $row['apellido']; ?>
							</td>
							<td class="center">
								<?php echo $row['usuario']; ?>
							</td>
							<td class="center"><?php echo date("d/m/Y", strtotime($row['fechaalta'])); ?></td>
							<td class="center">
								<?php echo $rowp['perfil']; ?>
							</td>
							<td class="center">
								<?php if ($row['activo'] == 1) { ?><span class="label label-success">Activo</span>
									<?php } ?> <?php if ($row['activo'] == 0) { ?><span class="label label-error">Inactivo</span>
									<?php } ?>
							</td>
							<td class="center"> <a class="btn btn-info"
									href="usuarios-editar.php?id=<?php echo $row['id']; ?>&action=modificar"> <i
										class="icon-edit icon-white"></i> Editar / Ver </a>
								<?php if (!$val) { ?><a class="btn btn-danger"
										href="javascript: deleteAlert('<?php echo $row['nombre']; ?> <?php echo $row['apellido']; ?>','<?php echo $row['id']; ?>')">
										<i class="icon-trash icon-white"></i> Borrar </a>
									<?php } ?>
							</td>
						</tr>
						<?php
						$linea++;
					} ?>
				</tbody>
			</table>
			<div class="pagination pagination-centered">
				<ul>
					<?php if (isset($_REQUEST['buscar']) == 1) {
					echo paginar($pag, $total, $tampag, "usuarios.php?nombre=$nombre&usuario=$usuario&perfil=$perfil&buscar=1&pag=");
				} else {
					echo paginar($pag, $total, $tampag, "usuarios.php?pag=");
				} ?>
				</ul>
			</div>

		</div>
	</div><!--/span-->
</div><!--/row-->

<?php include('footer.php'); ?>