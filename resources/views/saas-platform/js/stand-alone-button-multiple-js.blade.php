<script>
    (function($) {

        $.fn.multiple_filemanager = function(type, options) {
            type = type || 'file';

            this.on('click', function(e) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                var input = $(this).data('input');
                var target_input = $('#' + $(this).data('input'));
                var target_preview = $('#' + $(this).data('preview'));
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                window.SetUrl = function(items) {

                    /*var file_path = items.map(function (item) {
                      return item.url;
                    }).join(',');

                    // set the value of the desired input to image url
                    target_input.val('').val(file_path).trigger('change');

                    // clear previous preview
                    target_preview.html('');*/

                    // set or change the preview image src
                    items.forEach(function(item) {
                        var html = '<li style="margin:10px 10px 0 0;overflow:hidden">' +
                            '<input type="hidden" name="' + input + '[]" value="' + item
                            .url + '" />' +
                            '<image src="' + item.thumb_url + '" style="height:100%"/>' +
                            '<div style="clear:both"></div>' +
                            '<div class="remove-image" onclick="jQuery(this).parent().remove();">X</div>' +
                            '</li>';
                        target_preview.append(
                            html
                        );
                    });

                    // trigger change event
                    target_preview.trigger('change');
                };
                return false;
            });
        }

    })(jQuery);
</script>
