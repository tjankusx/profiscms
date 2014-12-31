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

use \Profis\Db\Schema;

class CommandBuilder extends \Profis\Db\Commandbuilder {
	/**
	 * @param Schema  $schema
	 * @param array $params
	 * @return InsertCommand
	 */
	function createInsertCommand(Schema $schema = null, $params = array()) {
		return new InsertCommand($this->driver, $schema, $params);
	}

	/**
	 * @param Schema  $schema
	 * @param array $params
	 * @return SelectCommand
	 */
	function createSelectCommand(Schema $schema = null, $params = array()) {
		return new SelectCommand($this->driver, $schema, $params);
	}

	/**
	 * @param Schema  $schema
	 * @param array $params
	 * @return UpdateCommand
	 */
	function createUpdateCommand(Schema $schema = null, $params = array()) {
		return new UpdateCommand($this->driver, $schema, $params);
	}
}