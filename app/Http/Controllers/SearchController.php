<?php namespace App\Http\Controllers;
use App\Models\Website;
use App\Models\SearchStats;
use Input;
use Redirect;

class SearchController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function Search()
	{
		$links = null;
		$query = Input::get('q');
		$lucky = Input::get('lucky');
		$stats = new SearchStats();


		if(!empty($query) && $query != ""){
			
			$starttime = microtime(true);
			$links =  Website::getByQueryString($query);
			$endtime = microtime(true);
			$timediff = $endtime - $starttime;

			$stats->elapsed = $timediff;
			$stats->total = count($links);

		} else {
			//$links =  Website::all();
			return Redirect::to("/");
		}

		//If there are results, if lucky is set to true you will be redirect to the first link
		if(!empty($links) && !empty($lucky) && $lucky == true) {
			return Redirect::to($links[0]->url);
		} else {
			return view('search')->with('links', $links)->with('query', $query)->with('stats',$stats);
		}
	}

}
