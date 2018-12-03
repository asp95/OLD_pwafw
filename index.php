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
		<?php /*
			foreach ($core->getCssList() as $cssFile => $optionalData) {
				echo '<link rel="stylesheet" href="'.$cssFile.'" '.$core->buildAttributes($optionalData).'>';
				echo "\n";
			}

			foreach ($core->getJsList() as $jsFile => $optionalData) {
				echo '<link rel="stylesheet" href="'.$jsFile.'" '.$core->buildAttributes($optionalData).'>';
				echo "\n";
			}*/
		 ?>
	</head>
	<body>
		<?php /* echo $core->getTemplates(); */ ?>
	</body>
</html>


<?php $core->end(); ?>