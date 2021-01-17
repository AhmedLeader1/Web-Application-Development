"use strict";

// This block will run when the DOM is loaded (once elements exist)
window.addEventListener('DOMContentLoaded', () => {
  // This function is correct, don't mess with it
  const emailIsValid = string => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(string);



  //replace ??? with the selector to get the required element
  const submitButton = document.querySelector('#submit'); //

  const emailInput = document.querySelector('#email');
  const emailError = document.querySelector('#email + span');

  const candySelect = document.querySelector('#choice');
  const candyError = document.querySelector('#choice + span');


  //replace 'event name here' with the correct event
  submitButton.addEventListener('click', event => {

    emailError.classList.add('hidden');
    candyError.classList.add('hidden');

    //set valid to be true
    let valid = true;
    //do form validation here
    if (!emailIsValid(emailInput.value)) {
      //hide the class list
      emailError.classList.remove('hidden');
      valid = false;
    }

    //check the selectores 'candyselect'
    if(candySelect.value == -1){
      candyError.classList.remove('hidden');
      valid = false;
    }

    //prevent the default
    if(valid == false){
    event.preventDefault();
  }
  });
});
