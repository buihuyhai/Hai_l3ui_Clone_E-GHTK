async function createProduct() {
    let thumbnailInput = $('#thumbnail')[0]

    let formProductCreated = new FormData();
    formProductCreated.append('name', $("#name").val());
    formProductCreated.append('price', $("#price").val());
    formProductCreated.append('sale_price', $("#sale-price").val());
    formProductCreated.append('slug', $("#slug").val());
    formProductCreated.append('thumbnail', thumbnailInput.files.length > 0 ? thumbnailInput.files[0] : '');
    formProductCreated.append('category_id', $("#select-category").val());
    formProductCreated.append('description', $("#description").text());
    formProductCreated.append('variant', JSON.stringify(tmpVariant));
    let response = await api.createProduct({formProductCreated})
    if (response.success) {
        $.notify("create success", "success");
        window.location.href = `${baseUrl}shops/products`;
    } else {
        $.notify(response.message, "error");
    }
}


function openUpdateVariantInCreate(index){
    if (index === null) {
        $.notify("id not null", "error")
    }
    let variantUpdate = tmpVariant[index]
    openModalVariant()
    nameVariant.val(variantUpdate.name)
    priceVariant.val(variantUpdate.price)
    salePriceVariant.val(variantUpdate.sale_price)
    importPriceVariant.val(variantUpdate.import_price)
    idVariant.val(index)
}

function deleteVariantInCreate(index){
    if (index === null) {
        $.notify("id not null", "error")
    }

    let confirmDelete = confirm("Bạn có chắc chắn muốn xóa phần tử này không?");

    if (confirmDelete) {
        tmpVariant.splice(index, 1);
        $.notify("variant đã được xoá", "success")
    } else {
        $.notify("variant đã không được xoá", "error")
    }
    genTableVariant(tmpVariant)

}




function createVariantInCreate(){
    tmpVariant.push({
        name : nameVariant.val(),
        price : priceVariant.val(),
        sale_price : salePriceVariant.val(),
        import_price : importPriceVariant.val()
    })
}
function updateVariantInCreate(){
    tmpVariant[idVariant.val()] ={
        name : nameVariant.val(),
        price : priceVariant.val(),
        sale_price : salePriceVariant.val(),
        import_price : importPriceVariant.val()
    }
}

function submitVariantInCreate(){
    let validate = validateVariant()
    if (!validate){
        return false;
    }

    if(idVariant.val() === ""){
        createVariantInCreate()
    }else {
        updateVariantInCreate()
    }

    genTableVariant(tmpVariant)

    hiddenModalVariant()
    $.notify("done","info")

}


function genTableVariant(arrayVariant = []){
    let html = ""
    arrayVariant.map((value, index) => {
        html += `
            <tr>
                <td>${index + 1}</td>
                <td>${value.name}</td>
                <td>${value.price}</td>
                <td>${value.sale_price}</td>
                <td>${value.import_price}</td>
                <td>
                    <button class="btn btn-warning" onclick="openUpdateVariantInCreate(${index})" >Sửa</button>
                    <button class="btn btn-danger" onclick="deleteVariantInCreate(${index})">Xoá</button>
                </td>
            </tr>
        `
    })
    tbody.html(html)
}
$(function () {
    $("#description").summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['codeview']],
        ],
        disableResizeEditor: true
    });
});