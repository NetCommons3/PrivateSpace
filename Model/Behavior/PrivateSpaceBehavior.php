<?php
/**
 * PrivateSpace Behavior
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('ModelBehavior', 'Model');

/**
 * PrivateSpace Behavior
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Model\Behavior
 */
class PrivateSpaceBehavior extends ModelBehavior {

/**
 * Setup this behavior with the specified configuration settings.
 *
 * @param Model $model Model using this behavior
 * @param array $config Configuration settings for $model
 * @return void
 */
	public function setup(Model $model, $config = array()) {
		parent::setup($model, $config);

		$model->loadModels([
			'RolesRoomsUser' => 'Rooms.RolesRoomsUser',
			'Room' => 'Rooms.Room',
			'Space' => 'Rooms.Space',
		]);
	}

/**
 * ルームデータ取得
 *
 * @param Model $model ビヘイビア呼び出し元モデル
 * @param int $userId ユーザID
 * @return array ルームデータ
 */
	public function getPrivateRoomByUserId(Model $model, $userId) {
		$result = $model->Room->find('first', array(
			'recursive' => -1,
			'fields' => array(
				$model->Room->alias . '.*',
				$model->RolesRoomsUser->alias . '.*',
			),
			'conditions' => array(
				$model->Room->alias . '.space_id' => Space::PRIVATE_SPACE_ID,
				$model->Room->alias . '.page_id_top NOT' => null,
			),
			'joins' => array(
				array(
					'table' => $model->RolesRoomsUser->table,
					'alias' => $model->RolesRoomsUser->alias,
					'type' => 'INNER',
					'conditions' => array(
						$model->RolesRoomsUser->alias . '.room_id' . ' = ' . $model->Room->alias . ' .id',
						$model->RolesRoomsUser->alias . '.user_id' => $userId,
					),
				),
			),
		));

		return $result;
	}

}
