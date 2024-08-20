
async function loadBasic() {
    let response = await api.getBasicDashboard()
    if(Object.keys(response).length !== 0) {
        let data = response.data;
        let item = data.item
        let order = data.order
        let revenue = data.revenue
        $("#count-order-number").text(order.current + " đơn")
        $("#count-order-percent").text(order.change + "%")
        $("#count-order-type").text(order.type)
        if (order.type === "increment"){
            $("#count-order-percent").addClass("text-success")
        }else{
            $("#count-order-percent").addClass("text-danger")
        }
        $("#revenue-number").text(formatNumberToVND(revenue.current))
        $("#revenue-percent").text(revenue.change + "%")
        $("#revenue-type").text(revenue.type)
        if (revenue.type === "increment"){
            $("#revenue-percent").addClass("text-success")
        }else{
            $("#revenue-percent").addClass("text-danger")
        }
        $("#product-sale-number").text(item.current)
        $("#product-sale-percent").text(item.change + "%")
        $("#product-sale-type").text(item.type)
        if (item.type === "increment"){
            $("#product-sale-percent").addClass("text-success")
        }else{
            $("#product-sale-percent").addClass("text-danger")
        }
    }
}



async function loadBasicForMonth() {
    let response = await api.getBasicForMonth()
    let dataOrder = []
    let dataRevenue = []
    let dataSell = []
    let categories = []
    if (Object.keys(response).length !== 0) {
        let data = response.data;
        Object.keys(data).forEach(function(key, index) {
            let item = data[key]
            dataOrder.push(item.orders)
            dataRevenue.push((item.revenue/ 23000).toFixed(1) )
            dataSell.push(item.item)
            categories.push(key + "")
        });
    }
        new ApexCharts(document.querySelector("#reportsChart"), {
            series: [{
                name: 'Order',
                data: dataOrder,
            },
                {
                name: 'Revenue',
                data: dataRevenue
            },
                {
                name: 'Sell',
                data: dataSell
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                },
            },
            markers: {
                size: 4
            },
            colors: ['#4154f1',
                '#2eca6a',
                '#ff771d'],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                type: 'string',
                categories: categories
            },
            tooltip: {
                x: {
                },
            }
        }).render();
}

async function loadTopSellingInYear() {
    let response = await api.getTopSellerInYear()
    if (Object.keys(response).length !== 0) {
        let data = response.data;
        let html = ""
        data.map(function (value, index) {
            html += `
                <tr>
                    <td>${index+1}</td>
                    <td>
                        <img src="${baseUrl}storage/${value.thumbnail}" class="img-fluid img-thumbnail" alt="Sheep" width="50" height="50">
                    </td>
                    <td>${value.name}</td>
                    <td>${value.price}</td>
                    <td>${value.total_quantity}</td>
                </tr>
            `
        })
        $('#data-product tbody').html(html)
        console.log(data)
    }
}

$(document).ready(function(){
    loadBasic()
    loadBasicForMonth()
    loadTopSellingInYear()
});
