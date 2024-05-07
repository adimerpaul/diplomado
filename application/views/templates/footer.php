

</div>
</div><!-- /.main-content -->

<div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Postgrado UTO</span>
							Application &copy; <?=date('Y')?>-<?=date('Y')+1?>
						</span>

        </div>
    </div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
<script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='<?=base_url()?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

<script src="<?=base_url()?>assets/js/ace-elements.min.js"></script>
<script src="<?=base_url()?>assets/js/ace.min.js"></script>
<link href="https://select2.github.io/select2/select2-3.5.3/select2.css" rel="stylesheet" />
<script src="https://select2.github.io/select2/select2-3.5.3/select2.js"></script>

<?=$js?>



<script>
    $(document).ready(function() {
        // Función para convertir a mayúsculas solo si el campo es de tipo texto
        function convertirAMayusculas(input) {
            console.log(input);
            if (input.type === 'text') {
                input.value = input.value.toUpperCase();
            }
        }

// Obtener todos los elementos de entrada
        var inputs = document.querySelectorAll('input');

// Iterar sobre cada elemento de entrada y asignar el evento input
        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                convertirAMayusculas(this);
            });
        });
        $('#example').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
        });
    });
</script>
<style>
    div.dataTables_wrapper input[type="search"] {
        width: 400px; /* Cambia este valor según tu preferencia */
        padding: 5px; /* Ajusta el relleno según sea necesario */
        margin-bottom: 10px; /* Ajusta el margen inferior según sea necesario */
    }
</style>
<!-- inline scripts related to this page -->
</body>
</html>
