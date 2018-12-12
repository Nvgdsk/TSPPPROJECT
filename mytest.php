<script>
    $.ajax({
        type: 'POST',
        url: 'jq_test.php?a=gettest',
        success: function(data) {
            $(".container").html(data);
        }
    });

</script>
