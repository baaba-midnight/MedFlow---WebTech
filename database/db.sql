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
    contact_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    emergency_contact_name VARCHAR(100) NOT NULL,
    emergency_contact_number VARCHAR(15) NOT NULL,
    insurance_provider VARCHAR(100),
    insurance_policy_number VARCHAR(50)
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