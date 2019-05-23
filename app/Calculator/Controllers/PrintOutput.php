<?php
namespace Calculator\Controllers;

use Calculator\Controllers\LegalCashOut;
use Calculator\Controllers\LegalCashIn;
use Calculator\Controllers\NaturalCashOut;
use Calculator\Controllers\NaturalCashIn;
use \DateTime;

class PrintOutput
{
	public function printOutput($input)
	{
		$previuosWeekDay = 0;
		$previousDate = new DateTime('1900-01-01');
		$table = array();

		foreach ($input as $value) {
			$currentDate = new DateTime(date('Y-m-d',strtotime($value[0])));
			$interval = $previousDate->diff($currentDate);
			if(
				($previuosWeekDay == 0 && date('w',strtotime($value[0])) > $previuosWeekDay)
				|| (date('w',strtotime($value[0])) != 0 
					&& date('w',strtotime($value[0])) < $previuosWeekDay)
				|| ($interval->d > 7))
			{
				if(!empty($table))unset($table);
				$table = array();
			}
			$previuosWeekDay = date('w',strtotime($value[0]));
			$previousDate = $currentDate;
			$discountAvailable=3;
			$count = 0;
			foreach($table as $discounts)
			{
				if($discounts['userId']==$value[1])
				$discountAvailable=$discountAvailable-$discounts['discount'];
				if($count>3)
				{
					$discountAvailable=0;
					break;
				}
				if($discountAvailable<0)
				{
					$discountAvailable=0;
					break;
				}
				$count++;
			}
			switch (true)
			{
				case ($value[2]=='legal' && $value[3]=='cash_out'):
				echo LegalCashOut::transaction($value[4],$value[5])."\n";
				break;
				case ($value[2]=='legal' && $value[3]=='cash_in'):
				echo LegalCashIn::transaction($value[4],$value[5])."\n";
				break;
				case ($value[2]=='natural' && $value[3]=='cash_out'):
				echo NaturalCashOut::transaction($value[4],$value[5],$discountAvailable)."\n";
				if($discountAvailable>0)
				{
					if(NaturalCashOut::transaction($value[4],$value[5],$discountAvailable)>0){
						$discount=3;
					}
					else{
						$discount=NaturalCashOut::calculateCommisionValue($value[4]);
						$discount=NaturalCashOut::discount($discount,$value[5]);
					}
					$transaction = array(
				    	    'userId' =>  $value[1],
                    	    'discount' =>  $discount,
					);
					array_push($table,$transaction);
				}
				break;
				case ($value[2]=='natural' && $value[3]=='cash_in'):
				echo NaturalCashIn::transaction($value[4],$value[5])."\n";
				break;
				default:
				var_dump($value);
				break;
			}
		}
	}
}