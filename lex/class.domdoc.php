<?php
/*
 Ratter by Siim Tiilen aka Baron Holbach <eritikass@gmail.com> is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License.
 http://creativecommons.org/licenses/by-sa/3.0/us/
 
 all isk donations welcome in eve
 
 All Eve Related Materials are Property Of CCP Games (  http://www.ccpgames.com/ )
*/


/**
 * DOMDocument handler for lazy use
 *
 * @uses 		DOMDocument
 * @link 		http://www.php.net/domxml
 */
class domdoc extends DOMDocument {

	/**
	 * name for fixworker function
	 *
	 * @var 	string
	 */
	protected $fixworker = null;

	/**
	 * if createElement value is string
	 * then value is converted to DOMText
	 * ( using DOMDocument::createTextNode )
	 * and used instead of createElement string value
	 *
	 * THIS CONVERSION WILL ALSO MAKE ESCAPE
	 *
	 * @var 	bool
	 */
	public $createElement_StrVal_to_textNode = false;

	/**
	 * set fixworkder function
	 *
	 * @param 	string	$name = null
	 * @return 	void
	 * @access 	public
	 */
	public function set_fixworker($name = null) {
		if (is_null($name)) {
			$this->fixworker = null;
		} elseif (function_exists($name)) {
			$this->fixworker = $name;
		}
	}

	/**
	 * create elemet with cdata
	 *
	 * @param 	string		$name
	 * @param 	string		$value
	 * @param 	bool		$fixworker = true
	 * @return 	DOMElement
	 * @access 	public
	 */
	public function CDATA($name, $value, $fixworker = true) {
		if ($fixworker && $this->fixworker) {
			$value = call_user_func($this->fixworker, $value, $this);
		}

		$element = $this->createElement($name);
		$element->appendChild($this->createCDATASection($value));

		return $element;
	}

	/**
	 * Enter description here...
	 *
	 * @param 	unknown_type 	$name
	 * @param 	array 			$elements
	 * @param 	array 			$optional
	 * @return 	DOMDocument
	 */
	public function createblock($name, array $elements, array $optional = array()) {
		$bodyBlock = $this->createElement($name);

		// add setAttribute to useonly if need
		if( isset($optional['setAttribute']) && isset($optional['useonly']) ) {
			foreach ((array )$optional['setAttribute'] as $key_ => $value_) {
				if( !in_array( $key_ , (array)$optional['useonly'] ) ) {
					$optional['useonly'][] = $key_;
				}
			}
		} elseif( !isset($optional['setAttribute']) ) {
			$optional['setAttribute'] = array();
		}

		// use filter useonly ifset
		$elements2 = $elements;
		if (isset($optional['useonly'])) {
			$elements = array();
			foreach ((array )$optional['useonly'] as $value_) {
				if (isset($elements2[$value_])) {
					$elements[$value_] = $elements2[$value_];
				}
			}
		}

		foreach ($elements as $name_ => $value_) {
			// use filter, notuse - if set
			if (isset($optional['notuse']) && is_array($optional['notuse']) && in_array($name_, $optional['notuse'])) {
				continue;
			}

			if (isset($optional['cdata']) && is_array($optional['cdata']) && in_array($name_,$optional['cdata'])) {
				$tag = $this->CDATA($name_,$value_);
			} elseif (isset($optional['dateformat'][$name_])) {
				if (is_array($optional['dateformat'][$name_])) {
					$tag = $this->createElement($name_, date($optional['dateformat'][$name_][0], (int)$value_));
				} else {
					$tag = $this->createElement($name_, date($optional['dateformat'][$name_], (int)$value_));
				}
				if (isset($optional['dateformat'][$name_][1])) {
					$tag->setAttribute('format', $optional['dateformat'][$name_][1]);
				}
			} else {
				$tag = $this->createElement($name_, $value_);
			}

			if( isset($optional['setAttribute'][$name_]) ) {
				foreach ( $optional['setAttribute'][$name_] as $xmlattrkey => $value_row ) {
					if( mb_substr($value_row,0,1) == '@' ) {
						$value_row = mb_substr($value_row,1);
						if( isset($elements2[$value_row]) ) {
							$tag->setAttribute($xmlattrkey, $elements2[$value_row]);
						}
					} else {
						$tag->setAttribute($xmlattrkey, $value_row);
					}
				}
			}

			$bodyBlock->appendChild($tag);
		}

		if (isset($optional['attributes']) && is_array($optional['attributes'])) {
			foreach ($optional['attributes'] as $name_ => $value_name) {
				if (isset($elements2[$value_name])) {
					$bodyBlock->setAttribute($name_, $elements2[$value_name]);
				}
			}
		}

		return $bodyBlock;
	}

	/**
	 * set headers for xml document
	 *
	 */
	public function setHeader($utf8 = false) {
		header('Content-type: text/xml'.($utf8 ? '; charset=utf-8' : ''));
	}


	/**
	* give format output
	*
	*@param		string		$file=null
	*@return	void
	*@access 	public
	*/
	public function formatoutput($file = null) {
		$this->formatOutput = true;
		if (is_null($file)) {
			echo $this->saveXML();
		} else {
			file_put_contents($file, $this->saveXML());
		}
	}

	/**
	 * Create new element node
	 *
	 * @param 	string 		$name
	 * @param 	string 		$value
	 * @param 	array 		$attributes
	 * @return 	DOMElement
	 */
	public function createElementAtr($name, $value = null, $attributes = array()) {
		if (is_null($value) || ($value instanceof DOMCdataSection)) {
			$tmp = $this->createElement($name);
			if ($value instanceof DOMCdataSection) {
				$tmp->appendChild($value);
			}
		} else {
			$tmp = $this->createElement($name, $value);
		}

		foreach ($attributes as $key => $value) {
			$tmp->setAttribute($key, $value);
		}
		return $tmp;
	}

	/**
	 *	Enter description here...
	 *
	 * @param 	string	$name
	 * @param 	string	$value
	 * @return 	DOMElement
	 */
	public function _create_param($name, $value) {
		return $this->createElementAtr('param', $this->createCDATASection($value), array('name' => $name));
	}

	/**
	 *	Enter description here...
	 *
	 * @param 	array	$params
	 * @param 	mixed	$addhere
	 * @return 	DOMElement
	 */
	public function _create_params(array $params, $addhere = 'params') {
		if (!($addhere instanceof DOMElement)) {
			$addhere = $this->createElement($addhere);
		}
		foreach ($params as $name => $value) {
			$addhere->appendChild($this->_create_param($name, $value));
		}
		return $addhere;
	}

	/**
	 * Create new element node
	 *
	 * @param 	string 		$name
	 * @param 	string 		$value
	 * @return 	DOMElement
	 */
	public function createElement($name, $value = null) {
		if (is_null($value)) {
			return parent::createElement($name);
		} else {
			if ($this->createElement_StrVal_to_textNode && is_string($value)) {
				$element = parent::createElement($name);
				$element->appendChild( $this->createTextNode($value) );
				return $element;
			}
			return parent::createElement($name,$value);
		}
	}

}
