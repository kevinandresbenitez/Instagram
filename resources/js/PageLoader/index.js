window.onload = ()=>{
  let PageLoader = document.getElementById('PageLoader');

  PageLoader.style.animation = 'hiddenPageLoader 1s';

  PageLoader.addEventListener("animationend",()=>{
    PageLoader.style.display = 'none';
  });


}
