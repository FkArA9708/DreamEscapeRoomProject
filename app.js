let currentIndex = -1;
let correctAnswers = 0;
let totalQuestions = document.querySelectorAll('.box, .hotspot').length;

// Automatically detect room from PHP via a global JS variable
let currentRoom = window.roomId || 1;

function openModal(index) {
  const boxes = document.querySelectorAll('.box, .hotspot');
  const box = boxes[index];
  const question = box.getAttribute('data-question');
  const id = box.getAttribute('data-id');  

  currentIndex = index;

  document.getElementById('question').textContent = question;
  document.getElementById('answer').value = '';
  document.getElementById('feedback').textContent = '';

  const imageContainer = document.getElementById('image-container');
  const wallText = document.getElementById('wall-text');

  document.getElementById('modal').style.display = 'block';
  document.getElementById('overlay').style.display = 'block';

  if (id === "1") {
    document.body.style.backgroundImage = "url('images/time.jpg')";
    document.body.style.backgroundSize = 'cover';
    document.body.style.backgroundPosition = 'center 0.1vh';
    document.body.style.backgroundRepeat = 'no-repeat';
    imageContainer.style.display = 'none';
    wallText.style.display = 'none';  // hide overlay text
  } 
 else if (id === "2") {
    document.body.style.backgroundImage = "url('images/wall.jpg')";
    document.body.style.backgroundSize = 'cover';
    document.body.style.backgroundPosition = 'center 0.1vh';
    document.body.style.backgroundRepeat = 'no-repeat';

    const imageContainer = document.getElementById('image-container');
    imageContainer.style.display = 'none'; // hide image container (or just room-image)

    // Hide hotspot 2
    const hotspots = document.querySelectorAll('.hotspot, .box');
    hotspots.forEach(hs => {
      if (hs.getAttribute('data-id') === "2") {
        hs.style.display = 'none';
      }
    
    });

  

}


  else {
    document.body.style.backgroundImage = '';
    imageContainer.style.display = 'inline-block';
    wallText.style.display = 'none';
  }
}





function closeModal() {
  document.getElementById('modal').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('feedback').textContent = '';

  document.body.style.backgroundImage = '';

  // Show image container again
  const imageContainer = document.getElementById('image-container');
  imageContainer.style.display = 'inline-block';

  // Show all hotspots
  const hotspots = document.querySelectorAll('.hotspot, .box');
  hotspots.forEach(hs => {
    hs.style.display = 'block'; // show all hotspots again including hotspot 2
  });


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

  box.classList.add('answered-correctly'); // ✅ add this line

  box.onclick = null; // prevent re-clicking
  correctAnswers++;


    // ✅ Restore image and background after delay
    setTimeout(() => {
      closeModal();

      // Restore image container and background
      document.body.style.backgroundImage = '';
      document.getElementById('image-container').style.display = 'inline-block';

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
