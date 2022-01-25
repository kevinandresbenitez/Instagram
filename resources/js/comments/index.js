/*show the container for comments in a publication, this change if description from publication is avalible*/
window.showComments=(button)=>{

    /*Change icon in button */
    button.children[0].classList.toggle('far');
    button.children[0].classList.toggle('fas');
    /*add this class to know if the button is activated */
    button.classList.toggle('buttonCommentActive');
    

    let lenghtItems =button.parentElement.parentElement.children.length;
    let ItemToToggle ={item : lenghtItems - 2}
    let info = button.parentElement.parentElement.children[ItemToToggle.item];

    info.classList.toggle('d-none');


}
/*Url aplication , publication_id , button(this) are necesary*/
window.sendFormComments=async(url,publication_id,button)=>{  

  /*Input value text and url to send get */
  let containerComments =button.parentElement.parentElement.parentElement.querySelector('.containerComments');

  /*this button is the button to show comments , for enabled or disabled depending if have comments*/
  let buttonShowComments =button.parentElement.parentElement.parentElement.children[2].querySelector('.buttonComment');
  buttonShowComments.classList.remove('disabled');

  let comment = button.parentElement.children[0].value;
  let route = url+'/comments/add/'+publication_id+'/'+comment
  let token = button.parentElement.children[1].getAttribute('content');

  let paramsRoute = {
    credentials: "same-origin",

    headers:{
      "_token":token,
      "Content-Type": "application/json",
      "Accept": "application/json",
      "X-Requested-With": "XMLHttpRequest",      

    }
  }

  /*send comment and update dom with comment added */
  let newComment = await fetch(route,paramsRoute).then((response => response.json())).then(data=>data);
  /*The new button in the comment add method to delete , new route to delete*/
  let buttonDeleteRoute = '(removeComment(\' '+url+'/comments/delete/'+newComment.id+'\',this))'

  /*Create new comment */

    /*comment */
  let container = document.createElement('div');
  container.classList.add('col-12');


  /* Header Comment container*/
    let containerHeader = document.createElement('div');
    containerHeader.classList.add('col-12');
  /* Header Left container*/ 
    let leftHeader = document.createElement('div');
    leftHeader.classList.add('col-12');
    leftHeader.classList.add('d-flex');
    leftHeader.classList.add('align-items-center');  
  /*Img user */
    let imgUser = document.createElement('img');
    imgUser.classList.add('img-fluid');
    imgUser.classList.add('rounded-circle');
    imgUser.classList.add('d-block');
    imgUser.classList.add('my');
    imgUser.classList.add('mx-2');
    imgUser.style.width = '45px';
    imgUser.style.height = '45px';
    imgUser.src =url+(newComment.user.img ?  '/avatar/'+newComment.user.img :'/avatar-default');
    
  /*Create a elements name and link to the profile*/
    let userName = document.createElement('a');
    userName.classList.add('my-auto');
    userName.classList.add('mx-2');
    userName.setAttribute('href',url+'/profile/'+newComment.user.id);
    userName.innerText ='@'+newComment.user.name;
  /*Create p elements separator*/
    let separator = document.createElement('p');
    separator.classList.add('mx-0');
    separator.classList.add('my-auto');
    separator.innerText = '|';
    /*Create p elements time*/
    let elementTime = document.createElement('p');
    elementTime.classList.add('mx-2');
    elementTime.classList.add('my-auto');
    elementTime.innerText = 'Hace 1 segundo';
      /*Create p elements separator*/
      let separator2 = document.createElement('p');
      separator2.classList.add('mx-0');
      separator2.classList.add('my-auto');
      separator2.innerText = '|';
    /*Create button element*/
    let buttonDelete = document.createElement('button');    
    buttonDelete.classList.add('btn');
    buttonDelete.classList.add('btn-sm');
    buttonDelete.classList.add('border-none');
    buttonDelete.classList.add('bt-white');
    buttonDelete.classList.add('text-primary');
    buttonDelete.innerText ='Eliminar';
    buttonDelete.setAttribute('onclick',buttonDeleteRoute);
    /*Add in the header elements */
    leftHeader.prepend(buttonDelete);
    leftHeader.prepend(separator2);
    leftHeader.prepend(elementTime);
    leftHeader.prepend(separator);
    leftHeader.prepend(userName);
    leftHeader.prepend(imgUser);
    containerHeader.prepend(leftHeader);


  /*Comments description container */
  let containerDescription = document.createElement('div');
  containerDescription.classList.add('col-12');
  containerDescription.classList.add('p-2');
  /*Comments description p and info */
  let commentDescription = document.createElement('p');
  commentDescription.innerText = newComment.description;
  /*add comment description in container description*/
  containerDescription.prepend(commentDescription);

  /*Add in container */
  container.append(containerHeader);
  container.append(containerDescription);
  containerComments.prepend(container);

  /*Send toast notification */
  sendToast('Comentario '+'\"'+newComment.description+'\"'+' Agregado correctamente .');
  
  /*In dom add Comment */
  let CountComment=button.parentElement.parentElement.parentElement.children[2].children[2].children[3];
  CountComment.innerText = parseInt(CountComment.innerText) + 1;  
}
  /*click button delete comment and , delete comment for dom and send ajax delete  */
window.removeComment=(route ,button)=>{
  /*Button comments */
  let buttonShowComments =button.parentElement.parentElement.parentElement.parentElement.parentElement.children[2];  
  let commentToDelete = button.parentElement.parentElement.parentElement;
  let commentsContainer = button.parentElement.parentElement.parentElement.parentElement;

  /*In dom remove comment */
  let CountComment=button.parentElement.parentElement.parentElement.parentElement.parentElement.children[2].children[2].children[3];
  CountComment.innerText = parseInt(CountComment.innerText) - 1;

  /*Get text comment to send notification in toast  */
  let CommentText =commentToDelete.children[1].children[0].innerText;

  /*Delete comment */
  commentsContainer.removeChild(commentToDelete);

  if(commentsContainer.children.length === 0 ){    
    /*the button to show comments if activated is disabled, but only if there are no comments to show */
    buttonShowComments.querySelector('.buttonCommentActive').click();
    buttonShowComments.querySelector('.buttonComment').classList.add('disabled');
  }


  /*Send toast notification */
  sendToast('Comentario '+'\"'+CommentText+'\"'+' Eliminando correctamente .');

  /*Remove comment */
  fetch(route);
  
}