<?php
/**
 * PrivateSpace Model
 *
 * @property Space $Space
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Space', 'Rooms.Model');

/**
 * PublicSpace Model
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Model
 */
class PrivateSpace extends Space {

/**
 * Table name
 *
 * @var string
 */
	public $useTable = 'spaces';

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'PrivateSpace.PrivateSpace',
	);

/**
 * PrivateSpaceルームの生成
 *
 * @param array $data デフォルト値
 * @return array PrivateSpaceルーム配列
 */
	public function createRoom($data) {
		$data = Hash::merge(array(
			'need_approval' => true,
			'default_participation' => false,
		), $data);

		return parent::createRoom($data);
	}

}
