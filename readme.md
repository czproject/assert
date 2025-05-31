# CzProject\Assert

[![Build Status](https://github.com/czproject/assert/workflows/Build/badge.svg)](https://github.com/czproject/assert/actions)
[![Downloads this Month](https://img.shields.io/packagist/dm/czproject/assert.svg)](https://packagist.org/packages/czproject/assert)
[![Latest Stable Version](https://poser.pugx.org/czproject/assert/v/stable)](https://github.com/czproject/assert/releases)
[![License](https://img.shields.io/badge/license-New%20BSD-blue.svg)](https://github.com/czproject/assert/blob/master/license.md)

Assert helper, throws exceptions.

<a href="https://www.janpecha.cz/donate/"><img src="https://buymecoffee.intm.org/img/donate-banner.v1.svg" alt="Donate" height="100"></a>


## Installation

[Download a latest package](https://github.com/czproject/assert/releases) or use [Composer](http://getcomposer.org/):

```
composer require czproject/assert
```

`CzProject\Assert` requires PHP 5.6 or later.


## Usage


``` php
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
* `float($value, $msg = NULL)` - checks if value is `float`
* `floatOrNull($value, $msg = NULL)` - checks if value is `float|NULL`
* `number($value, $msg = NULL)` - checks if value is `float|int`
* `numberOrNull($value, $msg = NULL)` - checks if value is `float|int|NULL`
* `string($value, $msg = NULL)` - checks if value is `string`
* `stringOrNull($value, $msg = NULL)` - checks if value is `string|NULL`
* `type($value, $type, $msg = NULL)` - checks if value is instance of given type
* `typeOrNull($value, $type, $msg = NULL)` - checks if value is instance of given type or `NULL`
* `null($value, $msg = NULL)` - checks if value is `NULL`
* `in($value, $arr, $msg = NULL)` - checks if value is in array
* `inArray($value, $arr, $msg = NULL)` - alias for `Assert::in()`


## PhpStan extension

```neon
services:
	-
		class: CzProject\Assert\Bridges\PhpStan\StaticMethodTypeSpecifyingExtension
		tags:
			- phpstan.typeSpecifier.staticMethodTypeSpecifyingExtension
```

------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/
