<?php
  foreach ($informacoes->result() as $info) {
?>
  
  
   <ul class="list-group">
    <li class="list-group-item">(<?php echo $info->contrato; ?>) <?php echo $info->nome; ?></li>
    <li class="list-group-item"><?php echo $info->endereco.", ".$info->bairro; ?> - <?php echo $info->cidade; ?></li>
    <li class="list-group-item"><?php echo $info->telefone." ".$info->celular; ?></li>
    <li class="list-group-item">Plano: <?php echo $info->plano; ?></li>

<?php
  }
?> 