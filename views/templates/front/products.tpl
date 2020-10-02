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
    {* <div>{l s='This product is no longer available.' d='Shop.Notifications.Error'}</div> *}
    
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
                        
                                            {* <form action="{$urls.pages.cart}" method="post">
                                                <input type="hidden" name="id_product" value="{$product.id_product}">
                                                <input type="number" name="qty" min="1" value="1" class="input-group form-control num">
                                                <button class="btn btn-sm btn-primary btn-success orderbtn" data-button-action="add-to-cart" type="submit">{l s='Order now'}</button>
                                            </form> *}
                        
                        
                                            {if $customerShow}
                                                <div class="product-quantity clearfix">
                            
                                                    <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
                                                        <input type="hidden" name="token" value="{$static_token}">
                                                        <input type="hidden" name="id_product" value="{$product.id_product}" id="product_page_product_id">
                                                        {* <input type="number" name="qty" min="1" value="1" class="input-group form-control num"> *}
                                                        {* <input type="number" name="qty" min="1" value="1" class="input-group form-control num"> *}
                                                        {* <div class="qty">
                                                            <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input type="number" name="qty" id="quantity_wanted" value="1" class="input-group form-control" min="1" aria-label="Кількість" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn-vertical"><button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button"><i class="material-icons touchspin-up"></i></button><button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button"><i class="material-icons touchspin-down"></i></button></span></div>
                                                        </div> *}
                                                        <input type="hidden" name="id_customization" value="0" id="product_customization_id">
                            
                                                        <div class="add">
                                                            <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit">
                                                                <i class="material-icons shopping-cart"></i>
                                                                У Кошик
                                                            </button>
                                                        </div>
                                                        {* <input type="hidden" name="token" value="09ea14f56163d462ea41103809bd0c15">
                                                        <input type="hidden" name="id_product" value="2" id="product_page_product_id">
                                                        <input type="hidden" name="id_customization" value="0" id="product_customization_id"> *}
                            
                                                        {* <div class="product-variants">
                                                            <div class="clearfix product-variants-item">
                                                                <span class="control-label">Розмір</span>
                                                                <select class="form-control form-control-select" id="group_1" data-product-attribute="1" name="group[1]">
                                                                    <option value="1" title="S" selected="selected">S</option>
                                                                    <option value="2" title="M">M</option>
                                                                    <option value="3" title="L">L</option>
                                                                    <option value="4" title="XL">XL</option>
                                                                </select>
                                                            </div>
                                                        </div> *}
                            
                                                        {* <div class="product-add-to-cart">
                                                            <span class="control-label">Кількість</span>
                                                            <div class="product-quantity clearfix"> *}
                                                                {* <div class="qty">
                                                                    <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input type="number" name="qty" id="quantity_wanted" value="1" class="input-group form-control" min="1" aria-label="Кількість" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn-vertical"><button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button"><i class="material-icons touchspin-up"></i></button><button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button"><i class="material-icons touchspin-down"></i></button></span></div>
                                                                </div> *}
                            
                                                                {* <div class="add">
                                                                    <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit">
                                                                        <i class="material-icons shopping-cart"></i>
                                                                        У Кошик
                                                                    </button>
                                                                </div> *}
                                                                {* </div>
                                                            <span id="product-availability">
                                                            </span>
                                                            <p class="product-minimal-quantity">
                                                            </p>
                                                        </div> *}
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