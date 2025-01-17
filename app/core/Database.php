<?php

Trait Database{

    private function connect_PDO(){
        $conn = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS);
        # Setting the attribute to return the error from DB:
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    private function connect_mysqli(){
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        return $conn;
    }

    public function query($query, $data=[]){
        echo $query;
        $conn = $this->connect_PDO();
        $stmt = $conn->prepare($query);
        $check = $stmt->execute($data);
        if($check){
            $result = $stmt->fetchAll((PDO::FETCH_ASSOC));
            if(is_array($result) && count($result)){
                return $result;
            }
        }
        return false;
    }

    public function get_row($query, $data=[]){
        echo $query;
        $conn = $this->connect_PDO();
        $stmt = $conn->prepare($query);
        $check = $stmt->execute($data);
        if($check){
            $result = $stmt->fetchAll((PDO::FETCH_ASSOC));
            if(is_array($result) && count($result)){
                return $result[0];
            }
        }
        return false;
    }
}