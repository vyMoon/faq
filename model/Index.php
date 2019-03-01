<?php

class Index
{

    private $faqClass;
    private $userClass;
    private $themeClass;
    private $sessionClass;
    private $ControllerUser;
    private $ControllerSession;

    function __construct($pdo)
    {
        
        $this->faqClass = new Faq($pdo);
        $this->userClass = new User($pdo);
        $this->themeClass = new Themes($pdo);
        $this->sessionClass = new Session($pdo);
        $this->ControllerUser = new ControllerUser($pdo);
        $this->ControllerSession = new ControllerSession($pdo);
        
    }

    public function display()
    {

        if (isset($_POST['loginLog']) && isset($_POST['passLog'])) {

            $passLog = !empty($_POST['passLog']) ? $_POST['passLog'] : '';
            $loginLog = !empty($_POST['loginLog']) ? $_POST['loginLog'] : '';
            
            $this->sessionClass->authorization($loginLog, $passLog);
        
        }

        if (isset($_POST['newAdmin']) && isset($_POST['newPass'])) {

            $newAdminPass = trim($_POST['newPass'], " \t\n\r\0\x0B");
            $newAdminLogin = trim($_POST['newAdmin'], " \t\n\r\0\x0B");
        
            if ($newAdminLogin !== '' && $newAdminPass !== '') {
        
                $this->userClass->addNewAdmin($newAdminLogin, $newAdminPass);
        
            }
        }

        
        if (!isset($_SESSION['id']) || !isset($_SESSION['user'])) {

            $messageLogin = $this->sessionClass->messageLogin;
            
            include "./view/login.php";
        
        } elseif (isset($_GET['display']) && $_GET['display'] == 'theme') {
        
            $themes = $this->themeClass->themes;
        
            if (isset($_GET['theme'])) {
        
                $themeName = $_GET['theme'];
                
                $this->sessionClass->setCoociePageNull();
                $this->sessionClass->setCookieGetThemeName($themeName);
                
            }
            
            $themeQuestions = $this->faqClass->getThemeQuestions($themeName); // считает колчиество вопросов без ответа. запуск этой функции должен быть выше присваивания значений переменных $hiden $published $nonAnswered
            $hiden = $this->faqClass->hiden;
            $published = $this->faqClass->published;
            $nonAnswered = $this->faqClass->nonAnswered;
        
            include "./view/theme.php";
        
        } elseif (isset($_GET['display']) && $_GET['display'] == 'question') {
        
            $this->sessionClass->setCoociePageNull();
        
            if (isset($_GET['question'])) {

                $questionId = $_GET['question'];

                $question = $this->faqClass->getQuestion($questionId);
                
                $this->sessionClass->setCookieQuestionId($questionId);
                
            }
        
            $themes = $this->themeClass->themes;

            include "./view/question.php";
        
        } elseif (isset($_GET['display']) && $_GET['display'] == 'faq') {
        
            $themes = $this->themeClass->themes;
            $questions = $this->faqClass->questions;

            $this->sessionClass->setCoociePageFaq();
            $this->sessionClass->setCookieGetNull();

            include "./view/faq.php";
        
        } else {

            $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

            $admins = $this->userClass->admins;
            $themes = $this->themeClass->getThemes();
            $message = $this->userClass->messageAddAdmin;
            $questions = $this->faqClass->questions;
            $nonAnswered = $this->faqClass->nonAnswered;

            $this->sessionClass->setCookieGetNull();
            $this->sessionClass->setCoociePageNull();

            include "./view/admin.php";
        }
    }
    
}