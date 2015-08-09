<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Website extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'websites';


	//The method which will perform the search on the db
	public static function getByQueryString($query) {
		// we get results searching in url or title
		$results = DB::table('websites')
					->where('url', 'LIKE', "%{$query}%")
					->orWhere('title', 'LIKE', "%{$query}%")
					->get();

		//now we search for keyword as well
		$keywordresults = DB::table('websites')
					->where('keywords', 'LIKE', "%{$query}%")
					->get();

		//append if not already there
		foreach($keywordresults as $value) {
	    	if(!in_array($value, $results, true)){
	        	array_push($results, $value);
	    	}
		}

		return $results;
	}
}