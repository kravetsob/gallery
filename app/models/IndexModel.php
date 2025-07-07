<?php

namespace app\models;


class IndexModel
{
    protected \mysqli $db;
    public function __construct()
    {
        try{
            $this->db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }catch (\mysqli_sql_exception $e){
            exit('DB connection error');
        }
    }

    /**
     * Return all photos from DB
     * @return array|bool
     */
    public function all(): array|bool
    {
        $statement = [];
        $query = "SELECT name FROM photos";
        $statement = $this->db->query($query);
        if($statement){
            return $statement->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    /**
     * Add file path into DB
     * @param $photo
     * @return bool
     */
    public function add($photo)
    {
        $query = "INSERT INTO photos (name) VALUES (?)";
        $prepared = $this->db->prepare($query);
        $prepared->bind_param('s', $photo);
        return $prepared->execute();
    }

}