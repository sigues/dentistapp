<?php
/**
 * Creates ics file for importing into calendars such as iCal.
 *
 * @author Floyd Resler
 */
class ical {
	private $properties=array();
	private $attendees=array();
	
	const DAILY="DAILY";
	const WEEKLY="WEEKLY";
	const MONTHLY="MONTHLY";
	const YEARLY="YEARLY";
	
	/**
	 *
	 * @param string $event
	 * The $event can be the event name along with the date and time. For example: Bob's Party 2/25/2012 6 pm 
	 */
	function __construct($event="") {
		//Set some default values
		//Get timezone info
		$timezone=new DateTimeZone(date_default_timezone_get());
		$time=new DateTime("now",$timezone);
		$this->setTimeZone(date_default_timezone_get());
		$this->setGMTOffset($timezone->getOffset($time)/3600);
		
		//Set daylight savings time for United States
		$this->setDaylightStart("2007-03-11 02:00:00");
		$this->setDaylightEnd("2007-11-04 02:00:00");
		if($event) {
			$parts=explode(" ",$event);
			for($i=0;$i<count($parts);$i++) {
				$item=$parts[$i];
				$altered=strtolower($item);
				$date=strtotime($item);
				if($altered=="am" || $altered=="pm") {
					$date=strtotime($parts[$i-1].$item);
				}
				if($date!==false) { //Got a date/time value
					if(strpos($altered,":")!==false || strpos($altered,"pm")!==false || strpos($altered,"am")!==false) { //Time
						
						if(!$startTime) {
							$startTime=date("H:i",$date);
						} else {
							$endTime=date("H:i",$date);
						}
					} else { //Date
						if(!$startDate) {
							$startDate=date("Y-m-d",$date);
						} else {
							$endDate=date("Y-m-d",$date);
						}
					}
				} else {
					$this->eventTitle.="$item ";
				}
			}
			
			//Set event dates and times
			if(!$endDate) {
				$endDate=$startDate;
			}
			
			if($startTime && !$startDate) {
				throw new Exception("A start time of $startTime was found but no start date could be found.");
			}
			if($startDate>$endDate) {
				throw new Exception("The start date of an event cannot be after the end date.");
			}
			if($startTime) {
				$this->setEventStartTime("$startDate $startTime");
			} else {
				$this->setEventStartDate($startDate);

			}
			if($endTime) {
				$this->setEventEndTime("$endDate $endTime");
			} else {
				$this->setEventEndDate($endDate);
			}
		}
	}
	
	/**
	 *
	 * @param string $key
	 * @param strng $value 
	 */
	function __set($key,$value) {
		$this->properties[$key]=$value;
	}
	
	/**
	 *
	 * @param string $key
	 * @return string 
	 */
	function __get($key) {
            if(isset($this->properties[$key])){
		return $this->properties[$key];
            }
	}
	
	/**
	 *
	 * @param string $time
	 * @throws Exception 
	 */
	function setEventStartTime($time) {
		$t=strtotime($time);
		if($t===false) {
			throw new Exception('Could not convert $time to a time value.');
		}
		$this->eventStartTime=date("Ymd",$t)."T".date("His",$t);
	}
	
	function setEventEndTime($time) {
		$t=strtotime($time);
		if($t===false) {
			throw new Exception('Could not convert $time to a time value.');
		}
		$this->eventEndTime=date("Ymd",$t)."T".date("His",$t);
	}
	
	
	/**
	 *
	 * @param string $date
	 * @throws Exception 
	 */
	function setEventStartDate($date) {
		$d=strtotime($date);
		if($d===false) {
			throw new Exception('Could not convert $date to a date value.');
		}
		$this->eventStartDate=date("Ymd",$d);
	}
	
	/**
	 *
	 * @param string $date
	 * @throws Exception 
	 */
	function setEventEndDate($date) {
		$d=strtotime($date);
		if($d===false) {
			throw new Exception('Could not convert $date to a date value.');
		}
		$this->eventEndDate=date("Ymd",$d);
	}
	
	/**
	 *
	 * @param string $title
	 * @throws Exception 
	 */
	function setEventTitle($title) {
		if(!$title) {
			throw new Exception("The event title is empty.");
		}
		$this->eventTitle=$title;
	}
	
	/**
	 *
	 * @param string $timezone 
	 */
	function setTimeZone($timezone) {
		$this->timezone=$timezone;
	}
	
	/**
	 *
	 * @param integer $offset 
	 */
	function setGMTOffset($offset) {
		$plusMinus=substr($offset,0,1);
		if($plusMinus!="-" && $plusMinus!="+") {
			throw new Exception("The GMT offset must begin with a + or a -");
		}
		$offset=str_replace($plusMinus,"",$offset);
		
		if(strlen($offset)<4) {
			$offset="0$offset";
		}
		$this->GMTOffset=$plusMinus.$offset;
	}
	
	/**
	 *
	 * @param string $start
	 * @throws Exception 
	 */
	function setDaylightStart($start) {
		$date=strtotime($start);
		if($date===false) {
			throw new Exception("Could not understand $start for the daylight savings time start date.");
		}
		$this->daylightStart=$start;
	}
	
	/**
	 *
	 * @param string $end
	 * @throws Exception 
	 */
	function setDaylightEnd($end) {
		$date=strtotime($end);
		if($date===false) {
			throw new Exception("Could not understand $end for the daylight savings time start date.");
		}
		$this->daylightEnd=$end;
	}
	
	/**
	 *
	 * @param string $frequency
	 * @param integer $interval
	 * @param array $options 
	 */
	function setFrequency($frequency,$interval=1,$options=array()) {
		$this->frequency=$frequency;
		$this->interval=$interval;
		$this->frequencyOptions=$options;
	}
	
	/**
	 *
	 * @param string $location 
	 */
	function setLocation($location) {
		$this->location=$location;
	}
	
	/**
	 *
	 * @param string $url 
	 */
	function setURL($url) {
		$this->url=$url;
	}
	
	/**
	 *
	 * @param string $notes 
	 */
	function setNotes($notes) {
		$this->notes=$notes;
	}
	
	/**
	 *
	 * @param string $email
	 * @param string $name
	 * @param boolean $rsvp 
	 */
	function addAttendee($email,$name="",$rsvp=true) {
		$this->attendees[$email]=array("name"=>$name,"rsvp"=>"$rsvp");
	}
	
	/**
	 *
	 * @param string $name
	 * @param string $email 
	 */
	function setOrganizer($name,$email) {
		$this->organizerName=$name;
		$this->organizerEmail=$email;
	}
	
	/**
	 *
	 * @return string
	 * @throws Exception 
	 */
	function createEvent() {
		//DST GMT offset
		$dstOffset=$this->GMTOffset+1;
		$gmtOffset=$this->GMTOffset."00";
		$s="BEGIN:VCALENDAR
CALSCALE:GREGORIAN
VERSION:2.0
X-WR-CALNAME:$this->eventTitle
BEGIN:VTIMEZONE
TZID:$this->timezone
BEGIN:DAYLIGHT
TZOFFSETFROM:$gmtOffset
";
		//Find DST rules
		$start=strtotime($this->daylightStart);
		$dow=strtoupper(date("D",$start));
		$dow=substr($dow,0,2);
		$day=date("d",$start);
		$month=date("n",$start);
		$week=ceil($day/7);
		$s.="RRULE:FREQ=YEARLY;BYMONTH=$month;BYDAY=".$week.$dow."\n";
		$s.="DTSTART:".date("Ymd",$start)."T".date("Hi",$start)."00\n";
		$s.="TZNAME:".$this->getTimezoneAbbr($dstOffset)."\n";
		$plusMinus=substr($dstOffset,0,1);
		$dstOffset=str_replace($plusMinus,"",$dstOffset);
		if($dstOffset<10) {
			$dstOffset="0$dstOffset";
		}
		$dstOffset=$plusMinus.$dstOffset."00";
		$s.="TZOFFSETTO:$dstOffset
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:$dstOffset
";
		$end=strtotime($this->daylightEnd);
		$dow=strtoupper(date("D",$end));
		$dow=substr($dow,0,2);
		$day=date("d",$end);
		$month=date("n",$end);
		$week=ceil($day/7);
		$s.="RRULE:FREQ=YEARLY;BYMONTH=$month;BYDAY=".$week.$dow."\n";
		$s.="DTSTART:".date("Ymd",$end)."T".date("Hi",$end)."00\n";
		$s.="TZNAME:".$this->getTimezoneAbbr($this->GMTOffset)."\n";
		$s.="TZOFFSETTO:".$this->GMTOffset."00\n";
		$s.="END:STANDARD
END:VTIMEZONE
BEGIN:VEVENT
SUMMARY: $this->eventTitle
CREATED:".date("Ymd",time())."T".date("His",time())."T\n";
		$s.="UID:".uniqid()."\n";
		
		//Start time
		if($this->eventStartTime) {
			$s.="DTSTART;TZID=$this->timezone:$this->eventStartTime\n";
		} elseif($this->eventStartDate) {
			$s.="DTSTART;VALUE=DATE:$this->eventStartDate\n";
		}
		
		//End time
		if($this->eventEndTime) {
			$s.="DTEND;TZID=$this->timezone:$this->eventEndTime\n";
		} elseif($this->eventEndDate) {
			$s.="DTEND;VALUE=DATE:$this->eventEndDate\n";
		}
		
		//Frequency
		if($this->frequency) {
			$s.="RRULE:FREQ=$this->frequency";
			if($this->interval) {
				$s.=";INTERVAL=$this->interval";
			}
			if($this->frequencyOptions) {
				foreach($this->frequencyOptions as $option=>$value) {
					$s.=";$option=$value";
				}
			}
			$s.="\n";
		}
		
		if($this->location) {
			$s.="LOCATION:$this->location\n";
		}
		if($this->url) {
			$s.="URL;VALUE=URI:$this->url\n";
		}
		if($this->notes) {
			$s.="DESCRIPTION:$this->notes\n";
		}
		
		//Attendees & Organizer
		if($this->organizerName) {
			$s.="ORGANIZER;CN=\"$this->organizerName\":mailto:$this->organizerEmail
ATTENDEE;ROLE=CHAIR;PARTSTAT=ACCEPTED;CN=\"$this->organizerName\"
 ;RSVP=FALSE:mailto:$this->organizerEmail
";
		}
		
		if(count($this->attendees)) {
			if(!$this->organizerName) {
				throw new Exception("When adding attendees you must also set the organizer by using the setOrganizer method");
			}
			foreach($this->attendees as $email=>$data) {
				$rsvp="FALSE";
				if($data["rsvp"]) {
					$rsvp="TRUE";
				}
				$s.="ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN=\"$data[name]\";
RSVP=$rsvp:mailto:$email\n";
			}
		}
		//End Output
		$s.="END:VEVENT
END:VCALENDAR
";
		return $s;
	}
	
	function getTimezoneAbbr($dstOffset) {
		$dstOffset*=3600;
		$list=timezone_abbreviations_list();
                $abbreviation="";
		foreach($list as $abbr=>$data) {
			foreach($data as $items) {
				if($items["timezone_id"]==$this->timezone && $items["offset"]==$dstOffset && !$abbreviation) {
					$abbreviation=$abbr;
				}
			}
		}
		return strtoupper($abbreviation);
	}
}
?>
