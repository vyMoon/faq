<?php

class ControllerTheme
{

    private $Faq;
    private $Themes;
    private $Session;

    function __construct($pdo)
    {

        $this->Faq = new Faq($pdo);
        $this->Themes = new Themes($pdo);
        $this->Session = new Session($pdo);
        
    }

    public function themeOperations() 
    {
        // созданиеновой темы

        if (isset($_POST['newTheme'])) {

            $newTheme = $_POST['newTheme'];
            $newTheme = trim($_POST['newTheme'], " \t\n\r\0\x0B");

            if ($newTheme !== '') {

                $this->Themes->addNewTheme($newTheme);
        
            }

            $this->Session->smartHeader();

        }

        // удалить тему и все впоросы в ней

        if (isset($_GET['dellTheme'])) {

            $dellTheme = $_GET['dellTheme'];
            
            $this->Faq->dellQuestionOnThemeId($dellTheme);
            $this->Themes->dellTheme($dellTheme);
            $this->Session->smartHeader();
            
        }
    }

}