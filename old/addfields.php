<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="http://code.jquery.com/jquery-compat-git.js"></script>

    <title>Add/Remove Input Fields Dynamically with jQuery</title>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('.multi-field-wrapper').each(function() {
                var $wrapper = $('.multi-fields', this);
                $(".add-field", $(this)).click(function(e) {
                    $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
                });
                $('.multi-field .remove-field', $wrapper).click(function() {
                    if ($('.multi-field', $wrapper).length > 1)
                        $(this).parent('.multi-field').remove();
                });
            });
        }); //]]>
    </script>

</head>

<body>
    <form action="" method="POST">
        <label>Manage field</label>
        <div class="multi-field-wrapper">
            <div class="multi-fields">
                <div class="multi-field">
                    <select name="asdf">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                        <option value="">5</option>
                    </select>
                    <input type="text" name="stuff[]">
                    <button type="button" class="remove-field">Remove</button>
                </div>
            </div>
            <button type="button" class="add-field">Add field</button>
        </div>
    </form>
</body>

</html>