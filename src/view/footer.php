

    <!-- <footer class="page-footer orange">
        <div class="container align-right">
            &copy; 2018 Tom Hanover
            <br>
            <br>

        </div>
    </footer> -->


    <!--  Scripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/materialize.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems);
    });
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
    document.addEventListener('DOMContentLoaded', function() {
        var elem = document.querySelector('.collapsible.expandable');
        var instance = M.Collapsible.init(elem, {accordion: false });
    });
    
    </script>

</body>

</html>