<?php

require_once dirname(__FILE__) . "/../application/libraries/stringmeth.php";

class StringMethTest extends PHPUnit_Framework_TestCase
{
	
	public function testStripConsonants()
	{
		$string = "Hello";
		$vowels = array(
			'e',
			'o',
		);
		
		$this->assertEquals(StringMeth::getVowels($string), $vowels);
	}
	
	public function testSlugify()
	{
		$string = "Cookies are delicious";
		$expected = 'cookies-are-delicious';
		
		$this->assertEquals(StringMeth::slugify($string), $expected);
		
		$string = "Hi Mom! I like muffins!";
		$expected = 'hi-mom-i-like-muffins';
		
		$this->assertEquals(StringMeth::slugify($string), $expected);
		
		$string = "Hey there   billy, I like cheese.  ";
		$expected = "hey-there-billy-i-like-cheese";
		
		$this->assertEquals(StringMeth::slugify($string), $expected);
	}
}
