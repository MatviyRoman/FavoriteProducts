{extends 'page.tpl'}
{block content}
    {if $result}
        <style>
            .result {
                color: #13462a;
                font-weight: bold;
                text-align: center;
                font-size: 30px;
                padding-bottom: 20px;
            }
        </style>
        <div class="result">
            {$result}
        </div>
    {elseif $error}
        <style>
            .error {
                color: #f00;
                font-weight: bold;
                text-align: center;
                font-size: 30px;
                padding-bottom: 20px;
            }
        </style>
        <div class="error">
            {$error}
        </div>
    {elseif $cart}
        <script>
            //window.location = '{$urls.pages.cart}';
            window.location = '/cart?action=show'
        </script>
    {/if}
{/block}