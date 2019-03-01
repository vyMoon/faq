<?php

class ControllerFaq
{

    private $Faq;
    private $Session;
    

    function __construct($pdo)
    {
        $this->Faq = new Faq($pdo);
        $this->Session = new Session($pdo);
    }

    public function faqOperations()
    {

        // добавить вопрос

        if (isset($_POST['asking']) && isset($_POST['askingEmail']) && isset($_POST['themeId']) &&
        isset($_POST['question'])) {

            $email = trim($_POST['askingEmail'], " \t\n\r\0\x0B");
            $asking = trim($_POST['asking'], " \t\n\r\0\x0B");
            $themeId = $_POST['themeId'];
            $question = trim($_POST['question'], " \t\n\r\0\x0B");
            

            if ($asking !== '' && $email !== '' && $question !== "") {

                $this->Faq->addNewQuestion($asking, $email, $question, $themeId);

            }

            $this->Session->smartHeader();

        }


        //редактирование вопроса

        if (isset($_POST['correctedAuthor']) && isset($_POST['correctedQuestion']) 
        && isset($_POST['correctedAnswer']) && isset($_POST['correctedTheme']) 
        && isset($_COOKIE['question']) && !isset($_POST['publishing'])) {

            $id = $_COOKIE['question'];
            $theme = trim($_POST['correctedTheme'], " \t\n\r\0\x0B");
            $author = trim($_POST['correctedAuthor'], " \t\n\r\0\x0B");
            $answer = trim($_POST['correctedAnswer'], " \t\n\r\0\x0B");
            $question = trim($_POST['correctedQuestion'], " \t\n\r\0\x0B");
            
            if ($id !== '' && $author != '' && $question !== '' && $answer != "" && $theme !== '') {

                $this->Faq->correctedQuestion($id, $author, $question, $answer, $theme);
                $this->Session->smartHeader();

            }
        }


        //редактирование c публикацией вопроса

        if (isset($_POST['correctedAuthor']) && isset($_POST['correctedQuestion']) 
        && isset($_POST['correctedAnswer']) && isset($_POST['correctedTheme']) 
        && isset($_COOKIE['question']) && isset($_POST['publishing'])) {

            $id = $_COOKIE['question'];
            $theme = trim($_POST['correctedTheme'], " \t\n\r\0\x0B");
            $author = trim($_POST['correctedAuthor'], " \t\n\r\0\x0B");
            $answer = trim($_POST['correctedAnswer'], " \t\n\r\0\x0B");
            $question = trim($_POST['correctedQuestion'], " \t\n\r\0\x0B");

            if ($id !== '' && $author != '' && $question !== '' && $answer != "" && $theme !== '') {

                $this->Faq->correctingAndPublishingQuestion($id, $author, $question, $answer, $theme);
                $this->Session->smartHeader();

            }
        }


        // скрыть вопрос

        if (isset($_GET['unpublished'])) {

            $id = $_GET['unpublished'];
            $display = 0;

            $this->Faq->displayOnOff($id, $display);
            $this->Session->smartHeader();

        }


        // опубликовать вопрос

        if (isset($_GET['published'])) {

            $id = $_GET['published'];
            $display = 1;

            $this->Faq->displayOnOff($id, $display);
            $this->Session->smartHeader();

        }


        // удалить вопрос

        if (isset($_GET['dellQuestion'])) {

            $dellQuestion = $_GET['dellQuestion'];

            $this->Faq->dellQuestion($dellQuestion);
            $this->Session->smartHeader();

        }


        // быстрый ответ

        foreach ($_POST as $k => $v) {

            if (strpos($k, 'quickAnswer')) {

                $id = (int)$k;
                $answer = $v;

                $this->Faq->quickAnswer($id, $answer);

                if (isset($_POST['publishing'])) {

                    $id = (int)$k;
                    $display = 1;

                    $this->Faq->displayOnOff($id, $display);

                }

                $this->Session->smartHeader();

            }
        }
    }

}