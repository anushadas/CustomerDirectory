<?php
class Customer
{
    //Attributes
    // +------------+------------------+------+-----+---------+----------------+
    //  | Field      | Type             | Null | Key | Default | Extra          |
    //  +------------+------------------+------+-----+---------+----------------+
    //  | CustomerID | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    //  | Name       | char(50)         | NO   |     | NULL    |                |
    //  | Address    | char(100)        | NO   |     | NULL    |                |
    //  | City       | char(30)         | NO   |     | NULL    |                |
    //  +------------+------------------+------+-----+---------+----------------+
    private $CustomerID;
    private $Name;
    private $Address;
    private $City;

    //Getters

    function getCustomerID()
    {
        return $this->CustomerID;
    }
    function getName()
    {
        return $this->Name;
    }
    function getAddress()
    {
        return $this->Address;
    }
    function getCity()
    {
        return $this->City;
    }

    //Setters

    function setCustomerID($cId)
    {
        $this->CustomerID = $cId;
    }
    function setName($n)
    {
        $this->Name = $n;
    }
    function setAddress($a)
    {
        $this->Address = $a;
    }
    function setCity($c)
    {
        $this->City = $c;
    }
}
?>