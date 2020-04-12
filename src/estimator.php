 <?php

function covid19ImpactEstimator($data)
{
  $impact["currentlyInfected"]=$data["reportedCases"]*10;

  $severeImpact["currentlyInfected"]=$data["reportedCases"]*50;

  $impact["infectionsByRequestedTime"]=floor($impact["currentlyInfected"]*pow(2,periodType($data)));
  
  $severeImpact["infectionsByRequestedTime"]=floor($severeImpact["currentlyInfected"]*pow(2,periodType($data)));
 
  $impact["severeCasesByRequestedTime"]=$impact["infectionsByRequestedTime"]*0.15;

  $severeImpact["severeCasesByRequestedTime"] =$severeImpact["infectionsByRequestedTime"]*0.15;

  $impact["hospitalBedsByRequestedTime"] = floor(($data["totalHospitalBeds"]*0.35)-$impact["severeCasesByRequestedTime"]);
  $severeImpact["hospitalBedsByRequestedTime"]= floor(($data["totalHospitalBeds"]*0.35)-$severeImpact["severeCasesByRequestedTime"]);

  $impact["casesForICUByRequestedTime"] = floor($impact["infectionsByRequestedTime"]*0.05);
  $severeImpact["casesForICUByRequestedTime"] = floor($severeImpact["infectionsByRequestedTime"]*0.05);

  $impact["casesForVentilatorsByRequestedTime"] = floor($impact["infectionsByRequestedTime"]*0.02);
  $severeImpact["casesForVentilatorsByRequestedTime"] = floor($severeImpact["infectionsByRequestedTime"]*0.05);

  $impact["dollarsInFlight"] = floor($impact["infectionsByRequestedTime"]*0.65*1.5*30);
  $severeImpact["dollarsInFlight"] = floor($severeImpact["infectionsByRequestedTime"]*0.65*1.5*30);

  $outPut = array("data"=>$data, "impact"=>$impact, "severeImpact"=>$severeImpact);
 
  return $outPut;
}
