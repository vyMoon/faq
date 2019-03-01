<?php

class Themes
{

    public $themes;
    private $pdo;

    function __construct($pdo)
    {

        $this->pdo = $pdo;

        $inquiry = "SELECT * FROM themes";
        $stmt = $pdo->prepare($inquiry);
        $stmt->execute();
        $this->themes=$stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function getThemes()
    {
        $inquiry = "SELECT * FROM themes";
        $pdo = $this->pdo;

        $stmt = $pdo->prepare($inquiry);
        $stmt->execute();
        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $themes;
    }


    public function addNewTheme($newTheme)
    {
        $pdo = $this->pdo;

        $inquiry = "INSERT INTO themes (theme) VALUES (:theme)";
        $stmt = $pdo->prepare($inquiry);
        $stmt->execute(["theme" => $newTheme]);

    }


    public function dellTheme($dellTheme)
    {

        $pdo = $this->pdo;
    
        $inquiry = 'DELETE FROM themes WHERE id = :value';
        $stmt = $pdo->prepare($inquiry);
        $stmt->execute([
            "value" => $dellTheme
        ]);
    }

}