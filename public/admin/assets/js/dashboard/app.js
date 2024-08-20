//nhuandt3
document.addEventListener('DOMContentLoaded', () => {
    (function() {
        'use strict';
        const rootUrl = 'http://127.0.0.1:8000/';
        const defaultLimit = 8;
        const defaultPage = 1;
        const shopUrl = `${rootUrl}api/v1/shop/limit`;
        const shopRevenueUrl = `${rootUrl}revenueAllShop`;
        const vendorUrl = `${rootUrl}api/v1/user/vendor`;
        const customerUrl = `${rootUrl}api/v1/user/customer`;
        const adminUrl = `${rootUrl}api/v1/user/admin`;

        const globalData = {
            totalVendor: 0, totalCustomer: 0, totalAdmin: 0,
        };

        function createVendorTableItem(item, index) {
            let html = '';
            html += `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <img
                        src="${rootUrl}storage/${item?.avatar}"
                        width="32"
                        class="rounded-circle me-3 rounded-avatar">
                    <span>${item?.name}</span>
                </td>
                <td>${item?.phone}</td>
                <td>${item?.last_login_at}</td>
            </tr>
        `;
            return html;
        }

        function createCustomerTableItem(item, index) {
            let html = '';
            html += `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <img
                        src="${rootUrl}storage/${item?.avatar}"
                        width="32"
                        class="rounded-circle me-3 rounded-avatar">
                    <span>${item?.name}</span>
                </td>
                <td>${item?.phone}</td>
                <td>${item?.last_login_at}</td>
            </tr>
        `;
            return html;
        }

        function createAdminTableItem(item, index) {
            let html = '';
            html += `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <img
                        src="${rootUrl}storage/${item?.avatar}"
                        width="32"
                        class="rounded-circle me-3 rounded-avatar">
                    <span>${item?.name}</span>
                </td>
                <td>${item?.phone}</td>
                <td>${item?.last_login_at}</td>
            </tr>
        `;
            return html;
        }

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
                <td>${item?.totalRevenue}</td>
            </tr>
        `;
            return html;
        }

        async function getTableDataItemsV1(
            url, pageNumber = 1, limitItems = defaultLimit) {
            let result = {};
            await $.ajax({
                url: url, type: 'GET', dataType: 'json', data: {
                    page: pageNumber, limit: limitItems,
                }, success: function(response) {
                    result = response.data;
                }, error: function(error) {
                    console.log(error);
                },
            });
            return result;
        }

        async function getTableDataItemsApi(
            url, pageNumber = 1, limitItems = defaultLimit) {
            let result = {};
            await $.ajax({
                url: shopRevenueUrl, type: 'GET', dataType: 'json', data: {
                    page: pageNumber, limit: limitItems,
                }, success: function(response) {
                    result = response;
                }, error: function(error) {
                    console.log(error);
                },
            });
            return result;
        }

        function assignPageForButton(
            table, url, button, page, limit, callback, createTableItem) {
            button.on('click', () => {
                callback(table, url, page, limit, createTableItem);
            });
        }

        function assignPageForButtons(table, url, items, pageNumber, limitItems,
            callback, createTableItem) {
            const navContainer = table.next('.table-navigation');

            navContainer.find('button').off();

            const prePage = navContainer.find('#pre-page');
            const nextPage = navContainer.find('#next-page');
            const lastPage = navContainer.find('#last-page');
            const firstPage = navContainer.find('#first-page');

            const curPageNumber = pageNumber;
            const prePageNumber = pageNumber - 1;
            const nextPageNumber = pageNumber + 1;
            const lastPageNumber = items.last_page;
            const firstPageNumber = defaultPage;

            if (curPageNumber !== defaultPage || pageNumber !==
                items.last_page) navContainer.find('.page-link').
                removeClass('disabled');

            if (curPageNumber === defaultPage) {
                firstPage.addClass('disabled');
                prePage.addClass('disabled');
            }

            if (curPageNumber === lastPageNumber) {
                lastPage.addClass('disabled');
                nextPage.addClass('disabled');
            }

            assignPageForButton(table, url, prePage, prePageNumber, limitItems,
                callback, createTableItem);

            assignPageForButton(table, url, nextPage, nextPageNumber,
                limitItems, callback, createTableItem);

            assignPageForButton(table, url, lastPage, lastPageNumber,
                limitItems, callback, createTableItem);

            assignPageForButton(table, url, firstPage, firstPageNumber,
                limitItems, callback, createTableItem);
        }

        function reloadDataButton(
            table, url, createTableItem, relatedEls = {}) {
            const reloadBtn = table.closest('.card-body').find('.load-icon');
            reloadBtn.on('click', function(e) {
                genTableDataItems(table, url, defaultPage, defaultLimit,
                    createTableItem, relatedEls);
            });
        }

        async function genTableDataItems(table, url, pageNumber = 1,
            limitItems = defaultLimit, createTableItem, relatedEls = {}) {

            const tableBody = table.find('.table-body');

            const items = await getTableDataItemsV1(url, pageNumber,
                limitItems);

            let html = '';

            (items.data).map((...data) => {
                html += createTableItem(...data);
            });

            tableBody.html(html);

            assignPageForButtons(table, url, items, pageNumber, limitItems,
                genTableDataItems, createTableItem);

            relatedEls?.totalEl?.html(items.total);
            globalData[relatedEls?.totalVar] = items.total;
        }

        async function initDataTable(
            table, url, createTableItem, relatedEls = {}) {
            await genTableDataItems(table, url, defaultPage, defaultLimit,
                createTableItem, relatedEls);
            reloadDataButton(table, url, createTableItem, relatedEls);
        }

        async function loadData() {
            await initDataTable($('#vendor-table'), vendorUrl,
                createVendorTableItem, {
                    totalEl: $('.vendor-total'), totalVar: 'totalVendor',
                });

            await initDataTable($('#customer-table'), customerUrl,
                createCustomerTableItem, {
                    totalEl: $('.customer-total'), totalVar: 'totalCustomer',
                });

            await initDataTable($('#admin-table'), adminUrl,
                createCustomerTableItem, {
                    totalEl: $('.admin-total'), totalVar: 'totalAdmin',
                });

            echarts.init(document.querySelector('#trafficChart')).setOption({
                tooltip: {
                    trigger: 'item',
                }, legend: {
                    top: '5%', left: 'center',
                }, series: [
                    {
                        name: 'Access From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false, position: 'center',
                        },
                        emphasis: {
                            label: {
                                show: true, fontSize: '18', fontWeight: 'bold',
                            },
                        },
                        labelLine: {
                            show: false,
                        },
                        data: [
                            {
                                value: globalData.totalVendor,
                                name: 'Người bán',
                            }, {
                                value: globalData.totalCustomer,
                                name: 'Người dùng',
                            }, {
                                value: globalData.totalAdmin,
                                name: 'Quản trị viên',
                            }],
                    }],
            });
        }

        loadData();

    })();

});
