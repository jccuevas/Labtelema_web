<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'ssmm_db.php';

class ssmm_db {

    protected $host;
    protected $user;
    protected $password;
    protected $dbname;
    protected $log_path;
    protected $tmp_path;

    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "servidortelematica";
        $this->dbname = "lt_ssmm";
    }

  

    public function updateUser($username, $sid, $expires) {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            return "ERROR";
        }

        $sql_p = "UPDATE `" . $this->dbname . "`.`users` SET  `session` = ?, `expired` = ? WHERE `name` = ?;";
        $stmt = $conn->prepare($sql_p);
        if ($stmt !== false) {
            $stmt->bind_param('sss', $sid, date('Y-m-d H:i:s', $expires), $username);
            if ($stmt->execute()) {
                return "OK";
            }
        }
        $stmt->close();
        $conn->close();
        return "ERROR";
    }

    public function addUser($user, $pass) {
        // Create connection
        $result = 'ERROR';
        $conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            return $result;
        }
        $sql_p = "INSERT INTO `" . $this->dbname . "`.`users` ( `name`,`pass`) VALUES (?, ?);";
        $stmt = $conn->prepare($sql_p);
        if ($stmt !== FALSE) {
            $stmt->bind_param('ss', $user, $pass);
            if ($stmt->execute()) {
                $result = "OK User " . $name . " added.";
            }
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function showUsers($username) {
        $list = NULL;
        $conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            return NULL;
        }
        //TODO Buscar si existe

        if ($username != "") {

            //$sql_p = "Select username, name , race , class  from `".$this->dbname."`.`yb_characters` where chatid=? ORDER by ID;";
            $sql_p = "Select name , session , expired from `" . $this->dbname . "`.`users` where name=?;";
            $stmt = $conn->prepare($sql_p);
            $stmt->bind_param('s', $username);
        } else {
            $sql_p = "Select name , session , expired from `" . $this->dbname . "`.`users` ORDER by id;";
            $stmt = $conn->prepare($sql_p);
        }
        if ($stmt->execute()) {
            $stmt->bind_result($name, $session, $expires);
            /* obtener los valores */
            $list = "";

            while ($stmt->fetch()) {
                $formato = 'Y-m-d H:i:s'; //2018-11-12 11:14:27
                $fecha = date_create_from_format($formato, $expires);
                $line = sprintf("%s %s %s\r\n", $name, $session, date_format($fecha, 'Y-m-d-H-i-s'));

                $list = $list . $line;
            }
        }
        $stmt->close();
        $conn->close();
        return $list;
    }

    public function loginUser($username, $pass) {
        if ($username != "" && $pass != "") {
            $storedpass = "";
            $session = "";
            $expires = "";
            $conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
            // Check connection
            if ($conn->connect_error) {
                return "ERROR";
            }
            $sql_p = "Select name , pass, session , expired from `" . $this->dbname . "`.`users` where name=?;";
            $stmt = $conn->prepare($sql_p);
            $stmt->bind_param('s', $username);

            if ($stmt->execute()) {
                $stmt->bind_result($name, $storedpass, $session, $expires);
                /* obtener los valores */
                while ($stmt->fetch()) {
                    if ($pass == $storedpass) {
                        return "OK";
                    }
                }
            }
            $stmt->close();
            $conn->close();
            return "ERROR";
        } else {
            return "ERROR";
        }
    }
}
