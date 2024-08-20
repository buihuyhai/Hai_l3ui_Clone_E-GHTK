
async function genListProduct(pageNum = 1, name = "", category = null) {
    let response = await api.getListProduct({pageNum, name,category})
    if(Object.keys(response).length !== 0) {
        let data = response.data.products;
        let page = response.data.paginate;
        // Get the tbody element
        let tbody = $('#data-product tbody');
        let paginate = $('#paginate');
        tbody.html("")

        let html = "";
        let htmlPaginate = "";
        // Loop through each product and create a row
        data.map((value, index) => {
            let price = formatNumberToVND(value.price != null ? value.price : 0)
            let salePrice = formatNumberToVND(value.sale_price != null ? value.sale_price : 0)
            html += `
                <tr>
                    <td>${index+1}</td>
                    <td>
                        <img src="${baseUrl}storage/${value.thumbnail}" class="img-fluid img-thumbnail" alt="Sheep" width="150" height="150">
                    </td>
                    <td>${value.name}</td>
                    <td>${price}</td>
                    <td>${salePrice}</td>
                    <td>${value.sold}</td>
                    <td>${value.category_name}</td>
                    <td>
                        <button class="btn btn-warning">
                            <a href="${baseUrl}shops/product/update/${value.id}">Sửa</a>
                        </button>
                    </td>
                </tr>
            `
        })
        tbody.html(html)

        page.map((value, index) => {
            htmlPaginate += `
                <li class="page-item ${value.active ? 'active' : ''} ${value.page < 1 ? 'disabled' : ''}" onclick="changePage(${value.page})">
                    <a class="page-link">${value.label}</a>
                </li>
            `
        })

        paginate.html(htmlPaginate)

    }
}

function changePage(page) {
    if(page > 0){
        genListProduct(page)
    }
}


async function deleteProduct(productId) {

    let confirmDelete = confirm("Bạn có chắc chắn muốn xóa phần tử này không?");
    if (confirmDelete) {
        let response = await api.deleteProduct({productId})
        if (response.success) {
            $.notify("delete success", "success");
            location.reload();
        } else {
            $.notify(response.message, "error");
        }
    }

}



$(document).ready(function(){
    genListProduct()
    $('#open-variant').on('hidden.bs.modal', function () {
        clearValueVariant()
        console.log('Modal đã đóng lại.');
    });
});
