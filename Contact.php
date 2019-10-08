<?php
require_once("vicUtility.php");
require_once("Mail.php");
require_once('Mail/mime.php');
 deHeader("Rock-Tama | Contact","Pillar Poles, Rock-Tama, water, contact,Bottled water, Nanka, Anambra", $adjust = false,"Contact Rock -Tama table water, How you can contact Rock-Tama");
?>



      <!-- This is where the content of the webpage started -->
      
      <nav class="navbar navbar-expand-lg navbar-light fixed-top"><!-- the Nav section -->
                    <a class="navbar-brand" href="index.php">
                    <img src="Images/Logo.jpg" width="30" height="30" class="d-inline-block align-top" />
                        <strong><b> ROCK-TAMA</b></strong>
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

                        <li class="nav-item  wow shake">
                        <a class="nav-link" href="order.php"><i class="fas fa-cart-plus"></i>Order</a>
                        </li>
                        
                        <li class="nav-item  wow swing">
                        <a class="nav-link" href="AboutUs.php"><i class="fab fa-accessible-icon"></i>About Us</a>
                        </li>

                        <li class="nav-item  active  wow heartBeat">
                        <a class="nav-link" href="Contact.php"><i class="fas fa-phone"></i>Contact</a>
                        </li>
                    </ul>
                   
             </nav>
            <!-- This is where the nav ends -->


        <div class="container-fluid">

            <div class="row Contact">
                <blockquote>Contact Us </blockquote>
            </div>

            <div class="row connections">

                <div class="col-md-6 col-lg-6 deDetails">
                    <dl>
                        <dt class=" wow jackInTheBox"><i class="fas fa-globe"></i> Head Office: </dt> 
                        <dd class=" wow zoomInUp"><address> Opposite PillarPole filling station Nanka</address> </dd>
                        <dt class=" wow jackInTheBox"><i class="fas fa-globe"></i> Factory :  </dt> 
                        <dd class=" wow zoomInUp"><address> Enugu Nanka</address> </dd>
                        <dt class=" wow zoomInRight"><i class="fas fa-mobile"></i> Mobile No :</dt>
                        <dd class=" wow zoomInLeft"><a href=""> +2349011341393</a> or <a href="">+2347031191571</a></dd>
                        <dt class=" wow zoomInDown"><i class="fas fa-envelope-square"></i> Email address: </dt>
                        <dd class=" wow zoomIn"><a href="mailto:rocktamawaters@gmail.com"> rocktamawaters@gmail.com</a></dd>
                        <dd class=" wow zoomIn"><a href="mailto:info@pillarpole.com">info@pillarpole.com</a></dd>
                    </dl>

                        <img src="Images/Rock-Tama waters  4.jpg" alt="" class="img-fluid" />
                </div>



            <!-- This is where the form started-->
			<?php
				if(isset($_POST["submitButton"])){
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
					$requiredFields = array("client_Name","email_Address", "mobile_NO", "messages"); // The name of the 
					$missingFields = array();

					foreach($requiredFields as $requiredField){ // For each of the required fields,
						if(!isset(($_POST[$requiredField])) or !trim($_POST[$requiredField])){ // If any of them has no value
							$missingFields[] = $requiredField;  // Put them in the missing field array
						}
					}
					if($missingFields){ // if there is any missing field,
						displayForm($missingFields); // display the form with those fields marked error
					}else{
                        displayThanks();
                        insertToDb(); // if there is no missing field , display the congrats/ thenks message
					}
				}

				function displayForm($missingFields){
				?>

                    <div class="col-md-6 col-lg-6">
                        <div class="inna4Form">
                            <div class="OuttaForForm">
                                <?php if($missingFields){ ?>
                                <p class="alert alert-danger"> There are some problem with the form you submitted, Kindly rectify and submit again </p>
                                <?php } else{ ?>
                                <p> Please fill in the form, we will get back to you as soon as possible.</p>
                                <?php } ?>

                                <form id="contactForm" method="post">


                                    <!--  The name of the clients -->
                                    <div class="form-group">
                                        <label for="yourName" <?php validateFields("client_Name", $missingFields) ?>> Your Name </label>
                                        <input type="text" class="form-control" id="yourName" name="client_Name" placeholder="Input Your Name please" value="<?php setValue("client_Name") ?>"  />
                                    </div>
                                    <div class="alert alert-danger hide" id="nameAlert"> </div>


                                    <!-- The email field -->
                                    <div class="form-group">
                                        <label for="yourEmail" <?php validateFields("email_Address", $missingFields) ?>> Email </label>
                                        <input type="text" class="form-control" id="yourEmail" name="email_Address"  placeholder="Input a valid email"  value="<?php setValue("email_Address") ?>"/>
                                    </div>

                                    <div class="alert alert-danger hide" id="emailAlert"> </div>


                                                                    
                                    <!-- The mobile Number field field -->
                                    <div class="form-group">
                                        <label for="mobileNo"  <?php validateFields("mobile_NO", $missingFields) ?>> Phone No </label>
                                        <input type="text" class="form-control" id="mobileNo" name="mobile_NO" aria-descibedby="mobiNoHelp" placeholder="Input a valid phone Number" value="<?php setValue("mobile_NO") ?>"  />
                                        <small id="mobiNoHelp" class="form-text text-muted"> Use the format e.g 08022222222 </small>
                                    </div>

                                    <div class="alert alert-danger hide" id="phoneNoAlert"> </div>


                                    
                                    <!-- The message field -->
                                    <div class="form-group">
                                        <label for="Message" <?php validateFields("messages", $missingFields) ?>>Message </label>
                                        <textarea class="form-control" id="Message" rows="3" name="messages"> <?php setValue("messages") ?></textarea>
                                    </div>

                                    <div class="alert alert-danger hide" id="MessageAlert"> </div>
                                    
                                    <button type="submit" id="subForming" name="submitButton" class="btn btn-outline-primary"> Submit </button>
                                </form>

                            </div>
                        </div>
                        
                        <?php
                            }
                            function displayThanks(){
                            insertToDb(); // if there is no missing field , display the congrats/ thenks message
                            sendMailToManager(); // This fucntion sends mail to the manager of the company
                            sendMailToClient(); // This function sends mail to client
                        ?>
                         <div class="col-md-6 col-lg-6">
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
                                                <td>Message</td>
                                                <td><?php echo $_POST["messages"]?></td>
                                            </tr>
                                    </table>
                
                
                                    <div class="btn-group">
                                        <a href="index.php"><button class="btn-success"> OK</button></a>
                                    </div>
                            </div>

                        <?php
                            }
                        ?>
                    </div>
                
            </div>

        </div>




<!-- This is the footer of the page -->
<?php
    foota();

    function  insertToDb(){
        $dsn = "mysql:host=one;dbname=pillarpo_Database";
        $username = "pillarpo_root";
        $password = "";

        try{
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

        $compName = $_POST["client_Name"];
        $phoneNumber = $_POST["mobile_NO"];
        $email = $_POST["email_Address"];
        $messages = $_POST["messages"];
        $contactDate = date("Y-m-d");

        $sql = "INSERT INTO daContact(clientName, mobile, emailAddress, contactDate, messages )  VALUES(:clientName, :mobile, :emailAddress,  :orderDate,:messages)";

        try{
            $st = $conn->prepare($sql);
            $st->bindValue(":clientName", $compName, PDO::PARAM_STR);
            $st->bindValue(":mobile", $phoneNumber, PDO::PARAM_STR);
            $st->bindValue(":emailAddress", $email, PDO::PARAM_STR);
            $st->bindValue(":messages", $messages, PDO::PARAM_STR);
            $st->bindValue(":orderDate", $contactDate, PDO::PARAM_STR);
            $st->execute();
        }catch(PDOException $e){
            die("Query failed: ". $e->getMessage());
        }
    }

    function  sendMailToClient(){
        $name = $_POST["client_Name"];

        $to = $_POST["email_Address"];;// The email of the person to be sent to , if you have a so many recipient, then it should be splitted with commas
        $username = "info@pillarpole.com"; // The domamin email, where the mail is coming from
        $password = ""; // The password of the mail in the top
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

        $to = "rocktamawaters@gmail.com";// The email of the person to be sent to , if you have a so many recipient, then it should be splitted with commas
        $username = "info@pillarpole.com"; // The domamin email, where the mail is coming from
        $password = ""; // The password of the mail in the top
        $from = "Rock-Tama Waters <info@pillarpole.com>"; // The domamin email, where the mail is coming from
        $subject  = "Customer's Contact"; // It is like a subtopic, or the name of the company the mail is coming from
        $message = "Dear Manager,<br><br>
                     this is to inform you that a request have.";
        // The body of the maill, akind of the content
        $request = $_POST["messages"]; // The body of the maill, akind of the content
        $headers = array('From'=>$from, 'To'=>$to, 'Subject'=>$subject); // This is an array containing the header, where the mail is coming from and going.

            $text = ''; // text versions of email.
            $html = "<html><body>
             $message <br><br>
             <b>Name: </b> $name <br><br>
             <b>Phone Number: </b> $phoneNumber <br><br>
             <b>Email: </b> $email<br><br>
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
