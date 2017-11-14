  
 <H3>OS: <?php echo $numero_os; ?></H3>	 
 <?php 
 	echo '<ul class="list-group">';

 	foreach ($resumo_os->result() as $os) {
 	echo '<li class="list-group-item">'.$os->nome_cli."<br>".'</li>';
 	echo '<li class="list-group-item">'.$os->endereco_instalacao_150." - ".$os->bairro_instalacao_150." - ".$os->cidade_instalacao_100.'</li>';
 	echo '<li class="list-group-item">'.$os->tipo_atendimento_100."<br>".'</li>';

 	$cod_tipo_servico = $os->cod_tipo_servico;
 	$obs = $os->obs_os;
 	$cod_servico = $os->cod_servico;
 	$status_os = $os->status_os;
 	}

 	echo '</ul>';
 ?>





<input type="hidden" value="<?php echo $numero_os; ?>" name="numero_os">
<input type="hidden" value="<?php echo $cod_tipo_servico; ?>" name="cod_tipo_servico">
<input type="hidden" value="<?php echo $cod_servico; ?>" name="cod_servico">
<input type="hidden" value="<?php echo $obs; ?>" name="obs"> 
<input type="hidden" value="<?php echo $status_os; ?>" name="status_os"> 
                  

                  