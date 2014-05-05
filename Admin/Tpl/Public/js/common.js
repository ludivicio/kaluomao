


/**
 * 通用AJAX提交
 * @param  {string} url    表单提交地址
 * @param  {string} formObj    待提交的表单对象或ID
 */
function ajaxSubmit(url, formObj, validate) {
    if (!formObj || formObj == '') {
        var formObj = 'form';
    }
    if (!url || url == '') {
        var url = document.URL;
    }

    $(formObj).submit(function() {

        $(this).ajaxSubmit({
            type: "post",
            url: url,
            beforeSubmit: validate,
            success: submitSuccess
        });

        //此处必须返回false，阻止常规的form提交
        return false;
    });

}

/**
 * 表单提交成功后的反馈
 * @param {type} data
 * @returns {undefined}
 */
function submitSuccess(data) {
    var title = null;
    var type = null;
    if (data.status == 1) {
        title = "操作成功";
        type = BootstrapDialog.TYPE_PRIMARY;
    } else {
        title = "操作失败";
        type = BootstrapDialog.TYPE_WARNING;
    }

    BootstrapDialog.show({
        title: title,
        message: data.info,
        type: type,
        buttons: [{
                label: '确定',
                cssClass: 'btn-primary',
                action: function(dialog) {
                    window.location.href = data.url;
                    dialog.close();
                }
            }]
    });

    if (data.url && data.url != '') {
        setTimeout(function() {
            top.window.location.href = data.url;
        }, 3000);
    }

    if (data.url == '') {
        setTimeout(function() {
            top.window.location.reload();
        }, 2000);
    }
}


/**
 * 检测字符串是否是电子邮件地址格式
 * @param  {string} value    待检测字符串
 */
function isEmail(value) {
    var Reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    return Reg.test(value);
}

function clickCheckbox() {
    $(".chooseAll").click(function() {
        var status = $(this).prop('checked');
        $("tbody input[type='checkbox']").prop("checked", status);
        $(".chooseAll").prop("checked", status);
        $(".unsetAll").prop("checked", false);
    });
    $(".unsetAll").click(function() {
        var status = $(this).prop('checked');
        $("tbody input[type='checkbox']").each(function() {
            $(this).prop("checked", !$(this).prop("checked"));
        });
        $(".unsetAll").prop("checked", status);
        $(".chooseAll").prop("checked", false);
    });
}