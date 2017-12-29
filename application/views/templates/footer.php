</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/Sistema.js"></script>

<!---->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<!---->
<?= MODALES ?>
<script>
    $(function () {
        var prevdefs = $('.preventDefault');
        prevdefs.each(function (k, v) {
            v.addEventListener('submit', function (e) {
                e.preventDefault();
            })
        });
        var focusselect = $('.focus-select');
        focusselect.each(function (k, v) {
            v.addEventListener('focus', function (e) {
                e.preventDefault();
                $(v).select();
            });
        });

        if (busquedainput.value.length > 0) {
            mostrarInfoProveedor(busquedainput.value)
        }
    });

    $('input[name="fechas"]').daterangepicker();
    document.getElementById('fechas').value = '';


</script>
</body>
</html>