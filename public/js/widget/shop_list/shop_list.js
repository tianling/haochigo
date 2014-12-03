define([ "jquery", "tools/Sizer" ], function($, Sizer) {
    // 事件触发的数据获取中间件
    function dataTrigger(ev, type) {
        var spans, activities, flavor, obj = {};
        // 数据获取
        if ("checkbox" == type || "activity" == type) {
            var deleteTarget = ev.delegateTarget, input = $(deleteTarget).find("input");
            if (flavor = $(".drop_button").find("a").html(), input) {
                var nowChecked = input[0].checked;
                input[0].checked = !nowChecked;
            }
            "口味" != flavor && "全部" != flavor && (obj.flavor = flavor);
        } else if ("drop" == type) {
            var target = ev.target;
            flavor = $(target).html(), "口味" != flavor && "全部" != flavor && (obj.flavor = flavor);
        }
        // 数据录入
        "checkbox" == type || "drop" == type ? (spans = $(".choice_click"), spans.each(function() {
            var input = $(this).find("input"), text = $(this).find("label"), checked = input[0].checked, label = (text.html(), 
            $(this).data("label"));
            checked && (obj[label] = Number(checked));
        })) : (spans = $(".activities-btn"), activities = [], spans.each(function() {
            var input = $(this).find("input"), activity = $(this).data("activity_id"), checked = input[0].checked;
            checked && activities.push(activity);
        }), obj.support_activity = activities), console.log(obj), console.log(Sizer.get(obj));
        // 通过筛选器进行筛选并渲染
        var template = _.template($("#shop_list_template").html())({
            shops: Sizer.get(obj),
            shop_activity: shop_activity
        });
        shop_container.find("td").html(template);
    }
    var drop_button = $(".drop_button"), drop_list = $(".drop_list"), activitiesBtn = $(".activities-btn"), choice_click = ($(".shops_func"), 
    $(".choice_click")), shop_activity = {}, shop_container = $(".shop_container");
    activitiesBtn.each(function() {
        var id = $(this).data("activity_id"), value = $(this).find("label").html();
        shop_activity[id] = value;
    }), drop_button.on("click", function() {
        return drop_list.toggle(), $(this).toggleClass("active"), !1;
    }), drop_list.on("click", "li", function(ev) {
        var target = ev.currentTarget, type = target.innerHTML;
        drop_button.find("a").html(type), drop_list.toggle();
    }), function() {
        var target = shop_container.find(".more_shops-row-book"), result = [];
        target.each(function() {
            var target = $(this), place_id = target.data("place_id"), shop_id = target.data("shop_id"), flavor = target.data("flavor"), issupportpay = target.data("issupportpay"), isonline = target.data("isonline"), ishot = target.data("ishot"), support_activity = target.data("support_activity").split(","), shop_url = target.parent().prop("href"), is_collected = target.find(".uncollect").hasClass("change"), shop_logo = target.find(".logo img").prop("src"), deliver_time = target.find(".more_shops-row-book-left span").data("deliver_time"), shop_name = target.find(".title p").html(), is_opening = target.find(".more_shops-row-book-right").data("is_opening"), shop_type = target.find(".more_shops-row-book-right").data("shop_type"), shop_level = target.find(".more_shops-row-book-right").data("shop_level"), order_count = target.find(".more_shops-row-book-right").data("order_count"), shop_announce = target.find(".divider").data("shop_announce"), deliver_state_start = target.find(".divider").data("deliver_state_start"), shop_address = target.find(".divider").data("shop_address"), business_hours = target.find(".divider").data("business_hours"), shop_summary = target.find(".divider").data("shop_summary"), storage = {};
            storage.place_id = place_id, storage.shop_id = shop_id, storage.flavor = flavor, 
            storage.issupportpay = issupportpay, storage.isonline = isonline, storage.ishot = ishot, 
            storage.support_activity = support_activity, storage.shop_id = shop_id, storage.shop_url = shop_url, 
            storage.is_collected = is_collected, storage.shop_logo = shop_logo, storage.deliver_time = deliver_time, 
            storage.shop_name = shop_name, storage.is_opening = is_opening, storage.shop_type = shop_type, 
            storage.shop_level = shop_level, storage.order_count = order_count, storage.shop_announce = shop_announce, 
            storage.deliver_state_start = deliver_state_start, storage.shop_address = shop_address, 
            storage.business_hours = business_hours, storage.shop_summary = shop_summary, result.push(storage);
        }), console.log(result), Sizer.add(result);
    }(), drop_list.on("click", "li", function(e) {
        dataTrigger(e, "drop");
    }), choice_click.on("click", function(e) {
        dataTrigger(e, "checkbox");
    }), activitiesBtn.on("click", function(e) {
        dataTrigger(e, "activity");
    });
});