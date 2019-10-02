<?php

class CustomerDAO {

    private static $db;

    //Initialize DAO class
    static function init()  {
        
        self::$db = new PDOAgent("Customer");

    }

    static function getCustomers()    {

        $sqlQuery = "SELECT * FROM customers ORDER BY CustomerID;";

        //Query!
        self::$db->query($sqlQuery);

        //Execute!
        self::$db->execute();

        //Return the results!
        return self::$db->resultSet();

    }
    static function createCustomer(Customer $nc)    {

        $sqlInsert = "INSERT INTO customers (CustomerID, Name, Address, City)
            VALUES (:CustomerID, :Name, :Address, :City);";

        //Query!
        self::$db->query($sqlInsert);
        //Bind!
        self::$db->bind(':CustomerID',$nc->getCustomerID());
        self::$db->bind(':Name',$nc->getName());
        self::$db->bind(':Address',$nc->getAddress());
        self::$db->bind(':City',$nc->getCity());
       
        //Execute!
        self::$db->execute();

        //Get Affected rows
        return self::$db->rowCount();
    }
    static function getSelectedCustomer($id)
    {
        $sqlQuery2 = "SELECT * FROM customers WHERE CustomerID=$id;";

        //Query!
        self::$db->query($sqlQuery2);

        //Execute!
        self::$db->execute();

        //Return the results!
        return self::$db->singleResult();

    }
    static function editCustomer($id,Customer $nc) {

        $sqlUpdate = "UPDATE customers SET name= :Name, address=:Address, city=:City where CustomerID=$id;";

        //Query!
        self::$db->query($sqlUpdate);

        //Bind!
        self::$db->bind(':Name',$nc->getName());
        self::$db->bind(':Address',$nc->getAddress());
        self::$db->bind(':City',$nc->getCity());
       
        //Execute!
        self::$db->execute();

        //Get Affected rows
        return self::$db->rowCount();
    }
    static function deleteCustomer($id)
    {
        $sqlDelete = "DELETE from customers WHERE CustomerID=$id;";

        //Query!
        self::$db->query($sqlDelete);

        //Execute!
        self::$db->execute();

        //Get Affected rows
        return self::$db->rowCount();
    }


}