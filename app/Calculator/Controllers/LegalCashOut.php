<?php
namespace Calculator\Controllers;

use \Calculator\Config\ConfigCommision;
use \Calculator\Controllers\Math;

class LegalCashOut
{
	public function transaction($amount,$currency)
	{
		switch($currency)
		{
			case 'JPY':
			return LegalCashOut::transactionJpy($amount);
			break;
			case 'USD':
			return LegalCashOut::transactionUsd($amount);
			break;			
			default:
			return LegalCashOut::transactionEur($amount);
			break;
			break;
		}
	}
	protected function transactionJpy($amount)
	{
		return LegalCashOut::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_JPY,
			ConfigCommision::LEGAL_CASH_OUT_MINIMUM,
			ConfigCommision::ROUND_PRECISION_JPY
			);
	}
	protected function transactionUsd($amount)
	{
		return LegalCashOut::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_USD,
			ConfigCommision::LEGAL_CASH_OUT_MINIMUM,
			ConfigCommision::ROUND_PRECISION
			);	
	}
	protected function transactionEur($amount)
	{
		return LegalCashOut::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_EUR,
			ConfigCommision::LEGAL_CASH_OUT_MINIMUM,
			ConfigCommision::ROUND_PRECISION
			);
	}

	protected function calculateCommision($amount, $rate, $minimum, $precision)
	{
		$commision = LegalCashOut::calculateCommisionValue($amount);
		if($commision/$rate<$minimum)
		{
			return Math::roundUp(
				$minimum*$rate,
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
		return $number*ConfigCommision::LEGAL_CASH_OUT_PERCENTAGE/100;
	}
}