let form = document.getElementById('filters');
let cardsContainer = document.getElementById('book_cards');

let cards = Array.from(cardsContainer.querySelectorAll('.card'));

// reads the current values from the filter form 
function getFilters() {
  return {
    titleFilter:form.elements['title_filter'].value.trim().toLowerCase(),
    publisherFilter:form.elements['publisher_filter'].value,
    formatFilter:form.elements['format_filter'].value,
    sortBy:form.elements['sort_by'].value
  };
}

function cardMatches(card, filters) {
  let title = card.dataset.title.toLowerCase();
  let publisher = card.dataset.publisher;

  let formats = card.dataset.format ? card.dataset.format.split(',') : [];

  if (filters.titleFilter && !title.includes(filters.titleFilter)) return false;
  if (filters.publisherFilter && publisher !== filters.publisherFilter) return false;
  if (filters.formatFilter && !formats.includes(filters.formatFilter)) return false;

  return true;
}

// returnscards array
function sortCards(cards, sortBy) {
  return cards.slice().sort(function(a, b) {
    let titleA = a.dataset.title.toLowerCase();
    let titleB = b.dataset.title.toLowerCase();
    let yearA  = Number(a.dataset.year);
    let yearB  = Number(b.dataset.year);

    if (sortBy === 'year_desc') return yearB - yearA;
    if (sortBy === 'year_asc')  return yearA - yearB;
    return titleA.localeCompare(titleB);
  });
}

// hides cards that don't match
function applyFilters() {
  let filters = getFilters();

  // toggle the hidden class 
  cards.forEach(function(card) {
    card.classList.toggle('hidden', !cardMatches(card, filters));
  });

  let visible = cards.filter(function(card) {
    return !card.classList.contains('hidden');
  });

  // appendChild moves each card to the end
  sortCards(visible, filters.sortBy).forEach(function(card) {
    cardsContainer.appendChild(card);
  });
}

// resets the form back to defaults
function clearFilters() {
  form.reset();

  cards.forEach(function(card) {
    card.classList.remove('hidden');
  });

  sortCards(cards, 'year_asc').forEach(function(card) {
    cardsContainer.appendChild(card);
  });
}

// click listeners
document.getElementById('apply_filters').addEventListener('click', function(e) {
  e.preventDefault();
  applyFilters();
});

document.getElementById('clear_filters').addEventListener('click', function(e) {
  e.preventDefault();
  clearFilters();
});

function myFunction() {
  document.body.classList.toggle('dark-mode');
}

let bookForm = document.getElementById('book_form');
let submitBtn = bookForm.querySelector('button[type="submit"]');

let titleInput  = document.getElementById('title');
let authorInput  = document.getElementById('author');
let publisherInput  = document.getElementById('publisher_id');
let yearInput  = document.getElementById('year');
let isbnInput = document.getElementById('isbn');
let descriptionInput = document.getElementById('description');
let coverInput = document.getElementById('cover');


let titleError  = document.getElementById('title_error');
let authorError  = document.getElementById('author_error');
let publisherError   = document.getElementById('publisher_id_error');
let yearError = document.getElementById('year_error');
let isbnError = document.getElementById('isbn_error');
let descriptionError = document.getElementById('description_error');
let coverError  = document.getElementById('cover_error');
let formatError = document.getElementById('format_ids_error');

// object to store any validation errors
let errors = {};

// stores an error message for field
function addError(field, message) {
  errors[field] = message;
}

// writes each error message 
function showFieldErrors() {
  titleError.innerHTML  = errors.title  || '';
  authorError.innerHTML   = errors.author  || '';
  publisherError.innerHTML   = errors.publisher  || '';
  yearError.innerHTML  = errors.year   || '';
  isbnError.innerHTML  = errors.isbn || '';
  descriptionError.innerHTML = errors.description || '';
  coverError.innerHTML  = errors.cover  || '';
  formatError.innerHTML   = errors.formats || '';
}

// runs all validation checks
submitBtn.addEventListener('click', function(e) {
  // stop the form from submitting until validation
  e.preventDefault();
  errors = {};

  if (!titleInput.value.trim()) {
    addError('title', 'Title is required.');
  }

  if (!authorInput.value.trim()) {
    addError('author', 'Author is required.');
  }

  if (!publisherInput.value) {
    addError('publisher', 'Please select a publisher.');
  }

  let year = parseInt(yearInput.value);
  if (!yearInput.value.trim()) {
    addError('year', 'Year is required.');
  } else if (year < 1900 || year > 2026) {
    addError('year', 'Year must be between 1900 and 2026.');
  }

  let isbn = isbnInput.value.trim();
  if (!isbn) {
    addError('isbn', 'ISBN is required.');
  } else if (isbn.length !== 13) {
    addError('isbn', 'ISBN must be 13 characters.');
  }

  if (!descriptionInput.value.trim()) {
    addError('description', 'Description is required.');
  }

  if (!coverInput.value) {
    addError('cover', 'Please upload a cover image.');
  }

  // check that at least one format checkbox is ticked
  let checkboxes = document.querySelectorAll('input[name="format_ids[]"]:checked');
  if (checkboxes.length === 0) {
    addError('formats', 'Please select at least one format.');
  }

  // display all errors
  showFieldErrors();

  // submit the form if no errors
  if (Object.keys(errors).length === 0) {
    bookForm.submit();
  }
});