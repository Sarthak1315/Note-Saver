<?php
class con
{
    private $host = ""; // localhost
    private $user = ""; //user
    private $pas = ""; //pass
    private $db = ""; //db
       public $c;
    public function __construct()
    {
        $this->c = mysqli_connect($this->host, $this->user, $this->pas, $this->db);
        if ($this->c == null) {
            die("Can not connect.");
        }
    }
   

    function search($data_key){
        $search = "SELECT * FROM data WHERE data_key = '$data_key';";
        $result=$this->c->query($search);
        if($result->num_rows>0){
            return $result;
        }
        else{
            return false;
        }
    }
    function up($data_key,$data_val){
        $up = "UPDATE data SET data_value='".$data_val."' WHERE data_key = '".$data_key."'";
        $r = $this->c->query($up);
        return $r;
    }
    function inst($data_key,$data_val){
        $insert_comp="INSERT INTO data values ('','".$data_key."','".$data_val."');";
        $i_r = $this->c->query($insert_comp);
       
        return $i_r;
    }
    function del($i){
        $del = "DELETE FROM data WHERE data_key ='".$i."';";
        $r = $this->c->query($del);
        return $r;
    }
}
?>