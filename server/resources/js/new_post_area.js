'use strict';

const formWrap = document.querySelector('.formWrap');
const letsNew = document.getElementById('letsNew');

letsNew.addEventListener('click', ()=>{
  if(formWrap.classList.contains('closed')){
    formWrap.classList.remove('closed');
    formWrap.classList.add('opened');
  }else if(formWrap.classList.contains('opened')){
    formWrap.classList.remove('opened');
    formWrap.classList.add('closed');
  };
});