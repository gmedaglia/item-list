<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Item List</title>
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="." />
        <link media="all" type="text/css" rel="stylesheet" href="/css/app.css" />

        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/black-tie/jquery-ui.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    </head>
    <body class="p-5">

        <div id="page" name="sasas">

            <div class="container container-fluid">

                <div class="row mb-4">
                    <div class="col-md-8"><h1>Items</h1></div>
                    <div class="col-md-4 text-right"><a id="add-item" class="btn btn-primary">Add item</a></div>
                </div>
                <div id="item-list"></div>

                @include('musta') 

            </div>


        </div>

        @push('scripts')
            <script type="text/javascript" src="/js/app.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script type="text/javascript">
                var itemList = itemList();
                $('#add-item').click(function(event) {
                    event.preventDefault();
                    itemList.addItem();
                })
                itemList.retrieve();
            </script>
        @endpush
        @stack('scripts')
    </body>
</html>
