<?php

require_once 'vendor/autoload.php';

use Bpstr\Elements\Base\ElementAttributeCollection;
use Bpstr\Elements\Html\Element;

$attr = new ElementAttributeCollection();
$attr->set('href', 'asd');
echo $attr;

echo Element::create('p', 'Lorem ipsum dolor sit amet.')->attr('data-shit', 'true');
