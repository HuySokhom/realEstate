<?php
$news_query = tep_db_query("
      select
        nd.news_id as news_id,
        n.image_thumbnail,
        n.news_type_id as id,
        nd.title
      from
        news n
          inner join
        news_description nd
          on
        n.id = nd.news_id
      where
        n.status = 1
          and
        nd.language_id = '" . (int)$languages_id . "'
            order by
        n.id desc, rand()
        limit 5
");
$num_news_sale = tep_db_num_rows($news_query);

if ($num_news_sale > 0) {
    $new_display = NULL;
    while ($news = tep_db_fetch_array($news_query)) {
        $new_display .= '
            <div class="item">
                <a title="' . $news['title'] . '" href="news.php#/' . $news['id'] . '/' . $news['news_id'] . '">
                    <img src="images/' . $news['image_thumbnail'] . '" />
                    <span class="news_title_home">' . $news['title']. '</span>
                </a>
            </div>
        ';
    }
    echo '<h3 style="border-bottom: 2px solid #333;">'. MENU_NEWS .'</h3><div class="owl-carousel">' . $new_display . '</div>';
}
?>