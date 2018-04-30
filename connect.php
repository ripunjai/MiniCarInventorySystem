<?php

class Connect {

	private $db = "";

	function __construct($conn) {

		$this->db = $conn;

	}

	public function login($username, $password, $tableName, $passfield, $idfield, $condition) {

		try

		{

			$stmt = $this->db->prepare("SELECT $passfield, $idfield FROM $tableName WHERE $condition=:username LIMIT 1");

			$stmt->execute(array(':username' => $username));

			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($stmt->rowCount() > 0) {

				if ($password == $userRow[$passfield]) {

					$_SESSION['user_session'] = $userRow[$idfield];

					return true;

				} else {

					return false;

				}

			} else {

				return false;

			}

		} catch (PDOException $e) {

			echo $e->getMessage();

		}

	}

	public function redirect($url) {

		header("location:" . $url);

	}

	public function is_logged_in() {

		if (isset($_SESSION['user_session'])) {

			return true;

		}

	}

	public function logout() {

		session_destroy();

		unset($_SESSION['user_session']);

		return true;

	}

	public function tableData($field, $table) {

		try

		{

			$stmt = $this->db->prepare("select $field from $table");

			$stmt->execute();
			return $stmt;

		} catch (PDOException $e) {

			echo 'Query failed' . $e->getMessage();

		}

	}

	public function tableDataCondition($field, $table, $condition) {

		try

		{

			$stmt = $this->db->prepare("select $field from `$table` where $condition");

			$stmt->execute();

			//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $stmt;

		} catch (PDOException $e) {

			echo 'Query failed' . $e->getMessage();

		}

	}

	

	public function OneRow($field, $table) {

		try

		{

			$stmt = $this->db->prepare("select $field from $table");

			$stmt->execute();

			$results = $stmt->fetch(PDO::FETCH_ASSOC);

			return $results;

		} catch (PDOException $e) {

			echo 'Query failed' . $e->getMessage();

		}

	}

	public function sanitize_input($data) {

		$data = trim($data);

		$data = stripslashes($data);

		$data = htmlspecialchars($data);

		return $data;

	}

	public function OneRowCondition($field, $table, $condition) {

		try

		{

			$stmt = $this->db->prepare("select $field from $table where $condition");

			$stmt->execute();

			$results = $stmt->fetch(PDO::FETCH_ASSOC);

			return $results;

		} catch (PDOException $e) {

			echo 'Query failed' . $e->getMessage();

		}

	}

	public function rowCount($field, $table, $condition) {

		try

		{

			if ($condition != "") {

				$stmt = $this->db->prepare("select $field from $table where $condition");

			} else {

				$stmt = $this->db->prepare("select $field from $table");

			}

			$stmt->execute();

			$results = $stmt->rowCount();

			return $results;

		} catch (PDOException $e) {

			echo 'Query failed' . $e->getMessage();

		}

	}

	public function DeleteRow($table, $field, $condition) {

		try

		{

			$stmt = $this->db->prepare("DELETE FROM $table WHERE $field='$condition'");

			$stmt->execute();

		} catch (PDOException $e) {

			echo 'Query failed' . $e->getMessage();

		}

	}

	public function InsertQuery($table, $cols) {

		try

		{

			$colCount = count($cols);

			$columns = implode(", ", array_keys($cols));

			$colBind = implode(", :", array_keys($cols));

			//$values = implode("', '", array()ray_values($cols));

			$stmt = $this->db->prepare("INSERT into `$table` ($columns) VALUES (:$colBind)");

			for ($i = 0; $i < $colCount; $i++) {

				$key = array_keys($cols);

				$keys = $key[$i];

				$value = array_values($cols);

				$values = $value[$i];

				$stmt->bindValue(":" . $keys, $values);

			}

			$stmt->execute();

			return true;

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

			$stmt = $this->db->prepare($sql);

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

?>