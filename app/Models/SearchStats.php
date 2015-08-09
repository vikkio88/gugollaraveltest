<?php
namespace App\Models;

class SearchStats {
	
	public $elapsedTime;
	public $total;
	public $pages;
	public $currentPage;

	// a small fucntion in order to convert microtime in time
	public function SetElapsedFromMicro($microtime) {
		$h = floor($s / 3600);
    	$s -= $h * 3600;
    	$m = floor($s / 60);
    	$s -= $m * 60;
    	$this->elapsedTime = $h.':'.sprintf('%02d', $m).':'.sprintf('%02d', $s);
    	return $this->elapsedTime;
	}
}