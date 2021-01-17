//Java Script CODE
"use strict";
//setting
const edit = document.querySelector('.editAccount');
const deleteAccount = document.querySelector('.deleteAccount');
const editform = document.querySelector('#updateForm');
const deleteForm = document.querySelector('#deleteForm');
const buttonUpdate = document.querySelector('#updateForm button');
const buttonDelete = document.querySelector('#deleteForm button');
const createPage = document.querySelector('#createPage');

// MAKE THE EDIT PAGE RESPONSIVE ON CLICK
edit.addEventListener('click', ev=>{
  ev.srcElement.parentElement.style.display = "none";
  edit.style.display = "none";
  editform.style.display = "block";
});
//REVEAL THE CONTENT OF THE DELETE PAE ON CLICK
deleteAccount.addEventListener('click', ev=>{
  ev.srcElement.parentElement.style.display = "none";
  deleteAccount.style.display = "none";
  deleteForm.style.display = "block";
});
//WHAT HAPPENS ONCE THE USER CLICKS THE UPDATE BUTTON ON THE EDIT PAGE
buttonUpdate.addEventListener('click', ev=>{
  editform.style.display = "none";
  edit.parentElement.style.display = "block";
  edit.style.display = "block";
});
// WHAT HAPPENS WHEN THE USER PRESSES THE DELETE ACCOUNT BUTTON
buttonDelete.addEventListener('click', ev=>{
  deleteForm.style.display = "none";
  deleteAccount.parentElement.style.display = "block";
  deleteAccount.style.display = " block";
});


//add event listener to menu icon
document.querySelector('#home').addEventListener('click',ev=>{
  createPage.style.display = "block";
});
