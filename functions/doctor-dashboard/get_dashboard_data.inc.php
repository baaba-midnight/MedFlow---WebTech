<?php
require_once '../../includes/config.inc.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $data = [];

        // get patiet status distribution
        $query = "SELECT `status`, COUNT(*) as count FROM Patients GROUP BY `status`";
        $stmt = $conn->prepare($query);
        $patientStatus = [];
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $patientStatus[] = [
                    'name' => $row['status'],
                    'value' => (int)$row['count']
                ];
            }

            $data['patientStatus'] = $patientStatus;
        }

        // get department-wise patient count
        $query = "SELECT
                    d.department_name,
                    COUNT(DISTINCT p.patient_id) as patient_count
                FROM Departments d
                LEFT JOIN Appointments a ON a.doctor_user_id IN (
                    SELECT doctor_id FROM DoctorDepartment WHERE department_id = d.department_id
                )
                LEFT JOIN Patients p ON a.patient_id = p.patient_id
                GROUP BY d.department_name;";
        
        $stmt = $conn->prepare($query);
        $departmentCount = [];
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $departmentCount[] = [
                    'department' => $row['department_name'],
                    'patients' => (int)$row['patient_count']
                ];
            }

            $data['departmentCount'] = $departmentCount;
        }

        // get weekly admissions
        $query = "SELECT 
                    DATE(admission_date) as admission_day,
                    COUNT(*) as admission_count
                FROM Patients
                WHERE admission_date >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)
                GROUP BY DATE(admission_date)
                ORDER BY admission_day";

        $stmt = $conn->prepare($query);
        $weeklyAdmissions = [];

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $weeklyAdmissions[] = [
                    'date' => $row['admission_day'],
                    'count' => (int)$row['admission_count']
                ];
            }

            $data['weeklyAdmissions'] = $weeklyAdmissions;
        }

        // Get Quick Stats
        $query = "SELECT
                    (SELECT COUNT(*) FROM patients WHERE `status` = 'inpatient' OR `status` = 'outpatient') as active_patients,
                    (SELECT COUNT(*) FROM users) as total_staff,
                    (SELECT COUNT(*) FROM Appointments WHERE appoint_condition = 'scheduled') as pending_appointments,
                    (SELECT COUNT(*) FROM patients WHERE is_critical = TRUE) as critical_patients";
        
        $stmt = $conn->prepare($query);
        $quickStats = [];

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $quickStats[] = [
                    'criticalPatients' => (int)$row['critical_patients'],
                    'activePatients' => (int)$row['active_patients'],
                    'todayAppointments' => (int)$row['pending_appointments'],
                    'totalStaff' => (int)$row['total_staff']
                ];
            }

            $data['quickStats'] = $quickStats;
        }

        // return JSON response
        header('Content-Type: application/json');
        echo json_encode($data);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}