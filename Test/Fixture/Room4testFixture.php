<?php
/**
 * Room4testFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('RoomFixture', 'Rooms.Test/Fixture');

/**
 * Room4testFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Test\Fixture
 */
class Room4testFixture extends RoomFixture {

/**
 * Model name
 *
 * @var string
 */
	public $name = 'Room';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'rooms';

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		//パブリックスペース
		array(
			'id' => '1',
			'space_id' => '2',
			'page_id_top' => '1',
			'parent_id' => null,
			'lft' => '1',
			'rght' => '6',
			'active' => '1',
			'default_role_key' => 'visitor',
			'need_approval' => '1',
			'default_participation' => '1',
			'page_layout_permitted' => '1',
		),
		//別ルーム(room_id=4)
		array(
			'id' => '4',
			'space_id' => '2',
			'page_id_top' => '3',
			'parent_id' => '1',
			'lft' => '2',
			'rght' => '3',
			'active' => '1',
			'default_role_key' => 'visitor',
			'need_approval' => '1',
			'default_participation' => '1',
			'page_layout_permitted' => '1',
		),
		//別ルーム(room_id=5、ブロックなし)
		array(
			'id' => '5',
			'space_id' => '2',
			'page_id_top' => '4',
			'parent_id' => '1',
			'lft' => '4',
			'rght' => '5',
			'active' => '1',
			'default_role_key' => 'visitor',
			'need_approval' => '1',
			'default_participation' => '1',
			'page_layout_permitted' => '1',
		),
		//プライベート
		array(
			'id' => '2',
			'space_id' => '3',
			'page_id_top' => null,
			'parent_id' => null,
			'lft' => '7',
			'rght' => '10',
			'active' => '1',
			'default_role_key' => 'room_administrator',
			'need_approval' => '0',
			'default_participation' => '0',
			'page_layout_permitted' => '0',
		),
		//別ルーム(room_id=7, プライベートルーム)
		array(
			'id' => '7',
			'space_id' => '3',
			'page_id_top' => '7',
			'parent_id' => '2',
			'lft' => '8',
			'rght' => '9',
			'active' => '1',
			'default_role_key' => 'room_administrator',
			'need_approval' => '0',
			'default_participation' => '0',
			'page_layout_permitted' => '0',
		),
		//グループスペース
		array(
			'id' => '3',
			'space_id' => '4',
			'page_id_top' => null,
			'parent_id' => null,
			'lft' => '11',
			'rght' => '14',
			'active' => '1',
			'default_role_key' => 'general_user',
			'need_approval' => '1',
			'default_participation' => '1',
			'page_layout_permitted' => '1',
		),
		//別ルーム(room_id=6, 準備中)
		array(
			'id' => '6',
			'space_id' => '4',
			'page_id_top' => '5',
			'parent_id' => '3',
			'lft' => '12',
			'rght' => '13',
			'active' => '0',
			'default_role_key' => 'general_user',
			'need_approval' => '1',
			'default_participation' => '1',
			'page_layout_permitted' => '1',
		),
	);

}
