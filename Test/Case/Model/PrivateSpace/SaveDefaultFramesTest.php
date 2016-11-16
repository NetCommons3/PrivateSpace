<?php
/**
 * PrivateSpace::saveDefaultFrames()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('PrivateSpaceSaveTest', 'PrivateSpace.TestSuite');
App::uses('PrivateSpaceFixture', 'PrivateSpace.Test/Fixture');

/**
 * PrivateSpace::saveDefaultFrames()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Test\Case\Model\PrivateSpace
 */
class PrivateSpaceSaveDefaultFramesTest extends PrivateSpaceSaveTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.private_space.plugin4private_space',
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
	protected $_methodName = 'saveDefaultFrames';

/**
 * Save用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *
 * @return array テストデータ
 */
	public function dataProviderSave() {
		$results = array();
		$results[0] = array(
			'data' => array(
				'Box' => array(
					'3' => array(
						'Box' => array(
							'id' => '999'
						),
					),
				),
				'Room' => array(
					'id' => '99'
				),
			),
			'saved' => true
		);
		$results[1] = array(
			'data' => array(
				'Box' => array(
				),
				'Room' => array(
					'id' => '99'
				),
			),
			'saved' => false
		);
		$results[2] = array(
			'data' => array(
				'Box' => array(
					'3' => array(
						'Box' => array(
							'id' => '999'
						),
					),
				),
				'Room' => array(
				),
			),
			'saved' => false
		);

		return $results;
	}

/**
 * Saveのテスト
 *
 * @param array $data 登録データ
 * @param bool $saved 登録したかどうか
 * @dataProvider dataProviderSave
 * @return void
 */
	public function testSave($data, $saved) {
		$model = $this->_modelName;
		$method = $this->_methodName;

		//テスト実行
		$result = $this->$model->$method($data);
		$this->assertTrue($result);

		if ($saved) {
			//idのチェック
			$id = $this->$model->Frame->getLastInsertID();

			//チェック
			$actual = $this->$model->Frame->find('first', array(
				'recursive' => -1,
				'conditions' => array('id' => $id),
			));
			$expected = $this->$model->Frame->find('first', array(
				'recursive' => -1,
				'conditions' => array('box_id' => '999', 'room_id' => '99'),
			));
			$this->assertEquals($expected, $actual);
		}
	}

/**
 * SaveのExceptionError用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *  - mockMethod Mockのメソッド
 *
 * @return array テストデータ
 */
	public function dataProviderSaveOnExceptionError() {
		$data = $this->dataProviderSave()[0]['data'];

		return array(
			array($data, 'Frames.Frame', 'save'),
		);
	}

/**
 * SaveのValidationError用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *  - mockMethod Mockのメソッド(省略可：デフォルト validates)
 *
 * @return array テストデータ
 */
	public function dataProviderSaveOnValidationError() {
		$data = $this->dataProviderSave()[0]['data'];

		return array(
			array($data, 'Frames.Frame', 'save'),
		);
	}

/**
 * SaveのValidationErrorテスト
 *
 * @param array $data 登録データ
 * @param string $mockModel Mockのモデル
 * @param string $mockMethod Mockのメソッド
 * @dataProvider dataProviderSaveOnValidationError
 * @return void
 */
	public function testSaveOnValidationError($data, $mockModel, $mockMethod = 'validates') {
		parent::testSaveOnExceptionError($data, $mockModel, $mockMethod);
	}

}
