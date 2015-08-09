<?php namespace App\Http\Controllers;
use App\Models\Website;
use App\Models\SearchStats;
use App\Library\Paginator;
use Input;
use Redirect;

class SearchController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Search Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the SearchResult page
	| after checking all the inputs
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
	 * Show the search result to the user.
	 *
	 * @return Response
	 */
	public function Search()
	{
		$links = null;
		$query = Input::get('q');
		$lucky = Input::get('lucky');

		$pageNum = Input::get('p') != "" ? Input::get('p') : 1;
		$stats = new SearchStats();

		if(!empty($query) && $query != ""){
			
			//performing the search and calculating elapsed time
			$starttime = microtime(true);
			$links =  Website::getByQueryString($query);
			$endtime = microtime(true);
			$timediff = $endtime - $starttime;

			//wrapping info into a class
			$stats->elapsed = $timediff;
			$stats->total = count($links);
			$stats->currentPage = $pageNum;
			$stats->pages = ceil(count($links)/10);
			$stats->max = $stats->pages < 11 ? $stats->pages+1 : 11;

			//pagination of results
			$links = Paginator::page($links,$pageNum);

		} else {
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
