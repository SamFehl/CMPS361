<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Gridview</title>
        <!--Stylesheet-->
        <link rel="stylesheet" href="./styles.css">
        <script src="./searchTable.js"></script>
    </head>
    <div class="limit-container">
    <form method="GET" id="limitForm">
        <label for="limitSelect">Results per page: </label>
        <select name="limit" id="limitSelect" onchange="this.form.submit()">
            <?php
                $limitOptions = [10, 20, 50, 100];
                $selectedLimit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;

                foreach ($limitOptions as $opt) {
                    $selected = $selectedLimit === $opt ? 'selected' : '';
                    echo "<option value='$opt' $selected>$opt</option>";
                }
            ?>
        </select>
        <noscript><button type="submit">Apply</button></noscript>
    </form>
</div>
    <body>
<?php
    $apiURL = "https://api.openf1.org/v1/drivers?meeting_key=latest";

    //Fetch the data
    $response = file_get_contents($apiURL);
    //Decode JSON
    $data = json_decode($response, true);


//Check if data is available
if ($data && is_array($data)) {

    //Pagination setup
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20; //Number of posts per page
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

    //Search Box
    echo "<div class='search-container'>";
    echo "<label for='searchInput'>Search: </label>";
    echo "<input type='text' id='searchInput' oninput='searchTable()' placeholder='Search for something...'>";
    echo "</div>";

    //Display data in a GridView (HTML Table)
    //echo "<table border='1' cellpadding='10'>";
    echo "<table id='dataGrid'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th><a href='?page=$currentPage&sort=driver_number&order=" . toggleOrder($sortOrder) . "'>driver_number</a></th>";
    echo "<th><a href='?page=$currentPage&sort=full_name&order=" . toggleOrder($sortOrder) . "'>full_name</a></th>";
    echo "<th><a href='?page=$currentPage&sort=team_name&order=" . toggleOrder($sortOrder) . "'>team_name</a></th>";
    echo "<th><a href='?page=$currentPage&sort=headshot_url&order=" . toggleOrder($sortOrder) . "'>headshot_url</a></th>";
    echo "</tr>";
    echo "</thead>";
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

    echo "<div class='pagination'>";
    //Display previous link if not on first page
    if ($currentPage > 1) {
        echo '<a href=?page=' . ($currentPage - 1) . '&sort=' . $sortColumn . '&order=' . $sortOrder . '&limit=' . $limit .'"> Previous </a>';
    }

    //Display Page Numbers 
    for ($i = 1; $i <= $totalPages; $i++) {
        if($i == $currentPage) {
            echo "<strong>$i</strong>";
        } else {
        echo '<a href="?page=' . $i . '&sort=' . $sortColumn . '&order=' . $sortOrder . '&limit=' . $limit .'"> ' . $i . ' </a>';
        }
    }

    //Next Page
    if ($currentPage < $totalPages) {
        echo '<a href=?page=' . ($currentPage + 1) . '&sort=' . $sortColumn . '&order=' . $sortOrder . '&limit=' . $limit .'"> Next </a>';
    }
    
    echo "</div>";

    //Display total number of records at the bottom
    echo "<div class='total-records'>";
    echo "Total Records: $totalRecords";
    echo "</div>";

} else {
    echo "Sorry, no data, see you tomorrow!";
}
?>

    </body>
</html>