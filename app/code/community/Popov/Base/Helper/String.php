<?php
/**
 * Improve core magento string class
 *
 * @category Popov
 * @package Popov_Base
 * @author Popov Sergiy <popov.serhii@gmail.com>
 * @datetime: 21.04.14 16:38
 */
class Popov_Base_Helper_String {

	/**
	 * Simple string
	 *
	 * @var string
	 */
	private $_string;

	public function __construct($string = '') {
		$this->_string = $string;
	}

	public static function create($string) {
		return new self($string);
	}

	/**
	 * Return the number of words in a string
	 *
	 * @return int number
	 */
	public function countWords() {
		$string = $this->_string;

		$string= str_replace("&#039;", "'", $string);
		$t = array(' ', "\t", '=', '+', '-', '*', '/', '\\', ',', '.', ';', ':', '[', ']', '{', '}', '(', ')', '<', '>', '&', '%', '$', '@', '#', '^', '!', '?', '~'); // separators
		$string= str_replace($t, " ", $string);
		$string= trim(preg_replace("/\s+/", " ", $string));
		$num = 0;
		if ($this->strlen() > 0) {
			$word_array = explode(" ", $string);
			$num = count($word_array);
		}
		return $num;
	}

	public function strtolower() {
		$string = mb_strtolower($this->_string, "UTF-8");
		return new self($string);
	}

	public function strlen() {
		// Return mb_strlen with encoding UTF-8.
		return mb_strlen($this->_string, "UTF-8");
	}

	/**
	 * @return string
	 * @link http://oleg.in-da.ru/dev/php/funkcija_ucfirst_i_kirilica_v_kodirovke_utf-8
	 */
	public function ucfirst() {
		$string = $this->_string;
		$string = mb_strtoupper(mb_substr($string, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($string, 1, mb_strlen($string), 'UTF-8');
		return new self($string);
	}

	public function stripTags($allowableTags = '') {
		$string = strip_tags($this->_string, $allowableTags);
		return new self($string);
	}

	/**
	 *
	 * param string $str The text string to split
	 * param integer $words The number of words to extract. Defaults to 15
	 */
	public function truncateWord($words = 15) {
		$arr = preg_split("/[\s]+/",  $this->_string, $words + 1);
		$arr = array_slice($arr, 0, $words);
		$string = join(' ', $arr);
		return new self($string);
	}

	/**
	 * Advanced sprintf process pattern with string key
	 *
	 * Can replace by %key% pattern
	 *
	 * @param $vars
	 * @param string $char
	 * @return mixed
	 * @link http://www.php.net/manual/en/function.sprintf.php#83779
	 */
	public function sprintfKey($vars, $char = '%') {
		$str = $this->_string;
		$tmp = array();
		foreach($vars as $k => $v) {
			$tmp[$char . $k . $char] = $v;
		}
		$string = str_replace(array_keys($tmp), array_values($tmp), $str);
		return new self($string);
	}

	public function replace($search, $replace) {
		$string = str_replace($search, $replace, $this->_string);
		return new self($string);
	}

	/**
	 * @param $glue
	 * @return array
	 */
	public function explode($delimiter) {
		return explode($delimiter, $this->_string);
	}

	public function toCamelCase() {
		$parts = explode('_', $this->_string);

		$string = '';
		foreach ($parts as $part) {
			$string .= ucfirst($part);
		}
		return new self($string);
	}

	/**
	 * Get substring which exist in two string
	 *
	 * @param string $str
	 * @return $this Return string if they more then three symbols
	 * @todo full string compare. Now compare start from zero left symbol.
	 */
	public function subEq($str) {
		$sub = '';
		foreach (str_split($this->_string) as $i => $symbol) {
			if ($str{$i} === $symbol) {
				$sub .= $symbol;
			}
		}

		return new self($sub);
	}

	public function __toString() {
		return $this->_string;
	}

	public function toString() {
		return $this->__toString();
	}

}