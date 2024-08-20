let nameVariant = $("#open-variant #name-variant")
let priceVariant = $("#open-variant #price-variant")
let salePriceVariant = $("#open-variant #sale-price-variant")
let importPriceVariant = $("#open-variant #import-price-variant")
let idVariant = $("#open-variant #id-variant")
let tbody = $("#data-variant tbody")
let tmpVariant = []


function clearValueVariant(){
    nameVariant.val("")
    priceVariant.val(0)
    salePriceVariant.val(0)
    importPriceVariant.val(0)
    idVariant.val("")
}

function validateVariant(){
    if (
        nameVariant.val() === null ||
        nameVariant.val() === "" ||
        isNumber(priceVariant.val()) ||
        isNumber(salePriceVariant.val()) ||
        isNumber(importPriceVariant.val()) ||
        priceVariant.val() < 1 ||
        salePriceVariant.val() < 1 ||
        importPriceVariant.val() < 1 ||
        priceVariant.val() > 100000000 ||
        salePriceVariant.val() > 100000000 ||
        importPriceVariant.val() > 100000000
    ){
        $.notify("không được bỏ trống các trường và nhỏ nhất là 1 lớn nhất là 100000000", "error");
        return false;
    }
    return true
}

function openModalVariant(){
    clearValueVariant()
    $("#open-variant").modal("show");
}

function hiddenModalVariant() {
    clearValueVariant()
    $("#open-variant").modal("hide");
}


$(document).ready(function(){
    $('#open-variant').on('hidden.bs.modal', function () {
        clearValueVariant()
    });
});
