<?php

class Popov_Base_Helper_Array
{
	/**
	 * @param array $array
	 * @param int $position
	 * @param array $insertArray
	 * @return array
	 */
	public function arrayInsert(array $array, $position, array $insertArray)
	{
		if ($insertArray)
		{
			$firstArray = array_splice ($array, 0, $position);
			$array = array_merge ($firstArray, $insertArray, $array);
		}

		return $array;
	}

}