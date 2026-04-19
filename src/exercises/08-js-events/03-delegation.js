let cardsContainer = document.getElementById("cards");

function handleClicks(event){
    // console.log(`you clicked on a ${event.currentTarget.tagName} element\n`);
    // console.log(`you clicked on a ${event.target.tagName} element\n`);

    const card = event.target.closest('.card');

    if (!card){
        return;
    }


    const action = event.target.dataset.action;
    if(action === "select") {
        // console.log("you clicked ona a select button");
        toggleCardHighlight(card);

    } else if (action === "log"){
        // console.log("you clcicken on a log button")
        logCardTitle(card);
    }
}

function toggleCardHighlight(card){
    card.classList.toggle('selected');
}

function logCardTitle(card){
    console.log('card title: ', card.dataset.title);
}

cardsContainer.addEventListener('click', handleClicks);