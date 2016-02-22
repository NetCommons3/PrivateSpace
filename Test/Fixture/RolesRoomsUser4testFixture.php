<?php
/**
 * RolesRoomsUser4testFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('RolesRoomsUserFixture', 'Rooms.Test/Fixture');

/**
 * RolesRoomsUser4testFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Test\Fixture
 */
class RolesRoomsUser4testFixture extends RolesRoomsUserFixture {

/**
 * Model name
 *
 * @var string
 */
	public $name = 'RolesRoomsUser';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'roles_rooms_users';

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		// * ルームID=1、ユーザID=1
		array(
			'id' => '1',
			'roles_room_id' => '1',
			'user_id' => '1',
			'room_id' => '1',
		),
		// * ルームID=1、ユーザID=2
		array(
			'id' => '2',
			'roles_room_id' => '2',
			'user_id' => '2',
			'room_id' => '1',
		),
		// * ルームID=1、ユーザID=3
		array(
			'id' => '3',
			'roles_room_id' => '3',
			'user_id' => '3',
			'room_id' => '1',
		),
		// * ルームID=1、ユーザID=4
		array(
			'id' => '4',
			'roles_room_id' => '4',
			'user_id' => '4',
			'room_id' => '1',
		),
		// * ルームID=1、ユーザID=5
		array(
			'id' => '5',
			'roles_room_id' => '5',
			'user_id' => '5',
			'room_id' => '1',
		),
		// * 別ルーム(room_id=4)
		array(
			'id' => '6',
			'roles_room_id' => '6',
			'user_id' => '1',
			'room_id' => '4',
		),
		// * 別ルーム(room_id=5、ブロックなし)
		array(
			'id' => '7',
			'roles_room_id' => '7',
			'user_id' => '1',
			'room_id' => '5',
		),
		//別ルーム(room_id=6, 準備中)
		array(
			'id' => '8',
			'roles_room_id' => '8',
			'user_id' => '1',
			'room_id' => '6',
		),
		//別ルーム(room_id=7, プライベートルーム)
		array(
			'id' => '9',
			'roles_room_id' => '9',
			'user_id' => '1',
			'room_id' => '7',
		),
	);

}
