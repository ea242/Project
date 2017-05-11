<?php include '../view/header.php'; ?>
<main>
    <h1>View/Update Customer</h1>
    <form action="index.php" method="post" id="aligned">
        <input type="hidden" name="action" value="edit_customer">
        <input type="hidden" name="customerID" value="<?php echo $customer->getCustomerID();?>">
        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo $customer->getFirstName();?>"/>
        <br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo $customer->getLastName();?>"/>
        <br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $customer->getAddress();?>"/>
        <br>

        <label>City:</label>
        <input type="text" name="city" value="<?php echo $customer->getCity();?>"/>
        <br>

        <label>State:</label>
        <input type="text" name="state" value="<?php echo $customer->getState();?>"/>
        <br>

        <label>Postal Code:</label>
        <input type="text" name="postalCode" value="<?php echo $customer->getPostalCode();?>"/>
        <br>

        <label>Country Code:</label>
        <input type="text" name="countryCode" value="<?php echo $customer->getCountryCode();?>"/>
        <br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $customer->getPhone();?>"/>
        <br>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $customer->getEmail();?>"/>
        <br>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $customer->getPassword();?>"/>
        <br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Update Customer"/>
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_customers">Search Customers</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>