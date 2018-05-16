<?php

namespace ProjectDesigner\Database;

interface IDatabase {

	/**
	 * Executes a query on the database
	 *
	 * @param      string  $query  The query
	 * @return     PDOStatement The response or false if there was an error
	 */
	public function query($query);

    /**
     * @return int ID of the last inserted row
     */
	public function insertId();

    /**
     * @param string $password
     * @return string
     */
	public function hash($password);
}