<?php 

require_once "core.php";

$core = new Core("tienda1");
$core->start();
$mainDir = "pwafw";
?>

<html>
	<head>
		<?php if ($config = $core->getConfig()->getVar("system.initial-scale-string")){ ?>
			<meta name="viewport" content="<?php echo $config; ?>">
		<?php } ?>
			<link rel="stylesheet" href="/<?php echo $mainDir ?>/css.php">
			<script src="/<?php echo $mainDir ?>/js.php"></script>
			<script>window.addEventListener("DOMContentLoaded", core.init);var MAIN_DIR="<?php echo $mainDir; ?>"</script>
	</head>
	<body>
		<div id="main-content"></div>
		<div id="components-cache" style="display: none;"></div>
	</body>
</html>


<?php $core->end(); ?>