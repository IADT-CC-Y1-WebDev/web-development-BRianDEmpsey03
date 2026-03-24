let applyBtn = document.getElementById("apply_filters");
let clearBtn = document.getElementById("clear_filters");

applyBtn.addEventListener("click", (event) => {
        event.preventDefault();
        applyFilters();
});

clearBtn.addEventListener('click', (event) => {
    event.preventDefault();
    clearFilters();
});

function applyFilters(){
    let filters = getFilters();
    for (let i = 0; i != cards.length; i++){
        let card = cards[i];
        let match = cardMatches(card, filters);
        card.classList.toggle('hidden', !match);
    }
}

function getFilters(){
    const titleEl = form.elements['title_filter'];
    const genreEl = form.elements['genre_filter'];
    const platformEl = form.elements['platform_filter'];
    const sortEl = form.elements['sort_by'];

    let titleFilter = (titleEl. value || '').trim().toLowerCase();
    let genreFilter = genreE1.value || '';
    let platformFilter = platformE1.value || '';
    let sortBy = sortEl.value || 'title_asc';

    return {
        "titleFilter" : titleFilter,
        "genreFilter" : genreFilter,
        "platformFilter" : platformFilter,
        "sortBy" : sortBy,
    };
   
}

function cardMatches(card, filters){
   
    let title = card.dataset.title.toLowerCase();
    let genre = card.dataset.genre;
    let platform = card.dataset.platform;

    let matchTitle = title.includes(filters.titleFilter) || filters.titleFilter === "";
    

}



function clearFilters(){
    console.log("clearing filters");
}


function matchTitle(card, title){
    let ttl = title.toLowerCase();
    let match = false;
    if (card.dataset.title.includes(title)){
        match = true;
    }
    return match;
}