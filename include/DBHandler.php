<?php
 
/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 */
class DbHandler {
 
    private $conn;
 
    function __construct() {
		require_once __DIR__ . '/DbConnect.php';
        //require_once dirname(__FILE__) . './DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
 
    /**
     * Fetching all user tasks
     * @param String $user_id id of the userS
     */
    public function getAllUserTasks() {
        $stmt = $this->conn->prepare("SELECT *FROM availablemenu");
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }
}
 
?>