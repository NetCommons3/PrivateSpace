<?php
/**
 * PrivateSpace Component
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Component', 'Controller');

/**
 * PrivateSpace Component
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Controller\Component
 */
class PrivateSpaceComponent extends Component {

/**
 * アクセスチェック
 *
 * @param Controller $controller Controller with components to startup
 * @return bool
 */
	public function accessCheck(Controller $controller) {
		if ($controller->request->params['action'] === 'download') {
			return true;
		}

		if (! Current::read('RolesRoomsUser.user_id') ||
				Current::read('RolesRoomsUser.user_id') !== Current::read('User.id')) {

			return false;
		}

		if ($controller->request->params['plugin'] === Current::PLUGIN_USERS) {
			return true;
		}

		if (! Current::read('User.UserRoleSetting.use_private_room')) {
			return false;
		}

		if (! $controller->Session->check('roomAccesse.' . Current::read('RolesRoomsUser.id'))) {
			$controller->RolesRoomsUser = ClassRegistry::init('Rooms.RolesRoomsUser');
			$controller->RolesRoomsUser->saveAccessed(Current::read('RolesRoomsUser.id'));
			$controller->Session->write('roomAccesse.' . Current::read('RolesRoomsUser.id'), true);
		}

		return true;
	}
}
