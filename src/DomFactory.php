<?php
namespace Bpstr\Elements;
require_once '../vendor/autoload.php';


use Bpstr\Elements\Html\Element;

/**
 * HTML5 Tags Index
 */
class DomFactory {

	/**
	 * Structural Tags
	 */
	const HTML_A = 'a';
	const HTML_ARTICLE = 'article';
	const HTML_ASIDE = 'aside';
	const HTML_BODY = 'body';
	const HTML_BR = 'br';
	const HTML_DETAILS = 'details';
	const HTML_DIV = 'div';
	const HTML_HEAD = 'head';
	const HTML_HEADER = 'header';
	const HTML_HGROUP = 'hgroup';
	const HTML_HR = 'hr';
	const HTML_HTML = 'html';
	const HTML_FOOTER = 'footer';
	const HTML_NAV = 'nav';
	const HTML_P = 'p';
	const HTML_SECTION = 'section';
	const HTML_SPAN = 'span';
	const HTML_SUMMARY = 'summary';

	/**
	 * Metadata Tags
	 */
	const HTML_BASE = 'base';
	const HTML_BASEFONT = 'basefont';
	const HTML_LINK = 'link';
	const HTML_META = 'meta';
	const HTML_STYLE = 'style';
	const HTML_TITLE = 'title';

	/**
	 * Form Tags
	 */
	const HTML_BUTTON = 'button';
	const HTML_DATALIST = 'datalist';
	const HTML_FIELDSET = 'fieldset';
	const HTML_FORM = 'form';
	const HTML_INPUT = 'input';
	const HTML_KEYGEN = 'keygen';
	const HTML_LABEL = 'label';
	const HTML_LEGEND = 'legend';
	const HTML_METER = 'meter';
	const HTML_OPTGROUP = 'optgroup';
	const HTML_OPTION = 'option';
	const HTML_SELECT = 'select';
	const HTML_TEXTAREA = 'textarea';

	/**
	 * Formatting Tags
	 */
	const HTML_ABBR = 'abbr';
	const HTML_ACRONYM = 'acronym';
	const HTML_ADDRESS = 'address';
	const HTML_B = 'b';
	const HTML_BDI = 'bdi';
	const HTML_BDO = 'bdo';
	const HTML_BIG = 'big';
	const HTML_BLOCKQUOTE = 'blockquote';
	const HTML_CENTER = 'center';
	const HTML_CITE = 'cite';
	const HTML_CODE = 'code';
	const HTML_DEL = 'del';
	const HTML_DFN = 'dfn';
	const HTML_EM = 'em';
	const HTML_FONT = 'font';
	const HTML_I = 'i';
	const HTML_INS = 'ins';
	const HTML_KBD = 'kbd';
	const HTML_MARK = 'mark';
	const HTML_OUTPUT = 'output';
	const HTML_PRE = 'pre';
	const HTML_PROGRESS = 'progress';
	const HTML_Q = 'q';
	const HTML_RP = 'rp';
	const HTML_RT = 'rt';
	const HTML_RUBY = 'ruby';
	const HTML_S = 's';
	const HTML_SAMP = 'samp';
	const HTML_SMALL = 'small';
	const HTML_STRIKE = 'strike';
	const HTML_STRONG = 'strong';
	const HTML_SUB = 'sub';
	const HTML_SUP = 'sup';
	const HTML_TT = 'tt';
	const HTML_U = 'u';
	const HTML_VAR = 'var';
	const HTML_WBR = 'wbr';

	/**
	 * List Tags
	 */
	const HTML_DD = 'dd';
	const HTML_DIR = 'dir';
	const HTML_DL = 'dl';
	const HTML_DT = 'dt';
	const HTML_LI = 'li';
	const HTML_OL = 'ol';
	const HTML_MENU = 'menu';
	const HTML_UL = 'ul';

	/**
	 * Table Tags
	 */
	const HTML_CAPTION = 'caption';
	const HTML_COL = 'col';
	const HTML_COLGROUP = 'colgroup';
	const HTML_TABLE = 'table';
	const HTML_TBODY = 'tbody';
	const HTML_TD = 'td';
	const HTML_TFOOT = 'tfoot';
	const HTML_THEAD = 'thead';
	const HTML_TH = 'th';
	const HTML_TR = 'tr';

	/**
	 * Scripting Tags
	 */
	const HTML_NOSCRIPT = 'noscript';
	const HTML_SCRIPT = 'script';

	/**
	 * Embedded Content Tags
	 */
	const HTML_APPLET = 'applet';
	const HTML_AREA = 'area';
	const HTML_AUDIO = 'audio';
	const HTML_CANVAS = 'canvas';
	const HTML_EMBED = 'embed';
	const HTML_FIGCAPTION = 'figcaption';
	const HTML_FIGURE = 'figure';
	const HTML_FRAME = 'frame';
	const HTML_FRAMESET = 'frameset';
	const HTML_IFRAME = 'iframe';
	const HTML_IMG = 'img';
	const HTML_MAP = 'map';
	const HTML_NOFRAMES = 'noframes';
	const HTML_OBJECT = 'object';
	const HTML_PARAM = 'param';
	const HTML_SOURCE = 'source';
	const HTML_TIME = 'time';
	const HTML_VIDEO = 'video';



	/**
	 * Allows dynamically creating input fields of a given type.
	 *
	 * @param $type
	 * @param $arguments
	 *
	 * @return \Bpstr\Elements\Html\Element|void
	 */
	public static function __callStatic($type, $arguments) {
		if (constant(sprintf('%s::HTML_%s', static::class, strtoupper($type))) === $type) {
			return Element::create($type, ...$arguments);
		}
	}

}
