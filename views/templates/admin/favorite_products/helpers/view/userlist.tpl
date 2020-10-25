{block content}
    {foreach $products as $product}
        <article class="col-4" id="{$product['id_product']}">
            <span class="num">{$product['id_product']}</span>
            {$image = Image::getCover($product['id_product'])}
            <img src="{$link->getImageLink($product.link_rewrite,  $image['id_image'])}" alt="{$product.name|truncate:30:'...'}" width="100" height="auto">
            <span class="name">{$product['name']}</span>
            <span class="cat">{$product['categories']}</span>
        </article>
    {/foreach}
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
{/block}