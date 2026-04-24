var form = document.getElementById('filters');
var cardsContainer = document.getElementById('book_cards');
var cards = Array.from(cardsContainer.querySelectorAll('.card'));

function getFilters() {
  return {
    titleFilter:form.elements['title_filter'].value.trim().toLowerCase(),
    publisherFilter:form.elements['publisher_filter'].value,
    formatFilter:form.elements['format_filter'].value,
    sortBy:form.elements['sort_by'].value
  };
}

function cardMatches(card, filters) {
  var title = card.dataset.title.toLowerCase();
  var publisher = card.dataset.publisher;
  var formats = card.dataset.format ? card.dataset.format.split(',') : [];

  if (filters.titleFilter && !title.includes(filters.titleFilter)) return false;
  if (filters.publisherFilter && publisher !== filters.publisherFilter) return false;
  if (filters.formatFilter && !formats.includes(filters.formatFilter)) return false;

  return true;
}

function sortCards(cards, sortBy) {
  return cards.slice().sort(function(a, b) {
    var titleA = a.dataset.title.toLowerCase();
    var titleB = b.dataset.title.toLowerCase();
    var yearA  = Number(a.dataset.year);
    var yearB  = Number(b.dataset.year);

    if (sortBy === 'year_desc') return yearB - yearA;
    if (sortBy === 'year_asc')  return yearA - yearB;
    return titleA.localeCompare(titleB);
  });
}

function applyFilters() {
  var filters = getFilters();

  cards.forEach(function(card) {
    card.classList.toggle('hidden', !cardMatches(card, filters));
  });

  var visible = cards.filter(function(card) {
    return !card.classList.contains('hidden');
  });

  sortCards(visible, filters.sortBy).forEach(function(card) {
    cardsContainer.appendChild(card);
  });
}

function clearFilters() {
  form.reset();

  cards.forEach(function(card) {
    card.classList.remove('hidden');
  });

  sortCards(cards, 'year_asc').forEach(function(card) {
    cardsContainer.appendChild(card);
  });
}

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