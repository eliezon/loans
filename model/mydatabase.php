<?php
class Database5{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
  
    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }
  
    public function connect() {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
  
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
  
    public function getConnection() {
        return $this->conn;
    }
  
    public function closeConnection() {
        $this->conn->close();
    }
  }
  
  
  // Database credentials
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "loan";
  
  // Create a new instance of the Database class
  $database = new Database5($servername, $username, $password, $dbname);
  
  // Connect to the database
?>