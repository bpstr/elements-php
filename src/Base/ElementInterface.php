<?php

namespace Bpstr\Elements\Base;

use JsonSerializable;
use Serializable;

/**
 * Basic HTML Element interface.
 *
 * This interface defines base methods which are needed to create
 * HTML elements with ease.
 *
 * Note: This interface defines CHAINABLE methods in order to simply
 * create any kind of element.
 *
 * @author bpstr <bpstr@gmx.tm>
 */
interface ElementInterface extends MarkupInterface {

	/**
	 * Creates new instance of an HTML Element.
	 *
	 * @param string $tag
	 *   HTML Tag of the element
	 * @param mixed|null $content
	 *   Content of the element
	 * @param array $attributes
	 *   Associative array with HTML attributes
	 *
	 * @return ElementInterface
	 */
	public static function create (string $tag, $content = NULL, iterable $attributes = []) ;

	/**
	 * Set tag of an element
	 *
	 * @param string $tag
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 *
	 * @see \Bpstr\Elements\Base\MarkupInterface::tag()
	 */
	public function setTag(string $tag): self;



	/**
	 * Returns a content entry with the given key or NULL.
	 *
	 * @param mixed|NULL $key
	 *
	 * @param mixed|NULL $default
	 */
	public function getContent($key = NULL, $default = NULL);

	/**
	 * Place content before other content.
	 *
	 * @param $content
	 *
	 * @return $this
	 */
	public function prependContent($content): self;

	/**
	 * Place content after other content.
	 *
	 * @param $content
	 *
	 * @return $this
	 */
	public function appendContent($content = NULL): self;

	/**
	 * Place content to an element with a given key.
	 *
	 * @param mixed $key
	 * @param mixed $content
	 *
	 * @return $this
	 */
	public function placeContent($key, $content): self;

	/**
	 * @param string $tag
	 *
	 * @return array
	 */
	public function getChildrenByTagname(string $tag): array;



	/**
	 * @return \Bpstr\Elements\Base\ElementAttributeCollection
	 */
	public function getAttributes(): ElementAttributeCollection;

	/**
	 * @param string $name
	 * @param null $default
	 *
	 * @return mixed
	 */
	public function getAttribute(string $name, $default = NULL);

	/**
	 * @param string $name
	 * @param $value
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function setAttribute(string $name, $value): ElementInterface;

	/**
	 * @param $key
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
	 * Renders an HTML element as string.
	 *
	 * @return string
	 */
	public function render(): string;

	public function __toString();

}
