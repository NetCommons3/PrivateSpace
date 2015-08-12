<?php
/**
 * PrivateSpace All Test Suite
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */


/**
 * PrivateSpace All Test Suite
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Test\Case
 * @codeCoverageIgnore
 */
class AllPrivateSpaceTest extends CakeTestSuite {

/**
 * Suite defines all the tests for PublicSpace
 *
 * @return CakeTestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite();
		$suite->addTestDirectoryRecursive(dirname(__FILE__));
		return $suite;
	}
}
