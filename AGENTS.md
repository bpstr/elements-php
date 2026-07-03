# AGENTS.md

## Project Overview

`bpstr/elements-php` is a small PHP 7.2 library for rendering HTML or generic markup from PHP objects instead of writing raw HTML strings. The public API is intentionally fluent and chainable: most mutator methods return `$this`, and rendering normally happens by casting an object to string.

Read `README.md` before changing behavior. Its examples define the expected developer experience:

- `Bpstr\Elements\Base\Markup` renders generic tags and attributes.
- `Bpstr\Elements\Html\Element` extends `Markup` with HTML-aware content, attributes, classes, styles, data attributes, empty-element handling, and extensions.
- Concrete helpers in `src/Html/` (`Document`, `Anchor`, `Form`, `Heading`, `Image`, `Input`, `Select`, `Table`) should remain thin fluent builders around `Element`.

## Code Discovery

This repository is indexed by codebase-memory-mcp. Prefer graph tools over grep or manual file search for code discovery:

1. `search_graph` or `search_code` to find classes, methods, and tests.
2. `trace_path` to understand callers/callees when available.
3. `get_code_snippet` to read exact class or method implementations.
4. `get_architecture` for a high-level map.

Fall back to `rg` for non-code files, config, docs, string literals, or when the graph does not answer the question.

Current graph project name: `Users-bpstr-Github-elements-php`.

## Repository Layout

- `src/Base/`: core renderable interfaces, `Markup`, element collections, render strategy contracts, document/element interfaces.
- `src/Html/`: HTML-specific `Element` implementation and convenience classes.
- `src/Collection/`: simple collection primitives used by element content, class, style, and attribute handling.
- `src/Extension/`: extension mechanism for mutating an `Element` during render, including `EventAttribute`.
- `tests/`: PHPUnit tests grouped by concept (`Markup`, `Element`, `Html`, `Extension`).
- `demo.php`, `demo-endpoint.php`, `benchmark.php`: examples and manual exploration scripts.

## Core Concepts

- `Markup::create($tag, $content = null, iterable $attributes = [])` creates generic markup and stores raw content/attributes in arrays.
- `Element::create($tag, $content = null, iterable $attributes = [])` creates HTML markup backed by `ElementContentCollection` and `ElementAttributeCollection`.
- Content can be strings, stringable objects, elements, or iterables. Iterable content is flattened into keyed content entries.
- Attribute values must be scalar, boolean, string, or stringable. Boolean `true` renders as a boolean-style attribute value such as `novalidate="novalidate"`.
- Classes and styles are managed through dedicated collections behind the `class` and `style` attributes. Prefer `addClass()`, `removeClass()`, `style()`, and `setStyle()` over hand-building those strings.
- `Element::EMPTY_ELEMENTS` controls self-closing tags. If content is added to an empty tag such as `img` or `input`, rendering emits a comment before the self-closing element and dismisses the content.
- Relations (`before`, `after`, `wrap`) are part of rendering. Cloning should preserve independence of nested relations and collections.
- Extensions implement `ExtensionInterface` and are invoked during `Element::render()` before the element string is assembled.

## Coding Conventions

- Keep compatibility with PHP `^7.2`; do not introduce PHP 8-only syntax or APIs.
- Preserve PSR-4 namespace mapping: `Bpstr\Elements\` maps to `src/`.
- Use the existing fluent style. Mutators should return `$this` or the relevant interface unless there is a strong reason not to.
- Keep rendered output minified. Tests generally assert exact strings without whitespace formatting.
- Add behavior to the narrowest appropriate class. Prefer concrete helpers in `src/Html/` for tag-specific sugar and `Element`/collections only for shared rendering behavior.
- Avoid broad escaping or formatting changes unless the task explicitly asks for them; many tests depend on exact current rendering semantics.
- Keep comments sparse and useful. Existing code uses PHPDoc for public concepts and short inline comments for non-obvious render behavior.

## Testing

Install dependencies if needed:

```bash
composer install
```

Run the full suite:

```bash
./vendor/bin/phpunit tests
```

Run focused tests while iterating:

```bash
./vendor/bin/phpunit tests/Element/ElementBaseTest.php
./vendor/bin/phpunit tests/Html/FormTest.php
```

When changing rendering, add or update exact-string assertions in the matching test group. Cover both the fluent API and constructor/static-builder paths when a helper exposes both.

## Review Checklist

- Does the change preserve exact rendered output for existing APIs?
- Are new methods chainable where similar methods are chainable?
- Are attributes/content validated through the existing collection classes?
- Does the behavior still work when content is an array or another element?
- Are empty HTML elements still rendered self-closing?
- Is the change covered by PHPUnit tests in the closest existing test directory?
