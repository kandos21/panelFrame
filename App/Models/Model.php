<?php

namespace App\Models;

use mysqli;

class Model
{
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;
    protected $connection;
    protected $query;
    protected $table;

    public function __construct()
    {
        $this->connection();
    }



    public function connection()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if ($this->connection->connect_error) {
            die('Error en conexion' . $this->connection->connect_error);
        }
    }

    public function query($sql, $data = [], $params = null) //realizar la  consulta
    {
        if ($data) {
            if ($params == null) {
                $params = str_repeat('s', count($data));
            }
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param($params, ...$data);
            $stmt->execute();
            $this->query = $stmt->get_result();

            var_dump($this);
        } else {
            $this->query = $this->connection->query($sql);
        }

        return $this;
    }

    public function first() //regresa solo un registro
    {
        return $this->query->fetch_assoc();
    }

    public function get() //regresa todos los registros de la consulta
    {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }


    //consultas preparadas

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->get();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} where id_{$this->table} =?";
        return $this->query($sql, [$id], 'i')->first();
    }

    public function where($column, $operator, $value = null)
    {
        if ($value == null) {
            $value = $operator;
            $operator = "=";
        }
        //  $this->connection->real_escape_string($value);
        $sql = "SELECT * FROM {$this->table} where {$column} {$operator} ? ";
        $this->query($sql, [$value], 's');
        /* $stmt =$this->connection->prepare($sql);
        $stmt->bind_param('s',$value);
        $stmt->execute();
       $this->query= $stmt->get_result();*/
        return $this;
    }

    public function ultimateR()
    {
        $sql="SELECT * FROM {$this->table} ORDER by id_{$this->table} ASC LIMIT 1";
        return $this->query($sql);
    }

    public function create($data)
    {   
        $columns = array_keys($data); //creamos un array apartir del array de $data tomando solo los valores de key
        $columns = implode(', ', $columns); //unimos todos los valores de $columns en una sola cadena separadas pro comas
        
        $values = array_values($data); //creamos un array apartir del array $data tomando solo los values del array
        // $values = "'" . implode("', '", $values) . "'"; //unimos todos los valores en un sola cadena separadas como  comillas simples
        $sql = "INSERT INTO {$this->table}({$columns})values(" . str_repeat('?,', count($values) - 1) . "?);";  // damos forma a la consulta  llamando a la tabla,columnas y valores
        $this->query($sql, $values);
        $insert_id = $this->connection->insert_id; // obtenemos el ultimo id que se inserto
        return $this->find($insert_id); //obtenemos todos los datos del ultimo id que se inserto

    }

    public function update($id, $data)
    {
        $fields = []; //declaramos una array
        foreach ($data as $key => $value) { //se obtinen los valores de data 
            $fields[] = "{$key}= ? "; //toda ina informacion de data se almacena en el arregro fields
        }
       
        $fields = implode(', ', $fields); //le agreganos una , a cada campo
        $sql = "UPDATE {$this->table} SET {$fields} where id_{$this->table}=?";
        
        $values=array_values($data); //devuelve todos los valores del array array e indexa numéricamente el array.
        
        $values[]=$id;    
        $this->query($sql,$values);
        return $this->find($id);
    }


    public function delete($id)
    {
        $sql = "DELETE  FROM {$this->table} where id_{$this->table}=?";
        
        $this->query($sql,[$id],'i');//mandamos la consulta,junto con el id  y el parametro a evaluar "intenger"
    }
}
