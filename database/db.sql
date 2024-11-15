-- Drop database if it exists
DROP DATABASE IF EXISTS hospital_management;
CREATE DATABASE hospital_management;
USE hospital_management;

-- Users table
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    userrole ENUM('Nurse', 'Doctor') NOT NULL,
    user_department ENUM('Emergency department','Outpatient Department','Internal Medicine','Surgery Department','Pediatrics','Obstetrics and Gynecology','Pharmacy','Diagnostic Services'),
    license_number VARCHAR(50) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    user_password VARCHAR(50) NOT NULL,
    emergency_contact_name VARCHAR(50) NOT NULL,
    emergency_contact_phone VARCHAR(50) NOT NULL
);

-- Patients table
CREATE TABLE Patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) DEFAULT 'done@gmail.com',
    date_of_birth DATE NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    marital_status ENUM('Married', 'Divorced', 'Single', 'Widowed') NOT NULL,
    blood_group ENUM('O', 'A', 'B', 'AB') NOT NULL,
    `status` ENUM('inpatient', 'outpatient', 'discharged') NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    admission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Medical History table
CREATE TABLE MedicalHistory (
    medical_history_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    condition_name VARCHAR(100) NOT NULL,
    diagnosis_date DATE NOT NULL,
    case_condition ENUM('active', 'resolved') NOT NULL,
    notes TEXT,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);

-- Allergies table
CREATE TABLE Allergies (
    allergy_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    allergy_type VARCHAR(100) NOT NULL,
    severity ENUM('mild', 'moderate', 'severe') NOT NULL,
    notes TEXT,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);

-- Departments table
CREATE TABLE Departments (
    department_id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL
);

-- Doctors table
CREATE TABLE Doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    specialization VARCHAR(100) NOT NULL,
    department_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES Departments(department_id) ON DELETE CASCADE
);

-- DoctorDepartment table
CREATE TABLE DoctorDepartment (
    department_id INT NOT NULL,
    doctor_id INT NOT NULL,
    is_head_doctor BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (department_id, doctor_id),
    FOREIGN KEY (department_id) REFERENCES Departments(department_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);

-- Medications table
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

-- Appointments table
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
    FOREIGN KEY (doctor_user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

-- Staff table
CREATE TABLE Staff (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    task TEXT NOT NULL,
    department_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES Departments(department_id) ON DELETE CASCADE
);

-- Vitals table
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

-- LabResults table
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

INSERT INTO Patients (first_name, middle_name, last_name, email, date_of_birth, gender, marital_status, blood_group, status, is_critical, contact_number, address) VALUES
('John', 'Michael', 'Doe', 'john.doe@example.com', '1990-05-15', 'M', 'Single', 'O', 'inpatient', TRUE, '1234567890', '123 Elm Street, Springfield'),
('Jane', NULL, 'Smith', 'jane.smith@example.com', '1985-10-20', 'F', 'Married', 'A', 'outpatient', FALSE, '0987654321', '456 Oak Avenue, Metropolis'),
('Mark', 'Anthony', 'Brown', 'mark.brown@example.com', '1978-01-12', 'M', 'Divorced', 'B', 'discharged', FALSE, '1122334455', '789 Pine Road, Gotham City'),
('Emily', 'Rose', 'Johnson', 'emily.johnson@example.com', '2000-09-08', 'F', 'Single', 'AB', 'inpatient', TRUE, '6677889900', '321 Maple Lane, Star City'),
('Alice', NULL, 'Williams', 'alice.williams@example.com', '1995-06-25', 'F', 'Widowed', 'O', 'outpatient', FALSE, '3344556677', '654 Cedar Street, Central City');

INSERT INTO MedicalHistory (patient_id, condition_name, diagnosis_date, case_condition, notes) VALUES
(1, 'Hypertension', '2024-01-15', 'active', 'Controlled with medication'),
(2, 'Type 2 Diabetes', '2024-11-20', 'active', 'Diet controlled'),
(3, 'Asthma', '2024-03-10', 'active', 'Mild intermittent'),
(4, 'Migraine', '2024-02-05', 'active', 'Frequent episodes'),
(5, 'Arthritis', '2024-12-18', 'active', 'Affecting knee joints');

INSERT INTO Allergies (patient_id, allergy_type, severity, notes) VALUES
(1, 'Penicillin', 'severe', 'Anaphylactic reaction'),
(2, 'Peanuts', 'severe', 'Avoid all nut products'),
(3, 'Latex', 'moderate', 'Skin reaction'),
(4, 'Aspirin', 'mild', 'Causes mild rash'),
(5, 'Shellfish', 'severe', 'Immediate reaction');

INSERT INTO Departments (department_name, location) VALUES
('Cardiology', 'Building A, Floor 2'),
('Pediatrics', 'Building B, Floor 1'),
('Orthopedics', 'Building A, Floor 3'),
('General Doctors', 'Building C, Floor 2'),
('Physiotherapy', 'Building A, Floor 1');

INSERT INTO Doctors (user_id, specialization, department_id) VALUES
(1, 'General Practitioner', 4),
(3, 'Lung Surgery', 3),
(5, 'Accident Care', 1);

INSERT INTO Medications (patient_id, medication_name, dosage, frequency, start_date, end_date, prescribed_by, medi_condition) VALUES
(1, 'Lisinopril', '10mg', 'Once daily', '2024-01-15', NULL, 1, 'active'),
(2, 'Metformin', '500mg', 'Twice daily', '2024-11-20', NULL, 3, 'active'),
(3, 'Albuterol', '90mcg', 'As needed', '2024-03-10', NULL, 2, 'active');

INSERT INTO Appointments (patient_id, doctor_user_id, appointment_date, appointment_time, appoint_condition, appointment_type, notes, room_number) VALUES
(1, 1, '2024-01-15', '09:00:00', 'scheduled', 'Follow-up', 'Blood pressure check', 'R101'),
(2, 3, '2024-01-16', '10:00:00', 'scheduled', 'Consultation', 'Diabetes review', 'R102'),
(3, 5, '2024-01-17', '11:00:00', 'scheduled', 'Routine', 'Asthma check', 'R103');
