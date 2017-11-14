<?php
$row = $caixa->row(0);
?>
<form action="" method="post">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Editar Caixa <strong class="text-danger"><?php  echo $row->codigo; ?></strong></h4>
</div>
  <div class="modal-body">
      
          <div class="form-group col-md-4">
             <label>Tipo de Caixa</label>
             <select name="tipo" class="form-control" required>
                 <option value="">Selecione...</option>
                 <option value="C" <?php if($row->tipo == 'C'){ echo 'selected="selected"';} ?> >Conectorizada</option>
                 <option value="D" <?php if($row->tipo == 'D'){ echo 'selected="selected"';} ?> >Derivação</option>
             </select>
          </div>

          <div class="form-group col-md-4">
             <label>Complemento</label>
             <select name="complemento" class="form-control">
                 <option value="">Selecione...</option>
                 <option value="-A" <?php if(strpos($row->codigo, '-A')>=1){ echo 'selected="selected"'; } ?> >Caixa A</option>
                 <option value="-B" <?php if(strpos($row->codigo, '-B')>=1){ echo 'selected="selected"'; } ?> >Caixa B</option>
                 <option value="-C" <?php if(strpos($row->codigo, '-C')>=1){ echo 'selected="selected"'; } ?> >Caixa C</option>
             </select>
          </div>

          <div class="form-group col-md-4">
             <label>Rede</label>
             <select name="rede" class="form-control" required>
                 <option value="">Selecione...</option>
                 <option value="EPON" <?php if($row->rede == 'EPON'){ echo 'selected="selected"';} ?> >EPON</option>
                 <option value="GPON" <?php if($row->rede == 'GPON'){ echo 'selected="selected"';} ?> >GPON</option>
             </select>
          </div>

          <div class="form-group col-md-12">

             <label>Central</label>
             <select name="cod_central" class="form-control" required>
                 <option value="">Selecione...</option>
                  <?php
                    foreach ($centrais->result() as $central) {
                  ?>
                    
                 <option value="<?php echo $central->cod_central; ?>" <?php if($row->cod_central == $central->cod_central){ echo 'selected="selected"';} ?> ><?php echo $central->descricao; ?></option>

                  <?php
                    }
                  ?>
                  
             </select>

          </div>

          <div class="col-md-12">
            <label>Código <small class="text-danger">Só preencha se for código novo sem cep</small></label>
            <input type="text" name="codigo" class="form-control" value="<?php  echo $row->codigo; ?>" >
          </div>

          <div class="form-group col-md-4">
              <label>CEP</label>
              <input type="text" class="form-control" value="<?php  echo $row->cep; ?>" name="cep">
          </div>

          <div class="form-group col-md-4">
              <label>Total de Portas</label>
              <input type="text" class="form-control" value="<?php  echo $row->num_portas_total; ?>" name="num_portas_total">
          </div>

          <div class="form-group col-md-4">
              <label>Portas Disponíveis</label>
              <input type="text" class="form-control" value="<?php  echo $row->num_portas_disponiveis; ?>" name="num_portas_disponiveis">
          </div>

          <div class="form-group col-md-9 col-sm-12">
              <label>Lugradouro <small style="color: #CCC">Ex.: Rua A, Av. 123</small></label>
              <input type="text" class="form-control" value="<?php  echo $row->endereco; ?>" name="endereco">
          </div>

          <div class="form-group col-md-3 col-sm-12">
              <label>Número</label>
              <input type="text" class="form-control" value="<?php  echo $row->numero; ?>" name="numero">
          </div>

          <div class="form-group col-md-6">
              <label>Bairro</label>
              <input type="text" class="form-control" value="<?php  echo $row->bairro; ?>" name="bairro">
          </div>

          <div class="form-group col-md-6">
              <label>Cidade</label>
              <input type="text" class="form-control" value="<?php  echo $row->cidade; ?>" name="cidade">
          </div>

          <div class="form-group col-md-6">
              <label>Latitude</label>
              <input type="text" class="form-control" value="<?php  echo $row->latitude; ?>" name="latitude">
          </div>

          <div class="form-group col-md-6">
              <label>Longitude</label>
              <input type="text" class="form-control" value="<?php  echo $row->longitude; ?>" name="longitude">
          </div>

          <div class="col-md-12">
              <label>Observações</label>
              <textarea name="obs" value="<?php  echo $row->obs; ?>" class="form-control"></textarea>
          </div>

  </div>
  <div class="clearfix"></div>
  <hr>
  <div class="modal-footer">
      <input type="hidden" name="cod_caixa" value="<?php  echo $row->cod_caixa; ?>">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
      <input type="submit" class="btn btn-primary" name="atualizar" value="Atualizar">
 </div>

</form>