<?php

namespace Bpstr\Elements\Base;

interface AttributeInterface {
    public function set($key, $value): AttributeInterface;

    public function get($key): string;
}
