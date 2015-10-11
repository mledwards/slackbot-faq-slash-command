<?php

  # Set up slash command
  # https://YOURCOMPANYHERE.slack.com/services/new/slash-commands
  
  # Upload this script to the URL you entered in the link above

  # Grab the Slack post variables
  $token = ($_POST['token'] === 'YOURTOKENHERE' ? $_POST['token'] : false); # Replace with the token from your slash command config
  $channel = $_POST['channel_name'];
  $text = $_POST['text'];
  
  # Check pre-requisites for the script to run
  if(!$token){
   $msg = "This token doesn't match the slack command set up.";
   die($msg);
  }

  # Set up Frequently Asked Question (FAQ) array
  $faq = [
    "company information" => "Here is some information about our company...",
    "contact" => "Here are the contact details for our company...",
  ];

  # Check if the user's text has partially matched any of the FAQ keys
  foreach ($faq as $key => $value) {

    if (stripos($text, $key) !== false) {
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
    echo "We couldn't find a part of the guide related to the search *" . $text . "* :disappointed:";
  }
