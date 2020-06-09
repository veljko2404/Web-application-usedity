function upload() {
  var total_file=document.getElementById("thumb").files.length;
  for(var i=0;i<total_file;i++) {
    $('.img-preview').append("<img style='width:100%;height:100%;' src='"+URL.createObjectURL(event.target.files[i])+"'>");
  }
  $('.img-preview').css("display" , "block");
  $('#thumb').css("display" , "none");
  $('.label').css("display" , "none");
}
function img() {
  var close = document.getElementById("close_btn");
  var total_file=document.getElementById("images_upl").files.length;
  if(total_file<13) {
    for(var i=0;i<total_file;i++) {
      $('#imgs').append("<div id='img_uploaded'><img style='max-width:100%;height:100%;margin:auto !important;' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
    }
    close.style.display = "inline-block";
  } else {
    $('#photos-max').text("12 images only !");
    $('#photos-max').css("color","red");
  }
}
