function enableEditing(button, id) {
    var row = button.parentNode.parentNode;
    var editableFields = row.querySelectorAll('.editable');
    for (var i = 0; i < editableFields.length; i++) {
        editableFields[i].contentEditable = true;
        editableFields[i].classList.add('editing');
    }

    var saveButton = row.querySelector('.saveButton');
    saveButton.style.display = 'block';
}

function saveChanges(button) {
    var row = button.parentNode.parentNode;
    var id = row.getAttribute('data-id');
    var editableFields = row.querySelectorAll('.editable.editing');
    var data = 'id=' + encodeURIComponent(id);

    for (var i = 0; i < editableFields.length; i++) {
        var field = editableFields[i].getAttribute('data-field');
        var value = editableFields[i].innerText;
        data += '&' + field + '=' + encodeURIComponent(value);
        editableFields[i].classList.remove('editing');
        editableFields[i].contentEditable = false;
    }

    var xhr = new XMLHttpRequest();
    var updateUrl = '../Controller/update_invoice.php';

    xhr.open('POST', updateUrl, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Update successful');
            } else {
                console.error('Update failed:', xhr.responseText);
            }
        }
    };

    xhr.send(data);
}
