<?php
$conn = new mysqli("localhost", "root", "", "escape-room");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT team_naam, start_time, end_time FROM teams";
$result = $conn->query($sql);

echo "<table border='1' cellpadding='8'>";
echo "<tr><th>Team Name</th><th>Elapsed Time</th></tr>";

while ($row = $result->fetch_assoc()) {
    if ($row['end_time']) {
        $start = new DateTime($row['start_time']);
        $end = new DateTime($row['end_time']);
        $interval = $start->diff($end);
        $elapsed = $interval->format('%H:%I:%S');
    } else {
        $elapsed = "In progress";
    }

    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['team_naam']) . "</td>";
    echo "<td>" . $elapsed . "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<a href='index_loggedin.php'>Go home!</a>";

$conn->close();
?>