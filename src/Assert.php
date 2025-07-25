<?php

	declare(strict_types=1);

	namespace CzProject\Assert;


	class Assert
	{
		public function __construct()
		{
			throw new StaticClassException('This is static class.');
		}


		/**
		 * Checks if value is TRUE.
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert TRUE $value
		 */
		public static function assert($value, $msg = NULL)
		{
			if ($value !== TRUE) {
				throw new AssertException(self::message($msg, 'TRUE', $value));
			}
		}


		/**
		 * Checks if value is TRUE. Alias for self::assert()
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert TRUE $value
		 */
		public static function true($value, $msg = NULL)
		{
			self::assert($value, $msg);
		}


		/**
		 * Checks if value is FALSE.
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert FALSE $value
		 */
		public static function false($value, $msg = NULL)
		{
			self::assert($value === FALSE, self::message($msg, 'FALSE', $value));
		}


		/**
		 * Checks if value is bool
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert bool $value
		 */
		public static function bool($value, $msg = NULL)
		{
			self::assert(is_bool($value), self::message($msg, 'bool', $value));
		}


		/**
		 * Checks if value is NULL
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert NULL $value
		 */
		public static function null($value, $msg = NULL)
		{
			self::assert(is_null($value), self::message($msg, 'NULL', $value));
		}


		/**
		 * Checks if value is integer
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert int $value
		 */
		public static function int($value, $msg = NULL)
		{
			self::assert(is_int($value), self::message($msg, 'int', $value));
		}


		/**
		 * Checks if value is integer or NULL
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert int|NULL $value
		 */
		public static function intOrNull($value, $msg = NULL)
		{
			self::assert($value === NULL || is_int($value), self::message($msg, 'int|NULL', $value));
		}


		/**
		 * Checks if value is float
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert float $value
		 */
		public static function float($value, $msg = NULL)
		{
			self::assert(is_float($value), self::message($msg, 'float', $value));
		}


		/**
		 * Checks if value is float or NULL
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert float|NULL $value
		 */
		public static function floatOrNull($value, $msg = NULL)
		{
			self::assert($value === NULL || is_float($value), self::message($msg, 'float|NULL', $value));
		}


		/**
		 * Checks if value is float or int.
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert float|int $value
		 */
		public static function number($value, $msg = NULL)
		{
			self::assert(is_float($value) || is_int($value), self::message($msg, 'float|int', $value));
		}


		/**
		 * Checks if value is float or int or NULL
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert float|int|NULL $value
		 */
		public static function numberOrNull($value, $msg = NULL)
		{
			self::assert($value === NULL || is_float($value) || is_int($value), self::message($msg, 'float|int|NULL', $value));
		}


		/**
		 * Checks if value is object of given type
		 * @param  mixed $value
		 * @param  string $type
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-template T of object
		 * @phpstan-param class-string<T> $type
		 * @phpstan-assert T $value
		 */
		public static function type($value, $type, $msg = NULL)
		{
			self::assert($value instanceof $type, self::message($msg, $type, $value));
		}


		/**
		 * Checks if value is object of given type or NULL
		 * @param  mixed $value
		 * @param  string $type
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-template T of object
		 * @phpstan-param class-string<T> $type
		 * @phpstan-assert T|NULL $value
		 */
		public static function typeOrNull($value, $type, $msg = NULL)
		{
			self::assert(is_null($value) || ($value instanceof $type), self::message($msg, $type . '|NULL', $value));
		}


		/**
		 * Checks if value is string
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert string $value
		 */
		public static function string($value, $msg = NULL)
		{
			self::assert(is_string($value), self::message($msg, 'string', $value));
		}


		/**
		 * Checks if value is string or NULL
		 * @param  mixed $value
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-assert string|NULL $value
		 */
		public static function stringOrNull($value, $msg = NULL)
		{
			self::assert($value === NULL || is_string($value), self::message($msg, 'string|NULL', $value));
		}


		/**
		 * Checks if value is in haystack
		 * @param  mixed $value
		 * @param  array<mixed> $haystack
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-template T
		 * @phpstan-param T[] $haystack
		 * @phpstan-assert value-of<T[]> $value
		 */
		public static function in($value, array $haystack, $msg = NULL)
		{
			self::assert(in_array($value, $haystack, TRUE), self::message($msg, 'value from specific range', $value));
		}


		/**
		 * Checks if value is in haystack. Alias for Assert::in()
		 * @param  mixed $value
		 * @param  array<mixed> $haystack
		 * @param  string|NULL $msg
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 * @phpstan-template T
		 * @phpstan-param T[] $haystack
		 * @phpstan-assert value-of<T[]> $value
		 */
		public static function inArray($value, array $haystack, $msg = NULL)
		{
			self::in($value, $haystack, $msg);
		}


		/**
		 * @param  string|NULL $msg
		 * @param  string $expected
		 * @param  mixed $value
		 * @return string
		 */
		private static function message($msg, $expected, $value)
		{
			if ($msg !== NULL) {
				return $msg;
			}

			return "Invalid value type - expected $expected, " . (is_object($value) ? get_class($value) : gettype($value)) . ' given.';
		}
	}
