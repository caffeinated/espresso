<?php
namespace App\Http\Controllers;

use App\Apache;
use App\VirtualHosts;
use Illuminate\Routing\Controller;

use \Input;
use \Redirect;

class VirtualHostsController extends Controller
{
	/**
	 * @var VirtualHosts
	 */
	protected $virtualHosts;

	/**
	 * @var Apache
	 */
	protected $apache;

	public function __construct(VirtualHosts $virtualHosts, Apache $apache)
	{
		$this->virtualHosts = $virtualHosts;
		$this->apache       = $apache;
	}

	public function index()
	{
		$virtualHosts = $this->virtualHosts->readHosts();
		$projects     = $this->virtualHosts->getProjects();

		return view('virtualhosts.index', compact('virtualHosts', 'projects'));
	}

	public function add()
	{
		return view('virtualhosts.add');
	}

	public function store()
	{
		$serverName   = Input::get('serverName');
		$documentRoot = Input::get('documentRoot');

		$this->virtualHosts->createVirtualHost($documentRoot, $serverName);
		$this->virtualHosts->createHost($serverName);

		if (Input::get('enableSite')) {
			$this->virtualHosts->enable($serverName);
		}

		$this->apache->execute('reload');

		return Redirect::to('/');
	}

	public function edit($key)
	{
		$vHost = $this->virtualHosts->readvHost($key);
		$vHost = $vHost[0];

		return view('virtualhosts.edit', compact('vHost'));
	}

	public function update()
	{
		
	}
}