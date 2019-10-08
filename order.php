<?php
require_once("vicUtility.php");
require_once("Mail.php");
require_once('Mail/mime.php');
 deHeader("Rock-Tama | Order Products","Pillar Poles, Rock-Tama, water, Order, Product, Bottled water, Nanka, Anambra", $adjust = false,"Order for Rock-Tama Products, How ypu can order for water at Rock-Tama Table Water");
?>



      <!-- This is where the content of the webpage started -->
      
      <nav class="navbar navbar-expand-lg navbar-light fixed-top"><!-- the Nav section -->
                    <a class="navbar-brand" href="index">
                    <img src="Images/Logo.jpg" width="30" height="30" class="d-inline-block align-top" />
                        <strong><b>ROCK-TAMA</b></strong>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item  wow flash">
                        <a class="nav-link" href="index.php"> <i class="fas fa-home"></i>Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item wow  tada">
                        <a class="nav-link" href="products.php"><i class="fas fa-user-tie"></i>Products</a>
                        </li>

                        <li class="nav-item  wow shake">
                        <a class="nav-link" href="services.php"><i class="fab fa-servicestack"></i>Services</a>
                        </li>

                        <li class="nav-item  active  wow shake">
                        <a class="nav-link" href="order.php"><i class="fas fa-cart-plus"></i>Order</a>
                        </li>
                        
                        <li class="nav-item  wow swing">
                        <a class="nav-link" href="AboutUs.php"><i class="fab fa-accessible-icon"></i>About Us</a>
                        </li>
                        <li class="nav-item   wow heartBeat">
                        <a class="nav-link" href="Contact.php"><i class="fas fa-phone"></i>Contact</a>
                        </li>
                    </ul>
                   
             </nav>
            <!-- This is where the nav ends -->


            <div class="container-fluid">

                <div class="row Order">
                    <blockquote>Make Order</blockquote>
                </div>
                <div class="row">
                    <p class="OrderPar"> When order is made, you will recieve the service within 24 hours and if you ever have any problem 
                    with any of our products, then you have to call us or contact us to rectify any issue. Also, Note that 
                   <b> Payment is made on delivery </b> </p>
                </div>

            </div>

            <div class="container-fluid" id="laOrder">

            <?php
				if(isset($_POST["orderButton"])){
					processForm(); // If the user submits the form, call this function
				}else{
					displayForm(array()); // Display This if the the user loads the page
				}


                function validateFields($fieldName, $missingFields){ // Validating the label i.e putting the red color to show an error.
					if(in_array($fieldName, $missingFields)){
						echo 'class="alert alert-danger"';
					}
				}

				function setValue($fieldName){ // Sets the value of the previous so that user don't need to retype
					if(isset($_POST[$fieldName])){
						echo $_POST[$fieldName];
					}
				}

				function setChecked($fieldName, $fieldValue){
					if(isset($_POST[$fieldName]) and $_POST[$fieldName]== $fieldValue){
						echo 'checked = "checked"';
					}
				}

				function setSelected($fieldName, $fieldValue){
					if(isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue){
						echo 'selected = "selected"';
					}
                }
                

                function processForm(){
					$requiredFields = array("client_Name","email_Address", "mobile_NO","Residential_Address", "messages"); // The name of the 
                    $missingFields = array();
                    $quantityFields = array("SachetQuantity", "BottledShrink", "BottledCarton");

					foreach($requiredFields as $requiredField){ // For each of the required fields,
						if(!isset($_POST[$requiredField]) or !trim($_POST[$requiredField])){ // If any of them has no value
							$missingFields[] = $requiredField;  // Put them in the missing field array
						}
                    }
                    foreach($quantityFields as $quantityField){
                        if(!isset($_POST[$quantityField]) or $_POST[$quantityField]== 0 ){
                            $_POST[$quantityField] = "0";
                        }
                    }
					if($missingFields){ // if there is any missing field,
						displayForm($missingFields); // display the form with those fields marked error
					}else{
                        displayThanks();  // if there is no missing field , display the congrats/ Thanks  message
                    }
				}


                function displayForm($missingFields){
                    ?>

                    <div class="inna4Form">
                        <div class="OuttaForForm">
                                    <?php if($missingFields){ ?>
                                    <p class="alert alert-danger"> There are some problem with the form you submitted, Kindly rectify and submit again </p>
                                    <?php } else{ ?>
                                    <p> Please fill in the form, we will get back to you as soon as possible.</p>
                                    <?php } ?>
    
                                    <form id="contactForm" method="post">
    
    
                                        <!--  The name of the clients -->
                                        <p class="DaDetail"> Customer's Info </p>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="yourName" <?php validateFields("client_Name", $missingFields) ?>> Your Name </label>
                                                    <input type="text" class="form-control" id="yourName" name="client_Name" placeholder="Input Your Name please" value="<?php setValue("client_Name") ?>"  />
                                                </div>
                                            
                                                <div class="alert alert-danger hide" id="nameAlert"> </div>
                                            </div>
    
    
                                        <!-- The email field -->
                                            <div class="col-md-6 col-lg-6"> 
                                                <div class="form-group">
                                                    <label for="yourEmail" <?php validateFields("email_Address", $missingFields) ?>> Email </label>
                                                    <input type="text" class="form-control" id="yourEmail" name="email_Address"  placeholder="Input a valid email"  value="<?php setValue("email_Address") ?>"/>
                                                </div>
    
                                                <div class="alert alert-danger hide" id="emailAlert"> </div>
                                            </div>
                                        </div>
    
                                                                        
                                        
                                        <div class="row">

                                        <!-- The mobile Number field -->
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="mobileNo"  <?php validateFields("mobile_NO", $missingFields) ?>> Phone No </label>
                                                    <input type="text" class="form-control" id="mobileNo" name="mobile_NO" aria-descibedby="mobiNoHelp" placeholder="Input a valid phone Number" value="<?php setValue("mobile_NO") ?>"  />
                                                    <small id="mobiNoHelp" class="form-text text-muted"> Use the format e.g 08022222222 </small>
                                                </div>
    
                                                <div class="alert alert-danger hide" id="phoneNoAlert"> </div>
                                            </div>

                                            <!-- The  Residential Number  field -->
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="Residential_Address" <?php validateFields("Residential_Address", $missingFields) ?>>Company / Residential Address </label>
                                                    <input type="text" class="form-control ind_form" id="Residential_Address" name="Residential_Address" value="<?php setValue("Residential_Address") ?>" placeholder="Where do you/Company reside ?" />
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <!-- This is where the quantity of the product is required-->
                                        <p class="DaDetail"> Order Details</p>
                                        <p style="text-align:center"> Please input 0(zero) if you don't need any of this prodcuts </p>
                                        <!-- This is for sachet water -->
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="SachetQuantity" > Sachet Water (Quantity) </label>
                                                    <input type="text" class="form-control" id="SachetQuantity" name="SachetQuantity" aria-descibedby="SachetQuantityHelp" placeholder="Input the number of Sachet water you need" value="<?php setValue("SachetQuantity") ?>"  />
                                                </div>
    
                                                <div class="alert alert-danger hide" id="SachetQuantityAlert"> </div>
                                            </div>
                                        
                                        <!-- This is for Bottled water (Shrink)-->
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="BottledShrink" > Bottled Water(Shrink Cover) </label>
                                                    <input type="text" class="form-control" id="BottledShrink" name="BottledShrink" aria-descibedby="SachetQuantityHelp" placeholder="Input the number of bottle water(Shrink cover) needed" value="<?php setValue("BottledShrink") ?>"  />
                                                </div>
                                                <div class="alert alert-danger hide" id="BottledShrinkAlert"> </div>
                                            </div>
                                        </div>

                                        <!-- This is for Bottled water (Carton)-->
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="BottledCarton" > Bottled Water(Carton Cover) </label>
                                                    <input type="text" class="form-control" id="BottledCarton" name="BottledCarton" aria-descibedby="SachetQuantityHelp" placeholder="Input the number of bottle water(Carton cover) needed" value="<?php setValue("BottledCarton") ?>"  />
                                                </div>
                                                <div class="alert alert-danger hide" id="BottledCartonAlert"> </div>
                                            </div>

                                         <!-- The message field -->
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="Message" <?php validateFields("messages", $missingFields) ?>>Message </label>
                                                    <textarea class="form-control" id="Message" rows="3" name="messages"> <?php setValue("messages") ?></textarea>
                                                </div>
            
                                                <div class="alert alert-danger hide" id="MessageAlert"> </div>
                                            </div>

                                        </div>

                                        <div class="row btn-groupc">
                                             <button type="submit" id="subForming" name="orderButton" class="btn btn-outline-primary"> Submit </button>
                                        </div>
                                    </form>

                                </div>
                              </div>          
                            <?php
                                }
                                function displayThanks(){
                                    insertToDb();// This inserts the data to the database.
                                    sendMailToManager(); // This fucntion sends mail to the manager of the company
                                    sendMailToClient(); // This function sends mail to client
                                
                                ?>
                                    <h4> <strong> Your Info</strong></h4>
                                    <p> Thank you  <b><i><strong><?php echo strtoupper($_POST["client_Name"]) ?></i></b></strong> Your order has been recieved, we are working to make sure your order gets to you within 24 hours.
                                        will get back to you as soon as we can.</p>
                                    <table class="table table-striped">
                                        <caption id="info-Caption"> <span class="label label-success">Your Info</span> </caption>
                                            <tr>
                                                <td>Company/Customer Name</td>
                                                <td><?php echo  strtoupper($_POST["client_Name"])?></td>
                                            </tr>
                
                                            <tr>
                                                <td>Phone Number </td>
                                                <td><?php echo $_POST["mobile_NO"]?></td>
                                            </tr>
                
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $_POST["email_Address"]?></td>
                                            </tr>
                
                                            <tr>
                                                <td>Address</td>
                                                <td><?php echo $_POST["Residential_Address"]?></td>
                                            </tr>

                                            <th> Product Detail </th>

                                            <tr>
                                                <td>Bags Of Sachet</td>
                                                <td><?php echo $_POST["SachetQuantity"]?></td>
                                            </tr>

                                            <tr>
                                                <td>Bottle Water(Shrink Package)</td>
                                                <td><?php echo $_POST["BottledShrink"]?></td>
                                            </tr>

                                            
                                            <tr>
                                                <td>Bottle Water(Carton Package)</td>
                                                <td><?php echo $_POST["BottledCarton"]?></td>
                                            </tr>

                                            


                                            <tr>
                                                <td>Message</td>
                                                <td><?php echo $_POST["messages"]?></td>
                                            </tr>
                                    </table>
                
                
                                    <div class="btn-group">
                                        <a href="index.php"><button class="btn-success"> OK</button></a>
                                    </div>
                
                                    <?php
                                    }

                                    function  insertToDb(){
                                        $dsn = "mysql:host=one;dbname=pillarpo_Database";
                                        $username = "pillarpo_root";
                                        $password = "IAmVicman@1999";
                
                                        try{
                                            $conn = new PDO($dsn, $username, $password);
                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        }catch(PDOException $e){
                                            echo "Connection failed: " . $e->getMessage();
                                        }
                
                                        $compName = $_POST["client_Name"];
                                        $phoneNumber = $_POST["mobile_NO"];
                                        $email = $_POST["email_Address"];
                                        $residentialAddress = $_POST["Residential_Address"];
                                        $sachetQuantity = $_POST["SachetQuantity"];
                                        $bottledShrink = $_POST["BottledShrink"];
                                        $BottledCarton = $_POST["BottledCarton"];
                                        $messages = $_POST["messages"];
                                        $orderDate = date("Y-m-d");
                
                                        $sql = "INSERT INTO orders(clientName, mobile, emailAddress, compAddress, sachetQuantity, bottledShrink, BottledCarton, orderDate, messages )  VALUES(:clientName, :mobile, :emailAddress, :compAddress , :sachetQuantity , :bottledShrink,:BottledCarton, :orderDate,:messages)";
                
                                        try{
                                            $st = $conn->prepare($sql);
                                            $st->bindValue(":clientName", $compName, PDO::PARAM_STR);
                                            $st->bindValue(":mobile", $phoneNumber, PDO::PARAM_STR);
                                            $st->bindValue(":emailAddress", $email, PDO::PARAM_STR);
                                            $st->bindValue(":compAddress", $residentialAddress, PDO::PARAM_STR);
                                            $st->bindValue(":sachetQuantity", $sachetQuantity, PDO::PARAM_INT );
                                            $st->bindValue(":bottledShrink", $bottledShrink, PDO::PARAM_INT );
                                            $st->bindValue(":BottledCarton", $BottledCarton, PDO::PARAM_INT );
                                            $st->bindValue(":messages", $messages, PDO::PARAM_STR);
                                            $st->bindValue(":orderDate", $orderDate, PDO::PARAM_STR);
                                            $st->execute();
                                        }catch(PDOException $e){
                                            die("Query failed: ". $e->getMessage());
                                        }
                                    }
                                    ?>
                                    
                        </div>


<?php
 foota();



 function  sendMailToClient(){
    $name = $_POST["client_Name"];

    $to = $_POST["email_Address"];;// The email of the person to be sent to , if you have a so many recipient, then it should be splitted with commas
    $username = "info@pillarpole.com"; // The domamin email, where the mail is coming from
    $password = "IAmVicman@1999"; // The password of the mail in the top
    $from = "Rock-Tama Waters <info@pillarpole.com>"; // The domamin email, where the mail is coming from
    $subject  = "Rock-Tama Waters"; // It is like a subtopic, or the name of the company the mail is coming from
    $message = "Dear " .$_POST["client_Name"].", <br>
                <br>
                 We, have recieved your request. Be patient with us as we work on it.<br/>
                 Please, do not resend your request.<br/><br/>
                 Thanks.";
    // The body of the maill, akind of the content
    $request = $_POST["messages"]; // The body of the maill, akind of the content
    $headers = array('From'=>$from, 'To'=>$to, 'Subject'=>$subject); // This is an array containing the header, where the mail is coming from and going.

        $text = ''; // text versions of email.
        $html = "<html><body>
         $message <br><br>

         </body></html>"; // html versions of email.

        $crlf = "\n";

        $mime = new Mail_mime($crlf);
        $mime->setTXTBody($text);
        $mime->setHTMLBody($html);
        //do not ever try to call these lines in reverse order
        $body = $mime->get();
        $headers = $mime->headers($headers);


    $smtp = Mail::factory('smtp', array('host'=>localhost, 'auth'=>true, 'username'=>$username, 'password'=>$password, 'port'=> 25));
    $mail = $smtp->send($to, $headers, $body);
    if(PEAR::isError($mail)){
        echo "<p>".  $mail->getMessage(). "</p>";
    }else{
        echo "";
    }
}


    function  sendMailToManager(){
        $name = $_POST["client_Name"];
        $email = $_POST["email_Address"];
        $phoneNumber = $_POST["mobile_NO"];
        $residentialAddress = $_POST["Residential_Address"];
        $sachetQuantity = $_POST["SachetQuantity"];
        $bottledShrink = $_POST["BottledShrink"];
        $BottledCarton = $_POST["BottledCarton"];
        $orderDate = date("Y-m-d");

        $to = "rocktamawaters@gmail.com";// The email of the person to be sent to , if you have a so many recipient, then it should be splitted with commas
        $username = "info@pillarpole.com"; // The domamin email, where the mail is coming from
        $password = "IAmVicman@1999"; // The password of the mail in the top
        $from = "Rock-Tama Waters <info@pillarpole.com>"; // The domamin email, where the mail is coming from
        $subject  = "Customer's Request"; // It is like a subtopic, or the name of the company the mail is coming from
        $message = "Dear Manager,<br>
                     this is to inform you that a request have been made from a customer.";
        // The body of the maill, akind of the content
        $request = $_POST["messages"]; // The body of the maill, akind of the content
        $headers = array('From'=>$from, 'To'=>$to, 'Subject'=>$subject); // This is an array containing the header, where the mail is coming from and going.

            $text = ''; // text versions of email.
            $html = "<html><body>
             <b> Message: </b>$message <br>
             <b>Name: </b> $name <br>
             <b>Phone Number: </b> $phoneNumber <br>
             <b>Email: </b> $email<br>
             <b>residentialAddress: </b>  $residentialAddress<br>
             <b>Sachet Water Quantity: </b>  $sachetQuantity<br>
             <b>Shrink Bottled Water Quantity: </b>  $bottledShrink <br>
             <b>Carton Bottled Water Quantity: </b>  $BottledCarton <br>
             <b>Request:  </b>$request

             </body></html>"; // html versions of email.

            $crlf = "\n";

            $mime = new Mail_mime($crlf);
            $mime->setTXTBody($text);
            $mime->setHTMLBody($html);
            //do not ever try to call these lines in reverse order
            $body = $mime->get();
            $headers = $mime->headers($headers);


        $smtp = Mail::factory('smtp', array('host'=>localhost, 'auth'=>true, 'username'=>$username, 'password'=>$password, 'port'=> 25));
        $mail = $smtp->send($to, $headers, $body);
        if(PEAR::isError($mail)){
            echo "<p>".  $mail->getMessage(). "</p>";
        }else{
            echo "";
        }
    }

    
?>
            