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

namespace Profis\Db;

use \PDO;

abstract class CommandBuilder {
	/** @var PDO */
	protected $driver;

	public function __construct(PDO $driver) {
		$this->driver = $driver;
	}

	/**
	 * @param Schema  $schema
	 * @param array $params
	 * @return InsertCommand
	 */
	abstract function createInsertCommand(Schema $schema = null, $params = array());

	/**
	 * @param Schema  $schema
	 * @param array $params
	 * @return SelectCommand
	 */
	abstract function createSelectCommand(Schema $schema = null, $params = array());

	/**
	 * @param Schema  $schema
	 * @param array $params
	 * @return UpdateCommand
	 */
	abstract function createUpdateCommand(Schema $schema = null, $params = array());
}