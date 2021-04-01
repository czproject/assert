<?php

use CzProject\Assert\Assert as Assert;

require __DIR__ . '/../bootstrap.php';


test(function () {

	Tester\Assert::exception(function () {
		Assert::assert(FALSE);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected TRUE, boolean given.');

	Tester\Assert::exception(function () {
		Assert::assert(FALSE, 'Custom message.');
	}, 'CzProject\Assert\AssertException', 'Custom message.');

});


test(function () {

	Tester\Assert::exception(function () {
		Assert::int('1000');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected int, string given.');

	Tester\Assert::exception(function () {
		Assert::int('1000', 'Custom message.');
	}, 'CzProject\Assert\AssertException', 'Custom message.');

});


test(function () {

	Tester\Assert::exception(function () {
		Assert::intOrNull('1000');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected int|NULL, string given.');

	Tester\Assert::exception(function () {
		Assert::intOrNull('1000', 'Custom message.');
	}, 'CzProject\Assert\AssertException', 'Custom message.');

});


test(function () {

	Tester\Assert::exception(function () {
		Assert::string(1000);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected string, integer given.');

	Tester\Assert::exception(function () {
		Assert::string(1000, 'Custom message.');
	}, 'CzProject\Assert\AssertException', 'Custom message.');

});


test(function () {

	Tester\Assert::exception(function () {
		Assert::stringOrNull(1000);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected string|NULL, integer given.');

	Tester\Assert::exception(function () {
		Assert::stringOrNull(1000, 'Custom message.');
	}, 'CzProject\Assert\AssertException', 'Custom message.');

});


test(function () {

	Tester\Assert::exception(function () {
		Assert::type(new \DateTime('UTC'), 'AnotherDateTime');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected AnotherDateTime, DateTime given.');

	Tester\Assert::exception(function () {
		Assert::type(new \DateTime('UTC'), 'AnotherDateTime', 'Custom message.');
	}, 'CzProject\Assert\AssertException', 'Custom message.');

});


test(function () {

	Tester\Assert::exception(function () {
		Assert::in('10', [20, 15, 10, 5, 0]);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected value from specific range, string given.');

	Tester\Assert::exception(function () {
		Assert::in('10', [20, 15, 10, 5, 0], 'Custom message.');
	}, 'CzProject\Assert\AssertException', 'Custom message.');

});
