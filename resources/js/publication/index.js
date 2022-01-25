/*Show a modal to de confirm delete publication */
window.deletePublicationVerification = (route,PublicationToDelete)=>{
    let modalContainer = document.getElementById('Modal');    
    let ButtonModal = modalContainer.children[0].children[0].children[2].children[1];
    PublicationToDelete=PublicationToDelete.parentElement.parentElement.parentElement;    
    ButtonModal.onclick =()=>{deletePublication(route,PublicationToDelete)}

}
/*Delete publication in database */
window.deletePublication=async (route,itemToDelete)=>{    
    let response = await fetch(route);
    deletePublicationItem(itemToDelete);
    sendToast('Publicacion eliminada correctamente');
}
/*Remove item in dom */
window.deletePublicationItem=(itemToDelete)=>{
    itemToDelete.parentElement.removeChild(itemToDelete);
}