<?php
/** ProfisCMS - Opensource Content Management System Copyright (C) 2011 JSC "ProfIS"
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @var PC_core $core
 * @var PC_plugins $plugins
 * @var array $cfg
 */
require('../admin.php');
//files to pack
$files = array();
$files[] = 'swfupload.js';
$files[] = 'swfupload.swfobject.js';
$files[] = 'ZeroClipboard.js';
$files[] = 'BigInt.js';
$files[] = 'jsaes.js';
$files[] = 'PC_utils.js';
$localizeAt = count($files);

$files = array_merge($files, glob('Ext.ux.*.js'));
$pc_ux_files = glob('PC.ux.*.js');

$front_pc_files = array(
	'PC.ux.LocalCrud.js',
	'PC.ux.crud.js'
);

foreach ($front_pc_files as $value) {
	$key = array_search($value, $pc_ux_files);
	if ($key !== false) {
		$files[] = $pc_ux_files[$key];
		unset($pc_ux_files[$key]);
	}
}


$files = array_merge($files, $pc_ux_files);
$files = array_merge($files, glob('PC.*.js'));
////////$files = array_merge($files, glob('Ext.ux.*.js'), glob('ProfisCMS.*.js'), glob('PC.*.js'));

$files = array_merge($files, glob('dialog.*.js'));



//load custom plugins js
$pre_all_plugin_files = array();
$plugin_files = array();
if (isset($_GET['debug'])) {
	print_pre($plugins->loaded_plugins);
}
foreach ($plugins->loaded_plugins as $plugin) {
	$plugin_file = $core->Get_path('plugins', 'PC_plugin.js.php', $plugin); // .js.php MUST BE LOADED BEFORE .js!
	if (is_file($plugin_file)) $plugin_files[] = $plugin_file;
	$plugin_file = $core->Get_path('plugins', 'PC_plugin.js', $plugin);
	if (is_file($plugin_file)) $plugin_files[] = $plugin_file;

	$plugin_path = $core->Get_path('plugins', '', $plugin);
	$this_plugin_files = glob($plugin_path . 'PC_plugin.*.js');
	
	if (is_array($this_plugin_files)) {
		$plugin_files = array_merge($plugin_files, $this_plugin_files);
	}
	
	if (isset($_GET['debug'])) {
		echo "\n\n" . $plugin_file;
		echo "\n" . $plugin_path;
	}
	
	$this_pre_all_plugin_files = glob($plugin_path . 'PC_plugin_pre_all.*.js');
	
	if (is_array($this_pre_all_plugin_files)) {
		$pre_all_plugin_files = array_merge($pre_all_plugin_files, $this_pre_all_plugin_files);
	}
}
if (isset($_GET['debug'])) {
	print_pre($pre_all_plugin_files);
	print_pre($plugin_files);
	print_pre($files);
}

if (is_array($pre_all_plugin_files)) {
	$files = array_merge($files, $pre_all_plugin_files);
}

$pluginsStart = count($files);

if (is_array($plugin_files)) {
	$files = array_merge($files, $plugin_files);
}

$pluginsEnd = count($files);

$files[] = 'admin_core.js';
//array_pop($files); $files[] = 'admin_mock.js'; //used to run only one component (dev mode)

//identify last modification time and use highest value
$last_mod = 0;
foreach ($files as $f) {
	$last_mod = max($last_mod, filemtime($f));
}
header('Content-Type: application/javascript');
header('Last-Modified: '.date('D, d M Y H:i:s O', $last_mod));
header('True-Last-Modified: '.date('D, d M Y H:i:s O', $last_mod));

if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
	$cached_time = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']);
	if ($last_mod == $cached_time) {
		header($_SERVER['SERVER_PROTOCOL'].' 304 Not Modified (pack scripts)');
		exit;
	}
}
$files = array_unique($files);
if (isset($_GET['debug'])) {
	print_pre($files);
}
//echo "i >= $pluginsStart && i < $pluginsEnd";
foreach ($files as $i=>$file) {
	if ($i == $localizeAt) echo "\n\nPC.utils.localize();\n\n";
	//if ($i - $localizeAt > 15) break;
	if ($i >= $pluginsStart && $i < $pluginsEnd) {
		$plugin_name = preg_match("#/([^/]+)/PC_plugin\\.js(\\.php)?$#i", $file, $m);
		//print_pre($m);
		if ($plugin_name) {
			echo "\nvar CurrentlyParsing = '".$m[1]."';\n";
		}
		
		//before opening plugins
	}
	if (v($cfg['debug_mode'])) echo "\n\n/***** $file *****/\n\n";
	else echo "\n\n";
	if( preg_match('#\\.php$#i', $file) )
		include $file;
	else
		readfile($file);
}