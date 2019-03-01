<?php


class ControllerUser
{

    private $User;
    private $Session;

    function __construct($pdo)
    {
        $this->User = new User($pdo);
        $this->Session = new Session($pdo);
    }
    
    public function userOperations()
    {
        // удалить админа

        if (isset($_GET['deletedAdmin'])) {

            $deletedAdmin = $_GET['deletedAdmin'];

            $this->User->dellAdmin($deletedAdmin);
            $this->Session->smartHeader();


        }

        // измение пароля

        foreach ($_POST as $k => $v) {

            if (strpos($k, 'changedPassAdmin')) {
                
                $newPass = $v;
                $adminId = (int)$k;

                $this->User->newAdminPass($adminId, $newPass);
                $this->Session->smartHeader();
            }
        }
    }

}