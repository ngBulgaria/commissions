<?php
namespace Calculator\Controllers;

use \Calculator\Config\ConfigCommision;
use \Calculator\Controllers\Math;

class NaturalCashOut
{
	public function transaction($amount, $currency, $discountAvailable)
	{
		switch($currency)
		{
			case 'JPY':
			return NaturalCashOut::transactionJpy($amount, $discountAvailable);
			break;
			case 'USD':
			return NaturalCashOut::transactionUsd($amount, $discountAvailable);
			break;			
			default:
			return NaturalCashOut::transactionEur($amount, $discountAvailable);
			break;
			break;
		}
	}
	public function discount($discount,$currency)
	{
		switch($currency)
		{
			case 'JPY':
			return Math::roundUp(
				$discount/ConfigCommision::RATE_EUR_JPY,
				ConfigCommision::ROUND_PRECISION
				);
			break;
			case 'USD':
			return Math::roundUp(
				$discount/ConfigCommision::RATE_EUR_USD,
				ConfigCommision::ROUND_PRECISION
				);
			break;
			default:
			return Math::roundUp(
				$discount/ConfigCommision::RATE_EUR_EUR,
				ConfigCommision::ROUND_PRECISION
				);
			break;	

		}
	}
	protected function transactionJpy($amount, $discountAvailable)
	{
		return NaturalCashOut::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_JPY,
			$discountAvailable,
			ConfigCommision::ROUND_PRECISION_JPY
			);
	}
	protected function transactionUsd($amount, $discountAvailable)
	{
		return NaturalCashOut::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_USD,
			$discountAvailable,
			ConfigCommision::ROUND_PRECISION
			);	
	}
	protected function transactionEur($amount, $discountAvailable)
	{
		return NaturalCashOut::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_EUR,
			$discountAvailable,
			ConfigCommision::ROUND_PRECISION
			);
	}

	protected function calculateCommision($amount, $rate, $discountAvailable, $precision)
	{
		$commision = NaturalCashOut::calculateCommisionValue($amount);
		if($discountAvailable>0)
		{
			if($commision-$discountAvailable*$rate<0)
			{
				return Math::roundUp(
					0,
					$precision
				);
			}
			else
			{
				return Math::roundUp(
					$commision-$discountAvailable*$rate,
					$precision
				);
			}

		}
		else
		{
			return Math::roundUp(
				$commision,
				$precision
			);
		}
	}
	public function calculateCommisionValue($number)
	{
		return $number*ConfigCommision::NATURAL_CASH_OUT_PERCENTAGE/100;
	}
}