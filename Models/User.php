<?php
namespace Models;

class User 
{    
    private $id;
    private $userName;
    private $password;
    private $admin;

    public function __construct ($userName, $password, $admin)
    {
        $this->SetUserName($userName);
        $this->SetPassword($password);
        $this->SetAdmin($admin);
    }

    public function GetId(){return $this->id;}
    public function GetUserName(){return $this->userName;}
    public function GetPassword(){return $this->password;}
    public function GetAdmin(){return $this->admin;}
    
    public function SetId($id){$this->id = $id;}
    public function SetUserName($userName){$this->userName = $userName;}
    public function SetPassword($password){$this->password = $password;}   
    public function SetAdmin($admin){$this->admin = $admin;}
}

?>