jkjkkjj
<?php
// Conexão
$mysqli_city10 = new mysqli('conexao-cad10.city10.com.br', 'edgar', 'jk*85t78', 'cad10');

$sql = "
    SELECT
    *
    FROM 
    cad_caixas
    WHERE 
    cad_tipo IN (1,2,6)
";


$query = $mysqli_city10->query($sql);


foreach ($query as $dados) {


    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'CO':
            $cod_central = 1;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'MM':
            $cod_central = 2;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'DC':
            $cod_central = 3;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'VASC':
            $cod_central = 4;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'AC':
            $cod_central = 5;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'CDR':
            $cod_central = 6;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'JPII':
            $cod_central = 8;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'IPANEMA':
            $cod_central = 9;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'CA':
            $cod_central = 10;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'DDC':
            $cod_central = 12;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'PG':
            $cod_central = 13;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'RSQ':
            $cod_central = 14;
            break;
        

    /*cod_central*/
    switch ($dados['cad_central']) {
        case 'SF':
            $cod_central = 15;
            break;


        default:
            $cod_central = 1;
            break;
    }


    if($dados['cad_tipo'] = 1){$tipo = 'C'}; if($dados['cad_tipo'] = 6){$tipo = 'D'};
    echo $codigo = $dados['cad_caixa'];
    echo $num_portas_total = $dados['cad_numpt'];
    echo $num_portas_disponiveis = $dados['cad_numpd'];
    echo $rede = $dados['cad_rede'];
    echo $endereco = $dados['cad_end'];
    echo $numero = $dados['cad_num'];
    echo $bairro = $dados['cad_bairro'];
    echo $cidade = $dados['cad_cidade'];
    echo $cep = $dados['cad_cep'];
    echo $latitude = $dados['latitude'];
    echo $longitude = $dados['longitude'];
    echo $obs = $dados['cad_obs'];


            $mysqli = new mysqli('187.85.85.101', 'conectdb', 's%oPftY*&690', 'isp_city10');

            $sql_insert = "
                INSERT INTO isp_city10.redes_caixas (cod_central, tipo, codigo, num_portas_total, num_portas_disponiveis, rede, endereco, numero, bairro, cidade, cep, latitude, longitude, obs) 
    VALUES ('$cod_central', '$tipo', '$codigo', $num_portas_total, $num_portas_disponiveis, '$rede', '$endereco', $numero, '$bairro', '$cidade', '$cep', '$latitude', '$longitude', '$obs');

            ";


            $mysqli->query($sql_insert);



}/*End Foreach*/


 /************************************************
        FIM LIBERAÇÃO DE CRÉDITO FREE
************************************************/