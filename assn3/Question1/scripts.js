"use strict" //enforces variable declaration
window.onload = () => {
  // Question 1: Disappearing Text
  //Get the paragaph
  document.querySelector('#cont1 p').addEventListener('click', event => {
    const cont1 = event.srcElement;
    const section = cont1.parentElement;
    cont1.style.display = 'none'; //hide the paragraph
});

  // Question 2: Changing a background
  let cont2 = document.querySelectorAll("#cont2 ul li").forEach(item => {
     item.addEventListener("click", event => {
       // Make papa purple
       item.parentElement.style.backgroundColor = "#721778";
     });
   });

  // Question 3: Two differet colours
  //Get the paragraph
  let cont3 = document.querySelector('#cont3 p');
  //Change the color red on single click
  cont3.addEventListener('click', event => {
    cont3.style.color = '#FF0000';
  });
  //change the color to pink on double click
  cont3.addEventListener('dblclick', event => {
    cont3.style.color = '#FFC0CB	';
  });

  // Question  4: Text-cloning
  document.querySelector('#cont4 textarea').addEventListener('input', event => {
    event.srcElement.nextElementSibling.innerHTML = event.srcElement.value;
  });

  // Question  5: Size changing
  let MAX = 100;
    let buttonListener = sign => {
    //get the with and the heaght from the input
    let w = document.querySelector('#width').value;
    let h = document.querySelector('#height').value;
    //validate the height (only numbers is allowed)
    if(isNaN(w) || isNaN(h)){ // only numbers is allowed
  	          alert('Invalid input!')
              return;
           } else if (w <=0 || height<=0) {//zero or less is no valid
             alert('height or the width cannot be zero')
             return;
           }if(h > MAX || w > MAX){//make sure MAX IS not exceeded
             alert('MAX SIZE EXCEEDED!')
             return;
         }

    const div = document.querySelector('#cont5 .box');
    const computedStyle = getComputedStyle(div);

    // get current height and widht
    const currentWidth = Number(computedStyle['width'].replace('px', ''));
    const currentHeight = Number(computedStyle['height'].replace('px', ''));

    // increment the size the new ones
   if (sign = '+') {
        div.style.width = `${currentWidth + Number(w)}px`;//increment the widht
        div.style.height = `${currentHeight + Number(h)}px`;//increment the height
    }

  }
 //update the size
  const buttons = document.querySelectorAll('#cont5 button');
  buttons[0].addEventListener('click', () => buttonListener('+'));

  // Question  6: Adding children
  let cont = event => {
    let newContent = document.createElement('li');
    newContent.addEventListener('click', cont);
    //add new Item on click
    newContent.innerHTML = `Item ${event.srcElement.parentElement.children.length + 1}`;
    event.srcElement.after(newContent);
  }
  //Get the list
  for (let li of document.querySelectorAll('#cont6 li')) {
    li.addEventListener('click', cont);
  }

// Question 7: Convoluted list operations
// Get the even elements in the list, and change their backgroundColor oh mouseover
for (let even of document.querySelectorAll('#cont7 li:nth-child(even)')) {
  even.addEventListener('mouseover', event =>{
    even.style.backgroundColor = '#FFC0CB';//change background-color
  });
}
//Get the odd elelements in the list, and replaces them with new items
for (let odd of document.querySelectorAll('#cont7 li:nth-child(odd)')) {
  odd.addEventListener('click', event =>{
    let newItem = document.createElement('li');
    newItem.innerHTML = 'New Item'; // add a new item
    event.srcElement.parentElement.appendChild(newItem);
    event.srcElement.remove();
  });
}

 // Question 8: A simple Fetch Request
document.querySelector('#cont8 h2').addEventListener('click', ev=>{
 let fetch = new XMLHttpRequest(); //create a request
 fetch.open('GET', 'cont8.html');//Get the second html page
 fetch.addEventListener('load', ev=>{
   let doc =  document.querySelector('#cont8');
  doc.firstElementChild.nextElementSibling.innerHTML=fetch.response;
 });
 fetch.send();
})
}
