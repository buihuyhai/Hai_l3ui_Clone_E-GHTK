
async function loadRevenueAllMonthInYear(){
    let response = await api.getRevenueAllMonthInYear()
    let X = []
    let Y = []
    if (Object.keys(response).length !== 0) {
        let data = response.data;
        Object.keys(data).forEach(function(key, index) {
            X.push(key)
            Y.push(data[key])
        });
    }

    echarts.init(document.querySelector("#revenue-all-month")).setOption({
        xAxis: {
            type: 'category',
            data: X,
            axisLabel: {
                interval: 0,  // Đảm bảo rằng tất cả các nhãn đều được hiển thị
                rotate: 45,   // Xoay nhãn 45 độ để tránh chồng chéo
            }
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: Y,
            type: 'bar'
        }]
    });

}

async function loadOrderFollowStatus() {
    let response = await api.getOrderFollowShop()
    let result = []

    if (Object.keys(response).length !== 0) {
        let data = response.data;
        data.map(function (value) {
            result.push({
                name : value.status,
                value : value.total_orders
            })
        })
    }
    echarts.init(document.querySelector("#orderChart")).setOption({
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [{
            name: 'Access From',
            type: 'pie',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '18',
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: result
        }]
    });

}




async function analysisProduct() {
    let firstId = $('#first-product').val();
    let secondId = $('#second-product').val();
    let result = []
    console.log(firstId, secondId)

    let firstProduct = await api.getAnalysisProductById({id : firstId})
    if (Object.keys(firstProduct).length !== 0) {
        let data = firstProduct.data;
        result.push({
            value : [data.sales, data.sale_price, data.import_price, data.total_quantity, data.stock],
            name : data.name
        })
    }
    let secondProduct = await api.getAnalysisProductById({id : secondId})
    if (Object.keys(secondProduct).length !== 0) {
        let data = secondProduct.data;
        result.push({
            value : [data.sales, data.sale_price, data.import_price, data.total_quantity, data.stock],
            name : data.name
        })
    }

    await loadAnalysisProduct(result)


}
async function loadAnalysisProduct(data = []){
    echarts.init(document.querySelector("#analysisProduct")).setOption({
            legend: {
                // data: ['Allocated Budget', 'Actual Spending']
            },
            radar: {
                // shape: 'circle',
                indicator: [
                    {
                        name: 'Sales',
                    },
                    {
                        name: 'Sale Price',
                    },
                    {
                        name: 'Import Price',
                    },
                    {
                        name: 'Total Sell',
                    },
                    {
                        name: 'Stock',
                    },
                ]
            },
            series: [{
                type: 'radar',
                data: data
            }]
        });
}

async function analysisYearly(){
    let start = $('#year-start').val()
    let end = $('#year-end').val()
    let X= []
    let Y = []
    let response = await api.getRevenueYearLy({start, end})
    if (Object.keys(response).length !== 0) {
        let data = response.data;
        Object.keys(data).forEach(function(key, index) {
            X.push(data[key])
            Y.push(key)
        });
    }
    await loadAnalysisYearLy(X, Y)
}

async function loadAnalysisYearLy(X = [], Y= []){
    new ApexCharts(document.querySelector("#analysis-yearly"), {
        series: [{
            data: X
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: Y,
        }
    }).render();

}

async function loadSaleAndInventory() {
    let response = await api.getSaleAndInventorySevenDate()
    if (Object.keys(response).length!== 0) {
        let data = response.data;
        let date = [];
        let inventory = data.inventory;
        let sale = data.sale;
        let order = data.order;
        let dataInventory = [];
        let dataOrder = [];
        let dataSale = [];
        Object.keys(inventory).forEach(function(key, index) {
            date.push(key);
            dataInventory.push(inventory[key]);
        });
        Object.keys(sale).forEach(function(key, index) {
            dataSale.push(sale[key]);
        });
        Object.keys(order).forEach(function(key, index) {
            dataOrder.push(order[key]);
        });
        new Chart(document.querySelector('#sale-and-inventory'), {
                type: 'bar',
                data: {
                    labels: date,
                    datasets: [{
                        label: 'Tồn kho',
                        data: dataInventory,
                        backgroundColor: 'rgb(255, 99, 132)',
                    },
                        {
                            label: 'Số lượng hàng bán',
                            data: dataSale,
                            backgroundColor: 'rgb(75, 192, 192)',
                        },
                        {
                            label: 'Số đơn hàng',
                            data: dataOrder,
                            backgroundColor: 'rgb(255, 205, 86)',
                        },
                    ]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Chart.js Bar Chart - Stacked'
                        },
                    },
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true
                        }
                    }
                }
            });
    }
}

$(document).ready(function(){
    loadOrderFollowStatus()
    loadAnalysisProduct()
    loadRevenueAllMonthInYear()
    analysisYearly()
    loadSaleAndInventory()
});
