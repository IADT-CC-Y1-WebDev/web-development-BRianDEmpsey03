var bookForm       = document.getElementById('book_form');
var submitBtn      = document.getElementById('submit_btn');
var errorSummary   = document.getElementById('error_summary_top');

var titleInput       = document.getElementById('title');
var authorInput      = document.getElementById('author');
var yearInput        = document.getElementById('year');
var isbnInput        = document.getElementById('isbn');
var descriptionInput = document.getElementById('description');

var titleError       = document.getElementById('title_error');
var authorError      = document.getElementById('author_error');
var yearError        = document.getElementById('year_error');
var isbnError        = document.getElementById('isbn_error');
var descriptionError = document.getElementById('description_error');

var errors = {};

function addError(fieldName, message) {
  errors[fieldName] = message;
}

function showErrorSummaryTop() {
  var messages = Object.values(errors);

  if (messages.length > 0) {
    var html = '<ul>';
    for (var i = 0; i < messages.length; i++) {
      html += '<li>' + messages[i] + '</li>';
    }
    html += '</ul>';
    errorSummary.innerHTML = html;
    errorSummary.style.display = 'block';
  } else {
    errorSummary.innerHTML = '';
    errorSummary.style.display = 'none';
  }
}

function showFieldErrors() {
  titleError.innerHTML       = errors.title       || '';
  authorError.innerHTML      = errors.author      || '';
  yearError.innerHTML        = errors.year        || '';
  isbnError.innerHTML        = errors.isbn        || '';
  descriptionError.innerHTML = errors.description || '';
}

function validateTitle(value) {
  if (!value) return 'Title is required.';
  if (value.length < 2) return 'Title must be at least 2 characters.';
  return null;
}

function validateAuthor(value) {
  if (!value) return 'Author is required.';
  if (value.length < 2) return 'Author must be at least 2 characters.';
  return null;
}

function validateYear(value) {
  if (!value) return 'Year is required.';
  var num = parseInt(value);
  if (isNaN(num)) return 'Year must be a number.';
  if (num < 1000 || num > new Date().getFullYear()) return 'Please enter a valid year.';
  return null;
}

function validateIsbn(value) {
  if (!value) return 'ISBN is required.';
  var cleaned = value.replace(/-/g, '');
  if (cleaned.length !== 10 && cleaned.length !== 13) return 'ISBN must be 10 or 13 digits.';
  return null;
}

function validateDescription(value) {
  if (!value) return 'Description is required.';
  if (value.length < 10) return 'Description must be at least 10 characters.';
  return null;
}

function onSubmitForm(evt) {
  evt.preventDefault();
  errors = {};

  var titleErr = validateTitle(titleInput.value.trim());
  if (titleErr) addError('title', titleErr);

  var authorErr = validateAuthor(authorInput.value.trim());
  if (authorErr) addError('author', authorErr);

  var yearErr = validateYear(yearInput.value.trim());
  if (yearErr) addError('year', yearErr);

  var isbnErr = validateIsbn(isbnInput.value.trim());
  if (isbnErr) addError('isbn', isbnErr);

  var descriptionErr = validateDescription(descriptionInput.value.trim());
  if (descriptionErr) addError('description', descriptionErr);

  showErrorSummaryTop();
  showFieldErrors();

  if (Object.keys(errors).length === 0) {
    bookForm.submit();
  }
}

if (bookForm && submitBtn) {
  submitBtn.addEventListener('click', onSubmitForm);
}