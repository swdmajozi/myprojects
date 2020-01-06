<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);
?>  

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url() ?>public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo "Hi, ". $admin->first_name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
       <li id="add_user"><a href="<?php echo site_url('auth/create_user'); ?>"><i class="fa fa-circle-o"></i>ICS Web App - Dashboard</li>

         <li id="add_user"><a href="<?php echo site_url('auth/create_user'); ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
              <li id="Users" class=""><a href="<?php echo site_url('auth/user_list'); ?>"><i class="fa fa-circle-o"></i> View Users</a></li>

                <li id="add_user"><a href="<?php echo site_url('accounts/addcustomer'); ?>"><i class="fa fa-circle-o"></i>New Customer</a></li>
              <li id="view_users" class=""><a href="<?php echo site_url('accounts/allcustomers'); ?>"><i class="fa fa-circle-o"></i> All Customers</a></li>

              <li id="payments" class=""><a href="<?php echo site_url('accounts/payments'); ?>"><i class="fa fa-circle-o"></i>Payments</a></li>
      </ul>

   



         <!-- Logout    -->
        <ul class="sidebar-menu">
          <li>

              <a href="<?php echo site_url('auth/logout'); ?>">

                  <i class="fa fa-sign-out"></i> <span>Logout</span>

              </a>

          </li>

      </ul>


        </ul>


    </section>
    <!-- /.sidebar -->
  </aside>

  
<script>
  $("#<?= $cur_tab; ?>").addClass('active');
</script>
