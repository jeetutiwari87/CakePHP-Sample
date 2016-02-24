<?php
app::import("Model", "SitePermission");
$permission_obj = new SitePermission();

if (!isset($user_list)) {
    $user_list_act = '';
} else {
    $user_list_act = 'active';
}
?>
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php if ($this->params['controller'] == 'users' && $this->params['action'] == 'admin_dashboard') { ?>active<?php } ?>">
                <?php echo $this->Html->link('<i class="fa fa-dashboard"></i> <span>Dashboard</span>', array('controller' => 'users', 'action' => 'dashboard', "admin" => true), array("escape" => false)); ?>
            </li>

            <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'categories', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'categories', 'is_add')) { ?>

                <li class="treeview <?php if (in_array($this->params['controller'], array('categories')) && (in_array($this->params['action'], array("admin_index", "admin_add", "admin_edit", "admin_view")))) { ?>active<?php } ?>">
                    <a href="javascript:void(0);">
                        <i class="fa fa-users"></i>
                        <span>Categories</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">

                       
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'categories', 'is_read')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> List Categories', array('controller' => 'categories', 'action' => 'index', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>
						
						<?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'categories', 'is_add')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> Add Category', array('controller' => 'categories', 'action' => 'add', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>
                      
                    </ul>
                </li>
            <?php } ?>
			
			<?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'galleries', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'galleries', 'is_add')) { ?>

                <li class="treeview <?php if (in_array($this->params['controller'], array('galleries')) && (in_array($this->params['action'], array("admin_index", "admin_add", "admin_edit", "admin_view")))) { ?>active<?php } ?>">
                    <a href="javascript:void(0);">
                        <i class="fa fa-users"></i>
                        <span>Galleries</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">

                       
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'galleries', 'is_read')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> List Galleries', array('controller' => 'galleries', 'action' => 'index', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>
						
						<?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'galleries', 'is_add')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> Add Gallery', array('controller' => 'galleries', 'action' => 'add', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>
                      
                    </ul>
                </li>
            <?php } ?>
			
			<?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'items', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'items', 'is_add')) { ?>

                <li class="treeview <?php if (in_array($this->params['controller'], array('items')) && (in_array($this->params['action'], array("admin_index", "admin_add", "admin_edit", "admin_view")))) { ?>active<?php } ?>">
                    <a href="javascript:void(0);">
                        <i class="fa fa-users"></i>
                        <span>Items</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">

                       
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'items', 'is_read')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> List Items', array('controller' => 'items', 'action' => 'index', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>
						
						<?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'items', 'is_add')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> Add Item', array('controller' => 'items', 'action' => 'add', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>
                      
                    </ul>
                </li>
            <?php } ?>

          


            <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'users', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'users', 'is_add')) { ?>
                <li class="treeview <?php if (in_array($this->params['controller'], array('users')) && (in_array($this->params['action'], array("admin_index", "admin_add", "admin_edit", "admin_view")))) { ?>active<?php } ?>">
                    <a href="javascript:void(0);">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'users', 'is_read')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> List Users', array('controller' => 'users', 'action' => 'index', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'users', 'is_add')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> Add Users', array('controller' => 'users', 'action' => 'add', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>                  
                      
                     
                    </ul>
                </li>
            <?php } ?>


            <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_add')) { ?>
                <li class="treeview <?php if (in_array($this->params['controller'], array('email_templates')) && (in_array($this->params['action'], array("admin_index", "admin_add", "admin_edit", "admin_view")))) { ?>active<?php } ?>">
                    <a href="javascript:void(0);">
                        <i class="fa fa-laptop"></i>
                        <span>Email Templates</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_read')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> List Email Templates', array('controller' => 'email_templates', 'action' => 'index', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_add')) { ?>
                            <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i> Add Email Templates', array('controller' => 'email_templates', 'action' => 'add', "admin" => true), array("escape" => false)); ?></li>
                        <?php } ?>

                    </ul>
                </li>
            <?php } ?>

         <?php /*?> <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'requisition_requests', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'requisition_requests', 'is_add')) { ?>
                <li class="<?php if (in_array($this->params['controller'], array('requests')) && (in_array($this->params['action'], array("admin_add")))) { ?>active<?php } ?>">
				<?php echo $this->Html->link('<i class="fa fa-users"></i>
                        <span>Requisition Requests</span>
                        <i class="fa fa-angle-left pull-right"></i>', array('controller' => 'requests', 'action' => 'add', "admin" => true), array("escape" => false)); ?>
                   
                    
                </li>
            <?php } ?>
			
			 <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'requisition_history', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'requisition_history', 'is_add')) { ?>
                <li class="<?php if (in_array($this->params['controller'], array('requests')) && (in_array($this->params['action'], array("admin_index", "admin_edit")))) { ?>active<?php } ?>">
				<?php echo $this->Html->link('<i class="fa fa-users"></i>
                        <span>Requisition History</span>
                        <i class="fa fa-angle-left pull-right"></i>', array('controller' => 'requests', 'action' => 'index', "admin" => true), array("escape" => false)); ?>
                   
                    
                </li>
            <?php } ?>
			 <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'view_requisition', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'view_requisition', 'is_add')) { ?>
                <li class="<?php if (in_array($this->params['controller'], array('requests')) && (in_array($this->params['action'], array("admin_view_requisitions", "admin_edit")))) { ?>active<?php } ?>">
				<?php echo $this->Html->link('<i class="fa fa-users"></i>
                        <span>View Requisitions</span>
                        <i class="fa fa-angle-left pull-right"></i>', array('controller' => 'requests', 'action' => 'view_requisitions', "admin" => true), array("escape" => false)); ?>
                   
                    
                </li>
            <?php } ?>
			 <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'admin_requisition', 'is_read') || $permission_obj->CheckPermission($UsersDetails['role_id'], 'admin_requisition', 'is_add')) { ?>
                <li class="<?php if (in_array($this->params['controller'], array('requests')) && (in_array($this->params['action'], array("admin_requisitions", "admin_edit")))) { ?>active<?php } ?>">
				<?php echo $this->Html->link('<i class="fa fa-users"></i>
                        <span>Requisitions</span>
                        <i class="fa fa-angle-left pull-right"></i>', array('controller' => 'requests', 'action' => 'requisitions', "admin" => true), array("escape" => false)); ?>
                   
                    
                </li>
            <?php } ?>
			
			 <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'inventory_report', 'is_read')) { ?>
                <li class="<?php if (in_array($this->params['controller'], array('requests')) && (in_array($this->params['action'], array("admin_inventory_report")))) { ?>active<?php } ?>">
				<?php echo $this->Html->link('<i class="fa fa-users"></i>
                        <span>Inventory Report</span>
                        <i class="fa fa-angle-left pull-right"></i>', array('controller' => 'requests', 'action' => 'inventory_report', "admin" => true), array("escape" => false)); ?>
                   
                    
                </li>
            <?php } ?>
<?php */?>
           

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
