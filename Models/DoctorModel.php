<?php
require_once __DIR__ . '/../config/Database.php';

class DoctorModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection(); 
    }

    public function getAllDoctors() {
        $sql = "SELECT * FROM Doctors";
        $stmt = oci_parse($this->conn, $sql); 

        if (!$stmt) {
            $error = oci_error($this->conn);
            throw new Exception("SQL Parse Error: " . htmlentities($error['message'], ENT_QUOTES));
        }

        oci_execute($stmt); 

        $doctors = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $doctors[] = $row;
        }

        oci_free_statement($stmt);
        return $doctors;
    }

    public function getDoctorById($id) {
        $sql = "SELECT * FROM Doctors WHERE Doctor_Id = :id";
        $stmt = oci_parse($this->conn, $sql);

        oci_bind_by_name($stmt, ':id', $id);
        oci_execute($stmt);

        return oci_fetch_assoc($stmt);
    }

    public function addDoctor($data) {
        $sql = "INSERT INTO Doctors (Doctor_Id, Doctor_FullName, Doctor_Qualification, Doctor_Specification, Doctor_Contact, Doctor_Department, Hospital_Id) 
                VALUES (:id, :name, :qualification, :specification, :contact, :department, :hospital_id)";
        $stmt = oci_parse($this->conn, $sql);

        oci_bind_by_name($stmt, ':id', $data['id']);
        oci_bind_by_name($stmt, ':name', $data['name']);
        oci_bind_by_name($stmt, ':qualification', $data['qualification']);
        oci_bind_by_name($stmt, ':specification', $data['specification']);
        oci_bind_by_name($stmt, ':contact', $data['contact']);
        oci_bind_by_name($stmt, ':department', $data['department']);
        oci_bind_by_name($stmt, ':hospital_id', $data['hospital_id']);

        return oci_execute($stmt);
    }

    public function updateDoctor($data) {
        $sql = "UPDATE Doctors SET 
                    Doctor_FullName = :name, 
                    Doctor_Qualification = :qualification, 
                    Doctor_Specification = :specification, 
                    Doctor_Contact = :contact, 
                    Doctor_Department = :department, 
                    Hospital_Id = :hospital_id
                WHERE Doctor_Id = :id";
        $stmt = oci_parse($this->conn, $sql);

        oci_bind_by_name($stmt, ':id', $data['id']);
        oci_bind_by_name($stmt, ':name', $data['name']);
        oci_bind_by_name($stmt, ':qualification', $data['qualification']);
        oci_bind_by_name($stmt, ':specification', $data['specification']);
        oci_bind_by_name($stmt, ':contact', $data['contact']);
        oci_bind_by_name($stmt, ':department', $data['department']);
        oci_bind_by_name($stmt, ':hospital_id', $data['hospital_id']);

        return oci_execute($stmt);
    }

    public function deleteDoctor($id) {
        $sql = "DELETE FROM Doctors WHERE Doctor_Id = :id";
        $stmt = oci_parse($this->conn, $sql);

        oci_bind_by_name($stmt, ':id', $id);
        return oci_execute($stmt);
    }
}
?>
