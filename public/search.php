
<?php require_once "../Database/DB.php";
$term = '';
$results = '';
$arr = array();
if(isset( $_GET['search_term']))
{
    $term = $_GET['search_term'];
    echo "<h1>$term</h1>";

    $search_term = filter_input(INPUT_GET, "$term", FILTER_SANITIZE_STRING);

// Create a new mysqli object and connect to the database


// Prepare the SQL statement using a prepared statement
$stmt = $conn->prepare('SELECT fname from users WHERE fname LIKE ? LIMIT 10');
$term = "%$term%"; // Add the percent signs to the search term
$stmt->bind_param('s', $term);
$stmt->execute();
$result2 = $stmt->get_result();


while ($row2 = $result2->fetch_assoc()) {
    array_push($arr,$row2['fname']);
    
 
   
   


  }


// Fetch the results and output them as a JSON-encoded string
//$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
//echo json_encode($results);



}



?>


<html>
<head>
    <title>
        search
    </title>
    <script>
    function updateResults(searchTerm) {
      
      
     
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var results = JSON.parse(this.responseText);
            window.alert(this.responseText)
           // document.getElementById('result2').innerHTML = this.responseText;
           
            var dropdown = document.getElementById('results');
            dropdown.innerHTML = '';
            for (var i = 0; i < results.length; i++) {
                var option = document.createElement('option');
                option.value = results[i].fname;
                option.text = results[i].fname;
                dropdown.appendChild(option);
                document.getElementById('result2').innerHTML = results[i].fname;
            }
        }
    };
    document.getElementById('f1').action = 'search.php?query=' + encodeURIComponent(searchTerm); 
    xhr.open('GET', 'sh.php?search_term=' + searchTerm);
   xhr.send();
}




</script>


</head>

<body>
<form id="f1">
    <input type="text" name="search_term" id="search_term" placeholder="Search by name">
    <select id="results"></select>
   
    <?php
    if(count($arr) != 0)
    {
        echo "<option>".$arr[0] . "</option>";
       
      
    }
   

    ?>
    <h1 id="result2"></h1>
    
</form>
</body>

<script>
    // Get a reference to the text field and the form
    var textField = document.getElementById("search_term");
    var form = document.getElementById("f1");
    document.getElementById('f1').action = 'search.php?query=' + encodeURIComponent(textField); 

    // Listen for the keydown event on the text field
    textField.addEventListener("input", function(event) {
        // Submit the form
        //form.submit();

   
    }
    );
</script>




</html>