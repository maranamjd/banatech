//Author      : @arboshiki
//create lobibox object
var Lobibox = Lobibox || {};
(function () {

    Lobibox.counter = 0;
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

    //User can set default properties for prompt in the following way
    //Lobibox.prompt.DEFAULT_OPTIONS = object;
    Lobibox.prompt = function (type, options) {
        return new LobiboxPrompt(type, options);
    };
    //User can set default properties for confirm in the following way
    //Lobibox.confirm.DEFAULT_OPTIONS = object;
    Lobibox.confirm = function (options) {
        return new LobiboxConfirm(options);
    };
    //User can set default properties for progress in the following way
    //Lobibox.progress.DEFAULT_OPTIONS = object;
    Lobibox.progress = function (options) {
        return new LobiboxProgress(options);
    };
    //Create empty objects in order user to be able to set default options in the following way
    //Lobibox.error.DEFAULT_OPTIONS = object;
    //Lobibox.success.DEFAULT_OPTIONS = object;
    //Lobibox.warning.DEFAULT_OPTIONS = object;
    //Lobibox.info.DEFAULT_OPTIONS = object;

    Lobibox.error = {};
    Lobibox.success = {};
    Lobibox.warning = {};
    Lobibox.info = {};

    //User can set default properties for alert in the following way
    //Lobibox.alert.DEFAULT_OPTIONS = object;
    Lobibox.alert = function (type, options) {
        if (["success", "error", "warning", "info"].indexOf(type) > -1) {
            return new LobiboxAlert(type, options);
        }
    };
    //User can set default properties for window in the following way
    //Lobibox.window.DEFAULT_OPTIONS = object;
    Lobibox.window = function (options) {
        return new LobiboxWindow('window', options);
    };


    /**
     * Base prototype for all messageboxes and window
     */
   
    //User can set default options by this variable
    Lobibox.base = {};
    Lobibox.base.OPTIONS = {
        bodyClass: 'lobibox-open',

        modalClasses: {
            'error': 'lobibox-error',
            'success': 'lobibox-success',
            'info': 'lobibox-info',
            'warning': 'lobibox-warning',
            'confirm': 'lobibox-confirm',
            'progress': 'lobibox-progress',
            'prompt': 'lobibox-prompt',
            'default': 'lobibox-default',
            'window': 'lobibox-window'
        },
        buttonsAlign: ['left', 'center', 'right'],
        buttons: {
            ok: {
                'class': 'lobibox-btn lobibox-btn-default',
                text: 'OK',
                closeOnClick: true
            },
            cancel: {
                'class': 'lobibox-btn lobibox-btn-cancel',
                text: 'Cancel',
                closeOnClick: true
            },
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Yes',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'No',
                closeOnClick: true
            }
        },
        icons: {
            bootstrap: {
                confirm: 'glyphicon glyphicon-question-sign',
                success: 'glyphicon glyphicon-ok-sign',
                error: 'glyphicon glyphicon-remove-sign',
                warning: 'glyphicon glyphicon-exclamation-sign',
                info: 'glyphicon glyphicon-info-sign'
            },
            fontAwesome: {
                confirm: 'fa fa-question-circle',
                success: 'fa fa-check-circle',
                error: 'fa fa-times-circle',
                warning: 'fa fa-exclamation-circle',
                info: 'fa fa-info-circle'
            }
        }
    };
    Lobibox.base.DEFAULTS = {
        horizontalOffset: 5,                //If the messagebox is larger (in width) than window's width. The messagebox's width is reduced to window width - 2 * horizontalOffset
        verticalOffset: 5,                  //If the messagebox is larger (in height) than window's height. The messagebox's height is reduced to window height - 2 * verticalOffset
        width: 600,
        height: 'auto',                     // Height is automatically calculated by width
        closeButton: false,                  // Show close button or not
        draggable: false,                   // Make messagebox draggable
        customBtnClass: 'lobibox-btn lobibox-btn-default', // Class for custom buttons
        modal: true,
        debug: false,
        buttonsAlign: 'center',             // Position where buttons should be aligned
        closeOnEsc: true,                   // Close messagebox on Esc press
        delayToRemove: 200,                 // Time after which lobibox will be removed after remove call. (This option is for hide animation to finish)
        delay: false,                       // Time to remove lobibox after shown
        baseClass: 'animated-super-fast',   // Base class to add all messageboxes
        showClass: 'zoomIn',                // Show animation class
        hideClass: 'zoomOut',               // Hide animation class
        iconSource: 'bootstrap',            // "bootstrap" or "fontAwesome" the library which will be used for icons

        //events
        //When messagebox show is called but before it is actually shown
        onShow: null,
        //After messagebox is shown
        shown: null,
        //When messagebox remove method is called but before it is actually hidden
        beforeClose: null,
        //After messagebox is hidden
        closed: null
    };
//------------------------------------------------------------------------------
//-------------------------LobiboxPrompt----------------------------------------
//------------------------------------------------------------------------------
    function LobiboxPrompt(type, options) {
        this.$input = null;
        this.$type = 'prompt';
        this.$promptType = type;

        options = $.extend({}, Lobibox.prompt.DEFAULT_OPTIONS, options);

        this.$options = this._processInput(options);

        this._init();
        this.debug(this);
    }

   

  

    Lobibox.confirm.DEFAULTS = {
        title: 'Question',
        width: 500
    };
//------------------------------------------------------------------------------
//-------------------------LobiboxAlert------------------------------------------
//------------------------------------------------------------------------------
   
    Lobibox.alert.OPTIONS = {
        warning: {
            title: 'Warning'
        },
        info: {
            title: 'Information'
        },
        success: {
            title: 'Success'
        },
        error: {
            title: 'Error'
        }
    };
   

 

    Lobibox.window.DEFAULTS = {
        width: 480,
        height: 600,
        content: '',  // HTML Content of window
        url: '',  // URL which will be used to load content
        draggable: true,  // Override default option
        autoload: true,  // Auto load from given url when window is created
        loadMethod: 'GET',  // Ajax method to load content
        showAfterLoad: true,  // Show window after content is loaded or show and then load content
        params: {}  // Parameters which will be send by ajax for loading content
    };

})();

//Author      : @arboshiki
/**
 * Generates random string of n length.
 * String contains only letters and numbers
 *
 * @param {int} n
 * @returns {String}
 */

var Lobibox = Lobibox || {};
(function () {

    var LobiboxNotify = function (type, options) {
//------------------------------------------------------------------------------
//----------------PROTOTYPE VARIABLES-------------------------------------------
//------------------------------------------------------------------------------
        this.$type = null;
        this.$options = null;
        this.$el = null;
//------------------------------------------------------------------------------
//-----------------PRIVATE VARIABLES--------------------------------------------
//------------------------------------------------------------------------------        
        var me = this;
//------------------------------------------------------------------------------
//-----------------PRIVATE FUNCTIONS--------------------------------------------
//------------------------------------------------------------------------------
        var _processInput = function (options) {

            if (options.size === 'mini' || options.size === 'large') {
                options = $.extend({}, Lobibox.notify.OPTIONS[options.size], options);
            }
            options = $.extend({}, Lobibox.notify.OPTIONS[me.$type], Lobibox.notify.DEFAULTS, options);

            if (options.size !== 'mini' && options.title === true) {
                options.title = Lobibox.notify.OPTIONS[me.$type].title;
            } else if (options.size === 'mini' && options.title === true) {
                options.title = false;
            }
            if (options.icon === true) {
                options.icon = Lobibox.notify.OPTIONS.icons[options.iconSource][me.$type];
            }
            if (options.sound === true) {
                options.sound = Lobibox.notify.OPTIONS[me.$type].sound;
            }
            if (options.sound) {
                options.sound = options.soundPath + options.sound + options.soundExt;
            }
            return options;
        };

        var _appendInWrapper = function ($el, $wrapper) {
            if (me.$options.size === 'normal') {
                if ($wrapper.hasClass('bottom')) {
                    $wrapper.prepend($el);
                } else {
                    $wrapper.append($el);
                }

            } else if (me.$options.size === 'mini') {
                if ($wrapper.hasClass('bottom')) {
                    $wrapper.prepend($el);
                } else {
                    $wrapper.append($el);
                }
            } else if (me.$options.size === 'large') {
                var tabPane = _createTabPane().append($el);
                var $li = _createTabControl(tabPane.attr('id'));
                $wrapper.find('.lb-notify-wrapper').append(tabPane);
                $wrapper.find('.lb-notify-tabs').append($li);
                _activateTab($li);
                $li.find('>a').click(function () {
                    _activateTab($li);
                });
            }
        };
        var _activateTab = function ($li) {
            $li.closest('.lb-notify-tabs').find('>li').removeClass('active');
            $li.addClass('active');
            var $current = $($li.find('>a').attr('href'));
            $current.closest('.lb-notify-wrapper').find('>.lb-tab-pane').removeClass('active');
            $current.addClass('active')
        };
        var _createTabControl = function (tabPaneId) {
            var $li = $('<li></li>', {
                'class': Lobibox.notify.OPTIONS[me.$type]['class']
            });
            $('<a></a>', {
                'href': '#' + tabPaneId
            }).append('<i class="tab-control-icon ' + me.$options.icon + '"></i>')
                .appendTo($li);
            return $li;
        };
        var _createTabPane = function () {
            return $('<div></div>', {
                'class': 'lb-tab-pane',
                'id': Math.randomString(10)
            })
        };
        var _createNotifyWrapper = function () {
            var selector = (me.$options.size === 'large' ? '.lobibox-notify-wrapper-large' : '.lobibox-notify-wrapper')
                    + "." + me.$options.position.replace(/\s/gi, '.'),
                $wrapper;

            //var classes = me.$options.position.split(" ");
            $wrapper = $(selector);
            if ($wrapper.length === 0) {
                $wrapper = $('<div></div>')
                    .addClass(selector.replace(/\./g, ' ').trim())
                    .appendTo($('body'));
                if (me.$options.size === 'large') {
                    $wrapper.append($('<ul class="lb-notify-tabs"></ul>'))
                        .append($('<div class="lb-notify-wrapper"></div>'));
                }
            }
            return $wrapper;
        };
        var _createNotify = function () {
            var OPTS = Lobibox.notify.OPTIONS,
                $iconEl,
                $innerIconEl,
                $iconWrapper,
                $body,
                $msg,
                $notify = $('<div></div>', {
                    'class': 'lobibox-notify ' + OPTS[me.$type]['class'] + ' ' + OPTS['class'] + ' ' + me.$options.showClass
                });

            $iconWrapper = $('<div class="lobibox-notify-icon-wrapper"></div>').appendTo($notify);
            $iconEl = $('<div class="lobibox-notify-icon"></div>').appendTo($iconWrapper);
            $innerIconEl = $('<div></div>').appendTo($iconEl);

            // Add image or icon depending on given parameters
            if (me.$options.img) {
                $innerIconEl.append('<img src="' + me.$options.img + '"/>');
            } else if (me.$options.icon) {
                $innerIconEl.append('<div class="icon-el"><i class="' + me.$options.icon + '"></i></div>');
            } else {
                $notify.addClass('without-icon');
            }
            // Create body, append title and message in body and append body in notification
            $msg = $('<div class="lobibox-notify-msg">' + me.$options.msg + '</div>');

            if (me.$options.messageHeight !== false) {
                $msg.css('max-height', me.$options.messageHeight);
            }

            $body = $('<div></div>', {
                'class': 'lobibox-notify-body'
            }).append($msg).appendTo($notify);

            if (me.$options.title) {
                $body.prepend('<div class="lobibox-notify-title">' + me.$options.title + '<div>');
            }
            _addCloseButton($notify);
            if (me.$options.size === 'normal' || me.$options.size === 'mini') {
                _addCloseOnClick($notify);
                _addDelay($notify);
            }

            // Give width to notification
            if (me.$options.width) {
                $notify.css('width', _calculateWidth(me.$options.width));
            }

            return $notify;
        };
        var _addCloseButton = function ($el) {
            if (!me.$options.closable) {
                return;
            }
            $('<span class="lobibox-close">&times;</span>').click(function () {
                me.remove();
            }).appendTo($el);
        };
        var _addCloseOnClick = function ($el) {
            if (!me.$options.closeOnClick) {
                return;
            }
            $el.click(function () {
                me.remove();
            });
        };
        var _addDelay = function ($el) {
            if (!me.$options.delay) {
                return;
            }
            if (me.$options.delayIndicator) {
                var delay = $('<div class="lobibox-delay-indicator"><div></div></div>');
                $el.append(delay);
            }
            var time = 0;
            var interval = 1000 / 30;
            var currentTime = new Date().getTime();
            var timer = setInterval(function () {
                if (me.$options.continueDelayOnInactiveTab){
                    time = new Date().getTime() - currentTime;
                } else {
                    time += interval;
                }

                var width = 100 * time / me.$options.delay;
                if (width >= 100) {
                    width = 100;
                    me.remove();
                    timer = clearInterval(timer);
                }
                if (me.$options.delayIndicator) {
                    delay.find('div').css('width', width + "%");
                }

            }, interval);

            if (me.$options.pauseDelayOnHover) {
                $el.on('mouseenter.lobibox', function () {
                    interval = 0;
                }).on('mouseleave.lobibox', function () {
                    interval = 1000 / 30;
                });
            }
        };
        var _findTabToActivate = function ($li) {
            var $itemToActivate = $li.prev();
            if ($itemToActivate.length === 0) {
                $itemToActivate = $li.next();
            }
            if ($itemToActivate.length === 0) {
                return null;
            }
            return $itemToActivate;
        };
        var _calculateWidth = function (width) {
            width = Math.min($(window).outerWidth(), width);
            return width;
        };
//------------------------------------------------------------------------------
//----------------PROTOTYPE FUNCTIONS-------------------------------------------
//------------------------------------------------------------------------------
        /**
         * Delete the notification
         *
         * @returns {LobiboxNotify}
         */
        this.remove = function () {
            me.$el.removeClass(me.$options.showClass)
                .addClass(me.$options.hideClass);
            var parent = me.$el.parent();
            var wrapper = parent.closest('.lobibox-notify-wrapper-large');

            var href = '#' + parent.attr('id');

            var $li = wrapper.find('>.lb-notify-tabs>li:has(a[href="' + href + '"])');
            $li.addClass(Lobibox.notify.OPTIONS['class'])
                .addClass(me.$options.hideClass);
            setTimeout(function () {
                if (me.$options.size === 'normal' || me.$options.size === 'mini') {
                    me.$el.remove();
                } else if (me.$options.size === 'large') {

                    var $newLi = _findTabToActivate($li);
                    if ($newLi) {
                        _activateTab($newLi);
                    }
                    $li.remove();
                    parent.remove();
                }
                var list = Lobibox.notify.list;
                var ind = list.indexOf(me);
                list.splice(ind, 1);
                var next = list[ind];
                if (next && next.$options.showAfterPrevious){
                    next._init();
                }
            }, 500);
            return me;
        };
        me._init = function () {
            // Create notification
            var $notify = _createNotify();
            if (me.$options.size === 'mini') {
                $notify.addClass('notify-mini');
            }

            if (typeof me.$options.position === 'string') {
                var $wrapper = _createNotifyWrapper();
                _appendInWrapper($notify, $wrapper);
                if ($wrapper.hasClass('center')) {
                    $wrapper.css('margin-left', '-' + ($wrapper.width() / 2) + "px");
                }
            } else {
                $('body').append($notify);
                $notify.css({
                    'position': 'fixed',
                    left: me.$options.position.left,
                    top: me.$options.position.top
                })
            }

            me.$el = $notify;
            if (me.$options.sound) {
                var snd = new Audio(me.$options.sound); // buffers automatically when created
                snd.play();
            }
            if (me.$options.rounded) {
                me.$el.addClass('rounded');
            }
            me.$el.on('click.lobibox', function(ev){
                if (me.$options.onClickUrl){
                    window.location.href = me.$options.onClickUrl;
                }
                if (me.$options.onClick && typeof me.$options.onClick === 'function'){
                    me.$options.onClick.call(me, ev);
                }
            });
            me.$el.data('lobibox', me);
        };
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
        this.$type = type;
        this.$options = _processInput(options);
        if (!me.$options.showAfterPrevious || Lobibox.notify.list.length === 0){
            this._init();
        }

    };

    Lobibox.notify = function (type, options) {
        if (["default", "info", "warning", "error", "success"].indexOf(type) > -1) {
            var lobibox = new LobiboxNotify(type, options);
            Lobibox.notify.list.push(lobibox);
            return lobibox;
        }
    };
    Lobibox.notify.list = [];
    Lobibox.notify.closeAll = function () {
        var list = Lobibox.notify.list;
        for (var i in list){
            list[i].remove();
        }
    };
    //User can set default options to this variable
    Lobibox.notify.DEFAULTS = {
        title: true,                // Title of notification. If you do not include the title in options it will automatically takes its value 
        //from Lobibox.notify.OPTIONS object depending of the type of the notifications or set custom string. Set this false to disable title
        size: 'normal',             // normal, mini, large
        // soundPath: 'sounds/',   // The folder path where sounds are located
        // soundExt: '.ogg',           // Default extension for all sounds
        showClass: 'fadeInDown',    // Show animation class.
        hideClass: 'zoomOut',       // Hide animation class.
        icon: true,                 // Icon of notification. Leave as is for default icon or set custom string
        msg: '',                    // Message of notification
        img: null,                  // Image source string
        closable: true,             // Make notifications closable
        hideCloseButton: false,     // Notification may be closable but you can hide close button and it will be closed by clicking on notification itsef
        delay: 5000,                // Hide notification after this time (in miliseconds)
        delayIndicator: true,       // Show timer indicator
        closeOnClick: true,         // Close notifications by clicking on them
        width: 400,                 // Width of notification box
        sound: true,                // Sound of notification. Set this false to disable sound. Leave as is for default sound or set custom soud path
        // Place to show notification. Available options: "top left", "top right", "bottom left", "bottom right", "center top", "center bottom"
        // It can also be object {left: number, top: number} to position notification at any place
        position: "top right",
        iconSource: 'bootstrap',    // "bootstrap" or "fontAwesome" the library which will be used for icons
        rounded: false,             // Whether to make notification corners rounded
        messageHeight: 60,          // Notification message maximum height. This is not for notification itself, this is for <code>.lobibox-notify-msg</code>
        pauseDelayOnHover: true,    // When you mouse over on notification delay (if it is enabled) will be paused.
        onClickUrl: null,           // The url which will be opened when notification is clicked
        showAfterPrevious: false,   // Set this to true if you want notification not to be shown until previous notification is closed. This is useful for notification queues
        continueDelayOnInactiveTab: true, // Continue delay when browser tab is inactive

        // Events
        onClick: null
    };
    //This variable is necessary.
    Lobibox.notify.OPTIONS = {
        'class': 'animated-fast',
        large: {
            width: 500,
            messageHeight: 96
        },
        mini: {
            'class': 'notify-mini',
            messageHeight: 32
        },
        default: {
            'class': 'lobibox-notify-default',
            'title': 'Default',
          
        },
        success: {
            'class': 'lobibox-notify-success',
            'title': 'Success',
          
        },
        error: {
            'class': 'lobibox-notify-error',
            'title': 'Error',
           
        },
        warning: {
            'class': 'lobibox-notify-warning',
            'title': 'Warning',
       
        },
        info: {
            'class': 'lobibox-notify-info',
            'title': 'Information',
         
        },
        icons: {
            bootstrap: {
                success: 'glyphicon glyphicon-ok-sign',
                error: 'glyphicon glyphicon-remove-sign',
                warning: 'glyphicon glyphicon-exclamation-sign',
                info: 'glyphicon glyphicon-info-sign'
            },
            fontAwesome: {
                success: 'fa fa-check-circle',
                error: 'fa fa-times-circle',
                warning: 'fa fa-exclamation-circle',
                info: 'fa fa-info-circle'
            }
        }
    };
})();


