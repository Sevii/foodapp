<html>
 <head>
  <title>Food ingredients list app</title>
 </head>
<script src="" type="text/javascript"></script>



 <body>	
  <p>Food Items</p>
  
  <?php

    try {
    $dbh = new PDO('mysql:host=localhost;dbname=fooding', "fooding", "cathat");
      
       
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    	}

    	//$stmt = $dbh->prepare("SELECT * FROM ingredients");




    $stmt = $dbh->prepare("SELECT * FROM ingredients ");
	if ($stmt->execute(array($_GET['name']))) {
  	while ($row = $stmt->fetch()) {
    	print$row['name'] . "<br>" ;
    	print $row['inglist'] . "<br> <br>";
    	
  		}
	}


  ?>



 </body>




</html>