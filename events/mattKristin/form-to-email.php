<?php

header("Location: thankYou.html");

$name = $_POST['name'];
$visitor_email = $_POST['email'];
$numComing = $_POST['number'];
$phoneNumber = $_POST['phone'];
$thursday = $_POST['thursday'];
$friday = $_POST['friday'];
$saturday = $_POST['saturday'];
$sunday = $_POST['sunday'];
$camping = $_POST['camping'];
$haveSupplies = $_POST['campingSupplies'];
$comments = $_POST['comments'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'wedding@myoleanna.com';//<== update the email address
$email_subject = "New Wedding RSVP";
$email_body = "$name is coming to the wedding.
                *Bringing $numComing people
                *Phone Number: $phoneNumber
                *Email: $visitor_email
                *Staying: $thursday $friday $saturday $sunday
                *Camping: $camping
                *Has camping supplies: $haveSupplies
                *Comments: $comments\n".
    
    
$to = "wedding@myoleanna.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
//header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?>  