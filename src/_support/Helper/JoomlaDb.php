<?php
/**
 * @package     Joomla.Test
 * @subpackage  Helper
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Helper;

use Codeception\Module;
use Codeception\TestInterface;
use Joomla\Database\DatabaseDriver;
use Joomla\Database\DatabaseFactory;

/**
 * JoomlaDb Helper class for Acceptance.
 *
 * @package  Codeception\Module
 */
class JoomlaDb extends Module
{
	const PRIMARY_KEY_NAME = 'id';

	/**
	 * @var DatabaseDriver
	 */
	protected $driver;

	/**
	 * @var array
	 */
	protected $requiredFields = [
		'host',
		'user',
		'password',
		'database',
	];

	/**
	 * Default config
	 *
	 * @var array
	 */
	protected $config = [
		'reconnect' => false
	];

	/**
	 * The inserted rows
	 *
	 * @var array
	 */
	protected $inserted = [];

	/**
	 * Codeception Hook: called after configuration is loaded
	 *
	 * @return  mixed
	 */
	public function _initialize()
	{
		$this->connect();
	}

	/**
	 * Codeception Hook: called before each test
	 *
	 * @param TestInterface $test
	 */
	public function _before(TestInterface $test)
	{
		if ($this->config['reconnect'])
		{
			$this->connect();
		}

		parent::_before($test);
	}

	/**
	 * Codeception Hook: called after each test
	 *
	 * @param TestInterface $test
	 */
	public function _after(TestInterface $test)
	{
		$this->clearInserted();

		if ($this->config['reconnect'])
		{
			$this->disconnect();
		}

		parent::_after($test);
	}

	/**
	 * Inserts an SQL record into a database. This record will be
	 * removed after each test.
	 *
	 * @param   string $table Table
	 * @param   array  $data  Data
	 *
	 * @return  integer The last insert id
	 */
	public function haveInDatabase(string $table, array $data): int
	{
		$lastInsertId = $this->insert($table, $data);
		$this->addInserted($table, $data, $lastInsertId);

		return $lastInsertId;
	}

	/**
	 * See an entry in the database
	 *
	 * @param   string $table    Table
	 * @param   array  $criteria Criteria
	 */
	public function seeInDatabase(string $table, array $criteria = [])
	{
		$this->assertGreaterThan(
			0,
			$this->count($table, $criteria),
			'No matching records found for criteria ' . json_encode($criteria) . ' in table ' . $table
		);
	}

	/**
	 * Don't see in database
	 *
	 * @param   string $table    Table
	 * @param   array  $criteria Criteria
	 */
	public function dontSeeInDatabase($table, $criteria = [])
	{
		$this->assertEquals(
			0,
			$this->count($table, $criteria),
			'Unexpectedly found matching records for criteria ' . json_encode($criteria) . ' in table ' . $table
		);
	}

	/**
	 * See a specified number of records in database
	 *
	 * @param int    $expectedNumber
	 * @param string $table
	 * @param array  $criteria
	 */
	public function seeNumberOfRecordsInDatabase(int $expectedNumber, string $table, array $criteria)
	{
		$this->assertEquals(
			$expectedNumber,
			$this->count($table, $criteria),
			sprintf(
				'The number of found rows (%d) does not match expected number %d for criteria %s in table %s',
				$actualNumber,
				$expectedNumber,
				json_encode($criteria),
				$table
			)
		);
	}

	/**
	 * Connect to the database
	 */
	protected function connect()
	{
		$this->driver = (new DatabaseFactory())->getDriver($this->config['driver'] ?? 'mysqli', [
			'host'     => $this->config['host'] ?? 'localhost',
			'user'     => $this->config['user'] ?? '',
			'password' => $this->config['password'] ?? '',
			'database' => $this->config['database'] ?? null,
			'prefix'   => $this->config['prefix'] ?? 'jos_',
			'port'     => $this->config['port'] ?? null,
			'socket'   => $this->config['socket'] ?? null,
		]);

		$this->driver->connect();
	}

	/**
	 * Disconnect from the database
	 */
	protected function disconnect()
	{
		$this->driver->disconnect();
		$this->driver = null;
	}

	/**
	 * Insert data in a database table
	 *
	 * @param string $table
	 * @param array  $data
	 *
	 * @return int
	 */
	protected function insert(string $table, array $data)
	{
		$query = $this->driver->getQuery(true)
			->columns($this->driver->qn(array_keys($data)))
			->values(implode(',', $this->driver->q(array_values($data))))
			->insert($this->driver->qn($table));

		$this->driver->setQuery($query)->execute();

		return (int) $this->driver->insertid();;
	}

	/**
	 * Add a row to inserted
	 *
	 * @param string $table
	 * @param array  $data
	 * @param        $id
	 */
	protected function addInserted(string $table, array $data, $id)
	{
		$primaryKeys = array_map(function ($key) {
			return $key->Column_name;
		}, array_filter($this->driver->getTableKeys($table), function ($key) {
			return (isset($key->Key_name) && $key->Key_name === 'PRIMARY' && isset($key->Column_name));
		}));

		// Handle single primary key
		if ($id && count($primaryKeys) === 1)
		{
			$this->inserted[] = ['table' => $table, 'data' => [$primaryKeys[0] => $id]];

			return;
		}

		// Handle multiple primary keys
		if (count($primaryKeys > 1))
		{
			$keyData = [];
			foreach ($primaryKeys as $primaryKey)
			{
				if (!isset($data[$primaryKey]))
				{
					throw new \InvalidArgumentException('Primary key field ' . $primaryKey . ' is not set for table ' . $table);
				}

				$keyData[$primaryKey] = $data[$primaryKey];
			}
			$this->inserted[] = ['table' => $table, 'data' => $keyData];

			return;
		}

		// Assume the joomla default name for the primary key
		if ($id)
		{
			$this->inserted[] = ['table' => $table, 'data' => [self::PRIMARY_KEY_NAME => $id]];
		}

		// Fallback to dataset (will not work if entry is changed during test)
		$this->inserted[] = ['table' => $table, 'data' => $data];
	}

	/**
	 * Clear all inserted records from the database
	 */
	protected function clearInserted()
	{
		foreach (array_reverse($this->inserted) as $row)
		{
			try
			{
				$query = $this->driver->getQuery(true)
					->delete($this->driver->qn($row['table']))
					->where($this->criteriaToCondition($row['data']));

				$this->driver->setQuery($query)->execute();
			}
			catch (\Exception $e)
			{
				$this->debug("Couldn't delete " . json_encode($row['data']) . " from {$row['table']}");
			}
		}

		$this->inserted = [];
	}

	/**
	 * Count records in database
	 *
	 * @param string $table
	 * @param array  $criteria
	 *
	 * @return int
	 */
	protected function count(string $table, array $criteria = []): int
	{
		$query = $this->driver->getQuery(true)
			->select('COUNT(*)')
			->from($this->driver->qn($table))
			->where($this->criteriaToCondition($criteria));

		return (int) $this->driver->setQuery($query)->loadResult();
	}

	/**
	 * Transforem criteria to joomla conditions
	 *
	 * @param array $criteria
	 *
	 * @return array
	 */
	protected function criteriaToCondition(array $criteria = []): array
	{
		$conditions = [];
		foreach ($criteria as $column => $value)
		{
			$conditions[] = $this->driver->qn($column) . ' = ' . $this->driver->q($value);
		}

		return $conditions;
	}
}
