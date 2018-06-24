<?php

use CzProject\Assert\Assert as Assert;

require __DIR__ . '/../bootstrap.php';


test(function () {

	Tester\Assert::exception(function () {
		new Assert;
	}, 'CzProject\Assert\StaticClassException', 'This is static class.');

});


test(function () {

	Assert::assert(TRUE);

	Tester\Assert::exception(function () {
		Assert::assert(FALSE);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected TRUE, boolean given.');

});


test(function () {

	Assert::true(TRUE);

	Tester\Assert::exception(function () {
		Assert::true(FALSE);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected TRUE, boolean given.');

});


test(function () {

	Assert::false(FALSE);

	Tester\Assert::exception(function () {
		Assert::false(TRUE);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected FALSE, boolean given.');

});


test(function () {

	Assert::bool(FALSE);
	Assert::bool(TRUE);

	Tester\Assert::exception(function () {
		Assert::bool(1);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected bool, integer given.');

});


test(function () {

	Assert::null(NULL);

	Tester\Assert::exception(function () {
		Assert::null(1);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected NULL, integer given.');

});


test(function () {

	Assert::int(1000);

	Tester\Assert::exception(function () {
		Assert::int('1000');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected int, string given.');

});


test(function () {

	Assert::intOrNull(1000);
	Assert::intOrNull(NULL);

	Tester\Assert::exception(function () {
		Assert::intOrNull('1000');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected int|NULL, string given.');

});


test(function () {

	Assert::float(1000.0);

	Tester\Assert::exception(function () {
		Assert::float('1000');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected float, string given.');

});


test(function () {

	Assert::floatOrNull(1000.0);
	Assert::floatOrNull(NULL);

	Tester\Assert::exception(function () {
		Assert::floatOrNull('1000');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected float|NULL, string given.');

});


test(function () {

	Assert::string('1000');

	Tester\Assert::exception(function () {
		Assert::string(1000);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected string, integer given.');

});


test(function () {

	Assert::stringOrNull('1000');
	Assert::stringOrNull(NULL);

	Tester\Assert::exception(function () {
		Assert::stringOrNull(1000);
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected string|NULL, integer given.');

});


test(function () {

	Assert::type(new \DateTime('UTC'), 'DateTime');

	Tester\Assert::exception(function () {
		Assert::type(new \DateTime('UTC'), 'AnotherDateTime');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected AnotherDateTime, DateTime given.');

});


test(function () {

	Assert::typeOrNull(new \DateTime('UTC'), 'DateTime');
	Assert::typeOrNull(NULL, 'DateTime');

	Tester\Assert::exception(function () {
		Assert::typeOrNull(new \DateTime('UTC'), 'AnotherDateTime');
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected AnotherDateTime|NULL, DateTime given.');

});


test(function () {

	Assert::in(10, array(20, 15, 10, 5, 0));

	Tester\Assert::exception(function () {
		Assert::in('10', array(20, 15, 10, 5, 0));
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected value from specific range, string given.');

});


test(function () {

	Assert::inArray(10, array(20, 15, 10, 5, 0));

	Tester\Assert::exception(function () {
		Assert::inArray('10', array(20, 15, 10, 5, 0));
	}, 'CzProject\Assert\AssertException', 'Invalid value type - expected value from specific range, string given.');

});
