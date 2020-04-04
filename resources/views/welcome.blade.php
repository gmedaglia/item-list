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

        <style type="text/css">
            body {
                font-family: 'Roboto', sans-serif;
                font-size: 13px;
            }

        </style>
    </head>
    <body class="p-4">

        <div id="page" name="sasas">

            <div class="container container-fluid">

                <div class="row mb-4">
                    <div class="col-md-8"><h1>Items</h1></div>
                    <div class="col-md-4 text-right"><a id="add-item" class="btn btn-primary">Add item</a></div>
                </div>
                <div id="item-list"></div>

<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 0; right: 0;">
    <div class="toast-header">
        <strong class="mr-auto">Bootstrap</strong>
        <small>11 mins ago</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Order saved!
    </div>
</div>
</div>           

                @include('musta') 

            </div>


        </div>

        @push('scripts')
            <script type="text/javascript" src="/js/app.js"></script>

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
