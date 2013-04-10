<?php get_header(); ?>
<script type="text/javascript">
    $(document).ready(function(){
      $("#staff").autocomplete({
        source: function(request, response){
          console.log(request)
          var url = "<?php echo site_url('absensi/get_staff')?>/"+request.term;
          $.getJSON(url, function(data){
            var list = [];
            $.each(data, function(i, v){
              var li = {
                value: v.staff_name,
                staff_id: v.staff_id
              }
              list.push(li);
            });
            response(list);
          });
        },
        select: function(event, ui){
          $("#staff_id").val(ui.item.staff_id);
        }
      });
    });
</script>
<div class="body">
    <div class="content">
        <h2 class="rama-title">Form Absensi</h2>
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open_multipart($form_action) . form_hidden('id', $id); ?>
        <input type="hidden" name="staff_id" id="staff_id" />
        <table width="100%">
          <tr>
            <td>Kode absen</td>
            <td><div class="span2"><?php echo form_input($kode_absen); ?></div></td>
          </tr>
          <tr>
              <td width="20%">Staff</td>
              <td><div class="span3"><?php echo form_input($staff); ?></div></td>
          </tr>
          <tr>
              <td>Date</td>
              <td><div class="span2"><?php echo form_input($date); ?></div></td>
          </tr>
          <tr>
              <td>Jumlah hari masuk</td>
              <td><div class="span1"><?php echo form_input($hari_masuk); ?></div></td>
            </tr>
          <tr>
            <td colspan="2" style="text-align: center; font: bold 18px arial; border-bottom: 1px solid #ccc">OR</td>
          </tr>
          <tr>
            <td>Import from absence machine(.csv)</td>
            <td>
              <div class="row-form">
                <div class="input-append file span3">
                  <input type="file" name="csv" />
                  <input type="text" />
                  <input type="button" class="btn" value="Browse" />
                </div>
              </div>
            </td>
          </tr>
        </table>
        <input type="submit" name="save" class="btn btn-primary" />
        <a href="<?php echo site_url('absensi/index'); ?>" class="btn btn-danger">Back</a>
        <?php echo form_close() ?>
    </div>
</div>
<?php get_footer(); ?>
