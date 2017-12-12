<?php
/**
 * Base helper
 *
 * @category Popov
 * @package Popov_Base
 * @author Popov Sergiy <popov.serhii@gmail.com>
 * @datetime: 26.06.14 12:18
 */
class Popov_Base_Helper_Data {

	public function getSortedXmlChildren($parent, $child, $select = '', $filter = array(), $defaultSortOrder = 0) {
		$sortedResult = array();
		$result = array();
		if ($parent && isset($parent->$child)) {
			foreach ($parent->$child->children() as $key => $options) {
				if ($this->_doesXmlConformsFilter($options, $filter)) {
					$sortOrder = isset($options->sort_order) ? (int) (string) $options->sort_order : $defaultSortOrder;
					if ($sortOrder != 0) {
						if (!isset($sortedResult[$sortOrder])) {
							$sortedResult[$sortOrder] = array();
						}
						$sortedResult[$sortOrder][] = $key;
					} else {
						$result[] = $key;
					}
				}
			}
			ksort($sortedResult);
			$mergedResult = array();
			foreach ($sortedResult as $prioritizedResult) {
				$mergedResult = array_merge($mergedResult, $prioritizedResult);
			}
			$result = array_merge($mergedResult, $result);
		}
		$selectedResult = array();
		if ($select) {
			foreach ($result as $key) {
				$selectedResult[$key] = (string) $parent->$child->$key->$select;
			}
		} else {
			foreach ($result as $key) {
				$selectedResult[$key] = $parent->$child->$key;
			}
		}

		return $selectedResult;
	}

	protected function _doesXmlConformsFilter($xml, $filter) {
		foreach ($filter as $field => $value) {
			if (((string) ($xml->$field)) != $value) {
				return false;
			}
		}

		return true;
	}

}