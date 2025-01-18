<?php

function main(): void{
    $db = \DB\sql::getInstance();
    if ($_REQUEST["quizzid"]){
        $glob = null;
        foreach ($db->getAllQuizzes() as $key => $value) {
            if ($value->getId() == $_REQUEST["quizzid"]){
                $masterquizz = $value;
                $glob = $value->getContent();
                break;
            }
        }
        if (!$glob){
            goto listing;
        }
        echo "<h1>QuizzOmat : ".$masterquizz->getName()."</h1>";
        echo "<form action='index.php' method='POST'>";
        echo (new \Form\Type\hidden(name:"action" , defaultValue: "quizz" , label:"action"))->render();
        echo (new \Form\Type\hidden(name:"quizzid" , defaultValue: $masterquizz->getId() , label:"quizzid"))->render();
        $score = count($glob);
        foreach ($glob as $file) {
            foreach ($file as $factory => $inps) {
                if (!array_key_exists("options", $inps)) {
                    $inps["options"] = array();
                }
                $correct = false;
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $correction = (new $factory(...$inps));
                    array_push($inps["options"],"disabled");
                    $inps["value"] = $_POST[$inps["name"]];
                    try {
                        $correct = $correction->is_correct(strval($_POST[$inps["name"]]));
                        if ($inps["required"]){
                        if ($correct) {
                            $inps["style"] = "color : green;";
                        } else {
                            $inps["style"] = "color : red;";
                            $score -= 1;
                        }}
                    } catch (\Throwable $th) {
                        echo $th->getMessage();
                        //throw $th;
                    }
                }
                echo "<div class='question ".($_SERVER["REQUEST_METHOD"] == "POST" && $correct ? " correct " : " incorrect ")."'>";
                // print_r(json_encode($inps));
                $tmp = (new $factory(...$inps));
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    if ($inps["required"]){
                        if ($correct){
                            echo "<p style='color : green;'>correct</p>";
                        } else {
                            echo "<p style='color : red;'>no</p>";
                        }
                    }
                }
                echo $tmp;
                echo "</div>";
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $db->addAnswer(new \DB\AnswerQuizz($_SESSION["user"]->getId(),$masterquizz->getId(),$score));
        }
        echo "</form>";
    } else {
listing:        
        echo "<h1>List des Quizz</h1>";
        echo "<ul>";
        foreach ($db->getAllQuizzes() as $key => $value) {
            echo "<li>";
            echo "<a href='index.php?action=quizz&quizzid="+$value->getId();
            echo "> QuizzOmat : "+$value->getName();
            $tmp = $db->getAnswers($value->getId());
            if ($tmp){
                echo "<div>";
                echo "Score : ";
                echo $tmp->getAnswer();
                echo "</div>";
            }
            echo "</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    
    
}
main();