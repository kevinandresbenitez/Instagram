/*This function is a asicronic , add and remove like 

these functions work with each other, the values ​​they receive are, the current route,
which is the one that will be executed through the fetch, the next route, which is the 
one that will execute the callback as current route, and the like button, to change the icon

*/


window.addLike=(route,nextRoute,button)=>{
    button.children[0].classList.remove('far');
    button.children[0].classList.add('fas');
    button.onclick = ()=>{removeLike(nextRoute,route,button)};
    fetch(route);

}

window.removeLike=(route,nextRoute,button)=>{  
    button.children[0].classList.remove('fas');
    button.children[0].classList.add('far');

    button.onclick =()=>{addLike(nextRoute,route,button)};
    fetch(route);

}