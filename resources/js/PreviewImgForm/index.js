window.PreviewImgForm=()=>{
  /*Function for show preview image in form*/
  let file = document.getElementById('img').files[0];
  let preview = document.getElementById('Preview-img');

  if(file.type != "image/png"){
    return false;
  }

  var reader  = new FileReader();
  reader.onloadend = function () {
    preview.src = reader.result;
  }
  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }

}
