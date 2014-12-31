<?php
# ProfisCMS - Opensource Content Management System Copyright (C) 2011 JSC "ProfIS"
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http:#www.gnu.org/licenses/>.

if (version_compare(phpversion(), "5.3") < 0) die('ProfisCMS requires at least PHP 5.3 version.');

define('DS', '/');

spl_autoload_register(function($cls) {
	if( strpos($cls, '\\') !== false ) {
		$cls = ltrim($cls, '\\');
		if( DS != '\\' )
			$cls = str_replace('\\', DS, $cls);
		$path = dirname(__FILE__) . DS . 'namespaces' . DS . $cls . '.php';
		if( is_file($path) ) {
			require_once $path;
			return true;
		}
	}
	return false;
});
