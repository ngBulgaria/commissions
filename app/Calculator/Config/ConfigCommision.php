<?php
namespace Calculator\Config;

class ConfigCommision
{
	const NATURAL_CASH_IN_PERCENTAGE = '0.03';
	const NATURAL_CASH_IN_MAXIMUM = '5';
	const NATURAL_CASH_OUT_PERCENTAGE = '0.3';
	const NATURAL_CASH_OUT_MAX_FREE = '3';
	const NATURAL_CASH_OUT_MAX_COUNT_FREE = '3';

	const LEGAL_CASH_IN_PERCENTAGE = '0.03';
	const LEGAL_CASH_IN_MAXIMUM = '5';
	const LEGAL_CASH_OUT_PERCENTAGE = '0.3';
	const LEGAL_CASH_OUT_MINIMUM = '0.5';

	const RATE_EUR_USD = '1.1497';
	const RATE_EUR_JPY = '129.53';
	const RATE_EUR_EUR = '1';

	const ROUND_PRECISION = '3';
	const ROUND_PRECISION_JPY = '1';
}
?>