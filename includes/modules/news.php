<?php
$news_query = tep_db_query("
      select
        n.id,
        n.image_thumbnail,
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
        n.id asc, rand()
        limit 10"
);
$num_news_sale = tep_db_num_rows($news_query);

if ($num_news_sale > 0) {

    $new_display = NULL;

    while ($news = tep_db_fetch_array($news_query)) {
        $new_display .= '
            <div class="item">
                <a title="' . $news['title'] . '" href="http://' . $news['link'] . '" target="_blank">
                  <img src="images/' . $news['image_thumbnail'] . '" />
                </a>
              </div>
        ';
    }
    ?>

    <div id="partner-section" class="partner-section">
        <div class="row">
            <div id="business-partner" class="business-partner">
                <?php echo $new_display; ?>
            </div>
        </div>
    </div>
    <?php
}