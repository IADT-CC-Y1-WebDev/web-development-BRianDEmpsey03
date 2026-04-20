const form = document.getElementById('filters');
const cardsContainer = document.getElementById("book_cards");
const cards = Array.from(cardsContainer.querySelectorAll('.card'));

function getFilters() {
    const titleEl = form.elements['title_filter'];
    const publisherEl = form.elements['publisher_filter'];
    const formatEl = form.elements['format_filter'];
    const sortEl = form.elements['sort_by'];
    return {
        titleFilter: (titleEl.value || '').trim().toLowerCase(),
        publisherFilter: publisherEl.value || '',
        formatFilter: formatEl.value || '',
        sortBy: sortEl.value || 'title_asc'
    };
}

function cardMatches(card, filters) {
    const title = card.dataset.title.toLowerCase();
    const publisher = card.dataset.publisher;

    const formats = card.dataset.format
        ? card.dataset.format.split(',')
        : [];

    const matchTitle =
        filters.titleFilter === '' || title.includes(filters.titleFilter);

    const matchPublisher =
        filters.publisherFilter === '' ||
        publisher === filters.publisherFilter;

    const matchFormat =
        filters.formatFilter === '' ||
        formats.includes(filters.formatFilter);

    return matchTitle && matchPublisher && matchFormat;
}

function sortCards(cards, sortBy) {
    const list = cards.slice();
    list.sort(function (a, b) {
        const titleA = a.dataset.title.toLowerCase();
        const titleB = b.dataset.title.toLowerCase();
        const yearA = Number(a.dataset.year);
        const yearB = Number(b.dataset.year);
        if (sortBy === 'year_desc') return yearB - yearA;
        if (sortBy === 'year_asc') return yearA - yearB;
        return titleA.localeCompare(titleB);
    });
    return list;
}

function applyFilters() {
    const filters = getFilters();
    cards.forEach(function (card) {
        card.classList.toggle('hidden', !cardMatches(card, filters));
    });
    const visible = cards.filter(function (card) {
        return !card.classList.contains('hidden');
    });
    const sorted = sortCards(visible, filters.sortBy);
    sorted.forEach(function (card) {
        cardsContainer.appendChild(card);
    });
}

function clearFilters() {
    form.reset();
    cards.forEach(function (card) {
        card.classList.remove('hidden');
    });
    const byYear = sortCards(cards.slice(), 'year_asc');
    byYear.forEach(function (card) {
        cardsContainer.appendChild(card);
    });
}

document.getElementById('apply_filters').addEventListener('click', (e) => {
    e.preventDefault();
    applyFilters();
});
document.getElementById('clear_filters').addEventListener('click', (e) => {
    e.preventDefault();
    clearFilters();
});

function myFunction() {
  var element = document.body;
  element.classList.toggle("dark-mode");
}