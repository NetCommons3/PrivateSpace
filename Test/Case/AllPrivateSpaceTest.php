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

App::uses('NetCommonsTestSuite', 'NetCommons.TestSuite');

/**
 * PrivateSpace All Test Suite
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Test\Case
 * @codeCoverageIgnore
 */
class AllPrivateSpaceTest extends NetCommonsTestSuite {

/**
 * Suite defines all the tests for PublicSpace
 *
 * @return NetCommonsTestSuite
 */
	public static function suite() {
		$plugin = preg_replace('/^All([\w]+)Test$/', '$1', __CLASS__);
		$suite = new NetCommonsTestSuite(sprintf('All %s Plugin tests', $plugin));
		//$suite->addTestDirectoryRecursive(CakePlugin::path($plugin) . 'Test' . DS . 'Case');
		return $suite;
	}
}
