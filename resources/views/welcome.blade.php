<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Item List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link media="all" type="text/css" rel="stylesheet" href="/css/app.css" />

        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

        <style type="text/css">
            body {
                font-family: 'Roboto', sans-serif;
            }
            body.wait, body.wait * {
                cursor: wait !important;
            }
        </style>
    </head>
    <body class="p-4">

        <div class="container container-fluid">

            <div class="row mb-4">
                <div class="col-md-8"><h3>Items</h3></div>
                <div class="col-md-4 text-right">
                    <button id="add-item" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                        <span class="fas fa-plus"></span> New Item
                    </button>
                </div>
            </div>

            <div id="item-list">

            </div>

            @include('toast')
            @include('modal_confirm_delete')
            @include('modal_create_edit', ['type' => 'create', 'title' => 'Create new item', 'method' => 'post'])
            @include('modal_create_edit', ['type' => 'edit', 'title' => 'Edit item', 'method' => 'put'])
            @include('hb_tpl')

        </div>

        @push('scripts')
            <script type="text/javascript" src="/js/app.js"></script>
            <script type="text/javascript">
                let itemList = new ItemList();
                itemList.init();
                itemList.getItems();
            </script>
        @endpush
        @stack('scripts')
    </body>
</html>
