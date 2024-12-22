<?php
class User
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create a new user
    public function createUser($matric, $name, $password, $role)
    {
        try {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssss", $matric, $name, $password, $role);
                $result = $stmt->execute();

                if ($result) {
                    $stmt->close();
                    return true;
                } else {
                    throw new Exception("Error: " . $stmt->error);
                }
            } else {
                throw new Exception("Error: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Read all users
    public function getUsers()
    {
        $sql = "SELECT matric, name, role FROM users";
        $result = $this->conn->query($sql);

        if ($result) {
            return $result;
        } else {
            throw new Exception("Error: " . $this->conn->error);
        }
    }

    // Read a single user by matric
    public function getUser($matric)
    {
        try {
            $sql = "SELECT * FROM users WHERE matric = ?";
            $stmt = $this->conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $matric);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                $stmt->close();
                return $user;
            } else {
                throw new Exception("Error: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Update a user's information
    public function updateUser($matric, $name, $role)
    {
        try {
            $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
            $stmt = $this->conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sss", $name, $role, $matric);
                $result = $stmt->execute();

                if ($result) {
                    $stmt->close();
                    return true;
                } else {
                    throw new Exception("Error: " . $stmt->error);
                }
            } else {
                throw new Exception("Error: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Delete a user by matric
    public function deleteUser($matric)
    {
        try {
            $sql = "DELETE FROM users WHERE matric = ?";
            $stmt = $this->conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $matric);
                $result = $stmt->execute();

                if ($result) {
                    $stmt->close();
                    return true;
                } else {
                    throw new Exception("Error: " . $stmt->error);
                }
            } else {
                throw new Exception("Error: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}