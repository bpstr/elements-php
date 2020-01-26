<?php


namespace Bpstr\Elements\Base;

/**
 * Provides a simple interface which can be used to identify renderable objects.
 *
 * @package Bpstr\Elements\Base
 */
interface Renderable {

	public function render();

	public function __toString();

}
