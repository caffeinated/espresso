<?php
namespace App\Http\Controllers\Apache;

use App\Apache;
use Illuminate\Routing\Controller;

class ErrorLogController extends Controller
{
	/**
	 * @var Apache
	 */
	protected $apache;

	public function __construct(Apache $apache)
	{
		$this->apache = $apache;
	}

	public function index()
	{
		return view('apache.errorlog.index');
	}

	public function show()
	{
		$errorLog = $this->apache->getErrorLog();

		return view('apache.errorlog.show', compact('errorLog'));
	}
}