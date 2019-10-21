<?php
require_once 'vendor/autoload.php';

use Bpstr\Elements\Html\Document;
use Bpstr\Elements\Html\Element;

$start = microtime(true);

function randtext (){
	$text = explode(' ', 'PHP offers you several ways to get a random value of the array. One simple way is by using the array_rand() function. array_rand() expects the array as a parameter and returns a random index value as integer which then can be used to get the array value');
	shuffle($text);
	return implode(' ', $text);
}

$elements = ['div', 'p', 'base', 'area', 'br', 'col', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr', 'section', 'a', 'button', 'ul', 'li', 'table', 'tr', 'td'];

$document = new Document('Simple test');
for ($i = 1; $i < 299999; $i ++) {
	$randIndex = array_rand($elements);
	$elem = Element::create($elements[$randIndex], randtext());
	if ($i % 3 == 1) {
		$elem->before(clone $elem);
	}
	if ($i % 5 == 1) {
		$elem->after(clone $elem);
	}
	$document->body($i, $elem);
}
echo $document.PHP_EOL;
$time_elapsed_secs = microtime(true) - $start;
var_dump($time_elapsed_secs);
