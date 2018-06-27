<?php
/*
 * e107 website system
 *
 * Copyright (C) 2001-2008 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Form Handler
 *
 * $Source: /cvsroot/e107/e107_0.8/e107_handlers/form_handler.php,v $
 * $Revision: 1.22 $
 * $Date: 2009/01/20 22:59:39 $
 * $Author: secretr $
 *
*/

if (!defined('e107_INIT')) { exit; }

/**
 * Automate Form fields creation. Produced markup is following e107 CSS/XHTML standards
 * If options argument is omitted, default values will be used (which is OK most of the time)
 * Options are intended to handle some very special cases.
 *
 * Overall field options format (array or GET string like this one: var1=val1&var2=val2...):
 *
 *  - id => (mixed) custom id attribute value
 *  if numeric value is passed it'll be just appended to the name e.g. {filed-name}-{value}
 *  if false is passed id will be not created
 *  if empty string is passed (or no 'id' option is found)
 *  in all other cases the value will be used as field id
 * 	default: empty string
 *
 *  - class => (string) field class(es)
 * 	Example: 'tbox select class1 class2 class3'
 * 	NOTE: this will override core classes, so you have to explicit include them!
 * 	default: empty string
 *
 *  - size => (int) size attribute value (used when needed)
 *	default: 40
 * 
 *  - multiple => (bool) - only used with selects
 *	default: false (omitted)
 *
 *  - title (string) title attribute
 *  default: empty string (omitted)
 *
 *  - readonly => (bool) readonly attribute
 * 	default: false
 *
 *  - selected => (bool) selected attribute (used when needed)
 * 	default: false
 *
 *  checked => (bool) checked attribute (used when needed)
 *  default: false
 *  - disabled => (bool) disabled attribute
 *  default: false
 *
 *  - tabindex => (int) tabindex attribute value
 *	default: inner tabindex counter
 *
 *  - other => (string) additional data
 *  Example: 'attribute1="value1" attribute2="value2"'
 *  default: empty string
 */
class e_form
{
	var $_tabindex_counter = 0;
	var $_tabindex_enabled = true;
	var $_cached_attributes = array();
	var $_uc;

	function e_form($enable_tabindex = false)
	{
		$this->_tabindex_enabled = $enable_tabindex;
		//DISABLED IN COMPAT MOD
		//$e107 = &e107::getInstance();
		//$this->_uc = &$e107->user_class;
	}

	function text($name, $value, $maxlength = 200, $options = array())
	{
		$options = $this->format_options('text', $name, $options);
		//never allow id in format name-value for text fields
		return "<input type='text' name='{$name}' value='{$value}' maxlength='{$maxlength}'".$this->get_attributes($options, $name)." />";
	}

	function iconpicker($name, $default, $label, $sc_parameters = '', $ajax = true)
	{
		$e107 = &e107c::getInstance();
		
		$id = $this->name2id($name);
		$sc_parameters .= '&id='.$id;
		$jsfunc = $ajax ? "e107Ajax.toggleUpdate('{$id}-iconpicker', '{$id}-iconpicker-cn', 'sc:iconpicker=".urlencode($sc_parameters)."', '{$id}-iconpicker-ajax', { overlayElement: '{$id}-iconpicker-button' })" : "e107Helper.toggle('{$id}-iconpicker')";
		$ret = $this->text($name, $default).$this->admin_button($name.'-iconpicker-button', $label, 'action', '', array('other' => "onclick=\"{$jsfunc}\""));
		$ret .= "
			<div id='{$id}-iconpicker' class='e-hideme'>
				<div class='expand-container' id='{$id}-iconpicker-cn'>
					".(!$ajax ? $e107->tp->parseTemplate('{ICONPICKER='.$sc_parameters.'}') : '')."
				</div>
			</div>
		";

		return $ret;
	}

	function file($name, $options = array())
	{
		$options = $this->format_options('file', $name, $options);
		//never allow id in format name-value for text fields
		return "<input type='file' name='{$name}'".$this->get_attributes($options, $name)." />";
	}


	function password($name, $value, $maxlength = 50, $options = array())
	{
		$options = $this->format_options('text', $name, $options);
		//never allow id in format name-value for text fields
		return "<input type='password' name='{$name}' value='{$value}' maxlength='{$maxlength}'".$this->get_attributes($options, $name)." />";
	}

	function textarea($name, $value, $rows = 15, $cols = 40, $options = array())
	{
		$options = $this->format_options('textarea', $name, $options);
		//never allow id in format name-value for text fields
		return "<textarea name='{$name}' rows='{$rows}' cols='{$cols}'".$this->get_attributes($options, $name).">{$value}</textarea>";
	}

	function bbarea($name, $value, $help_mod = '', $help_tagid='', $rows = 15, $cols = 40, $options = array())
	{
		if(is_string($options)) parse_str($options, $options);
		if(!isset($options['class'])) $options['class'] = 'tbox large';

		if(!defsettrue('e_WYSIWYG'))
		{
			require_once(e_HANDLER."ren_help.php");
			$options['other'] = (isset($options['other']) ? $options['other'].' ' : '')."onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'";
			$bbbar = display_help($help_tagid, $help_mod);
		}

		$ret = "
		<div class='bbarea'>
			<div class='field-spacer'>
				".$this->textarea($name, $value, $rows, $cols, $options)."
			</div>
			{$bbbar}
		</div>
		";

		return $ret;
	}

	function checkbox($name, $value, $checked = false, $options = array())
	{
		$options['checked'] = $checked; //comes as separate argument just for convenience
		$options = $this->format_options('checkbox', $name, $options);
		return "<input type='checkbox' name='{$name}' value='{$value}'".$this->get_attributes($options, $name, $value)." />";

	}

	function checkbox_switch($name, $value, $checked = false, $label = '')
	{
		return $this->checkbox($name, $value, $checked).$this->label($label ? $label : LAN_ENABLED, $name, $value);
	}

	function checkbox_toggle($name, $selector = 'multitoggle')
	{
		$selector = 'jstarget:'.$selector;
		return $this->checkbox($name, $selector, false, array('id'=>false,'class'=>'checkbox toggle-all'));
	}

	/* DISABLED IN COMPAT MOD
	function uc_checkbox($name, $current_value, $uc_options, $field_options = array())
	{
		if(!is_array($field_options)) parse_str($field_options, $field_options);
		return '
			<div class="check-block">
				'.$this->_uc->vetted_tree($name, array($this, '_uc_checkbox_cb'), $current_value, $uc_options, $field_options).'
			</div>
		';
	}

	function _uc_checkbox_cb($treename, $classnum, $current_value, $nest_level, $field_options)
	{
		if($classnum == e_UC_BLANK)
			return '';

		$tmp = explode(',', $current_value);

		$class = $style = '';
		if($nest_level == 0)
		{
			$class = " strong";
		}
		else
		{
			$style = " style='text-indent:" . (1.2 * $nest_level) . "em'";
		}
		$descr = varset($field_options['description']) ? ' <span class="smalltext">('.$this->_uc->uc_get_classdescription($classnum).')</span>' : '';

		return "<div class='field-spacer{$class}'{$style}>".$this->checkbox($treename.'[]', $classnum, in_array($classnum, $tmp), $field_options).$this->label($this->_uc->uc_get_classname($classnum).$descr, $treename.'[]', $classnum)."</div>\n";
	}
	*/
	function radio($name, $value, $checked = false, $options = array())
	{
		$options['checked'] = $checked; //comes as separate argument just for convenience
		$options = $this->format_options('radio', $name, $options);
		return "<input type='radio' name='{$name}' value='".$value."'".$this->get_attributes($options, $name, $value)." />";

	}

	function radio_switch($name, $checked_enabled = false, $label_enabled = '', $label_disabled = '')
	{
		return $this->radio($name, 1, $checked_enabled)."".$this->label($label_enabled ? $label_enabled : LAN_ENABLED, $name, 1)."&nbsp;&nbsp;
			".$this->radio($name, 0, !$checked_enabled)."".$this->label($label_disabled ? $label_disabled : LAN_DISABLED, $name, 0);

	}

	function radio_multi($name, $elements, $checked, $multi_line = false)
	{
		$text = array();
		if(is_string($elements)) parse_str($elements, $elements);

		foreach ($elements as $value => $label)
		{
			$text[] = $this->radio($name, $value, $checked == $value)."".$this->label($label, $name, $value);
		}
		if(!$multi_line)
			return implode("&nbsp;&nbsp;", $text);

		return "<div class='field-spacer'>".implode("</div><div class='field-spacer'>", $text)."</div>";

	}

	function label($text, $name = '', $value = '')
	{
		$for_id = $this->_format_id('', $name, $value, 'for');
		return "<label$for_id>{$text}</label>";
	}

	function select_open($name, $options = array())
	{
		$options = $this->format_options('select', $name, $options);
		return "<select name='{$name}'".$this->get_attributes($options, $name).">";
	}

	function selectbox($name, $option_array, $selected = false, $options = array())
	{
		return $this->select_open($name, $options)."\n".$this->option_multi($option_array, $selected)."\n".$this->select_close();
	}

	/* DISABLED IN COMPAT MOD
	function uc_select($name, $current_value, $uc_options, $select_options = array(), $opt_options = array())
	{
		return $this->select_open($name, $select_options)."\n".$this->_uc->vetted_tree($name, array($this, '_uc_select_cb'), $current_value, $uc_options, $opt_options)."\n".$this->select_close();
	}

	// Callback for vetted_tree - Creates the option list for a selection box
	function _uc_select_cb($treename, $classnum, $current_value, $nest_level)
	{
		if($classnum == e_UC_BLANK)
			return $this->option('&nbsp;', '');

		$tmp = explode(',', $current_value);
		if($nest_level == 0)
		{
			$prefix = '';
			$style = "font-weight:bold; font-style: italic;";
		}
		elseif($nest_level == 1)
		{
			$prefix = '&nbsp;&nbsp;';
			$style = "font-weight:bold";
		}
		else
		{
			$prefix = '&nbsp;&nbsp;'.str_repeat('--', $nest_level - 1).'&gt;';
			$style = '';
		}
		return $this->option($prefix.$this->_uc->uc_get_classname($classnum), $classnum, in_array($classnum, $tmp), "style={$style}")."\n";
	}
	*/
	function optgroup_open($label, $disabled = false)
	{
		return "<optgroup class='optgroup' label='{$label}'".($disabled ? " disabled='disabled'" : '').">";
	}

	function option($option_name, $value, $selected = false, $options = array())
	{
		if(false === $value) $value = '';
		$options['selected'] = $selected; //comes as separate argument just for convenience
		$options = $this->format_options('option', '', $options); 
		return "<option value='{$value}'".$this->get_attributes($options).">{$option_name}</option>";
	}

	function option_multi($option_array, $selected = false, $options = array())
	{
		if(is_string($option_array)) parse_str($option_array, $option_array);

		$text = '';
		foreach ($option_array as $value => $label)
		{
			$text .= $this->option($label, $value, $selected == $value, $options)."\n";
		}

		return $text;
	}

	function optgroup_close()
	{
		return "</optgroup>";
	}

	function select_close()
	{
		return "</select>";
	}

	function hidden($name, $value, $options = array())
	{
		$options = $this->format_options('hidden', $name, $options);
		return "<input type='hidden' name='{$name}' value='{$value}'".$this->get_attributes($options, $name, $value)." />";
	}

	function submit($name, $value, $options = array())
	{
		$options = $this->format_options('submit', $name, $options);
		return "<input type='submit' name='{$name}' value='{$value}'".$this->get_attributes($options, $name, $value)." />";
	}

	function submit_image($name, $value, $image, $title='', $options = array())
	{
		$options = $this->format_options('submit_image', $name, $options);
		switch ($image) {
			case 'edit':
				$image = e_IMAGE_ABS.'admin_images/edit_16.png';
				$options['class'] = 'action edit'.(varset($options['class']) && $options['class'] != 'action' ? ' '.$options['class'] : '');
			break;

			case 'delete':
				$image = e_IMAGE_ABS.'admin_images/delete_16.png';
				$options['class'] = 'action delete'.(varset($options['class']) && $options['class'] != 'action' ? ' '.$options['class'] : '');
			break;
		}
		$options['title'] = $title;//shorthand
		return "<input type='image' src='{$image}' name='{$name}' value='{$value}'".$this->get_attributes($options, $name, $value)." />";
	}

	function admin_button($name, $value, $action = 'submit', $label = '', $options = array())
	{
		$btype = 'submit';
		if(strpos($action, 'action') === 0) $btype = 'button';
		$options = $this->format_options('admin_button', $name, $options);
		$options['class'] = $action;//shorthand
		if(empty($label)) $label = $value;

		return "
			<button type='{$btype}' name='{$name}' value='{$value}'".$this->get_attributes($options, $name)."><span>{$label}</span></button>
		";
	}

	function getNext($force = false)
	{
		if(!$this->_tabindex_enabled && !$force) return 0;
		$this->_tabindex_counter += 1;
		return $this->_tabindex_counter;
	}

	function getCurrent()
	{
		if(!$this->_tabindex_enabled) return 0;
		return $this->_tabindex_counter;
	}

	function resetTabindex($reset = 0)
	{
		$this->_tabindex_counter = $reset;
	}

	function get_attributes($options, $name = '', $value = '')
	{
		$ret = '';
		//
		foreach ($options as $option => $optval)
		{
			switch ($option) {

				case 'id':
					$ret .= $this->_format_id($optval, $name, $value);
					break;

				case 'class':
					if(!empty($optval)) $ret .= " class='{$optval}'";
					break;
					
				case 'style':
					if(!empty($optval)) $ret .= " style='{$optval}'";
					break;

				case 'size':
					if($optval) $ret .= " size='{$optval}'";
					break;
					
				case 'title':
					if($optval) $ret .= " title='{$optval}'";
					break;

				case 'tabindex':
					if($optval) $ret .= " tabindex='{$optval}'";
					elseif(false === $optval || !$this->_tabindex_enabled) break;
					else
					{
						$this->_tabindex_counter += 1;
						$ret .= " tabindex='".$this->_tabindex_counter."'";
					}
					break;

				case 'multiple':
					if($optval) $ret .= " multiple='multiple'";
					break;
					
				case 'readonly':
					if($optval) $ret .= " readonly='readonly'";
					break;

				case 'selected':
					if($optval) $ret .= " selected='selected'";
					break;

				case 'checked':
					if($optval) $ret .= " checked='checked'";
					break;

				case 'disabled':
					if($optval) $ret .= " disabled='disabled'";
					break;
					
				case 'onclick':
					if($optval) $ret .= " onclick=\"{$optval}\"";
					break;
					
				case 'onchange':
					if($optval) $ret .= " onchange=\"{$optval}\"";
					break;
					
				case 'other':
					if($optval) $ret .= " $optval";
					break;
			}
		}

		return $ret;
	}

	/**
	 * Auto-build field attribute id
	 *
	 * @param string $id_value value for attribute id passed with the option array
	 * @param string $name the name attribute passed to that field
	 * @param unknown_type $value the value attribute passed to that field
	 * @return string formatted id attribute
	 */
	function _format_id($id_value, $name, $value = '', $return_attribute = 'id')
	{
		if($id_value === false) return '';

		//format data first
		$name = $this->name2id($name);
		$value = trim(preg_replace('#[^a-z0-9\-]/i#','-', $value), '-');

		if(!$id_value && is_numeric($value)) $id_value = $value;

		if(empty($id_value) ) return " {$return_attribute}='{$name}".($value ? "-{$value}" : '')."'";// also useful when name is e.g. name='my_name[some_id]'
		elseif(is_numeric($id_value) && $name) return " {$return_attribute}='{$name}-{$id_value}'";// also useful when name is e.g. name='my_name[]'
		else return " {$return_attribute}='{$id_value}'";
	}

	function name2id($name)
	{
		return rtrim(str_replace(array('[]', '[', ']', '_'), array('-', '-', '', '-'), trim($name, '_')), '-');
	}


	/**
	 * Format options based on the field type,
	 * merge with default
	 *
	 * @param string $type
	 * @param string $name form name attribute value
	 * @param array|string $user_options
	 * @return array merged options
	 */
	function format_options($type, $name, $user_options)
	{
		if(is_string($user_options)) parse_str($user_options, $user_options);

		$def_options = $this->_default_options($type);

		foreach (array_keys($user_options) as $key)
		{
			if(!isset($def_options[$key])) unset($user_options[$key]);//remove it?
		}

		$user_options['name'] = $name; //required for some of the automated tasks
		return array_merge($def_options, $user_options);
	}

	/**
	 * Get default options array based on the filed type
	 *
	 * @param string $type
	 * @return array default options
	 */
	function _default_options($type)
	{
		if(isset($this->_cached_attributes[$type])) return $this->_cached_attributes[$type];

		$def_options = array(
			'id' => '',
			'class' => '',
			'style' => '',
			'onclick' => '',
			'onchange' => '',
			'title' => '',
			'size' => '',
			'multiple' => false,
			'readonly' => false,
			'selected' => false,
			'checked' => false,
			'disabled' => false,
			'tabindex' => 0,
			'other' => ''
		);

		switch ($type) {
			case 'hidden':
				$def_options = array('id'=>false, 'disabled' => false, 'other' => '');
				break;

			case 'text':
				$def_options['class'] = 'tbox input-text';
				unset($def_options['selected'], $def_options['checked'], $def_options['multiple']);
				break;

			case 'file':
				$def_options['class'] = 'tbox file';
				unset($def_options['selected'], $def_options['checked'], $def_options['multiple']);
				break;

			case 'textarea':
				$def_options['class'] = 'tbox textarea';
				unset($def_options['selected'], $def_options['checked'], $def_options['size'], $def_options['multiple']);
				break;

			case 'select':
				$def_options['class'] = 'tbox select';
				unset($def_options['checked'],  $def_options['selected']);
				break;

			case 'option':
				$def_options = array('class' => '', 'selected' => false, 'other' => '');
				break;

			case 'radio':
				$def_options['class'] = 'radio';
				unset($def_options['size'], $def_options['selected'], $def_options['multiple']);
				break;

			case 'checkbox':
				$def_options['class'] = 'checkbox';
				unset($def_options['size'],  $def_options['selected'], $def_options['multiple']);
				break;

			case 'submit':
				$def_options['class'] = 'button';
				unset($def_options['checked'], $def_options['selected'], $def_options['readonly'], $def_options['multiple']);
				break;

			case 'submit_image':
				$def_options['class'] = 'action';
				unset($def_options['checked'], $def_options['selected'], $def_options['readonly'], $def_options['multiple']);
				break;

			case 'admin_button':
				unset($def_options['checked'],  $def_options['selected'], $def_options['readonly'], $def_options['multiple']);
				break;

		}

		$this->_cached_attributes[$type] = $def_options;
		return $def_options;
	}
}
?>