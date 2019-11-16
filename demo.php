<?php

require_once 'vendor/autoload.php';

use Bpstr\Elements\Base\ElementAttributeCollection;
use Bpstr\Elements\Base\ElementContentCollection;
use Bpstr\Elements\Base\Markup;
use Bpstr\Elements\Extension\EventAttribute;
use Bpstr\Elements\Html\Element;

echo EventAttribute::script('demo-endpoint.php?a=');

$markup = Markup::create('report', 'Lorem ipsum dolor sit amet.', ['created' => date('Y-m-d')]);

//echo $markup;
$markup->content('footer_key', Markup::create('footer', 'Footer of the report.'))->attr('expires', 'never');
echo $markup;

$contents = new ElementContentCollection(['Paragraph', 'Wrapped'], Element::create('p'));
echo $contents;

$attr = new ElementAttributeCollection();
$attr->set('href', 'asd');
echo $attr;

$p = Element::create('p', 'Lorem ipsum dolor sit amet.')->attr('data-shit', 'true');
$p->setAttribute('id', 'test');

$p->attachExtension((new EventAttribute)->onClick('Call Ipsum.'));

echo $p;
