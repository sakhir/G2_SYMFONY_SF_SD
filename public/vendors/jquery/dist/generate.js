function generateChambre() {
    var divInputs = document.getElementById('input');
    var newInput = document.createElement('div');
    newInput.setAttribute('class', "chambre");
    newInput.innerHTML = `
            <input type="text" class="chambre" name="chambre" required>
            `;
    divInputs.appendChild(newInput);
}

function generateAdresse() {
    var divInputs = document.getElementById('input');
    var newInput = document.createElement('div');
    newInput.setAttribute('class', "adresse");
    newInput.innerHTML = `
    <input type="text" class="adresse" name="adresse" required>
            `;
    divInputs.appendChild(newInput);
}