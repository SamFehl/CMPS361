<?php
    $apiURL = "https://api.openf1.org/v1/drivers?meeting_key=latest";

    //Fetch the data
    $response = file_get_contents($apiURL);
    //Decode JSON
    $data = json_decode($response, true);


//Check if data is available
if ($data && is_array($data)) {
    //Pagination setup
    $limit = 20; //Number of posts per page
    $totalRecords = count($data); //Total number of records
    $totalPages = ceil($totalRecords / $limit); //Calculate total pages

    //Get the current page or set a default
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    //Ensure current page is within valid range
    if ($currentPage < 1) {
        $currentPage = 1;
    } elseif ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    //Sorting Logic
    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'driver_number'; //Default sort by 'id'
    $sortOrder = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc'; //Default order is 'asc'

    //Sort the data based on column and order
    usort($data, function($a, $b) use ($sortColumn, $sortOrder) {
        if ($sortOrder == 'asc') {
            return strcmp($a[$sortColumn], $b[$sortColumn]);
        } else {
            return strcmp($b[$sortColumn], $a[$sortColumn]);
        }
    });

    //Calculate the starting index of the current page
    $startIndex = ($currentPage - 1) * $limit;

    //Get the subset of data for the current page
    $pageData = array_slice($data, $startIndex, $limit);

    //Function to toggle sort order
    function toggleOrder($currentOrder) {
        return $currentOrder == 'asc' ? 'desc' : 'asc';
    }

    //Display data in a GridView (HTML Table)
    echo "<table border='1' cellpadding='10'>";
    echo "<thread>";
    echo "<tr>";
    echo "<th><a href='?page=$currentPage&sort=driver_number&order=" . toggleOrder($sortOrder) . "'>driver_number</a></th>";
    echo "<th><a href='?page=$currentPage&sort=full_name&order=" . toggleOrder($sortOrder) . "'>full_name</a></th>";
    echo "<th><a href='?page=$currentPage&sort=team_name&order=" . toggleOrder($sortOrder) . "'>team_name</a></th>";
    echo "<th><a href='?page=$currentPage&sort=headshot_url&order=" . toggleOrder($sortOrder) . "'>headshot_url</a></th>";
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
    }

    echo "</body>";
    echo "</table>";

    echo "<div style='margin-top: 20px;'>";
    //Display previous link if not on first page
    if ($currentPage > 1) {
        echo '<a href=?page=' . ($currentPage - 1) . '&sort=' . $sortColumn . '&order=' . $sortOrder .'"> Previous </a>';
    }

    //Display Page Numbers 
    for ($i = 1; $i <= $totalPages; $i++) {
        if($i == $currentPage) {
            echo "<strong>$i</strong>";
        } else {
        echo '<a href="?page=' . $i . '&sort=' . $sortColumn . '&order=' . $sortOrder .'"> ' . $i . ' </a>';
        }
    }

    //Next Page
    if ($currentPage < $totalPages) {
        echo '<a href=?page=' . ($currentPage + 1) . '&sort=' . $sortColumn . '&order=' . $sortOrder .'"> Next </a>';
    }
    
    echo "</div>";

    //Display total number of records at the bottom
    echo "<div style='margin-top: 20 px;'>";
    echo "<strong>Total Records: $totalRecords</strong>";
    echo "</div>";

} else {
    echo "Sorry, no data, see you tomorrow!";
}












?>