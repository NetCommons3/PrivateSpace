<?php
/**
 * PluginFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('PluginFixture', 'PluginManager.Test/Fixture');

/**
 * PluginFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PluginManager\Test\Fixture
 */
class Plugin4privateSpaceFixture extends PluginFixture {

/**
 * Model name
 *
 * @var string
 */
	public $name = 'Plugin';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'plugins';

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'language_id' => '1',
			'key' => 'topics',
			'name' => 'Topics EN',
			'namespace' => 'netcommons/topics',
			'weight' => '1',
			'type' => '1',
			'default_action' => '',
			'default_setting_action' => '',
		),
		array(
			'id' => '2',
			'language_id' => '2',
			'key' => 'topics',
			'name' => 'Topics JA',
			'namespace' => 'netcommons/topics',
			'weight' => '1',
			'type' => '1',
			'default_action' => '',
			'default_setting_action' => '',
		),
	);

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		parent::init();
	}

}
