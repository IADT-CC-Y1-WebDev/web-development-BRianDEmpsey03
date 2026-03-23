let box = document.getElementById('box');
let toggleBoxBtn = document.getElementById('toggle_box_btn');
let preview = document.getElementById('preview');
let previewInput = document.getElementById('preview_input');

toggleBoxBtn.addEventListener('click', (event) => {
    toggleBoxVisibility(box);
});

function toggleBoxVisibility(box){
    // console.log(event.target);
    box.classList.toggle('hidden');
}

previewInput.addEventListener('change', (event) => {
    console.log(event.target.value);
})

function updatePreview(previewElement, text){
    const trimmed = text.trim();

    if (trimmed === '') {
        previewElement.textContext = ('nothing yet');
        previewElement.classList.add('empty')
    }
}