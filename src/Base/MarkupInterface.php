<?php

namespace Bpstr\Elements\Base;

use JsonSerializable;
use Serializable;

/**
 * Basic SGML Markup interface.
 *
 * This interface defines base methods which are needed to create
 * SGTML markup with ease.
 *
 * Note: MarkupInterface defines CHAINABLE methods only, in order
 * to simply create any kind of element.
 *
 * @author bpstr <bpstr@gmx.tm>
 */
interface MarkupInterface extends Serializable, JsonSerializable, Renderable {

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
	 * @return MarkupInterface
	 */
	public static function create (string $tag, $content = NULL, iterable $attributes = []);

	/**
	 * Set the element tag
	 *
	 * @param string $tag
	 *
	 * @return $this
	 */
	public function tag(string $tag);

	/**
	 * @return string
	 */
	public function getTag(): string;

	/**
	 * Set a wrapping element around the current element.
	 *
	 * @param MarkupInterface $wrap
	 *
	 * @return $this
	 */
	public function wrap(MarkupInterface $wrap);

	/**
	 * Adds an element before current element.
	 *
	 * @param MarkupInterface $before
	 *
	 * @return $this
	 */
	public function before(MarkupInterface $before);

	/**
	 * Adds an element after current element.
	 *
	 * @param MarkupInterface $after
	 *
	 * @return $this
	 */
	public function after(MarkupInterface $after);

	/**
	 * Set content to an element.
	 *
	 * @param $key
	 * @param $value
	 *
	 * @return $this
	 */
	public function content($key, $value);

	/**
	 * Returns a content entry with the given key or NULL.
	 *
	 * @param mixed|NULL $key
	 *
	 * @param mixed|NULL $default
	 */
	public function getContent($key = NULL, $default = NULL);

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
	public function attributes(iterable $attributes): self;

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

	/**
	 * Renders an HTML element as string.
	 *
	 * @return string
	 */
	public function render(): string;
}
