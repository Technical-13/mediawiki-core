<?php

class AutoLoaderTest extends MediaWikiTestCase {
	protected function setUp() {
		global $wgAutoloadLocalClasses, $wgAutoloadClasses;

		parent::setUp();

		// Fancy dance to trigger a rebuild of AutoLoader::$autoloadLocalClassesLower
		$this->testLocalClasses = array(
			'TestAutoloadedLocalClass' => __DIR__ . '/../data/autoloader/TestAutoloadedLocalClass.php',
			'TestAutoloadedCamlClass' => __DIR__ . '/../data/autoloader/TestAutoloadedCamlClass.php',
			'TestAutoloadedSerializedClass' => __DIR__ . '/../data/autoloader/TestAutoloadedSerializedClass.php',
			'TestAutoloadedAliasedClass' => 'alias:TestAutoloadedAliasedClassNew',
			'TestAutoloadedAliasedClassDeprecated' => 'alias:TestAutoloadedAliasedClassNew?v=1.1',
			'TestAutoloadedAliasedClassNew' => __DIR__ . '/../data/autoloader/TestAutoloadedAliasedClassNew.php',
		);
		$this->setMwGlobals( 'wgAutoloadLocalClasses', $this->testLocalClasses + $wgAutoloadLocalClasses );
		AutoLoader::resetAutoloadLocalClassesLower();

		$this->testExtensionClasses = array(
			'TestAutoloadedClass' => __DIR__ . '/../data/autoloader/TestAutoloadedClass.php',
		);
		$this->setMwGlobals( 'wgAutoloadClasses', $this->testExtensionClasses + $wgAutoloadClasses );
	}

	/**
	 * Assert that there were no classes loaded that are not registered with the AutoLoader.
	 *
	 * For example foo.php having class Foo and class Bar but only registering Foo.
	 * This is important because we should not be relying on Foo being used before Bar.
	 */
	public function testAutoLoadConfig() {
		$results = self::checkAutoLoadConf();

		$this->assertEquals(
			$results['expected'],
			$results['actual']
		);
	}

	protected static function checkAutoLoadConf() {
		global $wgAutoloadLocalClasses, $wgAutoloadClasses, $IP;
		$supportsParsekit = function_exists( 'parsekit_compile_file' );

		// wgAutoloadLocalClasses has precedence, just like in includes/AutoLoader.php
		$expected = $wgAutoloadLocalClasses + $wgAutoloadClasses;
		$actual = array();

		// Check aliases
		foreach ( $expected as $class => $file ) {
			if ( substr( $file, 0, 6 ) !== 'alias:' ) {
				// Not an alias, so should be an actual file
				$files[] = $file;
			} else {
				$newClass = substr( $file, 6, strcspn( $file, '?', 6 ) );
				if ( isset( $expected[$newClass] ) ) {
					if ( substr( $expected[$newClass], 0, 6 ) !== 'alias:' ) {
						// Alias pointing to an existing MediaWiki class
						$actual[$class] = $file;
					}
				}
			}
		}

		$files = array_unique( $files );

		foreach ( $files as $file ) {
			// Only prefix $IP if it doesn't have it already.
			// Generally local classes don't have it, and those from extensions and test suites do.
			if ( substr( $file, 0, 1 ) != '/' && substr( $file, 1, 1 ) != ':' ) {
				$filePath = "$IP/$file";
			} else {
				$filePath = $file;
			}
			if ( $supportsParsekit ) {
				$parseInfo = parsekit_compile_file( "$filePath" );
				$classes = array_keys( $parseInfo['class_table'] );
			} else {
				$contents = file_get_contents( "$filePath" );
				$m = array();
				preg_match_all( '/\n\s*(?:final)?\s*(?:abstract)?\s*(?:class|interface)\s+([a-zA-Z0-9_]+)/', $contents, $m, PREG_PATTERN_ORDER );
				$classes = $m[1];
			}
			foreach ( $classes as $class ) {
				$actual[$class] = $file;
			}
		}

		return array(
			'expected' => $expected,
			'actual' => $actual,
		);
	}

	function testCoreClass() {
		$this->assertTrue( class_exists( 'TestAutoloadedLocalClass' ) );
	}

	function testExtensionClass() {
		$this->assertTrue( class_exists( 'TestAutoloadedClass' ) );
	}

	function testWrongCaseClass() {
		$this->assertTrue( class_exists( 'testautoLoadedcamlCLASS' ) );
	}

	function testWrongCaseSerializedClass() {
		$dummyCereal = 'O:29:"testautoloadedserializedclass":0:{}';
		$uncerealized = unserialize( $dummyCereal );
		$this->assertFalse( $uncerealized instanceof __PHP_Incomplete_Class,
			"unserialize() can load classes case-insensitively." );
	}

	function testAliasedClass() {
		$this->assertSame( 'TestAutoloadedAliasedClassNew',
			get_class( new TestAutoloadedAliasedClass ) );
	}

	function testAliasedClassDeprecated() {
		wfSuppressWarnings();
		$this->assertSame( 'TestAutoloadedAliasedClassNew',
			get_class( new TestAutoloadedAliasedClassDeprecated ) );
		wfRestoreWarnings();
	}
}
