<?php
require_once('./dbcon.php');
session_start();

// Redirect to team creation if no team exists
if (!isset($_SESSION['team_id'])) {
    header("Location: create_team.php");
    exit();
}

if (isset($_GET['reset']) && $_GET['reset'] == '1') {
    // Reset timer
    unset($_SESSION['start_time']);
    $_SESSION['start_time'] = time();
    
    // Update team start time in database
    $stmt = $db_connection->prepare("UPDATE teams SET start_time = NOW() WHERE team_id = ?");
    $stmt->execute([$_SESSION['team_id']]);
}

$totalTime = 60 * 60; // 60 minutes

if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

$timeElapsed = time() - $_SESSION['start_time'];
$timeRemaining = $totalTime - $timeElapsed;

if ($timeRemaining <= 0) {
    header("Location: lostescaperoom.php");
    exit();
}

try {
    $stmt = $db_connection->query("SELECT * FROM questions WHERE roomId = 1");
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Databasefout: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Escape Room 1</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="homepage_dreamescape.css">
  <script>
    let timeLeft = <?= $timeRemaining ?>;

    function updateTimer() {
      const timerElement = document.getElementById('timer');
      let minutes = Math.floor(timeLeft / 60);
      let seconds = timeLeft % 60;
      timerElement.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

      if (timeLeft <= 0) {
        window.location.href = 'lostescaperoom.php';
      } else {
        timeLeft--;
        setTimeout(updateTimer, 1000);
      }
    }

    window.onload = updateTimer;
  </script>
</head>
<body>

<!-- Timer -->
<div id="timer" style="position: fixed; top: 10px; right: 20px; font-size: 24px; background: #000; color: #fff; padding: 10px; border-radius: 8px;">Loading...</div>

<!-- ... rest of your room_1.php code ... -->

<div id="image-container" style="position: relative; display: inline-block; margin-top: 30px;">
  <img src="https://images.unsplash.com/photo-1532274402911-5a369e4c4bb5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
       id="room-image" 
       width="800" 
       alt="Escape Room">
</div>
<?php
$positions = [
    ['top' => '37%', 'left' => '33%'], 
    ['top' => '66%', 'left' => '60.5%'], 
    ['top' => '70%', 'left' => '20%'], 
    
];
?>

<?php foreach ($questions as $index => $question): ?>
  <?php 
    $top = $positions[$index]['top']; 
    $left = $positions[$index]['left']; 
  ?>
  <div class="hotspot" 
       style="top: <?= $top ?>; left: <?= $left ?>;" 
       onclick="openModal(<?= $index ?>)"
       data-index="<?= $index ?>" 
       data-id="<?= $question['id'] ?>" 
       data-question="<?= htmlspecialchars($question['question']) ?>" 
       data-answer="<?= htmlspecialchars($question['answer']) ?>" 
       title="Click to answer"></div>
<?php endforeach; ?>



<div class="nav-button">
  <a href="lostescaperoom.php" class="button">Give up?</a>
</div>

<section class="overlay" id="overlay" onclick="closeModal()"></section>

<section class="modal" id="modal">
  <h2>Escape Room Vraag</h2>
  <p id="question"></p>
  <p id="riddle-text" style="color: #fff; margin-top: 10px; font-style: italic; display: none;"></p>
  <input type="text" id="answer" placeholder="Typ je antwoord">
  <button onclick="checkAnswer()">Verzenden</button>
  <p id="feedback"></p>
</section>


<script>
  window.roomId = <?= (isset($questions[0]['roomId']) ? intval($questions[0]['roomId']) : 1) ?>;
</script>

<script src="app.js"></script>

</body>
</html>
