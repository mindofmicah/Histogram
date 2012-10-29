<?php
require 'Histogram.php';
class TestHistogram extends PHPUnit_Framework_TestCase 
{
    protected $values = array();
    public function testConstructor()
    {

    }
    public function testAddValue()
    {

    }

    public function testBuildFromArray()
    {

    }

    public function testBuildFromObjects()
    {

    }

    public function testGetValues()
    {

    }
    public function testOrder()
    {

    }
}

class Mock_Histogram extends Histogram
{
	public function __get($name)
	{
		return $this->$name;
	}

	public function __set($name, $value)
	{
		$this->$name = $value;
	}
}
