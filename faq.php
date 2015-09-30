<?php

  # Grab the Slack post variables
  $token = ($_POST['token'] === 'CxPDeOTKKscdX6nkTi3lOn1d' ? $_POST['token'] : false); # Replace with the token from your slash command config
  $channel = $_POST['channel_name'];
  $text = $_POST['text'];
  
  # Check pre-requisites for the script to run
  if(!$token){
   $msg = "This token doesn't match the slack command set up.";
   die($msg);
   echo $msg;
  } else if ($channel && $channel !== 'directmessage') { # Remove if you'd like the guide availabel everywhere
   $msg = "You cannot query the guide in channels, it would make them too busy.";
   die($msg);
   echo $msg; 
  }


  # Set up Frequently Asked Question (FAQ) array
  $faq = [
    "Company information" => "Here is some information about our company...",
    "Contact details" => "Here are the contact details for our company...",
    "MORE HERE" => "..."
  ];

  # Check if the user's text has partially matched any of the FAQ keys
  foreach ($faq as $key => $value) {
    if (strpos(strtolower($key), strtolower($text)) !== false) {
      $results[] = "*" . $key . "*\n\n" . $value . "\n\n";
    }
  }

  # Output each of the matched key values
  if (sizeof($results) > 0) {
    foreach ($results as $key => $value) {
      echo $value;
    }
  # or inform the user nothing was matched
  } else if ((sizeof($results) === 0)) {
    echo "We couldn't find a part of the guide related to this search :disappointed:";
  }