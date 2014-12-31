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

namespace Profis\Db\MySQL;

use \Profis\Db\DbException;

class SelectCommand extends \Profis\Db\SelectCommand {
	/**
	 * @param array|null $params
	 * @return SelectCommand
	 * @throws DbException
	 */
	function execute($params = null) {
	}

	/**
	 * @return array
	 * @throws DbException
	 */
	function fetch() {
	}

	/**
	 * @return array
	 * @throws DbException
	 */
	function fetchAll() {
	}

	/**
	 * @return mixed
	 * @throws DbException
	 */
	function fetchColumn() {
	}

	/**
	 * @param array|null $params
	 * @return array
	 * @throws DbException
	 */
	function query($params = null) {
	}

	/**
	 * @param array|null $params
	 * @return array
	 * @throws DbException
	 */
	function queryAll($params = null) {
	}

	/**
	 * @param array|null $params
	 * @return array
	 * @throws DbException
	 */
	function queryColumn($params = null) {
	}

	/**
	 * @param array|null $params
	 * @return mixed
	 * @throws DbException
	 */
	function queryScalar($params = null) {
	}
}
