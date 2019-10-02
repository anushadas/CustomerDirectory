<?php

class PDOAgent  {

    //Database Connection Details
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    //DSN (Data Source Name)
    private $dsn = "";

    //Variable to store the class we are mapping
    private $className = "";

    //Internal wrapper variables
    private $error;
    private $stmt;
    private $pdo;

    public function __construct(string $className)  {

        //record the class we are mapping internally
        $this->className = $className;

        //Build the DSN
        $this->dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;

        //Set the options for our PDO connection
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            //Try and connect
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $options);
        } catch (PDOException $px)  {
            $this->error = $px->getMessage();
            echo $this->error;
        }
    }

    function query( string $sqlQuery)   {
        //Prepare a statement
        $this->stmt = $this->pdo->prepare($sqlQuery);
    }

    //Set the appropriate type for the bind parameter
    public function bind($param, $value, $type = null){

        if (is_null($type)) {  
            switch (true) {

                case is_int($value):  
                $type = PDO::PARAM_INT;  
                break;

                case is_bool($value):  
                $type = PDO::PARAM_BOOL;  
                break;

                case is_null($value):  
                $type = PDO::PARAM_NULL;  
                break;

                default:  
                $type = PDO::PARAM_STR;  
            }  
        }  
        $this->stmt->bindValue($param, $value, $type);  
        }  

        public function execute($data = null)   {
            if (is_null($data)) {
                return $this->stmt->execute();
            } else {
                return $this->stmt->execute($data);
            }
        }

        //Return a single result
        public function singleResult()  {
        
            //set fetchmode
            $this->stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);
            //Return the result
            return $this->stmt->fetch(PDO::FETCH_CLASS);
        }

        //Return multiple results
        public function resultSet() {
            //Return all the results
            return $this->stmt->fetchAll(PDO::FETCH_CLASS, $this->className);
        }

        //Return the row count
        public function rowCount() : int  {
            return $this->stmt->rowCount();
        }

        //Return lastInsertedID
        public function lastInsertedId() : int {
            return $this->pdo->lastInsertedId();
        }
    
        



}