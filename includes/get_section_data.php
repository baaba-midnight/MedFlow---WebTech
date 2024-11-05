<?php
require_once 'config.php';

// get the modal section
$section = $_GET['section'];

$query = "SELECT 
            COUNT(CASE WHEN status = 'inpatient' THEN 1 END) AS inpatients,
            COUNT(CASE WHEN staus = 'outpatient' THEN 1 END) AS outpatients, 
            (COUNT(CASE WHEN status = 'inpatient' THEN 1 END) + COUNT(CASE WHEN status )"
?>