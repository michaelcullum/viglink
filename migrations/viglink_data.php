<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

namespace phpbb\viglink\migrations;

class viglink_data extends \phpbb\db\migration\migration
{
	/**
	* Skip this migration if VigLink data already exists
	*
	* @return bool True if data exists, false otherwise
	* @access public
	*/
	public function effectively_installed()
	{
		return isset($this->config['viglink_api_key']);
	}

	/**
	* Add VigLink API Key config to the database.
	*
	* @return array Array of table data
	* @access public
	*/
	public function update_data()
	{
		return array(
			array('config.add', array('viglink_enabled', 1)),
			array('config.add', array('viglink_api_key', '')),

			array('module.add', array(
				'acp',
				'ACP_BOARD_CONFIGURATION',
				array(
					'module_basename'	=> '\phpbb\viglink\acp\viglink_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}