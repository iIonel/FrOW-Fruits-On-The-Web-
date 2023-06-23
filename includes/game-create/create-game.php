    <?php

    require '../connection.php';
    session_start();

    function isNotEmpty($i){
        if(!empty($_POST['fruits'.$i]))
            return true;
        $GLOBALS['message'] = "Empty Fields!";
        return false;
    }

    function isIsset($i){
        if(isset($_POST['fruits'.$i]))
            return true;
        $GLOBALS['message'] =  "Doesn't set Fields!";
        return false;
    }

    $used = array();
    $generate = array();
    $fruits = file("fruits-names.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if(isset($_SESSION['round'])){
        $round = $_SESSION['round'];
        for($i = 1; $i <= $round; $i++){
            if(isNotEmpty($i) && isIsset($i))
                $used[] = $_POST['fruits'.$i];
            else
                header("Location: ../../finish.php?message=" . urlencode($GLOBALS['message']));
        }
        for($i = 0; $i < count($used); $i++){
            $ok = 0;
            $first;
            $second;
            while(!$ok){
                $first = array_rand($fruits);
                $second = array_rand($fruits);
                $ok1 = 1;
                for($j = 0; $j < count($used); $j++){
                    if($used[$j] == $fruits[$first] || $used[$j] == $fruits[$second])
                        $ok1 = 0;
                }
                $ok2 = 1;
                if(count($generate)){
                    for($j = 0; $j < count($generate); $j++){
                        if($generate[$j] == $first || $generate[$j] == $second || $fruits[$first] == $fruits[$second])
                            $ok2 = 0;
                    }
                }
                if($ok1 && $ok2)
                    $ok = 1;
            }
            $generate[] = $fruits[$first];
            $generate[] = $fruits[$second];
        }

        $image_paths = array();
        for($i = 0; $i < count($used); $i++)
            $image_paths[] = '../../images/game/'.strtolower($used[$i]).'.jpeg';


        $level;
        $time = $_SESSION['time'];
        $user_id = $_SESSION['id'];
        if($round == 3)
            $level = "easy";
        else if($round == 5)
            $level = "medium";
        else if($round == 7)
            $level = "hard";

        
        $sqlStatement = "INSERT INTO games (user_id, timer, level, rounds, users) VALUES ('$user_id', '$time', '$level', '$round', 0)";
        $result = mysqli_query($con,$sqlStatement);
        $gameId = $con ->insert_id;
        for($i = 1; $i <= $round; $i++){
            $correct = $used[$i-1];
            $incorrectfirst;
            $incorrectsecond;
            switch($i){
                case 1:
                    $incorrectfirst = $generate[0];
                    $incorrectsecond = $generate[1];
                    break;
                case 2:
                    $incorrectfirst = $generate[2];
                    $incorrectsecond = $generate[3];
                    break;
                case 3:
                    $incorrectfirst = $generate[4];
                    $incorrectsecond = $generate[5];
                    break;
                case 4:
                    $incorrectfirst = $generate[6];
                    $incorrectsecond = $generate[7];
                    break;
                case 5:
                    $incorrectfirst = $generate[8];
                    $incorrectsecond = $generate[9];
                    break;
                case 6:
                    $incorrectfirst = $generate[10];
                    $incorrectsecond = $generate[11];
                    break;
                case 7:
                    $incorrectfirst = $generate[12];
                    $incorrectsecond = $generate[13];
                    break;
            }

            $image = $image_paths[$i-1];
            $round_number = $i;
            
            $sqlStatement = "INSERT INTO rounds (game_id, round_number, answer, image_path) VALUES ('$gameId', '$round_number', '$correct', '$image')";
            $result = mysqli_query($con,$sqlStatement);
            $roundId = $con ->insert_id;

            $answers = array();
            $answers[] = $correct;
            $answers[] = $incorrectfirst;
            $answers[] = $incorrectsecond;
            shuffle($answers);

            $sqlStatement = "INSERT INTO answers (round_id, answer) VALUES ('$roundId', '$answers[0]')";
            $result = mysqli_query($con,$sqlStatement);

            $sqlStatement = "INSERT INTO answers (round_id, answer) VALUES ('$roundId', '$answers[1]')";
            $result = mysqli_query($con,$sqlStatement);

            $sqlStatement = "INSERT INTO answers (round_id, answer) VALUES ('$roundId', '$answers[2]')";
            $result = mysqli_query($con,$sqlStatement);
    
            unset($answers);
            header("Location: ../../create.php");
        }    
    }