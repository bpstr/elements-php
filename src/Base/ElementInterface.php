<?php

namespace Bpstr\Elements\Base;

use Bpstr\Elements\Extension\ExtensionInterface;

/**
 * Basic Element interface.
 *
 * This interface defines base methods which are needed to create
 * elements with ease.
 *
 * Note: This interface defines CHAINABLE methods in order to simply
 * create any kind of element.
 *
 * @author bpstr <bpstr@gmx.tm>
 * @author skillberto <skillbertoo@gmail.com>
 */
interface ElementInterface extends NodeInterface {

	/**
	 * Creates new instance of a Node
	 *
	 * @param string     $tag               HTML Tag of the element
	 * @param itarable   $attributes	Iterable, contains attributes
	 * @param mixed|null $content           Content of the element
	 *
	 * @return ElementInterface
	 */
	public static function create (string $tag, iterable $attributes, $content = NULL): ElementInterface;


	/**
	 * @param string $tag
	 * @param string[] ...$classes
	 *
	 * @return ElementInterface
	 */
	public static function createWithClass(string $tag, string ...$classes): ElementInterface;


	/**
	 * Determines whether the current tag is in the given list or not.
	 *
	 * @param string[] ...$tags
	 *
	 * @return bool
	 */
	public function is(string ...$tags): bool;

	/**
	 * Place content before other content.
	 *
	 * @param $content
	 *
	 * @return $this
	 */
	public function prependContent($content): ElementInterface;

	/**
	 * Place content after other content.
	 *
	 * @param $content
	 *
	 * @return $this
	 */
	public function appendContent($content = NULL): ElementInterface;

	/**
	 * Place content to an element with a given key.
	 *
	 * Note: when passing an iterable value to $content parameter,
	 * this method will be called recursively. Doing such way, the
	 * first parameter will be used to prefix the array keys.
	 * @example self::placeContent('key', ['a' => ['b' => 'c']);
	 *    Will add keyab = 'c' to the internal content collection.
	 *
	 * @param mixed $key
	 * @param mixed $content
	 *
	 * @return $this
	 */
	public function placeContent($key, $content): ElementInterface;

	/**
	 * @param string $tag
	 *
	 * @return array
	 */
	public function getChildrenByTagname(string $tag): array;

	/**
	 * @param string $attr
	 * @param $val
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function data(string $attr, $val): ElementInterface;



	/**
	 * @return \Bpstr\Elements\Base\ElementClassCollection
	 */
	public function getClasses(): ElementClassCollection;

	/**
	 * @param string[] $classes
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function addClass(string ...$classes): ElementInterface;

	/**
	 * @param string $class
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function removeClass(string $class): ElementInterface;

	/**
	 * @param string $class
	 *
	 * @return bool
	 */
	public function hasClass(string $class): bool;

	/**
	 * @param string $property
	 * @param $value
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function style(string $property, $value): ElementInterface;

	/**
	 * @return \Bpstr\Elements\Base\ElementStyleCollection
	 */
	public function getStyles(): ElementStyleCollection;

	/**
	 * @param string $property
	 * @param null $default
	 *
	 * @return mixed
	 */
	public function getStyle(string $property, $default = NULL);

	/**
	 * @param string $property
	 * @param $value
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function setStyle(string $property, $value): ElementInterface;

	/**
	 * @param string $property
	 *
	 * @return bool
	 */
	public function hasStyle(string $property): bool;

	/**
	 * Edit or define an HTML attribute.
	 *
	 * @param string $attr
	 * @param $val
	 *
	 * @return $this
	 */
	public function attr(string $attr, $val = NULL);
	
	/**
	 * @param iterable $attributes
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function attributes(iterable $attributes): ElementInterface;

	/**
	 * @return \Bpstr\Elements\Base\ElementAttributeCollection
	 */
	public function getAttributes(): ElementAttributeCollection;

	/**
	 * @param string $name
	 * @param $value
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function setAttribute(string $name, $value): ElementInterface;

	/**
	 * @param array $keys
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function removeAttribute(... $keys): ElementInterface;

	/**
	 * @param string $name
	 *
	 * @return bool
	 */
	public function hasAttribute(string $name): bool;
}
