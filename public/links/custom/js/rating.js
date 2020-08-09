$(document).ready(function() {
    $(document).on("click", ".p-rating a", function(e) {
        e.preventDefault();
        var el = $(this);
        var value = el.data("value");
        alert(value);
        $.ajax({
            type: "get",
            url: "{{ route('ajaxReview.rating') }}",
            data: { id: value },
            success: function(data) {
                console.log(data);
                // $(".itemCountAjax").text(data);
            },
            error: function() {}
        });
    });
});
