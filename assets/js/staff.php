<?php
  header("Content-type: application/javascript");
  $url = urldecode($_GET["url"]);
?>

var errors = 0;
$(document).ready(function(){
  $("#staff_birthdate" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
  
  var relation = ["Suami", "Anak Ke-1", "Anak Ke-2", "Anak Ke-3", "Anak Ke-4", "Anak Ke-5", "Lainnya (tls sendiri)"];
  $("#family_table").handsontable({
    colHeaders: ["Order", "Name", "Birthdate", "Birthplace", "Sex", "Relation"],
    startCols: 6,
    startRows: 3,
    minSpareRows: 1,
    colWidths: [60, 120, 80, 80, 60, 120],
    onChange : function(changes, source){
      if(source == "edit" && changes[0][1]==4){
        console.log(changes);
        if(changes[0][3] == "Male"){
          relation[0] = "Istri";
        }else{
          relation[0] = "Suami";
        }
      }
    },
    columns: [
      {},
      {},
      {type:'date'},
      {},
      {
        type: "autocomplete",
        source: ["Male", "Female"],
        strict: true
      },
      {
        type: "autocomplete",
        source: relation
      }
    ]
  });
  
  
  /*Medic table*/
  $("#medic_table").handsontable({
    colHeaders: ["Date", "Description"],
    startCols: 2,
    startRows: 3,
    minSpareRows: 1,
    colWidths: [50, 500],
    columns: [
      {type:'date'},
      {}
    ]
  });
  
  /*Works table*/
  $("#works_table").handsontable({
    startCols: 2,
    startRows: 3,
    minSpareRows: 1,
    colHeaders: ["Date", "Description"],
    colWidths: [50, 500],
    columns: [{type: 'date'}, {}],
    contextMenu: true
  });
  
  /*Salaries*/
  $("#salary_component_a").handsontable({
    contextMenu: true,
    startCols: 5,
    startRows: 3,
    minSpareRows: 1,
    colHeaders: ["", "Component", "Type", "Daily value (Rp)", "Monthly value (Rp)"],
    colWidths: [1, 150, 80, 100, 120],
    columns: [
      {readOnly: true},
      {
        type: 'autocomplete',
        source: function(req, process){
          var url = "<?php echo $url.'components/get_components'; ?>"
          $.getJSON(url, function(data){
            var items = [];
            $.each(data, function(i, v){
              items.push(v.comp_name);
            });
            process(items);
          });
        }
      },
      {readOnly: true},
      {type: "numeric", format: "0,0.00"},
      {type: "numeric", format: "0,0.00"}
    ],
    onChange: function(update, source){
      if(source=="edit" && update[0][1]==1){
        var url = "<?php echo $url.'components/get_where_component'; ?>/"+update[0][3];
        $.getJSON(url, function(data){
          $("#salary_component_a").handsontable("setDataAtCell", update[0][0], 2, data.comp_type);
          $("#salary_component_a").handsontable("setDataAtCell", update[0][0], 0, data.id);
          if(data.comp_type.toLowerCase() != "daily"){
            $("#salary_component_a").handsontable("setDataAtCell", update[0][0], 3, "0");
          }else{
            $("#salary_component_a").handsontable("setDataAtCell", update[0][0], 4, "0");
          }
        });
      }
    },
    onBeforeChange: function(update){
      if(update[0][1] == 3){
        var type = $("#salary_component_a").handsontable("getDataAtCell", update[0][0], 2);
        if(type.toLowerCase() != "daily"){
          update[0][3] = 0;
        }else{
          return true;
        }
      }
    }
  });
  
  $("#salary_component_b").handsontable({
    contextMenu: true,
    startCols: 5,
    startRows: 3,
    minSpareRows: 1,
    colHeaders: ["", "Component", "Type", "Daily value", "Monthly value"],
    colWidths: [1, 150, 80, 100, 120],
    columns: [
      {readOnly: true},
      {
        type: 'autocomplete',
        source: function(req, process){
          var url = "<?php echo $url.'components/get_components'; ?>"
          $.getJSON(url, function(data){
            var items = [];
            $.each(data, function(i, v){
              items.push(v.comp_name);
            });
            process(items);
          });
        }
      },
      {readOnly: true},
      {type: "numeric", format: "0,0.00"},
      {type: "numeric", format: "0,0.00"}
    ],
    onChange: function(update, source){
      if(source=="edit" && update[0][1]==1){
        var url = "<?php echo $url.'components/get_where_component'; ?>/"+update[0][3];
        $.getJSON(url, function(data){
          $("#salary_component_b").handsontable("setDataAtCell", update[0][0], 2, data.comp_type);
          $("#salary_component_b").handsontable("setDataAtCell", update[0][0], 0, data.id);
          if(data.comp_type.toLowerCase() != "daily"){
            $("#salary_component_b").handsontable("setDataAtCell", update[0][0], 3, "0");
          }else{
            $("#salary_component_b").handsontable("setDataAtCell", update[0][0], 4, "0");
          }
        });
      }
    },
    onBeforeChange: function(update){
      if(update[0][1] == 3){
        var type = $("#salary_component_b").handsontable("getDataAtCell", update[0][0], 2);
        if(type.toLowerCase() != "daily"){
          update[0][3] = 0;
        }else{
          return true;
        }
      }
    }
  });
  
  $("#salary_histories").handsontable({
    startCols: 7,
    startRows: 3,
    colHeaders: ["", "Periode", "Total A", "Total B", "Subtotal", "PPh21", "Nett"],
    colWidths: [1, 100, 100, 100, 100, 100, 100, 100],
    columns: [
      {readOnly: true},
      {type: 'date'},
      {type: 'numeric', format: '0,0.00'},
      {type: 'numeric', format: '0,0.00'},
      {type: 'numeric', format: '0,0.00'},
      {type: 'numeric', format: '0,0.00'},
      {type: 'numeric', format: '0,0.00'}
    ]
  });
  
  $("form").on("submit", function(e){
    e.preventDefault();
    var form = this;
    // get data from families tab
    getFamilies();
    // get data from medics tab
    getMedics();
    // get works
    getWorks();
    // get component A
    getComponentsA();
    // get component B
    getComponentsB();
    if(errors > 1){
      jConfirm("Some rows on histories and salaries section has invalid content.<br>Would you like to fix it?", "Confirm", function(r){
        if(r) form.submit();
      });
    }
  });
});


  
function getFamilies(){
  var $instance = $("#family_table");
  var data = $instance.handsontable('getData');
  var row_length = data.length;
  var families = "";
  for(i=0; i<row_length; i++){
    if(data[i][0]!=null && 
    data[i][1]!=null && 
    data[i][2]!=null && 
    data[i][3]!=null && 
    data[i][4]!=null && 
    data[i][5]!=null){
      families += '<input type="hidden" name="families[]" value="'+data[i][0]+';'+data[i][1]+';'+data[i][2]+';'+data[i][3]+';'+data[i][4]+';'+data[i][5]+'">'; 
    }else{
      errors++;
    }
  }
  $("#families_hidden").html(families);
}

function getMedics(){
  var $instance = $("#medic_table");
  var data = $instance.handsontable('getData');
  var row_length = data.length;
  var medics = "";
  for(i=0; i<row_length; i++){
    if(data[i][0] != null && data[i][1] != null){
      medics += '<input type="hidden" name="medics[]" value="'+data[i][0]+';'+data[i][1]+'">';
    }else{
      errors++;
    }
  }
  $("#medics_hidden").html(medics);
}

function getWorks(){
  var $instance = $("#works_table");
  var data = $instance.handsontable('getData');
  var row_length = data.length;
  var medics = "";
  for(i=0; i<row_length; i++){
    if(data[i][0] != null && data[i][1] != null){
      medics += '<input type="hidden" name="works[]" value="'+data[i][0]+';'+data[i][1]+'">';
    }else{
      errors++;
    }
  }
  $("#works_hidden").html(medics);
}

function getComponentsA(){
  var $instance = $("#salary_component_a");
  var data = $instance.handsontable('getData');
  var row_length = data.length;
  var comp_a = "";
  for(i=0; i<row_length; i++){
    if(data[i][0] != null && data[i][3] != null && data[i][4]){ // save only ID, daily, monthly
      comp_a += '<input type="hidden" name="comp_a[]" value="'+data[i][0]+';'+data[i][3]+';'+data[i][4]+'">';
    }else{
      errors++;
    }
  }
  $("#salary_comp_a").html(comp_a);
}

function getComponentsB(){
  var $instance = $("#salary_component_b");
  var data = $instance.handsontable('getData');
  var row_length = data.length;
  var comp_b = "";
  console.log(data);
  for(i=0; i<row_length; i++){
    if(data[i][0] != null && data[i][3] != null && data[i][4]){ // save only ID, daily, monthly
      comp_b += '<input type="hidden" name="comp_b[]" value="'+data[i][0]+';'+data[i][3]+';'+data[i][4]+'">';
    }else{
      errors++;
    }
  }
  $("#salary_comp_b").html(comp_b);
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
