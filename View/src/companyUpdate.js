function update(buttonUpdate, buttonValue) {

    let row = buttonUpdate.parentNode.parentNode;
    let table = row.parentNode;
    let tab = row.childNodes;
    console.log(tab);
    let row2 = document.createElement('tr');



    let cell = document.createElement('td');
    let input = document.createElement('input');
    input.id = "name";
    input.value = tab[1].innerText;
    cell.append(input);
    row2.append(cell);

    let cell1 = document.createElement('td');
    let input1 = document.createElement('input');
    input1.id = "tva";
    input1.value = tab[3].innerText;
    cell1.append(input1);
    row2.append(cell1);

    let cell2 = document.createElement('td');
    let input2 = document.createElement('input');
    input2.id = "country";
    input2.value = tab[5].innerText;
    cell2.append(input2);
    row2.append(cell2);


    let buttonSup = document.createElement('td');
    buttonSup.innerHTML = `<form method="POST" action="dashboard.php">
        <input type="hidden" name="delete_company" value="${buttonValue}">
        <button type="submit" name="delete_button">Delete</button>
    </form>`;
    row2.append(buttonSup);
    table.replaceChild(row2, row);

    let buttonSave = document.createElement('td');
    buttonSave.innerHTML = `<button onclick="sendUpdate()" name="save_button">Save</button>`;
    row2.append(buttonSave);
}

function sendUpdate() {
    let value1 = document.getElementById('name').value;
    let value2 = document.getElementById('tva').value;
    let value3 = document.getElementById('country').value;

    return tabValue = [value1, value2, value3];
}