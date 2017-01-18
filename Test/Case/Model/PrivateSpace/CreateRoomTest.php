<?php
/**
 * PrivateSpace::createRoom()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * PrivateSpace::createRoom()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Test\Case\Model\PrivateSpace
 */
class PrivateSpaceCreateRoomTest extends NetCommonsModelTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'private_space';

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'PrivateSpace';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'createRoom';

/**
 * createRoom()のテスト
 *
 * @return void
 */
	public function testCreateRoom() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$data = array();

		//テスト実施
		$result = $this->$model->$methodName($data);

		//チェック
		$this->assertEquals(array('Room', 'RoomsLanguage', 'Page'), array_keys($result));

		$this->assertTrue(Hash::get($result, 'Room.active'));
		$this->assertEquals('3', Hash::get($result, 'Room.space_id'));
		$this->assertEquals('3', Hash::get($result, 'Room.root_id'));
		$this->assertEquals('3', Hash::get($result, 'Room.parent_id'));
		$this->assertEquals('room_administrator', Hash::get($result, 'Room.default_role_key'));
		$this->assertArrayHasKey('id', Hash::get($result, 'Room'));

		$this->assertCount(1, Hash::get($result, 'RoomsLanguage'));
		$this->assertEquals('2', Hash::get($result, 'RoomsLanguage.0.language_id'));
		$this->assertNotEmpty(Hash::get($result, 'RoomsLanguage.0.name'));

		$this->assertArrayHasKey('parent_id', Hash::get($result, 'Page'));
	}

}
