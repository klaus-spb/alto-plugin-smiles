var ls = ls || {};

ls.smiles = (function ($) {

    this.options = {
        preview: false,
        smiles: null,
        loader: DIR_STATIC_SKIN + 'assets/images/loader.gif',
    };
	
    this.initMarkitup = function(settings) {
	
        if (!settings || !settings.markupSet) {
            return;
        }
        settings.markupSet.push({
            separator: '---------------'
        });
        settings.markupSet.push({
            name: "Smiles",
            className: "editor-smiles",
            beforeInsert: function (action) {
                ls.smiles.toggle(action['textarea']);
            }
        });
    };

    this.toggle = function (el) {
		this.SmilesList(el);
		$('#smiles_list_' + $(el).attr('id')).toggleClass('smiles-hide');
    };

    this.SmilesList = function (el) {
        var textarea = $(el);
        var lid = 'smiles_list_' + textarea.attr('id');
        var list = $('#smiles_list_' + textarea.attr('id'));
        if (list.size()) {
            return list;
        }
        list = $('<div class="smiles smiles-hide"/>')
            .css({'background': 'url(' + this.options.loader + ') no-repeat center center', 'min-height': 70})
            .attr('id', lid)
            .insertBefore(textarea)
        ;
        var listWrap = $('<div/>').width('100%').insertBefore(textarea);

        listWrap.width('100%');

        if (!this.options.smiles) {
            ls.ajax(aRouter['ajax'] + 'get/smiles/', {security_ls_key: ALTO_SECURITY_KEY}, function (result) {
                if (result) {
                    this.options.smiles = result.aSmiles;
                    list.css({'background': 'none', 'height': '100%', 'min-height': 0});
                    this.Smiles(textarea, list);
                }

            }.bind(this));
        }

        return list.appendTo(listWrap);
    };

    this.Smiles = function (el, list) {
        var textarea = $(el);
        list.empty();
        $.each(this.options.smiles, function (index, smile) {
            var image = $('<img src="' + smile.src + '" align="middle"/>');
            var button = $('<a href="#" class="smiles-insert-button"/>')
                .attr({'title': smile.list.join(', ')})
                .data({'smiles-smile': smile.list[0], 'smiles-textarea': textarea.attr('id')}).click(function (e) {
                    e.preventDefault();
                    $.markItUp({
                        replaceWith: $(this).data('smiles-smile'),
                        target: '#' + $(this).data('smiles-textarea')
                    });
                });
            button.append(image);
            list.append(button);
        });
    };
    return this;
}).call(ls.smiles || {}, jQuery);


jQuery(function ($) {

    if (typeof $.fn.markItUp == 'function') {
        ls.hook.inject([jQuery.fn, 'markItUp'], function (settings, extraSettings) {
            ls.smiles.initMarkitup(settings || {markupSet: []});
        });
    }

    ls.hook.inject([ls.tools, 'textPreview'], function (textId, save, divPreview) {
        ls.smiles.options.preview = true;
    });

    ls.hook.inject([ls, 'ajax'], function (url, params, callback, more) {
        if (ls.smiles.options.preview) {
            params.disable_smiles = $('#disable_smiles:checked').size() ? 1 : 0;
        }
        ls.smiles.options.preview = false;
    });

});
