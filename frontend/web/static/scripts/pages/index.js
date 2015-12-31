var Liuxy = function() {
    return {
        /**
         * 通用Ajax数据请求
         * @param obj	触发ajax请求的jquery对象，设置为非null，可以防止重复提交
         * @param url	请求相对地址
         * @param type	ajax的dataType
         * @param param	请求的参数，json格式
         * @param success	请求成功的回调函数
         * @param error	请求失败的回调函数
         * @param isAsync	是否采用异步方式
         */
        ajax: function (obj, url, type, param, success, error, isAsync) {
            var ajax = Liuxy._ajax(obj, url, type, param, success, error);
            if (ajax) {
                ajax.async = isAsync;
                $.ajax(ajax);
            } else {
                return false;
            }
        },
        /**
         * 简化form、支持file的异步提交
         * @param obj   表单对象
         * @param url	请求相对地址
         * @param type	ajax的dataType
         * @param param	额外请求的参数，json格式
         * @param success	请求成功的回调函数
         * @param error	请求失败的回调函数
         * @param isAsync	是否采用异步方式
         * @returns {boolean}
         */
        ajaxForm:function (obj, url, type, param, success, error, isAsync) {
            var ajax = Liuxy._ajax(obj, url, type, param, success, error);
            if (ajax) {
                ajax.forceSync = !isAsync;
                obj.ajaxSubmit(ajax);
            } else {
                return false;
            }
        },
        _ajax:function(obj, url, type, param, success, error) {
            if (obj) {
                if (obj.attr('submitting') == 1) {
                    return false;
                } else {
                    obj.attr('submitting',1);
                }
            }
            var ajax = {type: 'post', url: baseUrl + url, dataType: type};
            if (param) ajax.data = param;
            ajax.success = function(data) {
                if (data.code) {
                    if (data.code == 200) {
                        if (success) {
                            success(data.data);
                            if (obj) {
                                obj.attr('submitting',0);
                            }
                        }
                    } else {
                        if (error) {
                            error(data.code, data.msg);
                            if (obj) {
                                obj.attr('submitting',0);
                            }
                        }
                    }
                } else {
                    if (success) {
                        success(data);
                        if (obj) {
                            obj.attr('submitting',0);
                        }
                    }
                }
            };
            if (error) {
                ajax.error = function() {
                    error(500, '服务器错误，请重试');
                    if (obj) {
                        obj.attr('submitting',0);
                    }
                }
            }
            return ajax;
        },
    };
}();
var Message = function() {
    return {
        success:function(content) {
            bootbox.dialog({
                message: content,
                title: "成功提示",
                buttons: {
                    success: {
                        label: "关闭",
                        className: "btn-success"
                    }
                 }
          });
        },
        error:function(content) {
            bootbox.dialog({
                message: content,
                title: "错误提示",
                buttons: {
                    danger: {
                        label: "关闭",
                        className: "btn-danger"
                    }
                }
            });
        }
    };
}();
var Index = function () {
    return {
        init: function () {

        }
    };
}();