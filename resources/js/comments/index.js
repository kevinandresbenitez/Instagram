/*show the container for comments in a publication, this change if description from publication is avalible*/
window.showComments=(button)=>{

    /*Change icon in button */
    button.children[0].classList.toggle('far');
    button.children[0].classList.toggle('fas');

    let lenghtItems =button.parentElement.parentElement.children.length;
    let ItemToToggle ={item : lenghtItems - 2}
    let info = button.parentElement.parentElement.children[ItemToToggle.item];

    info.classList.toggle('d-none');


}
/*In form to add comments , take the input sumbmit and click event*/
window.sendFormComments=(button)=>{
  button.parentElement.children[1].click()
}

  /*click button delete comment and , delete comment for dom and send ajax delete  */
window.removeComment=(route ,button)=>{
  let commentToDelete = button.parentElement.parentElement.parentElement;
  let commentsContainer = button.parentElement.parentElement.parentElement.parentElement;
  commentsContainer.removeChild(commentToDelete);
  fetch(route);
  
}