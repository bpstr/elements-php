<?php

require_once 'vendor/autoload.php';

use Bpstr\Elements\Base\ElementAttributeCollection;
use Bpstr\Elements\Base\ElementContentCollection;
use Bpstr\Elements\Extension\EventAttribute;
use Bpstr\Elements\Html\Element;

$contents = new ElementContentCollection(['Paragraph', 'Wrapped'], Element::create('p'));
echo $contents;

$attr = new ElementAttributeCollection();
$attr->set('href', 'asd');
echo $attr;

$p = Element::create('p', 'Lorem ipsum dolor sit amet.')->attr('data-shit', 'true');


$p->attachExtension((new EventAttribute)->onClick('Call Ipsum.'));

echo $p;
