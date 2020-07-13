'use strict';

const likeBtns = document.querySelectorAll('.like');
let likeCount = 0

likeBtns.forEach(likeBtn => {
  const likeNum = likeBtn.parentNode.lastChild;
  likeNum.textContent = likeCount;
  
  likeBtn.addEventListener('click', ()=>{
    likeCount++;
    likeNum.textContent = likeCount;
  })
  
})