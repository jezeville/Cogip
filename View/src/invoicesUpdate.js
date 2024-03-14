// Déclarez une variable globale pour stocker l'ID
var selectedId = null;

function saveChanges(button) {
    var row = button.parentNode.parentNode;

    // Récupérer les nouvelles valeurs depuis les cellules éditables
    var newRef = row.cells[0].innerText;

    // Ajouter le code suivant pour formater la date en 'YYYY-MM-DD HH:MM:SS'
    var newDate = new Date(row.cells[1].innerText);
    newDate = newDate.toISOString().slice(0, 19).replace("T", " ");

    var newCompanyName = row.cells[2].innerText;

    // Utiliser l'ID stocké dans la variable globale
    var id = row.cells[0].getAttribute('data-id');



    // Récupérer les valeurs d'origine stockées dans les attributs
    var originalRef = row.cells[0].getAttribute('data-original');
    var originalDate = row.cells[1].getAttribute('data-original');
    var originalCompanyName = row.cells[2].getAttribute('data-original');

    // Désactiver l'édition des cellules
    for (var i = 0; i < 3; i++) {
        row.cells[i].contentEditable = false;
    }

    // Masquer le bouton "Save"
    button.style.display = 'none';

    // Si les valeurs ont changé, effectuez la mise à jour côté client
    if (newRef !== originalRef || newDate !== originalDate || newCompanyName !== originalCompanyName) {
        // Mettez à jour les valeurs dans la ligne du tableau
        row.cells[0].innerText = newRef;
        row.cells[1].innerText = newDate;
        row.cells[2].innerText = newCompanyName;

        // Utilisez une requête AJAX pour envoyer les données mises à jour au serveur
        var xhr = new XMLHttpRequest();
        var updateUrl = '../view/dashboard.php';  // Assurez-vous que l'URL est correcte

        console.log('Updating with data:', {
            id: id,
            ref: newRef,
            created_at: newDate,
            company_name: newCompanyName
        });

        xhr.open('POST', updateUrl, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        var data = 'save_button=true&' +
            'id=' + encodeURIComponent(id) + // Utilisez l'ID stocké
            '&ref=' + encodeURIComponent(newRef) +
            '&created_at=' + encodeURIComponent(newDate) +
            '&company_name=' + encodeURIComponent(newCompanyName);

        // ...

        xhr.send(data);
    } else {
        console.log('No changes to save.');
    }
}

// La fonction enableEditing reste inchangée
function enableEditing(button, id) {
    console.log('selectedId:', selectedId); // Ajoutez cette ligne pour le débogage
    var row = button.parentNode.parentNode;

    // Récupérer les valeurs d'origine
    var originalRef = button.getAttribute('data-ref');
    var originalDate = button.getAttribute('data-created_at');
    var originalCompanyName = button.getAttribute('data-company_name');

    // Stocker les valeurs d'origine dans les cellules pour référence ultérieure
    row.cells[0].setAttribute('data-original', originalRef);
    row.cells[1].setAttribute('data-original', originalDate);
    row.cells[2].setAttribute('data-original', originalCompanyName);

    // Stocker l'ID dans la variable globale
    selectedId = id;

    // Activer l'édition des cellules
    for (var i = 0; i < 3; i++) {
        row.cells[i].contentEditable = true;
    }

    // Afficher le bouton "Save"
    var saveButton = row.querySelector('.saveButton');
    saveButton.setAttribute('data-id', id);  // Stockez l'ID dans l'attribut
    saveButton.style.display = 'block';  // pour afficher

}