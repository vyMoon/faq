<?php

class Faq
{
    
    public $allCount;
    public $nullAnswer;
    public $countPublished;

    public $hiden;
    public $published;
    public $nonAnswered;

    public $questions;

    private $pdo;

    function __construct($pdo)
    {
        
        $this->pdo = $pdo;

        $inquiry = "SELECT faq.*, themes.theme as theme
        FROM `faq` 
        LEFT JOIN themes ON faq.theme_id = themes.id
        ORDER BY date";
    
        $stmt = $pdo->prepare($inquiry);
        $stmt -> execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->questions = $questions;

        $this->nonAnswered = 0;
    
        foreach ($questions as $question) {
            if ($question['answer'] == null) {
    
                $this->nonAnswered++;
    
            }
        }
    
    }


    public function addNewQuestion($asking, $email, $question, $themeId)
    {

        $pdo = $this->pdo;
        $inquiry = "INSERT INTO faq (theme_id, question, author, email) 

        VALUES (:themeId, :question, :author, :email)";
        $stmt = $pdo->prepare($inquiry);
        $stmt->execute([
            "themeId" => $themeId,
            "question" => $question,
            "author" => $asking,
            "email" => $email
        ]);
    }


    public function correctedQuestion($id, $author, $question, $answer, $theme)
    {
        
        $pdo = $this->pdo;
        $inquiry = "UPDATE faq SET 
        author = :author, 
        question = :question, 
        answer = :answer, 
        theme_id = :theme 
        WHERE id = :id";

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute([
            "author" => $author,
            "question" => $question,
            "answer" => $answer,
            "theme" => $theme,
            "id" => $id
        ]);
    }
    

    public function correctingAndPublishingQuestion($id, $author, $question, $answer, $theme)
    {
        
        $pdo = $this->pdo;
        $inquiry = "UPDATE faq SET 
        author = :author, 
        question = :question, 
        answer = :answer, 
        theme_id = :theme, 
        display = 1 
        WHERE id = :id";
    
        $stmt = $pdo->prepare($inquiry);
        $stmt->execute([
            "author" => $author,
            "question" => $question,
            "answer" => $answer,
            "theme" => $theme,
            "id" => $id
        ]);
    
    }


    public function dellQuestion($dellQuestion)
    {
        $pdo = $this->pdo;
        $inquiry = 'DELETE FROM faq WHERE id = :id';

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute(["id" => $dellQuestion]);
    }


    public function dellQuestionOnThemeId($dellTheme)
    {
        $pdo = $this->pdo;
        $inquiry = 'DELETE FROM faq WHERE theme_id = :value';

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute(["value" => $dellTheme]);
    }


    public function displayOnOff($id, $display)
    {
        $pdo = $this->pdo;
        $inquiry = "UPDATE faq SET display = :display WHERE id = :id";

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute([
            "display" => $display,
            "id" => $id
        ]);
    }


    public function quickAnswer($id, $answer)
    {
        $pdo = $this->pdo;
        $inquiry = "UPDATE faq SET answer = :answer WHERE id = :id";

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute([
            "answer" => $answer,
            "id" => $id
        ]);
    }


    public function countQuestion($themeId)
    {
        $pdo = $this->pdo;
        $inquiry = "SELECT answer, COUNT(*) FROM faq  WHERE theme_id = :val GROUP BY answer";

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute(["val" => $themeId]);

        $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $yesAnswer = 0;
        $this->allCount = 0;
        $this->nullAnswer = 0;
        $this->countPublished = 0;

        foreach ($count as $val) {

            if ($val['answer'] == null) {

                $this->nullAnswer += $val['COUNT(*)'];

            } else {

                $yesAnswer += $val['COUNT(*)'];

            }
        }

        $this->allCount = $this->nullAnswer + $yesAnswer;

        $inquiry = "SELECT display, COUNT(*) FROM faq  WHERE theme_id = :val GROUP BY display";

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute(["val" => $themeId]);
        $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($count as $val) {
            if ($val['display'] == 1) {

                $this->countPublished += $val['COUNT(*)'];

            }
        }

    }


    public function getThemeQuestions($themeName)
    {
        $pdo = $this->pdo;
        $inquiry = "SELECT faq.*, themes.theme as theme
        FROM `faq` 
        LEFT JOIN themes ON faq.theme_id = themes.id
        WHERE theme = :theme
        ORDER BY date";
    
        $stmt = $pdo->prepare($inquiry);
        $stmt -> execute(["theme" => $themeName]);
        $themeQuestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $this->hiden = 0;
        $this->published = 0;
        $this->nonAnswered = 0;
    
        foreach ($themeQuestions as $question) {
            if ($question['answer'] == null) {
    
                $this->nonAnswered++;
    
            }
            if ($question['answer'] !== null && $question['display'] == 0) {
    
                $this->hiden++;
    
            }
            if ($question['answer'] !== null && $question['display'] == 1) {
    
                $this->published++;
    
            }
        }

        return $themeQuestions;

    }


    public function getQuestion($questionId)
    {
        $pdo = $this->pdo;
        $inquiry = "SELECT faq.*, themes.theme as theme
        FROM `faq` 
        LEFT JOIN themes ON faq.theme_id = themes.id
        WHERE faq.id = :id";
    
        $stmt = $pdo->prepare($inquiry);
        $stmt -> execute(["id" => $questionId]);
        $question = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $question;
    }

}