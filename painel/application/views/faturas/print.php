<!DOCTYPE html>
<html>
<head>
	<title>Impressão</title>

	<style type="text/css">

	@media print {
		.quebra_pagina {page-break-after: always;}

		html, body {
			width: 210mm;
			height: 297mm;
			margin: 10mm;
		}
	}

	@page {
		size: A4;
		margin: 0;
	}

	.fatura{
		height: 28%;
		border: 1px solid #000;
		padding: 15px;
		width: 180mm;
		overflow: auto;
	}
	.dados{
		float: left;
		width: 60%;
	}
	.valor{
		float: right;
		width: 30%;
	}
	.img{

	}
	html, body{
		font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
	}

	.col-left{
		width: 20%;
		float: left;
		min-height: 100%;
	}
	.col-right{
		width: 75%;
		float: right;
		border-left: 1px dashed #000;
	}



</style>
</head>
<body>
	<?php $contador=1; ?>
	<?php foreach ($faturas_print->result() as $fat): ?>
		<div class="fatura 
		<?php if($contador == 3){ echo "quebra_pagina"; $contador = 1;}else{$contador++;} ?>
		">
			
			<div class="col-left">
				<h3>Fat.: <?php echo $fat->cod_fatura; ?></h3>
				<?php echo $fat->nome; ?><br>
				<?php echo $fat->telefone; ?><br><br>
				<strong><?php echo "R$ ".$fat->valor; ?></strong><br>


			</div>
			<div class="col-right">
				<div class="img">
					<div style="float: left; width: 250px; width: 25%"><img src="<?php echo base_url('assets/img/'); ?>logo.jpg" height="150px"></div>
					<div style="float: right; text-align: center; width: 70%">
						<h4>Anjos Solidários<br>
						 CNPJ: 028.392.874/0001-50<br>
						 Avenida José F. B. F. de Abreu, 444,<br>
						 36202-287 - Barbacena - MG</h4>
						 <hr>
						 <img src="<?php echo base_url('assets/img/'); ?>assinatura.png" style="max-height: 150px; max-width: 50%;">
					</div>
				</div>
				<div class="dados" style="clear:both;">
					<div class="campos" style="font-weight: bold; font-size: 20px;"> <?php echo $fat->nome; ?> </div>
					<div class="campos"> Endereço: <?php echo $fat->endereco.", ".$fat->numero." - "." ".$fat->bairro." - ".$fat->cidade."/".$fat->estado; ?> </div>
					<div class="campos"> Telefone: <?php echo $fat->telefone; ?> Obs: <small><?php echo $fat->obs; ?></small></div>
				</div>
				<div class="valor">
					<span style="font-size: 22px;"><?php echo "R$ ".$fat->valor; ?></span><br>
					<?php echo data_ptbr($fat->valor); ?>
				</div>
			</div>

		</div>
	<?php endforeach ?>
</body>
</html>