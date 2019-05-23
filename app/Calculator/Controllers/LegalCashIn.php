<?php
namespace Calculator\Controllers;

use \Calculator\Config\ConfigCommision;
use \Calculator\Controllers\Math;

class LegalCashIn
{
	public function transaction($amount,$currency)
	{
		switch($currency)
		{
			case 'JPY':
			return LegalCashIn::transactionJpy($amount);
			break;
			case 'USD':
			return LegalCashIn::transactionUsd($amount);
			break;			
			default:
			return LegalCashIn::transactionEur($amount);
			break;
			break;
		}
	}
	protected function transactionJpy($amount)
	{
		return LegalCashIn::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_JPY,
			ConfigCommision::LEGAL_CASH_IN_MAXIMUM,
			ConfigCommision::ROUND_PRECISION_JPY
			);
	}
	protected function transactionUsd($amount)
	{
		return LegalCashIn::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_USD,
			ConfigCommision::LEGAL_CASH_IN_MAXIMUM,
			ConfigCommision::ROUND_PRECISION
			);	
	}
	protected function transactionEur($amount)
	{
		return LegalCashIn::calculateCommision(
			$amount,
			ConfigCommision::RATE_EUR_EUR,
			ConfigCommision::LEGAL_CASH_IN_MAXIMUM,
			ConfigCommision::ROUND_PRECISION
			);
	}

	protected function calculateCommision($amount, $rate, $maximum, $precision)
	{
		$commision = LegalCashIn::calculateCommisionValue($amount);
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
		return $number*ConfigCommision::LEGAL_CASH_IN_PERCENTAGE/100;
	}
}