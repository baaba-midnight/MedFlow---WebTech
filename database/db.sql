DROP DATABASE IF EXISTS hospital_management;
CREATE DATABASE hospital_management;
USE hospital_management;

CREATE TABLE Patients (
    patient_id INT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    `status` ENUM('inpatient', 'outpatient', 'discharged') NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    emergency_contact_name VARCHAR(100) NOT NULL,
    emergency_contact_number VARCHAR(15) NOT NULL,
    insurance_provider VARCHAR(100),
    insurance_policy_number VARCHAR(50)
);

CREATE TABLE MedicalHistory (
    medical_history_id VARCHAR(10) PRIMARY KEY,
    patient_id INT,
    condition_name VARCHAR(100) NOT NULL,
    diagnosis_date DATE NOT NULL,
    case_condition ENUM('active', 'resolved') NOT NULL,
    notes TEXT,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

CREATE TABLE Allergies (
    allergy_id VARCHAR(10) PRIMARY KEY,
    patient_id INT,
    allergy_type VARCHAR(100) NOT NULL,
    severity ENUM('mild', 'moderate', 'severe') NOT NULL,
    notes TEXT,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

CREATE TABLE Departments (
    department_id VARCHAR(5) PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL
    
);

CREATE TABLE Doctors (
    doctor_id VARCHAR(5) PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    specialization VARCHAR(100) NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    department_id VARCHAR(5),
    FOREIGN KEY (department_id) REFERENCES Departments(department_id)
);

CREATE TABLE DoctorDepartment (
    department_id VARCHAR(5),
    doctor_id VARCHAR(5),
    is_head_doctor BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (department_id, doctor_id),
    FOREIGN KEY (department_id) REFERENCES Departments(department_id),
    FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id)
);

CREATE TABLE Medications (
    medication_id VARCHAR(10) PRIMARY KEY,
    patient_id INT,
    medication_name VARCHAR(100) NOT NULL,
    dosage VARCHAR(50) NOT NULL,
    frequency VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    prescribed_by VARCHAR(5),
    medi_condition ENUM('active', 'discontinued') DEFAULT 'active',
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    FOREIGN KEY (prescribed_by) REFERENCES Doctors(doctor_id)
);

CREATE TABLE Appointments (
    appointment_id VARCHAR(10) PRIMARY KEY,
    patient_id INT,
    doctor_id VARCHAR(5),
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    appoint_condition ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
    appointment_type VARCHAR(50) NOT NULL,
    notes TEXT,
    room_number VARCHAR(10),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id)
);

CREATE TABLE Staff (
    staff_id VARCHAR(5) PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    task VARCHAR(50) NOT NULL,
    department_id VARCHAR(5),
    contact_number VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    staff_condition ENUM('active', 'inactive') DEFAULT 'active',
    FOREIGN KEY (department_id) REFERENCES Departments(department_id)
);

CREATE TABLE Vitals (
    vital_id VARCHAR(5) PRIMARY KEY,
    patient_id INT,
    recorded_date DATETIME NOT NULL,
    blood_pressure VARCHAR(20),
    heart_rate INT,
    temperature DECIMAL(3,1),
    respiratory_rate INT,
    recorded_by VARCHAR(5),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    FOREIGN KEY (recorded_by) REFERENCES Staff(staff_id)
);

CREATE TABLE LabResults (
    lab_result_id VARCHAR(10) PRIMARY KEY,
    patient_id INT,
    test_type VARCHAR(100) NOT NULL,
    test_date DATE NOT NULL,
    result TEXT NOT NULL,
    normal_range VARCHAR(100),
    performed_by VARCHAR(5) NOT NULL,
    notes TEXT,
    FOREIGN KEY(performed_by) REFERENCES Staff(staff_id),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

INSERT INTO Patients (patient_id, first_name, last_name, date_of_birth, gender, `status`, contact_number, address, emergency_contact_name, emergency_contact_number, insurance_provider, insurance_policy_number) VALUES
(1,'Kwabena', 'Ansah', '1985-03-15', 'M', 'inpatient', '+233241234569', 'Adabraka, Accra', 'Akua Ansah', '+233241234570', 'NHIS', 'NHIS123456'),
(2,'Akua', 'Mensah', '2000-07-22', 'F', 'inpatient', '+233551234569', 'Asylum Down, Accra', 'Yaw Mensah', '+233551234570', 'NHIS', 'NHIS789012'),
(3,'Joel', 'Owusu', '1978-11-30', 'M', 'outpatient', '+233271234569', 'Kaneshie, Accra', 'Godfred Owusu', '+233271234570', NULL, NULL),
(4,'Jonathan', 'Addo', '2005-04-18', 'inpatient', 'M', '+233541234569', 'Dansoman, Accra', 'Cosmos Addo', '+233541234570', 'Nationwide', 'N8886245136'),
(5,'Joy', 'Amoah', '2003-09-25', 'F', 'inpatient', '+233201234569', 'East Legon, Accra', 'Jeremy Amoah', '+233201234570', 'NHIS', 'NHIS567890'),
(6,'Akua', 'Tetteh', '1970-01-12', 'F', 'inpatient', '+233241234571', 'Labadi, Accra', 'Kojo Tetteh', '+233241234572', NULL, NULL),
(7,'Kofi', 'Asante', '2000-06-28', 'M', 'outpatient', '+233551234571', 'Osu, Accra', 'John Asante', '+233551234572', 'Nationwide', 'N7776214589'),
(8,'Emelia', 'Boateng', '1992-12-05', 'F', 'discharged', '+233271234571', 'Tema, Greater Accra', 'Kwabena Boateng', '+233271234572', 'NHIS', 'NHIS456789'),
(9,'Kwame', 'Duah', '2001-08-20', 'M', 'inpatient', '+233541234571', 'Spintex, Accra', 'Jane Duah', '+233541234572', 'NHIS', 'NHIS012345'),
(10,'Abigail', 'Kufuor', '2005-02-14', 'F', 'inpatient', '+233201234571', 'Airport Hills, Accra', 'Helena Kufuor', '+233201234572', 'Natiowide', 'N6662154789'),
(11,'Yaw', 'Frimpong', '1993-05-08', 'M', 'outpatient', '+233241234573', 'Madina, Accra', 'Abena Frimpong', '+233241234574', 'NHIS', 'NHIS345678'),
(12,'Grace', 'Sarpong', '2017-10-17', 'F', 'discharged', '+233551234573', 'Adenta, Accra', 'Kwame Sarpong', '+233551234574', 'NHIS', 'NHIS901234'),
(13,'Reina', 'Agyeman', '2012-07-03', 'F', 'outpatient', '+233271234573', 'Achimota, Accra', 'Eugene Agyeman', '+233271234574', NULL, NULL),
(14,'Janet', 'Poku', '2019-03-22', 'F', 'outpatient', '+233541234573', 'Tesano, Accra', 'Kofi Poku', '+233541234574', 'Nationwide', 'N5552178952'),
(15,'Jennifer', 'Baah', '1976-12-09', 'F', 'inpatient', '+233201234573', 'Labone, Accra', 'David Baah', '+233201234574', 'NHIS', 'NHIS789012'),
(16,'Joseph', 'Nkrumah', '2021-09-14', 'M', 'discharged', '+233241234575', 'Cantonment, Accra', 'Comfort Nkrumah', '+233241234576', 'NHIS', 'NHIS456789'),
(17,'Kwame', 'Appiah', '1994-04-28', 'M', 'inpatient', '+233551234575', 'Ridge, Accra', 'Nana Appiah', '+233551234576', 'Nationwide', 'N4443385621'),
(18,'Paul', 'Danso', '2000-11-07', 'M', 'outpatient', '+233271234575', 'Dansoman, Accra', 'Yaw Danso', '+233271234576', 'NHIS', 'NHIS678901'),
(19,'Enock', 'Osei', '1989-06-19', 'M', 'inpatient', '+233541234575', 'Dzorwulu, Accra', 'Abena Osei', '+233541234576', 'NHIS', 'NHIS234567'),
(20,'James', 'Addo', '2001-01-25', 'M', 'discharged', '+233201234575', 'East legon, Accra', 'Tiffany Addo', '+233201234576', 'Nationwide', 'N3335566778'),
(21,'Kwesi', 'Agyei', '2003-08-11', 'M', 'inpatient', '+233241234577', 'Osu, Accra', 'James Agyei', '+233241234578', NULL, NULL),
(22,'Abena', 'Opoku', '2022-03-30', 'F', 'outpatient', '+233551234577', 'Airport Hills, Accra', 'Emelia Opoku', '+233551234578', 'NHIS', 'NHIS123456'),
(23,'Peniel', 'Mensah', '1982-10-16', 'F', 'inpatient', '+233271234577', 'Labone, Accra', 'Bernard Mensah', '+233271234578', 'NHIS', 'NHIS789012'),
(24,'Salome', 'Owusu', '1990-05-23', 'F', 'inpatient', '+233541234577', 'Haatso, Accra', 'Kwesi Owusu', '+233541234578', 'Nationwide', 'N1114478956'),
(25,'Prince', 'Asamoah', '2014-12-08', 'M', 'discharged', '+233201234577', 'Dome, Accra', 'Anna Asamoah', '+233201234578', 'NHIS', 'NHIS901234'),
(26,'Aikins', 'Boateng', '2007-07-27', 'M', 'discharged', '+233241234579', 'Kwabenya, Accra', 'Yaw Boateng', '+233241234580', 'NHIS', 'NHIS678901'),
(27,'Yaw', 'Antwi', '1992-02-13', 'M', 'discharged', '+233551234579', 'Madina, Accra', 'Godwin Antwi', '+233551234580', 'Nationwide', 'N2221144569');
SELECT * FROM Patients;


INSERT INTO MedicalHistory (medical_history_id, patient_id, condition_name, diagnosis_date, case_condition, notes) VALUES
(001,1, 'Hypertension', '2024-01-15', 'active', 'Controlled with medication'),
(002,22, 'Type 2 Diabetes', '2024-11-20', 'active', 'Diet controlled'),
(003,7, 'Asthma', '2024-03-10', 'active', 'Mild intermittent'),
(004,10,'Migraine', '2024-02-05', 'active', 'Frequent episodes'),
(005,2, 'Arthritis', '2024-12-18', 'active', 'Affecting knee joints'),
(006,11, 'Anxiety Disorder', '2024-04-01', 'active', 'Under medication'),
(007,26, 'Breast cancer', '2024-01-30', 'active', 'Under treatment and might need surgery'),
(008,4, 'Lower Back Pain', '2024-10-15', 'resolved', 'Resolved with physiotherapy'),
(009,17, 'Headache', '2024-02-28', 'resolved', 'Resolved with medication'),
(010,20, 'Asthma', '2024-09-20', 'active', 'Mild intermittent');
SELECT * FROM MedicalHistory;



INSERT INTO Allergies (allergy_id, patient_id, allergy_type, severity, notes) VALUES
(111,1, 'Penicillin', 'severe', 'Anaphylactic reaction'),
(222,7, 'Peanuts', 'severe', 'Avoid all nut products'),
(333,14, 'Latex', 'moderate', 'Skin reaction'),
(444,11, 'Aspirin', 'mild', 'Causes mild rash'),
(555,21, 'Shellfish', 'severe', 'Immediate reaction'),
(666,4, 'Dust', 'moderate', 'Triggers asthma'),
(777,26, 'Sulfa Drugs', 'severe', 'Avoid all sulfa medications'),
(888,9, 'Dairy', 'mild', 'Lactose intolerance'),
(999,15, 'Bee Stings', 'severe', 'Carries EpiPen'),
(1000,5, 'Dust', 'severe', 'Causes severe sneezing');
SELECT * FROM Allergies;


INSERT INTO Departments (department_id, department_name, location) VALUES
('DD1','Cardiology', 'Building A, Floor 2'),
('DD2','Pediatrics', 'Building B, Floor 1'),
('DD3','Orthopedics', 'Building A, Floor 3'),
('DD4','General Doctors', 'Building C, Floor 2'),
('DD5','Physiotherapy', 'Building A, Floor 1');
SELECT * FROM Departments;



INSERT INTO Doctors (doctor_id, first_name, last_name, specialization, contact_number, email, department_id) VALUES
('D1','John', 'Agyeman', 'General Doctor', '+233554421356', 'john.agyeman@gmail.com', 'DD4'),
('D2','Sarah', 'Johnson', 'Pediatrician', '+233201546786', 'johnsons@gmail.com', 'DD2'),
('D3','Michael', 'Oppong', 'Orthopedic Surgeon', '+233203698745', 'michael.oppong@gmail.com', 'DD3'),
('D4','Emily', 'Sumani', 'Cardiologist', '+233598742369', 'semily@gmail.com', 'DD1'),
('D5','David', 'Ampah', 'Physiotherapist', '+233245687021', 'ampah.david@gmail.com', 'DD5');
SELECT * FROM Doctors;


INSERT INTO DoctorDepartment (department_id, doctor_id, is_head_doctor) VALUES
('DD1', 'D4', TRUE),  
('DD2', 'D2', TRUE),  
('DD3', 'D3', TRUE), 
('DD4', 'D1', TRUE),
('DD5', 'D5', TRUE); 
SELECT * FROM DoctorDepartment;





INSERT INTO Medications (medication_id, patient_id, medication_name, dosage, frequency, start_date, end_date, prescribed_by, medi_condition) VALUES
('M1', 10,'Lisinopril', '10mg', 'Once daily', '2024-01-15', NULL, 'D1', 'active'),
('M2',7, 'Metformin', '500mg', 'Twice daily', '2024-11-20', NULL, 'D1', 'active'),
('M3', 19,'Albuterol', '90mcg', 'As needed', '2024-03-10', NULL, 'D2', 'active'),
('M4', 4,'Sumatriptan', '50mg', 'As needed', '2024-02-05', NULL, 'D4', 'active'),
('M5',20, 'Ibuprofen', '400mg', 'Three times daily', '2024-11-18', '2024-12-18', 'D3', 'discontinued'),
('M6',17, 'Sertraline', '50mg', 'Once daily', '2024-04-01', NULL, 'D4', 'active'),
('M7', 1,'Cetirizine', '10mg', 'Once daily', '2024-01-30', NULL, 'D2', 'active'),
('M8',2, 'Cyclobenzaprine', '10mg', 'Three times daily', '2024-10-15', '2025-01-15', 'D3', 'active'),
('M9',5, 'Omeprazole', '20mg', 'Once daily', '2024-02-28', NULL, 'D1', 'discontinued'),
('M10',12, 'Levothyroxine', '50mcg', 'Once daily', '2024-09-20', NULL, 'D1', 'active');
SELECT * FROM Medications;




INSERT INTO Appointments (appointment_id, patient_id, doctor_id, appointment_date, appointment_time, appoint_condition, appointment_type, notes, room_number) VALUES
('A1', 1, 'D1','2024-01-15', '09:00:00', 'scheduled', 'Follow-up', 'Blood pressure check', 'R101'),
('A2', 4,'D2', '2024-01-15', '10:00:00', 'scheduled', 'Follow-up', 'Diabetes review', 'R102'),
('A3', 2, 'D1','2024-01-15', '11:00:00', 'scheduled', 'Regular checkup', 'Asthma review', 'R201'),
('A4', 7, 'D4','2024-01-16', '09:30:00', 'scheduled', 'Consultation', 'Migraine assessment', 'R301'),
('A5', 3, 'D3','2024-01-16', '10:30:00', 'scheduled', 'Follow-up', 'Joint assessment', 'R103'),
('A6', 20, 'D5','2024-01-16', '11:30:00', 'scheduled', 'Regular checkup', 'Anxiety review', 'R302'),
('A7', 17,'D3', '2024-01-17', '09:00:00', 'scheduled', 'Follow-up', 'Allergy assessment', 'R202'),
('A8', 26,'D1', '2024-01-17', '10:00:00', 'scheduled', 'Follow-up', 'Back pain review', 'R104'),
('A9', 27,'D1', '2024-01-17', '11:00:00', 'scheduled', 'Consultation', 'Gastritis follow-up', 'R105'),
('A10', 11, 'D1','2024-01-18', '09:30:00', 'scheduled', 'Regular checkup', 'Thyroid review', 'R106');
SELECT * FROM Appointments;


INSERT INTO Staff (staff_id, first_name, last_name, task, department_id, contact_number, email, staff_condition) VALUES
('S1','Patricia', 'Adams', 'Nurse', 'DD1','+233201400365', 'p.adams@gmail.com', 'active'),
('S2','Robert', 'Obiri', 'Nurse', 'DD2', '+2335012367521', 'r.obiri@gmail.com', 'active'),
('S3','Linda', 'Acquah', 'Lab Technician', 'DD3', '+233542316890', 'linda.acquah@gmail.com', 'active'),
('S4','Ama', 'Tetteh', 'Receptionist', 'DD4', '+233552310206', 'tetteh.a@gmail.com', 'active'),
('S5','Mary', 'Danso', 'Nurse', 'DD5', '+233590210369', 'maryd@gmail.com', 'inactive'),
('S6','William', 'Adams', 'Lab Technician', 'DD1', '+200201543026', 'wiladams@gmail.com', 'active'),
('S7','Elizabeth', 'Seth', 'Nurse', 'DD2', '+233501236002', 'eliz.seth@gmail.com', 'active'),
('S8','Richard', 'Obiri', 'Pharmacist', 'DD3', '+233596210014', 'richard.obiri@gmail.com', 'active');
SELECT * FROM Staff;



INSERT INTO Vitals (vital_id, patient_id, recorded_date, blood_pressure, heart_rate, temperature, respiratory_rate, recorded_by) VALUES
('V1',1, '2024-01-15 09:15:00', '130/85', 72, 37.0, 16, 'S1'),
('V2',10, '2024-01-15 10:15:00', '125/82', 68, 36.8, 14, 'S1'),
('V3',13, '2024-01-15 11:15:00', '118/75', 75, 37.1, 18, 'S2'),
('V4',25, '2024-01-16 09:45:00', '120/80', 70, 36.9, 15, 'S2'),
('V5',19, '2024-01-16 10:45:00', '135/88', 73, 37.0, 16, 'S3'),
('V6',16, '2024-01-16 11:45:00', '122/78', 69, 36.7, 14, 'S3'),
('V7',7, '2024-01-17 09:15:00', '119/77', 71, 36.9, 15, 'S4'),
('V8',8, '2024-01-17 10:15:00', '128/84', 74, 37.2, 17, 'S4'),
('V9',21, '2024-01-17 11:15:00', '124/79', 72, 36.8, 15, 'S5'),
('V10',12, '2024-01-18 09:45:00', '126/83', 70, 37.0, 16, 'S5');
SELECT * FROM Vitals;




INSERT INTO LabResults (lab_result_id, patient_id, test_type, test_date, result, normal_range, performed_by, notes) VALUES
('L1',11, 'Complete Blood Count', '2024-01-15', 'WBC: 7.5, RBC: 4.8, Hgb: 14.2', 'WBC: 4.5-11.0, RBC: 4.2-5.4, Hgb: 13.0-17.0', 'S1', 'Within normal limits'),
('L2',2, 'HbA1c', '2024-01-15', '6.8%', '4.0-5.6%', 'S1', 'Above normal range'),
('L3',3, 'Spirometry', '2024-01-15', 'FEV1: 82% predicted', 'FEV1: >80% predicted', 'S5', 'Mild obstruction'),
('L4',4, 'Basic Metabolic Panel', '2024-01-16', 'Na: 140, K: 4.0, Cl: 102', 'Na: 135-145, K: 3.5-5.0, Cl: 98-106', 'S2', 'Normal electrolytes'),
('L5',20, 'X-Ray Knee', '2024-01-16', 'Mild joint space narrowing', 'N/A', 'S6', 'Early osteoarthritis changes'),
('L6',14, 'Thyroid Panel', '2024-01-16', 'TSH: 2.8, T4: 1.2', 'TSH: 0.4-4.0, T4: 0.8-1.8', 'S1', 'Within normal limits'),
('L7',17, 'IgE Levels', '2024-01-17', '180 IU/mL', '<100 IU/mL', 'S5', 'Elevated'),
('L8',4, 'MRI Lumbar Spine', '2024-01-17', 'Mild disc bulge L4-L5', 'N/A', 'S1', 'Conservative treatment recommended'),
('L9',9, 'H. pylori Test', '2024-01-17', 'Negative', 'Negative', 'S7', 'No H. pylori detected'),
('L10',27, 'Lipid Panel', '2024-01-18', 'Total Chol: 185, LDL: 110, HDL: 45', 'Total Chol: <200, LDL: <130, HDL: >40', 'S7', 'Within normal limits');
SELECT * FROM LabResults;

#QUERIES 
#Query to provide the patient information when the first and last name is entered 
SELECT * 
FROM Patients 
WHERE first_name = 'Kwabena' AND last_name = 'Ansah';

#Query to get the patient medical history when the patient's ID is entered 
SELECT * 
FROM MedicalHistory 
WHERE patient_id = 1;

#Query to get the patient's allergies when the first and last name is entered 
SELECT a.allergy_type, a.severity 
FROM Allergies a 
JOIN Patients p ON a.patient_id = p.patient_id 
WHERE p.first_name = 'Kwabena' AND p.last_name = 'Ansah';

#Query to identify patient on high risk and need attention based on medical history 
SELECT p.first_name, p.last_name, mh.condition_name, mh.case_condition
FROM Patients p
JOIN MedicalHistory mh ON p.patient_id = mh.patient_id
WHERE mh.case_condition = 'active' 
AND mh.condition_name IN ('Hypertension', 'Diabetes', 'Asthma');

#Query to find the upcoming appointment on a particular day for a specific doctor based on their ID
SELECT a.appointment_id, p.first_name, p.last_name, a.appointment_date, a.appointment_time 
FROM Appointments a 
JOIN Patients p ON a.patient_id = p.patient_id 
WHERE a.doctor_id = 'D1' 
AND a.appointment_date = '2024-01-15';

#Query to find all the patients with severe allergies 
SELECT p.first_name, p.last_name, a.allergy_type, a.severity
FROM Patients p
JOIN Allergies a ON p.patient_id = a.patient_id
WHERE a.severity = 'severe';

#Query to get the medication prescriptions for a patient as well as the status/condition of the medication
SELECT p.first_name, p.last_name, m.medication_name, m.dosage, m.prescribed_by, m.medi_condition 
FROM Medications m 
JOIN Patients p ON m.patient_id = p.patient_id 
WHERE m.medi_condition = 'active';

#Query to get the doctor who gave a specifc medication to a patient 
SELECT d.first_name, d.last_name, m.medication_name
FROM Doctors d
JOIN Medications m ON d.doctor_id = m.prescribed_by
JOIN Patients p ON m.patient_id = p.patient_id
WHERE p.first_name = 'Abigail' AND p.last_name = 'Kufuor'
  AND m.medication_name = 'Lisinopril';

#Query to find the patients that use insurance 
SELECT p.first_name, p.last_name, p.insurance_provider, p.insurance_policy_number
FROM Patients p
WHERE p.insurance_provider IS NOT NULL;

#Query to find the patients that use NHIS insurance
SELECT p.first_name, p.last_name, p.insurance_provider, p.insurance_policy_number
FROM Patients p
WHERE p.insurance_provider='NHIS';

#Query to find the patients that use nationwide insurance
SELECT p.first_name, p.last_name, p.insurance_provider, p.insurance_policy_number
FROM Patients p
WHERE p.insurance_provider='Nationwide';