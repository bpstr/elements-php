<?php

namespace Bpstr\Elements\Html;

use Bpstr\Elements\Base\ElementContentCollection;
use Bpstr\Elements\Base\ElementInterface;

/**
 * Heading HTML element class for elements-php.
 * Original: https://github.com/bpstr/elements-php
 */
class Table extends Element {
	public const CKEY_TABLE_HEAD = 0xF00001;
	public const CKEY_TABLE_BODY = 0xF00002;
	public const CKEY_TABLE_FOOT = 0xF00003;

	public static function build(iterable $content, iterable $header = NULL, iterable $footer = NULL) {
		$table = new static();

		if (!empty($header)) {
			$table->setHeader($header);
		}

		if (!empty($footer)) {
			$table->setFooter($footer);
		}

		$table_rows = new ElementContentCollection([], Element::create('tr'));
		foreach ($content as $index => $row) {
			if (!is_iterable($row)) {
				$row = [$row];
			}

			$table_rows->set($index, $table->tableRow($row));
		}
		$table->setBody($table_rows);
		return $table;
	}

	public function __construct ($tag = 'table') {
		parent::__construct($tag);
	}

	public function caption(string $text, array $attributes = []) {
		$this->before(Element::create('caption', $text, $attributes));
	}

	/**
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function getHeader(): ElementInterface {
		return $this->getContent(self::CKEY_TABLE_HEAD);
	}

	/**
	 * @param iterable $header
	 *
	 * @return Table
	 */
	public function setHeader(iterable $header): self {
		$header_row = Element::create('tr', $this->tableRow($header, 'th'));
		$this->content(self::CKEY_TABLE_HEAD, Element::create('thead', $header_row));
		return $this;
	}

	public function getBody(): ElementInterface {
		return $this->getContent(self::CKEY_TABLE_BODY, Element::create('tbody'));
	}

	public function setBody(ElementContentCollection $table_rows) {
		$this->content(self::CKEY_TABLE_BODY, Element::create('tbody', $table_rows));
	}

	/**
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function getFooter(): ElementInterface {
		return $this->getContent(self::CKEY_TABLE_FOOT);
	}

	/**
	 * @param iterable $footer
	 *
	 * @return Table
	 */
	public function setFooter(iterable $footer): self {
		$footer_row = Element::create('tr', $this->tableRow($footer));
		$this->content(self::CKEY_TABLE_FOOT, Element::create('tfoot', $footer_row));
		return $this;
	}

	protected function tableRow(iterable $columns, string $column_tagname = 'td'): ElementContentCollection {
		return new ElementContentCollection($columns, Element::create($column_tagname));
	}

	public function placeRow($key, iterable $columns) {
		$this->getBody()->placeContent($key, $this->tableRow($columns));
	}

	public function prependRow(iterable $columns) {
		$this->getBody()->prependContent($this->tableRow($columns));
	}

	public function appendRow(iterable $columns) {
		$this->getBody()->appendContent($this->tableRow($columns));
	}

}
