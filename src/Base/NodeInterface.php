<?php

namespace Bpstr\Elements\Base;

use JsonSerializable;
use Serializable;

/**
 *
 * @author bpstr <bpstr@gmx.tm>
 * @author skillberto <skillbertoo@gmail.com>
 */
interface NodeInterface extends Serializable, JsonSerializable, RenderableInterface {

	/**
	 * Creates new instance of a Node
	 *
	 * @param string $tag
	 *   HTML Tag of the element
	 * @param mixed|null $content
	 *   Content of the element
	 * @param array $attributes
	 *   Associative array with HTML attributes
	 *
	 * @return NodeInterface
	 */
	public static function create (string $tag, $content = NULL): NodeInterface;

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
	 * Set a wrapping element around the current element.
	 *
	 * @param NodeInterface $wrap
	 *
	 * @return $this
	 */
	public function wrap(NodeInterface $wrap);

	/**
	 * Adds an element before current element.
	 *
	 * @param NodeInterface $before
	 *
	 * @return $this
	 */
	public function before(NodeInterface $before);

	/**
	 * Adds an element after current element.
	 *
	 * @param NodeInterface $after
	 *
	 * @return $this
	 */
	public function after(NodeInterface $after);
}
