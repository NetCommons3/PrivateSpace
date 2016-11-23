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
App::uses('Container', 'Containers.Model');

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
	public function createRoom($data = array()) {
		$this->loadModels([
			'Language' => 'M17n.Language',
			'Room' => 'Rooms.Room',
			'RoomsLanguage' => 'Rooms.RoomsLanguage',
		]);

		$parentRoom = $this->Room->find('first', array(
			'recursive' => -1,
			'fields' => array(
				'space_id', 'active', 'need_approval',
				'page_layout_permitted'
			),
			'conditions' => array('id' => Space::getRoomIdRoot(Space::PRIVATE_SPACE_ID))
		));

		$result = $this->Room->create(Hash::merge(array(
			'id' => null,
			'root_id' => Space::getRoomIdRoot(Space::PRIVATE_SPACE_ID),
			'parent_id' => Space::getRoomIdRoot(Space::PRIVATE_SPACE_ID),
			'default_role_key' => Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR,
			'default_participation' => false,
		), $parentRoom['Room']));

		$languages = $this->Language->getLanguages();
		App::uses('L10n', 'I18n');
		$L10n = new L10n();

		foreach ($languages as $i => $language) {
			$catalog = $L10n->catalog($language['Language']['code']);

			$roomsLanguage = $this->RoomsLanguage->create(array(
				'id' => null,
				'language_id' => $language['Language']['id'],
				'room_id' => null,
				'name' => __d('private_space', $catalog['language']),
			));

			$result['RoomsLanguage'][$i] = $roomsLanguage['RoomsLanguage'];
		}

		$result['Page']['parent_id'] = null;

		return $result;
	}

/**
 * PrivateSpaceルームのデフォルト値の登録
 *
 * @param array $data デフォルト値
 * @return bool
 * @throws InternalErrorException
 */
	public function saveDefaultFrames($data = array()) {
		$this->loadModels([
			'Frame' => 'Frames.Frame',
			'Plugin' => 'PluginManager.Plugin',
		]);

		$boxId = Hash::get($data, 'Box.' . Container::TYPE_MAIN . '.Box.id');
		$roomId = Hash::get($data, 'Room.id');
		if (! $roomId || ! $boxId) {
			return true;
		}

		//新着情報の登録
		$pluginKey = 'topics';
		$plugin = $this->Plugin->find('first', array(
			'recursive' => -1,
			'conditions' => array('key' => $pluginKey, 'language_id' => Current::read('Language.id')),
		));
		$frame = $this->Frame->create(array(
			'room_id' => $roomId,
			'box_id' => $boxId,
			'plugin_key' => $pluginKey,
			'name' => Hash::get($plugin, 'Plugin.name', ''),
			'weight' => '1',
			'is_deleted' => false,
		));
		if (! $this->Frame->save($frame)) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}

		return true;
	}

}
