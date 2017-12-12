<?php
/**
 * @category    Popov
 * @package     Popov_Base
 * @copyright   Copyright (c) http://agere.com.ua
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author 		Popov Sergiy
 */

/**
 * Base class for source classes used to populate SELECT drop downs with values
 */
class Popov_Base_Model_Source_Config extends Popov_Base_Model_Source_Abstract {

	protected $_rootNode;
	protected $_childNode;
	protected $_defaultTranslationModule;

	protected function _getAllOptions() {
		/** @var $core Popov_Base_Helper_Data */
		$core = Mage::helper(strtolower('Popov_Base'));

		$result = array();
		foreach ($core->getSortedXmlChildren(Mage::getConfig()->getNode($this->_rootNode), $this->_childNode) as $key => $options) {
			$module = isset($options['module']) ? ((string) $options['module']) : $this->_defaultTranslationModule;
			$result[] = array('label' => Mage::helper($module)->__((string) $options->title), 'value' => $key);
		}

		return $result;
	}
}