let bootstrap  = require('bootstrap');

window.sendToast =(mensaje)=>{

    let container = document.getElementById('ToastContainer');

    let toast = document.createElement('div');    
    toast.classList.add('toast');
    toast.classList.add('p-1');
    toast.classList.add('p-md-2');

    toast.setAttribute('role','alert')
    toast.setAttribute('aria-live','assertive')
    toast.setAttribute('aria-atomic','true')

    let toastBody = document.createElement('div');
    toastBody.classList.add('toast-body');
    toastBody.innerText = mensaje;

    toast.appendChild(toastBody);
    container.appendChild(toast);


    toast = new bootstrap.Toast(toast);
    toast.show();

    /*
    <div class="toast p-3" role="alert" aria-live="assertive" aria-atomic="true">            
        <div class="toast-body">
            mensaje
        </div>
    </div>   
    */
}