<?php
include('header.php');
include('functions.php');

// Check if the delete button has been clicked and call the delete function
if (isset($_POST['delete_vouchers'])) {
    deleteVouchersByUptime24(); // Delete vouchers where uptime = '12'
}
?>

<h1>Voucher List</h1>
<hr>

<div class="row">
    <div class="col-xs-12">
        <div id="response" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body form-group form-group-sm">
                <table class="table table-striped">
                    <tbody>
                        <?php get24hours(); ?>
                    </tbody>
                </table>
                <!-- Delete Button -->
                <form method="post">
                    <button type="submit" name="delete_vouchers" class="btn btn-danger">Delete All Vouchers with 24 hours uptime</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="delete_invoice" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Invoice</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete these vouchers?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="delete_vouchers" class="btn btn-danger" data-dismiss="modal">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
include('footer.php');
?>
