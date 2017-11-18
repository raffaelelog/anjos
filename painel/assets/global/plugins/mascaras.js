/*!
 * Mascaras v1.0 for Thiago
 * Copyright 2016 City10
 */

function mascara(o, f) {
	v_obj = o;
	v_fun = f;
	setTimeout("v_obj.value = v_fun(v_obj.value)", 1);
}

function mdata(v) {
	v = v.replace(/\D/g, "")
	//Remove tudo o que não é dígito
	v = v.replace(/(\d{2})(\d)/, "$1/$2")
	v = v.replace(/(\d{2})(\d)/, "$1/$2")
	v = v.replace(/(\d{2})(\d{2})$/, "$1$2")
	return v
}

function emailr(v) {
	v = v.replace(/( ){2,}/g, '$1', "")
	return v
}

function nome(v) {
	v = v.replace("[\\s]", " ")//Remove numeros
	v = v.replace(/\d/g, "")//Remove numeros
	v = v.replace(/( ){2,}/g, '$1', "")
	return v
}

function cpfform(v) {
	v = v.replace(/\D/g, "")//Remove tudo o que não é dígito
	v = v.replace(/(\d{3})(\d)/, "$1.$2")
	//Coloca um ponto entre o terceiro e o quarto dígitos
	v = v.replace(/(\d{3})(\d)/, "$1.$2")
	//Coloca um ponto entre o terceiro e o quarto dígitos
	v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
	//Coloca um hífen entre o terceiro e o quarto dígitos
	return v
}

function telefone(v) {
	v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{5})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
    return v

}

function cnpj(v) {
	v = v.replace(/\D/g, "");
	//Remove tudo o que não é dígito
	v = v.replace(/^(\d{2})(\d)/, "$1.$2");
	//Coloca ponto entre o segundo e o terceiro dígitos
	v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
	//Coloca ponto entre o quinto e o sexto dígitos
	v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
	//Coloca uma barra entre o oitavo e o nono dígitos
	v = v.replace(/(\d{4})(\d)/, "$1-$2");
	//Coloca um hífen depois do bloco de quatro dígitos
	return v;
}

function buscaCidades(estado) {
	$('#cidade').empty();
	$.ajax({
		type : "POST",
		data : {
			uf : estado
		},
		url : "http://localhost/hotspot/index/buscaCidades",
		dataType : "html",
		success : function(result) {
			$('#cidade').html(result);
		},
		beforeSend : function() {
			$('.carregando').removeClass('hidden');
			$('.carregado').addClass('hidden');
		},
		complete : function(msg) {
			$('.carregado').removeClass('hidden');
			$('.carregando').addClass('hidden');
		}
	});
}

$(function() {

	$(".datepicker").datepicker();
});
$(".datepicker").datepicker({
	changeMonth : true,
	changeYear : true,
	maxDate : '-18y',
	yearRange : '-100:-18',
	dateFormat : "dd-mm-yy",
	dayNames : ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
	dayNamesMin : ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
	dayNamesShort : ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
	monthNames : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
	monthNamesShort : ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
	nextText : 'Próximo',
	prevText : 'Anterior'
});
$(".lancar_entrada").submit(function() {
	$("#loadergif").show();
}); 