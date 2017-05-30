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
      $output["speech"] = "action type [$action]";
      break;      

    default:
      $output["speech"] = "unkown action type [$action]";
      break;
  }



# Code to set $outputtext, $nextcontext, $param1, $param2 values
#$output["contextOut"] = array(array("name" => "$next-context", "parameters" => array("param1" => $param1value, "param2" => $param2value)));
#$output["speech"] = $outputtext;
#$output["displayText"] = $outputtext;
#$output["source"] = "whatever.php";

# testing
$output["speech"] = "flight number parameter is: " . $parameters["result"]["parameters"];
#$output["displayText"] = "this is the displayText output from the webhook";

echo $output["speech"];


ob_end_clean();
echo json_encode($output);


/*
class flight
{
  var $flight-number;
  var $airline;
  var $source;
  var $destination;
  var $depart_time;
  var $land_time;
  var $eta;
  var $status;

  function __construct($flightNumber)
    {
      $this->flight-number = $flightNumber;

      switch($this->flight-number)
        {
          case("UA 234"):
            $this->airline = 'United Airlines";
            $this->source = "New York";
            $this->destination = "Chicago";
            $this->depart_time = "13:40";
            $this->land_time = "15:30";
            $this->eta = "15:30";
            $this->status = "on time";
            break;

          case("UA 340"):
            $this->airline = 'United Airlines";
            $this->source = "New York";
            $this->destination = "Seattle";
            $this->depart_time = "14:00";
            $this->land_time = "19:05";
            $this->eta = "21:30";
            $this->status = "delayed";
            break;

          case("UA 342"):
            $this->airline = 'United Airlines";
            $this->source = "Los Angeles";
            $this->destination = "Boston";
            $this->depart_time = "15:20";
            $this->land_time = "20:35";
            $this->eta = "20:20";
            $this->status = "ahead of schedule";
            break;

          case("UA 22"):
            $this->airline = 'United Airlines";
            $this->source = "Orlando";
            $this->destination = "San Fransisco";
            $this->depart_time = "11:40";
            $this->land_time = "16:35";
            $this->eta = "16:35";
            $this->status = "on time";
            break;

          case("UA 102"):
            $this->airline = 'United Airlines";
            $this->source = "Houston";
            $this->destination = "Washington DC";
            $this->depart_time = "12:45";
            $this->land_time = "18:20";
            $this->eta = "19:20";
            $this->status = "delayed";
            break;
        }

}

*/



?>

