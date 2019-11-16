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

	public static function script($endpoint, $attributes) {
		$json_attr = json_encode($attributes);
		$script = str_replace('ENDPOINT', $endpoint, 'function loadXMLDoc(e,t){let n=new XMLHttpRequest;n.onreadystatechange=function(){n.readyState===XMLHttpRequest.DONE&&(200===n.status?document.getElementById(t).innerHTML=n.responseText:400===n.status?console.log("Some serious fuckup has been detected."):console.log("Weird magic happens here - "+n.status))},n.open("GET","ENDPOINT"+e,!0),n.send()}');
		return Element::create('script', $script,['type' => 'text/javascript']);
	}

}
