<?php
namespace tests\Calculator\Models;

use PHPUnit\Framework\TestCase;

class TestCommandLine extends TestCase
{

    private $CommandLine;

 	  public function setUp() {
        $this->TestCommandLine = new TestCommandLine();
 	  }
    public function tearDown() {
        $this->TestCommandLine = null;
    }
    public function testTrue() {
        $this->assertNULL($this->TestCommandLine->__construct());
    }
    public function testFalse() {
        $this->assertFalse(False);
   	}	
}