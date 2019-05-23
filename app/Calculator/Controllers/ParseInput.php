<?php
namespace Calculator\Controllers;

use \SplFileObject;
use \Exception;
use \Calculator\Config\ConfigInput;

class ParseInput
{
	protected function validateRow($transactionRow)
    {
        try{
            if(!preg_match(ConfigInput::YEAR_REGEX, $transactionRow[0]) ||
                !is_numeric($transactionRow[1]) ||
                !in_array($transactionRow[2], ConfigInput::USER_TYPES) ||
                !in_array($transactionRow[3], ConfigInput::TRANSACTION_TYPES) ||
                !is_numeric($transactionRow[4]) ||
                !in_array($transactionRow[5], ConfigInput::AVAILABLE_CURRENCIES))
                {
                    throw new Exception();
                }
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
        
    }

    public function parseCsv($path)
    {
        $file = new SplFileObject($path);
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::READ_AHEAD  |
            SplFileObject::DROP_NEW_LINE
        );
        foreach ($file as $key => $row) {
        list($key) = $row;
        try{
            if(count($row)!=ConfigInput::MAX_DATA_PER_ROW || !ParseInput::validateRow($row))
                {
                    throw new Exception();
                }
        }
        catch (Exception $e){
            exit();
        }
        finally{
            if(count($row)==ConfigInput::MAX_DATA_PER_ROW && ParseInput::validateRow($row))
                {
                    yield $row;
                }
        }
        }
    }
}