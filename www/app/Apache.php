<?php
namespace App;

use \Agent;
use \File;
use Illuminate\Support\Collection;

class Apache
{
	/**
	 * Executes the specified Apache command
	 *
	 * @param String $command
	 * @return Null
	 */
	public function execute($command)
	{
		$safeCommands = [
			'start'         => 'started',
			'stop'          => 'stopped',
			'restart'       => 'restarted',
			'reload'        => 'reloaded',
			'graceful'      => 'gracefully started',
			'graceful-stop' => 'gracefully stopped'
		];

		if (array_key_exists($command, $safeCommands)) {
			exec("service apache2 {$command}");
		}
	}

	/**
	 * Return the contents of the error log in reverse
	 *
	 * @return Array
	 */
	public function getErrorLog()
	{
		$logContents = file($this->getErrorLogPath());
		$errorLog    = [];

		foreach ($logContents as $line) {
			$regex = '/^\[([^\]]+)\] \[([^\]]+)\] (?:\[client ([^\]]+)\])?\s*(.*)$/i';

			preg_match($regex, $line, $matches);

			if (empty($matches[1])) {
				continue;
			}

			$errorLog[] = [
				'date'     => $matches[1],
				'severity' => $matches[2],
				'client'   => $matches[3],
				'message'  => $matches[4]
			];

			$errorLog = json_decode(json_encode($errorLog), false);
		}

		return new Collection($errorLog);
	}

	/**
	 * Retrieve the path to the error log depending
	 * on the OS
	 *
	 * @return String
	 */
	private function getErrorLogPath()
	{
		$locations = [
			'Linux' => '/var/log/apache2',
			'OS X'  => '/var/log/apache2'
		];

		if (array_key_exists(Agent::platform(), $locations) === true) {
			return $locations[Agent::platform()].'/error.log';
		}
	}
}