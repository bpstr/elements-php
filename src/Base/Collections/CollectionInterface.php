<?php

namespace Bpstr\Elements\Base;

use \Countable;
use \Traversable;

interface CollectionInterface implements Countable, Traversable {
    public function set($key, $value): ElementAttributeCollectionInterface;

    public function get($key): string;

    public function has($key): bool;

    public function remove($key): CollectionInterface;

    public function getAll(): array;
}
