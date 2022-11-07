<?php

namespace Bpstr\Elements\Html;

use Bpstr\Elements\Base\DocumentInterface;
use Bpstr\Elements\Base\Markup;

/**
 * Class Document
 *
 * @package Bpstr\Elements\Html
 *
 * @todo Refactor for Extensions!
 * @todo implement Javascript method (Head or body)
 * @todo Section management
 * @todo Prepared documents
 */
class Document extends Markup implements DocumentInterface {
	const DEFAULT_DOCTYPE = '<!DOCTYPE html>';

	const CKEY_DEFAULT_HEAD = 0xA0000;
	const CKEY_DEFAULT_BOTTOM = 0xFF0000;

	public static function build(string $title, string $content, iterable $attributes = []) {
		$document = static::create(self::DEFAULT_DOCTYPE, $content, $attributes);
		$document->title($title);
		return $document;
	}

	public static function create(string $doctype = self::DEFAULT_DOCTYPE, $content = NULL, iterable $attributes = []) {
		$markup = new static($doctype);

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

	public function __construct(string $doctype = self::DEFAULT_DOCTYPE, $lang = 'en', $charset = 'utf-8') {
		parent::__construct('html');
		$this->before = $doctype;
		$this->content(self::CKEY_DEFAULT_HEAD, Markup::create('head'));
		$this->content(self::CKEY_DEFAULT_CONTENT, Markup::create('body'));
		$this->attr('lang', $lang);
		$this->head('charset', Markup::create('meta')->attr('charset', $charset));
	}

	public function title($content) {
		$this->contents[self::CKEY_DEFAULT_HEAD]->content('title', Element::create('title', $content));
		return $this;
	}

	public function head($key, $content) {
		$this->contents[self::CKEY_DEFAULT_HEAD]->content($key, $content);
		return $this;
	}

	public function meta(string $name, $content) {
		$meta = Markup::create('meta')->attr('name', $name)->attr('content', $content);
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
		$stylesheet = Markup::create('link')->attributes(
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

	public function render(array $element = [], array $additional_attributes = []): string {
		$bottom_content = $this->contents[self::CKEY_DEFAULT_BOTTOM] ?? NuLL;
		$this->contents[self::CKEY_DEFAULT_CONTENT]->content(self::CKEY_DEFAULT_BOTTOM, !$bottom_content);
		unset($this->contents[self::CKEY_DEFAULT_BOTTOM]);
		return parent::render($element, $additional_attributes);
	}

	public function javascript(string $src, $position = self::CKEY_DEFAULT_BOTTOM) {
		$script = Markup::create('script')->attr('src', $src);
		$this->content($position, $script);
		return $this;
	}

	public function body($key, $content) {
		$this->contents['body']->content($key, $content);
		return $this;
	}

}
