let baseUrl = 'http://127.0.0.1:8000/'
let api = {
    getInfoShop  : async (prop) => {
        const {id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/getInfoShop/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },

    updateInfoShop  : async (prop) => {
        const {shopId, name, address, phone_number, email,logo, description} = prop
        let formData = new FormData();
        formData.append('logo', logo);
        formData.append('name', name);
        formData.append('address', address);
        formData.append('email', email);
        formData.append('phone_number', phone_number);
        formData.append('description', description);
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/update/${shopId}?_method=PUT`,
                type: 'POST',
                dataType: 'json',
                data : formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                    // console.log(response);
                }
            })
        }catch(e){
            console.log(e)
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },
    createProduct  : async (prop) => {
        const {formProductCreated} = prop
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product/store`,
                type: 'POST',
                dataType: 'json',
                data : formProductCreated,
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                }
            })
        }catch(e){
            console.log(e)
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },
    importProduct  : async (prop) => {
        const {id,number} = prop
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product/importProductVariant`,
                type: 'POST',
                dataType: 'json',
                data : {
                    product_variant_id : id,
                    number : number
                },
                // processData: false,  // tell jQuery not to process the data
                // contentType: false,
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                }
            })
        }catch(e){
            console.log(e)
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },
    deleteProduct  : async (prop) => {
        const {productId} = prop
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product/delete/${productId}`,
                type: 'POST',
                dataType: 'json',
                data : {},
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                }
            })
        }catch(e){
            console.log(e)
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },
    updateProduct  : async (prop) => {
        const {formProductUpdated, product} = prop
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product/update/${product}`,
                type: 'POST',
                dataType: 'json',
                data : formProductUpdated,
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                }
            })
        }catch(e){
            console.log(e)
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },
    createVariant  : async (prop) => {
        const {variant, product} = prop
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product/createVariant/${product}`,
                type: 'POST',
                dataType: 'json',
                data : variant,
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                }
            })
        }catch(e){
            console.log(e)
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },
    updateVariant  : async (prop) => {
        const {variant, product} = prop
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product/updateVariant/${product}`,
                type: 'POST',
                dataType: 'json',
                data : variant,
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                }
            })
        }catch(e){
            console.log(e)
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },
    deleteVariant  : async (prop) => {
        const {variant, product} = prop
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product/deleteVariant/${product}`,
                type: 'POST',
                dataType: 'json',
                data : variant,
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                }
            })
        }catch(e){
            console.log(e)
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },

    getListProduct  : async (prop) => {
        const {pageNum, name, category} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product?page=${pageNum}&name=${name}&category=${category}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getProductById  : async (prop) => {
        const {id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/product/getById/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getBasicDashboard  : async (prop) => {
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/analysis/reportBasic`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },

    getBasicForMonth  : async (prop) => {
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/analysis/reportBasicForMonth`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getTopSellerInYear  : async (prop) => {
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/analysis/reportBasicTopSellingInYear`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getOrderFollowShop  : async (prop) => {
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/analysis/orderFollowStatus`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getRevenueAllMonthInYear  : async (prop) => {
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/analysis/revenueAllMonthInYear`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getRevenueYearLy  : async (prop) => {
        let {start, end} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/analysis/revenueYearLy?year_start=${start}&year_end=${end}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getSaleAndInventorySevenDate  : async (prop) => {
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/analysis/saleAndInventoryInSevenDate`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getAnalysisProductById  : async (prop) => {
        const {id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/analysis/analysisProductById/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getListOrder  : async (prop) => {
        const {pageNum, email} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/orders?page=${pageNum}&email=${email}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getDetailOrder : async (prop) => {
        const {id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/orders/getOrderById/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    changeStatusOrder : async (prop) => {
        const {id, status} = prop
        let rs = { success: false, data: {}, message: "Error" };
        try{
            await $.ajax({
                url: `${baseUrl}shops/api/orders/changeStatus/${id}`,
                type: 'POST',
                data : {
                    status : status
                },
                dataType: 'json',
                success: function (response) {
                    rs.success = true;
                    rs.data = response;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    rs.success = false;
                    rs.message = jqXHR.responseText || textStatus || errorThrown;
                    // console.log(response);
                }
            })
        }catch(e){
            rs.success = false;
            rs.message = e.message ? e.message : e.responseText;
        }
        return rs;
    },

}
