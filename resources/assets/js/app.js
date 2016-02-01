$(document).ready(function() {
    token = $('#token').val();

    url = "http://localhost:8000";

    max_page = $('#lastPage').val();
    count = 2;

    /**
     * Infinite scroll with pagination loading on Home page
     */
    $(window).scroll(function() {
        if($('#scroll').length == 1) {
            if($(window).scrollTop() == $(document).height() - $(window).height())
            {
                if(count > max_page) {
                    return false;
                } else {
                    $('#loader').show();
                    $.ajax({
                        method: "GET",
                        headers: { 'X-XSRF-TOKEN' : token },
                        url: url+"/?page="+count,
                        dataType: "json",
                        success: function(json){
                            if(json.html) {
                                $('.product:last').after(json.html);
                                $('#loader').hide();
                            }
                        }
                    });
                }
                count++;
            }
        }
    });


    /**
     * Display the price calculated on each Product page
     */
    $('#quantity-bloc').each(function()
    {
        $(this).change(function()
        {
            quantity = $(this).val();
            price = $('#price').val();
            total = quantity*price;
            $('#quantity-bloc').next('span').remove();
            $(this).after('<span style="color: #008000; font-weight: bold;">Total: '+total+' €</span>');
        });
    });


    /**
     * Update the quantity and total price on Cart page
     */
    $('.quantity').each(function()
    {
        $(this).change(function()
        {
            product_id = $(this).attr('productId');
            quantity = $(this).val();

            var data = 'product_id='+product_id+'&quantity='+quantity;

            $.ajax({
                 method: 'POST',
                 headers: { 'X-XSRF-TOKEN' : token },
                 url: url+"/updateQuantity",
                 datatype: 'json',
                 data: data,
                 success: function(json)
                 {
                    $('.total_price'+product_id).text(json.price+' €');
                    $('#total').text(json.total+' €');
                 }
             });
        });
    });
});