# elements-php
Render HTML elements with PHP.

Inspired by chainable query structures, Elements-php makes it possible 
to render HTML elements without writing a single line of HTML code.

## Basic markup

Create a simple Markup object with chainable methods. When turning it 
into a string, you will get a [standard markup](https://en.wikipedia.org/wiki/Markup_language).


```
$markup = Markup::create('document')->attr('created', date('Y-m-d');
$markup->content('title', Markup::create('title', 'Lorem ipsum.'));
echo $markup;
```
And the output will be:
```
<document created="2019-10-19"><title>Lorem ipsum.</title></document>
```

## Creating an element

```
$div = Element::create('div');
```

