<?php

namespace Bpstr\Elements\Html;

use Bpstr\Elements\Base\Markup;

class Document extends Markup {

	public static function create(string $title, $content = NULL, iterable $attributes = []) {
		$markup = new static($title);

		// Add content if exists.
		if ($content !== NULL) {
			$markup->body(self::CKEY_DEFAULT_CONTENT, $content);
		}

		// Add element attributes.
		foreach ($attributes as $name => $value) {
			$markup->attr($name, $value);
		}

		return $markup;
	}

	public function __construct(string $title, string $lang = 'en', $charset='utf-8') {
		parent::__construct('html');
		$this->before = '<!DOCTYPE html>';
		$this->content('head', Markup::create('head'));
		$this->content('body', Markup::create('body'));
		$this->attr('lang', $lang);
		$this->head('charset', Element::create('meta')->attr('charset', $charset));
		$this->title($title);
	}

	public function title($content) {
		$this->contents['head']->content('title', Element::create('title', $content));
		return $this;
	}

	public function head($key, $content) {
		$this->contents['head']->content($key, $content);
		return $this;
	}

	public function meta(string $name, $content) {
		$meta = Element::create('meta')->attr('name', $name)->attr('content', $content);
		$this->head($name, $meta);
		return $this;
	}

	/**
	 * Add stylesheet link tags to the document header.
	 *
	 * @param string $href
	 * @param string|null $media
	 *
	 * @link https://www.w3.org/TR/html401/present/styles.html
	 */
	public function stylesheet(string $href, ?string $media) {
		$stylesheet = Element::create('link')->attributes(
			[
				'rel' => 'stylesheet',
				'type' => 'text/css',
				'href' => $href,
			]
		);

		if ($media !== NULL) {
			$stylesheet->attr('media', $media);
		}

		$this->head($href, $stylesheet);
	}

	public function body($key, $content) {
		$this->contents['body']->content($key, $content);
		return $this;
	}

}
