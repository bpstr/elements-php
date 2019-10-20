<?php

require_once 'vendor/autoload.php';

use Bpstr\Elements\Base\ElementAttributeCollection;
use Bpstr\Elements\Extension\EventAttribute;
use Bpstr\Elements\Html\Element;

$attr = new ElementAttributeCollection();
$attr->set('href', 'asd');
echo $attr;

$p = Element::create('p', 'Lorem ipsum dolor sit amet.')->attr('data-shit', 'true');


$p->attachExtension('attr', (new EventAttribute)->onClick('Call Ipsum.'));

echo $p;
