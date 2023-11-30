const movieOptions = document.getElementById('movieOptions');
const container = document.querySelector('.container');
const seats = document.querySelectorAll('.row .seat:not(.occupied)');
const count = document.getElementById('count');
const total = document.getElementById('total');


let ticketPrice = 12000;

populateUI();

function populateUI() {
  // Check if the page is refreshed
  if (performance.navigation.type === 1) {
    localStorage.clear(); // Clear local storage on refresh
  }

  const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));

  if (selectedSeats !== null && selectedSeats.length > 0) {
    selectedSeats.forEach((seatIndex) => {
      seats[seatIndex].classList.add('selected');
    });
  }

  const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

  if (selectedMovieIndex !== null) {
    movieOptions.selectedIndex = selectedMovieIndex;
  }
}


function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll('.row .selected');
  const selectedSeatCount = +selectedSeats.length;

  const selectedSeatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));

  localStorage.setItem('selectedSeats', JSON.stringify(selectedSeatsIndex));

  count.textContent = selectedSeatCount;
  total.textContent = selectedSeatCount * ticketPrice;
}

movieOptions.addEventListener('click', (event) => {
  const movieOption = event.target.closest('.movie-option');

  if (movieOption) {
    document.querySelectorAll('.row .selected').forEach((seat) => {
        seat.classList.remove('selected');
      });
      localStorage.removeItem('selectedSeats');
        updateSelectedCount();
    
  
    const movieIndex = Array.from(movieOptions.children).indexOf(movieOption);

    updateSelectedCount();
  }
});


container.addEventListener('click', (event) => {
  if (event.target.classList.contains('seat') && !event.target.classList.contains('occupied')) {
    event.target.classList.toggle('selected');

    updateSelectedCount();
  }
});

updateSelectedCount();
