$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$(function () {
    var IMG_PREFIX = 'demo/img/';
    (function () {
        Lobibox.base.DEFAULTS = $.extend({}, Lobibox.base.DEFAULTS, {
            iconSource: 'fontAwesome'
        });
        Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
            iconSource: 'fontAwesome'
        });

       
    (function () {
        //            Notification basic example
        (function () {
            $('#basicDefault').click(function () {
                Lobibox.notify('default', {
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
            $('#basicInfo').click(function () {
                Lobibox.notify('info', {
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
            $('#basicWarning').click(function () {
                Lobibox.notify('warning', {
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
            $('#basicError').click(function () {
                Lobibox.notify('error', {
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
            $('#basicSuccess').click(function () {
                Lobibox.notify('success', {
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
        })();
           })();
    })();
});