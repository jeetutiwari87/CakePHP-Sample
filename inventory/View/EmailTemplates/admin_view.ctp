<?php
app::import('Model', 'SitePermission');
$permission_obj = new SitePermission();
$is_ajax=Configure::read('site.run_admin_ajax');
?>

<aside class="right-side">
  <section class="content-header">
    <h1> <?php echo __('View Email Template Information');?> <small><?php echo __('Here you can view Email Template');?></small> </h1>
  </section>
  <div class="nav-tabs-custom">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-body">
              <div class="tab-content table-responsive no-padding">
                <div class="tab-pane active">
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td><?php echo __('Id');?></td>
                        <td><?php echo h($emailTemplate['EmailTemplate']['id']); ?> &nbsp; </td>
                      </tr>
                    
                      <tr>
                        <td><?php echo __('Subject');?></td>
                        <td><?php echo h($emailTemplate['EmailTemplate']['subject']); ?> &nbsp; </td>
                      </tr>
                      <tr>
                        <td><?php echo __('Description');?></td>
                        <td><?php echo $emailTemplate['EmailTemplate']['description']; ?> &nbsp; </td>
                      </tr>
                      <tr>
                        <td><?php echo __('From');?></td>
                        <td><?php echo h($emailTemplate['EmailTemplate']['from']); ?> &nbsp; </td>
                      </tr>
                      <tr>
                        <td><?php echo __('Reply To Email');?></td>
                        <td><?php echo h($emailTemplate['EmailTemplate']['reply_to_email']); ?> &nbsp; </td>
                      </tr>
                      <tr>
                        <td><?php echo __('Status');?></td>
                        <td><?php if ($emailTemplate['EmailTemplate']['status'] == '1'): ?>
                          <span class='label label-success'>Active</span>
                          <?php else: ?>
                          <span class='label label-warning'>Inactive</span>
                          <?php endif; ?>
                          &nbsp; </td>
                      </tr>
                    
                      <tr>
                        <td><?php echo __('Created');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($emailTemplate['EmailTemplate']['created'])); ?> &nbsp; </td>
                      </tr>
                      <tr>
                        <td><?php echo __('Modified');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($emailTemplate['EmailTemplate']['modified'])); ?> &nbsp; </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
  </div>
  </div>
</aside>
<?php echo $this->Html->script('admin/default.js'); ?> 