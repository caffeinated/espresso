<?php
namespace App;

use Agent;
use Config;
use File;

class VirtualHosts
{
	/**
	 * Get the path of the hosts file depending on the OS.
	 *
	 * @return String|Null
	 */
	public function getHostsPath()
	{
		$locations = [
			'Linux' => '/etc',
			'OS X'  => '/etc',
		];

		if (array_key_exists(Agent::platform(), $locations) === true) {
			return $locations[Agent::platform()].'/hosts';
		}
		
		return null;
	}

	/**
	 * Get all enabled virtual hosts.
	 *
	 * @return Array|Null
	 */
	public function getVirtualHosts()
	{
		$locations = [
			'Linux' => '/etc/apache2/sites-enabled',
			'OS X'  => '/etc/apache2/sites-enabled',
		];

		if (array_key_exists(Agent::platform(), $locations) === true) {
			return array_values(array_diff(scandir($locations[Agent::platform()]), array('..', '.', '000-default.conf')));
		}

		return null;
	}

	/**
	 * Read and parse the contents of the hosts file.
	 *
	 * @param String $section
	 * @return Array
	 */
	public function readHosts($section = 'hosts')
	{
		$hostsFileArray = [];
		$hostsArray     = [];
		$hostsFile      = file_get_contents($this->getHostsPath(), 'r');
		$hostsFileArray = explode("\n", $hostsFile);

		foreach ($hostsFileArray as $line) {
			if ((stripos($line, '127.0.0.1') !== false) and ((stripos($line, '127.0.0.1')) < 3)) {
				$lineArray     = explode('127.0.0.1', $line);
				$hostsArray[] = trim($lineArray[1]);
			}
		}

		// Remove localhost from results
		$key = array_search('localhost', $hostsArray);

		if ( ! is_null($key)) {
			unset($hostsArray[$key]);
		}

		switch ($section) {
			case 'file':
				return $hostsFileArray;
			break;

			case 'hosts':
				return array_values($hostsArray);
			break;
		}
	}

	/**
	 * Read and parse the contents of the specified virtual host file.
	 * 
	 * @param  integer $key
	 * @return array
	 */
	public function readvHost($key)
	{
		$locations = [
			'Linux' => '/etc/apache2/sites-enabled',
			'OS X'  => '/etc/apache2/sites-enabled',
		];

		$allvHosts     = $this->getVirtualHosts();
		$vHostFile     = $locations[Agent::platform()].'/'.$allvHosts[$key];
		$vHostsContent = file_get_contents($vHostFile);

		preg_match_all("'(#|)<VirtualHost(.*?)<\/VirtualHost>'si", $vHostsContent, $matches);

		foreach ($matches[0] as $key => $vHost) {
			preg_match("'DocumentRoot \"(.*?)\"'si", $vHost, $documentRoot);
			preg_match("'ServerName (.*?)\n'si", $vHost, $serverName);

			$vHostsArray[$key]['documentRoot'] = trim($documentRoot[1]);
			$vHostsArray[$key]['serverName']   = trim($serverName[1]);
		}

		return $vHostsArray;
	}

	/**
	 * Gets all directory paths of the defined project directories
	 *
	 * @return Array
	 */
	public function getProjects()
	{
		$projects = [];

		foreach (Config::get('virtualhosts.projectDirectories') as $directory) {
			$directories = File::directories($directory);

			foreach ($directories as $value) {
				$folder = explode('/', $value);
				$folder = end($folder);

				$projects[$folder] = $value;
			}
		}

		return $projects;
	}

	/**
	 * Create a new virtual host configuration file
	 *
	 * @param String $documentRoot
	 * @param String $serverName
	 * @return Bool
	 */
	public function createVirtualHost($documentRoot, $serverName)
	{
		$vHost  = "\n\n";
		$vHost .= "<VirtualHost 127.0.0.1>\n";
		$vHost .= "\tDocumentRoot \"{$documentRoot}\"\n";
		$vHost .= "\tServerName {$serverName}\n";
		$vHost .= "\tAccessFileName .htaccess.local .htaccess\n";
		$vHost .= "\t<Directory \"{$documentRoot}\">\n";
		$vHost .= "\t\tOptions FollowSymLinks Indexes\r\n";
		$vHost .= "\t\tAllowOverride All\r\n";
		$vHost .= "\t\tOrder deny,allow\r\n";
		$vHost .= "\t\tAllow from 127.0.0.1\r\n";
		$vHost .= "\t\tDeny from all\r\n";
		$vHost .= "\t\tRequire all granted\r\n";
		$vHost .= "\t</Directory>\r\n";
		$vHost .= "</VirtualHost>\n";

		switch (Agent::platform()) {
			case 'Linux':
			case 'OS X':
				$path     = '/etc/apache2/sites-available/';
				$filename = $serverName.'.conf';
				$fullPath = $path.$filename;
				break;

		}

		if (file_put_contents($fullPath, $vHost) !== false) {
			return true;
		}
	}

	/**
	 * Create a new host entry
	 *
	 * @param String $serverName
	 * @return Bool
	 */
	public function createHost($serverName)
	{
		$hostsFileArray = $this->readHosts('file');

		$newContent = '';

		foreach ($hostsFileArray as $line) {
			$newContent .= $line."\n";
		}

		$newContent .= "127.0.0.1\t{$serverName}\n";

		if (file_put_contents($this->getHostsPath(), trim($newContent)) !== false) {
			return true;
		}
	}

	/**
	 * Enables a virtual host site
	 *
	 * @param String $serverName
	 * @return Null
	 */
	public function enable($serverName)
	{
		exec("a2ensite {$serverName}");
	}

	/**
	 * Disables a virtual host site
	 *
	 * @param String $serverName
	 * @return Null
	 */
	public function disable($serverName)
	{
		exec("a2dissite {$serverName}");
	}
}