let shopId = localStorage.getItem("shop_id");

async function genInfoShop() {
    let response = await api.getInfoShop({id:shopId})
    if(Object.keys(response).length !== 0) {
        let data = response.data;
        $("#name").val(data.name).prop("readonly", false)
        $("#email").val(data.email).prop("readonly", false)
        $("#address").val(data.address).prop("readonly", false)
        $("#phone_number").val(data.phone_number).prop("readonly", false)
        $("#description").text(data.description).prop("readonly", false)
        $("#shop #blah").attr("src",`${baseUrl}storage/${data.logo_url}`)
            .attr("width",150)
            .attr("height",150)
    }
}
async function submitUpdateShop() {
    let logoInput = $('#shop #logo')[0]

    let name = $("#name").val()
    let email = $("#email").val()
    let address = $("#address").val()
    let phone_number = $("#phone_number").val()
    let description = $("#description").text()
    let logo = logoInput.files.length > 0 ? logoInput.files[0] : ''
    let response = await api.updateInfoShop({shopId, name, address, phone_number, email, logo, description})
    console.log(response)
    if (response.success) {
        $.notify("update success", "success");
        genInfoShop()
    } else {
        $.notify(response.message, "error");
    }
}
$(document).ready(function(){
    genInfoShop()
});
