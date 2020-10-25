{extends 'page.tpl'}

{block content}
    <h2>
        {if $customerShow}
            <center>{l s='Hello user '} {$first_name|upper} {$last_name|upper}</center>
            {l s='Your Favorite products '}
        {else}
            <center>{l s='Favorite List For User №'} {$id_customer|upper}</center>
        {/if}
    </h2>
    <br>
    
    {if $products}
        
        {if $customerShow}
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="checkbox_all[]" id="checkbox_all" value="">
                <label for="checkbox_all" class="checkall btn btn-primary btn-lg">{l s='Checkbox all'}</label>
                <div class="btn btn-primary btn-danger btn-lg" id="delFavoritesProducts">{l s='delete'}</div>
                <div class="btn btn-primary btn-success btn-lg" id="buyFavoritesProducts">{l s='buy'}</div>
            </div>
        {/if}
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
                        
                                            {if $customerShow}
                                                {hook h='displayProductPriceBlock' product=$product type="before_price"}
                                            {/if}
                        
                                            <span class="sr-only">{l s='Price' d='Shop.Theme.Catalog'}</span>
                                            <span itemprop="price" class="price">{$product.price}</span>
                        
                                            {hook h='displayProductPriceBlock' product=$product type='unit_price'}
                        
                                            {hook h='displayProductPriceBlock' product=$product type='weight'}
                        
                        
                                            {if $customerShow}
                                                <div class="product-quantity clearfix">
                            
                                                    <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
                                                        <input type="hidden" name="token" value="{$static_token}">
                                                        <input type="hidden" name="id_product" value="{$product.id_product}" id="product_page_product_id">
                                                        <input type="hidden" name="id_customization" value="0" id="product_customization_id">
                            
                                                        <div class="add">
                                                            <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit">
                                                                <i class="material-icons shopping-cart"></i>
                                                                {l s='Add to cart'}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            {/if}
                                        </div>
                                    {/if}
                                {/block}
                
                                {block name='product_reviews'}
                                    {hook h='displayProductListReviews' product=$product}
                                {/block}
                            </div>
                
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
        
        {if $customerShow}
            <div class="custom-control custom-checkbox">
                <div class="btn btn-primary btn-danger btn-lg" id="delAllProducts">{l s='delete all'}</div>
                <div class="btn btn-primary btn-success btn-lg" id="buyAllProducts">{l s='buy all'}</div>
            </div>
            <div class="result">
                <p class="warning">You have deleted all products</p>
            </div>
            <script type='text/javascript'>
                const noSelectItem = "{l s='No items selected'}";
            </script>
        {/if}
    {else}
        <p class="warning">{l s='No favorite products have been determined just yet.'}</p>
    {/if}
    <ul class="footer_links">
        <li class="fleft">
            {if $customerShow}
                <a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" class="btn btn-sm btn-primary">{l s='Back to account'}</a>
            {else}
                <button onclick="goBack()" class="btn btn-sm btn-primary">{l s='Back to admin'}</button>
                <script>
                    function goBack() {
                        window.history.back();
                    }
                </script>
            {/if}
        </li>
    </ul>
{/block}