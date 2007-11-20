<?php

/**
 * P4A - PHP For Applications.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * To contact the authors write to:									<br>
 * CreaLabs															<br>
 * Via Medail, 32													<br>
 * 10144 Torino (Italy)												<br>
 * Web:    {@link http://www.crealabs.it}							<br>
 * E-mail: {@link mailto:info@crealabs.it info@crealabs.it}
 *
 * The latest version of p4a can be obtained from:
 * {@link http://p4a.sourceforge.net}
 *
 * @link http://p4a.sourceforge.net
 * @link http://www.crealabs.it
 * @link mailto:info@crealabs.it info@crealabs.it
 * @copyright CreaLabs
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 * @author Fabrizio Balliano <fabrizio.balliano@crealabs.it>
 * @author Andrea Giardina <andrea.giardina@crealabs.it>
 * @package p4a
 */

	/**
	 * HTML "button".
	 * It's useful to trigger actions in easy way (with/without graphics).
	 * @author Andrea Giardina <andrea.giardina@crealabs.it>
	 * @author Fabrizio Balliano <fabrizio.balliano@crealabs.it>
	 * @package p4a
	 */
	class P4A_Button extends P4A_Widget
	{
		/**
		* The icon used by button, if null standard html button is used.
		* @access private
		* @var string
		*/
		var $_icon = null;
		var $_size = 32;
		
		var $menu = null;

		/**
		 * Class constructor.
		 * @param string			Mnemonic identifier for the object.
		 * @param string			The icon taken from icon set (file name without extension).
		 * @access private
		 */
		function P4A_Button($name, $icon = null)
		{
			parent::P4A_Widget($name);
			if ($icon !== null) {
				$this->setIcon($icon);
			}

			$this->setDefaultLabel();
		}
		
		function addMenu()
		{
			$this->build("p4a_menu", "menu");
			return $this->menu;
		}

		/**
		 * @param string $label
		 */
		function setLabel($label)
		{
			parent::setLabel($label);
		}

		/**
		 * Sets the icon for the button.
		 * @param string		The icon taken from icon set (file name without extension).
		 * @access public
		 */
		function setIcon($icon)
		{
			$this->_icon = $icon;
		}

		/**
		 * Returns the icon for the button.
		 * @access public
		 * @return string
		 */
		function getIcon()
		{
			return $this->_icon;
		}

		function setSize($size)
		{
			$this->_size = strtolower($size);
		}

		function getSize()
		{
			return $this->_size;
		}

		/**
		 * Retuns the HTML rendered button.
		 * @access public
		 * @return string
		 */
		function getAsString()
		{
			$id = $this->getId();
			$text = $this->getLabel();
			
			$tooltip = $this->getTooltip();
			if ($tooltip) $tooltip = ",tooltip:'$tooltip'";
			
			$handler = "";
			if (isset($this->actions['onclick'])) $handler = ",handler:executeEvent";
			
			$menu = "";
			if (is_object($this->menu)) {
				$menu = ",menu:" . $this->menu->getAsString();
			}
			
			return "new Ext.Button({id:'$id',text:'$text'{$menu}{$tooltip}{$handler}})";
			
			/*
			$id = $this->getId();
			if (!$this->isVisible()) {
				return "<span id='$id' class='hidden'></span>";
			}

			$p4a =& P4A::singleton();
			$header = '' ;
			$footer = '' ;
			$enabled = $this->isEnabled();

			if ($this->_icon != null and !$p4a->isHandheld()) {
				$size = $this->getSize();
				if (strpos($size, 'x') !== false) {
					list($width, $height) = explode('x', $size);
				} else {
					$width = $size;
					$height = $size;
				}

				if ($enabled) {
					$header .= '<a class="link_button" href="#" ';
				} else {
					$header .= '<span class="link_button" ';
				}
				$footer .= '><img class="img_button';

				if ($enabled) {
					$footer .= ' clickable';
				}

				$img_src = P4A_ICONS_PATH . "/{$height}/{$this->_icon}";
				if (!$enabled) {
					$img_src .= "_disabled";
				}
				$img_src .= '.' . P4A_ICONS_EXTENSION;

				$msg = __($this->getValue());
				if (empty($msg)) {
					$msg = __($this->_icon);
				}

				$accesskey = $this->getProperty("accesskey");
				if (strlen($accesskey) > 0) {
					$msg = "[$accesskey] $msg";
				}

				$msg = htmlspecialchars($msg);
				$footer .= "\" src=\"$img_src\" alt=\"$msg\" title=\"$msg\" width=\"$width\" height=\"$height\" ";
				$footer .= ' />';

				if ($this->getLabel()) {
					$footer .= '<span style="margin:5px;">' . $this->getLabel() . '</span>';
				}

				if ($enabled) {
					$footer .= '</a>';
				} else {
					$footer .= '</span>';
				}
			} else {
				$header .= '<input type="button" class="';
				if ($enabled) {
					$header .= 'clickable ';
				}
				$header .= 'border_box font4 no_print" ';
				$header .= 'value="' . htmlspecialchars(__($this->getValue())) . '" ';
				if (!$enabled) {
					$header .= ' disabled="disabled"';
				}
				$footer = ' />';
			}

			$sReturn = "";
			$sReturn .= $header . $this->composeStringProperties();
			if ($enabled) {
				$sReturn .= $this->composeStringActions();
			}
			$sReturn .= "$footer\n";
			$sReturn = "<span id='$id'>{$sReturn}</span>";
			return $sReturn;
*/
		}

		/**
		 * Composes a string containing all the HTML properties of the widget.
		 * Note: it will also contain the name and the value.
		 * @return string
		 * @access public
		 */
		function composeStringProperties()
		{
			$sReturn = "";
			$p4a =& p4a::singleton();
			$properties = $this->properties;

			if (isset($properties['value'])) {
				unset($properties['value']);
			}

			foreach ($properties as $property_name=>$property_value) {
				$sReturn .= $property_name . '="' . htmlspecialchars($property_value) . '" ' ;
			}

			$sReturn .= $this->composeStringStyle();
			return $sReturn;
		}
	}