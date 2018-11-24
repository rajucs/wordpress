function showImage1(){

  if (this.files && this.files[0]) {
    var obj = new FileReader();

    obj.onload = function(data) {
     var image = document.getElementById("filepreviewimg1");
     image.src = data.target.result;
     image.style.display="block";

    }

    obj.readAsDataURL(this.files[0]);
  }
}

function showImage2(){

  if (this.files && this.files[0]) {
    var obj = new FileReader();

    obj.onload = function(data) {
     var image = document.getElementById("filepreviewimg2");
     image.src = data.target.result;
     image.style.display="block";

    }

    obj.readAsDataURL(this.files[0]);
  }
}
function showImage3(){

  if (this.files && this.files[0]) {
    var obj = new FileReader();

    obj.onload = function(data) {
     var image = document.getElementById("filepreviewimg3");
     image.src = data.target.result;
     image.style.display="block";

    }

    obj.readAsDataURL(this.files[0]);
  }
}

jQuery(document).on("change", ".file_multi_video1", function(evt) {
  var jQuerysource = jQuery('#video_before');
  jQuerysource[0].src = URL.createObjectURL(this.files[0]);
  jQuerysource.parent()[0].load();
});
jQuery(document).on("change", ".file_multi_video2", function(evt) {
  var jQuerysource = jQuery('#video_after');
  jQuerysource[0].src = URL.createObjectURL(this.files[0]);
  jQuerysource.parent()[0].load();
});