<?php

namespace Bpstr\Elements\Base;

interface DocumentInterface extends MarkupInterface {

	public function title($content);

	public function head($key, $content);

	public function meta(string $name, $content);

	public function stylesheet(string $href, ?string $media);

	public function javascript();

	public function body($key, $content);

}
