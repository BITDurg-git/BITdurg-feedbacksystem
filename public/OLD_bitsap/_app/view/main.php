<!DOCTYPE html>
<html>

<head>
	<title><?php echo $res->title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- W3.CSS file -->
	<link rel="stylesheet" type="text/css" href="<?php echo $res->public_folder_path; ?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $res->public_folder_path; ?>/css/w3.css">
	<!--link rel="stylesheet" type="text/css" href="<?php echo $res->public_folder_path; ?>/css/indigo-theme.css"-->

	<style type="text/css">
		<?php include('_public/css/indigo-theme.css');?>
	</style>
	

	<!-- Angular.js file -->
	<script type="text/javascript" src="<?php echo $res->public_folder_path; ?>/js/angular.js"></script>
	<script type="text/javascript" src="<?php echo $res->public_folder_path; ?>/js/jquery.js"></script>

	<style type="text/css">
		a {text-decoration: none;}
		.uline {text-decoration: underline;}
		.scroll {overflow-x: auto;}
	</style>
</head>
<body class="w3-theme-l5">

	<?php (isset($res->show))?include("$res->show"):'';?>

</body>
</html>