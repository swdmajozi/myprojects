<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="payment.css">
  
 <style>
 .payment-form{
	padding-bottom: 50px;
	font-family: 'Montserrat', sans-serif;
}

.payment-form.dark{
	background-color: #f6f6f6;
}

.payment-form .content{
	box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
	background-color: white;
}

.payment-form .block-heading{
    padding-top: 50px;
    margin-bottom: 40px;
    text-align: center;
}

.payment-form .block-heading p{
	text-align: center;
	max-width: 420px;
	margin: auto;
	opacity:0.7;
}

.payment-form.dark .block-heading p{
	opacity:0.8;
}

.payment-form .block-heading h1,
.payment-form .block-heading h2,
.payment-form .block-heading h3 {
	margin-bottom:1.2rem;
	color: #3b99e0;
}

.payment-form form{
	border-top: 2px solid #5ea4f3;
	box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
	background-color: #ffffff;
	padding: 0;
	max-width: 600px;
	margin: auto;
}

.payment-form .title{
	font-size: 1em;
	border-bottom: 1px solid rgba(0,0,0,0.1);
	margin-bottom: 0.8em;
	font-weight: 600;
	padding-bottom: 8px;
}

.payment-form .products{
	background-color: #f7fbff;
    padding: 25px;
}

.payment-form .products .item{
	margin-bottom:1em;
}

.payment-form .products .item-name{
	font-weight:600;
	font-size: 0.9em;
}

.payment-form .products .item-description{
	font-size:0.8em;
	opacity:0.6;
}

.payment-form .products .item p{
	margin-bottom:0.2em;
}

.payment-form .products .price{
	float: right;
	font-weight: 600;
	font-size: 0.9em;
}

.payment-form .products .total{
	border-top: 1px solid rgba(0, 0, 0, 0.1);
	margin-top: 10px;
	padding-top: 19px;
	font-weight: 600;
	line-height: 1;
}

.payment-form .card-details{
	padding: 25px 25px 15px;
}

.payment-form .card-details label{
	font-size: 12px;
	font-weight: 600;
	margin-bottom: 15px;
	color: #79818a;
	text-transform: uppercase;
}

.payment-form .card-details button{
	margin-top: 0.6em;
	padding:12px 0;
	font-weight: 600;
}

.payment-form .date-separator{
 	margin-left: 10px;
    margin-right: 10px;
    margin-top: 5px;
}

@media (min-width: 576px) {
	.payment-form .title {
		font-size: 1.2em; 
	}

	.payment-form .products {
		padding: 40px; 
  	}

	.payment-form .products .item-name {
		font-size: 1em; 
	}

	.payment-form .products .price {
    	font-size: 1em; 
	}

  	.payment-form .card-details {
    	padding: 40px 40px 30px; 
    }

  	.payment-form .card-details button {
    	margin-top: 2em; 
    } 

	.btn-success {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
	width:100% !important;
}
}</style>
</head>
<body>
  <main class="page payment-page">
    <section class="payment-form dark">
      <div class="container">
        <div class="block-heading">

		<img src="<?php echo base_url();?>/assets/images/logobig.png" class="img-circle" alt="ICS Logo">
        <p>Hello,  MR/MRS <?php echo $lname; ?></br> CONGRATULATIONS! ON  TAKING A SMART STEP</p>
		  <p>SUBSCRIBE <u>NOW</u> TO  GET FINANCIAL FREEDOM BY  CLICKING PAY NOW</p>
        </div>
               <div class="products">
            <h3 class="title">My Profile Summary</h3>
			<h6 class="title">Personal Details</h6>
			<div class="form-group">
			<h7>Your Name: </h7>
			<input id="name_first" name="name_first" value="<?php echo $fname;?>" type="text" disabled>
			</div>
			
			<div class="form-group">
			<h7>Your Surname: </h7>
             <input id="name_last" name="name_last" value="<?php echo $lname;?>" type="text" disabled>
			 </div>

			 <h6 class="title">Contact Details</h6>
			<div class="form-group">
			<h7>Your Email: </h7>
            <input id="email_address" name="email_address" value="<?php echo $email;?>" type="text" disabled>
			</div>
			<div class="form-group">
			<h7>Your Cell#: </h7>
            <input id="email_address" name="email_address" value="<?php echo $pnumbers;?>" type="text" disabled>
			</div>
            <div class="item">
              <span class="price"></span>
              <p class="item-name">Package You Chose:</p>
              <p class="item-description">Package 1</p>
            </div>
           <div class="total">Total Cost:<span class="price">R320.00</span></div>
<br>
<br><br>      
     
  <form action="https://www.payfast.co.za/eng/process" method="post" onsubmit="return checkForm(this);">
    <input id="merchant_id" name="merchant_id" value="11418196" type="hidden">
    <input id="merchant_key" name="merchant_key" value="i1hioxoxqklp8" type="hidden">
    <input id="return_url" name="return_url" value="http://icswebserver.co.za/siyandamadjozi" type="hidden">
    <input id="cancel_url" name="cancel_url" value="http://icswebserver.co.za/siyandamadjozi" type="hidden">
    <input id="notify_url" name="notify_url" value="http://icswebserver.co.za/siyandamadjozi/payfast/itn" type="hidden">
    <input id="name_first" name="name_first" value="<?php echo $fname;?>" type="hidden">
    <input id="name_last" name="name_last" value="<?php echo $lname;?>" type="hidden">
    <input id="email_address" name="email_address" value="<?php echo $email;?>" type="hidden">
	<input id="email_address" name="cell_number" value="<?php echo $pnumbers;?>" type="hidden">
    <input id="m_payment_id" name="m_payment_id" value="TRN1481493600" type="hidden">
    <input id="amount" name="amount" value="5" type="hidden">
    <input id="item_name" name="item_name" value="package1" type="hidden">
    <input id="item_description" name="item_description" value="package description" type="hidden">
	<input type="hidden" name="payment_method" value="cc">
	<input type="hidden" name="email_confirmation" value="1">
    <input type="hidden" name="confirmation_address" value="<?php echo $email;?>">
	<input type="hidden" name="subscription_type" value="1">
    <input type="hidden" name="billing_date" value="2020-01-01">
    <input type="hidden" name="recurring_amount" value="100">
    <input type="hidden" name="frequency" value="3">
    <input type="hidden" name="cycles" value="0">


    

	<p><input type="checkbox" name="terms" required > I accept the <a href="http://icscredit.co.za/home/" target="_blank"> Terms and Conditions</a></p>


    <input type="submit" class="btn btn-success" value="Pay Now">

             
           
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
</body>

<script>


function checkForm(form)
  {
    ...
    if(!form.terms.checked) {
      alert("Please indicate that you accept the Terms and Conditions");
      form.terms.focus();
      return false;
    }
    return true;
  }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>




