<?php
    // $feed = RSS::feed('http://rss.nytimes.com/services/xml/rss/nyt/InternationalHome.xml');
    // $option_feed_enable = $user->options()->where('key', '=', 'feed_enable')->first();
    // var_dump ($option_feed_enable->value);
    // $feed_enable = ($option_feed_enable) ? $option_feed_enable->value  : Config::get('option.feed_enable');
    // var_dump ($feed_enable);
    // $feed_enable = (int) $feed_enable;
    // $feed_enable = 0;
    
    // $feed = RSS::feed('http://feeds.reuters.com/news/artsculture');
    // $counnt = $feed->articlesCount();
    // $info = $feed->info();
    // $articles = $feed->articles();
    // var_dump ($feed);
    
    $feed_enable = (int) OptionHelper::getValue($user->id, 'feed_enable');
    $feed_url = OptionHelper::getValue($user->id, 'feed_url');
    $feed_update_interval = OptionHelper::getValue($user->id, 'feed_update_interval');
    $articles = null;
    
    // var_dump ($feed_enable);
    // var_dump ($feed_url);
    // var_dump ($feed_update_interval);

    /*
    $feed_url_cached = Cache::get('feed_url');
    
    if ($feed_url_cached && $feed_url == $feed_url_cached) {
        $articles = Cache::get('articles');
        // echo "Cached";
    } else {
        $feed = RSS::feed($feed_url);
        $counnt = $feed->articlesCount();
        $info = $feed->info();
        $articles = $feed->articles();
        
        // $expireAt = Carbon::now()->addMinutes($feed_update_interval);
        // Cache::put('feed_url', $feed_url, $expireAt);
        // Cache::put('articles', $articles, $expireAt);
        Cache::put('feed_url', $feed_url, $feed_update_interval);
        Cache::put('articles', $articles, $feed_update_interval);
        // echo "Not Cached";
    }
    */
?>

<div>
    <a href="#" id="feed-toggle" data-toggle="collapse" data-target="#feed" style="line-height:40px;"><?php echo ($feed_enable == 0) ? "Show News" : "Hide News"; ?> </a>
    <div id="feed" class="collapse <?php echo ($feed_enable == 0) ? "" : "in"; ?>" style="background-color:#F8F8F8;">
        <div style="padding:20px 20px 10px 20px; line-height:50px; font-family:'Old English Text MT'; font-size:20px; text-align:center;">
            <!-- The New York Times -->
            {{ HTML::image("images/The_New_York_Times_logo.png", "The New York Times", array('style'=>'width:80%;'))}}
        </div>
        
        <ul class="articles">
            @if ($articles)
            @foreach ($articles as $article)
            <li class="article">
                <div class="title">
                    <a href="{{ $article->link }}" style="color:#000000;">{{ $article->title }}</a>
                </div>
                <div class="date">
                    {{ date('F d, Y', strtotime($article->pubDate)) }}
                </div>
            </li>
            @endforeach
            @endif
        </ul>
    </div>
</div>

<script> 
    $('#feed').on('hidden.bs.collapse', function() {
        $('#feed-toggle').html('Show News');
        
        $.ajax({
            type: 'get',
            url: "{{ url('user/'.$user->id.'/saveOption') }}",
            data: {
                key: 'feed_enable',
                value: '0'
            }
        })
        .done(function(response) {
            console.log(response);
        });
    });
    
    $('#feed').on('shown.bs.collapse', function() {
        $('#feed-toggle').html('Hide News');
        
        $.ajax({
            type: 'get',
            url: "{{ url('user/'.$user->id.'/saveOption') }}",
            data: {
                key: 'feed_enable',
                value: '1'
            }
        })
        .done(function(response) {
            console.log(response);
        });
    });
</script>
