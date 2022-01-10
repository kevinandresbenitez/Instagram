/*show the container for comments in a publication, this change if description from publication is avalible*/
window.showComments=(param)=>{

    let lenghtItems =param.parentElement.parentElement.children.length;
    let ItemToToggle ={item : lenghtItems - 2}
    let info = param.parentElement.parentElement.children[ItemToToggle.item];

    info.classList.toggle('d-none');


}
/*In form to add comments , take the input sumbmit and click event*/
window.sendFormComments=(param)=>{
  param.parentElement.children[1].click()
}
