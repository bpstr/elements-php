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
 * @todo Section management
 * @todo Prepared documents
 */
class Document extends Markup implements DocumentInterface {
	const DEFAULT_DOCTYPE = '<!DOCTYPE html>';

	const CKEY_DEFAULT_HEAD = 0xA0000;
	const CKEY_DEFAULT_BOTTOM = 0xFF0000;

	public static function build(string $title, $content = NULL, iterable $attributes = []) {
		return static::create($title, $content, $attributes);
	}

	public static function create(string $title, $content = NULL, iterable $attributes = []) {
		$markup = new static();
		$markup->title($title);

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
		$this->head('charset', Element::create('meta')->attr('charset', $charset));
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
	public function stylesheet(string $href, ?string $media = NULL) {
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
		return $this;
	}

	public function javascript(?string $src = NULL, string $location = 'head', iterable $attributes = []) {
		if ($src === NULL) {
			return $this;
		}

		$script = Element::create('script', NULL, ['src' => $src])->attributes($attributes);
		$key = sprintf('javascript.%s', $src);

		if ($location === 'body') {
			return $this->body($key, $script);
		}

		return $this->head($key, $script);
	}

	public function body($key, $content) {
		$this->contents[self::CKEY_DEFAULT_CONTENT]->content($key, $content);
		return $this;
	}

}
