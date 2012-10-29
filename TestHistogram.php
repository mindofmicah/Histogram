<?php
require 'Histogram.php';
class TestHistogram extends PHPUnit_Framework_TestCase 
{
    protected $values = array();
    public function testConstructor()
    {
		$this->assertInstanceOf('Histogram', new Histogram());
    }
	public function testConstructorWithValue()
	{
		$histogram = new Histogram(3,5);
		$this->assertEquals(array(3=>1, 5=>1), $histogram->getValues());
	}
    
	public function testAddValueNewValue()
    {
		$histogram = new Histogram();
		$histogram->addValue(3);
		$this->assertEquals(array(3=>1), $histogram->getValues());
    }

	public function testAddValueExistingEntry()
	{
		$histogram = new Histogram(3);
		$histogram->addValue(3);
		$this->assertEquals(array(3=>2), $histogram->getValues());
	}

    public function testBuildFromArray()
    {

    }

    public function testBuildFromObjects()
    {

    }

    public function testGetValues()
    {
		$histogram = new Mock_Histogram();
		$this->assertEquals(array(), $histogram->getValues());
	
		$histogram->values = array(1=>3);
		$this->assertEquals(array(1=>3), $histogram->getValues());
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
