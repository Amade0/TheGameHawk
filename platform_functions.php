<?php

define("platform0", "PC");
define("platform1", "PlayStation 4");
define("platform2", "XBox One");
define("platform3", "Android");
define("platform4", "iOS");

//inputs: five boolean values, each corresponding to one of the defined platforms
//output: a bitwise concatenation of the inputs
function encode_platformList($p0, $p1, $p2, $p3, $p4)
{
	//shift
	$p1 = $p1 * 2;
	$p2 = $p2 * 4;
	$p3 = $p3 * 8;
	$p4 = $p4 * 16;
	//merge
	$encoding = $p4 | $p3 | $p2 | $p1 | $p0;
	return $encoding;
}

//input: an encoded platform list (see above)
//output: a comma-separated list of the names of platforms represented in the string (or None if 0)
function decode_platformList($encoding)
{
	$decoding = '';
	$firstEntry = true;
	if($encoding & 1)
	{
		$decoding = platform0;
		$firstEntry = false;
	}
	if($encoding & 2)
	{
		if($firstEntry)
		{
			$decoding = platform1;
			$firstEntry = false;
		}
		else
		{
			$decoding = $decoding . ', ' . platform1;
		}
	}
	if($encoding & 4)
	{
		if($firstEntry)
		{
			$decoding = platform2;
			$firstEntry = false;
		}
		else
		{
			$decoding = $decoding . ', ' . platform2;
		}
	}
	if($encoding & 8)
	{
		if($firstEntry)
		{
			$decoding = platform3;
			$firstEntry = false;
		}
		else
		{
			$decoding = $decoding . ', ' . platform3;
		}
	}
	if($encoding & 16)
	{
		if($firstEntry)
		{
			$decoding = platform4;
			$firstEntry = false;
		}
		else
		{
			$decoding = $decoding . ', ' . platform4;
		}
	}
	if($decoding == '')
	{
		return 'None';
	}
	else
	{
		return $decoding;
	}
}

?>