<?php
      $today = date("Y-m-d");
      $dt = new DateTime($today);
      $td = $dt->format('Y-m-d');
      echo $td;
  


    $start = date("Y-m-1");  //change to the start day
   //$interval = "7". " " . "day"; 
    $ds = new DateTime($start);
   // $ds->modify('+' . $interval);
  $ds->add(new DateInterval('P7D'));
    $new_date = $ds->format('Y-m-d');
    echo $new_date;

    if($td == $new_date)
    {
       // echo "correct";
       $start = $new_date;
    }

 // $test = date("Y-08-04");

 // if ($test >= $start && $test <= $new_date) {
   // echo "The date is within the range.";
//} else {
   // echo "The date is not within the range.";
//}

    

    ?>