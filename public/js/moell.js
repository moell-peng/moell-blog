var Moell = window.Moell || {};

var _token = $("meta[name='_token']").attr('content');

(function(Moell) {
    Moell.ajax = {
        delete: function (url) {

            layer.confirm('你确认删除吗?', {
                btn: ['删除', '取消']
            }, function () {
                $.post(url, {'_method': "DELETE", '_token': _token}, function (data) {
                    var msg;
                    if (data.status == 0) {
                        layer.msg('删除成功', {time: 5000, icon: 6});
                        window.location.href = window.location.href;
                    } else {
                        msg = data.msg  ? data.msg : '删除失败';
                        layer.msg(msg, {time: 5000, icon: 5});
                    }
                });

            }, function () {
                layer.close();
            })
        },
        postForm : function(url, data, method) {
            data._method = method;
            data._token  = _token;
            $.post(url, data, function(data) {
                var msg;
                if (data.status == 0) {
                    msg = data.msg  ? data.msg : '操作成功';
                    layer.msg(msg, {time: 5000, icon: 6});
                    window.location.href = window.location.href;
                } else {
                    msg = data.msg  ? data.msg : '操作失败';
                    layer.msg(msg, {time: 5000, icon: 5});
                }
            });
        },
    }
})(Moell);