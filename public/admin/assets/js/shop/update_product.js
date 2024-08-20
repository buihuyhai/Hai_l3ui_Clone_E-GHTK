let productId = $("#id")
let variantImportId = $("#id-variant-import")
async function genProduct() {
    let response = await api.getProductById({ id: productId.val() })
    if (Object.keys(response).length !== 0) {
        let data = response.data;
        console.log(data)
        $("#name").val(data.name).prop("readonly", false)
        $("#price").val(data.price).prop("readonly", false)
        $("#sale-price").val(data.sale_price).prop("readonly", false)
        $("#slug").val(data.slug).prop("readonly", false)
        $("#select-category").val(data.category_id).prop("readonly", false).trigger("change")
        $("#description").val(data.description).prop("readonly", false)
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
        $("#blah").attr("src", `${baseUrl}storage/${data.thumbnail}`)
            .attr("width", 150)
            .attr("height", 150)
        genTableVariant(data.variants)
        tmpVariant = data.variants
    }
}

async function updateProduct() {
    let thumbnailInput = $('#thumbnail')[0]
    let product = productId.val()

    let formProductUpdated = new FormData();
    formProductUpdated.append('name', $("#name").val());
    formProductUpdated.append('price', $("#price").val());
    formProductUpdated.append('sale_price', $("#sale-price").val());
    formProductUpdated.append('slug', $("#slug").val());
    formProductUpdated.append('thumbnail', thumbnailInput.files.length > 0 ? thumbnailInput.files[0] : '');
    formProductUpdated.append('category_id', $("#select-category").val());
    formProductUpdated.append('description', $("#description").val());
    let response = await api.updateProduct({ formProductUpdated, product })
    if (response.success) {
        $.notify("update success", "success");
    } else {
        $.notify(response.message, "error");
    }
}
function openUpdateVariantInUpdate(index) {
    if (index === null) {
        $.notify("id not null", "error")
    }
    let variantUpdate = tmpVariant[index]
    openModalVariant()
    nameVariant.val(variantUpdate.name)
    priceVariant.val(variantUpdate.price)
    salePriceVariant.val(variantUpdate.sale_price)
    importPriceVariant.val(variantUpdate.import_price)
    idVariant.val(variantUpdate.id)
}
//
async function deleteVariantInUpdate(index) {
    if (index === null) {
        $.notify("id not null", "error")
    }

    let confirmDelete = confirm("Bạn có chắc chắn muốn xóa phần tử này không?");

    if (confirmDelete) {
        let variant = {
            id: index,
        }
        let product = productId.val()

        let response = await api.deleteVariant({ variant, product })
        if (response.success) {
            $.notify("create success", "success");
        } else {
            $.notify(response.message, "error");
        }
    }
    genProduct(tmpVariant)

}

async function createVariantInUpdate() {
    let variant = {
        name: nameVariant.val(),
        price: priceVariant.val(),
        sale_price: salePriceVariant.val(),
        import_price: importPriceVariant.val()
    }
    let product = productId.val()
    let response = await api.createVariant({ variant, product })
    if (response.success) {
        $.notify("create success", "success");
    } else {
        $.notify(response.message, "error");
    }
}
async function updateVariantInUpdate() {
    let variant = {
        name: nameVariant.val(),
        price: priceVariant.val(),
        sale_price: salePriceVariant.val(),
        import_price: importPriceVariant.val(),
        id: idVariant.val()
    }

    let product = productId.val()
    let response = await api.updateVariant({ variant, product })
    if (response.success) {
        $.notify("update success", "success");
    } else {
        $.notify(response.message, "error");
    }
}

function submitVariantInUpdate() {
    let validate = validateVariant()
    if (!validate) {
        return false;
    }


    if (idVariant.val() === "") {
        createVariantInUpdate()
    }
    else {
        updateVariantInUpdate()
    }

    genProduct(tmpVariant)

    hiddenModalVariant()

}


function genTableVariant(arrayVariant = []) {
    let html = ""
    arrayVariant.map((value, index) => {
        html += `
            <tr>
                <td>${index + 1}</td>
                <td>${value.name}</td>
                <td>${value.stock}</td>
                <td>${value.price}</td>
                <td>${value.sale_price}</td>
                <td>${value.import_price}</td>
                <td>
                    <button class="btn btn-warning" onclick="openUpdateVariantInUpdate(${index})" >Sửa</button>
                    <button class="btn btn-warning" onclick="openImportProduct(${value.id})" >Nhập kho</button>
                    <button class="btn btn-danger" onclick="deleteVariantInUpdate(${value.id})">Xoá</button>
                </td>
            </tr>
        `
    })
    tbody.html(html)
}

function openImportProduct(id) {
    if (id === null) {
        $.notify("id not null", "error")
    }
    variantImportId.val(id)
    $('#open-import_product #number-import').val(0)
    $('#open-import-product').modal('show')
}
async function submitImportVariant() {
    let id = variantImportId.val()
    let number = $("#number-import").val()
    let response = await api.importProduct({ id, number })
    if (response.success) {
        $.notify("update success", "success");
    } else {
        $.notify(response.message, "error");
    }

    $('#open-import-product').modal('hide')

    genProduct()

}



$(document).ready(function () {
    genProduct();
});
