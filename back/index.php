<?php include('header.php');
ini_set('display_errors', '0');
?>

<body>
	<!-- topbar starts -->
	<div id="content" class="span12">
		<!-- content starts -->
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2>Estadísticas</h2>
				<!--<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>-->
			</div>
		</div>
		<?php
		//	$sql="select count(id) as PedidosAbiertos from cr_ventas WHERE status='3'";
		//	$result = MySQLSESSION_ExecuteSQL($sql);
		//	$row = mysql_fetch_array($result);
		?>
		<div class="row-fluid sortable">
			<div class="box span6">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-list"></i> Estadíasticas</h2>
				</div>
				<div class="box-content">
					<ul class="dashboard-list">
						<?php
						$sql = "select count(id) as Articulos from articulos";
						$result = MySQLSESSION_ExecuteSQL($sql);
						$row = mysqli_fetch_array($result);
						?>
						<li>
							<a href="articulos.php">
								<i class="icon-home"></i>
								<span class="red">
									<?php echo $row['Articulos']; ?>
								</span>
								Artículos
							</a>
						</li>
						<?php
						$sql = "select count(id) as Categorias from articulos_categorias ";
						$result = MySQLSESSION_ExecuteSQL($sql);
						$row = mysqli_fetch_array($result);
						?>
						<li>
							<a href="categorias.php">
								<i class="icon-ok"></i>
								<span class="green">
									<?php echo $row['Categorias']; ?>
								</span>
								Categorías
							</a>
						</li>
						<?php
						$sql = "select count(id) as Marcas from articulos_marcas";
						$result = MySQLSESSION_ExecuteSQL($sql);
						$row = mysqli_fetch_array($result);
						?>
						<li>
							<a href="marcas.php">
								<i class="icon-ok"></i>
								<span class="green">
									<?php echo $row['Marcas']; ?>
								</span>
								Marcas
							</a>
						</li>
					</ul>
				</div>
			</div><!--/span-->
			<div class="box span6">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-list"></i> Categorías</h2>
				</div>
				<div class="box-content">
					<ul class="dashboard-list">
						<?php
						$sql = "select * from articulos_categorias order by id asc ";
						$result = MySQLSESSION_ExecuteSQL($sql);
						while ($row = mysqli_fetch_array($result)) {
							?>
							<li>
								<a href="categorias.php">
									<i class="icon-minus"></i>
									<?php echo $row['categoria']; ?>
								</a>
							</li>
							<?php } ?>
					</ul>
				</div>
			</div><!--/span-->
		</div><!--/row-->
		<!-- content ends -->
	</div><!--/#content.span10-->
	</div><!--/fluid-row-->
	<hr>
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	<?php include('footer.php'); ?>