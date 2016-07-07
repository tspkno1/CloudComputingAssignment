<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
            }
        </style>
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo">Shop Manager</a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href=""><i class="material-icons">search</i></a></li>
                        <li><a href=""><i class="material-icons">view_module</i></a></li>
                        <li><a href=""><i class="material-icons">refresh</i></a></li>
                        <li><a href=""><i class="material-icons">more_vert</i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
    <center>
        <!--     Tab-->
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a href="#Product" onclick="getAllProduct()">Product</a></li>
                    <li class="tab col s3"><a class="active" onclick="getAllGuest()" href="#Guest">Guest</a></li>
                    <li class="tab col s3"><a href="#Order" onclick="getProductforOder()">Order</a></li>
                </ul>
            </div>
            <!--            Product content-->
            <div id="Product" class="col s12">
                <div class="row">
                    <div class="col s4">
                        <div class="row">

                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <input id="nameProducttxt" type="text" required>
                                    <label for="nameProducttxt">Name product</label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <label for="manufDatetxt" class="">Manuf. date</label>
                                    <input id="manufDatetxt"  type="date" class="datepicker" >
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <input id="priceProducttxt" type="number" >
                                    <label for="priceProducttxt">Price</label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <div class="selectTypeProduct-ajax">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light" id="btnaddproduct">Add
                            <i class="material-icons right">done_all</i>
                        </button>
                        <div class="col s12"> 
                        <h5>Add Type Product</h5>
                        <div class="input-field col s12">
                            <input id="nameTypeProducttxt" type="text" length="20" >
                            <label for="nameTypeProducttxt">Name type</label>
                        </div>
                        <button class="btn waves-effect waves-light" id="btnaddTypeProduct" >Add
                            <i class="material-icons right">done_all</i>
                        </button>
                        <div class="col s12"> 
                        <div class="tableTypeProduct-ajax">
                        </div></div></div>
                    </div>

                    <div class="col s8"> 
                        <nav class="z-depth-0"> 
                            <div class="nav-wrapper" >
                                <a class="brand-logo center">List Products</a>
                        </nav>
                        <div class="tableProduct-ajax">

                        </div>
                    </div>

                </div>
            </div>
            <!--    guest-->
            <div id="Guest" class="col s12" >
                <div class="row">
                    <div class="col s4">
                        <div class="row">

                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <input id="nameCustomertxt" type="text" >
                                    <label for="nameCustomertxt">Name Customer</label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <input id="ageCustomertxt" type="number" >
                                    <label for="ageCustomertxt">Age</label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <input id="addressCustomertxt" type="text" >
                                    <label for="addressCustomertxt">Address</label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <input id="phoneCustomertxt" type="number" >
                                    <label for="phoneCustomertxt">Phone</label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <input id="emailCustomertxt" type="text" >
                                    <label for="emailCustomertxt">Email</label>
                                </div>
                            </div>

                        </div>
                        <button class="btn waves-effect waves-light"  id="btnaddCustomer">Add
                            <i class="material-icons right">done_all</i>
                        </button>
                    </div>

                    <div class="col s8"> 
                        <nav class="z-depth-0"> 
                            <div class="nav-wrapper" >
                                <a class="brand-logo center">List Customer</a>
                        </nav>
                        <div class="tableGuest-ajax">

                        </div>
                    </div>

                </div>
            </div>
            <!--            Order content-->
            <div id="Order" class="col s12">
                <div class="row">
                    <form class="col s4">
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <div class="selectGuestOder-ajax">

                                    </div>

                                </div>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s8">
                                    <div class="selectProductOder-ajax">

                                    </div>
                                </div>
                                <div class="input-field col s2"><select>
                                        <script>for (var i = 1; i < 10; i++) {
                                                document.write("<option value=" + i + ">" + i + "</option>")
                                            }
                                        </script>
                                    </select>
                                    <label>Quantity</label>
                                </div>
                                <div class="input-field col s2">
                                    <a onclick="clickAddProductOder()" class="btn-floating"><i class="material-icons">add</i></a>
                                </div>



                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s12">
                                    <label for="manufDateOdertxt" class="">Manuf. date</label>
                                    <input id="manufDateOdertxt"  type="date" class="datepicker" >
                                </div>
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light" type="submit" name="addCustomer">Add
                            <i class="material-icons right">done_all</i>
                        </button>
                    </form>

                    <div class="col s8"> 
                        <nav class="z-depth-0"> 
                            <div class="nav-wrapper" >
                                <a class="brand-logo center">List Oder</a>
                        </nav>
                        <div class="tableOder-ajax"></div>
                    </div>

                </div>
            </div></div>
    </div>
</div>



</center>

<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">INF Cloud Computing</h5>
                <p class="grey-text text-lighten-4">Make web application on cloud easies with php and material UI.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">FPT Polytechnic</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Home Polytechnic</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">AP Polytechnic</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">LMS Polytechnic</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Forum Polytechnic</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2016 Copyright INF-205 by khuyennpd00990@fpt.edu.vn
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>

  <div id="editproduct" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Edit Product</h4> 
      <div class="modaEdit-ajax"></div>   
     
    </div>
      
    <div class="modal-footer">
        <a id="agreeEdit"href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
        <a id="disagreeEdit" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Disagree</a>
    </div>
  </div>
    
     <div id="editGuest" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Edit Guest</h4> 
      <div class="modaEditGuest-ajax">
          
</div>   
      
    </div>
      
    <div class="modal-footer">
        <a id="agreeEditGuest"href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
        <a id="disagreeEditGuest" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Disagree</a>
    </div>
  </div>
    
 <div id="editTypeProduct" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Edit Type Production</h4> 
      <div class="modaEditTypeProduct-ajax">
          
</div>   
      
    </div>
      
    <div class="modal-footer">
        <a id="agreeEditTypeProduct"href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
        <a id="disagreeEditTypeProduct" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Disagree</a>
    </div>
  </div>

<!--Import jQuery before materialize.js-->

<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>
<script src="js/main.js" type="text/javascript"></script>
</body>
</html>