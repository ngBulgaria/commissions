<?php
namespace Calculator\Controllers;

use \Calculator\Config\ConfigCommision;
use \Calculator\Controllers\Math;

class NaturalCashIn
{
	public function transaction($amount,$currency)
	{
		switch($currency)
		{
			case 'JPY':
			return NaturalCashIn::transactionJpy($amount);
			break;
			case 'USD':
			return NaturalCashIn::transactionUsd($amount);
			break;			
			default:
			return NaturalCashIn::transactionEur($amount);
			break;
			break;
		}
	}
	protected function transactionJpy($amount)
	{
		return NaturalCashIn::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_JPY,
			ConfigCommision::NATURAL_CASH_IN_MAXIMUM,
			ConfigCommision::ROUND_PRECISION_JPY
			);
	}
	protected function transactionUsd($amount)
	{
		return NaturalCashIn::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_USD,
			ConfigCommision::NATURAL_CASH_IN_MAXIMUM,
			ConfigCommision::ROUND_PRECISION
			);	
	}
	protected function transactionEur($amount)
	{
		return NaturalCashIn::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_EUR,
			ConfigCommision::NATURAL_CASH_IN_MAXIMUM,
			ConfigCommision::ROUND_PRECISION
			);
	}

	protected function calculateCommision($amount, $rate, $maximum, $precision)
	{
		$commision = NaturalCashIn::calculateCommisionValue($amount);
		if($commision/$rate>$maximum)
		{
			return Math::roundUp(
				$maximum*$rate,
				$precision
			);
		}
		else
		{
			return Math::roundUp(
				$commision,
				$precision
			);
		}
	}
	protected function calculateCommisionValue($number)
	{
		return $number*ConfigCommision::NATURAL_CASH_IN_PERCENTAGE/100;
	}
}