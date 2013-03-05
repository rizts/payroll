(function($){
  $.fn.blackify = function(){
    $(this).css("position","relative").append("<div class='blackify'><img src='<?php echo assets_url('images/photon/preloader/22.gif'); ?>'></div>");
  };
})(jQuery);
