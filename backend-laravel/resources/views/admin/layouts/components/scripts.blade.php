<!-- Vendor JS Files -->

<script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/chart.js/chart.umd.js"></script>
<script src="/assets/vendor/echarts/echarts.min.js"></script>
<script src="/assets/vendor/quill/quill.js"></script>
<script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>

<!-- Tagify -->
<script src="/assets/vendor/tagify/tagify.js"></script>
<script src="/assets/vendor/tagify/tagify.polyfills.min.js"></script>

<!-- Template Main JS File -->
<script src="/assets/js/main.js"></script>
<script src="/assets/js/custom.js"></script>

<script>
    function fetchData(url, inputId) {
        let value = [];
        var input = document.getElementById(inputId);
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                data.forEach(element => {
                    value.push(element.name);
                });
                new Tagify(input, {
                    whitelist: value,
                    focusable: false,
                    dropdown: {
                        position: 'input',
                        enabled: 0
                    }
                });
            }
        });
    }

    // Fetch categories for categories input
    fetchData("http://127.0.0.1:8000/api/categories", 'categories-input');

    // Fetch tags for tags input
    fetchData("http://127.0.0.1:8000/api/tags", 'tags-input');
</script>

<script>
    $(document).ready(function() {
        $('.input_number').on('input', function() {
            var value = $(this).val();
            var filteredValue = value.replace(/[^0-9]/g, '');
            $(this).val(filteredValue);
        });
    });
    $(document).ready(function() {
        $('.input_discount').on('input', function() {
            var value = $(this).val();
            var numericValue = value.replace(/[^0-9]/g, '');
            var intValue = parseInt(numericValue);
            if (isNaN(intValue)) {
                intValue = '';
            } else if (intValue > 100) {
                intValue = 100;
            } else if (intValue < 1) {
                intValue = '';
            }
            $(this).val(intValue);
        });
    });
</script>
<script>
    const test = document.querySelector('.img-test');
    test.addEventListener('change', function() {
        console.log(test.files[0].name);
    });
</script>
