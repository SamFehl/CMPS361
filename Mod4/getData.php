<?php
    $apiURL = "https://api.openf1.org/v1/drivers?meeting_key=latest";

    //Fetch the data
    $response = file_get_contents($apiURL);
    //Decode JSON
    $data = json_decode($response, true);

    //Validate that data exists
    if($data && is_array($data)){
        //Pagination
        $limit = 20;
        $totalRecords = count($data);
        $totalPages = ceil($totalRecords/$limit); //calculating number of pages

        //Capture current page or set default page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        //Calculate the starting index of the page
        if ($currentPage < 1){
            $currentPage = 1;
        } else if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        $startIndex = ($currentPage-1) * $limit;
        $pageData = array_slice($data, $startIndex, $limit);
        
        //Build out the table
        echo "<table border ='1' cellpadding='10'>";
        echo "<thread>";
        echo "<tr>";
        echo "<th>driver_number</th>";
        echo "<th>full_name</th>";
        echo "<th>team_name</th>";
        echo "<th>headshot_url</th>";
        //echo "<th>country_code</th>";
        echo "</tr>";
        echo "</thread>";
        echo "<body>";
        
        //Loop through the data
        foreach ($pageData as $post) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($post["driver_number"]) . "</td>";
            echo "<td>" . htmlspecialchars($post["full_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($post["team_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($post["headshot_url"]) . "</td>";
            //echo "<td>" . htmlspecialchars($post["country_code"]) . "</td>";
        }

        echo "</body>";
        echo "</table>";

        echo "<div style='margin-top: 20px;'>";
        //Display previous link if not on first page
        if ($currentPage > 1) {
            echo '<a href=?page=' . ($currentPage - 1) . '"> Previous </a>';
        }

        //Display Page Numbers 
        for ($i = 1; $i <= $totalPages; $i++) {
            if($i == $currentPage) {
                echo "<strong>$i</strong>";
            } else {
            echo '<a href="?page=' . $i . '"> ' . $i . ' </a>';
            }
        }

        //Next Page
        if ($currentPage < $totalPages) {
            echo '<a href=?page=' . ($currentPage + 1) . '"> Next </a>';
        }
        
        echo "</div>";

    } else {
        echo "Sorry, no data, see you tomorrow!";
    }

?>