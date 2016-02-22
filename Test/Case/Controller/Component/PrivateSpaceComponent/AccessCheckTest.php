<?php
/**
 * PrivateSpaceComponent::accessCheck()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * PrivateSpaceComponent::accessCheck()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Test\Case\Controller\Component\PrivateSpaceComponent
 */
class PrivateSpaceComponentAccessCheckTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

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
		//テストコントローラ生成
		$this->generateNc('TestPrivateSpace.TestPrivateSpaceComponent');
		//ログイン
		TestAuthGeneral::login($this);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		//ログアウト
		TestAuthGeneral::logout($this);
		parent::tearDown();
	}

/**
 * accessCheck()のテスト
 * [indexアクション、自分自身、Users以外プラグイン、プライベートルーム使用可]
 *
 * @return void
 */
	public function testIndex() {
		//テストアクション実行
		$this->_testGetAction('/test_private_space/test_private_space_component/index',
				array('method' => 'assertNotEmpty'), null, 'view');
		$pattern = '/' . preg_quote('Controller/Component/TestPrivateSpaceComponent', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//テストデータ
		$this->_mockForReturnTrue('Rooms.RolesRoomsUser', 'saveAccessed');
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.id', '1');
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.user_id', '1');
		Current::$current = Hash::insert(Current::$current, 'User.UserRoleSetting.use_private_room', true);

		//テスト実行
		$result = $this->controller->PrivateSpace->accessCheck($this->controller);

		//チェック
		$this->assertTrue($result);
	}

/**
 * accessCheck()のテスト
 * [indexアクション、自分自身、Users以外プラグイン、プライベートルーム使用可、複数回目のアクセス]
 *
 * @return void
 */
	public function testIndexAgain() {
		//テストアクション実行
		$this->_testGetAction('/test_private_space/test_private_space_component/index',
				array('method' => 'assertNotEmpty'), null, 'view');
		$pattern = '/' . preg_quote('Controller/Component/TestPrivateSpaceComponent', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//テストデータ
		$this->_mockForReturnTrue('Rooms.RolesRoomsUser', 'saveAccessed', 0);
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.id', '1');
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.user_id', '1');
		Current::$current = Hash::insert(Current::$current, 'User.UserRoleSetting.use_private_room', true);

		$this->controller->Components->Session->expects($this->once())
			->method('check')
			->will($this->returnValue(true));

		//テスト実行
		$result = $this->controller->PrivateSpace->accessCheck($this->controller);

		//チェック
		$this->assertTrue($result);
	}

/**
 * accessCheck()のテスト
 * [downloadアクション、自分自身、Users以外プラグイン、プライベートルーム使用可]
 *
 * @return void
 */
	public function testDownload() {
		//テストアクション実行
		$this->_testGetAction('/test_private_space/test_private_space_component/download',
				array('method' => 'assertNotEmpty'), null, 'view');
		$pattern = '/' . preg_quote('Controller/Component/TestPrivateSpaceComponent', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//テストデータ
		$this->_mockForReturnTrue('Rooms.RolesRoomsUser', 'saveAccessed', 0);
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.id', '1');
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.user_id', '1');
		Current::$current = Hash::insert(Current::$current, 'User.UserRoleSetting.use_private_room', true);

		//テスト実行
		$result = $this->controller->PrivateSpace->accessCheck($this->controller);

		//チェック
		$this->assertTrue($result);
	}

/**
 * accessCheck()のテスト
 * [indexアクション、他人(RolesRoomsUser.user_idなし)、Users以外プラグイン、プライベートルーム使用可]
 *
 * @return void
 */
	public function testIndexWORolesRoomsUserId() {
		//テストアクション実行
		$this->_testGetAction('/test_private_space/test_private_space_component/index',
				array('method' => 'assertNotEmpty'), null, 'view');
		$pattern = '/' . preg_quote('Controller/Component/TestPrivateSpaceComponent', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//テストデータ
		$this->_mockForReturnTrue('Rooms.RolesRoomsUser', 'saveAccessed', 0);
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.id', '1');
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.user_id', null);
		Current::$current = Hash::insert(Current::$current, 'User.UserRoleSetting.use_private_room', true);

		//テスト実行
		$result = $this->controller->PrivateSpace->accessCheck($this->controller);

		//チェック
		$this->assertFalse($result);
	}

/**
 * accessCheck()のテスト
 * [indexアクション、他人(RolesRoomsUser.user_idが異なる)、Users以外プラグイン、プライベートルーム使用可]
 *
 * @return void
 */
	public function testIndexOtherUserId() {
		//テストアクション実行
		$this->_testGetAction('/test_private_space/test_private_space_component/index',
				array('method' => 'assertNotEmpty'), null, 'view');
		$pattern = '/' . preg_quote('Controller/Component/TestPrivateSpaceComponent', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//テストデータ
		$this->_mockForReturnTrue('Rooms.RolesRoomsUser', 'saveAccessed', 0);
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.id', '1');
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.user_id', '2');
		Current::$current = Hash::insert(Current::$current, 'User.UserRoleSetting.use_private_room', true);

		//テスト実行
		$result = $this->controller->PrivateSpace->accessCheck($this->controller);

		//チェック
		$this->assertFalse($result);
	}

/**
 * accessCheck()のテスト
 * [indexアクション、自分自身、Usersプラグイン、プライベートルーム使用可]
 *
 * @return void
 */
	public function testIndexForUserPlugin() {
		//テストアクション実行
		$this->_testGetAction('/test_private_space/test_private_space_component/index',
				array('method' => 'assertNotEmpty'), null, 'view');
		$pattern = '/' . preg_quote('Controller/Component/TestPrivateSpaceComponent', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//テストデータ
		$this->_mockForReturnTrue('Rooms.RolesRoomsUser', 'saveAccessed', 0);
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.id', '1');
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.user_id', '1');
		Current::$current = Hash::insert(Current::$current, 'User.UserRoleSetting.use_private_room', true);
		$this->controller->request->params['plugin'] = 'users';

		//テスト実行
		$result = $this->controller->PrivateSpace->accessCheck($this->controller);

		//チェック
		$this->assertTrue($result);
	}

/**
 * accessCheck()のテスト
 * [indexアクション、自分自身、Users以外プラグイン、プライベートルーム使用不可]
 *
 * @return void
 */
	public function testIndexNotUsePrivateRoom() {
		//テストアクション実行
		$this->_testGetAction('/test_private_space/test_private_space_component/index',
				array('method' => 'assertNotEmpty'), null, 'view');
		$pattern = '/' . preg_quote('Controller/Component/TestPrivateSpaceComponent', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//テストデータ
		$this->_mockForReturnTrue('Rooms.RolesRoomsUser', 'saveAccessed', 0);
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.id', '1');
		Current::$current = Hash::insert(Current::$current, 'RolesRoomsUser.user_id', '1');
		Current::$current = Hash::insert(Current::$current, 'User.UserRoleSetting.use_private_room', false);

		//テスト実行
		$result = $this->controller->PrivateSpace->accessCheck($this->controller);

		//チェック
		$this->assertFalse($result);
	}

}
