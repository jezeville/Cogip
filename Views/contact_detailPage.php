<?php

require '../Controller/contact_detail.php';
require 'contactPage.php';
require 'header.php';


$contactId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$contactId = new Contact_detail($db);
$contactDetails = $contactId->getContactById($contactId);

// verify if there's a result
if ($result->num_rows > 0) {
    // to get the  contact details
    $contactDetails = $result->fetch_assoc();
?>
    
    <section>
        <h2>Contact details</h2>
        <div>
            <p>ID : <?php echo $contactDetails['id']; ?></p>
            <p>Nom : <?php echo $contactDetails['name']; ?></p>
            <p>Prénom : <?php echo $contactDetails['company_id']; ?></p>
            <p>Email : <?php echo $contactDetails['email']; ?></p>
            <p>Phone : <?php echo $contactDetails['phone']; ?></p>
            <p>Created_at : <?php echo $contactDetails['Created_at']; ?></p>
            <p>Updated_at : <?php echo $contactDetails['Updated_at']; ?></p>
        </div>
    </section>
<?php
} else {
    echo "<p>Contact non trouvé.</p>";
}


include('footer.php');
?>
