<?php
 

namespace Models;

use libs\Database;

class Model {
    protected $db;
    
    function __construct() {
        $this->db = new Database();
    }

    function query($query) {
        return $this->db->connect()->query($query);
    }

    function prepare($query) {
        return $this->db->connect()->prepare($query);
    }
} 

?>

