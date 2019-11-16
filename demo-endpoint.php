<?php
require_once 'vendor/autoload.php';

use Bpstr\Elements\Base\ElementInterface;

if ($_GET['a']) {

	if (is_subclass_of($_GET['a'], ElementInterface::class)) {
		echo new $_GET['a']('b');
	}
	echo 'nooe';

	echo $_GET['a'];

}

