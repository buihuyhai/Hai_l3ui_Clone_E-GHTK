
async function genListOrders(pageNum = 1, email = "") {
    let response = await api.getListOrder({pageNum, name})
    if(Object.keys(response).length !== 0) {
        let data = response.data.orders;
        console.log(data)
        let page = response.data.paginate;
        // Get the tbody element
        let tbody = $('#data-order tbody');
        let paginate = $('#paginate');
        tbody.html("")
        //
        let html = "";
        let htmlPaginate = "";
        // // Loop through each product and create a row
        data.map((value, index) => {
            let total = formatNumberToVND(value.finalCost != null ? value.finalCost : 0)
            let status = ''
            if (value.statusCode === 0){
                status = `<span class="badge bg-danger">${value.status}</span>`
            }else if (value.statusCode === 1){
                status = `<span class="badge bg-warning text-dark">${value.status}</span>`
            }else if (value.statusCode === 2){
                status = `<span class="badge bg-success">${value.status}</span>`
            }
            html += `
                <tr>
                    <td>${index+1}</td>
                    <td>${value.customer}</td>
                    <td>${total}</td>
                    <td>${value.email}</td>
                    <td>${value.address}</td>
                    <td>${value.phone_number}</td>
                    <td>${status}</td>
                    <td>
                        <button class="btn btn-link p-0" onclick="openDetailOrder(${value.id})">
                            <i class="bi bi-eye"></i>
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
        genListOrders(page)
    }
}


async function openDetailOrder(id = -1) {
    $('#open-order-detail').modal('show')
    let response = await api.getDetailOrder({id})
    if (Object.keys(response).length !== 0) {
        let data = response.data;
        let htmlTable = ""
        let htmlInfo = ""
        let htmlFooter = '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>'
        let total = 0;
        data.detail.map((function (item, index){
            let sumEach = item.quantity * (item.sale_price - item.import_price)
            total += sumEach
            htmlTable += `
                <tr>
                    <td>${index+1}</td>
                    <td>
                        <img src="${baseUrl}storage/${item.image}" class="img-fluid img-thumbnail" alt="Sheep" width="25" height="25">
                    </td>
                    <td>${item.sale_price}</td>
                    <td>${item.import_price}</td>
                    <td>${item.quantity}</td>
                    <td>${sumEach}</td>
                </tr>
            `
        }))
        htmlTable +=
            `<tr>
                <td colspan="5">Tong</td>
                <td colspan="1">${formatNumberToVND(total)}</td>
            </tr>`

        $('#open-order-detail #data-detail tbody').html(htmlTable)
        htmlInfo += `
            <li class="list-group-item">Ten khach hang : ${data.customer}</li>
            <li class="list-group-item">Email : ${data.email}</li>
            <li class="list-group-item">Dia chi : ${data.address}</li>
            <li class="list-group-item">Dien thoai : ${data.phone_number}</li>
            <li class="list-group-item">Tien phai tra : ${formatNumberToVND(data.finalCost)}</li>
            <li class="list-group-item">Trang thai : ${data.status}</li>
        `
        $('#open-order-detail #info').html(htmlInfo)
        if(data.statusCode === 1){
            htmlFooter+=
                `<button type="button" class="btn btn-success" onclick="changeStatus(${data.id}, 2)">Confirm</button>
                    <button type="button" class="btn btn-danger" onclick="changeStatus(${data.id}, 0)">Reject</button>
                `
        }
        $('#open-order-detail #modal-footer').html(htmlFooter)
    }
}


async function changeStatus(orderId = null, status = false) {
    let response = await api.changeStatusOrder({id: orderId, status})
    if (response.success) {
        genListOrders()
        $('#open-order-detail').modal('hide')
        $.notify("change status success", "success");
    }else{
        $.notify("change status error", "error");
    }
}

$(document).ready(function(){
    genListOrders()
});
