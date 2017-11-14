	<div class="page-footer">
		<div class="page-footer-inner" align="center">Operate - <?php echo '2017'; ?> &copy; City10 Telecom | TI - Desenvolvimento
        	<div class="scroll-to-top">
				<i class="icon-arrow-up"></i>
			</div>
		</div>
	</div>
	<!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/global/plugins/ie8.fix.min.js"></script> 
    <![endif]-->
	<!-- BEGIN CORE PLUGINS -->
	<script
			  src="https://code.jquery.com/jquery-2.2.4.js"
			  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
			  crossorigin="anonymous"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?php echo base_url(); ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
	<!-- END THEME GLOBAL SCRIPTS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME LAYOUT SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
	<!-- END THEME LAYOUT SCRIPTS -->
	<!-- BEGIN MASK -->
	<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/jquery.maskedinput.min.js" type="text/javascript"></script>
	<!-- END MASK -->
	<!-- BEGIN DATATABLE -->
	<script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
	<!-- END DATATABLE -->

	<script type="text/javascript">
		
function maskIt(w,e,m,r,a){



// Cancela se o evento for Backspace

if (!e) var e = window.event

if (e.keyCode) code = e.keyCode;

else if (e.which) code = e.which;



// Variáveis da função

var txt = (!r) ? w.value.replace(/[^\w]+/gi,'') : w.value.replace(/[^\w]+/gi,'').reverse();

var mask = (!r) ? m : m.reverse();

var pre = (a ) ? a.pre : "";

var pos = (a ) ? a.pos : "";

var ret = "";



if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;



// Loop na máscara para aplicar os caracteres

for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){

if(mask.charAt(x)!='#'){

ret += mask.charAt(x); x++;

} else{

ret += txt.charAt(y); y++; x++;

}

}



// Retorno da função

ret = (!r) ? ret : ret.reverse()

w.value = pre+ret+pos;

}



// Novo método para o objeto 'String'

String.prototype.reverse = function(){

return this.split('').reverse().join('');

};
	</script>