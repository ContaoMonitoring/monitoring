<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2014 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    Monitoring
 * @license    LGPL
 */

$GLOBALS['TL_DCA']['tl_monitoring_test'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_monitoring',
		'enableVersioning'            => false,
		'closed'                      => true,
		'doNotCopyRecords'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		) 
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('date DESC'),
			'headerFields'            => array('customer', 'website', 'system', 'url'),
			'child_record_callback'   => array('tl_monitoring_test', 'getTestLabel'),
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_class'      => 'no_padding' 
		),
		'global_operations' => array
		(
			'check' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_monitoring_test']['check'],
				'href'                => 'key=check',
				'class'               => 'header_icon check'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_monitoring_test']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_monitoring_test']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_monitoring_test']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{result_legend},date,type,status,repetitions,response_string;{comment_legend},comment'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'eval'                    => array('doNotShow'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'eval'                    => array('doNotShow'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		), 
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_monitoring_test']['date'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'default'                 => time(),
			'flag'                    => 6,
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'w50', 'readonly'=>true, 'rgxp'=>'datim'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		), 
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_monitoring_test']['type'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'default'                 => Monitoring::CHECK_TYPE_MANUAL,
			'options'                 => array(Monitoring::CHECK_TYPE_MANUAL, Monitoring::CHECK_TYPE_AUTOMATIC),
			'reference'               => &$GLOBALS['TL_LANG']['tl_monitoring_test']['types'],
			'eval'                    => array('tl_class'=>'w50', 'readonly'=>true, 'helpwizard'=>true),
			'sql'                     => "varchar(64) NOT NULL default '" . Monitoring::CHECK_TYPE_MANUAL . "'"
		),
		'status' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_monitoring_test']['status'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'default'                 => Monitoring::STATUS_OKAY,
			'options'                 => array(Monitoring::STATUS_OKAY, Monitoring::STATUS_INCOMPLETE, Monitoring::STATUS_ERROR),
			'reference'               => &$GLOBALS['TL_LANG']['tl_monitoring_test']['statusTypes'],
			'eval'                    => array('tl_class'=>'w50', 'readonly'=>true, 'helpwizard'=>true),
			'sql'                     => "varchar(64) NOT NULL default '" . Monitoring::STATUS_OKAY . "'"
		),
		'repetitions' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_monitoring_test']['repetitions'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'w50', 'readonly'=>true, 'rgxp'=>'digit'),
			'sql'                     => "varchar(2) NOT NULL default '1'"
		),
		'response_string' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_monitoring_test']['response_string'],
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('tl_class'=>'long clr', 'readonly'=>true, 'doNotCopy'=>true),
			'sql'                     => "text NOT NULL"
		),
		'comment' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_monitoring_test']['comment'],
			'search'                  => true,
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('tl_class'=>'long clr'),
			'sql'                     => "text NULL"
		),
	)
);

/**
 * Class tl_monitoring_test
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_monitoring_test extends Backend
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Return the label for an test entry
	 * @param array
	 * @return string
	 */
	public function getTestLabel($arrRow)
	{
		$cssClass = strtolower($arrRow['status']);

		$label = '
<div>
  <ul>
    <li><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_monitoring_test']['date'][0] . ':</span>' . \Date::parse($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['date']) . '</li>
    <li><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_monitoring_test']['type'][0] . ':</span>' . $GLOBALS['TL_LANG']['tl_monitoring_test']['types'][$arrRow['type']][0] . '</li>
    <li><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_monitoring_test']['status'][0] . ':</span><span class="' . $cssClass . '">' . $GLOBALS['TL_LANG']['tl_monitoring_test']['statusTypes'][$arrRow['status']][0] . '</span></li>
    <li><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_monitoring_test']['repetitions'][0] . ':</span>' . $arrRow['repetitions'] . '</li>
  </ul>
</div>';
		$label .="\n";
		return $label;
	}
}

?>