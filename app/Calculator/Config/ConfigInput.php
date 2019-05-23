<?php
namespace Calculator\Config;

class ConfigInput
{
	const MAX_DATA_PER_ROW = '6';
	const YEAR_REGEX = '([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))';
	const USER_TYPES = ['natural', 'legal'];
	const TRANSACTION_TYPES = ['cash_in', 'cash_out'];
	const AVAILABLE_CURRENCIES = ['EUR', 'USD', 'JPY'];
}
?>