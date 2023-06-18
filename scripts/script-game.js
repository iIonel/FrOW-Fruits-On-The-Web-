window.addEventListener('DOMContentLoaded', function() {
    // generate images
    const pictures =
    [
        ["","empty"]
        ["./images/game/banana.jpeg","Banana"],
        ["./images/game/watermelon.jpeg","Watermelon"],
        ["./images/game/plum.jpeg","Plum"],
        ["./images/game/mango.jpeg","Mango"],
        ["./images/game/kiwi.jpeg","Kiwi"],
        ["./images/game/apple.jpeg","Apple"],
        ["./images/game/grape.jpeg","Grape"],
        ["./images/game/coconut.jpeg","Coconut"],
        ["./images/game/lemon.jpeg","Lemon"],
    ];

    var index = generateNumber(1, pictures.length-1);
    var fruit = pictures[index][0];
    var fruitName = pictures[index][1];
    document.getElementById("photo").src = fruit;


    // timer
    var timeElement = document.querySelector('.time');
    var sec = 15;
    var secondsElement = document.createElement('h2');
    secondsElement.textContent =  sec + 's';
    timeElement.appendChild(secondsElement);
    var timer = setInterval(function() {
        sec--;
    
        if (!sec) {
          clearInterval(timer);
          timeElement.style.color = 'red'; 
          window.location.href = 'endgame.html';
        }
        secondsElement.textContent = sec + 's';
      }, 1000);

    // roundNo
    var roundNo = 1;
    var button = document.querySelector('.gameSection button');
    var round = document.querySelector('.round');
    var roundNow = document.createElement('h2');
    roundNow.textContent = roundNo + '/3';
    round.appendChild(roundNow);
    button.addEventListener('click',function(){
        roundNo++;
        if(roundNo > 3)
            window.location.href = 'endgame.html';    
        else{
            index = generateNumber(1, pictures.length-1);
            fruit = pictures[index][0];
            fruitName = pictures[index][1];
            document.getElementById("photo").src = fruit;
            roundNow.textContent = roundNo + '/3';
        }
    })


    function generateNumber(min, max){
        return Math.floor((Math.random() * (max - min + 1)) + min);
    }

});






