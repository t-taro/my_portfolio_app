'use strict';

const likeBtns = document.querySelectorAll('.like');
const token = document.getElementsByName('csrf-token').item(0).content;

likeBtns.forEach(likeBtn => {
  const likeNum = likeBtn.parentElement.lastElementChild;
  
  likeBtn.addEventListener('click', ()=>{
    const formData = new FormData();
    
    const postId = likeBtn.parentNode.parentNode.parentNode.dataset.postId;
    formData.append('post_id', postId);
    
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
      if(json.like !== 'noResult'){
        likeNum.textContent = json.like;
        if(json.state == 'plus'){
          console.log('plus');
          likeBtn.textContent = 'favorite';
          
        } else if (json.state == 'minus'){
          console.log('minus');
          likeBtn.textContent = 'favorite_border';
          
        }
      }
    })
  });
});