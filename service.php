<?php echo json_encode(array(
		"componentsHtml" => array(
			"a1" => "<a1>a1</a1>",
			"a2" => "<a data-href='link'>a2</a>",
			"a3" => "<a3 data-textcontent='caca.pis'>a3</a3>",
			"a4" => "<a data-href='link'>tormenta</a>"
		),
		"design" => array(
			"_clear_" => "#main-content",
			"a1" => "#main-content",
			"a2" => "#main-content .a1",
			"a3" => "#main-content .a2",
			"a4" => "#main-content"
		),
		"data" => array(
			"a1" => array(
				"name" => "casa 1"
			),
			"a2" => array(
				"name" => "casa 2",
				"link" => "http://google.com/"
			),
			"a3" => array(
				"caca" => array("pis" => "casa 3"),
			),
			"a4" => array(
				"name" => "casa 4",
				"link" =>"/pwafw/tormenta?type=miriam",
			),
		)
	)); ?>