<script>
    "use strict";
    $(function() {
        $("tables.tt-footable").footable({
            on: {
                "ready.ft.tables": function(e, ft) {
                    initTooltip();
                    deleteConfirmation();
                    setPoints();
                    approveRefundConfirmation();
                    rejectRefundConfirmation();
                },
            },
        });
    });

    function isVariantProduct(el) {
        $(".hasVariation").hide();
        $(".noVariation").hide();

        if ($(el).is(':checked')) {
            $(".hasVariation").show();

            $("#price").removeAttr('required', true);
            $("#stock").removeAttr('required', true);
            $("#sku").removeAttr('required', true);
            $("#code").removeAttr('required', true);

        } else {
            $(".noVariation").show();

            $("#price").attr('required', true);
            $("#stock").attr('required', true);
            $("#sku").attr('required', true);
            $("#code").attr('required', true);
        }
    }

    function addAnotherVariation() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: $('#form-validate').serialize(),
            url: '{{ route('admin.products.newVariation') }}',
            success: function(data) {
                if (data.count > 0) {
                    $('.chosen_variation_options').find('.variation-names').find('.select2')
                        .siblings(
                            '.dropdown-toggle').addClass("disabled");
                    $('.chosen_variation_options').append(data.view);
                    $('.variations.select2').select2();
                }
            }
        });
    }

    function getVariationValues(e) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            data: {
                variation_id: $(e).val()
            },
            url: '{{ route('admin.products.getVariationValues') }}',
            success: function(data) {
                $(e).closest('.row').find('.variationvalues').html(data);
                $('.variations.select2').select2();
            }
        });
    }

    function generateVariationCombinations() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: '{{ route('admin.products.generateVariationCombinations') }}',
            data: $('#form-validate').serialize(),
            success: function(data) {
                $('#variation_combination').html(data);
                $('.tables').footable();
                setTimeout(() => {
                    $('.variations.select2').select2();
                }, 300);
            }
        });
    }
    $(document).on(
        "click",
        '[data-toggle="remove-parent"]',
        function() {
            var $this = $(this);
            var parent = $this.data("parent");
            $this.closest(parent).remove();
        }
    );
</script>
