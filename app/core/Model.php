<?php

Trait Model {
    # This is how we use a trait.
    # A class can extend only one class at a time. But with traits, we can use multiple traits. A trait can't run on its own
    use Database;
    protected $limit        = 10;
    protected $offset       = 0;
    protected $order_type   = 'desc';
    protected $order_col    = 'id';
    public $errors          = [];

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

    public function findAll(){
        $query = "select * from $this->table order by $this->order_col $this->order_type limit $this->limit offset $this->offset";
       return $this->query($query); 
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
          # remove unwanted data
        if(!empty($this->allowedColumn)){
            foreach($data as $key => $val){
                if(!in_array($key, $this->allowedColumns)){
                    unset($data[$key]);
                }
            }
        }
         $keys = array_keys($data);
         $query = "Insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";
        //  show($query);

         $this->query($query, $data);
         
         return false;
    }

    public function update($id, $data, $id_column='id'){
        # remove unwanted data
        if(!empty($this->allowedColumn)){
            foreach($data as $key => $val){
                if(!in_array($key, $this->allowedColumns)){
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "Update $this->table set ";
        foreach($keys as $key){
            $query .= $key. "=:". $key . " , ";
        }
       $query = trim($query, " , ");
       $query .= " where $id_column = :$id_column";
       $data[$id_column] = $id;
    //    show($query);
       return $this->query($query, $data); 
    }

    public function delete($id, $id_column = 'id'){
        $data[$id_column] = $id;
        $query = "Delete from $this->table where $id_column = :$id_column";
        // show($query);

        $this->query($query, $data);

        return false;
    }
}