let currentIndex = -1;
let correctAnswers = 0;
let totalQuestions = document.querySelectorAll('.box, .hotspot').length;

// Automatically detect room from PHP via a global JS variable
let currentRoom = window.roomId || 1;

function openModal(index) {
  const boxes = document.querySelectorAll('.box, .hotspot');
  const box = boxes[index];
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
  const answerInput = document.getElementById('answer').value.trim().toLowerCase();
  const boxes = document.querySelectorAll('.box, .hotspot');
  const box = boxes[currentIndex];
  const correctAnswer = box.getAttribute('data-answer').trim().toLowerCase();
  const feedback = document.getElementById('feedback');

  if (answerInput === correctAnswer) {
    feedback.textContent = 'Correct!';
    feedback.style.color = 'green';
    box.style.backgroundColor = 'green';
    box.onclick = null;

    correctAnswers++;

    // Close modal after short delay
    setTimeout(() => {
      closeModal();
      if (correctAnswers === totalQuestions) {
        if (currentRoom === 1) {
          window.location.href = 'room_2.php';
        } else {
          window.location.href = 'winpagina.html';
        }
      }
    }, 1000);
  } else {
    feedback.textContent = 'Incorrect, try again.';
    feedback.style.color = 'red';
  }
}
