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
                    var icon;
                    if (data.status == 0) {
                        layer.msg('删除成功', {time: 5000, icon: 6});
                        window.location.href = window.location.href;
                    } else {
                        layer.msg('删除失败', {time: 5000, icon: 5});
                    }
                });

            }, function () {
                layer.close();
            })
        }
    },
    Moell.form = {
        reset: function (form, resetBtn) {
            $(resetBtn).click(function () {
                $(form).data('bootstrapValidator').resetForm(true);
                $(form)[0].reset();
            });
        }
    }
})(Moell);