<?php

header('Content-Type: application/json');
ob_start();

$json = file_get_contents('php://input');
$request = json_decode($json, true);
$action = $request["result"]["action"];
$parameters = $request["result"]["parameters"];


switch($action)
  {
    case "flight.check":
      $output["speech"] = "action type [$action]"
      break;

    default:
      $output["speech"] = "unkown action type [$action]"
      break;
  }



# Code to set $outputtext, $nextcontext, $param1, $param2 values
#$output["contextOut"] = array(array("name" => "$next-context", "parameters" => array("param1" => $param1value, "param2" => $param2value)));
#$output["speech"] = $outputtext;
#$output["displayText"] = $outputtext;
#$output["source"] = "whatever.php";
# testing
#$output["speech"] = "this is the speech output from webhook";
#$output["displayText"] = "this is the displayText output from the webhook";




ob_end_clean();
echo json_encode($output);
?>
