{extends 'page.tpl'}

{block content}
    <h2>
        <center>{l s='Hello user '} {$first_name|upper} {$last_name|upper}</center>
        {l s='Your Favorite products '}
    </h2>
    <br>
    {* <div>{l s='This product is no longer available.' d='Shop.Notifications.Error'}</div> *}
    
    <div id="favoriteproducts_block_account">
        {if $favoriteproducts}
            <div class="row">
                {foreach $favoriteproducts as $product item=favoriteProduct}
                    {block name='product_miniature_item'}
                        <article class="product-miniature js-product-miniature col-lg-3 col mr-auto" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product" style="margin-bottom: 30px">
                            <div class="thumbnail-container">
                                {block name='product_thumbnail'}
                                    <a href="{$link->getProductLink($product.id_product)|escape:'html':'UTF-8'}" class="thumbnail product-thumbnail">
                                        <img src="{$link->getImageLink($product.link_rewrite, $product.id_product,'home_default', $product.image)|escape:'html':'UTF-8'}" alt="" />
                                    </a>
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
                                                    <span class="regular-price">
                                                        {* {$product.regular_price} *}
                                                        {$product.price * (1+($product.rate/100))}
                                                    </span>
                                                    {if $product.discount_type === 'percentage'}
                                                        <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
                                                    {elseif $product.discount_type === 'amount'}
                                                        <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
                                                    {/if}
                                                {/if}
                        
                                                {* {hook h='displayProductPriceBlock' product=$product type="before_price"} *}
                                                <input type="checkbox" id="item_product{$product.id_product}" class="item_product" value="{$product.id_product}">
                                                <input type="checkbox" id="cb{$product.id_product}" class="addstar" value="{$product.id_product}" checked>
                                                <label for="cb3" class="star"></label>
                                                {* <div class="remove">
                                                    <img rel="ajax_id_favoriteproduct_{$product.id_product}" src="/modules/favoriteproducts/views/img/del_star.png" alt="" class="icon" />
                                                </div> *}
                        
                                                <span class="sr-only">{l s='Price' d='Shop.Theme.Catalog'}</span>
                                                <span itemprop="price" class="price">
                                                    {* {$product.price} *}
                                                    {$product.price * (1+($product.rate/100))}
                                                    {$brutto = number_format($prajs, 2, ',', '')}
                                                </span><br>
                                                <a href="" class="btn btn-sm btn-primary">Order Now</a>
                        
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
            <p class="warning">{l s='No favorite products have been determined just yet. ' mod='favoriteproducts'}</p>
        {/if}
    
        <ul class="footer_links">
            <li class="fleft">
                <a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" class="btn btn-sm btn-primary">{l s='Back to account'}</a></li>
        </ul>
    </div>
{/block}