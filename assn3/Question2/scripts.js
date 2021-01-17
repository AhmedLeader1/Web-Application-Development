
"use strict" //enforces variable declaration

window.onload = () =>
 {
   //COUNT UP TIMER
   /*
     In The CountUp Timer, the program is going to set the date of which we want to start our timer from,then it updates the countUp for every 1 second elapsed,
     gets the current date and time. After that, it gets the difference of time between the current date's time and the past date's time,
     and lastly it calculates the number of days, hours, minutes, and seconds we passed from that date and displays the outputs (increasing after every second)
   */
   // Initialize a countDownDate variable to the date and time that you want to count down
   var countUp = new Date("December 31, 2019 00:00:00").getTime();
   // Update the count Up for every 1 second elapsed
   var l = setInterval(function()
    {

       // Get the current date and time (the very moment day)
       var currentDate = new Date().getTime();

       // Find the diffrence between current date and the count up date
       var difference = currentDate - countUp;


       // Time calculations for days, hours, minutes and seconds
      var seconds = Math.floor((difference % (1000 * 60)) / 1000);
      var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
      var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var days = Math.floor(difference / (1000 * 60 * 60 * 24));


         // Check if the timeDifference is greater than 0
       if(difference > 0)
       {
           // if it is greater than zero, dislay the output in countDown Id in the html page
         document.getElementById("countUp").innerHTML = days + " days "+ hours + " hours "
         + minutes + " minutes " + seconds + " seconds ";
       }

       else {
           // if the the date is passed display a text to show an ERROR!
         clearInterval(l);
         document.getElementById("countUp").innerHTML = "ERROR!";
       }


    }, 1000);

    //CountDown Timer
    /*
      In The CountDown Timer, the program is going to set the date of which we want to base our timer to, updates the countDown for every 1 second elapsed,
      gets the current date and time. After that, it gets the difference of time between the future date's time and the current date's time,
      and lastly it calculates the number of days, hours, minutes, and seconds remaining till the coming date and displays the outputs (decreasing after every seconds)
    */
    // Initialize a countDownDate variable to the date and time that you want to count down
    var countDown = new Date("April 30, 2020 00:00:00").getTime();

    // Update the count down for every 1 second elapsed
    var k = setInterval(function()
     {

        // Get the current date and time (the very moment day)
        var currentDate = new Date().getTime();

        // Calculate the time difference between upcoming date and the current date
        var timeDifference = countDown - currentDate;

        // Calculates the days, hours, minutes and seconds remaining (Decreasing second after a second)
        var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        // Check if the timeDifference is greater than 0
        if (timeDifference > 0)
            {
              // if it is greater than zero, dislay the output in countDown Id in the html page
              document.getElementById("countDown").innerHTML = days + " days " + hours + " hours "
              + minutes + " minutes " + seconds + " seconds ";
            }
        // if the the date is passed display a text to show that
        else {
            clearInterval(x);
            document.getElementById("countDown").innerHTML = "ERROR! the date has passed";
          }
       }, 1000);


  };
