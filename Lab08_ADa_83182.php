<?php

//TO DO:
//Add CustomerID to Edit Customer
//Validate Inputs
session_start();
require_once("inc/config.inc.php");
require_once("inc/Utilities/Page.class.php");
require_once("inc/Entities/Customer.class.php");
require_once("inc/Utilities/PDOAgent.class.php");
require_once("inc/Utilities/CustomerDAO.class.php");

//Initialize Customer DAO
CustomerDAO::init();

//Read all Customers
$customers = CustomerDAO::getCustomers();

Page::$title = "Lab08_ADa-83182";
Page::header();

Page::displayCustomers($customers);
$exampleCustomer = new Customer();
$exampleCustomer->setName('First Last');
$exampleCustomer->setAddress('Full Address');
$exampleCustomer->setCity('City Name');
Page::updateCustomers($exampleCustomer);
if(isset($_POST["save"]))
{
    if(isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["city"]))
    {
        if(empty($_POST["name"]) || empty($_POST["address"]) || empty($_POST["city"]))
        {
            $_SESSION["errmsg"] = "Please fill all required fields";
            header('Location: '.$_SERVER['PHP_SELF']);
        }
        else
        {
            $newCustomer = new Customer();
            $newCustomer->setName($_POST["name"]);
            $newCustomer->setAddress($_POST["address"]);
            $newCustomer->setCity($_POST["city"]);

        CustomerDAO::createCustomer($newCustomer);
        $_SESSION["msg"] = "Added new customer";
        header('Location: '.$_SERVER['PHP_SELF']);
        } 
    }

}
if(isset($_POST["update"]))
{
    if(isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["city"]))
    {
        if(empty($_POST["name"]) || empty($_POST["address"]) || empty($_POST["city"]))
        {
            $_SESSION["errmsg"] = "Please fill all required fields";
            header('Location: '.$_SERVER['PHP_SELF']);
        }
        else
        {
            if(isset($_POST["id"]))
            {
            $updatedCustomer = new Customer();
            $updatedCustomer->setName($_POST["name"]);
            $updatedCustomer->setAddress($_POST["address"]);
            $updatedCustomer->setCity($_POST["city"]);

            CustomerDAO::editCustomer($_POST["id"],$updatedCustomer);
            $_SESSION["msg"] = "Updated customer record";
            header('Location: '.$_SERVER['PHP_SELF']);
            }
        }
    }
}
if(isset($_GET["del"]))
{
    CustomerDAO::deleteCustomer($_GET["del"]);
    $_SESSION["msg"] = "Deleted customer record";
    header('Location: '.$_SERVER['PHP_SELF']);
}
Page::footer();

?>