"use strict";

// This block will run when the DOM is loaded (once elements exist)
window.addEventListener('DOMContentLoaded', () => {
  // This function is correct, don't mess with it
  const emailIsValid = string => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(string);



  //replace ??? with the selector to get the required element
  const submitButton = document.querySelector('#submit'); //

  const emailInput = document.querySelector('#email');
  const emailError = document.querySelector('#email + span');

  const candySelect = document.querySelector('div > select');
  const candyError = document.querySelector('select + span.error hidden');


  //replace 'event name here' with the correct event
  submitButton.addEventListener('click', event => {
    //create variable true
    let valid = true;
    //do form validation here
    if (emailIsValid==valid) {
      //do nothing
      console.log("Hello!");
    }else {
      span.remove(emailError);
    }
  });
});
