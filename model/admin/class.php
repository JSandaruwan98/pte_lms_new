<?php

class ClassModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function getClass() {

        $sql = "SELECT * FROM class";
        $stmt = $this->conn->query($sql);
        $data = array();
        
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $data;
        
    }

//===============================================================================================================================================

    

}
?>
