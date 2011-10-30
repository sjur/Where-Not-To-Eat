<?php

/*

	A restaurant that is open now, but has at one point in time been closed by the NYC Department of Health
	
	
	
	@Entity
*/

Class Restaurant
{
	private $camis;
	private $dba;
	private $closedDates = array();
	private $newestDate; //newest date is a YYYY-MM-DD representation for displaying previous week or month
	private $address;
	private $cuisine;
	private $yelpScore;
	private $yelpImage="marker.png";
	private $yelpURL;
	private $lat;
	private $lng;
	private $zip;
	
	function __construct($camis, $dba, $closedDate, $address, $cuisine, $yelpScore, $yelpURL, $lat, $lng, $zip) 
	{
		$this->camis = $camis;
		$this->dba = $dba;
		$this->address = $address;
		$this->cuisine = $cuisine;
		$this->yelpURL = $yelpURL;
		$this->lat = $lat;
		$this->lng = $lng;
		$this->zip = $zip;
		
		
		$this->addClosedDate($closedDate);
		$this->yelpScore = $yelpScore;
		
		/*switch ($yelpScore) 
		{
						 
						case '0':	$yelpImage = "marker.png";break; 
						case '1':	$yelpImage = "stars_small_1.png";break;
						case '1.5':	$yelpImage = "stars_small_1_half.png";break;
						case '2':	$yelpImage = "stars_small_2.png";break;
						case '2.5':	$yelpImage = "stars_small_2_half.png";break;
						case '3':	$yelpImage = "stars_small_3.png";break;
						case '3.5':	$yelpImage = "stars_small_3_half.png";break;
						case '4':	$yelpImage = "stars_small_4.png";break;
						case '4.5':	$yelpImage = "stars_small_4_half.png";break;
						case '5':	$yelpImage = "stars_small_5.png";break;
		}*/
	}
	
	function addClosedDate($closedDate)
	{
			
		$this->closedDates[count($this->closedDates)] = date('j M Y',strtotime($closedDate));
		$this->newestDate = date('Ymd',strtotime($closedDate)); 
			
		
	}
	
	function getCamis()
	{
		return $this->camis;
	}
	function getDba()
	{
		return  $this->dba;
	}
	function getAddress()
	{
		return $this->address;	
	}
	function getYelpImage()
	{
		$score = $this->getYelpScore();
		switch ($score) 
		{
						 
						case '0':	$yelpImage = "marker.png";break; 
						case '1':	$yelpImage = "stars_small_1.png";break;
						case '1.5':	$yelpImage = "stars_small_1_half.png";break;
						case '2':	$yelpImage = "stars_small_2.png";break;
						case '2.5':	$yelpImage = "stars_small_2_half.png";break;
						case '3':	$yelpImage = "stars_small_3.png";break;
						case '3.5':	$yelpImage = "stars_small_3_half.png";break;
						case '4':	$yelpImage = "stars_small_4.png";break;
						case '4.5':	$yelpImage = "stars_small_4_half.png";break;
						case '5':	$yelpImage = "stars_small_5.png";break;
		}
		
		return  $yelpImage;	
	}
	function getYelpScore()
	{
		return $this->yelpScore;
	}
	function getYelpUrl()
	{
		return $this->yelpURL;	
	}
	function getCuisine()
	{
		return  $this->cuisine;
	}
	function getClosedDates()
	{
		return  $this->closedDates;	
	}
	function getClosedDatesAsString($delimiter)
	{
		$stringOfDates;
		foreach($this->closedDates as $a)
		{
			$stringOfDates .= $a.$delimiter;		
		}
		$lenght = (strlen($stringOfDates)) - (strlen($delimiter));
		if((count($this->closedDates)>1))
		{
			$times = "times:";	
		}
		else $times = "time:";
		
		return "Closed <span class='bold red'>".count($this->closedDates)."</span> ".$times." <div class='closed_dates bold'>".substr($stringOfDates,0,$lenght)."</div>";
		//return "ostekake";
		//return count($this->closedDates);
	}
	function getLatestClosedDate()
	{
		return $this->closedDates[count($this->closedDates)];	
		
	}
	function getNewestDate()
	{
		return $this->newestDate;
		
	}
	function getLat()
	{
		return  $this->lat;
	}
	function getLng()
	{
		return  $this->lng;
	}

	
}
		
?>