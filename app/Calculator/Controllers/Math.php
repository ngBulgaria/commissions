<?php
namespace Calculator\Controllers;

use \Calculator\Config\ConfigCommision;

class Math
{
	public function roundUp($number, $precision)
	{
		if($precision==1)
		{
			if(round($number,0)<$number)
			{
				return number_format($number+1,0);
			}
			else
			{
				return number_format($number,0);
			}
		}
		
		else
		{
			$mult = pow(10, $precision);
  			return number_format(ceil($number * $mult) / $mult,2);
		}
	}
}