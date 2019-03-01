<?php

class User
{

    public $admins;
    private $pdo;
    private $Session;
    public $messageAddAdmin = 'Для создания нового администратора введите логин нового администратора и пароль.';

    function __construct($pdo)
    {

        $this->pdo = $pdo;

        $this->Session = new Session($pdo);

        $inquiry = "SELECT * FROM user";

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute();
        $this->admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function addNewAdmin($newAdminLogin, $newAdminPass)
    {

        $pdo = $this->pdo;
        $inquiry = "SELECT login, COUNT(*) FROM user WHERE login = :login";

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute(["login" => $newAdminLogin]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result[0]['COUNT(*)'] == 0) {
            
            $inquiry = "INSERT INTO user (login, password) VALUES ('$newAdminLogin', '$newAdminPass')";

            $stmt = $pdo->prepare($inquiry);
            $stmt->execute();

            $this->Session->smartHeader();

        } else {

            $this->messageAddAdmin = 'Пользователь c логином '.$newAdminLogin.' существует выберете другой логин.';

        }
    }


    public function dellAdmin($deletedAdmin)
    {
        
        $pdo = $this->pdo;
        $inquiryDell = "DELETE FROM user WHERE id = :dell";

        $stmt = $pdo->prepare($inquiryDell);
        $stmt -> execute(["dell" => $deletedAdmin]);
    
    }


    public function newAdminPass($adminId, $newPass)
    {
        
        $pdo = $this->pdo;
        $inquiry = "UPDATE user SET password = :newPass WHERE id = :id";

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute([
            "newPass" => $newPass, 
            "id" => $adminId
        ]);
    }

}