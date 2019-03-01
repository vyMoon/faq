<?php

class Session
{

    public $id;
    public $user;
    public $messageLogin = 'Для авторизации введите логин и пароль';

    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function authorization($loginLog, $passLog)
    {
        $pdo = $this->pdo;
        $inquiry = "SELECT * FROM user WHERE login = :login";
        
        $stmt = $pdo->prepare($inquiry);
        $stmt->execute(["login" => $loginLog]);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($result[0] !== null) {

            if ($loginLog == $result[0]['login'] && $passLog == $result[0]['password']) {
    
                $_SESSION['id'] = $result[0]['id'];
                $_SESSION['user'] = $result[0]['login'];
    
            } else {
    
                $this->messageLogin = "Вы ввели неверные данные";
    
            }
                
        } else {
    
            $this->messageLogin = "Вы ввели неверные данные";
    
        }
    }


    public function session()
    {
    
        if (!isset($_SESSION['id']) || !isset($_SESSION['user'])) {
    
            return false;
    
        }

        if (isset($_SESSION['id']) || isset($_SESSION['user'])) {
    
            $this->id = !empty($_SESSION['id']) ? $_SESSION['id'] : '';
            $this->user = !empty($_SESSION['user']) ? $_SESSION['user'] : '';

            return true;
    
        }
    }
    

    public function setCookieGetNull()
    {
        setcookie('get', null);
    }


    public function setCookieGetThemeName($themeName)
    {
        setcookie('get', $themeName);
    }


    public function setCoociePageFaq()
    {
        setcookie('page', '?display=faq');
    }


    public function setCoociePageNull()
    {
        setcookie('page', null);
    }


    public function setCookieQuestionId($questionId)
    {
        setcookie('question', $questionId);
    }


    public function logout()
    {
        session_destroy();
        header('location: ../index.php');
    }


    public function goToFaq()
    {
        header('location: faq.php');
        exit;
    }


    public function smartHeader()
    {
        $goTo = '../index.php';
        
        if (isset($_COOKIE['page'])) {
    
            $goTo .= $_COOKIE['page'];
            setcookie('page', null);

        }
    
        if (isset($_COOKIE['get'])) {

            $goTo .= '?display=theme&theme='.$_COOKIE['get'];
            setcookie('get', null);
    
        }
    
        header("location: $goTo");
        exit;
    
    }

}