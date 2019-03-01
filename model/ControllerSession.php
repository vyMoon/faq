<?php

class ControllerSession
{

    private $Session;

    function __construct($pdo)
    {
        $this->Session = new Session($pdo);
    }

    public function logout()
    {

        if (isset($_GET['destroy'])) {

            if ($_GET['destroy'] == 'session') {
    
                $this->Session->logout();

            }
        }
    }

}