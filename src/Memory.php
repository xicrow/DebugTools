<?php
namespace Xicrow\PhpDebug;

/**
 * Class Memory
 *
 * @package Xicrow\PhpDebug
 * @codeCoverageIgnore
 */
class Memory extends Profiler {
	/**
	 * Force the unit to display memory usage in (B|KB|MB|GB|TB|PB)
	 *
	 * @var bool
	 */
	public static $forceDisplayUnit = false;

	/**
	 * @inheritdoc
	 */
	public static function getMetric() {
		// Return current memory usage
		return memory_get_usage();
	}

	/**
	 * @inheritdoc
	 */
	public static function getMetricFormatted($metric) {
		// Return formatted metric
		return self::formatBytes($metric, 4, self::$forceDisplayUnit);
	}

	/**
	 * @inheritdoc
	 */
	public static function getMetricResult($start, $stop) {
		// Return result in bytes
		return ($stop - $start);
	}

	/**
	 * @inheritdoc
	 */
	public static function getMetricResultFormatted($result) {
		// Return formatted result
		return self::formatBytes($result, 4, self::$forceDisplayUnit);
	}
}
