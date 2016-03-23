<?php
require_once('../src/bootstrap.php');

use \Xicrow\Debug\Debugger;
use \Xicrow\Debug\Collection;
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Xicrow/Debug/Debugger</title>
	</head>

	<body>
		<?php
		$closure    = function () {
			return true;
		};
		$stdClass   = (new stdClass());
		$collection = (new Collection([1, 2, 3]));

		function foo() {
			Debugger::showTrace();
		}

		function bar() {
			foo();
		}

		Debugger::debug(null);
		Debugger::debug(true);
		Debugger::debug(false);
		Debugger::debug('string');
		Debugger::debug(123);
		Debugger::debug(123.123);
		Debugger::debug([1, 2, 3]);
		Debugger::debug($closure);
		Debugger::debug($stdClass);
		Debugger::debug($collection);
		Debugger::debug(fopen('../README.md', 'r'));

		Debugger::showTrace();
		foo();
		bar();

		Debugger::debug(Debugger::getCalledFrom());
		Debugger::debug(Debugger::getCalledFrom(1));

		Debugger::reflectClass('\Xicrow\Debug\Collection');
		Debugger::reflectClassProperty('\Xicrow\Debug\Collection', 'items');
		Debugger::reflectClassMethod('\Xicrow\Debug\Collection', 'sort');
		?>
	</body>
</html>
