// 筛选器
define([ "jquery" ], function($) {
    function Sizer() {
        this.data = [];
    }
    /**
	 * 添加
	 * @数据标签 label
	 * @数据的值 value
	 */
    /**
	 * 获取
	 * @要获取的标签 labels { isHot : 1, flavor : "中式"}
	 * @returns {Array}
	 */
    return Sizer.prototype.add = function(value) {
        var self = this;
        if (!$.isFunction(value)) for (var i = 0, len = value.length; len > i; i++) self.data.push(value[i]);
    }, Sizer.prototype.get = function(labelObject) {
        {
            var self = this;
            self.data;
        }
        if ($.isPlainObject(labelObject)) {
            for (var result = [], i = 0, len = self.data.length; len > i; i++) {
                var target = self.data[i], flag = !0;
                for (var name in labelObject) {
                    if ("support_activity" == name) for (var activity = labelObject[name], j = 0, len_activity = activity.length; len_activity > j; j++) target.support_activity[j] != activity[j] && (flag = !1);
                    "support_activity" != name && target[name] != labelObject[name] && (flag = !1);
                }
                flag && result.push(target);
            }
            return result;
        }
    }, new Sizer();
});