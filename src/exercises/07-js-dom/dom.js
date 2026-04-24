var myBtn = document.getElementById('myButton');
myBtn.addEventListener('click', addParagraph);

function addParagraph() {
  var input = document.createElement('input');
  input.type = 'text';
  input.placeholder = 'Type your paragraph text here';
  document.body.appendChild(input);

  var btn = document.createElement('button');
  btn.innerText = 'Add';
  document.body.appendChild(btn);

  btn.addEventListener('click', function() {
    var p = document.createElement('p');
    p.innerHTML = input.value;
    document.body.appendChild(p);
  });
}