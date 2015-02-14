<?php
/**
 * Created by PhpStorm.
 * User: hyo
 * Date: 2015/02/11
 * Time: 14:21
 */
App::uses('FormHelper', 'View/Helper');

class AppImageHelper extends FormHelper {
	function image($image_object, $number) {
		return $this->image_html($image_object, $number);
	}
	function thumb150($image_object, $number) {
		return $this->image_html($image_object, $number, 'thumb150_');
	}
	function thumb80($image_object, $number) {
		return $this->image_html($image_object, $number, 'thumb80_');
	}

	function image_html($image_object, $number, $file = '') {
		if (!isset($image_object[$number]) || !$image_object[$number]) {
			return $this->noimage();
		}
		return '<img src="'. $this->image_dir($image_object). $file. $image_object['images']. '">';
	}
	function image_dir($image_object) {
		$model = Inflector::underscore($image_object['model']);
		return '/files/'.$model.'/images/'. $image_object['dir']. '/';
	}
	function noimage() {
		return '<img src="/img/noimage.png">';
	}


}