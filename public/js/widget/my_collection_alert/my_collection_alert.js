define([ "jquery" ], function($) {
    function cancel_collection_each() {
        $(".collection-modal input").each(function() {
            this.checked && (n = $(this).attr("shop_id"), cancel_collection["shop_id_" + n] = new Array(2), 
            cancel_collection["shop_id_" + n].shop_id = n, cancel_collection["shop_id_" + n].place_id = $(this).attr("place_id"));
        });
    }
    function showComments(data) {
        var temp = _.template($("#collection-row").html())(data);
        $(".collection .collection-row").html(temp);
    }
    console.log("my collection alert loaded");
    var n, cancel_collection = [], add_collection = [], post = {};
    window.onload = function() {
        cancel_collection_each();
    }, $(".add").on("click", function() {
        $(".collection-modal").css("display", "block");
    }), $(".collection-modal").on("click", function(e) {
        var e_class = e.target.className || null;
        switch (e_class) {
          case "check":
            var shop_id = $(e.target).attr("shop_id"), click_checked = e.target.checked, sameElement = $(".collection-modal").find("input[shop_id='" + shop_id + "']");
            sameElement.each(function() {
                this.checked = click_checked;
            });
            break;

          case "set close":
            $(".collection-modal").css("display", "none");
            break;

          case "btn btn-yellow":
            $(".collection-modal").css("display", "none"), $(".collection-modal input").each(function() {
                this.checked && (n = $(this).attr("shop_id"), add_collection["shop_id_" + n] = new Array(2), 
                add_collection["shop_id_" + n].shop_id = n, add_collection["shop_id_" + n].place_id = $(this).attr("place_id"));
            }), Object.keys(add_collection).forEach(function(value) {
                cancel_collection[value] && (delete cancel_collection[value], delete add_collection[value]);
            }), post.add_collection = [], post.cancel_collection = [], Object.keys(add_collection).forEach(function(value, index) {
                post.add_collection[index] = {}, post.add_collection[index] = {
                    shop_id: add_collection[value].shop_id,
                    place_id: add_collection[value].place_id
                };
            }), Object.keys(cancel_collection).forEach(function(value, index) {
                post.cancel_collection[index] = {}, post.cancel_collection[index] = {
                    shop_id: cancel_collection[value].shop_id,
                    place_id: cancel_collection[value].place_id
                };
            }), (post.add_collection.length || post.cancel_collection.length) && $.ajax({
                url: "takeaway/public/index.php/collect-list",
                type: "POST",
                data: post,
                success: function(res) {
                    if ("true" == res.success) {
                        showComments(res.data);
                        for (var i = res.data.collection_shop.length; i > 0; i--) ;
                    } else alert("收藏失败，请重新收藏");
                }
            }), cancel_collection = [], cancel_collection_each(), add_collection = [];
            break;

          case "p_hot":
            $(".collection-modal .new-res").css("display", "none"), $(".collection-modal .p_new").removeClass("action"), 
            $(".collection-modal .hot-res").css("display", "block"), $(".collection-modal .p_hot").addClass("action");
            break;

          case "p_new":
            $(".collection-modal .hot-res").css("display", "none"), $(".collection-modal .p_hot").removeClass("action"), 
            $(".collection-modal .new-res").css("display", "block"), $(".collection-modal .p_new").addClass("action");
        }
    });
});