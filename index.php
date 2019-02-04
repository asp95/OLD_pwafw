<?php 
require_once "core.php";
$core = new Core();
$core->start();

$mainDir = $core->getMainDir(); // necesita mejoras
?>

<html>
	<head>
		<?php if ($config = $core->getConfig()->getVar("system.initial-scale-string")){ 
			// ir a getConfig()
		?>
			<meta name="viewport" content="<?php echo $config; ?>">
		<?php } ?>
			<link rel="stylesheet" href="/<?php echo $mainDir ?>/css.php">
			<script src="/<?php echo $mainDir ?>/js.php"></script>
			<script>window.addEventListener("DOMContentLoaded", core.init);var MAIN_DIR="<?php echo $mainDir; ?>"</script>
			<?php /*
				css.php compila todos los archivos de la carpeta /css/
				js.php compila todos los archivos de la carpeta /js/

				ir a core.init() ( /js/main.js::core.init )


			*/ ?>
	</head>
	<body>
		<div id="main-content"></div>
		<div id="components-cache" style="display: none;"></div>
	</body>
</html>


<?php $core->end(); ?>