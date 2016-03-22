<?php
require_once('../src/bootstrap.php');

use \Xicrow\Debug\Timer;

$scriptStart = microtime(true);
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Xicrow/Debug/Timer</title>
		<style type="text/css">
			pre {
				margin: 5px;
				padding: 0;
				font-family: Consolas, Courier, monospace;
			}
		</style>
	</head>

	<body>
		<?php
		// Only add "ALL" and "PHP boostrap" timer, if we have request time in float, otherwise it is unusable
		if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
			Timer::custom('ALL', $_SERVER['REQUEST_TIME_FLOAT']);
			Timer::custom('PHP bootstrap', $_SERVER['REQUEST_TIME_FLOAT'], $scriptStart);
		}
		Timer::custom('script', $scriptStart);

		// No name test
		Timer::start();
		Timer::stop();

		// Loop timers
		for ($i = 1; $i <= 2; $i++) {
			Timer::start('Loop level 1');
			for ($j = 1; $j <= 2; $j++) {
				Timer::start('Loop level 2');
				for ($k = 1; $k <= 2; $k++) {
					Timer::start('Loop level 3');
					Timer::stop();
				}
				Timer::stop();
			}
			Timer::stop();
		}

		// Callback timers
		Timer::callback(null, 'strpos', 'Hello world', 'world');
		Timer::callback(null, 'array_sum', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
		Timer::callback(null, 'min', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
		Timer::callback(null, 'max', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
		Timer::callback(null, ['Xicrow\Debug\Debugger', 'debug'], [1, 2, 3]);
		Timer::callback(null, function () {
			return true;
		});

		// Custom timers
		Timer::custom('-5 minutes', strtotime('-5minutes'), time());
		Timer::custom('+5 minutes', time(), strtotime('+5minutes'));

		// Show all timers
		Timer::showAll();
		?>
	</body>
</html>
