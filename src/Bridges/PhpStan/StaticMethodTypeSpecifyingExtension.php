<?php

	namespace CzProject\Assert\Bridges\PhpStan;

	use PhpParser\Node\Arg;
	use PhpParser\Node\Expr\StaticCall;
	use PHPStan\Analyser\Scope;
	use PHPStan\Analyser\SpecifiedTypes;
	use PHPStan\Analyser\TypeSpecifier;
	use PHPStan\Analyser\TypeSpecifierContext;
	use PHPStan\Reflection\MethodReflection;
	use PHPStan\Type\Constant\ConstantStringType;


	/**
	 * @deprecated CzProject\Assert uses @phpstan-assert PHPDoc tags (supported since PHPStan 1.9.0)
	 */
	class StaticMethodTypeSpecifyingExtension implements \PHPStan\Type\StaticMethodTypeSpecifyingExtension, \PHPStan\Analyser\TypeSpecifierAwareExtension
	{
		/** @var \Closure[] */
		private static $resolvers;


		/** @var \PHPStan\Analyser\TypeSpecifier */
		private $typeSpecifier;


		public function setTypeSpecifier(TypeSpecifier $typeSpecifier): void
		{
			$this->typeSpecifier = $typeSpecifier;
		}


		public function getClass(): string
		{
			return \CzProject\Assert\Assert::class;
		}


		public function isStaticMethodSupported(
			MethodReflection $staticMethodReflection,
			StaticCall $node,
			TypeSpecifierContext $context
		): bool
		{
			$methodName = $staticMethodReflection->getName();
			$resolvers = self::getExpressionResolvers();

			if (!array_key_exists($methodName, $resolvers)) {
				return FALSE;
			}

			$resolver = $resolvers[$methodName];
			$resolverReflection = new \ReflectionObject($resolver);

			return count($node->args) >= (count($resolverReflection->getMethod('__invoke')->getParameters()) - 1);
		}


		public function specifyTypes(
			MethodReflection $staticMethodReflection,
			StaticCall $node,
			Scope $scope,
			TypeSpecifierContext $context
		): SpecifiedTypes
		{
			$expression = self::createExpression($scope, $staticMethodReflection->getName(), $node->args);

			if ($expression === NULL) {
				return new SpecifiedTypes([], []);
			}

			$specifiedTypes = $this->typeSpecifier->specifyTypesInCondition(
				$scope,
				$expression,
				TypeSpecifierContext::createTruthy()
			);

			return $specifiedTypes;
		}


		/**
		 * @param Scope $scope
		 * @param string $name
		 * @param array<\PhpParser\Node\Arg|\PhpParser\Node\VariadicPlaceholder> $args
		 * @return \PhpParser\Node\Expr|NULL
		 */
		private static function createExpression(
			Scope $scope,
			string $name,
			array $args
		): ?\PhpParser\Node\Expr
		{
			$resolvers = self::getExpressionResolvers();
			$resolver = $resolvers[$name];
			return $resolver($scope, ...$args);
		}


		/**
		 * @return \Closure[]
		 */
		private static function getExpressionResolvers(): array
		{
			if (self::$resolvers === NULL) {
				self::$resolvers = [
					'assert' => function (Scope $scope, Arg $expr): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\BinaryOp\Identical(
							$expr->value,
							new \PhpParser\Node\Expr\ConstFetch(new \PhpParser\Node\Name('true'))
						);
					},
					'false' => function (Scope $scope, Arg $expr): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\BinaryOp\Identical(
							$expr->value,
							new \PhpParser\Node\Expr\ConstFetch(new \PhpParser\Node\Name('false'))
						);
					},
					'bool' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\FuncCall(
							new \PhpParser\Node\Name('is_bool'),
							[$value]
						);
					},
					'null' => function (Scope $scope, Arg $expr): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\BinaryOp\Identical(
							$expr->value,
							new \PhpParser\Node\Expr\ConstFetch(new \PhpParser\Node\Name('null'))
						);
					},
					'int' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\FuncCall(
							new \PhpParser\Node\Name('is_int'),
							[$value]
						);
					},
					'intOrNull' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\BinaryOp\BooleanOr(
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_int'),
								[$value]
							),
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_null'),
								[$value]
							)
						);
					},
					'float' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\FuncCall(
							new \PhpParser\Node\Name('is_float'),
							[$value]
						);
					},
					'floatOrNull' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\BinaryOp\BooleanOr(
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_float'),
								[$value]
							),
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_null'),
								[$value]
							)
						);
					},
					'number' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\BinaryOp\BooleanOr(
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_int'),
								[$value]
							),
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_float'),
								[$value]
							)
						);
					},
					'numberOrNull' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\BinaryOp\BooleanOr(
							new \PhpParser\Node\Expr\BinaryOp\BooleanOr(
								new \PhpParser\Node\Expr\FuncCall(
									new \PhpParser\Node\Name('is_int'),
									[$value]
								),
								new \PhpParser\Node\Expr\FuncCall(
									new \PhpParser\Node\Name('is_float'),
									[$value]
								)
							),
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_null'),
								[$value]
							)
						);
					},
					'type' => function (Scope $scope, Arg $expr, Arg $class): ?\PhpParser\Node\Expr {
						$classType = $scope->getType($class->value);

						if (!$classType instanceof ConstantStringType) {
							return NULL;
						}

						return new \PhpParser\Node\Expr\Instanceof_(
							$expr->value,
							new \PhpParser\Node\Name($classType->getValue())
						);
					},
					'typeOrNull' => function (Scope $scope, Arg $expr, Arg $class): ?\PhpParser\Node\Expr {
						$classType = $scope->getType($class->value);

						if (!$classType instanceof ConstantStringType) {
							return NULL;
						}

						return new \PhpParser\Node\Expr\BinaryOp\BooleanOr(
							new \PhpParser\Node\Expr\Instanceof_(
								$expr->value,
								new \PhpParser\Node\Name($classType->getValue())
							),
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_null'),
								[$expr]
							)
						);
					},
					'string' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\FuncCall(
							new \PhpParser\Node\Name('is_string'),
							[$value]
						);
					},
					'stringOrNull' => function (Scope $scope, Arg $value): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\BinaryOp\BooleanOr(
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_string'),
								[$value]
							),
							new \PhpParser\Node\Expr\FuncCall(
								new \PhpParser\Node\Name('is_null'),
								[$value]
							)
						);
					},
					'in' => function (Scope $scope, Arg $value, Arg $haystack): \PhpParser\Node\Expr {
						return new \PhpParser\Node\Expr\FuncCall(
							new \PhpParser\Node\Name('in_array'),
							[$value, $haystack, new Arg(new \PhpParser\Node\Expr\ConstFetch(new \PhpParser\Node\Name('true')))]
						);
					},
				];

				// alises
				self::$resolvers['true'] = self::$resolvers['assert'];
				self::$resolvers['inArray'] = self::$resolvers['in'];
			}

			return self::$resolvers;
		}
	}
