{block name=favoriteproducts}
    <div class="panel col-lg-12">
        <div class="panel-heading">
            Favorite Products List
            <span class="badge">{$products|@count}</span>
        </div>
        <style>
            @media (max-width: 992px) {
                .table-responsive-row td:nth-of-type(1):before {
                    content: "ID";
                }
    
                .table-responsive-row td:nth-of-type(2):before {
                    content: "Product image";
                }
    
                .table-responsive-row td:nth-of-type(3):before {
                    content: "Product name";
                }
    
                .table-responsive-row td:nth-of-type(4):before {
                    content: "Product price";
                }
    
                .table-responsive-row td:nth-of-type(5):before {
                    content: "Product description short";
                }
    
                .table-responsive-row td:nth-of-type(6):before {
                    content: "Product categories";
                }
    
                .table-responsive-row td:nth-of-type(7):before {
                    content: "Date add";
                }
            }
        </style>
    
    
        <div class="table-responsive-row clearfix">
            <table id="table-customer" class="table favorite_products">
                <thead>
                    <tr class="nodrag nodrop">
                        <th class="fixed-width-xs center">
                            <span class="title_box">
                                ID
                            </span>
                        </th>
                        <th class="">
                            <span class="title_box">
                                Product image
                            </span>
                        </th>
                        <th class="">
                            <span class="title_box">
                                Product name
                            </span>
                        </th>
                        <th class="">
                            <span class="title_box">
                                Price without tax
                            </span>
                        </th>
                        <th class="">
                            <span class="title_box">
                                Product description short
                            </span>
                        </th>
                        <th class="">
                            <span class="title_box">
                                Product categories
                            </span>
                        </th>
                        <th class="">
                            <span class="title_box">
                                Date Add
                            </span>
                        </th>
                    </tr>
                </thead>
    
                <tbody class="favoriteproducts">
                    {foreach $products as $product}
                        <tr id="tr___0" class="odd">
                            <td class="fixed-width-xs center">
                                {$product['id_product']}
                            </td>
        
                            <td>
                                {if $product['image']}
                                    <img src="{$link->getImageLink($product.link_rewrite,  $product['image'])}" alt="" width="45" height="auto">
                                {else}
                                    <img src="{$url}/img/p/en-default-home_default.jpg" alt="" width="45" height="auto">
                                {/if}
                            </td>
                            <td>
                                {$product['name']}
                            </td>
                            <td>
                                {$product['price']|string_format:"%.2f"}
                            </td>
                            <td>
                                {$product['description_short']}
                            </td>
                            <td>
                                {$product['categories']}
                            </td>
                            <td>
                                {$product['date_add']}
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    
    <ul class="footer_links">
        <li class="fleft">
            <button onclick="goBack()" class="btn btn-sm btn-primary">{l s='Back to user list'}</button>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </li>
    </ul>
{/block}