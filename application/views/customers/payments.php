<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Payments List</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <div class="btn-group">
                <a href="<?=site_url('auth/create_user')?>" id="editable_table_new" class="btn btn-info pull-right">
                    Add Customer <i class="fa fa-plus"></i>
                </a>

                <br><br><br>
            </div>
           
            <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Subscription Type</th>
                    <th>Frequency</th>
                    <th>Billing Date</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>ID No.</th>
                    <th>Phone Number</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                

                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user):?>
                    <tr><td><?php echo htmlspecialchars($user->paymentId,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->SubscriptionType,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->frequency,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->billingDate,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->FirstName,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->LastName,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->Email,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->IdNumber,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->Phone,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->Amount,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->PaymentSatus,ENT_QUOTES,'UTF-8');?></td>
                 
              </tr>
                <?php endforeach;?>
                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
    });
</script>
<script>
    $("#view_users").addClass('active');
</script>
