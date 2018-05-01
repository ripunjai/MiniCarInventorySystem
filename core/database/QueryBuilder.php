<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectDataCondition($field, $table, $condition) {
		try
		{
			$stmt = $this->pdo->prepare("select $field from {$table} where $condition");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_CLASS);
		} catch (PDOException $e) {
			echo 'Query failed' . $e->getMessage();
		}
    }
    
    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            //
        }
    }

    public function OneRowCondition($field, $table, $condition) {
		try
		{
			$stmt = $this->pdo->prepare("select $field from $table where $condition");
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		} catch (PDOException $e) {

			echo 'Query failed' . $e->getMessage();

		}

    }
    
    public function UpdateQuery($table, $cols, $condition) {
		try
		{

			$colCount = count($cols);

			$columns = array_keys($cols);

			$values = "";

			$sql = "UPDATE $table SET ";

			for ($j = 0; $j < $colCount; $j++) {

				$values .= $columns[$j] . "=:" . $columns[$j] . ", ";

			}

			if (substr($values, -2) == ", ") {

				$values2 = substr($values, 0, -2);

			}

			$sql .= $values2;

			$sql .= " where $condition";

			$stmt = $this->pdo->prepare($sql);

			for ($i = 0; $i < $colCount; $i++) {

				$key = array_keys($cols);

				$keys = $key[$i];

				$value = array_values($cols);

				$values = $value[$i];

				$stmt->bindValue(":" . $keys, $values);

			}
			$stmt->execute();
		} catch (PDOException $e) {

			echo 'Query failed' . $e->getMessage();

		}

	}
}
