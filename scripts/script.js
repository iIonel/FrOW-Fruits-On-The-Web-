window.addEventListener('DOMContentLoaded', function() {

    //take response from server
    const url = new URLSearchParams(this.window.location.search);
    const jsonResponse = url.get('response');
    const response = JSON.parse(jsonResponse);

    if(response){
        var game = response[0];
        var timer = game.timer;
        var level = game.level;
        var players = game.users;
        var rounds = game.rounds;
    }   

    // timer
    var timeElement = document.querySelector('.time');
    var sec = timer;
    var secondsElement = document.createElement('h2');
    secondsElement.textContent =  sec + 's';
    timeElement.appendChild(secondsElement);
    var timer = setInterval(function() {
        sec--;
    
        if (!sec) {
          clearInterval(timer);
          timeElement.style.color = 'rgb(255, 145, 0)'; 
          var url = 'endgame.php?gameId=' + game.id + '&score=' + finalscore + '&difficulty=' + level + '&players=' + players;
          window.location.href = url;
        }
        secondsElement.textContent = sec + 's';
      }, 1000);

    // roundNo
    var roundNo = 1;
    var answerPhoto = rounds[roundNo-1].image.substring(4);
    document.getElementById("photo").src = answerPhoto;

    var button0 = document.querySelector('#btn0');
    var button1 = document.querySelector('#btn1');
    var button2 = document.querySelector('#btn2');
    var answers = rounds[roundNo-1].answers;

    button0.textContent = answers[0].answer;
    button1.textContent = answers[1].answer;
    button2.textContent = answers[2].answer;

    var round = document.querySelector('.round');
    var roundNow = document.createElement('h2');
    roundNow.textContent = roundNo + '/' + rounds.length;
    round.appendChild(roundNow);

    var perfect = 1;
    var correct;
    var finalscore = 0;
    button0.addEventListener('click', function() {
        correct = rounds[roundNo-1].answer;
        roundNo++;
    
        if(button0.textContent != correct){
            perfect = 0;
        }

        if (roundNo > rounds.length) {
            if(perfect == 1){
                if(level == "easy")
                    finalscore = 1000;
                else if(level == "medium")
                    finalscore = 2000;
                else finalscore = 3000;
            }
            else 
                finalscore = 0;
            var url = 'endgame.php?gameId=' + game.id + '&score=' + finalscore + '&difficulty=' + level + '&players=' + players;
            window.location.href = url;
        } else {
            answerPhoto = rounds[roundNo - 1].image.substring(4);
            document.getElementById("photo").src = answerPhoto;
            answers = rounds[roundNo - 1].answers;

            button0.textContent = answers[0].answer;
            button1.textContent = answers[1].answer;
            button2.textContent = answers[2].answer;

            roundNow.textContent = roundNo + '/' + rounds.length;
        }
    });

    button1.addEventListener('click', function() {
        correct = rounds[roundNo-1].answer;
        roundNo++;

        if(button1.textContent != correct){
            perfect = 0;
        }

        if (roundNo > rounds.length) {
            if(perfect == 1){
                if(level == "easy")
                    finalscore = 1000;
                else if(level == "medium")
                    finalscore = 2000;
                else finalscore = 3000;
            }
            else 
                finalscore = 0;
            var url = 'endgame.php?gameId=' + game.id + '&score=' + finalscore + '&difficulty=' + level + '&players=' + players;
            window.location.href = url;
        } else {
            answerPhoto = rounds[roundNo - 1].image.substring(4);
            document.getElementById("photo").src = answerPhoto;
            answers = rounds[roundNo - 1].answers;

            button0.textContent = answers[0].answer;
            button1.textContent = answers[1].answer;
            button2.textContent = answers[2].answer;

            roundNow.textContent = roundNo + '/' + rounds.length;
        }
    });

    button2.addEventListener('click', function() {
        correct = rounds[roundNo-1].answer;
        roundNo++;

        if(button2.textContent != correct){
            perfect = 0;
        }

        if (roundNo > rounds.length) {
            if(perfect == 1){
                if(level == "easy")
                    finalscore = 1000;
                else if(level == "medium")
                    finalscore = 2000;
                else finalscore = 3000;
            }
            else 
                finalscore = 0;
            var url = 'endgame.php?gameId=' + game.id + '&score=' + finalscore + '&difficulty=' + level + '&players=' + players;
            window.location.href = url;
        } else {
            answerPhoto = rounds[roundNo - 1].image.substring(4);
            document.getElementById("photo").src = answerPhoto;
            answers = rounds[roundNo - 1].answers;

            button0.textContent = answers[0].answer;
            button1.textContent = answers[1].answer;
            button2.textContent = answers[2].answer;

            roundNow.textContent = roundNo + '/' + rounds.length;
        }
    });
});