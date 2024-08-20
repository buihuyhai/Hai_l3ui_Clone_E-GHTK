//nhuandt3
(function() {
    'use strict';
    const rootUrl = 'http://127.0.0.1:8000/';
    const defaultLimit = 8;
    const defaultPage = 1;
    const shopRevenueUrl = `${rootUrl}revenueAllShop`;

    function createShopTableItem(item, index) {
        let html = '';
        html += `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <img
                        src="${rootUrl}storage/${item?.logo}"
                        width="32"
                        class="rounded-circle me-3 rounded-avatar">
                    <span>${item?.name}</span>
                </td>
                <td>${item?.phone_number}</td>
                <td>${item?.totalRevenue} VNĐ</td>
            </tr>
        `;
        return html;
    }

    async function getTableDataItemsApi(
        url, pageNumber = 1, limitItems = defaultLimit) {
        let result = {};
        await $.ajax({
            url: shopRevenueUrl,
            type: 'GET',
            dataType: 'json',
            data: {
                page: pageNumber, limit: limitItems,
            },
            success: function(response) {
                result = response;
            },
            error: function(error) {
                console.log(error);
            },
        });
        return result;
    }

    function reloadDataButton(table, url, createTableItem) {
        const reloadBtn = table.closest('.card-body').find('.load-icon');
        reloadBtn.on('click', function(e) {
            genTableDataItems(table, url, defaultPage, defaultLimit,
                createTableItem);
        });
    }

    async function genTableDataItems(
        table, url, pageNumber = 1, limitItems = defaultLimit,
        createTableItem, relatedEls = {}) {

        const tableBody = table.find('.table-body');

        const items = await getTableDataItemsApi(url, pageNumber, limitItems);

        let html = '';

        let totalRevenue = 0;

        Object.values(items.data).map((item, index) => {
            html += createTableItem(item, index);
            totalRevenue += item?.totalRevenue;
        });

        tableBody.html(html);
        relatedEls?.totalEl?.html(Object.keys(items.data).length);
        relatedEls?.totalRevenue?.html(` ${totalRevenue} VNĐ`);
    }

    function initDataTable(table, url, createTableItem, relatedEls = {}) {
        genTableDataItems(table, url, defaultPage, defaultLimit,
            createTableItem, relatedEls);
        reloadDataButton(table, url, createTableItem);
    }

    $(document).ready(function() {
        initDataTable($('#shop-table'), shopRevenueUrl, createShopTableItem, {
            totalEl: $('.shop-total'),
            totalRevenue: $('.total-revenue'),
        });
    });

})();
