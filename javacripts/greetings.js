datetoday = new Date();
timenow=datetoday.getTime();
datetoday.setTime(timenow);
thehour = datetoday.getHours();
if (thehour > 18) display = "Evening";
else if (thehour >12) display = "Afternoon";
else display = "Morning";
var greeting = ("Good " + display + "!");
document.write(greeting);