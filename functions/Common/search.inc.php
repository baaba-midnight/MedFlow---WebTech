<?php
include "../includes/config.inc.php";

// search patient by name of ID
$query = "SELECT DISTINCT
            p.patient_id,
            p.first_name,
            p.middle_name,
            p.last_name,
            p.date_of_birth,
            p.gender,
            p.status
        FROM Patients p
        WHERE
            p.first_name LIKE '%[search_term]%' OR
            p.last_name LIKE '%[search_terms]%' OR
            p.patient_id = '[search_item]';";

// search users ny name, role, or department
$query = "SELECT
            u.user_id,
            u.first_name,
            u.last_name,
            u.userrole,
            u.user_department
        FROM Users u
        WHERE 
            u.first_name LIKE '%[search_item]%' OR
            u.last_name LIKE '%[search_item]%' OR
            u.userrole LIKE '%[search_item]%' OR
            u.user_department LIKE '%[search_item]%';";