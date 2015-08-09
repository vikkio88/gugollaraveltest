<?php
namespace App\Library;
/*
a simple class to manage with a static function the pagination 
*/
class Paginator {
	public static function page($results, $pageNum =1)
	{
		$forPage = 10;
		if($pageNum!=-1 && $forPage != -1 && count($results)){ //if result is not null and paging filters are set
			//chunking result array
			$pagedResults = array_chunk($results,$forPage);
			if($pageNum<=count($pagedResults))
				return $pagedResults[$pageNum-1];
			else
				return $pagedResults[count($pagedResults)-1];
		}

		return $results;
	}
}