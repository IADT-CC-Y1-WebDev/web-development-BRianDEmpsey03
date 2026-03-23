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

}

function getFilters(){
    const titleEl = form.elements['title_filter'];
    const genreEl = form.elements['genre_filter'];
    const platformEl = form.elements['platform_filter'];
    const sortEl = form.elements['sort_by'];

    let titleFilter = (titleEl. value || '').trim().toLowerCase();
    let genreFilter = genreE1.value || '';
    let platformFilter = platformE1.value || '';
    let sortFilter = sortEl.value || 'title_asc';
}

return
    "titleFilter" : titleFilter;

function clearFilters(){
    console.log("clearing filters");
}