
<?php 

class User{
    private $id;
    private $username;
    private $password;
    private $gender;
    private $email;
    private $phone;
    private $role;

    public function __construct($id, $username, $password, $gender, $email, $phone = null, $role = 'user'){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->gender = $gender;
        $this->email = $email;

        if($phone != null){
            $this->phone = $phone;
        }

        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getRole() {
        return $this->role;
    }

}

?>