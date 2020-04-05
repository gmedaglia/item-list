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
            }


        .btn-circle.btn-sm { 
            width: 30px; 
            height: 30px; 
            padding: 6px 0px; 
            border-radius: 15px; 
            font-size: 8px; 
            text-align: center; 
        } 
        .btn-circle.btn-md { 
            width: 50px; 
            height: 50px; 
            padding: 7px 10px; 
            border-radius: 25px; 
            font-size: 10px; 
            text-align: center; 
        } 
        .btn-circle.btn-xl { 
            width: 70px; 
            height: 70px; 
            padding: 10px 16px; 
            border-radius: 35px; 
            font-size: 12px; 
            text-align: center; 
        }             
        </style>
    </head>
    <body class="p-4">

        <div class="container container-fluid">

            <div class="row mb-4">
                <div class="col-md-8"><h3>Items</h3></div>
                <div class="col-md-4 text-right"><button id="add-item" class="btn btn-primary">New Item</button></div>
            </div>

            <div id="item-list">
                
            </div>

            @include('toast')
            @include('modal_confirm_delete')
            @include('modal_create_edit', ['title' => 'Create new item', 'method' => 'post', 'action' => route('items.store')])
            @include('musta') 

        </div>

        @push('scripts')
            <script type="text/javascript" src="/js/app.js"></script>
            <script type="text/javascript">
                let itemList = new ItemList();
                itemList.init();
                itemList.retrieve();
            </script>
        @endpush
        @stack('scripts')
    </body>
</html>
