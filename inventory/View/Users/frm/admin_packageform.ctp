<?php

app::import("Model","User");
$user_obj=new User();
?>
<div id="stntab1" class="tab-pane active">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Add Package information');?></h3>
    </div>
        <div class="form-group">        
        <?php 
        /*if(isset($this->request->data['UserPayment']['id']) && !empty($this->request->data['UserPayment']['id']))
        {
        ?>
        <label><span class="required"></span><?php echo __('Package Term');?> : </label>
        <?php
            switch ($this->request->data['UserPayment']['payment_term']) {
                    case 'monthy':
                        echo "Monthy";
                        break;
                    case 'quarterly':
                        echo "Quarterly";
                        break;
                    case 'yearly':
                        echo "Yearly";
                        break;
                }
        }
        else
        {*/
        ?>
        <label><span class="required">*</span><?php echo __('Package Term');?></label>
        <?php
        echo $this->Form->input('UserPayment.payment_term', array("label" => false, "div" => false, "class" => "form-control","type"=>"select","options"=>Configure::read('UserPayment.payment_term'), 'placeholder'=>__('Package Term'),"data-validation"=>"required","empty"=>__('Package Term')));
        //}
        ?>
    </div>
    <div class="form-group">        
        <?php
        /*if(isset($this->request->data['UserPayment']['id']) && !empty($this->request->data['UserPayment']['id']))
        {
         ?>
        <label><span class="required"></span><?php echo __('Package Type');?> : </label>
        <?php
        $Packagedata = ClassRegistry::init('Package')->find('first', array('conditions' => array('Package.id' => $this->request->data['UserPayment']['package_id']), 'fields' => array('Package.package_name')));
        echo $Packagedata['Package']['package_name'];
        }
        else {*/
        ?>
        <label><span class="required">*</span><?php echo __('Select Package');?></label>
        <?php
        echo $this->Form->input('UserPayment.package_id', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Select Package'),"data-validation"=>"required","empty"=>__('Select Package'))); 
       // }
        ?>
    </div>

    <div class="form-group">
        <label><span class="required"></span><?php echo __('Extend Day');?></label>
 <?php 
// if(isset($this->request->data['UserPayment']['id']) && !empty($this->request->data['UserPayment']['id']))
// {
// echo $this->Form->hidden('UserPayment.book_date'); 
// echo $this->Form->hidden('UserPayment.expire_date');
// }
 echo $this->Form->hidden('UserPayment.id'); 
 echo $this->Form->hidden('UserPayment.user_id',array('value'=>$id)); 
 echo $this->Form->input('UserPayment.extend_day', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Extend Day'),"data-validation"=>"number positive")); ?>
    </div>
</div>
<?php echo $this->Html->script('admin/default.js'); ?>	

