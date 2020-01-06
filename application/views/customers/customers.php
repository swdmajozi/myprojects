
<div class="col-md-8 col-md-offset-4 text-center">
    <?php if(isset($message) || validation_errors() !== ''): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <?= isset($message)? $message: ''; ?>
        </div>
    <?php endif; ?>

<div class="form-box">

<?php $formid = array('class' => 'login-form', 'id' => 'myform');
 echo form_open("auth/create_user", $formid, );?>
    <div class="caption">
        <h3 class="box-title">ADD CUSTOMER</h3>
    </div>

      <div class="form-group has-feedback">

            <?php echo form_input($first_name);?>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
            <?php echo form_input($last_name);?>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>
      
    


    <div class="form-group has-feedback">
            <?php echo form_input($email);?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

    </div>

    <div class="form-group has-feedback">
            <?php echo form_input($phone);?>
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>

        </div>

        <div class="form-group has-feedback">
            <?php echo form_input($idnumber);?>
        <span class="glyphicon glyphicon-home form-control-feedback"></span>

    </div>

    <div class="form-group has-feedback">
            <?php echo form_input($address);?>
        <span class="glyphicon glyphicon-home form-control-feedback"></span>

    </div>

    <div class="form-group has-feedback">
            <?php echo form_input($city);?>
        <span class="glyphicon glyphicon-home form-control-feedback"></span>

    </div>

    <div class="form-group has-feedback">
            <?php echo form_input($code);?>
        <span class="glyphicon glyphicon-home form-control-feedback"></span>

    </div>


 
    

        <div class="form-group has-feedback">
            <?php

               $js = 'id="bank" onChange="appendPaymentMethod(); class="form-control-feedback style="width: 100% !important; padding:8px;"';
             echo form_dropdown('bank', $bank,'ABSA', $js);

            
             ?>

  

    </div>


    
    <div class="form-group has-feedback">
           

    <select name="products" id="products"  class=" form-control-feedback=" style="width: 100% !important; padding:8px;">
<option value="CreditRepair">Credit Repair</option>
<option value="CreditCleanUp">Credit CleanUp</option>
<option value="CreditReport">Credit Report</option>
<option value="CreditAssessment">Credit Assessment</option>
</select>

            
        


    </div>

    <div class="form-group has-feedback">
         <input type="text" id="packageAmount"   placeholder="Package Amount" name="packageAmount">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>

        </div>
        <div class="form-group has-feedback">
        <p>Please  select payment date below</p>
        <input type="date" name="billingdate" required>
        </div>
   

  
    <div class="form-group has-feedback">
    <?php $id = "id='submit'";
     echo form_submit('submit', 'Create Customer', $id);?>
    </div>

<?php echo form_close();?>

</div>
    </div>
</div>

<script type="text/javascript">

  
   


    $('#products').change(function(){
        var   productName =  $('#products').val();
     //   alert(productName);
        $('#packageAmount').val("");
  
if(productName == "CreditRepair"){
      amount1 = 258;
      $('#packageAmount').val(amount1);

}else if(productName == "CreditCleanUp"){
    amount1 = 129;
    $('#packageAmount').val(amount1);

}else if(productName == "CreditReport"){
    amount1 = 64;
    $('#packageAmount').val(amount1);

}else{

    amount1 = 395;
    $('#packageAmount').val(amount1);

}
    });





// Ajax post
$(document).ready(function() {
$("#submit").click(function(event) {
event.preventDefault();

var   productName =  $('#products').val();
//check  fo  subscriotions  

if(productName == "CreditAssessment"){
     
     
      subscription_type = null;

}else{
    subscription_type = 1;

}





//$('#packageAmount').val(amount1);



var amount = amount1;
var first_name = $("input#first_name").val();
var last_name = $("input#last_name").val();
var email = $("input#email").val();
var bank = $("#bank").val();
var phone = $("input#phone").val();
var idnumber = $("input#idnumber").val();
var productId = $("input#productId").val();
var amount = $("input#packageAmount").val();
var billingdate = $("input#billingdate").val();
var code = $("input#code").val();
var address = $("input#address").val();
var street = $("input#street").val();

if(first_name == '' || last_name == '' || idnumber == '' || phone == '' ||email == '' ){

alert("Please Fill In All Fields!");


}else{

jQuery.ajax({
type: "POST",
url: "<?php echo base_url(); ?>" + "/accounts/SaveCustomer",
dataType: 'json',
data: {first_name: first_name, last_name: last_name, email:email , bank:bank , phone:phone ,idnumber:idnumber ,billingdate:billingdate,subscription_type:subscription_type,amount:amount,code:code,address:address,street:street },
success: function(res) {

    alert(res);
if (res == 1)
{
    alert("Customer Added Successfully!!!");
window.open(res)
   

}else{

       alert("Failed Please  try again");
}
}
});



}



});
});

</script>