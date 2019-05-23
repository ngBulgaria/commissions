<?php
namespace Calculator\Models;

class CommandLine
{
	protected $args;

    public function __construct($args)
    {
        $this->args = $args;
    }
}