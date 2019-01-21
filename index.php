<?php 

require_once "core.php";

$core = new Core("tienda1");
$core->start();

?>

<html>
	<head>
		<?php if ($config = $core->getConfig()->getVar("system.initial-scale-string")){ ?>
			<meta name="viewport" content="<?php echo $config; ?>">
		<?php } ?>
			<link rel="stylesheet" href="css.php">
			<script src="js.php"></script>
	</head>
	<body>
		<?php   ?>
	</body>
</html>


<?php $core->end(); ?>