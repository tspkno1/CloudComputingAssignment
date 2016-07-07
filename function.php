<?php require 'connect.php'; ?>
<?php
$queryGuest = $conn->query("SELECT * FROM `guest`");
$queryProduct = $conn->query("SELECT * FROM `product`");
$queryTypeprotuct = $conn->query("SELECT * FROM `type_product`");
$queryBill = $conn->query("SELECT * FROM `bill`");
$queryBilldetail = $conn->query("SELECT * FROM `detail_bill`");
$queryOder = $conn->query("SELECT `bill`.`ID`, `GUEST_ID`, `DATE`, `NAME`, `AGE`, `ADDRESS`, `PHONE`, `EMAIL`, (SELECT COUNT(*) FROM `detail_bill` WHERE `BILL_ID` = `bill`.`ID`) AS `QUANTITY`,
(SELECT SUM(detail_bill.PRICE) FROM `detail_bill` WHERE `BILL_ID` = `bill`.`ID`) AS `TOTALAMOUNT`
FROM `bill` INNER JOIN guest ON guest_ID = guest.ID");
?>
<?php if (isset($_POST['selectGuest'])): ?>
    <table>
        <thead>
            <tr>
                <th data-field="nameCustomer">NAME</th>
                <th data-field="ageCustomer">AGE</th>
                <th data-field="addressCustomer">ADDRESS</th>
                <th data-field="phoneCustomer">PHONE</th>
                <th data-field="emailCustomer">EMAIL</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($queryGuest->num_rows): while ($rowGuest = $queryGuest->fetch_array()): ?>
                    <tr>
                        <td><?php echo $rowGuest['NAME'] ?></td>
                        <td><?php echo $rowGuest['AGE'] ?></td>
                        <td><?php echo $rowGuest['ADDRESS'] ?></td>
                        <td><?php echo $rowGuest['PHONE'] ?></td>
                        <td><?php echo $rowGuest['EMAIL'] ?></td>
                        <td>  <a onclick="geteditGuest(this.id)" id="idEditGuest<?php echo $rowGuest['ID'] ?>" href="#editGuest" class="btn-floating btn-floating waves-effect waves-light red modal-trigger"><i class="tiny material-icons">mode_edit</i></a></td>
                        <td>  <a onclick="delGuest(this.id)" id="idDelGuest<?php echo $rowGuest['ID'] ?>" class="btn-floating btn-floating waves-effect waves-light red "><i class="tiny material-icons">clear_all</i></a></td>
                    </tr>
                <?php
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if (isset($_POST['editGuest'])): ?>
    <?php
    $idEditGuest = $_POST['idEditGuest'];
    $editnameCustomertxt = $_POST['editnameCustomertxt'];
    $editageCustomertxt = $_POST['editageCustomertxt'];
    $editaddressCustomertxt = $_POST['editaddressCustomertxt'];
    $editemailCustomertxt = $_POST['editemailCustomertxt'];
    $editphoneCustomertxt = $_POST['editphoneCustomertxt'];

    $conn->query("UPDATE `guest` SET `NAME` = '$editnameCustomertxt', `AGE` = '$editageCustomertxt', `ADDRESS` = '$editaddressCustomertxt', `PHONE` = '$editphoneCustomertxt', `EMAIL` = '$editemailCustomertxt' WHERE `guest`.`ID` = $idEditGuest;");
    echo mysqli_error($conn);
    ?>
<?php endif; ?> 

<?php if (isset($_POST['delGuest'])): ?>
    <?php
    $idGuest = $_POST['iddelGuest'];
    if (!$conn->query("DELETE FROM `guest` WHERE `guest`.`ID` = {$idGuest}")) {
        http_response_code(401);
    }
    echo mysqli_error($conn);
    ?>
<?php endif; ?>  

<?php if (isset($_POST['geteditGuest'])): ?>
    <?php
    $idGuest = $_POST['idEditguest'];
    $queryGuestEdit = $conn->query("SELECT * FROM `guest` WHERE `ID` = $idGuest");
    if ($queryGuestEdit->num_rows): while ($rowGuestEdit = $queryGuestEdit->fetch_array()):
            ?>
            <div class="input-field col s12">
                <div class="input-field col s12">
                    <input id="editnameCustomertxt" type="text" value="<?php echo $rowGuestEdit['NAME'] ?>" >
                    <label for="editnameCustomertxt">Name Customer</label>
                </div>
            </div>
            <div class="input-field col s12">
                <div class="input-field col s12">
                    <input id="editageCustomertxt" type="number" value="<?php echo $rowGuestEdit['AGE'] ?>">
                    <label for="editageCustomertxt">Age</label>
                </div>
            </div>
            <div class="input-field col s12">
                <div class="input-field col s12">
                    <input id="editaddressCustomertxt" type="text" value="<?php echo $rowGuestEdit['ADDRESS'] ?>">
                    <label for="editaddressCustomertxt">Address</label>
                </div>
            </div>
            <div class="input-field col s12">
                <div class="input-field col s12">
                    <input id="editphoneCustomertxt" type="number" value="<?php echo $rowGuestEdit['PHONE'] ?>">
                    <label for="editphoneCustomertxt">Phone</label>
                </div>
            </div>
            <div class="input-field col s12">
                <div class="input-field col s12">
                    <input id="editemailCustomertxt" type="text" value="<?php echo $rowGuestEdit['EMAIL'] ?>">
                    <label for="editemailCustomertxt">Email</label>
                </div>
            </div>
        <?php
        endwhile;
    endif;
    echo mysqli_error($conn);
    ?>
<?php endif; ?>  

<?php if (isset($_POST['selectProduct'])): ?>

    <table>
        <thead>
            <tr>
                <th data-field="nameCustomer">NAME</th>
                <th data-field="ageCustomer">MFG DATE</th>
                <th data-field="addressCustomer">PRICE</th>
            </tr>
        </thead>
        <tbody>
    <?php if ($queryProduct->num_rows): while ($rowProduct = $queryProduct->fetch_array()): ?>
                    <tr>
                        <td><?php echo $rowProduct['NAME'] ?></td>
                        <td><?php echo $rowProduct['MANUF'] ?></td>
                        <td><?php echo $rowProduct['PRICE'] ?></td>
                        <td></td>
                        <td>  <a onclick="geteditProduct(this.id)" id="idEditProduct<?php echo $rowProduct['ID'] ?>" href="#editproduct" class="btn-floating btn-floating waves-effect waves-light red modal-trigger"><i class="tiny material-icons">mode_edit</i></a></td>
                        <td>  <a onclick="delProduct(this.id)" id="idDelProduct<?php echo $rowProduct['ID'] ?>" class="btn-floating btn-floating waves-effect waves-light red "><i class="tiny material-icons">clear_all</i></a></td>
                    </tr>
        <?php
        endwhile;
    endif;
    ?>
        </tbody>
    </table>
<?php endif; ?>
<?php if (isset($_POST['getallTypeProductList'])): ?>

    <table>
        <thead>
            <tr>
                <th data-field="nametypeProduct">NAME</th>
            </tr>
        </thead>
        <tbody>
    <?php if ($queryTypeprotuct->num_rows): while ($rowtyPEProduct = $queryTypeprotuct->fetch_array()): ?>
                    <tr>
                        <td><?php echo $rowtyPEProduct['NAME'] ?></td>
                        <td>  <a onclick="getedittypeProduct(this.id)" id="idEdittypeProduct<?php echo $rowtyPEProduct['ID'] ?>" href="#editTypeProduct" class="btn-floating btn-floating waves-effect waves-light red modal-trigger"><i class="tiny material-icons">mode_edit</i></a></td>
                        <td>  <a onclick="delTypeProduct(this.id)" id="idDeltypeProduct<?php echo $rowtyPEProduct['ID'] ?>" class="btn-floating btn-floating waves-effect waves-light red "><i class="tiny material-icons">clear_all</i></a></td>
                    </tr>
        <?php
        endwhile;
    endif;
    ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if (isset($_POST['geteditProduct'])): ?>
    <?php
    $idEditProduct = $_POST['idEditProduct'];
    $queryProductEdit = $conn->query("SELECT * FROM `product` WHERE `ID` = $idEditProduct");
    if ($queryProductEdit->num_rows): while ($rowProductEdit = $queryProductEdit->fetch_array()):
            ?>
            <div class="row">
                <div class="input-field col s12">
                    <div class="input-field col s12">
                        <input id="editnameProducttxt" type="text" value="<?php echo $rowProductEdit['NAME'] ?>" required>
                        <label >Name product</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="input-field col s12">
                        <label  class="">Manuf. date</label>
                        <input id="editmanufDatetxt"   type="date" value="<?php echo $rowProductEdit['MANUF'] ?>" class="datepicker" required>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="input-field col s12">
                        <input id="editpriceProducttxt" value="<?php echo $rowProductEdit['PRICE'] ?>" type="number" required>
                        <label >Price</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="input-field col s12">
                        <div class="editselectTypeProduct-ajax">
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    endif;
    ?>
    <?php endif; ?>
<?php if (isset($_POST['selectTypeProduct'])): ?>

    <select id="selectTypeProduct">
        <option value="" disabled selected>Choose type product</option>
    <?php if ($queryGuest->num_rows): while ($rowTypeprotuct = $queryTypeprotuct->fetch_array()): ?>
                <option value="<?php echo $rowTypeprotuct['ID']; ?>"><?php echo $rowTypeprotuct['NAME']; ?></option>
        <?php
        endwhile;
    endif;
    ?>
    </select>
    <label>Type product</label>
<?php endif; ?>

<?php if (isset($_POST['delTypeProduct'])): ?>
    <?php
    $idtypeProduct = $_POST['iddelTypeProduct'];
    if (!$conn->query("DELETE FROM `type_product` WHERE `type_product`.`ID` = $idtypeProduct")) {
        http_response_code(401);
    }
    echo mysqli_error($conn);
    ?>
    <?php endif; ?>  

    <?php if (isset($_POST['selectTypeProductforEdit'])): ?>

    <select id="editselectTypeProduct">
        <option value="" disabled selected>Choose type product</option>
    <?php if ($queryGuest->num_rows): while ($rowTypeprotuct = $queryTypeprotuct->fetch_array()): ?>
                <option value="<?php echo $rowTypeprotuct['ID']; ?>"><?php echo $rowTypeprotuct['NAME']; ?></option>
        <?php
        endwhile;
    endif;
    ?>
    </select>
    <label>Type product</label>
<?php endif; ?>    

<?php if (isset($_POST['addProduct'])): ?>
    <?php
    $nameproduct = $_POST['nameProducttxt'];
    $manufproduct = $_POST['manufDatetxt'];
    $priceproduct = $_POST['priceProducttxt'];
    $typeproductionID = $_POST['selectTypeProduct'];
    $conn->query("INSERT INTO product (NAME,MANUF,PRICE,TYPE_PRODUCT_ID) VALUES ('{$nameproduct}','{$manufproduct}','{$priceproduct}','{$typeproductionID}')");
    echo mysqli_error($conn);
    ?>
<?php endif; ?>

<?php if (isset($_POST['delProduct'])): ?>
    <?php
    $idProduct = $_POST['iddelProduct'];
    
    if (!$conn->query("DELETE FROM `product` WHERE `product`.`ID` = {$idProduct}")) {
        http_response_code(401);
    }
    echo mysqli_error($conn);
    ?>
<?php endif; ?>  

<?php if (isset($_POST['editProduct'])): ?>
    <?php
    $idProduct = $_POST['idEditProduct'];
    $nameproduct = $_POST['editnameProducttxt'];
    $manufproduct = $_POST['editmanufDatetxt'];
    $priceproduct = $_POST['editpriceProducttxt'];
    $typeproductionID = $_POST['editselectTypeProduct'];

    $conn->query("UPDATE `product` SET `ID` = '$idProduct', `NAME` = '$nameproduct', `MANUF` = '$manufproduct', `PRICE` = '$priceproduct', `TYPE_PRODUCT_ID` = '$typeproductionID' WHERE `product`.`ID` = $idProduct;");
    echo mysqli_error($conn);
    ?>
<?php endif; ?>   

<?php if (isset($_POST['addTypeProduct'])): ?>
    <?php
    $nameTypeProducttxt = $_POST['nameTypeProducttxt'];
    $conn->query("INSERT INTO type_product (NAME) VALUES ('{$nameTypeProducttxt}')");
    echo mysqli_error($conn);
    ?>

<?php endif; ?>

<?php if (isset($_POST['addGuest'])): ?>
    <?php
    $nameCustomertxt = $_POST['nameCustomertxt'];
    $ageCustomertxt = $_POST['ageCustomertxt'];
    $addressCustomertxt = $_POST['addressCustomertxt'];
    $phoneCustomertxt = $_POST['phoneCustomertxt'];
    $emailCustomertxt = $_POST['emailCustomertxt'];
    $conn->query("INSERT INTO guest (NAME,AGE,ADDRESS,PHONE,EMAIL) VALUES ('{$nameCustomertxt}','{$ageCustomertxt}','{$addressCustomertxt}','{$phoneCustomertxt}','{$emailCustomertxt}') ");
    echo mysqli_error($conn);
    ?>
    <?php endif; ?>

<?php if (isset($_POST['selectGuestOder'])): ?>

    <select id="selectGuestOder">
        <option value="" disabled selected>Customer</option>
    <?php if ($queryGuest->num_rows): while ($rowGuest = $queryGuest->fetch_array()): ?>
                <option value="<?php echo $rowGuest['ID']; ?>"><?php echo $rowGuest['NAME']; ?></option>
            <?php
            endwhile;
        endif;
        ?>
    </select>
    <label>Customer</label>
<?php endif; ?>

<?php if (isset($_POST['selectProductOder'])): ?>
    <select id="selectProductOder">
        <option value="" disabled selected>Product</option>
    <?php if ($queryGuest->num_rows): while ($rowProduct = $queryProduct->fetch_array()): ?>
                <option value="<?php echo $rowProduct['ID']; ?>"><?php echo $rowProduct['NAME']; ?></option>
        <?php
        endwhile;
    endif;
    ?>
    </select>
    <label>Product</label>
<?php endif; ?>

<?php if (isset($_POST['selectOrder'])): ?>
    <table>
        <thead>
            <tr>
                <th data-field="nameOder">NAME</th>
                <th data-field="ageOder">PROMT DAY</th>
                <th data-field="addressOder">QUANTITY</th>
                <th data-field="phoneOder">TOTAL AMOUNT</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if ($queryOder->num_rows): while ($rowOder = $queryOder->fetch_array()): ?>
                    <tr>
                        <td><?php echo $rowOder['NAME'] ?></td>
                        <td><?php echo $rowOder['DATE'] ?></td>
                        <td><?php echo $rowOder['QUANTITY'] ?></td>
                        <td><?php echo $rowOder['TOTALAMOUNT'] ?></td>
                    
                        <td>  <a onclick="geteditOder(this.id)" id="idEditOder<?php echo $rowGuest['ID'] ?>" href="#editGuest" class="btn-floating btn-floating waves-effect waves-light red modal-trigger"><i class="tiny material-icons">mode_edit</i></a></td>
                        <td>  <a onclick="delOder(this.id)" id="idDelOder<?php echo $rowGuest['ID'] ?>" class="btn-floating btn-floating waves-effect waves-light red "><i class="tiny material-icons">clear_all</i></a></td>
                    </tr>
                <?php
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
<?php endif; ?>
    
<?php if (isset($_POST['getedittypeProduct'])): ?>
    <?php
    $idEditTypeProduct = $_POST['idEditTypeProduct'];
    $queryTypeProductEdit = $conn->query("SELECT * FROM `type_product` WHERE `ID` = $idEditTypeProduct");
    if ($queryTypeProductEdit->num_rows): while ($rowtypeEdit = $queryTypeProductEdit->fetch_array()):
            ?>
        
                <div class="input-field col s12">
                    <input id="edittypeproducttxt" type="text" value="<?php echo $rowtypeEdit['NAME'] ?>" >
                    <label for="edittypeproducttxt">Name</label>
                </div>
         
            
        <?php
        endwhile;
    endif;
    echo mysqli_error($conn);
    ?>
<?php endif; ?> 
    
<?php if (isset($_POST['editTypeProduct'])): ?>
    <?php
    $idEditTypeProduct = $_POST['idEditTypeProduct'];
    $edittypeproducttxt = $_POST['edittypeproducttxt'];

    $conn->query("UPDATE `type_product` SET `NAME` = '$edittypeproducttxt' WHERE `type_product`.`ID` = $idEditTypeProduct;");
    echo mysqli_error($conn);
    ?>
<?php endif; ?>      
    