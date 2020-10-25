{* {extends 'page.tpl'} *}
{*
{block content}
    <h2>
        <center>{l s='Favorite List For User №'} {$id_customer|upper}</center>
    </h2>
    {if $products}
        <div class="favoriteproducts-wrapper row">
            {foreach $products as $product}
                {block name='product_miniature_item'}
                    <article class="product-miniature js-product-miniature col-lg-3" id="product-{$product.id_product}" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
                        <div class="thumbnail-container">
                            {block name='product_thumbnail'}
                                {if $product.cover}
                                    <a href="{$product.url}" class="thumbnail product-thumbnail">
                                        <img src="{$product.cover.bySize.home_default.url}" alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}" data-full-size-image-url="{$product.cover.large.url}" />
                                    </a>
                                {else}
                                    <a href="{$product.url}" class="thumbnail product-thumbnail">
                                        <img src="{$urls.no_picture_image.bySize.home_default.url}" />
                                    </a>
                                {/if}
                            {/block}
                
                            <div class="product-description">
                                {block name='product_name'}
                                    {if $page.page_name == 'index'}
                                        <h3 class="h3 product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></h3>
                                    {else}
                                        <h2 class="h3 product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></h2>
                                    {/if}
                                {/block}
                
                                {block name='product_price_and_shipping'}
                                    {if $product.show_price}
                                        <div class="product-price-and-shipping">
                                            {if $product.has_discount}
                                                {hook h='displayProductPriceBlock' product=$product type="old_price"}
                            
                                                <span class="sr-only">{l s='Regular price' d='Shop.Theme.Catalog'}</span>
                                                <span class="regular-price">{$product.regular_price}</span>
                                                {if $product.discount_type === 'percentage'}
                                                    <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
                                                {elseif $product.discount_type === 'amount'}
                                                    <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
                                                {/if}
                                            {/if}
                        
                                            {hook h='displayProductPriceBlock' product=$product type="before_price"}
                        
                        
                                            <span class="sr-only">{l s='Price' d='Shop.Theme.Catalog'}</span>
                                            <span itemprop="price" class="price">{$product.price}</span>
                        
                                            {hook h='displayProductPriceBlock' product=$product type='unit_price'}
                        
                                            {hook h='displayProductPriceBlock' product=$product type='weight'}
                        
                                        </div>
                                    {/if}
                                {/block}
                
                                {block name='product_reviews'}
                                    {hook h='displayProductListReviews' product=$product}
                                {/block}
                            </div>
                
                            <!-- @todo: use include file='catalog/_partials/product-flags.tpl'} -->
                            {block name='product_flags'}
                                <ul class="product-flags">
                                    {foreach from=$product.flags item=flag}
                                        <li class="product-flag {$flag.type}">{$flag.label}</li>
                                    {/foreach}
                                </ul>
                            {/block}
                
                            <div class="highlighted-informations{if !$product.main_variants} no-variants{/if} hidden-sm-down">
                                {block name='quick_view'}
                                    <a class="quick-view" href="#" data-link-action="quickview">
                                        <i class="material-icons search">&#xE8B6;</i> {l s='Quick view' d='Shop.Theme.Actions'}
                                    </a>
                                {/block}
                
                                {block name='product_variants'}
                                    {if $product.main_variants}
                                        {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
                                    {/if}
                                {/block}
                            </div>
                        </div>
                    </article>
                {/block}
            {/foreach}
        </div>
    {else}
        <p class="warning">{l s='No favorite products have been determined just yet.'}</p>
    {/if}
    <ul class="footer_links">
        <li class="fleft">
            <button onclick="goBack()" class="btn btn-sm btn-primary">{l s='Back to admin'}</button>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </li>
    </ul>
{/block} *}

{block name=favoriteproducts}
    
    {* {$products|dump} *}
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
                                    {* {$image = Image::getCover($product['id_product'])}
                                    <img src="{$link->getImageLink($product.link_rewrite,  $image['id_product'])}" alt="" width="45" height="auto"> *}
                                    <img src="{$link->getImageLink($product.link_rewrite,  $product['image'])}" alt="" width="45" height="auto">
                                {else}
                                    {* <img src="{$urls.no_picture_image.bySize.home_default.url}" /> *}
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
    
    
    {* {foreach $products as $product}
        <article class="col-4" id="{$product['id_product']}">
            <span class="num">{$product['id_product']}</span>
            {$image = Image::getCover($product['id_product'])}
            {* {$image['id_image']|dump}
            <img src="{$link->getImageLink($product.link_rewrite,  $image['id_image'])}" alt="{$product.name|truncate:30:'...'}" width="100" height="auto">
            <span class="name">{$product['name']}</span>
            <span class="cat">{$product['categories']}</span>
        </article>
    {/foreach} *}
    
    
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