define([ "jquery" ], function($) {
    console.log("personal my site loaded"), $.fn.serializeObject = function() {
        var o = {}, a = this.serializeArray();
        return $.each(a, function() {
            void 0 != o[this.name] ? (o[this.name].push || (o[this.name] = [ o[this.name] ]), 
            o[this.name].push(this.value || "")) : o[this.name] = this.value || "";
        }), o;
    }, $("#order_form").on("submit", function() {
        var address_details = $("#address_details"), deliver_phone = $("#deliver_phone"), checkPlace = /\w+/, checkPhone = /\d{11}/, flag = !0;
        return checkPlace.test(address_details.val()) || (address_details.parent().find(".error_box").show(), 
        address_details.addClass("error"), flag = !1), checkPhone.test(deliver_phone.val()) || (deliver_phone.parent().find(".error_box").show(), 
        deliver_phone.addClass("error"), flag = !1), flag ? void 0 : !1;
    });
});