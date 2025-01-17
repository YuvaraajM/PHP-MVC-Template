<?php

class Model {
    # This is how we use a trait.
    # A class can extend only one class at a time. But with traits, we can use multiple traits. A trait can't run on its own
    use Database;
    protected $table = 'feedback';
    protected $limit = 10;
    protected $offset = 0;
    
    # Returns multiple rows
    public function where($data, $data_not = []){
        // $query = "Select * from feedback where id = :id";
        // $this->query($query, ['id'=>1]);
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach($keys as $key){
            $query .= $key. "=:". $key . " && ";
        }
         foreach($keys_not as $key){
            $query .= $key. "!=:". $key . " && ";
        }
       $query = trim($query, " && ");
       $query .= " limit $this->limit offset $this->offset";
       $data = array_merge($data, $data_not);
       return $this->query($query, $data); 
   }

   # Returns one row
   public function first($data, $data_not = []){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach($keys as $key){
            $query .= $key. "=:". $key . " && ";
        }
         foreach($keys_not as $key){
            $query .= $key. "!=:". $key . " && ";
        }
       $query = trim($query, " && ");
       $query .= " limit $this->limit offset $this->offset";
       $data = array_merge($data, $data_not);
       $result = $this->query($query, $data);
       if($result)  
        return $result[0];
       else 
        return false; 
   }

    public function insert($data){

    }

    public function update($id, $data, $id_column='id'){

    }

    public function delete($id, $id_column = 'id'){

    }
}