const apiUrl = 'http://localhost:8000/api/fighter';

function fetchFighters() {
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const list = document.getElementById('fighter-list');
            list.innerHTML = '';
            data.data.forEach(fighter => {
                const item = document.createElement('li');
                item.innerHTML = `
                    <span id="fighter-${fighter.id}">
                        <strong>${fighter.name}</strong> - ${fighter.weight_class} - Record: ${fighter.record} - ${fighter.country}
                    </span>
                    <div>
                        <button onclick="editFighter(${fighter.id})">Edit</button>
                        <button onclick="deleteFighter(${fighter.id})">Delete</button>
                    </div>
                `;
                list.appendChild(item);
            });
        });
}

function addFighter() {
    const name = document.getElementById('name').value;
    const weight_class = document.getElementById('weight_class').value;
    const record = document.getElementById('record').value;
    const country = document.getElementById('country').value;

    if (!name || !record || !country) {
        alert("All fields are required!");
        return;
    }

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, weight_class, record, country })
    })
    .then(response => response.json())
    .then(() => {
        fetchFighters();
        document.getElementById('name').value = '';
        document.getElementById('record').value = '';
        document.getElementById('country').value = '';
    });
}

function editFighter(id) {
    const fighterSpan = document.getElementById(`fighter-${id}`);
    const currentValues = fighterSpan.textContent.split(' - ');
    const currentName = currentValues[0].trim();
    const currentWeightClass = currentValues[1].trim();
    const currentRecord = currentValues[2].replace('Record: ', '').trim();
    const currentCountry = currentValues[3].trim();

    fighterSpan.innerHTML = `
        <input type="text" id="edit-name-${id}" value="${currentName}">
        <select id="edit-weight-class-${id}">
            <option value="Featherweight" ${currentWeightClass === 'Featherweight' ? 'selected' : ''}>Featherweight</option>
            <option value="Lightweight" ${currentWeightClass === 'Lightweight' ? 'selected' : ''}>Lightweight</option>
            <option value="Welterweight" ${currentWeightClass === 'Welterweight' ? 'selected' : ''}>Welterweight</option>
            <option value="Middleweight" ${currentWeightClass === 'Middleweight' ? 'selected' : ''}>Middleweight</option>
            <option value="Heavyweight" ${currentWeightClass === 'Heavyweight' ? 'selected' : ''}>Heavyweight</option>
        </select>
        <input type="text" id="edit-record-${id}" value="${currentRecord}">
        <input type="text" id="edit-country-${id}" value="${currentCountry}">
        <button onclick="saveFighter(${id})">Save</button>
        <button onclick="cancelEdit(${id}, '${currentName}', '${currentWeightClass}', '${currentRecord}', '${currentCountry}')">Cancel</button>
    `;
}

function saveFighter(id) {
    const name = document.getElementById(`edit-name-${id}`).value;
    const weight_class = document.getElementById(`edit-weight-class-${id}`).value;
    const record = document.getElementById(`edit-record-${id}`).value;
    const country = document.getElementById(`edit-country-${id}`).value;

    if (!name || !record || !country) {
        alert("All fields are required!");
        return;
    }

    fetch(`${apiUrl}/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, weight_class, record, country })
    })
    .then(response => response.json())
    .then(() => fetchFighters());
}

function cancelEdit(id, name, weight_class, record, country) {
    const fighterSpan = document.getElementById(`fighter-${id}`);
    fighterSpan.innerHTML = `
        <strong>${name}</strong> - ${weight_class} - Record: ${record} - ${country}
    `;
}

function deleteFighter(id) {
    if (confirm("Are you sure you want to delete this fighter?")) {
        fetch(`${apiUrl}?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (response.ok) {
                console.log(`Fighter with ID ${id} deleted successfully.`);
                fetchFighters();
            } else {
                console.error(`Failed to delete fighter with ID ${id}.`);
            }
        })
        .catch(error => console.error('Error deleting fighter:', error));
    }
}


window.onload = fetchFighters;
