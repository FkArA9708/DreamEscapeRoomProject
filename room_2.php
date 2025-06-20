<?php
session_start();
require_once('./dbcon.php');

$totalTime = 60 * 60; // same total as room_1.php

if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time(); // this should already be set by room_1
}

$timeElapsed = time() - $_SESSION['start_time'];
$remainingTime = $totalTime - $timeElapsed;

if ($remainingTime <= 0) {
    header("Location: lostescaperoom.php");
    exit();
}

try {
    $stmt = $db_connection->query("SELECT * FROM questions WHERE roomId = 2");
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Databasefout: " . $e->getMessage());
}

function getRandomPosition() {
    return [
        'top' => rand(10, 70) . '%',
        'left' => rand(10, 80) . '%'
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Escape Room 2</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: url('images/room2_background.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
    }

    #timer {
      position: fixed;
      top: 10px;
      right: 10px;
      background-color: #222;
      color: #fff;
      padding: 10px;
      border-radius: 5px;
      font-size: 16px;
      z-index: 1000;
    }

    .container {
      position: relative;
      width: 100%;
      height: 100vh;
    }

    .box {
      position: absolute;
      width: 100px;
      height: 100px;
      background-size: cover;
      border: 3px solid transparent;
      cursor: pointer;
      transition: transform 0.2s, border 0.2s;
    }

    .box:hover {
      transform: scale(1.05);
      border-color: yellow;
    }

    .answered {
      opacity: 0.5;
      pointer-events: none;
      border-color: green;
    }

    .overlay, .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.7);
      z-index: 999;
    }

    .modal {
      z-index: 1000;
      background: white;
      max-width: 400px;
      margin: 10% auto;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
    }

    .modal input {
      width: 80%;
      padding: 8px;
      margin-top: 10px;
    }

    .modal button {
      margin-top: 10px;
      padding: 8px 16px;
    }

    .nav-button {
      position: fixed;
      bottom: 20px;
      left: 20px;
    }

    .nav-button .button {
      background-color: #cc0000;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
    }

  </style>
</head>
<body>

<div id="timer">Time Remaining: <span id="time"><?= gmdate("i:s", $remaining_time) ?></span></div>

<div class="container">
  <?php
  $used_positions = [];
  foreach ($questions as $index => $question):
    do {
      $pos = getRandomPosition();
      $key = $pos['top'] . '-' . $pos['left'];
    } while (in_array($key, $used_positions));
    $used_positions[] = $key;
  ?>
    <div class="box"
         style="top: <?= $pos['top'] ?>; left: <?= $pos['left'] ?>; background-image: url('images/item<?= $index+1 ?>.png');"
         onclick="openModal(<?= $index ?>)"
         data-index="<?= $index ?>"
         data-question="<?= htmlspecialchars($question['question']) ?>"
         data-answer="<?= htmlspecialchars($question['answer']) ?>">
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
  let remainingTime = <?= $remainingTime ?>;
  let currentIndex = -1;
  let correctAnswers = 0;
  let totalQuestions = document.querySelectorAll('.box').length;

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

  function openModal(index) {
    const box = document.querySelectorAll('.box')[index];
    const question = box.getAttribute('data-question');
    currentIndex = index;

    document.getElementById('question').textContent = question;
    document.getElementById('answer').value = '';
    document.getElementById('feedback').textContent = '';
    document.getElementById('modal').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
  }

  function checkAnswer() {
    const input = document.getElementById('answer').value.trim().toLowerCase();
    const boxes = document.querySelectorAll('.box');
    const box = boxes[currentIndex];
    const correct = box.getAttribute('data-answer').trim().toLowerCase();
    const feedback = document.getElementById('feedback');

    if (input === correct) {
      feedback.textContent = 'Correct!';
      feedback.style.color = 'green';
      box.classList.add('answered');
      box.onclick = null;
      correctAnswers++;
      setTimeout(() => {
        closeModal();
        if (correctAnswers === totalQuestions) {
          window.location.href = 'winpagina.php';
        }
      }, 1000);
    } else {
      feedback.textContent = 'Incorrect, try again.';
      feedback.style.color = 'red';
    }
  }
</script>

</body>
</html>

