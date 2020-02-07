<?php

namespace Bpstr\Elements\Base;

interface ElementAttributeCollectionInterface implements CollectionInterface {
	public function getClass(): ElementClassCollection {
		return $this->classCollection;
	}

	public function getStyle(): ElementStyleCollection {
		return $this->styleCollection;
	}
}
