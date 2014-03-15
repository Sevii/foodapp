
<?php

    // Defining the basic cURL function
    function curl($url) {
        // Assigning cURL options to an array
        $options = Array(
            CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
            CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
            CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
            CURLOPT_CONNECTTIMEOUT => 120,   // Setting the amount of time (in seconds) before the request times out
            CURLOPT_TIMEOUT => 120,  // Setting the maximum amount of time for cURL to execute queries
            CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",  // Setting the useragent
            CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
        );
         
        $ch = curl_init();  // Initialising cURL 
        curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL 
        return $data;   // Returning the data from the function 
    }


    $scraped_website = curl("http://www.example.com");  // Executing our curl function to scrape the webpage 
    //http://www.example.com and return the results into the $scraped_website variable
    $tryurl = "http://www.foodfacts.com/NutritionFacts/a/a/";



    // Defining the basic scraping function
    function scrape_between($data, $start, $end){
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }




        try {
        $dbh = new PDO('mysql:host=localhost;dbname=fooding', "fooding", "cathat");
      
       
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }



    $stmt = $dbh->prepare("INSERT INTO ingredients (id, name, inglist) VALUES (?, ?, ?)");
    
 
    $stmt->bindParam(1, $id);
    $stmt->bindParam(2, $name);
    $stmt->bindParam(3, $inglist);

//insert one row
//$name = 'one';
//$value = 1;
//$stmt->execute();

// // insert another row with different values
// $name = 'two';
// $value = 2;
// $stmt->execute();





	for($i = 4410; $i < 4470; $i++){
		$url = $tryurl . (string)$i;



		$scraped_page = curl($url);  
		$scraped_title = scrape_between($scraped_page, "<title>", "</title>"); 	
		$ingredients_data = scrape_between($scraped_page, "<div class=\"row-small-content\">", "</p>");
		



		if($ingredients_data != ""){
		 	

            echo $scraped_title;
            echo $ingredients_data;
            echo "<p>\n </p>";
		 	
            //id, name, inglist

            $id = $i;
            $name = strip_tags($scraped_title);
            $inglist = strip_tags($ingredients_data);
            $stmt->execute();







		  }
		
		}
		

         // 









?>