<!DOCTYPE html>
<html>
<head>
    <title>jQuery UI Sortable : Get the order of Sortable Element</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.3/themes/hot-sneaks/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-2.1.3.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <style>
        div.sortIt { width: 120px; background-color: #44c756; font-family: Verdana;
            float: left; margin: 4px; text-align: center; border: medium solid #999;
            padding: 4px; color:#eee; box-shadow:5px 5px 5px #444;}

    </style>
    <script>
        $(document).ready(function() {
            $('#sortableContainer').sortable();
            $('button').button().click(function() {
                var itemOrder = $('#sortableContainer').sortable("toArray");
                alert(itemOrder);
            })

        });
    </script>

</head>
<body>
<div id="sortableContainer">
    <div id="Element1" class="sortIt">Item 1</div>
    <div id="Element2" class="sortIt">Item 2</div>
    <div id="Element3" class="sortIt">Item 3</div>
    <div id="Element4" class="sortIt">Item 4</div>
</div>
<br><br>
<p>The position is zero based.</p>
<br><br><div id=buttonDiv><button>Get Order of Elements</button></div>
</body>
</html>
