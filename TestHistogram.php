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
		$object1 = new stdClass();
		$object1->val = 2;
		$object2 = new stdClass();
		$object2->val = 1;

		$objects = array($object1, $object2);

		$histogram = Histogram::buildFromObjects($objects, 'val');
		$this->assertInstanceOf('Histogram', $histogram);
		$this->assertEquals(array(1=>1,2=>1), $histogram->getValues());
    }

	public function testBuildFromObjectsInvalidKey()
	{
		$objects = array(new stdClass);		
		$histogram = Histogram::buildFromObjects($objects, 'some property that does not exist');
		$this->assertEquals(array(), $histogram->getValues());
	}

    public function testGetValues()
    {
		$histogram = new Mock_Histogram();
		$this->assertEquals(array(), $histogram->getValues());
	
		$histogram->values = array(1=>3);
		$this->assertEquals(array(1=>3), $histogram->getValues());
    }
    public function testOrderRegular()
    {
		$histogram = new Histogram(2,2,1,3,3,3);
		$histogram->order();

		$expected = array(3=>3,2=>2,1=>1);
		foreach ($histogram->getValues() as $index=>$value) {
			$this->assertEquals(key($expected), $index);			
			$this->assertEquals(current($expected), $value);
			next($expected);
		}
    }
	public function testOrderInverse()
	{
		$histogram = new Histogram(2,2,1,3,3,3);
		$histogram->order(true);

		$expected = array(1=>1,2=>2,3=>3);
		foreach ($histogram->getValues() as $index=>$value) {
			$this->assertEquals(key($expected), $index);			
			$this->assertEquals(current($expected), $value);
			next($expected);
		}
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
