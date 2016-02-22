<?php
/**
 * PrivateSpaceBehavior::getPrivateRoomByUserId()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * PrivateSpaceBehavior::getPrivateRoomByUserId()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Test\Case\Model\Behavior\PrivateSpaceBehavior
 */
class PrivateSpaceBehaviorGetPrivateRoomByUserIdTest extends NetCommonsModelTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.rooms.roles_rooms_user4test',
		'plugin.rooms.room4test',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'private_space';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'PrivateSpace', 'TestPrivateSpace');
		$this->TestModel = ClassRegistry::init('TestPrivateSpace.TestPrivateSpaceBehaviorModel');
	}

/**
 * getPrivateRoomByUserId()のテスト
 *
 * @return void
 */
	public function testGetPrivateRoomByUserId() {
		//テストデータ
		$userId = '1';

		//テスト実施
		$result = $this->TestModel->getPrivateRoomByUserId($userId);

		//チェック
		$roomId = '7';
		$this->assertEquals(array('Room', 'RolesRoomsUser'), array_keys($result));
		$this->assertEquals('9', Hash::get($result, 'RolesRoomsUser.id'));
		$this->assertEquals($roomId, Hash::get($result, 'RolesRoomsUser.room_id'));
		$this->assertEquals($userId, Hash::get($result, 'RolesRoomsUser.user_id'));
		$this->assertEquals($roomId, Hash::get($result, 'Room.id'));
		$this->assertNotNull(Hash::get($result, 'Room.page_id_top'));
	}

}
