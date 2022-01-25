/*This function is a asicronic , add and remove like 

these functions work with each other, the values ​​they receive are, the current route,
which is the one that will be executed through the fetch, the next route, which is the 
one that will execute the callback as current route, and the like button, to change the icon

*/


window.addLike=(route,nextRoute,button)=>{

    /*In dom add Like */
    let CountLike=button.parentElement.children[2].children[1];    
    CountLike.innerText= parseInt(CountLike.innerText) + 1;

    /*Change icon */
    button.children[0].classList.remove('far');
    button.children[0].classList.add('fas');
    button.onclick = ()=>{removeLike(nextRoute,route,button)};

    /*Send request to add */
    fetch(route);

    /*Send toast notification */
  sendToast('Like agregado correctamente');
}

window.removeLike=(route,nextRoute,button)=>{  
    /*In dom remove Like */
    let CountLike=button.parentElement.children[2].children[1];    
    CountLike.innerText= parseInt(CountLike.innerText) - 1;

    /*Change icon */
    button.children[0].classList.remove('fas');
    button.children[0].classList.add('far');
    button.onclick =()=>{addLike(nextRoute,route,button)};

    /*Send request to remove*/
    fetch(route);

   sendToast('Like eliminado correctamente');
}