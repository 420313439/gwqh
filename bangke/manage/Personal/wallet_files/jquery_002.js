(function($) {
    var opt;
    $.fn.jqprint = function(options) {
        opt = $.extend({}, $.fn.jqprint.defaults, options);
        var $element = (this instanceof jQuery) ? this : $(this);
        if (opt.operaSupport && $.browser.opera) {
            var tab = window.open("", "jqPrint-preview");
            tab.document.open();
            var doc = tab.document;
        } else {
            var $iframe = $("<iframe style='position:absolute;top:20%;right:20%;width:800px;height:400px;z-index:100'/>");
            if (!opt.debug) {
                $iframe.css({
                    position: "absolute",
                    width: "0px",
                    height: "0px",
                    left: "-600px",
                    top: "-600px"
                });
            }
            $iframe.appendTo("body");
            var doc = $iframe[0].contentWindow.document;
        }
        if (opt.importCSS) {
            if ($("link[media=print]").length > 0) {
                $("link[media=print]").each(function() {
                    doc.write("<link type='text/css' rel='stylesheet' href='" + $(this).attr("href") + "' media='print' />");
                });
            } else {
                $("link").each(function() {
                    doc.write("<link type='text/css' rel='stylesheet' href='" + $(this).attr("href") + "' />");
                });
            }
        }
        if (opt.printContainer) {
            doc.write(handleHtml($element.outer()));
        } else {
            $element.each(function() {
                doc.write(handleHtml($(this).html()));
            });
        }
        doc.close();
        (opt.operaSupport && $.browser.opera ? tab : $iframe[0].contentWindow).focus();
        setTimeout(function() {
            (opt.operaSupport && $.browser.opera ? tab : $iframe[0].contentWindow).print();
            if (tab) {
                tab.close();
            }
        }, 1000);
    }
    $.fn.jqprint.defaults = {
        debug: false,
        importCSS: true,
        printContainer: true,
        operaSupport: true,
        handleHtml:false,
    };
    jQuery.fn.outer = function() {
        return $($('<div></div>').html(this.clone())).html();
    }
    function handleHtml(html){
        return opt.handleHtml?opt.handleHtml(html):html;
    }
})(jQuery);