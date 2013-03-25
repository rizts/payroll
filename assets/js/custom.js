$(document).ready(function(){
        // styling select box
        $("select").select2({
            dropdownCssClass: 'noSearch'
        });
        // check all
        $("body").on("click", "#check_all", function(e){
          if($(this).is(":checked")){
            $(".check_action").attr("checked","checked");
          }else{
            $(".check_action").removeAttr("checked");
          }
        });
        // nav height
        setNavHeight();
        // nav tree
        $("a.has_subnav").click(function(e){
          e.preventDefault();
          $(this).siblings(".subnav").slideToggle ();
        });
        // double click to edit, only simulate
        $("body").on("dblclick", "tr.data",function(){
          var id = $(this).attr("data-id");
          $("#dlg"+id).click();
        });
        // show dialog
        $(".show-modal").on("click", function(e){
          e.preventDefault();
          $('body').modalmanager('loading'); // bootstrap extension for responsive modal
          var url = $(this).attr("data-url");
          var title = $(this).attr("data-popup-title");
          $("#modal-title").html(title);
          $(".modal-body").load(url, function(){
            $("#modal-dialog").modal();
          });
        });
        //delete item
        $(".delete").click(function(e){
          var url = $(this).attr("href");
          $.alerts.overlayColor = "#000";
          $.alerts.overlayOpacity = .25;
          jConfirm('Are you sure want to delete this entry?', 'Are you sure?', function(r) {
            console.log(r);
              if(r){
                window.location.href = url;
              }
          });
          e.preventDefault();
        });
        // fade out alert box for 3 second
        setTimeout(function(){
          //$(".alert").fadeOut();
        }, 3000);
        // delete ajax
        $("body").on("click", ".delete-ajax", function(e){
          if(!confirm("Yakin delete?")){
            return false;
          }else{
            var url = $(this).attr("href");
            var pid = $(this).attr("data-parent-id");
            $.get(url, function(){
              $("#"+pid).fadeOut().remove();
            });
          }
          e.preventDefault();
        });
        // auto comas
        $(".auto-coma").on("keyup", function(){
          var num = $(this).val().replace(/,/g, '');
          num = num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
          $(this).val(num);
        });
        // spinner
        $('.spinner').spinner({
            min: 0,
            max: 10000
        });
        $('#search_btn').click(function(e){
          var q = $("#search_input").val();
          var by = $("#search_by").val();
          console.log(by);
          if(q.length < 2 || by == ''){
            alert("invalid search, please input atleast 2 digit keyword and choose search by");
            e.preventDefault();
          }
        });

      });
      function setNavHeight(){
        var wrapHeight = $(".wrap").innerHeight();
        var winHeight = $(window).innerHeight();
        var navHeight = 0;
        if(wrapHeight<winHeight){
          navHeight = "100%";
        }else{
          navHeight = wrapHeight+"px";
        }
        $("#nav").css("height",navHeight);
      }
      
      window.onmousemove = function(e){
        setNavHeight();
      }
