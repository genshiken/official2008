var i = 0;
var Speed = 40;
TextInput = new Object();
TotalTextInput = 0;
TextInput[0]= "Genshiken - Gendai Shikaku Bunka Kenkyuukai - The Society For The Study Of Modern Visual Culture";
var timer;
var nspace = 125; // number of spaces to add
var msg = '';
var j = 0;
function startBanner() {  // set up the banner for the status bar
  clearTimeout(timer);
for(j=0; j <= TotalTextInput; j++) {
msg = msg + TextInput[j];
for (i=0; i < nspace; i++) {
  msg= msg + ' ';
}
}
scrollMe();
}
function scrollMe() {
 window.status = msg;
 msg = msg.substring(1, msg.length) +  msg.substring(0,1);
 timer = setTimeout('scrollMe()',Speed );
 }
startBanner();
