{if json}
    {$json|@json_encode nofilter}
{else}
    ERROR
{/if}