
# CzProject\Assert

Assert helper, throws exceptions.


Installation
------------

[Download a latest package](https://github.com/czproject/assert/releases) or use [Composer](http://getcomposer.org/):

```
composer require czproject/assert
```

`CzProject\Assert` requires PHP 5.4.0 or later.


## Usage


``` php
<?php

use CzProject\Assert\Assert;

function add($a, $b)
{
	Assert::int($a);
	Assert::int($b);
	return $a + $b;
}
```

* `assert($value, $msg = NULL)` - checks if value is `TRUE`
* `bool($value, $msg = NULL)` - checks if value is `bool`
* `int($value, $msg = NULL)` - checks if value is `int`
* `intOrNull($value, $msg = NULL)` - checks if value is `int|NULL`
* `string($value, $msg = NULL)` - checks if value is `string`
* `stringOrNull($value, $msg = NULL)` - checks if value is `string|NULL`
* `type($value, $type, $msg = NULL)` - checks if value is instance of given type
* `typeOrNull($value, $type, $msg = NULL)` - checks if value is instance of given type or `NULL`
* `in($value, $arr, $msg = NULL)` - checks if value is in array

------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/
