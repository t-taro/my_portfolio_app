'use strict';

const likeBtns = document.querySelectorAll('.like');

likeBtns.forEach(likeBtn => {
  const likeNum = likeBtn.parentElement.lastElementChild;
  let likeCount = parseInt(likeNum.textContent, 10);
  
  likeBtn.addEventListener('click', ()=>{
    likeCount++;
    
    likeCount = String(likeCount);
    
    const formData = new FormData();
    formData.append('like', likeCount);
    
    const postId = likeBtn.parentNode.parentNode.parentNode.dataset.postId;
    formData.append('id', postId);
    
    const token = document.getElementsByName('csrf-token').item(0).content;
    
    fetch('/like', {
      method:'POST',
      headers:{
        'X-CSRF-TOKEN': token
      },
      body:formData
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(json) {
      likeNum.textContent = json.like;
    });
  });
});