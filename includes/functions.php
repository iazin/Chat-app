<?php
class ChatAppFunctions 
{
    private $db;

    public function __construct() 
    {
        $dbPath = '.\database\chat_app.db';
        $this->db = new SQLite3($dbPath);
    }

    public function register($username, $email, $password) 
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public function login($username, $password) 
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindValue(1, $username);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);
        if ($user && password_verify($password, $user['password'])) 
        {
            return $user;
        }
        return false;
    }

    public function isUserLoggedIn() 
    {
        if (isset($_SESSION['user_id'])) 
        {
            return true;
        } 
        return false;
    }
    
    public function getUserId($username) 
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bindValue(1, $username);
        $result = $stmt->execute();
        $user_id = $result->fetchArray(SQLITE3_NUM);
        return $user_id[0];
    }

    public function getUser($user_id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bindValue(1, $user_id);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function editUser($user_id, $username, $email, $password) 
    {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(4, $user_id);
        return $stmt->execute();
    }

    public function deleteUser($user_id) 
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bindValue(1, $user_id);
        return $stmt->execute();
    }

    public function createRoom($name) {
        $stmt = $this->db->prepare("INSERT INTO rooms (name) VALUES (?)");
        $stmt->bindValue(1, $name);
        return $stmt->execute();
    }
    
    public function getRooms() {
        $result = $this->db->query("SELECT * FROM rooms");
        $rooms = [];
        while ($room = $result->fetchArray(SQLITE3_ASSOC)) {
            $rooms[] = $room;
        }
        return $rooms;
    }
    
    public function postMessage($user_id, $room_id, $message) {
        $stmt = $this->db->prepare("INSERT INTO messages (user_id, room_id, message) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $user_id);
        $stmt->bindValue(2, $room_id);
        $stmt->bindValue(3, $message);
        return $stmt->execute();
    }
    
    public function getMessagesByRoom($room_id) {
        $stmt = $this->db->prepare("SELECT m.*, u.username FROM messages m JOIN users u ON m.user_id = u.id WHERE room_id = ? ORDER BY timestamp ASC");
        $stmt->bindValue(1, $room_id);
        $result = $stmt->execute();
        $messages = [];
        while ($message = $result->fetchArray(SQLITE3_ASSOC)) {
            $messages[] = $message;
        }
        return $messages;
    }

    function editMessage($message_id, $new_message, $user_id) {
        $stmt = $this->db->prepare("UPDATE messages SET message = ?, is_edited = TRUE WHERE id = ? AND user_id = ?");
        $stmt->bindValue(1, $new_message);
        $stmt->bindValue(2, $message_id);
        $stmt->bindValue(3, $user_id);   
        if ($stmt->execute()) {
            return 'Message updated successfully';
        } else {
            return 'Error updating message';
        }
    }

    function deleteMessage($message_id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM messages WHERE id = ? AND user_id = ?");
        $stmt->bindValue(1, $message_id);
        $stmt->bindValue(2, $user_id);
        if ($stmt->execute()) {
            return 'Message deleted successfully';
        } else {
            return 'Error deleting message';
        }
    }
}