# elements-php
Render HTML elements with PHP.

Inspired by chainable query structures, and jQuery DOM management.

With Elements-php it is possible to render an HTML element without
writing a single line of HTML code.

## Basic markup

Create a simple Markup object with chainable methods. When turning 
it into a string, you will get a [standard markup](https://en.wikipedia.org/wiki/Markup_language).

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

The `Element` class extends `Markup` to provide more advenced features
for rendering HTML. 

```
$div = Element::create('p', 'Lorem ipsum', ['class' => 'lead']);

echo $div; // <p class="lead">Lorem ipsum</p>
```
The same result can be achieved with chainable methods:
```
echo Element::create('p')->appendContent('Lorem ipsum')->addClass('lead');

// OR

$div = new Element('p');
$div->appendContent('Lorem ipsum');
if (true) {
    $div->addClass('lead');
}

echo $div;
```

### Creating more advanced structures

It is possible to pass another element, or array of other elements as the 
second argument of `Element::create()` which makes it incredibly convinent
to render advanced HTML structures *with pure PHP!*
```
echo Element::create('div', [
    new Heading('This is an H1 tag'),
    Element::create('ul', [
        Element::create('li', 'The first list item'),
        Element::create('li', 'The second item'),
    ]),
    new Image('image.jpg', 'Some Alt text')
])->addClass('container');
```
The example above will return the following HTML markup: **(minified!)**
```
<div class="container">
    <h1>This is an H1 tag</h1>
    <ul>
        <li>The first list item</li>
        <li>The second item</li>
    </ul>
    <img src="image.jpg" alt="Some Alt text" />
</div>
```

