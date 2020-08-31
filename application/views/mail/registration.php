<!DOCTYPE html>
<html lang="en">
<head>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;500;600&display=swap" rel="stylesheet">
	<style>
		.email-otp{
			width: 60%;
			position: relative;
			margin: 0 auto;
			text-align: center;
			display: block;
			padding: 80px 0px;
		}
		.tb-center{
			margin-left: auto;
			margin-right: auto;

		}
		h4{
			padding-bottom: 60px;
			font-weight: 500;
			font-size: 20px;
			line-height: 20px;
			color: #3b3939;
			letter-spacing: 1px;
		}

		table,tr,td{

			border: 1px solid #aaa5a5;
			border-radius: 5px;
		}
		 p{
			padding: 0px;
			margin: 0px;
		 }
		 h4,span,p{
			font-family: 'Raleway', sans-serif;
		 }
		 span{
			font-size: 18px;
			font-weight: 400;
			color: #3b3939;
			line-height: 38px;
			letter-spacing: 1px;
		 }
		 
		 td{
			padding: 6px 8px;
			font-size: 25px;
		 }
		 p{
			color: #ea5e17;
			font-size: 15px;
			font-weight: 500;
			line-height: 18px;

		   }
		  img{
		  width:100%;
		  padding: 40px 0px;

		  }
		  .space{

			padding-bottom: 80px;
		  }
		  .img-otp{

			width: 30%;
			position: relative;
			margin: 0 auto;

		  }
	</style>
</head>
<body>
	<div class="email-otp">
		<h2>Dear <?= $name ?>,<br> Thank you for registering with <strong style="color: #ea5e17;"> Call Metrics </strong> powered by <a href="http://www.shoptexto.com" target="_blank">www.shoptexto.com</a>. Please use the PIN below to compete your account activation  and get strated. </h2>
		<div class="space">
		<span>Your PIN</span>
		<table class="tb-center">
			<tr>
				<td><?= $otp[0] ?></td>
				<td><?= $otp[1] ?></td>
				<td><?= $otp[2] ?></td>
				<td><?= $otp[3] ?></td>
				<td><?= $otp[4] ?></td>
				<td><?= $otp[5] ?></td>
				<td><?= $otp[6] ?></td>
				<td><?= $otp[7] ?></td>
			</tr>
		</table>
        </div>
		<p>
			This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. You cannot use or forward any attachments in the email. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system.
		</p>
		<div class="img-otp">		
			<a target="_blank" href="<?= $this->config->config['appLink'] ?>"><img src="<?= base_url('asset/') ?>playstore.png"></a>
        </div>
	</div>
</body>
</html>	
