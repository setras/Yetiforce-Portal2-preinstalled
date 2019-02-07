<?php
/**
 * List view class.
 *
 * @copyright YetiForce Sp. z o.o.
 * @license   YetiForce Public License 3.0 (licenses/LicenseEN.txt or yetiforce.com)
 * @author    Mariusz Krzaczkowski <m.krzaczkowski@yetiforce.com>
 * @author    Radosław Skrzypczak <r.skrzypczak@yetiforce.com>
 */

namespace YF\Modules\Base\View;

use App\Api;
use App\Request;
use YF\Modules\Base\Model\Field;
use YF\Modules\Base\Model\Record;

class DetailView extends Index
{
	/**
	 * Process.
	 *
	 * @param \App\Request $request
	 */
	public function process(Request $request)
	{
		$moduleName = $request->getModule();
		$record = $request->get('record');
		$api = Api::getInstance();

		$recordDetail = $api->call("$moduleName/Record/$record");
		$recordModel = Record::getInstance($moduleName);
		$recordModel->setData($recordDetail);

		$moduleStructure = $api->call($moduleName . '/Fields');
		$fields = [];
		foreach ($moduleStructure['fields'] as $field) {
			if ($field['isViewable']) {
				$fieldInstance = Field::getInstance($moduleName, $field);
				if (isset($recordDetail['data'][$field['name']])) {
					$fieldInstance->setDisplayValue($recordDetail['data'][$field['name']]);
				}
				$fields[$field['blockId']][] = $fieldInstance;
			}
		}

		$viewer = $this->getViewer($request);
		$viewer->assign('BREADCRUMB_TITLE', $recordDetail['name']);
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('FIELDS', $fields);
		$viewer->assign('BLOCKS', $moduleStructure['blocks']);
		$viewer->view('DetailView.tpl', $moduleName);
	}
}
