<?php
namespace App\Composers;

use App\VirtualHosts;

class SidebarComposer
{
	/**
	 * @var VirtualHosts
	 */
	protected $virtualHosts;

	public function __construct(VirtualHosts $virtualHosts)
	{
		$this->virtualHosts = $virtualHosts;
	}

	public function compose($view)
	{
		$view->with('virtualHosts', $this->virtualHosts->readHosts());
	}
}