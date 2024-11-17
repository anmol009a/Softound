<?php
class Student
{
    private $conn;
    private $table = 'students';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addStudent($name, $address, $marks)
    {
        $query = "INSERT INTO " . $this->table . " (parent_id, `key`, `value`) VALUES 
                  (:parent_id, 'name', :name),
                  (:parent_id, 'address', :address),
                  (:parent_id, 'marks', :marks)";

        $stmt = $this->conn->prepare($query);

        // Sanitize input and bind parameters
        $parent_id = $this->getNewParentId();
        $name = htmlspecialchars(strip_tags($name));
        $address = htmlspecialchars(strip_tags($address));
        $marks = htmlspecialchars(strip_tags($marks));

        $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':marks', $marks, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    private function getNewParentId()
    {
        $query = "SELECT MAX(parent_id) AS max_id FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['max_id'] + 1;
    }

    public function getStudents()
    {
        $query = "SELECT 
                    parent_id AS student_id,
                    MAX(CASE WHEN `key` = 'name' THEN `value` END) AS name,
                    MAX(CASE WHEN `key` = 'address' THEN `value` END) AS address,
                    MAX(CASE WHEN `key` = 'marks' THEN `value` END) AS marks
                FROM 
                    students
                GROUP BY 
                    parent_id;
                ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $students;
    }

    public function findStudentsByMarks($marks)
    {
        $query = "SELECT 
                    parent_id AS student_id, 
                    MAX(CASE WHEN `key` = 'name' THEN `value` END) AS name, 
                    MAX(CASE WHEN `key` = 'address' THEN `value` END) AS address, 
                    MAX(CASE WHEN `key` = 'marks' THEN `value` END) AS marks 
                FROM 
                    students 
                GROUP BY 
                    parent_id 
                HAVING 
                    MAX(CASE WHEN `key` = 'marks' THEN `value` END) = :marks;
                ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':marks', $marks, PDO::PARAM_STR);
        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $students;
    }
}
