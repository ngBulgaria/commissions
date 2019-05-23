<?php 
namespace Calculator\Controllers;

use \Exception;
use \Calculator\Config\ConfigCommandLine;
use \Calculator\Models\CommandLine;

class ParseCommandLine extends CommandLine
{
    public function getArgv()
    {
    	try{
    		if(count($this->args)!=ConfigCommandLine::PARAMS_COUNT ||
    			substr($this->args[1],-4)!=ConfigCommandLine::FILE_EXTENSION)
    		{
    			throw new Exception ();
    		}
    		if(!file_exists($this->args[1]))
    		{
     			throw new Exception ();   			
    		}
    	}
    	catch(Exception $e) {
    		exit();
    	}
       	return $this->args[1];
    }
}