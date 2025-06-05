<?php
session_start();
require_once('./dbcon.php');

// Set total time limit in seconds (e.g., 10 minutes = 600 seconds)
$total_time_limit = 600;

// Initialize start time if not already set
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

// Calculate elapsed time
$elapsed_time = time() - $_SESSION['start_time'];

// Calculate remaining time
$remaining_time = $total_time_limit - $elapsed_time;

// If time has run out, redirect to lost page
if ($remaining_time <= 0) {
    header("Location: lostescaperoom.php");
    exit();
}

try {
    $stmt = $db_connection->query("SELECT * FROM questions WHERE roomId = 2");
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Databasefout: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room 2</title>
  <link rel="stylesheet" href="style.css">
  <style>
    #timer {
      position: fixed;
      top: 10px;
      right: 10px;
      background-color: #222;
      color: #fff;
      padding: 10px;
      border-radius: 5px;
      font-family: Arial, sans-serif;
      font-size: 16px;
      z-index: 1000;
    }
  </style>
</head>
<body>

<div id="timer">Time Remaining: <span id="time"><?= gmdate("i:s", $remaining_time) ?></span></div>

<div class="container">
  <?php foreach ($questions as $index => $question) : ?>
    <div class="box box<?= $index + 1; ?>" onclick="openModal(<?= $index; ?>)"
      data-index="<?= $index; ?>" data-question="<?= htmlspecialchars($question['question']); ?>"
      data-answer="<?= htmlspecialchars($question['answer']); ?>">
      Box <?= $index + 1; ?>
    </div>
  <?php endforeach; ?>
</div>

<div class="nav-button">
  <a href="lostescaperoom.php" class="button">Give up?</a>
</div>

<section class="overlay" id="overlay" onclick="closeModal()"></section>

<section class="modal" id="modal">
  <h2>Escape Room Vraag</h2>
  <p id="question"></p>
  <input type="text" id="answer" placeholder="Typ je antwoord">
  <button onclick="checkAnswer()">Verzenden</button>
  <p id="feedback"></p>
</section>

<script>
  window.roomId = <?= (isset($questions[0]['roomId']) ? intval($questions[0]['roomId']) : 1) ?>;
</script>


<script src="app.js"></script>
<script>
  // Initialize timer
  let remainingTime = <?= $remaining_time ?>;

  function updateTimer() {
    if (remainingTime <= 0) {
      window.location.href = 'lostescaperoom.php';
    } else {
      let minutes = Math.floor(remainingTime / 60);
      let seconds = remainingTime % 60;
      document.getElementById('time').textContent = 
        (minutes < 10 ? '0' : '') + minutes + ':' + 
        (seconds < 10 ? '0' : '') + seconds;
      remainingTime--;
    }
  }

  setInterval(updateTimer, 1000);
</script>

</body>
</html>
