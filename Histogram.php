<?php
class Histogram
{
	protected $values = array();
	public function __construct($val1 = null)
	{
		$args = func_get_args();
		for ($i = 0, $length = count($args); $i < $length; $i++) {
			$this->addValue($args[$i]);
		}
	}
	public function addValue($value)
	{
		if (array_key_exists($value, $this->values)) {
			$this->values[$value]++;
		} else {
			$this->values[$value] = 1;
		}
	}
	
	public function buildFromArray(array $ary = array(), $key = null)
	{

	}

	public function buildFromObjects(array $ary = array(), $property)
	{

	}

	public function getValues()
	{
		return $this->values;
	}
	public function order($inverse = 0)
	{
		if ($inverse) {
			asort($this->values);
		} else {
			arsort($this->values);
		}
	}
}
