<?php
include('config.php');

ini_set('max_execution_time', 0);
$sql = "SELECT ID FROM produkt"; // I am getting Id of item from produkt database
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {



    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "". $row["ID"], //Enter your Api link here and remove $row['ID'] variable if you dont need this
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: 21e0917a-529f-28d1-e30b-c192a0cb7f6e"
      ),
    ));

    $response = curl_exec($curl);           // getting result from the API in $response define_syslog_variables
    $item = json_decode($response);// converting response from API to json object
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err; // you will see this if there is no response from api
    } else {
    foreach($item as $val){
      $sqlUpdate = "UPDATE produkt SET image='".$val->Pfad."' WHERE ID=". $row["ID"]; // in this line I am updating the sql table of the item with api response for particular id

      if ($conn->query($sqlUpdate) === TRUE) {
        echo "Image added successfully at row: ". $row["ID"]."<br>"; 
      } else {
        echo "Error updating record: " . $conn->error."<br>";
      }
      // print_r ($val->Pfad);

    }
    }




  }
} else {
  echo "0 results";
}

 ?>
