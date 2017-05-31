<?php

header('Content-Type: application/json');
ob_start();

$json = file_get_contents('php://input'); 

$request = json_decode($json, true);
$action = $request["result"]["action"];
$parameters = $request["result"]["parameters"];

$srcCity = $request["result"]["parameters"]["to"]["city"];
$flightNumber = $parameters["flight-number"];

# Code to set $outputtext, $nextcontext, $param1, $param2 values
#$output["contextOut"] = array(array("name" => "$next-context", "parameters" => array("param1" => $param1value, "param2" => $param2value)));
#$output["speech"] = $outputtext;
#$output["displayText"] = $outputtext;
#$output["source"] = "whatever.php";

$returnSpeech = execute($action, $flightNumber, $srcCity);


# testing
$output["speech"] = $returnSpeech;
#$output["speech"] = "flight number parameter is: " . $parameters["flight-number"];
#$output["displayText"] = "this is the displayText output from the webhook";

ob_end_clean();
echo json_encode($output);





function execute($action, $flightNo, $city)
{

  switch($action)
    {
      case "flight.check":
        $record = array();
        $record[0] = new flight("UA 234");
        $record[1] = new flight("UA 340");
        $record[2] = new flight("UA 342");
        $record[3] = new flight("UA 22");
        $record[4] = new flight("UA 102");

        if($flightNo != "")
          {
            for($ctr=0;$ctr<count($record);$ctr++)
              {
                if($record[$ctr]->flightNumber == $flightNo)
                  {
                    $returnString = $record[$ctr]->airline . " flight " . $record[$ctr]->flightNumber . " is " . $record[$ctr]->status . " to " . $record[$ctr]->destination . ".  Estimated time of arrival is " . $record[$ctr]->eta;
                    return($returnString);
                  }
              }
          }

        if($city != "")
          {
            for($ctr=0;$ctr<count($record);$ctr++)
              {
                if($record[$ctr]->destination == $city)
                  {
                    $returnString = $record[$ctr]->airline . " flight " . $record[$ctr]->flightNumber . " is " . $record[$ctr]->status . " to " . $record[$ctr]->destination . ".  Estimated time of arrival is " . $record[$ctr]->eta;
                    return($returnString);
                  }
              }
           }

        $returnString = "unable to find flight, please specify flight number or destination";

        break;      

      default:
        $output["speech"] = "action type [$action] is not yet coded for";
        break;
    }
}

class flight
{
  var $flightNumber;
  var $airline;
  var $source;
  var $destination;
  var $depart_time;
  var $land_time;
  var $eta;
  var $status;

  function __construct($flightNumber)
    {

      $this->flightNumber = $flightNumber;

      switch($this->flightNumber)
        {
          case "UA 234":
            $this->airline = "United Airlines";
            $this->source = "New York";
            $this->destination = "Chicago";
            $this->depart_time = "13:40";
            $this->land_time = "15:30";
            $this->eta = "15:30";
            $this->status = "on time";
            break;

          case "UA 340":
            $this->airline = "United Airlines";
            $this->source = "New York";
            $this->destination = "Seattle";
            $this->depart_time = "14:00";
            $this->land_time = "19:05";
            $this->eta = "21:30";
            $this->status = "delayed";
            break;

          case "UA 342":
            $this->airline = "United Airlines";
            $this->source = "Los Angeles";
            $this->destination = "Boston";
            $this->depart_time = "15:20";
            $this->land_time = "20:35";
            $this->eta = "20:20";
            $this->status = "ahead of schedule";
            break;

          case "UA 22":
            $this->airline = "United Airlines";
            $this->source = "Orlando";
            $this->destination = "San Fransisco";
            $this->depart_time = "11:40";
            $this->land_time = "16:35";
            $this->eta = "16:35";
            $this->status = "on time";
            break;

          case "UA 102":
            $this->airline = "United Airlines";
            $this->source = "Houston";
            $this->destination = "Tampa";
            $this->depart_time = "12:45";
            $this->land_time = "18:20";
            $this->eta = "19:20";
            $this->status = "delayed";
            break;
        }

    }

}

?>
