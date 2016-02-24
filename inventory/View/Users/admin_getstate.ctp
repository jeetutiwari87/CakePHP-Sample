 <?php 
 echo $this->Form->input('User.state_id', array("label" => false, "div" => false, "class" => "selectstate form-control",'onchange'=>'listcity();', 'placeholder'=>__('State'),"data-validation"=>"required","empty"=>__('Select State')));
 ?>