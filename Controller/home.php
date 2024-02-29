<?php

require('../Model/connection.php');


// function to get 5 last invoices
function getLatestInvoices($conn, $limit) {
   
   
//    $sql = "SELECT invoices.ref, DATE(invoices.created_at) as created_date, DATE(invoices.updated_at) as updated_date, DATE(invoices.due_date) as due_date, companies.name AS company_name 
//     FROM invoices
//     JOIN companies ON invoices.id_company = companies.id
//     JOIN types ON companies.type_id = types.id
//     ORDER BY invoices.created_at DESC
//     LIMIT :offset, :maxPage";


    $sql = "SELECT invoices.ref, DATE(invoices.created_at) as created_date, DATE(invoices.updated_at) as updated_date, DATE(invoices.due_date) as due_date, companies.name AS company_name 
    FROM invoices ORDER BY date DESC LIMIT $limit";
    $result = $conn->query($sql);

    return ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// function to get 5 last contacts
function getLatestContact($conn, $limit) {
    $sql = "SELECT first_name, last_name, email FROM people ORDER BY created_at DESC LIMIT $limit";
    $result = $conn->query($sql);

    return ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// // function to get 5 last companies
function getLatestCompanies($conn, $limit) {
    $sql = "SELECT name, type FROM companies ORDER BY created_at DESC LIMIT $limit";
    $result = $conn->query($sql);

    return ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];
}
