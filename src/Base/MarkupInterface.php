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
 * Note: This interface defines CHAINABLE methods in order to simply
 * create any kind of element.
 *
 * @author bpstr <bpstr@gmx.tm>
 */
interface MarkupInterface extends Serializable, JsonSerializable {

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
	 * Changes the element tag or returns the current one.
	 *
	 * @param string|NULL $tag
	 *
	 * @return $this
	 */
	public function tag(string $tag);

	/**
	 * Adds a wrapping element to current element.
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
	 * Adds content to an element.
	 *
	 * @param $key
	 * @param $value
	 *
	 * @return $this
	 */
	public function content($key, $value);

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
	 * Renders an HTML element as string.
	 *
	 * @return string
	 */
	public function render(): string;

	public function __toString();

}
