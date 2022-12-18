							var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
							var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")

							function getthedate()
							{
							var mydate=new Date()
							var year=mydate.getYear()

							if (year < 1000)year+=1900

							var day=mydate.getDay()
							var month=mydate.getMonth()
							var daym=mydate.getDate()
							var hours=mydate.getHours()
							var minutes=mydate.getMinutes()
							var seconds=mydate.getSeconds()
							var dn="AM"
							
							if (daym==1)daym="1st"
							if (daym==2)daym="2nd"
							if (daym==3)daym="3rd"
							if (daym==4)daym="4th"
							if (daym==5)daym="5th"
							if (daym==6)daym="6th"
							if (daym==7)daym="7th"
							if (daym==8)daym="8th"
							if (daym==9)daym="9th"
							if (daym==10)daym="10th"
							if (daym==11)daym="11th"
							if (daym==12)daym="12th"
							if (daym==13)daym="13th"
							if (daym==14)daym="14th"
							if (daym==15)daym="15th"
							if (daym==16)daym="16th"
							if (daym==17)daym="17th"
							if (daym==18)daym="18th"
							if (daym==19)daym="19th"
							if (daym==20)daym="20th"
							if (daym==21)daym="21st"
							if (daym==22)daym="22nd"
							if (daym==23)daym="23rd"
							if (daym==24)daym="24th"
							if (daym==25)daym="25th"
							if (daym==26)daym="26th"
							if (daym==27)daym="27th"
							if (daym==28)daym="28th"
							if (daym==29)daym="29th"
							if (daym==30)daym="30th"
							if (daym==31)daym="31st"
							
							if (hours>=12)dn="PM"
							if (hours>12){hours=hours-12}
							if (hours==0)hours=12
							if (minutes<=9)minutes="0"+minutes
							if (seconds<=9)seconds="0"+seconds

							//change font size here
							var cdate=dayarray[day]+", "+montharray[month]+" "+daym+", "+year+", "+hours+":"+minutes+":"+seconds+" "+dn
							if (document.all)
							document.all.clock.innerHTML=cdate
							else
							document.write(cdate)
							}
							if (!document.all)
							getthedate()
							function goforit(){
							if (document.all)
							setInterval("getthedate()",1000)
							}