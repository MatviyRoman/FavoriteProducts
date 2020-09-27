{block content}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://user-list.matviy.pp.ua/css/style.min.css">
    <style>
        .favoriteproducts_block_admin {
            background: #fff;
            padding: 15px;
            margin-bottom: 50px;
        }
    
        .bootstrap .table {
            background: blanchedalmond;
        }
    
        tr:nth-child(even) td {
            background: gray !important;
            color: #fff !important;
            font-size: 16px !important;
        }
    
        tr:nth-child(odd) td {
            font-size: 16px !important;
        }
    </style>
    <div class="favoriteproducts_block_admin">
        <h2>
            {l s='Your User Favorite Products List'}
        </h2>
    
        {if $favoriteproducts}
            <table class="table user-list col-lg-6">
                <thead>
                    <tr>
                        <th><span>id_product</span></th>
                        <th class="text-center"><span>Product Title</span></th>
                        <th class="text-center"><span>Customer</span></th>
                        <th class="text-center"><span>Customer Id</span></th>
                        <th class="text-center"><span>Date Add</span></th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $favoriteproducts as $product}
                        <tr>
                            <td>
                                <span class="user-link">
                                    {$product.id_product}</span>
                            </td>
                            <td>
                                <span class="user-link">
                                    {$product.name}</span>
                            </td>
                            <td>
                                <span class="user-link">
                                    {$product.firstname} {$product.lastname}</span>
                            </td>
                            <td class="text-center">
                                <span class="user-subhead">
                                    {$product.id_customer}</span>
                            </td>
                            <td class="text-center">
                                <span class="user-subhead">
                                    {$product.date_add}</span>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p class="warning">{l s='No favorite products have been determined just yet.'}</p>
        {/if}
    </div>
{/block}