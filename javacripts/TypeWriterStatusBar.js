/*
   http://www.geocities.com/CollegePark/Quad/3400
   http://javacentral.home.ml.org
   http://www.page4life.nl/javacentral/index.htm

   (c) 1997 Semian Software, Script by: Michiel steendam
   Modify and use anyway you want, just mention this site.
*/

  <!-- Hide from old browsers

  // All you have to do is put another text in the variable message.
  // Don't forget to break all lines with a ^
  // When you do not place a ^ at the end of all the message, the
  // message will not repeat

message	= "Genshiken^" +
          "Gendai Shikaku Bunka Kenkyuukai^" +
          "The Society For The Study Of Modern Visual Culture^" +
          "^"
scrollSpeed = 25
lineDelay   = 1500

// Do not change the text below //

txt         = ""

function scrollText(pos) 
{
	if (message.charAt(pos) != '^') 
	{
    	txt    = txt + message.charAt(pos)
      	status = txt
      	pauze  = scrollSpeed
    }
    else 
	{
      	pauze = lineDelay
      	txt   = ""
      	if (pos == message.length-1) pos = -1
    }
    pos++
    setTimeout("scrollText('"+pos+"')",pauze)
}

// Unhide -->
scrollText(0)