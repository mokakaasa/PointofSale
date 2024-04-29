const getTotalAmount = () => {
    const quantityField = document.getElementById('quantity');
    const soldPriceField = document.getElementById('sold_price');
    const totalAmountField = document.getElementById('total_amount');

    if (Number(quantityField.value) && Number(soldPriceField.value)) {
        totalAmountField.value = Number(quantityField.value) * Number(soldPriceField.value);
    }
}

$(document).ready(function(){
    $("#product_id").change(function(){
        let productId= $("#product_id").val();
        let searchParams = new URLSearchParams()
        searchParams.set('id', productId);
        $.get("/product/get-expected-price?" + searchParams.toString(),function(data, status){
            $("#expected_price").val(data);

        });
    });
});