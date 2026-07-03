<?php

namespace Bpstr\Elements\Base;

interface DocumentInterface extends MarkupInterface {

	public function title($content);

	public function head($key, $content);

	public function meta(string $name, $content);

	public function stylesheet(string $href, ?string $media = NULL);

	public function javascript(?string $src = NULL, string $location = 'head', iterable $attributes = []);

	public function body($key, $content);

}
