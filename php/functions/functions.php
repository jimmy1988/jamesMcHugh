<?php

  require_once("validationFunctions.php");
  require_once('php/components/phpMailer/class.phpmailer.php');
  require_once('php/components/phpMailer/class.smtp.php');

  function redirect_to($newLocation){
    header("Location: ".$newLocation);
  }

  function sendEmailToClient($firstName, $surname, $email, $sendMessage){
    $to_name=$firstName." ".$surname;
    $to=$email;
    $subject="Thank you for your enquiry";

    $message="<html xmlns=\"http://www.w3.org/1999/xhtml\">
                <body style=\"margin:0; padding:0; color:#FFF; font-family:'Comic Sans MS', cursive; background-color:#FFF;\">
                  <table bgcolor=\"#544747\" style=\"width:50%; height:100%; margin:25px 25%; padding:15px;\" cellpadding=\"0\" cellspacing=\"0\">
                    <tbody>
                      <tr>
                        <td style=\"padding-top:0; padding-bottom:25px;\"><img align=\"left\" alt=\"James McHugh Freelance Web Developer Logo\" src=\"images/logo.png\"/></td>
                      </tr>
                      <tr>
                        <td height=\"50px\">Hello ".$firstName." ".$surname."</td>
                      </tr>
                      <tr>
                        <td height=\"75px\">Thank you for your recent enquiry, your message has been recieved and saved to my system.
                            I will aim to get a reply back to you within 14 working days, this maybe sooner depending on the volume of responses I recieve.</td>
                      </tr>
                      <tr>
                        <td height=\"75px\">However, if you wish for a quicker response or wish to contact me about an urgent matter please send an email to
                          <a style=\"color: #7b818c; text-decoration:none; cursor:pointer\" href=\"mailto:james.mchugh.webdeveloper@gmail.com\">james.mchugh.webdeveloper@gmail.com</a>.</td>
                      </tr>
                      <tr>
                        <td height=\"75px\">Do you have an account with us?</td>
                      </tr>
                      <tr>
                        <td align=\"center\" height=\"100px\">
                          <a href=\"#\" style=\"height:50px; text-decoration:none; background-color:#FFF; border:3px solid #FFF; color: #7b818c; padding:15px 60px; margin-right:50px;\">Login</a>
                          <a href=\"#\" style=\"height:50px; text-decoration:none; background-color:#FFF; border:3px solid #FFF; color: #7b818c; padding:15px 50px; \">Register</a>
                        </td>
                      </tr>
                      <tr>
                        <td height=\"50px\">If you register for an account you can setup and manage projects for free or you can login to your account for the link above.</td>
                      </tr>
                      <tr>
                        <td height=\"75px\">Kind Regards</td>
                      </tr>
                      <tr>
                        <td height=\"50px;\" style=\"padding-left:125px;\">James McHugh</td>
                      </tr>
                  </tbody>
                </table>
              </body>
            </html>";

    $message=wordwrap($message, 70);

    $from_name="James McHugh Web Developer";
    $from="james.mchugh.webdeveloper@gmail.com";

    $mail=new PHPMailer();

    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username ="james.mchugh.webdeveloper";
    $mail->Password="j4m3rs1988uk";

    $mail->FromName=$from_name;
    $mail->From=$from;

    $mail->IsHTML(true);

    $mail->AddAddress($to, $to_name);
    $mail->Subject=$subject;
    $mail->Body=$message;


    $result=$mail->Send();

    if($result){
      return true;
    }else{
      return false;
    }
  }

  function sendEmailToHost($firstName, $surname, $email, $sendMessage){
    $to_name="James McHugh";
  	$to="james.mchugh.webdeveloper@gmail.com";
  	$subject="New message from client";

    $message="<html xmlns=\"http://www.w3.org/1999/xhtml\">
              <body style=\"margin:0; padding:0; color:#FFF; font-family:'Comic Sans MS', cursive; background-color:#FFF;\">
              <table bgcolor=\"#544747\" style=\"width:50%; height:100%; margin:25px 25%; padding:15px;\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody>
                  <tr>
                    <td style=\"padding-top:0; padding-bottom:25px;\"><img align=\"left\" alt=\"James McHugh Freelance Web Developer Logo\" src=\"images/logo.png\"/></td>
                  </tr>
                  <tr>
                    <td height=\"50px\">Hello!</td>
                  </tr>
                  <tr>
                    <td height=\"75px\">You have a new message on the server, please log in to the system to view and reply to this message</td>
                  </tr>
                  <tr>
                    <td height=\"75px\">The message details are as follows: </td>
                  </tr>
                  <tr>
                    <td height=\"75px\">Customer Name: ".$firstName." ".$surname."</td>
                  </tr>
                  <tr>
                    <td height=\"75px\">Email Address: <a href=\"mailto:".$email ."\" style=\"color: #7b818c; text-decoration:none; cursor:pointer\">".$email."</a></td>
                  </tr>
                  <tr>
                    <td height=\"75px\">Comment/Message: ".$sendMessage."</td>
                  </tr>
                  <tr>
                    <td height=\"75px\">Kind Regards</td>
                  </tr>
                  <tr>
                    <td height=\"50px;\" style=\"padding-left:125px;\">Admin</td>
                  </tr>
                </tbody>
              </table>
            </body>
          </html>";


  	$message=wordwrap($message, 70);

  	$from_name="ADMIN ENQUIRY";
  	$from="james.mchugh.webdeveloper@gmail.com";

  	$mail=new PHPMailer();

  	$mail->IsSMTP();
  	$mail->Host = "smtp.gmail.com";
  	$mail->Port = 587;
  	$mail->SMTPAuth = true;
  	$mail->Username ="james.mchugh.webdeveloper";
  	$mail->Password="j4m3rs1988uk";

  	$mail->FromName=$from_name;
  	$mail->From=$from;

    $mail->IsHTML(true);

  	$mail->AddAddress($to, $to_name);

  	$mail->Subject=$subject;
  	$mail->Body=$message;


  	$result=$mail->Send();

    if($result){
      return true;
    }else{
      return false;
    }

  }
?>
