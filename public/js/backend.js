$(function() {

    var validatorDefaultParam =  {
        live: 'disables',
        message: "This Values is not valid",
        feedbackIcons: {
            valid: 'glyphicon ',
            invalid: 'glyphicon ',
            validating: 'glyphicon glyphicon-refresh'
        }
    };

    /* 文章分类操作验证 */
    $("#category-form").bootstrapValidator({
        validatorDefaultParam,
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: "分类名称不能为空"
                    }
                }
            }
        }
    });

    /*$("#category-form #reset-btn").click(function(){
        $('#category-form').data('bootstrapValidator').resetForm(true);
        $('#category-form')[0].reset();
    });*/
    Moell.form.reset("#category-form", "#reset-btn");

    /* 文章操作验证 */
    $("#article-form").bootstrapValidator({
        validatorDefaultParam,
        fields : {
            title : {
                validators : {
                    notEmpty : {
                        message : "文章标题不能为空"
                    }
                }
            },
            cate_id : {
                validators : {
                    notEmpty : {
                        message : "请选择文章分类"
                    }
                }
            }
        }
    });

    /*$("#article-form #reset-btn").click(function(){
        $('#article-form').data('bootstrapValidator').resetForm(true);
    });*/

    Moell.form.reset("#article-form", "#reset-btn");


});
