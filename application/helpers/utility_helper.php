<?php
	function date_time($stamp){
		$datetimeFormat = 'd-m-Y H:i:s';

		$date = new \DateTime();
		$date->setTimestamp($stamp);
		return $date->format($datetimeFormat);
	}
	
	


	
?>