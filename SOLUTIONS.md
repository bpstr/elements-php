## Problem: Inheritence after Element

Solution 1: Each element defines the tag as constructor attribute
```
public function __construct (string $tag = 'a') {
    parent::__construct($tag);
}
```
Solution 2: 
```
public function __construct (string $tag = 'a') {
    parent::__construct($this->tag);
}
```
