<?php

use CzProject\Assert\Assert as Assert;

require __DIR__ . '/../bootstrap.php';


test(function () {

	Tester\Assert::exception(function () {
		new Assert;
	}, 'CzProject\Assert\StaticClassException');

});


test(function () {

	Assert::assert(TRUE);

	Tester\Assert::exception(function () {
		Assert::assert(FALSE);
	}, 'CzProject\Assert\AssertException');

});


test(function () {

	Assert::int(1000);

	Tester\Assert::exception(function () {
		Assert::int('1000');
	}, 'CzProject\Assert\AssertException');

});


test(function () {

	Assert::intOrNull(1000);
	Assert::intOrNull(NULL);

	Tester\Assert::exception(function () {
		Assert::intOrNull('1000');
	}, 'CzProject\Assert\AssertException');

});


test(function () {

	Assert::string('1000');

	Tester\Assert::exception(function () {
		Assert::string(1000);
	}, 'CzProject\Assert\AssertException');

});


test(function () {

	Assert::stringOrNull('1000');
	Assert::stringOrNull(NULL);

	Tester\Assert::exception(function () {
		Assert::stringOrNull(1000);
	}, 'CzProject\Assert\AssertException');

});


test(function () {

	Assert::type(new \DateTime('UTC'), 'DateTime');

	Tester\Assert::exception(function () {
		Assert::type(new \DateTime('UTC'), 'AnotherDateTime');
	}, 'CzProject\Assert\AssertException');

});


test(function () {

	Assert::typeOrNull(new \DateTime('UTC'), 'DateTime');
	Assert::typeOrNull(NULL, 'DateTime');

	Tester\Assert::exception(function () {
		Assert::typeOrNull(new \DateTime('UTC'), 'AnotherDateTime');
	}, 'CzProject\Assert\AssertException');

});


test(function () {

	Assert::in(10, array(20, 15, 10, 5, 0));

	Tester\Assert::exception(function () {
		Assert::in('10', array(20, 15, 10, 5, 0));
	}, 'CzProject\Assert\AssertException');

});
