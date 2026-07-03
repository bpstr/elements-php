<?php

namespace Bpstr\Elements\Extension;

use Bpstr\Elements\Base\ElementInterface;
use Bpstr\Elements\Html\Element;

class EventAttribute extends ExtensionBase {

	/**
	 * @var array
	 */
	protected $events = [];

	public function __invoke(ElementInterface $element) {
		foreach ($this->events as $attribute => $event) {
			$element->attr($attribute, $event);
		}
	}

	public function onClick(string $value) {
		$this->events['onclick'] = $value;
		return $this;
	}

	public static function script($endpoint, $attributes = []) {
		$script = sprintf(
			'function loadXMLDoc(callback,target,attributes){var defaults=%s;var params=Object.assign({},defaults,attributes||{});var query=Object.keys(params).map(function(key){return encodeURIComponent(key)+"="+encodeURIComponent(params[key]);}).join("&");var xmlhttp=new XMLHttpRequest();xmlhttp.onreadystatechange=function(){if(xmlhttp.readyState===XMLHttpRequest.DONE&&xmlhttp.status===200){document.getElementById(target).innerHTML=xmlhttp.responseText;}};xmlhttp.open("GET",%s+callback+(query?"?"+query:""),true);xmlhttp.send()}',
			json_encode($attributes),
			json_encode($endpoint, JSON_UNESCAPED_SLASHES)
		);
		return Element::create('script', $script,['type' => 'text/javascript']);
	}

}
