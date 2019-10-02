<?php
class Page  {
    public static $title = "Please set the title";
    public static $selectedCustomer = null;
    static function header() { 
        if(isset($_GET["edit"]))
        {
            $id= $_GET["edit"];
            self::$selectedCustomer = CustomerDAO::getSelectedCustomer($id);
            $name = self::$selectedCustomer->getName();
            $address = self::$selectedCustomer->getAddress();
            $city = self::$selectedCustomer->getCity();
        }
    ?>
        <!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

            <title><?php echo self::$title; ?></title>
        </head>
        <body>
            <h1 class="display-4"><?php echo self::$title; ?></h1><br />
            <?php
            if(isset($_SESSION["msg"]))
            {
            ?>
                <div class="alert alert-success" role="alert">
                <?php 
                    echo $_SESSION["msg"]; 
                    unset($_SESSION["msg"]);
                ?>
                </div>
            <?php
            }
            if(isset($_SESSION["errmsg"]))
            {
            ?>
                <div class="alert alert-danger" role="alert">
                <?php 
                    echo $_SESSION["errmsg"]; 
                    unset($_SESSION["errmsg"]);
                ?>
                </div>
            <?php
            }
            ?>

    <?php 
    }

    static function displayCustomers($customers)
    {?>
        <table class="table">
            <thead>
                <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Delete</th>
                <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($customers as $customer)   {
                echo '<TR>';
                echo '<TD>'.$customer->getName().'</TD>';
                echo '<TD>'.$customer->getAddress().'</TD>';
                echo '<TD>'.$customer->getCity().'</TD>';
                echo '<TD> <a href='.$_SERVER["PHP_SELF"]. '?del='. $customer->getCustomerID().'>Delete</a></TD>';
                echo '<TD> <a href='.$_SERVER["PHP_SELF"]. '?edit='. $customer->getCustomerID().'>Edit</a></TD>';
                echo '</TR>';
            }
            ?>
            </tbody>
        </table>
    <?php
    }
    static function updateCustomers($selCust)
    {
        if(self::$selectedCustomer != null)
        {
            $selCust = self::$selectedCustomer;
            ?>
            <h1 class="display-4">Edit Customer - <?php echo $selCust->getCustomerID() ?></h1><br />
            <?php
        }
        else
        {
        ?>
        <h1 class="display-4">Add Customer</h1><br />
        <?php
        }?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $selCust->getCustomerID() ?>">
            <div class="form-group">
                <label>Name</label><br />
                    <input type="text" name="name" placeholder="<?php echo $selCust->getName() ?>">
            </div>
            <div class="form-group">
                <label>Address</label><br />
                <input type="text" name="address" placeholder="<?php echo $selCust->getAddress(); ?>">
            </div>
            <div class="form-group">
                <label>City</label><br />
                    <input type="text" name="city" placeholder="<?php echo $selCust->getCity(); ?>">
            </div>
            <?php
            if(self::$selectedCustomer == NULL)
            {?>
            <div class="input group">
                <button type="submit" name="save" class="btn btn-primary">Submit</button>
            </div>
            <?php
            }
            else
            {?>
            <div class="input group">
                <button type="submit" name="update" class="btn btn-primary">Submit</button>
            </div>
            <?php
            }
            ?>
            
        </form>
    <?php
    }
    static function footer() { ?>
    
        <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
        </html>

    <?php }

}
?>