DROP DATABASE IF EXISTS hospital_management;
CREATE DATABASE hospital_management;
USE hospital_management;

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name varchar(50) NOT NULL,
    last_name varchar(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    userrole ENUM('Nurse', 'Doctor') NOT NULL,
    user_department ENUM('Emergency department','Outpatient Department','Internal Medicine','Surgery Department','Pediatrics','Obstetrics and Gynecology','Pharmacy','Diagnostic Services'),
    license_number varchar(50) NOT NULL UNIQUE,
    username varchar(50) NOT NULL UNIQUE,
    user_password VARCHAR(50) NOT NULL,
    emergency_contact_name varchar(50) NOT NULL,
    emergency_contact_phone varchar(50) NOT NULL
);

CREATE TABLE Patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    `status` ENUM('inpatient', 'outpatient', 'discharged') NOT NULL,
    is_critical BOOLEAN DEFAULT FALSE,
    contact_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    emergency_contact_name VARCHAR(100) NOT NULL,
    emergency_contact_number VARCHAR(15) NOT NULL,
    insurance_provider VARCHAR(100),
    insurance_policy_number VARCHAR(50),
    admission_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE MedicalHistory (
    medical_history_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    condition_name VARCHAR(100) NOT NULL,
    diagnosis_date DATE NOT NULL,
    case_condition ENUM('active', 'resolved') NOT NULL,
    notes TEXT,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);

CREATE TABLE Allergies (
    allergy_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    allergy_type VARCHAR(100) NOT NULL,
    severity ENUM('mild', 'moderate', 'severe') NOT NULL,
    notes TEXT,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);

CREATE TABLE Departments (
    department_id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL
    
);

CREATE TABLE Doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, 
    specialization VARCHAR(100) NOT NULL,
    department_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES Departments(department_id) ON DELETE CASCADE
);


CREATE TABLE DoctorDepartment (
    department_id INT NOT NULL,
    doctor_id INT NOT NULL,
    is_head_doctor BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (department_id, doctor_id),
    FOREIGN KEY (department_id) REFERENCES Departments(department_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);

CREATE TABLE Medications (
    medication_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    medication_name VARCHAR(100) NOT NULL,
    dosage VARCHAR(50) NOT NULL,
    frequency VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    prescribed_by INT NOT NULL,
    medi_condition ENUM('active', 'discontinued') DEFAULT 'active',
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
    FOREIGN KEY (prescribed_by) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);

CREATE TABLE Appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    doctor_user_id INT NOT NULL, 
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    appoint_condition ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
    appointment_type VARCHAR(50) NOT NULL,
    notes TEXT,
    room_number VARCHAR(10),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_user_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);


CREATE TABLE Staff (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, 
    task TEXT NOT NULL,
    department_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES Departments(department_id) ON DELETE CASCADE
);


CREATE TABLE Vitals (
    vital_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    recorded_date DATETIME NOT NULL,
    blood_pressure VARCHAR(20),
    heart_rate INT,
    temperature DECIMAL(3,1),
    respiratory_rate INT,
    recorded_by INT NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
    FOREIGN KEY (recorded_by) REFERENCES Users(user_id) ON DELETE CASCADE
);


CREATE TABLE LabResults (
    lab_result_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    test_type VARCHAR(100) NOT NULL,
    test_date DATE NOT NULL,
    result TEXT NOT NULL,
    normal_range VARCHAR(100),
    performed_by INT NOT NULL,
    notes TEXT,
    FOREIGN KEY(performed_by) REFERENCES Staff(staff_id) ON DELETE CASCADE,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);

INSERT INTO Users (first_name, last_name, date_of_birth, gender, email, phone_number, address, userrole, user_department, license_number, username, user_password, emergency_contact_name, emergency_contact_phone) VALUES
('Kwame', 'Mensah', '1985-04-12', 'M', 'kwame.mensah@example.com', '+233244123456', 'Accra, Greater Accra Region', 'Doctor', 'Internal Medicine', 'GMC12345', 'kmensah', 'pass1234', 'Ama Mensah', '+233505678910'),
('Akosua', 'Osei', '1990-11-21', 'F', 'akosua.osei@example.com', '+233209876543', 'Kumasi, Ashanti Region', 'Nurse', 'Pediatrics', 'NMC56789', 'aosei', 'nursepass1', 'Yaw Osei', '+233240567890'),
('Kojo', 'Asare', '1982-07-05', 'M', 'kojo.asare@example.com', '+233501234567', 'Takoradi, Western Region', 'Doctor', 'Surgery Department', 'GMC98765', 'kasare', 'surgeon01', 'Efua Asare', '+233559876543'),
('Esi', 'Ankrah', '1995-03-15', 'F', 'esi.ankrah@example.com', '+233557123890', 'Cape Coast, Central Region', 'Nurse', 'Outpatient Department', 'NMC34567', 'eankrah', 'esiankrah', 'Kwesi Ankrah', '+233208765432'),
('Yaw', 'Boateng', '1987-08-09', 'M', 'yaw.boateng@example.com', '+233543210987', 'Tema, Greater Accra Region', 'Doctor', 'Emergency department', 'GMC11223', 'yboateng', 'doctor22', 'Akua Boateng', '+233501122334'),
('Abena', 'Badu', '1992-01-19', 'F', 'abena.badu@example.com', '+233502345678', 'Tamale, Northern Region', 'Nurse', 'Obstetrics and Gynecology', 'NMC33456', 'abadu', 'nurse02', 'Kwame Badu', '+233502223344');

INSERT INTO Patients (first_name, middle_name, last_name, date_of_birth, gender, `status`, contact_number, address, emergency_contact_name, emergency_contact_number, insurance_provider, insurance_policy_number) VALUES
('Kwabena', 'Sofo', 'Ansah', '1985-03-15', 'M', 'inpatient', '+233241234569', 'Adabraka, Accra', 'Akua Ansah', '+233241234570', 'NHIS', 'NHIS123456'),
('Maame','Akua', 'Mensah', '2000-07-22', 'F', 'inpatient', '+233551234569', 'Asylum Down, Accra', 'Yaw Mensah', '+233551234570', 'NHIS', 'NHIS789012'),
('Joel', 'Senam','Owusu', '1978-11-30', 'M', 'outpatient', '+233271234569', 'Kaneshie, Accra', 'Godfred Owusu', '+233271234570', NULL, NULL),
('Jonathan','Obed', 'Addo', '2005-04-18','M', 'inpatient', '+233541234569', 'Dansoman, Accra', 'Cosmos Addo', '+233541234570', 'Nationwide', 'N8886245136'),
('Joy','Charles', 'Amoah', '2003-09-25', 'F', 'inpatient', '+233201234569', 'East Legon, Accra', 'Jeremy Amoah', '+233201234570', 'NHIS', 'NHIS567890'),
('Akua','Jennifer', 'Tetteh', '1970-01-12', 'F', 'inpatient', '+233241234571', 'Labadi, Accra', 'Kojo Tetteh', '+233241234572', NULL, NULL),
('Kofi', 'Dwomoh','Asante', '2000-06-28', 'M', 'outpatient', '+233551234571', 'Osu, Accra', 'John Asante', '+233551234572', 'Nationwide', 'N7776214589'),
('Emelia','Ama', 'Boateng', '1992-12-05', 'F', 'discharged', '+233271234571', 'Tema, Greater Accra', 'Kwabena Boateng', '+233271234572', 'NHIS', 'NHIS456789'),
('Kwame','Ahene', 'Duah', '2001-08-20', 'M', 'inpatient', '+233541234571', 'Spintex, Accra', 'Jane Duah', '+233541234572', 'NHIS', 'NHIS012345'),
('Abigail','Ayeh', 'Kufuor', '2005-02-14', 'F', 'inpatient', '+233201234571', 'Airport Hills, Accra', 'Helena Kufuor', '+233201234572', 'Natiowide', 'N6662154789'),
('Yaw','Junior', 'Frimpong', '1993-05-08', 'M', 'outpatient', '+233241234573', 'Madina, Accra', 'Abena Frimpong', '+233241234574', 'NHIS', 'NHIS345678'),
('Grace','Koshi','Sarpong', '2017-10-17', 'F', 'discharged', '+233551234573', 'Adenta, Accra', 'Kwame Sarpong', '+233551234574', 'NHIS', 'NHIS901234'),
('Reina','Whyte', 'Agyeman', '2012-07-03', 'F', 'outpatient', '+233271234573', 'Achimota, Accra', 'Eugene Agyeman', '+233271234574', NULL, NULL),
('Janet', 'Akua','Poku', '2019-03-22', 'F', 'outpatient', '+233541234573', 'Tesano, Accra', 'Kofi Poku', '+233541234574', 'Nationwide', 'N5552178952'),
('Jennifer','Afua', 'Baah', '1976-12-09', 'F', 'inpatient', '+233201234573', 'Labone, Accra', 'David Baah', '+233201234574', 'NHIS', 'NHIS789012'),
('Joseph','Chichi', 'Nkrumah', '2021-09-14', 'M', 'discharged', '+233241234575', 'Cantonment, Accra', 'Comfort Nkrumah', '+233241234576', 'NHIS', 'NHIS456789'),
('Kwame','Sefakan', 'Appiah', '1994-04-28', 'M', 'inpatient', '+233551234575', 'Ridge, Accra', 'Nana Appiah', '+233551234576', 'Nationwide', 'N4443385621'),
('Paul', 'Obiri','Danso', '2000-11-07', 'M', 'outpatient', '+233271234575', 'Dansoman, Accra', 'Yaw Danso', '+233271234576', 'NHIS', 'NHIS678901'),
('Enock','Junior', 'Osei', '1989-06-19', 'M', 'inpatient', '+233541234575', 'Dzorwulu, Accra', 'Abena Osei', '+233541234576', 'NHIS', 'NHIS234567'),
('James','Cassy', 'Addo', '2001-01-25', 'M', 'discharged', '+233201234575', 'East legon, Accra', 'Tiffany Addo', '+233201234576', 'Nationwide', 'N3335566778'),
('Kwesi', 'Dampare','Agyei', '2003-08-11', 'M', 'inpatient', '+233241234577', 'Osu, Accra', 'James Agyei', '+233241234578', NULL, NULL),
('Abena', 'Tiffany','Opoku', '2022-03-30', 'F', 'outpatient', '+233551234577', 'Airport Hills, Accra', 'Emelia Opoku', '+233551234578', 'NHIS', 'NHIS123456'),
('Peniel','Akyireko', 'Mensah', '1982-10-16', 'F', 'inpatient', '+233271234577', 'Labone, Accra', 'Bernard Mensah', '+233271234578', 'NHIS', 'NHIS789012'),
('Salome','Baby', 'Owusu', '1990-05-23', 'F', 'inpatient', '+233541234577', 'Haatso, Accra', 'Kwesi Owusu', '+233541234578', 'Nationwide', 'N1114478956'),
('Prince', 'Kweku','Asamoah', '2014-12-08', 'M', 'discharged', '+233201234577', 'Dome, Accra', 'Anna Asamoah', '+233201234578', 'NHIS', 'NHIS901234'),
('Aikins', 'Ahene','Boateng', '2007-07-27', 'M', 'discharged', '+233241234579', 'Kwabenya, Accra', 'Yaw Boateng', '+233241234580', 'NHIS', 'NHIS678901'),
('Yaw','Junior', 'Antwi', '1992-02-13', 'M', 'discharged', '+233551234579', 'Madina, Accra', 'Godwin Antwi', '+233551234580', 'Nationwide', 'N2221144569');
SELECT * FROM Patients;


INSERT INTO MedicalHistory (patient_id, condition_name, diagnosis_date, case_condition, notes) VALUES
(1, 'Hypertension', '2024-01-15', 'active', 'Controlled with medication'),
(22, 'Type 2 Diabetes', '2024-11-20', 'active', 'Diet controlled'),
(7, 'Asthma', '2024-03-10', 'active', 'Mild intermittent'),
(10,'Migraine', '2024-02-05', 'active', 'Frequent episodes'),
(2, 'Arthritis', '2024-12-18', 'active', 'Affecting knee joints'),
(11, 'Anxiety Disorder', '2024-04-01', 'active', 'Under medication'),
(26, 'Breast cancer', '2024-01-30', 'active', 'Under treatment and might need surgery'),
(4, 'Lower Back Pain', '2024-10-15', 'resolved', 'Resolved with physiotherapy'),
(17, 'Headache', '2024-02-28', 'resolved', 'Resolved with medication'),
(20, 'Asthma', '2024-09-20', 'active', 'Mild intermittent');
SELECT * FROM MedicalHistory;



INSERT INTO Allergies (patient_id, allergy_type, severity, notes) VALUES
(1, 'Penicillin', 'severe', 'Anaphylactic reaction'),
(7, 'Peanuts', 'severe', 'Avoid all nut products'),
(14, 'Latex', 'moderate', 'Skin reaction'),
(11, 'Aspirin', 'mild', 'Causes mild rash'),
(21, 'Shellfish', 'severe', 'Immediate reaction'),
(4, 'Dust', 'moderate', 'Triggers asthma'),
(26, 'Sulfa Drugs', 'severe', 'Avoid all sulfa medications'),
(9, 'Dairy', 'mild', 'Lactose intolerance'),
(15, 'Bee Stings', 'severe', 'Carries EpiPen'),
(5, 'Dust', 'severe', 'Causes severe sneezing');
SELECT * FROM Allergies;


INSERT INTO Departments (department_name, location) VALUES
('Cardiology', 'Building A, Floor 2'),
('Pediatrics', 'Building B, Floor 1'),
('Orthopedics', 'Building A, Floor 3'),
('General Doctors', 'Building C, Floor 2'),
('Physiotherapy', 'Building A, Floor 1'),
('Internal Medicine','Building B Floor 2'),
('Surgery Department','Building B Floor 3'),
('Outpatient Department','Building C Floor 1'),
('Emergency Department','Buidling C Floor 3'),
('Obstetrics and Gynecology','Building A Floor 4');
SELECT * FROM Departments;



INSERT INTO Doctors (user_id, specialization, department_id) VALUES
(1, 'General Practictioner',4),
(3,'Lung Surgery',7),
(5,'Accident care',9);

SELECT * FROM Doctors;


INSERT INTO DoctorDepartment (department_id, doctor_id, is_head_doctor) VALUES
(9, 1, TRUE),  
(7, 3, TRUE),  
 
(4, 2, TRUE);
 
SELECT * FROM DoctorDepartment;





INSERT INTO Medications (patient_id, medication_name, dosage, frequency, start_date, end_date, prescribed_by, medi_condition) VALUES
(10,'Lisinopril', '10mg', 'Once daily', '2024-01-15', NULL, 1, 'active'),
(7, 'Metformin', '500mg', 'Twice daily', '2024-11-20', NULL, 1, 'active'),
(19,'Albuterol', '90mcg', 'As needed', '2024-03-10', NULL, 2, 'active'),
(4,'Sumatriptan', '50mg', 'As needed', '2024-02-05', NULL, 3, 'active'),
(20, 'Ibuprofen', '400mg', 'Three times daily', '2024-11-18', '2024-12-18', 3, 'discontinued'),
(17, 'Sertraline', '50mg', 'Once daily', '2024-04-01', NULL, 2, 'active'),
(1,'Cetirizine', '10mg', 'Once daily', '2024-01-30', NULL, 3, 'active'),
(2, 'Cyclobenzaprine', '10mg', 'Three times daily', '2024-10-15', '2025-01-15', 3, 'active'),
(5, 'Omeprazole', '20mg', 'Once daily', '2024-02-28', NULL, 1, 'discontinued'),
(12, 'Levothyroxine', '50mcg', 'Once daily', '2024-09-20', NULL, 1, 'active');
SELECT * FROM Medications;




INSERT INTO Appointments (patient_id, doctor_user_id, appointment_date, appointment_time, appoint_condition, appointment_type, notes, room_number) VALUES
(1, 1,'2024-01-15', '09:00:00', 'scheduled', 'Follow-up', 'Blood pressure check', 'R101'),
(4,2, '2024-01-15', '10:00:00', 'scheduled', 'Follow-up', 'Diabetes review', 'R102'),
(2, 1,'2024-01-15', '11:00:00', 'scheduled', 'Regular checkup', 'Asthma review', 'R201'),
(7, 3,'2024-01-16', '09:30:00', 'scheduled', 'Consultation', 'Migraine assessment', 'R301'),
(3, 3,'2024-01-16', '10:30:00', 'scheduled', 'Follow-up', 'Joint assessment', 'R103'),
(20, 2,'2024-01-16', '11:30:00', 'scheduled', 'Regular checkup', 'Anxiety review', 'R302'),
(17,3, '2024-01-17', '09:00:00', 'scheduled', 'Follow-up', 'Allergy assessment', 'R202'),
(26,1, '2024-01-17', '10:00:00', 'scheduled', 'Follow-up', 'Back pain review', 'R104'),
(27,1, '2024-01-17', '11:00:00', 'scheduled', 'Consultation', 'Gastritis follow-up', 'R105'),
(11, 1,'2024-01-18', '09:30:00', 'scheduled', 'Regular checkup', 'Thyroid review', 'R106');
SELECT * FROM Appointments;


INSERT INTO Staff (user_id, task, department_id) VALUES
(2, 'Check vitals', 1),
(3, 'Prescribe medication', 2),
(6, 'Administer injections', 3),
(2, 'Check sugar levels', 4),
(5, 'Perform eye exam', 5);

SELECT * FROM Staff;



INSERT INTO Vitals (patient_id, recorded_date, blood_pressure, heart_rate, temperature, respiratory_rate, recorded_by) VALUES
(1, '2024-01-15 09:15:00', '130/85', 72, 37.0, 16, 1),
(10, '2024-01-15 10:15:00', '125/82', 68, 36.8, 14, 1),
(13, '2024-01-15 11:15:00', '118/75', 75, 37.1, 18, 2),
(25, '2024-01-16 09:45:00', '120/80', 70, 36.9, 15, 2),
(19, '2024-01-16 10:45:00', '135/88', 73, 37.0, 16, 3),
(16, '2024-01-16 11:45:00', '122/78', 69, 36.7, 14, 3),
(7, '2024-01-17 09:15:00', '119/77', 71, 36.9, 15, 4),
(8, '2024-01-17 10:15:00', '128/84', 74, 37.2, 17, 4),
(21, '2024-01-17 11:15:00', '124/79', 72, 36.8, 15, 5),
(12, '2024-01-18 09:45:00', '126/83', 70, 37.0, 16, 5);
SELECT * FROM Vitals;




INSERT INTO LabResults (patient_id, test_type, test_date, result, normal_range, performed_by, notes) VALUES
(11, 'Complete Blood Count', '2024-01-15', 'WBC: 7.5, RBC: 4.8, Hgb: 14.2', 'WBC: 4.5-11.0, RBC: 4.2-5.4, Hgb: 13.0-17.0', 1, 'Within normal limits'),
(2, 'HbA1c', '2024-01-15', '6.8%', '4.0-5.6%', 1, 'Above normal range'),
(3, 'Spirometry', '2024-01-15', 'FEV1: 82% predicted', 'FEV1: >80% predicted', 5, 'Mild obstruction'),
(4, 'Basic Metabolic Panel', '2024-01-16', 'Na: 140, K: 4.0, Cl: 102', 'Na: 135-145, K: 3.5-5.0, Cl: 98-106', 2, 'Normal electrolytes'),
(20, 'X-Ray Knee', '2024-01-16', 'Mild joint space narrowing', 'N/A', 3, 'Early osteoarthritis changes'),
(14, 'Thyroid Panel', '2024-01-16', 'TSH: 2.8, T4: 1.2', 'TSH: 0.4-4.0, T4: 0.8-1.8', 1, 'Within normal limits'),
(17, 'IgE Levels', '2024-01-17', '180 IU/mL', '<100 IU/mL', 5, 'Elevated'),
(4, 'MRI Lumbar Spine', '2024-01-17', 'Mild disc bulge L4-L5', 'N/A', 1, 'Conservative treatment recommended'),
(9, 'H. pylori Test', '2024-01-17', 'Negative', 'Negative', 3, 'No H. pylori detected'),
(27, 'Lipid Panel', '2024-01-18', 'Total Chol: 185, LDL: 110, HDL: 45', 'Total Chol: <200, LDL: <130, HDL: >40', 4, 'Within normal limits');
SELECT * FROM LabResults;

DELETE FROM Patients WHERE patient_id = 1;
SELECT * FROM Patients;
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
WHERE a.doctor_user_id = 'D1' 
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
SELECT m.medication_name, p.first_name AS patient_first_name, p.last_name AS patient_last_name, d.doctor_id, u.first_name AS doctor_first_name, u.last_name AS doctor_last_name, u.email AS doctor_email
FROM Medications m
JOIN Patients p ON m.patient_id = p.patient_id
JOIN Doctors d ON m.prescribed_by = d.doctor_id
JOIN Users u ON d.user_id = u.user_id
WHERE m.medication_name = 'Lisinopril';


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