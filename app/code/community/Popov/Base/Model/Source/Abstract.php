<?php
/**
 * @category    Agere
 * @package     Popov_Base
 * @copyright   Copyright (c) http://agere.com.ua
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Popov Sergiy
 */
/**
 * Base class for source classes used to populate SELECT drop downs with values
 */
abstract class Popov_Base_Model_Source_Abstract {

	protected $_options = null;

	/**
	 * Retrieve all options array
	 *
	 * @return array
	 */
	public function getAllOptions() {
		if (is_null($this->_options)) {
			$this->_options = $this->_getAllOptions();
		}

		return $this->_options;
	}

	protected abstract function _getAllOptions();

	/**
	 * Retrieve option array
	 *
	 * @return array
	 */
	public function getOptionArray() {
		$_options = array();
		foreach ($this->getAllOptions() as $option) {
			$_options[$option['value']] = $option['label'];
		}

		return $_options;
	}

	/**
	 * Get a text for option value
	 *
	 * @param string|integer $value
	 * @return string
	 */
	public function getOptionText($value) {
		$options = $this->getAllOptions();
		foreach ($options as $option) {
			if ($option['value'] == $value) {
				return $option['label'];
			}
		}

		return false;
	}

	public function toOptionArray() {
		return $this->getAllOptions();
	}
}