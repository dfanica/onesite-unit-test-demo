<?php

class StringMeth
{
	/**
	 * Returns only the vowels in the given string.
	 * 
	 * @param string $string
	 * 
	 * @return string
	 */
	public static function getVowels($string)
	{
		$vowels = preg_replace("/[^aeiou]/i", '', $string);
		
		return preg_split('//', $vowels, -1, PREG_SPLIT_NO_EMPTY);
	}
	
	/**
	 * Takes the string and changes spaces into hyphens, and lowercases
	 * the whole thing.
	 * 
	 * @param String $string
	 * 
	 * @return string
	 */
	public static function slugify($string)
	{
		$string = trim($string);
		$string = preg_replace('/[^a-zA-Z0-9 ]/', '', $string);
		$replaces = preg_replace("/ +/", '-', $string);
		
		return strtolower($replaces);
	}
}
