<?php

namespace Bpstr\Elements\Html;

use Bpstr\Elements\Base\Markup;

class Document extends Markup {

	public function __construct(string $title, string $lang = 'en') {
		parent::__construct('html');
		$this->before = '<!DOCTYPE html>';
		$this->content('head', Markup::create('head'));
		$this->content('body', Markup::create('body'));
		$this->attr('lang', $lang);
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

	public function body($key, $content) {
		$this->contents['body']->content($key, $content);
		return $this;
	}

}
