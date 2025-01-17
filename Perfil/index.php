<?php

if (!isset($_COOKIE['user_id']) || count($_COOKIE) == 0) {
	header("Location: http://softicket.cl");
}

// include_once 'config.php';
include_once '../conexion.php';

// $id = $_GET['id'];
$id = $_COOKIE['user_id'];

$link = Conectarse();

$squery = "SELECT 
user_id,
user_nombre,
user_correo,
user_password,
user_empresa,
user_direccion,
user_telefono,
user_web_empresa,
user_cargo,
p.priv_id,
priv_titulo,
priv_descripcion
FROM usuarios u
INNER JOIN tickets.privilegios p
ON u.priv_id = p.priv_id
WHERE user_id = " . $id . " LIMIT 1;";

$ticket = mysqli_query($link, $squery);

//$row = mysqli_fetch_array($ticket, MYSQLI_NUM);

$row = $ticket->fetch_assoc();

if (empty($row['user_id'])) {
	header("Location: http://softicket.cl");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title><?php echo "Perfil de " . $row['user_nombre'] ?></title>

	<meta name="description" content="3 styles with inline editable feature" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="assets/css/jquery.gritter.min.css" />
	<link rel="stylesheet" href="assets/css/select2.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-editable.min.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->
	<script src="assets/js/ace-extra.min.js"></script>

	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body class="no-skin">
	<div id="navbar" class="navbar navbar-default          ace-save-state">
		<div class="navbar-container ace-save-state" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>



		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try {
					ace.settings.loadState('main-container')
				} catch (e) {}
			</script>



			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Inicio</a>
							</li>

							<li>
								<a href="#">Perfil</a>
							</li>
							<li class="active"><?php echo $row['user_nombre'] ?></li>
							<a href="/salir.php" class="RED">
								[Cerrar sesion]
								<!-- <i class="ace-icon fa fa-trash-o"></i> -->
							</a>
						</ul><!-- /.breadcrumb -->


					</div>

					<div class="page-content">


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="clearfix">
									<div class="pull-left alert alert-success no-margin alert-dismissable">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-user bigger-120 green"></i>
										Hola, Tienes Privilegios de <b><?php echo $row['priv_titulo']; ?></b>
									</div>

								</div>

								<div class="hr dotted"></div>

								<div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="assets/images/avatars/profile-pic.jpg" />
												</span>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															<i class="ace-icon fa fa-circle light-green"></i>
															&nbsp;
															<span class="white"><?php echo $row["user_nombre"];	?></span>
														</a>

														<ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
															<li class="dropdown-header"> Change Status </li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-circle green"></i>
																	&nbsp;
																	<span class="green">Available</span>
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-circle red"></i>
																	&nbsp;
																	<span class="red">Busy</span>
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-circle grey"></i>
																	&nbsp;
																	<span class="grey">Invisible</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>

											<div class="space-6"></div>

											<div class="profile-contact-info">
												<div class="profile-contact-links align-center">

													<a href="/formulario.php" class="btn btn-link">
														<i class="ace-icon fa fa-pencil-square-o bigger-125 pink"></i>
														Crear Nuevo Ticket
													</a>
													<a href="../bandeja" class="btn btn-link">
														<i class="ace-icon fa fa-file-text bigger-125 pink"></i>
														Bandeja de Tickets
													</a>
													<?php
													if ($_COOKIE['priv_id'] == 1) {
														echo "<a href='/dashboard' class='btn btn-link'>";
														echo "<i class='ace-icon fa fa-cog bigger-125 pink'></i>";
														echo "Administracion";
														echo "</a>";
													}
													?>
													<!-- <a href="mailto:<?php echo $row["user_correo"]; ?>" class="btn btn-link">
														<i class="ace-icon fa fa-envelope bigger-125 pink"></i>
														Enviar un Correo
													</a>

													<a href="<?php echo "http://" . $row["user_web_empresa"]; ?>" class="btn btn-link">
														<i class="ace-icon fa fa-globe bigger-125 blue"></i>
														<?php echo $row["user_web_empresa"]; ?>
													</a> -->
												</div>

												<div class="space-6"></div>


											</div>

											<div class="hr hr12 dotted"></div>


											<div class="hr hr16 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9">
											<div class="center">
												<span class="btn btn-app btn-sm btn-light no-hover">
													<span class="line-height-1 bigger-170 blue"> 1,411 </span>

													<br />
													<span class="line-height-1 smaller-90"> Views </span>
												</span>

												<span class="btn btn-app btn-sm btn-yellow no-hover">
													<span class="line-height-1 bigger-170"> 32 </span>

													<br />
													<span class="line-height-1 smaller-90"> Followers </span>
												</span>

												<span class="btn btn-app btn-sm btn-pink no-hover">
													<span class="line-height-1 bigger-170"> 4 </span>

													<br />
													<span class="line-height-1 smaller-90"> Projects </span>
												</span>

												<span class="btn btn-app btn-sm btn-grey no-hover">
													<span class="line-height-1 bigger-170"> 23 </span>

													<br />
													<span class="line-height-1 smaller-90"> Reviews </span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> 7 </span>

													<br />
													<span class="line-height-1 smaller-90"> Albums </span>
												</span>

												<span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 bigger-170"> 55 </span>

													<br />
													<span class="line-height-1 smaller-90"> Contacts </span>
												</span>
											</div>

											<div class="space-12"></div>

											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Nombre : </div>

													<div class="profile-info-value">
														<span class="editable" id="nombre"><?php echo $row["user_nombre"]; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Correo :</div>

													<div class="profile-info-value">
														<span class="editable" id="correo">
															<a href="mailto:<?php echo $row["user_correo"]; ?>">
																<?php echo $row["user_correo"]; ?>
															</a>
														</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Empresa : </div>

													<div class="profile-info-value">
														<span class="editable" id="empresa"><?php echo $row["user_empresa"]; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Cargo : </div>

													<div class="profile-info-value">
														<span class="editable" id="cargo"><?php echo $row["user_cargo"]; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Direccion : </div>

													<div class="profile-info-value">
														<span class="editable" id="direccion"><?php echo $row["user_direccion"]; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Telefono : </div>

													<div class="profile-info-value">
														<span class="editable" id="telefono"><?php echo $row["user_telefono"]; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Web Empresa : </div>

													<div class="profile-info-value">
														<span class="editable" id="telefono">
															<a href="<?php echo "http://" . $row["user_web_empresa"]; ?>">
																<?php echo $row["user_web_empresa"]; ?>
															</a>
														</span>
													</div>
												</div>

											</div>



											<div class="space-20"></div>

											<div class="widget-box transparent">
												<div class="widget-header widget-header-small">
													<h4 class="widget-title blue smaller">
														<i class="ace-icon fa fa-rss orange"></i>
														Actividades recientes
													</h4>

													<div class="widget-toolbar action-buttons">
														<a href="#" data-action="reload">
															<i class="ace-icon fa fa-refresh blue"></i>
														</a>
														&nbsp;
														<a href="#" class="pink">
															<i class="ace-icon fa fa-trash-o"></i>
														</a>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-8">
														<div id="profile-feed-1" class="profile-feed">
															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png" />
																	<a class="user" href="#"> Alex Doe </a>
																	changed his profile photo.
																	<a href="#">Take a look</a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		an hour ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Susan Smith's avatar" src="assets/images/avatars/avatar1.png" />
																	<a class="user" href="#"> Susan Smith </a>

																	is now friends with Alex Doe.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		2 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-check btn-success no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>
																	joined
																	<a href="#">Country Music</a>

																	group.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		5 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-picture-o btn-info no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>
																	uploaded a new photo.
																	<a href="#">Take a look</a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		5 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="David Palms's avatar" src="assets/images/avatars/avatar4.png" />
																	<a class="user" href="#"> David Palms </a>

																	left a comment on Alex's wall.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		8 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-pencil-square-o btn-pink no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>
																	published a new blog post.
																	<a href="#">Read now</a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		11 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png" />
																	<a class="user" href="#"> Alex Doe </a>

																	upgraded his skills.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		12 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>

																	logged in.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		12 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-power-off btn-inverse no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>

																	logged out.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		16 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>

																	logged in.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		16 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="hr hr2 hr-double"></div>

											<div class="space-6"></div>

											<div class="center">
												<button type="button" class="btn btn-sm btn-primary btn-white btn-round">
													<i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
													<span class="bigger-110">Ver mas actividades</span>

													<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
												</button>
											</div>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Softicket &copy; 2019
						</span>

						&nbsp; &nbsp;

					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>
		<script src="assets/js/bootbox.js"></script>
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/jquery.hotkeys.index.min.js"></script>
		<script src="assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="assets/js/select2.min.js"></script>
		<script src="assets/js/spinbox.min.js"></script>
		<script src="assets/js/bootstrap-editable.min.js"></script>
		<script src="assets/js/ace-editable.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {

				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
				$.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>' +
					'<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

				//editables 

				//text editable
				$('#username')
					.editable({
						type: 'text',
						name: 'username'
					});



				//select2 editable
				var countries = [];
				$.each({
					"CA": "Canada",
					"IN": "India",
					"NL": "Netherlands",
					"TR": "Turkey",
					"US": "United States"
				}, function(k, v) {
					countries.push({
						id: k,
						text: v
					});
				});

				var cities = [];
				cities["CA"] = [];
				$.each(["Toronto", "Ottawa", "Calgary", "Vancouver"], function(k, v) {
					cities["CA"].push({
						id: v,
						text: v
					});
				});
				cities["IN"] = [];
				$.each(["Delhi", "Mumbai", "Bangalore"], function(k, v) {
					cities["IN"].push({
						id: v,
						text: v
					});
				});
				cities["NL"] = [];
				$.each(["Amsterdam", "Rotterdam", "The Hague"], function(k, v) {
					cities["NL"].push({
						id: v,
						text: v
					});
				});
				cities["TR"] = [];
				$.each(["Ankara", "Istanbul", "Izmir"], function(k, v) {
					cities["TR"].push({
						id: v,
						text: v
					});
				});
				cities["US"] = [];
				$.each(["New York", "Miami", "Los Angeles", "Chicago", "Wysconsin"], function(k, v) {
					cities["US"].push({
						id: v,
						text: v
					});
				});

				var currentValue = "NL";
				$('#country').editable({
					type: 'select2',
					value: 'NL',
					//onblur:'ignore',
					source: countries,
					select2: {
						'width': 140
					},
					success: function(response, newValue) {
						if (currentValue == newValue) return;
						currentValue = newValue;

						var new_source = (!newValue || newValue == "") ? [] : cities[newValue];

						//the destroy method is causing errors in x-editable v1.4.6+
						//it worked fine in v1.4.5
						/**			
						$('#city').editable('destroy').editable({
							type: 'select2',
							source: new_source
						}).editable('setValue', null);
						*/

						//so we remove it altogether and create a new element
						var city = $('#city').removeAttr('id').get(0);
						$(city).clone().attr('id', 'city').text('Select City').editable({
							type: 'select2',
							value: null,
							//onblur:'ignore',
							source: new_source,
							select2: {
								'width': 140
							}
						}).insertAfter(city); //insert it after previous instance
						$(city).remove(); //remove previous instance

					}
				});

				$('#city').editable({
					type: 'select2',
					value: 'Amsterdam',
					//onblur:'ignore',
					source: cities[currentValue],
					select2: {
						'width': 140
					}
				});



				//custom date editable
				$('#signup').editable({
					type: 'adate',
					date: {
						//datepicker plugin options
						format: 'yyyy/mm/dd',
						viewformat: 'yyyy/mm/dd',
						weekStart: 1

						//,nativeUI: true//if true and browser support input[type=date], native browser control will be used
						//,format: 'yyyy-mm-dd',
						//viewformat: 'yyyy-mm-dd'
					}
				})

				$('#age').editable({
					type: 'spinner',
					name: 'age',
					spinner: {
						min: 16,
						max: 99,
						step: 1,
						on_sides: true
						//,nativeUI: true//if true and browser support input[type=number], native browser control will be used
					}
				});


				$('#login').editable({
					type: 'slider',
					name: 'login',

					slider: {
						min: 1,
						max: 50,
						width: 100
						//,nativeUI: true//if true and browser support input[type=range], native browser control will be used
					},
					success: function(response, newValue) {
						if (parseInt(newValue) == 1)
							$(this).html(newValue + " hour ago");
						else $(this).html(newValue + " hours ago");
					}
				});

				$('#about').editable({
					mode: 'inline',
					type: 'wysiwyg',
					name: 'about',

					wysiwyg: {
						//css : {'max-width':'300px'}
					},
					success: function(response, newValue) {}
				});



				// *** editable avatar *** //
				try { //ie8 throws some harmless exceptions, so let's catch'em

					//first let's add a fake appendChild method for Image element for browsers that have a problem with this
					//because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
					try {
						document.createElement('IMG').appendChild(document.createElement('B'));
					} catch (e) {
						Image.prototype.appendChild = function(el) {}
					}

					var last_gritter
					$('#avatar').editable({
						type: 'image',
						name: 'avatar',
						value: null,
						//onblur: 'ignore',  //don't reset or hide editable onblur?!
						image: {
							//specify ace file input plugin's options here
							btn_choose: 'Change Avatar',
							droppable: true,
							maxSize: 110000, //~100Kb

							//and a few extra ones here
							name: 'avatar', //put the field name here as well, will be used inside the custom plugin
							on_error: function(error_type) { //on_error function will be called when the selected file has a problem
								if (last_gritter) $.gritter.remove(last_gritter);
								if (error_type == 1) { //file format error
									last_gritter = $.gritter.add({
										title: 'File is not an image!',
										text: 'Please choose a jpg|gif|png image!',
										class_name: 'gritter-error gritter-center'
									});
								} else if (error_type == 2) { //file size rror
									last_gritter = $.gritter.add({
										title: 'File too big!',
										text: 'Image size should not exceed 100Kb!',
										class_name: 'gritter-error gritter-center'
									});
								} else { //other error
								}
							},
							on_success: function() {
								$.gritter.removeAll();
							}
						},
						url: function(params) {
							// ***UPDATE AVATAR HERE*** //
							//for a working upload example you can replace the contents of this function with 
							//examples/profile-avatar-update.js

							var deferred = new $.Deferred

							var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
							if (!value || value.length == 0) {
								deferred.resolve();
								return deferred.promise();
							}


							//dummy upload
							setTimeout(function() {
								if ("FileReader" in window) {
									//for browsers that have a thumbnail of selected image
									var thumb = $('#avatar').next().find('img').data('thumb');
									if (thumb) $('#avatar').get(0).src = thumb;
								}

								deferred.resolve({
									'status': 'OK'
								});

								if (last_gritter) $.gritter.remove(last_gritter);
								last_gritter = $.gritter.add({
									title: 'Avatar Updated!',
									text: 'Uploading to server can be easily implemented. A working example is included with the template.',
									class_name: 'gritter-info gritter-center'
								});

							}, parseInt(Math.random() * 800 + 800))

							return deferred.promise();

							// ***END OF UPDATE AVATAR HERE*** //
						},

						success: function(response, newValue) {}
					})
				} catch (e) {}

				/**
				//let's display edit mode by default?
				var blank_image = true;//somehow you determine if image is initially blank or not, or you just want to display file input at first
				if(blank_image) {
					$('#avatar').editable('show').on('hidden', function(e, reason) {
						if(reason == 'onblur') {
							$('#avatar').editable('show');
							return;
						}
						$('#avatar').off('hidden');
					})
				}
				*/

				//another option is using modals
				$('#avatar2').on('click', function() {
					var modal =
						'<div class="modal fade">\
					  <div class="modal-dialog">\
					   <div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Change Avatar</h4>\
						</div>\
						\
						<form class="no-margin">\
						 <div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
						 </div>\
						\
						 <div class="modal-footer center">\
							<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Submit</button>\
							<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
						 </div>\
						</form>\
					  </div>\
					 </div>\
					</div>';


					var modal = $(modal);
					modal.modal("show").on("hidden", function() {
						modal.remove();
					});

					var working = false;

					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style: 'well',
						btn_choose: 'Click to choose new avatar',
						btn_change: null,
						no_icon: 'ace-icon fa fa-picture-o',
						thumbnail: 'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
					});

					form.on('submit', function() {
						if (!file.data('ace_input_files')) return false;

						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");

						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();

							modal.modal("hide");

							var thumb = file.next().find('img').data('thumb');
							if (thumb) $('#avatar2').get(0).src = thumb;

							working = false;
						});


						setTimeout(function() {
							deferred.resolve();
						}, parseInt(Math.random() * 800 + 800));

						return false;
					});

				});



				//////////////////////////////
				$('#profile-feed-1').ace_scroll({
					height: '250px',
					mouseWheelLock: true,
					alwaysVisible: true
				});

				$('a[ data-original-title]').tooltip();

				$('.easy-pie-chart.percentage').each(function() {
					var barColor = $(this).data('color') || '#555';
					var trackColor = '#E2E2E2';
					var size = parseInt($(this).data('size')) || 72;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size / 10),
						animate: false,
						size: size
					}).css('color', barColor);
				});

				///////////////////////////////////////////

				//right & left position
				//show the user info on right or left depending on its position
				$('#user-profile-2 .memberdiv').on('mouseenter touchstart', function() {
					var $this = $(this);
					var $parent = $this.closest('.tab-pane');

					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $this.offset();
					var w2 = $this.width();

					var place = 'left';
					if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) place = 'right';

					$this.find('.popover').removeClass('right left').addClass(place);
				}).on('click', function(e) {
					e.preventDefault();
				});


				///////////////////////////////////////////
				$('#user-profile-3')
					.find('input[type=file]').ace_file_input({
						style: 'well',
						btn_choose: 'Change avatar',
						btn_change: null,
						no_icon: 'ace-icon fa fa-picture-o',
						thumbnail: 'large',
						droppable: true,

						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
					})
					.end().find('button[type=reset]').on(ace.click_event, function() {
						$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
					})
					.end().find('.date-picker').datepicker().next().on(ace.click_event, function() {
						$(this).prev().focus();
					})
				$('.input-mask-phone').mask('(999) 999-9999');

				$('#user-profile-3').find('input[type=file]').ace_file_input('show_file_list', [{
					type: 'image',
					name: $('#avatar').attr('src')
				}]);


				////////////////////
				//change profile
				$('[data-toggle="buttons"] .btn').on('click', function(e) {
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('.user-profile').parent().addClass('hide');
					$('#user-profile-' + which).parent().removeClass('hide');
				});



				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					try {
						$('.editable').editable('destroy');
					} catch (e) {}
					$('[class*=select2]').remove();
				});
			});
		</script>
</body>

</html>