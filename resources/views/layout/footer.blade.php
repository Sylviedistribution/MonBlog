<footer class="row tm-row">
    <div class="col-md-6 col-12 tm-color-gray">
        Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-external-link">TemplateMo</a>
    </div>
    <div class="col-md-6 col-12 tm-color-gray tm-copyright">
        Copyright 2020 Xtra Blog Company Co. Ltd.
    </div>
</footer>
</main>
</div>
<script src="{{asset("js/jquery.min.js")}}"></script>
<script src="{{asset("js/templatemo-script.js")}}"></script>
<script src="{{asset("js/bootstrap.bundle.min.js")}}"></script>

<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>s

</body>
</html>
