<?php
    get_header();
    $query = $_GET['s'];
?>

<div class="content-container">
    <div class="row">
        <div class="main-content columns large-12">
            <article class="article" id="article">
                <header>
                    <h1 class="article-title">Sök: <?php echo $query; ?></h1>
                    <div id="result"></div>
                    <?php get_template_part('templates/partials/accessability','menu'); ?>
                </header>

                <ul class="pagination"></ul>
                <ul id="search" class="list"></ul>
                <ul class="pagination"></ul>
            </article>
        </div>
    </div>
</div>

<script>
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    var query = '<?php echo $query; ?>';
    var initial_data = { action: 'search', keyword: query, index: '1' };
    var next_data = null;
    var prev_data = null;

    jQuery.post(ajaxurl, initial_data, function(response) {
        updateSearch(JSON.parse(response));
    });

    function next() {
        jQuery.post(ajaxurl, next_data, function(response) {
            jQuery("html, body").animate({ scrollTop: 0 }, "slow");
            updateSearch(JSON.parse(response));
        });
    }

    function previous() {
        jQuery.post(ajaxurl, prev_data, function(response) {
            jQuery("html, body").animate({ scrollTop: 0 }, "slow");
            updateSearch(JSON.parse(response));
        });
    }

    function updateSearch(data) {
            var next     = data.queries.nextPage       !== undefined ? data.queries.nextPage[0]         : undefined;
            var prev     = data.queries.previousPage !== undefined ? data.queries.previousPage[0] : undefined;
            var request  = data.queries.request          !== undefined ? data.queries.request[0]            : undefined;
            var total = '<b>' + data.searchInformation.formattedTotalResults + '</b> träffar på <b>' + data.queries.request[0].searchTerms + '</b> inom hela webbplatsen';

            jQuery('#result').html("");
            jQuery('#search').html("");
            jQuery('.pagination').html("");
            jQuery('#result').append(total);

            for (var i = 0; i < data.items.length; i++) {
                var meta = data.items[i].pagemap.metatags[0];
                var item = '<li>';

                item += '<a href="' + data.items[i].link + '" desc="link-desc">';
                if (data.items[i].fileFormat !== undefined) {
                    if (data.items[i].fileFormat == 'PDF/Adobe Acrobat') {
                        item += '<span class="pdf-icon"></span>';
                    }
                }

                if (meta['moddate'] !== undefined ) {
                    item += '<span class="news-date">' + convertDate(meta['moddate']) + '</span>';
                } else if (meta['creationdate'] !== undefined) {
                    item += '<span class="news-date">' + convertDate(meta['creationdate'].substring(2,10)) + '</span>';
                } else if (meta['last-modified'] !== undefined){
                    item += '<span class="news-date">' + convertDate(meta['epi.published'].substring(5,16)) + '</span>';
                }

                item += '<h4 class="list-title">' + data.items[i].title + '</h4></a>';

                item += '<div class="list-content">' + data.items[i].htmlSnippet + '<div>';
                item += '</li>';

                jQuery('#search').append(item);
            }

            if (prev !== undefined) {
                var prevPage = '<li class="arrow" style="float: left;"><a onclick="previous()">Föregående</a></li>';
                prev_data = { action: 'search', keyword: query, index: prev['startIndex'].toString() };
                jQuery('.pagination').append(prevPage);
            }

            if (next !== undefined) {
                var nextPage = '<li class="arrow" style="float: right;"><a onclick="next()">Nästa</a></li>';
                next_data = { action: 'search', keyword: query, index: next['startIndex'].toString() };
                jQuery('.pagination').append(nextPage);
            }
    }

    function convertDate(value) {
        if (value.length > 20) {
            var year = value.substring(2,6);
            var month = value.substring(6,8);
            var day = value.substring(8,10);
            month = convertDateToMonth(month);
            return day + ' ' + month + ' ' + year;
        } else if (value.length == 11) {
            value = value.replace('May', 'Maj');
            value = value.replace('Oct', 'Okt');
            return value;
        } else if (value.length == 8) {
            var year = value.substring(0,4);
            var month = value.substring(4,6);
            var day = value.substring(6,value.length);
            month = convertDateToMonth(month);
            return day + ' ' + month + ' ' + year;
        } else {
            return '';
        }
    }

    function convertDateToMonth(month) {
        switch (month) {
            case '01':
                return "Jan";
            case '02':
                return "Feb";
            case '03':
                return "Mar";
            case '04':
                return "Apr";
            case '05':
                return "Maj";
            case '06':
                return "Jun";
            case '07':
                return "Jul";
            case '08':
                return "Aug";
            case '09':
                return "Sep";
            case '10':
                return "Okt";
            case '11':
                return "Nov";
            case '12':
                return "Dec";
        }
    }
</script>

<?php get_footer(); ?>
