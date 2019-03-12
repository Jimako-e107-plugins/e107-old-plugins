<!--

  today = new Date()
    if(today.getMinutes() < 10){ 
        pad = "0";}
    else { 
    pad = "";}

   if((today.getHours() >=6) && (today.getHours() <=9)){
var str = "<center><pre>Good Morning!</pre></center>";
document.write(str.fontcolor("green"))
}
   if((today.getHours() >=10) && (today.getHours() <=11)){
var str = "<center><pre>Good Morning!</pre></center>";
document.write(str.fontcolor("green"))
}
    if((today.getHours() >=12) && (today.getHours() <=16)){
var str = "<center><pre>Good Afternoon!</pre></center>";
document.write(str.fontcolor("green"))
}    
    if((today.getHours() >=17) && (today.getHours() <=23)){
var str = "<center><pre>Good Evening!</pre></center>";
document.write(str.fontcolor("green"))
}
    if((today.getHours() >=0) && (today.getHours() <=4)){
var str = "<center><pre>You're up late night crawler!</pre></center>";
document.write(str.fontcolor("green"))
}
    if((today.getHours() >=4) && (today.getHours() <=6)){
var str = "<center><pre>Wow! You're up early!!</pre></center>";
document.write(str.fontcolor("green"))
}

// -- End Hiding Here -->