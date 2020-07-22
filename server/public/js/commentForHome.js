'use strict';

var formWraps = document.querySelectorAll('.commentFormWrap');


formWraps.forEach(formWrap =>{
  
  const commentIcon = formWrap.parentNode.children[5].lastElementChild.firstElementChild;
  
  const commentCount = formWrap.dataset.commentCount;
  const HEIGHT = commentCount * 145;
  
  commentIcon.addEventListener('click', function () {
    if (formWrap.classList.contains('closed')) {
      formWrap.classList.remove('closed');
      formWrap.style.height = `${HEIGHT}px`;
    } else if (!formWrap.classList.contains('closed')) {
      formWrap.style.height = '0px';
      formWrap.classList.add('closed');
    };
  });
});
