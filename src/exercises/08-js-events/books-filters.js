var form = document.getElementById('filter-form');
var list = document.getElementById('book-list');
var applyBtn = document.getElementById('apply-btn');
var clearBtn = document.getElementById('clear-btn');

function getFilters() {
  return {
    titleFilter: form.elements['title_filter'].value.toLowerCase(),
    yearFilter:  form.elements['year_filter'].value
  };
}

function cardMatches(card, filters) {
  var title = card.dataset.title.toLowerCase();
  var year  = parseInt(card.dataset.year);

  if (filters.titleFilter && title.indexOf(filters.titleFilter) === -1) {
    return false;
  }

  if (filters.yearFilter === 'before2000' && year >= 2000) {
    return false;
  }

  if (filters.yearFilter === 'from2000' && year < 2000) {
    return false;
  }

  return true;
}

function sortCards(cards) {
  return cards.slice().sort(function(a, b) {
    var yearA = parseInt(a.dataset.year);
    var yearB = parseInt(b.dataset.year);
    return yearA - yearB;
  });
}

function applyFilters() {
  var filters = getFilters();
  var cards   = document.querySelectorAll('.book-card');

  for (var i = 0; i < cards.length; i++) {
    if (cardMatches(cards[i], filters)) {
      cards[i].hidden = false;
    } else {
      cards[i].hidden = true;
    }
  }

  var visibleCards = [];
  for (var i = 0; i < cards.length; i++) {
    if (!cards[i].hidden) {
      visibleCards.push(cards[i]);
    }
  }

  var sorted = sortCards(visibleCards);
  for (var i = 0; i < sorted.length; i++) {
    list.appendChild(sorted[i]);
  }
}

function clearFilters() {
  form.reset();

  var cards = document.querySelectorAll('.book-card');
  for (var i = 0; i < cards.length; i++) {
    cards[i].hidden = false;
  }

  var allCards = [];
  for (var i = 0; i < cards.length; i++) {
    allCards.push(cards[i]);
  }

  var sorted = sortCards(allCards);
  for (var i = 0; i < sorted.length; i++) {
    list.appendChild(sorted[i]);
  }
}

applyBtn.addEventListener('click', applyFilters);
clearBtn.addEventListener('click', clearFilters);