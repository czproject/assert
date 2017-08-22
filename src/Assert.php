<?php

	namespace CzProject\Assert;


	class Assert
	{
		public function __construct()
		{
			throw new StaticClassException('This is static class.');
		}


		/**
		 * Checks if value is TRUE.
		 * @param  mixed
		 * @param  string|NULL
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 */
		public static function assert($value, $msg = NULL)
		{
			if ($value !== TRUE) {
				throw new AssertException(self::message($msg, 'TRUE', $value));
			}
		}


		/**
		 * Checks if value is integer
		 * @param  mixed
		 * @param  string|NULL
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 */
		public static function int($value, $msg = NULL)
		{
			self::assert(is_int($value), self::message($msg, 'int', $value));
		}


		/**
		 * Checks if value is integer or NULL
		 * @param  mixed
		 * @param  string|NULL
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 */
		public static function intOrNull($value, $msg = NULL)
		{
			self::assert($value === NULL || is_int($value), self::message($msg, 'int|NULL', $value));
		}


		/**
		 * Checks if value is object of given type
		 * @param  mixed
		 * @param  string
		 * @param  string|NULL
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 */
		public static function type($value, $type, $msg = NULL)
		{
			self::assert($value instanceof $type, self::message($msg, $type, $value));
		}


		/**
		 * Checks if value is string
		 * @param  mixed
		 * @param  string|NULL
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 */
		public static function string($value, $msg = NULL)
		{
			self::assert(is_string($value), self::message($msg, 'string', $value));
		}


		/**
		 * Checks if value is string or NULL
		 * @param  mixed
		 * @param  string|NULL
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 */
		public static function stringOrNull($value, $msg = NULL)
		{
			self::assert($value === NULL || is_string($value), self::message($msg, 'string|NULL', $value));
		}


		/**
		 * Checks if value is in haystack
		 * @param  mixed
		 * @param  array
		 * @param  string|NULL
		 * @return void
		 * @throws AssertException
		 * @tracySkipLocation
		 */
		public static function in($value, array $haystack, $msg = NULL)
		{
			self::assert(in_array($value, $haystack, TRUE), self::message($msg, 'value from specific range', $value));
		}


		/**
		 * @param  string|NULL
		 * @param  string
		 * @param  mixed
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
