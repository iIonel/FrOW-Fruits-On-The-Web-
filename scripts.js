var guests =[];
var scores =[];
var yourScore = 0;
var rounds = 0;
var roundNo = 0;
var yourPoints = 0;
var fruit,fruitName;
var btnAux1,btnAux2,btnGood;
var fakers =[];

const pictures =
[
    ["","empty"]
    ["../assets/images/banana.jpeg","Banana"],
    ["../assets/images/watermelon.jpeg","Watermelon"],
    ["../assets/images/plum.jpeg","Plum"],
    ["../assets/images/mango.jpeg","Mango"],
    ["../assets/images/kiwi.jpeg","Kiwi"],
    ["../assets/images/apple.jpeg","Apple"],
    ["../assets/images/grape.jpeg","Grape"],
    ["../assets/images/coconut.jpeg","Coconut"],
    ["../assets/images/Lemon.jpeg","Lemon"],
];

setInterval(function() {
    onlinePlayers();
   }, 1000);


setInterval(function() {
    getLeaderBoard();    
}, 1000);

setInterval(function() {
    points();   
}, 0);

function addAnim(){
    let game = document.getElementById('gameSection');
    game.style.animation = 'none';
    game.offsetHeight;
    game.style.animation = null;
    game.style.animation = 1 + 's anim';
}

function generateGameDetails(type){
    generateRoomType(type);
    generateRoom();
    generatePlayersNo();
}

function generateRoomType(type){
    let roomtype = document.getElementById("roomType");
    roomtype.innerHTML = 'TYPE: ' + type;
}


function generatePlayersNo(){
    let players = generateNumber(1,100);
    let playersDetail = document.getElementById("playersPlays");
    playersDetail.innerHTML = 'PLAYERS: ' + players;
}

function generateRoom(){
    let roomId = generateNumber(100,1000);
    let currRoom = document.getElementById("roomId");
    currRoom.innerHTML = 'ROOM: ' + '#' + roomId;
}

function generateButtons(){
    let currbtn = document.getElementById("btn" + btnGood);
    currbtn.innerHTML = fruitName;
    currbtn = document.getElementById("btn" + btnAux1);
    currbtn.innerHTML = fakers[0];
    currbtn = document.getElementById("btn" + btnAux2);
    currbtn.innerHTML = fakers[1];
}

function generateAnswers(){
    let i = 0;
    
    while(i < 2){
        let fakeindex = generateNumber(1,pictures.length-1);
        if(i == 0 && pictures[fakeindex][1] != fruitName)
            fakers[i] = pictures[fakeindex][1],i++;
        if(i == 1 && pictures[fakeindex][1] != fruitName && fakers[0] != pictures[fakeindex][1])
            fakers[i] = pictures[fakeindex][1],i++;
    }
}

function generateButtonsRound(){
    btnGood = generateNumber(0,2);
    if(btnGood == 0){
        btnAux1 = 1;
        btnAux2 = 2;
    }
    else if(btnGood == 1){
        btnAux1 = 0;
        btnAux2 = 2;
    }
    else if(btnGood == 2){
        btnAux1 = 0;
        btnAux2 = 1;
    }    
}

function generateImage(){
    let index = generateNumber(1,pictures.length-1);
    fruit = pictures[index][0];
    fruitName = pictures[index][1];
    document.getElementById("photo").src = fruit;
}

function clearRound(screen){
    let game = document.getElementById("gameSection");
    let btn = document.getElementById("btn0");
    let text = document.getElementById("extraPoints");
    let roomDetail = document.getElementById("aboutRoom");
    let yourDetail = document.getElementById("aboutYou");
    btn.style.backgroundColor = "#8a9226";
    btn = document.getElementById("btn1");
    btn.style.backgroundColor = "#8a9226";
    btn = document.getElementById("btn2");
    btn.style.backgroundColor = "#8a9226";
    game.style.opacity = 0;
    roomDetail.style.opacity = 0;
    text.style.opacity = 1;
    if(screen == 1){
        game = document.getElementById("gameSection");
        game.style.opacity = 1;
        roomDetail.style.opacity = 1;
        yourDetail.style.opacity = 1;
        text.style.opacity = 0;
    }
}

function putScore(){
   let currScore = document.getElementById("currentScore");
   currScore.innerText = 'SCORE: ' + yourScore;
}

function putRounds(){
    roundNo++;
    let roundText = document.getElementById("round");
    roundText.innerText = 'ROUND: ' + roundNo + ' / ' + rounds;
}

function putPoints(){
    if(yourScore == rounds){
        if(rounds == 3)
            yourPoints += 1000;
        else if(rounds == 5)
            yourPoints += 2000;
        else
            yourPoints += 3000;
    }
}

function putExtraPoints(){
    let extra = document.getElementById('extraPoints');
    if(yourScore == rounds){
        if(rounds == 3)
            extra.innerText = '+' + 1000 + ' points';
        else if(rounds == 5)
            extra.innerText = '+' + 2000 + ' points';
        else
            extra.innerText = '+' + 3000 + ' points';
    }
    else
        extra.innerText = '+' + 0 +' points'; 
}

function generateNextRound(){
    
    if(exitGame() == false){
        playSound();
        clearRound(1);
        addAnim();
        putScore();
        putRounds();
        generateRound();
    }
    else{
        clearRound(0);
        putScore();
        putPoints();
        putExtraPoints();
    }
}

function generateRound(){
    generateImage();
    generateButtonsRound();
    generateAnswers();
    generateButtons();
// alert(fruit + ' ' + btnGood + ' ' + fruitName + '-GOOD '+ btnAux1 + ' '+ fakefruit1 + '-BAD ' + btnAux2 + ' '+ fakefruit2 + '-BAD ');
}

function getAnswer(no){
    let btn = document.getElementById("btn" + no);
    if(btnGood == no)
        yourScore++;
    generateNextRound();
}

function getAnotherPage(url){
    window.open(url, "_self");
}

function onlinePlayers(){
let playersNo = document.getElementById("players");
playersNo.innerText = generateNumber(1,100) + " players"; 
}

function points(){
    let currpoints = document.getElementById("points");
    currpoints.innerText = yourPoints + ' points';
}

function exitGame(){
    if(roundNo > rounds - 1)
        return true;
    return false;
}

function getEasyLevel(){
    roundNo = 0;
    rounds = 3;
    yourScore = 0;
    generateGameDetails("EASY");
    generateNextRound();
}

function getMediumLevel(){
    roundNo = 0;
    rounds = 5;
    yourScore = 0;
    generateGameDetails("MEDIUM");
    generateNextRound();
}

function getHardLevel(){
    roundNo = 0;
    rounds = 7;
    yourScore = 0;
    generateGameDetails("HARD");
    generateNextRound();
}

function generateNumber(min, max){
    return Math.floor((Math.random() * (max - min + 1)) + min);
}

function generateScore(){
    for(let i = 1; i <= 10; ++i)
        scores[i] = generateNumber(100,10);

    scores.sort();
    scores.reverse();
}

function generateTop10(){    
    for(let i = 1; i <= 10; ++i){
        guests[i] = i + '.' + ' ' + 'Guest#' + generateNumber(1000,100) + ' - ' + scores[i] +'k';
    }
}

function top10(){
    generateScore();
    generateTop10();
}

function getLeaderBoard(){
    top10();
    for(let i = 1; i <= 10; ++i){
        let currplayer = document.getElementById('player' + i);
        currplayer.innerText = guests[i];
    }
}  

function playSound(){
    let audio = document.getElementById('tab');
    audio.play();
}