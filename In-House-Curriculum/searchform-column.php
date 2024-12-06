<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <button type="submit"></button>
    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="検索" />
    <input type="hidden" name="post_type" value="column" />
</form>