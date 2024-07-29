<?php
// Step 1: Make an HTTP request to the API
$api_url = "https://proxyencase.cut.ac.cy:8090/api/public/quiz/grades";
$json_data = file_get_contents($api_url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));

// Step 2: Parse JSON data into a PHP array
$data = json_decode($json_data, true);

// Check if the data was successfully fetched and parsed
if ($data) {
    // Step 3: Create an HTML table
    echo '<table>';
    echo '<tr>';
    echo '<th>Child Name</th>';
    echo '<th>Title</th>';
    echo '<th>Score</th>';
    echo '</tr>';

    foreach ($data as $row) {
        $childName = $row['child_first_name'] . ' ' . $row['child_last_name'];
        $title = $row['title'];
        $score = $row['score'];

        echo '<tr>';
        echo '<td class="tg-0pky"><a href="https://proxyencase.cut.ac.cy:8090/en/quiz_view.php?fb_url='.$row["child_fb_url"].'" target="_blank">' . $childName . '</td>';
        echo '<td class="tg-0pky">' . $title . '</td>';
        echo '<td class="tg-0pky">' . $score . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'Failed to fetch and parse data from the API.';
}
?>

