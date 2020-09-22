{extends 'page.tpl'}

{block content}
    <h2>
        <center>{l s='Hello user '} {$first_name|upper} {$last_name|upper}</center>
        {l s='Your Favorite products '}
    </h2>
    <br>
    {* <div>{l s='This product is no longer available.' d='Shop.Notifications.Error'}</div> *}
    
    <div class="products row">
    
        {* {$favoriteproducts}
        {$favoriteproducts|var_dump} *}
    
        {* {$favoriteproducts|@debug_print_var} *}
    
    
    
    
    
    
    
    
    
        {* {foreach $favoriteproducts as $product} *}
        
        
        
        
        
            {* {$product|var_dump}
        
            {$product["date_add"]}
        
            {$product["name"]}
        
        
            <input type="checkbox" id="cb{$product["id_product"]}" class="addstar" value="">
            <label for="cb" class="star"></label>
            <a href="/{$product["link_rewrite"]}.html">{$product["link_rewrite"]}</a>
        
            {* {$product["description_short"]} *}
        
        
        
        
        
        
            {* {block name='product_miniature_item'}
                <article class="product-miniature js-product-miniature col-lg-3 col mr-auto" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
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
            {/block}*}
        
        
        
            {* <article class="product-miniature js-product-miniature col-lg-3" data-id-product="1" data-id-product-attribute="1" itemscope="" itemtype="http://schema.org/Product">
                <div class="thumbnail-container">
        
                    <a href="http://v93190it.beget.tech/men/1-1-hummingbird-printed-t-shirt.html#/1-rozmir-s/8-kolir-bilij" class="thumbnail product-thumbnail">
                        <img src="http://v93190it.beget.tech/2-home_default/hummingbird-printed-t-shirt.jpg" alt="Hummingbird printed t-shirt" data-full-size-image-url="http://v93190it.beget.tech/2-large_default/hummingbird-printed-t-shirt.jpg">
                    </a>
                    <div class="product-description">
                        <h3 class="h3 product-title" itemprop="name"><a href="http://v93190it.beget.tech/men/1-1-hummingbird-printed-t-shirt.html#/1-rozmir-s/8-kolir-bilij">{$product["name"]}</a></h3>
                        <div class="product-price-and-shipping">
                            <span class="sr-only">Ціна</span>
                            <span itemprop="price" class="price">34,80&nbsp;₴</span>
                            <a href="" class="btn btn-sm btn-primary float-right">Order Now</a>
                        </div>
                    </div>
                    <ul class="product-flags">
                        <li class="product-flag discount">
                            <input class="check" type="checkbox" id="check{$product["id_product"]}" value="{$product["id_product"]}" />
                        </li>
                        <li>
                            <input type="checkbox" id="cb{$product["id_product"]}" value="{$product["id_product"]}" class="addstar" />
                            <label for="cb{$product["id_product"]}" class="star"></label>
                        </li>
                    </ul>
                </div>
            </article> *}
        
            {* {var_dump($product)} *}
        
        
        
        
        
        {* {/foreach} *}
    
    
    
    
    
    
        {* <article class="product-miniature js-product-miniature col-lg-4" data-id-product="1" data-id-product-attribute="1" itemscope="" itemtype="http://schema.org/Product">
            <div class="thumbnail-container">
    
                <a href="http://v93190it.beget.tech/men/1-1-hummingbird-printed-t-shirt.html#/1-rozmir-s/8-kolir-bilij" class="thumbnail product-thumbnail">
                    <img src="http://v93190it.beget.tech/2-home_default/hummingbird-printed-t-shirt.jpg" alt="Hummingbird printed t-shirt" data-full-size-image-url="http://v93190it.beget.tech/2-large_default/hummingbird-printed-t-shirt.jpg">
                </a>
                <div class="product-description">
                    <h3 class="h3 product-title" itemprop="name"><a href="http://v93190it.beget.tech/men/1-1-hummingbird-printed-t-shirt.html#/1-rozmir-s/8-kolir-bilij">Hummingbird printed t-shirt</a></h3>
                    <div class="product-price-and-shipping">
                        <span class="sr-only">Ціна</span>
                        <span itemprop="price" class="price">34,80&nbsp;₴</span>
                        <a href="" class="btn btn-sm btn-primary float-right">Order Now</a>
                    </div>
                </div>
                <ul class="product-flags">
                    <li class="product-flag discount">
                        <input type="checkbox" id="cb{ $id }" value="{ $id }" />
                    </li>
                    <li>
                        <input type="checkbox" id="cb1" value="1" />
                        <label for="cb1" class="star"></label>
                    </li>
                </ul>
            </div>
        </article> *}
    
    
    
    
        <div id="favoriteproducts_block_account">
            {if $favoriteproducts}
                <div class="row">
                    {foreach $favoriteproducts as $product}
                        {* {foreach from=$favoriteProducts item=favoriteProduct} *}
                            <div class="favoriteproduct col-lg-3">
                                <a href="{$link->getProductLink($product.id_product, null, null, null, null, $product.id_shop)|escape:'html':'UTF-8'}" class="product_img_link">
                                    {* <img src="{$link->getImageLink($product.link_rewrite, $product.image, 'medium_default')|escape:'html':'UTF-8'}" alt="" /></a> *}
                
                                {$product.price_final}
                                <img src="{$link->getImageLink($product.link_rewrite, $product.id_product,'home_default', $product.image)|escape:'html':'UTF-8'}" alt="" />
                                {* {$link->getPriceStatic($productid)} *}
                
                                {* {$link->getProductLink($product.id_product)|var_dump} *}
                
                                <h3><a href="{$link->getProductLink($product.id_product, null, null, null, null, $product.id_shop)|escape:'html':'UTF-8'}">{$product.name|escape:'html':'UTF-8'}</a></h3>
                                <div class="product_desc">{$product.description_short|strip_tags|escape:'html':'UTF-8'}</div>
                
                                <div class="remove">
                                    <img rel="ajax_id_favoriteproduct_{$product.id_product}" src="/modules/favoriteproducts/views/img/del_star.png" alt="" class="icon" />
                                </div>
                            </div>
                        {/foreach}
                    </div>
                {else}
                    <p class="warning">{l s='No favorite products have been determined just yet. ' mod='favoriteproducts'}</p>
                {/if}
        
                <ul class="footer_links">
                    <li class="fleft">
                        <a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}">{l s='Back to your account.' mod='favoriteproducts'}</a></li>
                </ul>
            </div>
        
        
        
        
        </div>
    {/block}