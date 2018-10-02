/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/3
 * Time: 10:29
 */
$(function () {
    var acting = false;
    var body = $("body")
    body.on('click', '.action_act', function () {
        var _this = $(this);
        if (!acting) {
            var confirmation = _this.attr("data-confirm");
            if (confirmation == undefined || confirmation.length == 0 || confirm(confirmation)) {
                var method = _this.attr("data-method");
                var data = $.parseJSON(_this.attr("data-data"));
                var url = _this.attr("data-href");
                var target = _this.attr("data-target");
                var callback = _this.attr("data-callback");
                if (method && url) {
                    acting = true;
                    $.ajax({
                               url: url,
                               dataType: "json",
                               type: method,
                               data: data,
                               success: function (data) {
                                   if (callback.length > 0) {
                                       eval(callback + "(_this, target, data)");
                                   }
                               },
                               error: function (data) {
                                   alert(data.responseText);
                               },
                               complete: function () {
                                   acting = false;
                               }
                           })
                }
            }
        }
        return false;
    });

    var deleting = false;
    body.on('click', '.action_delete', function () {
        var _this = $(this);
        if (!deleting && confirm("确定删除?")) {
            var id = _this.attr("data-id");
            var action = _this.attr("data-action");
            var url = _this.attr("data-href");
            var target = _this.attr("data-target");
            if (url && id && action && target) {
                deleting = true;
                $.ajax({
                           url: url, dataType: "json", method: "post", data: {
                        action: action, id: id
                    }, success: function (data) {
                        if (data.status == 1) {
                            $("#" + target).remove();
                        } else {
                            alert(data.msg);
                        }
                    }, error: function (data) {
                        alert(data.responseText);
                    }, complete: function () {
                        deleting = false;
                    }
                       })
            }
        }

        return false;
    });

    var enableing = false;
    body.on('click', '.action_enable', function () {
        var _this = $(this);
        if (!enableing && confirm("确定启用?")) {
            var id = _this.attr('data-id');
            var action = _this.attr('data-action');
            var url = _this.attr('data-href');
            var target = _this.attr('data-target');
            var callback = _this.attr("data-callback");
            if (url && id && action && target) {
                enableing = true;
                $.ajax({
                           url: url, dataType: "json", method: "post", data: {
                        action: action, id: id
                    }, success: function (data) {
                        if (data.status == 1) {
                            $("#" + target).find(".action_enable").hide();
                            $("#" + target).find(".action_disable").show();
                            if (callback.length > 0) {
                                eval(callback + "(_this, target, data)");
                            }
                        }
                        else {
                            alert(data.msg);
                        }
                    }, error: function (data) {
                        alert(data.responseText);
                    }, complete: function () {
                        enableing = false;
                    }
                       });
            }
        }

        return false;
    });

    var disabling = false;
    body.on('click', '.action_disable', function () {
        var _this = $(this);
        if (!disabling && confirm("确定禁用?")) {
            var id = _this.attr('data-id');
            var action = _this.attr('data-action');
            var url = _this.attr('data-href');
            var target = _this.attr('data-target');
            var callback = _this.attr("data-callback");
            if (url && id && action && target) {
                disabling = true;
                $.ajax({
                           url: url, dataType: "json", method: "post", data: {
                        action: action, id: id
                    }, success: function (data) {
                        if (data.status == 1) {
                            $("#" + target).find(".action_disable").hide();
                            $("#" + target).find(".action_enable").show();
                            if (callback.length > 0) {
                                eval(callback + "(_this, target, data)");
                            }
                        }
                        else {
                            alert(data.msg);
                        }
                    }, error: function (data) {
                        alert(data.responseText);
                    }, complete: function () {
                        disabling = false;
                    }
                       });
            }
        }

        return false;
    });
});
